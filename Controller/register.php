<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

include_once('../model/User.php');

if (isset($_POST['submit'])) {
            
    $user = new User();

    $validUser = true;
    $message = '';
    if ($user->getUserByEmail($_POST['email'])) {
        
        $message = 'This email is already register';
        $validUser = false;
    }

    if ($user->getUserByUsername($_POST['username'])) {   
        $message = 'This username is already taken, choose another';
        $validUser = false;
    }    
    
    if (!$validUser) {
        foreach ($_POST as $key => $postData) {
            $_SESSION[$key] = $postData;
        }

        header('location: http://localhost/CRUD/index.php?rmessage=' . $message);
    } else {
        $user->setFName($_POST['fname']);
        $user->setLName($_POST['lname']);
        $user->setUserName($_POST['username']);
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
    
      
        $user->save();
        //echo "success";
    
        
        header('location: http://localhost/CRUD/index.php');   
    }
} 




