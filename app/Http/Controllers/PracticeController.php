<?php

namespace App\Http\Controllers;

use App\Models\Practice;
use Illuminate\Http\Request;

class PracticeController extends Controller
{
    public function index(Practice $practice)
    {
        return view('practices.index')->with(['practices' => $practice->get()]);
    }
    public function create()
    {
        return view('practices.create');
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = auth()->id();

        $practice = new Practice();
        $practice->fill($input)->save();

        return redirect('/practices');
    }
    public function show($id)
    {
        $practice = Practice::findOrFail($id);
        return view('practices.show', compact('practice'));
    }
}
