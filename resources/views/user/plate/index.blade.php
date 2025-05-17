@extends('layouts.app')

@section('content')

<style>
    /* Custom Plate Listing Styles */
    .listview-plate {
        background: #ffffff;
        border: 1px solid #E3E3E3;
        box-shadow: 0px 4px 24px rgba(225, 225, 225, 0.25);
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 25px;
        transition: all 0.5s;
    }

    .listview-plate:hover {
        border-color: #FFA633;
        transform: translateY(-5px);
    }

    .listview-plate .blog-img {
        position: relative;
        width: 35%;
        overflow: hidden;
        border-radius: 10px 0 0 10px;
    }

    .listview-plate .blog-img img {
        display: block;
        position: relative;
        -webkit-transform: translateZ(0);
        -moz-transform: translateZ(0);
        transform: translateZ(0);
        -moz-transition: all 2000ms cubic-bezier(0.19, 1, 0.22, 1) 0ms;
        -ms-transition: all 2000ms cubic-bezier(0.19, 1, 0.22, 1) 0ms;
        -o-transition: all 2000ms cubic-bezier(0.19, 1, 0.22, 1) 0ms;
        -webkit-transition: all 2000ms cubic-bezier(0.19, 1, 0.22, 1) 0ms;
        transition: all 2000ms cubic-bezier(0.19, 1, 0.22, 1) 0ms;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .listview-plate:hover .blog-img img {
        -webkit-transform: scale(1.15);
        -moz-transform: scale(1.15);
        transform: scale(1.15);
    }

    .listview-plate .bloglist-content {
        width: 65%;
        padding: 20px;
    }

    .listview-plate .blog-list-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .listview-plate .blog-list-title h3 {
        font-weight: 500;
        font-size: 18px;
        color: #201F1D;
        margin-bottom: 10px;
    }

    .listview-plate .blog-list-title h3 span {
        font-weight: 700;
        color: #127384;
    }

    .listview-plate .blog-list-rate h6 {
        font-weight: 700;
        font-size: 22px;
        color: #FF9307;
        background: rgba(255, 147, 7, 0.1);
        padding: 8px 15px;
        border-radius: 5px;
        margin: 0;
    }

    .listview-plate .list-head-bottom {
        border-top: 1px solid #F4F4F4;
        padding-top: 15px;
        margin-top: 15px;
    }

    .listview-plate .listing-button .btn-order {
        display: inline-block;
        padding: 8px 20px;
        border-radius: 5px;
        font-weight: 500;
        font-size: 14px;
        margin-right: 10px;
        transition: all 0.5s;
    }

    .listview-plate .listing-button .btn-order:first-child {
        background-color: #127384;
        color: white;
        border: 1px solid #127384;
    }

    .listview-plate .listing-button .btn-order:first-child:hover {
        background-color: #0e5a68;
    }

    .listview-plate .delete-plate {
        background-color: #FF0000;
        color: white;
        border: 1px solid #FF0000;
    }

    .listview-plate .delete-plate:hover {
        background-color: #d60000;
    }

    /* Empty state styling */
    .plates-empty-state {
        text-align: center;
        padding: 40px 20px;
        background: #FCFCFC;
        border-radius: 10px;
        margin-top: 20px;
    }

    .plates-empty-state h5 {
        font-weight: 500;
        font-size: 20px;
        color: #737373;
        margin-bottom: 15px;
    }

    .plates-empty-state .btn-add {
        background: #FFA633;
        color: #ffffff;
        padding: 10px 20px;
        border-radius: 5px;
        font-weight: 500;
        display: inline-block;
        margin-top: 15px;
    }

    /* Card header styling */
    .card-header {
        background: #ffffff;
        border-bottom: 1px solid #F4F4F4;
        padding: 20px;
    }

    .card-header h4 {
        font-weight: 700;
        font-size: 20px;
        color: #201F1D;
        margin: 0;
    }

    .card-header h4 span {
        color: #127384;
        font-weight: 500;
    }

    .btn-add {
        background: #FFA633;
        color: #ffffff;
        padding: 8px 15px;
        border-radius: 5px;
        font-weight: 500;
        transition: all 0.5s;
    }

    .btn-add:hover {
        background: #e88f1e;
        color: #ffffff;
    }



    /* Toggle switch styling */
    .plate-status-toggles {
        display: flex;
        flex-wrap: wrap;
    }

    .form-check-input {
        cursor: pointer;
        width: 3em;
        height: 1.5em;
    }

    .form-check-input:checked {
        background-color: #127384;
        border-color: #127384;
    }

    .form-check-input:focus {
        border-color: #127384;
        box-shadow: 0 0 0 0.25rem rgba(18, 115, 132, 0.25);
    }

    .form-check-label {
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
    }

    .status-label,
    .visibility-label {
        display: inline-block;
        min-width: 70px;
    }

    @media (max-width: 767.98px) {
        .plate-status-toggles {
            flex-direction: column;
        }

        .form-check.form-switch {
            margin-bottom: 10px;
        }

        .listview-plate {
            flex-direction: column;
        }

        .listview-plate .blog-img {
            width: 100%;
            border-radius: 10px 10px 0 0;
            height: 200px;
        }

        .listview-plate .bloglist-content {
            width: 100%;
        }

        .listview-plate .blog-list-head {
            flex-direction: column;
            align-items: flex-start;
        }

        .listview-plate .blog-list-rate {
            margin-top: 15px;
        }

        .listview-plate .listing-button .btn-order {
            display: block;
            margin-bottom: 10px;
            text-align: center;
        }
    }
</style>




<div class="container mt-3">
    <div class="row">
        <div class="col-xl-9 col-lg-8 col-sm-12 col-12 m-auto">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <h4>My Plates <span class=""> ({{ $plates->count() }})</span></h4>
                        </div>
                        <div class="col-md-7 text-md-end">
                            <div class="table-search">
                                <div id="tablefilter">
                                    <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                        <label> <input type="search" class="form-control form-control-sm" placeholder="Search" aria-controls="DataTables_Table_0"></label>
                                    </div>
                                </div>
                                <a href="{{ route('user.plates.create') }}" class="btn btn-add"><i class="feather-plus-circle"></i> Add Plate</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @forelse ($plates as $plate)
                    <div class="blog-widget d-flex mt-3 listview-plate">
                        <div class="blog-img">
                            <img src="{{ asset ('assets/img/car-list-1.jpg') }}" class="img-fluid" alt="Plate Image">
                        </div>
                        <div class="bloglist-content">
                            <div class="blog-list-head d-flex">
                                <div class="blog-list-title">
                                    <h3>Code : <span>{{ $plate->code }}</span></h3>
                                    <h3>Number : <span>{{ $plate->number }}</span></h3>
                                    @if($plate->emirate)
                                    <h3>Emirate : <span>{{ $plate->emirate->name }}</span></h3>
                                    @endif
                                </div>
                                <div class="blog-list-rate">
                                    <h6>{{ $plate->price }} AED</h6>
                                </div>
                            </div>

                            <div class="blog-list-head list-head-bottom d-flex">
                                <div class="plate-status-toggles mt-2 mb-2">
                                    <div class="form-check form-switch d-inline-block me-3">
                                        <input class="form-check-input toggle-sold" type="checkbox" role="switch"
                                            id="soldToggle{{ $plate->id }}" data-id="{{ $plate->id }}"
                                            {{ $plate->is_sold ? 'checked' : '' }}>
                                        <label class="form-check-label" for="soldToggle{{ $plate->id }}">
                                            <span class="status-label">{{ $plate->is_sold ? 'Sold' : 'Not Sold' }}</span>
                                        </label>
                                    </div>

                                    <div class="form-check form-switch d-inline-block">
                                        <input class="form-check-input toggle-visibility" type="checkbox" role="switch"
                                            id="visibilityToggle{{ $plate->id }}" data-id="{{ $plate->id }}"
                                            {{ $plate->is_visible ? 'checked' : '' }}>
                                        <label class="form-check-label" for="visibilityToggle{{ $plate->id }}">
                                            <span class="visibility-label">{{ $plate->is_visible ? 'Visible' : 'Hidden' }}</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="listing-button">




                                    <a href="{{ route('user.plates.edit', $plate->id) }}" class="btn btn-order">
                                        <span><i class="feather-edit me-2"></i></span>Edit
                                    </a>

                                    <button type="button" class="btn btn-order delete-plate" data-id="{{ $plate->id }}">
                                        <span><i class="feather-trash me-2"></i></span>Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="plates-empty-state">
                        <h5>You don't have any plates yet</h5>
                        <p>Add your first plate to start selling</p>
                        <a href="{{ route('user.plates.create') }}" class="btn-add"><i class="feather-plus-circle"></i> Add Plate</a>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<link rel="stylesheet" href="{{ asset('assets/css/custom-plate.css') }}">
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
                            // Remove the plate card from the DOM
                            button.closest('.listview-plate').fadeOut(300, function() {
                                $(this).remove();

                                // Check if there are no more plates
                                if ($('.listview-plate').length === 0) {
                                    $('.card-body').html(`
                                        <div class="plates-empty-state">
                                            <h5>You don't have any plates yet</h5>
                                            <p>Add your first plate to start selling</p>
                                            <a href="{{ route('user.plates.create') }}" class="btn-add"><i class="feather-plus-circle"></i> Add Plate</a>
                                        </div>
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
    });



    $(document).ready(function() {
        // Delete plate functionality
        $('.delete-plate').on('click', function() {
            // Existing delete code...
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