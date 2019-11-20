<?php

include_once 'config.php';

if(isset($_POST['save'])){
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $date = DateTime::createFromFormat( 'm-d-Y', $_POST['date'] )->format( 'Y-m-d' );
    $tablename ="placeholder";
    $guestTablename ="guestplaceholder";
    
    $sql = "INSERT INTO event(name, description, date, tablename , guestTablename) VALUES('$name', '$desc', '$date', '$tablename', '$guestTablename')";
    if($conn->query($sql) === TRUE){
        echo "New record created successfully";
    } else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $lastid = mysqli_insert_id($conn);
    $cleanname = preg_replace('/[^A-Za-z0-9\-]/','',str_replace(' ', '', $name));
    $tablename = $lastid."_addu_".$cleanname;
    $guestTablename = $lastid."_guest_".$cleanname;

    $sql = "UPDATE event SET tablename='$tablename' WHERE eventid=$lastid";
    if( $conn->query( $sql ) === TRUE ){
        echo "Record updated successfully";
    } else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "UPDATE event SET guestTablename='$guestTablename' WHERE eventid=$lastid";
    if($conn->query($sql) === TRUE){
        echo "alert('Record updated successfully')";
    } else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "CREATE TABLE `$tablename` (
	`StudentID` VARCHAR(255),
	`Firstname` VARCHAR(255) NOT NULL,
	`Lastname` VARCHAR(255) NOT NULL,
	`Course` VARCHAR(255) NOT NULL,
	`Section` VARCHAR(255) NOT NULL,
	`TimeIn` DATETIME NOT NULL,
	PRIMARY KEY (`StudentID`)
        ) ENGINE=InnoDB;";

    if($conn->query( $sql ) === TRUE){
        echo "Table added successfully";
    } else{
        echo "Error: ' . $sql . '<br>' . $conn->error";
    }
    
    $sql = "CREATE TABLE `$guestTablename` (
    `guestcode` int AUTO_INCREMENT,
    `firstname` VARCHAR(255) NOT NULL,
    `lastname` VARCHAR(255) NOT NULL,
    `school` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`guestcode`)
        ) ENGINE=InnoDB;";
    if( $conn->query( $sql ) === TRUE ){
        echo "Table added successfully";
    } else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $_SESSION['message'] = "New event added!";
    $_SESSION['msg_type'] = "Success";
    header("location: events.php");
}

if( isset($_POST['update'])){
    echo "Updating";
    $eventid = $_POST['eventid'];
    $eventname = $_POST['vname'];
    $cleanname = preg_replace('/[^A-Za-z0-9\-]/','',str_replace(' ', '', $eventname));
    $tablename = $eventid."_addu_".$cleanname;
    $guestTablename = $eventid."_guest_".$cleanname;

    $desc = $_POST['vdesc'];

    $date = DateTime::createFromFormat('m-d-Y', $_POST['vdate'])->format('Y-m-d');
    
    $sql = "UPDATE event SET name='$eventname', description='$desc', date='$date', tablename='$tablename', guestTablename='$guestTablename' WHERE eventid='$eventid'";
    $result = $conn->query($sql) or die($conn->error);

    #$sql = "RENAME  TO "
    #$result = $conn->query($sql) or die($conn->error);
    
    header("Location: viewEvent.php?view=$eventid");
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $row = mysqli_fetch_array( $conn->query("SELECT * FROM event WHERE eventid=$id") );
    
    $tablename=$row['tablename'];
    $guestTablename=$row['guestTablename'];
    
    $conn->query("DELETE FROM event WHERE eventid=$id") or die($conn->error);
    $conn->query("DROP TABLE IF EXISTS $tablename") or die($conn->error);
    $conn->query("DROP TABLE IF EXISTS $guestTablename") or die($conn->error);

    $_SESSION['message'] = "An event has been deleted!";
    $_SESSION['msg_type'] = "danger";
    header("location: events.php");
}
