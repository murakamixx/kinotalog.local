

<?php $__env->startSection('title', 'Админ-панель — Кинокаталог'); ?>

<?php $__env->startSection('content'); ?>
    <div class="kp-page-header">
        <h1 class="kp-title">Админ-панель</h1>
        <p class="kp-subtitle">Управление кинокаталогом</p>
    </div>

    <div class="kp-profile-grid">
        <section class="kp-card">
            <h2 class="kp-section-title">Статистика</h2>
            <p><strong>Фильмов:</strong> <?php echo e($moviesCount); ?></p>
            <p><strong>Пользователей:</strong> <?php echo e($usersCount); ?></p>
        </section>

        <section class="kp-card">
            <h2 class="kp-section-title">Действия</h2>
            <a href="<?php echo e(route('admin.movies.index')); ?>" class="kp-button kp-button-primary">
                Управление фильмами
            </a>
        </section>
    </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\OSPanel\home\kinotalog.local\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>