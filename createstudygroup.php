
<?php session_start();
if(isset($_SESSION['student'])) { ?>

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
						<a class="nav-link" href="meetinglist.php">Meeting </a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="studygrouplist.php">Study Group </a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="logout.php">Log out </a>
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
			$meeting_id = $_GET['id'];
		}
		if ($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$topic = $_POST['topic'];
			$description = $_POST['description'];
			$maxlimit = $_POST['maxlimit'];
			$owner_id = $_SESSION['student'];
			$status = TRUE;

			$sql = pg_query($db, "select create_studygroup('$topic','$description','$maxlimit', '$owner_id', '$status', '$meeting_id');");
			while ($row = pg_fetch_row($sql)) {

				if ($row[0] == 'Error') {
					echo "Error";
				}
				else{

					header("Location: studygrouplist.php");
				}
			}
		}
		?>

		<section class="section">
			<div style="margin-top: 100px; padding: 00px 105px;">
				<h2 style="background: #4CAF50!important; padding: 10px 20px; font-size: 20px; font-weight: bold; color: white;">Add Study Group</h2> <br>
				<form  method="post" action="">
					<div class="form-group">
						<label for="exampleFormControlInput1">Topic</label>
						<input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="topic">
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Description</label>
						<textarea class="form-control" id="exampleFormControlInput1" name="description"></textarea>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1">Maximum Student</label>
						<input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="maxlimit">
					</div>

					<button class="btn btn-primary">Submit</button>
				</form>
			</div>
		</section>
	</body>
	</html>

	<?php } ?>