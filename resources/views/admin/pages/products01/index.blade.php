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
                <!--begin::Products-->
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <input type="text" data-kt-ecommerce-product-filter="search"
                                    class="form-control   w-250px ps-12"
                                    placeholder="Search Product" />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <div class="w-100 mw-150px">
                                <!--begin::Select2-->
                                <select class="form-select form-select-solid" data-control="select2"
                                    data-hide-search="true" data-placeholder="Status"
                                    data-kt-ecommerce-product-filter="status">
                                    <option></option>
                                    <option value="all">All</option>
                                    <option value="published">Published</option>
                                    <option value="scheduled">Scheduled</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                <!--end::Select2-->
                            </div>
                            <!--begin::Add product-->
                            <!-- <a href="{{ route ('admin.products.create') }}" class="btn btn-primary">Add Product</a> -->
                            <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_create_app">Create</a>
                            <!--end::Add product -->
                        </div>
                        <!-- end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0 table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_products_table">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                data-kt-check-target="#kt_ecommerce_products_table .form-check-input"
                                                value="1" />
                                        </div>
                                    </th>
                                    <th class="min-w-200px">Product</th>
                                    <th class="text-end min-w-100px">SKU</th>
                                    <th class="text-end min-w-70px">Qty</th>
                                    <th class="text-end min-w-100px">Price</th>

                                    <th class="text-end min-w-100px">Status</th>
                                    <th class="text-end min-w-70px">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($variants as $product)


                                    <tr>
                                        <td>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="1" />
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <!--begin::Thumbnail-->
                                                <!-- <a href="" class="symbol symbol-50px">
                                                    <span class="symbol-label"
                                                        style="background-image:url('/assets/dashboard-assets/media/stock/ecommerce/1.png');"></span>
                                                </a> -->
                                                <!--end::Thumbnail-->
                                                <div class="ms-5">
                                                    <!--begin::Title-->
                                                    <a href="" class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                        data-kt-ecommerce-product-filter="product_name">{{ $product->name }}</a>
                                                    <!--end::Title-->
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end pe-0">
                                            <span class="fw-bold">{{ $product->sku }}</span>
                                        </td>
                                        <td class="text-end pe-0" data-order="16">
                                            <span class="fw-bold ms-3">{{ $product->quantity }}</span>
                                        </td>
                                        <td class="text-end pe-0">{{  $product->price  }}

                                        </td>

                                        <td class="text-end pe-0" data-order="Published">
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-success">Published</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end">
                                            <a href="#"
                                                class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                                                <i class="ki-duotone ki-down fs-5 ms-1"></i></a>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                                        class="menu-link px-3">Edit</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <!-- <a href="#" class="menu-link px-3"
                                                        data-kt-ecommerce-product-filter="delete_row">Delete</a> -->
                                                    <div class="menu-item px-3">
                                                        <form
                                                            action="{{ route('admin.products.destroy', $product->id) }}"
                                                            method="POST">
                                                            <button type="submit" class="menu-link px-3">Delete</button>
                                                            @csrf
                                                            @method('delete')
                                                        </form>
                                                    </div>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu-->
                                        </td>
                                    </tr>

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

@include('admin::pages.products.model')


@endsection

@push('scripts')
<script src="{{ asset('assets/dashboard-assets/js/custom/apps/ecommerce/catalog/products.js') }}"></script>


    <script src="{{ asset('assets/dashboard-assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>

    <script>
        $(document).ready(function () {

            var category_id = '';

            $('#category_id').change(function () {
                category_id = $(this).val();
            });

            $('.choice_attributes').select2();

            let combinations = [];

            const chechSwitchVariant = $('#chechSwitchVariant');
            const kt_ecommerce_add_product = $('#kt_ecommerce_add_product');

            // display variant options 
            // function toggleDisplay() {
            //     if (chechSwitchVariant.is(":checked")) {
            //         kt_ecommerce_add_product.removeClass('d-none')
            //     } else {
            //         if(!kt_ecommerce_add_product.hasClass('d-none')) {
            //             // remove variant options
            //             $('#customer_choice_options').empty();
            //             kt_ecommerce_add_product.addClass('d-none');
            //         }

            //     }
            // }


            // chechSwitchVariant.change(toggleDisplay);

            // toggleDisplay();

            var currentStep = 1;
            var totalSteps = $('.step').length;
            var steps = $('.step');

            function combineProperties(properties) {
                // console.log(properties);
                if (properties.length === 0)
                    return [[]];

                let firstProperty = properties[0];
                let remainingProperties = properties.slice(1);
                let combinationsOfRemaining = combineProperties(remainingProperties);

                let result = [];
                for (let i = 0; i < firstProperty.length; i++) {
                    for (let j = 0; j < combinationsOfRemaining.length; j++) {
                        result.push([firstProperty[i], ...combinationsOfRemaining[j]]);
                    }
                }
                //   console.log(result);
                return result;
            }


            function cearteCombinationAttributeWithValuesOfVarient(data) {

                let properties = []

                if (data.length > 0) {

                    combinations = combineProperties(data);

                }

            }

            // save data to loacal storage function
            function saveVariantDataLocalStorage(currentStep) {

                // get select attributes and values from variants options
                var stepData = $(steps[currentStep]).find('select');

                let data = [];

                let ValuesObjects = [];
                stepData.each(function () {
                    var input = $(this);

                    var attributeValues = input.val();

                    let ValuesObjects = attributeValues.map(value => {
                        return JSON.parse(value);
                    });

                    data.push(ValuesObjects);
                    console.log(data);
                    
                });
                
                data.shift();
                console.log(data);

                cearteCombinationAttributeWithValuesOfVarient(data);

            }
            // end save data to loacal storage 

            // appendVarient
            function createHtmlView(ids = null, text = 'product ') {

                let html = '<div class="form-group row mt-5"><div class="col-12 mt-3">\
                                                                               <input type="hidden" name="choice_attr_val[]" value="' + ids + '">\
                                                                                   <label class="required form-label text-uppercase" style="text-transform: uppercase">'+ text.slice(0, -1) + '</label>\
                                                                               </div>\
                                                                                <div class="col-md-6 mt-3">\
                                                                                     <input type="text" class="form-control" name="sku[]"  placeholder="SKU" >\
                                                                                </div>\
                                                                                <div class="col-md-6 mt-3">\
                                                                                     <input type="text" class="form-control" name="barcode[]"  placeholder="Barcode" >\
                                                                                </div>\
                                                                                <div class="col-md-6 mt-3">\
                                                                                     <input type="text" class="form-control" name="cost_price[]"  placeholder="Cost Price" >\
                                                                                </div>\
                                                                                <div class="col-md-6 mt-3">\
                                                                                     <input type="text" class="form-control" name="price[]"  placeholder="Price" >\
                                                                                </div>\
                                                                                <div class="col-md-6 mt-3">\
                                                                                     <input type="text" class="form-control" name="sale_price[]"  placeholder="Discount Price" >\
                                                                                </div>\
                                                                                <div class="col-md-6 mt-3">\
                                                                                     <input type="text" class="form-control" name="qty[]"  placeholder="Quentity" >\
                                                                                </div>\
                                                                                <div class="col-md-6 mt-3">\
                                                                                     <input type="file" class="form-control mb-2" name="featured_image[]">\
                                                                                </div>\ </div>\
                                                                           ';

                return html;

            }

            function updatecategoryAttributes() {
                if (category_id) {

                    $.ajax({

                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        url: "{{ route('admin.fetch.category.attributes') }}",
                        data: {
                            category_id: category_id
                        },
                        success: function (data) {

                            // $('#step2Data').text('Hello ' + response.greeting);

                            var attrbitesContainer = $('#choice_attributes');

                            attrbitesContainer.empty();

                            var options = [];

                            data.forEach(item => {
                                options += '<option value="' + item.id + '"> ' + item.name.en + ' </option>';
                            });


                            attrbitesContainer.append(options);

                        }, error: function () {
                            alert('Failed to fetch data');
                        }

                    });


                };
            }

            function showStep(step) {
                $('.step').removeClass('active');
                $('#step' + step).addClass('active');

                updatecategoryAttributes();

            }


            $('#next1').click(function () {

                currentStep++;

                showStep(currentStep);

            });

            $('#prev1').click(function () {
                // updatecategoryAttributes
                currentStep--;
                showStep(currentStep);
            });

            $('#next2').click(function () {

                // save the variant data in localstorge 
                saveVariantDataLocalStorage(--currentStep);

                currentStep += 2;
                showStep(currentStep);
                let containerVarientProducts = $('#product_varient');
                let containerProduct = $('#single-product');

                if (combinations.length > 0) {

                    containerVarientProducts.empty();
                    containerProduct.empty();

                    combinations.forEach(innerCombination => {

                        // innerCombination.shift();

                        let combinationVarinat = [];

                        let ids = '';
                        let text = '';

                        // concatenate attrbites values
                        innerCombination.forEach(value => {

                            ids += value.id + '-';
                            text += value.value.en + '-';

                        });

                        containerVarientProducts.append(createHtmlView(ids, text));
                    });

                } else {

                    containerProduct.empty();

                    containerVarientProducts.empty();

                    $('#single-product').html(createHtmlView());
                }

            });

            $('#prev2').click(function () {
                currentStep--;
                showStep(currentStep);
              
               
            });

            // validation for the formm steps
            function validateStep(step) {
                var isValid = true;
                $('#step' + step + ' input').each(function () {
                    if ($(this).val() === '') {
                        isValid = false;

                        toastr.error("Inconceivable!");

                    } else {
                        $(this).removeClass('error');
                    }
                });
                return isValid;
            }

            // submit form proccess
            $('#multiStepForm').submit(function (event) {
                // event.preventDefault();
                alert('Form submitted!');
            });


            // add_more_customer_choice_option
            function add_more_customer_choice_option(i, name, category_id) {

                $('#customer_choice_options .attribute_choice').select2();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ route('admin.products.add-more-choice-option') }}",
                    data: {
                        attribute_id: i
                    },
                    success: function (data) {

                        // console.log(data);

                        let options = '';
                        for (i = 0; i < data.values.length; i++) {
                            // convert object to stringe in option id and value 
                            options = options + '<option value=' + JSON.stringify({ id: data.values[i].id, value: data.values[i].value }) + '>' + data.values[i].value.en + '</option>'

                        }
                        // console.log(options);

                        var inputHtml = '\
                                                                            <div class="form-group row">\
                                                                                <div class="col-md-3 mt-3">\
                                                                                    <input type="hidden" name="attribute" value="attribute_id">\
                                                                                    <input type="text" class="form-control" name="choice[]" value="' + data.name.en + '" >\
                                                                                </div>\
                                                                                <div class="col-md-8 mt-3">\
                                                                                    <select class="form-control attribute_choice" data-control="select2" data-live-search="true" name="choice_options" 	multiple="multiple" required>\
                                                                                    ' + '<option value="">select option</option>' + '\
                                                                                    ' + options + '\
                                                                                    </select>\
                                                                                </div>\
                                                                            </div>';


                        $('#customer_choice_options').append(inputHtml).trigger('change');
                        $('#customer_choice_options .attribute_choice').select2();


                    }, error: (error) => {
                        console.log(JSON.stringify(error));
                    }
                });
            }


            // choice_attributes
            $('#choice_attributes').on('change', function () {
                $('#customer_choice_options').html(null);
                $.each($("#choice_attributes option:selected"), function () {
                    // console.log(category_id);
                    // add attributes options
                    add_more_customer_choice_option($(this).val(), $(this).text().trim(), category_id);
                });

            });







        });
    </script>

 

@endpush