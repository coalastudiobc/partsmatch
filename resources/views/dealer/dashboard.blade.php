@extends('layouts.dealer')
@section('title', 'Dashboard')
@section('heading', 'Dashboard')

@section('content')
    
    <div class="dashboard-right-box">
        <div class="custm-card dashboard-custm-card">
            {{-- <div class="row clearfix">
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                            <div class="card-statistic-4">
                                <div class="align-items-center justify-content-between">
                                    <div class="row ">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                            <div class="card-content">
                                                <h5 class="font-15">Total Orders</h5>
                                                <h2 class="mb-3 mt-3  font-18">{{$ordersCount ?? 'N/A'}}</h2>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                            <div class="banner-img">
                                                <img src="{{ asset('assets/images/totalUsers.png') }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">Total Payment Earned</h5>
                                            <h2 class="mb-3 mt-3  font-18">{{ isset($totalAmountOfAllOrders) ? '$' . number_format($totalAmountOfAllOrders, 2) : 'N/A' }}
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="{{ asset('assets/images/earning.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">Total FulFilled Orders</h5>
                                            <h2 class="mb-3 mt-3 font-18"> {{ $fulfilledOrders ?? 'N/A' }}</h2>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="{{ asset('assets/images/timer.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">Total Pending Orders</h5>
                                            <h2 class="mb-3 mt-3 font-18"> {{ $pendingOrders ?? 'N/A' }}</h2>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="{{ asset('assets/images/timer.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div> --}}


            <div class="row g-3">
                <div class="col-md-3">
                    <div class="db-analytics-card">
                        <div class="db-analytics-data">
                            <h3>Total Orders</h3>
                            <h5>4</h5>
                        </div>
                        <div class="db-analytics-img">
                            <img src="{{ asset('assets/images/totalUsers.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="db-analytics-card">
                        <div class="db-analytics-data">
                            <h3>Total Orders</h3>
                            <h5>4</h5>
                        </div>
                        <div class="db-analytics-img">
                            <img src="{{ asset('assets/images/earning.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="db-analytics-card">
                        <div class="db-analytics-data">
                            <h3>Total Orders</h3>
                            <h5>4</h5>
                        </div>
                        <div class="db-analytics-img">
                            <img src="{{ asset('assets/images/timer.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="db-analytics-card">
                        <div class="db-analytics-data">
                            <h3>Total Orders</h3>
                            <h5>4</h5>
                        </div>
                        <div class="db-analytics-img">
                            <img src="{{ asset('assets/images/timer.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

    </div>
@endsection
