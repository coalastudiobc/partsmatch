@extends('layouts.dealer')
@section('title', 'Dashboard')
@section('heading', 'Dashboard')

@section('content')
    <div class="dashboard-right-box">
        <div class="custm-card dashboard-custm-card">
            <div class="row g-3">
                <div class="col-xl-3 col-lg-6 col-md-6">
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
                <div class="col-xl-3 col-lg-6 col-md-6">
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
                <div class="col-xl-3 col-lg-6 col-md-12">
                    <div class="db-analytics-card">
                        <div class="db-analytics-data">
                            <h3>Total Fulfilled Orders</h3>
                            <h5>{{ $fulfilledOrders ?? 'N/A' }}</h5>
                        </div>
                        <div class="db-analytics-img">
                            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="30" height="30"><path d="M12,0C5.383,0,0,5.383,0,12c.603,15.898,23.4,15.894,24,0,0-6.617-5.383-12-12-12Zm0,21c-4.963,0-9-4.037-9-9,.452-11.923,17.549-11.92,18,0,0,4.963-4.037,9-9,9Zm4-6.587c0,1.599-1.052,2.957-2.5,3.418v.669c-.034,1.972-2.966,1.971-3,0v-.579c-.955-.206-1.799-.807-2.299-1.67-.414-.717-.169-1.635,.548-2.05,.716-.414,1.634-.169,2.05,.548,.091,.157,.253,.251,.434,.251h1.181c.629,.018,.809-.917,.218-1.132l-2.376-.95c-3.11-1.155-2.884-5.845,.245-6.749v-.669c.034-1.972,2.967-1.971,3,0v.579c.955,.206,1.799,.807,2.299,1.67,.414,.717,.169,1.635-.548,2.049-.716,.414-1.635,.169-2.05-.547-.091-.157-.253-.251-.434-.251h-1.181c-.629-.018-.809,.917-.218,1.132l2.376,.95c1.37,.548,2.255,1.855,2.255,3.331Z"/></svg>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-xl-3 col-lg-6 col-md-6">
                    <div class="db-analytics-card">
                        <div class="db-analytics-data">
                            <h3>Total Fulfilled Orders</h3>
                            <h5>{{ $fulfilledOrders ?? 'N/A' }}</h5>
                        </div>
                        <div class="db-analytics-img">
                            <img src="{{ asset('assets/images/timer.png') }}" alt="">
                        </div>
                    </div>
                </div> --}}
                <div class="col-xl-3 col-lg-6 col-md-6">
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
