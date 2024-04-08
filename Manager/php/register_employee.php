<?php 
session_start();
	include '../include/dbc.inc.php';
	if(isset($_POST['register'])){
	$id = ucwords($_POST['id']);
	$fname = ucwords($_POST['fname']);
	$lname = ucwords($_POST['lname']);
	$position = ucwords($_POST['position']);
	$phone_no = $_POST['phone_no'];
	$address = $_POST['address'];
	$salary = $_POST['salary'];
	$registered_date = date("Y-m-d");
	 //echo $id." ".$fname." ".$lname.": ".$position." ".$phone_no." ".$salary." ".$address." ,";
	
	$sql = "SELECT * FROM employee WHERE employee_id = '$id'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		$row = mysqli_fetch_assoc($result);
		echo "Employee <strong>".$row['fname']."</strong> whith ID <strong>".$id."</strong> is alredy exist!";
	}else{
		$password = "$lname"."abc123";
		$passwordMd5 = md5($password);
		$sql = "INSERT INTO employee VALUES('$id','$fname','$lname','$passwordMd5','$position','$phone_no','$address','$salary','registered_date',1)";
		if(mysqli_query($conn, $sql))
			echo 1;
		else
			echo 2;
	}
}	
if(isset($_POST['update'])){
	$id = ucwords($_POST['id']);
	$fname = ucwords($_POST['fname']);
	$lname = ucwords($_POST['lname']);
	$position = ucwords($_POST['position']);
	$phone_no = $_POST['phone_no'];
	$address = $_POST['address'];
	$salary = $_POST['salary'];
	$chng_emp_id = $_SESSION['chng_emp_id'];
	$registered_date = date("Y-m-d");
	 //echo $id." ".$fname." ".$lname.": ".$position." ".$phone_no." ".$salary." ".$address." ,";
	
	// $sql = "SELECT * FROM employee WHERE employee_id = '$id'";
	// $result = mysqli_query($conn, $sql);
	// $resultCheck = mysqli_num_rows($result);
	// if($resultCheck > 0){
	// 	$row = mysqli_fetch_assoc($result);
	// 	echo "Employee <strong>".$row['fname']."</strong> whith ID <strong>".$id."</strong> is alredy exist!";
	// }else{
		// $password = "$lname"."abc123";
		// $passwordMd5 = md5($password);
		$sql = "UPDATE employee set employee_id = '$id',fname = '$fname',lname = '$lname',position = '$position',phone_no = '$phone_no',address = '$address',salary = '$salary' WHERE employee_id = '$chng_emp_id'";
		if(mysqli_query($conn, $sql)){
			unset($chng_emp_id);
			echo 1;
		}
		else
			echo 2;
	//}
}

 ?>
