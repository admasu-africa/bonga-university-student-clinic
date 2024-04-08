<?php 
	include "../include/dbc.inc.php";
if(isset($_GET['action']) && $_GET['action'] == "save_history"){
	$student_id = $_GET['id'];
	$history_value = $_GET['history'];
	$date = date("Y-m-d");
	
	$history_clean = mysqli_real_escape_string($conn,$history_value);

	$sql = "INSERT INTO patient_info(student_id, history, status, visited_date) VALUES('$student_id', '$history_clean',1,'$date');";
	$sql .= "UPDATE patient SET status = 0 WHERE student_id = '$student_id'";
	$res = mysqli_multi_query($conn, $sql);

	if($res)
		echo 1;
	else
		echo "Error: ".mysqli_error($conn);
}
if(isset($_GET['action']) && $_GET['action'] == "save_history_2"){
	$student_id = $_GET['id'];
	$history_value = $_GET['history'];
	$date = date("Y-m-d");
	
	$history_clean = mysqli_real_escape_string($conn,$history_value);

	$sql = "INSERT INTO patient_info(student_id, history, status, visited_date) VALUES('$student_id', '$history_clean',0,'$date');";
	$sql .= "UPDATE patient SET status = 0 WHERE student_id = '$student_id'";
	$res = mysqli_multi_query($conn, $sql);

	if($res)
		echo 1;
	else
		echo "Error: ".mysqli_error($conn);
}
 ?>