<?php
session_start();
include_once('../model/User.php');

if (isset($_POST['login'])) {

    $user = new User();

    $password = md5($_POST['login-password']);
    $message = '';
    
    if($user->loginUser($_POST['login-email'], $password)){
        header('location: http://localhost/CRUD/view/home.php');
    }
    else {
        $message = "Credentail is wrong";
        header('location: http://localhost/CRUD/index.php?message=' . $message);
    }  
}
else{
    header('location: http://localhost/CRUD/index.php'); 
}

?>