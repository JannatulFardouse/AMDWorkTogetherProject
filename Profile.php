
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
		
		$sid = $_SESSION['student'];
		$getusername = pg_query($db, "select * from get_user('$sid')");
		$rows = pg_fetch_assoc($getusername);

		?>

		<section class="section">
			
				<div class="card">
					<div class="card-header">
						My Profile					</div>
					<div class="card-body">
						<h5 class="card-title"> Name : <?php echo $rows['name']; ?></h5>
						<h5 class="card-text"> Matricular No : <?php echo $rows['matricularno']; ?></h5>
	
					</div>
					<h3 style="margin: 20px 40px;">  
						
						<a href="logout.php?id=<?php echo $rows['id']; ?>" style="background-color: black;border: none; color: #FFFFFF; padding: 10px 25px; text-align: center; -webkit-transition-duration: 0.4s; transition-duration: 0.4s; margin: 16px 0 !important; text-decoration: none; font-size: 16px; cursor: pointer; border-radius: 2px;">Logout</a></h3>
					</div>
				
			</section>
		</body>
		</html>
		<?php } ?>