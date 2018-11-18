<?php 
    // Here we must enter variables for connection to database
    $servername = "localhost";
    $username = "root";
    $password= "";
    $dbname = "quiz";

    $conn = new mysqli($servername,$username,$password,$dbname); 
    if($conn->connect_error){
        die($conn->connect_error); }
    $conn -> set_charset("UTF8") or die("Spatne kodovani!");
?>