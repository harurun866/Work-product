<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    public function show()
    {
        return view('profile.dashboard');
    }
    public function create(Request $request)
    {
        Event::create([
            'user_id' => Auth::id(),
            'body' => $request->input('body'),
            'date' => $request->input('date'),
            'is_planned' => $request->input('is_planned'),
        ]);

        return redirect()->route('show')->with('success', '予定を追加しました。');
    }
}
