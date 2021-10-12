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
	$sqls = pg_query($db, "select * from m_studygroup('$id');");
	$row = pg_fetch_assoc($sql);
	$id = $row['id']
	?>
	<section class="section">
		<div class="card">
			<div class="card-header">
				Meeting
			</div>
			<div class="card-body">
				<h5 class="card-title"> Location : <?php echo $row['location']; ?></h5>
				<h5 class="card-text"> Start Time: <?php echo $row['start_time']; ?></h5>
				<h5 class="card-text">END Time: <?php echo $row['end_time']; ?></h5>
			</div>
		</div>
		<div class="card">
			<div class="card-header">
				Groups 
			</div>
			<div class="card-body">
				<?php while ($row = pg_fetch_assoc($sqls)) {
						?>
				<blockquote class="blockquote mb-0">
					<h5 class="card-title"> Topic : <?php echo $row['topic']; ?></h5>
					<h5 class="card-text"> Description: <?php echo $row['description']; ?></h5>
					<h5 class="card-text">Max limit: <?php echo $row['maxlimit']; ?></h5>
					<?php  $sg_id= $row['id']; $sqlst = pg_query($db, "select * from m_studentlist('$sg_id');"); ?>
					<h4>Joined Students: </h4>
					<?php $i = 1; ?>
					<?php while ($rows = pg_fetch_assoc($sqlst)) {
						?>     <span><?php echo $i; ?>)</span>
								<h5 class="card-title"> Name : <?php echo $rows['name']; ?></h5>
								<h5 class="card-title"> Matricular Number : <?php echo $rows['matricularno']; ?></h5>
							<?php $i++; } ?>
				</blockquote>
				<?php } ?>
			</div>
		</div>
	</section>
</body>
</html>





