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
					<td><button class='btn btn-primary student_detail' value='".$row['student_id']."'>Detail</button>";
					if($row['status'] == 1){
						$output .= "<button class='btn btn-danger student_deactive' value='".$row['student_id']."' style='width: 75px; margin: 15px;'>Deactive</button>";
					}else{
						$output .= "<button class='btn btn-success student_active' value='".$row['student_id']."' style='width: 75px; margin: 5px;'>Active</button>";
					}
					// $output .= "<button class='btn btn-secondary student_reset_pass' value='".$row['student_id']."'>Reset</button></td>
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

if(isset($_POST['searchemp'])){
		$search = $_POST['searchemp'];
		if($search != "")
			$sql = "SELECT * FROM employee WHERE employee_id like '%$search%' OR fname like '%$search%'";
		else
			$sql = "SELECT * FROM employee";

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
					if($row['status'] == 1){
						$output .= "<button class='btn btn-danger employee_deactive' value='".$row['employee_id']."' style='width: 75px; margin: 5px;'>Deactive</button>";
					}else{
						$output .= "<button class='btn btn-success employee_active' value='".$row['employee_id']."' style='width: 75px; margin: 5px;'>Active</button>";
					}
					// $output .= "<button class='btn btn-secondary employee_reset_pass' value='".$row['employee_id']."'>Reset</button></td>
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
 		$("#table1").DataTable({});
 	$(".student_detail").click(function(){
		var id = $(this).val();
		$.ajax({
			url:'php/display_person_detail.php',
			method:'post',
			data:{student_detail:"detail",student_id:id},
			success:function(response){
				$("#display_student_detail").html(response);
				$("#student_detail").modal('show');
			}
		});
		
	});
	$(".student_deactive").click(function(){
	var id = $(this).val();
	if(confirm("Are You Sure to Deactive Student account?")){
		$.ajax({
			url:'php/display_person_detail.php',
			method:'post',
			data:{deactive_stud:"detail",student_id:id},
			success:function(response){
				if(response == 1)
					alert("Selected Student account deactivated");
				else
					alert(response);
				// $("#display_employee_detail").html(response);
				// $("#employee_detail").modal('show');
			}
		});
	}
});
$(".student_active").click(function(){
	var id = $(this).val();
	if(confirm("Are You Sure to Active Student account?")){
		$.ajax({
			url:'php/display_person_detail.php',
			method:'post',
			data:{active_stud:"detail",student_id:id},
			success:function(response){
				if(response == 1)
					alert("Selected Student account activated");
				else
					alert(response);
				// $("#display_employee_detail").html(response);
				// $("#employee_detail").modal('show');
			}
		});
	}
});
$(".student_reset_pass").click(function(){
	var id = $(this).val();
	if(confirm("Are You Sure to Reset Student Password?")){
		$.ajax({
			url:'php/display_person_detail.php',
			method:'post',
			data:{reset_stud_pass:"detail",student_id:id},
			success:function(response){
				if(response == 1)
					alert("Selected Student Password Resseted");
				else
					alert(response);
				// $("#display_employee_detail").html(response);
				// $("#employee_detail").modal('show');
			}
		});
	}
});	



	$(".employee_detail").click(function(){
		var id = $(this).val();
		$.ajax({
			url:'php/display_person_detail.php',
			method:'post',
			data:{employe_detail:"detail",employee_id:id},
			success:function(response){
				$("#display_employee_detail").html(response);
				$("#employee_detail").modal('show');
			}
		});
		
	});	
$(".employee_deactive").click(function(){
	var id = $(this).val();
	if(confirm("Are You Sure to Deactive employee account?")){
		$.ajax({
			url:'php/display_person_detail.php',
			method:'post',
			data:{deactive_emp:"detail",employee_id:id},
			success:function(response){
				if(response == 1)
					alert("Selected employee account deactivated");
				else
					alert(response);
				// $("#display_employee_detail").html(response);
				// $("#employee_detail").modal('show');
			}
		});
	}
});
$(".employee_active").click(function(){
	var id = $(this).val();
	if(confirm("Are You Sure to Active employee account?")){
		$.ajax({
			url:'php/display_person_detail.php',
			method:'post',
			data:{active_emp:"detail",employee_id:id},
			success:function(response){
				if(response == 1)
					alert("Selected employee account activated");
				else
					alert(response);
				// $("#display_employee_detail").html(response);
				// $("#employee_detail").modal('show');
			}
		});
	}
});
$(".employee_reset_pass").click(function(){
	var id = $(this).val();
	if(confirm("Are You Sure to Reset employee Password?")){
		$.ajax({
			url:'php/display_person_detail.php',
			method:'post',
			data:{reset_emp_pass:"detail",employee_id:id},
			success:function(response){
				if(response == 1)
					alert("Selected employee Password Resseted");
				else
					alert(response);
				// $("#display_employee_detail").html(response);
				// $("#employee_detail").modal('show');
			}
		});
	}
});
 });
 </script>