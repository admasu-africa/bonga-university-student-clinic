<?php 
session_start();
include '../include/dbc.inc.php';
	if(isset($_POST['to'])){
	$refered_by = $_SESSION['user_id'];
	$refer_time = date("Y-m-d H:i:s");
	$to = $_POST['to'];
    $cc = $_POST['cc'];
    $brief_hx_diagnosis = $_POST['brief_hx_diagnosis'];
    $pe = $_POST['pe'];
    $investigation_done = $_POST['investigation_done'];
     $student_id = $_POST['student_id'];
    $treatment_given = $_POST['treatment_given'];
    $reason_for_referal = $_POST['reason_for_referal'];
    $sql = "INSERT INTO referal values('$student_id','$to','$cc','$brief_hx_diagnosis','$pe','$investigation_done','$treatment_given','$reason_for_referal','$refer_time','$refered_by',1)";
    $res = mysqli_query($conn, $sql);
    if($res)
    	echo 1;
    else
    	echo "Error: ".mysqli_error($conn);
	}
 ?>