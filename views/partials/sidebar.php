<div class="menu-left">
    <h2>Menu</h2>
    <a href="index.php">Início</a>
    <div class="squad-menu">
        <span>Squads/Comitês</span>
        <button id="add-squad-btn" type="button">+</button>
        <?php if (!empty($squads)): ?>
        <div class="submenu">
            <?php foreach ($squads as $squad): ?>
                <a href="?squad=<?= urlencode($squad['slug']) ?>">
                    <?= htmlspecialchars($squad['name']) ?>
                </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <form id="add-squad-form" method="post" style="display:none;">
            <input type="hidden" name="action" value="add_squad">
            <input type="hidden" name="squad_name" id="squad-name-input">
        </form>
    </div>
    <div class="config-menu">
        <span>Configurações</span>
        <div class="submenu">
            <a href="?config=statuses">Status de comentários</a>
            <a href="?config=pauta_statuses">Status de pautas</a>
        </div>
    </div>
    <a href="?logout=1">Sair</a>
</div>
<script>
var btn = document.getElementById('add-squad-btn');
if(btn){
    btn.addEventListener('click', function() {
        const name = prompt('Nome da Squad/Comitê:');
        if (name) {
            document.getElementById('squad-name-input').value = name;
            document.getElementById('add-squad-form').submit();
        }
    });
}
</script>
