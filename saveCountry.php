<?php
  session_start();
  include "connectDB.php";
  include "databaseFunctions.php";

  if(!$_SESSION['loggedIn']){
      header("location:login.php");
      exit;
  }

  $country_name = $_POST['country_name'];
  if(!$country_name){
    header("location:./countries.php?error=name_missing");
    exit;
  }
  $sql = "INSERT INTO countries (name) VALUES ('$country_name')";
  mysqli_query($db_connection, $sql);
  header("location:./countries.php");
?>