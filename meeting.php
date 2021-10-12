
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

	<script type="text/javascript">
		function autoRefresh(site_id) {        
			 window.location.href = "changestatus.php?id=" + site_id; 
		}  
	</script>
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
				<li class="nav-item active">
					<a class="nav-link" href="studentlist.php">Student </a>
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
	$sql = pg_query($db, "select * from show_meeting()");
	?>
	<section class="section">
		<div style="margin-top: 100px; padding: 00px 105px;">
			<h2 style="background: blue!important; padding: 10px 20px; font-size: 20px; font-weight: bold; color: white;">All Meeitng List</h2> <br>
			<h6><a href="addmeeting.php" style="background: #2196F3!important; color: white; padding: 10px; font-weight: bold">Add New Meeting</a></h6> <br> 
			<table class="table table-bordered">
				<thead>
					<tr>
						<th scope="col">Location</th>
						<th scope="col">Start Time</th>
						<th scope="col">End Time</th>
						<th scope="col">Status</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php while ($row = pg_fetch_assoc($sql)) {
						?>
						<tr>
							<th scope="row"><?php echo $row['location']; ?></th>
							<td><?php echo $row['start_time']; ?></td>
							<td><?php echo $row['end_time']; ?>
								<?php 
									$cd = date("Y-m-d\TH:i:s");
									if ($row['end_time'] < $cd &&  $row['status'] == 'f') {
											$var = $row['id'];
											echo ">script type='text/javascript'>autoRefresh('$var');</script>";

								 } ?>


							</td>
							<td> <?php if ($row['status'] == 't' ) { ?> Hide  <?php } else {  ?> Show  <?php } ?></td>
							<td><a href="viewmeeting.php?id=<?php echo $row['id']; ?>" style="background-color: #4CAF50!important;border: none; color: #FFFFFF; padding: 10px 25px; text-align: center; -webkit-transition-duration: 0.4s; transition-duration: 0.4s; margin: 16px 0 !important; text-decoration: none; font-size: 16px; cursor: pointer; border-radius: 2px;">View</a>
								<a href="updatemeeting.php?id=<?php echo $row['id']; ?>" style="background-color: #2196F3!important;border: none; color: #FFFFFF; padding: 10px 25px; text-align: center; -webkit-transition-duration: 0.4s; transition-duration: 0.4s; margin: 16px 0 !important; text-decoration: none; font-size: 16px; cursor: pointer; border-radius: 2px;">Update</a>
								<?php if ($row['status'] == 't' ) {  ?> 
								<a href="deletemeeting.php?id=<?php echo $row['id']; ?>" style="background-color: #e91e63!important;border: none; color: #FFFFFF; padding: 10px 25px; text-align: center; -webkit-transition-duration: 0.4s; transition-duration: 0.4s; margin: 16px 0 !important; text-decoration: none; font-size: 16px; cursor: pointer; border-radius: 2px;">Delete</a>
							<?php } ?>
							</td>

						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</section>
</body>
</html>






