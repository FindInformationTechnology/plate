@extends('seller::layouts.master')

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
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Products Viewed Report</h1>
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
                        <li class="breadcrumb-item text-muted">Reports</li>
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
                <!--begin::Products-->
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-duotone ki-magnifier fs-2 position-absolute ms-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                              
                            </div>
                            <!--end::Search-->
                            <!--begin::Export buttons-->
                            <div id="kt_ecommerce_report_views_export" class="d-none"></div>
                            <!--end::Export buttons-->
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            
                            
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0 table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5"
                            id="kt_ecommerce_report_views_table">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-150px">Customer Name</th>
                                    <th class="min-w-150px">Product</th>
                                    <!-- <th class="text-end min-w-100px">SKU</th> -->
                                    <th class="text-end min-w-100px">Rating</th>
                                    <!-- <th class="text-end min-w-100px">Price</th>
                                    <th class="text-end min-w-70px">Viewed</th> -->
                                    <th class="text-end min-w-100px">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">

                          
                            @foreach ($products as $product)

@foreach ($product->reviews as $review)
<!-- <li>{{ $review->content }}</li> -->


<tr>
    <td>
        <div class="d-flex align-items-center">

            <div class="ms-5">
                <!--begin::Title-->
                <a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bold" data-kt-ecommerce-product-filter="product_name">{{ $review->customer->first_name }} {{  $review->customer->last_name }}</a>
                <!--end::Title-->
            </div>
        </div>
    </td>
    <td>
        <div class="d-flex align-items-center">
            <!--begin::Thumbnail-->

            <div class="ms-5">
                <!--begin::Title-->
                <a href="apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fs-5 fw-bold" data-kt-ecommerce-product-filter="product_name">{{ $product->name }}</a>
                <!--end::Title-->
            </div>
        </div>
    </td>
    <!-- <td class="text-end pe-0">
                            <span class="fw-bold">03578006</span>
                        </td> -->
    <td class="text-end pe-0" data-order="rating-1" data-filter="rating-1">
        <div class="rating justify-content-end">
            @for ($j = 0; $j < $review->rate; $j++)

                <div class="rating-label checked">
                    <i class="ki-duotone ki-star fs-6"></i>
                </div>
                @endfor

        </div>
    </td>

    <td class="text-end pe-0">
        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
            <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
        <!--begin::Menu-->
        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
            <!--begin::Menu item-->
            <div class="menu-item px-3">
                <a href="{{ route('seller.products.reviews.show', $product->id) }}" class="menu-link px-3">Show</a>
            </div>
            <div class="menu-item px-3">
                <a href="{{ route('seller.products.edit', $product->id) }}" class="menu-link px-3">Edit</a>
            </div>
            <!--end::Menu item-->
            <!--begin::Menu item-->
            <div class="menu-item px-3">
                <!-- <a href="#" class="menu-link px-3"
                    data-kt-ecommerce-product-filter="delete_row">Delete</a> -->
                <div class="menu-item px-3">
                    <form action="{{ route('seller.products.reviews.destroy', $product->id) }}"
                        method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-light px-3 ">Delete</button>
                    </form>

                </div>
            </div>
            <!--end::Menu item-->
        </div>
        <!--end::Menu-->
    </td>
</tr>
@endforeach

@endforeach


                            </tbody>
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
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

<script src="{{ asset('assets/dashboard-assets/js/custom/apps/user-management/users/list/table.js') }}"></script>

<script>
    window.addEventListener('added', (event) => {
        // the id of the model pass from the component
        $('#kt_modal_add_user').modal('hide');

        toastr.success(event.detail.message, "Success");


    }) // end of function
</script>



<script>
    $('#kt_modal_add_user').on('hidden.bs.modal', function() {
        Livewire.dispatch('new_user');

    });

    $('.edit_user').click(function() {
        const userId = $(this).data('user-id');

        Livewire.dispatch('update_user', {
            'userId': userId
        });
    });

    $('.delete_item').click(function() {
        // const Id = $(this).data('user-id');
        Livewire.dispatch('delete', {
            'id': Id
        });
    });
</script>
@endpush