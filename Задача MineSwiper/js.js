document.addEventListener('DOMContentLoaded', e => {

    const mw = document.querySelector('.mw');
    const width = 12;
    const height = 12;
    const bombCount = 5;
    let bombMap = [];
    let bombNum = [];
    let bombCell = [];

    let createBombs = (startX, startY) => {
        let count = 0;
        bombMap = [];
        bombNum = [];

        for (let y = 0; y < width; y++) {
            let row = []
            let rowNum = []
            for (let x = 0; x < height; x++) {
                row.push(0)
                rowNum.push(0)
            }
            bombMap.push(row)
            bombNum.push(rowNum)

        }
        for (let i = 0; i < bombCount; i++) {
            let randX = Math.round(Math.random() * (width - 1));
            let randY = Math.round(Math.random() * (height - 1));
            while (bombMap[randY][randX] || (startX === randX && startY === randY)) {
                randX = Math.round(Math.random() * (width - 1));
                randY = Math.round(Math.random() * (height - 1));
            }
            bombMap[randY][randX] = 1;
        }
        for (let y = 0; y < width; y++) {
            for (let x = 0; x < height; x++) {
                if (bombMap[y][x]) {
                    if (x > 0) {
                        bombNum[y][x - 1]++;
                    }
                    if (x < width - 1) {
                        bombNum[y][x + 1]++;
                    }
                    if (y > 0) {
                        bombNum[y - 1][x]++;
                    }
                    if (y < height - 1) {
                        bombNum[y + 1][x]++;
                    }
                    if (y < height - 1 && x < width - 1) {
                        bombNum[y + 1][x + 1]++;
                    }
                    if (x > 0 && y > 0) {
                        bombNum[y - 1][x - 1]++;
                    }
                    if (y > 0 && x < width - 1) {
                        bombNum[y - 1][x + 1]++;
                    }
                    if (y < height - 1 && x > 0) {
                        bombNum[y + 1][x - 1]++;
                    }
                }
            }
        }


    }


    mw.style.setProperty('--columns-count', width);
    for (let y = 0; y < width; y++) {
        bombCell.push([])
        for (let x = 0; x < height; x++) {
            let mwCell = document.createElement('div');
            mwCell.tabIndex = 0
            mwCell.className = 'mw-cell';
            mwCell.x = x;
            mwCell.y = y;
            // mwCell.classList.add('mw-cell--bomb')
            bombCell[y][x] = mwCell

            mw.append(mwCell);

        }
    }
    bombCell[0][0].focus()
    let openCell = (cell, check) => {
        if (cell.classList.contains('mw-cell--open')) {
            return;
        }
        let x = cell.x;
        let y = cell.y;
        cell.classList.add('mw-cell--open');
        if (!check && bombMap[y][x]) {
            cell.classList.add("mw-cell--bomb")
            window.location.reload();
        }
        else if (!check && bombNum[y][x]) {
            cell.textContent = bombNum[y][x]
        }
        else {
            if (x > 0) {
                openCell(bombCell[y][x - 1])
            }
            if (x < width - 1) {
                openCell(bombCell[y][x + 1])
            }
            if (y > 0) {
                openCell(bombCell[y - 1][x])
            }
            if (y < height - 1) {
                openCell(bombCell[y + 1][x])
            }
            if (y < height - 1 && x < width - 1) {
                openCell(bombCell[y + 1][x + 1])
            }
            if (x > 0 && y > 0) {
                openCell(bombCell[y - 1][x - 1])
            }
            if (y > 0 && x < width - 1) {
                openCell(bombCell[y - 1][x + 1])
            }
            if (y < height - 1 && x > 0) {
                openCell(bombCell[y + 1][x - 1])
            }
        }
    }
    let gameStarted = false;


    let cellInteract = (e) => {
        const t = e.target;
        if (t.classList.contains('mw-cell')) {
            if (!gameStarted) {
                startGame(e);
            }
            openCell(t, false);
            console.log(t.x, t.y);
        }

    }
    let arrowNavigate = (e, m_to_x, m_to_y) => {
        const t = e.target;
        x = t.x
        y = t.y
        bombCell[y + m_to_y][x + m_to_x].focus()
    }
    let placeMark = e => {
        const t = e.target
        x = t.x
        y = t.y
        bombCell[y][x].classList.toggle("mw-cell--mark")
    }
    mw.addEventListener('mousedown', e => {
        t = e.target
        if (t.classList.contains('mw-cell')) {
            if (e.button === 2) {
                console.log("2 but")
                placeMark(e)
            } else {
                cellInteract(e)
            }
        }
    });
    mw.addEventListener('keydown', e => {
        const t = e.target
        switch (e.key) {
            case "Enter":
            case "Space":
                if (e.ctrlKey && !t.classList.contains("mw-cell--open")) {
                    placeMark(e)

                } else {
                    console.log("Okett")
                    cellInteract(e)
                }
                break;

            case "Down":
            case "ArrowDown":
                if (t.y < height - 1) {
                    arrowNavigate(e, 0, 1)
                }
                break;
            case "Up":
            case "ArrowUp":
                if (t.y > 0) {
                    arrowNavigate(e, 0, -1)
                }
                break;
            case "Left":
            case "ArrowLeft":
                if (t.x > 0) {
                    arrowNavigate(e, -1, 0)
                }
                break;
            case "Right":
            case "ArrowRight":
                if (t.x < width - 1) arrowNavigate(e, 1, 0)
                break;
        }

    });

    let startGame = (e) => {
        gameStarted = true;
        t = e.target
        createBombs(t.x, t.y);
        console.log(bombMap)
    };
});