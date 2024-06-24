@extends('layouts.front')
@section('title', 'chat')
@section('heading', 'chat')

@section('content')
    <main>
        <section class="Chat-sec">
            <div class="container">
                <div class="chat-wrapper">
                    <div class="chat-main-box">
                        <div class="chat-main-left">
                            <div class="back-page-btn">
                                <div class="back-round-icon">
                                    <i class="fa-solid fa-angle-left"></i>
                                </div>
                                <p>Back</p>
                            </div>
                        </div>
                        <div class="chat-main-right">

                            <div class="chat-box-area">
                                <div class="chat-inbox-box">
                                    @include('components.chat-list-component', ['chats' => $chats])
                                </div>
                                <div class="chat-message-box">
                                    @include('components.chat-inbox-component', ['chats' => $chats])
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </main>
@endsection
@push('scripts')
    <script defer src="https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js"></script>
    <script defer src="https://www.gstatic.com/firebasejs/8.10.1/firebase-firestore.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script>
        // Your web app's Firebase configuration
        const firebaseConfig = {
            apiKey: "AIzaSyDVU7iPT4dk4Eld4HS-PKhtp5ZqIP6ERRY",
            authDomain: "testing-chat-may.firebaseapp.com",
            databaseURL: "https://testing-chat-may-default-rtdb.firebaseio.com",
            projectId: "testing-chat-may",
            storageBucket: "testing-chat-may.appspot.com",
            messagingSenderId: "810868582911",
            appId: "1:810868582911:web:f2b8174915bb87b4169fca"
        };
        var senderId = {{ $authUser->id }}
        var userImage = "{{ asset('assets/images/chat-pro1.png') }}";
        var get_user_names = "{{ route('dealer.chat.getuser.names.sa') }}";
        var last_msg_update_url = "{{ route('dealer.chat.lastchat.update') }}";
        // get_chat_url = "{{ route('dealer.chat.messages') }}"
    </script>
    <script defer src="{{ asset('assets/js/chat.js') }}"></script>
@endpush
