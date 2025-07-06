

<?php $__env->startSection('content'); ?>







<!-- Page Content -->
<div class="content">
	<div class="container">

		<!-- Content Header -->
		<!-- <div class="content-header content-settings-header">
			<h4>Profile</h4>
		</div> -->
		<!-- /Content Header -->

		<div class="row">

			<!-- Settings Menu -->
			<!-- <?php echo $__env->make('partials._settings_menu', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> -->

			<!-- /Settings Menu -->

			<!-- Settings Details -->
			<div class="col-lg-9 mx-auto">
				<?php if(request()->routeIs('user.profile')): ?>
					<?php echo $__env->make('partials.settings._profile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
				<?php elseif(request()->routeIs('user.security')): ?>
					<?php echo $__env->make('partials.settings._security', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
				<?php endif; ?>
			</div>
			<!-- /Settings Details -->

		</div>

	</div>
</div>
<!-- /Page Content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SOLO REAL ESTATE6\Desktop\Plate\resources\views/user/profile.blade.php ENDPATH**/ ?>