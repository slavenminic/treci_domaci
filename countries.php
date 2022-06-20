<?php
    session_start();
    include "connectDB.php";
    include "databaseFunctions.php";

    if(!$_SESSION['loggedIn']){
        header("location:login.php");
        exit;
    }

    $searchTerm = "";
    if(isset($_GET["searchName"]) && $_GET["searchName"] !== ""){
        $searchTerm = $_GET["searchName"];
        $sql = "SELECT * FROM countries WHERE lower(name) like '%$searchTerm%' ORDER BY name";
        $countries = mysqli_query($db_connection,$sql);
    } 
    else {
        $countries = getCountries();
    }
        
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Countries</title>
</head>
<body>
    <?php include './navbar.php' ?>
    <h1 class="text-center mt-3">Available countries</h1>
    <form action="countries.php" method="GET" class="mt-3 container row col-4 offset-8">
        <input type="text"  name="searchName" value="<?=$searchTerm?>" placeholder="enter the country name" class="form-control my-3">
    </form>
    <div class="container row col-8 offset-2">
 
    <table class="table ">
        <thead>
            <tr>
                <th>Država</th>
                <th>Izmijeni</th>
                <th>Obriši</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                while($country = mysqli_fetch_assoc($countries)){
                    $countryId = $country['id'];
                    $countryName = $country['name'];
                    echo "<tr>
                    <td>$countryName</td>
                    <td><a class='btn btn-primary' href='./editCountry.php?id=$countryId'>Izmijeni</a></td>
                    <td>
                    <button type='button'class='btn btn-danger' onclick=\"deleteCountry('$countryName',$countryId)\" class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#exampleModal'>
                    Delete country
                    </button>
                    </td>
                    </tr>";
                    
                    
                }
            ?>
        </tbody>
        
        
    </table>
</div>
    <a href="./addCountry.php" class="btn btn-primary row col-2 offset-2 mt-3">Add Country</a>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Country</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <span id="countryToDelete"></span>?</p> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="./deleteCountry.php" method="POST">
                        <input type="hidden" name="countryId" id="countryIdToDelete" value="">
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