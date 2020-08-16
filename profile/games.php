<?php
session_start();

require_once("../RedBean/rb-mysql.php");
require_once('../db/connect.php');

// Display results of previous games in profile
function showGames()
{
    $email = trim($_SESSION['login']);
    $dbEmail = R::getAll("SELECT * FROM users WHERE email = '$email'");
    if (!empty($dbEmail)) {
        $user_id = $dbEmail[0]['id'];
        $games = R::getAll("SELECT * FROM games WHERE `user_id` = '$user_id'");
        if (!empty($games)) {
            echo "<table class='games'>";
            echo "<thead><tr>
                <td>#</td>
                <td>Cas hry</td>
                <td>Data hry</td>
                </tr></thead>";
            $count = 1;
            foreach ($games as $game) {
                echo "<tr>
                <td>" . $count . "</td>";
                echo "<td>" . $game['time'] . "</td>";
                echo "<td>" . $game['data'] . "</td>";
                echo "</tr>";
                $count++;
            }
            echo "</table>";
        } else {
            echo "No games yet!";
        }
    }
}
