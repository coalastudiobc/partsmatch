/*GOOGLE FIREBASE CHAT*/
firebase.initializeApp(firebaseConfig);
const db = firebase.firestore();

document.getElementById("chatForm").addEventListener("submit", submitForm);

jQuery('#attachment').on('change', function () {
    var imageName = jQuery(this).val().replace(/.*(\/|\\)/, '');
    jQuery('#message').val(imageName);

})

$(document).ready(function () {
    $('#message').keydown(function (e) { // previously there was .commentarea in use
        console.log('herer');
        if (e.keyCode == 13 && !e.shiftKey) {
            submitForm(e);
        }
    });
});

function parseHtml(text) {
    return text
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

function parseMessage(text) {
    return text
        .replace(/(?:\r\n|\r|\n)/g, '<br>');
}

function urlify(text) {
    var urlRegex = /(https?:\/\/[^\s]+)/g;
    return text.replace(urlRegex, function (url) {
        return '<a href="' + url + '" target="_blank" class="message-link">' + url + '</a>';
    });
}

function submitForm(e) {
    console.log('submit form')
    e.preventDefault();
    // chatId = jQuery(".chat-list.active").attr("chatId");
    chatId = jQuery(".inbox-list .active").attr("chatId");

    ReceiverId = jQuery(".inbox-list .active").attr("receiverid");

    const currentTime = new Date().getTime();
    const timestamp = currentTime.toString();
    const messageInput = document.getElementById("message");
    const message = parseHtml(messageInput.value);
    messageInput.value = '';
    const messageData = {
        currentTime: currentTime,
        message: message,
        receiverId: ReceiverId,
        senderId: senderId,
    }

    if (messageData.message != '') {
        //console.log("messageData",messageData);
        sendMessage(chatId, timestamp, messageData);
    }
}

function sendMessage(chatId, timestamp, data) {
    console.log('sending..', data);
    jQuery('#sendMessage').prop('disabled', true);
    let response = new Promise((resolve, reject) => {
        db.collection(chatId)
            .doc(timestamp)
            .set(data)
            .then(function (docRef) {
                console.log('reseres');
                jQuery('#sendMessage').prop('disabled', false);
            })
            .catch(function (error) {
                reject(error)
                jQuery('#sendMessage').prop('disabled', false);
                console.log('error', error);
            })
    });
}

fireBaseListener = null;
function loadMessages(chatId) {
    if (!chatId) {
        //console.log('HELLLLL')
        return;
    }
    console.log('hiiii', chatId);
    jQuery('#chatWindow').html('');
    if (fireBaseListener)
        fireBaseListener();
    fireBaseListener = db.collection(chatId).onSnapshot((snapshot) => {
        var messageList = '',
            allSenders = [];
        // messageList += '<p class="text-center date_cht">Today, '+moment(new Date()).format('MMMM MM')+'</p>'
        messageList += '<p class="text-center date_cht"></p>';
        snapshot.docChanges().forEach((change) => {
            //console.log("change",change);
            if (change.type === "added") {
                //console.log('fds', change.doc.data().senderId)

                let sender = change.doc.data().senderId;
                let message = change.doc.data().message;
                let currentTime = change.doc.data().currentTime;
                let attachment = ('attachment' in change.doc.data()) ? change.doc.data().attachment : '';
                var msgDate = moment(new Date(currentTime)).format('YYYY-MM-DD');
                let date = moment(new Date()).format('YYYY-MM-DD');
                if (date == msgDate) {
                    var time = moment(new Date(currentTime)).format('h:mm a');

                } else {
                    var time = msgDate;
                }
                // console.log(sender, message,currentTime )

                //console.log(sender, senderId)
                if (sender == senderId) {
                    messageList += '<div class="chat-screen-right ">';
                    messageList += '<div class="msg-data">';
                    messageList += '<div class="pro_name d-flex">';
                    messageList += "<p>You</p>";
                    messageList += "<span>" + time + "</span></div>";
                    if (attachment)
                        messageList +=
                            '<div class="msg_media"><img src="' +
                            imagePath +
                            "/" +
                            attachment +
                            '"></div>';
                    if (message)
                        messageList +=
                            '<div class="chat-txt-box">' +
                            "<p>" +
                            parseMessage(urlify(message)) +
                            "</p>" +
                            "</div>";
                    messageList += "</div>";
                    messageList +=
                        '<div class="chat-screen-profile"><img class="chat-user-img" src="' +
                        profilePictureUrl +
                        "?id=" +
                        sender +
                        '"></div>';
                    messageList += "</div>";

                    // messageList += `
                    // <div class="chat-screen-right">
                    //     <div class="chat-txt-wrapper">
                    //         <h4>You</h4>
                    //         <div class="chat-txt-box">
                    //             <p>${parseMessage(urlify(message))}</p>
                    //             <span>${time}</span>
                    //         </div>
                    //     </div>
                    //     <div class="chat-screen-profile">
                    //         <img src="${userImage}" alt="sender image">
                    //     </div>
                    // </div>`;
                } else {
                    messageList += '<div class="chat-screen-left ">';
                    messageList +=
                        '<div class="chat-screen-profile"><img class="chat-user-img" src="' +
                        userImage +
                        "?id=" +
                        sender +
                        '"></div>';
                    messageList +=
                        '<div class="msg-data"><div class="pro_name d-flex">';
                    messageList +=
                        "<p>" + "{{ auth($reciever)->name }}" + "</p>";
                    messageList += "<span>" + time + "</span></div>";
                    if (attachment)
                        messageList +=
                            '<div class="msg_media"><img src="' +
                            imagePath +
                            "/" +
                            attachment +
                            '"></div>';
                    if (message)
                        messageList +=
                            '<div class="chat-txt-box">' +
                            "<p>" +
                            parseMessage(urlify(message)) +
                            "</p>" +
                            "</div>";
                    messageList += "</div></div>";
                }
                allSenders.push(sender);
                // return false;
            } else if (change.type === "modified") {
                // console.log('modified')
            } else if (change.type === "removed") {
                // console.log('removed')
            }
        });

        response = fetch(get_user_names, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                user_id: allSenders
            })
        })
            .then((response) => {
                if (response.ok) {
                    return response.json();
                }
                throw new Error('error');
            })
            .then((responseJson) => {
                var data = responseJson.data;
                for (const index in data) {
                    //console.log("data",data[index]);
                    messageList = messageList.replace(new RegExp(`{{USERNAME-${index}}}`, "g"), data[index]);
                }
                jQuery('#chatWindow').append(messageList);
                _lastMsgUpdate(chatId);
                // jQuery("#chatWindow").scrollTop($('#chatWindow')[0].scrollHeight);
            });
    });


}

function _lastMsgUpdate(chatId) {
    //console.log("chatId", chatId);
    var fireBaseListenerLastRecord = db.collection(chatId).orderBy('currentTime', 'desc').limit(1).get().then(function (prevSnapshot) {
        //console.log("prevSnapshot",prevSnapshot);
        var lastdate_array = [];
        prevSnapshot.docChanges().forEach((change) => {
            //console.log("change",change);
            var lastmessage = change.doc.data().message;
            var currentTime = change.doc.data().currentTime;
            var getdate = moment(new Date(currentTime)).format("h:mm a");
            lastdate_array.push({ chatid: chatId, lastmessage: lastmessage, date: moment(new Date(currentTime)).format('YYYY-MM-DD HH:mm:ss') });
            // $('.chatmsg').text(lastmessage);
            // $('.activecht').find('span').text(getdate);
        });
        response = fetch(last_msg_update_url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                data: lastdate_array
            })
        })
            .then((response) => {
                if (response.ok) {
                    return response.json();
                }
                throw new Error('error');
            })
            .then((responseJson) => {
                var data = responseJson.data;
            });
    })
}

async function getMessages(get_chat_url, formData) {
    console.log('getMessages', formData)
    const response = await fetch(get_chat_url, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    })
        .then((response) => {
            if (response.ok) {
                return response.json();
            }
            throw new Error('error');
        })
        .then((responseJson) => {
            console.log("responseJson", responseJson);
            let chatId = responseJson.data.getchatId;
            console.log("chatId", chatId);
            if (!chatId)
                return;
            loadMessages(chatId);
            // jQuery('#chatUser').html(responseJson.data.chatheader);

        })
        .catch((error) => {
            console.log('error1', error);

        });

}


// $(document).on('click', '.li-list', function () {
//     console.log("hello");

//     var classElement = jQuery('.li-list ');
//     classElement.removeClass('active');
//     var element = jQuery(this);
//     console.log(element);
//     element.addClass('active');
//     //jQuery('#sendMessage').attr('disabled', false);

//     var formData = new FormData();
//     formData.append('receiverId', jQuery(".li-list .active").attr('receiverId'));
//     console.log("here", get_chat_url);
//     getMessages(get_chat_url, formData);
// });

// jQuery(window).on("load", function () {
//     if ($('.inbox-list .li-list .active').html() != undefined) {
//         $('.inbox-list .li-list .active').trigger('click');
//     }
//     else {
//         $(".wrapcht").addClass('d-none');
//         $(".no-chats-found").removeClass('d-none');
//     }
// });

$(window).on("load", function () {
    var activeLi = $('.chat-inbox-list-box .inbox-list .li-list.active');

    if (activeLi.length > 0) {
        activeLi.trigger('click');
    } else {
        $(".wrapcht").addClass('d-none');
        $(".no-chats-found").removeClass('d-none');
    }
});

// Click event handler for .li-list elements within .inbox-list
$(document).on('click', '.chat-inbox-list-box .inbox-list .li-list', function () {
    console.log("hello");

    // Remove 'active' class from all .li-list elements within .inbox-list
    $('.chat-inbox-list-box .inbox-list .li-list').removeClass('active');

    // Add 'active' class to the clicked .li-list
    $(this).addClass('active');

    // Get receiverId from the clicked .li-list
    var receiverId = $(this).attr('receiverId');
    console.log('Receiver ID:', receiverId);

    var formData = new FormData();
    formData.append('receiverId', receiverId);
    //     console.log("here", get_chat_url);
    //     getMessages(get_chat_url, formData);
    // Example: Call a function passing receiverId
    getMessages($(this).attr("get_chat_url"), formData);

    // Prevent default action (if any) for the anchor element within .li-list
    return false;
});
