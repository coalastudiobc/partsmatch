<div class="chat-inbox-heading">
    <h2>Inbox</h2>
    <div class="unbox-search-menu">
        <a href="#"><i class="fa-solid fa-magnifying-glass"></i></a>
        <div class="dropdown inbox-menu-btn">
            <div class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </div>
            <ul class="dropdown-menu dropdown-menu-end " aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="chat-inbox-list-box">
    <ul class="inbox-list ">
        @php
            $user = null;
        @endphp
        @foreach ($chats as $key => $chat)
            @php
                if ($chat->sender_id == auth()->id()) {
                    $user = $chat->reciever;
                } else {
                    $user = $chat->sender;
            } @endphp
            <li class=" li-list {{ isset($chat_id) && $chat_id == $chat->chat_id ? 'active' : '' }}"
                chatId="{{ isset($chat_id) && $chat_id == $chat->chat_id ? $chat_id : $chat->chat_id }}"
                receiverId="{{ $user->id }}" get_chat_url="{{ route('dealer.chat.messages') }}">

                <a class="chat-open-box">
                    <div class="chat-profile">
                        <div class="chat-profile-img">
                            <img src="{{ asset('storage/' . $user->profile_picture_url) }}" alt="">
                        </div>
                        <div class="chat-profile-txt">
                            <h3>{{ $user->name }}</h3>
                            <p>{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="chat-profile-time">
                        <span>10:50AM</span>
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
</div>
