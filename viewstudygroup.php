
<?php session_start();
if(isset($_SESSION['student'])) { ?>

</body>
</html>
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
		$id = $_GET['id'];
	}
	$sql = pg_query($db, "select * from get_studygroup('$id');");
	$row = pg_fetch_assoc($sql);
	$id = $row['id'];
	?>
	<section class="section">
		<div class="card">
			<div class="card-header">
				Study Group: <?php echo $row['topic']; ?>
			</div>
			<div class="card-body">
				<h5 class="card-title"> Topic : <?php echo $row['topic']; ?></h5>
				<h5 class="card-text"> Description: <?php echo $row['description']; ?></h5>
				<h5 class="card-text"> Maximum Student: <?php echo $row['maxlimit']; ?></h5>
				<h5 class="card-text">Meeting Location: <?php echo $row['location']; ?></h5>
				<h5 class="card-text">Meeting Start Time: <?php echo $row['start_time']; ?></h5>
				<h5 class="card-text">Meeting End Time: <?php echo $row['end_time']; ?></h5>
			</div>
			<?php if ($_SESSION['student'] != $row['owner_id']) {  ?>
				<h3 style="margin: 20px 40px;"><a href="joinstudygroup.php?id=<?php echo $row['id']; ?>" style="background-color: #f4511e;border: none; color: #FFFFFF; padding: 10px 25px; text-align: center; -webkit-transition-duration: 0.4s; transition-duration: 0.4s; margin: 16px 0 !important; text-decoration: none; font-size: 16px; cursor: pointer; border-radius: 2px;">Join</a></h3>
			<?php  }  ?>
		</div>
	</section>
</body>
</html>

<?php } ?>