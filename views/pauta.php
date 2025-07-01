<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>SafeHm - Pauta</title>
    <link rel="stylesheet" href="public/style.css">
</head>
<body>
<div class="menu">
    <div class="menu-left">
        <h2>Menu</h2>
        <a href="index.php">Início</a>
        <a href="?squad=<?= urlencode($_GET['squad']) ?>">Voltar à Squad</a>
        <a href="?logout=1">Sair</a>
    </div>
    <div class="content">
        <h1><?= htmlspecialchars($pauta['name']) ?></h1>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="save_pauta">
            <textarea name="content" rows="10" style="width:100%;"><?= htmlspecialchars($pauta['content'] ?? '') ?></textarea>
            <input type="file" name="image" accept="image/*">
            <button type="submit">Salvar</button>
        </form>
    </div>
</div>
</body>
</html>

