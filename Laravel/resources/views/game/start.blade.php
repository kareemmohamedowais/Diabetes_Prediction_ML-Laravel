<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start Game</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f3f4f6;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        input {
            padding: 10px;
            font-size: 16px;
            width: 50%;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>{{ $message }}</h1>
    <p>Remaining Chances: <strong>{{ $remaining_chances }}</strong></p>
    <form action="{{ route('game.guess') }}" method="POST">
        @csrf
        <input type="number" name="guess" placeholder="Enter your guess (1-100)" required>
        <button type="submit">Submit Guess</button>
    </form>
</body>
</html>
