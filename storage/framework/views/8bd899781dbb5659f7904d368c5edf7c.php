

<?php $__env->startSection('title', 'Регистрация — Кинокаталог'); ?>

<?php $__env->startSection('content'); ?>
    <div class="kp-auth-card">
        <h1 class="kp-title">Регистрация</h1>

        <form method="POST" action="<?php echo e(route('register.post')); ?>" class="kp-form">
            <?php echo csrf_field(); ?>

            <div class="kp-field">
                <label for="username" class="kp-label">Логин</label>
                <input
                    id="username"
                    type="text"
                    name="username"
                    class="kp-input <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> kp-input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    value="<?php echo e(old('username')); ?>"
                    required
                    autofocus
                >
                <?php $__errorArgs = ['username'];
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

            <div class="kp-field">
                <label for="password_confirmation" class="kp-label">Повторите пароль</label>
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    class="kp-input"
                    required
                >
            </div>

            <div class="kp-field">
                <button type="submit" class="kp-button kp-button-primary kp-button-block">
                    Создать аккаунт
                </button>
            </div>

            <p class="kp-muted kp-auth-switch">
                Уже есть аккаунт?
                <a href="<?php echo e(route('login')); ?>">Войти</a>
            </p>
        </form>
    </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\OSPanel\home\kinotalog.local\resources\views/auth/register.blade.php ENDPATH**/ ?>