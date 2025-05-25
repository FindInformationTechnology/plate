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
                        <h4>{{ __('message.Basic_Info') }}</h4>
                        <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p> -->
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('message.Plate_number') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="number" class="form-control"
                                            placeholder="{{ __('message.Ex_58565') }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('message.City') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="select" name="emirate_id" id="emirate_id" required>
                                            <option value="">{{ __('message.Select_Emirate') }}</option>
                                            @foreach(\App\Models\Emirate::all() as $emirate)
                                            <option value="{{ $emirate->id }}">{{ $emirate->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('message.Code') }} <span
                                                class="text-danger">*</span></label>
                                        <select class="select" name="code_id" id="code_id" required>
                                            <option value="">{{ __('message.Select_Emirate_First') }}</option>
                                        </select>
                                        <div class="spinner-border text-primary d-none" id="code-loading" role="status">
                                            <span class="visually-hidden">{{ __('message.Loading') }}...</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('message.Price') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="price" class="form-control"
                                            placeholder="{{ __('message.Ex_1200') }}" required>
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
                                                            <span><i class="fa fa-upload me-2"></i>{{ __('message.Plate_Photo') }}</span>
                                                            <h6>{{ __('message.or_Drag_Photo') }}</h6>
                                                        </div>
                                                    </div>
                                                    <div class="upload-list">
                                                        <ul>
                                                            <li>{{ __('message.The_maximum_photo_size') }}</li>
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
                <a href="{{ route('user.plates') }}" class="btn btn-secondary">{{ __('message.Cancel') }}</a>
                <button class="btn btn-primary continue-book-btn"
                    type="submit">{{ __('message.Save') }}</button>
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
            codeSelect.empty().append('<option value="">{{ __("message.Loading_codes") }}...</option>');

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
                        codeSelect.append('<option value="">{{ __("message.Select_Code") }}</option>');

                        // Add options for each code
                        $.each(response.codes, function(key, code) {
                            codeSelect.append('<option value="' + code.id + '">' + code.name + '</option>');
                        });

                        // Hide loading spinner
                        loadingSpinner.addClass('d-none');
                    },
                    error: function(xhr, status, error) {
                        console.error("Error loading codes:", error);
                        codeSelect.empty().append('<option value="">{{ __("message.Error_loading_codes") }}</option>');
                        loadingSpinner.addClass('d-none');
                    }
                });
            } else {
                // If no emirate is selected, show default message
                codeSelect.empty().append('<option value="">{{ __("message.Select_Emirate_First") }}</option>');
            }
        });
    });
</script>
@endpush