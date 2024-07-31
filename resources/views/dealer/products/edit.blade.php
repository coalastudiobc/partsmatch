@extends('layouts.dealer')
@section('heading', 'Edit Product')
@section('content')
{{-- <div class="main-content">
        <section class="section"> --}}
<div class="section-body edit-product-sec">
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
            <form id="product" action="{{ route(auth()->check() ? auth()->user()->getRoleNames()->first() . '.products.update' : 'Dealer.products.update', $product->id) }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Product Name<span class="required-field">*</span></label>

                            <div class="form-field">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}">
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
                            <label for="">Product Category<span class="required-field">*</span></label>
                            <div class="form-field">
                                <select type="text" name="category" class="form-control category" placeholder="Product Category">
                                    <option value="">Select the category</option>
                                    @foreach (get_category() as $category)
                                    <option value="{{ $category->id }}" @if ($product->category->parent_id == $category->id) Selected @endif>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Product SubCategory<span class="required-field">*</span></label>
                            <div class="form-field subcategory">
                                <select type="text" name="subcategory" class="form-control" placeholder="Product SubCategory" id="subcategory">
                                    <option value="{{ $product->subcategory_id }}">
                                        {{ $product->category ? $product->category->name : 'Select the subcategory' }}
                                    </option>
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Description<span class="required-field">*</span></label>
                            <div class="form-field">
                                <textarea name="description" class="form-control summernote @error('description') is-invalid @enderror">{{ $product->description ? $product->description : '' }} </textarea>
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
                    {{-- <div class="col-md-6">
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
                <textarea name="Specifications_and_dimensions" class="form-control @error('Specifications_and_dimensions') is-invalid @enderror" id="" cols="30" rows="2">{{ $product->Specifications_and_dimensions ? $product->Specifications_and_dimensions : '' }}</textarea>
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
                <textarea name="Shipping_info" class="form-control @error('Shipping_info') is-invalid @enderror" id="" cols="30" rows="2">{{ $product->Shipping_info ? $product->Shipping_info : '' }}</textarea>
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
                <textarea name="field_3" class="form-control @error('field_3') is-invalid @enderror" id="" cols="30" rows="2">{{ $product->field_3 ? $product->field_3 : '' }}</textarea>
                @error('field_3')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div> --}}
    <div class="col-md-12">
        <div class="form-group">
            <label for="">Add Product Images (Up to 5)</label>
            <!-- <label class="img-upload-box">
                                            <p>Upload Images</p>
                                            <input type="file" name="images[]" id="upload-image" multiple mixlength="5">
                                            <input type="hidden" name="total-img-preview" id="total-img-preview"
                                                value={{ count($product->productImage) }}>
                                            <input type="hidden" name="image_id[]" value="imageid[]" id="get_image_id">

                                        </label> -->

            <div class="pre-upload-img-preview">
                @foreach ($product->productImage as $image)
                <div class="upload-img-box">
                    <img src="{{ Storage::url($image->file_url) }}" class="uploadedimage" alt="img" img-id="{{ $image->id }}" height="100px" width="75px">
                    <div class="upload-img-cross">
                        <i class="fa-regular fa-circle-xmark remove_uploaded"></i>
                    </div>
                </div>
                @endforeach
                <label class="img-upload-box">
                    <div class="img-upload-box-inner">
                        <i class="fa-solid fa-plus"></i>
                        <p>Upload Images</p>
                    </div>
                    <input type="file" name="images[]" id="upload-image" multiple mixlength="5">
                    <input type="hidden" name="total-img-preview" id="total-img-preview" value={{ count($product->productImage) }}>
                    <input type="hidden" name="image_id[]" value="imageid[]" id="get_image_id">

                </label>

            </div>
            <div class="upload-img-preview"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="">Product Quantity<span class="required-field">*</span></label>
            <div class="form-field">
                <input type="text" name="stocks_avaliable" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('stocks_avaliable', $product->stocks_avaliable) }}">
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
            <label for="">Product Price<span class="required-field">*</span></label>
            <div class="form-field">
                <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}">
                @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>
    {{-- <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="length">Length:</label>
                                        <div class="form-field">
                                            <input type="number" class="form-control" id="length" name="length"
                                                required value="{{ old('length', $product->parcelDetail->length) }}">
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
            <input type="number" class="form-control" id="width" name="width" required value="{{ old('width', $product->parcelDetail->width) }}">
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
            <input type="number" class="form-control" id="height" name="height" required value="{{ old('height', $product->parcelDetail->height) }}">
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
            <input type="number" class="form-control" id="weight" name="weight" required value="{{ old('weight', $product->parcelDetail->weight) }}">
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
</div> --}}

{{-- <div class="col-md-6">
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
</div> --}}
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

<div class="row">
    <div class="col-md-6">
    </div>
    <div class="col-md-6">
        <div class="d-flex align-items-center gap-2 justify-content-end">
            <a href="{{ route(auth()->user()->getRoleNames()->first() . '.products.index') }}" class="btn secondary-btn md-btn mr-1">Back</a>
            <button class="btn primary-btn md-btn mr-1" id="submit" type="submit">Submit</button>
        </div>
    </div>
</div>
</div>
</form>

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
            var models = [];
            var selectedYear = "";
            var selectedMake = "";
            var selectedModel = "";
            var selectedValue = "";
            var htmlText = "";
            jQuery(document).on('change', '#carYear', function() {

                var year = jQuery(this).val();
                var url = APP_URL + '/dealer/model/' + year
                var response = ajaxCall(url, 'get', null, false);
                response.then(handleStateData).catch(handleStateError)

                function handleStateData(response) {
                    if (response.success == true) {
                        console.log(response.model)
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
                        console.log(response.model)
                        jQuery('#carMake').html(response.makes)
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
                console.log(models);
                jQuery('#compatableProducts').val(models);
                // var htmlText = "";
                for (var i = models.length - 1; i < models.length; i++) {
                    htmlText += `<div class="ymmm-data-outer">
            <div class="ymmm-box-data">
                <p>` + models[i] + `</p>
            </div>
            <span class="ymmm-cross">×</span>
        </div>`;
                }
                console.log(htmlText);
                jQuery('#test1234').html(htmlText)
                jQuery('#test1234').removeClass('d-none');
            });
            var oppositeStringArray = @json($oppositeString);
            var oppositeStringArray = JSON.parse(oppositeStringArray);
            for (var i = 0; i < oppositeStringArray.length; i++) {
                htmlText += `<div class="ymmm-data-outer">
            <div class="ymmm-box-data">
                <p>` + oppositeStringArray[i] + `</p>
            </div>
            <span class="ymmm-cross">×</span>
        </div>`;
                models.push(oppositeStringArray[i]);
            }
            jQuery('#compatableProducts').val(models);

            jQuery('#test1234').html(htmlText)
            jQuery('#test1234').removeClass('d-none');

            jQuery(document).on('click', '.ymmm-cross', function() {
                var data = jQuery(this).siblings('.ymmm-box-data').find('p').text();
                console.log('dat', data);
                var index = models.indexOf(data);
                console.log('index', index);

                if (index > -1) {
                    models.splice(index, 1);
                    console.log('models', models);
                    jQuery('#compatableProducts').val(models);
                }
                jQuery(this).closest('.ymmm-data-outer').remove();
            });
            console.log('models outside', models);

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
                $(this).parent('div').parent('div').remove();
                $('#total-img-preview').val(total_img - 1)


                getimgid = $(this).parent().prev().attr('img-id')
                getid.push(getimgid)
                console.log(getid, $.type(getid), "again check");
                $('#get_image_id').val(getid);
        });

    });
</script>
@endpush