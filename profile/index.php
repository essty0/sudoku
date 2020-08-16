<?php
session_start();

require_once("../RedBean/rb-mysql.php");
require_once('../db/connect.php');
require_once('games.php');
$data = $_POST;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile :: Hexasudoku game </title>
    <link rel="stylesheet" href="../css/style.min.css">
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/script.js"></script>
    <link rel="stylesheet" href="../css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../favicon.ico">

</head>

<body>
<div class="container" id="container">
    <div class="wrapper">
        <header>
            <div class="mode">
                <a href="#" onClick="whiteMode()"><i class="far fa-sun"></i></a>
                <a href="#" onClick="darkMode()"><i class="fas fa-moon"></i></a>
            </div>
            <div class="userform" id="profile">
                <a href="/"><i class="fas fa-home"></i> Domov</a> <a href="/logout.php"><i
                            class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </header>
    </div>

    <main class="content">
        <h1>Ahoj, <?= $_SESSION['login']; ?>!</h1>
        <?php showGames(); ?>
    </main>
    <footer class="wrapper">
        <p> <?= date("Y") ?> Copyright <i class="far fa-copyright"></i> Team II</p>
    </footer>
</div>


</body>

</html>