<div class="menu-left">
    <h2>Menu</h2>
    <a href="index.php">🏠 Início</a>
    <a href="#">👤 Perfil</a>
    <a href="#">⚙️ Configurações</a>
    <div class="squad-menu">
        <span>Squads/Comitês</span>
        <button id="add-squad-btn" type="button">+</button>
        <?php if (!empty($squads)): ?>
        <div class="submenu">
            <?php foreach ($squads as $squad): ?>
                <a href="?squad=<?= urlencode($squad['slug']) ?>">
                    <?= htmlspecialchars($squad['emoji'] ?? '') ?> <?= htmlspecialchars($squad['name']) ?>
                </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <form id="add-squad-form" method="post" style="display:none;">
            <input type="hidden" name="action" value="add_squad">
            <input type="hidden" name="squad_name" id="squad-name-input">
            <input type="hidden" name="squad_emoji" id="squad-emoji-input">
        </form>
    </div>
    <a href="?logout=1">🚪 Sair</a>
</div>
<script>
var btn = document.getElementById('add-squad-btn');
if(btn){
    btn.addEventListener('click', function() {
        const name = prompt('Nome da Squad/Comitê:');
        if (name) {
            const emoji = prompt('Emoji da Squad/Comitê (ex: 😃):', '');
            if (emoji) {
                document.getElementById('squad-name-input').value = name;
                document.getElementById('squad-emoji-input').value = emoji;
                document.getElementById('add-squad-form').submit();
            }
        }
    });
}
</script>
