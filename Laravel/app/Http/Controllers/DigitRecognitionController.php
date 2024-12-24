<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DigitRecognitionController extends Controller
{
    // عرض نموذج رفع الصورة
    public function showForm()
    {
        return view('AI_pro.upload');
    }

    // معالجة الصورة وإرسالها إلى Flask
    public function predictimage(Request $request)
    {
        // تحقق من رفع الصورة
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            // رفع الصورة
            $image = $request->file('image');

            // إرسال الصورة إلى Flask
            $response = Http::attach(
                'image', // اسم الحقل المطلوب في Flask
                file_get_contents($image->getRealPath()),
                $image->getClientOriginalName()
            )->post('http://127.0.0.1:5000/predict'); // استبدل الرابط برابط Flask الخاص بك

            // التحقق من نجاح الاستجابة
            if ($response->successful()) {
                $data = $response->json();

                // عرض النتيجة
                return view('AI_pro.upload', ['prediction' => $data['prediction'] ?? 'Unknown']);
            } else {
                return back()->withErrors(['error' => 'Flask server error: ' . $response->body()]);
            }
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error: ' . $e->getMessage()]);
        }
    }
}

