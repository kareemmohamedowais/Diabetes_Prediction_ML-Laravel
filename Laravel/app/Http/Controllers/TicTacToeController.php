<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TicTacToeController extends Controller
{
    private $apiUrl = 'http://127.0.0.1:5000'; // رابط API لـ Python

    public function index()
    {
        $response = Http::get("{$this->apiUrl}/start_game");
        $data = $response->json();
        session(['board' => $data['board']]);

        return view('tic-tac-toe.tic-tac-toe', ['message' => $data['message'], 'board' => $data['board']]);
    }

    public function makeMove(Request $request)
    {
        $position = $request->input('position');
        $response = Http::post("{$this->apiUrl}/make_move", ['position' => $position]);
        $data = $response->json();

        if (isset($data['error'])) {
            return redirect()->back()->with('error', $data['error']);
        }

        session(['board' => $data['board']]);

        return view('tic-tac-toe.tic-tac-toe', ['message' => $data['message'], 'board' => $data['board'], 'game_over' => $data['game_over']]);
    }
    public function startNewGame()
{
    $response = Http::get("{$this->apiUrl}/start_game");
    $data = $response->json();
    session(['board' => $data['board']]);

    return view('tic-tac-toe', ['message' => $data['message'], 'board' => $data['board']]);
}

}

