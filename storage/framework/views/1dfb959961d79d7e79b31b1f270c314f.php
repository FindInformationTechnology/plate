<script>
    <?php if(Session::has('success')): ?>
        toastr.success("<?php echo e(session('success')); ?>");
    <?php elseif(Session::has('error')): ?>
        toastr.error("<?php echo e(session('error')); ?>");
    <?php endif; ?>
</script><?php /**PATH C:\Users\SOLO REAL ESTATE6\Desktop\Plate\resources\views/admin/includes/_messages.blade.php ENDPATH**/ ?>