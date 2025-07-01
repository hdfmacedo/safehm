<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>SafeHm - Status de Comentários</title>
    <link rel="stylesheet" href="public/style.css">
</head>
<body>
<div class="menu">
    <?php include __DIR__ . '/partials/sidebar.php'; ?>
    <div class="content">
        <div class="navbar"><a href="index.php">Home</a> / Configurações / Status de comentários</div>
        <h1>Status de Comentários</h1>
        <ul class="status-list">
            <?php foreach ($statuses as $st): ?>
                <li>
                    <span style="color: <?= htmlspecialchars($st['color']) ?>; font-weight:bold;">
                        <?= htmlspecialchars($st['name']) ?>
                    </span>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="action" value="remove_status">
                        <input type="hidden" name="status" value="<?= htmlspecialchars($st['name']) ?>">
                        <button type="submit">Remover</button>
                    </form>
                    <form method="post" style="display:inline; margin-left:5px;">
                        <input type="hidden" name="action" value="update_status">
                        <input type="hidden" name="status" value="<?= htmlspecialchars($st['name']) ?>">
                        <input type="color" name="color" value="<?= htmlspecialchars($st['color']) ?>" onchange="this.form.submit()">
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
        <form method="post" class="add-status-form">
            <input type="hidden" name="action" value="add_status">
            <input type="text" name="status" placeholder="Novo status" required>
            <input type="color" name="color" value="#ffffff">
            <button type="submit">Adicionar</button>
        </form>
    </div>
</div>
</body>
</html>
