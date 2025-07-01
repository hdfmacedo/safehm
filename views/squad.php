<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>SafeHm - Squad</title>
    <link rel="stylesheet" href="public/style.css">
</head>
<body>
<div class="menu">
    <?php include __DIR__ . '/partials/sidebar.php'; ?>
    <div class="content">
        <div class="navbar"><a href="index.php">Home</a> / <?= htmlspecialchars($currentSquad['emoji'] ?? '') ?> <?= htmlspecialchars($currentSquad['name']) ?></div>
        <h1><?= htmlspecialchars($currentSquad['emoji'] ?? '') ?> <?= htmlspecialchars($currentSquad['name']) ?></h1>
        <form method="post">
            <input type="hidden" name="action" value="add_pauta">
            <input type="text" name="pauta_name" placeholder="Nova pauta" required>
            <button type="submit">Criar Pauta</button>
        </form>
        <h2>Pautas</h2>
        <ul>
            <?php foreach ($pautas as $p): ?>
                <li>
                    <a href="?squad=<?= urlencode($currentSquad['slug']) ?>&pauta=<?= urlencode($p['file']) ?>">
                        <?= htmlspecialchars($p['name']) ?>
                    </a>
                    - Criado em <?= htmlspecialchars($p['created_at']) ?> - Atualizado em <?= htmlspecialchars($p['updated_at']) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
</body>
</html>

