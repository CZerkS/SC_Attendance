<?php
    include "config.php";
    
    if( isset($_GET['use'] ) ){
        $currEventId = $_GET['use'];
        $currEvent = mysqli_fetch_array( $conn->query("SELECT * FROM event WHERE eventid=$currEventId") );
        $eventTable = $currEvent['tablename'];
    }
    
    if( isset($_GET['submitAttendance'])){
        #$code = $_GET['code'];
        $code = filter_input( INPUT_GET, 'code', FILTER_SANITIZE_SPECIAL_CHARS);
        $offline = file_put_contents( $eventTable.".txt", $code.PHP_EOL, FILE_APPEND | LOCK_EX );
        #commenting out the addu api thing
        #$api_url = "https://winrest01.addu.edu.ph/eventAttendance/InquiryAPI/personQuery?eventcode=575E37FI&barCode=".$barcode;
        #$response = json_decode(file_get_contents($api_url), true);
        #if( $newrespon['status'] === 'not found' )
        #echo "Student not enrolled";
        #else{
            $studentCode = $code;
            $firstName = "Mike";
            $lastName = "Espera";
            $course = "Computer";
            $section = "2-A";
            
            $query = "INSERT INTO $eventTable VALUES( '$code', '$firstName', '$lastName', '$course', '$section', now() ) ON DUPLICATE KEY UPDATE course='$course', section='$section'";
            
            $result = $conn->query( $query ) or die( $conn-> error );
    }