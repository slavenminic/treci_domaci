<?php 

    session_start();
    include "connectDB.php";
    include "databaseFunctions.php";

    $username = $_POST['username'];
    $password = $_POST['password'];

    if($user = findUserByUsernameAndPassword($username, $password)){
        $_SESSION['loggedIn'] = true;
        $_SESSION['user'] = $user;

        header("location:index.php?msg=welcome");
        exit;
    }

    header("location:login.php?msg=wrongCredentials");
    exit;
?>