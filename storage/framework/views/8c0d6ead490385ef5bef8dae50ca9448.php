<script>
    <?php if(Session::has('success')): ?>
        toastr.success("<?php echo e(session('success')); ?>");
    <?php elseif(Session::has('error')): ?>
        toastr.error("<?php echo e(session('error')); ?>");
    <?php endif; ?>
</script><?php /**PATH C:\Users\dell\Desktop\plate\resources\views/admin/includes/_messages.blade.php ENDPATH**/ ?>