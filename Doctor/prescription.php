<?php
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Doctor"){
  header("location:../index.php");
}
 include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Doctor | Prescription</title>
	<link rel="stylesheet" type="text/css" href="include/style.css">
	<link rel="stylesheet" type="text/css" href="../include/bootstrap/css/bootstrap.css">
    <script src="../include/bootstrap/js/bootstrap.js"></script>
    <script src="../include/jquery/jquery-3.6.2.js"></script>
     <link rel="stylesheet" type="text/css" href="../include/fontawesome/css/all.css">
	<script src="js/provide_prescription.js"></script>
</head>
<body>
	

	<?php include 'include/side_bar.php'; ?>


     <?php include 'include/navbar.php'; ?>

       <div class="home">

      <div class="text">
        <span class="left_second_header">Doctor</span>
        <span class="right_second_header"><i class="fas fa-"></i>Prescription</span>
      </div>
      <hr class="text-primary">
      <div class="row content"> 
        <!--  -->
	      <div class="col col-12 col-md-12">     
	         <div>
	         <div class="display_error_msg_pr" id="display_error_msg_pr">

		</div>
		<?php  
		 $id = $_GET['stud_id'];

			 $fname = "";
	 		$lname = "";
	 		$status = 0;
	 		$lab_result = "";
	 		$history = "";
		 //$conn = mysqli_connect("localhost", "root", "", "BUC");
		 $sql = "SELECT pa.fname, pa.lname, pai.lab_result, pai.status, pai.patient_info_id,pai.history from patient AS pa INNER JOIN patient_info AS pai ON pa.student_id = pai.student_id where pai.student_id = '$id' AND (pai.status = 1 or pai.status = 3)";
		  $result = mysqli_query($conn, $sql);
		 
		 $resultCheck = mysqli_num_rows($result);

		 if ($resultCheck > 0) {
		 	while ($rows = mysqli_fetch_assoc($result)) {
		 		$fname = $rows['fname'];
		 		$lname = $rows['lname'];
		 		$status = $rows['status'];
		 		$lab_result = $rows['lab_result'];
		        $paii = $rows['patient_info_id'];
		        $history = $rows['history'];
		 		?>
		 		<table class="table mb-3">
		 			<tr>
		 				<th>Name </th>
		 				<th>Last Name </th>
		 				<th>ID </th>
		 				<th>Lab Result </th>
		 			</tr>
		 			<tr>
		 				<td> <?php echo $fname ?></td>
		 				<td> <?php echo $lname ?></td>
		 				<td> <?php echo $id ?></td>
		 				<td> <?php echo $lab_result ?></td>
		 			</tr>
		 		</table>


		 		<?php	
		 	 }
		 	}else
			echo "0 result";
		?>
				<label class="form-label" for="lab_history" style="font-size: 20px;">Update History:</label><br><textarea class="form-control mb-3" id="lab_history" cols="75" rows="3"><?php echo $history ?></textarea>
				
		 		<h3 class="alert alert-info mb-13" style="text-align:center; margin-top:3; font-size: 15px;">Please Write Your Prescription below the fields</h3>

		 		<div class="row col col-md-12 mb-3 " style="font-weight: bold;">
					<!-- <div class="col">
						<label>Drug Name</label>
					</div>

					<div class="col">
						<label>Dose</label>
					</div>

					<div class="col">
						<label>Description</label>
					</div> -->

					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Drug Name</th>
								<th>Dose</th>
								<th>Description</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<input class="form-control medicine_name" type="text" name="medicine_name" id="medicine_name"
							list="medicine_list_1" placeholder='Please Enter drug name' 
							onchange="fillTheFields(this.value);" onkeyup="showMedicineOption(this.value, 'medicine_list_1');" 
							onfocus="showMedicineOption(this.value,'medicine_list_1');" onblur="checkDrugAvailability(this.value, 'drug_id')" required>
					<code id="medicine_name_error"  style="display: none; "></code>			
					<datalist id="medicine_list_1">
						 
					</datalist>
								</td>
								<td>
									<input class="form-control dose" type="number" name="dose" id="dose" min="1"required>
									<code id="dose_error"  style="display: none; "></code>
								</td>
								<td>
									<textarea class="form-control" name="description" id="description" class="description"required></textarea>
									<code id="description_error"  style="display: none; "></code>
								</td>
							</tr>
						</tbody>
					</table>

				</div>



<!-- onblur="validateMedicine(this.value, 'medicine_name_error');" -->

	<form>
		<div class="row col col-md-12">
			
			<div class="col">
				<!-- <input class="medicine_name" type="text" name="medicine_name" id="medicine_name"
						list="medicine_list_1" placeholder='Please Enter drug name' 
						onchange="fillTheFields(this.value);" onkeyup="showMedicineOption(this.value, 'medicine_list_1');" 
						onfocus="showMedicineOption(this.value,'medicine_list_1');" onblur="checkDrugAvailability(this.value, 'drug_id')" required>
				<code id="medicine_name_error"  style="display: none; "></code>			
				<datalist id="medicine_list_1">
					 
				</datalist> -->
			</div>

			<!-- <div class="col">
				<input class="strength" type="text" name="strength" id="dose" min="1"required>
				<code id="dose_error"  style="display: none; "></code>
			</div> -->

			<div class="col">
				<!-- <input class="dose" type="number" name="dose" id="dose" min="1"required>
				<code id="dose_error"  style="display: none; "></code> -->
			</div>

			<div class="col">
				<!-- <textarea name="description" id="description" class="description"required></textarea>
				<code id="description_error"  style="display: none; "></code> -->
			</div>

			<input type="hidden" name="drug_id" value="" id="drug_id">

		</div>

			<div align="right">
		 			<button type="button" id="add_prescription" name="add" class="btn btn-success btn-xs">Add Prescription</button>	
		 	</div>

		 </form>	

		 <input type="hidden" name="stud_id" value="<?php echo $id; ?>" id="pr_stud_id">
		 <input type="hidden" name="pr_paii" value="<?php echo $paii; ?>" id="pr_paii">

		 	<div >
			<table class="table" id="prtable">
				<thead>
					<th>Drug Name</th>
					<th>Dose</th>
					<th>Description</th>
					<th>Drug ID</th>
					<th>Action</th>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div>

		<div class="m-5">
			<!-- <hr class="text-success mb-3"  style="padding: 0px; border-top: 2px solid  #02b6ff;"> -->
			<a href="refferal.php?stud_id=<?php echo $id; ?>"><input class="btn btn-primary" value="Write Referal"></a>
			<input class="btn btn-success" value="Finish" id="save_prescription"> 

		</div>

		 		<div>
						<hr class="text-success mt-5"  style="padding: 0px; border-top: 2px solid  #02b6ff;">
				</div>

	         </div>
	      </div> 

    </div>
   <?php //include 'include/footer.html'; ?>
  
    </div>

     <script src="js/script.js"></script> 

<script type="text/javascript">
	var subMenu = document.getElementById('subMenu');

      function toggleMenu(){
        subMenu.classList.toggle('open-menu');
      }
</script>
	


<!-- 
				<h1>you are out of the content </h1>

		 		
		 		<table class="table" id="prtable">
		 			<thead>
		 				<tr>
		 					<td>Drug Name</td>
		 					<td>Dose</td>
		 					<td>Description</td>
		 					<td></td>
		 				</tr>
		 			</thead>
		 			<tbody>
		 				<tr>
		 					<td><input type='text' name='drugName'class='drugName'></td>
		 					<td><input type='number' name='dose' class='drugName'></td>
		 					<td><textarea id='description' class='description'></textarea></td>
		 					<td></td>
		 				</tr>
		 			</tbody>
		 		</table>

		 		<div align="center">
		 			<button type="button" id="save" name="save" class="btn btn-info btn-xs">Save</button>	
		 		</div> -->
		 		<?php	
		 	//  }
		 	// }else
			// echo "0 result";
		?>
	


	<script type="text/javascript">

		// $(document).ready(function(){
		// 	var count = 1;
		// 	$("#add").click(function(){
		// 		//console.log("button add is clicked");
		// 		count++;
		// 		var insert_in_table = "<tr id='row"+count+"'>";
		// 			insert_in_table += "<td><input type='text' name='drugName'class='drugName'></td>";
		//  			insert_in_table += "<td><input type='number' name='dose' class='drugName'></td>";
		//  			insert_in_table += "<td><textarea id='description' class='description'></textarea></td>";
		//  			insert_in_table += "<td><button type='button' name='remove' data-row='row"+count+"' class='btn btn-danger btn-xs remove'>-</button></td>";
		// 			insert_in_table += "</tr>";
		// 			$("#prtable").append(insert_in_table);
		// 	});
		// 	$(document).on('click','.remove',function(){
		// 		var delete_row = $(this).data('row');
		// 		$('#'+delete_row).remove();
		// 	});
		// 	$("#save").click(function(){
		// 		if(document.getElementById('prtable').getElementsByTagName('tbody')[0].childNodes[1] == undefined){
		// 			if(confirm("Are you sure finish with out write prescription?")){
		// 				console.log("You Idiot");
		// 			}
		// 		}else
		// 			console.log("You are stupid");
		// 		var drugName = [];
		// 		var dose = [];
		// 		var description = [];

		// 	})
		// })
		</script>
</body>
</html>