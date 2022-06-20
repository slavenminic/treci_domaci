<?php 

    include "connectDB.php";
    include "databaseFunctions.php";

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $city_id = $_POST['city_id'];
    $id = $_POST['id'];

    updateContact($first_name, $last_name, $email, $id, $city_id);

    header('location:index.php');
?>