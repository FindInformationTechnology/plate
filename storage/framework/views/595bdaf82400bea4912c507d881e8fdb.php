<?php $__env->startSection('content'); ?>
<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Emirates</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Emirates</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_emirate">Add New</a>
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search Emirates" />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">ID</th>
                                    <th class="min-w-125px">Name</th>
                                    <th class="min-w-125px">Created Date</th>
                                    <th class="text-end min-w-100px">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                <?php $__currentLoopData = $emirates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emirate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($emirate->id); ?></td>
                                    <td><?php echo e($emirate->name); ?></td>
                                    <td><?php echo e($emirate->created_at->format('d M Y, h:i a')); ?></td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-light btn-active-light-primary btn-sm btn-data" data-id="<?php echo e($emirate->id); ?>" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                            <span class="svg-icon svg-icon-5 m-0">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                                </svg>
                                            </span>
                                        </a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3 btn-edit" data-id="<?php echo e($emirate->id); ?>">Edit</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-users-table-filter="delete_row" data-id="<?php echo e($emirate->id); ?>">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    <div class="pb-4 mb-5"></div>
</div>
<!--end:::Main-->

<?php echo $__env->make('admin.pages.emirates.partials.emirate_crud', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Select2 elements if needed
        if ($.fn.select2) {
            $('.form-select').select2({
                dropdownParent: $(this).closest('.modal')
            });
        }

        // Reset form when opening the add modal
        $('[data-bs-target="#kt_modal_add_emirate"]').click(function() {
            $('#myForm')[0].reset();
        });

        // Handle edit button click
        // Add this to your existing JavaScript in index.blade.php
        $('.btn-edit').click(function() {
            var id = $(this).data('id');

            // AJAX request to get emirate data
            $.get('<?php echo e(route("admin.emirates.edit", ":id")); ?>'.replace(':id', id), function(data) {
                // console.log(data.emirate.name.en);
                // Set form action URL with the correct ID
                $('#editForm').attr('action', '<?php echo e(route("admin.emirates.update", "")); ?>/' + id);

                // Populate form fields
                $('#edit_emirate_id').val(data.emirate.id);


                // Set translated fields
                if (data.emirate.name) {
                    $('#edit_emirate_name_en').val(data.emirate.name.en || '');
                    $('#edit_emirate_name_ar').val(data.emirate.name.ar || '');
                }

                // Set icon preview if exists
                if (data.emirate.icon) {
                    var iconUrl = '<?php echo e(asset("storage")); ?>/' + data.emirate.icon;
                    $('#edit_emirate_icon_wrapper').css('background-image', 'url(' + iconUrl + ')');
                    $('#edit_emirate_icon_preview').css('background-image', 'url(' + iconUrl + ')');
                } else {
                    $('#edit_emirate_icon_wrapper').css('background-image', 'url(<?php echo e(asset("assets/media/svg/avatars/blank.svg")); ?>)');
                    $('#edit_emirate_icon_preview').css('background-image', 'none');
                }

                // Show the modal
                $('#kt_modal_edit_emirate').modal('show');
            }).fail(function(xhr, status, error) {
                console.error("Error fetching emirate data:", error);
                toastr.error("Failed to load emirate data");
            });
        });

        // Delete functionality
        $('[data-kt-users-table-filter="delete_row"]').click(function(e) {
            e.preventDefault();

            var emirateId = $(this).data('id');
            var row = $(this).closest('tr');

            Swal.fire({
                text: "Are you sure you want to delete this emirate?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: '<?php echo e(route("admin.emirates.destroy", "")); ?>/' + emirateId,
                        type: 'DELETE',
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>'
                        },
                        success: function(response) {
                            row.remove();
                            Swal.fire({
                                text: "Emirate deleted successfully!",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            });
                        },
                        error: function(xhr) {
                            let errorMessage = "Error deleting emirate!";
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            }

                            Swal.fire({
                                text: errorMessage,
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            });
                        }
                    });
                }
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\SOLO REAL ESTATE6\Desktop\Plate\resources\views/admin/pages/emirates/index.blade.php ENDPATH**/ ?>