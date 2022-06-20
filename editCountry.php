<?php
    session_start();
    include "connectDB.php";
    include "databaseFunctions.php";

    if(!$_SESSION['loggedIn']){
        header("location:login.php");
        exit;
    }
    if(isset($_GET['id'])){
        $countryId = $_GET['id'];
        $sql = "SELECT name FROM countries WHERE id=$countryId";
        $result = mysqli_query($db_connection,$sql);
        $array = mysqli_fetch_assoc($result);
        $countryName = $array["name"];
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
    <form action="./updateCountry.php" method="POST" class="form contianer">
        <label for="country" class="form-label">Edit country name:</label>
        <input type="text" required name="country" value="<?=$countryName ?>" id="country" class="form-control">
        <input type="hidden" value=<?= $countryId?> name="id">
        <button class="btn btn-success">Confirm edit</button>
    </form>
</body>
</html>