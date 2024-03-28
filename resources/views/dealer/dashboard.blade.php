@extends('layouts.dealer')
@section('title', 'Dashboard')
@section('heading', 'Dashboard')

@section('content')
    <div class="dashboard-right-box">
        <h2>All Products</h2>
        <div class="product-detail-table">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>
                            <p>Image</p>
                        </th>
                        <th>
                            <p>Product</p>
                        </th>
                        <th>
                            <p>Price</p>
                        </th>
                        <th>
                            <p>Quantity</p>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <img src="images/table-img.png" alt="">
                        </td>
                        <td>
                            <p>Car Engine</p>
                        </td>
                        <td>
                            <p>$700</p>
                        </td>
                        <td>
                            <div class="table-pro-quantity">
                                1
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="images/table-img.png" alt="">
                        </td>
                        <td>
                            <p>Car Engine</p>
                        </td>
                        <td>
                            <p>$700</p>
                        </td>
                        <td>
                            <div class="table-pro-quantity">
                                1
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="images/table-img.png" alt="">
                        </td>
                        <td>
                            <p>Car Engine</p>
                        </td>
                        <td>
                            <p>$700</p>
                        </td>
                        <td>
                            <div class="table-pro-quantity">
                                1
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="images/table-img.png" alt="">
                        </td>
                        <td>
                            <p>Car Engine</p>
                        </td>
                        <td>
                            <p>$700</p>
                        </td>
                        <td>
                            <div class="table-pro-quantity">
                                1
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="images/table-img.png" alt="">
                        </td>
                        <td>
                            <p>Car Engine</p>
                        </td>
                        <td>
                            <p>$700</p>
                        </td>
                        <td>
                            <div class="table-pro-quantity">
                                1
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="images/table-img.png" alt="">
                        </td>
                        <td>
                            <p>Car Engine</p>
                        </td>
                        <td>
                            <p>$700</p>
                        </td>
                        <td>
                            <div class="table-pro-quantity">
                                1
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="images/table-img.png" alt="">
                        </td>
                        <td>
                            <p>Car Engine</p>
                        </td>
                        <td>
                            <p>$700</p>
                        </td>
                        <td>
                            <div class="table-pro-quantity">
                                1
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="pagination-wrapper">
            <div class="pagination-boxes">
                <div class="pagination-box">
                    <i class="fa-solid fa-angle-left"></i>
                </div>
                <div class="pagination-box active">
                    <p>1</p>
                </div>
                <div class="pagination-box">
                    <p>2</p>
                </div>
                <div class="pagination-box">
                    <p>3</p>
                </div>
                <div class="pagination-box">
                    <p>4</p>
                </div>
                <div class="pagination-box">
                    <p>5</p>
                </div>
                <div class="pagination-box">
                    <i class="fa-solid fa-angle-right"></i>
                </div>
            </div>
        </div>
    </div>
@endsection
