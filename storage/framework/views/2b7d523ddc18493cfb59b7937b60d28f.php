<script>
    <?php if(Session::has('success')): ?>
        toastr.success("<?php echo e(session('success')); ?>");
    <?php elseif(Session::has('error')): ?>
        toastr.error("<?php echo e(session('error')); ?>");
    <?php endif; ?>
</script><?php /**PATH /home/u465294331/domains/plate35.com/public_html/resources/views/admin/includes/_messages.blade.php ENDPATH**/ ?>