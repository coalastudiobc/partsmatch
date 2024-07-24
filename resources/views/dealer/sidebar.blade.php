<div class="dashboard-left-box">


    <span class="sidebar-cross-icon">
        <i class="fa-solid fa-xmark cross-filter"></i>
    </span>

    <h2>Dashboard</h2>
    <div class="analyics-tabs">
        <ul>
            {{-- <li class="analyics-tabs-list">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne1" aria-expanded="false"
                                aria-controls="flush-collapseOne">
                                <a href="{{ route('dealer.dashboard') }}"
            class="analyics-tabs-btns @if (Route::is('dealer.dashboard')) active @endif ">
            <div class="analyics-tabs-name">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                        <g opacity="0.3">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.45698 4.2498H4.5268V5.37372C4.5268 5.56962 4.68561 5.72843 4.88151 5.72843C5.07741 5.72843 5.23622 5.56962 5.23622 5.37372V4.2498H8.95125V5.37372C8.95125 5.56962 9.11006 5.72843 9.30596 5.72843C9.50186 5.72843 9.66067 5.56962 9.66067 5.37372V4.2498H11.7305C11.9604 4.2498 12.1509 4.42362 12.172 4.65259L12.5056 8.28285C12.3478 8.26645 12.1876 8.25791 12.0254 8.25791C9.4907 8.25791 7.43589 10.3127 7.43589 12.8474C7.43589 13.4709 7.56044 14.0651 7.78559 14.607H2.05227C1.79923 14.607 1.58138 14.5109 1.41085 14.324C1.24029 14.137 1.16452 13.9113 1.18766 13.6593L2.01548 4.65259C2.03653 4.42362 2.22702 4.2498 2.45698 4.2498ZM4.5268 4.19139V2.92689C4.5268 2.22062 4.81547 1.57881 5.28054 1.11373C5.74562 0.648653 6.38744 0.359985 7.0937 0.359985C7.79996 0.359985 8.44178 0.648653 8.90686 1.11373C9.37193 1.57881 9.6606 2.22066 9.6606 2.92689V4.19139H8.95122V2.92689C8.95122 2.41645 8.74214 1.95211 8.40529 1.6153C8.06844 1.27845 7.60417 1.06937 7.0937 1.06937C6.58327 1.06937 6.11896 1.27845 5.78211 1.6153C5.44526 1.95211 5.23619 2.41642 5.23619 2.92689V4.19139H4.5268ZM12.0254 9.05479C9.93077 9.05479 8.23273 10.7528 8.23273 12.8474C8.23273 14.9421 9.93077 16.6401 12.0254 16.6401C14.12 16.6401 15.8181 14.9421 15.8181 12.8474C15.8181 10.7528 14.12 9.05479 12.0254 9.05479ZM10.1715 13.072L11.3062 14.114C11.4652 14.2603 11.7113 14.2526 11.8608 14.0984L13.8855 12.1598C14.0437 12.0077 14.0486 11.7561 13.8964 11.598C13.7443 11.4398 13.4927 11.435 13.3346 11.5871L11.57 13.2766L10.7101 12.4868C10.5485 12.3381 10.2969 12.3486 10.1482 12.5101C9.99947 12.6717 10.0099 12.9233 10.1715 13.072Z" fill="black" />
                        </g>
                    </svg>
                </span>
                <h4>Dashboard</h4>
            </div>
            </a>
            </button>
            </h2>
    </div>
</div>
</li> --}}
<li class="analyics-tabs-list">
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
                {{-- <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne1" aria-expanded="false"
                                aria-controls="flush-collapseOne"> --}}
                <a href="{{ route(auth()->user()->getRoleNames()->first() . '.products.index') }}" class="analyics-tabs-btns @if (Route::is('Dealer.products.*')) active @endif ">
                    <div class="analyics-tabs-name">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                                <g opacity="0.3">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2.45698 4.2498H4.5268V5.37372C4.5268 5.56962 4.68561 5.72843 4.88151 5.72843C5.07741 5.72843 5.23622 5.56962 5.23622 5.37372V4.2498H8.95125V5.37372C8.95125 5.56962 9.11006 5.72843 9.30596 5.72843C9.50186 5.72843 9.66067 5.56962 9.66067 5.37372V4.2498H11.7305C11.9604 4.2498 12.1509 4.42362 12.172 4.65259L12.5056 8.28285C12.3478 8.26645 12.1876 8.25791 12.0254 8.25791C9.4907 8.25791 7.43589 10.3127 7.43589 12.8474C7.43589 13.4709 7.56044 14.0651 7.78559 14.607H2.05227C1.79923 14.607 1.58138 14.5109 1.41085 14.324C1.24029 14.137 1.16452 13.9113 1.18766 13.6593L2.01548 4.65259C2.03653 4.42362 2.22702 4.2498 2.45698 4.2498ZM4.5268 4.19139V2.92689C4.5268 2.22062 4.81547 1.57881 5.28054 1.11373C5.74562 0.648653 6.38744 0.359985 7.0937 0.359985C7.79996 0.359985 8.44178 0.648653 8.90686 1.11373C9.37193 1.57881 9.6606 2.22066 9.6606 2.92689V4.19139H8.95122V2.92689C8.95122 2.41645 8.74214 1.95211 8.40529 1.6153C8.06844 1.27845 7.60417 1.06937 7.0937 1.06937C6.58327 1.06937 6.11896 1.27845 5.78211 1.6153C5.44526 1.95211 5.23619 2.41642 5.23619 2.92689V4.19139H4.5268ZM12.0254 9.05479C9.93077 9.05479 8.23273 10.7528 8.23273 12.8474C8.23273 14.9421 9.93077 16.6401 12.0254 16.6401C14.12 16.6401 15.8181 14.9421 15.8181 12.8474C15.8181 10.7528 14.12 9.05479 12.0254 9.05479ZM10.1715 13.072L11.3062 14.114C11.4652 14.2603 11.7113 14.2526 11.8608 14.0984L13.8855 12.1598C14.0437 12.0077 14.0486 11.7561 13.8964 11.598C13.7443 11.4398 13.4927 11.435 13.3346 11.5871L11.57 13.2766L10.7101 12.4868C10.5485 12.3381 10.2969 12.3486 10.1482 12.5101C9.99947 12.6717 10.0099 12.9233 10.1715 13.072Z" fill="black" />
                                </g>
                            </svg>
                        </span>
                        <h4>Products</h4>
                    </div>
                </a>
                {{-- </button> --}}
            </h2>
        </div>
    </div>
</li>
@if (auth()->user()->hasRole('Dealer') ||
(isset(auth()->user()->permissions[0]) && auth()->user()->permissions[0]->name !== 'role-view'))
<li class="analyics-tabs-list">
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
                {{-- <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne1" aria-expanded="false"
                                aria-controls="flush-collapseOne"> --}}
                <a href="{{ route('Dealer.partsmanager.index') }}" class="analyics-tabs-btns @if (Route::is('Dealer.partsmanager.*')) active @endif ">
                    <div class="analyics-tabs-name">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                                <g opacity="0.3">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2.45698 4.2498H4.5268V5.37372C4.5268 5.56962 4.68561 5.72843 4.88151 5.72843C5.07741 5.72843 5.23622 5.56962 5.23622 5.37372V4.2498H8.95125V5.37372C8.95125 5.56962 9.11006 5.72843 9.30596 5.72843C9.50186 5.72843 9.66067 5.56962 9.66067 5.37372V4.2498H11.7305C11.9604 4.2498 12.1509 4.42362 12.172 4.65259L12.5056 8.28285C12.3478 8.26645 12.1876 8.25791 12.0254 8.25791C9.4907 8.25791 7.43589 10.3127 7.43589 12.8474C7.43589 13.4709 7.56044 14.0651 7.78559 14.607H2.05227C1.79923 14.607 1.58138 14.5109 1.41085 14.324C1.24029 14.137 1.16452 13.9113 1.18766 13.6593L2.01548 4.65259C2.03653 4.42362 2.22702 4.2498 2.45698 4.2498ZM4.5268 4.19139V2.92689C4.5268 2.22062 4.81547 1.57881 5.28054 1.11373C5.74562 0.648653 6.38744 0.359985 7.0937 0.359985C7.79996 0.359985 8.44178 0.648653 8.90686 1.11373C9.37193 1.57881 9.6606 2.22066 9.6606 2.92689V4.19139H8.95122V2.92689C8.95122 2.41645 8.74214 1.95211 8.40529 1.6153C8.06844 1.27845 7.60417 1.06937 7.0937 1.06937C6.58327 1.06937 6.11896 1.27845 5.78211 1.6153C5.44526 1.95211 5.23619 2.41642 5.23619 2.92689V4.19139H4.5268ZM12.0254 9.05479C9.93077 9.05479 8.23273 10.7528 8.23273 12.8474C8.23273 14.9421 9.93077 16.6401 12.0254 16.6401C14.12 16.6401 15.8181 14.9421 15.8181 12.8474C15.8181 10.7528 14.12 9.05479 12.0254 9.05479ZM10.1715 13.072L11.3062 14.114C11.4652 14.2603 11.7113 14.2526 11.8608 14.0984L13.8855 12.1598C14.0437 12.0077 14.0486 11.7561 13.8964 11.598C13.7443 11.4398 13.4927 11.435 13.3346 11.5871L11.57 13.2766L10.7101 12.4868C10.5485 12.3381 10.2969 12.3486 10.1482 12.5101C9.99947 12.6717 10.0099 12.9233 10.1715 13.072Z" fill="black" />
                                </g>
                            </svg>
                        </span>
                        <h4>Parts manager</h4>
                    </div>
                </a>
                {{-- </button> --}}
            </h2>
        </div>
    </div>
</li>
@endif
{{-- <li class="analyics-tabs-list">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <a href="{{ route('Dealer.address.view') }}"
class="analyics-tabs-btns @if (Route::is('Dealer.address.*')) active @endif ">
<div class="analyics-tabs-name">
    <span>
        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
            <g opacity="0.3">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M2.45698 4.2498H4.5268V5.37372C4.5268 5.56962 4.68561 5.72843 4.88151 5.72843C5.07741 5.72843 5.23622 5.56962 5.23622 5.37372V4.2498H8.95125V5.37372C8.95125 5.56962 9.11006 5.72843 9.30596 5.72843C9.50186 5.72843 9.66067 5.56962 9.66067 5.37372V4.2498H11.7305C11.9604 4.2498 12.1509 4.42362 12.172 4.65259L12.5056 8.28285C12.3478 8.26645 12.1876 8.25791 12.0254 8.25791C9.4907 8.25791 7.43589 10.3127 7.43589 12.8474C7.43589 13.4709 7.56044 14.0651 7.78559 14.607H2.05227C1.79923 14.607 1.58138 14.5109 1.41085 14.324C1.24029 14.137 1.16452 13.9113 1.18766 13.6593L2.01548 4.65259C2.03653 4.42362 2.22702 4.2498 2.45698 4.2498ZM4.5268 4.19139V2.92689C4.5268 2.22062 4.81547 1.57881 5.28054 1.11373C5.74562 0.648653 6.38744 0.359985 7.0937 0.359985C7.79996 0.359985 8.44178 0.648653 8.90686 1.11373C9.37193 1.57881 9.6606 2.22066 9.6606 2.92689V4.19139H8.95122V2.92689C8.95122 2.41645 8.74214 1.95211 8.40529 1.6153C8.06844 1.27845 7.60417 1.06937 7.0937 1.06937C6.58327 1.06937 6.11896 1.27845 5.78211 1.6153C5.44526 1.95211 5.23619 2.41642 5.23619 2.92689V4.19139H4.5268ZM12.0254 9.05479C9.93077 9.05479 8.23273 10.7528 8.23273 12.8474C8.23273 14.9421 9.93077 16.6401 12.0254 16.6401C14.12 16.6401 15.8181 14.9421 15.8181 12.8474C15.8181 10.7528 14.12 9.05479 12.0254 9.05479ZM10.1715 13.072L11.3062 14.114C11.4652 14.2603 11.7113 14.2526 11.8608 14.0984L13.8855 12.1598C14.0437 12.0077 14.0486 11.7561 13.8964 11.598C13.7443 11.4398 13.4927 11.435 13.3346 11.5871L11.57 13.2766L10.7101 12.4868C10.5485 12.3381 10.2969 12.3486 10.1482 12.5101C9.99947 12.6717 10.0099 12.9233 10.1715 13.072Z" fill="black" />
            </g>
        </svg>
    </span>
    <h4>Picking Address</h4>
</div>
</a>
</h2>
</div>
</div>
</li> --}}
<li class="analyics-tabs-list">
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
                {{-- <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne1" aria-expanded="false"
                                aria-controls="flush-collapseOne"> --}}
                <a href="{{ route('Dealer.myorder.orderlist') }}" class="analyics-tabs-btns @if (Route::is('Dealer.myorder.*')) active @endif ">
                    <div class="analyics-tabs-name">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                                <g opacity="0.3">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2.45698 4.2498H4.5268V5.37372C4.5268 5.56962 4.68561 5.72843 4.88151 5.72843C5.07741 5.72843 5.23622 5.56962 5.23622 5.37372V4.2498H8.95125V5.37372C8.95125 5.56962 9.11006 5.72843 9.30596 5.72843C9.50186 5.72843 9.66067 5.56962 9.66067 5.37372V4.2498H11.7305C11.9604 4.2498 12.1509 4.42362 12.172 4.65259L12.5056 8.28285C12.3478 8.26645 12.1876 8.25791 12.0254 8.25791C9.4907 8.25791 7.43589 10.3127 7.43589 12.8474C7.43589 13.4709 7.56044 14.0651 7.78559 14.607H2.05227C1.79923 14.607 1.58138 14.5109 1.41085 14.324C1.24029 14.137 1.16452 13.9113 1.18766 13.6593L2.01548 4.65259C2.03653 4.42362 2.22702 4.2498 2.45698 4.2498ZM4.5268 4.19139V2.92689C4.5268 2.22062 4.81547 1.57881 5.28054 1.11373C5.74562 0.648653 6.38744 0.359985 7.0937 0.359985C7.79996 0.359985 8.44178 0.648653 8.90686 1.11373C9.37193 1.57881 9.6606 2.22066 9.6606 2.92689V4.19139H8.95122V2.92689C8.95122 2.41645 8.74214 1.95211 8.40529 1.6153C8.06844 1.27845 7.60417 1.06937 7.0937 1.06937C6.58327 1.06937 6.11896 1.27845 5.78211 1.6153C5.44526 1.95211 5.23619 2.41642 5.23619 2.92689V4.19139H4.5268ZM12.0254 9.05479C9.93077 9.05479 8.23273 10.7528 8.23273 12.8474C8.23273 14.9421 9.93077 16.6401 12.0254 16.6401C14.12 16.6401 15.8181 14.9421 15.8181 12.8474C15.8181 10.7528 14.12 9.05479 12.0254 9.05479ZM10.1715 13.072L11.3062 14.114C11.4652 14.2603 11.7113 14.2526 11.8608 14.0984L13.8855 12.1598C14.0437 12.0077 14.0486 11.7561 13.8964 11.598C13.7443 11.4398 13.4927 11.435 13.3346 11.5871L11.57 13.2766L10.7101 12.4868C10.5485 12.3381 10.2969 12.3486 10.1482 12.5101C9.99947 12.6717 10.0099 12.9233 10.1715 13.072Z" fill="black" />
                                </g>
                            </svg>
                        </span>
                        <h4>My orders</h4>
                    </div>
                </a>
                {{-- </button> --}}
            </h2>
        </div>
    </div>
</li>
<li class="analyics-tabs-list">
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
                {{-- <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne1" aria-expanded="false"
                                aria-controls="flush-collapseOne"> --}}
                <a href="{{ route('Dealer.order.orderlist') }}" class="analyics-tabs-btns @if (Route::is('Dealer.order.*')) active @endif ">
                    <div class="analyics-tabs-name">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                                <g opacity="0.3">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2.45698 4.2498H4.5268V5.37372C4.5268 5.56962 4.68561 5.72843 4.88151 5.72843C5.07741 5.72843 5.23622 5.56962 5.23622 5.37372V4.2498H8.95125V5.37372C8.95125 5.56962 9.11006 5.72843 9.30596 5.72843C9.50186 5.72843 9.66067 5.56962 9.66067 5.37372V4.2498H11.7305C11.9604 4.2498 12.1509 4.42362 12.172 4.65259L12.5056 8.28285C12.3478 8.26645 12.1876 8.25791 12.0254 8.25791C9.4907 8.25791 7.43589 10.3127 7.43589 12.8474C7.43589 13.4709 7.56044 14.0651 7.78559 14.607H2.05227C1.79923 14.607 1.58138 14.5109 1.41085 14.324C1.24029 14.137 1.16452 13.9113 1.18766 13.6593L2.01548 4.65259C2.03653 4.42362 2.22702 4.2498 2.45698 4.2498ZM4.5268 4.19139V2.92689C4.5268 2.22062 4.81547 1.57881 5.28054 1.11373C5.74562 0.648653 6.38744 0.359985 7.0937 0.359985C7.79996 0.359985 8.44178 0.648653 8.90686 1.11373C9.37193 1.57881 9.6606 2.22066 9.6606 2.92689V4.19139H8.95122V2.92689C8.95122 2.41645 8.74214 1.95211 8.40529 1.6153C8.06844 1.27845 7.60417 1.06937 7.0937 1.06937C6.58327 1.06937 6.11896 1.27845 5.78211 1.6153C5.44526 1.95211 5.23619 2.41642 5.23619 2.92689V4.19139H4.5268ZM12.0254 9.05479C9.93077 9.05479 8.23273 10.7528 8.23273 12.8474C8.23273 14.9421 9.93077 16.6401 12.0254 16.6401C14.12 16.6401 15.8181 14.9421 15.8181 12.8474C15.8181 10.7528 14.12 9.05479 12.0254 9.05479ZM10.1715 13.072L11.3062 14.114C11.4652 14.2603 11.7113 14.2526 11.8608 14.0984L13.8855 12.1598C14.0437 12.0077 14.0486 11.7561 13.8964 11.598C13.7443 11.4398 13.4927 11.435 13.3346 11.5871L11.57 13.2766L10.7101 12.4868C10.5485 12.3381 10.2969 12.3486 10.1482 12.5101C9.99947 12.6717 10.0099 12.9233 10.1715 13.072Z" fill="black" />
                                </g>
                            </svg>
                        </span>
                        <h4>Order management</h4>
                    </div>
                </a>
                {{-- </button> --}}
            </h2>
        </div>
    </div>
</li>
<!-- <li class="analyics-tabs-list">
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
                {{-- <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne1" aria-expanded="false"
                                aria-controls="flush-collapseOne"> --}}
                <a href="{{ route('welcome.index') }}" class="analyics-tabs-btns @if (Route::is('welcome.index')) active @endif ">
                    <div class="analyics-tabs-name">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                                <g opacity="0.3">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2.45698 4.2498H4.5268V5.37372C4.5268 5.56962 4.68561 5.72843 4.88151 5.72843C5.07741 5.72843 5.23622 5.56962 5.23622 5.37372V4.2498H8.95125V5.37372C8.95125 5.56962 9.11006 5.72843 9.30596 5.72843C9.50186 5.72843 9.66067 5.56962 9.66067 5.37372V4.2498H11.7305C11.9604 4.2498 12.1509 4.42362 12.172 4.65259L12.5056 8.28285C12.3478 8.26645 12.1876 8.25791 12.0254 8.25791C9.4907 8.25791 7.43589 10.3127 7.43589 12.8474C7.43589 13.4709 7.56044 14.0651 7.78559 14.607H2.05227C1.79923 14.607 1.58138 14.5109 1.41085 14.324C1.24029 14.137 1.16452 13.9113 1.18766 13.6593L2.01548 4.65259C2.03653 4.42362 2.22702 4.2498 2.45698 4.2498ZM4.5268 4.19139V2.92689C4.5268 2.22062 4.81547 1.57881 5.28054 1.11373C5.74562 0.648653 6.38744 0.359985 7.0937 0.359985C7.79996 0.359985 8.44178 0.648653 8.90686 1.11373C9.37193 1.57881 9.6606 2.22066 9.6606 2.92689V4.19139H8.95122V2.92689C8.95122 2.41645 8.74214 1.95211 8.40529 1.6153C8.06844 1.27845 7.60417 1.06937 7.0937 1.06937C6.58327 1.06937 6.11896 1.27845 5.78211 1.6153C5.44526 1.95211 5.23619 2.41642 5.23619 2.92689V4.19139H4.5268ZM12.0254 9.05479C9.93077 9.05479 8.23273 10.7528 8.23273 12.8474C8.23273 14.9421 9.93077 16.6401 12.0254 16.6401C14.12 16.6401 15.8181 14.9421 15.8181 12.8474C15.8181 10.7528 14.12 9.05479 12.0254 9.05479ZM10.1715 13.072L11.3062 14.114C11.4652 14.2603 11.7113 14.2526 11.8608 14.0984L13.8855 12.1598C14.0437 12.0077 14.0486 11.7561 13.8964 11.598C13.7443 11.4398 13.4927 11.435 13.3346 11.5871L11.57 13.2766L10.7101 12.4868C10.5485 12.3381 10.2969 12.3486 10.1482 12.5101C9.99947 12.6717 10.0099 12.9233 10.1715 13.072Z" fill="black" />
                                </g>
                            </svg>
                        </span>
                        <h4>Shop</h4>
                    </div>
                </a>
                {{-- </button> --}}
            </h2>
        </div>
    </div>
</li> -->
</ul>
</div>
</div>