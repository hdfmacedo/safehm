<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>SafeHm - Pauta</title>
    <link rel="stylesheet" href="public/style.css">
</head>
<body>
<div class="menu">
    <?php include __DIR__ . '/partials/sidebar.php'; ?>
    <div class="content">
        <div class="navbar">
            <a href="index.php">Home</a> /
            <a href="?squad=<?= urlencode($currentSquad['slug']) ?>">
                <?= htmlspecialchars($currentSquad['name']) ?>
            </a>
            / <?= htmlspecialchars($pauta['name']) ?>
        </div>
        <h1><?= htmlspecialchars($pauta['name']) ?></h1>
        <form method="post" enctype="multipart/form-data" id="pauta-form">
            <input type="hidden" name="action" value="save_pauta">
            <input type="hidden" name="content" id="content-input">
            <div id="editor" style="height:300px;"><?= $pauta['content'] ?? '' ?></div>
            <input type="file" name="image" accept="image/*">
            <div class="button-row">
                <button type="submit" name="return" value="0">Salvar</button>
                <button type="submit" name="return" value="1">Salvar e voltar</button>
            </div>
        </form>
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
        <script>
            var quill = new Quill('#editor', { theme: 'snow' });
            document.getElementById('pauta-form').addEventListener('submit', function () {
                document.getElementById('content-input').value = quill.root.innerHTML;
            });
        </script>
    </div>
</div>
</body>
</html>

