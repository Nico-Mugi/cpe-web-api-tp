<?php
include 'Models/DatabaseDriver.php';
session_start();

if (isset($_POST['log_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $errors = array();
    $dbd = new DatabaseDriver;
    $db_pass = $dbd->getUserPassword($username);

    if(empty($db_pass)){
        array_push($errors, "Username not found");
        return $errors;
    }else{
        if($db_pass==password_hash($db_pass[0]['password'],PASSWORD_BCRYPT)){
            $_SESSION['username'] = $username;
  	        $_SESSION['success'] = "You are now logged in";
        }
    }
}




?>