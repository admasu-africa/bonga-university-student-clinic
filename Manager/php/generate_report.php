<?php 
include '../include/dbc.inc.php';
if(isset($_POST['start_date']) && isset($_POST['end_date'])){
	$department = $_POST['department'];
	if($department == 'card'){
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];
	$output = '';
	//echo $start_date.$end_date;
	$sql = "SELECT * FROM `patient` INNER JOIN patient_info on patient_info.student_id = patient.student_id WHERE patient_info.visited_date = patient.registered_date and patient_info.visited_date BETWEEN '$start_date' AND '$end_date';";
	$res = mysqli_query($conn, $sql);
	$no_of_new_patient = mysqli_num_rows($res);
	// $output .= "New Patient: ".$no_of_new_patient;
	$sql1 = "SELECT * FROM `patient` INNER JOIN patient_info on patient_info.student_id = patient.student_id WHERE patient_info.visited_date != patient.registered_date and patient_info.visited_date BETWEEN '$start_date' AND '$end_date';";
	$res1 = mysqli_query($conn, $sql1);
	$no_of_exist_patient = mysqli_num_rows($res1);
	// $output .= "Existing Patient: ".$no_of_exist_patient;
	if($no_of_new_patient == 0 && $no_of_exist_patient == 0)
		$output .= 1;
	else{
		$output .= "<div id='print_content'>";
		$output .= "<table class='table table-bordered  table-hover text-centered'>
	<thead>
			<tr>
			<th colspan='5'><center>Bonga University Student Clinic</center></th>
			</tr>
			<tr>
				<th colspan='5'><center>Card Department Report</center></th>
			</tr>
		<tr>
			<th>#</th>
			<th>Dates Between</th>	
			<th>New Registered Patient</th>
			<th>Existing Visited patient</th>
			<th>Total</th>		
		</tr>
	</thead>
	<tbody>
		<td>1</td>
		<td>".$start_date." - ".$end_date."</td>
		<td>".$no_of_new_patient."</td>
		<td>".$no_of_exist_patient."</td>
		<td>".($no_of_exist_patient + $no_of_new_patient)."</td>
		
	</tbody>
</table>";
$output .= "</div>";
$output .= "<button class='btn btn-success' onclick='printContent();'>Print</button>";
	}
	echo $output;
 }else if($department == 'lab'){
 	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];
	$output = '';
	$urine_hg = 0;
	$chemistry = 0;
	$tb = 0;
	$hiv = 0;
	$S_E = 0;
	$microcopy = 0;
	$B_F = 0;
	$sql = "SELECT lab_test FROM  patient_info WHERE patient_info.visited_date BETWEEN '$start_date' AND '$end_date';";
	$res = mysqli_query($conn, $sql);
	$no_of_lab_test = mysqli_num_rows($res);
	if($no_of_lab_test > 0){
		while ($row = mysqli_fetch_assoc($res)) {
			$lab_test = $row['lab_test'];
			$mark = explode(",", $lab_test);
		 		foreach ($mark as $value) {
		 			if($value == "Urine_HG")
		 				$urine_hg++;
		 			if($value == "TB")	
		 				$tb++;
		 			if($value == "HIV")
						$hiv++;
		 			if($value == "SE")
		 				$S_E++;
		 			if($value == "Microcopy")	
		 				$microcopy++;
		 			if($value == "BF")
						$B_F++;
		 		}
}
		$output .= "<div id='print_content'>";
		$output .= "<table class='table table-bordered table-hover text-centered'>
	<thead>
		<tr>
			<th colspan='8'><center>Bonga University Student Clinic</center></th>
		</tr>
			<tr>
				<th colspan='8'><center>Laboratory Report</center></th>
			</tr>
		<tr>
			<th>Dates Between</th>	
			<th>Urine HG</th>
			<th>TB</th>
			<th>HIV</th>
			<th>S/E</th>
			<th>Microscopy</th>
			<th>B/F</th>
			<th>Total</th>
					
		</tr>
	</thead>
	<tbody>
		<td>".$start_date." - ".$end_date."</td>
		<td>".$urine_hg."</td>
		<td>".$tb."</td>
		<td>".$hiv."</td>
		<td>".$S_E."</td>
		<td>".$microcopy."</td>
		<td>".$B_F."</td>
		<td>".($urine_hg + $chemistry + $tb + $hiv + $S_E + $microcopy + $B_F)."</td>	
	</tbody>
</table>";
$output .= "</div>";
$output .= "<button class='btn btn-success' onclick='printContent();'>Print</button>";
	
  }else
	$output .= 1;
	echo $output;
	}
else if($department == 'opd'){
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];
	$output = '';
	$sql = "SELECT * FROM  patient_info WHERE patient_info.visited_date BETWEEN '$start_date' AND '$end_date';";
	$res = mysqli_query($conn, $sql);
	$no_of_visited = mysqli_num_rows($res);
	if($no_of_visited == 0)
		 $output .= 1;
	else{
		$output .= "<div id='print_content'>";
		$output .= "<table class='table table-bordered table-hover text-centered'>
	<thead>
			<tr>
			<th colspan='3'><center>Bonga University Student Clinic</center></th>
			</tr>
			<tr>
				<th colspan='3'><center>OPD Report</center></th>
			</tr>
		<tr>
			<th>Dates Between</th>	
			<th>Number of Visited Patient</th>
		</tr>
	</thead>
	<tbody>
		<td>".$start_date." - ".$end_date."</td>
		<td>".$no_of_visited."</td>
		
	</tbody>
</table>";
$output .= "</div>";
$output .= "<button class='btn btn-success' onclick='printContent();'>Print</button>";
	}
		echo $output;
  }	
}
?>
