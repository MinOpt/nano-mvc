<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <style>
        body { font-family: system-ui, sans-serif; max-width: 700px; margin: 2rem auto; padding: 0 1rem; line-height: 1.6; }
        ul { background: #f5f5f5; padding: 1rem 2rem; border-radius: 8px; }
        a { color: #0066cc; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1><?= htmlspecialchars($title) ?></h1>
    <p><?= htmlspecialchars($description) ?></p>
    
    <h3>Возможности:</h3>
    <ul>
        <?php foreach ($features as $feature): ?>
            <li><?= htmlspecialchars($feature) ?></li>
        <?php endforeach; ?>
    </ul>

    <p><a href="/">← Вернуться на главную</a></p>
</body>
</html>