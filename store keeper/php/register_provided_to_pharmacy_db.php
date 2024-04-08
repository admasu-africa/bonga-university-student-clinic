<?php 
	require '../include/dbc.inc.php';

	if(isset($_POST['drug_id'])){
		$length = count($_POST['drug_id']);

		$drug_id = $_POST['drug_id'];
		$request_id = $_POST['request_id'];
		$equivalent_qty = $_POST['equivalent_qty'];
		$measure = $_POST['equivalent_measure'];
		$expire_date = $_POST['expire_date'];
		$pharmacist = $_SESSION['user_id'];
		$date = date("Y-m-d");

		$sql = '';
		$output = "";

		for ($i=0; $i < $length; $i++) { 

		$drug_id_1 = $drug_id[$i]; 
		$request_id_1 = $request_id[$i]; 
		$equivalent_qty_1 = $equivalent_qty[$i]; 
		$measure_1 = $measure[$i]; 
		$expire_date_1 = $expire_date[$i]; 

		$res = mysqli_query($conn,"SELECT comfirmed_by, requested_quantity FROM provide_request WHERE request_id = '$request_id_1'");
		$row = mysqli_fetch_assoc($res);

			//$output .= $row['comfirmed_by'].":".$row['requested_quantity'].",";
		$store_keeper = $row['comfirmed_by'];

		 $quantity = $equivalent_qty_1 * $row['requested_quantity'];

		 //$output .=  $quantity;

		$sql .= "INSERT INTO pharmacy(drug_id,request_id,quantity, measure, registered_date, provided_by, comfirmed_by) 
								VALUES('$drug_id_1','$request_id_1','$quantity','$measure_1','$date','$store_keeper','$pharmacist');";

		$sql .= "UPDATE provide_request SET status = 0 WHERE request_id = '$request_id_1';";
	}
	//echo $output;
		if((mysqli_multi_query($conn, $sql)) )
			echo 1;
		else
			echo "Error: ".mysqli_error($conn);
}

 ?>