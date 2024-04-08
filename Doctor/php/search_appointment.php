<?php 
include "../include/dbc.inc.php";
	if (isset($_GET['value'])) {
		$value = $_GET['value'];
		$sql = "SELECT pa.fname, pa.lname, pa.student_id, app.app_for_date from patient as pa INNER JOIN appointment as app on pa.student_id = app.student_id WHERE app.status = 1 and (pa.student_id like '%$value%' or pa.fname like '%$value%')";
		$res = mysqli_query($conn, $sql);
		$resCheck = mysqli_num_rows($res);
		if($resCheck > 0){
			$i = 1;
			$output = "
			<thead>
				<tr>
				<th>#</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>ID</th>
				<th>Appointment Date</th>
				<th></th>
				</tr>
			</thead>
			<tbody>";
			while($row = mysqli_fetch_assoc($res)){
				$output .= "
				<tr>
					<td>".$i."</td>
					<td>".$row['fname']."</td>
					<td>".$row['lname']."</td>
					<td>".$row['student_id']."</td>
					<td>".$row['app_for_date']."</td>
					<td><button type='button' value='".$row['student_id']."' class='btn btn-primary app_btn'>Treate</button></td>
				</tr>";
				$i++;
			}	
			$output .= "</tbody>";
			echo $output;
		
		}else
			echo "<h3> Search Not Found! </h3>";
	}else
		echo "Error: ".mysqli_error($conn);
 ?>
 <script type="text/javascript">
 	$(document).ready(function(){
 	$(".app_btn").click(function(){
		var student_id = $(this).val();
		$.ajax({
			url:'php/finish_appointment.php',
			method:'post',
			data:{student_id:student_id},
			success:function(response){
				if(response == 1)
					location.href = "../doctor/opd.php?id="+student_id;
				else
					$("#display_app_msg").html("<div class='alert alert-danger'>" +response+ "</div>");
			}
		});
	});
});
 </script>