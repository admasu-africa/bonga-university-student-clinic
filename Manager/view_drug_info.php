<?php 
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Manager"){
  header("location:../index.php");
}
include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Manager | View Drug Information</title>
	<link rel="stylesheet" type="text/css" href="include/style.css">
</head>
<body>
	<?php include_once "include/header.php"; 
		  include "../include/dbc.inc.php"; ?>

	<div class="column" style="border: 2px solid blue;">
		<a href="view_drug_info.php"><button>Available Drug</button></a>
		<a href="expired_drug.php"><button>Expired Drug</button></a><br>
		<?php 
		$sql = "select * from drug_store";
		$res = mysqli_query($conn,$sql);
		if($res == true){
			$resCheck = mysqli_num_rows($res);
			if($resCheck > 0){
				while ($row = mysqli_fetch_assoc($res)) {
					echo "Name: ".$row['drug_name']."<br>";
					echo "Available: ".$row['amount']."<br>";
					echo "Measure: ".$row['measure']."<br>";
					echo "Expire Date: ".$row['expire_date']."<br><br>";
				}
			}else{
				echo "0 Result";
			}
		}else{
			echo "Error: ".mysqli_error($conn);
		}
		

		 ?>
			
		</div>
	</div>
</div>
</body>
</html>