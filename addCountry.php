<?php
  session_start();
  include "connectDB.php";
  include "databaseFunctions.php";

  if(!$_SESSION['loggedIn']){
      header("location:login.php");
      exit;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Add Country</title>
</head>
<body>
    <h1 class="text-center">Adding country</h1>
    <div class="container">
        <form class="form" action="./saveCountry.php" method="POST">
            <label for="country" class="form-label ">Add Country:</label>
            <input type="text" name="country_name" class="form-control" placeholder="Country name" id="country" required>
            <button class="btn btn-success mt-3">Add country</button>
        </form>
    </div>
</body>
</html>