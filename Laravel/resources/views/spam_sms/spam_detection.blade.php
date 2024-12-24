<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spam Detection</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #007BFF;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 24px;
        }

        .container {
            width: 60%;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        label {
            font-size: 16px;
            color: #333;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            width: 100%;
        }

        button:hover {
            background-color: #218838;
        }

        .results {
            margin-top: 20px;
            padding: 20px;
            background-color: #f1f1f1;
            border-radius: 8px;
        }

        .results h2 {
            text-align: center;
            color: #333;
        }

        .results ul {
            list-style: none;
            padding: 0;
        }

        .results li {
            padding: 8px;
            background-color: #fff;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 20px;
        }

        .error ul {
            list-style: none;
            padding: 0;
        }

        .error li {
            margin-bottom: 8px;
        }
    </style>
</head>

<body>
    <header>
        Spam Detection
    </header>

    <div class="container">
        <h1>Check if Your Text is Spam</h1>

        <!-- نموذج الإدخال -->
        <form method="POST" action="{{ route('detect-spam') }}">
            @csrf
            <label for="text1">Text 1:</label>
            <input type="text" id="text1" name="text1" value="{{ old('text1') }}" required>
            <br>
            <label for="text2">Text 2:</label>
            <input type="text" id="text2" name="text2" value="{{ old('text2') }}" required>
            <br><br>
            <button type="submit">Detect Spam</button>
        </form>

        <!-- عرض النتائج -->
        @if (isset($results))
        <div class="results">
            <h2>Results</h2>
            <ul>
                <li><strong>Text 1:</strong> "{{ $inputs[0] }}" - Prediction: {{ $results[0] }}</li>
                <li><strong>Text 2:</strong> "{{ $inputs[1] }}" - Prediction: {{ $results[1] }}</li>
            </ul>
        </div>
        @endif

        <!-- عرض الأخطاء -->
        @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

</body>

</html>


{{-- Text 1: "Congratulations! You've won a $1000 gift card. Claim it now by clicking the link!" - Prediction: spam
Text 2: "Just wanted to check in and see how you're doing" - Prediction: ham --}}
