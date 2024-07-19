@extends('layouts.dealer')
@section('title', 'Products')
@section('heading', 'Product Management')

@section('content')
<div class="dashboard-right-box">
    <x-alert-component />
    <div class="bredcrum-plus-filter">
        <div class="cstm-bredcrum">
        </div>
        <div class="serach-and-filter-box">
            <form action="">
                <div class="pro-search-box">
                    <input type="text" name="filter_by_name" class="form-control" value="" placeholder="Search Product By Name">
                    <button type="submit" class="btn primary-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
            <a href="javascript:void(0)" class="btn primary-btn" data-bs-toggle="modal" data-bs-target="#bulk-upload">
                <img src="{{ asset('assets/images/add-round-icon.svg') }}" alt=""> Bulk upload
            </a>
            <a href="javascript:void(0)" class="btn primary-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <img src="{{ asset('assets/images/add-round-icon.svg') }}" alt=""> ADD
            </a>
        </div>
    </div>
    <div class="product-detail-table product-list-table pro-manage-table">
        <div class="table-responsive">
            <table class="table ">
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
                    {{-- <th>
                            <p>Featured Status</p>
                        </th> --}}
                    <th>
                        <p>Action</p>
                    </th>
                </tr>
                {{-- @dd($products[3]->featuredProduct[]->id); --}}
                @forelse ($products as $key => $product)
                <tr>
                    @foreach ($product->productImage as $a => $image)
                    <td>
                        <div class="pro-img-box" data-bs-toggle="modal" data-bs-target="#pro-detail-model">
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
                            <input type="checkbox" id="switch100{{ $key }}" class="custom-switch-input" @if ($product->status == '1') checked="checked" @endif
                            onchange="toggleStatus(this, 'Product', '{{ $product->id }}');"
                            url="{{ route('Dealer.products.status') }}"><label for="switch100{{ $key }}">Toggle</label>
                        </div>
                    </td>

                    {{-- <td>
                            <div class="toggle-btn">
                                <input type="checkbox" id="switch1{{ $key }}"
                    data-id=" @if (isset($product->featuredProduct->id)) {{ $product->featuredProduct->id }} @else 0 @endif"
                    product-id="{{ $product->id }}" class="custom-switch-input feature-switch"
                    @if (isset($product->featuredProduct) && $product->featuredProduct != null) checked="checked" @endif
                    @if (!plan_validity()) disabled @endif><label for="switch1{{ $key }}">Toggle</label>
        </div>
        </td> --}}
        <td>
            <div class="action-btns">
                <a href="{{ route(auth()->user()->getRoleNames()->first() . '.products.edit', $product->id) }}"><i class="fa-solid fa-pen-to-square" style="color: #3EBE62;"></i></a>
                <a href="{{ route(auth()->user()->getRoleNames()->first() . '.products.delete', $product->id) }}" class="delete"><i class="fa-regular fa-trash-can " style="color: #E13F3F;"></i></a>
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
            <input type="checkbox" id="switch100{{ $key }}" class="custom-switch-input" @if ($product->status == '1') checked="checked" @endif
            onchange="toggleStatus(this, 'Product', '{{ $product->id }}');"
            url="{{ route('dealer.products.status') }}"><label for="switch100{{ $key }}">Toggle</label>
        </div>
    </td>
    <td>
        <div class="action-btns">
            <a href="{{ route('dealer.products.edit', $product->id) }}"><i class="fa-solid fa-pen-to-square" style="color: #3EBE62;"></i></a>
            <a href="{{ route('dealer.products.delete', $product->id) }}"><i class="fa-regular fa-trash-can" style="color: #E13F3F;"></i></a>
        </div>
    </td>

    </tr> --}}

    @empty
    <div class="empty-data">
        <img src="{{ asset('assets/images/no-product.svg') }}  " alt="" width="300">
        <p class="text-center mt-1">Did not found any order</p>
    </div>
    @endforelse
    </tr>

    </table>
</div>
</div>
{!! $products->links('dealer.pagination') !!}
</div>
@endsection
@section('modals')
<div class="modal fade add-new-pro-modal" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- <div class="modal-header">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               </div> -->
            <div class="modal-body">
                <div class="add-pro-form">
                    <h2>Add New Products</h2>
                    <form id="product" action="{{ route('Dealer.products.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Product Name</label>
                                    <div class="form-field">
                                        <input type="text" name="name" class="form-control" placeholder="Product Name">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Product Category</label>
                                    <div class="form-field">
                                        <select type="text" name="category" class="form-control category" placeholder="Product Category">
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
                                        <select type="text" name="subcategory" class="form-control" placeholder="Product SubCategory" id="subcategory">
                                            <option value="">Select the category</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Part Number</label>
                                    <div class="form-field subcategory">
                                        <input type="text" class="form-control" id="part_number" name="part_number" value="{{ old('part_number', $product->part_number ?? ' ') }}" placeholder="Part Number">
                                        @error('part_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
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
                                        <input type="file" name="images[]" id="upload-image" multiple minlength="5" upload-image-count="0">

                                    </label>
                                    <div class="upload-img-preview">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Product Quantity</label>
                                    <div class="form-field">
                                        <input type="text" name="stocks_avaliable" class="form-control" placeholder="Product Quantity">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Product Price</label>
                                    <div class="form-field">
                                        <input type="text" name="price" class="form-control" placeholder="$000">

                                    </div>
                                </div>
                            </div>

                            {{-- <div class="col-md-12">
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
                            </div> --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="length">Length:</label>
                                    <div class="form-field">
                                        <input type="number" class="form-control" id="length" name="length" required value="{{ old('length', $product->length ?? ' ') }}">
                                        @error('length')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="width">Width:</label>
                                    <div class="form-field">
                                        <input type="number" class="form-control" id="width" name="width" required value="{{ old('width', $product->width ?? '') }}">
                                        @error('width')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="height">Height:</label>

                                    <div class="form-field">
                                        <input type="number" class="form-control" id="height" name="height" required value="{{ old('height', $product->height ?? ' ') }}">
                                        @error('height')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="weight">Weight:</label>
                                    <div class="form-field">
                                        <input type="number" class="form-control" id="weight" name="weight" required value="{{ old('weight', $product->weight ?? ' ') }}">
                                        @error('weight')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="distance_unit">Distance Unit:</label>
                                    <div class="form-field">
                                        <select id="distance_unit" class="form-control" name="distance_unit" required>
                                            <option value="cm">cm</option>
                                            <option value="m">m</option>
                                            <option value="in">in</option>
                                            <option value="ft">ft</option>
                                        </select>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mass_unit">Mass Unit:</label>
                                    <div class="form-field">
                                        <select id="mass_unit" class="form-control" name="mass_unit" required>
                                            <option value="lb">lb</option>
                                            <option value="kg">kg</option>
                                            <option value="oz">oz</option>
                                            <option value="g">g</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Shipping Price*</label>
                                    <div class="form-field">
                                        <input type="text" name="shipping_price" class="form-control"
                                            placeholder="$000">

                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="custm-field-for-ymmm">
                            <div class="field-for-ymmm-box">
                                <div class="form-group">
                                    <label for="">Year</label>
                                    <div class="form-field">
                                        {{-- <select class="form-control api_call" name="car_years"
                                                                id="car-years"></select> --}}
                                        <select class="form-control" name="car_years" id="carYear">
                                            <option id="selectYearDefault">Select year</option>
                                            @foreach ($years as $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                            @endforeach

                                        </select>
                                        <span class="form-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="8" viewBox="0 0 14 8" fill="none">
                                                <path d="M13 1L7 7L1 1" stroke="#272643" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Brand</label>
                                    <div class="form-field">
                                        {{-- <select class="form-control api_call" name="car_model"
                                                                id="car-makes"></select> --}}
                                        <select class="form-control" name="car_model" id="carModel">
                                            <option>please select year first</option>
                                        </select>
                                        <span class="form-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="8" viewBox="0 0 14 8" fill="none">
                                                <path d="M13 1L7 7L1 1" stroke="#272643" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Model*</label>
                                    <div class="form-field modelselect">
                                        <div id="output"></div>
                                        <select class="form-control car-model" id="carMake">
                                            <option>Select your make</option>
                                        </select>
                                        <span class="form-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="8" viewBox="0 0 14 8" fill="none">
                                                <path d="M13 1L7 7L1 1" stroke="#272643" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            {{-- <i id="addValue" style="font-size: 20px; margin-top:50px;" class="fa-solid fa-circle-plus fa-fw"></i> --}}
                        </div>
                </div>
                <input type="hidden" name="compatable_with" class="form-control" id="compatableProducts" placeholder="Product Name">
                <div id="test1234" class="ymmm-box-preview d-none">
                    {{-- <div class="ymmm-data-outer">
                        <div class="ymmm-box-data">
                            <p>2023(Bentley)743</p>
                        </div>
                        <span class="ymmm-cross">×</span>
                    </div> --}}
                </div>
                <div class="row">
                    {{-- <div class="col-md-6">
                        <a href="#" class="btn secondary-btn full-btn" data-bs-toggle="modal" data-bs-target="#bulk-upload">Bulk Upload</a>
                    </div> --}}
                    <div class="col-md-12">
                        <div class="d-flex aign-items-center justify-content-end">
                            <button type="submit" id="submit" class="btn primary-btn md-btn">submit</button>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>



            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-field">
                                        <input type="checkbox" name="subscription_status"
                                            @if (isset(plan_validity()->stripe_status) && plan_validity()->stripe_status == 'active') checked @else disabled @endif>

                                    </div>
                                </div>
                            </div> --}}


            </form>
        </div>
    </div>

</div>
</div>
</div>



<div class="modal fade" id="bulk-upload" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="bulk-upload" aria-hidden="true">
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
                                <button type="submit" class="btn secondary-btn full-btn">submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="pro-detail-model" tabindex="-1" aria-labelledby="bulk-upload" aria-hidden="true">
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
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#additional-information" aria-expanded="false" aria-controls="collapseTwo">
                                                Additional Information
                                            </button>
                                        </h2>
                                        <div id="additional-information" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
    // $(document).ready({
    //     function() {
    //         var carquery = new CarQuery();
    //         carquery.init();
    //         carquery.initYearMakeModelTrim('car-years', 'car-makes', 'car-models', 'car-model-trims');
    //     }
    // });
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

                    }

                }

            })
        } else {
            var id = $(this).attr('product-id');
            $.ajax({
                url: APP_URL + "/dealer/featured/products/create/" + id,
                success: function(result) {
                    if (result.status == true) {
                        location.reload();
                    } else {
                        $(".feature-switch").addClass('checked', false);
                    }
                }

            })
        }
    })
</script>
<script>
    jQuery(document).ready(function() {
        var models = [];
        var selectedYear = "";
        var selectedMake = "";
        var selectedModel = "";
        var selectedValue = "";
        jQuery(document).on('change', '#carYear', function() {

            var year = jQuery(this).val();
            var url = APP_URL + '/dealer/model/' + year
            var response = ajaxCall(url, 'get', null, false);
            response.then(handleStateData).catch(handleStateError)

            function handleStateData(response) {
                if (response.success == true) {
                    jQuery('#carModel').html(response.models)
                    selectedYear = year;
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
                    jQuery('#carMake').html(response.makes);
                    selectedMake = model;
                } else {
                    jQuery('#errormessage').html(response.error);
                }
            }

            function handleStateError(error) {
                console.log('error', error)

            }
        });

        jQuery(document).on('change', '#carMake', function() {

            var model1 = jQuery(this).find('option:selected').attr('data-name');

            selectedModel = model1;
            var test = selectedYear + "(" + selectedMake + ")" + selectedModel;
            if (!models.includes(test)) {
                models.push(test);
            }
            jQuery('#compatableProducts').val(models);
            var htmlText = "";
            for (var i = 0; i < models.length; i++) {
                htmlText += `<div class="ymmm-data-outer">
                        <div class="ymmm-box-data">
                            <p>` + models[i] + `</p>
                        </div>
                        <span class="ymmm-cross">×</span>
                    </div>`;
            }
            jQuery('#test1234').html(htmlText)
            jQuery('#test1234').removeClass('d-none');
        });

        jQuery(document).on('click', '.ymmm-cross', function() {
            var data = jQuery(this).siblings('.ymmm-box-data').find('p').text();
            var index = models.indexOf(data);
            if (index > -1) {
                models.splice(index, 1);
            }
            jQuery(this).closest('.ymmm-data-outer').remove();
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
        // var carquery = new CarQuery();
        // carquery.init();
        // carquery.initYearMakeModelTrim('car-years', 'car-makes', 'car-models', 'car-model-trims');

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