<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>SafeHm - Squad</title>
    <link rel="stylesheet" href="public/style.css">
</head>
<body>
<div class="menu">
    <div class="menu-left">
        <h2>Menu</h2>
        <a href="index.php">Início</a>
        <div class="squad-menu">
            <span>Squads/Comitês</span>
            <?php if (!empty($squads)): ?>
            <div class="submenu">
                <?php foreach ($squads as $s): ?>
                    <a href="?squad=<?= urlencode($s['slug']) ?>">
                        <?= htmlspecialchars($s['name']) ?>
                    </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
        <a href="?logout=1">Sair</a>
    </div>
    <div class="content">
        <h1><?= htmlspecialchars($currentSquad['name']) ?></h1>
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

