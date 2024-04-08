<?php 
session_start();
include "../include/dbc.inc.php";
	if(isset($_POST['requested_id'])){
		include "../include/dbc.inc.php";
		$request_id = $_POST['requested_id'];
		$requested_amount = $_POST['requested_amount'];
		$store_id = $_POST['provided_drug_id']; 

		//echo count($request_id).":".count($requested_amount).":".count($store_id);

		$output = '';
		$sql = '';
		$sql2 = '';
		$date = date("Y-m-d");
		$manager = $_SESSION['user_id'];
		for ($i=0; $i < count($request_id); $i++) { 
			
			$request_id_1 = $request_id[$i];
			$requested_amount_1 = $requested_amount[$i];
			$store_id_1 = $store_id[$i];
			//$output .= $request_id_1.$requested_amount_1.$store_id_1;

			 $sql .= "UPDATE provide_request SET approved_by = '$manager', approved_date = '$date', status = 3 WHERE request_id = '$request_id_1';";
			 $sql .= "UPDATE drug_store set quantity = quantity - '$requested_amount_1'  where  drug_id = '$store_id_1';";
		}
		//echo $output;
		if( mysqli_multi_query($conn, $sql) )
			echo 1;
		else
			echo "Error: ".mysqli_error($conn);
	}
	 ?>