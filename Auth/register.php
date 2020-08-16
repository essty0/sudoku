<?php
// Start the session
session_start();

require_once("../RedBean/rb-mysql.php");
require_once('../db/connect.php');

$data = $_POST;

// Check if email valid
function isEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}


$error = [];

if ($data['email'] === "") {
    $error[] = 'EZle email! Skúste to, prosím, znova';
}

if (!isEmail($data['email'])) {
    $error[] = 'Zle email! Skúste to, prosím, znova';
}

if ($data['password'] === "") {
    $error[] = 'Zle heslo!!! Skúste to, prosím, znova';
}


if (empty($error)) {
    // check if email already in DB
    $email = trim($data['email']);
    $dbEmail = R::findOne("users", ' email = ?', [$email]);
    if (empty($dbEmail)) {
        $pass = md5($data['password']);

        $user = R::dispense('users');
        $user->email = $email;
        $user->password = $pass;
        $userId = R::store($user); // add user data to bd. user_id returns
    
        $game = R::dispense('games'); // prepare object for game data
        $game->user_id = $userId;
        $game->time = null;

        R::store($game);
        $_SESSION['login'] = $email;
        echo 'Registrácia dokončená! Môžete sa prihlásiť :)';

    } else {
        echo 'Tento e-mail je už registrovaný!';
    }

} else echo array_shift($error);


?>


