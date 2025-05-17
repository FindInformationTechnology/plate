<div class="tab-pane fade show active" id="kt_customer_view_overview_tab" role="tabpanel">
    <!--begin::Statistics-->
    <div class="card mb-6 mb-xl-9">
        <!--begin::Header-->
        <div class="card-header border-0">
            <div class="card-title">
                <h2>Statistics </h2>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-0">
            <div class="fs-5 fw-bold text-gray-500 mb-4">Customer Orders Overview Between 01-01-2023 - 01-06-2024.</div>
            <!--begin::Left Section-->
            <div class="d-flex flex-wrap flex-stack mb-5">
                <!--begin::Row-->
                <div class="d-flex flex-wrap">
                    <!--begin::Col-->
                    <div class="border border-dashed border-gray-300 w-150px rounded my-3 p-4 me-6">
                        <span class="fs-1 fw-bolder text-gray-800 lh-1">
                            <span data-kt-countup="true" data-kt-countup-value="{{ $customer->orders()->sold()->count() }}" >0</span>
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                            
                            <!--end::Svg Icon-->
                        </span>
                        <span class="fs-6 fw-bold text-muted d-block lh-1 pt-2">Total Orders</span>
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="border border-dashed border-gray-300 w-200px rounded my-3 p-4 me-6">
                        <span class="fs-1 fw-bolder text-gray-800 lh-1">
                            <span class="" data-kt-countup="true" data-kt-countup-value="{{ $customer->orders()->sold()->sum('total_amount') }}" data-kt-countup-prefix="">0</span>
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                            
                            <!--end::Svg Icon-->
                        </span>
                        <span class="fs-6 fw-bold text-muted d-block lh-1 pt-2">Total Amount(<small>AED</small>)</span>
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="border border-dashed border-gray-300 w-150px rounded my-3 p-4 me-6">
                        <span class="fs-1 fw-bolder text-gray-800 lh-1">
                            <span data-kt-countup="true" data-kt-countup-value="" data-kt-countup-prefix=""></span>
                            <span class="text-primary">--</span>
                        </span>
                        <span class="fs-6 fw-bold text-muted d-block lh-1 pt-2">Total Return</span>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <a href="#" class="btn btn-sm btn-light-primary flex-shrink-0">Change Date Range</a>
            </div>
            <!--end::Left Section-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Statistics-->
    <!--begin::Card-->
    <div class="card pt-4 mb-6 mb-xl-9">
        <!--begin::Card header-->
        <div class="card-header border-0">
            <!--begin::Card title-->
            <div class="card-title">
                <h2>Customer Orders</h2>
            </div>
            <!--end::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Filter-->
                <button type="button" class="btn btn-sm btn-flex btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_payment">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen035.svg-->
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="black" />
                            <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black" />
                            <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->Make Order</button>
                <!--end::Filter-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        @livewire('admin::orders.orders-list',['customer_id'=>$customer->id])        
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>