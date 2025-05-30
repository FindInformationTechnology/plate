@extends('layouts.app')

@section('content')

<!-- Page Content -->
<div class="content dashboard-content">
    <div class="container">
        <div class="row">
            <!-- User Stats -->
            <div class="col-lg-12 mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg bg-light-primary">
                                        <i class="feather-tag text-primary fs-3"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="mb-0">{{ $myPlatesCount ?? 0 }}</h5>
                                        <p class="mb-0">{{ __('message.My_Plates') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg bg-light-success">
                                        <i class="feather-check-circle text-success fs-3"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="mb-0">{{ $soldPlatesCount ?? 0 }}</h5>
                                        <p class="mb-0">{{ __('message.Sold_Plates') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-lg bg-light-warning">
                                        <i class="feather-eye text-warning fs-3"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="mb-0">{{ $viewsCount ?? 0 }}</h5>
                                        <p class="mb-0">{{ __('message.Total_Views') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /User Stats -->

            <!-- My Recent Plates -->
            <div class="col-lg-8 d-flex">
                <div class="card user-card flex-fill">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-sm-5">
                                <h5>{{ __('message.My_Recent_Plates') }}</h5>
                            </div>
                            <div class="col-sm-7 text-sm-end">
                                <div class="booking-select">
                                    <select class="form-control select">
                                        <option>{{ __('message.All_Plates') }}</option>
                                        <option>{{ __('message.Available') }}</option>
                                        <option>{{ __('message.Sold') }}</option>
                                    </select>
                                    <a href="{{ route('user.plates') }}"
                                        class="view-link">{{ __('message.View_all_Plates') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive dashboard-table dashboard-table-info">
                            <table class="table">
                                <tbody>
                                    @forelse($recentPlates ?? [] as $plate)
                                    <tr>
                                        <td>
                                            <div class="table-avatar">

                                                <!-- <img class="avatar-img" src="{{ $plate->image_url }}" alt="Plate Image"> -->

                                                <div class="table-head-name flex-grow-1">
                                                    <a href="">
                                                        {{ $plate->emirate->name }} - {{ $plate->code->name }} {{
                                                        $plate->number }}</a>
                                                    <p>{{ __('message.Listed') }}: {{
                                                        $plate->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h6>{{ __('message.Emirate') }}</h6>
                                            <p>{{ $plate->emirate->name }}</p>
                                        </td>
                                        <td>
                                            <h6>{{ __('message.Code') }}</h6>
                                            <p>{{ $plate->code->name }}</p>
                                        </td>
                                        <td>
                                            <h6>{{ __('message.Price') }}</h6>
                                            <h5 class="text-success">{{ $plate->price_digits }}</h5>
                                        </td>
                                        <td>
                                            <span class="badge badge-light-{{ $plate->is_sold ? 'danger' : 'success' }}">
                                                {{ $plate->is_sold ? __('message.Sold') : __('message.Available') }}
                                            </span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <div class="empty-state">
                                                <i class="feather-tag fs-1 text-muted mb-3"></i>
                                                <h6>{{ __('message.No_plates_listed_yet') }}</h6>
                                                <p class="text-muted">{{ __('message.Start_listing_your_plates') }}</p>
                                                <a href="{{ route('user.plates.create') }}"
                                                    class="btn btn-primary">{{ __('message.Add_New_Plate') }}</a>
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
            <!-- /My Recent Plates -->

            <!-- Market Insights -->
            <div class="col-lg-4 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5>{{ __('message.Market_Insights') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="popular-emirates mb-4">
                            <h6 class="mb-3">{{ __('message.Popular_Emirates') }}</h6>
                            @foreach($popularEmirates ?? [] as $emirate)
                            <div class="d-flex justify-content-between mb-2">
                                <span>{{ $emirate->name }}</span>
                                <span class="text-success">{{ $emirate->plates_count }} {{ __('message.plates') }}</span>
                            </div>
                            @endforeach
                        </div>

                        <div class="price-range">
                            <h6 class="mb-3">{{ __('message.Price_Range') }}</h6>
                            <div class="d-flex justify-content-between mb-2">
                                <span>{{ __('message.Average_Price') }}</span>
                                <span class="text-success">{{ $averagePrice ?? 'N/A' }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>{{ __('message.Highest_Price') }}</span>
                                <span class="text-success">{{ $highestPrice ?? 'N/A' }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>{{ __('message.Lowest_Price') }}</span>
                                <span class="text-success">{{ $lowestPrice ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Market Insights -->
        </div>
        <!-- /Dashboard -->
    </div>
</div>
<!-- /Page Content -->

<!-- Footer -->
@endsection