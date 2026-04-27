<!-- app/Views/about.php -->
<div class="about-page">
    <!-- Заголовок -->
    <div class="mb-5">
        <h1 class="display-5 fw-bold mb-2">
            <i class="bi bi-info-circle-fill text-primary me-2"></i>
            <?= htmlspecialchars($title) ?>
        </h1>
        <p class="lead text-muted"><?= htmlspecialchars($description ?? 'Информация о проекте') ?></p>
    </div>

    <!-- Карточки с информацией -->
    <div class="row g-4 mb-5">
        <div class="col-md-6 col-lg-4">
            <div class="dash-card p-4 h-100">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-box bg-primary bg-opacity-10 rounded-3 p-3 me-3">
                        <i class="bi bi-box-seam fs-4 text-primary"></i>
                    </div>
                    <h5 class="mb-0 fw-semibold" style="overflow-wrap: break-word;">О проекте</h5>
                </div>
                <p class="text-muted mb-0" style="overflow-wrap: break-word; text-wrap: balance;">
                    Минималистичный PHP-фреймворк без магии и зависимостей. Простой, быстрый и понятный.
                </p>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="dash-card p-4 h-100">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-box bg-success bg-opacity-10 rounded-3 p-3 me-3">
                        <i class="bi bi-speedometer2 fs-4 text-success"></i>
                    </div>
                    <h5 class="mb-0 fw-semibold" style="overflow-wrap: break-word;">Производительность</h5>
                </div>
                <p class="text-muted mb-0" style="overflow-wrap: break-word; text-wrap: balance;">
                    Оптимизирован для скорости. Минимум накладных расходов, максимум эффективности.
                </p>
            </div>
        </div>

        <div class="col-md-6 col-lg-4">
            <div class="dash-card p-4 h-100">
                <div class="d-flex align-items-center mb-3">
                    <div class="icon-box bg-warning bg-opacity-10 rounded-3 p-3 me-3">
                        <i class="bi bi-shield-check fs-4 text-warning"></i>
                    </div>
                    <h5 class="mb-0 fw-semibold" style="overflow-wrap: break-word;">Безопасность</h5>
                </div>
                <p class="text-muted mb-0" style="overflow-wrap: break-word; text-wrap: balance;">
                    Встроенная защита от XSS, CSRF и SQL-инъекций. Ваши данные под надежной защитой.
                </p>
            </div>
        </div>
    </div>

    <!-- Фичи в виде сетки -->
    <?php if (!empty($features)): ?>
    <div class="mb-5">
        <h3 class="h4 fw-semibold mb-4">
            <i class="bi bi-stars me-2 text-primary"></i>
            Возможности
        </h3>
        <div class="row g-3">
            <?php 
            $icons = ['bi-router', 'bi-arrow-left-right', 'bi-file-earmark-code', 'bi-lightning-charge', 'bi-database', 'bi-plug'];
            foreach ($features as $index => $feature): 
                $icon = $icons[$index % count($icons)];
            ?>
            <div class="col-md-6 col-lg-4">
                <div class="dash-card p-3 d-flex align-items-center gap-3">
                    <i class="bi <?= $icon ?> fs-5 text-primary flex-shrink-0"></i>
                    <span class="fw-medium" style="overflow-wrap: break-word; text-wrap: balance;"><?= htmlspecialchars($feature) ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Версии и статистика -->
    <div class="row g-4">
        <div class="col-md-8">
            <div class="dash-card p-4">
                <h5 class="fw-semibold mb-3">
                    <i class="bi bi-git me-2"></i>
                    Информация о версии
                </h5>
                <div class="row text-center">
                    <div class="col-4">
                        <div class="mb-2">
                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">v2.4.0</span>
                        </div>
                        <small class="text-muted">Текущая версия</small>
                    </div>
                    <div class="col-4">
                        <div class="mb-2">
                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">PHP 8.1+</span>
                        </div>
                        <small class="text-muted">Требования</small>
                    </div>
                    <div class="col-4">
                        <div class="mb-2">
                            <span class="badge bg-info bg-opacity-10 text-info px-3 py-2">MIT</span>
                        </div>
                        <small class="text-muted">Лицензия</small>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="dash-card p-4 h-100">
                <h5 class="fw-semibold mb-3"> Документация</h5>
                <div class="d-grid gap-2">
                    <a href="#" class="btn btn-outline-light btn-sm text-start">
                        <i class="bi bi-book me-2"></i>Руководство
                    </a>
                    <a href="#" class="btn btn-outline-light btn-sm text-start">
                        <i class="bi bi-code-slash me-2"></i>API Reference
                    </a>
                    <a href="#" class="btn btn-outline-light btn-sm text-start">
                        <i class="bi bi-question-circle me-2"></i>FAQ
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.about-page .dash-card {
    background: var(--bg-card, #1a2231);
    border: 1px solid var(--border, #2a3444);
    border-radius: 12px;
    transition: all 0.3s ease;
    /* Гарантируем, что ничего не вылезет за пределы */
    overflow: hidden;
}
.about-page .dash-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(99, 102, 241, 0.15);
    border-color: var(--accent, #6366f1);
}
.about-page .icon-box {
    flex-shrink: 0;
}
/* Для всех текстов внутри карточек */
.about-page .dash-card h5,
.about-page .dash-card p,
.about-page .dash-card span {
    overflow-wrap: break-word;
    word-break: break-word;
    hyphens: auto;
}
</style>