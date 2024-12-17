<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maze Escape Game</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #ff7e5f, #feb47b); /* تدرج لوني جميل */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            color: white;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        p {
            font-size: 1rem;
            margin-bottom: 40px;
        }

        /* تصميم الماز */
        .maze {
            display: grid;
            grid-template-columns: repeat(5, 60px);
            grid-template-rows: repeat(5, 60px);
            gap: 5px;
            margin-bottom: 30px;
            margin-left: 120px;
        }

        .cell {
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.2rem;
            border-radius: 10px;
            transition: background-color 0.3s, transform 0.3s;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .wall {
            background-color: #343a40;
        }

        .path {
            background-color: #fff;
            color: #333;
        }

        .player {
            background-color: #4caf50;
            color: white;
            font-weight: bold;
        }

        .start {
            background-color: #ff9800;
            color: white;
        }

        .goal {
            background-color: #f44336;
            color: white;
        }

        .cell:hover {
            transform: scale(1.1);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.7);
        }

        /* أزرار التحكم */
        .controls {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .controls button {
            background-color: #2196f3;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .controls button:hover {
            background-color: #0d47a1;
        }

        .controls button:active {
            transform: scale(0.98);
        }

        #message {
            font-size: 1.2rem;
            color: #fff;
            margin-top: 20px;
        }

        #restart-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #8bc34a;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #restart-button:hover {
            background-color: #4caf50;
        }
    </style>
</head>
<body>
    <div>
        <h1>Welcome to the Maze Escape Game!</h1>
        <p>You are the "P" and need to reach the "G".</p>

        <!-- عرض الماز -->
        <div class="maze">
            @foreach ($maze as $i => $row)
                @foreach ($row as $j => $cell)
                    @php
                        $position = [$i, $j];
                        $class = '';
                        if ($position == $player_position) {
                            $class = 'player';
                        } elseif ($position == $start) {
                            $class = 'start';
                        } elseif ($position == $goal) {
                            $class = 'goal';
                        } elseif ($cell == 1) {
                            $class = 'wall';
                        } else {
                            $class = 'path';
                        }
                    @endphp
                    <div class="cell {{ $class }}"></div>
                @endforeach
            @endforeach
        </div>

        <!-- أزرار التحرك -->
        <div class="controls">
            <button onclick="move('up')">Up</button>
            <button onclick="move('down')">Down</button>
            <button onclick="move('left')">Left</button>
            <button onclick="move('right')">Right</button>
        </div>

        <!-- زر إعادة التشغيل -->
        <button id="restart-button" onclick="restartGame()">Restart</button>
        <div id="message"></div>
    </div>

    <script>
        function move(direction) {
            fetch('/move', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ direction: direction })
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    document.getElementById('message').innerText = data.error;
                } else {
                    document.getElementById('message').innerText = data.status === 'won' ? 'Congratulations, you won!' : 'Moving...';
                    document.querySelector('.maze').innerHTML = data.maze.map((row, i) => {
                        return row.map((cell, j) => {
                            let position = [i, j];
                            let className = position.toString() === data.player_position.toString() ? 'player' :
                                            position.toString() === [0, 0].toString() ? 'start' :
                                            position.toString() === [4, 4].toString() ? 'goal' :
                                            cell === 1 ? 'wall' : 'path';
                            return `<div class="cell ${className}"></div>`;
                        }).join('');
                    }).join('');
                }
            });
        }

        function restartGame() {
            fetch('/restart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'moving') {
                    document.getElementById('message').innerText = '';
                    document.querySelector('.maze').innerHTML = data.maze.map((row, i) => {
                        return row.map((cell, j) => {
                            let position = [i, j];
                            let className = position.toString() === data.player_position.toString() ? 'player' :
                                            position.toString() === [0, 0].toString() ? 'start' :
                                            position.toString() === [4, 4].toString() ? 'goal' :
                                            cell === 1 ? 'wall' : 'path';
                            return `<div class="cell ${className}"></div>`;
                        }).join('');
                    }).join('');
                }
            });
        }
    </script>
</body>
</html>
