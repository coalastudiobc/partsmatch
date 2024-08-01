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

{{-- ------------------ product-manager page --------------------------------}}

<div class="card custom-partsmanager-card">
    <div class="custom-partsmanager-box">
        <div class="custom-partsmanager-left">
            <div class="partsmanager-info-box">
                <h2>Rishabh girdhar</h2>
                <p>Customer</p>
            </div>
            <div class="partsmanager-info-box">
                <h4>Akshya Nagar 1st Block 1st Cross, Bangalore</h4>
                <p>Address</p>
            </div>
            <div class="partsmanager-info-box">
                <h4>B87452155552322745</h4>
                <p>Shipping id</p>
            </div>
        </div>
        <div class="custom-partsmanager-right">
            <div class="partsmanager-info-status">
                <p>Status</p>
                <div class="confirm-badge">
                    <i class="fa-solid fa-check"></i>
                    <p>Confirmed</p>
                </div>
            </div>
            <div class="partsmanager-info-box">
                <h3>$375.66</h3>
                <p>Price</p>
            </div>
            <div class="partsmanager-dates-box">
                <div class="partsmanager-dates-inner">
                    <h4>07/29/2024</h4>
                    <p><i class="fa-regular fa-calendar-days"></i> Order Date</p>
                </div>
                <div class="partsmanager-dates-inner">
                    <h4>07/29/2024</h4>
                    <p><i class="fa-regular fa-calendar-days"></i> ship date</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="partsmanager-link-box">
                <p>Track url</p>
                <h5>https://iconscout.com/icons/link?page=2&price=free?page=2&price=free</h5>
            </div>
        </div>
        <div class="col-md-6">
            <div class="partsmanager-link-box">
                <p>Label URL</p>
                <h5>https://iconscout.com/icons/link?page=2&price=free</h5>
            </div>
        </div>
        <div class="col-md-12">
            <div class="carrier-services-box">
                <p>Carrier services</p>
                <div class="carrier-services-serever">
                    <p>UPS-ground-server XXXXXXXXXX</p>
                    <a href="#">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                                <path d="M2.53334 7.42449C2.09375 6.9476 1.8567 6.31854 1.87225 5.67014C1.8878 5.02174 2.15473 4.40476 2.61667 3.94949L3.79167 2.76616C4.02577 2.52178 4.3063 2.32661 4.61683 2.19209C4.92736 2.05758 5.26162 1.98643 5.60001 1.98282C5.90865 1.97951 6.21488 2.03746 6.50097 2.15333C6.78706 2.26919 7.04732 2.44067 7.26667 2.65782L11.8333 7.21616C11.908 7.30339 12 7.37424 12.1034 7.42426C12.2068 7.47428 12.3194 7.50239 12.4341 7.50682C12.5489 7.51126 12.6633 7.49192 12.7703 7.45002C12.8772 7.40813 12.9743 7.34458 13.0555 7.26337C13.1368 7.18215 13.2003 7.08503 13.2422 6.97809C13.2841 6.87116 13.3034 6.75671 13.299 6.64195C13.2946 6.52718 13.2665 6.41457 13.2164 6.31118C13.1664 6.20779 13.0956 6.11586 13.0083 6.04116L8.44167 1.50782C8.07203 1.12892 7.62999 0.828176 7.14183 0.623464C6.65368 0.418752 6.12935 0.314247 5.60001 0.316157C5.04333 0.317295 4.49253 0.429969 3.98013 0.647525C3.46773 0.865081 3.00412 1.18311 2.61667 1.58282L1.43334 2.76616C0.659798 3.53517 0.218652 4.57685 0.204629 5.66751C0.190607 6.75817 0.604825 7.81085 1.35834 8.59949L1.89167 9.14116C1.96914 9.21926 2.06131 9.28126 2.16286 9.32357C2.26441 9.36587 2.37333 9.38766 2.48334 9.38766C2.59335 9.38766 2.70227 9.36587 2.80382 9.32357C2.90537 9.28126 2.99754 9.21926 3.07501 9.14116C3.15311 9.06369 3.21511 8.97152 3.25742 8.86997C3.29972 8.76842 3.3215 8.6595 3.3215 8.54949C3.3215 8.43948 3.29972 8.33056 3.25742 8.22901C3.21511 8.12746 3.15311 8.03529 3.07501 7.95782L2.53334 7.42449ZM15.5667 8.64949L15.0083 8.09116C14.8522 7.93595 14.641 7.84883 14.4208 7.84883C14.2007 7.84883 13.9895 7.93595 13.8333 8.09116C13.7552 8.16863 13.6932 8.26079 13.6509 8.36234C13.6086 8.46389 13.5868 8.57281 13.5868 8.68282C13.5868 8.79283 13.6086 8.90175 13.6509 9.0033C13.6932 9.10485 13.7552 9.19702 13.8333 9.27449L14.3917 9.83282C14.626 10.0652 14.812 10.3417 14.9389 10.6464C15.0658 10.951 15.1312 11.2778 15.1312 11.6078C15.1312 11.9379 15.0658 12.2646 14.9389 12.5693C14.812 12.8739 14.626 13.1504 14.3917 13.3828L13.2083 14.5662C12.7306 15.0236 12.0947 15.2789 11.4333 15.2789C10.7719 15.2789 10.1361 15.0236 9.65834 14.5662L4.97501 9.86616C4.81887 9.71095 4.60766 9.62383 4.38751 9.62383C4.16735 9.62383 3.95614 9.71095 3.80001 9.86616C3.7219 9.94363 3.6599 10.0358 3.6176 10.1373C3.57529 10.2389 3.55351 10.3478 3.55351 10.4578C3.55351 10.5678 3.57529 10.6768 3.6176 10.7783C3.6599 10.8799 3.7219 10.972 3.80001 11.0495L8.50001 15.7328C8.88705 16.1209 9.34685 16.4287 9.85306 16.6388C10.3593 16.8488 10.9019 16.9569 11.45 16.9569C11.9981 16.9569 12.5407 16.8488 13.047 16.6388C13.5532 16.4287 14.013 16.1209 14.4 15.7328L15.5833 14.5495C15.9703 14.1613 16.2768 13.7007 16.4855 13.1939C16.6941 12.6871 16.8007 12.1441 16.7991 11.596C16.7976 11.048 16.6879 10.5056 16.4764 9.99998C16.265 9.49437 15.9558 9.03544 15.5667 8.64949Z" fill="#272643"/>
                                <path d="M10.5 11.4912C10.3903 11.4918 10.2816 11.4708 10.1801 11.4293C10.0786 11.3878 9.98621 11.3267 9.90834 11.2495L5.91667 7.2495C5.76146 7.09337 5.67435 6.88216 5.67435 6.662C5.67435 6.44185 5.76146 6.23064 5.91667 6.0745C5.99414 5.99639 6.08631 5.9344 6.18786 5.89209C6.28941 5.84978 6.39833 5.828 6.50834 5.828C6.61835 5.828 6.72727 5.84978 6.82882 5.89209C6.93037 5.9344 7.02254 5.99639 7.10001 6.0745L11.0833 10.0662C11.2004 10.1822 11.2803 10.3304 11.3132 10.4919C11.346 10.6534 11.3302 10.821 11.2677 10.9735C11.2053 11.1261 11.099 11.2567 10.9624 11.3488C10.8257 11.4409 10.6648 11.4905 10.5 11.4912Z" fill="#272643"/>
                            </svg>
                        </span>
                    </a>
                </div>
                <a href="#" class="btn secondary-btn">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                            <path d="M12.1407 15.8495C12.2407 15.9495 12.3407 16.0495 12.4407 16.0495C12.5407 16.1495 12.7407 16.1495 12.8407 16.1495C12.9407 16.1495 13.1407 16.1495 13.2407 16.0495C13.3407 15.9495 13.4407 15.9495 13.5407 15.8495L17.5407 11.8495C17.9407 11.4495 17.9407 10.8495 17.5407 10.4495C17.1407 10.0495 16.5407 10.0495 16.1407 10.4495L13.8407 12.7495V5.14951C13.8407 4.54951 13.4407 4.14951 12.8407 4.14951C12.2407 4.14951 11.8407 4.54951 11.8407 5.14951V12.7495L9.5407 10.4495C9.1407 10.0495 8.5407 10.0495 8.1407 10.4495C7.7407 10.8495 7.7407 11.4495 8.1407 11.8495L12.1407 15.8495Z" fill="white"/>
                            <path d="M19.8407 13.1495C19.2407 13.1495 18.8407 13.5495 18.8407 14.1495V16.1495C18.8407 17.2495 17.9407 18.1495 16.8407 18.1495H8.8407C7.7407 18.1495 6.8407 17.2495 6.8407 16.1495V14.1495C6.8407 13.5495 6.4407 13.1495 5.8407 13.1495C5.2407 13.1495 4.8407 13.5495 4.8407 14.1495V16.1495C4.8407 18.3495 6.6407 20.1495 8.8407 20.1495H16.8407C19.0407 20.1495 20.8407 18.3495 20.8407 16.1495V14.1495C20.8407 13.5495 20.4407 13.1495 19.8407 13.1495Z" fill="white"/>
                        </svg>
                    </span>
                    Download
                </a>
            </div>
        </div>
    </div>
</div>

{{-- ------------------ product-manager page --------------------------------}}

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