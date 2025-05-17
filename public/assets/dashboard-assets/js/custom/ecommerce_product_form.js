$(document).on('click', '.product_varient_item', function() {
    // Find the closest parent with the class "product_variant" and remove it
    var productVariantCount = $('.product_variant').length;

    if (productVariantCount > 1) {
        $(this).closest('.product_variant').remove();

    }else {
        alert ('Cannot delete the last product variant.');
    }
    // console.log(123);
});

    $(document).ready(function() {

        var singleType = document.getElementById('single');
        var variantType = document.getElementById('variant');

        if(singleType.checked)
            $('#kt_ecommerce_add_product').addClass('hidden');


        singleType.addEventListener('click', function() {
            $('#kt_ecommerce_add_product').addClass('hidden');
        });

        variantType.addEventListener('click', function() {
            $('#kt_ecommerce_add_product').removeClass('hidden');
        });

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
                    url: "{{ route('seller.fetch.category.attributes') }}",
                    data: {
                        category_id: category_id
                    },
                    success: function(data) {

                        if (data.length > 0) {

                            console.log(data);
                            $('#variations').removeClass('hidden');


                            var attrbitesContainer = $('#choice_attributes');

                            attrbitesContainer.empty();

                            var options = [];

                            data.forEach(item => {

                                options += '<option value="' + item.id + '"> ' + item.name.en + ' </option>';

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

        ;

        // appendVarient
        function createHtmlView(ids = null, text = 'product ') {

            let html = '  <div class="card card-flush py-4 mt-3 product_variant">\
                                    <div class="card-body pt-0">\
            <div class="form-group row mt-5"><div class="col-6 mt-3">\
                                                                                                   <input type="hidden" name=" choice_attr_val[]" value="' + ids + '">\
                                                                                                       <label class="required form-label text-uppercase" style="text-transform: uppercase">' + text.slice(0, -1) + '</label>\
                                                                                                   </div>\
                                                                                                   <div class="col-6 mt-3">  <button type="button"  class="btn btn-danger f-left product_varient_item">remove</button></div>\
                                                                                                     <div class="col-md-6 mt-4">\
                                                                                                     <label for="" class="form-label required">Featured image</label>\
                                                                                                         <input type="file" class="form-control mb-2" name="featured_image[]" required>\
                                                                                                    </div>\
                                                                                                   <div class="col-md-6 mt-4">\
                                                                                                       <label for="" class="form-label required">SKU</label>\
                                                                                                         <input type="text" class="form-control" name="sku[]"  placeholder="SKU" required>\
                                                                                                    </div>\
                                                                                                    <div class="col-md-6 mt-4">\
                                                                                                       <label for="" class="form-label">Barcode</label>\
                                                                                                         <input type="text" class="form-control" name="barcode[]"  placeholder="Barcode" >\
                                                                                                    </div>\
                                                                                                    <div class="col-md-6 mt-4">\
                                                                                                       <label for="" class="form-label required">Cost Price</label>\
                                                                                                         <input type="text" class="form-control" name="cost_price[]"  placeholder="Cost Price" required>\
                                                                                                    </div>\
                                                                                                    <div class="col-md-6 mt-4">\
                                                                                                       <label for="" class="form-label required">Price</label>\
                                                                                                         <input type="text" class="form-control" name="price[]"  placeholder="Price" required>\
                                                                                                    </div>\
                                                                                                    <div class="col-md-6 mt-4">\
                                                                                                       <label for="" class="form-label">Discount Price</label>\
                                                                                                         <input type="text" class="form-control" name="sale_price[]"  placeholder="Discount Price" required>\
                                                                                                    </div>\
                                                                                                    <div class="col-md-6 mt-4">\
                                                                                                    <label for="" class="form-label">Discount end date</label>\
                                                                                                    <input type="date" class="form-control multi-datepicker" name="discount_end_date[]" placeholder="discount end date" />\
                                                                                                    </div>\
                                                                                                    <div class="col-md-6 mt-4">\
                                                                                                     <label for="" class="form-label">Quentity</label>\
                                                                                                         <input type="text" class="form-control" name="qty[]"  placeholder="Quentity" required>\
                                                                                                    </div>\
                                                                                                    <div class="col-md-6 mt-4">\
                                                                                                     <label for="" class="form-label">Multi images</label>\
                                                                                                         <input type="file" class="form-control mb-2" name="multi_image[][]"  multiple>\
                                                                                                    </div>\ </div>\
                                                                                               </div></div>\
                                                                                                    ';

            return html;

        }

        function appendCombinationValues(combinations) {
            let containerVarientProducts = $('#product_varient');
            let containerProduct = $('#single-product');
            if (combinations.length > 0) {

                containerVarientProducts.empty();
                containerProduct.empty();

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
                        text += value.value.en + '-';

                    });

                    containerVarientProducts.append(createHtmlView(ids, text));
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

        function add_more_customer_choice_option(i, name, category_id) {

            $('#customer_choice_options .attribute_choice').select2();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: "{{ route('seller.products.add-more-choice-option') }}",
                data: {
                    attribute_id: i
                },
                success: function(data) {

                    let options = '';
                    for (i = 0; i < data.values.length; i++) {
                        // convert object to stringe in option id and value 
                        options = options + '<option value=' + JSON.stringify({
                            id: data.values[i].id,
                            value: data.values[i].value
                        }) + '>' + data.values[i].value.en + '</option>'

                    }

                    var inputHtml = '\
                                                                                <div class="form-group row">\
                                                                                    <div class="col-md-3 mt-3">\
                                                                                        <input type="hidden" name="attribute" value="attribute_id">\
                                                                                        <input type="text" class="form-control" name="choice[]" value="' + data.name.en + '" >\
                                                                                    </div>\
                                                                                    <div class="col-md-8 mt-3">\
                                                                                        <select class="form-control choice_options" data-control="select2" data-live-search="true" name="choice_options" 	multiple="multiple" required>\
                                                                                        ' + '<option value="">select option</option>' + '\
                                                                                        ' + options + '\
                                                                                        </select>\
                                                                                    </div>\
                                                                                </div>';

                    $('#customer_choice_options').append(inputHtml).trigger('change');

                    $('#customer_choice_options .choice_options').select2();
                    // choiceOptions();

                },
                error: (error) => {
                    console.log(JSON.stringify(error));
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
