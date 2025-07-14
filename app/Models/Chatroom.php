<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Chatroom extends Model
{
    use HasFactory;

    // fillable指定（必要なら）
    protected $fillable = ['name', 'room_description', 'user_id'];

    /**
     * このチャットルームに属するメッセージ（1対多）
     */
    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    /**
     * このチャットルームに参加しているユーザー（多対多）
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_chatrooms')->withPivot('status');
    }
}
