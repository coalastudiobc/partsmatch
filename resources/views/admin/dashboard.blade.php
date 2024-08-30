 @extends('layouts.admin')
 @section('title','Dashboard')
 @section('heading', 'Dashboard')

 @section('content')
     <div class="main-content">
        <div class="dashboard-right-box">
            <div class="custm-card dashboard-custm-card">
                <div class="row g-3">
                    <div class="col-xl-3 col-lg-6 col-md-12">
                        <div class="db-analytics-card">
                            <div class="db-analytics-data">
                                <h3>Total Dealers</h3>
                                <h5>{{$dealers ?? 'N/A'}}</h5>
                            </div>
                            <div class="db-analytics-img">
                                <!-- <img src="{{ asset('assets/images/totalUsers.png') }}" alt=""> -->
                                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="30" height="30">
                                    <path d="m9,12c3.309,0,6-2.691,6-6S12.309,0,9,0,3,2.691,3,6s2.691,6,6,6Zm0-10c2.206,0,4,1.794,4,4s-1.794,4-4,4-4-1.794-4-4,1.794-4,4-4Zm12,17h2v5h-11v-5h2v3h7v-3ZM5,14h4.692l-.923,2h-3.769c-1.654,0-3,1.346-3,3v5H0v-5c0-2.757,2.243-5,5-5Zm19,2c0,1.105-.831,2-1.857,2h-.619c-1.026,0-1.857-.895-1.857-2,0,1.105-.831,2-1.857,2h-.619c-1.026,0-1.857-.895-1.857-2,0,1.105-.831,2-1.857,2h-.619c-1.026,0-1.857-.895-1.857-2l1.238-3h10.524l1.238,3Z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-12">
                        <div class="db-analytics-card">
                            <div class="db-analytics-data">
                                <h3>Order Amount + Shipping Charges</h3>
                                <h5>{{isset($totalOrderPlacedAmount) ? '$' . number_format($totalOrderPlacedAmount, 2) : 'N/A' }}</h5>
                            </div>
                            <div class="db-analytics-img">
                                <!-- <img src="{{ asset('assets/images/earning.png') }}" alt=""> -->
                                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="30" height="30"><path d="M12,0C5.383,0,0,5.383,0,12c.603,15.898,23.4,15.894,24,0,0-6.617-5.383-12-12-12Zm0,21c-4.963,0-9-4.037-9-9,.452-11.923,17.549-11.92,18,0,0,4.963-4.037,9-9,9Zm4-6.587c0,1.599-1.052,2.957-2.5,3.418v.669c-.034,1.972-2.966,1.971-3,0v-.579c-.955-.206-1.799-.807-2.299-1.67-.414-.717-.169-1.635,.548-2.05,.716-.414,1.634-.169,2.05,.548,.091,.157,.253,.251,.434,.251h1.181c.629,.018,.809-.917,.218-1.132l-2.376-.95c-3.11-1.155-2.884-5.845,.245-6.749v-.669c.034-1.972,2.967-1.971,3,0v.579c.955,.206,1.799,.807,2.299,1.67,.414,.717,.169,1.635-.548,2.049-.716,.414-1.635,.169-2.05-.547-.091-.157-.253-.251-.434-.251h-1.181c-.629-.018-.809,.917-.218,1.132l2.376,.95c1.37,.548,2.255,1.855,2.255,3.331Z"/></svg>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-12">
                        <div class="db-analytics-card">
                            <div class="db-analytics-data">
                                <h3>Total Placed Orders</h3>
                                <h5>{{$placedOrdersCount ?? 'N/A'}}</h5>
                            </div>
                            <div class="db-analytics-img">
                                <!-- <img src="{{ asset('assets/images/timer.png') }}" alt=""> -->
                                <svg xmlns="http://www.w3.org/2000/svg" id="Isolation_Mode" data-name="Isolation Mode" viewBox="0 0 24 24" width="30" height="30"><circle cx="7" cy="22" r="2"/><circle cx="17" cy="22" r="2"/><path d="M18.112,15H7.217a.329.329,0,0,1-.325-.3L6.036,8H11V5H5.653L5.391,2.939A3.327,3.327,0,0,0,2.087,0H0V3H2.087a.329.329,0,0,1,.325.3l1.5,11.76A3.327,3.327,0,0,0,7.217,18H20.4l1.65-6H18.938Z"/><path d="M17.069,10.042h.04a2.407,2.407,0,0,0,1.691-.7l5.261-5.261L21.939,1.96l-4.82,4.821-1.89-1.968-2.163,2.08,2.3,2.4A2.4,2.4,0,0,0,17.069,10.042Z"/></svg>
                            </div>
                        </div>
                    </div>
                    <!-- {{-- <div class="col-xl-3 col-lg-6 col-md-12">
                        <div class="db-analytics-card">
                            <div class="db-analytics-data">
                                <h3>Total Orders</h3>
                                <h5>4</h5>
                            </div>
                            <div class="db-analytics-img">
                                <img src="{{ asset('assets/images/timer.png') }}" alt="">
                            </div>
                        </div>
                    </div> --}} -->
                </div>
                
            </div>
        </div>

        
     </div>
 @endsection
