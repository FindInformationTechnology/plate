@extends('admin.layouts.master')

@section('content')
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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Plates</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Plates</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('admin.plates.create') }}" class="btn btn-sm fw-bold btn-primary">Add New Plate</a>
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
                                <input type="text" data-kt-plate-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search Plates" />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-plate-table-toolbar="base">
                                <!--begin::Filter-->
                                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="ki-duotone ki-filter fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>Filter
                                </button>
                                <!--begin::Menu 1-->
                                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bold">Filter Options</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Separator-->
                                    <!--begin::Content-->
                                    <div class="px-7 py-5" data-kt-plate-table-filter="form">
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <label class="form-label fs-6 fw-semibold">Status:</label>
                                            <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-plate-table-filter="status" data-hide-search="true">
                                                <option></option>
                                                <option value="all">All</option>
                                                <option value="approved">Approved</option>
                                                <option value="pending">Pending</option>
                                                <option value="sold">Sold</option>
                                                <option value="available">Available</option>
                                            </select>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="reset" class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6" data-kt-menu-dismiss="true" data-kt-plate-table-filter="reset">Reset</button>
                                            <button type="submit" class="btn btn-primary fw-semibold px-6" data-kt-menu-dismiss="true" data-kt-plate-table-filter="filter">Apply</button>
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Menu 1-->
                                <!--end::Filter-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_plates">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">ID</th>
                                    <th class="min-w-125px">User</th>
                                    <th class="min-w-125px">Emirate</th>
                                    <th class="min-w-125px">Code</th>
                                    <th class="min-w-125px">Number</th>
                                    <!-- <th class="min-w-125px">Length</th> -->
                                    <th class="min-w-125px">Price</th>
                                    <th class="min-w-125px">Status</th>
                                    <th class="min-w-125px">Created Date</th>
                                    <th class="text-end min-w-100px">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @foreach ($plates as $plate)
                                <tr>
                                    <td>{{ $plate->id }}</td>
                                    <td>{{ $plate->user ? $plate->user->name : 'N/A' }}</td>
                                    <td>{{ $plate->emirate ? $plate->emirate->name : 'N/A' }}</td>
                                    <td>{{ $plate->code ? $plate->code->name : 'N/A' }}</td>
                                    <td>{{ $plate->number }}</td>
                                    <!-- <td>{{ $plate->length }}</td> -->
                                    <td>{{ number_format($plate->price, 2) }}</td>
                                    <td>
                                        <div class="badge badge-light-{{ $plate->is_approved ? 'success' : 'warning' }} me-2">
                                            {{ $plate->is_approved ? 'Approved' : 'Pending' }}
                                        </div>
                                        <div class="badge badge-light-{{ $plate->is_sold ? 'danger' : 'success' }}">
                                            {{ $plate->is_sold ? 'Sold' : 'Available' }}
                                        </div>
                                    </td>
                                    <td>{{ $plate->created_at->format('d M Y, h:i a') }}</td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                            <span class="svg-icon svg-icon-5 m-0">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                                </svg>
                                            </span>
                                        </a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="{{ route('admin.plates.show', $plate->id) }}" class="menu-link px-3">View</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="{{ route('admin.plates.edit', $plate->id) }}" class="menu-link px-3">Edit</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3 toggle-status" data-id="{{ $plate->id }}" data-status="{{ $plate->is_approved ? 0 : 1 }}">
                                                    {{ $plate->is_approved ? 'Unapprove' : 'Approve' }}
                                                </a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3 toggle-sold" data-id="{{ $plate->id }}" data-status="{{ $plate->is_sold ? 0 : 1 }}">
                                                    {{ $plate->is_sold ? 'Mark as Available' : 'Mark as Sold' }}
                                                </a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3 delete-plate" data-id="{{ $plate->id }}">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
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
@endsection

@push('styles')
<!-- Add DataTables CSS -->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<!-- Make sure jQuery is loaded first -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Then load DataTables -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        if ($.fn.DataTable) {
            // Initialize datatable
            var table = $("#kt_table_plates").DataTable({
                "info": false,
                'order': [],
                'pageLength': 10,
            });

            // Search functionality

            $('[data-kt-plate-table-filter="search"]').on('keyup', function() {
                table.search($(this).val()).draw();
            });

            // Filter functionality
            $('[data-kt-plate-table-filter="filter"]').on('click', function() {
                const filterStatus = $('[data-kt-plate-table-filter="status"]').val();

                if (filterStatus === 'all') {
                    table.search('').columns(7).search('').draw();
                } else {
                    table.columns(7).search(filterStatus).draw();
                }
            });

            // Reset filter
            $('[data-kt-plate-table-filter="reset"]').on('click', function() {
                $('[data-kt-plate-table-filter="status"]').val('').trigger('change');
                table.search('').columns(7).search('').draw();
            });
        } else {
            console.log('DataTables is not defined.');
        }

        // Toggle status
        $('.toggle-status').on('click', function(e) {
            e.preventDefault();

            const plateId = $(this).data('id');
            const newStatus = $(this).data('status');
            const statusText = newStatus ? 'approve' : 'unapprove';

            Swal.fire({
                text: `Are you sure you want to ${statusText} this plate?`,
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: `Yes, ${statusText} it!`,
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-primary",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: '{{ route("admin.plates.update-status") }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: plateId,
                            status: newStatus
                        },
                        success: function(response) {
                            Swal.fire({
                                text: `Plate ${statusText}d successfully!`,
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            }).then(function() {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                text: `Error ${statusText}ing plate!`,
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

        // Toggle sold status
        $('.toggle-sold').on('click', function(e) {
            e.preventDefault();

            const plateId = $(this).data('id');
            const newStatus = $(this).data('status');
            const statusText = newStatus ? 'mark as sold' : 'mark as available';

            Swal.fire({
                text: `Are you sure you want to ${statusText} this plate?`,
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: `Yes, ${statusText}!`,
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-primary",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: '{{ route("admin.plates.update-sold") }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: plateId,
                            status: newStatus
                        },
                        success: function(response) {
                            Swal.fire({
                                text: `Plate ${newStatus ? 'marked as sold' : 'marked as available'} successfully!`,
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            }).then(function() {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                text: `Error updating plate status!`,
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

        // Delete plate
        $('.delete-plate').on('click', function(e) {

            e.preventDefault();

            const plateId = $(this).data('id');
            const row = $(this).closest('tr');
            

            Swal.fire({
                text: "Are you sure you want to delete this plate?",
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
                        url: '{{ route("admin.plates.destroy") }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: plateId
                        },
                        success: function(response) {
                            console.log('delete process confirmed ');        
                            row.remove();
                            Swal.fire({
                                text: "Plate deleted successfully!",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                text: "Error deleting plate!",
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
@endpush