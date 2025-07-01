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
        <div class="navbar"><a href="index.php">Home</a> / <?= htmlspecialchars($currentSquad['name']) ?></div>
        <h1><?= htmlspecialchars($currentSquad['name']) ?></h1>
        <h2>Pautas</h2>
        <table class="pauta-table">
            <thead>
                <tr><th>Nome</th><th>Criado em</th><th>Atualizado em</th></tr>
            </thead>
            <tbody>
            <?php foreach ($pautas as $p): ?>
                <tr>
                    <td><a href="?squad=<?= urlencode($currentSquad['slug']) ?>&pauta=<?= urlencode($p['file']) ?>"><?= htmlspecialchars($p['name']) ?></a></td>
                    <td><?= htmlspecialchars($p['created_at']) ?></td>
                    <td><?= htmlspecialchars($p['updated_at']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <form method="post" class="add-pauta-form">
            <input type="hidden" name="action" value="add_pauta">
            <input type="text" name="pauta_name" placeholder="Nova pauta" required>
            <button type="submit">Criar Pauta</button>
        </form>
    </div>
</div>
</body>
</html>

