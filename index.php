<?php
session_start();
require_once __DIR__ . '/controllers/UserController.php';
require_once __DIR__ . '/models/User.php';
require_once __DIR__ . '/controllers/SquadController.php';
require_once __DIR__ . '/controllers/CommentStatusController.php';
require_once __DIR__ . '/models/CommentStatus.php';

$controller = new UserController();
$squadController = new SquadController();
$statusController = new CommentStatusController();
$statuses = CommentStatus::getAll();
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'add_squad' && isset($_SESSION['user'])) {
        $squadController->addSquad($_POST['squad_name'] ?? '');
    } elseif (isset($_POST['action']) && $_POST['action'] === 'add_pauta' && isset($_SESSION['user'])) {
        $squadController->addPauta($_GET['squad'] ?? '', $_POST['pauta_name'] ?? '');
    } elseif (isset($_POST['action']) && $_POST['action'] === 'save_pauta' && isset($_SESSION['user'])) {
        $squadController->savePauta(
            $_GET['squad'] ?? '',
            $_GET['pauta'] ?? '',
            $_POST['content'] ?? '',
            $_FILES['image'] ?? null
        );
        if (!empty($_POST['return']) && $_POST['return'] === '1') {
            header('Location: ?squad=' . urlencode($_GET['squad'] ?? ''));
            exit;
        }
    } elseif (isset($_POST['action']) && $_POST['action'] === 'add_status' && isset($_SESSION['user'])) {
        $statusController->addStatus($_POST['status'] ?? '');
        $statuses = $statusController->getStatuses();
    } elseif (isset($_POST['action']) && $_POST['action'] === 'remove_status' && isset($_SESSION['user'])) {
        $statusController->removeStatus($_POST['status'] ?? '');
        $statuses = $statusController->getStatuses();
    } elseif (isset($_POST['action']) && $_POST['action'] === 'add_comment' && isset($_SESSION['user'])) {
        $squadController->addComment(
            $_GET['squad'] ?? '',
            $_GET['pauta'] ?? '',
            $_SESSION['user'],
            $_POST['comment_text'] ?? '',
            $_POST['comment_status'] ?? ''
        );
        $pauta = $squadController->getPauta($_GET['squad'], $_GET['pauta']);
    } elseif (isset($_POST['action']) && $_POST['action'] === 'update_comment_status' && isset($_SESSION['user'])) {
        $squadController->updateCommentStatus(
            $_GET['squad'] ?? '',
            $_GET['pauta'] ?? '',
            intval($_POST['comment_index'] ?? 0),
            $_POST['new_status'] ?? ''
        );
        $pauta = $squadController->getPauta($_GET['squad'], $_GET['pauta']);
    } else {
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');
        if ($_POST['action'] === 'login') {
            if (!$controller->login($username, $password)) {
                $message = 'Usuário ou senha inválidos.';
            }
        } elseif ($_POST['action'] === 'register') {
            if (!$controller->register($username, $password)) {
                $message = 'Usuário já existe.';
            }
        }
    }
}

if (isset($_GET['logout'])) {
    $controller->logout();
    header('Location: index.php');
    exit;
}

if (isset($_SESSION['user'])) {
    $squads = $squadController->getSquads();
    if (isset($_GET['config']) && $_GET['config'] === 'statuses') {
        $statuses = $statusController->getStatuses();
        include __DIR__ . '/views/statuses.php';
    } elseif (isset($_GET['pauta']) && isset($_GET['squad'])) {
        $pauta = $squadController->getPauta($_GET['squad'], $_GET['pauta']);
        $currentSquad = Squad::getBySlug($_GET['squad']);
        include __DIR__ . '/views/pauta.php';
    } elseif (isset($_GET['squad'])) {
        $currentSquad = Squad::getBySlug($_GET['squad']);
        $pautas = $squadController->getPautas($_GET['squad']);
        include __DIR__ . '/views/squad.php';
    } else {
        include __DIR__ . '/views/menu.php';
    }
} else {
    include __DIR__ . '/views/login.php';
}
