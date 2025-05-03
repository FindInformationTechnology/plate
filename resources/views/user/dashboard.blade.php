@extends('layouts.app')

@section('content')






<!-- Page Content -->
<div class="content dashboard-content">
	<div class="container">
		<div class="row">
			<!-- Last 5 Bookings -->
			<div class="col-lg-8 d-flex mx-auto">
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
									<a href="" class="view-link">View all Bookings</a>
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
												<a href="#" class="avatar avatar-lg flex-shrink-0">
													<img class="avatar-img" src="{{  asset ('assets/img/cars/car-04.jpg') }}" alt="image">
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

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- /Last 5 Bookings -->



		</div>
		<!-- /Dashboard -->

	</div>
</div>
<!-- /Page Content -->

<!-- Footer -->
@endsection