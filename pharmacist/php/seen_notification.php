<?php 
include '../include/dbc.inc.php';
if(isset($_POST['clear'])){
	$sql = "UPDATE notification set status = 0 WHERE status = 1";
	$res = mysqli_query($conn, $sql);
	if($res)
		header("location:../index.php");
	else
		echo "Error: ".mysqli_error($conn);
}

 ?>