<?php 
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Pharmacist"){
  header("location:../index.php");
}
include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Pharmacist | Manage Request</title>
	<link rel="stylesheet" type="text/css" href="include/style.css">
	<script src="../include/jquery/jquery-3.6.2.js"></script>
	<script src="js/approve_request.js"></script>
	<script type="text/javascript">
		// $(document).ready(function(){
		// 	$("#checkAll").click(function(){
		// 		if($(this).is(":checked")){
		// 			$(".checkItem").prop('checked',true);
		// 		}else{
		// 			$(".checkItem").prop('checked',false);
		// 		}
		// 	});
		// });
	</script>
</head>
<body>
	<?php include_once "include/header.php"; 
		include "include/dbc.inc.php";

		// if(isset($_POST['submit'])){
		// 	if(isset($_POST['id'])){
		// 		$success = 0;
		// 		foreach($_POST['id'] as $id){
		// 			$sql = "DELETE FROM provide_request WHERE request_id='$id'";
		// 			$res = mysqli_query($conn, $sql);
		// 			if($res)
		// 				$success++;
		// 		}
		// 		//echo "<script>alert('".$success." is deleted');</script>";
		// 		$_SESSION['success'] = $success;
		// 	}
		// }
?>
	
	<div class="column" style="border: 2px solid blue;  ">
		<select id="select_request">
			<option value="">--------</option>
			<option value="dispensary">Requested from dispensary</option>
			<option value="app_by_me">Waiting manager approval</option>
			<option value="app_by_manager">Approved by manager</option>
		</select>

		<div class="display_msg_mr" id="display_msg_mr">
			
		</div>

		<div class="container-fluid" id="success">	
			<?php 
			//$sql = "SELECT * FROM "
		$sql = "SELECT ds.drug_name, prr.requested_quantity, ds.quantity, ds.measure, ds.expire_date, ds.drug_id, prr.request_id from provide_request as prr inner join drug_store as ds on ds.drug_id = prr.drug_id where  prr.status = 1";
		$res = mysqli_query($conn,$sql);
		if($res){
		$resCheck = mysqli_num_rows($res);
		if($resCheck > 0){
			$i = 1;
			 ?>
		<table class="table" id="mtable">
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
		<?php					
			while ($row = mysqli_fetch_assoc($res)) {
				echo "<tr class='edit_table' id='row".$i."'>";
				//echo "<td><input type='checkbox' class='checkItem' name='id[]' value='".$row['request_id']."'></td>";
				echo "<td>".$i."</td>";
				echo "<td>".$row['drug_name']."</td>";
				echo "<td class='requested_amount'>".$row['requested_quantity']." </td>";
				echo "<td>".$row['quantity']." ".$row['measure']."</td>";
				echo "<td>".$row['expire_date']." </td>";
				echo "<td class='store_drug_id'>".$row['drug_id']." </td>";
				echo "<td class='requested_drug_id'>".$row['request_id']." </td>";
				echo "<td><a href='php/edit_request.php?id=".$row['request_id']."&name=".$row['drug_name']."&quantity=".$row['quantity']."&measure=".$row['measure']."&required=".$row['requested_quantity']."&expire_date=".$row['expire_date']."'><button class='btn btn-primary'>Edit</button></a>
					<button onclick='deleteRequest(".$row['request_id'].");' class='btn btn-danger delete'>Delete</button>
					</td>";
				echo "</tr>";
				$i++;
			}

			echo "</tbody></table>
			<button class='btn btn-success' id='save_edited' style='text-align: left;'>Comfirm Request</button>";
		}else{
		?>
			<div class="" style="font-size: 20px;">
				No Request Is Provided to store from Dispenasry
			</div> 
			<?php
		}
	}else
		echo "Error: ".mysqli_error($conn);
		?>



	</div>	
		</div>
		
	</div>
</div>

<script >
	// function testing(){
	// 	console.log("Its changed on here");
	// }
	function deleteRequest(id){
		if(confirm('Are You Sure to delete the given request?')){
		if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				if (this.responseText == 1)	{	
					$("#display_msg_mr").html("<div class='alert alert-success'>Request Deleted Successfully</div>");		
					refresh();
				}
				else
					$("#display_msg_mr").html("<div class='alert alert-danger'>"+xmlhttp.responseText+"</div>");	
			
		}
	};
		xmlhttp.open('GET','php/provide_drug_request.php?action=delete_request_row&request_id='+id,true);
	 	xmlhttp.send();	
	}
}
function refresh(){
	if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
			document.getElementById('mtable').getElementsByTagName('tbody')[0].innerHTML = xmlhttp.responseText;
			//alert(xmlhttp.responseText);
		}
	};
		xmlhttp.open('GET','php/refresh.php?action=refresh',true);
	 	xmlhttp.send();	
}

	
</script>

</body>
</html>
