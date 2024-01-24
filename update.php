<!DOCTYPE html>
<?php
include 'dbconnect.php';
$id = (int)$_GET['id'];
$sql = "Select * from tasks where id='$id'";
$rows = $db->query($sql);
$row = $rows->fetch_assoc();
if(isset($_POST['send']))
{
$task = htmlspecialchars($_POST['task']);
$sql = "update tasks set name = '$task' where id = '$id'";
$val = $db->query($sql);
header('location:index.php');
}
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
				<center><h1>Update Table</h1></center>
				<div class="col-md-10 col-md-offset-1">
					<br>
					<hr>
					<form method="post">
						<div class="form-group">
							<label>Task Name</label>
							<input type="text" required name="task" class="form-control" value="<?php echo $row['name']; ?>">
						</div>
						<input type="submit" name="send" class="btn btn-success" value="Submit">
						<a href="index.php" class="btn btn-warning">Back</a>
					</form>
				</div>
				<hr>
			</div>
		</div>
	</body>
</html>