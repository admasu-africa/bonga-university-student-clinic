	<?php 
		include 'dbc.inc.php';
	//$conn = mysqli_connect('localhost','root','','BUC');
	$id = $_POST['id'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$dept = $_POST['dept'];
	$sql = "insert into Patient values('$id','$fname','$lname','$dept')" ;
	mysqli_query($conn,$sql);
	header("location: ../registration.php");

	?>