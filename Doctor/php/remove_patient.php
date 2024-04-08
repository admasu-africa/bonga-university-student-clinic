
<?php 
	include "../include/dbc.inc.php";
	if (isset($_GET['action']) && $_GET['action'] == 'remove_from_OPD') {
		$student_id = $_GET['student_id'];
		$sql = "UPDATE patient SET status = 0 WHERE student_id = '$student_id'";
		$res = mysqli_query($conn, $sql);
		if ($res) 
			echo 1;
		else
			echo "Error: ".mysqli_error($conn);
	}
	if (isset($_GET['action']) && $_GET['action'] == 'remove_from_OPD2') {
		$student_id = $_GET['student_id'];
		$sql = "UPDATE patient_info SET status = 0 WHERE student_id = '$student_id'";
		$res = mysqli_query($conn, $sql);
		if ($res) 
			echo 1;
		else
			echo "Error: ".mysqli_error($conn);
	}

	if (isset($_GET['action']) && $_GET['action'] == 'refresh') {
		$sql = "select student_id, fname, lname from patient where status = 1 ";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);
		 if($resultCheck > 0){
		 	$output = '';
		 	$output .= "<thead>
		 			<tr>
		 				<th>#</th>
		 				<th>ID</th>
		 				<th>Student Name</th>
		 				<th>Last Name</th>
		 				<th>Action</th>
		 			</tr>
		 		</thead>
		 		<tbody>";
		$i = 1;
		 	while ($row = mysqli_fetch_assoc($result)) {
		 		
		 	$output .= "<tr>
		 			<td>". $i ."</td>
		 			<td>". $row['student_id'] ."</td>
		 			<td>". $row['fname'] ."</td>
		 			<td>". $row['lname'] ."</td>

		 			<td><a href='opd.php?id=".$row['student_id']."'><button class='btn btn-success treat'>Treate</button></a>	

					<button class='btn btn-danger remove' id='remove_patient' onclick=\"removePatient('".$row['student_id']."','". $row['fname']."')\">Remove</button></td>

		 		</tr>";
		 		$i++;
		 	}	
			$output .= "</tbody>";
			echo $output;
	}
}

 ?>