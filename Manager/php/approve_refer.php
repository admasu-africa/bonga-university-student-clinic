<?php 
	include '../include/dbc.inc.php';
	if(isset($_POST['student_id'])){
		$student_id = $_POST['student_id'];
		$sql = "UPDATE referal set status = 2 where student_id = '$student_id'";
		$res = mysqli_query($conn, $sql);
		if($res)
			echo 1;
		else
			echo mysqli_error($conn);
	}
 ?>