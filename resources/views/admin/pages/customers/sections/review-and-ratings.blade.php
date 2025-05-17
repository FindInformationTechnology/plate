<div class="tab-pane fade" id="kt_customer_review_and_ratings" role="tabpanel">
    <!--begin::Products-->
    <div class="card card-flush mb-6">
        <!--begin::Card header-->
        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <h3>Product Ratings and Reviews</h3>
                <!--end::Search-->
            </div>
            <!--end::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                <div class="w-100 mw-150px">
                    <!--begin::Select2-->
                    <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Status" data-kt-ecommerce-product-filter="status">
                        <option></option>
                        <option value="all">All</option>
                        <option value="published">Visible</option>
                        <option value="scheduled">Non Visible</option>
                    </select>
                    <!--end::Select2-->
                </div>
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0 table-responsive">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table">
                <!--begin::Table head-->
                <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_products_table .form-check-input" value="1" />
                            </div>
                        </th>
                        <th class="min-w-200px">Customer</th>
                        <th class="text-end min-w-100px">Rate</th>
                        <th class="text-end min-w-70px">Review</th>
                        <th class="text-end min-w-100px">Visibility</th>
                        <th class="text-end min-w-100px">Date</th>
                       
                    </tr>
                    <!--end::Table row-->
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="fw-bold text-gray-600">
                    @foreach ($customer->productReviews as $review)
                    <!--begin::Table row-->
                    <tr>
                        <!--begin::Checkbox-->
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="1" />
                            </div>
                        </td>
                        <!--end::Checkbox-->
                        <!--begin::Category=-->
                        <td>
                            <div class="ms-5">
                                <!--begin::Title-->
                                <a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bolder" data-kt-ecommerce-product-filter="product_name">{{ $review->customer->name }}</a>
                                <!--end::Title-->
                            </div>
                            </div>
                        </td>
                        <!--end::Category=-->

                        <!--begin::Rating-->
                        <td class="text-end pe-0" data-order="rating-{{ $review->id }}">
                            <div class="rating justify-content-end">
                                <div class="rating-label @if($review->rate > 0) checked @endif">
                                    <i class="ki-duotone ki-star fs-1"></i>
                                </div>
                                <div class="rating-label @if($review->rate > 1) checked @endif">
                                    <i class="ki-duotone ki-star fs-1"></i>
                                </div>
                                <div class="rating-label @if($review->rate > 2) checked @endif">
                                    <i class="ki-duotone ki-star fs-1"></i>
                                </div>
                                <div class="rating-label @if($review->rate > 3) checked @endif">
                                    <i class="ki-duotone ki-star fs-1"></i>
                                </div>
                                <div class="rating-label @if($review->rate > 4) checked @endif">
                                    <i class="ki-duotone ki-star fs-1"></i>
                                </div>
                            </div>
                        </td>
                        <!--end::Rating-->

                        <td class="text-end pe-0">
                            <span class="fw-bolder">{{ $review->review }}</span>
                        </td>

                        <td class="text-end pe-0">
                            @if($review->is_visible)
                            <span class="badge badge-light-success">Visible</span>
                            @else
                            <span class="badge badge-light-danger">Not Visible</span>
                            @endif
                        </td>

                        <td class="text-end pe-0">
                            <span class="fw-bolder">{{ $review->created_at }}</span>
                        </td>

                       
                    </tr>
                    @endforeach
                </tbody>
            <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Products-->

    <!--begin::Products-->
    <div class="card card-flush mb-6">
        <!--begin::Card header-->
        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <h3>Store Ratings and Reviews</h3>
                <!--end::Search-->
            </div>
            <!--end::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                <div class="w-100 mw-150px">
                    <!--begin::Select2-->
                    <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Status" data-kt-ecommerce-product-filter="status">
                        <option></option>
                        <option value="all">All</option>
                        <option value="published">Visible</option>
                        <option value="scheduled">Non Visible</option>
                    </select>
                    <!--end::Select2-->
                </div>
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0 table-responsive">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table">
                <!--begin::Table head-->
                <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_products_table .form-check-input" value="1" />
                            </div>
                        </th>
                        <th class="min-w-200px">Customer</th>
                        <th class="text-end min-w-100px">Rate</th>
                        <th class="text-end min-w-70px">Review</th>
                        <th class="text-end min-w-100px">Visibility</th>
                        <th class="text-end min-w-100px">Date</th>
                    </tr>
                    <!--end::Table row-->
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="fw-bold text-gray-600">
                    @foreach ($customer->storeReviews as $review)
                    <!--begin::Table row-->
                    <tr>
                        <!--begin::Checkbox-->
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="1" />
                            </div>
                        </td>
                        <!--end::Checkbox-->
                        <!--begin::Category=-->
                        <td>
                            <div class="ms-5">
                                <!--begin::Title-->
                                <a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bolder" data-kt-ecommerce-product-filter="product_name">{{ $review->customer->name }}</a>
                                <!--end::Title-->
                           
                            </div>
                        </td>
                        <!--end::Category=-->

                        <!--begin::Rating-->
                        <td class="text-end pe-0" data-order="rating-{{ $review->id }}">
                            <div class="rating justify-content-end">
                                <div class="rating-label @if($review->rate > 0) checked @endif">
                                    <i class="ki-duotone ki-star fs-1"></i>
                                </div>
                                <div class="rating-label @if($review->rate > 1) checked @endif">
                                    <i class="ki-duotone ki-star fs-1"></i>
                                </div>
                                <div class="rating-label @if($review->rate > 2) checked @endif">
                                    <i class="ki-duotone ki-star fs-1"></i>
                                </div>
                                <div class="rating-label @if($review->rate > 3) checked @endif">
                                    <i class="ki-duotone ki-star fs-1"></i>
                                </div>
                                <div class="rating-label @if($review->rate > 4) checked @endif">
                                    <i class="ki-duotone ki-star fs-1"></i>
                                </div>
                            </div>
                        </td>
                        <!--end::Rating-->

                        <td class="text-end pe-0">
                            <span class="fw-bolder">{{ $review->review }}</span>
                        </td>

                        <td class="text-end pe-0">
                            @if($review->is_visible)
                            <span class="badge badge-light-success">Visible</span>
                            @else
                            <span class="badge badge-light-danger">Not Visible</span>
                            @endif
                        </td>

                        <td class="text-end pe-0">
                            <span class="fw-bolder">{{ $review->created_at }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Products-->

    
</div>