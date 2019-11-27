<?php
    include "config.php";
    
    if(isset($_GET['use'])){
        $currEventId = $_GET['use'];
        $currEvent = mysqli_fetch_array($conn->query("SELECT * FROM event WHERE eventid=$currEventId"));
        $eventTable = $currEvent['tablename'];
        $sql = $conn->query("SELECT * FROM current_api;") or die( $conn->error);
        $row = $sql->fetch_assoc();
        $apicode = $row['api_code'];
    }
    
    if(isset($_GET['studentcode'])){
        //session_start();
        $barcode = $_GET['studentcode'];
        $code = filter_input(INPUT_GET, 'code', FILTER_SANITIZE_SPECIAL_CHARS);
        $offline = file_put_contents($eventTable.".txt", $code.PHP_EOL, FILE_APPEND | LOCK_EX);
        $api_url = "https://winrest01.addu.edu.ph/eventAttendance/InquiryAPI/personQuery?eventcode=$apicode&barCode=$barcode";
        
        
        $content = @file_get_contents($api_url);

        if($content){
            $newContent = json_decode($content, true);

            if($newContent['status'] === 'success'){
                $studentCode = $newContent['data']['Code'];
                $firstName = $newContent['data']['FirstName'];
                $lastName = $newContent['data']['LastName'];
                $course = $newContent['data']['ProgrammeOrDept'];
                $section = $newContent['data']['Section'];
    
                $result = mysqli_query($conn, "INSERT INTO $eventTable(StudentID, Firstname, Lastname, Course, Section, Timein) VALUES('$studentCode', '$firstName', '$lastName', '$course', '$section', now())");
            }else if($newContent['status'] === 'not found')
                $notenrolled = true; 
        }else
            $wrongapi = true;
    }
    