<?php

namespace App\Http\Controllers;

use App\Models\HskWord;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HskListController extends Controller
{
    public function index(Request $request): View
    {
        $level         = $request->input('level');
        $sortColumn    = $request->input('sortColumn', 'id');
        $sortDirection = $request->input('sortDirection', 'asc');

        $levels = HskWord::select('hsk_level')
            ->distinct()
            ->orderBy('hsk_level')
            ->pluck('hsk_level');

        $words = collect();

        if ($level !== null) {
            $allowedColumns    = ['chinese', 'pinyin', 'japanese_meaning', 'id'];
            $allowedDirections = ['asc', 'desc'];

            $column    = in_array(strtolower($sortColumn), $allowedColumns, true)
                ? strtolower($sortColumn)
                : 'id';
            $direction = in_array(strtolower($sortDirection), $allowedDirections, true)
                ? strtolower($sortDirection)
                : 'asc';

            $words = HskWord::where('hsk_level', $level)
                ->orderBy($column, $direction)
                ->get();
        }

        return view('hsk-list.index', [
            'levels'        => $levels,
            'selectedLevel' => $level,
            'sortColumn'    => $sortColumn,
            'sortDirection' => $sortDirection,
            'words'         => $words,
        ]);
    }
}
