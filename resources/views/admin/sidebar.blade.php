    <div class="dashboard-left-box">
        {{-- <h2>Analytics</h2> --}}
        <div class="analyics-tabs">
            <ul>
                <li class="analyics-tabs-list">

                    {{-- <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne1" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    <a href="{{ route('admin.dashboard') }}"
                                        class="analyics-tabs-btns @if (Route::is('admin.dashboard')) active @endif ">
                                        <div class="analyics-tabs-name">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                    viewBox="0 0 17 17" fill="none">
                                                    <g opacity="0.3">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M2.45698 4.2498H4.5268V5.37372C4.5268 5.56962 4.68561 5.72843 4.88151 5.72843C5.07741 5.72843 5.23622 5.56962 5.23622 5.37372V4.2498H8.95125V5.37372C8.95125 5.56962 9.11006 5.72843 9.30596 5.72843C9.50186 5.72843 9.66067 5.56962 9.66067 5.37372V4.2498H11.7305C11.9604 4.2498 12.1509 4.42362 12.172 4.65259L12.5056 8.28285C12.3478 8.26645 12.1876 8.25791 12.0254 8.25791C9.4907 8.25791 7.43589 10.3127 7.43589 12.8474C7.43589 13.4709 7.56044 14.0651 7.78559 14.607H2.05227C1.79923 14.607 1.58138 14.5109 1.41085 14.324C1.24029 14.137 1.16452 13.9113 1.18766 13.6593L2.01548 4.65259C2.03653 4.42362 2.22702 4.2498 2.45698 4.2498ZM4.5268 4.19139V2.92689C4.5268 2.22062 4.81547 1.57881 5.28054 1.11373C5.74562 0.648653 6.38744 0.359985 7.0937 0.359985C7.79996 0.359985 8.44178 0.648653 8.90686 1.11373C9.37193 1.57881 9.6606 2.22066 9.6606 2.92689V4.19139H8.95122V2.92689C8.95122 2.41645 8.74214 1.95211 8.40529 1.6153C8.06844 1.27845 7.60417 1.06937 7.0937 1.06937C6.58327 1.06937 6.11896 1.27845 5.78211 1.6153C5.44526 1.95211 5.23619 2.41642 5.23619 2.92689V4.19139H4.5268ZM12.0254 9.05479C9.93077 9.05479 8.23273 10.7528 8.23273 12.8474C8.23273 14.9421 9.93077 16.6401 12.0254 16.6401C14.12 16.6401 15.8181 14.9421 15.8181 12.8474C15.8181 10.7528 14.12 9.05479 12.0254 9.05479ZM10.1715 13.072L11.3062 14.114C11.4652 14.2603 11.7113 14.2526 11.8608 14.0984L13.8855 12.1598C14.0437 12.0077 14.0486 11.7561 13.8964 11.598C13.7443 11.4398 13.4927 11.435 13.3346 11.5871L11.57 13.2766L10.7101 12.4868C10.5485 12.3381 10.2969 12.3486 10.1482 12.5101C9.99947 12.6717 10.0099 12.9233 10.1715 13.072Z"
                                                            fill="black" />
                                                    </g>
                                                </svg>
                                            </span>

                                            <h4>Dashboard</h4>

                                        </div>
                                    </a>
                                </button>
                            </h2>
                        </div>
                    </div> --}}
                </li>
                <li class="analyics-tabs-list">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    <a href="{{ route('admin.category.index') }}"
                                        class="analyics-tabs-btns @if (Route::is('admin.category.*')) active @endif">
                                        <div class="analyics-tabs-name">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    opacity="0.3" viewBox="0 0 18 18" fill="none">
                                                    <path
                                                        d="M13.2509 8.50165L9.17383 9.86068L13.2509 11.2197L17.328 9.86068L13.2509 8.50165Z"
                                                        fill="#231F20" />
                                                    <path
                                                        d="M0 9.86068L4.07709 11.2197L8.15419 9.86068L4.07709 8.50165L0 9.86068Z"
                                                        fill="#231F20" />
                                                    <path
                                                        d="M8.82418 0.0338348C8.71957 -0.00102436 8.60646 -0.00102436 8.50185 0.0338348L4.58594 1.33915L8.66303 2.69818L12.7401 1.33915L8.82418 0.0338348Z"
                                                        fill="#231F20" />
                                                    <path
                                                        d="M4.58594 17.4033L8.15339 16.2141V10.9351L4.58594 12.1242V17.4033Z"
                                                        fill="#231F20" />
                                                    <path
                                                        d="M0 15.8468C0 16.0662 0.140354 16.2609 0.34849 16.3303L3.56746 17.4033V12.1242L0 10.9351V15.8468Z"
                                                        fill="#231F20" />
                                                    <path
                                                        d="M9.17383 16.2141L12.7413 17.4033V12.1242L9.17383 10.9351V16.2141Z"
                                                        fill="#231F20" />
                                                    <path
                                                        d="M13.7617 17.4033L16.9807 16.3303C17.1888 16.2609 17.3292 16.0661 17.3292 15.8468V10.9351L13.7617 12.1242V17.4033Z"
                                                        fill="#231F20" />
                                                    <path
                                                        d="M4.58594 7.78811L8.15339 8.97726V3.6027L4.58594 2.41351V7.78811Z"
                                                        fill="#231F20" />
                                                    <path
                                                        d="M12.7413 7.78811V2.41351L9.17383 3.6027V8.97726L12.7413 7.78811Z"
                                                        fill="#231F20" />
                                                </svg>
                                            </span>
                                            <h4>Category</h4>
                                        </div>
                                        {{-- <p class="analyics-tabs-num">100</p> --}}
                                    </a>
                                </button>
                            </h2>
                            {{-- <div id="flush-collapseOne"
                                class="accordion-collapse collapse  @if (Route::is('admin.category.*')) show @endif"
                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('admin.category.index') }}">
                                                <p>Categories</p>
                                            </a></li>
                                        <li><a href="{{ route('admin.category.add') }}">
                                                <p>Add Category</p>
                                            </a></li>
                                    </ul>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </li>
                <li class="analyics-tabs-list">

                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne1" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    <a href="{{ route('admin.dealers.all') }}"
                                        class="analyics-tabs-btns @if (Route::is('admin.dealers.*')) active @endif ">
                                        <div class="analyics-tabs-name">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                    viewBox="0 0 17 17" fill="none">
                                                    <g opacity="0.3">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M2.45698 4.2498H4.5268V5.37372C4.5268 5.56962 4.68561 5.72843 4.88151 5.72843C5.07741 5.72843 5.23622 5.56962 5.23622 5.37372V4.2498H8.95125V5.37372C8.95125 5.56962 9.11006 5.72843 9.30596 5.72843C9.50186 5.72843 9.66067 5.56962 9.66067 5.37372V4.2498H11.7305C11.9604 4.2498 12.1509 4.42362 12.172 4.65259L12.5056 8.28285C12.3478 8.26645 12.1876 8.25791 12.0254 8.25791C9.4907 8.25791 7.43589 10.3127 7.43589 12.8474C7.43589 13.4709 7.56044 14.0651 7.78559 14.607H2.05227C1.79923 14.607 1.58138 14.5109 1.41085 14.324C1.24029 14.137 1.16452 13.9113 1.18766 13.6593L2.01548 4.65259C2.03653 4.42362 2.22702 4.2498 2.45698 4.2498ZM4.5268 4.19139V2.92689C4.5268 2.22062 4.81547 1.57881 5.28054 1.11373C5.74562 0.648653 6.38744 0.359985 7.0937 0.359985C7.79996 0.359985 8.44178 0.648653 8.90686 1.11373C9.37193 1.57881 9.6606 2.22066 9.6606 2.92689V4.19139H8.95122V2.92689C8.95122 2.41645 8.74214 1.95211 8.40529 1.6153C8.06844 1.27845 7.60417 1.06937 7.0937 1.06937C6.58327 1.06937 6.11896 1.27845 5.78211 1.6153C5.44526 1.95211 5.23619 2.41642 5.23619 2.92689V4.19139H4.5268ZM12.0254 9.05479C9.93077 9.05479 8.23273 10.7528 8.23273 12.8474C8.23273 14.9421 9.93077 16.6401 12.0254 16.6401C14.12 16.6401 15.8181 14.9421 15.8181 12.8474C15.8181 10.7528 14.12 9.05479 12.0254 9.05479ZM10.1715 13.072L11.3062 14.114C11.4652 14.2603 11.7113 14.2526 11.8608 14.0984L13.8855 12.1598C14.0437 12.0077 14.0486 11.7561 13.8964 11.598C13.7443 11.4398 13.4927 11.435 13.3346 11.5871L11.57 13.2766L10.7101 12.4868C10.5485 12.3381 10.2969 12.3486 10.1482 12.5101C9.99947 12.6717 10.0099 12.9233 10.1715 13.072Z"
                                                            fill="black" />
                                                    </g>
                                                </svg>
                                            </span>

                                            <h4>Dealers</h4>
                                        </div>
                                        {{-- <p class="analyics-tabs-num">200</p> --}}
                                    </a>
                                </button>
                            </h2>
                            {{-- <div id="flush-collapseOne1" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <ul class="sub-menu">
                                        <li><a href="#">
                                                <p>action</p>
                                            </a></li>
                                        <li><a href="#">
                                                <p>another action</p>
                                            </a></li>
                                    </ul>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </li>
                <li class="analyics-tabs-list">

                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne1" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    <a href="{{ route('admin.products.list') }}"
                                        class="analyics-tabs-btns @if (Route::is('admin.products.*')) active @endif ">
                                        <div class="analyics-tabs-name">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                    viewBox="0 0 17 17" fill="none">
                                                    <g opacity="0.3">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M2.45698 4.2498H4.5268V5.37372C4.5268 5.56962 4.68561 5.72843 4.88151 5.72843C5.07741 5.72843 5.23622 5.56962 5.23622 5.37372V4.2498H8.95125V5.37372C8.95125 5.56962 9.11006 5.72843 9.30596 5.72843C9.50186 5.72843 9.66067 5.56962 9.66067 5.37372V4.2498H11.7305C11.9604 4.2498 12.1509 4.42362 12.172 4.65259L12.5056 8.28285C12.3478 8.26645 12.1876 8.25791 12.0254 8.25791C9.4907 8.25791 7.43589 10.3127 7.43589 12.8474C7.43589 13.4709 7.56044 14.0651 7.78559 14.607H2.05227C1.79923 14.607 1.58138 14.5109 1.41085 14.324C1.24029 14.137 1.16452 13.9113 1.18766 13.6593L2.01548 4.65259C2.03653 4.42362 2.22702 4.2498 2.45698 4.2498ZM4.5268 4.19139V2.92689C4.5268 2.22062 4.81547 1.57881 5.28054 1.11373C5.74562 0.648653 6.38744 0.359985 7.0937 0.359985C7.79996 0.359985 8.44178 0.648653 8.90686 1.11373C9.37193 1.57881 9.6606 2.22066 9.6606 2.92689V4.19139H8.95122V2.92689C8.95122 2.41645 8.74214 1.95211 8.40529 1.6153C8.06844 1.27845 7.60417 1.06937 7.0937 1.06937C6.58327 1.06937 6.11896 1.27845 5.78211 1.6153C5.44526 1.95211 5.23619 2.41642 5.23619 2.92689V4.19139H4.5268ZM12.0254 9.05479C9.93077 9.05479 8.23273 10.7528 8.23273 12.8474C8.23273 14.9421 9.93077 16.6401 12.0254 16.6401C14.12 16.6401 15.8181 14.9421 15.8181 12.8474C15.8181 10.7528 14.12 9.05479 12.0254 9.05479ZM10.1715 13.072L11.3062 14.114C11.4652 14.2603 11.7113 14.2526 11.8608 14.0984L13.8855 12.1598C14.0437 12.0077 14.0486 11.7561 13.8964 11.598C13.7443 11.4398 13.4927 11.435 13.3346 11.5871L11.57 13.2766L10.7101 12.4868C10.5485 12.3381 10.2969 12.3486 10.1482 12.5101C9.99947 12.6717 10.0099 12.9233 10.1715 13.072Z"
                                                            fill="black" />
                                                    </g>
                                                </svg>
                                            </span>

                                            <h4>Products</h4>
                                        </div>
                                        {{-- <p class="analyics-tabs-num">200</p> --}}
                                    </a>
                                </button>
                            </h2>
                            {{-- <div id="flush-collapseOne1" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <ul class="sub-menu">
                                        <li><a href="#">
                                                <p>action</p>
                                            </a></li>
                                        <li><a href="#">
                                                <p>another action</p>
                                            </a></li>
                                    </ul>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </li>
                <li class="analyics-tabs-list">

                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne2" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    <a href="{{ route('admin.cms.index') }}"
                                        class="analyics-tabs-btns @if (Route::is('admin.cms.*')) active @endif ">
                                        <div class="analyics-tabs-name">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                    viewBox="0 0 17 17" fill="none">
                                                    <g opacity="0.3" clip-path="url(#clip0_234_82)">
                                                        <path
                                                            d="M11.9531 7.70312C9.61031 7.70312 7.70312 9.61031 7.70312 11.9531C7.93751 17.5912 15.9696 17.5895 16.2031 11.9531C16.2031 9.61031 14.2959 7.70312 11.9531 7.70312ZM14.3039 10.2345L11.985 13.9533C11.9015 14.0964 11.6932 14.1195 11.5759 14.0038L9.64484 12.1444C9.39526 11.9033 9.76164 11.5226 10.0114 11.7619L11.7088 13.3928L13.8524 9.95297C14.0369 9.65937 14.4866 9.93738 14.3039 10.2345Z"
                                                            fill="#231F20" />
                                                        <path
                                                            d="M7.17188 11.9531C7.10998 8.47455 10.9995 6.06294 14.0781 7.67391V2.125C14.0781 1.39188 13.4831 0.796875 12.75 0.796875H9.29688C9.2969 0.91962 9.29685 5.02977 9.29688 5.3125C9.30543 5.52999 9.0248 5.66209 8.86125 5.517L7.4375 4.32969L6.01375 5.51703C5.84973 5.66294 5.56992 5.52994 5.57812 5.3125C5.57797 5.02092 5.57823 0.928917 5.57812 0.796875H2.125C1.39188 0.796875 0.796875 1.39188 0.796875 2.125V12.75C0.796875 13.4831 1.39188 14.0781 2.125 14.0781H7.67391C7.34068 13.4209 7.17456 12.7105 7.17188 11.9531ZM5.3125 11.6875C5.3125 12.1258 4.95391 12.4844 4.51562 12.4844H3.1875C2.74922 12.4844 2.39062 12.1258 2.39062 11.6875V10.3594C2.39062 9.92109 2.74922 9.5625 3.1875 9.5625H4.51562C4.95391 9.5625 5.3125 9.92109 5.3125 10.3594V11.6875Z"
                                                            fill="#231F20" />
                                                        <path
                                                            d="M7.4375 3.71875C7.49859 3.71875 7.55703 3.74 7.6075 3.77984L8.76562 4.74672C8.76562 4.39562 8.76562 1.03716 8.76562 0.796875H6.10938V4.74672L7.2675 3.77984C7.31797 3.74 7.37641 3.71875 7.4375 3.71875Z"
                                                            fill="#231F20" />
                                                        <path
                                                            d="M4.51562 10.0938H3.1875C3.04141 10.0938 2.92188 10.2133 2.92188 10.3594V11.6875C2.92188 11.8336 3.04141 11.9531 3.1875 11.9531H4.51562C4.66172 11.9531 4.78125 11.8336 4.78125 11.6875V10.3594C4.78125 10.2133 4.66172 10.0938 4.51562 10.0938Z"
                                                            fill="#231F20" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_234_82">
                                                            <rect width="17" height="17" fill="white" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </span>
                                            <h4>CMS</h4>
                                        </div>
                                        {{-- <p class="analyics-tabs-num">60</p> --}}
                                    </a>
                                </button>
                            </h2>
                            {{-- <div id="flush-collapseOne2" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <ul class="sub-menu">
                                        <li><a href="#">
                                                <p>action</p>
                                            </a></li>
                                        <li><a href="#">
                                                <p>another action</p>
                                            </a></li>
                                    </ul>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </li>
                <li class="analyics-tabs-list">

                    {{-- <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne3" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    <a href="{{ route('admin.settings.view') }}"
                                        class="analyics-tabs-btns @if (Route::is('admin.settings.*')) active @endif ">
                                        <div class="analyics-tabs-name">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                    viewBox="0 0 17 17" fill="none">
                                                    <g opacity="0.3" clip-path="url(#clip0_234_89)">
                                                        <path d="M13.6465 0.291565V3.32029H16.675L13.6465 0.291565Z"
                                                            fill="black" />
                                                        <path
                                                            d="M13.1484 4.31641C12.8734 4.31641 12.6504 4.09341 12.6504 3.81836V0H5.51172C4.68785 0 4.01758 0.670272 4.01758 1.49414V7.06194C4.18167 7.04706 4.34772 7.03906 4.51562 7.03906C6.21323 7.03906 7.73291 7.81522 8.7386 9.03125H14.1445C14.4196 9.03125 14.6426 9.25424 14.6426 9.5293C14.6426 9.80435 14.4196 10.0273 14.1445 10.0273H9.39476C9.70607 10.6348 9.90682 11.3078 9.97126 12.0195H14.1445C14.4196 12.0195 14.6426 12.2425 14.6426 12.5176C14.6426 12.7926 14.4196 13.0156 14.1445 13.0156H9.97126C9.82231 14.6605 8.94349 16.0977 7.66189 17H15.4727C16.2965 17 16.9668 16.3297 16.9668 15.5059V4.31641H13.1484ZM14.1445 7.03906H6.83984C6.56479 7.03906 6.3418 6.81607 6.3418 6.54102C6.3418 6.26596 6.56479 6.04297 6.83984 6.04297H14.1445C14.4196 6.04297 14.6426 6.26596 14.6426 6.54102C14.6426 6.81607 14.4196 7.03906 14.1445 7.03906Z"
                                                            fill="black" />
                                                        <path
                                                            d="M4.51562 8.03516C2.04402 8.03516 0.0332031 10.046 0.0332031 12.5176C0.0332031 14.9892 2.04402 17 4.51562 17C6.98723 17 8.99805 14.9892 8.99805 12.5176C8.99805 10.046 6.98723 8.03516 4.51562 8.03516ZM5.84375 13.0156H4.51562C4.24057 13.0156 4.01758 12.7926 4.01758 12.5176V10.5254C4.01758 10.2503 4.24057 10.0273 4.51562 10.0273C4.79068 10.0273 5.01367 10.2503 5.01367 10.5254V12.0195H5.84375C6.1188 12.0195 6.3418 12.2425 6.3418 12.5176C6.3418 12.7926 6.1188 13.0156 5.84375 13.0156Z"
                                                            fill="black" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_234_89">
                                                            <rect width="17" height="17" fill="white" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </span>
                                            <h4>Stripe Setting</h4>
                                        </div>
                                        <p class="analyics-tabs-num"></p>
                                    </a>
                                </button>
                            </h2>
                        </div>
                    </div> --}}
                </li>
                <li class="analyics-tabs-list">

                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne4" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    <a href="{{ route('admin.commission') }}"
                                        class="analyics-tabs-btns @if (Route::is('admin.commission')) active @endif ">
                                        <div class="analyics-tabs-name">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                    viewBox="0 0 17 17" fill="none">
                                                    <g opacity="0.3" clip-path="url(#clip0_234_93)">
                                                        <path
                                                            d="M12.3104 8.14587C10.1153 8.14587 8.32813 9.933 8.32813 12.1282C8.32812 14.3233 10.1153 16.1105 12.3104 16.1105C14.5056 16.1105 16.2927 14.3233 16.2927 12.1282C16.2927 9.933 14.5056 8.14587 12.3104 8.14587ZM11.3033 10.6202L12.3104 11.6274L13.3176 10.6202C13.4726 10.4666 13.6661 10.4679 13.8184 10.6202C13.9567 10.7585 13.9567 10.9827 13.8184 11.121L12.8112 12.1282L13.8184 13.1353C13.9567 13.2736 13.9567 13.4978 13.8184 13.6361C13.6801 13.7744 13.4559 13.7744 13.3176 13.6361L12.3104 12.629L11.3033 13.6361C11.165 13.7744 10.9408 13.7744 10.8024 13.6361C10.6642 13.4978 10.6642 13.2736 10.8024 13.1353L11.8096 12.1282L10.8024 11.121C10.6642 10.9827 10.6642 10.7585 10.8024 10.6202C10.9441 10.4776 11.1688 10.4858 11.3033 10.6202Z"
                                                            fill="black" />
                                                        <path
                                                            d="M1.42908 0.889587C1.03615 0.889587 0.708984 1.21682 0.708984 1.60968V2.94956C0.708984 3.34244 1.03615 3.66966 1.42908 3.66966H5.39547V0.889587H1.42908ZM6.1038 0.889587V6.10665L7.0411 5.17004C7.17941 5.03179 7.4036 5.03179 7.54191 5.17004L8.50411 6.13155V0.889602L6.1038 0.889587ZM9.21244 0.889587V3.66966H13.1415C13.5344 3.66966 13.8623 3.34244 13.8623 2.94956V1.60968C13.8623 1.21682 13.5344 0.889587 13.1415 0.889587H9.21244ZM1.3018 4.31089V11.7816C1.3018 12.5224 1.93977 12.8455 2.52755 12.8455H7.67196C7.63551 12.6109 7.61108 12.3726 7.61108 12.1282C7.61108 9.54416 9.72607 7.42922 12.31 7.42922C12.6387 7.42922 12.9593 7.46446 13.2695 7.52952V4.31089C11.8791 4.33462 10.419 4.32715 9.21244 4.32191V6.98651C9.21232 7.30195 8.83099 7.45989 8.60787 7.23692L7.2915 5.92124L6.00004 7.21202C5.77692 7.43499 5.39559 7.27704 5.39547 6.96161V4.3273C3.95795 4.32588 2.54623 4.32481 1.3018 4.31089Z"
                                                            fill="black" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_234_93">
                                                            <rect width="17" height="17" fill="white" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </span>
                                            <h4>Commission</h4>
                                        </div>
                                        <p class="analyics-tabs-num"></p>
                                    </a>
                                </button>
                            </h2>

                        </div>
                    </div>
                </li>
                <li class="analyics-tabs-list">

                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne4" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    <a href="{{ route('admin.shipping.view') }}"
                                        class="analyics-tabs-btns @if (Route::is('admin.shipping.*')) active @endif ">
                                        <div class="analyics-tabs-name">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                    viewBox="0 0 17 17" fill="none">
                                                    <g opacity="0.3" clip-path="url(#clip0_234_93)">
                                                        <path
                                                            d="M12.3104 8.14587C10.1153 8.14587 8.32813 9.933 8.32813 12.1282C8.32812 14.3233 10.1153 16.1105 12.3104 16.1105C14.5056 16.1105 16.2927 14.3233 16.2927 12.1282C16.2927 9.933 14.5056 8.14587 12.3104 8.14587ZM11.3033 10.6202L12.3104 11.6274L13.3176 10.6202C13.4726 10.4666 13.6661 10.4679 13.8184 10.6202C13.9567 10.7585 13.9567 10.9827 13.8184 11.121L12.8112 12.1282L13.8184 13.1353C13.9567 13.2736 13.9567 13.4978 13.8184 13.6361C13.6801 13.7744 13.4559 13.7744 13.3176 13.6361L12.3104 12.629L11.3033 13.6361C11.165 13.7744 10.9408 13.7744 10.8024 13.6361C10.6642 13.4978 10.6642 13.2736 10.8024 13.1353L11.8096 12.1282L10.8024 11.121C10.6642 10.9827 10.6642 10.7585 10.8024 10.6202C10.9441 10.4776 11.1688 10.4858 11.3033 10.6202Z"
                                                            fill="black" />
                                                        <path
                                                            d="M1.42908 0.889587C1.03615 0.889587 0.708984 1.21682 0.708984 1.60968V2.94956C0.708984 3.34244 1.03615 3.66966 1.42908 3.66966H5.39547V0.889587H1.42908ZM6.1038 0.889587V6.10665L7.0411 5.17004C7.17941 5.03179 7.4036 5.03179 7.54191 5.17004L8.50411 6.13155V0.889602L6.1038 0.889587ZM9.21244 0.889587V3.66966H13.1415C13.5344 3.66966 13.8623 3.34244 13.8623 2.94956V1.60968C13.8623 1.21682 13.5344 0.889587 13.1415 0.889587H9.21244ZM1.3018 4.31089V11.7816C1.3018 12.5224 1.93977 12.8455 2.52755 12.8455H7.67196C7.63551 12.6109 7.61108 12.3726 7.61108 12.1282C7.61108 9.54416 9.72607 7.42922 12.31 7.42922C12.6387 7.42922 12.9593 7.46446 13.2695 7.52952V4.31089C11.8791 4.33462 10.419 4.32715 9.21244 4.32191V6.98651C9.21232 7.30195 8.83099 7.45989 8.60787 7.23692L7.2915 5.92124L6.00004 7.21202C5.77692 7.43499 5.39559 7.27704 5.39547 6.96161V4.3273C3.95795 4.32588 2.54623 4.32481 1.3018 4.31089Z"
                                                            fill="black" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_234_93">
                                                            <rect width="17" height="17" fill="white" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </span>
                                            <h4>Shipping</h4>
                                        </div>
                                        <p class="analyics-tabs-num"></p>
                                    </a>
                                </button>
                            </h2>

                        </div>
                    </div>
                </li>
                {{-- <li class="analyics-tabs-list">

                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne5" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    <div class="analyics-tabs-btns ">
                                        <div class="analyics-tabs-name">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                    viewBox="0 0 17 17" fill="none">
                                                    <g opacity="0.3" clip-path="url(#clip0_236_102)">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M11.7894 9.43425C10.4694 9.43425 9.3936 8.35768 9.3936 7.03838C9.3936 5.71908 10.4694 4.64331 11.7894 4.64331C13.1087 4.64331 14.1845 5.71908 14.1845 7.03838C14.1845 8.35768 13.1087 9.43425 11.7894 9.43425ZM7.53167 12.4241L7.69507 13.9958H7.26707C7.2188 13.9958 7.17287 13.9749 7.14123 13.9384C7.10957 13.902 7.09527 13.8536 7.10203 13.8058C7.17477 13.3169 7.32187 12.8524 7.53167 12.4241ZM15.8836 13.9958L16.0466 12.4245C16.2563 12.8526 16.4034 13.3171 16.4758 13.8058C16.4825 13.8535 16.4683 13.9018 16.4367 13.9382C16.4051 13.9746 16.3592 13.9955 16.311 13.9955C16.1298 13.9958 15.8836 13.9958 15.8836 13.9958ZM14.5517 10.656H9.0266C9.80433 10.0968 10.7584 9.76758 11.7894 9.76758C12.8201 9.76758 13.774 10.0968 14.5517 10.656ZM7.40123 16.5V15.6369C7.40123 15.5449 7.47587 15.4703 7.5679 15.4703H16.0102C16.1023 15.4703 16.1769 15.5449 16.1769 15.6369V16.5C16.1769 16.592 16.1023 16.6666 16.0102 16.6666H7.5679C7.47587 16.6666 7.40123 16.592 7.40123 16.5ZM4.56623 9.89478C4.56623 9.74761 4.6857 9.62811 4.8329 9.62811C4.98007 9.62811 5.09957 9.74761 5.09957 9.89478V13.5044H6.31507C6.46223 13.5044 6.58173 13.6239 6.58173 13.7711C6.58173 13.9183 6.46223 14.0378 6.31507 14.0378H4.8329C4.6856 14.0378 4.56623 13.9184 4.56623 13.7711V9.89478ZM5.69593 1.05231C6.07843 1.14321 6.44327 1.29435 6.77857 1.50095L7.4822 1.18808L8.311 2.01688L7.9993 2.72055C8.20593 3.05581 8.35703 3.42065 8.44797 3.80435L9.16577 4.08061V5.25298L8.44797 5.52925C8.35703 5.91175 8.20473 6.27658 7.9993 6.61188L8.311 7.31551L7.4822 8.14431L6.77857 7.83261C6.44443 8.03925 6.07843 8.19035 5.69593 8.28128L5.41967 8.99908H4.2473L3.97103 8.28128C3.58733 8.19035 3.2225 8.03805 2.88723 7.83261L2.18357 8.14431L1.35477 7.31551L1.66763 6.61188C1.46103 6.27775 1.3099 5.91175 1.21783 5.52925L0.5 5.25298V4.08061L1.21783 3.80435C1.3099 3.42065 1.46103 3.05581 1.66763 2.72055L1.35477 2.01688L2.18357 1.18808L2.88723 1.50095C3.2225 1.29435 3.58733 1.14321 3.96983 1.05231L4.2473 0.333313H5.41967L5.69593 1.05231ZM4.8329 1.95955C3.3384 1.95955 2.12623 3.17171 2.12623 4.66621C2.12623 6.16068 3.3384 7.37288 4.8329 7.37288C6.32737 7.37288 7.53957 6.16068 7.53957 4.66621C7.53957 3.17171 6.32737 1.95955 4.8329 1.95955ZM4.56623 3.05835C4.56623 2.91115 4.6857 2.79168 4.8329 2.79168C4.98007 2.79168 5.09957 2.91115 5.09957 3.05835V4.51228L6.1305 5.10788C6.25793 5.18148 6.3016 5.34475 6.228 5.47218C6.15437 5.59961 5.99113 5.64331 5.8637 5.56968L4.6995 4.89711C4.617 4.84945 4.56623 4.76145 4.56623 4.66621V3.05835ZM8.3291 14.9369L7.9862 11.6385C7.9743 11.5238 8.01157 11.4095 8.08877 11.3238C8.16597 11.2382 8.27587 11.1893 8.39117 11.1893H15.187C15.3023 11.1893 15.4122 11.2382 15.4894 11.3238C15.5666 11.4094 15.6039 11.5238 15.592 11.6384L15.2497 14.9369H8.3291ZM11.7894 13.8271C12.2253 13.8271 12.5807 13.5513 12.5807 13.2139C12.5807 12.8758 12.2253 12.6008 11.7894 12.6008C11.3536 12.6008 10.9974 12.8758 10.9974 13.2139C10.9974 13.5513 11.3536 13.8271 11.7894 13.8271Z"
                                                            fill="black" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_236_102">
                                                            <rect width="17" height="17" fill="white" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </span>
                                            <h4>parts manager</h4>
                                        </div>
                                        <p class="analyics-tabs-num"></p>
                                    </div>
                                </button>
                            </h2>
                            <div id="flush-collapseOne5" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <ul class="sub-menu">
                                        <li><a href="#">
                                                <p>action</p>
                                            </a></li>
                                        <li><a href="#">
                                                <p>another action</p>
                                            </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="analyics-tabs-list">

                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne6" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    <div class="analyics-tabs-btns ">
                                        <div class="analyics-tabs-name">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                    viewBox="0 0 17 17" fill="none">
                                                    <g opacity="0.3" clip-path="url(#clip0_236_105)">
                                                        <path
                                                            d="M0.498007 15.8373H1.49402C1.76905 15.8373 1.99203 15.6143 1.99203 15.3393V9.86121H0.498007C0.222974 9.86121 0 10.0842 0 10.3592V15.3393C0 15.6143 0.222974 15.8373 0.498007 15.8373Z"
                                                            fill="black" />
                                                        <path
                                                            d="M13.0153 0.897095C10.8149 0.897095 9.03125 2.68079 9.03125 4.88115C9.03125 7.08145 10.8149 8.86521 13.0153 8.86521C15.2157 8.86521 16.9994 7.08145 16.9994 4.88115C16.9994 2.68079 15.2157 0.897095 13.0153 0.897095ZM13.8499 6.67351C13.742 6.72743 13.6289 6.76989 13.5132 6.80203V6.93965C13.5132 7.21468 13.2903 7.43765 13.0152 7.43765C12.7402 7.43765 12.5172 7.21468 12.5172 6.93965V6.8176C12.3099 6.76541 12.1166 6.67766 11.9528 6.55485C11.7328 6.38985 11.6882 6.0777 11.8532 5.85764C12.0183 5.63766 12.3304 5.593 12.5504 5.75804C12.7496 5.90744 13.1328 5.91853 13.4044 5.78268C13.5136 5.72806 13.5726 5.66232 13.5726 5.62823C13.5726 5.56863 13.5726 5.55944 13.5063 5.52408C13.3764 5.45472 13.1466 5.41209 12.9244 5.37089C12.6278 5.31584 12.321 5.25894 12.0552 5.11707C11.6671 4.9099 11.4619 4.57003 11.4619 4.13421C11.4619 3.69789 11.7235 3.31681 12.1797 3.08872C12.2879 3.03464 12.4012 2.99184 12.5172 2.95967V2.82279C12.5172 2.54776 12.7402 2.32478 13.0152 2.32478C13.2903 2.32478 13.5132 2.54776 13.5132 2.82279V2.94473C13.7206 2.99696 13.9139 3.08477 14.0777 3.20758C14.2977 3.37262 14.3423 3.68477 14.1773 3.90479C14.0122 4.12481 13.7001 4.16943 13.48 4.00439C13.2805 3.85476 12.8971 3.84367 12.6252 3.97956C12.5153 4.03447 12.4579 4.09891 12.4579 4.13417C12.4579 4.1938 12.4579 4.20296 12.5242 4.23836C12.6541 4.30771 12.8839 4.35034 13.1061 4.39154C13.4027 4.44659 13.7095 4.50349 13.9753 4.64536C14.3634 4.85253 14.5686 5.1924 14.5686 5.62823C14.5686 6.06412 14.3066 6.44512 13.8499 6.67351Z"
                                                            fill="black" />
                                                        <path
                                                            d="M8.99096 16.103H9.10052C10.7738 16.083 12.3774 15.6083 13.7918 14.7517L16.5706 12.8095C17.0387 12.4808 17.1284 11.8633 16.8196 11.425C16.5009 10.9668 15.8834 10.8573 15.4352 11.176L12.7659 13.0485C11.9093 13.5465 10.8635 13.6561 9.91725 13.3373L6.84621 12.3214C6.58724 12.2417 6.44777 11.9528 6.53744 11.6939C6.61709 11.4449 6.87606 11.3055 7.13502 11.3752C7.14498 11.3752 10.5845 12.4908 10.5845 12.4908C11.1638 12.6644 11.6784 12.3366 11.8395 11.8533C12.0088 11.3254 11.72 10.7676 11.2021 10.5983L6.51749 9.06447C5.49286 8.69146 4.11208 8.76852 2.98828 9.39694V14.972L6.89598 15.8573C7.61181 16.0148 8.3142 16.103 8.99096 16.103Z"
                                                            fill="black" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_236_105">
                                                            <rect width="17" height="17" fill="white" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </span>
                                            <h4>money earned</h4>
                                        </div>
                                        <p class="analyics-tabs-num"></p>
                                    </div>
                                </button>
                            </h2>
                            <div id="flush-collapseOne6" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <ul class="sub-menu">
                                        <li><a href="#">
                                                <p>action</p>
                                            </a></li>
                                        <li><a href="#">
                                                <p>another action</p>
                                            </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                </li> --}}

                {{-- packages --}}
                <li class="analyics-tabs-list">

                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne5" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    <a href="{{ route('admin.packages.all') }}"
                                        class="analyics-tabs-btns @if (Route::is('admin.packages.*')) active @endif ">
                                        <div class="analyics-tabs-name">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                    viewBox="0 0 17 17" fill="none">
                                                    <g opacity="0.3" clip-path="url(#clip0_236_102)">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M11.7894 9.43425C10.4694 9.43425 9.3936 8.35768 9.3936 7.03838C9.3936 5.71908 10.4694 4.64331 11.7894 4.64331C13.1087 4.64331 14.1845 5.71908 14.1845 7.03838C14.1845 8.35768 13.1087 9.43425 11.7894 9.43425ZM7.53167 12.4241L7.69507 13.9958H7.26707C7.2188 13.9958 7.17287 13.9749 7.14123 13.9384C7.10957 13.902 7.09527 13.8536 7.10203 13.8058C7.17477 13.3169 7.32187 12.8524 7.53167 12.4241ZM15.8836 13.9958L16.0466 12.4245C16.2563 12.8526 16.4034 13.3171 16.4758 13.8058C16.4825 13.8535 16.4683 13.9018 16.4367 13.9382C16.4051 13.9746 16.3592 13.9955 16.311 13.9955C16.1298 13.9958 15.8836 13.9958 15.8836 13.9958ZM14.5517 10.656H9.0266C9.80433 10.0968 10.7584 9.76758 11.7894 9.76758C12.8201 9.76758 13.774 10.0968 14.5517 10.656ZM7.40123 16.5V15.6369C7.40123 15.5449 7.47587 15.4703 7.5679 15.4703H16.0102C16.1023 15.4703 16.1769 15.5449 16.1769 15.6369V16.5C16.1769 16.592 16.1023 16.6666 16.0102 16.6666H7.5679C7.47587 16.6666 7.40123 16.592 7.40123 16.5ZM4.56623 9.89478C4.56623 9.74761 4.6857 9.62811 4.8329 9.62811C4.98007 9.62811 5.09957 9.74761 5.09957 9.89478V13.5044H6.31507C6.46223 13.5044 6.58173 13.6239 6.58173 13.7711C6.58173 13.9183 6.46223 14.0378 6.31507 14.0378H4.8329C4.6856 14.0378 4.56623 13.9184 4.56623 13.7711V9.89478ZM5.69593 1.05231C6.07843 1.14321 6.44327 1.29435 6.77857 1.50095L7.4822 1.18808L8.311 2.01688L7.9993 2.72055C8.20593 3.05581 8.35703 3.42065 8.44797 3.80435L9.16577 4.08061V5.25298L8.44797 5.52925C8.35703 5.91175 8.20473 6.27658 7.9993 6.61188L8.311 7.31551L7.4822 8.14431L6.77857 7.83261C6.44443 8.03925 6.07843 8.19035 5.69593 8.28128L5.41967 8.99908H4.2473L3.97103 8.28128C3.58733 8.19035 3.2225 8.03805 2.88723 7.83261L2.18357 8.14431L1.35477 7.31551L1.66763 6.61188C1.46103 6.27775 1.3099 5.91175 1.21783 5.52925L0.5 5.25298V4.08061L1.21783 3.80435C1.3099 3.42065 1.46103 3.05581 1.66763 2.72055L1.35477 2.01688L2.18357 1.18808L2.88723 1.50095C3.2225 1.29435 3.58733 1.14321 3.96983 1.05231L4.2473 0.333313H5.41967L5.69593 1.05231ZM4.8329 1.95955C3.3384 1.95955 2.12623 3.17171 2.12623 4.66621C2.12623 6.16068 3.3384 7.37288 4.8329 7.37288C6.32737 7.37288 7.53957 6.16068 7.53957 4.66621C7.53957 3.17171 6.32737 1.95955 4.8329 1.95955ZM4.56623 3.05835C4.56623 2.91115 4.6857 2.79168 4.8329 2.79168C4.98007 2.79168 5.09957 2.91115 5.09957 3.05835V4.51228L6.1305 5.10788C6.25793 5.18148 6.3016 5.34475 6.228 5.47218C6.15437 5.59961 5.99113 5.64331 5.8637 5.56968L4.6995 4.89711C4.617 4.84945 4.56623 4.76145 4.56623 4.66621V3.05835ZM8.3291 14.9369L7.9862 11.6385C7.9743 11.5238 8.01157 11.4095 8.08877 11.3238C8.16597 11.2382 8.27587 11.1893 8.39117 11.1893H15.187C15.3023 11.1893 15.4122 11.2382 15.4894 11.3238C15.5666 11.4094 15.6039 11.5238 15.592 11.6384L15.2497 14.9369H8.3291ZM11.7894 13.8271C12.2253 13.8271 12.5807 13.5513 12.5807 13.2139C12.5807 12.8758 12.2253 12.6008 11.7894 12.6008C11.3536 12.6008 10.9974 12.8758 10.9974 13.2139C10.9974 13.5513 11.3536 13.8271 11.7894 13.8271Z"
                                                            fill="black" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_236_102">
                                                            <rect width="17" height="17" fill="white" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </span>
                                            <h4>Subscription Plan</h4>
                                        </div>
                                        <p class="analyics-tabs-num"></p>
                                    </a>
                                </button>
                            </h2>
                            {{-- <div id="flush-collapseOne5" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('admin.packages.all') }}">
                                                <p>index</p>
                                            </a></li>
                                        <li><a href="{{ route('admin.packages.add') }}">
                                                <p>Add Packages</p>
                                            </a></li>
                                    </ul>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </li>

                <li class="analyics-tabs-list">

                    {{-- <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne3" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    <a href="{{ route('admin.profile.view') }}"
                                        class="analyics-tabs-btns @if (Route::is('admin.profile.*')) active @endif ">
                                        <div class="analyics-tabs-name">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                    viewBox="0 0 17 17" fill="none">
                                                    <g opacity="0.3" clip-path="url(#clip0_234_89)">
                                                        <path d="M13.6465 0.291565V3.32029H16.675L13.6465 0.291565Z"
                                                            fill="black" />
                                                        <path
                                                            d="M13.1484 4.31641C12.8734 4.31641 12.6504 4.09341 12.6504 3.81836V0H5.51172C4.68785 0 4.01758 0.670272 4.01758 1.49414V7.06194C4.18167 7.04706 4.34772 7.03906 4.51562 7.03906C6.21323 7.03906 7.73291 7.81522 8.7386 9.03125H14.1445C14.4196 9.03125 14.6426 9.25424 14.6426 9.5293C14.6426 9.80435 14.4196 10.0273 14.1445 10.0273H9.39476C9.70607 10.6348 9.90682 11.3078 9.97126 12.0195H14.1445C14.4196 12.0195 14.6426 12.2425 14.6426 12.5176C14.6426 12.7926 14.4196 13.0156 14.1445 13.0156H9.97126C9.82231 14.6605 8.94349 16.0977 7.66189 17H15.4727C16.2965 17 16.9668 16.3297 16.9668 15.5059V4.31641H13.1484ZM14.1445 7.03906H6.83984C6.56479 7.03906 6.3418 6.81607 6.3418 6.54102C6.3418 6.26596 6.56479 6.04297 6.83984 6.04297H14.1445C14.4196 6.04297 14.6426 6.26596 14.6426 6.54102C14.6426 6.81607 14.4196 7.03906 14.1445 7.03906Z"
                                                            fill="black" />
                                                        <path
                                                            d="M4.51562 8.03516C2.04402 8.03516 0.0332031 10.046 0.0332031 12.5176C0.0332031 14.9892 2.04402 17 4.51562 17C6.98723 17 8.99805 14.9892 8.99805 12.5176C8.99805 10.046 6.98723 8.03516 4.51562 8.03516ZM5.84375 13.0156H4.51562C4.24057 13.0156 4.01758 12.7926 4.01758 12.5176V10.5254C4.01758 10.2503 4.24057 10.0273 4.51562 10.0273C4.79068 10.0273 5.01367 10.2503 5.01367 10.5254V12.0195H5.84375C6.1188 12.0195 6.3418 12.2425 6.3418 12.5176C6.3418 12.7926 6.1188 13.0156 5.84375 13.0156Z"
                                                            fill="black" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_234_89">
                                                            <rect width="17" height="17" fill="white" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </span>

                                            <h4>Profile setting</h4>

                                        </div>
                                    </a>
                                </button>
                            </h2>
                        </div>
                    </div> --}}
                </li>

                <li class="analyics-tabs-list">

                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne5" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    <a href="{{ route('admin.featured.product') }}" class="analyics-tabs-btns ">
                                        <div class="analyics-tabs-name">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                    viewBox="0 0 17 17" fill="none">
                                                    <g opacity="0.3" clip-path="url(#clip0_236_102)">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M11.7894 9.43425C10.4694 9.43425 9.3936 8.35768 9.3936 7.03838C9.3936 5.71908 10.4694 4.64331 11.7894 4.64331C13.1087 4.64331 14.1845 5.71908 14.1845 7.03838C14.1845 8.35768 13.1087 9.43425 11.7894 9.43425ZM7.53167 12.4241L7.69507 13.9958H7.26707C7.2188 13.9958 7.17287 13.9749 7.14123 13.9384C7.10957 13.902 7.09527 13.8536 7.10203 13.8058C7.17477 13.3169 7.32187 12.8524 7.53167 12.4241ZM15.8836 13.9958L16.0466 12.4245C16.2563 12.8526 16.4034 13.3171 16.4758 13.8058C16.4825 13.8535 16.4683 13.9018 16.4367 13.9382C16.4051 13.9746 16.3592 13.9955 16.311 13.9955C16.1298 13.9958 15.8836 13.9958 15.8836 13.9958ZM14.5517 10.656H9.0266C9.80433 10.0968 10.7584 9.76758 11.7894 9.76758C12.8201 9.76758 13.774 10.0968 14.5517 10.656ZM7.40123 16.5V15.6369C7.40123 15.5449 7.47587 15.4703 7.5679 15.4703H16.0102C16.1023 15.4703 16.1769 15.5449 16.1769 15.6369V16.5C16.1769 16.592 16.1023 16.6666 16.0102 16.6666H7.5679C7.47587 16.6666 7.40123 16.592 7.40123 16.5ZM4.56623 9.89478C4.56623 9.74761 4.6857 9.62811 4.8329 9.62811C4.98007 9.62811 5.09957 9.74761 5.09957 9.89478V13.5044H6.31507C6.46223 13.5044 6.58173 13.6239 6.58173 13.7711C6.58173 13.9183 6.46223 14.0378 6.31507 14.0378H4.8329C4.6856 14.0378 4.56623 13.9184 4.56623 13.7711V9.89478ZM5.69593 1.05231C6.07843 1.14321 6.44327 1.29435 6.77857 1.50095L7.4822 1.18808L8.311 2.01688L7.9993 2.72055C8.20593 3.05581 8.35703 3.42065 8.44797 3.80435L9.16577 4.08061V5.25298L8.44797 5.52925C8.35703 5.91175 8.20473 6.27658 7.9993 6.61188L8.311 7.31551L7.4822 8.14431L6.77857 7.83261C6.44443 8.03925 6.07843 8.19035 5.69593 8.28128L5.41967 8.99908H4.2473L3.97103 8.28128C3.58733 8.19035 3.2225 8.03805 2.88723 7.83261L2.18357 8.14431L1.35477 7.31551L1.66763 6.61188C1.46103 6.27775 1.3099 5.91175 1.21783 5.52925L0.5 5.25298V4.08061L1.21783 3.80435C1.3099 3.42065 1.46103 3.05581 1.66763 2.72055L1.35477 2.01688L2.18357 1.18808L2.88723 1.50095C3.2225 1.29435 3.58733 1.14321 3.96983 1.05231L4.2473 0.333313H5.41967L5.69593 1.05231ZM4.8329 1.95955C3.3384 1.95955 2.12623 3.17171 2.12623 4.66621C2.12623 6.16068 3.3384 7.37288 4.8329 7.37288C6.32737 7.37288 7.53957 6.16068 7.53957 4.66621C7.53957 3.17171 6.32737 1.95955 4.8329 1.95955ZM4.56623 3.05835C4.56623 2.91115 4.6857 2.79168 4.8329 2.79168C4.98007 2.79168 5.09957 2.91115 5.09957 3.05835V4.51228L6.1305 5.10788C6.25793 5.18148 6.3016 5.34475 6.228 5.47218C6.15437 5.59961 5.99113 5.64331 5.8637 5.56968L4.6995 4.89711C4.617 4.84945 4.56623 4.76145 4.56623 4.66621V3.05835ZM8.3291 14.9369L7.9862 11.6385C7.9743 11.5238 8.01157 11.4095 8.08877 11.3238C8.16597 11.2382 8.27587 11.1893 8.39117 11.1893H15.187C15.3023 11.1893 15.4122 11.2382 15.4894 11.3238C15.5666 11.4094 15.6039 11.5238 15.592 11.6384L15.2497 14.9369H8.3291ZM11.7894 13.8271C12.2253 13.8271 12.5807 13.5513 12.5807 13.2139C12.5807 12.8758 12.2253 12.6008 11.7894 12.6008C11.3536 12.6008 10.9974 12.8758 10.9974 13.2139C10.9974 13.5513 11.3536 13.8271 11.7894 13.8271Z"
                                                            fill="black" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_236_102">
                                                            <rect width="17" height="17" fill="white" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </span>
                                            <h4>Featured list</h4>
                                        </div>
                                        <p class="analyics-tabs-num"></p>
                                    </a>
                                </button>
                            </h2>

                        </div>
                    </div>
                </li>
                <li class="analyics-tabs-list">

                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne4" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    <a href="{{ route('admin.order.orderlist') }}"
                                        class="analyics-tabs-btns @if (Route::is('admin.order.orderlist')) active @endif ">
                                        <div class="analyics-tabs-name">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                    viewBox="0 0 17 17" fill="none">
                                                    <g opacity="0.3" clip-path="url(#clip0_234_93)">
                                                        <path
                                                            d="M12.3104 8.14587C10.1153 8.14587 8.32813 9.933 8.32813 12.1282C8.32812 14.3233 10.1153 16.1105 12.3104 16.1105C14.5056 16.1105 16.2927 14.3233 16.2927 12.1282C16.2927 9.933 14.5056 8.14587 12.3104 8.14587ZM11.3033 10.6202L12.3104 11.6274L13.3176 10.6202C13.4726 10.4666 13.6661 10.4679 13.8184 10.6202C13.9567 10.7585 13.9567 10.9827 13.8184 11.121L12.8112 12.1282L13.8184 13.1353C13.9567 13.2736 13.9567 13.4978 13.8184 13.6361C13.6801 13.7744 13.4559 13.7744 13.3176 13.6361L12.3104 12.629L11.3033 13.6361C11.165 13.7744 10.9408 13.7744 10.8024 13.6361C10.6642 13.4978 10.6642 13.2736 10.8024 13.1353L11.8096 12.1282L10.8024 11.121C10.6642 10.9827 10.6642 10.7585 10.8024 10.6202C10.9441 10.4776 11.1688 10.4858 11.3033 10.6202Z"
                                                            fill="black" />
                                                        <path
                                                            d="M1.42908 0.889587C1.03615 0.889587 0.708984 1.21682 0.708984 1.60968V2.94956C0.708984 3.34244 1.03615 3.66966 1.42908 3.66966H5.39547V0.889587H1.42908ZM6.1038 0.889587V6.10665L7.0411 5.17004C7.17941 5.03179 7.4036 5.03179 7.54191 5.17004L8.50411 6.13155V0.889602L6.1038 0.889587ZM9.21244 0.889587V3.66966H13.1415C13.5344 3.66966 13.8623 3.34244 13.8623 2.94956V1.60968C13.8623 1.21682 13.5344 0.889587 13.1415 0.889587H9.21244ZM1.3018 4.31089V11.7816C1.3018 12.5224 1.93977 12.8455 2.52755 12.8455H7.67196C7.63551 12.6109 7.61108 12.3726 7.61108 12.1282C7.61108 9.54416 9.72607 7.42922 12.31 7.42922C12.6387 7.42922 12.9593 7.46446 13.2695 7.52952V4.31089C11.8791 4.33462 10.419 4.32715 9.21244 4.32191V6.98651C9.21232 7.30195 8.83099 7.45989 8.60787 7.23692L7.2915 5.92124L6.00004 7.21202C5.77692 7.43499 5.39559 7.27704 5.39547 6.96161V4.3273C3.95795 4.32588 2.54623 4.32481 1.3018 4.31089Z"
                                                            fill="black" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_234_93">
                                                            <rect width="17" height="17" fill="white" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </span>
                                            <h4>All Orders</h4>
                                        </div>
                                        <p class="analyics-tabs-num"></p>
                                    </a>
                                </button>
                            </h2>

                        </div>
                    </div>
                </li>
            </ul>


        </div>
    </div>
