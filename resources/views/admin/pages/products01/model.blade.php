<!--begin::Modal - Create App-->
<style>
	.step {
		display: none;
	}

	.step.active {
		display: block;
	}
</style>
</style>
<div class="modal fade" id="kt_modal_create_app" tabindex="-1" aria-hidden="true">
	<!--begin::Modal dialog-->
	<div class="modal-dialog modal-dialog-centered mw-900px">
		<!--begin::Modal content-->
		<div class="modal-content">

			<!--begin::Modal body-->
			<div class="modal-body py-lg-10 px-lg-10">
				<!--begin::Stepper-->
				<div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid"
					id="kt_modal_create_app_stepper">
					<!--begin::Aside-->

					<!--end::Nav-->

					<!--begin::Aside-->
					<!--begin::Content-->
					<div class="flex-row-fluid py-lg-5 px-lg-15">
						<!--begin::Form-->
						<form id="multiStepForm" method="POST" action="{{ route('admin.products.store') }}"
							enctype="multipart/form-data">
							@csrf
							<div class="step active" id="step1">

								<div class="d-flex flex-column gap-7 gap-lg-10 w-100 mb-7 me-lg-10">

									<!--begin::Status-->
									<div class="card-body">

										<div class=" py-4">
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
												<select class="form-select mb-2" data-control="select2"
													name="category_id" data-hide-search="true"
													data-placeholder="Select an option" id="category_id">
													<option>Select Category</option>
													@foreach ($categories as $category)
																										@include(
															'admin::pages.products.include.category_children',
															[
																'category'=> $category, 'category_id' => null,
																'level' => 1
															]
														)
													@endforeach
												</select>

												<!--begin::Description-->
												<div class="text-muted fs-7 mb-7">Add product to a category.</div>
												<!--end::Description-->
												<!--end::Select2-->

											</div>
											<!--end::Card body-->
										</div>
										<!--end::Status-->
										<!--begin::Category & tags-->
										<div class=" py-4">
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
													<option>Select Brand</option>
													@foreach ($brands as $brand)
														<option value="{{ $brand->id }}">{{ $brand->name }}</option>

													@endforeach

												</select>
												<!--end::Select2-->
												<!--begin::Description-->
												
												<!--end::Description-->
												<!--end::Input group-->

												<!--end::Input group-->
											</div>
											<!--end::Card body-->
										</div>
										<!--end::Category & tags-->
										<!--begin::Category & tags-->
										<div class=" py-4">
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
													<option>Select Unit</option>
													@foreach ($units as $unit)
														<option value="{{ $unit->id }}">{{ $unit->name }}</option>

													@endforeach

												</select>
												<!--end::Select2-->
												<!--begin::Description-->
												
												<!--end::Description-->
												<!--end::Input group-->

												<!--end::Input group-->
											</div>
											<!--end::Card body-->
										</div>
										<!--end::Category & tags-->
									</div>

								</div>

								<div class="d-flex justify-content-end pt-4">
									<!--begin::Button-->
									<a href="#" id="kt_ecommerce_add_product_cancel"
										class="btn btn-light me-5">Cancel</a>
									<!--end::Button-->
									<!--begin::Button-->
									<button class="btn btn-primary " type="button" id="next1">
										<span class="indicator-label">Next</span>

									</button>
									<!--end::Button-->
								</div>


							</div>
							<div class="step" id="step2">
								<!--begin::Main column-->
								<div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

									<!--begin::Tab content-->
									<div class="tab-content">
										<!--begin::Tab pane-->
										<div class="tab-pane fade show active" id="kt_ecommerce_add_product_general"
											role="tab-panel">
											<div class="d-flex flex-column gap-7 gap-lg-10">
												<!--begin::General options-->
												<div class="card card-flush py-4">
													<!--begin::Card header-->
													<div class="card-header">
														<div class="card-title">
															<h2>General</h2>
														</div>
													</div>
													<!--end::Card header-->
													<!--begin::Card body-->
													<div class="card-body pt-0">
														<!--begin::Input group-->
														@foreach (Config('app.accepted_locales') as  $key => $value)
														
														<div class="mb-10 fv-row">
															<!--begin::Label-->
															<label class="required form-label">Product Name {{ $value }}</label>
															<!--end::Label-->
															<!--begin::Input-->
															<input type="text" name="name[{{ $key }}]" class="form-control mb-2"
															placeholder="Product name" value="" />
															<!--end::Input-->
															
														</div>
														<!--end::Input group-->
														@endforeach
														<!--begin::Input group-->

														@foreach (Config('app.accepted_locales') as  $key => $value)
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
														@foreach (Config('app.accepted_locales') as  $key => $value )
														<div class="">
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
														<div class="mb-10 d-flex flex-wrap gap-5">
															<!--begin::Input group-->
															<div class="fv-row w-100 flex-md-root">
																<!--begin::Label-->
																<label class="required form-label">Model Number</label>
																<!--end::Label-->
																<!--begin::Select2-->
																<input type="text" class="form-control mb-2"
																	name="model_number" value="">
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
																<label class="required form-label">Minimum
																	Quantity</label>
																<!--end::Label-->
																<!--begin::Select2-->
																<input type="text" class="form-control mb-2"
																	name="maximum_quantity" value="">
																<!--end::Select2-->

															</div>
															<!--end::Input group-->
															<!--begin::Input group-->
															<div class="fv-row w-100 flex-md-root">
																<!--begin::Label-->
																<label class="form-label">Minimum Quantity</label>
																<!--end::Label-->
																<!--begin::Input-->
																<input type="text" name="minimum_quantity"
																	class="form-control mb-2" value="" />
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
																	value="">
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
																	value="" />
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
																<label class="required form-label">Featured
																	video</label>
																<!--end::Label-->
																<!--begin::Input-->


																<input type="file" class="form-control mb-2"
																	name="featured_video">
																<!--end::Input-->

															</div>
														</div>


													</div>

													<!--end::Card header-->
												</div>
												<!--begin::Variations-->
												<div class="card card-flush py-4">
													<!--begin::Card header-->
													<div class="card-header">
														<div class="card-title">
															<h2>Variations <span
																	class="form-check form-switch form-check-custom form-check-solid">

																	<input class="form-check-input" type="checkbox"
																		value="" id="chechSwitchVariant" />
																</span></h2>
														</div>
													</div>
													<!--end::Card header-->
													<!--begin::Card body-->
													<div class="card-body pt-0 " id="kt_ecommerce_add_product">
														<!--begin::Input group-->
														<div class=""
															data-kt-ecommerce-catalog-add-product="auto-options">
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

																	<select name="choice_attributes[]"
																		id="choice_attributes"
																		class="form-control choice_attributes"
																		data-control="select2" data-live-search="true"
																		multiple="multiple"
																		data-placeholder="Choose Attributes">
																		
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
												<!--end::Pricing-->
											</div>
										</div>
										<!--end::Tab pane-->
										<!--begin::Tab pane-->

										<!--end::Tab pane-->
									</div>
									<!--end::Tab content-->
								</div>
								<div class="d-flex justify-content-end pt-4">
									<!--begin::Button-->
									<!-- <a href="apps/ecommerce/catalog/products.html" id="kt_ecommerce_add_product_cancel"
	                                        class="btn btn-light me-5">Cancel</a> -->

									<!-- <button type="submit" class="btn btn-primary">
	                                        <span class="indicator-label">Save Changes</span> -->

									<!-- </button> -->
									<!--end::Button-->
									<button type="button" id="prev1" class="btn btn-light me-5">Previous</button>
									<button type="button" id="next2" class="btn btn-primary">Next</button>
								</div>
								<!--end::Main column-->
							</div>
							<div class="step" id="step3">
								<div class="d-flex flex-column gap-7 gap-lg-10">

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
										<div class="card-body pt-0">
											<div class="" id="single-product">

											</div>
										</div>
									</div>


									<div class="d-flex justify-content-end pt-4">
										<!--begin::Button-->
										<!-- <a href="apps/ecommerce/catalog/products.html" id="kt_ecommerce_add_product_cancel"
	                                        class="btn btn-light me-5">Cancel</a> -->

										<!--end::Button-->
										<button type="button" id="prev2" class="btn btn-light me-5">Previous</button>

										<button type="submit" class="btn btn-primary"> <span
												class="indicator-label">Save
												Changes</span></button>
									</div>
									<!--end::Main column-->

								</div>
						</form>
						<!--end::Form-->
					</div>
					<!--end::Content-->
				</div>
				<!--end::Stepper-->
			</div>
			<!--end::Modal body-->
		</div>
		<!--end::Modal content-->
	</div>
	<!--end::Modal dialog-->
</div>
<!--end::Modal - Create App-->


<!-- test scrip -->
<script>
	// add attributes


	// if (category_id) {

	//     $.ajax({
	//         url: ' route("admin.fetch.category.attributes") ', // Replace with your API endpoint
	//         method: 'GET',
	//         data: {
	//             category_id: category_id
	//         },
	//         success: function (response) {
	//         },
	//         error: function () {
	//             alert('Failed to fetch data');
	//         }
	//     });
	// }
	// if (category_id) {

	//     $.ajax({
	//         url: 'route("admin.fetch.category.attributes") ', // Replace with your API endpoint
	//         method: 'GET',
	//         data: { category_id: category_id },
	//         success: function (response) {

	//             console.log(response);

	//             var options = response.options;


	//             var checkbox = $('#dynamiccheckbox');


	//             checkbox.empty();



	//             options.forEach(function (option) {


	//                 checkbox.append('<div class="d-block"><input class="form-check-input me-3" name="option" type="checkbox" value="'
	//                     + option.id +
	//                     '"  />  <label class="form-check-label" for="kt_docs_formvalidation_checkbox_option_3"> <div class="fw-semibold text-gray-800">'
	//                     + option.name. Config::get('app.locale')
	//                             + '</div></label> </div><input type="text" class="form-control mw-100 w-200px " name="test[' + option.id + ']" placeholder="Variation" id="kt_tagify_'+ option.id +'"/>');

	//                 new Tagify(document.querySelector("#kt_tagify_" + option.id + ""));
	//             });
	//         },
	//         error: function () {
	//             alert('Failed to fetch data');
	//         }
	//     });
	// }

</script>
<!-- end test scrip -->