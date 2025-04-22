@extends('layouts.app')

@section('content')


		<!-- Breadscrumb Section -->
		<div class="breadcrumb-bar">
			<div class="container">
				<div class="row align-items-center text-center">
		    		<div class="col-md-12 col-12">
			    	    <h2 class="breadcrumb-title">User Dashboard</h2>
				    	<nav aria-label="breadcrumb" class="page-breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.html">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">User Dashboard</li>
							</ol>
						</nav>							
					</div>
				</div>
			</div>
		</div>
		<!-- /Breadscrumb Section -->		     	
		
		<!-- Dashboard Menu -->
		<div class="dashboard-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="dashboard-menu">
							<ul>
								<li>
									<a href="user-dashboard.html" class="active">
										<img src="assets/img/icons/dashboard-icon.svg" alt="Icon">
										<span>Dashboard</span>
									</a>
								</li>
								<li>
									<a href="user-bookings.html">
										<img src="assets/img/icons/booking-icon.svg" alt="Icon">
										<span>My Bookings</span>
									</a>
								</li>
								<li>
									<a href="user-reviews.html">
										<img src="assets/img/icons/review-icon.svg" alt="Icon">
										<span>Reviews</span>
									</a>
								</li>
								<li>
									<a href="user-wishlist.html">
										<img src="assets/img/icons/wishlist-icon.svg" alt="Icon">
										<span>Wishlist</span>
									</a>
								</li>
								<li>
									<a href="user-messages.html">
										<img src="assets/img/icons/message-icon.svg" alt="Icon">
										<span>Messages</span>
									</a>
								</li>
								<li>
									<a href="user-wallet.html">
										<img src="assets/img/icons/wallet-icon.svg" alt="Icon">
										<span>My Wallet</span>
									</a>
								</li>
								<li>
									<a href="user-payment.html">
										<img src="assets/img/icons/payment-icon.svg" alt="Icon">
										<span>Payments</span>
									</a>
								</li>
								<li>
									<a href="user-settings.html">
										<img src="assets/img/icons/settings-icon.svg" alt="Icon">
										<span>Settings</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Dashboard Menu -->

		<!-- Page Content -->
		<div class="content dashboard-content">
			<div class="container">

				<!-- Status List -->
				<ul class="status-lists">
					<li class="approve-item">
						<div class="status-info">
							<span><i class="fa-solid fa-calendar-days"></i></span>
							<p>Your Booking has been Approved by admin</p>
						</div>
						<a href="javascript:void(0);" class="view-detail">View Details</a>
					</li>
					<li>
						<div class="status-info">
							<span><i class="fa-solid fa-money-bill"></i></span>
							<p>Your Refund request has been approved by admin & your payment will be updated in 3 days.</p>
						</div>
						<a href="javascript:void(0);" class="close-link"><i class="feather-x"></i></a>
					</li>
					<li class="bg-danger-light">
						<div class="status-info">
							<span><i class="fa-solid fa-money-bill"></i></span>
							<p>Your Refund request has been rejected by admin <a href="javascript:void(0);">View Reason</a></p>
						</div>
						<a href="javascript:void(0);" class="close-link"><i class="feather-x"></i></a>
					</li>
				</ul>
				<!-- /Status List -->

				<!-- Content Header -->
				<div class="content-header">
					<h4>Dashboard</h4>
				</div>
				<!-- /Content Header -->

				<!-- Dashboard -->
				<div class="row">

					<!-- Widget Item -->
					<div class="col-lg-3 col-md-6 d-flex">
						<div class="widget-box flex-fill">
							<div class="widget-header">
								<div class="widget-content">
									<h6>My Bookings</h6>
									<h3>450</h3>
								</div>
								<div class="widget-icon">
									<span>
										<img src="assets/img/icons/book-icon.svg" alt="icon">
									</span>
								</div>
							</div>
							<a href="user-bookings.html" class="view-link">View all Bookings <i class="feather-arrow-right"></i></a>
						</div>
					</div>
					<!-- /Widget Item -->

					<!-- Widget Item -->
					<div class="col-lg-3 col-md-6 d-flex">
						<div class="widget-box flex-fill">
							<div class="widget-header">
								<div class="widget-content">
									<h6>Wallet Balance</h6>
									<h3>$24,665</h3>
								</div>
								<div class="widget-icon">
									<span class="bg-warning">
										<img src="assets/img/icons/balance-icon.svg" alt="icon">
									</span>
								</div>
							</div>
							<a href="user-wallet.html" class="view-link">View Balance <i class="feather-arrow-right"></i></a>
						</div>
					</div>
					<!-- /Widget Item -->

					<!-- Widget Item -->
					<div class="col-lg-3 col-md-6 d-flex">
						<div class="widget-box flex-fill">
							<div class="widget-header">
								<div class="widget-content">
									<h6>Total Transactions</h6>
									<h3>$15,210</h3>
								</div>
								<div class="widget-icon">
									<span class="bg-success">
										<img src="assets/img/icons/transaction-icon.svg" alt="icon">
									</span>
								</div>
							</div>
							<a href="user-payment.html" class="view-link">View all Transactions <i class="feather-arrow-right"></i></a>
						</div>
					</div>
					<!-- /Widget Item -->

					<!-- Widget Item -->
					<div class="col-lg-3 col-md-6 d-flex">
						<div class="widget-box flex-fill">
							<div class="widget-header">
								<div class="widget-content">
									<h6>Wishlist Cars</h6>
									<h3>24</h3>
								</div>
								<div class="widget-icon">
									<span class="bg-danger">
										<img src="assets/img/icons/cars-icon.svg" alt="icon">
									</span>
								</div>
							</div>
							<a href="user-wishlist.html" class="view-link">Go to Wishlist <i class="feather-arrow-right"></i></a>
						</div>
					</div>
					<!-- /Widget Item -->

				</div>				

				<div class="row">

					<!-- Last 5 Bookings -->
					<div class="col-lg-8 d-flex">
						<div class="card user-card flex-fill">
							<div class="card-header">	
								<div class="row align-items-center">
									<div class="col-sm-5">
										<h5>Last 5 Bookings</h5>	
									</div>
									<div class="col-sm-7 text-sm-end">
										<div class="booking-select">
											<select class="form-control select">
												<option>Last 30 Days</option>
												<option>Last 7 Days</option>
											</select>
										<a href="user-bookings.html" class="view-link">View all Bookings</a>
										</div>
									</div>
								</div>
							</div>
							<div class="card-body p-0">	
								<div class="table-responsive dashboard-table dashboard-table-info">
									<table class="table">
										<tbody>
											<tr>
												<td>
													<div class="table-avatar">
														<a href="user-bookings.html" class="avatar avatar-lg flex-shrink-0">
															<img class="avatar-img" src="assets/img/cars/car-04.jpg" alt="Booking">
														</a>
														<div class="table-head-name flex-grow-1">
															<a href="user-bookings.html">Ferrari 458 MM Speciale</a>
															<p>Rent Type : Hourly</p>
														</div>
													</div>
												</td>
												<td>
													<h6>Start date</h6>
													<p>15 Sep 2023, 11:30 PM</p>
												</td>
												<td>
													<h6>End Date</h6>
													<p>15 Sep 2023, 1:30 PM</p>
												</td>
												<td>
													<h6>Price</h6>
													<h5 class="text-danger">$200</h5>
												</td>
												<td>
													<span class="badge badge-light-secondary">Upcoming</span>
												</td>
											</tr>
											<tr>
												<td>
													<div class="table-avatar">
														<a href="user-bookings.html" class="avatar avatar-lg flex-shrink-0">
															<img class="avatar-img" src="assets/img/cars/car-05.jpg" alt="Booking">
														</a>
														<div class="table-head-name flex-grow-1">
															<a href="user-bookings.html">Kia Soul 2016</a>
															<p>Rent Type : Hourly</p>
														</div>
													</div>
												</td>
												<td>
													<h6>Start date</h6>
													<p>15 Sep 2023, 09:00 AM</p>
												</td>
												<td>
													<h6>End Date</h6>
													<p>15 Sep 2023, 1:30 PM</p>
												</td>
												<td>
													<h6>Price</h6>
													<h5 class="text-danger">$300</h5>
												</td>
												<td>
													<span class="badge badge-light-secondary">Upcoming</span>
												</td>
											</tr>
											<tr>
												<td>
													<div class="table-avatar">
														<a href="user-bookings.html" class="avatar avatar-lg flex-shrink-0">
															<img class="avatar-img" src="assets/img/cars/car-01.jpg" alt="Booking">
														</a>
														<div class="table-head-name flex-grow-1">
															<a href="user-bookings.html">Toyota Camry SE 350</a>
															<p>Rent Type : Day</p>
														</div>
													</div>
												</td>
												<td>
													<h6>Start date</h6>
													<p>18 Sep 2023, 09:00 AM</p>
												</td>
												<td>
													<h6>End Date</h6>
													<p>18 Sep 2023, 05:00 PM</p>
												</td>
												<td>
													<h6>Price</h6>
													<h5 class="text-danger">$600</h5>
												</td>
												<td>
													<span class="badge badge-light-warning">Inprogress</span>
												</td>
											</tr>
											<tr>
												<td>
													<div class="table-avatar">
														<a href="user-bookings.html" class="avatar avatar-lg flex-shrink-0">
															<img class="avatar-img" src="assets/img/cars/car-03.jpg" alt="Booking">
														</a>
														<div class="table-head-name flex-grow-1">
															<a href="user-bookings.html">Audi A3 2019 new</a>
															<p>Rent Type : Weekly</p>
														</div>
													</div>
												</td>
												<td>
													<h6>Start date</h6>
													<p>10 Oct 2023, 10:30 AM</p>
												</td>
												<td>
													<h6>End Date</h6>
													<p>16 Oct 2023, 10:30 AM</p>
												</td>
												<td>
													<h6>Price</h6>
													<h5 class="text-danger">$800</h5>
												</td>
												<td>
													<span class="badge badge-light-success">Completed</span>
												</td>
											</tr>
											<tr>
												<td>
													<div class="table-avatar">
														<a href="user-bookings.html" class="avatar avatar-lg flex-shrink-0">
															<img class="avatar-img" src="assets/img/cars/car-05.jpg" alt="Booking">
														</a>
														<div class="table-head-name flex-grow-1">
															<a href="user-bookings.html">2018 Chevrolet Camaro</a>
															<p>Rent Type : Hourly</p>
														</div>
													</div>
												</td>
												<td>
													<h6>Start date</h6>
													<p>14 Nov 2023, 02:00 PM</p>
												</td>
												<td>
													<h6>End Date</h6>
													<p>14 Nov 2023, 04:00 PM</p>
												</td>
												<td>
													<h6>Price</h6>
													<h5 class="text-danger">$240</h5>
												</td>
												<td>
													<span class="badge badge-light-success">Completed</span>
												</td>
											</tr>
											<tr>
												<td>
													<div class="table-avatar">
														<a href="user-bookings.html" class="avatar avatar-lg flex-shrink-0">
															<img class="avatar-img" src="assets/img/cars/car-06.jpg" alt="Booking">
														</a>
														<div class="table-head-name flex-grow-1">
															<a href="user-bookings.html">Acura Sport Version</a>
															<p>Rent Type : Monthly</p>
														</div>
													</div>
												</td>
												<td>
													<h6>Start date</h6>
													<p>01 Dec 2023, 08:15 AM</p>
												</td>
												<td>
													<h6>End Date</h6>
													<p>01 Jan 2024, 08:15 AM</p>
												</td>
												<td>
													<h6>Price</h6>
													<h5 class="text-danger">$1000</h5>
												</td>
												<td>
													<span class="badge badge-light-danger">Cancelled</span>
												</td>
											</tr>
										</tbody>
									</table>
								</div>	
							</div>
						</div>
					</div>
					<!-- /Last 5 Bookings -->

					<!-- Recent Transaction -->
					<div class="col-lg-4 d-flex">
						<div class="card user-card flex-fill">
							<div class="card-header">	
								<div class="row align-items-center">
									<div class="col-sm-6">
										<h5>Recent Transaction</h5>	
									</div>
									<div class="col-sm-6 text-sm-end">
										<div class="booking-select">
											<select class="form-control select">
												<option>Last 30 Days</option>
												<option>Last 7 Days</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="card-body p-0">	
								<div class="table-responsive dashboard-table dashboard-table-info">
									<table class="table">
										<tbody>
											<tr>
												<td class="border-0">
													<div class="table-avatar">
														<a href="user-bookings.html" class="avatar avatar-md flex-shrink-0">
															<img class="avatar-img" src="assets/img/cars/car-04.jpg" alt="Booking">
														</a>
														<div class="table-head-name flex-grow-1">
															<a href="user-bookings.html">Ferrari 458 MM Speciale</a>
															<p>Rent Type : Hourly</p>
														</div>
													</div>
												</td>
												<td class="border-0 text-end">
													<span class="badge badge-light-secondary">Upcoming</span>
												</td>
											</tr>
											<tr>
												<td colspan="2" class="pt-0">
													<div class="status-box">
														<p><span>Status : </span>On 15 Sep 2023, 11:30 PM</p>
													</div>
												</td>
											</tr>
											<tr>
												<td class="border-0">
													<div class="table-avatar">
														<a href="user-bookings.html" class="avatar avatar-md flex-shrink-0">
															<img class="avatar-img" src="assets/img/cars/car-07.jpg" alt="Booking">
														</a>
														<div class="table-head-name flex-grow-1">
															<a href="user-bookings.html">Chevrolet Pick Truck 3.5L</a>
															<p>Rent Type : Day</p>
														</div>
													</div>
												</td>
												<td class="border-0 text-end">
													<span class="badge badge-light-warning">Refund started </span>
												</td>
											</tr>
											<tr>
												<td colspan="2" class="pt-0">
													<div class="status-box">
														<p><span>Status : </span>Yet to recieve</p>
													</div>
												</td>
											</tr>
											<tr>
												<td class="border-0">
													<div class="table-avatar">
														<a href="user-bookings.html" class="avatar avatar-md flex-shrink-0">
															<img class="avatar-img" src="assets/img/cars/car-08.jpg" alt="Booking">
														</a>
														<div class="table-head-name flex-grow-1">
															<a href="user-bookings.html">Toyota Tacoma 4WD</a>
															<p>Rent Type : Weekly</p>
														</div>
													</div>
												</td>
												<td class="border-0 text-end">
													<span class="badge badge-light-danger">Cancelled</span>
												</td>
											</tr>
											<tr>
												<td colspan="2" class="pt-0">
													<div class="status-box">
														<p><span>Status : </span>On 15 Sep 2023, 11:30 PM</p>
													</div>
												</td>
											</tr><tr>
												<td class="border-0">
													<div class="table-avatar">
														<a href="user-bookings.html" class="avatar avatar-md flex-shrink-0">
															<img class="avatar-img" src="assets/img/cars/car-01.jpg" alt="Booking">
														</a>
														<div class="table-head-name flex-grow-1">
															<a href="user-bookings.html">Ford Mustang 4.0 AT</a>
															<p>Rent Type : Monthly</p>
														</div>
													</div>
												</td>
												<td class="border-0 text-end">
													<span class="badge badge-light-success">Completed</span>
												</td>
											</tr>
											<tr>
												<td colspan="2" class="pt-0 pb-0 border-0">
													<div class="status-box">
														<p><span>Status : </span>On 20 Dec 2023, 05:20 PM</p>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>	
							</div>
						</div>
					</div>
					<!-- /Recent Transaction -->

				</div>			
				<!-- /Dashboard -->						

			</div>			
		</div>
		<!-- /Page Content -->

        <!-- Footer -->
		@endsection