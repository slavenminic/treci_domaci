<?php
    session_start();
    include "connectDB.php";
    include "databaseFunctions.php";

    if(!$_SESSION['loggedIn']){
        header("location:login.php");
        exit;
    }

    $id = $_POST['cityId'];
    $sql = "UPDATE contacts SET city_id =NULL where city_id = $id;
            DELETE FROM cities WHERE id = $id;"; 
    mysqli_multi_query($db_connection, $sql);
    header("location:./cities.php");
?>