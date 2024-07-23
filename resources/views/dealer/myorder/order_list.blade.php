@extends('layouts.dealer')
@section('title', 'My Orders')
@section('heading', 'Order')

@section('content')

    <div class="dashboard-right-box">
        <div class="serach-and-filter-box">
            {{-- <form action="">
                <div class="pro-search-box">
                    <input type="text" name="filter_by_name" class="form-control" placeholder="Search Product By Name">
                    <button type="submit" class="btn primary-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form> --}}
            {{-- <div class="pro-filter">
                <p>Filter:</p>
                <a href="#" class="btn primary-btn outline-btn"><img src="images/calender-icon.png"
                        alt="">Select Date</a>
            </div> --}}
        </div>
        <div class="product-detail-table product-list-table">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>OrderId</th>
                        <th>Total product</th>
                        <th>Total price</th>
                        <th>Quantity</th>
                        <th>Shipment Price</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>

                    @forelse ($orders as $key => $order)
                        <tr>
                            <td>
                                <div class="pro-list-name">
                                    {{-- <input type="checkbox" class="custm-check" class="custm-check"> --}}
                                    <h4>{{ $order->id }}</h4>
                                </div>
                            </td>
                            <td>
                                <p>{{ count($order->orderItem) }}</p>
                            </td>
                            <td>
                                <p>${{ $order->total_amount }}</p>
                            </td>

                            <td>
                                <p>{{ $order->orderItem[0]->quantity }}</p>
                            </td>
                            <td>
                                <p>${{ $order->shipment_price }}</p>
                            </td>
                            <td>
                                <p>{{ date('d-m-Y', strtotime($order->created_at)) }}</p>
                            </td>

                            <td>
                                <div class="pro-status">

                                    <div class="dropdown">

                                        {{-- <div class="badge complete-badge" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="fa-solid fa-check"></i> Complete
                                        </div> --}}
                                        <a href="#" class="btn primary-btn"><i class="fa-solid fa-eye"></i> view</a>
                                        {{-- <ul class="dropdown-menu"
                                                                aria-labelledby="dropdownMenuButton1">
                                                                <li><a class="dropdown-item" href="#"><i
                                                                            class="fa-solid fa-check"></i> Confirmed</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="#">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="14" height="14"
                                                                            viewBox="0 0 14 14" fill="none">
                                                                            <path
                                                                                d="M5.2513 10.7917C5.2513 11.0801 5.16577 11.3621 5.00553 11.6019C4.84529 11.8417 4.61752 12.0286 4.35105 12.139C4.08457 12.2494 3.79135 12.2782 3.50846 12.222C3.22557 12.1657 2.96572 12.0268 2.76177 11.8229C2.55782 11.6189 2.41893 11.3591 2.36266 11.0762C2.30639 10.7933 2.33527 10.5001 2.44564 10.2336C2.55602 9.96711 2.74294 9.73935 2.98276 9.57911C3.22258 9.41886 3.50454 9.33333 3.79297 9.33333C4.17974 9.33333 4.55068 9.48698 4.82417 9.76047C5.09766 10.034 5.2513 10.4049 5.2513 10.7917ZM10.2096 9.33333C9.9212 9.33333 9.63925 9.41886 9.39943 9.57911C9.15961 9.73935 8.97269 9.96711 8.86231 10.2336C8.75193 10.5001 8.72305 10.7933 8.77932 11.0762C8.83559 11.3591 8.97449 11.6189 9.17844 11.8229C9.38239 12.0268 9.64224 12.1657 9.92513 12.222C10.208 12.2782 10.5012 12.2494 10.7677 12.139C11.0342 12.0286 11.262 11.8417 11.4222 11.6019C11.5824 11.3621 11.668 11.0801 11.668 10.7917C11.668 10.4049 11.5143 10.034 11.2408 9.76047C10.9673 9.48698 10.5964 9.33333 10.2096 9.33333ZM7.0013 1.75H1.7513C1.59659 1.75 1.44822 1.81146 1.33882 1.92085C1.22943 2.03025 1.16797 2.17862 1.16797 2.33333V4.66667H7.58464V2.33333C7.58464 2.17862 7.52318 2.03025 7.41378 1.92085C7.30439 1.81146 7.15601 1.75 7.0013 1.75ZM1.16797 9.33333C1.1687 9.41683 1.18761 9.49916 1.22337 9.57461C1.25913 9.65006 1.31089 9.71682 1.37505 9.77025C1.57976 9.28271 1.92737 8.86862 2.37208 8.58255C2.81679 8.29647 3.33773 8.15183 3.86627 8.16769C4.39481 8.18354 4.90614 8.35914 5.33291 8.67135C5.75967 8.98356 6.08184 9.41773 6.25697 9.91667H7.58464V5.83333H1.16797V9.33333ZM8.7513 3.5V8.61117C9.07242 8.39574 9.43723 8.25402 9.81956 8.19617C10.2019 8.13832 10.5923 8.16577 10.9628 8.27656C11.3333 8.38734 11.6746 8.57871 11.9625 8.83695C12.2503 9.09519 12.4774 9.4139 12.6276 9.77025C12.6917 9.71682 12.7435 9.65006 12.7792 9.57461C12.815 9.49916 12.8339 9.41683 12.8346 9.33333V5.83333L11.0846 3.5H8.7513Z"
                                                                                fill="#5C5C5C" />
                                                                        </svg>
                                                                        Picked Up
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="#">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="14" height="14"
                                                                            viewBox="0 0 14 14" fill="none">
                                                                            <g clip-path="url(#clip0_280_3087)">
                                                                                <path
                                                                                    d="M7.05488 11.0723C7.05497 10.3224 7.27361 9.58884 7.68407 8.96129C8.09453 8.33374 8.679 7.83943 9.36597 7.53884C10.0529 7.23825 10.8126 7.1444 11.5521 7.26879C12.2916 7.39317 12.9788 7.73039 13.5296 8.2392C13.5478 6.92105 13.5369 5.60289 13.4968 4.28474C13.4749 3.37912 12.9636 2.46994 12.1069 2.02068C11.6667 1.78799 11.2106 1.56404 10.7493 1.35185C8.92656 1.94138 6.79183 2.71904 4.63879 3.68181C4.43178 3.77331 4.25444 3.92081 4.12676 4.10768C3.99907 4.29455 3.92611 4.51336 3.91609 4.73947C3.88246 5.77853 3.87207 6.85095 3.88574 7.91134C3.88684 7.94244 3.87794 7.97308 3.86035 7.99874C3.84276 8.02441 3.8174 8.04376 3.78799 8.05395C3.75859 8.06414 3.72669 8.06463 3.69699 8.05535C3.66729 8.04607 3.64134 8.02751 3.62297 8.0024C3.3951 7.71073 3.17253 7.42235 2.95523 7.13724C2.93919 7.11496 2.91535 7.09952 2.88845 7.094C2.86156 7.08847 2.83356 7.09327 2.81004 7.10744C2.64105 7.20806 2.47508 7.30732 2.31211 7.40521C2.22078 7.4599 2.1084 7.38689 2.10785 7.27451C2.10238 6.21822 2.12863 5.1592 2.18523 4.13271C2.20902 3.69986 2.48055 3.29217 2.88223 3.09365C4.94723 2.07373 7.15031 1.24056 9.03019 0.623962C8.59269 0.45279 8.15765 0.295837 7.73301 0.147087C7.16043 -0.0495173 6.53863 -0.0495173 5.96605 0.147087C4.5491 0.635993 3.00172 1.2742 1.59187 2.02068C0.735469 2.46994 0.224687 3.37912 0.201992 4.28474C0.146211 6.0949 0.146211 7.90506 0.201992 9.71521C0.223867 10.6208 0.735469 11.53 1.59187 11.9793C3.00172 12.7258 4.5491 13.364 5.96687 13.8526C6.53945 14.0492 7.16125 14.0492 7.73383 13.8526C7.8576 13.8099 7.98256 13.7659 8.10871 13.7205C7.42982 13.0062 7.05239 12.0577 7.05488 11.0723Z"
                                                                                    fill="#5C5C5C" />
                                                                                <path
                                                                                    d="M10.9118 8.1449C10.3328 8.14495 9.76673 8.31671 9.2853 8.63846C8.80388 8.9602 8.42867 9.41748 8.20713 9.95246C7.98559 10.4875 7.92767 11.0761 8.04068 11.644C8.1537 12.2119 8.43259 12.7336 8.84207 13.143C9.25155 13.5524 9.77325 13.8312 10.3412 13.9441C10.9091 14.057 11.4978 13.999 12.0327 13.7773C12.5676 13.5557 13.0249 13.1804 13.3465 12.6989C13.6682 12.2174 13.8398 11.6514 13.8398 11.0723C13.8397 10.6878 13.764 10.3072 13.6168 9.95196C13.4696 9.59677 13.254 9.27404 12.9821 9.00221C12.7102 8.73037 12.3874 8.51475 12.0322 8.36765C11.677 8.22055 11.2963 8.14486 10.9118 8.1449ZM12.5817 10.5878L10.8218 12.4357C10.774 12.4861 10.7164 12.5262 10.6526 12.5538C10.5887 12.5813 10.52 12.5956 10.4505 12.5959H10.448C10.379 12.5959 10.3106 12.582 10.2469 12.5551C10.1833 12.5282 10.1257 12.4888 10.0775 12.4392L9.14375 11.4773C9.04839 11.379 8.99596 11.2469 8.99802 11.11C9.00007 10.9731 9.05642 10.8426 9.15469 10.7472C9.25295 10.6518 9.38508 10.5994 9.52199 10.6015C9.65891 10.6035 9.7894 10.6599 9.88477 10.7581L10.445 11.3348L11.8344 9.87576C11.9299 9.78215 12.058 9.72928 12.1918 9.72827C12.3255 9.72726 12.4544 9.77819 12.5514 9.87034C12.6483 9.96249 12.7057 10.0887 12.7115 10.2223C12.7172 10.3559 12.6709 10.4866 12.5822 10.5867L12.5817 10.5878Z"
                                                                                    fill="#5C5C5C" />
                                                                            </g>
                                                                            <defs>
                                                                                <clipPath id="clip0_280_3087">
                                                                                    <rect width="14" height="14"
                                                                                        fill="white" />
                                                                                </clipPath>
                                                                            </defs>
                                                                        </svg>
                                                                        Delivered
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="#">
                                                                        <i class="fa-solid fa-xmark"></i>
                                                                        Cancelled
                                                                    </a>
                                                                </li>
                                                            </ul> --}}
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <div class="empty-data">
                            <img src="{{ asset('assets/images/no-product.svg') }}  " alt="" width="300">
                            <p class="text-center mt-1">Did not found any order</p>
                        </div>
                    @endforelse

                </table>
            </div>
        </div>
        <div class="shipper-page-main-outer">
            <div class="shipper-page-main">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="checkout-main-card cstm-card">
                            <div class="shipment-address-box">
                                <div class="shipment-address-header">
                                    <h3>Recipient</h3>
                                    <a href="#">Edit Resipient</a>
                                </div>
                                <h4>Walters Cooley LLC</h4>
                                <p>9201 Circuit of the Americas Blvd, Del Valle, TX  78617, United States</p>
                                <div class="shipment-address-mail-phone">
                                    <a href="#">cyhujequ@mailinator.com</a>
                                    <a href="#">0015877742066</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="checkout-main-card cstm-card">
                            <div class="shipment-id-box">
                                <div class="shipment-address-box">
                                    <div class="shipment-address-header">
                                        <h3>Shipment-id</h3>
                                        <p>25615646511</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="checkout-main-card cstm-card">
                            <div class="order-summary">
                                <h3>Payment</h3>
                                <p>All transactions are secure and encrypted.</p>
                                <form id="paymentform" action="https://partsmatch.shinedezign.pro/order/payment" method="POST">
                                    <input type="hidden" name="_token" value="NJviTFksKs2EtJwiFdnUN96XbgL1jY9YSTKOmSVr" autocomplete="off">                            <div class="">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Card Number</label>
                                                    <div class="form-field StripeElement StripeElement--empty" id="cardNumberElement"><div class="__PrivateStripeElement" style="margin: 0px !important; padding: 0px !important; border: none !important; display: block !important; background: transparent !important; position: relative !important; opacity: 1 !important;"><iframe name="__privateStripeFrame9243" frameborder="0" allowtransparency="true" scrolling="no" role="presentation" allow="payment *" src="https://js.stripe.com/v3/elements-inner-card-278b3c1324ac8e4875b02219aeb49beb.html#wait=false&amp;mids[guid]=NA&amp;mids[muid]=NA&amp;mids[sid]=NA&amp;showIcon=true&amp;style[base][iconColor]=%23666EE8&amp;style[base][color]=%2331325F&amp;style[base][lineHeight]=40px&amp;style[base][fontWeight]=300&amp;style[base][fontFamily]=Helvetica+Neue&amp;style[base][fontSize]=15px&amp;style[base][::placeholder][color]=%23CFD7E0&amp;style[base][iconStyle]=solid&amp;style[invalid][color]=%23fa755a&amp;style[invalid][fontSize]=20px&amp;placeholder=1234+1234+1234+1234&amp;rtl=false&amp;componentName=cardNumber&amp;keyMode=test&amp;apiKey=pk_test_51OY4tODf0V4fyp7XatEJtPShzSbTKQg5NAJNBYCyQDbMoER6uY8jA5n9lHdZb7zfo0lkwvrVbUKMTDT2SDf3j5za00xv5bH699&amp;referrer=https%3A%2F%2Fpartsmatch.shinedezign.pro%2Fdealer%2Fproduct%2Fshipping%2Ftoaddress&amp;controllerId=__privateStripeController9241" title="Secure card number input frame" style="border: 0px !important; margin: 0px !important; padding: 0px !important; width: 1px !important; min-width: 100% !important; overflow: hidden !important; display: block !important; user-select: none !important; transform: translate(0px) !important; color-scheme: light only !important; height: 40px;"></iframe><input class="__PrivateStripeElement-input" aria-hidden="true" aria-label=" " autocomplete="false" maxlength="1" style="border: none !important; display: block !important; position: absolute !important; height: 1px !important; top: -1px !important; left: 0px !important; padding: 0px !important; margin: 0px !important; width: 100% !important; opacity: 0 !important; background: transparent !important; pointer-events: none !important; font-size: 16px !important;"></div></div>
                                                    <div class="is-invalid stripe-error" id="cardNumberError"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Card Expiration Date</label>
                                                    <div class="form-field StripeElement StripeElement--empty" id="cardExpiryElement"><div class="__PrivateStripeElement" style="margin: 0px !important; padding: 0px !important; border: none !important; display: block !important; background: transparent !important; position: relative !important; opacity: 1 !important;"><iframe name="__privateStripeFrame9244" frameborder="0" allowtransparency="true" scrolling="no" role="presentation" allow="payment *" src="https://js.stripe.com/v3/elements-inner-card-278b3c1324ac8e4875b02219aeb49beb.html#wait=false&amp;mids[guid]=NA&amp;mids[muid]=NA&amp;mids[sid]=NA&amp;style[base][iconColor]=%23666EE8&amp;style[base][color]=%2331325F&amp;style[base][lineHeight]=40px&amp;style[base][fontWeight]=300&amp;style[base][fontFamily]=Helvetica+Neue&amp;style[base][fontSize]=15px&amp;style[base][::placeholder][color]=%23CFD7E0&amp;style[base][iconStyle]=solid&amp;style[invalid][color]=%23fa755a&amp;style[invalid][fontSize]=20px&amp;rtl=false&amp;componentName=cardExpiry&amp;keyMode=test&amp;apiKey=pk_test_51OY4tODf0V4fyp7XatEJtPShzSbTKQg5NAJNBYCyQDbMoER6uY8jA5n9lHdZb7zfo0lkwvrVbUKMTDT2SDf3j5za00xv5bH699&amp;referrer=https%3A%2F%2Fpartsmatch.shinedezign.pro%2Fdealer%2Fproduct%2Fshipping%2Ftoaddress&amp;controllerId=__privateStripeController9241" title="Secure expiration date input frame" style="border: 0px !important; margin: 0px !important; padding: 0px !important; width: 1px !important; min-width: 100% !important; overflow: hidden !important; display: block !important; user-select: none !important; transform: translate(0px) !important; color-scheme: light only !important; height: 40px;"></iframe><input class="__PrivateStripeElement-input" aria-hidden="true" aria-label=" " autocomplete="false" maxlength="1" style="border: none !important; display: block !important; position: absolute !important; height: 1px !important; top: -1px !important; left: 0px !important; padding: 0px !important; margin: 0px !important; width: 100% !important; opacity: 0 !important; background: transparent !important; pointer-events: none !important; font-size: 16px !important;"></div></div>
                                                    <div class="is-invalid stripe-error" id="cardExpiryError"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Card Security Code</label>
                                                    <div class="form-field StripeElement StripeElement--empty" id="cardCVCElement"><div class="__PrivateStripeElement" style="margin: 0px !important; padding: 0px !important; border: none !important; display: block !important; background: transparent !important; position: relative !important; opacity: 1 !important;"><iframe name="__privateStripeFrame9245" frameborder="0" allowtransparency="true" scrolling="no" role="presentation" allow="payment *" src="https://js.stripe.com/v3/elements-inner-card-278b3c1324ac8e4875b02219aeb49beb.html#wait=false&amp;mids[guid]=NA&amp;mids[muid]=NA&amp;mids[sid]=NA&amp;showIcon=true&amp;style[base][iconColor]=%23666EE8&amp;style[base][color]=%2331325F&amp;style[base][lineHeight]=40px&amp;style[base][fontWeight]=300&amp;style[base][fontFamily]=Helvetica+Neue&amp;style[base][fontSize]=15px&amp;style[base][::placeholder][color]=%23CFD7E0&amp;style[base][iconStyle]=solid&amp;style[invalid][color]=%23fa755a&amp;style[invalid][fontSize]=20px&amp;placeholder=123&amp;rtl=false&amp;componentName=cardCvc&amp;keyMode=test&amp;apiKey=pk_test_51OY4tODf0V4fyp7XatEJtPShzSbTKQg5NAJNBYCyQDbMoER6uY8jA5n9lHdZb7zfo0lkwvrVbUKMTDT2SDf3j5za00xv5bH699&amp;referrer=https%3A%2F%2Fpartsmatch.shinedezign.pro%2Fdealer%2Fproduct%2Fshipping%2Ftoaddress&amp;controllerId=__privateStripeController9241" title="Secure CVC input frame" style="border: 0px !important; margin: 0px !important; padding: 0px !important; width: 1px !important; min-width: 100% !important; overflow: hidden !important; display: block !important; user-select: none !important; transform: translate(0px) !important; color-scheme: light only !important; height: 40px;"></iframe><input class="__PrivateStripeElement-input" aria-hidden="true" aria-label=" " autocomplete="false" maxlength="1" style="border: none !important; display: block !important; position: absolute !important; height: 1px !important; top: -1px !important; left: 0px !important; padding: 0px !important; margin: 0px !important; width: 100% !important; opacity: 0 !important; background: transparent !important; pointer-events: none !important; font-size: 16px !important;"></div></div>
                                                    <div class="is-invalid stripe-error" id="cardCVVError"></div>
                                                    <input type="hidden" name="stripeCustomer_id" value="cus_QSGwUPKOpaiszH">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Card Holder Name</label>
                                                    <div class="form-field">
                                                        <input type="text" name="cardname" id="cardName" class="form-control" placeholder="John Doe">
                                                        <label class="cardName-error" for="card-name" id="cardname"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" value="2390" id="total_payment">
                                    <button type="submit" id="payNow" class="btn secondary-btn full-btn">Pay Now
                                        $2,390.00</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="checkout-main-card cstm-card shippment-rates-card">
                            <h3>Rates</h3>
                            <p>Transit times may be estimated.</p>
                            <div class="form-group">
                                <label for="">Shipment Date</label>
                                <div class="formfield">
                                    <input type="text" placeholder="07/23/2024" class="form-control">
                                </div>
                            </div>
                            <div class="shipper-rates">
                                <h4>Fastest</h4>
                                <ul class="shipper-rates-list">
                                    <li>
                                        <a href="#" class="active">
                                            <div class="shipper-rates-left">
                                                <div class="shipper-rates-img">
                                                    
                                                </div>
                                                <h3>UPS Next Day Air® Early</h3>
                                            </div>
                                            <div class="shipper-rates-prize">
                                                <h4>$8.25</h4>
                                                <p>2 days</p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="shipper-rates">
                                <h4>MORE RATES</h4>
                                <ul class="shipper-rates-list">
                                    <li>
                                        <a href="#" class="">
                                            <div class="shipper-rates-left">
                                                <div class="shipper-rates-img">
                                                    
                                                </div>
                                                <h3>UPS Next Day Air® Early</h3>
                                            </div>
                                            <div class="shipper-rates-prize">
                                                <h4>$8.25</h4>
                                                <p>2 days</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="">
                                            <div class="shipper-rates-left">
                                                <div class="shipper-rates-img">
                                                    
                                                </div>
                                                <h3>UPS Next Day Air® Early</h3>
                                            </div>
                                            <div class="shipper-rates-prize">
                                                <h4>$8.25</h4>
                                                <p>2 days</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="">
                                            <div class="shipper-rates-left">
                                                <div class="shipper-rates-img">
                                                    
                                                </div>
                                                <h3>UPS Next Day Air® Early</h3>
                                            </div>
                                            <div class="shipper-rates-prize">
                                                <h4>$8.25</h4>
                                                <p>2 days</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="">
                                            <div class="shipper-rates-left">
                                                <div class="shipper-rates-img">
                                                    
                                                </div>
                                                <h3>UPS Next Day Air® Early</h3>
                                            </div>
                                            <div class="shipper-rates-prize">
                                                <h4>$8.25</h4>
                                                <p>2 days</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="">
                                            <div class="shipper-rates-left">
                                                <div class="shipper-rates-img">
                                                    
                                                </div>
                                                <h3>UPS Next Day Air® Early</h3>
                                            </div>
                                            <div class="shipper-rates-prize">
                                                <h4>$8.25</h4>
                                                <p>2 days</p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pagination-wrapper">
            {{-- <div class="pagination-boxes"> --}}

            {!! $orders->links('dealer.pagination') !!}
        </div>
    </div>
    {{-- </div>

            </div>
        </div> --}}
    {{-- </section> --}}
@endsection
