<?php 
	require '../include/dbc.inc.php';
	if(isset($_POST['name'])){
		$drug_name = $_POST['name'];
		$drug_qty = $_POST['qty'];
		$drug_measure = $_POST['measure'];
		$drug_batch_no = $_POST['batch_no'];
		$drug_expire_date = $_POST['expire_date'];
		$date = date("Y-m-d");
		$pharmacist = $_SESSION['user_id'];
		//echo count($drug_name);

		$sql = '';
		for ($i=0; $i < count($drug_name); $i++) { 
			$drug_name_clear = mysqli_real_escape_string($conn, $drug_name[$i]);
			$drug_qty_clear = mysqli_real_escape_string($conn, $drug_qty[$i]);
			$drug_measure_clear = mysqli_real_escape_string($conn, $drug_measure[$i]);
			$drug_batch_no_clear = mysqli_real_escape_string($conn, $drug_batch_no[$i]);
			$drug_expire_date_clear = mysqli_real_escape_string($conn, $drug_expire_date[$i]);

			if($drug_name_clear != '' && $drug_qty_clear !='' && $drug_measure_clear != '' && $drug_batch_no_clear != '' && $drug_expire_date_clear != ''){
				$sql .= "INSERT INTO drug_store(drug_name, quantity, measure, batch_no, expire_date,supplier,registered_date,registered_by) VALUES('$drug_name_clear','$drug_qty_clear','$drug_measure_clear','$drug_batch_no_clear','$drug_expire_date_clear',1,'$date','$pharmacist');";
			}
			else{
				echo "Please fill all fields";
			}
		}
		if($sql != null){
			$res = mysqli_multi_query($conn, $sql);
			if($res)
				echo 1;
			else
				echo "Error: ".mysqli_error($conn);
		}else{
			echo "Please fill all field";
		}
	}
	if(isset($_GET['action']) && $_GET['action'] == "register"){
			$req_num = $_GET['req_num'];
			$id = $_GET['id'];
			//echo $req_num.$id;
			$sql = "UPDATE provide_request SET requested_quantity = '$req_num' WHERE request_id = '$id'";
			$res = mysqli_query($conn,$sql);
			if($res)
				echo 1;
			else
				echo "Error: ".mysqli_error($conn);
		}
 ?>
