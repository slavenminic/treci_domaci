<?php 
    include "connectDB.php";
    include "databaseFunctions.php";

    if(isset($_GET['id'])){
        $contact = findContactById($_GET['id']);
    }else{
        header("location:index.php");
    }
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Phonebook</title>
</head>
<body>
    
    <div class="container">

        <div class="row mt-5">
            <div class="col-8 offset-2">
                <h3>Izmjena detalja kontakta</h3>
                <form action="updateContact.php" method="POST">
                    <input type="hidden" name="id" value="<?=$contact['id']?>">
                    <input type="text" required class="mt-3 form-control" name="first_name" placeholder="Unesite ime..." value="<?=$contact['first_name']?>">
                    <input type="text" required class="mt-3 form-control" name="last_name" placeholder="Unesite prezime..." value="<?=$contact['last_name']?>">
                    <input type="email" required class="mt-3 form-control" name="email" placeholder="Unesite email..." value="<?=$contact['email']?>">
                    
                    <select name="country_id" id="country_id" class="form-control mt-3" onchange="displayCities()">
                        <option value="" selected disabled>- odaberite državu -</option>
                        <?php 
                            $countries = getCountries();
                            while($country = mysqli_fetch_assoc($countries)){
                                $countryId = $country['id'];
                                $countryName = $country['name'];
                                $selected = "";
                                if($countryId == $contact['country_id']){
                                    $selected = "selected";
                                }
                                echo "<option value=\"$countryId\" $selected >$countryName</option>";
                            }
                        ?>
                    </select>

                    <select name="city_id" id="city_id" class="form-control mt-3">
                        <?php 
                        
                            $cities = getCitiesByCountry($contact['country_id']);
                            while($city = mysqli_fetch_assoc($cities)){
                                $cityId = $city['id'];
                                $cityName = $city['name'];
                                $selected = "";
                                if($cityId == $contact['city_id']){
                                    $selected = "selected";
                                }
                                echo "<option value=\"$cityId\" $selected >$cityName</option>";
                            }
                        
                        ?>
                    </select>

                    <button class="btn float-end mt-3 btn-primary">Izmijeni kontakt</button>
                </form>
            </div>
        </div>

    </div>

    <script src="app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
