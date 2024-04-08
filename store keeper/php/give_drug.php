<?php 
session_start();
	include '../include/dbc.inc.php';
	if (isset($_POST['did'])) {

		$length = count($_POST['dosage']);

		$drug_id = $_POST['did'];
		// $drug_name = $_POST['dname'];
		$dose = $_POST['dosage'];
		// $description = $_POST['description'];
		$status = $_POST['status'];
		$student_id = $_POST['student_id'];
		$paii = $_POST['paii'];
		$pharmacist = $_SESSION['user_id'];
		$output = '';
		$sql = '';
		// $sql1 = 'SELECT * FROM provide_request WHERE request_id = -10;';
		// $sql2 = 'SELECT * FROM provide_request WHERE request_id = -10;';
		// $sql3 = 'SELECT * FROM provide_request WHERE request_id = -10;';

		for ($i=0; $i < $length; $i++) { 

			$drug_id_1 = $drug_id[$i];
			// $drug_name_1 = $drug_name[$i];
			$dose_1 = $dose[$i];
			// $description_1 = $description[$i];
			 $status_1 = $status[$i];
			// if($drug_id_1 != null)
			//  $output .= $drug_id_1 ." ".$status_1.",";

			
			if($drug_id_1 != null){
				if( $status_1 == 1){
					
					//$output .= "status_1 , ";
				// $sql .= "UPDATE prescription set given_dose = '$dose_1', given_by = '$pharmacist' where drug_id = '$drug_id_1' AND patient_info_id = '$paii'";

				// $sql3 .= "UPDATE pharmacy set quantity = quantity - '$dose_1' WHERE drug_id = '$drug_id_1'";
				$sql .= "UPDATE prescription set given_dose = '$dose_1', given_by = '$pharmacist' where drug_id = '$drug_id_1' AND patient_info_id = '$paii';";

				$sql .= "UPDATE pharmacy set quantity = quantity - '$dose_1' WHERE drug_id = '$drug_id_1';";
			}else if($status_1 == 4){
				$value = available($drug_id_1);
				//$output .= "status_4 , and value: ".$value.", ";

				// $sql .= "UPDATE prescription set given_dose = '$value', given_by = '$pharmacist' where drug_id = '$drug_id_1' AND patient_info_id = '$paii'";

				// $sql3 .= "UPDATE pharmacy set quantity = quantity - '$value' WHERE drug_id = '$drug_id_1'";
				$sql .= "UPDATE prescription set given_dose = '$value', given_by = '$pharmacist' where drug_id = '$drug_id_1' AND patient_info_id = '$paii';";

				$sql .= "UPDATE pharmacy set quantity = quantity - '$value' WHERE drug_id = '$drug_id_1';";
			}
		}
			

		}
		 $sql .= "UPDATE patient_info set status = 0 WHERE student_id = '$student_id' AND patient_info_id = '$paii';";
		//$sql3 = "UPDATE patient_info set status = 0 WHERE student_id = '$student_id' AND patient_info_id = '$paii'";
		$result = mysqli_multi_query($conn,$sql);
		// if($result)
		// 	echo 1;
		// else
		// 	echo "Error: ".mysqli_error($conn);
		// if(mysqli_multi_query($conn,$sql) && mysqli_multi_query($conn,$sql1) && mysqli_query($conn,$sql2) && mysqli_query($conn,$sql3) && mysqli_query($conn,$sql4))
		if($result)
			echo 1;
		else
			echo "Error: ".mysqli_error($conn);
		//echo $output;
	}

	function available($did){
		$conn = mysqli_connect("localhost","root","","BUC");
		$sql2 = "SELECT quantity from pharmacy WHERE drug_id = '$did' AND quantity > 0";
		$res = mysqli_query($conn, $sql2);
		$resCheck = mysqli_num_rows($res);

		if($resCheck > 0){
			$row = mysqli_fetch_array($res);
			$quantity = $row['quantity'];
			return $quantity;
		}
	}
	// if($_POST['variable'])
 ?>