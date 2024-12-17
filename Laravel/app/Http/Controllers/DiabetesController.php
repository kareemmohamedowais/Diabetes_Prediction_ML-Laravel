<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DiabetesPredictionService;

class DiabetesController extends Controller
{
    protected $diabetesService;

    public function __construct(DiabetesPredictionService $diabetesService)
    {
        $this->diabetesService = $diabetesService;
    }

    public function predict(Request $request)
    {



        $validatedData = $request->validate([
            'Pregnancies' => 'required|numeric',
            'Glucose' => 'required|numeric',
            'BloodPressure' => 'required|numeric',
            'SkinThickness' => 'required|numeric',
            'Insulin' => 'required|numeric',
            'BMI' => 'required|numeric',
            'DiabetesPedigreeFunction' => 'required|numeric',
            'Age' => 'required|integer',
            'Model_selectd' => 'required',
        ]);



        $prediction = $this->diabetesService->predict($validatedData);

        if (isset($prediction['error'])) {
            return response()->json(['error' => $prediction['error']], 500);
        }

        // return response()->json([
        //     'prediction' => $prediction['prediction'] == 1 ? 'مريض بالسكري' : 'غير مريض بالسكري'
        // ]);
        // dd( $prediction['prediction']);
        return view('predict_result',[
            'prediction' => $prediction['prediction'],
            'Model_used' => $prediction['Model_used']
        ]);
    }
}
