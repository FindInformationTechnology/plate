<!--begin::Modal - Add brands-->
<div class="modal fade" id="kt_modal_add_brand" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add a brand</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form class="form" action="{{ route('admin.brands.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Manufacturers  </span>
                            <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true"
                                data-bs-content="attribute names is required to be unique.">
                                <i class="ki-duotone ki-information fs-7">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <select class="form-select mb-2" data-control="select2" name="manufacturer_id"
                            data-hide-search="true" data-placeholder="Select an option"
                            id="kt_ecommerce_add_product_status_select">
                            <option>Select manufacturer</option>
                            @foreach ($manufacturers as $manufacturer)
                                <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>

                            @endforeach

                        </select>
                        <!--end::Input-->
                    </div>
                    <!--begin::Input group-->

                    <!--begin::Input group-->
                    @foreach (Config('app.accepted_locales') as $key => $value)
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Brand Name {{ $value }}</span>
                                <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true"
                                    data-bs-content="brand names is required to be unique.">
                                    <i class="ki-duotone ki-information fs-7">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control  " placeholder="Enter a brand name"
                                name="name[{{ $key }}]" />
                            <!--end::Input-->
                        </div>
                    @endforeach
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">

                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mt-3">
                            <span class="required">Brand Logo</span>

                        </label>
                        <!--end::Label-->

                        <!--begin::Input-->
                        <div class="w-100">
                            <input class="form-control" type="file" name="image" id="formFile">
                        </div>
                        <!--end::Input-->

                    </div>
                    <!--end::Input group-->

                    <!-- meta data -->
                    <!--begin::Meta options-->
                    <div class="">
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
                    <!-- end of meta data -->

                    <!--begin::Actions-->
                    <div class="text-center pt-15">

                        <button type="submit" class="btn btn-primary" data-kt-brands-modal-action="submit">
                            <span class="indicator-label">Submit</span>


                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Add brands-->

<!--begin::Modal - Add brands-->
<div class="modal fade" id="kt_modal_edit_brand" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add a brand</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form class="form" action="{{ route('admin.brands.store') }}" method="post" id="myForm">
                    @csrf
                    <input name="brand_id" id="brand_id" hidden value="" />
                    <!--begin::Input group-->
                       <!--begin::Input group-->
                       <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Manufacturers  </span>
                            <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true"
                                data-bs-content="attribute names is required to be unique.">
                                <i class="ki-duotone ki-information fs-7">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <select class="form-select mb-2" data-control="select2" name="manufacturer_id"
                            data-hide-search="true" data-placeholder="Select an option"
                            id="container_manufacturer">
                            <option>Select manufacturer</option>
                           

                        </select>
                        <!--end::Input-->
                    </div>
                    <!--begin::Input group-->
                 
                    
                    
                    
                    
                    <!--begin::Input group-->
                    @foreach (Config('app.accepted_locales') as $key => $value)
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">brand Name {{ $value }}</span>
                                <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true"
                                    data-bs-content="brand names is required to be unique.">
                                    <i class="ki-duotone ki-information fs-7">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control  " placeholder="Enter a brand name"
                                name="name[{{ $key }}]" id="brand_name_{{$key}}" />
                            <!--end::Input-->
                        </div>
                    @endforeach
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">

                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mt-3">
                            <span class="required">Brand Logo</span>

                        </label>
                        <!--end::Label-->

                        <!--begin::Input-->
                        <div class="w-100">
                            <input class="form-control" type="file" name="image" >
                        </div>
                        <!--end::Input-->

                    </div>
                    <!--end::Input group-->

                    <!-- meta data -->
                    <!--begin::Meta options-->
                    <div class="">
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
                                    placeholder="Meta tag name" id="meta_title"/>
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
                                    aria-label="With textarea" id="meta_descriptions"></textarea>
                                <!--end::Editor-->

                            </div>
                            <!--end::Input group-->

                        </div>
                        <!--end::Card header-->
                    </div>
                    <!--end::Meta options-->
                    <!-- end of meta data -->
                    <!--end::Input group-->

                    <!--begin::Actions-->
                    <div class="text-center pt-15">

                        <button type="submit" class="btn btn-primary" data-kt-brands-modal-action="submit">
                            <span class="indicator-label">Submit</span>


                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Add brands-->