{{-- <div class="messanger-profile" id="chatUser"> --}}
<div class="chat-profile">
    <span class="close-chat">
        <i class="fa-solid fa-arrow-left"></i>
    </span>
    <div class="chat-profile-img">
        <img src="{{ asset('storage/' . $reciever->profile_picture_url) }}" alt="">

    </div>
    <div class="chat-profile-txt">
        <h3>{{ $reciever->name }}</h3>
        <p>{{ $reciever->email }}</p>
    </div>

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
{{-- </div> --}}
