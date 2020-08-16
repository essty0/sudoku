<?php
// Start the session
session_start();
require_once('../db/connect.php');
require_once("../RedBean/rb-mysql.php");

$data = $_POST;
$min = (int) $data['mins'];
$sec = (int) $data['secs'];

// Check if user authorized in
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $dbEmail = R::findOne("users", ' email = ?', [$email]);
    $date = date("j/n/Y");
    $game = R::dispense('games'); // prepare object for game data
    $game->user_id = $dbEmail['id'];
    $game->time = $min . ":" . $sec;
    $game->date = $date;
    $res = R::store($game);
    if($res){
        $result = 3;
    }
     
} else {
    $_SESSION['time'] = $min . ":" . $sec;
    $result = 2;
    
}
echo json_encode($result);

?>
