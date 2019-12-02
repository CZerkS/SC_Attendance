<?php 
    session_start();
    date_default_timezone_set("Asia/Shanghai");
    require "config.php";

    $eventid = $_GET['export'];

    $currEvent = mysqli_fetch_array($conn->query("SELECT * FROM test.event WHERE eventid=$eventid"));

    $tableName  = $currEvent['tablename'];

    $eventname = $currEvent['name'];

    $eventdesc = $currEvent['description'];

    $date = DateTime::createFromFormat('Y-m-d', $currEvent['date'])->format('m-d-Y');

    $eventTable = $conn->query("SELECT * FROM test.$tableName ORDER BY Section, TimeIn") or die( $conn->error);

    $data = array();

    while($row = $eventTable->fetch_assoc()){
        array_push(
            $data,
            array(
                $row['StudentID'],
                $row['Firstname'],
                $row['Lastname'],
                $row['Course'],
                $row['Section'],
                $row['TimeIn']
            )
        );
    }

    $output = fopen("php://output", 'w') or die( "Can't open php://output" );

    $filename = preg_replace('/[^A-Za-z0-9\-]/','',str_replace(' ', '', $eventname)) . "_" . $date;

    header("Content-Type:application/csv");
    header("Content-Disposition:attachment;filename=$filename.csv");

    fputcsv($output, array("") );
    fputcsv( $output, array( $eventname, $date ) );
    fputcsv($output, array( 'ID NO', 'FIRST NAME', 'LAST NAME', 'COURSE', 'SECTION', 'TIME-IN' ) );

    foreach( $data as $row ){
        fputcsv( $output, $row );
    }

    fclose($output) or die("Can't close php://output");
?>
