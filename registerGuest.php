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
		<script src="js/jq.js"></script>
	</head>
    <body style="font-family:Comic Sans MS">
        <div class="container">
            <div class="col-sm-1">
                <a href="index.php" class="btn btn_primary"  style="margin-top:1rem; background-color:#5E016D; color: #ffffff">Go Back</a>
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
									$guestTable = $conn->query( "SELECT * FROM guests ORDER BY lastname") or die( $conn->error);
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
									<select class="form-control" id="schoolnameselect">
										<?php
											$guestTable = $conn->query( "SELECT DISTINCT school FROM guests ORDER BY school") or die( $conn->error);
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

