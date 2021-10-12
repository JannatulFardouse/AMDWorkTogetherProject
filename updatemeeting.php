<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="assets/style.css">
	<title>WT</title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-success">
		<a class="navbar-brand" href="/wt/">WorkTogether</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="meeting.php">Meeting </a>
				</li>
				
			</ul>
		</div>
	</nav>
	<?php 
	$host        = "host = 127.0.0.1";
	$port        = "port = 5432";
	  $dbname      = "dbname = wt";
  $credentials = "user = postgres password=123456";

	$db = pg_connect( "$host $port $dbname $credentials"  );

	?>

	<?php 
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	}
	$sql = pg_query($db, "select * from get_meeting('$id');");
	$row = pg_fetch_assoc($sql);
	$id = $row['id'];
	?>

	<?php 
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$location = $_POST["location"];
		$status = $_POST["status"];
		$starttime = $_POST["starttime"];
		$endtime = $_POST["endtime"];


		$sql = pg_query($db, "select update_meeting('$id', '$location', '$starttime','$endtime', '$status');");
		while ($row = pg_fetch_row($sql)) {

			if ($row[0] == 'Error') {
				echo "Error";
			}
			else{	
				header("Location: meeting.php");
			}
		}
	}
	?>

	<section class="section">
		<div style="margin-top: 100px; padding: 00px 105px;">
			<h2 style="background: blue; padding: 10px 20px; font-size: 20px; font-weight: bold; color: white;">Update Meeting</h2> <br>
			<form  method="post" action="">
				<div class="form-group">
					<label for="exampleFormControlInput1">Location</label>
					<input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="location" value="<?php echo $row['location']; ?>">
				</div>
				<?php $start = date("Y-m-d\TH:i:s", strtotime($row['end_time']));?>
				<div class="form-group">
					<label for="exampleFormControlInput1">Start Time</label>
					<input type="datetime-local" class="form-control" id="exampleFormControlInput1" placeholder="" name="starttime" value="<?php echo $start ?>">
				</div>
				<?php $end = date("Y-m-d\TH:i:s", strtotime($row['start_time']));?>
				<div class="form-group">
					<label for="exampleFormControlInput1">End Time</label>
					<input type="datetime-local" class="form-control" id="exampleFormControlInput1" placeholder="" name="endtime" value="<?php echo $end ?>">
				</div>

				<div class="form-group">
					<label class="exampleFormControlInput1">Status</label>
					<div class="control">
						<input class="radio" type="radio" name="status" value="0" <?php if ($row['status'] == 'f') { ?> checked <?php }  ?> > Show
						<input class="radio" type="radio" name="status" value="1" <?php if ($row['status'] == 't') { ?> checked <?php }  ?>> Hide
					</div>
				</div>
				
				<button class="btn btn-primary">Submit</button>
			</form>
		</div>
	</section>
</body>
</html>






