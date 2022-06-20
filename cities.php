<?php
    session_start();
    include "connectDB.php";
    include "databaseFunctions.php";

    if(!$_SESSION['loggedIn']){
        header("location:login.php");
        exit;
    }

    $sql = "SELECT cities.id, cities.name as city, countries.name as country 
            FROM cities 
            INNER JOIN countries on countries.id=cities.country_id ";
    
    $searchTerm = "";
    if(isset($_GET["searchName"]) && $_GET["searchName"] !== ""){
        $searchTerm = $_GET["searchName"];
        $sql.= "WHERE lower(cities.name) like '%$searchTerm%' ORDER BY cities.name";
    } 
    $cities = mysqli_query($db_connection,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Cities</title>
</head>
<body>
    <?php  include './navbar.php'?>
    <h1 class="text-center">Cities</h1>
    <form action="./cities.php" class="row col-2 offset-8">
        <input type="text" name="searchName" placeholder="search for city" value="<?=$searchTerm?>">
    </form>
    <div class="contianer row col-8 offset-2">
        <table class="table">
            <thead>
                <tr>
                    <td>Grad</td>
                    <td>Drzava</td>
                    <td>Izmijeni</td>
                    <td>Obrisi</td>
                </tr>
            </thead>
            <tbody>
                <?php while($city = mysqli_fetch_assoc($cities)){
                    $city_name = $city["city"];
                    $country = $city["country"];
                    $id = $city["id"];
                    echo "<tr>
                            <td>$city_name</td>
                            <td>$country</td>
                            <td><a class='btn btn-primary' href='./editCity.php?id=$id'>Izmijeni</a></td>
                            <td>
                                <button type='button'class='btn btn-danger' onclick=\"deleteCity('$city_name','$country',$id)\" class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#exampleModal'>
                                Delete City
                                </button>
                            </td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <a href="./addCity.php" class="btn btn-primary row col-2 offset-2 mt-3">Add City</a>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete City</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <span id="cityToDelete"></span> from <span id="countryName"></span>?</p> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="./deleteCity.php" method="POST">
                        <input type="hidden" name="cityId" id="cityIdToDelete" value="">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>