<?php 

session_start();
date_default_timezone_set("Asia/Shanghai");
require "config.php";

$eventid = $_GET['export'];

$currEvent = mysqli_fetch_array($conn->query("SELECT * FROM event WHERE eventid=$eventid"));

$tname  = $currEvent['tablename'];

$eventname = $currEvent['name'];

$eventdesc = $currEvent['description'];

$date = DateTime::createFromFormat('Y-m-d', $currEvent['date'])->format('m-d-Y');

$eventTable = $conn->query("SELECT * FROM $tname") or die( $conn->error);

$data = array();

while($row = $eventTable->fetch_assoc() ){
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

echo $data[0][1];

$output = fopen( "php://output", 'w') or die( "Can't open php://output" );

header("Content-Type:application/csv");
header("Content-Disposition:attachment;filename=$tname.csv");
fputcsv( $output, array('ID No', 'First Name', 'Last Name', 'Course', 'Section', 'Time-in' ) );

foreach( $data as $row ){
    fputcsv( $output, $row );
}

fclose($output) or die("Can't close php://output");

?>
