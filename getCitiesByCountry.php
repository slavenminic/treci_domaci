<?php 

    session_start();
    include "connectDB.php";
    include "databaseFunctions.php";

    if(isset($_GET['country_id'])){
        $country_id = $_GET['country_id'];
    }else{
        echo json_encode([]);
        exit;
    }

    $cities = getCitiesByCountry($country_id);

    $result = [];
    while($city = mysqli_fetch_assoc($cities)){
        $result[] = $city;
    }

    echo json_encode($result);
?>