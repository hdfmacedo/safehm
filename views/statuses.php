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
        <table class="status-table">
            <thead>
                <tr><th>Nome</th><th>Cor</th><th>Ação</th></tr>
            </thead>
            <tbody>
            <?php foreach ($statuses as $st): ?>
                <tr>
                    <td><?= htmlspecialchars($st['name']) ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="action" value="update_status">
                            <input type="hidden" name="status" value="<?= htmlspecialchars($st['name']) ?>">
                            <input type="color" name="color" value="<?= htmlspecialchars($st['color']) ?>" onchange="this.form.submit()">
                        </form>
                    </td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="action" value="remove_status">
                            <input type="hidden" name="status" value="<?= htmlspecialchars($st['name']) ?>">
                            <button type="submit">Remover</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <form method="post">
                    <input type="hidden" name="action" value="add_status">
                    <td><input type="text" name="status" placeholder="Novo status" required></td>
                    <td><input type="color" name="color" value="#ffffff"></td>
                    <td><button type="submit">Cadastrar</button></td>
                </form>
            </tr>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
