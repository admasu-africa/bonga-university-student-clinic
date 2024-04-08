<?php 
session_start();
$id = $_GET['id'];
$conn = mysqli_connect('localhost','root','','BUC');
$sql = "SELECT * FROM patient INNER JOIN  patient_info on patient.student_id = patient_info.student_id WHERE patient.student_id = '$id' AND (patient.status = 1 OR patient_info.status = 2 OR patient_info.status = 3 OR patient_info.status = 1 OR patient_info.status = 4);";

// $sql3 = "SELECT * FROM patient WHERE student_id '$id' AND status = 1";
// $res3 = mysqli_query($conn,$sql3);
// $resCheck2 = mysqli_num_rows($res3);
// if($resCheck2 > 0){
// 	while($row2 = mysqli_fetch_assoc($res3)){
// 	$_SESSION['transfer'] = "<strong> ".$row2['fname'] ."</strong> with Id <strong>".$id."</strong> is alredy sent to Doctor";
// 	header("location:../search.php");
// 	}
// }else{

$res = mysqli_query($conn, $sql);
$resCheck = mysqli_num_rows($res);
if($resCheck > 0){
	$row = mysqli_fetch_assoc($res);
	$_SESSION['transfer'] = "<strong> ".$row['fname'] ."</strong> with Id <strong>".$id."</strong> is alredy sent to Doctor";
	header("location:../search.php");
}else{
$sql2 = "UPDATE patient SET status = 1 WHERE student_id = '$id'";
$res1 = mysqli_query($conn, $sql2);
	if($res1 == true){
		$_SESSION['transfer'] = 1;
		header("location:../search.php");
	}else{
		$_SESSION['transfer'] = "Failed to transfer<br>";
		echo mysqli_error($conn)."<br>";
		header("location:../search.php");
		}
	}
//}
 ?>
