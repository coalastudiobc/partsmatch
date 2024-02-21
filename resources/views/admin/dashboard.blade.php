@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="main-content">
		<div class="card">
			<x-alert-component />

			<div class="card-header">
				<x-search-form :nameField="false" />
			</div>
		</div>
		<section class="section">
		<div class="row ">
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="card">
					<div class="card-statistic-4">
						<div class="align-items-center justify-content-between">
							<div class="row ">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
									<div class="card-content">
										<h5 class="font-15"> Total Dealers</h5>
										<h2 class="mb-3 font-18"> {{$dealers ?? 0}} </h2>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
									<div class="banner-img">
										<img src="{{ asset('assets/img/banner/1.png') }}" alt="">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

@endsection
@push('scripts')
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/js/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/js/index.js') }}"></script>
@endpush
