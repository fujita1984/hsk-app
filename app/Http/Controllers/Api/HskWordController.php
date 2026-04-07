<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HskWord;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HskWordController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $level = (int) $request->input('level', 1);
        $limit = $request->input('limit');

        $words = HskWord::where('hsk_level', $level)->get();

        if ($limit !== null && (int) $limit < $words->count()) {
            $words = $words->shuffle()->take((int) $limit)->values();
        }

        return response()->json($words->map(fn (HskWord $w) => [
            'id'               => $w->id,
            'chinese'          => $w->chinese,
            'pinyin'           => $w->pinyin,
            'pinyin_with_tone' => $w->pinyin_with_tone,
            'japanese_meaning' => $w->japanese_meaning,
            'hsk_level'        => $w->hsk_level,
        ]));
    }
}
