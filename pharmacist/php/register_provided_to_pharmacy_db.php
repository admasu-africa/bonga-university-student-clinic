<?php 
session_start();
	require '../include/dbc.inc.php';

	if(isset($_POST['drug_id'])){
		$length = count($_POST['drug_id']);

		$drug_id = $_POST['drug_id'];
		$request_id = $_POST['request_id'];
		$equivalent_qty = $_POST['equivalent_qty'];
		$measure = $_POST['equivalent_measure'];
		$expire_date = $_POST['expire_date'];

		$date = date("Y-m-d");

		$sql = '';
		$output = "";
		$comfirmed_by = $_SESSION['user_id'];

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

		 $res2 = mysqli_query($conn, "SELECT * FROM pharmacy inner join drug_store on pharmacy.drug_id = drug_store.drug_id WHERE pharmacy.drug_id = '$drug_id_1' AND drug_store.expire_date = '$expire_date_1'");
		 $resCheck2 = mysqli_num_rows($res2);
		 if($resCheck2 > 0){
		 	$sql .= "UPDATE pharmacy set quantity = quantity + '$quantity' WHERE drug_id = '$drug_id_1'";
		 }else{
		 	$sql .= "INSERT INTO pharmacy(drug_id,request_id,quantity, measure, registered_date, provided_by, comfirmed_by) 
								VALUES('$drug_id_1','$request_id_1','$quantity','$measure_1','$date','$store_keeper','$comfirmed_by');";
	
		 }
		 $sql .= "UPDATE provide_request SET status = 0, registered_by = '$comfirmed_by',registered_date = '$date' WHERE request_id = '$request_id_1';";
		
	}
	//echo $output;
		if((mysqli_multi_query($conn, $sql)) )
			echo 1;
		else
			echo "Error: ".mysqli_error($conn);
}

 ?>