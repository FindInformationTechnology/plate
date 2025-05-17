<div>
    <div class="card card-flush h-xl-100">
        <!--begin::Card header-->
        <div class="card-header pt-7">
            <!--begin::Title-->
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-gray-800">Store Addresses </span>
                <span class="text-gray-500 mt-1 fw-semibold fs-6"></span>
            </h3>
            <!--end::Title-->
            <!--begin::Actions-->
            <div class="card-toolbar">
                <!--begin::Filters-->
                <div class="d-flex flex-stack flex-wrap gap-4">
                    <!--begin::type-->
                    <div class="d-flex align-items-center fw-bold">
                        <!--begin::Label-->
                        <div class="text-gray-500 fs-7 me-2">Address Type</div>
                        <!--end::Label-->
                        <!--begin::Select-->
                        <select wire:model.live="selected_type" class="form-select form-select-transparent text-gray-900 fs-7 lh-1 fw-bold py-0 ps-3 w-auto" data-hide-search="true" data-dropdown-css-class="w-150px" data-placeholder="Select type" data-kt-table-widget-4="filter_type">
                            <option value="" >Show All</option>
                            
                        </select>
                        <!--end::Select-->
                    </div>
                    <!--end::type-->
                    
                </div>
                <!--begin::Filters-->
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-2 table-responsive">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 fw-bolder gy-5">
            <!--begin::Thead-->
            <thead class="border-bottom border-gray-200 fs-7 text-uppercase fw-bolder">
                <tr class="text-start text-muted gs-0">
                    <th class="min-w-100px">Address Type</th>
                    <th class="min-w-100px">Emirate</th>
                    <th class="min-w-100px">Area</th>
                    <th class="min-w-100px">Street</th>
                    <th class="min-w-100px">Mobile Number</th>
                    <th class="min-w-125px">Date</th>
                </tr>
            </thead>
            <!--end::Thead-->
            <!--begin::Tbody-->
            <tbody class="fs-6 fw-bold text-gray-600">
                @foreach ($store->addresses as $storeAddress)

                <tr>
                    <td>
                        {{ $storeAddress->type?->name }}
                    </td>
                    <td>
                        {{ $storeAddress->address?->emirate->name }}
                    </td>
                    <td class="text-success">{{ $storeAddress->address?->area }}</td>
                    <td class="text-success">{{ $storeAddress->address?->street }}</td>
                    <td>
                        <span class="badge badge-light-info">{{ $storeAddress->address?->mobile_number }}</span>
                    </td>
                    <td>{{$storeAddress->address?->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
            <!--end::Tbody-->
        </table>
            <!--end::Table-->
           {{-- $store->addresses->links() --}} 
        </div>
        <!--end::Card body-->
    </div>

</div>


