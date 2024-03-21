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
                    @foreach ($products as $key => $product)
                        <tr>
                            <td>
                                <div class="pro-img-box" data-bs-toggle="modal" data-bs-target="#pro-detail-model">
                                    <img src="{{ Storage::url($product->productImage["$key"]->file_url) }}" alt="img">
                                </div>
                            </td>
                            <td>
                                <p>{{ $product->name }}</p>
                            </td>
                            <td>
                                <p>{{ $product->price }}</p>
                            </td>
                            <td>
                                <div class="toggle-btn">
                                    <input type="checkbox" id="switch100{{ $key }}" class="custom-switch-input"
                                        @if ($product->status == '1') checked="checked" @endif
                                        onchange="toggleStatus(this, 'Product', '{{ $product->id }}');"
                                        url="{{ route('dealer.products.status') }}"><label
                                        for="switch100{{ $key }}">Toggle</label>
                                </div>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <a href="{{ route('dealer.products.edit', $product->id) }}"><i
                                            class="fa-solid fa-pen-to-square" style="color: #3EBE62;"></i></a>
                                    <a href="{{ route('dealer.products.delete', $product->id) }}"><i
                                            class="fa-regular fa-trash-can" style="color: #E13F3F;"></i></a>
                                </div>
                            </td>
                            @foreach ($products as $key => $product)
                        <tr>
                            <td>
                                <div class="pro-img-box" data-bs-toggle="modal" data-bs-target="#pro-detail-model">
                                    <img src="{{ Storage::url($product->productImage["$key"]->file_url) }}" alt="img">
                                </div>
                            </td>
                            <td>
                                <p>{{ $product->name }}</p>
                            </td>
                            <td>
                                <p>{{ $product->price }}</p>
                            </td>
                            <td>
                                <div class="toggle-btn">
                                    <input type="checkbox" id="switch100{{ $key }}" class="custom-switch-input"
                                        @if ($product->status == '1') checked="checked" @endif
                                        onchange="toggleStatus(this, 'Product', '{{ $product->id }}');"
                                        url="{{ route('dealer.products.status') }}"><label
                                        for="switch100{{ $key }}">Toggle</label>
                                </div>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <a href="{{ route('dealer.products.edit', $product->id) }}"><i
                                            class="fa-solid fa-pen-to-square" style="color: #3EBE62;"></i></a>
                                    <a href="{{ route('dealer.products.delete', $product->id) }}"><i
                                            class="fa-regular fa-trash-can" style="color: #E13F3F;"></i></a>
                                </div>
                            </td>

                        </tr>
                    @endforeach

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
                        <form id="product" action="{{ route('dealer.products.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Product Name</label>
                                        <div class="form-field">
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Product Name">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Product Category</label>
                                        <div class="form-field">
                                            <select type="text" name="category" class="form-control category"
                                                placeholder="Product Category">
                                                <option value="">Select the category</option>
                                                @foreach (get_category() as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Product SubCategory</label>
                                        <div class="form-field subcategory">
                                            <select type="text" name="subcategory" class="form-control"
                                                placeholder="Product SubCategory" id="subcategory">
                                                <option value="">Select the category</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Product Description</label>
                                        <div class="form-field">
                                            <textarea name="description" class="form-control" id="" cols="30" rows="2"></textarea>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Additional details</label>
                                        <div class="form-field">
                                            <textarea name="additional_details" class="form-control" id="" cols="30" rows="2"></textarea>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Add Product Images (Up to 5)</label>
                                        <label class="img-upload-box">
                                            <p>Upload Images</p>
                                            <input type="file" name="images[]" id="upload-image" multiple
                                                minlength="5">

                                        </label>
                                        <div class="upload-img-preview">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Product Quantity</label>
                                        <div class="form-field">
                                            <input type="text" name="stocks_avaliable" class="form-control"
                                                placeholder="Product Quantity">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Product Price</label>
                                        <div class="form-field">
                                            <input type="text" name="price" class="form-control"
                                                placeholder="$000">

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Other specifications</label>
                                        <div class="form-field">
                                            <textarea name="other_specification" class="form-control" id="" cols="30" rows="2"></textarea>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Shipping Price</label>
                                        <div class="form-field">
                                            <input type="text" name="shipping_price" class="form-control"
                                                placeholder="$000">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Model</label>
                                        <div class="form-field">
                                            <select class="form-control api_call" name="car_years"
                                                id="car-years"></select>
                                            {{-- <select class="form-control" name="Select your country"
                                                    id="Select your country">
                                                    <option>Select your model</option>
                                                    <option value="model1">Model1</option>
                                                    <option value="model2">Model2</option>
                                                    <option value="model3">Model3</option>
                                                </select> --}}
                                            <span class="form-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="8"
                                                    viewBox="0 0 14 8" fill="none">
                                                    <path d="M13 1L7 7L1 1" stroke="#272643" stroke-width="2"
                                                        stroke-miterlimit="10" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Brand</label>
                                        <div class="form-field">
                                            <select class="form-control api_call" name="car_makes"
                                                id="car-makes"></select>
                                            {{-- <select class="form-control" name="Select your country"
                                                    id="Select your country">
                                                    <option>Select your country</option>
                                                    <option value="brand1">Brand1</option>
                                                    <option value="brand2">Brand2</option>
                                                    <option value="brand3">brand3</option>
                                                </select> --}}
                                            <span class="form-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="8"
                                                    viewBox="0 0 14 8" fill="none">
                                                    <path d="M13 1L7 7L1 1" stroke="#272643" stroke-width="2"
                                                        stroke-miterlimit="10" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Make</label>
                                        <div class="form-field">
                                            <select class="form-control api_call" name="car_models"
                                                id="car-models"></select>
                                            {{-- <select class="form-control" name="Select your country"
                                                    id="Select your country">
                                                    <option>Select your make</option>
                                                    <option value="make1">Make1</option>
                                                    <option value="make2">Make2</option>
                                                    <option value="make3">make3</option>
                                                </select> --}}
                                            <span class="form-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="8"
                                                    viewBox="0 0 14 8" fill="none">
                                                    <path d="M13 1L7 7L1 1" stroke="#272643" stroke-width="2"
                                                        stroke-miterlimit="10" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="#" class="btn secondary-btn full-btn" data-bs-toggle="modal"
                                            data-bs-target="#bulk-upload">Bulk Upload</a>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn primary-btn full-btn">submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- <div class="modal-body">
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
                </div> --}}


            </div>
        </div>
    </div>



    <div class="modal fade" id="bulk-upload" tabindex="-1" aria-labelledby="bulk-upload" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
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
                @includeFirst(['validation.dealer.js_product'])
                <script type="text/javascript">
                    $(document).ready({
                        function() {
                            var carquery = new CarQuery();
                            carquery.init();
                            carquery.initYearMakeModelTrim('car-years', 'car-makes', 'car-models', 'car-model-trims');
                        }
                    });


                    jQuery(document).on('change', ".category", function() {
                        var id = $(this).val();
                        if ($(this).val()) {
                            $.ajax({
                                url: APP_URL + "/dealer/products/subcategory/" + id,
                                success: function(result) {
                                    if (result.status == true) {
                                        if (result.subcategory) {
                                            $("#subcategory").html(result.subcategory);
                                        }
                                    }
                                }

                            })
                        }
                    })
                </script>
                <script>
                    $(function() {
                        // Multiple images preview with JavaScript
                        var previewImages = function(input, imgPreviewPlaceholder) {
                            if (input.files) {
                                var filesAmount = input.files.length;
                                for (i = 0; i < filesAmount; i++) {
                                    var reader = new FileReader();
                                    reader.onload = function(event) {
                                        var element =
                                            '<div class="upload-img-box"><img src="' + event.target.result +
                                            '" alt="img"> <div class = "upload-img-cross" > <i class = "fa-regular fa-circle-xmark remove_uploaded"></i></div></div>';
                                        console.log(element);
                                        jQuery(element).appendTo(imgPreviewPlaceholder);
                                    }
                                    reader.readAsDataURL(input.files[i]);
                                }
                            }
                        };
                        $('#upload-image').on('change', function() {
                            previewImages(this, 'div.upload-img-preview');
                        });

                        $(document).on('click', '.remove_uploaded', function() {
                            $(this).parent('div').parent('div').remove();
                        });

                    });
                </script>
            @endpush
