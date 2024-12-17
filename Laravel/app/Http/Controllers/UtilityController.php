<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UtilityController extends Controller
{
    // استرجاع حالة اللعبة من Flask
    public function getGameState()
    {
        $response = Http::get('http://localhost:5000/game');
        $data = $response->json();

        return view('utility.utility', ['game_state' => $data]);
    }


    // تحريك العميل في اللعبة
    public function moveAgent(Request $request)
    {
        $direction = $request->input('direction');

        $response = Http::post('http://localhost:5000/move', [
            'direction' => $direction,
        ]);

        return $response->json();
    }
}

