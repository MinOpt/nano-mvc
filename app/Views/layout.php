<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Nano MVC') ?></title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <header>
        <nav>
            <a href="/">Главная</a> | 
            <a href="/about">О проекте</a>
        </nav>
    </header>

    <main>
        <!-- Сюда вставится контент -->
        <?= $content ?>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> Nano MVC. Minimal PHP Framework.</p>
    </footer>
</body>
</html>