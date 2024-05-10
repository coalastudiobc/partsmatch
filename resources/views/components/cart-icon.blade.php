@if (count(auth()->user()->cart) != 0)
    <li class="nav-item">
        <a class="nav-link" aria-current="page" href="{{ route('dealer.cart.cart.index') }}">
            <div class="nav-msg-icon">
                <p class="carttotal">{{ count(auth()->user()->cart) }}</p>
                <img src="{{ asset('assets/images/cart.png') }}" alt="img">
            </div>
        </a>
    </li>
@endif
