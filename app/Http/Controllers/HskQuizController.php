<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HskQuizController extends Controller
{
    public function index(): View
    {
        return view('hsk-quiz.index');
    }
}
