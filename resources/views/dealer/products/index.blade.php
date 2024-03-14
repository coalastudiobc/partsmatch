@extends('layouts.dealer')
@section('title', 'products')
@section('heading', 'Product Management')

@section('content')
    <div class="dashboard-right-box">
        <div class="serach-and-filter-box">
            <div class="pro-search-box">
                <input type="text" class="form-control" placeholder="Search Product By Name">
                <a href="#" class="btn primary-btn">Search</a>
            </div>
            <a href="javascript:void(0)" class="btn primary-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                + Add New Product
            </a>
        </div>
        <div class="product-detail-table product-list-table pro-manage-table">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>
                            <p>Image</p>
                        </th>
                        <th>
                            <p>Product Name</p>
                        </th>
                        <th>
                            <p>Price</p>
                        </th>
                        <th>
                            <p>Status</p>
                        </th>
                        <th>
                            <p>Action</p>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <div class="pro-img-box" data-bs-toggle="modal" data-bs-target="#pro-detail-model">
                                <img src="images/product1.png" alt="">
                            </div>
                        </td>
                        <td>
                            <p>Car Engine</p>
                        </td>
                        <td>
                            <p>$700</p>
                        </td>
                        <td>
                            <div class="toggle-btn">
                                <input type="checkbox" id="switch1" /><label for="switch1">Toggle</label>
                            </div>
                        </td>
                        <td>
                            <div class="action-btns">
                                <a href="#"><i class="fa-solid fa-pen-to-square" style="color: #3EBE62;"></i></a>
                                <a href="#"><i class="fa-regular fa-trash-can" style="color: #E13F3F;"></i></a>
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <div class="pro-img-box">
                                <img src="images/product2.png" alt="">
                            </div>
                        </td>
                        <td>
                            <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                        </td>
                        <td>
                            <p>$700</p>
                        </td>
                        <td>
                            <div class="toggle-btn">
                                <input type="checkbox" id="switch2" /><label for="switch2">Toggle</label>
                            </div>
                        </td>
                        <td>
                            <div class="action-btns">
                                <a href="#"><i class="fa-solid fa-pen-to-square" style="color: #3EBE62;"></i></a>
                                <a href="#"><i class="fa-regular fa-trash-can" style="color: #E13F3F;"></i></a>
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <div class="pro-img-box">
                                <img src="images/product3.png" alt="">
                            </div>
                        </td>
                        <td>
                            <p>Yada 720P Mirror RoadCam-BT58361 - Yada Auto Electronics</p>
                        </td>
                        <td>
                            <p>$4500</p>
                        </td>
                        <td>
                            <div class="toggle-btn">
                                <input type="checkbox" id="switch3" /><label for="switch3">Toggle</label>
                            </div>
                        </td>
                        <td>
                            <div class="action-btns">
                                <a href="#"><i class="fa-solid fa-pen-to-square" style="color: #3EBE62;"></i></a>
                                <a href="#"><i class="fa-regular fa-trash-can" style="color: #E13F3F;"></i></a>
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <div class="pro-img-box">
                                <img src="images/product4.png" alt="">
                            </div>
                        </td>
                        <td>
                            <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                        </td>
                        <td>
                            <p>$700</p>
                        </td>
                        <td>
                            <div class="toggle-btn">
                                <input type="checkbox" id="switch4" /><label for="switch4">Toggle</label>
                            </div>
                        </td>
                        <td>
                            <div class="action-btns">
                                <a href="#"><i class="fa-solid fa-pen-to-square" style="color: #3EBE62;"></i></a>
                                <a href="#"><i class="fa-regular fa-trash-can" style="color: #E13F3F;"></i></a>
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <div class="pro-img-box">
                                <img src="images/product1.png" alt="">
                            </div>
                        </td>
                        <td>
                            <p>Car Engine</p>
                        </td>
                        <td>
                            <p>$700</p>
                        </td>
                        <td>
                            <div class="toggle-btn">
                                <input type="checkbox" id="switch10" /><label for="switch10">Toggle</label>
                            </div>
                        </td>
                        <td>
                            <div class="action-btns">
                                <a href="#"><i class="fa-solid fa-pen-to-square" style="color: #3EBE62;"></i></a>
                                <a href="#"><i class="fa-regular fa-trash-can" style="color: #E13F3F;"></i></a>
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <div class="pro-img-box">
                                <img src="images/product2.png" alt="">
                            </div>
                        </td>
                        <td>
                            <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                        </td>
                        <td>
                            <p>$700</p>
                        </td>
                        <td>
                            <div class="toggle-btn">
                                <input type="checkbox" id="switch20" /><label for="switch20">Toggle</label>
                            </div>
                        </td>
                        <td>
                            <div class="action-btns">
                                <a href="#"><i class="fa-solid fa-pen-to-square" style="color: #3EBE62;"></i></a>
                                <a href="#"><i class="fa-regular fa-trash-can" style="color: #E13F3F;"></i></a>
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <div class="pro-img-box">
                                <img src="images/product3.png" alt="">
                            </div>
                        </td>
                        <td>
                            <p>Yada 720P Mirror RoadCam-BT58361 - Yada Auto Electronics</p>
                        </td>
                        <td>
                            <p>$4500</p>
                        </td>
                        <td>
                            <div class="toggle-btn">
                                <input type="checkbox" id="switch300" /><label for="switch300">Toggle</label>
                            </div>
                        </td>
                        <td>
                            <div class="action-btns">
                                <a href="#"><i class="fa-solid fa-pen-to-square" style="color: #3EBE62;"></i></a>
                                <a href="#"><i class="fa-regular fa-trash-can" style="color: #E13F3F;"></i></a>
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <div class="pro-img-box">
                                <img src="images/product4.png" alt="">
                            </div>
                        </td>
                        <td>
                            <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                        </td>
                        <td>
                            <p>$700</p>
                        </td>
                        <td>
                            <div class="toggle-btn">
                                <input type="checkbox" id="switch40" /><label for="switch40">Toggle</label>
                            </div>
                        </td>
                        <td>
                            <div class="action-btns">
                                <a href="#"><i class="fa-solid fa-pen-to-square" style="color: #3EBE62;"></i></a>
                                <a href="#"><i class="fa-regular fa-trash-can" style="color: #E13F3F;"></i></a>
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
@section('modals')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> -->
                <div class="modal-body">
                    <div class="add-pro-form">
                        <h2>Add New Products</h2>
                        <form action="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Product Name</label>
                                        <div class="form-field">
                                            <input type="text" class="form-control" placeholder="Product Name">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Product Category</label>
                                        <div class="form-field">
                                            <input type="text" class="form-control" placeholder="Product Category">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Product Description</label>
                                        <div class="form-field">
                                            <input type="text" class="form-control" placeholder="Product Description">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Additional details</label>
                                        <div class="form-field">
                                            <input type="text" class="form-control" placeholder="Additional details">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Add Product Images (Up to 5)</label>
                                        <label class="img-upload-box">
                                            <img src="images/upload-img.png" alt="">
                                            <p>Upload Images</p>
                                            <input type="file">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Product Quantity</label>
                                        <div class="form-field">
                                            <input type="text" class="form-control" placeholder="Product Quantity">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Product Price</label>
                                        <div class="form-field">
                                            <input type="text" class="form-control" placeholder="$000">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Other specifications</label>
                                        <div class="form-field">
                                            <input type="text" class="form-control"
                                                placeholder="Other specifications">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Shipping Price</label>
                                        <div class="form-field">
                                            <input type="text" class="form-control" placeholder="$000">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Brand</label>
                                        <div class="form-field">
                                            <input type="text" class="form-control" placeholder="Brand">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Model</label>
                                        <div class="form-field">
                                            <input type="text" class="form-control" placeholder="Model">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Make</label>
                                        <div class="form-field">
                                            <input type="text" class="form-control" placeholder="Make">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <select name="car-years" id="car-years"></select>  
                                    <select name="car-makes" id="car-makes"></select> 
                                    <select name="car-models" id="car-models"></select>
                                    <select name="car-model-trims" id="car-model-trims"></select>
                                    <div class="col-md-6">
                                        <a href="#" class="btn secondary-btn full-btn" data-bs-toggle="modal"
                                            data-bs-target="#bulk-upload">Bulk Upload</a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="#" class="btn primary-btn full-btn">submit</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
            </div>
        </div>
    </div>



    <div class="modal fade" id="bulk-upload" tabindex="-1" aria-labelledby="bulk-upload" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> -->
                <div class="modal-body">
                    <div class="add-pro-form">
                        <h2>Bulk Upload</h2>
                        <form action="">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Upload File</label>
                                        <label class="img-upload-box">
                                            <img src="images/upload-img.png" alt="">
                                            <p>Upload Images</p>
                                            <input type="file">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <a href="#" class="btn secondary-btn full-btn">submit</a>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>



                <div class="modal fade" id="pro-detail-model" tabindex="-1" aria-labelledby="bulk-upload"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <!-- <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div> -->
                            <div class="modal-body">
                                <div class="pro-detail-body">
                                    <img class="model-pro-img" src="images/collect1.png" alt="">
                                    <div class="product-infography">
                                        <h2>R1 Concepts® – eLINE Series Plain Brake Rotors</h2>
                                        <span>( Product Category )</span>
                                        <p>Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out
                                            print, graphic or web designs. </p>
                                        <div class="product-quantity-box">
                                            <p>Quantity</p>
                                            <div class="left-input">
                                                <input type="text" placeholder="3">
                                            </div>
                                        </div>
                                        <div class="singlr-pro-detail model-more-info-box">
                                            <div class="product-name-detail">
                                                <h3>Product Name</h3>
                                                <h3>$700</h3>
                                            </div>
                                            <div class="more-info-box ">
                                                <div class="accordion" id="accordionExample">

                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#additional-information"
                                                                aria-expanded="false" aria-controls="collapseTwo">
                                                                Additional Information
                                                            </button>
                                                        </h2>
                                                        <div id="additional-information"
                                                            class="accordion-collapse collapse"
                                                            data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <p>Lorem ipsum, or lipsum as it is sometimes known, is dummy
                                                                    text used in laying out print, graphic or web designs.
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <!-- <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div> -->
                        </div>
                    </div>
                </div>

            @endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(
    function()
    {
         //Create a variable for the CarQuery object.  You can call it whatever you like.
         var carquery = new CarQuery();
    
         //Run the carquery init function to get things started:
         carquery.init();
         
         //Optionally, you can pre-select a vehicle by passing year / make / model / trim to the init function:
         //carquery.init('2000', 'dodge', 'Viper', 11636);
    
         //Optional: Pass sold_in_us:true to the setFilters method to show only US models. 
         carquery.setFilters( {sold_in_us:true} );
    
         //Optional: initialize the year, make, model, and trim drop downs by providing their element IDs
         carquery.initYearMakeModelTrim('car-years', 'car-makes', 'car-models', 'car-model-trims');
    
    });
    </script>
    @endpush