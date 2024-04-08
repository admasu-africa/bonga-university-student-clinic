<?php include '../include/dbc.inc.php';
if(isset($_POST['student_id'])){
	$student_id = $_POST['student_id'];
	$sql = "SELECT * FROM patient WHERE student_id = '$student_id'";
	$res = mysqli_query($conn, $sql);
	$resCheck = mysqli_num_rows($res);
	$output = '';
	if($resCheck > 0){
		while ($row = mysqli_fetch_assoc($res)) {
			$output .= "<div class'row'>";
			$output .= "<span><strong class'gx-5'>Student Name</strong>:  ".$row['fname']."</span><br>";
			$output .= "<span><strong>Father</strong>:  ".$row['mname']."</span><br>";
			$output .= "<span><strong>Grand Father Number</strong>:  ".$row['lname']."</span><br>";	
			$output .= "<span><strong>Department</strong>:  ".$row['dept']."</span><br>";		
			$output .= "<span><strong>Batch</strong>:  ".$row['batch']."</span><br>";
			$output .= "<span><strong>Sex</strong>:  ".$row['sex']."</span><br>";
			$output .= "<span><strong>Age</strong>:  ".$row['age']."</span><br>";
			$output .= "<span><strong>Region</strong>:  ".$row['region']."</span><br>";
			$output .= "<span><strong>Zone</strong>:  ".$row['zone']."</span><br>";
			$output .= "<span><strong>Kebele</strong>:  ".$row['kebele']."</span><br>";
			$output .= "<span><strong>Phone Number</strong>:  ".$row['phone_no']."</span><br>";
			$output .= "<span><strong>Registered Date</strong>:  ".$row['registered_date']."</span><br>";
			$output .= "</div>";
		}
	}
	echo $output;
}
if(isset($_POST['employee_id'])){
	$employee_id = $_POST['employee_id'];
	$sql = "SELECT * FROM employee as emp WHERE employee_id = '$employee_id'";
	$res = mysqli_query($conn, $sql);
	$resCheck = mysqli_num_rows($res);
	$output = '';
	if($resCheck > 0){
		while ($row = mysqli_fetch_assoc($res)) {
			$output .= "<div class'row'>";
			$output .= "<span><strong class'gx-5'>Employee Name</strong>:  ".$row['fname']."</span><br>";
			$output .= "<span><strong>Father</strong>:  ".$row['lname']."</span><br>";
			$output .= "<span><strong>Position</strong>:  ".$row['position']."</span><br>";		
			$output .= "<span><strong>Address</strong>:  ".$row['address']."</span><br>";
				$output .= "<span><strong>Phone Number</strong>:  ".$row['phone_no']."</span><br>";
			$output .= "<span><strong>Registered Date</strong>:  ".$row['registered_date']."</span><br>";
			$output .= "</div>";
		}
	}
	echo $output;
}