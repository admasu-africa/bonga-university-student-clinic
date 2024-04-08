<?php 
session_start();
include '../include/dbc.inc.php';
if(isset($_POST['student_id'])){
	$student_id = $_POST['student_id'];
	$sql = "UPDATE patient_info set status = 0 WHERE student_id = '$student_id'";
	$res = mysqli_query($conn, $sql);
	if($res)
		echo 1;
	else
		echo mysqli_error($conn);
}
 ?>