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
        <div class="squad-menu">
            <span>Squads/Comitês</span>
            <button id="add-squad-btn" type="button">+</button>
            <?php if (!empty($squads)): ?>
            <div class="submenu">
                <?php foreach ($squads as $squad): ?>
                    <a href="#"><?= htmlspecialchars($squad) ?></a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <form id="add-squad-form" method="post" style="display:none;">
                <input type="hidden" name="action" value="add_squad">
                <input type="hidden" name="squad_name" id="squad-name-input">
            </form>
        </div>
        <a href="?logout=1">Sair</a>
    </div>
    <div class="content">
        <h1>Bem-vindo, <?= htmlspecialchars($_SESSION['user']) ?>!</h1>
        <p>Conteúdo do SafeHm aqui...</p>
    </div>
</div>
<script>
document.getElementById('add-squad-btn').addEventListener('click', function() {
    const name = prompt('Nome da Squad/Comitê:');
    if (name) {
        document.getElementById('squad-name-input').value = name;
        document.getElementById('add-squad-form').submit();
    }
});
</script>
</body>
</html>
