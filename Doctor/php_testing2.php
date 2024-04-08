<?php 
$conn = mysqli_connect("localhost", "root","","BUC");
	if(isset($_POST['name'])){
		//echo "Wow Its working Dichaw";
		$name = $_POST['name'];
		$id = $_POST['id'];
		//echo "Name: ".$name." ID: ".$id;
		$query = '';
		//echo count($name);
		for ($count=0; $count < count($name); $count++) { 
			$name_clean = mysqli_real_escape_string($conn,$name[$count]);
			$id_clean = mysqli_real_escape_string($conn,$id[$count]);
			if($name_clean != "" && $id_clean != ""){
				$query .= "INSERT INTO test VALUES('$id_clean', '$name_clean');";
			}
		}
		if($query != ''){
			if(mysqli_multi_query($conn, $query))
				echo "Inserted succesfully";
			else
				echo "Error";
		}else{
			echo "All fields are required";
		}
	}
 ?>