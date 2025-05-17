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
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Deals Of The Day</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route ('admin.dashboard') }}" class="text-muted text-hover-primary">Dashboard</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->

                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Deals</li>
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
                <livewire:admin::deals-of-the-day.list-deals />
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

<!-- <script src="{{ asset('assets/dashboard-assets/js/custom/apps/ecommerce/catalog/products.js') }}"></script> -->

<script>
    $("#kt_datepicker_1").flatpickr();
    $("#kt_datepicker_2").flatpickr();

    $('.new_deal').click(function() {

        Livewire.dispatch('new');

    });

    $('.edit_deal').click(function() {

        const dealId = $(this).data('deal-id');

        Livewire.dispatch('loadRecord', {
            'id': dealId
        });

    });

    window.addEventListener('hide-modal', (event) => {

        $('#deal_modal').modal('hide');

        // console.log(typeof (event.detail[0]));

        toastr.success(event.detail[0]);


    }) // end of function

    // $('.delete').click(function() {

    //     confirm('Are you sure to delete this ?');

    //     const id = $(this).data('delete-id');

    //     Livewire.dispatch('deleteRecord', {
    //         'id': id
    //     });
    // });
</script>





@endpush