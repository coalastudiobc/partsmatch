<?php

namespace App\Http\Controllers\Dealer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, Media, ConversationMedia, Chat, GroupMember};
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    public function view()
    {
        $chats =  getChatId();
        $type = 0;
        return view('dealer.chat.dashboard', compact('chats', 'type'));
        // dd($response);
    }
    public function inboxView($user_id)
    {
        $id = jsdecode_userdata($user_id);
        if ($id === auth()->user()->id) {
            return redirect()->back();
        }
        if (check_chatId($id)) {
            $chat = Chat::create(['chat_id' => Str::random(10), 'sender_id' => auth()->user()->id, 'reciever_id' => $id]);
        }

        $chat_id =  getChat($id);
        $chats =  getChatId();
        $type = 0;
        // $chatheader = view('components.chat-inbox-component', compact('reciever'))->render();
        return view('dealer.chat.dashboard', compact('chats', 'chat_id', 'type',));
    }
    public function inbox($id = null)
    {
        $messages = array();
        return view('user.messages', compact('messages', 'id'));
    }

    public function messages()
    {
        $id = null;
        $messages = array();
        // dd($messages ,$id);
        return view('messages', compact('messages', 'id'));
    }

    public function storeChat(Request $request)
    {
        try {
            $receiver_id = jsdecode_userdata($request->receiver_id);
            // if ($receiver_id) {
            //     if (check_chat_exist($receiver_id))
            //         $chat = check_chat_exist($receiver_id);
            //     else
            $chat = Chat::create(['chatid' => Str::random(10), 'sender_id' => auth()->user()->id, 'receiver_id' => $receiver_id]);
            // } else {
            //     $chat = auth()->user()->chat()->create(['chatid' => Str::random(10), 'group_id' => jsdecode_userdata($request->group_id)]);
            // }

            return response()->json([
                'status' => 'success',
                'message' => "Chat inserted successfully",
                'chat' => ($chat) ? $chat : '',
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }

    /**
     * send image in chat .
     *
     * @return \Illuminate\Http\Response
     */
    public function chatImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'attachment' => 'file|required|mimetypes:image/*|max:' . 1024 * 10
        ], [
            'attachment.mimetypes'  =>  'Please upload valid image',
            'attachment.max'        =>  'Please upload image less that 10Mb.'
        ]);
        try {
            if ($validator->fails())
                throw new \Exception($validator->errors()->first());

            $data = $this->uploadImage($request->file('attachment'));
            ConversationMedia::create([
                'conversation_id' => $request->Id,
                'media_id' => $data->id,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'image retrieved successfully',
                'data'  => $data,
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }

    public function chatMessages(Request $request)
    {
        try {
            $receiverId = $request->receiverId;
            // $receiverId = jsdecode_userdata($request->receiverId);
            $chats = User::select('id', 'name', 'email', 'profile_picture_url')->where('id', $receiverId)->first();

            $type = 1;
            return response()->json(
                [
                    'status' => true,
                    'message' => 'chat retrieved successfully',
                    'data'  => [
                        'chatheader'  =>  view('components.chat-inbox-component', compact('chats', 'type'))->render(),
                        'getchatId'  =>  getChat($receiverId),
                    ],
                ]
            );
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }

    public function muteUnmute($id)
    {
        // dd($id);
        try {
            $user = User::find($id);
            // $user = auth()->user();
            if ($user->is_mute === '0') {
                $user->is_mute = '1';
                $user->save();
            } else {
                $user->is_mute = '0';
                $user->save();
            }
            $is_mute = $user->is_mute;
            return response()->json([
                'status'    =>  true,
                'message' => $is_mute,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'    =>  false,
                'error'      =>  $e->getMessage()
            ]);
        }
    }

    public function muteStatus($receiverId)
    {
        $user = User::find($receiverId);
        if ($user) {
            $isMute = $user->is_mute;
            return response()->json(['is_mute' => $isMute]);
        } else {
            return response()->json(['error' => 'User not found']);
        }
    }

    public function userNames(Request $request)
    {
        $response = User::whereIn('id', $request->user_id)->pluck('name', 'id')->toArray();
        return [
            'data'  =>  $response
        ];
    }

    public function userImage(Request $request)
    {
        $user = User::find($request->id);
        return redirect()->away($user->frontend_profile_url);
    }

    public function chatSearch($type, $search)
    {
        try {


            if ($type == 'chat') {
                $chatlists = getchatmembers($search == 'null' ? '' : $search);
            } else {
                $chatlists = GroupMember::with(['group.getgroupmembers', 'group.getmedia.media', 'group.getgroupchat'])->getfilter($search)->whereUserId(auth()->user()->id)->orderByDesc('id')->limit(50)->get();

                // print_r($chatlists->toArray()); die;
            }
            // dd($chatlists);

            return response()->json([
                'status'    =>  true,
                'data'      =>  [
                    'chatlists'  =>  view('include.chatlist', compact('chatlists', 'type'))->render(),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'    =>  false,
                'error'      =>  $e->getMessage()
            ]);
        }
    }

    public function lastchat_update(Request $request)
    {

        if (!$request->data)
            return response()->json([
                'data' => 'msg not updated'
            ], 201);

        Chat::where('chat_id', $request->data[0]['chatid'])->update(['last_message' => $request->data[0]['lastmessage'], 'last_message' => $request->data[0]['date']]);

        return response()->json([
            'data' => 'last msg updated'
        ], 200);
    }

    public function chat_sort($sortby)
    {

        try {
            $type = 'chat';
            if ($sortby == 'sort_by_name') {
                $chatlists = chats_sort_by_name(getchatmembers());
            } elseif ($sortby == 'sort_by_tip') {
                $chatlists = chats_sort_by_tip(getchatmembers());
            } else {
                $chatlists = chats_sort_by_date(getchatmembers());
            }
            return response()->json([
                'status'    =>  true,
                'data'      =>  [
                    'chatlists'  =>  view('include.chatlist', compact('chatlists', 'type'))->render(),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'    =>  false,
                'error'      =>  $e->getMessage()
            ]);
        }
    }

    public function uploadImage($file)
    {

        $image = store_image($file, 'chat/images');
        if ($image != null) {
            $data = Media::create([
                'name' => $image['name'],
                'type' => 'image/png',
                'path' => $image['url'],
            ]);

            return $data;
        }
    }
}
