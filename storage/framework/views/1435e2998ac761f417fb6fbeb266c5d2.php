<?php $__env->startSection('title', 'Items'); ?>

<?php $__env->startSection('content'); ?>
<?php
    /**
     * Sort ASC DESC
     */
    function sortUrl($column) {
        $isActive = request('sort_by') === $column;
        $dir = ($isActive && request('sort_dir') === 'asc') ? 'desc' : 'asc';

        return route('admin.items.index', array_merge(request()->all(), [
            'sort_by'  => $column,
            'sort_dir' => $dir,
        ]));
    }

    function sortIcon($column) {
        if (request('sort_by') !== $column) return '⇅';
        return request('sort_dir') === 'asc' ? '▲' : '▼';
    }
?>

<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Items</h1>
            <p class="text-gray-600 mt-1">Manage inventory items</p>
        </div>

        <div class="flex gap-3">
            <a href="<?php echo e(route('admin.items.import.show')); ?>"
               class="inline-flex items-center gap-2 px-4 py-2 bg-amber-600 text-white font-semibold rounded-lg hover:bg-amber-700">
                Import Excel
            </a>

            <a href="<?php echo e(route('admin.items.create')); ?>"
               class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white font-semibold rounded-lg hover:bg-emerald-700">
                + Add Item
            </a>
        </div>
    </div>

    <!--FLASH MESSAGE-->
    <?php if(session('success')): ?>
        <div class="p-4 bg-green-50 border border-green-200 rounded-lg text-green-800">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <!-- Search and Filters -->
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <form method="GET" id="filterForm" class="flex flex-col sm:flex-row gap-3">

            <!-- Search -->
            <div class="flex flex-1 gap-2">
                <input type="text"
                       name="search"
                       value="<?php echo e($search); ?>"
                       placeholder="Search items..."
                       class="flex-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">

                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/>
                    </svg>
                </button>
            </div>

            <!--Reset-->
            <a href="<?php echo e(route('admin.items.index')); ?>"
               class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-500 text-center">
                Reset
            </a>

            <!--PerPage-->
            <div class="w-40">
                <select name="per_page"
                        onchange="document.getElementById('filterForm').submit();"
                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                    <?php $__currentLoopData = [5,10,25,50]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($size); ?>" <?php echo e($perPage == $size ? 'selected' : ''); ?>>
                            Show <?php echo e($size); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

        </form>
    </div>

    <!-- Table -->
    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
        <div class="overflow-x-auto">

            <table class="w-full text-sm">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="px-4 py-3 text-center">No</th>

                        <th class="px-6 py-4 text-left">
                            <a href="<?php echo e(sortUrl('item_code')); ?>"
                               class="inline-flex items-center gap-1 hover:text-blue-600">
                                Code <span class="text-xs"><?php echo e(sortIcon('item_code')); ?></span>
                            </a>
                        </th>

                        <th class="px-6 py-4 text-left">
                            <a href="<?php echo e(sortUrl('item_name')); ?>"
                               class="inline-flex items-center gap-1 hover:text-blue-600">
                                Name <span class="text-xs"><?php echo e(sortIcon('item_name')); ?></span>
                            </a>
                        </th>

                        <th class="px-4 py-3 text-left">
                            <a href="<?php echo e(sortUrl('category_name')); ?>"
                               class="inline-flex items-center gap-1 hover:text-blue-600">
                                Category <span class="text-xs"><?php echo e(sortIcon('category_name')); ?></span>
                            </a>
                        </th>

                        <th class="px-4 py-3 text-center">Condition</th>
                        <th class="px-4 py-3 text-left">Description</th>

                        <th class="px-6 py-4 text-center">
                            <a href="<?php echo e(sortUrl('min_stock')); ?>"
                               class="inline-flex items-center gap-1 hover:text-blue-600">
                                Min Stock <span class="text-xs"><?php echo e(sortIcon('min_stock')); ?></span>
                            </a>
                        </th>

                        <th class="px-6 py-4 text-center">
                            <a href="<?php echo e(sortUrl('stock')); ?>"
                               class="inline-flex items-center gap-1 hover:text-blue-600">
                                Stock <span class="text-xs"><?php echo e(sortIcon('stock')); ?></span>
                            </a>
                        </th>

                        <th class="px-4 py-3 text-left">
                            <a href="<?php echo e(sortUrl('unit_name')); ?>"
                               class="inline-flex items-center gap-1 hover:text-blue-600">
                                Unit <span class="text-xs"><?php echo e(sortIcon('unit_name')); ?></span>
                            </a>
                        </th>

                        <th class="px-4 py-3 text-center">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-center">
                            <?php echo e($items->firstItem() + $loop->index); ?>

                        </td>

                        <td class="px-4 py-3 font-mono text-blue-600 font-semibold">
                            <?php echo e($item->item_code); ?>

                        </td>

                        <td class="px-4 py-3 font-medium">
                            <?php echo e($item->item_name); ?>

                        </td>

                        <td class="px-4 py-3 text-gray-600">
                            <?php echo e($item->category->category_name ?? '-'); ?>

                        </td>

                        <td class="px-4 py-3 text-center">
                            <span class="px-2 py-1 rounded text-xs font-semibold <?php echo e($item->conditionBadge()); ?>">
                                <?php echo e(ucfirst($item->condition)); ?>

                            </span>
                        </td>

                        <td class="px-4 py-3 text-gray-600 max-w-xs truncate">
                            <?php echo e($item->description ?? '-'); ?>

                        </td>

                        <td class="px-4 py-3 text-center font-medium">
                            <?php echo e($item->min_stock); ?>

                        </td>

                        <td class="px-4 py-3 text-center">
                            <span class="font-medium <?php echo e($item->stock <= $item->min_stock ? 'text-red-600' : 'text-gray-900'); ?>">
                                <?php echo e($item->stock); ?>

                            </span>
                        </td>

                        <td class="px-4 py-3 text-gray-600">
                            <?php echo e($item->unit->unit_name ?? '-'); ?>

                        </td>

                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center gap-2">
                                <a href="<?php echo e(route('admin.items.edit', $item)); ?>"
                                   class="p-1 text-blue-600 hover:text-blue-800" title="Edit">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                    </svg>
                                </a>

                                <form method="POST" action="<?php echo e(route('admin.items.destroy', $item)); ?>"
                                      onsubmit="return confirm('Delete this item?')"
                                      style="display:inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="p-1 text-red-600 hover:text-red-800" title="Delete">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="9" class="text-center py-10 text-gray-400">
                            No items found
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

        
        <div class="px-6 py-4 border-t bg-gray-50 flex flex-col sm:flex-row sm:justify-between gap-4">
            <p class="text-sm text-gray-600">
                Showing
                <strong><?php echo e($items->firstItem() ?? 0); ?></strong>
                to
                <strong><?php echo e($items->lastItem() ?? 0); ?></strong>
                of
                <strong><?php echo e($items->total()); ?></strong>
                items
            </p>

            <?php echo e($items->links('pagination::tailwind')); ?>

        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\bismillah\SISTEM-IN-OUT-BARANG\resources\views/admin/items/index.blade.php ENDPATH**/ ?>