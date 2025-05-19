@extends('layouts.app')

@section('content')

<div class="content dashboard-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 d-flex">
                <div class="card user-card flex-fill">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-sm-5">
                                <h5>My Plates <span class="text-muted">({{ $plates->count() }})</span></h5>
                            </div>
                            <div class="col-sm-7 text-sm-end">
                                <div class="booking-select d-flex justify-content-end align-items-center">
                                    <div class="search-group me-3">
                                        <input type="search" class="form-control" placeholder="Search plates...">
                                    </div>
                                    <a href="{{ route('user.plates.create') }}" class="btn btn-primary"><i class="feather-plus-circle me-1"></i> Add Plate</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive dashboard-table dashboard-table-info">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Plate Details</th>
                                        <th>Emirate</th>
                                        <th>Code</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($plates as $plate)
                                    <tr>
                                        <td>
                                            <div class="table-avatar">
                                                <!-- <a href="#" class="avatar avatar-lg flex-shrink-0">
                                                    <img class="avatar-img" src="{{ $plate->image_url }}" alt="Plate Image">
                                                </a> -->
                                                <div class="table-head-name flex-grow-1">
                                                    <a href="#">{{ $plate->code->name }} {{ $plate->number }}</a>
                                                    <p>Listed: {{ $plate->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h6>{{ $plate->emirate->name }}</h6>
                                        </td>
                                        <td>
                                            <h6>{{ $plate->code->name }}</h6>
                                        </td>
                                        <td>
                                            <h5 class="text-success">{{ $plate->price_digits }}</h5>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <div class="form-check form-switch mb-2">
                                                    <input class="form-check-input toggle-sold" type="checkbox" role="switch"
                                                        id="soldToggle{{ $plate->id }}" data-id="{{ $plate->id }}"
                                                        {{ $plate->is_sold ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="soldToggle{{ $plate->id }}">
                                                        <span class="status-label">{{ $plate->is_sold ? 'Sold' : 'Not Sold' }}</span>
                                                    </label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input toggle-visibility" type="checkbox" role="switch"
                                                        id="visibilityToggle{{ $plate->id }}" data-id="{{ $plate->id }}"
                                                        {{ $plate->is_visible ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="visibilityToggle{{ $plate->id }}">
                                                        <span class="visibility-label">{{ $plate->is_visible ? 'Visible' : 'Hidden' }}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('user.plates.edit', $plate->id) }}" class="btn btn-sm btn-primary me-2">
                                                    <i class="feather-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-danger delete-plate" data-id="{{ $plate->id }}">
                                                    <i class="feather-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <div class="empty-state">
                                                <i class="feather-tag fs-1 text-muted mb-3"></i>
                                                <h6>No plates listed yet</h6>
                                                <p class="text-muted">Start listing your plates for sale</p>
                                                <a href="{{ route('user.plates.create') }}" class="btn btn-primary">Add New Plate</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Delete plate functionality
        $('.delete-plate').on('click', function() {
            let button = $(this);
            let plateId = button.data('id');

            // Show confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#127384',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // AJAX call to delete plate
                    $.ajax({
                        url: "{{ route('user.plates.ajax-destroy') }}",
                        type: "POST",
                        data: {
                            id: plateId,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            // Remove the plate row from the DOM
                            button.closest('tr').fadeOut(300, function() {
                                $(this).remove();

                                // Check if there are no more plates
                                if ($('tbody tr').length === 0) {
                                    $('tbody').html(`
                                        <tr>
                                            <td colspan="6" class="text-center py-4">
                                                <div class="empty-state">
                                                    <i class="feather-tag fs-1 text-muted mb-3"></i>
                                                    <h6>No plates listed yet</h6>
                                                    <p class="text-muted">Start listing your plates for sale</p>
                                                    <a href="{{ route('user.plates.create') }}" class="btn btn-primary">Add New Plate</a>
                                                </div>
                                            </td>
                                        </tr>
                                    `);
                                }
                            });

                            // Show success message
                            toastr.success(response.message || "Plate deleted successfully");
                        },
                        error: function(xhr) {
                            toastr.error(xhr.responseJSON?.message || "Error deleting plate");
                            console.log(xhr.responseText);
                        }
                    });
                }
            });
        });

        // Toggle sold status
        $('.toggle-sold').on('change', function() {
            let checkbox = $(this);
            let plateId = checkbox.data('id');
            let isSold = checkbox.prop('checked') ? 1 : 0;
            let label = checkbox.closest('.form-check').find('.status-label');

            // AJAX call to update sold status
            $.ajax({
                url: "{{ route('user.plates.update-sold') }}",
                type: "POST",
                data: {
                    id: plateId,
                    is_sold: isSold,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    // Update label text
                    label.text(isSold ? 'Sold' : 'Not Sold');

                    // Show success message
                    toastr.success(response.message || "Plate status updated successfully");
                },
                error: function(xhr) {
                    // Revert checkbox state on error
                    checkbox.prop('checked', !isSold);
                    label.text(!isSold ? 'Sold' : 'Not Sold');

                    // Show error message
                    toastr.error(xhr.responseJSON?.message || "Error updating plate status");
                    console.log(xhr.responseText);
                }
            });
        });

        // Toggle visibility status
        $('.toggle-visibility').on('change', function() {
            let checkbox = $(this);
            let plateId = checkbox.data('id');
            let isVisible = checkbox.prop('checked') ? 1 : 0;
            let label = checkbox.closest('.form-check').find('.visibility-label');

            // AJAX call to update visibility status
            $.ajax({
                url: "{{ route('user.plates.update-visibility') }}",
                type: "POST",
                data: {
                    id: plateId,
                    is_visible: isVisible,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    // Update label text
                    label.text(isVisible ? 'Visible' : 'Hidden');

                    // Show success message
                    toastr.success(response.message || "Visibility updated successfully");
                },
                error: function(xhr) {
                    // Revert checkbox state on error
                    checkbox.prop('checked', !isVisible);
                    label.text(!isVisible ? 'Visible' : 'Hidden');

                    // Show error message
                    toastr.error(xhr.responseJSON?.message || "Error updating visibility");
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>
@endpush