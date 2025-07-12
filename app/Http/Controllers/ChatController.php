<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chatroom;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;



class ChatController extends Controller
{
    /**
     * チャットルーム内のメッセージを表示（GET）
     */
    public function show($chatroomId)
    {
        $chatroom = Chatroom::findOrFail($chatroomId);

        // 認証ユーザーがそのルームに参加していなければ禁止
        if (!$chatroom->users->contains(auth()->id())) {
            abort(403, 'このチャットルームに参加していません。');
        }

        $messages = $chatroom->chats()->with('user')->orderBy('created_at', 'asc')->get();

        return view('chatrooms.show', compact('chatroom', 'messages'));
    }

    /**
     * メッセージを投稿（POST）
     */
    public function store(Request $request, $id, Chat $chat)
    {
        $user = Auth::user();
        $chat->user_id = $user->id;
        $chat->chatroom_id = $id;
        $chat->message = $request['body'];
        $chat->save();

        return redirect()->route('chatrooms.show', $id);
    }

    public function update(Request $request, $id)
    {
        $chat = Chat::findOrFail($id);

        if ($chat->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $chat->message = $request->input('message');
        $chat->save();

        return response()->json(['message' => $chat->message, 'updated_at' => $chat->updated_at]);
    }

    public function destroy($id)
    {
        $chat = Chat::findOrFail($id);

        if ($chat->user_id !== auth()->id()) {
            abort(403);
        }

        $chat->delete();

        return response()->json(['status' => 'success']);
    }
}
