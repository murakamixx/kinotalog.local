

<?php $__env->startSection('title', 'Вход — Кинокаталог'); ?>

<?php $__env->startSection('content'); ?>
    <div class="kp-auth-card">
        <h1 class="kp-title">Вход</h1>

        <form method="POST" action="<?php echo e(route('login.post')); ?>" class="kp-form">
            <?php echo csrf_field(); ?>

            <div class="kp-field">
                <label for="email" class="kp-label">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    class="kp-input <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> kp-input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    value="<?php echo e(old('email')); ?>"
                    required
                    autofocus
                >
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="kp-error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="kp-field">
                <label for="password" class="kp-label">Пароль</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    class="kp-input <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> kp-input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    required
                >
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="kp-error"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="kp-field kp-field-inline">
                <label class="kp-checkbox">
                    <input type="checkbox" name="remember">
                    <span>Запомнить меня</span>
                </label>
            </div>

            <div class="kp-field">
                <button type="submit" class="kp-button kp-button-primary kp-button-block">
                    Войти
                </button>
            </div>

            <p class="kp-muted kp-auth-switch">
                Нет аккаунта?
                <a href="<?php echo e(route('register')); ?>">Зарегистрироваться</a>
            </p>
        </form>
    </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\OSPanel\home\kinotalog.local\resources\views/auth/login.blade.php ENDPATH**/ ?>