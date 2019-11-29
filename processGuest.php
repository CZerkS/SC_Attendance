<?php
    include "config.php";
    
    if( isset($_GET['use'] ) ){
        $currEventId = $_GET['use'];
        $currEvent = mysqli_fetch_array( $conn->query("SELECT * FROM event WHERE eventid=$currEventId") );
        $eventTable = $currEvent['guestTablename'];
    }
    
	if(isset($_GET['submitAttendance'])){
		$firstName = strtoupper($_GET['fname']);
		$lastName = strtoupper($_GET['lname']);
		
		if(strlen($firstName) > 0 && strlen($lastName) > 0){
			$school = strtoupper($_GET['school']);

			// insert to database
			if (!isset($_GET['returning'])) {
				$query = "INSERT INTO guests(firstname, lastname, school) VALUES('$firstName', '$lastName', '$school')";
				$result = $conn->query( $query ) or die( $conn-> error );
			}
			
			$query = "INSERT INTO $eventTable VALUES((SELECT guestcode FROM guests WHERE firstname='$firstName' AND lastname='$lastName' AND school='$school'), now())";
			$result = $conn->query( $query ) or die( $conn-> error );
	
			echo "$firstName $lastName recorded!";
		}else{
			echo "No First Name or Last Name";
		}
		
	}
?>
