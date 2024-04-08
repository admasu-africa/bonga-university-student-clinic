<?php include '../include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="author" content="admasu, aku to bonga students">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pharmacist | Provide Request</title>
	<link rel="stylesheet" type="text/css" href="include/style.css">
	<link rel="stylesheet" type="text/css" href="../include/bootstrap/css/bootstrap.css">
    <script src="../include/bootstrap/js/bootstrap.js"></script>
    <script src="../include/jquery/jquery-3.6.2.js"></script>
     <link rel="stylesheet" type="text/css" href="../include/fontawesome/css/all.css">
	<script src="js/validate.js"></script>
	<script src="js/provide_request.js"></script>
</head>
<body>

	<?php include 'include/side_bar.php';
       include 'include/navbar.php'; ?>

       <div class="home">

      <div class="text">
        <span class="left_second_header">Pharmacist</span>
        <span class="right_second_header"><i class="fas fa-"></i>Provide Request</span>
      </div>
      <hr class="text-primary">
      <div class="row content"> 
        <!--  -->
	      <div class="col col-12 col-md-12">     
	         <div>
				<div class="display_msg_pr" id="display_msg_pr">
			
		</div>

		<div class="row col col-md-12 mb-3 " style="font-weight: bold;">
			<div class="col">
				<label>Drug Name</label>
			</div>

			<div class="col">
				<label>Available Quantity</label>
			</div>

			<div class="col">
				<label>Required Quantity</label>
			</div>

			<div class="col">
				<label>Expire date</label>
			</div>

			<div class="col">
				<label>Drug ID</label>
			</div>

		</div>

		<div>
			<hr class="text-success mb-3"  style="padding: 0px; border-top: 2px solid  #02b6ff;">
		</div>

			<!-- <input type='text' class='drug_name' value='"+name.value+"'> -->

		<div class="row col col-md-12">
			
			<div class="col">
				<input class="medicine_name" type="text" name="medicine_name" id="medicine_name"
						list="medicine_list" placeholder='Please select drug' onblur="validateMedicine(this.value, 'medicine_name_error');"
						onchange="fillTheFields(this.value);" onkeyup="showMedicineOption(this.value, 'medicine_list');" 
						onfocus="showMedicineOption(this.value,'medicine_list');" >
				<code id="medicine_name_error"  style="display: none; "></code>			
				<datalist id="medicine_list">
					 <?php //showMedicineList("") ?>
				</datalist>
			</div>
			<div class="col">
				<input class="available_qty" type="text" name="available_qty" id="available_qty"  disabled>
			</div>
			<div class="col">
				<input class="required_qty" type="number" name="required_qty" id="required_qty" onblur="checkDrugAvailability(this.value, 'required_qty_error');"
				onkeyup="checkDrugAvailability(this.value, 'required_qty_error');" min = "0">
				<code id="required_qty_error"  style="display: none;"></code>	
			</div>
			<div class="col">
				<input class="expire_date" type="text" name="expire_date" id="expire_date" onblur="validateDate(this.value, 'expire_date_error');" disabled>
				<code id="expire_date_error"  style="display: none; "></code>	
			</div>
			<div class="col">
				<input class="drug_id" type="text" name="drug_id" id="drug_id" disabled>
			</div>

		</div>

		<div>
			<button class="btn btn-success mt-3 text-center" id="add_request">Add Request</button>
		</div>

		<div >
			<table class="table" id="rtable">
				<thead>
					<th>Drug Name</th>
					<th>Available Quantity</th>
					<th>Required quantity</th>
					<th>Expire date</th>
					<th>Drug ID</th>
					<th>Action</th>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div>

		<div>
			<hr class="text-success mb-3"  style="padding: 0px; border-top: 2px solid  #02b6ff;">
			<button class="btn btn-success align-center" id="save_requested">Save Request</button>
		</div>

	         </div>
	      </div> 

    </div>

    

    <hr class="text-">

        <?php //include 'include/footer.html'; ?>
  
    </div>
 <script src="js/script.js"></script> 

<script type="text/javascript">
	var subMenu = document.getElementById('subMenu');

      function toggleMenu(){
        subMenu.classList.toggle('open-menu');
      }
</script>

</body>
</html>