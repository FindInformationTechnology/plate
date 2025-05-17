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
                        Product Form</h1>
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
                <!--begin::Actions-->

            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Form-->
                <form class="form d-flex flex-column flex-lg-row" method="POST" enctype="multipart/form-data"
                    action="{{ route('admin.products.update', $variant->id) }}">
                    @csrf
                    @method('put')


                    <!--begin::Aside column-->
                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">

                        <!--begin::Status-->

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
                                    data-placeholder="Select an option" id="edit_category_id">
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
                                <!--begin::Label-->
                                <!-- <label class="form-label">Categories</label> -->
                                <!--end::Label-->
                                <!--begin::Select2-->
                                <select class="form-select mb-2" data-control="select2" name="brand_id"
                                    data-hide-search="true" data-placeholder="Select an option"
                                    id="kt_ecommerce_add_product_status_select">
                                    <option></option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ ($variant->product->brand_id == $brand->id) ? 'selected' : ''}}>{{ $brand->name }}</option>

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
                                    data-hide-search="true" data-placeholder="Select an option"
                                    id="kt_ecommerce_add_product_status_select">
                                    <option></option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}" {{ ($variant->product->unit_id == $unit->id) ? 'selected' : ''}}>{{ $unit->name }}</option>

                                    @endforeach

                                </select>
                                <!--end::Select2-->

                                <!--end::Input group-->

                                <!--end::Input group-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Category & tags-->


                    </div>
                    <!--end::Aside column-->
                    <!--begin::Main column-->
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <!--begin:::Tabs-->
                        <ul
                            class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2">
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                    href="#kt_ecommerce_add_product_general">General</a>
                            </li>
                            <!--end:::Tab item-->
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                                    href="#kt_ecommerce_add_product_advanced">Advanced</a>
                            </li>
                            <!--end:::Tab item-->
                        </ul>
                        <!--end:::Tabs-->
                        <!--begin::Tab content-->
                        <div class="tab-content">
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general"
                                role="tab-panel">
                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                    <!--begin::General options-->
                                    <div class="card card-flush py-4">

                                        <!-- <div class="card-header">
                                            <div class="card-title">
                                                <h2>General</h2>
                                            </div>
                                        </div> -->
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <input type="text" name="product_id" hidden value="{{ $variant->product->id }}">
                                        <div class="card-body py-3">
                                            <!--begin::Input group-->
                                            @foreach (Config('app.accepted_locales') as  $key => $value)
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">Product Name {{  $value }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="name[{{  $key }}]" class="form-control mb-2"
                                                    placeholder="Product name" value="{{ $variant -> product -> translate('name', $key) }}" />
                                                <!--end::Input-->

                                            </div>
                                            @endforeach
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            @foreach ( Config('app.accepted_locales') as  $key => $value )
                                            <div class="mb-10 ">
                                                <!--begin::Label-->
                                                <label class="form-label">Summary {{$value}}</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->

                                                <textarea class="form-control" name="summary{{$key}}"
                                                    aria-label="With textarea">{{ $variant->product->translate('summary', $key) }}</textarea>
                                                <!--end::Editor-->
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->
                                            @endforeach
                                            <!--begin::Input group-->
                                            @foreach (Config('app.accepted_locales') as  $key => $value)
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
                                            <!--end::Input group-->
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
                                            <div class="mb-10 d-flex flex-wrap gap-5">
                                                <!--begin::Input group-->
                                                <div class="fv-row w-100 flex-md-root">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">Model Number</label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <input type="text" class="form-control mb-2" name="model_number"
                                                        value="{{ $variant->product->model_number }}">
                                                    <!--end::Select2-->

                                                </div>
                                                <!--end::Input group-->

                                            </div>
                                            <!--end:Tax-->

                                            <!--begin::Tax-->
                                            <div class="mb-10 d-flex flex-wrap gap-5">
                                                <!--begin::Input group-->
                                                <div class="fv-row w-100 flex-md-root">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">Minimum Quantity</label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <input type="text" class="form-control mb-2" name="maximum_quantity"
                                                        value="{{ $variant->product->maximum_quantity }}">
                                                    <!--end::Select2-->

                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="fv-row w-100 flex-md-root">
                                                    <!--begin::Label-->
                                                    <label class="form-label">Minimum Quantity</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" name="minimum_quantity" class="form-control mb-2"
                                                        value="{{ $variant->product->minimum_quantity }}" />
                                                    <!--end::Input-->

                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end:Tax-->
                                            <!--end::Input group-->


                                            <!--begin::Tax-->
                                            <div class="d-flex flex-wrap gap-5">
                                                <!--begin::Input group-->
                                                <div class="fv-row w-100 flex-md-root">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">MPN Code</label>
                                                    <!--end::Label-->
                                                    <!--begin::Select2-->
                                                    <input type="text" class="form-control mb-2" name="mpn"
                                                        value="{{ $variant->product->mpn }}">
                                                    <!--end::Select2-->


                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="fv-row w-100 flex-md-root">
                                                    <!--begin::Label-->
                                                    <label class="form-label">GTIN Code</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control mb-2" name="gtin"
                                                        value="{{ $variant->product->gtin }}" />
                                                    <!--end::Input-->

                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->

                                                <!--end::Input group-->
                                            </div>
                                            <!--end:Tax-->
                                            <div class="d-flex flex-wrap gap-5">
                                                <div class="fv-row w-100 flex-md-root">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">Featured video</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->


                                                    <input type="file" class="form-control mb-2" name="featured_video">
                                                    <!--end::Input-->

                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                    </div>
                                    <!--end::Pricing-->

                                    <!--begin::Variations-->
                                    <div class="card card-flush py-4">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Variations <span
                                                        class="form-check form-switch form-check-custom form-check-solid">

                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="chechSwitchVariant" />
                                                    </span></h2>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0 " id="kt_ecommerce_add_product">
                                            <!--begin::Input group-->
                                            <div class="" data-kt-ecommerce-catalog-add-product="auto-options">
                                                <!--begin::Label-->
                                                <label class="form-label">Add Product Variations</label>
                                                <!--end::Label-->
                                                <!--begin::Repeater-->
                                                <div id="kt_ecommerce_add_product">
                                                    <!--begin::Form group-->
                                                    <div class="form-group">
                                                        <div class="d-flex flex-column gap-3">

                                                            <div data-repeater-item=""
                                                                class="form-group d-flex flex-wrap align-items-center gap-5"
                                                                id="dynamiccheckbox">

                                                            </div>

                                                        </div>

                                                        <select name="choice_attributes[]" id="choice_attributes"
                                                            class="form-control choice_attributes"
                                                            data-control="select2" data-live-search="true"
                                                            multiple="multiple" data-placeholder="Choose Attributes">

                                                        </select>
                                                    </div>
                                                    <div class="form-group mt-3 gap-5">
                                                        <div class="customer_choice_options"
                                                            id="customer_choice_options">

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
                                    <!--end::Variations-->

                                </div>
                            </div>
                            <!--end::Tab pane-->
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade" id="kt_ecommerce_add_product_advanced" role="tab-panel">
                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                    <!--begin::Inventory-->

                                    <div class="card card-flush py-4">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Product Inventory</h2>
                                            </div>
                                        </div>
                                        <!--end::Card header-->

                                        <div class="card-body pt-0">
                                            <div class="" id="product_varient">

                                            </div>
                                        </div>

                                    </div>

                                    <!--end::Inventory-->



                                    <!--end::Meta options-->
                                </div>
                            </div>
                            <!--end::Tab pane-->

                            <div class="d-flex justify-content-end">
                                <!--begin::Button-->
                                <a href="apps/ecommerce/catalog/products.html" id="kt_ecommerce_add_product_cancel"
                                    class="btn btn-light me-5">Cancel</a>
                                <!--end::Button-->
                                <!--begin::Button-->
                                <button type="submit" class="btn btn-primary">
                                    <span class="indicator-label">Save Changes</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <!--end::Button-->
                            </div>
                        </div>
                        <!--end::Tab content-->

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

    <script src="{{ asset('assets/dashboard-assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>

    <script>
        $(document).ready(function () {

            var category_id = $('#edit_category_id').val();

            if (category_id) {

                updatecategoryAttributes(category_id);

            }

            var variantValuesLength = {{ $variant->attributeValues->count() }};

            var attrbites = @json(\Modules\Store\Models\Attribute::whereIn('id', $variant->attributeValues->pluck('attribute_id'))->get());
            var attrbites = @json($variant->attributeValues);
            var values = @json($variant->attributeValues);


            function add_more_customer_choice_option(i, name, category_id) {

                // $('#customer_choice_options .attribute_choice').select2();
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

                        let options = '';
                        for (i = 0; i < data.values.length; i++) {

                            selected = values.some(elem => elem.id == data.values[i].id) ? "selected" : "not selecting";
                            // convert object to stringe in option id and value 
                            options = options + '<option value=' + JSON.stringify({ id: data.values[i].id, value: data.values[i].value }) + ' ' + selected + '>' + data.values[i].value.en + '</option>'

                        }


                        var inputHtml = '\
                                                                                                            <div class="form-group row">\
                                                                                                                <div class="col-md-3 mt-3">\
                                                                                                                    <input type="hidden" name="attribute" value="attribute_id">\
                                                                                                                    <input type="text" class="form-control" name="choice[]" value="' + data.name.{{ config('app.locale') }}  + '" >\
                                                                                                                </div>\
                                                                                                                <div class="col-md-8 mt-3">\
                                                                                                                    <select class="form-control attribute_choice" data-control="select2" data-live-search="true" name="choice_options[]" 	 required>\
                                                                                                                    ' + '<option value="">select option</option>' + '\
                                                                                                                    ' + options + '\
                                                                                                                    </select>\
                                                                                                                </div>\
                                                                                                            </div>';


                        $('#customer_choice_options').append(inputHtml).trigger('change');
                        // $('#customer_choice_options .attribute_choice').select2();


                    }, error: (error) => {
                        console.log(JSON.stringify(error));

                    }
                });
            }

            $('#edit_category_id').change(function () {

                category_id = $(this).val();

                updatecategoryAttributes(category_id);

            });

            function updatecategoryAttributes(category_id) {
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

                            var attrbitesContainer = $('#choice_attributes');

                            attrbitesContainer.empty();

                            var options = [];

                            data.forEach(item => {

                                // selected = attrbites.includes(item) ? "selected" : "not selecting";
                                selected = attrbites.some(elem => elem.attribute_id == item.id) ? "selected" : "not selecting";

                                options += '<option value="' + item.id + '" ' + selected + ' >  ' + item.name.{{ config('app.locale') }} + ' </option>';
                            });


                            attrbitesContainer.append(options).trigger('change');

                            attrbitesContainer.select2();

                        }, error: function () {
                            alert('Failed to fetch data');
                        }

                    });


                };
            }

            function createHtmlView(ids = null, text = 'product ') {

                let html = '<div class="form-group row mt-5"><div class="col-12 mt-3">\
                                                                                        <input type="hidden" name="choice_attr_val[]" value="' + ids + '">\
                                                                                            <label class="required form-label text-uppercase" style="text-transform: uppercase">'+ text.slice(0, -1) + '</label>\
                                                                                        </div>\
                                                                                        <div class="col-md-6 mt-3">\
                                                                                                <input type="text" class="form-control" name="sku[]"  placeholder="SKU" value="{{$variant->sku}}">\
                                                                                        </div>\
                                                                                        <div class="col-md-6 mt-3">\
                                                                                                <input type="text" class="form-control" name="barcode[]"  placeholder="Barcode" value="{{$variant->barcode}}">\
                                                                                        </div>\
                                                                                        <div class="col-md-6 mt-3">\
                                                                                                <input type="text" class="form-control" name="cost_price[]"  placeholder="Cost Price" value="{{$variant->cost_price}}">\
                                                                                        </div>\
                                                                                        <div class="col-md-6 mt-3">\
                                                                                                <input type="text" class="form-control" name="price[]"  placeholder="Price" value="{{$variant->price}}">\
                                                                                        </div>\
                                                                                        <div class="col-md-6 mt-3">\
                                                                                                <input type="text" class="form-control" name="sale_price[]"  placeholder="Discount Price" value="{{$variant->sale_price}}">\
                                                                                        </div>\
                                                                                         <div class="col-md-6 mt-3">\
                                                                                                <input type="text" class="form-control" name="qty[]"  placeholder="Quentity" value="{{$variant->quantity}}">\
                                                                                        </div>\
                                                                                        <div class="col-md-6 mt-3">\
                                                                                                <input type="file" class="form-control mb-2" name="featured_image[]">\
                                                                                        </div>\ </div>\
                                        ';

                return html;

            }

            function onTabShown(event) {
                var activatedTab = event.target;
                var previousTab = event.relatedTarget;
                
                var values = document.querySelectorAll('.attribute_choice');
                console.log(values.length);

                if (activatedTab.getAttribute('href') === '#kt_ecommerce_add_product_advanced') {
                    
                    var containerVarientProduct = $('#product_varient');

                    containerVarientProduct.empty();

                    let ids = text = '';
                   
                    if (values.length > 0) {

                        var attributes = [];

                        $.each(values, function (index, value) {
                            attributes.push(value.value);
                        });
                       
                        text = combineValuesNames(attributes);
                        
                    }

                    containerVarientProduct.append(createHtmlView(ids, text));

                }
            }

            function combineValuesNames(attrbites) {
                var stringValuesNames = '';
                for (let i = 0; i < attrbites.length; i++) {

                    stringValuesNames +=  JSON.parse(attrbites[i]).value.en + '-';

                }

                return stringValuesNames;
            }

            var tabs = document.querySelectorAll('a[data-bs-toggle="tab"]');

            $('#choice_attributes').on('change', function () {

                $('#customer_choice_options').html(null);
                $.each($("#choice_attributes option:selected"), function () {
                    add_more_customer_choice_option($(this).val(), $(this).text().trim(), category_id);
                });

            });

            tabs.forEach(tab => {
                tab.addEventListener('shown.bs.tab', onTabShown);
            });

        });
    </script>



@endpush