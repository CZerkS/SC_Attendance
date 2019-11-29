<!doctype html>

<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Log In</title>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="css/custom.css"/>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
    <body>
      <div class="navbar navbar-default navbar-static-top navbar-expand-lg navbar-dark" role="navigation">
          <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
              <a class="navbar-brand" href="#">
                  <img src="img/avatar_2x_w.png" width="50" height="50">
                  AdDU Computer Studies Cluster
              </a>
              <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav">
                      <li class="nav-item">
                          <a class="nav-link" href="index.php">Home</a>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
        <div class="container">
            <div class="row">
              <div class="mx-auto mt-5">
                <form action="events.php" method="GET">
                    <div class="form-group">
                        <h1>Please enter the event code</h1>
                        <input type="text" class="form-control" placeholder="Event code" name="eventcode" >
                    </div>
                </form>
              </div>
        <title>Events</title>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

        <style>
            #apiText{}

            #apiEnter{}

            #apiButton{}

            #apiSection{}

            #eventButton{}

            #eventSection{}

            #buttonhideae{}
        </style>
    </head>
    <body>
      <div class="container">
        <div class="row justify-content-center text-center">
            <div class="row">
                <div class="col-md-9 justify-content-center">
                <div class="container" style="margin-top: 5rem">
                    <div class="col-sm-1">
                        <img src="Images/CS Logo.jpg" height="100" width="100" alt="CS Logo">
                    </div>
                    <div class="col-sm-5">
                        <h1 style="font-weight:bold">CS Attendance Systems</h1>
                    </div>
                </div>
                    <?php
                        include_once 'config.php';
                        $eventTables = $conn->query("SELECT * FROM event") or die( $conn->error);
                        $apikey = $conn->query("SELECT * FROM current_api ORDER BY apiID DESC LIMIT 1;") or die( $conn->error);
                        $row = $apikey->fetch_assoc();

                        date_default_timezone_set("Asia/Shanghai");

                        if(!date("YYYY-MM-DD hh:mm:ss",time()) > $row['dateEnd'])
                            echo "<h4 align='left'><b>CURRENT API KEY</b>: " . $row['api_code'] . "</h4>";
                        else
                            echo "<h4 align='left'><b>CURRENT API KEY</b>: No API Key yet</h4>"
                    ?>
                    <div class="row justify-content-center" style="margin-top:1rem">
                        <table class="table table-striped text-left">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th colspan="3">Actions</th>
                                </tr>
                            </thead>
                            <?php while($row = $eventTables->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row['name'];?></td>
                                    <td><?php echo $row['description'];?></td>
                                    <td><?php echo $row['date'];?></td>
                                    <td>
                                        <a href="registerAdDU.php?use=<?php echo $row['eventid']; ?>" class="btn btn-primary">AdDU</a>
                                        <a href="registerGuest.php?use=<?php echo $row['eventid']; ?>" class="btn btn-primary">Guest</a>
                                        <a href="viewEvent.php?view=<?php echo $row['eventid']; ?>" class="btn btn-info">View</a>
                                        <a href="processEvent.php?delete=<?php echo $row['eventid']; ?>" class="btn btn-danger">Delete</a>
                                        <a href="export.php?export=<?php echo $row['eventid']; ?>" class="btn btn-success">Export</a>
                                    </td>
                                </tr>
                            <?php endwhile;?>
                        </table>
                    </div>
                </div>
                <div class="col-md-3" style="margin-top:6rem">
                    <?php
                        require_once 'processEvent.php';
                    ?>

                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-primary" id="apiButton">API</button>
                        <button type="button" class="btn btn-primary" id="eventButton">EVENT</button>
                        <button type="button" class="btn btn-primary" id="buttonhideae">HIDE</button>
                    </div>

                    <form action="index.php" method="POST" id="apiSection">
                        <div class="form-group">
                            <h3 style="font-weight:bold">CHANGE API</h3>
                            <!--Placing of "API does not exist"-->
                            <?php
                                if(isset($contentnotexist))
                                    echo "<h3>API Key doesn't exist</h3>";
                            ?>
                            <input type="text" class="form-control" placeholder="Enter new API" name="new_api_name">
                            <label for="date">Date Finished</label>
                            <input class="form-control" name="date" placeholder="MM-DD-YYYY" type ="text"/>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" name="changeapi">Change</button>
                        </div>
                    </form>

                    <form action="processEvent.php" method="POST" id="eventSection">
                        <div class="form-group">
                            <h3 style="font-weight:bold">ADD EVENT</h3>
                        </div>
                        <div class="form-group">
                            <label for="name">Event Name</label>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter event name" name="name">
                        </div>
                        <div class="form-group">
                            <label>Event Description</label>
                            <textarea class="form-control" placeholder="Enter event description" name="desc" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="date">Event Date</label>
                            <input class="form-control" name="date" placeholder="MM-DD-YYYY" type ="text"/>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" name="save">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </body>


    <script>
        $(document).ready(function(){
            // Datepicker
            var date_input=$('input[name="date"]');
            var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
            date_input.datepicker({
                format: 'mm-dd-yyyy',
                container: container,
                todayHighlight: true,
              autoclose: true,
            });

            // Button Event Handler
            $("#eventSection").hide();

            $("#apiButton").click(function(){
                $("#apiSection").show();
                $("#eventSection").hide();
            });
            $("#eventButton").click(function(){
                $("#apiSection").hide();
                $("#eventSection").show();
            });
            $("#buttonhideae").click(function(){
                $("#apiSection").hide();
                $("#eventSection").hide();
            });
        })

    </script>

</html>
