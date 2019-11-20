<?php
    include "config.php";
    
    if( isset($_GET['use'] ) ){
        $currEventId = $_GET['use'];
        $currEvent = mysqli_fetch_array($conn->query("SELECT * FROM event WHERE eventid=$currEventId"));
        $eventTable = $currEvent['tablename'];
    }
    
    if(isset($_GET['studentcode'])){
        session_start();
        $eCode = $_SESSION['eventcode'];
        $barcode = $_GET['studentcode'];
        $code = filter_input(INPUT_GET, 'code', FILTER_SANITIZE_SPECIAL_CHARS);
        $offline = file_put_contents($eventTable.".txt", $code.PHP_EOL, FILE_APPEND | LOCK_EX);
        $api_url = "https://winrest01.addu.edu.ph/eventAttendance/InquiryAPI/personQuery?eventcode=$eCode&barCode=".$barcode;
        $content = file_get_contents($api_url);

        $newContent = json_decode($content, true);

        if($newContent['status'] === 'not found')
            echo "Student not enrolled";
        else{
            $studentCode = $newContent['data']['Code'];
            $firstName = $newContent['data']['FirstName'];
            $lastName = $newContent['data']['LastName'];
            $course = $newContent['data']['ProgrammeOrDept'];
            $section = $newContent['data']['Section'];

            //Executing the Insert
            #$result = $conn->query($query) or die($conn-> error);
            $result = mysqli_query($conn, "INSERT INTO $eventTable(StudentID, Firstname, Lastname, Course, Section, Timein) VALUES('$studentCode', '$firstName', '$lastName', '$course', '$section', 'now()')"); 
            
            $bottomnameQ = mysqli_fetch_array($conn->query("SELECT Firstname FROM $eventTable WHERE eventid=$currEventId ORDER BY DESC LIMIT 1"));
            $bottomname = $bottomnameQ['Firstname'];
        } 
    }
    