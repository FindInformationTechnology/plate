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
        <form action="{{ route('user.plates.update', $plate->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row" id="info">
                <div class="col-lg-12 col-md-12">
                    <div class="heading-lising">
                        <h4>Edit Plate Information</h4>
                        <p>Update your plate information below</p>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Plate number <span class="text-danger">*</span></label>
                                        <input type="text" name="number" class="form-control" value="{{ $plate->number }}" placeholder="Ex: 58565" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">City <span class="text-danger">*</span></label>
                                        <select class="select" name="emirate_id" required>
                                            @foreach(\App\Models\Emirate::all() as $emirate)
                                            <option value="{{ $emirate->id }}" {{ $plate->emirate_id == $emirate->id ? 'selected' : '' }}>{{ $emirate->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Code <span class="text-danger">*</span></label>
                                        <select class="select" name="code" required>
                                            <option value="A" {{ $plate->code == 'A' ? 'selected' : '' }}>A</option>
                                            <option value="B" {{ $plate->code == 'B' ? 'selected' : '' }}>B</option>
                                            <option value="C" {{ $plate->code == 'C' ? 'selected' : '' }}>C</option>
                                            <option value="D" {{ $plate->code == 'D' ? 'selected' : '' }}>D</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Price <span class="text-danger">*</span></label>
                                        <input type="text" name="price" class="form-control" value="{{ $plate->price }}"  required>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    @if($plate->image)
                                                    <div class="current-image mb-3">
                                                        <label class="form-label">Current Image</label>
                                                        <img src="{{ asset('storage/' . $plate->image) }}" 
                                                        alt="Current Plate Image" class="img-fluid" style="max-height: 200px;">
                                                    </div>
                                                    @endif
                                                    <div class="upload-div">
                                                        <input type="file" name="image">
                                                        <div class="upload-photo-drag">
                                                            <span><i class="fa fa-upload me-2"></i> Update Plate Photo</span>
                                                            <h6>or Drag Photo</h6>
                                                        </div>
                                                    </div>
                                                    <div class="upload-list">
                                                        <ul>
                                                            <li>The maximum photo size is 8 MB. Formats: jpeg, jpg, png.</li>
                                                            <li>Leave empty to keep the current image.</li>
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
                <button class="btn btn-primary continue-book-btn" type="submit">Update</button>
            </div>
        </form>
    </div>
</section>
@endsection

@push('scripts')
@endpush