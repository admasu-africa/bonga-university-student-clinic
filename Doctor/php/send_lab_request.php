<?php include "../include/dbc.inc.php"; 
if(isset(($_POST['labtest']))){
	$labtest = $_POST['labtest'];
	$id = $_POST['id'];
	$fname = $_POST['fname'];
	$mname = $_POST['mname'];
	//echo $labtest.$id.$fname.$mname;
	$sql = "UPDATE patient_info set lab_test = '$labtest', status = 2 WHERE student_id = '$id' AND status = 1";
	$res = mysqli_query($conn, $sql);
	if($res)
		echo 1;
	else
		echo "Error: ".mysqli_error($conn);
}
?>
