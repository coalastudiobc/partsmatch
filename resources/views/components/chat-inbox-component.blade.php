{{-- <div class="messanger-profile" id="chatUser">
    <div class="chat-profile">
        <span class="close-chat">
            <i class="fa-solid fa-arrow-left"></i>
        </span>
        <div class="chat-profile-img">
            @if ($type)
                <img src="{{ asset('storage/' . $chats->profile_picture_url) }}" alt="">
            @else
                <img src="{{ asset('storage/' . $chats[0]->reciever->profile_picture_url) }}" alt="">
            @endif
        </div>
        @if ($type)
            <div class="chat-profile-txt">
                <h3 class="chat_header_name">{{ $chats->name }}</h3>
                <p class="chat_header_email">{{ $chats->email }}</p>
            </div>
        @else
            <div class="chat-profile-txt">
                <h3>{{ $chats[0]->reciever->name }}</h3>
                <p>{{ $chats[0]->reciever->email }}</p>
            </div>
        @endif

    </div>
    <a href="#" class="messanger-header-cross">
        <span>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path
                    d="M11.405 9.74654L19.2635 1.88799C19.6194 1.53243 19.6194 0.95535 19.2635 0.599787C18.9077 0.243927 18.3312 0.243927 17.9753 0.599787L10.1168 8.45834L2.25823 0.599781C1.90237 0.243921 1.32588 0.243921 0.970026 0.599781C0.614166 0.955344 0.614166 1.53243 0.970026 1.88799L8.82857 9.74654L0.97002 17.6051C0.61416 17.9607 0.61416 18.5377 0.97002 18.8933C1.14795 19.0712 1.38104 19.1602 1.61413 19.1602C1.84721 19.1602 2.0803 19.0712 2.25823 18.8933L10.1168 11.0348L17.9753 18.8933C18.1533 19.0712 18.3863 19.1602 18.6194 19.1602C18.8525 19.1602 19.0856 19.0712 19.2635 18.8933C19.6194 18.5377 19.6194 17.9607 19.2635 17.6051L11.405 9.74654Z"
                    fill="#131313" />
            </svg>
        </span>
    </a>
</div> --}}
<div class="messanger-area">
    <div class="messanger-product-detail">
        <div class="messanger-product-img">
            <img src="{{ asset('assets/images/product1.png') }}" alt="">
        </div>
        <h3>Car Engine 700219 Whitewall</h3>
        <hr>
        <h3>$2500.00</h3>
    </div>
    <div class="messanger-chat-area">
        <div class="chat-area-inner">
            <div class="chat-screen" id="chatWindow">
                <p class="date-center">Today</p>
                <div class="chat-screen-left">
                    <div class="chat-screen-profile">
                        @if ($type)
                            <img src="{{ asset('storage/' . $chats->profile_picture_url) }}" alt="">
                        @else
                            <img src="{{ asset('storage/' . $chats[0]->reciever->profile_picture_url) }}"
                                alt="">
                        @endif
                    </div>
                    <div class="chat-txt-wrapper">
                        @if ($type)
                            <h4>{{ $chats->name ?? '' }}</h4>
                        @else
                            <h4>{{ $chats[0]->reciever->name ?? '' }}</h4>
                        @endif

                        <div class="chat-txt-box">
                            <p>Hi How Are You ?</p>
                            <span>5:00 PM</span>
                        </div>
                    </div>
                </div>
                <div class="chat-screen-right">
                    <div class="chat-txt-wrapper">
                        <h4>You</h4>
                        <div class="chat-txt-box">
                            <p>What do you thing about my offer value ?</p>
                            <span>5:00 PM</span>
                        </div>
                    </div>
                    <div class="chat-screen-profile">
                        <img src="{{ asset('storage/' . auth()->user()->profile_picture_url) }}" alt="">
                    </div>

                </div>
                <div class="chat-screen-right">
                    <div class="chat-txt-wrapper">
                        <h4>You</h4>
                        <div class="chat-txt-box">
                            <p>What do you thing about my offer value ?</p>
                            <span>5:00 PM</span>
                        </div>
                    </div>
                    <div class="chat-screen-profile">
                        <img src="{{ asset('storage/' . auth()->user()->profile_picture_url) }}" alt="">
                    </div>
                </div>

                {{-- commented code --}}
                {{-- <div class="chat-screen-left">
                    <div class="chat-screen-profile">
                        <img src="{{ asset('assets/images/chat-pro2.png') }}" alt="">
                    </div>
                    <div class="chat-txt-wrapper">
                        <h4>Emerson Vetrovs</h4>
                        <div class="chat-txt-box">
                            <p>Hi How Are You ?</p>
                            <span>5:00 PM</span>
                        </div>
                        <div class="chat-photo-box">
                            <img src="{{ asset('assets/images/part-img.png') }}" alt="">
                            <span>5:00 PM</span>
                        </div>
                    </div>
                </div> --}}
                {{-- commented code --}}
            </div>
            <div class="chat-input-wrapper">
                <div class="chat-input-box">
                    <a href="#">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26"
                                fill="none">
                                <path
                                    d="M12.5828 0.272583C19.5148 0.272583 25.1343 5.8921 25.1343 12.8241C25.1343 19.7561 19.5148 25.3757 12.5828 25.3757C5.65076 25.3757 0.03125 19.7561 0.03125 12.8241C0.03125 5.8921 5.65076 0.272583 12.5828 0.272583ZM12.5828 2.36451C6.80611 2.36451 2.12317 7.04745 2.12317 12.8241C2.12317 18.6008 6.80611 23.2837 12.5828 23.2837C18.3594 23.2837 23.0424 18.6008 23.0424 12.8241C23.0424 7.04745 18.3594 2.36451 12.5828 2.36451ZM16.4812 16.3104C16.8664 15.88 17.5277 15.8433 17.9582 16.2286C18.3885 16.6139 18.4251 17.2751 18.04 17.7056C16.7008 19.2018 14.7513 20.1459 12.5828 20.1459C10.4142 20.1459 8.4648 19.2018 7.12563 17.7056C6.74039 17.2751 6.77701 16.6139 7.20745 16.2286C7.6379 15.8433 8.29914 15.88 8.68441 16.3104C9.64351 17.382 11.034 18.0539 12.5828 18.0539C14.1316 18.0539 15.5221 17.382 16.4812 16.3104ZM8.92193 9.16326C9.78842 9.16326 10.4909 9.86571 10.4909 10.7322C10.4909 11.5987 9.78842 12.3011 8.92193 12.3011C8.05543 12.3011 7.35298 11.5987 7.35298 10.7322C7.35298 9.86571 8.05543 9.16326 8.92193 9.16326ZM16.2437 9.16326C17.1101 9.16326 17.8126 9.86571 17.8126 10.7322C17.8126 11.5987 17.1101 12.3011 16.2437 12.3011C15.3772 12.3011 14.6747 11.5987 14.6747 10.7322C14.6747 9.86571 15.3772 9.16326 16.2437 9.16326Z"
                                    fill="#727272" />
                            </svg>
                        </span>
                    </a>
                    <form method="POST" id="chatForm">
                        <div class="file-upload-box">
                            <label for="file-upload">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="27"
                                        viewBox="0 0 17 27" fill="none">
                                        <path
                                            d="M8.17559 26.3734C6.14814 26.4225 4.18392 25.6658 2.71358 24.269C1.24325 22.8721 0.386808 20.9493 0.332031 18.922V5.62713C0.369725 4.16157 0.986504 2.77063 2.04737 1.75877C3.10823 0.746908 4.52676 0.196546 5.99247 0.22815C7.46041 0.193035 8.88231 0.741833 9.94601 1.75407C11.0097 2.7663 11.6283 4.15926 11.666 5.62713V18.935C11.6116 19.8221 11.2209 20.6551 10.5735 21.264C9.92615 21.8729 9.07088 22.2119 8.18213 22.2119C7.29338 22.2119 6.43811 21.8729 5.79073 21.264C5.14336 20.6551 4.75265 19.8221 4.69828 18.935V6.65987C4.69828 6.31316 4.83601 5.98066 5.08117 5.7355C5.32633 5.49034 5.65883 5.35261 6.00554 5.35261C6.35225 5.35261 6.68475 5.49034 6.92991 5.7355C7.17507 5.98066 7.3128 6.31316 7.3128 6.65987V18.935C7.33887 19.1472 7.44166 19.3426 7.60179 19.4842C7.76192 19.6259 7.96833 19.7041 8.18213 19.7041C8.39593 19.7041 8.60234 19.6259 8.76247 19.4842C8.9226 19.3426 9.02539 19.1472 9.05146 18.935V5.62713C9.01082 4.85377 8.66682 4.12764 8.09412 3.60634C7.52142 3.08503 6.76623 2.81063 5.99247 2.84267C5.22091 2.81415 4.46908 3.09014 3.89923 3.61108C3.32938 4.13201 2.9872 4.85612 2.94655 5.62713V18.922C3.00097 20.2559 3.58183 21.514 4.56192 22.4206C5.54201 23.3271 6.84143 23.8084 8.17559 23.7588C9.50976 23.8084 10.8092 23.3271 11.7893 22.4206C12.7694 21.514 13.3502 20.2559 13.4046 18.922V5.62713C13.4046 5.28043 13.5424 4.94792 13.7875 4.70276C14.0327 4.4576 14.3652 4.31987 14.7119 4.31987C15.0586 4.31987 15.3911 4.4576 15.6363 4.70276C15.8814 4.94792 16.0192 5.28043 16.0192 5.62713V18.922C15.9644 20.9493 15.1079 22.8721 13.6376 24.269C12.1673 25.6658 10.203 26.4225 8.17559 26.3734Z"
                                            fill="#727272" />
                                    </svg>
                                </span>
                                <input type="file" id="file-upload" name="attachments">
                            </label>
                        </div>
                        <div class="form-field">
                            <textarea name="message" id="message" cols="30" rows="1" placeholder="Type a Message....."></textarea>
                        </div>
                        <button type="submit" id="sendMessage"><span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="42" height="43"
                                    viewBox="0 0 42 43" fill="none">
                                    <circle cx="20.9192" cy="21.824" r="20.9192" fill="#272643" />
                                    <path
                                        d="M12.5592 30.1917L30.3321 22.347L12.5592 14.5023L12.5508 20.6038L25.2517 22.347L12.5508 24.0903L12.5592 30.1917Z"
                                        fill="white" />
                                </svg>
                            </span></button>
                        {{-- <a href="#">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="42" height="43"
                                    viewBox="0 0 42 43" fill="none">
                                    <circle cx="20.9192" cy="21.824" r="20.9192" fill="#272643" />
                                    <path
                                        d="M12.5592 30.1917L30.3321 22.347L12.5592 14.5023L12.5508 20.6038L25.2517 22.347L12.5508 24.0903L12.5592 30.1917Z"
                                        fill="white" />
                                </svg>
                            </span>
                        </a> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var profilePictureUrl = "{{ asset('storage/' . auth()->user()->profile_picture_url) }}";
</script>
