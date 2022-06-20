<?php 

    include "connectDB.php";
    include "databaseFunctions.php";

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }else{
        header("location:index.php");
    }

    deleteContact($id);
    
    header("location:index.php");

?>