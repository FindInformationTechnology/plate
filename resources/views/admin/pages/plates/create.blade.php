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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Add New Plate</h1>
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
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.plates.index') }}" class="text-muted text-hover-primary">Plates</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Add New</li>
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
                            <h2>Plate Details</h2>
                        </div>
                        <!--begin::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <!--begin::Form-->
                        <form action="{{ route('admin.plates.store') }}" method="POST" class="form">
                            @csrf
                            
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">User</label>
                                <!--end::Label-->
                                <!--begin::Select-->
                                <select name="user_id" class="form-select form-select-solid" data-control="select2" data-placeholder="Select a user" required>
                                    <option></option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                    @endforeach
                                </select>
                                <!--end::Select-->
                            </div>
                            <!--end::Input group-->
                            
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Emirate</label>
                                                                <!--end::Label-->
                                <!--begin::Select-->
                                <select name="emirate_id" class="form-select form-select-solid" data-control="select2" data-placeholder="Select an emirate" required>
                                    <option></option>
                                    @foreach($emirates as $emirate)
                                        <option value="{{ $emirate->id }}">{{ $emirate->name }}</option>
                                    @endforeach
                                </select>
                                <!--end::Select-->
                            </div>
                            <!--end::Input group-->
                            
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Code</label>
                                <!--end::Label-->
                                <!--begin::Select-->
                                <select name="code_id" class="form-select form-select-solid" data-control="select2" data-placeholder="Select a code" required>
                                    <option></option>
                                    @foreach($codes as $code)
                                        <option value="{{ $code->id }}">{{ $code->name }}</option>
                                    @endforeach
                                </select>
                                <!--end::Select-->
                            </div>
                            <!--end::Input group-->
                            
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Number</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="number" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Plate number" required />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Length</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="number" name="length" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Plate length" min="1" required />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Price</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="number" name="price" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Plate price" min="0" step="0.01" required />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" name="is_approved" id="is_approved" value="1" />
                                    <label class="form-check-label fw-semibold fs-6" for="is_approved">
                                        Approved
                                    </label>
                                </div>
                            </div>
                            <!--end::Input group-->
                            
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" name="is_sold" id="is_sold" value="1" />
                                    <label class="form-check-label fw-semibold fs-6" for="is_sold">
                                        Sold
                                    </label>
                                </div>
                            </div>
                            <!--end::Input group-->
                            
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" name="is_visible" id="is_visible" value="1" checked />
                                    <label class="form-check-label fw-semibold fs-6" for="is_visible">
                                        Available
                                    </label>
                                </div>
                            </div>
                            <!--end::Input group-->
                            
                            <!--begin::Actions-->
                            <div class="text-center pt-10">
                                <a href="{{ route('admin.plates.index') }}" class="btn btn-light me-3">Cancel</a>
                                <button type="submit" class="btn btn-primary">
                                    <span class="indicator-label">Submit</span>
                                    <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
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

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize Select2
        if ($.fn.select2) {
            $('.form-select').select2({
                minimumResultsForSearch: 10
            });
        }
        
        // Handle sold status change
        $('#is_sold').on('change', function() {
            if ($(this).is(':checked')) {
                $('#is_visible').prop('checked', false);
            }
        });
        
        // Handle available status change
        $('#is_visible').on('change', function() {
            if ($(this).is(':checked')) {
                $('#is_sold').prop('checked', false);
            }
        });
    });
</script>
@endpush