<?php 

// file functions for "CRUD" 
function getContactsFromFile($filename = "database.json"){
    $rawData = file_get_contents($filename);
    if($rawData == "") $rawData = "[]";

    $user_id = $_SESSION['user']['id'];
    $contacts = json_decode($rawData, true);
    // $res = array_filter($contacts, function($c) use($user_id){
    //     $c['user_id'] == $user_id;
    // });
    $res = [];
    foreach($contacts as $c){
        if($c['user_id'] == $user_id) $res[] = $c;
    }
    return $res;
}

function getUsersFromFile($filename = "users.json"){
    $rawData = file_get_contents($filename);
    if($rawData == "") $rawData = "[]";
    return json_decode($rawData, true);
}

function saveContactsToFile($contacts, $filename = "database.json"){
    file_put_contents($filename, json_encode($contacts));
}

function filterContacts($term){
    $term = strtolower($term);
    $contacts = getContactsFromFile();
    $result = [];
    foreach($contacts as $contact){
        $fn = strtolower($contact['first_name']);
        $ln = strtolower($contact['last_name']);
        if( strpos($fn, $term) !== false || strpos($ln, $term) !== false ){
            $result[] = $contact;
        }
    }
    return $result;
}

function findContactById($id){
    $contacts = getContactsFromFile();
    foreach($contacts as $contact){
        if($contact['id'] == $id) return $contact;
    }
    return false;
}

?>