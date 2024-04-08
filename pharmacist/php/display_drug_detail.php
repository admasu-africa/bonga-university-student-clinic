<?php include '../include/dbc.inc.php';
	if(isset($_POST['drug_id']) && isset($_POST['store'])){
		$drug_id = $_POST['drug_id'];
	$sql = "SELECT * FROM drug_store INNER join supplier on drug_store.supplier_id = supplier.supplier_id inner join employee on drug_store.registered_by = employee.employee_id where drug_id = '$drug_id'";
	$res = mysqli_query($conn, $sql);
	$resCheck = mysqli_num_rows($res);
	$output = '';
	if($resCheck > 0){
		while ($row = mysqli_fetch_assoc($res)) {
			$output .= "<div class'row'>";
			$output .= "<span><strong class'gx-5'>Drug Name</strong>:  ".$row['drug_name']."</span><br>";
			$output .= "<span><strong>Balance</strong>:  ".$row['quantity']." ".$row['measure']."</span><br>";
			$output .= "<span><strong>Batch Number</strong>:  ".$row['batch_no']."</span><br>";	
			$output .= "<span><strong>Expire Date</strong>:  ".$row['expire_date']."</span><br>";
			$output .= "<span><strong>Registered Date</strong>:  ".$row['registered_date']."</span><br>";
			$output .= "<span><strong>Supplier Name</strong>:  ".$row['supplier_name']."</span><br>";
			$output .= "<span><strong>Registered By</strong>:  ".$row['fname']." ".$row['lname']."</span><br>";
			$output .= "</div>";
		}
		
	}
	echo $output;
}
	if(isset($_POST['drug_id']) && isset($_POST['pharmacy'])){
		$drug_id = $_POST['drug_id'];
		//echo "called pharmacy and drug id is:".$drug_id;
	// $sql = "SELECT * FROM drug_store INNER join supplier on drug_store.supplier_id = supplier.supplier_id inner join employee on drug_store.registered_by = employee.employee_id where drug_id = '$drug_id'";
	 	$sql = "SELECT ds.drug_name, ph.quantity, ph.measure, ds.expire_date,ph.drug_id,ph.registered_date, ph.comfirmed_by,emp.fname, emp.lname from pharmacy as ph INNER JOIN drug_store as ds ON ph.drug_id = ds.drug_id inner join employee as emp on ph.comfirmed_by = emp.employee_id where ph.drug_id = '$drug_id'";
	$res = mysqli_query($conn, $sql);
	$resCheck = mysqli_num_rows($res);
	$output = '';
	if($resCheck > 0){
		while ($row = mysqli_fetch_assoc($res)) {
			$output .= "<div class'row'>";
			$output .= "<span><strong class'gx-5'>Drug Name</strong>:  ".$row['drug_name']."</span><br>";
			$output .= "<span><strong>Balance</strong>:  ".$row['quantity']." ".$row['measure']."</span><br>";
			$output .= "<span><strong>Expire Date</strong>:  ".$row['expire_date']."</span><br>";
			$output .= "<span><strong>Registered Date</strong>:  ".$row['registered_date']."</span><br>";
			$output .= "<span><strong>Registered By</strong>:  ".$row['fname']." ".$row['lname']."</span><br>";
			$output .= "</div>";
		}
		
	}
	echo $output;
}
 ?>