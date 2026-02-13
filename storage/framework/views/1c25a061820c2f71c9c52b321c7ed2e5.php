<div
    class="real-time-check"
    data-type="<?php echo e($type); ?>"
    data-input-id="<?php echo e($inputId); ?>"
    data-original="<?php echo e($original ?? ''); ?>"
    data-id="<?php echo e($id ?? ''); ?>"
></div>

<script>
(function () {
    const wrapper = document.querySelector('.real-time-check[data-input-id="<?php echo e($inputId); ?>"]') || document.querySelector('.real-time-check');
    if (!wrapper) return;

    const type = wrapper.dataset.type;
    const inputId = wrapper.dataset.inputId;
    const original = wrapper.dataset.original ?? '';
    const recordId = wrapper.dataset.id || null;

    const input = document.getElementById(inputId);
    if (!input) return;

    // create message nodes if missing
    let err = document.getElementById(inputId + '_error');
    let ok  = document.getElementById(inputId + '_ok');
    if (!err) {
        err = document.createElement('p');
        err.id = inputId + '_error';
        err.className = 'text-red-500 text-sm mt-1 hidden';
        input.parentElement.appendChild(err);
    }
    if (!ok) {
        ok = document.createElement('p');
        ok.id = inputId + '_ok';
        ok.className = 'text-green-500 text-sm mt-1 hidden';
        input.parentElement.appendChild(ok);
    }

    const submitBtn = document.querySelector('button[type="submit"]');
    let isValid = (original ? true : false);

    async function checkName(name) {
        try {
            // Dynamic route mapping
            const routes = {
                'item': '<?php echo e(route("admin.items.check-name")); ?>',
                'category': '<?php echo e(route("admin.categories.check-name")); ?>',
                'unit': '<?php echo e(route("admin.units.check-name")); ?>',
                'supplier': '<?php echo e(route("admin.suppliers.check-name")); ?>',
                'departement': '<?php echo e(route("admin.departement.check-name")); ?>',
            };

            const url = routes[type];
            if (!url) {
                console.error('Unknown type:', type);
                return null;
            }

            const res = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({ type, name, id: recordId || null })
            });

            if (!res.ok) return null;
            return await res.json();
        } catch (e) {
            console.error('checkName error', e);
            return null;
        }
    }

    input.addEventListener('input', async function () {
        const val = this.value.trim();
        if (!val) {
            err.classList.add('hidden');
            ok.classList.add('hidden');
            isValid = false;
            if (submitBtn) submitBtn.disabled = false;
            return;
        }

        if (original && val === original) {
            err.classList.add('hidden');
            ok.classList.remove('hidden');
            ok.textContent = (type.charAt(0).toUpperCase() + type.slice(1)) + ' name available';
            isValid = true;
            if (submitBtn) submitBtn.disabled = false;
            return;
        }

        const data = await checkName(val);
        if (!data) return;

        if (data.exists) {
            err.textContent = data.message;
            err.classList.remove('hidden');
            ok.classList.add('hidden');
            isValid = false;
            if (submitBtn) submitBtn.disabled = true;
        } else {
            ok.textContent = data.message;
            ok.classList.remove('hidden');
            err.classList.add('hidden');
            isValid = true;
            if (submitBtn) submitBtn.disabled = false;
        }
    });

    // block submit when invalid
    const form = input.closest('form');
    if (form) {
        form.addEventListener('submit', function (e) {
            const val = input.value.trim();
            if (val && !isValid) {
                e.preventDefault();
                err.textContent = (type.charAt(0).toUpperCase() + type.slice(1)) + ' name already exists. Please choose a different name';
                err.classList.remove('hidden');
            }
        });
    }
})();
</script>
<?php /**PATH C:\Users\bismillah\SISTEM-IN-OUT-BARANG\resources\views/admin/partials/check-name.blade.php ENDPATH**/ ?>