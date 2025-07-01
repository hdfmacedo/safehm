<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>SafeHm - Menu</title>
    <link rel="stylesheet" href="public/style.css">
</head>
<body>
<div class="menu">
    <?php include __DIR__ . '/partials/sidebar.php'; ?>
    <div class="content">
        <div class="navbar">Home</div>
        <h1>Bem-vindo, <?= htmlspecialchars($_SESSION['user']) ?>!</h1>
        <p>Conteúdo do SafeHm aqui...</p>
    </div>
</div>
</body>
</html>
