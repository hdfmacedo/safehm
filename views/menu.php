<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>SafeHm - Menu</title>
    <link rel="stylesheet" href="public/style.css">
</head>
<body>
<div class="menu">
    <div class="menu-left">
        <h2>Menu</h2>
        <a href="#">Início</a>
        <a href="#">Perfil</a>
        <a href="#">Configurações</a>
        <a href="?logout=1">Sair</a>
    </div>
    <div class="content">
        <h1>Bem-vindo, <?= htmlspecialchars($_SESSION['user']) ?>!</h1>
        <p>Conteúdo do SafeHm aqui...</p>
    </div>
</div>
</body>
</html>
