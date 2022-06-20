<?php
    session_start();
    include "connectDB.php";
    include "databaseFunctions.php";

    if(!$_SESSION['loggedIn']){
        header("location:login.php");
        exit;
    }

    $id = $_POST['countryId'];
    $sql = "UPDATE contacts SET city_id = NULL where city_id IN
            (SELECT cities.id FROM cities WHERE country_id = $id );
            DELETE FROM cities WHERE country_id = $id; 
            DELETE FROM countries where id = $id";
    mysqli_multi_query($db_connection, $sql);
    header("location:countries.php");
?>