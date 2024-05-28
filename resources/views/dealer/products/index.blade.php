@extends('layouts.dealer')
@section('title', 'products')
@section('heading', 'Product Management')

@section('content')

    <div class="dashboard-right-box">
        <x-alert-component />
        <div class="sidebar-filter">
            <a href="#" id="sidebar-btn" class="btn secondary-btn sidebar-filter-btn">
                <i class="fa-solid fa-filter"></i>
                Filter
            </a>
        </div>
        <div class="serach-and-filter-box">
            <form action="">
                <div class="pro-search-box">
                    <input type="text" name="filter_by_name" class="form-control" value=""
                        placeholder="Search Product By Name">
                    <button type="submit" class="btn primary-btn">Search</button>
                </div>
            </form>
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
                            <p>Featured Status</p>
                        </th>
                        <th>
                            <p>Action</p>
                        </th>
                    </tr>
                    {{-- @dd($products[3]->featuredProduct[]->id); --}}
                    @foreach ($products as $key => $product)
                        <tr>
                            @foreach ($product->productImage as $a => $image)
                                <td>
                                    <div class="pro-img-box" data-bs-toggle="modal"
                                        data-bs-target="#pro-detail-model{{ $key }}">
                                        <img src="{{ Storage::url($image->file_url) }}" alt="img">
                                    </div>
                                </td>
                            @break
                        @endforeach

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
                            <div class="toggle-btn">
                                <input type="checkbox" id="switch1{{ $key }}"
                                    data-id=" @if (isset($product->featuredProduct->id)) {{ $product->featuredProduct->id }} @else 0 @endif"
                                    product-id="{{ $product->id }}" class="custom-switch-input feature-switch"
                                    @if (isset($product->featuredProduct) && $product->featuredProduct != null) checked="checked" @endif
                                    @if (!plan_validity()) disabled @endif><label
                                    for="switch1{{ $key }}">Toggle</label>
                            </div>
                        </td>
                        <td>
                            <div class="action-btns">
                                <a href="{{ route('dealer.products.edit', $product->id) }}"><i
                                        class="fa-solid fa-pen-to-square" style="color: #3EBE62;"></i></a>
                                <a class="delete" href="{{ route('dealer.products.delete', $product->id) }}"><i
                                        class="fa-regular fa-trash-can" style="color: #E13F3F;"></i></a>
                            </div>
                        </td>
                        {{-- @foreach ($products as $key => $product) --}}
                        {{-- <tr>
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

                        </tr> --}}
                @endforeach

            </table>
        </div>
    </div>
    {!! $products->links('dealer.pagination') !!}
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
            <div class="modal-body modal-custm-body">
                <div class="add-pro-form">
                    <h2>Add New Products</h2>
                    <form id="product" action="{{ route('dealer.products.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Product Name*</label>
                                    <div class="form-field">
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Product Name">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Product Category*</label>
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
                                    <label for="">Product SubCategory*</label>
                                    <div class="form-field subcategory">
                                        <select type="text" name="subcategory" class="form-control"
                                            placeholder="Product SubCategory" id="subcategory">
                                            <option value="">Select the SubCategory</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Product Description*</label>
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
                                    <label for="">Add Product Images* (Up to 5)</label>
                                    <label class="img-upload-box">
                                        <p>Upload Images</p>
                                        <input type="file" name="images[]" id="upload-image" multiple
                                            minlength="5" upload-image-count="0">

                                    </label>
                                    <div class="upload-img-preview">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Product Quantity*</label>
                                    <div class="form-field">
                                        <input type="text" name="stocks_avaliable" class="form-control"
                                            placeholder="Product Quantity">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Product Price*</label>
                                    <div class="form-field">
                                        <input type="text" name="price" class="form-control"
                                            placeholder="Product Price">

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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Specifications and dimensions</label>
                                    <div class="form-field">
                                        <textarea name="Specifications_and_dimensions" class="form-control" id="" cols="30" rows="2"></textarea>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Shipping info</label>
                                    <div class="form-field">
                                        <textarea name="Shipping_info" class="form-control" id="" cols="30" rows="2"></textarea>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">field 3</label>
                                    <div class="form-field">
                                        <textarea name="field_3" class="form-control" id="" cols="30" rows="2"></textarea>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Shipping Price*</label>
                                    <div class="form-field">
                                        <input type="text" name="shipping_price" class="form-control"
                                            placeholder="Shipping Price">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Year*</label>
                                    <div class="form-field">
                                        {{-- <select class="form-control api_call" name="car_years"
                                            id="car-years"></select> --}}
                                        <select class="form-control" name="car_years" id="carYear">
                                            <option>Select year</option>
                                            @foreach ($years as $year)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endforeach

                                        </select>
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
                                    <label for="">Make*</label>
                                    <div class="form-field">
                                        {{-- <select class="form-control api_call" name="car_model"
                                            id="car-makes"></select> --}}
                                        <select class="form-control" name="car_model" id="carModel">
                                            <option>Select your country</option>

                                            <option>Select your Model</option>

                                        </select>
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
                                    <label for="">Model*</label>
                                    <div class="form-field">
                                        {{-- <select class="form-control api_call" name="car_make"
                                            id="car-models"></select> --}}
                                        <select class="form-control" name="car_make" id="carMake">
                                            <option>Select your make</option>

                                        </select>
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
                                    {{-- <label for="">Product Price</label> --}}
                                    <div class="form-field">
                                        <input type="checkbox" name="subscription_status"
                                            @if (isset(plan_validity()->stripe_status) && plan_validity()->stripe_status == 'active') checked @else disabled @endif>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <a href="#" class="btn secondary-btn full-btn" data-bs-toggle="modal"
                                        data-bs-target="#bulk-upload">Bulk Upload</a>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" id="submit"
                                        class="btn primary-btn full-btn">submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

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
        </div>
    </div>
</div>
{{-- @foreach ($products as $key => $product)
    <div class="modal fade" id="pro-detail-model{{ $key }}" tabindex="-1" aria-labelledby="bulk-upload"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="pro-detail-body">
                        @foreach ($product->productImage as $a => $image)
                            <img class="model-pro-img" src="{{ Storage::url($image->file_url) }}" alt="">
                        @endforeach
                        <div class="product-infography">

                            <h2>{{ $product->name }}</h2>
                            <span>{{ $product->subcategory_id }}</span>
                            <p>{{ $product->description }} </p>
                            <div class="product-quantity-box">
                                <p>Quantity</p>

                                <div class="left-input">
                                    <input type="text" placeholder="{{ $product->stocks_avaliable }}">
                                </div>
                            </div>
                            <div class="singlr-pro-detail model-more-info-box">
                                <div class="product-name-detail">
                                    <h3>{{ $product->name }}</h3>
                                    <h3>{{ $product->price }}</h3>
                                </div>
                                <div class="more-info-box ">
                                    <div class="accordion" id="accordionExample">

                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#additional-information"
                                                    aria-expanded="false" aria-controls="collapseTwo">
                                                    Additional Information
                                                </button>
                                            </h2>
                                            <div id="additional-information" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <p>{{ $product->additional_details }}</p>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

            </div>
        </div>
    </div>
@endforeach --}}

@endsection

@push('scripts')
@includeFirst(['validation.dealer.js_product'])
<script type="text/javascript">
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
    jQuery(document).on('click', ".feature-switch", function() {
        var id = $(this).attr('data-id');
        // console.log(id, "herererererer");
        if (id != 0) {
            $.ajax({
                url: APP_URL + "/dealer/featured/products/delete/" + id,
                success: function(result) {
                    if (result.status == true) {
                        $(".feature-switch").addClass('checked', false);
                        location.reload();
                        return toastr.error(result.message);

                    }

                }

            })
        } else {
            var id = $(this).attr('product-id');
            $.ajax({
                url: APP_URL + "/dealer/featured/products/create/" + id,
                methode: 'POST',
                success: function(result) {
                    if (result.status == true) {
                        location.reload();
                        return toastr.success(result.message);
                    } else {

                        $(".feature-switch").addClass('checked', false);
                        return toastr.error(result.message);
                    }
                }

            })
        }
    })
</script>
<script>
    jQuery(document).ready(function() {
        jQuery(document).on('change', '#carYear', function() {

            var year = jQuery(this).val();
            var url = APP_URL + '/dealer/model/' + year
            var response = ajaxCall(url, 'get', null, false);
            response.then(handleStateData).catch(handleStateError)

            function handleStateData(response) {
                if (response.success == true) {
                    console.log(response.model)
                    jQuery('#carModel').html(response.models)
                } else {
                    jQuery('#errormessage').html(response.error);
                }
            }

            function handleStateError(error) {
                console.log('error', error)

            }
        });

        jQuery(document).on('change', '#carModel', function() {

            var model = jQuery(this).val();
            var url = APP_URL + '/dealer/make/' + model
            var response = ajaxCall(url, 'get', null, false);
            response.then(handleStateData).catch(handleStateError)

            function handleStateData(response) {
                if (response.success == true) {
                    console.log(response.model)
                    jQuery('#carMake').html(response.makes)
                } else {
                    jQuery('#errormessage').html(response.error);
                }
            }

            function handleStateError(error) {
                console.log('error', error)

            }
        });
    });

    jQuery(document).ready(function() {
        jQuery('#submit').click(function(e) {
            var no_image = $('#upload-image').attr('upload-image-count');
            if (parseInt(no_image) < 5) {
                e.preventDefault();
                return toastr.error("Please enter atleast 5 images");
            }
            // var formData = new FormData($('form#product').get(0));
            $('#product').valid()
        });
    });

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
                        // console.log(element);
                        jQuery(element).appendTo(imgPreviewPlaceholder);
                    }
                    reader.readAsDataURL(input.files[i]);
                }

                var noimage = $('#upload-image').attr('upload-image-count');
                totalimg = parseInt(noimage) + filesAmount;
                $('#upload-image').attr('upload-image-count', totalimg)
            }
        };
        $('#upload-image').on('change', function() {
            previewImages(this, 'div.upload-img-preview');
        });

        $(document).on('click', '.remove_uploaded', function() {
            totalimage = $('#upload-image').attr('upload-image-count');
            remaningimg = parseInt(totalimage) - 1;
            totalimage = $('#upload-image').attr('upload-image-count', remaningimg);

            $(this).parent('div').parent('div').remove();
        });
    });
</script>
@endpush
