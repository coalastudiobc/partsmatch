<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $fillable = [
        'last_message',
        'last_msg_time',
        'reciever_id',
        'sender_id',
        'chat_id',
    ];
    protected $with = ['sender', 'reciever'];

    public function sender()
    {
        return $this->hasOne(User::class, 'id', 'sender_id');
    }

    public function reciever()
    {
        return $this->hasOne(User::class, 'id', 'reciever_id');
    }
}
