@extends('layouts.dealer')
@section('title', 'Order Management')
@section('heading', 'Order Management')
@section('content')
<div class="dashboard-right-box">
    <div class="serach-and-filter-box justify-content-end">
        <div class="pro-search-box">
            <input type="text" class="form-control" name="filter_by_name" placeholder="Search">
            <a href="#" class="btn primary-btn"><i class="fa-solid fa-magnifying-glass"></i></a>
        </div>
    </div>
    <div class="product-detail-table product-list-table">
        <x-alert-component />
        <div class="table-responsive">
            <table class="table customer-table">
                <thead>
                    <tr>
                        <th>
                            <p>Customer</p>
                        </th>
                        <th>
                            <p>Shippment_id</p>
                        </th>
                        <th>
                            <p>Rate</p>
                        </th>
                        <th>
                            <p>Track Url</p>
                        </th>
                        <th>
                            <p>Label Url</p>
                        </th>
                        <th>
                            <p>Carrier Service</p>
                        </th>
                        <th>
                            <p>Order Date</p>
                        </th>
                        <th>
                            <p>Ship date</p>
                        </th>
                        <th>
                            <p>Download</p>
                        </th>
                        <th>
                            <p>Status</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="customer-profile">
                                <h3>Rishabh Girdhar</h3>
                                <p class="text-elipses">Scottsdale, AZ 85254-8169</p>
                            </div>
                        </td>
                        <td>
                            <p class="customer-track-no">{{$shippmentDetails ? ($shippmentDetails->shippment_id ?? 'N/A'): 'N/A'}}</p>
                        </td>
                        <td>
                            <p class="customer-price">${{$shippmentDetails ? ($shippmentDetails->amount ?? 'N/A'): 'N/A'}}</p>
                        </td>
                        <td>
                            <a  href="{{$shippmentDetails ? ($shippmentDetails->tracking_url ?? '#'): '#'}}" class="customer-price text-elipses" target="_blank">{{$shippmentDetails ? ($shippmentDetails->label_url ?? 'N/A'): 'N/A'}}</a>

                        </td>
                        <td>
                            <a  href="{{$shippmentDetails ? ($shippmentDetails->label_url ?? '#'): '#'}}" class="customer-price text-elipses" target="_blank">{{$shippmentDetails ? ($shippmentDetails->label_url ?? 'N/A'): 'N/A'}}</a>
                        </td>
                        <td>
                            <div class="carrier-serv-bx">
                                <div class="carrier-serv-pro">
                                </div>
                                <div class="carrier-serv-content">
                                    <h3>{{$shippmentDetails ? ($shippmentDetails->service_level_token ?? 'N/A'): 'N/A'}}</h3>
                                    <span id="trackingDisplay">{{ $shippmentDetails ? (substr($shippmentDetails->tracking_number, 0, 4) . 'XXXXXX') : 'N/A' }}</span>
                                    <a href="#" id="copy_trackingNumber" style="display:none;">{{ $shippmentDetails ? $shippmentDetails->tracking_number : 'N/A' }}</a>
                                </div>
                                <div class="carrier-serv-copy"><i class="fa-regular fa-copy" style="cursor: pointer;" onclick="copyToClipboard('copy_trackingNumber')"></i>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="order-date">
                                <p>{{$shippmentDetails ? ($shippmentDetails->created_at->format('m/d/Y') ?? 'N/A') : 'N/A'}}</p>
                            </div>
                        </td>
                        <td>
                            <div class="order-date">
                                <p>07/29/2024</p>
                            </div>
                        </td>
                        <td>
                            <a  href="{{$shippmentDetails ? ($shippmentDetails->label_url ?? '#'): '#'}}"  class="download-btn" download="example.pdf"  ><span><svg width="10" height="12" viewBox="0 0 10 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.87841 4.74981V0H2.12204V4.74981H0L5 11.1111L10 4.74981H7.87841Z" fill="CurrentColor"/>
                                </svg>
                                </span>Download</a>
                        </td>
                        <td>
                            <div class="pro-status">
                                    <div class="badge complete-badge" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-check"></i> Complete
                                    </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
<script>
    function copyToClipboard(id) {
    var element = document.getElementById(id);
    if (element) {
        // Create a temporary textarea element
        var textarea = document.createElement('textarea');
        textarea.value = element.textContent || element.innerText; 
        document.body.appendChild(textarea); 
        textarea.select(); 
        document.execCommand('copy'); 
        document.body.removeChild(textarea);
        toastr.success('Copied to clipboard!')
    } else {
         toastr.error('Something went wrong');
    }
}
</script>