<!DOCTYPE html>
<html>
<head>
	<title>Pharmacist | Accept Drug</title>
	<link rel="stylesheet" type="text/css" href="include/style.css">
</head>
<body>
	<?php include_once "include/header.php"; 
		include "include/dbc.inc.php";
?>
	
	<div class="column" style="border: 2px solid blue; ">
		<?php
		$sql = "select * from provide_drug";
		$res = mysqli_query($conn,$sql);
		if($res){
		$resCheck = mysqli_num_rows($res);
		if($resCheck > 0){
			while ($row = mysqli_fetch_assoc($res)) {
				echo "Drug Name: ".$row['drug_name']." ";
				echo "Provided Qty: ".$row['quantity']." ";
				echo "Expire Date: ".$row['expire_date']." ";
				echo "Provided By: ".$row['given_by']." ";
				echo "Provided Date: ".$row['provided_date']."<br> <br>";
			}
		}else
			echo "0 Result";
	}else
		echo "Error: ".mysqli_error($conn);
		?>
		
		</div>
	</div>
</div>
</body>
</html>