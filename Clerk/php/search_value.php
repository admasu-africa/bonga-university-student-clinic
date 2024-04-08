<?php 
	$output = '';
	include '../include/dbc.inc.php';
	if(isset($_POST['action'])){
		$search = $_POST['action'];
		//echo "Its seted wow: ".$search;
		$sql = "SELECT * FROM patient WHERE student_id like '%$search%' OR fname like '%$search%'";
		
	}else{
		$sql = "SELECT * FROM patient";
	}
		$result = mysqli_query($conn, $sql);
		if($result == true){
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck > 0){
			$i = 1;
			$output = "
			<thead>
				<tr>
				<th>#</th>
				<th>ID</th>
				<th>First Name</th>
				<th>Middle Name</th>
				<th>Dept</th>
				<th>R.Date</th>
				<th>Action</th>
				</tr>
			</thead>
			<tbody>";
			while($row = mysqli_fetch_assoc($result)){
				$output .= "
				<tr>
					<td>".$i."</td>
					<td>".$row['student_id']."</td>
					<td>".$row['fname']."</td>
					<td>".$row['mname']."</td>
					<td>".$row['dept']."</td>
					<td>".$row['registered_date']."</td>
					<td><a href='../Clerk/php/transfer_to_doctor.php?id=".$row['student_id']."'><button class='btn btn-primary'>Send</button></a></td>
				</tr>";
				$i++;
			}	
			$output .= "</tbody>";
			echo $output;
		
		}else
			echo "<h3> Search Not Found! </h3>
			<h4><a href='../Clerk/registration.php'>Register?</a></h4>";
	}else
		echo "Error: ".mysqli_error($conn);
 ?>