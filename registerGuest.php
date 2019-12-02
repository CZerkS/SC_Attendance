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
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="css/custom.css"/>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="js/jq.js"></script>
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
        <div class="container" style="margin-top: 2rem">
            <div class="jumbotron">
				<?php
					echo "<input type='hidden' class='form-control' name='use' value='$currEventId'>";
					echo "<h3 for='code'>Registration for $currEvent[name] Guest</h3>";
				?>
				<button id='toggle'>Returning Guest</button>
				
					<!-- RETURNING GUEST -->
					<div id='returning' class="form-group">
						<div class="row col-sm-2">
							<label for="gSearch">Search</label>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<input type="text" class="form-control" placeholder='Enter name' name=gSearch>
							</div>
						</div>
						<div class="form-group" style='height:50vh; overflow:auto;'>
							<table class="table table-striped text-left">
								<thead style='position:sticky; top: 0; background-color:#cdcdcd;'>
									<th>Lastname</th>
									<th>Firstname</th>
									<th>School</th>
									<th></th>
								</thead>
								<?php
									$query = "SELECT lastname, firstname, school FROM test.$currEvent[guestTablename] e LEFT JOIN guests g ON e.guestcode=g.guestcode ORDER BY lastname";
									$guestTable = $conn->query( $query ) or die( $conn->error);
									while($row = $guestTable->fetch_assoc()) {
										echo "<tr class=tblrow>";
										echo "<td class=lname>$row[lastname]</td>";
										echo "<td class=fname>$row[firstname]</td>";
										echo "<td class=school>$row[school]</td>";
										echo "<td><button class='checkInButton'>CHECK IN</button></td>";
										echo "</tr>";
									}
								?>
							</table>
						</div> 
					</div>
					<!-- NEW GUEST -->
					<div id='newguest' class="form-group">
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
						<div class="form-group">
							<div class="row">
								<div class="col-sm-2">
									<label for="dpSchools">School</label>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<select class="form-control" id="schoolnameselect" name="school">
										<?php
											$guestTable = $conn->query( "SELECT DISTINCT school FROM test.guests ORDER BY school") or die( $conn->error);
											while($row = $guestTable->fetch_assoc())
												echo "<option value='$row[school]'>$row[school]</option>";
										?>
									</select>
									<input type='text' class=form-control id='schoolnametext' placeholder='School'>
								</div>
								<div class="col-sm-6">
									<button type="button" class="btn btn-primary" id='toggleSchool' style="margin-left:1rem;background-color:#5E016D">Enter Another School</button>
								</div>
							</div> 
						</div>
						<input type="hidden" id="use" class="form-control" name="use" value="<?php echo $currEventId ?>" >
						<button type="submit" class="btn btn-primary btn-block" style="margin-top:1rem;background-color:#5E016D" name="submitAttendance">Enter</button>
					</div>
			</div>
        </div>
    </body>
</html>
