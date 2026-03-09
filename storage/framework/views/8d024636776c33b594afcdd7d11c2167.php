

<?php $__env->startSection('title', 'Кинокаталог'); ?>

<?php $__env->startSection('content'); ?>
    <div class="kp-page-header">
        <h1 class="kp-title">Кинокаталог</h1>
        <p class="kp-subtitle">Поиск, сортировка и фильтрация фильмов</p>
    </div>

    <section class="kp-filters">
        <form method="GET" action="<?php echo e(route('movies.index')); ?>" class="kp-filters-form">
            <input type="hidden" name="q" value="<?php echo e(request('q')); ?>">

            <div class="kp-filters-row">
                <div class="kp-field">
                    <label class="kp-label">Год</label>
                    <input
                        type="number"
                        name="year"
                        value="<?php echo e(request('year')); ?>"
                        class="kp-input"
                        placeholder="Например, 2024"
                    >
                </div>

                <div class="kp-field">
                    <label class="kp-label">Жанр</label>
                    <select name="genre" class="kp-input">
                        <option value="">Все жанры</option>
                        <?php $__currentLoopData = $genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($genre->id); ?>" <?php if(request('genre') == $genre->id): echo 'selected'; endif; ?>>
                                <?php echo e($genre->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="kp-field">
                    <label class="kp-label">Сортировка</label>
                    <select name="sort" class="kp-input">
                        <option value="newest" <?php if(request('sort') === 'newest'): echo 'selected'; endif; ?>>Новые сначала</option>
                        <option value="oldest" <?php if(request('sort') === 'oldest'): echo 'selected'; endif; ?>>Старые сначала</option>
                        <option value="year" <?php if(request('sort') === 'year'): echo 'selected'; endif; ?>>По году выпуска</option>
                        <option value="rating" <?php if(request('sort') === 'rating'): echo 'selected'; endif; ?>>По рейтингу</option>
                        <option value="popular" <?php if(request('sort') === 'popular'): echo 'selected'; endif; ?>>По популярности</option>
                    </select>
                </div>

                <div class="kp-field kp-field-submit">
                    <button type="submit" class="kp-button kp-button-primary">Применить</button>
                </div>
            </div>
        </form>
    </section>

    <section class="kp-movies-grid">
        <?php $__empty_1 = true; $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a href="<?php echo e(route('movies.show', $movie)); ?>" class="kp-movie-card">
                <div class="kp-movie-poster-wrapper">
                    <?php if($movie->poster_url): ?>
                        <img src="<?php echo e($movie->poster_url); ?>" alt="<?php echo e($movie->title); ?>" class="kp-movie-poster">
                    <?php else: ?>
                        <div class="kp-movie-poster kp-movie-poster-placeholder">
                            <span><?php echo e(mb_substr($movie->title, 0, 1)); ?></span>
                        </div>
                    <?php endif; ?>
                    <div class="kp-movie-badges">
                        <?php if($movie->release_year): ?>
                            <span class="kp-badge"><?php echo e($movie->release_year); ?></span>
                        <?php endif; ?>
                        <?php if($movie->rating): ?>
                            <span class="kp-badge kp-badge-rating"><?php echo e(number_format($movie->rating, 1)); ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="kp-movie-body">
                    <h2 class="kp-movie-title"><?php echo e($movie->title); ?></h2>
                    <?php if($movie->genres->isNotEmpty()): ?>
                        <div class="kp-movie-genres">
                            <?php echo e($movie->genres_list); ?>

                        </div>
                    <?php endif; ?>
                    <p class="kp-movie-description">
                        <?php echo e($movie->short_description); ?>

                    </p>
                    <div class="kp-movie-meta">
                        <span class="kp-meta-item">❤ <?php echo e($movie->likes_count); ?></span>
                        <span class="kp-meta-item">💬 <?php echo e($movie->comments_count); ?></span>
                        <span class="kp-meta-item">★ <?php echo e($movie->favorites_count); ?></span>
                    </div>
                </div>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="kp-empty">
                По вашему запросу ничего не найдено.
            </div>
        <?php endif; ?>
    </section>

    <div class="kp-pagination">
        <?php echo e($movies->links()); ?>

    </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\OSPanel\home\kinotalog.local\resources\views/movies/index.blade.php ENDPATH**/ ?>