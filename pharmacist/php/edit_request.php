<!DOCTYPE html>
<html>
<head>
	<title>Edditing Request</title>
	<link rel="stylesheet" type="text/css" href="../../include/bootstrap/css/bootstrap.css">
	<script src="../../include/bootstrap/js/bootstrap.js"></script>
	<script src="../../include/jquery/jquery-3.6.2.js"></script>
	<!-- <script src="../js/manage_model.js"></script> -->
</head>
<body>
	<div class="container">
		<?php 
		include '../include/dbc.inc.php';
	if(isset($_GET['id']) && isset($_GET['name'])){
		$id = $_GET['id'];
		$name = $_GET['name'];
		$quantity  = $_GET['quantity'];
		$measure = $_GET['measure'];	
		$required = $_GET['required'];	
		$expire_date = $_GET['expire_date'];

		?>
		
		<div class="row col col-md-12">
			<div>
				<label>Drug Name: </label>
				<input type="text" value="<?php echo $name; ?>" id='editable_name' disabled>
			</div>
			<div>
				<label>Available Quantity: </label>
				<input type="text" value="<?php echo $quantity." ".$measure; ?>" id="editable_av_qty" disabled>
			</div>
			<div>
				<label>Requested Quantity: </label>
				<input type="number" value="<?php echo $required; ?>" id="editable_req_qty" onkeyup="validateQuantity(this.value,'editable_req_qty_error');"
						onblur="validateQuantity(this.value,'editable_req_qty_error');" min='1'>
				<code id="editable_req_qty_error"  style="display: none;"></code>		
			</div>
			<div>
				<label>Expire Date: </label>
				<input type="text" value="<?php echo $expire_date; ?>" id="editable_expire_date" disabled>
			</div>
			<div>
				<button class="btn btn-success" id="update_requested" onclick="return updateOnDatabase(<?php echo $id; ?>);">Update</button>
				<button class="btn btn-success" id="cancel_update" onclick="returenBack();">Return Back</button>
			</div>
		</div>

		<?php

		}	 
	?>
	</div>

	<script>

		function validateQuantity(value, error){
			var result = document.getElementById(error);
			var available = document.getElementById('editable_av_qty').value;
			var pos = available.indexOf(" ");
			var res = available.slice(0,pos);

			if(value.trim() == ""){
				result.style.display = 'block';
				result.innerHTML = "Must fill out!";
				return false;
			}
			if(Number.parseInt(value) < 0){
				result.style.display = 'block';
				result.innerHTML = "Invalid quantity!";
				return false;
			}
			if(Number.parseInt(res) < Number.parseInt(value)){
				result.style.display = 'block';
				result.innerHTML = "Only "+res+" in store!";
				return false;
			}
			result.style.display = 'none';
			return true;
			
		}
		function updateOnDatabase(id){
			var req_num = document.getElementById('editable_req_qty');
			if(!validateQuantity(req_num.value, 'editable_req_qty_error'))
				req_num.focus();
			else{
				if(window.XMLHttpRequest)
					xmlhttp = new XMLHttpRequest();
					else
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
					xmlhttp.onreadystatechange = function(){
					if(this.readyState == 4 && this.status == 200){
						if (xmlhttp.responseText == 1) {
						//$("#display_msg_mr").html("<div class='alert alert-success'>Request Updated Successfully</div>");
						   alert("Request Updated Successfully");								
							window.location='../manage_request.php';
							
						}else{
							alert(xmlhttp.responseText);
							//$("#display_msg_mr").html("<div class='alert alert-danger'>"+xmlhttp.responseText+"</div>");	
						}
		}
	};
		xmlhttp.open('GET','save_drug_db.php?action=register&req_num='+req_num.value+"&id="+id,true);
	 	xmlhttp.send();	
	}
}

	 function returenBack(){
	 	window.location='../manage_request.php';
	 }	
	</script>

</body>
</html>

