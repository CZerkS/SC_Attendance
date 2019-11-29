<?php

    if( isset($_GET['eventcode'])){
        session_start();
        $_SESSION['eventcode'] = filter_input( INPUT_GET, 'eventcode', FILTER_SANITIZE_SPECIAL_CHARS);
        header("Location: events.php");

    }

    $dbhost="localhost";
    $dbuser="root";
    $dbpass="";
    $dbname="testdb";

    $conn = mysqli_connect($dbhost,$dbuser,$dbpass);
    mysqli_select_db( $conn, $dbname);

    if( !$conn ){
       die( 'Could not connect to MySQL: ' . mysqli_error());


    }
