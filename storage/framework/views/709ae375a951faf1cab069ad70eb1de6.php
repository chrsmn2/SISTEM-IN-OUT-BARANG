<?php $__env->startSection('title', 'Add Item'); ?>

<?php $__env->startSection('content'); ?>
<!-- SELECT2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-5-theme/1.3.0/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

<div class="max-w-2xl mx-auto bg-white rounded-xl shadow border border-gray-200">

    <!-- HEADER -->
    <div class="px-6 py-4 bg-gradient-to-r from-gray-700 to-gray-800 rounded-t-xl">
        <h2 class="text-lg font-semibold text-white">Add New Item</h2>
    </div>

    <!-- FORM -->
    <form action="<?php echo e(route('admin.items.store')); ?>" method="POST" class="p-6">
        <?php echo csrf_field(); ?>

        <!-- Item Code -->
        <!--<div class="mb-4">
            <label for="item_code" class="block text-sm font-bold text-gray-700 mb-2">Item Code <span class="text-red-500">*</span></label>
            <input type="text" id="item_code" name="item_code" value="Auto-generated"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-600 outline-none"
                   disabled>
        </div>-->

        <!-- Item Name -->
        <div>
            <label class="block text-sm font-bold text-gray-800">
                Item Name <span class="text-red-500">*</span></label>
            </label>
            <input type="text"
                   id="item_name"
                   name="item_name"
                   class="w-full mt-1 rounded-lg border <?php $__errorArgs = ['item_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php else: ?> border-gray-300 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                          text-gray-900
                          focus:ring-emerald-500 focus:border-emerald-500"
                   value="<?php echo e(old('item_name')); ?>"
                   required>
            <?php $__errorArgs = ['item_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <?php echo $__env->make('admin.partials.check-name', ['type'=>'item', 'inputId'=>'item_name'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

        <!-- Category (Select2) -->
        <div class="mb-4">
            <label for="category_id" class="block text-sm font-bold text-gray-700 mb-2">Category <span class="text-red-500">*</span></label>
            <select id="category_id" name="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%;" required>
                <option value="">-- Select Category --</option>
            </select>
            <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Condition -->
        <div class="mb-4">
            <label for="condition" class="block text-sm font-bold text-gray-700 mb-2">Condition <span class="text-red-500">*</span></label>
            <select id="condition" name="condition"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none <?php $__errorArgs = ['condition'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                <option value="">-- Select Condition --</option>
                <option value="good" <?php echo e(old('condition') == 'good' ? 'selected' : ''); ?>>Good</option>
                <option value="damaged" <?php echo e(old('condition') == 'damaged' ? 'selected' : ''); ?>>Damaged</option>
            </select>
            <?php $__errorArgs = ['condition'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Minimum Stock -->
        <div class="mb-4">
            <label for="min_stock" class="block text-sm font-bold text-gray-700 mb-2">Minimum Stock <span class="text-red-500">*</span></label>
            <input type="number" id="min_stock" name="min_stock" value="<?php echo e(old('min_stock', 0)); ?>" min="0"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none <?php $__errorArgs = ['min_stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                   placeholder="Enter minimum stock level" required>
            <?php $__errorArgs = ['min_stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Stock (DISABLED) -->
        <div class="mb-4">
            <label for="stock" class="block text-sm font-bold text-gray-700 mb-2">Stock <span class="text-red-500">*</span></label>
            <input type="number" id="stock" name="stock" value="0"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 text-gray-600 outline-none"
                   placeholder="Auto (from incoming/outgoing)" disabled>
            <p class="text-xs text-gray-500 mt-1"> Stock is managed automatically through incoming and outgoing transactions</p>
        </div>

        <!-- Unit (Select2) -->
        <div class="mb-4">
            <label for="unit_id" class="block text-sm font-bold text-gray-700 mb-2">Unit <span class="text-red-500">*</span></label>
            <select id="unit_id" name="unit_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none <?php $__errorArgs = ['unit_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%;" required>
                <option value="">-- Select Unit --</option>
            </select>
            <?php $__errorArgs = ['unit_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Description -->
        <div class="mb-6">
            <label for="description" class="block text-sm font-bold text-gray-700 mb-2">Description</label>
            <textarea id="description" name="description" rows="4"
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                      placeholder="Enter item description"><?php echo e(old('description')); ?></textarea>
            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Buttons -->
        <div class="flex gap-4 border-t pt-6">
            <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition">
                Save
            </button>
            <a href="<?php echo e(route('admin.items.index')); ?>" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-400 transition">
                Cancel
            </a>
        </div>
    </form>

</div>

<!-- SELECT2 JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
const categoryApiUrl = '<?php echo e(route("admin.api.categories.search")); ?>';
const unitApiUrl = '<?php echo e(route("admin.api.units.search")); ?>';

document.addEventListener('DOMContentLoaded', function() {
    // Initialize SELECT2 for Category
    $('#category_id').select2({
        theme: 'bootstrap-5',
        ajax: {
            url: categoryApiUrl,
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term || ''
                };
            },
            processResults: function(data) {
                return {
                    results: data.results || []
                };
            },
            cache: true
        },
        minimumInputLength: 0,
        allowClear: true,
        placeholder: '-- Select Category --'
    });

    // Initialize SELECT2 for Unit
    $('#unit_id').select2({
        theme: 'bootstrap-5',
        ajax: {
            url: unitApiUrl,
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term || ''
                };
            },
            processResults: function(data) {
                return {
                    results: data.results || []
                };
            },
            cache: true
        },
        minimumInputLength: 0,
        allowClear: true,
        placeholder: '-- Select Unit --'
    });

    // Pre-fill old values if form submission failed
    <?php if(old('category_id')): ?>
        const categoryVal = <?php echo e(old('category_id')); ?>;
        if (categoryVal) {
            $.ajax({
                url: categoryApiUrl,
                data: { q: '' },
                dataType: 'json',
                success: function(data) {
                    const option = data.results.find(r => r.id == categoryVal);
                    if (option) {
                        $('#category_id').append(new Option(option.text, option.id, true, true)).trigger('change');
                    }
                }
            });
        }
    <?php endif; ?>

    <?php if(old('unit_id')): ?>
        const unitVal = <?php echo e(old('unit_id')); ?>;
        if (unitVal) {
            $.ajax({
                url: unitApiUrl,
                data: { q: '' },
                dataType: 'json',
                success: function(data) {
                    const option = data.results.find(r => r.id == unitVal);
                    if (option) {
                        $('#unit_id').append(new Option(option.text, option.id, true, true)).trigger('change');
                    }
                }
            });
        }
    <?php endif; ?>
});
</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\bismillah\SISTEM-IN-OUT-BARANG\resources\views/admin/items/create.blade.php ENDPATH**/ ?>