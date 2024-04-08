<?php 
	include "../include/dbc.inc.php";
	if($_POST['student_id']){
		$student_id = $_POST['student_id'];
		$sql = "UPDATE appointment set status = 0 WHERE student_id = '$student_id'";
		$res = mysqli_query($conn, $sql);
		if($res)
			echo 1;
		else
			echo "Error: ".mysqli_error($conn);
	}
 ?>