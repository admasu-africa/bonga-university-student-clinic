<?php 
	if(isset($_GET['action']) && $_GET['action'] == 'show_drug_list')
		showMedicineList($_GET['drug_name']);
	if(isset($_GET['action']) && $_GET['action'] == 'fill')
		fillTheFields();
	if(isset($_GET['action']) && $_GET['action'] == 'is_drug_available')
		checkAvailability();
		if(isset($_POST['name']) && isset($_POST['student_id']) && isset($_POST['paii_s']))
		savePrescription();
	if(isset($_POST['stud_id']) && isset($_POST['paii']))
		savePrescriptionWOC();

	function showMedicineList($txt){
		require '../include/dbc.inc.php';
		$date = date("Y-m-d");
		if($conn){
			if($txt == "")
				$sql = "SELECT * from pharmacy INNER JOIN drug_store on drug_store.drug_id = pharmacy.drug_id where drug_store.expire_date > '$date' AND pharmacy.quantity > 0";
			else
				$sql = "SELECT * from pharmacy INNER JOIN drug_store on drug_store.drug_id = pharmacy.drug_id where drug_name like '%$txt%' AND drug_store.expire_date > '$date' AND pharmacy.quantity > 0";
			$res1 = mysqli_query($conn,  $sql);
			$resCheck = mysqli_num_rows($conn, $res1);
			while($row = mysqli_fetch_assoc($res1))
				echo '<option value="'.$row['drug_name'].'">'.$row['drug_name'].'</option>';

		}else{
			echo "Database Not conncted";
		}
	}

	function fillTheFields(){
		require '../include/dbc.inc.php';
		$name = $_GET['drug_name'];
		$column = $_GET['column'];

		$sql = "select drug_id from drug_store where drug_name = '$name'";
 		$res = mysqli_query($conn, $sql);
 		if(mysqli_num_rows($res) != 0) {
	        $row = mysqli_fetch_array($res);
	        	echo $row[$column];
      	}
	}
	function checkAvailability(){
		require '../include/dbc.inc.php';
		$date = date("Y-m-d");
		$txt = $_GET['drug_name'];
		$sql = "SELECT pharmacy.drug_id from pharmacy INNER JOIN drug_store on drug_store.drug_id = pharmacy.drug_id where drug_name = '$txt' AND drug_store.expire_date > '$date' AND pharmacy.quantity > 0";
		$res = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($res);
		if($resultCheck > 0){
			$row = mysqli_fetch_array($res);
			echo $row['drug_id'];
		}else
			echo 0;

	}
	function savePrescription(){
		require '../include/dbc.inc.php';
		$student_id = $_POST['student_id'];
		$paii = $_POST['paii_s'];
		$history = $_POST['history'];
		$history_1 = mysqli_real_escape_string($conn,$history);

		$drug_name = $_POST['name'];
		$dose = $_POST['dose'];
		$description = $_POST['description'];
		$drug_id = $_POST['id'];
		$sql = "";
		$output = "";
		for ($i=0; $i < count($drug_name); $i++) { 
			$dname = $drug_name[$i];
			$ddose = $dose[$i];
			$ddesc = $description[$i];
			$did = $drug_id[$i];
			if($did == "")
				$sql .= "INSERT INTO `prescription`(`drug_id`, `drug_name`, `dose`, `description`, `prescribed_by`, `patient_info_id`) VALUES (null,'$dname','$ddose','ddesc','BUE003','$paii');";	
			else
				$sql .= "INSERT INTO `prescription`(`drug_id`, `drug_name`, `dose`, `description`, `prescribed_by`, `patient_info_id`) VALUES ('$did','$dname','$ddose','ddesc','BUE003','$paii');";	
		}
		// $output .= $student_id.$paii;
		 //echo  $output;
	 $sql .= "UPDATE patient_info set status = 4, history = '$history_1' where student_id = '$student_id' and patient_info_id = '$paii'";
	 $res = mysqli_multi_query($conn, $sql);
	if ($res)
		echo 1;
	else
		echo "Errro: " . mysqli_error($conn);		


		//echo "No of name: ".count($drug_name).": student id :".$student_id.": patient info id :".$paii;
	}
	function savePrescriptionWOC(){
		require '../include/dbc.inc.php';
		$id = $_POST['stud_id'];
		$paii = $_POST['paii'];
		$history = $_POST['history'];
		$history_1 = mysqli_real_escape_string($conn,$history);
		//echo "ID is : ".$id."paii ";
		$sql = "UPDATE patient_info set status = 0, history = '$history_1' WHERE student_id = '$id' AND patient_info_id = '$paii'";
		$res = mysqli_query($conn, $sql);
		if ($res) 
			echo 1;
		else
			echo "Erro: ".mysqli_error($conn);
	}
 ?>