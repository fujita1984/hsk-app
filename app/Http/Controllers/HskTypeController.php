<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HskTypeController extends Controller
{
    public function index(): View
    {
        return view('hsk-type.index');
    }
}
