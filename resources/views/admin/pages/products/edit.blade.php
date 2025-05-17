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
                        Edit Product </h1>
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
                    action="{{ route('admin.products.update', $variant->id) }}">
                    @csrf
                    @method('put')
                    <!--begin::Aside column-->

                    <input type="hidden" name="product_id" value="{{ $variant->product_id }}">

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
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <h4>Store</h4>
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
                                    <select class="form-select mb-2" data-control="select2" name="store_id"
                                        data-hide-search="true" data-placeholder="Select an option" id="" required>
                                        <option></option>
                                        @foreach ($stores as $store)
                                        <option value="{{ $store->id }}" {{ ($variant->product->store_id == $store->id) ? 'selected' : ''}}>{{ $store->name }}</option>

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
                                        <h4>Condition</h4>
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
                                    <select class="form-select mb-2" data-control="select2" name="condition_id"
                                        data-hide-search="true" data-placeholder="Select an option" id="" required>
                                        <option></option>
                                        @foreach ($conditions as $condition)
                                        <option value="{{ $condition->id }}" {{ ($variant->product->condition_id == $condition->id) ? 'selected' : ''}}>{{ $condition->name }}</option>

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
                                        @include('admin::pages.products.include.category_children', [
                                        'category' => $category,
                                        'category_id' => $variant->product->category_id,
                                        'level' => 1
                                        ])
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
                                        <option value="{{ $brand->id }}"
                                            {{ ($variant->product->brand_id == $brand->id) ? 'selected' : ''}}>
                                            {{ $brand->name }}
                                        </option>

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
                                        <option value="{{ $unit->id }}"
                                            {{ ($variant->product->unit_id == $unit->id) ? 'selected' : ''}}>
                                            {{ $unit->name }}
                                        </option>

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
                                        <label class="required form-label">Product Name {{ $value }}</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" name="name[{{  $key }}]" class="form-control mb-2"
                                            placeholder="Product name"
                                            value="{{ $variant->product->translate('name', $key) }}" />
                                        <!--end::Input-->

                                    </div>
                                    @endforeach
                                    <!--begin::Input group-->

                                    @foreach (Config('app.accepted_locales') as $key => $value)
                                    <div class="mb-10 ">
                                        <!--begin::Label-->
                                        <label class="form-label">Summary {{$value}}</label>
                                        <!--end::Label-->
                                        <!--begin::Editor-->

                                        <textarea class="form-control" name="summary[{{$key}}]"
                                            aria-label="With textarea">{{ $variant->product->translate('summary', $key) }}</textarea>
                                        <!--end::Editor-->
                                        <!--end::Description-->
                                    </div>
                                    <!--end::Input group-->
                                    @endforeach


                                    <!--begin::Input group-->
                                    @foreach (Config('app.accepted_locales') as $key => $value)
                                    <div class="mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label">Description {{$value}}</label>
                                        <!--end::Label-->
                                        <!--begin::Editor-->

                                        <textarea class="form-control" name="description[{{$key}}]"
                                            aria-label="With textarea">{{ $variant->product->translate('description', $key) }}</textarea>
                                        <!--end::Editor-->
                                        <!--end::Description-->
                                    </div>
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
                                        'required' => true,
                                        'value' => old('model_number', $variant->product->model_number),

                                        ])
                                        <!--end:Tax-->

                                        <!--begin::Tax-->
                                        <!--begin::Input group-->


                                        @include('admin::partials.text_input', [
                                        'label' => 'Maximum Quantity',
                                        'name' => 'maximum_quantity',
                                        'value' => old('maximum_quantity', $variant->product->maximum_quantity),
                                        'required' => true
                                        ])
                                    </div>
                                    <div class="mb-10 d-flex flex-wrap gap-5">
                                        <!--end::Input group-->
                                        <!--begin::Input group-->


                                        @include('admin::partials.text_input', [
                                        'label' => 'Minimum Quantity',
                                        'name' => 'minimum_quantity',
                                        'value' => old('minimum_quantity', $variant->product->minimum_quantity),
                                        'required' => true
                                        ])


                                        @include('admin::partials.text_input', [
                                        'label' => 'MPN Code',
                                        'name' => 'mpn',
                                        'required' => false,
                                        'value' => old('mpn', $variant->product->mpn),
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
                                        'required' => false,
                                        'value' => old('gtin', $variant->product->gtin),
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
                                        <!-- <div class="d-flex align-items-center position-relative"> -->
                                        <div class="form-check form-check-custom form-check-solid me-10">
                                            @if($variant->product->type )
                                            <input class="form-check-input  " name="type" type="radio" value=""
                                                id="single" checked />
                                            <label class="form-check-label" for="  ">
                                                {{ $variant->product->type }}
                                            </label>

                                        </div>
                                        @endif

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
                        <!--end::Main column-->
                    </div>
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

<script src="{{ asset('assets/dashboard-assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>

<script>
$(document).ready(function() {

    const local = <?php echo json_encode(config('app.locale')) ?>;

    const values = <?php echo json_encode($variant->attributeValues) ?>;

    const $categoryId = $('#category_id');

    const updatCategoryAttributes = () => {

        const category_id = $categoryId.val();

        if (category_id) {
            getCategoryAttributes(category_id);
        }

    }

    updatCategoryAttributes();

    $categoryId.on('change', updatCategoryAttributes);

    function getCategoryAttributes(category_id) {

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


                    $('#variations').removeClass('hidden');


                    var attrbitesContainer = $('#choice_attributes');

                    attrbitesContainer.empty();

                    var options = [];


                    data.forEach(item => {

                        selected = values.map(item => item.attribute_id).includes(item.pivot
                            .attribute_id) ? 'selected' : '';

                        options +=
                            `<option value="${item.pivot.attribute_id}" ${selected}> ${item.name[local]} </option>`;

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


    }

    function add_more_customer_choice_option(i, name, category_id) {

        // Ensure values is defined somewhere in the broader scope

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: "{{ route('admin.products.add-more-choice-option') }}",
            data: {
                attribute_id: i
            },
            success: function(data) {
                let options = '';
                for (let j = 0; j < data.values.length; j++) {
                    // const selected = values.some(elem => elem.id == data.values[j].id) ? "selected" : "";
                    const selected = values.map(item => item.id).includes(data.values[j].id) ?
                        'selected' : '';
                    // console.log(data.values[j].id);
                    options += `<option value='${JSON.stringify({
                    id: data.values[j].id,
                    value: data.values[j].value
                })}' ${selected}>${data.values[j].value[local]}</option>`;
                }

                var inputHtml = `
                <div class="form-group row">
                    <div class="col-md-3 mt-3">
                        <input type="hidden" name="attribute" value="${i}">
                        <input type="text" class="form-control" name="choice[]" value="${data.name[local]}" >
                    </div>
                    <div class="col-md-8 mt-3">
                        <select class="form-control attribute_choice" data-control="select2" data-live-search="true" name="choice_options[]" required>
                            <option value="">select option</option>
                            ${options}
                        </select>
                    </div>
                </div>`;

                $('#customer_choice_options').append(inputHtml).trigger('change');
                // Optionally, re-initialize select2 here
                $('#customer_choice_options .attribute_choice').select2();

                // getChoiceOptions(values);

                // console.log($attr_values);
            },
            error: function(error) {
                console.log(JSON.stringify(error));
            }
        });
    }

    $('#choice_attributes').on('change', function() {

        $('#customer_choice_options').html(null);

        $.each($("#choice_attributes option:selected"), function() {
            add_more_customer_choice_option($(this).val(), $(this).text().trim(), $categoryId
                .val());
        });



    });

    getChoiceOptions(values);

    function getChoiceOptions(values) {

        let product_varient = $('#product_varient');

        index = 0;
        let ids = text = '';

        values.forEach(item => {
            console.log(item.id);
            ids += item.id + '-';
            text += item.value[local] + '-';
        });

        product_varient.append(createHtmlView(index, ids, text));


    }

    // Generate HTML for product variants
    function createHtmlView(index = 0, ids = null, text = 'product') {
        return `
            <div class="card card-flush py-4 mt-3 product_variant">
                <div class="card-body pt-0">
                    <div class="form-group row mt-5">
                        <div class="col-12 mt-3">
                            <input type="hidden" name="choice_attr_val[]" value="${ids}">
                            <label class="required form-label text-uppercase" style="text-transform: uppercase">
                                ${text.slice(0, -1)}
                            </label>
                        </div>
                       
                        <div class="col-md-6 mt-4">
                            <label class="form-label required">Featured image</label>
                            <input type="file" class="form-control mb-2" name="featured_image[]">
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="form-label required">SKU</label>
                            <input type="text" class="form-control" name="sku[]" placeholder="SKU" value="{{$variant->sku}}" required>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="form-label">Barcode</label>
                            <input type="text" class="form-control" name="barcode[]" placeholder="Barcode" value="{{$variant->barcode}}">
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="form-label required">Cost Price</label>
                            <input type="text" class="form-control" name="cost_price[]" placeholder="Cost Price" value="{{$variant->cost_price}}" required>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="form-label required">Price</label>
                            <input type="text" class="form-control" name="price[]" placeholder="Price" value="{{$variant->price}}" required>
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="form-label">Discount Price</label>
                            <input type="text" class="form-control" name="sale_price[]" placeholder="Discount Price" value="{{$variant->sale_price}}">
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="form-label">Quantity</label>
                            <input type="text" class="form-control" name="qty[]" placeholder="Quantity" value="{{$variant->quantity}}" required >
                        </div>
                        <div class="col-md-6 mt-4">
                            <label class="form-label">Multi images</label>
                            <input type="file" class="form-control mb-2" name="multi_images[${index}][]" multiple>
                        </div>
                    </div>
                </div>
            </div>`;
    }

});
</script>



@endpush