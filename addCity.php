<?php
    session_start();
    include "connectDB.php";
    include "databaseFunctions.php";

    if(!$_SESSION['loggedIn']){
        header("location:login.php");
        exit;
    }
    $sql = "SELECT * FROM countries";
    $countries = mysqli_query($db_connection,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Add City</title>
</head>
<body>
    <?php include "./navbar.php"?>
    <h1 class="text-center">Adding City</h1>
    <div class="container">
        <form class="form" action="./saveCity.php" method="POST">
            <label for="city" class="form-label ">Add City:</label>
            <input type="text" name="city_name" class="form-control" placeholder="City name" id="city" required>
            <label for="country" class="form-lable">Select country</label>
            <select name='country' required id="country" class="form-control">

            <?php 
                while($country = mysqli_fetch_assoc($countries)){
                    $name = $country["name"];
                    $id = $country["id"];
                    echo "<option value=\"$id\" >$name</option>";
                    }
            ?>
            </select>
            
            <button class="btn btn-success mt-3">Add City</button>
        </form>
    </div>
</body>
</html>