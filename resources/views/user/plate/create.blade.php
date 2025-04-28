@extends('layouts.app')

@section('content')





<section class="section product-details add-listing">
    <div class="container">

        <form action="{{ route('user.plates.store') }}" method="post">
            @csrf
            <div class="row" id="info">
                <div class="col-lg-4 col-md-12">
                    <div class="heading-lising">
                        <h4>Basic Info</h4>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Plate number <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Ex: 58565 ">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">City <span class="text-danger">*</span></label>
                                        <select class="select">
                                            <option>abu Dhabi</option>
                                            <option>Dubai</option>
                                            <option>Ajman</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Code <span class="text-danger">*</span></label>
                                        <select class="select">
                                            <option>2015</option>
                                            <option>2016</option>
                                            <option>2017</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Price <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Ex: 1,200 ">
                                    </div>
                                </div>
                                <!-- <div class="col-lg-4 col-md-12">
										<div class="mb-3">
											<label class="form-label">Model <span class="text-danger">*</span></label>
											<select class="select">
												<option>A8</option>
												<option>A7</option>
												<option>Q3</option>
											</select>
										</div>
									</div> -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="booking-info-btns d-flex justify-content-end">
                <a href="{{ route('user.plates') }}" class="btn btn-secondary">Cancel</a>
                <button class="btn btn-primary continue-book-btn" type="submit">Save </button>
            </div>
        </form>
    </div>
</section>

@endsection

@push('scripts')




@endpush