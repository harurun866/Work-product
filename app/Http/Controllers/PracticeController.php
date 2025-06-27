<?php

namespace App\Http\Controllers;

use App\Models\Practice;
use Illuminate\Http\Request;

class PracticeController extends Controller
{
    public function index()
    {
        // ページネーション対応。1ページ10件
        $practices = Practice::orderBy('date', 'desc')->paginate(10);
        return view('practices.index')->with(['practices' => $practices]);
    }


    public function create()
    {
        return view('practices.create');
    }

    public function store(Request $request)
    {
        $hours = (int) $request->input('hours');
        $minutes = (int) $request->input('minutes');
        $duration = sprintf('%02d:%02d:00', $hours, $minutes); // HH:MM:00形式

        $practice = new Practice();
        $practice->user_id = auth()->id();
        $practice->date = $request->input('date');
        $practice->duration = $duration;
        $practice->instrument = $request->input('instrument');
        $practice->genre = $request->input('genre');
        $practice->content = $request->input('content');
        $practice->reflection = $request->input('reflection');
        $practice->next_goal = $request->input('next_goal');
        $practice->memo = $request->input('memo');

        $practice->save();

        return redirect('/practices');
    }

    public function show($id)
    {
        $practice = Practice::findOrFail($id);
        return view('practices.show', compact('practice'));
    }

    public function edit(Practice $practice)
    {
        [$h, $m, $s] = explode(':', $practice->duration ?? '00:00:00');

        return view('practices.edit')->with([
            'practice' => $practice,
            'hours' => (int) $h,
            'minutes' => (int) $m,
        ]);
    }

    public function update(Request $request, Practice $practice)
    {
        $hours = (int) $request->input('hours');
        $minutes = (int) $request->input('minutes');
        $duration = sprintf('%02d:%02d:00', $hours, $minutes);

        $practice->date = $request->input('date');
        $practice->duration = $duration;
        $practice->instrument = $request->input('instrument');
        $practice->genre = $request->input('genre');
        $practice->content = $request->input('content');
        $practice->reflection = $request->input('reflection');
        $practice->next_goal = $request->input('next_goal');
        $practice->memo = $request->input('memo');

        $practice->save();

        return redirect()->route('practices.show', $practice->id);
    }

    public function delete(Practice $practice)
    {
        $practice->delete();
        return redirect('/practices')->with('success', 'Practice record deleted successfully.');
    }
}
