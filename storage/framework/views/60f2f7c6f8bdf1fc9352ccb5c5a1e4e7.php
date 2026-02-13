<?php $__env->startSection('title', 'Add Category'); ?>

<?php $__env->startSection('content'); ?>

<div class="max-w-xl mx-auto bg-white rounded-xl shadow-xl border">

    <!-- Header -->
    <div class="px-6 py-4 bg-gradient-to-r from-gray-700 to-gray-800 rounded-t-xl">
        <h2 class="text-xl font-bold text-white">Add New Category</h2>
        <p class="text-sm text-gray-300">Create new item category</p>
    </div>

    <!-- Form -->
    <form action="<?php echo e(route('admin.categories.store')); ?>"
          method="POST"
          class="p-6 space-y-3">
        <?php echo csrf_field(); ?>

        <div>
            <label class="block text-sm font-bold text-gray-800">
                Category Name
            </label>
            <input type="text" 
                   id="category_name"
                   name="category_name"
                   class="w-full mt-1 rounded-lg border <?php $__errorArgs = ['category_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php else: ?> border-gray-300 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                          text-gray-900
                          focus:ring-emerald-500 focus:border-emerald-500"
                   value="<?php echo e(old('category_name')); ?>"
                   required>
            <?php $__errorArgs = ['category_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <?php echo $__env->make('admin.partials.check-name', ['type'=>'category', 'inputId'=>'category_name'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

        <div>
            <label class="block text-sm font-bold text-gray-800">
                Description
            </label>
            <textarea name="category_description"
                      rows="4"
                      class="w-full mt-1 rounded-lg border border-gray-300
                             text-gray-900
                             focus:ring-emerald-500 focus:border-emerald-500"
                      placeholder="Optional"></textarea>
        </div>

        <div class="flex justify-between pt-4">
            <a href="<?php echo e(route('admin.categories.index')); ?>"
               class="px-4 py-2 rounded-lg
                      bg-gray-200 text-gray-800
                      font-semibold hover:bg-gray-300 transition">
                 Back
            </a>

            <button type="submit"
                class="px-6 py-2 rounded-lg
                       bg-emerald-600 text-white
                       font-bold shadow
                       hover:bg-emerald-700 transition">
                Save Category
            </button>
        </div>
    </form>

</div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Mardiana Syafitry\projInOutBarang\resources\views/admin/categories/create.blade.php ENDPATH**/ ?>