<?php $__env->startSection('content'); ?>

<!--begin::Content-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
	<!--begin::Content wrapper-->
	<div class="d-flex flex-column flex-column-fluid">
		<!--begin::Toolbar-->
		<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
			<!--begin::Toolbar container-->
			<div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
				<!--begin::Page title-->
				<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
					<!--begin::Title-->
					<h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
						Dashboard</h1>
					<!--end::Title-->
					<!--begin::Breadcrumb-->
					<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
						<!--begin::Item-->
						<li class="breadcrumb-item text-muted">
							<a href="<?php echo e(route ('admin.dashboard')); ?>" class="text-muted text-hover-primary">Home</a>
						</li>
						<!--end::Item-->
						<!--begin::Item-->
						<li class="breadcrumb-item">
							<span class="bullet bg-gray-500 w-5px h-2px"></span>
						</li>
						<!--end::Item-->
						<!--begin::Item-->
						<li class="breadcrumb-item text-muted">Dashboard</li>
						<!--end::Item-->
					</ul>
					<!--end::Breadcrumb-->
				</div>
				<!--end::Page title-->
			</div>
			<!--end::Toolbar container-->
		</div>
		<!--end::Toolbar-->
		<!--begin::Content-->
		<div id="kt_app_content" class="app-content flex-column-fluid">
			<!--begin::Content container-->
			<div id="kt_app_content_container" class="app-container container-fluid">
				<!--begin::Row-->
				<div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
					<!--begin::Col-->
					<div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
						<!--begin::Card widget 20-->
						<div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-50 mb-5 mb-xl-10"
							style="background-color: #F1416C;background-image:url('assets/media/patterns/vector-1.png')">
							<!--begin::Header-->
							<div class="card-header pt-5">
								<!--begin::Title-->
								<div class="card-title d-flex flex-column">
									<!--begin::Amount-->
									<span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2"><?php echo e($totalPlates); ?></span>
									<!--end::Amount-->
									<!--begin::Subtitle-->
									<span class="text-white opacity-75 pt-1 fw-semibold fs-6">Total Plates</span>
									<!--end::Subtitle-->
								</div>
								<!--end::Title-->
							</div>
							<!--end::Header-->
							<!--begin::Card body-->
							<div class="card-body d-flex align-items-end pt-0">
								<!--begin::Progress-->
								<div class="d-flex align-items-center flex-column mt-3 w-100">
									<div
										class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
										<span><?php echo e($pendingApproval); ?> Pending</span>
										<span><?php echo e($activePlates); ?> Active</span>
									</div>
									<div class="h-8px mx-3 w-100 bg-white bg-opacity-50 rounded">
										<div class="bg-white rounded h-8px" role="progressbar" style="width: '<?php echo e(($activePlates / ($totalPlates ?: 1)) * 100); ?>'%;"
											aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
								<!--end::Progress-->
							</div>
							<!--end::Card body-->
						</div>
						<!--end::Card widget 20-->
						<!--begin::Card widget 7-->
						<div class="card card-flush h-md-50 mb-5 mb-xl-10">
							<!--begin::Header-->
							<div class="card-header pt-5">
								<!--begin::Title-->
								<div class="card-title d-flex flex-column">
									<!--begin::Amount-->
									<span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2"><?php echo e($totalUsers); ?></span>
									<!--end::Amount-->
									<!--begin::Subtitle-->
									<span class="text-gray-500 pt-1 fw-semibold fs-6">Total Users</span>
									<!--end::Subtitle-->
								</div>
								<!--end::Title-->
							</div>
							<!--end::Header-->
							<!--begin::Card body-->
							<div class="card-body d-flex flex-column justify-content-end pe-0">
								<!--begin::Title-->
								<span class="fs-6 fw-bolder text-gray-800 d-block mb-2">New Users</span>
								<!--end::Title-->
								<!--begin::Users group-->
								<div class="d-flex align-items-center">
									<div class="d-flex align-items-center me-4">
										<span class="fs-7 fw-bold text-gray-700">Today:</span>
										<span class="fs-7 fw-bolder text-gray-900 ms-1"><?php echo e($newUsersToday); ?></span>
									</div>
									<div class="d-flex align-items-center">
										<span class="fs-7 fw-bold text-gray-700">This Week:</span>
										<span class="fs-7 fw-bolder text-gray-900 ms-1"><?php echo e($newUsersThisWeek); ?></span>
									</div>
								</div>
								<!--end::Users group-->
							</div>
							<!--end::Card body-->
						</div>
						<!--end::Card widget 7-->
					</div>
					<!--end::Col-->
					<!--begin::Col-->
					<div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
						<!--begin::Card widget 17-->
						<div class="card card-flush h-md-50 mb-5 mb-xl-10">
							<!--begin::Header-->
							<div class="card-header pt-5">
								<!--begin::Title-->
								<div class="card-title d-flex flex-column">
									<!--begin::Info-->
									<div class="d-flex align-items-center">
										<!--begin::Currency-->
										<span class="fs-4 fw-semibold text-gray-500 me-1 align-self-start">AED</span>
										<!--end::Currency-->
										<!--begin::Amount-->
										<span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2"><?php echo e($averagePrice); ?></span>
										<!--end::Amount-->
									</div>
									<!--end::Info-->
									<!--begin::Subtitle-->
									<span class="text-gray-500 pt-1 fw-semibold fs-6">Average Plate Price</span>
									<!--end::Subtitle-->
								</div>
								<!--end::Title-->
							</div>
							<!--end::Header-->
							<!--begin::Card body-->
							<div class="card-body pt-2 pb-4 d-flex flex-wrap align-items-center">
								<!--begin::Labels-->
								<div class="d-flex flex-column content-justify-center flex-row-fluid">
									<!--begin::Label-->
									<div class="d-flex fw-semibold align-items-center">
										<!--begin::Bullet-->
										<div class="bullet w-8px h-3px rounded-2 bg-success me-3"></div>
										<!--end::Bullet-->
										<!--begin::Label-->
										<div class="text-gray-500 flex-grow-1 me-4">Highest Price</div>
										<!--end::Label-->
										<!--begin::Stats-->
										<div class="fw-bolder text-gray-700 text-xxl-end">AED <?php echo e($highestPrice); ?></div>
										<!--end::Stats-->
									</div>
									<!--end::Label-->
									<!--begin::Label-->
									<div class="d-flex fw-semibold align-items-center my-3">
										<!--begin::Bullet-->
										<div class="bullet w-8px h-3px rounded-2 bg-primary me-3"></div>
										<!--end::Bullet-->
										<!--begin::Label-->
										<div class="text-gray-500 flex-grow-1 me-4">Lowest Price</div>
										<!--end::Label-->
										<!--begin::Stats-->
										<div class="fw-bolder text-gray-700 text-xxl-end">AED <?php echo e($lowestPrice); ?></div>
										<!--end::Stats-->
									</div>
									<!--end::Label-->
								</div>
								<!--end::Labels-->
							</div>
							<!--end::Card body-->
						</div>
						<!--end::Card widget 17-->
						<!--begin::List widget 26-->
						<div class="card card-flush h-lg-50">
							<!--begin::Header-->
							<div class="card-header pt-5">
								<!--begin::Title-->
								<h3 class="card-title text-gray-800 fw-bold">Plate Statistics</h3>
								<!--end::Title-->
							</div>
							<!--end::Header-->
							<!--begin::Body-->
							<div class="card-body pt-5">
								<!--begin::Item-->
								<div class="d-flex flex-stack">
									<!--begin::Section-->
									<div class="d-flex align-items-center me-5">
										<!--begin::Symbol-->
										<div class="symbol symbol-40px me-4">
											<span class="symbol-label bg-light-success">
												<i class="ki-duotone ki-check fs-2 text-success"></i>
											</span>
										</div>
										<!--end::Symbol-->
										<!--begin::Content-->
										<div class="me-5">
											<!--begin::Title-->
											<a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Active Plates</a>
											<!--end::Title-->
											<!--begin::Desc-->
											<span class="text-gray-500 fw-semibold fs-7">Approved & Visible</span>
											<!--end::Desc-->
										</div>
										<!--end::Content-->
									</div>
									<!--end::Section-->
									<!--begin::Wrapper-->
									<div class="d-flex align-items-center">
										<!--begin::Number-->
										<span class="text-gray-800 fw-bold fs-6 me-3"><?php echo e($activePlates); ?></span>
										<!--end::Number-->
									</div>
									<!--end::Wrapper-->
								</div>
								<!--end::Item-->
								<!--begin::Separator-->
								<div class="separator separator-dashed my-3"></div>
								<!--end::Separator-->
								<!--begin::Item-->
								<div class="d-flex flex-stack">
									<!--begin::Section-->
									<div class="d-flex align-items-center me-5">
										<!--begin::Symbol-->
										<div class="symbol symbol-40px me-4">
											<span class="symbol-label bg-light-warning">
												<i class="ki-duotone ki-time fs-2 text-warning"></i>
											</span>
										</div>
										<!--end::Symbol-->
										<!--begin::Content-->
										<div class="me-5">
											<!--begin::Title-->
											<a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Pending Approval</a>
											<!--end::Title-->
											<!--begin::Desc-->
											<span class="text-gray-500 fw-semibold fs-7">Awaiting Admin Review</span>
											<!--end::Desc-->
										</div>
										<!--end::Content-->
									</div>
									<!--end::Section-->
									<!--begin::Wrapper-->
									<div class="d-flex align-items-center">
										<!--begin::Number-->
										<span class="text-gray-800 fw-bold fs-6 me-3"><?php echo e($pendingApproval); ?></span>
										<!--end::Number-->
									</div>
									<!--end::Wrapper-->
								</div>
								<!--end::Item-->
								<!--begin::Separator-->
								<div class="separator separator-dashed my-3"></div>
								<!--end::Separator-->
								<!--begin::Item-->
								<div class="d-flex flex-stack">
									<!--begin::Section-->
									<div class="d-flex align-items-center me-5">
										<!--begin::Symbol-->
										<div class="symbol symbol-40px me-4">
											<span class="symbol-label bg-light-danger">
												<i class="ki-duotone ki-tag fs-2 text-danger"></i>
											</span>
										</div>
										<!--end::Symbol-->
										<!--begin::Content-->
										<div class="me-5">
											<!--begin::Title-->
											<a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Sold Plates</a>
											<!--end::Title-->
											<!--begin::Desc-->
											<span class="text-gray-500 fw-semibold fs-7">Completed Transactions</span>
											<!--end::Desc-->
										</div>
										<!--end::Content-->
									</div>
									<!--end::Section-->
									<!--begin::Wrapper-->
									<div class="d-flex align-items-center">
										<!--begin::Number-->
										<span class="text-gray-800 fw-bold fs-6 me-3"><?php echo e($soldPlates); ?></span>
										<!--end::Number-->
									</div>
									<!--end::Wrapper-->
								</div>
								<!--end::Item-->
							</div>
							<!--end::Body-->
						</div>
						<!--end::List widget 26-->
					</div>
					<!--end::Col-->
					<!--begin::Col-->
					<div class="col-xxl-6">
						<!--begin::Engage widget 10-->
						<div class="card card-flush h-md-100">
							<!--begin::Header-->
							<div class="card-header pt-7">
								<!--begin::Title-->
								<h3 class="card-title align-items-start flex-column">
									<span class="card-label fw-bold text-gray-800">View Statistics</span>
									<span class="text-gray-500 mt-1 fw-semibold fs-6">Total Views: <?php echo e($totalViews); ?></span>
								</h3>
								<!--end::Title-->
								<!--begin::Toolbar-->
								<div class="card-toolbar">
									<span class="badge badge-light-success fs-base">
										<i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1"></i>Today: <?php echo e($viewsToday); ?></span>
								</div>
								<!--end::Toolbar-->
							</div>
							<!--end::Header-->
							<!--begin::Body-->
							<div class="card-body pt-7 px-0">
								<!--begin::Table container-->
								<div class="table-responsive px-9">
									<!--begin::Table-->
									<table class="table align-middle gs-0 gy-3">
										<!--begin::Table head-->
										<thead>
											<tr>
												<!-- <th class="p-0 w-50px"></th> -->
												<th class="p-0 min-w-150px"></th>
												<th class="p-0 min-w-100px"></th>
											</tr>
										</thead>
										<!--end::Table head-->
										<!--begin::Table body-->
										<tbody>
											<?php $__currentLoopData = $mostViewedPlates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<!-- <td>
													<div class="symbol symbol-50px">
														<img src="<?php echo e($plate->image_url); ?>" alt="" class="w-100" />
													</div>
												</td> -->
												<td>
													<a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6"><?php echo e($plate->emirate->name); ?> <?php echo e($plate->code->name); ?> <?php echo e($plate->number); ?></a>
													<span class="text-gray-500 fw-semibold d-block fs-7"><?php echo e($plate->user->name); ?></span>
												</td>
												<td class="text-end">
													<span class="text-gray-800 fw-bold d-block fs-6"><?php echo e($plate->views_count); ?></span>
													<span class="text-gray-500 fw-semibold d-block fs-7">Views</span>
												</td>
											</tr>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</tbody>
										<!--end::Table body-->
									</table>
								</div>
								<!--end::Table-->
							</div>
							<!--end::Body-->
						</div>
						<!--end::Engage widget 10-->
					</div>
					<!--end::Col-->
				</div>
				<!--end::Row-->
				
				<!--begin::Row-->
				<div class="row g-5 g-xl-10 mb-5 mb-xl-10">
					<!--begin::Col-->
					<div class="col-xl-6">
						<!--begin::List widget 25-->
						<div class="card card-flush h-lg-100">
							<!--begin::Header-->
							<div class="card-header pt-7">
								<!--begin::Title-->
								<h3 class="card-title align-items-start flex-column">
									<span class="card-label fw-bold text-gray-800">Recently Added Plates</span>
									<span class="text-gray-500 mt-1 fw-semibold fs-6">Latest Listings</span>
								</h3>
								<!--end::Title-->
							</div>
							<!--end::Header-->
							<!--begin::Body-->
							<div class="card-body pt-7">
								<?php $__currentLoopData = $recentPlates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<!--begin::Item-->
								<div class="d-flex flex-stack">
									<!--begin::Section-->
									<div class="d-flex align-items-center me-5">
										<!--begin::Symbol-->
										<!-- <div class="symbol symbol-40px me-4">
											<img src="<?php echo e($plate->image_url); ?>" class="" alt="" />
										</div> -->
										<!--end::Symbol-->
										<!--begin::Title-->
										<div class="me-5">
											<a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6"><?php echo e($plate->emirate->name); ?> <?php echo e($plate->code->name); ?> <?php echo e($plate->number); ?></a>
											<span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0"><?php echo e($plate->user->name); ?></span>
										</div>
										<!--end::Title-->
									</div>
									<!--end::Section-->
									<!--begin::Label-->
									<span class="badge badge-light-<?php echo e($plate->is_approved ? 'success' : 'warning'); ?> fs-7 fw-bold"><?php echo e($plate->is_approved ? 'Approved' : 'Pending'); ?></span>
									<!--end::Label-->
								</div>
								<!--end::Item-->
								<?php if(!$loop->last): ?>
								<div class="separator separator-dashed my-4"></div>
								<?php endif; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
							<!--end::Body-->
						</div>
						<!--end::List widget 25-->
					</div>
					<!--end::Col-->
					<!--begin::Col-->
					<div class="col-xl-6">
						<!--begin::List widget 25-->
						<div class="card card-flush h-lg-100">
							<!--begin::Header-->
							<div class="card-header pt-7">
								<!--begin::Title-->
								<h3 class="card-title align-items-start flex-column">
									<span class="card-label fw-bold text-gray-800">Most Active Users</span>
									<span class="text-gray-500 mt-1 fw-semibold fs-6">Users with Most Plates</span>
								</h3>
								<!--end::Title-->
							</div>
							<!--end::Header-->
							<!--begin::Body-->
							<div class="card-body pt-7">
								<?php $__currentLoopData = $mostActiveUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<!--begin::Item-->
								<div class="d-flex flex-stack">
									<!--begin::Section-->
									<div class="d-flex align-items-center me-5">
										<!--begin::Symbol-->
										<div class="symbol symbol-40px me-4">
											<span class="symbol-label bg-light-primary">
												<i class="ki-duotone ki-profile-user fs-2 text-primary"></i>
											</span>
										</div>
										<!--end::Symbol-->
										<!--begin::Title-->
										<div class="me-5">
											<a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6"><?php echo e($user->name); ?></a>
											<span class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0"><?php echo e($user->email); ?></span>
										</div>
										<!--end::Title-->
									</div>
									<!--end::Section-->
									<!--begin::Label-->
									<span class="badge badge-light-primary fs-7 fw-bold"><?php echo e($user->plates_count); ?> Plates</span>
									<!--end::Label-->
								</div>
								<!--end::Item-->
								<?php if(!$loop->last): ?>
								<div class="separator separator-dashed my-4"></div>
								<?php endif; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
							<!--end::Body-->
						</div>
						<!--end::List widget 25-->
					</div>
					<!--end::Col-->
				</div>
				<!--end::Row-->
			</div>
			<!--end::Content container-->
		</div>
		<!--end::Content-->
	</div>
	<!--end::Content wrapper-->
</div>
<!--end::Content-->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SOLO REAL ESTATE6\Desktop\Plate\resources\views/admin/pages/index.blade.php ENDPATH**/ ?>