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
}
