<!DOCTYPE html>
<?php include 'dbconnect.php';
$page = (isset($_GET['page']) ? (int)$_GET['page'] : 1);
$perPage = (isset($_GET['per-page']) && (int)$_GET['per-page'] <= 50 ? (int)$_GET['per-page'] : 5);
$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;
$sql = "select * from tasks limit ".$start." , ".$perPage." ";
$total = $db->query("select * from tasks")->num_rows;
$pages = ceil($total / $perPage);
$rows = $db->query($sql);
?>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-compitable" content="IE-edge">
		<meta name="viewport" content="width=device-width">
		<title>CRUD APPLICATION</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="css/styles.css" type="text/css">
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			
			<div class="row">
				<center><h1>My Tasks</h1></center>
				<div class="col-md-10 col-md-offset-1">
					<button type="button" data-target="#myModal" data-toggle="modal" class="btn btn-success">Add</button>
					<button type="button" class="btn btn-default pull-right" onclick="print()">Print</button>
					<br>
					<hr>
					<div id="myModal" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Add Task</h4>
								</div>
								<div class="modal-body">
									<form method="post" action="add.php">
										<div class="form-group">
											<label>Task Name</label>
											<input type="text" required name="task" class="form-control">
										</div>
										<input type="submit" name="send" class="btn btn-success" value="Submit">
									</form>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 text-center">
						<b><p>Search</p></b>
						<form action="search.php" method="post" class="form-group">
							<input class="form-control" type="text" placeholder="Search" name="search"></input>
						</form>
					</div>
					<table class="table table-hover">
						
						<thead>
							<tr>
								<th>ID</th>
								<th class="col-md-10">Task</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<?php while($row = $rows->fetch_assoc()): ?>
								<th><?php echo $row['id'] ?></th>
								<td class="col-md-10"><?php echo $row['name'] ?></td>
								<td><a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Edit</a></td>
								<td><a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a></td>
							</tr>
							<?php endwhile; ?>
						</tbody>
					</table>
					<center>
					<ul class="pagination">
						<?php for($i = 1 ; $i <= $pages ; $i++): ?>
						<li>
							<a href="?page=<?php echo $i;?>&?per-page=<?php echo $perPage;?>"><?php echo $i; ?></a>
						</li>
						<?php endfor; ?>
					</ul>
					</center>
					<hr>
				</div>
			</div>
		</body>
	</html>