<?php
session_start();
require_once __DIR__ . '/controllers/UserController.php';
require_once __DIR__ . '/models/User.php';
require_once __DIR__ . '/controllers/SquadController.php';

$controller = new UserController();
$squadController = new SquadController();
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
    if (isset($_GET['pauta']) && isset($_GET['squad'])) {
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
