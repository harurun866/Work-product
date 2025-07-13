<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    public function show()
    {
        return view('dashboard');
    }
    public function create(Request $request)
    {
        $request->validate([
            'body' => 'required|string|max:255',
            'date' => 'required|date',
            'is_planned' => 'required|boolean',
        ]);
        Event::create([
            'user_id' => Auth::id(),
            'body' => $request->input('body'),
            'date' => $request->input('date'),
            'is_planned' => $request->input('is_planned'),
        ]);

        return redirect()->route('show')->with('success', '予定を追加しました。');
    }

    public function get(Request $request)
    {
        $request->validate([
            'start_date' => 'required|integer',
            'end_date' => 'required|integer',
        ]);

        $start_date = date('Y-m-d', $request->input('start_date') / 1000);
        $end_date = date('Y-m-d', $request->input('end_date') / 1000);

        return Event::query()
            ->select(
                'id',
                'body as title',    // FullCalendarのタイトル
                'date as start'
                // FullCalendarの開始日（endなし）
            )
            ->where('date', '>=', $start_date)
            ->where('date', '<=', $end_date)
            ->get();
    }
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:events,id',
            'body' => 'required|string|max:255',
            'date' => 'required|date',
            'is_planned' => 'required|boolean',
        ]);

        $event = Event::find($request->input('id'));

        $event->update([
            'body' => $request->input('body'),
            'date' => $request->input('date'),
            'is_planned' => $request->input('is_planned'),
        ]);

        return redirect()->route('show')->with('success', '予定を更新しました。');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:events,id',
        ]);

        $event = Event::where('id', $request->input('id'))
            ->where('user_id', Auth::id())
            ->first();

        if (!$event) {
            return redirect()->route('show')->with('error', '削除対象の予定が見つかりません。');
        }

        $event->delete();

        return redirect()->route('show')->with('success', '予定を削除しました。');
    }
}
