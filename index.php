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
    include __DIR__ . '/views/menu.php';
} else {
    include __DIR__ . '/views/login.php';
}
