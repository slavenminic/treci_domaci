<?php 

    session_start();
    include "connectDB.php";
    include "databaseFunctions.php";

    // superglobals, $_POST, $_GET, $_SERVER
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $city_id = $_POST['city_id'];

    $user_id = $_SESSION['user']['id'];

    saveContactToDatabase($first_name, $last_name, $email, $user_id, $city_id);
    
    header("location:./index.php");
?>