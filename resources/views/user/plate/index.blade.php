@extends('layouts.app')

@section('content')






<!-- Sort By -->
<!-- <div class="sort-section">
    <div class="container">
        <div class="sortby-sec">
            <div class="sorting-div">
                <div class="row d-flex align-items-center">
                    <div class="col-xl-4 col-lg-3 col-sm-12 col-12">
                        <div class="count-search">
                            <p>Showing 1-9 of 154 Cars</p>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-9 col-sm-12 col-12">
                        <div class="product-filter-group">
                            <div class="sortbyset">
                                <ul>
                                    <li>
                                        <span class="sortbytitle">Show : </span>
                                        <div class="sorting-select select-one">
                                            <select class="form-control select">
                                                <option>5</option>
                                                <option>10</option>
                                                <option>15</option>
                                                <option>20</option>
                                                <option>30</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="sortbytitle">Sort By </span>
                                        <div class="sorting-select select-two">
                                            <select class="form-control select">
                                                <option>Newest</option>
                                                <option>Relevance</option>
                                                <option>Low to High</option>
                                                <option>High to Low</option>
                                                <option>Best Rated</option>
                                                <option>Distance</option>
                                                <option>Popularity</option>
                                            </select>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="grid-listview">
                                <ul>
                                    <li>
                                        <a href="listing-grid.html">
                                            <i class="feather-grid"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="listing-list.html" class="active">
                                            <i class="feather-list"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="listing-map.html">
                                            <i class="feather-map-pin"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- /Sort By -->

<!-- Car Grid View -->
<section class="section car-listing pt-0">
    <div class="container">
        <div class="row">

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <div class="col-xl-9 col-lg-8 col-sm-12 col-12 m-auto">
                <div class="row">
                    @forelse ($plates as $plate)
                    <div class="listview-car">
                        <div class="card">
                            <div class="blog-widget d-flex">
                                <div class="blog-img">
                                    <img src="{{ asset ('assets/img/car-list-1.jpg') }}" class="img-fluid"
                                        alt="Toyota" width="400">


                                </div>
                                <div class="bloglist-content w-100">
                                    <div class="card-body">
                                        <div class="blog-list-head d-flex">
                                            <div class="blog-list-title">
                                                <!-- <h3><a href=""> {{ $plate->number }}</a></h3> -->
                                                <h3>Code : <span>{{ $plate->code }}</span></h3>
                                                <h3>Number : <span>{{ $plate->number }}</span></h3>
                                                <h3>Length : <span>{{ $plate->length }}</span></h3>
                                            </div>
                                            <div class="blog-list-rate">

                                                <h6>{{ $plate->price }} AED<span></span></h6>
                                            </div>
                                        </div>

                                        <div class="blog-list-head list-head-bottom d-flex">

                                            <div class="listing-button">

                                                <a href="{{ route('user.plates.edit', $plate->id) }}" class="btn btn-order">
                                                    <span><i class="feather-calendar me-2"></i></span>Edit
                                                </a>

                                                <form action="{{ route('user.plates.destroy', $plate->id) }}" method="POST" style="display:inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-order" onclick="return confirm('Are you sure you want to delete this plate?')">
                                                        <span><i class="feather-trash me-2"></i></span>Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="feature-text">
                                    <span class="bg-danger">Featured</span>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="listview-car">
                        <div class="card">
                            <h5>Plates list empty</h5>
                        </div>
                    </div>
                    @endforelse
                    <!-- <div class="listview-car">
                        <div class="card">
                            <div class="blog-widget d-flex">
                                <div class="blog-img">
                                    <a href="listing-details.html">
                                        <img src="assets/img/car-list-2.jpg" class="img-fluid" alt="blog-img">
                                    </a>
                                    <div class="fav-item justify-content-end">
                                        <a href="javascript:void(0)" class="fav-icon">
                                            <i class="feather-heart"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="bloglist-content w-100">
                                    <div class="card-body">
                                        <div class="blog-list-head d-flex">
                                            <div class="blog-list-title">
                                                <h3><a href="listing-details.html">BMW 640 XI Gran Turismo</a></h3>
                                                <h6>Category : <span>BMW</span></h6>
                                            </div>
                                            <div class="blog-list-rate">
                                                <div class="list-rating">
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star"></i>
                                                    <span>165 Reviews</span>
                                                </div>
                                                <h6>$60 <span>/ Day</span></h6>
                                            </div>
                                        </div>
                                        <div class="listing-details-group">
                                            <ul>
                                                <li>
                                                    <span><img src="assets/img/icons/car-parts-05.svg" alt="Auto"></span>
                                                    <p>Auto</p>
                                                </li>
                                                <li>
                                                    <span><img src="assets/img/icons/car-parts-02.svg" alt="10 KM"></span>
                                                    <p>13 KM</p>
                                                </li>
                                                <li>
                                                    <span><img src="assets/img/icons/car-parts-03.svg" alt="Petrol"></span>
                                                    <p>Petrol</p>
                                                </li>
                                                <li>
                                                    <span><img src="assets/img/icons/car-parts-04.svg" alt="Power"></span>
                                                    <p>Normal</p>
                                                </li>
                                                <li>
                                                    <span><img src="assets/img/icons/car-parts-06.svg" alt="Persons"></span>
                                                    <p>6 Persons</p>
                                                </li>
                                                <li>
                                                    <span><img src="assets/img/icons/car-parts-05.svg" alt="2018"></span>
                                                    <p>2021</p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="blog-list-head list-head-bottom d-flex">
                                            <div class="blog-list-title">
                                                <div class="title-bottom">
                                                    <div class="car-list-icon">
                                                        <img src="assets/img/profiles/avatar-03.jpg" alt="user">
                                                    </div>
                                                    <div class="address-info">
                                                        <h6><i class="feather-map-pin"></i>Pattaya, Thailand</h6>
                                                    </div>
                                                    <div class="list-km">
                                                        <span class="km-count"><img src="assets/img/icons/map-pin.svg" alt="author">3.7m</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="listing-button">
                                                <a href="listing-details.html" class="btn btn-order"><span><i class="feather-calendar me-2"></i></span>Rent Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="listview-car">
                        <div class="card">
                            <div class="blog-widget d-flex">
                                <div class="blog-img">
                                    <a href="listing-details.html">
                                        <img src="assets/img/car-list-3.jpg" class="img-fluid" alt="blog-img">
                                    </a>
                                    <div class="fav-item justify-content-end">
                                        <a href="javascript:void(0)" class="fav-icon">
                                            <i class="feather-heart"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="bloglist-content w-100">
                                    <div class="card-body">
                                        <div class="blog-list-head d-flex">
                                            <div class="blog-list-title">
                                                <h3><a href="listing-details.html">Ford Mustang, Blue 2014</a></h3>
                                                <h6>Category : <span>Ford</span></h6>
                                            </div>
                                            <div class="blog-list-rate">
                                                <div class="list-rating">
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <i class="fas fa-star filled"></i>
                                                    <span>200 Reviews</span>
                                                </div>
                                                <h6>$150<span>/ Day</span></h6>
                                            </div>
                                        </div>
                                        <div class="listing-details-group">
                                            <ul>
                                                <li>
                                                    <span><img src="assets/img/icons/car-parts-01.svg" alt="Auto"></span>
                                                    <p>Auto</p>
                                                </li>
                                                <li>
                                                    <span><img src="assets/img/icons/car-parts-02.svg" alt="10 KM"></span>
                                                    <p>17 KM</p>
                                                </li>
                                                <li>
                                                    <span><img src="assets/img/icons/car-parts-03.svg" alt="Petrol"></span>
                                                    <p>Petrol</p>
                                                </li>
                                                <li>
                                                    <span><img src="assets/img/icons/car-parts-04.svg" alt="Power"></span>
                                                    <p>Power</p>
                                                </li>
                                                <li>
                                                    <span><img src="assets/img/icons/car-parts-06.svg" alt="Persons"></span>
                                                    <p>4 Persons</p>
                                                </li>
                                                <li>
                                                    <span><img src="assets/img/icons/car-parts-05.svg" alt="2018"></span>
                                                    <p>2019</p>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="blog-list-head list-head-bottom d-flex">
                                            <div class="blog-list-title">
                                                <div class="title-bottom">
                                                    <div class="car-list-icon">
                                                        <img src="assets/img/profiles/avatar-06.jpg" alt="user">
                                                    </div>
                                                    <div class="address-info">
                                                        <h6><i class="feather-map-pin"></i>Lasvegas, USA</h6>
                                                    </div>
                                                    <div class="list-km">
                                                        <span class="km-count"><img src="assets/img/icons/map-pin.svg" alt="author">4.0m</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="listing-button">
                                                <a href="listing-details.html" class="btn btn-order"><span><i class="feather-calendar me-2"></i></span>Rent Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="feature-text">
                                    <span class="bg-warning">Top Rated</span>
                                </div>
                            </div>
                        </div>
                    </div> -->

                </div>
                <!--Pagination-->
                <div class="blog-pagination">
                    <nav>
                        <ul class="pagination page-item justify-content-center">
                            <li class="previtem">
                                <a class="page-link" href="#"><i class="fas fa-regular fa-arrow-left me-2"></i> Prev</a>
                            </li>
                            <li class="justify-content-center pagination-center">
                                <div class="page-group">
                                    <ul>
                                        <li class="page-item">
                                            <a class="page-link" href="#">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="active page-link" href="#">2 <span class="visually-hidden">(current)</span></a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">3</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nextlink">
                                <a class="page-link" href="#">Next <i class="fas fa-regular fa-arrow-right ms-2"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!--/Pagination-->

            </div>
        </div>
    </div>
</section>
<!-- /Car Grid View -->

@endsection