<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    require_once 'processAttendance.php';
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Register Attendance</title>
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

      </div>
    </div>
        <div class="container">
          <h1 class="mt-5">AdDU-CSSEC Attendance Systems</h1>
          <form action="registerAdDU.php" method="GET">
            <div class="form-group">
              <input type="hidden" class="form-control" name="use" value="<?php echo $currEventId ?>" >
              <h2 for="studentcode">Registration for <?php echo $currEvent['name']?></h2>
              <p>Student Code:</p>
              <input type="text" class="form-control form-control-lg mb-4" placeholder="Enter student code" name="studentcode">
              <button type="submit" class="btn btn-primary btn-lg btn-block violet" name="submitAttendance">Enter</button>
            </div>
          </form>
        </div>
    </body>
</html>
