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
                        <h4>Edit Plate</h4>
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
                                        <input type="text" name="number" class="form-control" placeholder="Ex: 58565" value="{{ $plate->number }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">City <span class="text-danger">*</span></label>
                                        <select class="select" name="emirate_id" id="emirate_id" required>
                                            <option value="">Select Emirate</option>
                                            @foreach(\App\Models\Emirate::all() as $emirate)
                                            <option value="{{ $emirate->id }}" {{ $plate->emirate_id == $emirate->id ? 'selected' : '' }}>{{ $emirate->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Code <span class="text-danger">*</span></label>
                                        <select class="select" name="code_id" id="code_id" required>
                                            <option value="">Select Code</option>
                                            @foreach(\App\Models\Code::where('emirate_id', $plate->emirate_id)->get() as $code)
                                            <option value="{{ $code->id }}" {{ $plate->code_id == $code->id ? 'selected' : '' }}>{{ $code->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="spinner-border text-primary d-none" id="code-loading" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Price <span class="text-danger">*</span></label>
                                        <input type="text" name="price" class="form-control" placeholder="Ex: 1,200" value="{{ $plate->price }}" required>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="soldToggle" name="is_sold" {{ $plate->is_sold ? 'checked' : '' }}>
                                            <label class="form-check-label" for="soldToggle">Sold</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Visibility</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="visibilityToggle" name="is_visible" {{ $plate->is_visible ? 'checked' : '' }}>
                                            <label class="form-check-label" for="visibilityToggle">Visible</label>
                                        </div>
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
                                                        <div class="d-flex align-items-center">
                                                            <img src="{{ asset('storage/' . $plate->image) }}" alt="Current Plate Image" class="img-thumbnail me-3" style="max-width: 150px;">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="removeImage" name="remove_image">
                                                                <label class="form-check-label" for="removeImage">Remove current image</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="upload-div">
                                                        <input type="file" name="image">
                                                        <div class="upload-photo-drag">
                                                            <span><i class="fa fa-upload me-2"></i> Update Plate Photo</span>
                                                            <h6>or Drag New Photo</h6>
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
                <a href="{{ route('user.plates') }}" class="btn btn-secondary me-2">Cancel</a>
                <button class="btn btn-primary continue-book-btn" type="submit">Update Plate</button>
            </div>
        </form>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // When emirate selection changes
        $('#emirate_id').on('change', function() {
            const emirateId = $(this).val();
            const codeSelect = $('#code_id');
            const loadingSpinner = $('#code-loading');
            
            // Clear current options
            codeSelect.empty().append('<option value="">Loading codes...</option>');
            
            if (emirateId) {
                // Show loading spinner
                loadingSpinner.removeClass('d-none');
                
                // Fetch codes for the selected emirate
                $.ajax({
                    url: "{{ route('user.api.codes.by.emirate') }}",
                    type: "GET",
                    data: {
                        emirate_id: emirateId
                    },
                    success: function(response) {
                        // Clear the loading option
                        codeSelect.empty();
                        
                        // Add a default option
                        codeSelect.append('<option value="">Select Code</option>');
                        
                        // Add options for each code
                        $.each(response.codes, function(key, code) {
                            codeSelect.append('<option value="' + code.id + '">' + code.name + '</option>');
                        });
                        
                        // Hide loading spinner
                        loadingSpinner.addClass('d-none');
                    },
                    error: function(xhr, status, error) {
                        console.error("Error loading codes:", error);
                        codeSelect.empty().append('<option value="">Error loading codes</option>');
                        loadingSpinner.addClass('d-none');
                    }
                });
            } else {
                // If no emirate is selected, show default message
                codeSelect.empty().append('<option value="">Select Emirate First</option>');
            }
        });

        // Handle the remove image checkbox
        $('#removeImage').on('change', function() {
            if ($(this).is(':checked')) {
                $('input[name="image"]').prop('disabled', true);
                $('.upload-div').addClass('disabled');
            } else {
                $('input[name="image"]').prop('disabled', false);
                $('.upload-div').removeClass('disabled');
            }
        });
    });
</script>
@endpush