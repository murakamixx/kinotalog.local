

<?php $__env->startSection('title', 'Личный кабинет — Кинокаталог'); ?>

<?php $__env->startSection('content'); ?>
    <div class="kp-page-header">
        <h1 class="kp-title">Личный кабинет</h1>
        <p class="kp-subtitle">Ваш профиль и активность</p>
    </div>

    <div class="kp-profile-grid">
        <section class="kp-card">
            <h2 class="kp-section-title">Профиль</h2>
            <p><strong>Логин:</strong> <?php echo e($user->username); ?></p>
            <p><strong>Email:</strong> <?php echo e($user->email); ?></p>
            <p><strong>Роль:</strong> <?php echo e($user->role === 'admin' ? 'Администратор' : 'Пользователь'); ?></p>
            <p><strong>Последний вход:</strong> <?php echo e($user->last_login?->format('d.m.Y H:i') ?? '—'); ?></p>
        </section>

        <section class="kp-card">
            <h2 class="kp-section-title">Статистика</h2>
            <p><strong>Лайков:</strong> <?php echo e($user->likes_count); ?></p>
            <p><strong>Комментариев:</strong> <?php echo e($user->comments_count); ?></p>
            <p><strong>В избранном:</strong> <?php echo e($user->favorites_count); ?></p>
        </section>
    </div>

    <section class="kp-card">
        <h2 class="kp-section-title">Избранные фильмы</h2>
        <div class="kp-movies-grid kp-movies-grid-sm">
            <?php $__empty_1 = true; $__currentLoopData = $user->favoriteMovies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <a href="<?php echo e(route('movies.show', $movie)); ?>" class="kp-movie-card">
                    <div class="kp-movie-poster-wrapper">
                        <?php if($movie->poster_url): ?>
                            <img src="<?php echo e($movie->poster_url); ?>" alt="<?php echo e($movie->title); ?>" class="kp-movie-poster">
                        <?php else: ?>
                            <div class="kp-movie-poster kp-movie-poster-placeholder">
                                <span><?php echo e(mb_substr($movie->title, 0, 1)); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="kp-movie-body">
                        <h3 class="kp-movie-title"><?php echo e($movie->title); ?></h3>
                        <p class="kp-movie-description"><?php echo e($movie->short_description); ?></p>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="kp-empty">
                    У вас пока нет фильмов в избранном.
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\OSPanel\home\kinotalog.local\resources\views/profile/index.blade.php ENDPATH**/ ?>