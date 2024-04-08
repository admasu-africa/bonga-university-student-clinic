<?php 
	$output = '';
	include '../include/dbc.inc.php';
	if(isset($_POST['searchp'])){
		$search = $_POST['searchp'];
		//echo "Its seted wow: ".$search;
		if($search != "")
			$sql = "SELECT * FROM patient WHERE student_id like '%$search%' OR fname like '%$search%'";	
		else
			$sql = "SELECT * FROM patient";

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
					<td><button class='btn btn-primary student_detail' value='". $row['student_id']."'>Detail</button></a></td>
				</tr>";
				$i++;
			}	
			$output .= "</tbody>";
			echo $output;
		
		}else
			echo "<h3> Search Not Found! </h3>";

	}else
		echo "Error: ".mysqli_error($conn);
}		

if(isset($_POST['searchemp'])){
		$search = $_POST['searchemp'];
		if($search != "")
			$sql = "SELECT * FROM employee WHERE employee_id like '%$search%' OR fname like '%$search%'";
		else
			$sql = "SELECT * FROM employee ";

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
				<th>Last Name</th>
				<th>Phone Number Name</th>
				<th>Address</th>
				<th>Position</th>
				<th>Action</th>
				</tr>
			</thead>
			<tbody>";
			while($row = mysqli_fetch_assoc($result)){
				$output .= "
				<tr>
					<td>".$i."</td>
					<td>".$row['employee_id']."</td>
					<td>".$row['fname']."</td>
					<td>".$row['lname']."</td>
					<td>".$row['phone_no']."</td>
					<td>".$row['address']."</td>
					<td>".$row['position']."</td>
					<td><button class='btn btn-primary employee_detail' value='".$row['employee_id']."'>Detail</button>";
					if($row['position'] == 'Pharmacist'){
					$output .= "<button class='btn btn-success add_privilage' value='".$row['employee_id']."' style='width: 90px;'><i class='fas fa-circle-plus'></i> Role</button>
						</td>";
					}else if($row['position'] == "Storekeeper"){
					 $output .= "<button class='btn btn-danger remove_privilage' value='".$row['employee_id']."' style='width: 90px;'><i class='fas fa-minus-circle'></i> Role</button>";
					}	
				$output .= "</tr>";
				$i++;
			}	
			$output .= "</tbody>";
			echo $output;
		
		}else
			echo "<h3> Search Not Found! </h3>";

	}else
		echo "Error: ".mysqli_error($conn);		
}
 ?>
 <script type="text/javascript">
 	$(document).ready(function(){
 		$(".student_detail").click(function(){
		var id = $(this).val();
		$.ajax({
			url:'php/display_person_detail.php',
			method:'post',
			data:{student_id:id},
			success:function(response){
				$("#display_student_detail").html(response);
				$("#student_detail").modal('show');
			}
		});
		
	});
 	$(".employee_detail").click(function(){
		var id = $(this).val();
		$.ajax({
			url:'php/display_person_detail.php',
			method:'post',
			data:{employee_id:id},
			success:function(response){
				$("#display_employee_detail").html(response);
				$("#employee_detail").modal('show');
			}
		});
		
	});
 });
 </script>