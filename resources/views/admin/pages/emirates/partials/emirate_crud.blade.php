<!--begin::Modal - Add Emirate-->
<div class="modal fade" id="kt_modal_add_emirate" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_emirate_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add Emirate</h2>
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
            <div class="modal-body px-5 my-7">
                <!--begin::Form-->
                <form id="myForm" class="form" action="{{ route('admin.emirates.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_emirate_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_emirate_header" data-kt-scroll-wrappers="#kt_modal_add_emirate_scroll" data-kt-scroll-offset="300px">
                        
                        <!-- Tabs for languages -->
                        <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_en">English</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_ar">Arabic</a>
                            </li>
                        </ul>
                        
                        <!-- Tab content -->
                        <div class="tab-content" id="myTabContent">
                            <!-- English Tab -->
                            <div class="tab-pane fade show active" id="kt_tab_pane_en" role="tabpanel">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-semibold fs-6 mb-2">Emirate Name (English)</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="name[en]" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Emirate name in English" required />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            
                            <!-- Arabic Tab -->
                            <div class="tab-pane fade" id="kt_tab_pane_ar" role="tabpanel">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-semibold fs-6 mb-2">Emirate Name (Arabic)</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="name[ar]" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Emirate name in Arabic" required dir="rtl" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                            </div>
                        </div>
                        
                        <!--begin::Input group-->
                        <div class="fv-row mb-7 mt-5">
                            <!--begin::Label-->
                            <label class="fw-semibold fs-6 mb-2">Emirate Icon</label>
                            <!--end::Label-->
                            <!--begin::Image input-->
                            <div class="image-input image-input-empty image-input-outline" data-kt-image-input="true" style="background-image: url('{{ asset('assets/media/svg/avatars/blank.svg') }}')">
                                <!--begin::Image preview wrapper-->
                                <div class="image-input-wrapper w-125px h-125px"></div>
                                <!--end::Image preview wrapper-->

                                <!--begin::Edit button-->
                                <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="change"
                                    data-bs-toggle="tooltip"
                                    data-bs-dismiss="click"
                                    title="Change icon">
                                    <i class="ki-duotone ki-pencil fs-7">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <!--begin::Inputs-->
                                    <input type="file" name="icon" accept=".png, .jpg, .jpeg, .svg" />
                                    <input type="hidden" name="icon_remove" />
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Edit button-->

                                <!--begin::Cancel button-->
                                <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="cancel"
                                    data-bs-toggle="tooltip"
                                    data-bs-dismiss="click"
                                    title="Cancel icon">
                                    <i class="ki-duotone ki-cross fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <!--end::Cancel button-->

                                <!--begin::Remove button-->
                                <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="remove"
                                    data-bs-toggle="tooltip"
                                    data-bs-dismiss="click"
                                    title="Remove icon">
                                    <i class="ki-duotone ki-cross fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <!--end::Remove button-->
                            </div>
                            <!--end::Image input-->
                            <div class="form-text">Allowed file types: png, jpg, jpeg, svg.</div>
                        </div>
                        <!--end::Input group-->
                        
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-10">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>
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
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Add Emirate-->

<!--begin::Modal - Edit Emirate-->
<div class="modal fade" id="kt_modal_edit_emirate" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_edit_emirate_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Edit Emirate</h2>
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
            <div class="modal-body px-5 my-7">
                <!--begin::Form-->
                <form id="editForm" class="form" action="{{ route('admin.emirates.update', '') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_edit_emirate_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_edit_emirate_header" data-kt-scroll-wrappers="#kt_modal_edit_emirate_scroll" data-kt-scroll-offset="300px">
                        
                        <input type="hidden" name="emirate_id" id="edit_emirate_id">
                        
                        <!-- Tabs for languages -->
                        <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#kt_edit_tab_pane_en">English</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#kt_edit_tab_pane_ar">Arabic</a>
                            </li>
                        </ul>
                        
                        <!-- Tab content -->
                        <div class="tab-content" id="myEditTabContent">
                            <!-- English Tab -->
                            <div class="tab-pane fade show active" id="kt_edit_tab_pane_en" role="tabpanel">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-semibold fs-6 mb-2">Emirate Name (English)</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="name[en]" id="edit_emirate_name_en" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Emirate name in English" required />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            
                            <!-- Arabic Tab -->
                            <div class="tab-pane fade" id="kt_edit_tab_pane_ar" role="tabpanel">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-semibold fs-6 mb-2">Emirate Name (Arabic)</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" name="name[ar]" id="edit_emirate_name_ar" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Emirate name in Arabic" required dir="rtl" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                            </div>
                        </div>
                        
                        <!--begin::Input group-->
                        <div class="fv-row mb-7 mt-5">
                            <!--begin::Label-->
                            <label class="fw-semibold fs-6 mb-2">Emirate Icon</label>
                            <!--end::Label-->
                            <!--begin::Image input-->
                            <div class="image-input image-input-outline" data-kt-image-input="true" id="edit_emirate_icon_wrapper">
                                <!--begin::Image preview wrapper-->
                                <div class="image-input-wrapper w-125px h-125px" id="edit_emirate_icon_preview"></div>
                                <!--end::Image preview wrapper-->

                                <!--begin::Edit button-->
                                <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="change"
                                    data-bs-toggle="tooltip"
                                    data-bs-dismiss="click"
                                    title="Change icon">
                                    <i class="ki-duotone ki-pencil fs-7">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <!--begin::Inputs-->
                                    <input type="file" name="icon" accept=".png, .jpg, .jpeg, .svg" />
                                    <input type="hidden" name="icon_remove" />
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Edit button-->

                                <!--begin::Cancel button-->
                                <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="cancel"
                                    data-bs-toggle="tooltip"
                                    data-bs-dismiss="click"
                                    title="Cancel icon">
                                    <i class="ki-duotone ki-cross fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <!--end::Cancel button-->

                                <!--begin::Remove button-->
                                <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="remove"
                                    data-bs-toggle="tooltip"
                                    data-bs-dismiss="click"
                                    title="Remove icon">
                                    <i class="ki-duotone ki-cross fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <!--end::Remove button-->
                            </div>
                            <!--end::Image input-->
                            <div class="form-text">Allowed file types: png, jpg, jpeg, svg.</div>
                        </div>
                        <!--end::Input group-->
                        
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-10">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Update</span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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
<!--end::Modal - Edit Emirate-->