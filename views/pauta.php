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
                <?= htmlspecialchars($currentSquad['emoji'] ?? '') ?> <?= htmlspecialchars($currentSquad['name']) ?>
            </a>
            / <?= htmlspecialchars($pauta['name']) ?>
        </div>
        <h1><?= htmlspecialchars($pauta['name']) ?></h1>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="save_pauta">
            <textarea id="editor" name="content" rows="10" style="width:100%;"><?= htmlspecialchars($pauta['content'] ?? '') ?></textarea>
            <input type="file" name="image" accept="image/*">
            <button type="submit" name="return" value="0">Salvar</button>
            <button type="submit" name="return" value="1">Salvar e voltar</button>
        </form>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
        <script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
        <script>
            new EasyMDE({
                element: document.getElementById('editor'),
                autoDownloadFontAwesome: false,
                renderingConfig: { singleLineBreaks: false },
                spellChecker: false,
                toolbar: ["bold", "italic", "heading", "|", "quote", "unordered-list", "ordered-list", "link", "preview"],
                codemirrorOptions: { lineNumbers: true, theme: 'base16-dark' }
            });
        </script>
    </div>
</div>
</body>
</html>

