<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MazeController extends Controller
{
    // عرض الماز
    public function showMaze()
    {
        // الاتصال بـ Flask للحصول على بيانات الماز الحالية
        $response = Http::get('http://127.0.0.1:5000/maze');
        $data = $response->json();

        return view('maze.maze', [
            'maze' => $data['maze'],
            'player_position' => $data['player_position'],
            'start' => $data['start'],
            'goal' => $data['goal']
        ]);
    }

    // تحريك اللاعب
    public function movePlayer(Request $request)
    {
        $direction = $request->input('direction');
        $response = Http::post('http://127.0.0.1:5000/move', [
            'direction' => $direction
        ]);
        $data = $response->json();

        return response()->json($data);
    }

    // إعادة التشغيل
    public function restartGame()
    {
        // إرسال طلب إلى Flask لإعادة تعيين اللعبة
        $response = Http::post('http://127.0.0.1:5000/restart');
        $data = $response->json();

        return response()->json($data);
    }
}

