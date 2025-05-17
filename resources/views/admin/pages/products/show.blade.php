@extends('admin::layouts.master')

@push('styles')

    <!-- <link href="{{ asset('assets/dashboard-assets/dist/css/select2.css') }}" rel="stylesheet" /> -->

@endpush

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
                    <h1 class="page-heading d-flex text-gray-900   fs-3 flex-column justify-content-center my-0">
                        Products</h1>
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
                        <li class="breadcrumb-item text-muted">Catalog</li>
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


                <div class="card card-flush py-5 my-5">
                    <!--begin::Card header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <span class="fs-3 fw-bold">Product Stories </span>
                                <span class="fs-2 fw-bold px-3">({{ $variant->product->stories?->count() }})</span>
                                
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <!-- <div class="card-toolbar flex-row-fluid justify-content-end gap-5">

                            
                            <a href="{{ route('admin.products.index') }}" class="btn btn-light"><i class="ki-duotone ki-left fs-2"></i></a>
                            <div class="d-flex flex-wrap">
                                <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_1">Add Story</button>
                              
                            </div>
                            
                        </div> -->
                      
                    </div>
                


                    
                  

                </div>

                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card header-->
                        <div class="card-title fs-3 fw-bold ">Product and stock details </div>
                        <!--end::Card header-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body">
                        <!--begin::Row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row mb-6">
                                    <!--begin::Col-->
                                    <div class="col-xl-3">
                                        <div class="fs-6 fw-semibold  mt-2 mb-3 fw-bold ">Product Name : </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-xl-9">
                                        <!--begin::Progress-->
                                        <div class="d-flex flex-column">
                                            <div class="d-flex justify-content-between w-100 fs-4  ">
                                                <span>{{ $variant->product->name }}</span>
                                                <!-- <span>$22,300 of 36,000 Used</span> -->
                                            </div>

                                        </div>
                                        <!--end::Progress-->
                                    </div>
                                    <!--end::Col-->

                                </div>
                                <div class="row mb-6">
                                    <!--begin::Col-->
                                    <div class="col-xl-3">
                                        <div class="fs-6 fw-semibold  mt-2 mb-3 fw-bold ">Category Name : </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-xl-9">
                                        <!--begin::Progress-->
                                        <div class="d-flex flex-column">
                                            <div class="d-flex justify-content-between w-100 fs-5  ">
                                                <span>{{ $variant->product->category?->name }}</span>

                                            </div>

                                        </div>
                                        <!--end::Progress-->
                                    </div>
                                    <!--end::Col-->

                                </div>
                                <div class="row mb-6">
                                    <!--begin::Col-->
                                    <div class="col-xl-3">
                                        <div class="fs-6 fw-semibold  mt-2 mb-3 fw-bold">Brand : </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-xl-9">
                                        <!--begin::Progress-->
                                        <div class="d-flex flex-column">
                                            <div class="d-flex justify-content-between w-100 fs-4  ">
                                                <span>{{ $variant->product->brand?->name}}</span>
                                                <!-- <span>$22,300 of 36,000 Used</span> -->
                                            </div>

                                        </div>
                                        <!--end::Progress-->
                                    </div>
                                    <!--end::Col-->

                                </div>
                                <div class="row mb-6">
                                    <!--begin::Col-->
                                    <div class="col-xl-3">
                                        <div class="fs-6 fw-semibold  mt-2 mb-3 fw-bold">Model Number : </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-xl-9">
                                        <!--begin::Progress-->
                                        <div class="d-flex flex-column">
                                            <div class="d-flex justify-content-between w-100 fs-4  ">
                                                <span>{{ $variant->product?->model_number }}</span>
                                                <!-- <span>$22,300 of 36,000 Used</span> -->
                                            </div>

                                        </div>
                                        <!--end::Progress-->
                                    </div>
                                    <!--end::Col-->

                                </div>
                                <div class="row mb-6">
                                    <!--begin::Col-->
                                    <div class="col-xl-3">
                                        <div class="fs-6 fw-semibold  mt-2 mb-3 fw-bold">GTN : </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-xl-9">
                                        <!--begin::Progress-->
                                        <div class="d-flex flex-column">
                                            <div class="d-flex justify-content-between w-100 fs-4  ">
                                                <span>{{ $variant->product->gtin }}</span>
                                                <!-- <span>$22,300 of 36,000 Used</span> -->
                                            </div>

                                        </div>
                                        <!--end::Progress-->
                                    </div>
                                    <!--end::Col-->

                                </div>
                                <div class="row mb-6">
                                    <!--begin::Col-->
                                    <div class="col-xl-3">
                                        <div class="fs-6 fw-semibold  mt-2 mb-3 fw-bold">MPN : </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-xl-9">
                                        <!--begin::Progress-->
                                        <div class="d-flex flex-column">
                                            <div class="d-flex justify-content-between w-100 fs-4  ">
                                                <span>{{ $variant->product?->mpn }}</span>
                                                <!-- <span>$22,300 of 36,000 Used</span> -->
                                            </div>

                                        </div>
                                        <!--end::Progress-->
                                    </div>
                                    <!--end::Col-->

                                </div>
                                <div class="row mb-6">
                                    <!--begin::Col-->
                                    <div class="col-xl-3">
                                        <div class="fs-6 fw-semibold  mt-2 mb-3 fw-bold">Summary : </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-xl-9">
                                        <!--begin::Progress-->
                                        <div class="d-flex flex-column">
                                            <div class="d-flex justify-content-between w-100 fs-4  ">
                                                <span>{{ $variant->product->gtin }}</span>
                                                <!-- <span>$22,300 of 36,000 Used</span> -->
                                                <p class="text-dark">
                                                    {!! $variant->product->summary !!}
                                                </p>
                                            </div>

                                        </div>
                                        <!--end::Progress-->
                                    </div>
                                    <!--end::Col-->

                                </div>

                                <div class="row mb-6">
                                    <!--begin::Col-->
                                    <div class="col-xl-3">
                                        <div class="fs-6 fw-semibold  mt-2 mb-3 fw-bold">Description : </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-xl-9">
                                        <!--begin::Progress-->
                                        <div class="d-flex flex-column">
                                            <div class="d-flex justify-content-between w-100 fs-4  ">
                                                <p class="text-dark" id="product-description">
                                                    {!! $variant->product?->description !!}
                                                </p>
                                            </div>

                                        </div>
                                        <!--end::Progress-->
                                    </div>
                                    <!--end::Col-->

                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="row mb-6">
                                    <!--begin::Col-->
                                    <div class="col-xl-3">
                                        <div class="fs-6 fw-semibold  mt-2 mb-3 fw-bold">SKU :</div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-xl-9">
                                        <!--begin::Progress-->
                                        <div class="d-flex flex-column">
                                            <div class="d-flex justify-content-between w-100 fs-4   mb-3">
                                                <span>{{ $variant->sku }}</span>
                                                <!-- <span>$22,300 of 36,000 Used</span> -->
                                            </div>

                                        </div>
                                        <!--end::Progress-->
                                    </div>
                                    <!--end::Col-->

                                </div>
                                <div class="row mb-6">
                                    <!--begin::Col-->
                                    <div class="col-xl-3">
                                        <div class="fs-6 fw-semibold  mt-2 mb-3 fw-bold">Barcode :</div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-xl-9">
                                        <!--begin::Progress-->
                                        <div class="d-flex flex-column">
                                            <div class="d-flex justify-content-between w-100 fs-4   mb-3">
                                                <span>{{ $variant->barcode }}</span>
                                                <!-- <span>$22,300 of 36,000 Used</span> -->
                                            </div>

                                        </div>
                                        <!--end::Progress-->
                                    </div>
                                    <!--end::Col-->

                                </div>
                                <div class="row mb-6">
                                    <!--begin::Col-->
                                    <div class="col-xl-3">
                                        <div class="fs-6 fw-semibold  mt-2 mb-3 fw-bold">Price: </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-xl-9">
                                        <!--begin::Progress-->
                                        <div class="d-flex flex-column">
                                            <div class="d-flex justify-content-between w-100 fs-4   mb-3">
                                                <span>{{ $variant->price }} </span>
                                                <!-- <span>$22,300 of 36,000 Used</span> -->
                                            </div>

                                        </div>
                                        <!--end::Progress-->
                                    </div>
                                    <!--end::Col-->

                                </div>
                                <div class="row mb-6">
                                    <!--begin::Col-->
                                    <div class="col-xl-3">
                                        <div class="fs-6 fw-semibold  mt-2 mb-3 fw-bold">Cost Price:</div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-xl-9">
                                        <!--begin::Progress-->
                                        <div class="d-flex flex-column">
                                            <div class="d-flex justify-content-between w-100 fs-4   mb-3">
                                                <span>{{ $variant->cost_price }}</span>
                                                <!-- <span>$22,300 of 36,000 Used</span> -->
                                            </div>

                                        </div>
                                        <!--end::Progress-->
                                    </div>
                                    <!--end::Col-->

                                </div>
                                <div class="row mb-6">
                                    <!--begin::Col-->
                                    <div class="col-xl-3">
                                        <div class="fs-6 fw-semibold  mt-2 mb-3 fw-bold">Sale Price:
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-xl-9">
                                        <!--begin::Progress-->
                                        <div class="d-flex flex-column">
                                            <div class="d-flex justify-content-between w-100 fs-4   mb-3">
                                                <span>{{ $variant->sale_price }}</span>
                                                <!-- <span>$22,300 of 36,000 Used</span> -->
                                            </div>

                                        </div>
                                        <!--end::Progress-->
                                    </div>
                                    <!--end::Col-->

                                </div>
                                <div class="row mb-6">
                                    <!--begin::Col-->
                                    <div class="col-xl-3">
                                        <div class="fs-6 fw-semibold  mt-2 mb-3 fw-bold">Quantity:
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-xl-9">
                                        <!--begin::Progress-->
                                        <div class="d-flex flex-column">
                                            <div class="d-flex justify-content-between w-100 fs-4   mb-3">
                                                <span>{{ $variant->quantity }}</span>
                                                <!-- <span>$22,300 of 36,000 Used</span> -->
                                            </div>

                                        </div>
                                        <!--end::Progress-->
                                    </div>
                                    <!--end::Col-->

                                </div>

                            </div>
                        </div>
                        <!--end::Row-->



                    </div>
                    <!--end::Card body-->
                    <!--begin::Card footer-->

                </div>
                <!--end::Card-->
                <!--end::Products-->


            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->

</div>
<!--end:::Main-->

@endsection

@push('scripts')

    <script>
        $(document).ready(function () {

            const buttons = document.querySelectorAll('.kt_docs_sweetalert_basic');

            buttons.forEach(button => {


                button.addEventListener('click', e => {

                    Swal.fire({
                        html: `Are you sure you wont to delete this record`,
                        icon: "info",
                        buttonsStyling: false,
                        showCancelButton: true,
                        confirmButtonText: "Delete",
                        cancelButtonText: 'Cancel',
                        customClass: {
                            confirmButton: "btn btn-primary",
                            cancelButton: 'btn btn-danger'
                        }
                    }).then((result) => {

                        if (result.isConfirmed) {

                        

                        } else {
                            console.log('fron delete not Confirmed')

                        }



                    });
                });

            });

        });
    </script>
@endpush