@extends('admin::layouts.master')

@section('content')


<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">

        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Add Category</h1>
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
                        <li class="breadcrumb-item text-muted">eCommerce</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">test</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->

            </div>
            <!--end::Toolbar container-->
        </div>

        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                @include('partials._errors')
                <form class="form d-flex flex-column flex-lg-row" method="POST"
                    action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Aside column-->
                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                        <!--begin::Thumbnail settings-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>Featured Image</h2>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body text-center pt-0">
                                <!--begin::Image input-->
                                <!--begin::Image input placeholder-->
                                <style>
                                .image-input-placeholder {
                                    background-image: url('{{ asset('assets/dashboard-assets/media/svg/files/blank-image.svg') }}');
                                }
                                </style>
                                <!--end::Image input placeholder-->
                                <!--begin::Image input-->
                                <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3"
                                    data-kt-image-input="true">
                                    <!--begin::Preview existing avatar-->
                                    <div class="image-input-wrapper w-150px h-150px"></div>
                                    <!--end::Preview existing avatar-->
                                    <!--begin::Label-->
                                    <label
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change" data-bs-toggle="tooltip" title="add Image">
                                        <!--begin::Icon-->
                                        <i class="ki-duotone ki-pencil fs-7">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <!--end::Icon-->
                                        <!--begin::Inputs-->
                                        <input type="file" name="image" accept=".png, .jpg, .jpeg" />

                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Cancel-->
                                    <span
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                        title="Cancel avatar">
                                        <i class="ki-duotone ki-cross fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <!--end::Cancel-->
                                    <!--begin::Remove-->

                                    <!--end::Remove-->
                                </div>
                                <!--end::Image input-->
                                <!--begin::Description-->
                                <div class="text-muted fs-7">Set the category thumbnail image. Only *.png, *.jpg and
                                    *.jpeg image files are accepted</div>
                                <!--end::Description-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Thumbnail settings-->
                        <!--begin::Status-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>Priority Level</h2>
                                </div>
                                <!--end::Card title-->
                                <!--begin::Card toolbar-->
                                <div class="card-toolbar">
                                    <div class="rounded-circle bg-success w-15px h-15px"
                                        id="kt_ecommerce_add_category_status"></div>
                                </div>
                                <!--begin::Card toolbar-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Select2-->
                                <select class="form-select mb-2" data-control="select2" data-hide-search="true"
                                    data-placeholder="Select an option" name="priority_level"
                                    id="kt_ecommerce_add_category_status_select">

                                    <option value="" selected="selected"></option>
                                    @for ($i = 1; $i <= 10; $i++) <option value="{{ $i }} "
                                        {{ ($i == 10) ? "selected" : ""}}> {{ $i }} </option>
                                        @endfor

                                </select>
                                <!--end::Select2-->
                                <!--begin::Description-->
                                <div class="text-muted fs-7">Set the category priroity Level.</div>
                                <!--end::Description-->
                                <!--begin::Datepicker-->
                                <div class="d-none mt-10">
                                    <label for="kt_ecommerce_add_category_status_datepicker" class="form-label">Select
                                        publishing date and time</label>
                                    <input class="form-control" id="kt_ecommerce_add_category_status_datepicker"
                                        placeholder="Pick date & time" />
                                </div>
                                <!--end::Datepicker-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Status-->

                    </div>
                    <!--end::Aside column-->
                    <!--begin::Main column-->
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <!--begin::General options-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>General</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                @foreach (Config('app.accepted_locales') as  $key => $value)
                                <div class="mb-10 fv-row">
                                    <!--begin::Label-->
                                    <label class="required form-label">Category Name {{$value}}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="name[{{$key}}]" class="form-control mb-2" placeholder="Category name {{$value}}"
                                        value="" />
                                    <!--end::Input-->

                                </div>
                                
                                <!--end::Input group-->
                                @endforeach
                                @foreach (Config('app.accepted_locales') as  $key => $value)
                                <!--begin::Input group-->
                                <div class="my-10">
                                    <!--begin::Label-->
                                    <label class="form-label">Description</label>
                                    <!--end::Label-->
                                    <!--begin::Editor-->
                                    <textarea class="form-control" name="description[{{$key}}]"
                                        aria-label="With textarea"></textarea>
                                    <!--end::Editor-->

                                </div>
                                <!--end::Input group-->
                                @endforeach
                                <!--  -->
                                <div class="mb-10">

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="parent_id"
                                            checked />
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Is Parent
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-10">
                                    <div class="">
                                        <!--begin::Label-->
                                        <label class=" form-label">
                                            Banner

                                        </label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <div class="w-100">
                                            <input class="form-control" type="file" name="cover_image" id="formFile">

                                        </div>
                                        <!--end::Input-->
                                    </div>
                                </div>

                                <div class="mb-10 d-none" id="parent_cat_div">

                                    <!--begin::Select store template-->
                                    <label for="kt_ecommerce_add_category_store_template" class="form-label">Select
                                        Parent
                                        Category</label>
                                    <!--end::Select store template-->
                                    <!--begin::Select2-->
                                    <select class="form-select mb-2" data-control="select2" data-hide-search="true"
                                        data-placeholder="Select an option" name="parent_id" id="parent-id">

                                        <option value="" selected="selected">Select category</option>

                                        <option value="">None</option>
                                        @foreach ($categories as $parentCategory)
                                        <option value="{{ $parentCategory->id }}">{{ $parentCategory->name }}</option>
                                        @foreach ($parentCategory->children as $childCategory)
                                        @include('admin::pages.categories.partials.option', ['category' =>
                                        $childCategory, 'level' => 1])
                                        @endforeach
                                        @endforeach

                                    </select>
                                    <!--end::Select2-->



                                </div>

                                <div class="mb-10" id="parent_cat_div">
                                    <button type="button" class="btn btn-clear d-flex flex-column flex-center"
                                        data-bs-toggle="modal" data-bs-target="#kt_modal_add_role">

                                        <!--begin::Label-->
                                        <div class="fw-bold fs-3 text-gray-600 text-hover-primary">Add Attribute</div>
                                        <!--end::Label-->
                                    </button>
                                    <!--begin::Button-->
                                </div>
                            </div>
                            <!--end::Card header-->
                        </div>
                        <!--end::General options-->
                        <!--begin::Meta options-->
                        <div class="card card-flush py-4">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Meta Options</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label">Meta Tag Title</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control mb-2" name="meta_title"
                                        placeholder="Meta tag name" />
                                    <!--end::Input-->
                                    <!--begin::Description-->

                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label">Meta Tag Description</label>
                                    <!--end::Label-->
                                    <!--begin::Editor-->
                                    <textarea class="form-control" name="meta_descriptions"
                                        aria-label="With textarea"></textarea>
                                    <!--end::Editor-->

                                </div>
                                <!--end::Input group-->

                            </div>
                            <!--end::Card header-->
                        </div>
                        <!--end::Meta options-->

                        <div class="d-flex justify-content-end">
                            <!--begin::Button-->
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-light me-5">Cancel</a>
                            <!--end::Button-->
                            <!--begin::Button-->
                            <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                                <span class="indicator-label">Save Changes</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Button-->
                        </div>
                    </div>

                    @include('admin::pages.categories.partials.attribute')
                    <!--end::Main column-->
                </form>
            </div>
            <!--end::Content container-->
        </div>

    </div>
    <!--end::Content wrapper-->
</div>
<!--end:::Main-->

@endsection

@push('scripts')

<script src="{{ asset('assets/dashboard-assets/js/custom/widgets.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous">
</script>
<script>
$(document).ready(function() {

    // display pareant category 
    $('#hideForm').click(function() {
        $('#kt_modal_add_role').hide();
    });

    // display pareant category
    $('#parent_id').change(function() {

        var is_checked = $('#parent_id').prop('checked');

        if (is_checked) {
            $('#parent_cat_div').addClass('d-none');
            $('#parent_cat_div').val('');
        } else {
            $('#parent_cat_div').removeClass('d-none');
        }

    });

    // display sub category 
    $('#parent-id').change(function() {

        var categoryId = $(this).val();

        if (categoryId) {
            $.ajax({
                url: '{{ route("admin.fetch.children") }}',
                type: 'GET',
                data: {
                    category_id: categoryId
                },
                success: function(response) {
                     
                    $('#subSelect').html(response);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

    });

});
</script>


@endpush