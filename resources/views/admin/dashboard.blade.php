 @extends('layouts.admin')
 @section('title')
 @section('heading', 'Dashboard')

 @section('content')
     <div class="main-content">
        <div class="dashboard-right-box">
            <div class="custm-card dashboard-custm-card">
                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="db-analytics-card">
                            <div class="db-analytics-data">
                                <h3>Total Dealers</h3>
                                <h5>{{$dealers ?? 'N/A'}}</h5>
                            </div>
                            <div class="db-analytics-img">
                                <img src="{{ asset('assets/images/totalUsers.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="db-analytics-card">
                            <div class="db-analytics-data">
                                <h3>Order Amount + Shipping Charges</h3>
                                <h5>{{isset($totalOrderPlacedAmount) ? '$' . number_format($totalOrderPlacedAmount, 2) : 'N/A' }}</h5>
                            </div>
                            <div class="db-analytics-img">
                                <img src="{{ asset('assets/images/earning.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="db-analytics-card">
                            <div class="db-analytics-data">
                                <h3>Total Placed Orders</h3>
                                <h5>{{$placedOrdersCount ?? 'N/A'}}</h5>
                            </div>
                            <div class="db-analytics-img">
                                <img src="{{ asset('assets/images/timer.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-3">
                        <div class="db-analytics-card">
                            <div class="db-analytics-data">
                                <h3>Total Orders</h3>
                                <h5>4</h5>
                            </div>
                            <div class="db-analytics-img">
                                <img src="{{ asset('assets/images/timer.png') }}" alt="">
                            </div>
                        </div>
                    </div> --}}
                </div>
                
            </div>
        </div>

        
     </div>
 @endsection
