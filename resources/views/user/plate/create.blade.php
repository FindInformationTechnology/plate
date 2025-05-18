@extends('layouts.app')

@section('content')
<section class="section product-details add-listing">
    <div class="container">
        
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('user.plates.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row" id="info">
                <div class="col-lg-12 col-md-12">
                    <div class="heading-lising">
                        <h4>Basic Info</h4>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Plate number <span class="text-danger">*</span></label>
                                        <input type="text" name="number" class="form-control" placeholder="Ex: 58565" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">City <span class="text-danger">*</span></label>
                                        <select class="select" name="emirate_id" id="emirate_id" required>
                                            <option value="">Select Emirate</option>
                                            @foreach(\App\Models\Emirate::all() as $emirate)
                                            <option value="{{ $emirate->id }}">{{ $emirate->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Code <span class="text-danger">*</span></label>
                                        <select class="select" name="code_id" id="code_id" required>
                                            <option value="">Select Emirate First</option>
                                        </select>
                                        <div class="spinner-border text-primary d-none" id="code-loading" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Price <span class="text-danger">*</span></label>
                                        <input type="text" name="price" class="form-control" placeholder="Ex: 1,200" required>
                                    </div>
                                </div>


                                <div class="col-lg-12 col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="upload-div">
                                                        <input type="file" name="image">
                                                        <div class="upload-photo-drag">
                                                            <span><i class="fa fa-upload me-2"></i> Plate Photo</span>
                                                            <h6>or Drag Photo</h6>
                                                        </div>
                                                    </div>
                                                    <div class="upload-list">
                                                        <ul>
                                                            <li>The maximum photo size is 8 MB. Formats: jpeg, jpg, png.</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="booking-info-btns d-flex justify-content-end">
                <a href="{{ route('user.plates') }}" class="btn btn-secondary">Cancel</a>
                <button class="btn btn-primary continue-book-btn" type="submit">Save</button>
            </div>
        </form>
    </div>
</section>
@endsection

@push('scripts')
@endpush