<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GameController extends Controller
{
    private $apiUrl = 'http://127.0.0.1:5000';

    public function startGame()
    {
        $response = Http::get("{$this->apiUrl}/start_game");
        $data = $response->json();
        session([
            'number_to_guess' => $data['number_to_guess'],
            'chances' => 10,
            'guess_counter' => 0
        ]);

        return view('game.start', [
            'message' => $data['message'],
            'remaining_chances' => 10
        ]);
    }

    public function makeGuess(Request $request)
    {
        $numberToGuess = session('number_to_guess');
        $guessCounter = session('guess_counter');
        $chances = session('chances');

        // تحديث عدد المحاولات المستهلكة
        $guessCounter++;
        session(['guess_counter' => $guessCounter]);

        // حساب المحاولات المتبقية
        $remainingChances = $chances - $guessCounter;

        $response = Http::post("{$this->apiUrl}/guess", [
            'number_to_guess' => $numberToGuess,
            'my_guess' => $request->input('guess'),
            'guess_counter' => $guessCounter,
            'chances' => $chances,
        ]);

        $data = $response->json();

        // تحديث الجلسة بالمحاولات المتبقية فقط إذا لم تفز أو تخسر
        if ($data['result'] != 'win' && $data['result'] != 'lose') {
            session(['guess_counter' => $guessCounter]);
        }

        return view('game.result', [
            'data' => $data,
            'remaining_chances' => max($remainingChances, 0)
        ]);
    }


}
