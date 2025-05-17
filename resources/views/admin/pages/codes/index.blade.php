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
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        code Value</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href=" " class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">code Values Management</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Values</li>
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
                                <input type="text" data-kt-user-table-filter="search"
                                    class="form-control   w-250px ps-13" placeholder="Search " />
                            </div>
                            <!--end::Search-->
                            <!--begin::Toolbar-->
                            <!--end::Toolbar-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <div class="card-toolbar">
                                    <!--begin::Button-->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_add_code">
                                        <i class="ki-duotone ki-plus-square fs-3">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>Add New</button>
                                    <!--end::Button-->
                                </div>
                                <!--end::Card toolbar-->
                                <!--begin::Add customer-->
                                <!-- <a href="{" class="btn btn-primary">Add Category</a> -->
                                <!--end::Add customer-->
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--begin::Card title-->

                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body py-4 table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                data-kt-check-target="#kt_table_users .form-check-input" value="1" />
                                        </div>
                                    </th>
                                    <th class="min-w-125px">Code Name</th>
                                    <th class="min-w-125px">Emirate name </th>


                                    <th class="text-end min-w-100px">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @foreach ($codes as $code)
                              


                                    <tr>
                                        <td>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="1" />
                                            </div>
                                        </td>
                                        <td class="d-flex align-items-center">
                                            <!--begin:: Avatar -->

                                            <!--end::Avatar-->
                                            <!--begin::User details-->
                                            <div class="d-flex flex-column">
                                                <a href=""
                                                    class="text-gray-800 text-hover-primary mb-1">{{$code->name}}</a>

                                            </div>
                                            <!--begin::User details-->
                                        </td>
                                        <td>{{ $code->emirate ? $code->emirate->name : 'N/A' }}</td>



                                        <td class="text-end">
                                            <a href="#"
                                                class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                  
                                                    <button type="button" class="menu-link px-3 btn-data"
                                                        data-id="{{$code->id}}">
                                                        Edit</button>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3"
                                                        data-kt-users-table-filter="delete_row">Delete</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu-->
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

{{--   --}}

@include('admin.pages.codes.partials.code_crud')



@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function () {
            // Initialize Select2 elements
            if ($.fn.select2) {
                $('.form-select').select2({
                    dropdownParent: $(this).closest('.modal')
                });
            }

            // Reset form when opening the add modal
            $('[data-bs-target="#kt_modal_add_code"]').click(function(){
                $('#myForm')[0].reset();
                if ($.fn.select2) {
                    $('#myForm select').val('').trigger('change');
                }
            });

            // Handle edit button click
            $('.btn-data').click(function () {
                var id = $(this).data('id');

                // AJAX request to get code data
                $.get('{{ route("admin.codes.edit", ":id") }}'.replace(':id', id), function (data) {
                    // Set form action URL with the correct ID
                    $('#editForm').attr('action', '{{ route("admin.codes.update", "") }}/' + id);
                    
                    // Populate form fields
                    $('#edit_code_id').val(data.code.id);
                    $('#edit_code_name').val(data.code.name);
                    
                    // Set emirate dropdown value
                    if ($.fn.select2) {
                        $('#edit_emirate_id').val(data.code.emirate_id).trigger('change');
                    } else {
                        $('#edit_emirate_id').val(data.code.emirate_id);
                    }
                    
                    // Show the modal
                    $('#kt_modal_edit_code').modal('show');
                }).fail(function(xhr, status, error) {
                    console.error("Error fetching code data:", error);
                    toastr.error("Failed to load code data");
                });
            });

            // Delete functionality
            $('[data-kt-users-table-filter="delete_row"]').click(function(e) {
                e.preventDefault();
                
                var codeId = $(this).closest('tr').find('.btn-data').data('id');
                var row = $(this).closest('tr');
                
                Swal.fire({
                    text: "Are you sure you want to delete this code?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        $.ajax({
                            url: '{{ route("admin.codes.destroy", "") }}/' + codeId,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                row.remove();
                                Swal.fire({
                                    text: "Code deleted successfully!",
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
                                    text: "Error deleting code!",
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