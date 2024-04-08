<?php 
	require '../include/dbc.inc.php';

	$sql = "SELECT lab_test from patient_info";	

	$urine = 0;
	$blood = 0;
	$feaces = 0;
	$saliva = 0;
	$res = mysqli_query($conn, $sql);
	$resCheck = mysqli_num_rows($res);
	if($resCheck > 0){
		while ($row = mysqli_fetch_assoc($res)) {
			$lab_test = $row['lab_test'];
			//echo $lab_test;
			$mark = explode(",", $lab_test);
		 		foreach ($mark as $value) {
		 			if($value == "Urine")
		 				$urine++;
		 			if($value == "Saliva")
		 				$saliva++;
		 			if($value == "Blood")	
		 				$blood++;
		 			if($value == "Faeces")
						$feaces++;
		 		}
		}
		echo "Urine:".$urine.",Blood:".$blood.",Saliva:".$saliva."Feaces:".$feaces;
	}
 ?>