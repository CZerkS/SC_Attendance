<?php

include 'config.php';

if( isset($_POST['save'])){
    $name = mysql_real_escape_string($_POST['name']);
    $desc = mysql_real_escape_string($_POST['desc']);
    $date = DateTime::createFromFormat( 'm-d-Y', $_POST['date'] )->format( 'Y-m-d' );
    $tablename ="placeholder";
    
    $sql = "INSERT INTO event( name, description, date, tablename ) VALUES('$name', '$desc', '$date', '$tablename' )";
    
    if( $conn->query( $sql ) === TRUE ){
                echo "New record created successfully";
            } else{
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
    $lastid = mysqli_insert_id($conn );
    $cleanname = preg_replace('/[^A-Za-z0-9\-]/','',str_replace(' ', '', $name));
    $tablename = $lastid."_".$cleanname;
    $sql = "UPDATE event SET tablename='$tablename' WHERE eventid=$lastid";
    if( $conn->query( $sql ) === TRUE ){
                echo "Record updated successfully";
            } else{
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
    $sql = "CREATE TABLE `$tablename` (
	`studentCode` VARCHAR(255) NOT NULL,
	`firstName` VARCHAR(255) NOT NULL,
	`lastName` VARCHAR(255) NOT NULL,
	`course` VARCHAR(255) NOT NULL,
	`section` VARCHAR(255) NOT NULL,
	`timeIn` DATETIME NOT NULL,
	PRIMARY KEY (`studentCode`)
        ) ENGINE=InnoDB;";
    
    if( $conn->query( $sql ) === TRUE ){
                echo "Table added successfully";
            } else{
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
    
    $_SESSION['message'] = "New event added!";
    $_SESSION['msg_type'] = "success";
    header("location: events.php");
}

if( isset($_GET['delete'])){
    
    $id = $_GET['delete'];
    $row = mysqli_fetch_array( $conn->query("SELECT * FROM event WHERE eventid=$id") );
    
    $tablename=$row['tablename'];
    
    $conn->query("DELETE FROM event WHERE eventid=$id") or die($conn->error);
    $conn->query("DROP TABLE IF EXISTS $tablename") or die($conn->error);
    
    $_SESSION['message'] = "An event has been deleted!!";
    $_SESSION['msg_type'] = "danger";
    header("location: events.php");
}
