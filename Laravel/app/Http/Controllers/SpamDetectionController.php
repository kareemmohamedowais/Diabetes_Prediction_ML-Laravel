<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SpamDetectionController extends Controller
{
    public function showForm()
    {
        return view('spam_sms.spam_detection'); // عرض الصفحة التي تحتوي على النموذج
    }

    public function detectSpam(Request $request)
    {
        // التحقق من الإدخالات
        $request->validate([
            'text1' => 'required|string',
            'text2' => 'required|string',
        ]);

        // إرسال النصوص إلى خدمة Flask
        $texts = [$request->input('text1'), $request->input('text2')];

        $client = new Client();
        $response = $client->post('http://127.0.0.1:5000/predict', [
            'json' => [
                'text' => $texts,
            ],
        ]);

        $body = json_decode($response->getBody(), true);

        // عرض النتائج في نفس الصفحة
        return view('spam_sms.spam_detection', [
            'results' => $body['predictions'], // النتائج من خدمة Flask
            'inputs' => $texts, // النصوص المدخلة
        ]);
    }
}
