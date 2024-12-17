<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tic-Tac-Toe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f3f4f6;
            padding: 20px;
        }
        .board {
            display: grid;
            grid-template-columns: repeat(3, 100px);
            grid-gap: 10px;
            justify-content: center;
            margin: 20px auto;
        }
        .cell {
            width: 100px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            background-color: #fff;
            border: 1px solid #ddd;
            cursor: pointer;
        }
        .cell.taken {
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <h1>Tic-Tac-Toe</h1>
    <p>{{ $message }}</p>
    <div class="board">
        @foreach($board as $index => $cell)
            <form method="POST" action="{{ route('tic-tac-toe.move') }}" style="display: inline;">
                @csrf
                <input type="hidden" name="position" value="{{ $index }}">
                <button class="cell {{ $cell != '-' ? 'taken' : '' }}" {{ $cell != '-' ? 'disabled' : '' }}>
                    {{ $cell }}
                </button>
            </form>
        @endforeach
    </div>

    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form method="GET" action="{{ route('tic-tac-toe.index') }}" style="margin-top: 20px;">
        @csrf
        <button type="submit" class="btn" style="padding: 10px 20px; font-size: 16px;">Start New Game</button>
    </form>
</body>
</html>
