<!DOCTYPE html>
<html lang="ru" data-bs-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dark Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    :root {
      --bg-body: #0b0f14;
      --bg-sidebar: #111827;
      --bg-panel: #151c26;
      --bg-card: #1a2231;
      --border: #2a3444;
      --accent: #6366f1;
      --accent-hover: #4f46e5;
      --text-main: #e5e7eb;
      --text-muted: #9ca3af;
    }

    body { background-color: var(--bg-body); color: var(--text-main); }
    
    /* Сайдбар */
    .sidebar {
      background-color: var(--bg-sidebar);
      border-right: 1px solid var(--border);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    .brand {
      padding: 1.25rem;
      border-bottom: 1px solid var(--border);
      font-weight: 700;
      font-size: 1.25rem;
      display: flex;
      align-items: center;
      gap: 10px;
      color: #fff;
    }
    .brand i { color: var(--accent); }

    /* Кнопки меню */
    .nav-link {
      color: var(--text-muted) !important;
      padding: 0.75rem 1rem !important;
      border-radius: 10px !important;
      margin-bottom: 6px;
      display: flex;
      align-items: center;
      gap: 12px;
      transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
      font-weight: 500;
    }
    .nav-link:hover {
      background: rgba(99, 102, 241, 0.12);
      color: #fff !important;
      transform: translateX(4px);
    }
    .nav-link.active {
      background: var(--accent) !important;
      color: #fff !important;
      box-shadow: 0 4px 14px rgba(99, 102, 241, 0.35);
    }
    .nav-link i { font-size: 1.1rem; width: 20px; text-align: center; }

    /* Карточки */
    .dash-card {
      background: var(--bg-card);
      border: 1px solid var(--border);
      border-radius: 12px;
      transition: transform 0.2s, box-shadow 0.2s;
    }
    .dash-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 24px rgba(0,0,0,0.35);
    }
    .dash-stat h2 { margin: 0; font-weight: 700; }
    
    /* Правая панель */
    .right-panel {
      background: var(--bg-panel);
      border-left: 1px solid var(--border);
      min-height: 100vh;
    }

    
    /* Скроллбар */
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #334155; border-radius: 3px; }
    ::-webkit-scrollbar-thumb:hover { background: #475569; }
  </style>
</head>
<body>
  <div class="container-fluid p-0">
    <div class="row min-vh-100 g-0">
      
      <!-- 🟦 ЛЕВАЯ КОЛОНКА: Меню -->
      <div class="col-3 sidebar">
        <div class="brand"><i class="bi bi-grid-3x3-gap-fill"></i> NexusDash</div>
        <nav class="p-3 flex-grow-1">
          
          <ul class="nav flex-column">
    <li class="nav-item"><a class="nav-link  <?= isActive('/') ?>" href="/"><i class="bi bi-house-door"></i> Главная</a></li>
    <li class="nav-item"><a class="nav-link <?= isActive('/analytics') ?>" href="/analytics"><i class="bi bi-bar-chart"></i> Аналитика</a></li>
    <li class="nav-item"><a class="nav-link <?= isActive('/projects') ?>" href="/projects"><i class="bi bi-folder2"></i> Проекты</a></li>
    <li class="nav-item"><a class="nav-link <?= isActive('/about') ?>" href="/about"><i class="bi bi-people"></i> Команда</a></li>
    <li class="nav-item"><a class="nav-link <?= isActive('/settings') ?>" href="/settings"><i class="bi bi-gear"></i> Настройки</a></li>
    <hr class="my-3" style="border-color: var(--border); opacity: 0.4;">
    <li class="nav-item"><a class="nav-link text-danger" href="#"><i class="bi bi-box-arrow-left"></i> Выход</a></li>
          </ul>
        </nav>
      </div>

      <!-- 🟨 ЦЕНТР: Основной контент -->
      <div class="col-6 p-4">
       <?=$content?>
      </div>

      <!-- 🟧 ПРАВАЯ КОЛОНКА: Дополнительно -->
      <div class="col-3 right-panel p-4">
        <h5 class="mb-3 fw-semibold">📢 Уведомления</h5>
        <div class="dash-card p-3 mb-3">
          <div class="d-flex gap-2">
            <i class="bi bi-bell fs-5 text-warning mt-1"></i>
            <div>
              <h6 class="mb-1">Обновление v2.4</h6>
              <p class="small text-muted mb-0">Доступны новые модули аналитики.</p>
            </div>
          </div>
        </div>
        <div class="dash-card p-3 mb-3">
          <div class="d-flex gap-2">
            <i class="bi bi-clock-history fs-5 text-info mt-1"></i>
            <div>
              <h6 class="mb-1">Плановое ТО</h6>
              <p class="small text-muted mb-0">28 апреля, 02:00–04:00 MSK</p>
            </div>
          </div>
        </div>

        <div class="dash-card p-3">
          <h6 class="mb-3 fw-semibold">Быстрые действия</h6>
          <div class="d-grid gap-2">
            <button class="btn btn-outline-light btn-sm">📊 Экспорт отчета</button>
            <button class="btn btn-outline-light btn-sm">👥 Пригласить в команду</button>
            <button class="btn btn-sm" style="background: var(--accent); border: none; color: #fff;">⚡ Создать проект</button>
          </div>
        </div>
      </div>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>