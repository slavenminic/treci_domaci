<?php
    session_start();
    include "connectDB.php";
    include "databaseFunctions.php";

    if(!$_SESSION['loggedIn']){
        header("location:login.php");
        exit;
    }
    if(isset($_GET['id'])){
        $cityId = $_GET['id'];
        $sql = "SELECT * FROM cities WHERE id=$cityId";
        $result = mysqli_query($db_connection,$sql);
        $array = mysqli_fetch_assoc($result);
        $cityName = $array["name"];
        $id = $array["id"];
        $selectedCountryId = $array["country_id"];
    }else{
        header("location:./index.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Edit country</title>
</head>
<body>
    <h1 class="text-center">Edit country</h1>
    <form action="./updateCity.php" method="POST" class="form contianer">
        <label for="city" class="form-label">Edit city name:</label>
        <input type="text" required name="city" value="<?=$cityName?>" id="city" class="form-control">
        <select name="country">
        <?php 
            $sql = "SELECT * FROM countries";
            $countries = mysqli_query($db_connection,$sql);
            while($country = mysqli_fetch_assoc($countries)){
                $name = $country["name"];
                $countryId = $country["id"];
                $selected = "";
                if($countryId == $selectedCountryId){
                    $selected = "selected";
                }
                echo "<option value=\"$countryId\" $selected>$name</option>";
                }
            ?>
        </select>
        <input type="hidden" value=<?= $id?> name="id">
        <button class="btn btn-success">Confirm edit</button>
    </form>
</body>
</html>