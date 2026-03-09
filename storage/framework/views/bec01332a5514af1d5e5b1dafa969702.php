<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('title', 'Кинокаталог'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
</head>
<body class="kp-body">
    <header class="kp-header">
        <div class="kp-container kp-header-inner">
            <a href="<?php echo e(route('movies.index')); ?>" class="kp-logo">
                <span class="kp-logo-main">Kino</span><span class="kp-logo-accent">Catalog</span>
            </a>

            <form action="<?php echo e(route('movies.index')); ?>" method="GET" class="kp-search">
                <input
                    type="text"
                    name="q"
                    value="<?php echo e(request('q')); ?>"
                    placeholder="Фильмы, сериалы, персоны"
                    class="kp-input kp-input-search"
                >
            </form>

            <nav class="kp-nav">
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('profile.index')); ?>" class="kp-nav-link">
                        <?php echo e(auth()->user()->username); ?>

                    </a>
                    <?php if(auth()->user()->isAdmin()): ?>
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="kp-nav-link">Админ</a>
                    <?php endif; ?>
                    <form action="<?php echo e(route('logout')); ?>" method="POST" class="kp-inline-form">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="kp-button kp-button-ghost">Выйти</button>
                    </form>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="kp-nav-link">Войти</a>
                    <a href="<?php echo e(route('register')); ?>" class="kp-button kp-button-primary">Регистрация</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <main class="kp-main">
        <div class="kp-container">
            <?php if(session('status')): ?>
                <div class="kp-alert kp-alert-success">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </main>
</body>
</html>


<?php /**PATH D:\OSPanel\home\kinotalog.local\resources\views/layouts/app.blade.php ENDPATH**/ ?>