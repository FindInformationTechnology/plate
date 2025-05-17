@extends('admin::layouts.master')

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
                        ORDERS</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted text-hover-primary">Orders</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-primary">#{{ $order->id }}</a>
                        </li>
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
                
                <!--begin::Order details page-->
                <div class="d-flex flex-column gap-7 gap-lg-10">
                    <div class="d-flex flex-wrap gap-5 gap-lg-10">
                        <!--begin:::Tabs-->
                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-lg-n2 me-auto">
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_sales_order_summary">Order Summary</a>
                            </li>
                            <!--end:::Tab item-->
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_ecommerce_sales_order_history">Order History</a>
                            </li>
                            <!--end:::Tab item-->
                        </ul>
                        <!--end:::Tabs-->
                    </div>
                    @livewire('admin::orders.order-controls',['order'=>$order])
                   
                    <!--begin::Order summary-->
                    <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                        <!--begin::Order details-->
                        <div class="card card-flush py-4 flex-row-fluid">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Order Details (#{{ $order->id }})</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                        <tbody class="fw-semibold text-gray-600">
                                            
                                            <tr x-data="{ status: '{{$order->status->name}}'}" @order-updated.window="status=$event.detail.status">
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                    <i class="ki-duotone ki-calendar fs-2 me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>Order Status</div>
                                                </td>
                                                <td class="fw-bold text-end" x-text="status" id="status"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                    <i class="ki-duotone ki-calendar fs-2 me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>Date Added</div>
                                                </td>
                                                <td class="fw-bold text-end">{{ $order->created_at }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                    <i class="ki-duotone ki-wallet fs-2 me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                    </i>Payment Method</div>
                                                </td>
                                                <td class="fw-bold text-end"> {{ $order->getPurchasePayment()?->method->name}} 
                                                <!-- <img src="{{ asset('assets/dashboard-assets/media/svg/card-logos/visa.svg') }}" class="w-50px ms-2" /></td> -->
                                            </tr>
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                    <i class="ki-duotone ki-truck fs-2 me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                        <span class="path5"></span>
                                                    </i>Shipping Method</div>
                                                </td>
                                                <td class="fw-bold text-end">-</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!--end::Table-->
                                </div>
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Order details-->
                        <!--begin::Customer details-->
                        <div class="card card-flush py-4 flex-row-fluid">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Customer Details</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                        <tbody class="fw-semibold text-gray-600">
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                    <i class="ki-duotone ki-profile-circle fs-2 me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>Customer</div>
                                                </td>
                                                <td class="fw-bold text-end">
                                                    <div class="d-flex align-items-center justify-content-end">
                                                        <!--begin:: Avatar -->
                                                        <div class="symbol symbol-circle symbol-25px overflow-hidden me-3">
                                                            <a href="#">
                                                                <div class="symbol-label">
                                                                    <img src="{{ asset('assets/dashboard-assets/media/avatars/300-23.jpg') }}" alt="Dan Wilson" class="w-100" />
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <!--end::Avatar-->
                                                        <!--begin::Name-->
                                                        <a href="#" class="text-gray-600 text-hover-primary">{{ $order->customer->name }}</a>
                                                        <!--end::Name-->
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                    <i class="ki-duotone ki-sms fs-2 me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>Email</div>
                                                </td>
                                                <td class="fw-bold text-end">
                                                    <a href=" # #" class="text-gray-600 text-hover-primary">{{ $order->customer->email }}</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                    <i class="ki-duotone ki-phone fs-2 me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>Phone</div>
                                                </td>
                                                <td class="fw-bold text-end">{{ $order->customer->mobile_number }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                    <i class="ki-duotone ki-phone fs-2 me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>Joined at</div>
                                                </td>
                                                <td class="fw-bold text-end">{{ $order->customer->created_at }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!--end::Table-->
                                </div>
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Customer details-->
                        <!--begin::Documents-->
                        <div class="card card-flush py-4 flex-row-fluid">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Invoice and Shipping</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                        <tbody class="fw-semibold text-gray-600">
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                    <i class="ki-duotone ki-devices fs-2 me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                        <span class="path5"></span>
                                                    </i>Invoice 
                                                    <span class="ms-1" data-bs-toggle="tooltip" title="View the invoice generated by this order.">
                                                        <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i>
                                                    </span></div>
                                                </td>
                                                <td class="fw-bold text-end">
                                                    <a href="{{ route('admin.invoices.order-invoice',$order->getPurchasePayment()?->id) }}" class="text-gray-600 text-hover-primary">#{{ $order->getPurchasePayment()?->id }}</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                    <i class="ki-duotone ki-devices fs-2 me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                        <span class="path5"></span>
                                                    </i>Payment Status
                                                    <span class="ms-1" data-bs-toggle="tooltip" title="View the invoice generated by this order.">
                                                        <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i>
                                                    </span></div>
                                                </td>
                                                <td class="fw-bold text-end">
                                                    {{ $order->getPurchasePayment()?->status->name }}</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                    <i class="ki-duotone ki-truck fs-2 me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                        <span class="path5"></span>
                                                    </i>Shipping 
                                                    <span class="ms-1" data-bs-toggle="tooltip" title="View the shipping manifest generated by this order.">
                                                        <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i>
                                                    </span></div>
                                                </td>
                                                <td class="fw-bold text-end">
                                                    <a href="#" class="text-gray-600 text-hover-primary">-</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted">
                                                    <div class="d-flex align-items-center">
                                                    <i class="ki-duotone ki-discount fs-2 me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>CashBack 
                                                    <span class="ms-1" data-bs-toggle="tooltip" title="Reward value earned by customer when purchasing this order">
                                                        <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i>
                                                    </span></div>
                                                </td>
                                                <td class="fw-bold text-end">-</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!--end::Table-->
                                </div>
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Documents-->
                    </div>
                    <!--end::Order summary-->
                    <!--begin::Tab content-->
                    <div class="tab-content">
                        <!--begin::Tab pane-->
                        <div class="tab-pane fade show active" id="kt_ecommerce_sales_order_summary" role="tab-panel">
                            <!--begin::Orders-->
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                                    <!--begin::Payment address-->
                                    <div class="card card-flush py-4 flex-row-fluid position-relative">
                                        <!--begin::Background-->
                                        <div class="position-absolute top-0 end-0 bottom-0 opacity-10 d-flex align-items-center me-5">
                                            <i class="ki-solid ki-two-credit-cart" style="font-size: 14em"></i>
                                        </div>
                                        <!--end::Background-->
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Billing Address</h2>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">{{ $order->address->emirate->name }}
                                        <br />{{ $order->address->area }},
                                        <br />{{ $order->address->street }},
                                        <br />{{ $order->address->mobile_number }}.</div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Payment address-->
                                    <!--begin::Shipping address-->
                                    <div class="card card-flush py-4 flex-row-fluid position-relative">
                                        <!--begin::Background-->
                                        <div class="position-absolute top-0 end-0 bottom-0 opacity-10 d-flex align-items-center me-5">
                                            <i class="ki-solid ki-delivery" style="font-size: 13em"></i>
                                        </div>
                                        <!--end::Background-->
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Shipping Address</h2>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">{{ $order->address->emirate->name }}
                                        <br />{{ $order->address->area }},
                                        <br />{{ $order->address->area }},
                                        <br />{{ $order->address->area }},.</div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Shipping address-->
                                </div>
                                <!--begin::Product List-->
                                <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Order #{{ $order->id }}</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                                <thead>
                                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                                        <th class="min-w-175px">Product</th>
                                                        <th class="min-w-100px text-end">SKU</th>
                                                        <th class="min-w-70px text-end">Qty</th>
                                                        <th class="min-w-100px text-end">Unit Price</th>
                                                        <th class="min-w-100px text-end">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="fw-semibold text-gray-600">
                                                    @foreach ($order->items as $item)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <!--begin::Thumbnail-->
                                                                <a href="#" class="symbol symbol-50px">
                                                                    <span class="symbol-label" style="background-image:url(assets/dashboard-assests/media/stock/ecommerce/1.png);"></span>
                                                                </a>
                                                                <!--end::Thumbnail-->
                                                                <!--begin::Title-->
                                                                <div class="ms-5">
                                                                    <a href="apps/ecommerce/catalog/edit-product.html" class="fw-bold text-gray-600 text-hover-primary">{{ $item->variant->product->name }}</a>
                                                                    <div class="fs-7 text-muted">Delivery Date: -</div>
                                                                </div>
                                                                <!--end::Title-->
                                                            </div>
                                                        </td>
                                                        <td class="text-end">{{ $item->variant->sku }}</td>
                                                        <td class="text-end">{{ $item->quantity }}</td>
                                                        <td class="text-end">AED {{ $item->sale_price }}</td>
                                                        <td class="text-end">AED {{ $item->total }}</td>
                                                    </tr>
                                                    @endforeach
                                                    
                                                    
                                                    <tr>
                                                        <td colspan="4" class="text-end">Subtotal</td>
                                                        <td class="text-end">AED {{ $order->sub_total }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" class="text-end">Discount</td>
                                                        <td class="text-end">AED {{ $order->discount_amount }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" class="text-end">Shipping </td>
                                                        <td class="text-end">AED {{ $order->shipping_fees }}</td>
                                                    </tr>
                                                    @if($order->cod)
                                                    <tr>
                                                        <td colspan="4" class="text-end">CoD Fees</td>
                                                        <td class="text-end">{{ $order->cod_fees }}</td>
                                                    </tr>
                                                    @endif
                                                    <tr>
                                                        <td colspan="4" class="fs-3 text-gray-900 text-end">Grand Total</td>
                                                        <td class="text-gray-900 fs-3 fw-bolder text-end">AED {{ $order->total_amount }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Product List-->
                            </div>
                            <!--end::Orders-->
                        </div>
                        <!--end::Tab pane-->
                        <!--begin::Tab pane-->
                        <div class="tab-pane fade" id="kt_ecommerce_sales_order_history" role="tab-panel">
                            <!--begin::Orders-->
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <!--begin::Order history-->
                                <livewire:admin::orders.order-history :order="$order" >
                                <!--end::Order history-->
                                
                            </div>
                            <!--end::Orders-->
                        </div>
                        <!--end::Tab pane-->
                    </div>
                    <!--end::Tab content-->
                </div>
                <!--end::Order details page-->

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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
@endpush