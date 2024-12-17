<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game State</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(5, 50px);
            gap: 5px;
            margin: 20px;
        }
        .cell {
            width: 50px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            border: 1px solid #ccc;
        }
        .reward { background-color: lightgreen; }
        .penalty { background-color: lightcoral; }
        .goal { background-color: gold; }
        .player { background-color: skyblue; }
        .empty { background-color: white; }
        button {
            margin-top: 20px;
            padding: 10px 15px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <h1>Treasure Collection Game</h1>
    <div id="game-board" class="grid"></div>

    <div>
        <button onclick="moveAgent('up')">Move Up</button>
        <button onclick="moveAgent('down')">Move Down</button>
        <button onclick="moveAgent('left')">Move Left</button>
        <button onclick="moveAgent('right')">Move Right</button>
    </div>

    <script>
        let gameState = @json($game_state); // Data passed from Laravel controller

        // Function to render the game grid
        function renderGrid() {
            const gridContainer = document.getElementById('game-board');
            gridContainer.innerHTML = ''; // Clear the grid

            // Loop through the grid and create cells
            for (let i = 0; i < gameState.grid.length; i++) {
                for (let j = 0; j < gameState.grid[i].length; j++) {
                    const cell = document.createElement('div');
                    cell.classList.add('cell');

                    // Add styles based on grid content
                    if (gameState.grid[i][j] === '1') {
                        cell.classList.add('reward');
                        cell.textContent = '+1';
                    } else if (gameState.grid[i][j] === '-1') {
                        cell.classList.add('penalty');
                        cell.textContent = '-1';
                    } else if (gameState.grid[i][j] === 'G') {
                        cell.classList.add('goal');
                        cell.textContent = 'G';
                    } else if (gameState.grid[i][j] === 'X') {
                        cell.classList.add('player');
                        cell.textContent = 'P';
                    } else {
                        cell.classList.add('empty');
                    }

                    gridContainer.appendChild(cell);
                }
            }
        }

        // Function to move the agent
        function moveAgent(direction) {
            fetch('/move', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ direction: direction }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                } else {
                    gameState.agent_position = data.agent_position;
                    renderGrid();
                }
            })
            .catch(error => console.error('Error:', error));
        }

        // Initial grid render
        renderGrid();
    </script>
</body>
</html>
