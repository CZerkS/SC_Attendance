<!doctype html>

<?php
    session_start();
    date_default_timezone_set("Asia/Shanghai");
    include_once 'config.php';
    $eventid = $_GET['view'];
    $currEvent = mysqli_fetch_array($conn->query("SELECT * FROM event WHERE eventid=$eventid"));
    $tname  = $currEvent['tablename'];
    $eventname = $currEvent['name'];
    $eventdesc = $currEvent['description'];
    $date = DateTime::createFromFormat('Y-m-d', $currEvent['date'])->format('m-d-Y');
    $eventTable = $conn->query("SELECT * FROM $tname") or die( $conn->error);
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Viewing Event</title>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

    <!---for JQuery--->
    <style>
            #adduSection{}

            #guestSection{}

            #btnAdduSection{}

            #btnGuestSection{}

            #btnEventSection{}
    </style>
  </head>
  
  <body>
        <div class="container">
            <div class="col-sm-1">
                <a href="index.php" class="btn btn_primary"  style="margin-top:1rem; background-color:#5E016D; color: #ffffff">Go Back</a>
            </div>
        </div>
        <div class="container" style="margin-top: 5rem;">
                <!--NAVIGATION SECTION--->
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-primary" id="btnAdduSection">AdDU</button>
                    <button type="button" class="btn btn-primary" id="btnGuestSection">GUEST</button>
                </div>
                <!--STOPS HERE--->
                <!--ADDU VIEW SECTION--->
                <div class="row justify-content-center text-center">
                    <div class="col-sm-9" id="adduSection">
                            <table class="table table-striped text-left">
                                <thead>
                                    <tr>
                                        <th>Student Code</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Course</th>
                                        <th>Section</th>
                                        <th>Time-in</th>
                                    </tr>
                                </thead>
                                <?php while($row = $eventTable->fetch_assoc() ): ?>
                                    <tr>
                                        <td><?php echo $row['StudentID'];?></td>
                                        <td><?php echo $row['Firstname'];?></td>
                                        <td><?php echo $row['Lastname'];?></td>
                                        <td><?php echo $row['Course'];?></td>
                                        <td><?php echo $row['Section'];?></td>
                                        <td><?php echo $row['TimeIn'];?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </table>
                    </div>
                    <!--STOPS HERE--->
                    <!--GUEST VIEW SECTION--->
                    <div class="col-sm-9" id="guestSection">
                        <table class="table table-striped text-left">
                            <thead>
                                <tr>
                                    <th>Guest Code</th>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>School</th>
                                    <th>Time-in</th>
                                </tr>
                            </thead>
                            <?php
                                $g_tableName  = $currEvent['guestTablename'];
                                $query = "SELECT guests.guestcode, lastname, firstname, school, timein FROM $g_tableName
                                        LEFT JOIN guests ON $g_tableName.guestcode = guests.guestcode
                                        ORDER BY timein";
                                $g_eventTable = $conn->query( $query ) or die( $conn->error);
                                while($row = $g_eventTable->fetch_assoc() ):
                            ?>
                                <tr>
                                    <td><?php echo $row['guestcode'];?></td>
                                    <td><?php echo $row['lastname'];?></td>
                                    <td><?php echo $row['firstname'];?></td>
                                    <td><?php echo $row['school'];?></td>
                                    <td><?php echo $row['timein'];?></td>
                                </tr>
                            <?php endwhile; ?>
                        </table>
                    </div>
                    <!--STOPS HERE--->
                    <!--EVENT DETAILS SECTION--->
                    <div class="col-md-3" id="eventSection">
                        <?php 
                            require_once 'processEvent.php'; 
                        ?>
                        <form action="processEvent.php" method="POST">
                            
                            <input type="hidden" class="form-control" name="eventid" value="<?php echo $eventid; ?>" >
                            <h2>Event Details</h2>
                            <div class="form-group">
                                <label for="name">Event Name</label>
                                <input type="text" class="form-control" placeholder="Enter event name" name="vname" value="<?php echo $eventname; ?>" >
                            </div>
                            <div class="form-group">
                                <label>Event Description</label>
                                <textarea class="form-control" placeholder="Enter event description" name="vdesc" rows="3"><?php echo $eventdesc; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="date">Event Date</label>
                                <input type ="text" placeholder="MM-DD-YYYY" class="form-control" name="vdate" value="<?php echo $date; ?>">
                            </div>
                            <div class="form-group">
                                <button type="update" class="btn btn-info" name="update">Update</button>
                            </div>
                        </form>
                    </div>
                    <!--STOPS HERE--->
                </div>
            </div>
        </div>
    </body>
    
    <script>
        //Datepicker
        $(document).ready(function(){
            var date_input=$('input[name="date"]');
            var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
            date_input.datepicker({
                format: 'mm-dd-yyyy',
                container: container,
                todayHighlight: true,
              autoclose: true,
            })
        })
        
        //Button Event Handler
        $(document).ready(function(){
            $("#guestSection").hide();

            $("#btnAdduSection").click(function(){
                $("#adduSection").show();
                $("#guestSection").hide();
            });
            $("#btnGuestSection").click(function(){
                $("#adduSection").hide();
                $("#guestSection").show();
            });
        });
    </script>
    
</html>