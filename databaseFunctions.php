<?php 

    // CRUD methods for phonebook

    function getContactsFromDatabase($searchTerm = ""){
        global $db_connection;
        $user_id = $_SESSION['user']['id'];
        $sql = "SELECT  
                    contacts.id,
                    contacts.first_name,
                    contacts.last_name,
                    contacts.email,
                    cities.name as city_name,
                    countries.name as country_name
                    FROM `contacts`,cities,countries 
                    where contacts.city_id = cities.id 
                    and cities.country_id = countries.id 
                    and user_id = $user_id";

        if($searchTerm != ""){
            $term = strtolower($searchTerm);
            $sql .= " AND lower(first_name) like '%$term%' OR lower(last_name) like '%$term%' ";
        }

        $res = mysqli_query($db_connection, $sql);

        $contacts = [];
        while($contact = mysqli_fetch_assoc($res)){
            $contacts[] = $contact;
        }

        return $contacts;
    }

    function saveContactToDatabase($first_name, $last_name, $email, $user_id, $city_id){
        global $db_connection;
        $sql = "INSERT INTO contacts (first_name, last_name, email, user_id, city_id) 
                VALUES ('$first_name', '$last_name', '$email', $user_id, $city_id)
                ";
        return mysqli_query($db_connection, $sql);
    }

    function findContactById($id){
        global $db_connection;
        $sql = "SELECT contacts.*, countries.id as country_id 
                FROM contacts,cities,countries 
                WHERE contacts.id = $id
                AND contacts.city_id = cities.id
                AND countries.id = cities.country_id
                ";
        $res = mysqli_query($db_connection, $sql);

        return mysqli_fetch_assoc($res);
    }

    function updateContact($first_name, $last_name, $email, $id, $city_id){
        global $db_connection;
        $sql = "UPDATE contacts SET 
                first_name = '$first_name', 
                last_name = '$last_name', 
                email = '$email',  
                city_id = $city_id
            WHERE id = $id ";
        return mysqli_query($db_connection, $sql);
    }

    function deleteContact($id){
        global $db_connection;
        $sql = "DELETE FROM contacts WHERE id = $id";
        return mysqli_query($db_connection, $sql);
    }

    function findUserByUsernameAndPassword($username, $password){
        global $db_connection;
        $sql = "SELECT * FROM users 
                    WHERE username = '$username' 
                    AND `password` = '$password' 
                ";
        $res = mysqli_query($db_connection, $sql);
        return mysqli_fetch_assoc($res);
    }

    function getCountries(){
        global $db_connection;
        $sql = "SELECT * FROM countries ORDER BY name";
        return mysqli_query($db_connection, $sql);
    }

    function getCitiesByCountry($country_id){
        global $db_connection;
        $sql = "SELECT * FROM cities WHERE country_id = $country_id ORDER BY name";
        return mysqli_query($db_connection, $sql);
    }
?>