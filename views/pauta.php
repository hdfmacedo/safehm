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
            <div class="button-row">
                <button type="submit" name="return" value="0">Salvar</button>
                <button type="submit" name="return" value="1">Salvar e voltar</button>
            </div>
        </form>
        <h2>Comentários</h2>
        <ul class="comment-list">
            <?php foreach (($pauta['comments'] ?? []) as $idx => $c): ?>
                <li>
                    <strong><?= htmlspecialchars($c['user']) ?>:</strong>
                    <?= nl2br(htmlspecialchars($c['text'])) ?>
                    <form method="post" class="status-form" style="display:inline;">
                        <input type="hidden" name="action" value="update_comment_status">
                        <input type="hidden" name="comment_index" value="<?= $idx ?>">
                        <select name="new_status" onchange="this.form.submit()">
                            <?php foreach ($statuses as $st): ?>
                                <option value="<?= htmlspecialchars($st) ?>" <?= $c['status'] === $st ? 'selected' : '' ?>><?= htmlspecialchars($st) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
        <form method="post" class="add-comment-form">
            <input type="hidden" name="action" value="add_comment">
            <textarea name="comment_text" placeholder="Seu comentário" required></textarea>
            <select name="comment_status">
                <?php foreach ($statuses as $st): ?>
                    <option value="<?= htmlspecialchars($st) ?>"><?= htmlspecialchars($st) ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Comentar</button>
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

