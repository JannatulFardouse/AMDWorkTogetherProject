
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
	$sql = pg_query($db, "select * from studentlist()");
	?>
	<section class="section">
		<div style="margin-top: 100px; padding: 00px 105px;">
			<h2 style="background: #009270!important; padding: 10px 20px; font-size: 20px; font-weight: bold; color: white;">Student List</h2> <br>
			
			<table class="table table-bordered">
				<thead>
					<tr>
						<th scope="col">Student Name</th>
						<th scope="col">Matriculation number</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php while ($row = pg_fetch_assoc($sql)) {
						?>
						<tr>
							<td><?php echo $row['name']; ?></td>
							<td><?php echo $row['matricularno']; ?></td>
							<td>
								<a href="deletestudent.php?id=<?php echo $row['id']; ?>" style="background-color: #e91e63!important;border: none; color: #FFFFFF; padding: 10px 25px; text-align: center; -webkit-transition-duration: 0.4s; transition-duration: 0.4s; margin: 16px 0 !important; text-decoration: none; font-size: 16px; cursor: pointer; border-radius: 2px;">Delete</a>
							</td>

						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</section>
</body>
</html>






