<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class EcommerceDetectionController extends Controller
{
    public function detectSpam(Request $request)
    {
        // إعداد العميل لإرسال الطلب إلى Flask API
        $client = new Client();

        // إرسال البيانات إلى الـ API
        $response = $client->post('http://127.0.0.1:5000/predict', [
            'json' => [
                'texts' => [
                    $request->input('text1'),
                    $request->input('text2')
                ],
            ],
        ]);

        // تحويل الاستجابة من JSON إلى مصفوفة PHP
        $body = json_decode($response->getBody(), true);

        // إرجاع النتائج إلى العرض
        return view('ecommerce.ecommerce_detection', [
            'inputs' => [$request->input('text1'), $request->input('text2')],
            'results' => $body['predictions']
        ]);
    }
}
