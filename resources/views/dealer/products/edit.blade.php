@extends('layouts.dealer')
@section('heading', 'Edit Product')
@section('content')
    {{-- <div class="main-content">
        <section class="section"> --}}
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class='ajax-response'></div>
                    <x-alert-component />
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card-body">
                        <form id="product" action="{{ route('dealer.products.update', $product->id) }}"
                            enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Product Name</label>

                                        <div class="form-field">
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name', $product->name) }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
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
                                                    <option value="{{ $category->id }}"
                                                        @if ($product->category->parent_id == $category->id) Selected @endif>
                                                        {{ $category->name }}
                                                    </option>
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
                                                <option value="{{ $product->subcategory_id }}">
                                                    {{ $product->category ? $product->category->name : 'Select the subcategory' }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Product Description</label>
                                        <div class="form-field">
                                            <textarea name="description" class="form-control summernote @error('description') is-invalid @enderror">{{ $product->description ? $product->description : '' }}  </textarea>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Additional details</label>
                                        <div class="form-field">
                                            <textarea name="additional_details" class="form-control summernote @error('additional_details') is-invalid @enderror">{{ $product->additional_details ? $product->additional_details : '' }}</textarea>
                                            @error('additional_details')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Other specifications</label>
                                        <div class="form-field">
                                            <textarea name="other_specification" class="form-control summernote @error('other_specification') is-invalid @enderror">{{ $product->other_specification ? $product->other_specification : '' }}</textarea>
                                            @error('other_specification')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Specifications and dimensions</label>
                                        <div class="form-field">
                                            <textarea name="Specifications_and_dimensions"
                                                class="form-control @error('Specifications_and_dimensions') is-invalid @enderror" id="" cols="30"
                                                rows="2">{{ $product->Specifications_and_dimensions ? $product->Specifications_and_dimensions : '' }}</textarea>
                                            @error('other_specification')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Shipping info</label>
                                        <div class="form-field">
                                            <textarea name="Shipping_info" class="form-control @error('Shipping_info') is-invalid @enderror" id=""
                                                cols="30" rows="2">{{ $product->Shipping_info ? $product->Shipping_info : '' }}</textarea>
                                            @error('Shipping_info')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">field 3</label>
                                        <div class="form-field">
                                            <textarea name="field_3" class="form-control @error('field_3') is-invalid @enderror" id="" cols="30"
                                                rows="2">{{ $product->field_3 ? $product->field_3 : '' }}</textarea>
                                            @error('field_3')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                {{-- @dd($product) --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Add Product Images (Up to 5)</label>
                                        <label class="img-upload-box">
                                            <p>Upload Images</p>
                                            <input type="file" name="images[]" id="upload-image" multiple
                                                mixlength="5">
                                            <input type="hidden" name="total-img-preview" id="total-img-preview"
                                                value={{ count($product->productImage) }}>
                                            <input type="hidden" name="image_id[]" value="imageid[]" id="get_image_id">

                                        </label>

                                        <div class="pre-upload-img-preview">
                                            @foreach ($product->productImage as $image)
                                                <div class="upload-img-box">
                                                    <img src="{{ Storage::url($image->file_url) }}" class="uploadedimage"
                                                        alt="img" img-id="{{ $image->id }}" height="100px"
                                                        width="75px">
                                                    <div class="upload-img-cross">
                                                        <i class="fa-regular fa-circle-xmark remove_uploaded"></i>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                        <div class="upload-img-preview"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Product Quantity</label>
                                        <div class="form-field">
                                            <input type="text" name="stocks_avaliable"
                                                class="form-control @error('quantity') is-invalid @enderror"
                                                value="{{ old('stocks_avaliable', $product->stocks_avaliable) }}">
                                            @error('stocks_avaliable')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Product Price</label>
                                        <div class="form-field">
                                            <input type="text" name="price"
                                                class="form-control @error('price') is-invalid @enderror"
                                                value="{{ old('price', $product->price) }}">
                                            @error('price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Shipping Price</label>
                                        <div class="form-field">
                                            <input type="text" name="shipping_price"
                                                class="form-control @error('shipping_price') is-invalid @enderror"
                                                value="{{ old('shipping_price', $product->shipping_price) }}">
                                            @error('shipping_price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
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
                                                    <option value="{{ $year }}"
                                                        @if ($product->year == $year) Selected @endif>
                                                        {{ $year }}
                                                    </option>
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
                                        <label for="">Model*</label>
                                        <div class="form-field">
                                            {{-- <select class="form-control api_call" name="car_model"
                                                        id="car-makes"></select> --}}
                                            <select class="form-control" name="car_model" id="carModel">
                                                <option>{{ $product->model }}</option>

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
                                            {{-- <select class="form-control api_call" name="car_make"
                                                        id="car-models"></select> --}}
                                            <select class="form-control" name="car_make" id="carMake">
                                                <option>{{ $product->brand }}</option>

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
                                {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Image</label>
                                                <div class="form-field">
                                                    <input type="file" name="image"
                                                        class="form-control @error('image') is-invalid @enderror">
                                                    @error('image')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> --}}

                                <div class="col-md-6">
                                    <a href="{{ route('dealer.products.index') }}"
                                        class="btn secondary-btn full-btn mr-1">Back</a>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn primary-btn full-btn mr-1" id="submit"
                                        type="submit">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- </section> --}}
    {{-- </div> --}}
@endsection

@push('scripts')
    @includeFirst(['validation.dealer.js_product'])
    <script>
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

                            jQuery(element).appendTo(imgPreviewPlaceholder);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }

                    var total_img = parseInt($('#total-img-preview').val())
                    $('#total-img-preview').val(total_img + filesAmount)
                }
            };
            $('#upload-image').on('change', function() {
                previewImages(this, 'div.upload-img-preview');
            });

            var getid = []
            $(document).on('click', '.remove_uploaded', function() {
                var total_img = parseInt($('#total-img-preview').val())
                if (total_img > 5) {
                    $(this).parent('div').parent('div').remove();
                    $('#total-img-preview').val(total_img - 1)


                    getimgid = $(this).parent().prev().attr('img-id')
                    getid.push(getimgid)
                    console.log(getid, $.type(getid), "again check");
                    $('#get_image_id').val(getid);
                } else {
                    return iziToast.error({
                        message: "please provide images",
                        position: 'topRight'
                    });
                }
            });

        });
    </script>
@endpush
