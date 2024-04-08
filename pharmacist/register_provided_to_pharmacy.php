<?php 
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Pharmacist"){
  header("location:../index.php");
}
include 'include/dbc.inc.php'; ?>
<?php include '../include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Pharmacist | Register Provided</title>
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
        <span class="right_second_header"><i class="fas fa-"></i>Register to Dispensary</span>
      </div>
      <hr class="text-primary">
      <div class="row content"> 
        <!--  -->
	      <div class="col col-12 col-md-12">     
	         <div>
				<div class="row col col-md-12 mb-3 " style="font-weight: bold;">
			<div class='failed'>
				
			</div>

			<div class="container-fluid success" id="success">	
				<form method="POST" id="save_to_pharmacy_db">
				<table class="table" id="rptable">
			<thead>
				<tr>
					<th>#</th>
					<th>Drug Name</th>
					<th>Approved Quantity</th>
					<th style='text-align: right;' >Contain</th>
					<th style='text-align: left;' >Measure</th>
					<!-- <th>Expire Date</th> -->
				</tr>
			</thead>
		<?php
		$sql = "SELECT * FROM provide_request INNER JOIN drug_store ON provide_request.drug_id = drug_store.drug_id WHERE provide_request.status = 3;";
		$res = mysqli_query($conn,$sql);

		$resCheck = mysqli_num_rows($res);
		if($resCheck > 0){
			$i = 1;
			echo "<tbody>";
			$query= "";
			while ($row = mysqli_fetch_assoc($res)) {
				?>
	<tr>
		<td> <?php echo $i ?></td>

		<td><input class='drug_name' type='text' name='drug_name[]' value="<?php echo $row['drug_name']; ?>" disabled></td>

		<td><input class="quantity" type='text' name='quantity[]' value="<?php echo $row['requested_quantity']." ".$row['measure']; ?>" disabled></td>

		<td style='text-align: right;'> <input type='number' class='equivalent_value' name='equivalent_value[]' placeholder='1<?php echo $row['measure']; ?> contain' min='1' required> </td>

		<td class='pharmacy_measure' id='pharmacy_measure'><select class='measure' name='measure[]' required>
				<option value=''> select measure </option>
				<option value='vial'> vial </option>
				<option value='ampule'> ampule </option>
				<option value='vial'> each </option>
				<option value='ampule'> pcs </option>
				<option value='vial'> tablet </option>
				<option value='ampule'> tub </option>
				<option value='vial'> bag </option>
				<option value='ampule'> roll </option>
				<option value='vial'> bottle </option>
			</select></td>
		<!-- <td> -->
			<input type='hidden' class="expiredate" name='expiredate[]' value="<?php echo $row['expire_date']; ?>" disabled>
		<!-- </td> -->
		<input type="hidden" class="drug_id" name="drug_id[]" value="<?php echo $row['drug_id']; ?>">
		<input type="hidden" class="request_id" name="request_id[]" value="<?php echo $row['request_id']; ?>">
	</tr>
	<?php
		$i++;

    }

	?>
	</table>
	<div class="text-align-center">
		<input class="btn-success" type="submit" name="save_to_pharmacy" value="Add to Pharmacy">
	</div>
	</form>
	</div>
<?php 
		    
   }else
		echo "<script>document.getElementById('success').innerHTML = '<div class=\"alert alert-info\">No Drug Provided To Dispensary from Store</div>'</script>";
 ?>
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

<script type="text/javascript">
		$(document).ready(function(){
			$("#save_to_pharmacy_db").submit(function(e){
				e.preventDefault();
				$("#save_to_pharmacy").val("Saving...");
				var drugId = [];
				var requestId = [];
				var eq_qty = [];
				var measure = [];
				var expiredate = [];
				var provided_by = [];

				$(".drug_id").each(function(){
					drugId.push($(this).val());
				});	
				$(".request_id").each(function(){
					requestId.push($(this).val());
				});	

				$(".equivalent_value").each(function(){
					eq_qty.push($(this).val());
				});
				$(".measure").each(function(){
					measure.push($(this).val());
				});	
				$(".expiredate").each(function(){
					expiredate.push($(this).val());
				});	
				
				$.ajax({
					url:'php/register_provided_to_pharmacy_db.php',
					method:'post',
					data:{drug_id:drugId,request_id:requestId,equivalent_qty:eq_qty,equivalent_measure:measure,expire_date:expiredate},
					success:function(response){
						if (response == 1) {
							$(".success").html("<div class='alert alert-success '>Drug Registered to pharmacy Successfully</div>");
							
						}else
							$(".failed").html("<div class='alert alert-danger '>"+response+"</div>");
					}
				});
		
		});
	});
</script>
</body>
</html>