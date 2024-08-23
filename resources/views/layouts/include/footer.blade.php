@section('footer')
    <footer class="footer-sec">
        <div class="footer-main">
            <div class="container">
                <div class="footer-wrapper">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="footer-logo-box">
                                <h6><a href="#" class="footer-name">PartsMatch</a></h6>
                                <h2 class="footer-title">The Right Part<br> for the Right Price Every Time</h2>
                                <p class="ls-footer-title">Lorem ipsum, or lipsum as it is sometimes known, is dummy
                                    text
                                    used in laying out print, graphic or web designs.</p>
                                <!-- <div class="footer-btn">
                                    <a href="#" class="btn primary-btn">View More</a>
                                </div> -->
                                
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="footer-link-list">
                                <h4>Customer Service</h4>
                                @php
                                    $contactUsRoute=get_cms()->where('slug','contact-us')->first();
                                @endphp
                                @if ($contactUsRoute)
                                <ul>
                                    <li><a href="{{ route('view', ['slug' => $contactUsRoute->slug]) }}">{{ $contactUsRoute->name }}</a></li>
                                </ul>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="footer-social-list">
                                <h4>Information</h4>
                                <ul>

                                    @foreach (get_cms() as $cms)
                                        <li>
                                            <a href="{{ route('view', ['slug' => $cms->slug]) }}">{{ $cms->name }}</a>
                                        </li>
                                    @endforeach
                                    {{-- <li><a href="{{ route('view', ['slug' => 'about-us']) }}">About Us</a></li>

                                    <li><a href="{{ route('view', ['slug' => 'terms & conditions']) }}">Terms &
                                            Conditions</a></li>
                                    <li><a href="{{ route('view', ['slug' => 'faq']) }}">FAQ</a></li>
                                    <li><a href="{{ route('view', ['slug' => 'contact-us']) }}">Contact us</a>
                                    </li>
                                    <li><a href="{{ route('view', ['slug' => 'how it works']) }}">How it Works</a>
                                    </li>
                                    <li><a href="{{ route('view', ['slug' => 'privacy policy']) }}">Privacy Policy</a></li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-small">
                    <p class="right-reserve">{{ date('Y') }} partsmatch.ai  All Right Reserved</p>
                </div>
            </div>
        </div>

    </footer>
@endsection
