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
                        <p class="text-muted">{{ __('message.Note') }}: {{ __('message.you_may_use') }} <strong>x, y</strong> {{ __('message.and') }} <strong>z</strong> {{ __('message.characters_to_hide_some_numbers') }}</p>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="plates-table">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>{{ __('message.Plate_number') }} <span class="text-danger">*</span></th>
                                                    <th>{{ __('message.City') }} <span class="text-danger">*</span></th>
                                                    <th>{{ __('message.Code') }} <span class="text-danger">*</span></th>
                                                    <th>{{ __('message.Price') }} <small>({{ __('message.Optional') }})</small></th>
                                                    <th width="80">{{ __('message.Print_sold?') }}</th>
                                                    <th width="60">{{ __('message.Action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody id="plates-tbody">
                                                <tr class="plate-row" data-row="0">
                                                    <td>
                                                        <input type="text" name="plates[0][number]" class="form-control" 
                                                            placeholder="{{ __('message.Plate_Number') }}" value="{{ old('plates.0.number') }}" required>
                                                    </td>
                                                    <td>
                                                        <select class="form-select emirate-select" name="plates[0][emirate_id]" data-row="0" required>
                                                            <option value="">{{ __('message.City') }}</option>
                                                            @foreach(\App\Models\Emirate::all() as $emirate)
                                                            <option value="{{ $emirate->id }}">{{ $emirate->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-select code-select" name="plates[0][code_id]" data-row="0" required>
                                                            <option value="">{{ __('message.Code') }}</option>
                                                        </select>
                                                        <div class="spinner-border spinner-border-sm text-primary d-none code-loading" data-row="0" role="status">
                                                            <span class="visually-hidden">{{ __('message.Loading') }}...</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="plates[0][price]" class="form-control" 
                                                            placeholder="{{ __('message.Price_Optional') }}">
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge bg-success">{{ __('message.Avail.') }}</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-sm btn-outline-danger remove-row d-none">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-end mt-3">
                                        <button type="button" class="btn btn-outline-primary" id="add-row">
                                            <i class="fas fa-plus me-2"></i>{{ __('message.Add_Another_Plate') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="booking-info-btns d-flex justify-content-end">
                <a href="{{ route('user.plates') }}" class="btn btn-secondary">{{ __('message.Cancel') }}</a>
                <button class="btn btn-primary continue-book-btn" type="submit">{{ __('message.Save_All_Plates') }}</button>
            </div>
        </form>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        let rowCount = 1;

        // Add new row functionality
        $('#add-row').on('click', function() {
            const newRow = createNewRow(rowCount);
            $('#plates-tbody').append(newRow);
            updateRemoveButtons();
            rowCount++;
        });

        // Remove row functionality
        $(document).on('click', '.remove-row', function() {
            $(this).closest('.plate-row').remove();
            updateRemoveButtons();
        });

        // Emirate change functionality
        $(document).on('change', '.emirate-select', function() {
            const emirateId = $(this).val();
            const row = $(this).data('row');
            const codeSelect = $(`.code-select[data-row="${row}"]`);
            const loadingSpinner = $(`.code-loading[data-row="${row}"]`);

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
                loadingSpinner.addClass('d-none');
            }
        });

        function createNewRow(index) {
            return `
                <tr class="plate-row" data-row="${index}">
                    <td>
                        <input type="text" name="plates[${index}][number]" class="form-control" 
                            placeholder="{{ __('message.Plate_Number') }}" required>
                    </td>
                    <td>
                        <select class="form-select emirate-select" name="plates[${index}][emirate_id]" data-row="${index}" required>
                            <option value="">{{ __('message.City') }}</option>
                            @foreach(\App\Models\Emirate::all() as $emirate)
                            <option value="{{ $emirate->id }}">{{ $emirate->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="form-select code-select" name="plates[${index}][code_id]" data-row="${index}" required>
                            <option value="">{{ __('message.Code') }}</option>
                        </select>
                        <div class="spinner-border spinner-border-sm text-primary d-none code-loading" data-row="${index}" role="status">
                            <span class="visually-hidden">{{ __('message.Loading') }}...</span>
                        </div>
                    </td>
                    <td>
                        <input type="text" name="plates[${index}][price]" class="form-control" 
                            placeholder="{{ __('message.Price_Optional') }}">
                    </td>
                    <td class="text-center">
                        <span class="badge bg-success">{{ __('message.Avail.') }}</span>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-outline-danger remove-row">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
        }

        function updateRemoveButtons() {
            const rows = $('.plate-row');
            if (rows.length === 1) {
                // Hide remove button for the last remaining row
                rows.find('.remove-row').addClass('d-none');
            } else {
                // Show remove buttons for all rows when there are multiple
                rows.find('.remove-row').removeClass('d-none');
            }
        }
    });
</script>
@endpush