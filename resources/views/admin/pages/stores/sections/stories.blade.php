<div>
    <!--begin::Products-->
    <div class="card card-flush">
        <!--begin::Card header-->
        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
            <h3 class="card-title"> Ongoing Stories </h3>
            <!--begin::Card toolbar-->
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                <div class="w-100 mw-150px">
                    <!--begin::Select2-->
                    <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="story type" data-kt-ecommerce-product-filter="story_type">
                        <option></option>
                        <option value="all">All</option>
                        @foreach ($storyTypes as $type)
                        <option value="{{$type}}">{{$type}}</option>
                        @endforeach

                    </select>
                    <!--end::Select2-->
                </div>
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Table-->
            <div class="table-responsive">
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
                            <th class="text-end min-w-70px">Source</th>
                            <th class="text-end min-w-70px">Type</th>
                            <th class="text-end min-w-70px">Views</th>
                            <th class="text-end min-w-100px">Visibility</th>
                            <th class="text-end min-w-100px">Date</th>
                            <th class="text-end min-w-70px">Actions</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="fw-bold text-gray-600">
                        @foreach ($store->stories()->ongoing()->get() as $story)
                        <!--begin::Table row-->
                        <tr>
                            <!--begin::Checkbox-->
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="1" />
                                </div>
                            </td>
                            <!--end::Checkbox-->
                            <!--begin::type -->
                            <td>
                           <!--begin:: Avatar -->
                           <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                <a href="#"  data-bs-toggle="modal" data-bs-target="#kt_modal_{{$story->id}}">
                                   
                                    <div class="symbol-label">
                                    @if($story->isImage())
                                        <img src="{{ $story->getUrl() }}" alt="{{ $story->name}}" class="w-100" />
                                        @else
                                    <video controls autoplay>
                                        <source src="{{ $story->getUrl() }}" type="video/mp4"  class="w-100" >
                                        Your browser does not support the video tag.
                                    </video>
                                    @endif
                                    </div>
                                    

                                </a>
                            </div>
                            <!--end::Avatar-->
                            <div class="modal bg-white fade" tabindex="-1" id="kt_modal_{{$story->id}}">
                                <div class="modal-dialog modal-fullscreen">
                                    <div class="modal-content shadow-none">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Story Preview</h5>

                                            <!--begin::Close-->
                                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                <span class="svg-icon svg-icon-2x"></span>
                                            </div>
                                            <!--end::Close-->
                                        </div>

                                        <div class="modal-body">
                                        @if($story->isImage())
                                            <img src="{{ $story->getUrl() }}" alt="{{ $story->name}}"  style=" max-height: 100%;width:auto"/>
                                            @else
                                        <video controls autoplay style=" max-height: 100%;width:auto">
                                            <source src="{{ $story->getUrl() }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                        @endif
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            </td>
                            <!--end::type -->


                            <td class="text-end pe-0">
                                <span class="fw-bolder">{{ $story->type }}</span>
                            </td>

                            <td class="text-end pe-0">
                                <span class="fw-bolder">{{ $story->views }}</span>
                            </td>

                            <td class="text-end pe-0">
                                @if($story->is_visible)
                                <span class="badge badge-light-success">Visible</span>
                                @else
                                <span class="badge badge-light-danger">Not Visible</span>
                                @endif
                            </td>

                            <td class="text-end pe-0">
                                <span class="fw-bolder">{{ $story->created_at }}</span>
                            </td>

                            <!--begin::Action=-->
                            <td class="text-end">
                                <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                    <span class="svg-icon svg-icon-5 m-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon--></a>
                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Hide</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu-->
                            </td>
                            <!--end::Action=-->
                        </tr>
                        @endforeach
                    </tbody>
                    <!--end::Table body-->
                </table>
            </div>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Products-->

    <!--begin::Products-->
    <div class="card card-flush my-5">
        <!--begin::Card header-->
        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
            <h3 class="card-title"> Expired Stories </h3>
            <!--begin::Card toolbar-->
            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                <div class="w-100 mw-150px">
                    <!--begin::Select2-->
                    <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="story type" data-kt-ecommerce-product-filter="story_type">
                        <option></option>
                        <option value="all">All</option>
                        @foreach ($storyTypes as $type)
                        <option value="{{$type}}">{{$type}}</option>
                        @endforeach

                    </select>
                    <!--end::Select2-->
                </div>
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Table-->
            <div class="table-responsive">
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
                            <th class="min-w-70px">Type</th>
                            <th class="text-end min-w-70px">Source</th>
                            <th class="text-end min-w-70px">Views</th>
                            <th class="text-end min-w-100px">Visibility</th>
                            <th class="text-end min-w-100px">Date</th>
                            <th class="text-end min-w-70px">Actions</th>
                        </tr>
                        <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="fw-bold text-gray-600">
                        @foreach ($store->stories()->expired()->get() as $story)
                        <!--begin::Table row-->
                        <tr>
                            <!--begin::Checkbox-->
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="1" />
                                </div>
                            </td>
                            <!--end::Checkbox-->
                            <!--begin::type -->
                            <td>
                            <!--begin:: Avatar -->
                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                <a href="#"  data-bs-toggle="modal" data-bs-target="#kt_modal_{{$story->id}}">
                                   
                                    <div class="symbol-label">
                                    @if($story->isImage())
                                        <img src="{{ $story->getUrl() }}" alt="{{ $story->name}}" class="w-100" />
                                        @else
                                    <video controls autoplay>
                                        <source src="{{ $story->getUrl() }}" type="video/mp4"  class="w-100" >
                                        Your browser does not support the video tag.
                                    </video>
                                    @endif
                                    </div>
                                    

                                </a>
                            </div>
                            <!--end::Avatar-->
                            <div class="modal bg-white fade" tabindex="-1" id="kt_modal_{{$story->id}}">
                                <div class="modal-dialog modal-fullscreen">
                                    <div class="modal-content shadow-none">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Story Preview</h5>

                                            <!--begin::Close-->
                                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                <span class="svg-icon svg-icon-2x"></span>
                                            </div>
                                            <!--end::Close-->
                                        </div>

                                        <div class="modal-body">
                                        @if($story->isImage())
                                            <img src="{{ $story->getUrl() }}" alt="{{ $story->name}}"  style=" max-height: 100%;width:auto"/>
                                            @else
                                        <video controls autoplay style=" max-height: 100%;width:auto">
                                            <source src="{{ $story->getUrl() }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                        @endif
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            </td>
                            <!--end::type -->


                            <td class="text-end pe-0">
                                <span class="fw-bolder">{{ $story->type }}</span>
                            </td>

                            <td class="text-end pe-0">
                                <span class="fw-bolder">{{ $story->views }}</span>
                            </td>

                            <td class="text-end pe-0">
                                @if($story->is_visible)
                                <span class="badge badge-light-success">Visible</span>
                                @else
                                <span class="badge badge-light-danger">Not Visible</span>
                                @endif
                            </td>

                            <td class="text-end pe-0">
                                <span class="fw-bolder">{{ $story->created_at }}</span>
                            </td>

                            <!--begin::Action=-->
                            <td class="text-end">
                                <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                    <span class="svg-icon svg-icon-5 m-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon--></a>
                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Hide</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" data-kt-ecommerce-product-filter="delete_row">Delete</a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu-->
                            </td>
                            <!--end::Action=-->
                        </tr>
                        @endforeach
                    </tbody>
                    <!--end::Table body-->
                </table>
            </div>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Products-->
</div>