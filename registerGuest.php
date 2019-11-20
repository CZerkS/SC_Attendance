<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    require_once 'processGuest.php';
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Register Attendance</title>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    </head>
    <body style="font-family:Comic Sans MS">
        <div class="container">
            <div class="col-sm-1">
                <a href="events.php" class="btn btn_primary"  style="margin-top:1rem; background-color:#5E016D; color: #ffffff">Go Back</a>
            </div>
        </div>

        <div class="container" style="margin-top: 5rem">
            <div class="col-sm-1">
                <img src="Images/CS Logo.jpg" class="img-responsive" height="75" width="75" alt="CS Logo">
            </div>
            <div class="col-sm-9">
                <h2>CS Registration System (Guest)</h2>
            </div>
        </div>

        <div class="container" style="margin-top: 2rem">
            <div class="jumbotron">
                <div class="row">
                    <form action="registerGuest.php" method="GET">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="use" value="<?php echo $currEventId ?>" >
                            <h3 for="code">Registration for <?php echo $currEvent['name']?> Guest</h3>
                            <form>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label for="gfullname">Full Name</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="First name" name=gFirstname>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="Last name" name=gLastname>
                                    </div>
                                </div>
                            </form>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label for="dpSchools">School</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <select class="form-control" id="schoolname">
                                            <option value="uic">University of Immaculate Conception</option>
                                            <option value="jmc">Jose Maria College</option>
                                            <option value="mcm">Malayan Colleges of Mindanao</option>
                                            <option value="cjc">Cor Jesu College</option>
                                            <option value="um">University of Mindanao</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="dpSchools">Add New School</label>
                                        <button type="button" class="btn btn-primary" style="margin-left:1rem;background-color:#5E016D" name="newSchool">Click Me</button>
                                    </div>
                                </div> 
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" style="margin-top:1rem;background-color:#5E016D" name="submitAttendance">Enter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

