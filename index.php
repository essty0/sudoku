<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hexasudoku game</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.min.css">
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="./css/all.min.css">

    <link rel="shortcut icon" href="./favicon.ico">
    <script>
        function registerForm() {
            $('.log_form').hide()
            $('.reg_form').show()
            $('#reg-link').hide()
            $('#log-link').show()
            $('.error').html('')
        }

        function loginForm() {
            $('.log_form').show()
            $('.reg_form').hide()
            $('#log-link').hide()
            $('#reg-link').show()
            $('.error').html('')
        }
    </script>

</head>

<body>
<div class="container" id="container">
    <div class="wrapper">
        <header>
            <div class="mode">
                <a href="#" onClick="whiteMode()"><i class="far fa-sun"></i></a>
                <a href="#" onClick="darkMode()"><i class="fas fa-moon"></i></a>
            </div>

            <?php if (isset($_SESSION['login']) && !empty($_SESSION['login'])) { ?>
                <div class="userform">
                    <a href="/profile/">Profile</a> <a href="/logout.php">Logout</a>
                </div>

            <?php } else {

                ?>
                <div class="userform">
                    <span id="reg-link" onclick="registerForm()"><i class="fas fa-user-plus"></i> Registrácia</span>
                    <span id="log-link" onclick="loginForm()"><i class="fas fa-sign-in-alt"></i> Prihlásenie</span>
                </div>
            <?php } ?>

            <div class="reg_form">
                <form method="POST" id="register_form" class="userform">
                    <div class="userform_field">
                        <label for="email">Email</label>
                        <input type="email" name="email">
                        <span class="error erroremail"></span>
                    </div>
                    <div class="userform_field">
                        <label for="password">Heslo</label>
                        <input type="password" name="password">
                        <span class="error errorpassword"></span>
                    </div>
                    <div class="userform_field userform_field__btn">
                        <button type="submit" id="submit_btn" name="submit">Registrácia</button>
                    </div>

                </form>
                <div id="reg_result"></div>
            </div>
            <div class="log_form">
                <form method="POST" id="login_form" class="userform">
                    <div class="userform_field">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="login_email">
                        <span class="error erroremail"></span>
                    </div>
                    <div class="userform_field">
                        <label for="password">Heslo</label>
                        <input type="password" name="password" id="login_pass">
                        <span class="error errorpassword"></span>
                    </div>
                    <div class="userform_field userform_field__btn">
                        <button type="submit" id="submit_btn" name="submit">Prihlásenie</button>
                    </div>
                </form>
                <div id="log_result"></div>
            </div>
        </header>
    </div>
    <main>
        <h1>Hexasudoku</h1>
        <div class="wrapper wrapper_win">

            <div class="win"></div>
            <div class="win_btn">
                <div class="win_btn__left">
                    <p>Time: <span id="showMin"></span>:<span id="showSec"></span></p>
                    <div class="link" id="saveTm" onclick="saveTime()">Save time</div>
                </div>
                <div class="win_btn__right">
                    <p>Chyby: <span id="showErr"></span>/3</p>
                    <div class="link" onclick="location.reload();">Hrat' znova</div>
                </div>
                <div class="win_btn__result"></div>
            </div>

        </div>
        <div class="timer">
            Time: <span id="minutes">00</span>:<span id="seconds">00</span>
        </div>
        <div class="wa">

            <?php

            include('./tables.php');
            $rnd = rand(0, 2);
            $tablename = $tables[$rnd];
            echo '<div class="table" id="' . $tablename[0] . '">';
            for ($i = 1; $i < count($tablename); $i++) {
                echo '<div class="row">';
                $posElement = 0;
                for ($j = 0; $j < 4; $j++) {

                    for ($k = 0; $k < 4; $k++) {

                        if (is_array($tablename[$i][$j][$k])) {
                            if ($tablename[$i][$j][$k][0] > 9) {
                                echo '<div><b>' . strtoupper($hexa[$tablename[$i][$j][$k][0]]) . '</b></div>';
                            } else
                                echo '<div class="known"><b>' . strtoupper($tablename[$i][$j][$k][0]) . '</b></div>';
                        } else {
                            echo '<div data-sq="' . $i . '" data-col="' . $k . '" data-row="' . $j . '"  class="unknown"></div>';
                        }
                        $posElement++;
                    }
                }
                echo "</div>";
            }

            echo "</div>";


            ?>
        </div>
        <div class="chyba">Chyby: <span id="error">0</span>/3</div>
        <div class="numbers">
            <div value='0' onclick="setNumber(this.getAttribute('value'))" id="num0">0</div>
            <div value="1" onclick="setNumber(this.getAttribute('value'))" id="num1">1</div>
            <div value="2" onclick="setNumber(this.getAttribute('value'))" id="num2">2</div>
            <div value="3" onclick="setNumber(this.getAttribute('value'))" id="num3">3</div>
            <div value="4" onclick="setNumber(this.getAttribute('value'))" id="num4">4</div>
            <div value="5" onclick="setNumber(this.getAttribute('value'))" id="num5">5</div>
            <div value="6" onclick="setNumber(this.getAttribute('value'))" id="num6">6</div>
            <div value="7" onclick="setNumber(this.getAttribute('value'))" id="num7">7</div>
            <div value="8" onclick="setNumber(this.getAttribute('value'))" id="num8">8</div>
            <div value="9" onclick="setNumber(this.getAttribute('value'))" id="num9">9</div>
            <div value="A" onclick="setNumber(this.getAttribute('value'))" id="numA">A</div>
            <div value="B" onclick="setNumber(this.getAttribute('value'))" id="numB">B</div>
            <div value="C" onclick="setNumber(this.getAttribute('value'))" id="numC">C</div>
            <div value="D" onclick="setNumber(this.getAttribute('value'))" id="numD">D</div>
            <div value="E" onclick="setNumber(this.getAttribute('value'))" id="numE">E</div>
            <div value="F" onclick="setNumber(this.getAttribute('value'))" id="numF">F</div>
            <div onclick="editValue()"><i class="fas fa-eraser"></i></div>
        </div>
        <article class="rules">
            <h2>Pravidlá hry:</h2>
            <p>Cieľom hry sudoku je doplniť prázdne políčka hexadecimálnou sústavou čísiel od 0 do F, kde A je 11 a F je
                16.</p>

            <p>Na začiatku dostane hráč čiastočne vyplnenú hru. Vyplnené číslice pomáhajú zistiť, kde treba doplniť
                jednotlivé znaky.</p>
            <p>Pravidlá hry:
            <ol>
                <li>Každá hra sa skladá zo 4x4 oblastí(oddelených hrubšou čiarou), ktoré sú zložené zo 4x4 políčok.</li>
                <li>Každá oblasť môže obsahovať každý znak iba jedenkrát.</li>
                <li>V každom riadku a v každom stĺpci sa môže každý znak vyskytovať iba jeden krát.</li>
            </ol>
            </p>

            <p>Každý hráč má povolené maximálne 3 chyby a vyhráva hru ak vyplní všetky políčka správne.</p>
        </article>
    </main>
    <footer class="wrapper">
        <p> <?= date("Y") ?> Copyright <i class="far fa-copyright"></i> Team II</p>
    </footer>
</div>

<script>
    // Set number into table
    function setNumber(num) {
        let sec = $('#seconds').html()
        let min = $('#minutes').html()
        if (sec === "00" && min === "00") {
            startTimer()
        }
        let currId = $('.table').attr('id')
        const error = $('#error')
        let sel = $('.selected')
        let sq = sel.attr('data-sq')
        let row = sel.attr('data-row')
        let col = sel.attr('data-col')
        let allValues = isEndGame()
        let vals;
        (!allValues) ? vals = 7 : vals = allValues
        if ((sel.html() === "" || sel.hasClass('edited')) && Number(error.html()) < 3) {

            $.post(
                'json.php', {
                    pos: sq + ':' + row + ':' + col,
                    id: currId,
                    value: num,
                    values: vals
                },
                function (data) {
                    if (data == 2) {
                        let val = $('#error')
                        let newVal = Number(error.html()) + 1;
                        alert('Zadal si zlý symbol!')
                        if (newVal === 3) {
                            alert('Koniec hry! Urobil si 3 chyby. Skús to znova nabudúce!')
                            stopTime()
                        }

                        val.html(newVal)
                    } else if (data == 7) {
                        stopTime()
                        let mins = $('#minutes').html()
                        let secs = $('#seconds').html()
                        let err = $('#error').html()
                        $('.win').html('Gratulujem! Túto hru si úspešne zvládol!')
                        $('.win_btn').show();
                        $('#showMin').html(mins)
                        $('#showSec').html(secs)
                        $('#showErr').html(err)

                    } else {

                        if (data == 5) {
                            $('.win').html('Tabulka je naplnená, ale obsahuje errory. Znova ju skontrolujte, prosím!')

                        }
                    }
                }
            )
            sel.html(num)
        }

    }

    function saveTime() {
        let mins = $('#minutes').html()
        let secs = $('#seconds').html()
        $.post(
            'time.php', {
                mins,
                secs

            },
            function (result) {
                if (result == 2) {
                    $('.win_btn__result').html('Tento účet nie je registrovaný. Prosím, zaregistruj sa.')
                }
                if (result == 3) {
                    $('#saveTm').hide()
                    $('.win_btn__result').html('Čas uložený')
                }
            }
        )
    }
</script>

</body>

</html>