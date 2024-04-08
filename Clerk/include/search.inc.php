<?php 
	include 'dbc.inc.php';
	//where id = '$serchValue' or fname = '$serchValue' or lname = '$serchValue'
	//or fname = '$serchValue' or lname = '$serchValue'
	$serchValue = trim($_POST['search_value']);
		//echo $serchValue."<br>";
	$sql = "select * from patient where id = '$serchValue';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		while ($row = mysqli_fetch_assoc($result)) {
			echo "ID: ".$row['id']."<br>";
			echo "Name: ".$row['fname']."<br>";
			echo "Last Name: ".$row['lname']."<br>";
			echo "Department: ".$row['dept']."<br>";
		}
	}
	else{
		echo "0 Result";
	}
	//header("location:search.php");
 ?>