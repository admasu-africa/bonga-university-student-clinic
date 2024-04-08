<?php 
	include '../include/dbc.inc.php';
	if(isset($_POST['id'])){
	$id = ucwords($_POST['id']);
	$fname = ucwords($_POST['fname']);
	$mname = ucwords($_POST['mname']);
	$lname = ucwords($_POST['lname']);
	$dept = ucwords($_POST['dept']);
	$batch  = $_POST['batch'];
	$sex  = $_POST['sex'];
	$age  = $_POST['age'];
	$region  = $_POST['region'];
	$zone  = $_POST['zone'];
	$kebele  = $_POST['kebele'];
	$phone_no  = $_POST['phone_no'];
	$registered_date = date("Y-m-d");
	//echo "ID: ".$id.",Fname: ".$fname.", Mname: ".$mname.", Lname: ".$lname.", Dept: ".$dept.", Batch: ".$batch.", sex: ".$sex.", Age: ".$age.", Region: ".$region.", Zone: ".$zone.", Kebele: ".$kebele.", Phone No: ".$phone_no;
	
	$sql = "SELECT * FROM patient WHERE student_id = '$id'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		$row = mysqli_fetch_assoc($result);
		echo "Student <strong>".$row['fname']."</strong> whith ID <strong>".$id."</strong> is alredy exist!";
	}else{
		$password = "$mname"."abc123";
		$passwordMd5 = md5($password);
		// echo $id." ".$fname." ".$mname." ".$lname." ".$dept." ".$sex." ".$age." ".$region." ";
		$sql2 = "INSERT INTO patient VALUES('$id','$fname','$mname','$lname','$passwordMd5','$dept','$batch ','$sex','$age','$region','$zone','$kebele','$phone_no','$registered_date',1,1)";
		if(mysqli_query($conn, $sql2))
			echo 1;
		else
			echo 2;
	}
}	

 ?>