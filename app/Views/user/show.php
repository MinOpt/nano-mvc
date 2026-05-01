<!-- app/Views/user/show.php -->
<div class="container py-4">
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Профиль пользователя #<?= (int) $id ?></h4>
        </div>
        <div class="card-body">
            <p class="text-muted">ID: <strong><?= (int) $id ?></strong></p>
            
            <!-- Здесь потом будут данные из модели -->
            <dl class="row">
                <dt class="col-sm-3">Статус</dt>
                <dd class="col-sm-9">
                    <span class="badge bg-success">Активен</span>
                </dd>
                
                <dt class="col-sm-3">Дата регистрации</dt>
                <dd class="col-sm-9"><?= date('d.m.Y') ?></dd>
            </dl>
            
            <hr>
            <a href="/" class="btn btn-outline-secondary">← Назад</a>
            <a href="/user/<?= (int) $id ?>/edit" class="btn btn-primary">Редактировать</a>
        </div>
    </div>
</div>