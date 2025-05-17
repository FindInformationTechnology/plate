@extends('admin::layouts.master')

@section('content')

<style>
.hidden {
    display: none;
}
</style>

<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3  py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Product Form</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->

                    @include('admin::partials.breadcrumb', [
                    'breadcrumbs' => [
                    ['text' => 'Dashboard', 'url' => route('admin.dashboard')],
                    ['text' => 'Products', 'url' => '#'],

                    ]
                    ])

                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->

            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid mb-10">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Form-->
                <form class="form d-flex flex-column flex-lg-row" method="POST" enctype="multipart/form-data"
                    action="{{ route('admin.products.store') }}">
                    @csrf
                    <!--begin::Aside column-->

                    <!--end::Aside column-->
                    <!--begin::Main column-->
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                        <!--begin::Tab content-->

                        <!--begin::Tab pane-->
                        <div class="d-flex flex-column gap-7 gap-lg-10">

                            <!--begin::Category & tags-->
                            <div class="card card-flush py-4">

                                <!--begin::Card header-->
                                <div class="card-header">

                                    <div class="card-title">
                                        <h4>Store</h4>
                                    </div>


                                </div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <!--begin::Label-->
                                    <!-- <label class="form-label">Categories</label> -->
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select mb-2" name="store_id" data-control="select2"
                                        data-placeholder="Select an option" data-hide-search="true">
                                        <option></option>
                                        @foreach ($stores as $store)

                                        @include('admin::partials.select', [
                                        'option_id' => $store->id,
                                        'name' => $store->name

                                        ])
                                        @endforeach

                                    </select>
                                    <!--end::Select2-->

                                    <!--end::Input group-->

                                    <!--end::Input group-->
                                </div>
                                <!--end::Card body-->

                            </div>
                            <!--end::Category & tags-->

                            <!--begin::Category & tags-->
                            <div class="card card-flush py-4">

                                <!--begin::Card header-->
                                <div class="card-header">

                                    <div class="card-title">
                                        <h4>Condition</h4>
                                    </div>


                                </div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <!--begin::Label-->
                                    <!-- <label class="form-label">Categories</label> -->
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select mb-2" name="condition_id" data-control="select2"
                                        data-placeholder="Select an option" data-hide-search="true">
                                        <option></option>
                                        @foreach ($conditions as $condition)

                                        @include('admin::partials.select', [
                                        'option_id' => $condition->id,
                                        'name' => $condition->name

                                        ])
                                        @endforeach

                                    </select>
                                    <!--end::Select2-->

                                    <!--end::Input group-->

                                    <!--end::Input group-->
                                </div>
                                <!--end::Card body-->

                            </div>
                            <!--end::Category & tags-->

                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h4>Category</h4>
                                    </div>
                                    <!--end::Card title-->

                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Select2-->
                                    <select class="form-select mb-2" data-control="select2" name="category_id"
                                        data-placeholder="Select an option" id="category_id" required>
                                        <option></option>
                                        @foreach ($categories as $category)
                                        @include(
                                        'admin::pages.products.include.category_children',
                                        [
                                        'category' => $category,
                                        'category_id' => null,
                                        'level' => 1
                                        ]
                                        )
                                        @endforeach
                                    </select>
                                    <!--end::Select2-->

                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Status-->
                            <!--begin::Category & tags-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h4>Brand</h4>
                                    </div>
                                    <!--end::Card title-->

                                </div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->

                                    <select class="form-select mb-2" data-control="select2" name="brand_id"
                                        data-hide-search="true" data-placeholder="Select an option" id="" required>
                                        <option></option>
                                        @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>

                                        @endforeach

                                    </select>
                                    <!--end::Select2-->

                                    <!--end::Input group-->

                                    <!--end::Input group-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Category & tags-->

                            <!--begin::Category & tags-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h4>Unit</h4>
                                    </div>
                                    <!--end::Card title-->

                                </div>
                                <!--end::Card header-->

                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <!--begin::Label-->
                                    <!-- <label class="form-label">Categories</label> -->
                                    <!--end::Label-->
                                    <!--begin::Select2-->
                                    <select class="form-select mb-2" data-control="select2" name="unit_id"
                                        data-hide-search="true" data-placeholder="Select an option" id="" required>
                                        <option></option>
                                        @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>

                                        @endforeach

                                    </select>
                                    <!--end::Select2-->

                                    <!--end::Input group-->

                                    <!--end::Input group-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Category & tags-->
                            <!--begin::General options-->
                            <div class="card card-flush py-4">

                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body py-3">
                                    <!--begin::Input group-->
                                    @foreach (Config('app.accepted_locales') as $key => $value)

                                    <div class="mb-10 fv-row">
                                        <!--begin::Label-->
                                        <label class="required form-label">Product Name
                                            {{ $value }}</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="name[{{ $key }}]" class="form-control mb-2"
                                            placeholder="Product name" value="" required />
                                        <!--end::Input-->

                                    </div>
                                    <!--end::Input group-->
                                    @endforeach
                                    <!--begin::Input group-->

                                    @foreach (Config('app.accepted_locales') as $key => $value)
                                    <div class="mb-10 ">
                                        <!--begin::Label-->
                                        <label class="form-label">Summary {{ $value }}</label>
                                        <!--end::Label-->
                                        <!--begin::Editor-->

                                        <textarea class="form-control" name="summary[{{$key}}]"
                                            aria-label="With textarea"></textarea>
                                        <!--end::Editor-->
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--end::Input group-->
                                    @endforeach
                                    <!--begin::Input group-->
                                    @foreach (Config('app.accepted_locales') as $key => $value)
                                    <div class="mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label">Description {{ $value }}</label>
                                        <!--end::Label-->
                                        <!--begin::Editor-->

                                        <textarea class="form-control" name="description[{{$key}}]"
                                            aria-label="With textarea"></textarea>
                                        <!--end::Editor-->
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--end::Input group-->
                                    @endforeach
                                </div>
                                <!--end::Card header-->
                            </div>
                            <!--end::General options-->

                            <!--begin::Pricing-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->

                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->

                                    <!--begin::Tax-->
                                    <div class="mb-10 d-flex flex-wrap gap-5 pt-4">
                                        @include('admin::partials.text_input', [
                                        'label' => 'Model Number',
                                        'name' => 'model_number',
                                        'value' => old('model_number', ''),
                                        'required' => true
                                        ])
                                        <!--end:Tax-->

                                        <!--begin::Tax-->
                                        <!--begin::Input group-->


                                        @include('admin::partials.text_input', [
                                        'label' => 'Maximum Quantity',
                                        'name' => 'maximum_quantity',
                                        'value' => old('maximum_quantity', ''),
                                        'required' => true
                                        ])
                                    </div>
                                    <div class="mb-10 d-flex flex-wrap gap-5">
                                        <!--end::Input group-->
                                        <!--begin::Input group-->


                                        @include('admin::partials.text_input', [
                                        'label' => 'Minimum Quantity',
                                        'name' => 'minimum_quantity',
                                        'value' => old('minimum_quantity', ''),
                                        'required' => true
                                        ])


                                        @include('admin::partials.text_input', [
                                        'label' => 'MPN Code',
                                        'name' => 'mpn',
                                        'value' => old('mpn', ''),
                                        'required' => false
                                        ])
                                        <!--end::Input group-->
                                    </div>
                                    <!--end:Tax-->
                                    <!--end::Input group-->


                                    <!--begin::Tax-->
                                    <div class="d-flex flex-wrap gap-5">
                                        <!--begin::Input group-->

                                        @include('admin::partials.text_input', [
                                        'label' => 'GTIN Code',
                                        'name' => 'gtin',
                                        'value' => old('gtin', ''),
                                        'required' => false
                                        ])

                                        <!--begin::Input group-->

                                        <div class="fv-row w-100 flex-md-root">
                                            <!--begin::Label-->
                                            <label class=" form-label">Featured video</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="file" class="form-control mb-2" name="featured_video">
                                            <!--end::Input-->
                                        </div>

                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->

                                    <!--end::Input group-->


                                </div>
                                <!--end::Card header-->
                            </div>
                            <!--end::Pricing-->

                            <!--begin::Pricing-->
                            <div class="card card-flush py-4 gap-5" id="variations">
                                <div class="card-header">
                                    <div class="card-title">

                                        <label class="form-label">Product Type</label>


                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <div class="d-flex flex-wrap gap-5">


                                        <label>
                                            <input type="radio" name="type" value="single"
                                                {{ old('type', 'single') === 'single' ? 'checked' : '' }}> Single
                                        </label>
                                        <label>
                                            <input type="radio" name="type" value="variable"
                                                {{ old('type') === 'variable' ? 'checked' : '' }}> Variable
                                        </label>
                                        <!-- </div> -->
                                    </div>

                                </div>



                                <!--begin::Card body-->
                                <div class="card-body pt-0 ">
                                    <!--begin::Input group-->
                                    <div class="" id="kt_ecommerce_add_product">
                                        <!--begin::Label-->
                                        <label class="form-label">Add Product Variations</label>
                                        <!--end::Label-->
                                        <!--begin::Repeater-->
                                        <div id="">
                                            <!--begin::Form group-->
                                            <div class="form-group">
                                                <div class="d-flex flex-column gap-3">

                                                    <div data-repeater-item=""
                                                        class="form-group d-flex flex-wrap align-items-center gap-5"
                                                        id="dynamiccheckbox">

                                                    </div>

                                                </div>

                                                <select name="choice_attributes[]" id="choice_attributes"
                                                    class="form-control choice_attributes" data-control="select2"
                                                    data-live-search="true" multiple="multiple"
                                                    data-placeholder="Choose Attributes">

                                                </select>
                                            </div>
                                            <div class="form-group mt-3 gap-5">
                                                <div class="customer_choice_options" id="customer_choice_options">

                                                </div>
                                            </div>
                                            <!--end::Form group-->
                                        </div>
                                        <!--end::Repeater-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Card header-->



                            </div>

                            <!--begin::Inventory-->
                            <div id="product_varient">



                            </div>

                            <!--end::Tab content-->
                            <div class="d-flex justify-content-end">
                                <!--begin::Button-->
                                <a href="{{ route('admin.products.index') }}" class="btn btn-light me-5">Cancel</a>
                                <!--end::Button-->
                                <!--begin::Button-->
                                <button type="submit" class="btn btn-primary">
                                    <span class="indicator-label">Save Product</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <!--end::Button-->
                            </div>
                        </div>
                    </div>

                    <!--end::Main column-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>

</div>
<!--end:::Main-->


@endsection

@push('scripts')

<script src="{{ asset('assets/dashboard-assets/js/custom/apps/ecommerce/catalog/products.js') }}"></script>

<script src="{{ asset('assets/dashboard-assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>



<script>
$(document).on('click', '.product_varient_item', function() {
    // Find the closest parent with the class "product_variant" and remove it
    var productVariantCount = $('.product_variant').length;

    if (productVariantCount > 1) {
        $(this).closest('.product_variant').remove();

    } else {
        alert('Cannot delete the last product variant.');
    }

});

$(document).ready(function() {

    var local = <?php echo json_encode(config('app.locale')) ?>;

    // var singleType = document.getElementById('single');
    // var variantType = document.getElementById('variant');

    // if (singleType.checked)
    //     $('#kt_ecommerce_add_product').addClass('hidden');


    // singleType.addEventListener('click', function() {
    //     $('#kt_ecommerce_add_product').addClass('hidden');
    // });

    // variantType.addEventListener('click', function() {
    //     $('#kt_ecommerce_add_product').removeClass('hidden');
    // });

    // var tabs = document.querySelectorAll('a[data-bs-toggle="tab"]');
    $('.choice_attributes').select2();

    function choiceOptions() {
        $('#customer_choice_options .choice_options').select2();

        // const choiceOptions = document.querySelectorAll('.choice_options');

        var data = $('.choice_options').select2("val");
        // $data = $(choiceOptions).find('select');
    }

    let combinations = [];




    $('#category_id').change(function() {

        category_id = $(this).val();

        if (category_id) {

            // alert(category_id);

            $.ajax({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: "{{ route('admin.fetch.category.attributes') }}",
                data: {
                    category_id: category_id
                },
                success: function(data) {

                    if (data.length > 0) {

                        // console.log(data);
                        $('#variations').removeClass('hidden');


                        var attrbitesContainer = $('#choice_attributes');

                        attrbitesContainer.empty();

                        var options = [];

                        data.forEach(item => {

                            options += '<option value="' + item.id + '"> ' + item
                                .name[local] + ' </option>';

                        });

                        attrbitesContainer.append(options).change();

                    } else {
                        console.log('there is now category attribute');
                        $('#variations').addClass('hidden');

                    }

                },
                error: function() {

                    alert('Failed to fetch data');

                }

            });


        };

    });

    // $('#product_varient').empty();

    if (combinations.length < 1) {
        $('#product_varient').empty();
        $('#product_varient').html(createHtmlView());
    }

    // Generate HTML for product variants
    function createHtmlView(index = 0, ids = null, text = 'product') {
        return `
            <div class="card card-flush py-4 mt-3 product_variant">
                <div class="card-body pt-0">
                    <div class="form-group row mt-5">
                        <div class="col-6 mt-3">
                            <input type="hidden" name="choice_attr_val[]" value="${ids}">
                            <label class="required form-label text-uppercase" style="text-transform: uppercase">
                                ${text.slice(0, -1)}
                            </label>
                        </div>
                        <div class="col-6 mt-3">
                            <button type="button" class="btn btn-danger f-left product_varient_item">remove</button>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="form-label required">Featured image</label>
                            <input type="file" class="form-control mb-2" name="featured_image[]" required>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="form-label required">SKU</label>
                            <input type="text" class="form-control" name="sku[]" placeholder="SKU" required>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="form-label">Barcode</label>
                            <input type="text" class="form-control" name="barcode[]" placeholder="Barcode">
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="form-label required">Cost Price</label>
                            <input type="text" class="form-control" name="cost_price[]" placeholder="Cost Price" required>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="form-label required">Price</label>
                            <input type="text" class="form-control" name="price[]" placeholder="Price" required>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="form-label">Discount Price</label>
                            <input type="text" class="form-control" name="sale_price[]" placeholder="Discount Price">
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="form-label">Quantity</label>
                            <input type="text" class="form-control" name="qty[]" placeholder="Quantity" required>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="form-label">Multi images</label>
                            <input type="file" class="form-control mb-2" name="multi_images[${index}][]" multiple>
                        </div>
                    </div>
                </div>
            </div>`;
    }

    function appendCombinationValues(combinations) {
        let containerVarientProducts = $('#product_varient');
        let containerProduct = $('#single-product');
        if (combinations.length > 0) {

            containerVarientProducts.empty();
            containerProduct.empty();

            let index = 0;

            combinations.forEach(innerCombination => {

                // innerCombination.shift();

                // let combinationVarinat = [];
                let ids = '';
                let text = '';

                // concatenate attrbites values
                innerCombination.forEach(value => {

                    value = JSON.parse(value);
                    // console.log(value);
                    // console.log(typeof(value));

                    ids += value.id + '-';
                    text += value.value[local] + '-';

                });


                containerVarientProducts.append(createHtmlView(index, ids, text));

                index++;
            });

        } else {

            containerProduct.empty();

            containerVarientProducts.empty();

            $('#product_varient').html(createHtmlView());
        }
    }

    function combineProperties(properties) {

        if (properties.length === 0)
            return [
                []
            ];

        let firstProperty = properties[0];
        let remainingProperties = properties.slice(1);
        let combinationsOfRemaining = combineProperties(remainingProperties);

        let result = [];
        for (let i = 0; i < firstProperty.length; i++) {
            for (let j = 0; j < combinationsOfRemaining.length; j++) {
                result.push([firstProperty[i], ...combinationsOfRemaining[j]]);
            }
        }

        return result;
    }

    function cearteCombinationAttributeWithValuesOfVarient(data) {

        let properties = [];

        // console.log(data);

        if (data.length > 0) {

            combinations = combineProperties(data);

            appendCombinationValues(combinations);

        }

    }

    function getSelectedValues() {

        // var selectedValues = $('#customer_choice_options .choice_options').find('select');

        let selectedValues = [];

        $('#customer_choice_options .choice_options').each(function() {

            let value = $(this).val();

            if (value && value.length > 0) {
                selectedValues.push(value);
            }
        });

        // console.log(selectedValues);

        cearteCombinationAttributeWithValuesOfVarient(selectedValues);

        // getAllChoiceOptions(selectedValues);

    }

    // Attach change event listener to existing choice_options elements on page load
    $('#customer_choice_options').on('change', '.choice_options', function() {
        getSelectedValues();
    });

    // function add_more_customer_choice_option(i, name, category_id) {

    //     $('#customer_choice_options .attribute_choice').select2();

    //     $.ajax({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         type: 'POST',
    //         url: "{{ route('admin.products.add-more-choice-option') }}",
    //         data: {
    //             attribute_id: i
    //         },
    //         success: function(data) {

    //             let options = '';
    //             for (i = 0; i < data.values.length; i++) {
    //                 // convert object to stringe in option id and value 
    //                 options = options + '<option value=' + JSON.stringify({
    //                     id: data.values[i].id,
    //                     value: data.values[i].value
    //                 }) + '>' + data.values[i].value[local] + '</option>'

    //             }

    //             var inputHtml =
    //                 '\
    //                                                                             <div class="form-group row">\
    //                                                                                 <div class="col-md-3 mt-3">\
    //                                                                                     <input type="hidden" name="attribute" value="attribute_id">\
    //                                                                                     <input type="text" class="form-control" name="choice[]" value="' +
    //                 data.name[local] + '" >\
    //                                                                                 </div>\
    //                                                                                 <div class="col-md-8 mt-3">\
    //                                                                                     <select class="form-control choice_options" data-control="select2" data-live-search="true" name="choice_options" 	multiple="multiple" required>\
    //                                                                                     ' +
    //                 '<option value="">select option</option>' + '\
    //                                                                                     ' + options + '\
    //                                                                                     </select>\
    //                                                                                 </div>\
    //                                                                             </div>';

    //             $('#customer_choice_options').append(inputHtml).trigger('change');

    //             $('#customer_choice_options .choice_options').select2();
    //             // choiceOptions();

    //         },
    //         error: (error) => {
    //             console.log(JSON.stringify(error));
    //         }
    //     });
    // }

    function add_more_customer_choice_option(attributeId, name, categoryId) {
    // Initialize select2 for attribute_choice elements
    $('#customer_choice_options .attribute_choice').select2();

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: "{{ route('admin.products.add-more-choice-option') }}",
        data: {
            attribute_id: attributeId
        },
        success: function(response) {
            const options = response.values.map(value => {
                const optionData = JSON.stringify({ id: value.id, value: value.value });
                return `<option value='${optionData}'>${value.value[local]}</option>`;
            }).join('');

            const inputHtml = `
                <div class="form-group row">
                    <div class="col-md-3 mt-3">
                        <input type="hidden" name="attribute" value="${attributeId}">
                        <input type="text" class="form-control" name="choice[]" value="${response.name[local]}" >
                    </div>
                    <div class="col-md-8 mt-3">
                        <select class="form-control choice_options" data-control="select2" data-live-search="true" name="choice_options" multiple="multiple" required>
                            <option value="">select option</option>
                            ${options}
                        </select>
                    </div>
                </div>
            `;

            $('#customer_choice_options').append(inputHtml).trigger('change');

            // Re-initialize select2 for the new choice_options elements
            $('#customer_choice_options .choice_options').select2();
        },
        error: function(error) {
            console.error('Error:', error);
        }
    });
}


    // choice_attributes
    $('#choice_attributes').on('change', function() {
        $('#customer_choice_options').html(null);
        $.each($("#choice_attributes option:selected"), function() {

            // add attributes options
            add_more_customer_choice_option($(this).val(), $(this).text().trim(), category_id);
        });

    });



});
</script>

@endpush