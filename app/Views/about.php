<!-- app/Views/about.php -->
<h1><?= htmlspecialchars($title) ?></h1>
<p><?= htmlspecialchars($description ?? '') ?></p>

<?php if (!empty($features)): ?>
    <ul>
        <?php foreach ($features as $feature): ?>
            <li><?= htmlspecialchars($feature) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>