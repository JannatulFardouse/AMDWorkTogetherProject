
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
					<a class="nav-link" href="meetinglist.php">Meeting</a>
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
	$owner_id = $_SESSION['student'];
	$sql = pg_query($db, "select * from show_studygroup('$owner_id')");

	$sid = $_SESSION['student'];
	$getusername = pg_query($db, "select * from get_user('$sid')");
	$rows = pg_fetch_assoc($getusername);
	?>
	<section class="section">
		<div style="margin-top: 100px; padding: 00px 105px;">
			<h1 style="margin-top: 50px; text-align: center; font-size: 25px; padding: 15px 20px; color: white; font-weight: bold; background: #6fa3b0; box-shadow: 10px 10px 8px #888888;">
				
				Welcome, <a href="profile.php?id=<?php echo $rows['id']; ?>" style="color: white; font-size: 25px; text-transform: capitalize; text-shadow: 1px 1px 1px red, 2px 2px 1px red; text-align: center; letter-spacing: 2px;"><?php echo $rows['name']; ?></a>
			</h1>
			<br>

			<h2 style="background: #4CAF50!important; padding: 10px 20px; font-size: 20px; font-weight: bold; color: white;">All Study Group</h2> <br> 
			<h6><a href="mystudygroup.php" style="background: #2196F3!important; color: white; padding: 10px; font-weight: bold">View My Study Group</a></h6> <br> 
			<table class="table table-bordered">
				<thead>
					<tr>
						<th scope="col">Topic</th>
						<th scope="col">Maximum Student</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php while ($row = pg_fetch_assoc($sql)) {
						?>
						<tr>
							<th scope="row"><?php echo $row['topic']; ?></th>
							<td><?php echo $row['maxlimit']; ?></td>
						</td>
						<td><a href="viewstudygroup.php?id=<?php echo $row['id']; ?>" style="background-color: #f4511e;border: none; color: #FFFFFF; padding: 10px 25px; text-align: center; -webkit-transition-duration: 0.4s; transition-duration: 0.4s; margin: 16px 0 !important; text-decoration: none; font-size: 16px; cursor: pointer; border-radius: 2px;">View</a>
							<a href="joinstudygroup.php?id=<?php echo $row['id']; ?>" style="background-color: #008CBA;border: none; color: #FFFFFF; padding: 10px 25px; text-align: center; -webkit-transition-duration: 0.4s; transition-duration: 0.4s; margin: 16px 0 !important; text-decoration: none; font-size: 16px; cursor: pointer; border-radius: 2px;">Join</a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</section>
</body>
</html>
<?php } ?>