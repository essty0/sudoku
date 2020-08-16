<?php 
// Start the session
session_start();
require_once('../db/connect.php');
require_once("../RedBean/rb-mysql.php");

$data = $_POST;

function isEmail($email){ 
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// if(isset($data)){
    // echo "auth";
    $error=[];

    if($data['email'] === ""){
        $error[] = 'EZle email! Skúste to, prosím, znova';
    }

    if(!isEmail($data['email'])){
        $error[] = 'Zle email! Skúste to, prosím, znova';
    }

    if($data['password'] === ""){
        $error[] = 'Zle heslo!!! Skúste to, prosím, znova';
    }
    

    if(empty($error)){
        // check if email already in DB
        $email = trim($data['email']);
        $dbEmail =    R::getAll( "SELECT * FROM users WHERE email = '$email'" ); 
        $dbPass = $dbEmail[0]['password'];
        if(md5($data['password']) === $dbPass) { // compare if passwords are equal
            $_SESSION['login'] = $email;
            echo 'success';
        } else {
            echo 'Zle heslo! Skúste to, prosím, znova'; 
            
        }
       
    } else {
        echo array_shift($error);
    }

// }


?>
