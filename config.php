<?php
    /*
    Initialized Session variable with the values of currapi hidden input.
    if(isset($_GET['activateapi'])){
        session_start();
        $_SESSION['currapi'] = filter_input(INPUT_GET, 'currapi', FILTER_SANITIZE_SPECIAL_CHARS);
        header("Location: events.php");
    }
    */

    //Access database
    $dbhost="localhost";
    $dbuser="root";
    $dbpass="";
    $dbname="test";

    $conn = mysqli_connect($dbhost,$dbuser,$dbpass);
    mysqli_select_db($conn, $dbname);
 
    if(!$conn){
       die('Could not connect to MySQL: ' . mysqli_error());
    }

