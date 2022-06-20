<?php
    session_start();
    include "connectDB.php";
    include "databaseFunctions.php";

    if(!$_SESSION['loggedIn']){
        header("location:login.php");
        exit;
    }
  
    $country = $_POST['country'];
    $id = $_POST['id'];

    $sql = "UPDATE countries SET name = '$country' WHERE id = $id ";
    mysqli_query($db_connection, $sql);

    header('location:./countries.php');
?>