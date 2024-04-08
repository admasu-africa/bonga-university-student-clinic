<?php 
	if(isset($_GET['action']) && $_GET['action'] == 'show_drug_list')
		showMedicineList($_GET['drug_name']);
	if(isset($_GET['action']) && $_GET['action'] == 'fill')
		fillField($_GET['drug_name'], $_GET['column']);
	if(isset($_GET['action']) && $_GET['action'] == 'is_drug_available')
		isDrugAvailable();
	if(isset($_GET['action']) && $_GET['action'] == 'is_drug_requested')
		isDrugRequested($_GET['drug_id']);
	 if(isset($_GET['action']) && $_GET['action'] == 'delete_request_row')
 		deleteRequest();
	if(isset($_POST['id']))
		saveRequest();


	function showMedicineList($txt){
		require '../include/dbc.inc.php';
		$date = date("Y-m-d");
		if($conn){
			if($txt == "")
				$sql = "select * from drug_store where expire_date > '$date'";
			else
				$sql = "select * from drug_store where drug_name like '%$txt%' AND expire_date > '$date'";
			$res = mysqli_query($conn,  $sql);
			$resCheck = mysqli_num_rows($conn, $res);
			while($row = mysqli_fetch_assoc($res))
				echo '<option value="'.$row['drug_name'].'">'.$row['drug_name'].'</option>';

		}else{
			echo "Database Not conncted";
		}
	}
	function fillField($name, $column){
		require '../include/dbc.inc.php';
 	if($conn){
 		$sql = "select * from drug_store where drug_name = '$name'";
 		$res = mysqli_query($conn, $sql);
 		if(mysqli_num_rows($res) != 0) {
	        $row = mysqli_fetch_array($res);
	        	echo $row[$column];
      	}
 	}else
 		echo "Database Not conncted";
}

	function saveRequest(){

		require '../include/dbc.inc.php';
		$store_id = $_POST['id'];
		$qty = $_POST['qty'];
		$pharmacist = $_SESSION['user_id'];

		$date = date("Y-m-d");
		$sql = '';
		$output = "";
		for ($i=0; $i < count($qty); $i++) { 
			$store_id_provided = $store_id[$i];
			$qty_clean = $qty[$i];

			$sql .= "INSERT INTO provide_request(drug_id,requested_quantity, requested_by, requested_date,`status`) 
			VALUES('$store_id_provided','$qty_clean','$pharmacist','$date',1);";
	
		}

		if($sql != null){
			if (mysqli_multi_query($conn,$sql)) {
				echo 1;
			}else
				echo "Error: ".mysqli_error($conn);
		}else
			echo "Please fill all fields";	

	}

	function isDrugAvailable(){
		require '../include/dbc.inc.php';
		$name = $_GET['drug_name'];
		$sql = "SELECT * FROM drug_store where drug_name = '$name'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck > 0)
			echo 1;
		else
			echo "Not Available drug";
	}
	function isDrugRequested($id){
		require '../include/dbc.inc.php';
		$sql = "SELECT * FROM provide_request where  drug_id = '$id'";
		$res = mysqli_query($conn, $sql);
		$resCheck = mysqli_num_rows($res);
		if($resCheck > 0)
			echo 1;
		else
			echo "You can add";
	}
	function deleteRequest(){	
		require '../include/dbc.inc.php';
		$id = $_GET['request_id'];
		$sql = "DELETE FROM provide_request WHERE request_id='$id'";
		$res = mysqli_query($conn, $sql);
		if ($res) 
			echo 1;
		else
			echo "Error: ".mysqli_error($conn);
	}
 ?>