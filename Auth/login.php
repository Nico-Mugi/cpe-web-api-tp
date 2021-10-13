<?php
include '../Models/DatabaseDriver.php';
session_start();

if (isset($_POST['log_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $errors = array();
    $dbd = new DatabaseDriver;
    $db_pass = $dbd->getUserPassword($username);
    if(empty($db_pass)){
        array_push($errors, "Username not found");
        var_dump($errors);
        $_POST['errors'] = $errors;
        header("Location: /test/connexion.html");
        exit();
    }else{
        if(password_verify($password, $db_pass[0]['password'])){
            $_SESSION['username'] = $username;
  	        $_SESSION['success'] = "You are now logged in";
            header("Location: /test");
            exit();
        }
        else{
            array_push($errors, "Wrong password");
            var_dump($errors);
            $_POST['errors'] = $errors;
            header("Location: /test/connexion.html");
            exit();
        }
    }
}

print_r('test');
?>