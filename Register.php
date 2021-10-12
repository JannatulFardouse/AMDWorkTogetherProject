<?php session_start();
 if(!isset($_SESSION['student'])) { ?>
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
          <a class="nav-link" href="login.php">Student </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="meeting.php">FSR </a>
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

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$name = $_POST['name'];
		$matriculationnumber = $_POST['matriculationnumber'];
		
		$sql = pg_query($db, "select add_student('$name','$matriculationnumber');");
		while ($row = pg_fetch_row($sql)) {

			
				header("Location: login.php");
			
		}
	}
	?>


	<section class="section">

		<div class="col-md-12">
			<div class="login" style="text-align: center;">
				<form method="post" action="">
					<h4 style="text-align: center; font-size: 175%;color: #757575;font-weight: 300; margin-top: 100px; background: gray; padding: 10px 10px; font-weight: bold; color: white;">Register as Student</h4><hr><br>        
					<div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false">
					</div>
					<input name="name" type="text" placeholder="Name" required="Name"/>
					<input name="matriculationnumber" type="text" placeholder="Matriculation number" required="required"/>
					<button class="btn btn-primary">Register</button>
				</form>
			</div>
		</div>
	</section>
</body>
</html>

<?php } else{ header("Location: meetinglist.php"); }  ?>