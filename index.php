<?php
session_start();
require_once __DIR__ . '/controllers/UserController.php';
require_once __DIR__ . '/models/User.php';

$controller = new UserController();
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

if (isset($_GET['logout'])) {
    $controller->logout();
    header('Location: index.php');
    exit;
}

if (isset($_SESSION['user'])) {
    include __DIR__ . '/views/menu.php';
} else {
    include __DIR__ . '/views/login.php';
}
