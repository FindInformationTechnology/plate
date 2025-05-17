<!--begin::Modal - Add manufacturers-->
<div class="modal fade" id="kt_modal_add_manufacturer" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add a manufacturer</h2>
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
                <form class="form" action="{{ route('admin.manufacturers.store') }}" method="post" >
                    @csrf
                    <!--begin::Input group-->

                    @foreach (Config('app.accepted_locales') as  $key => $value)
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">manufacturer Name {{ $value }}</span>
                            <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true"
                                data-bs-content="manufacturer names is required to be unique.">
                                <i class="ki-duotone ki-information fs-7">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control  " placeholder="Enter a manufacturer name"
                            name="name[{{ $key }}]" />
                        <!--end::Input-->
                    </div>
                    @endforeach
                    <!--end::Input group-->
                    <!--begin::Input group-->

                    <!--end::Input group-->

                    <!--begin::Actions-->
                    <div class="text-center pt-15">

                        <button type="submit" class="btn btn-primary" data-kt-manufacturers-modal-action="submit">
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
<!--end::Modal - Add manufacturers-->

<!--begin::Modal - Add manufacturers-->
<div class="modal fade" id="kt_modal_edit_manufacturer" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add a manufacturer</h2>
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
                <form class="form" action="{{ route('admin.manufacturers.store') }}" method="post" id="myForm">
                    @csrf
                    <!--begin::Input group-->

                    <input 
                    name="manufacturer_id" id="manufacturer_id" hidden value=""/>

                    @foreach (Config('app.accepted_locales') as  $key => $value)
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">manufacturer Name {{ $value }}</span>
                            <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true"
                                data-bs-content="manufacturer names is required to be unique.">
                                <i class="ki-duotone ki-information fs-7">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control  " placeholder="Enter a manufacturer name"
                            name="name[{{ $key }}]" id="manufacturer_name_{{$key}}"/>
                        <!--end::Input-->
                    </div>
                    @endforeach
                    <!--end::Input group-->
                    <!--begin::Input group-->

                    <!--end::Input group-->

                    <!--begin::Actions-->
                    <div class="text-center pt-15">

                        <button type="submit" class="btn btn-primary" data-kt-manufacturers-modal-action="submit">
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
<!--end::Modal - Add manufacturers-->


