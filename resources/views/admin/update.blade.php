@extends('layouts.admin')
@section('title', 'Update Pofile')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-6 col-md-6 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Update Profile</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST"
                                    action="{{ route('admin.users.update', [jsencode_userdata($user->id)]) }}" id="profile"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label>Name</label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ $user->name ? ucfirst($user->name) : '' }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Email</label>
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ $user->email ? $user->email : '' }}">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label>Profile Picture</label>
                                            <input type="file" name="profile_pic"
                                                class="form-control  @error('profile_pic') is-invalid   @enderror">
                                            @error('profile_pic')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        {{-- <div class="form-group col-6">
                                            <label for="country">Choose your country</label>
                                            <select id="country_id" name="country_id" class="form-control">
                                                <option value="">Choose your country</option>
                                                @php $country = get_country(); @endphp
                                                @foreach ($country as $value)
                                                    <option value="{{ $value->id }}"
                                                        @if (old('country_id') == $value->id || $user->country_id == $value->id) selected @endif>
                                                        {{ ucfirst($value->name) }}</option>
                                                @endforeach
                                            </select>
                                            @error('country_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div> --}}
                                    </div>
                                    @if (!auth()->user()->role == 'Administrator')
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="password" class="d-block">{{ __('Password') }}</label>
                                                <input id="password_confirmation" type="password"
                                                    class="form-control pwstrength @error('password') is-invalid @enderror"
                                                    data-indicator="pwindicator" name="password"
                                                    autocomplete="new-password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div id="pwindicator" class="pwindicator">
                                                    <div class="bar"></div>
                                                    <div class="label"></div>
                                                </div>
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="password-confirm"
                                                    class="d-block">{{ __('Confirm Password') }}</label>
                                                <input type="password" class="form-control" name="password_confirmation"
                                                    autocomplete="new-password">

                                            </div>
                                        </div>
                                    @endif
                                    <div class="card-footer text-right">
                                        <a class="btn btn-success" href="{{ url()->previous() }}"> Back</a>
                                        <button class="btn btn-primary mr-1" id="submit">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
        </section>
    </div>

@endsection
@push('scripts')
    @includeFirst(['validation.js_profile'])
    <script>
        jQuery(document).on('click', '#submit', function(e) {
            e.preventDefault();
            if (jQuery('#profile').valid()) {
                var formData = new FormData($('form#profile').get(0));
                url = "{{ route('admin.users.update', [jsencode_userdata($user->id)]) }}";
                var response = ajaxCall(url, 'post', formData);
                response.then(handleUser).catch(handleUserError)

                function handleUser(response) {
                    if (response.success == true && response.url) {

                        window.location.replace(response.url);

                    } else if (response.success == false) {
                        if ('errortype' in response && response.errortype) {
                            var response_ajax = jQuery(document).find(".ajax-response-" + response.errortype);
                        } else {
                            var response_ajax = jQuery(document).find(".ajax-response");
                            $("html, body").animate({
                                scrollTop: 0
                            }, "fast");
                        }
                        response_ajax.html(
                            '<div class="alert alert-danger alert-dismissible fade show k" role="alert">' +
                            response.msg +
                            '<button type="button" class="btn-close close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                        );
                    }
                }

                function handleUserError(error) {
                    console.log('error', error)
                }
            }
        });
    </script>
@endpush
