<?php $__env->startSection('title', 'Login'); ?>

<?php $__env->startSection('content'); ?>
<?php if(session('success')): ?>
<div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg text-green-800 text-sm">
    <?php echo e(session('success')); ?>

</div>
<?php endif; ?>

<?php if($errors->any()): ?>
<div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
    <ul class="text-red-800 text-sm space-y-1">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php endif; ?>

<form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-5">
    <?php echo csrf_field(); ?>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            Email
        </label>
        <input
            type="email"
            name="email"
            value="<?php echo e(old('email')); ?>"
            required
            autofocus
            class="w-full px-4 py-2 border border-gray-300 rounded-lg
                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
        >
        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-500 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
            Password
        </label>
        <input
            type="password"
            name="password"
            required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg
                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
        >
        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-500 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="flex items-center">
        <input
            type="checkbox"
            name="remember"
            id="remember"
            class="h-4 w-4 text-blue-600 border-gray-300 rounded"
        >
        <label for="remember" class="ml-2 block text-sm text-gray-700">
            Ingat Saya
        </label>
    </div>

    <button
        type="submit"
        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold transition"
    >
        Login
    </button>
</form>

<?php if(Route::has('password.request')): ?>
<div class="text-center mt-6">
    <a href="<?php echo e(route('password.request')); ?>" class="text-sm text-blue-600 hover:underline">
        Lupa Password?
    </a>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Mardiana Syafitry\projInOutBarang\resources\views/auth/login.blade.php ENDPATH**/ ?>