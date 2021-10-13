<?php
include '../Models/DatabaseDriver.php';

print_r($_POST);

if (isset($_POST['reg_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $errors = array();
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password)) { array_push($errors, "Password is required"); }

    if(empty($errors)){
        $dbd = new DatabaseDriver;
        $code_err = $dbd->insertUser($username,password_hash($password,PASSWORD_BCRYPT),$email);
        if($code_err ==-1){
            array_push($errors, "Failed to register user");
            error_log($errors);
            return $errors;
        }else{
            return "User sucessfully registered , please log in";
        }
    }
}

header('Location: index.php')
?>