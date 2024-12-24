<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ecommerce Detection categories</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            background-color: #f7f7f7;
            padding: 20px;
            border-radius: 8px;
            max-width: 400px;
            margin: 0 auto;
        }
        label {
            font-weight: bold;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .results {
            margin-top: 20px;
            padding: 15px;
            background-color: #f0f0f0;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <h1>ecommerce category Detection</h1>

    <!-- نموذج الإدخال -->
    <form method="POST" action="{{ route('detect-ecommerce') }}">
        @csrf
        <label for="text1">Text 1:</label>
        <input type="text" id="text1" name="text1" value="{{ old('text1') }}" required>
        <br><br>
        <label for="text2">Text 2:</label>
        <input type="text" id="text2" name="text2" value="{{ old('text2') }}" required>
        <br><br>
        <button type="submit">Detect category</button>
    </form>

    <!-- عرض النتائج -->
    @if (isset($results))
        <div class="results">
            <h2>Results</h2>
            <ul>
                <li><strong>Text 1:</strong> - Prediction: {{ $results[0] }}</li>
                <li><strong>Text 2:</strong> - Prediction: {{ $results[1] }}</li>
            </ul>
        </div>
    @endif

    <!-- عرض الأخطاء -->
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>


{{-- Incredible Gifts India Wooden Happy Birthday Unique Personalized Gift (5 X 4 Inch) Size:4 x 5   Made Of Natural Imported Wood, Which Is Quite Solid With Light Particle Pattern & Is Soft Pale To Blond Colour. Your Uploaded Photo Will Look Amazing And Beautiful After Laser Engraving On It. This Is One Of The Most Popular Unique Gifts In Our Store. We Offer This In Multiple Sizes, Some Can Be Used As Table Top And The Big Sizes Can Be Used As Wall Hanging Which Just Blends With Your Home Decaration. You Just Need To Upload A Picture And Add Your Own Text And We Will Do The Rest For You. We Will Email You The Preview Before Making The Final Product. Do You Want The Best Moment Of Your Life To Be Engraved On A Wooden Plaque That Lasts For A Longer Time And Stays Close To You Forever? Then You Are At The Right Place. We Present To You Various Sizes Personalized Engraved Wooden Plaques Made With Birch Wood. Let Your Memories Be Engraved On Wooden Plaques And Stay With Your Forever. --}}
{{-- Siddeshwary Fab women's Bangalore Silk Anrkali Gown (semi stitched_free Size) This Coral Maroon red and blue bodice floor length Bangalore Silk anarkali has semi stitched kalis and black BangaloreSilk bodice with sequinned full sleeves. It has a V neck Includes with Embroidery Work on all sides; Front Neck - 8 inches; Back Neck -12 inches; Anarkali Length - 57 inches. Chest size is 44 inches. Fabric: Bangalore Silk, Embroidery work is on the Bangalore Silk fabric with floral pattern. its size adjustable as S to XXL and alteration is require in this gown is also warble as long anarkali dress --}}
