@extends('layouts.dealer')
@section('title', 'Dashboard')
@section('heading', 'Dashboard')

@section('content')
    <div class="dashboard-right-box">
        <div class="custm-card dashboard-custm-card">
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="db-analytics-card">
                        <div class="db-analytics-data">
                            <h3>Total Orders</h3>
                            <h5>{{$ordersCount ?? 'N/A'}}</h5>
                        </div>
                        <div class="db-analytics-img">
                            <img src="{{ asset('assets/images/totalUsers.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="db-analytics-card">
                        <div class="db-analytics-data">
                            <h3>Total Payment Earned</h3>
                            <h5>{{ isset($totalAmountOfAllOrders) ? '$' . number_format($totalAmountOfAllOrders, 2) : 'N/A' }}</h5>
                        </div>
                        <div class="db-analytics-img">
                            <img src="{{ asset('assets/images/earning.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="db-analytics-card">
                        <div class="db-analytics-data">
                            <h3>Total Fulfilled Orders</h3>
                            <h5>{{ $fulfilledOrders ?? 'N/A' }}</h5>
                        </div>
                        <div class="db-analytics-img">
                            <img src="{{ asset('assets/images/timer.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="db-analytics-card">
                        <div class="db-analytics-data">
                            <h3>Total Pending Orders</h3>
                            <h5>{{ $pendingOrders ?? 'N/A' }}</h5>
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
