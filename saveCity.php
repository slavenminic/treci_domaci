<?php
  session_start();
  include "connectDB.php";
  include "databaseFunctions.php";

  if(!$_SESSION['loggedIn']){
      header("location:login.php");
      exit;
  }

  $country_id = $_POST['country'];
  $city_name = $_POST['city_name'];
  if(!$country_id || !$city_name){
    header("location:./cities.php?error=something_is_wrong");
    exit;
  }
  $sql = "INSERT INTO cities (name,country_id) VALUES ('$city_name',$country_id)";
  mysqli_query($db_connection, $sql);
  header("location:./cities.php");
?>