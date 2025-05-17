
<div class="tab-pane fade" id="kt_customer_referrals" role="tabpanel">
                <!--begin::Card-->
                <div>
                    <div class="card">
                        <!--begin::Card header-->
                        <div class="card-header border-0 pt-6">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <!--begin::Search-->
                                <div class="d-flex align-items-center position-relative my-1">
                                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <input wire:model.live="search" type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-350px ps-13" placeholder="Search by customer by name" />
                                </div>
                                <!--end::Search-->
                            </div>
                            <!--begin::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0 table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                                <thead>
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th class="w-10px pe-2">
                                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_table_users .form-check-input" value="1" />
                                            </div>
                                        </th>
                                        <th class="min-w-125px">ID</th>
                                        <th class="min-w-125px">Referee </th>
                                        <th class="min-w-125px">Amount</th>
                                        <th class="min-w-125px">Date</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-semibold">
                                    @foreach ($customer->referrals as $customerReferral)
                                    <tr>
                                        <td>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="1" />
                                            </div>
                                        </td>
                                        <td class="align-items-center">

                                            <a href="" class="text-gray-800 text-hover-primary mb-1">{{ $customerReferral->id }}</a>

                                        </td>
                                        <td class="align-items-center">

                                            <a href="{{ route('admin.customers.show',  $customerReferral->referee) }}" class="text-gray-800 text-hover-primary mb-1">{{ $customerReferral->referee->name }}</a>

                                        </td>

                                        <td>
                                            {{ $customerReferral->amount  }}
                                        </td>
                                        <td>{{ $customerReferral->created_at }}</td>

                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>

                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                </div>

                <!--end::Card-->
</div>