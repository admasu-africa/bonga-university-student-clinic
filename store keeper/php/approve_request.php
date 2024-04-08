<?php 
session_start();
	include "../include/dbc.inc.php";
	if(isset($_POST['requested_id'])){
		include "../include/dbc.inc.php";
		$request_id = $_POST['requested_id'];
		// $requested_amount = $_POST['requested_amount'];
		$store_id = $_POST['provided_drug_id']; 
		$pharmacist = $_SESSION['user_id'];
		//echo count($request_id).":".count($requested_amount).":".count($store_id);

		$output = '';
		$sql = '';
		$sql2 = '';
		$date = date("Y-m-d");
		for ($i=0; $i < count($request_id); $i++) { 
			
			$request_id_1 = $request_id[$i];
			// $requested_amount_1 = $requested_amount[$i];
			$store_id_1 = $store_id[$i];
			//$output .= $request_id_1.$requested_amount_1.$store_id_1;

			 $sql .= "UPDATE provide_request SET comfirmed_by = '$pharmacist', comfirmed_date = '$date', status = 2 WHERE request_id = '$request_id_1';";
			 //$sql .= "UPDATE drug_store set quantity = quantity - '$requested_amount_1'  where  drug_id = '$store_id_1';";
		}
		//echo $output;
		if( mysqli_multi_query($conn, $sql) )
			echo 1;
		else
			echo "Error: ".mysqli_error($conn);
	}
	if (isset($_POST['value'])) {
		include "../include/dbc.inc.php";
		$value = $_POST['value'];
		if($value == 'dispensary'){
			showRequestedFromDispensary();
		}
		else if($value == 'app_by_me'){
			approvedByMe();
		}
		else if($value == 'app_by_manager'){
			approvedByManager();
		}
	}

	function showRequestedFromDispensary(){
		include "../include/dbc.inc.php";
		$sql = "SELECT ds.drug_name, prr.requested_quantity, ds.quantity, ds.measure, ds.expire_date, ds.drug_id, prr.request_id from provide_request as prr inner join drug_store as ds on ds.drug_id = prr.drug_id where  prr.status = 1";
		$res = mysqli_query($conn,$sql);
		$resCheck = mysqli_num_rows($res);
		$output = '';
		if($resCheck > 0){
			
			$i = 1;
			$output .= "
				<table class='table' id='mtable'>
			<thead>
				<tr>
					<th>#</th>
					<th>Drug Name</th>
					<th>Requested Quantity</th>
					<th>Available Quantity</th>
					<th>Expire Date</th>
					<th>Drug ID</th>
					<th>Request ID</th>
					<th>Action</th>
				</tr>
			</thead>
		<tbody>
			";
			while ($row = mysqli_fetch_assoc($res)) {
				$output .=  "<tr class='edit_table' id='row".$i."'>";
				$output .=  "<td>".$i."</td>";
				$output .=  "<td>".$row['drug_name']."</td>";
				$output .=  "<td class='requested_amount'>".$row['requested_quantity']." </td>";
				$output .=  "<td>".$row['quantity']." ".$row['measure']."</td>";
				$output .=  "<td>".$row['expire_date']." </td>";
				$output .=  "<td class='store_drug_id'>".$row['drug_id']." </td>";
				$output .=  "<td class='requested_drug_id'>".$row['request_id']." </td>";
				$output .=  "<td><a href='php/edit_request.php?id=".$row['request_id']."&name=".$row['drug_name']."&quantity=".$row['quantity']."&measure=".$row['measure']."&required=".$row['requested_quantity']."&expire_date=".$row['expire_date']."'><button class='btn btn-primary'>Edit</button></a>
					<button onclick='deleteRequest(".$row['request_id'].");' class='btn btn-danger delete'>Delete</button>
					</td>";
				$output .=  "</tr>";
				$i++;
			}
			$output .= "</tbody></table>
			<button class='btn btn-success' id='save_edited' style='text-align: left;'>Approve Request</button>";
	}else{
		$output .= "<div class='alert alert-info'>
				No Request Is Provided to store from Dispenasry
			</div>" ;
	}
	echo $output;
		
}
function approvedByMe(){
	include "../include/dbc.inc.php";
	$sql = "SELECT ds.drug_name, prr.requested_quantity, ds.quantity, ds.measure, ds.expire_date, ds.drug_id, prr.request_id, prr.comfirmed_by from provide_request as prr inner join drug_store as ds on ds.drug_id = prr.drug_id where  prr.status = 2";

	$res = mysqli_query($conn,$sql);
		$resCheck = mysqli_num_rows($res);
		$output = '';
		if($resCheck > 0){
			$output .= "
		<table class='table' id='mtable'>
			<thead>
				<tr>
					<th>#</th>
					<th>Drug Name</th>
					<th>Approved Quantity</th>
					<th>Available Quantity</th>
					<th>Expire Date</th>
					<th>Approved By</th>
				</tr>
			</thead>
		<tbody>";
		$i = 1;
		while ($row = mysqli_fetch_assoc($res)) {
				$output .=  "<tr class='edit_table'>";
				$output .=  "<td>".$i."</td>";
				$output .=  "<td>".$row['drug_name']."</td>";
				$output .=  "<td class='requested_amount'>".$row['requested_quantity']." </td>";
				$output .=  "<td>".$row['quantity']." ".$row['measure']."</td>";
				$output .=  "<td>".$row['expire_date']." </td>";
				$output .=  "<td>".$row['comfirmed_by']." </td>";
				$output .=  "</tr>";
				$i++;
			}
			$output .= "</tbody></table>";
		}else{
			$output .= "<div class='alert alert-info'>
				No Request Is waiting Manager Approval
			</div>" ;
		}
		echo $output;

}	
function approvedByManager(){
	include "../include/dbc.inc.php";
	$sql = "SELECT ds.drug_name, prr.requested_quantity, ds.quantity, ds.measure, ds.expire_date, ds.drug_id, prr.request_id, prr.comfirmed_by from provide_request as prr inner join drug_store as ds on ds.drug_id = prr.drug_id where  prr.status = 3";
	$res = mysqli_query($conn,$sql);
		$resCheck = mysqli_num_rows($res);
		$output = '';
		if($resCheck > 0){
			$output .= "
		<table class='table' id='mtable'>
			<thead>
				<tr>
					<th>#</th>
					<th>Drug Name</th>
					<th>Approved Quantity</th>
					<th>Available Quantity</th>
					<th>Expire Date</th>
					<th>Approved By</th>
				</tr>
			</thead>
		<tbody>";
		$i = 1;
		while ($row = mysqli_fetch_assoc($res)) {
				$output .=  "<tr class='edit_table'>";
				$output .=  "<td>".$i."</td>";
				$output .=  "<td>".$row['drug_name']."</td>";
				$output .=  "<td class='requested_amount'>".$row['requested_quantity']." </td>";
				$output .=  "<td>".$row['quantity']." ".$row['measure']."</td>";
				$output .=  "<td>".$row['expire_date']." </td>";
				$output .=  "<td>".$row['comfirmed_by']." </td>";
				$output .=  "</tr>";
				$i++;
			}
			$output .= "</tbody></table>";
		}else{
			$output .= "<div class='alert alert-info'>
				No Request Is Approved by Manager
			</div>" ;
		}
		echo $output;
	}

 ?>
