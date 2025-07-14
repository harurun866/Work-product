<?php

namespace App\Http\Controllers;

use App\Models\Chatroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatroomController extends Controller
{
    public function index()
    {
        $chatrooms = Chatroom::all();
        $joinedRoomIds = auth()->user()->chatrooms->pluck('id')->toArray(); // 参加中のルームID一覧

        return view('chatrooms.index', compact('chatrooms', 'joinedRoomIds'));
    }

    public function create()
    {
        return view('chatrooms.create');
    }

    public function store(Request $request)
    {
        $chatroom = new Chatroom();
        $chatroom->name = $request->input('name');
        $chatroom->room_description = $request->input('room_description');
        $chatroom->user_id = auth()->id();
        $chatroom->save();

        return redirect()->route('chatrooms.index')->with('success', 'New chatroom created!');
    }

    public function join($id)
    {
        $chatroom = Chatroom::findOrFail($id);
        // すでに参加していたら重複しないように
        $chatroom->users()->syncWithoutDetaching([
            auth()->id() => ['status' => 'active']
        ]);

        return redirect()->route('chatrooms.show', $chatroom->id);
    }

    public function show($id)
    {
        $chatroom = Chatroom::findOrFail($id);

        if (!$chatroom->users->contains(auth()->id())) {
            abort(403, 'You are not a participant of this chatroom.');
        }

        return view('chatrooms.show', compact('chatroom'));
    }

    public function joined()
    {
        $joinedChatrooms = auth()->user()->chatrooms;
        return view('chatrooms.joined', compact('joinedChatrooms'));
    }

    // 離席処理
    public function setAway($id)
    {
        auth()->user()->chatrooms()->updateExistingPivot($id, ['status' => 'away']);
        return redirect()->route('chatrooms.show', $id);
    }

    public function setActive($id)
    {
        auth()->user()->chatrooms()->updateExistingPivot($id, ['status' => 'active']);
        return redirect()->route('chatrooms.show', $id);
    }

    public function edit($id)
    {
        $chatroom = Chatroom::findOrFail($id);

        if ($chatroom->user_id !== auth()->id()) {
            abort(403, '編集権限がありません');
        }

        return view('chatrooms.edit', compact('chatroom'));
    }

    public function update(Request $request, $id)
    {
        $chatroom = Chatroom::findOrFail($id);

        if ($chatroom->user_id !== auth()->id()) {
            abort(403, '更新権限がありません');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'room_description' => 'nullable|string',
        ]);

        $chatroom->update([
            'name' => $request->name,
            'room_description' => $request->room_description,
        ]);

        return redirect()->route('chatrooms.index')->with('success', 'チャットルームを更新しました');
    }
}
