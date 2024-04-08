	<?php
	session_start();
	if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Doctor"){
	  header("location:../index.php");
	}
	 include 'include/dbc.inc.php'; ?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Doctor | OPD</title>
		<link rel="stylesheet" type="text/css" href="include/style.css">
		<link rel="stylesheet" type="text/css" href="../include/bootstrap/css/bootstrap.css">
	    <script src="../include/bootstrap/js/bootstrap.js"></script>
	    <script src="../include/jquery/jquery-3.6.2.js"></script>
	     <link rel="stylesheet" type="text/css" href="../include/fontawesome/css/all.css">
	</head>
	<body>
			<?php include 'include/side_bar.php'; ?>


	     <?php include 'include/navbar.php'; ?>


	     <div class="home">

	      <div class="text">
	        <span class="left_second_header">Doctor</span>
	        <span class="right_second_header"><i class="fas fa-"></i>OPD</span>
	      </div>
	      <hr class="text-primary">
	      <div class="row content"> 
	        <!--  -->
		      <div class="col col-12 col-md-12">     
		         <div class="inside_text">
		         	<div class="display_hstry_msg" id="display_hstry_msg">
				
					</div>
			
			<?php  

				$id =  $_GET['id'];

				include 'include/dbc.inc.php';
				//$sql = "select student_id, fname, lname from patient where status = 1 ";
				//$sql = "SELECT patient.fname,patient.lname, patient.dept, patient_info.history, patient_info.visited_date,patient_info.lab_result FROM `patient_info` INNER JOIN patient on patient.student_id = patient_info.student_id WHERE patient.student_id = '$id';";

				//$sql = "SELECT pa.fname,pa.lname, pa.dept, pai.history, pai.visited_date,pai.lab_result, ds.drug_name, pr.dose, pr.description FROM `patient_info` as pai INNER JOIN patient as pa on pa.student_id = pai.student_id INNER JOIN prescription as pr on pr.patient_info_id = pai.patient_info_id INNER JOIN drug_store as ds on pr.drug_id = ds.drug_id WHERE pa.student_id = '$id';";

				$sql0 = "SELECT * FROM patient WHERE student_id = '$id'";
				$res0 = mysqli_query($conn, $sql0);
				$resCheck0 = mysqli_num_rows($res0);
				$fname = '';
				$mname = '';

				if ($resCheck0 > 0) {
					$row0 = mysqli_fetch_assoc($res0);
					$fname = $row0['fname'];
					$mname = $row0['mname'];
					?>
					<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>Name</th>
								<th>Last Name</th>
								<th>ID</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php echo $fname; ?></td>
								<td><?php echo $mname; ?></td>
								<td><?php echo $id; ?></td>
							</tr>
						</tbody>
					</table>
					<?php
				}


				$sql = "SELECT pa.fname,pa.lname , pai.history, pai.visited_date,pai.lab_result, pai.patient_info_id from patient as pa inner join patient_info as pai on pa.student_id = pai.student_id where pai.student_id = '$id' order by pai.visited_date desc limit 0,3 ";
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);
			 	if($resultCheck > 0){
			 	?>
			 	<label><h3>Previous History </h3></label>
			 	<table class="table table-bordered table-hover"  id="infotable">
			 		
			 		<thead>
			 			<tr>
			 				<th>#</th>
			 				<th>History</th>
			 				<th>Visited Date</th>
			 				<th>Lab Result</th>
			 				<th>Prescription</th>
			 			</tr>
			 		</thead>
			 		<tbody>

			 	<?php
			 	$i = 1;
			 	while ($row = mysqli_fetch_assoc($result)) {
			 		$paii = $row['patient_info_id'];
			 		?>
			 		<tr>
			 			<td><?php echo $i; ?></td>
			 			<td><?php echo $row['history']; ?></td>
			 			<td><?php echo $row['visited_date']; ?></td>
			 			<td><?php echo $row['lab_result']; ?></td>
			 			<td>
			 				<table class="table">
			 					<?php 
			 					$sql2 = "SELECT ds.drug_name, pr.dose, pr.description from prescription as pr inner join drug_store as ds on pr.drug_id = ds.drug_id where pr.patient_info_id = '$paii'";
						 	$res1 = mysqli_query($conn, $sql2);
						 	$resCheck1 = mysqli_num_rows($res1);
						 	//if($resCheck1 > 0){
			 					if($i==1){
			 					?>
			 					<thead>
			 						<tr>
				 						<th>Drug Name</th>
				 						<th>Dose</th>
				 						<th>Description</th>
			 						</tr>
			 					</thead>
			 				
			 					<tbody>
			 					<?php
						 		}
						 		while ($row1 = mysqli_fetch_assoc($res1)) {
								?>
			 						<tr>
			 							<td><?php echo $row1['drug_name'] ?></td>
			 							<td><?php echo $row1['dose'] ?></td>
			 							<td><?php echo $row1['description'] ?></td>
			 						</tr>
			 						<?php 
			 					}
			 						?>
			 					</tbody>
			 				</table>
			 				<?php
			 				//}	
					?>
			 			</td>
			 		</tr>
			 		<?php
			 		$i++;
			 	}	
					?>
					</tbody>
			 	</table>
				<?php
			 }
				else
				echo "<div class='alert alert-info' style='font-size: 15px;'>No Previously Registered History</div>";	
			?>

			

			<form>
				<div class="row col col-md-12">
					<input type="hidden" name="stud_id" id="stud_id" value="<?php echo $id;  ?>">
					<input type="hidden" name="stud_fname" id="stud_fname" value="<?php echo $fname;  ?>">
					<input type="hidden" name="stud_mname" id="stud_mname" value="<?php echo $mname;  ?>">
						<div class="mb-3">
						  <label for="historys" class="form-label" style="font-size: 20px;">Write History</label>
						  <textarea class="form-control" id="historys" rows="5" style="border-radius: 15px;" placeholder="Please Write patient history here....."></textarea>
						  <code id="history_error" style="display: none; font-size: 15px;"></code>
						</div>
						<!-- Write History: <br><textarea id="historys" name="history" rows="5" cols="30"></textarea> <br>
						<code id="history_error" style="display: none;"></code> -->
					<!-- <div> -->

						<select id="selection" class="form-select mb-3 mt-3" aria-label="Select" style="border: 2px solid #6969;">

					  <option value="">Please select from here to prescrive, lab test, or reffer</option>
					  <option value="lab_request">Lab Request</option>
					  <option value="prescrive">Priscribe</option>
					  <option value="write_reffer">Write Reffer</option>

						</select>

					<!-- 	<div class="btn-group w-50px" role="group" aria-label="Basic example">

						  <button type="button" id="labtest" class="btn btn-primary" onclick="gotoLabtest();">Lab Test Need?</button>
						  <button type="button" id="prescription" class="btn btn-secondary" onclick="gotoPrescription();">Prescribe?</button>
						  <button type="button" id="submit_history" class="btn btn-primary" onclick="finish();">Finish</button>
						</div> -->

						<!-- <input type="button" name="labtest" id="labtest" value="Lab Test Need?" onclick="gotoLabtest();">
						<input type="button" name="prescription" id="prescription" value="Prescribe?" onclick="gotoPrescription();">

						<input type="button" name="submit" value="Finish" id="submit_history" onclick="finish();"><br> -->
				    <!-- </div>		 -->
				 	<input class="btn btn-success mb-5" type="button" name="submit" value="Finish" id="submit_history" onclick="finish();" style="width: 10%; margin: auto;">
				 </div>
			</form>
				
			</div>
		</div>
	</div>
		         </div>
		      </div> 


	    </div>


	    <!-- <hr class="text-"> -->

	        <?php //include 'include/footer.html'; ?>
	  
	    </div> 



	<script src="js/script.js"></script>
	   <script type="text/javascript">
	  var subMenu = document.getElementById('subMenu');

	  function toggleMenu(){
	    subMenu.classList.toggle('open-menu');
	  }

	//   function gotoLabtest(){
	// 	var history = document.getElementById('historys');
	// 	var id = document.getElementById('stud_id');
	// 	var fname = document.getElementById('stud_fname');
	// 	var mname = document.getElementById('stud_mname');
	// 		if(history.value == ""){
	// 		document.getElementById('history_error').style.display = 'block';
	// 		document.getElementById('history_error').innerHTML = "Plese Write history";
	// 		history.focus();
	// 	}else{
	// 		if(window.XMLHttpRequest)
	// 			xmlhttp = new XMLHttpRequest();
	// 		else
	// 			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	// 			xmlhttp.onreadystatechange = function(){
	// 			if(this.readyState == 4 && this.status == 200){
	// 				console.log(this.responseText);
	// 				if (this.responseText == 1)	{	
	// 					location.href = "send_to_lab.php?stud_id="+id.value+"&fname="+fname.value+"&mname="+mname.value;
	// 					console.log(id.value+fname.value+mname.value);
	// 				}
	// 				else
	// 					$("#display_hstry_msg").html("<div class='alert alert-danger'>"+xmlhttp.responseText+"</div>");		
	// 		}
	// 	};
	// 		xmlhttp.open('GET','php/save_history.php?action=save_history&history='+history.value+"&id="+id.value,true);
	// 	 	xmlhttp.send();	
	// 	 }	
	// 	}
	// function gotoPrescription(){
	// 	var history = document.getElementById('historys');
	// 	var id = document.getElementById('stud_id');
	// 		if(history.value == ""){
	// 		document.getElementById('history_error').style.display = 'block';
	// 		document.getElementById('history_error').innerHTML = "Plese Write history";
	// 		history.focus();
	// 	}else{
	// 		if(window.XMLHttpRequest)
	// 			xmlhttp = new XMLHttpRequest();
	// 		else
	// 			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	// 			xmlhttp.onreadystatechange = function(){
	// 			if(this.readyState == 4 && this.status == 200){

	// 				if (this.responseText == 1)	{	
	// 					location.href = "prescription.php?stud_id="+id.value;
	// 				}
	// 				else
	// 					$("#display_hstry_msg").html("<div class='alert alert-danger'>"+xmlhttp.responseText+"</div>");		
	// 		}
	// 	};
	// 		xmlhttp.open('GET','php/save_history.php?action=save_history&history='+history.value+"&id="+id.value,true);
	// 	 	xmlhttp.send();	
	// 	 }	
	// 	}
	function finish(){
		var history = document.getElementById('historys');
		var id = document.getElementById('stud_id');
		var selection = document.getElementById('selection');
			if(history.value == ""){
			document.getElementById('history_error').style.display = 'block';
			document.getElementById('history_error').innerHTML = "Plese Write history";
			history.focus();
		}else{
			if(selection.value == ""){
				console.log("Selection is empty");
				if(window.XMLHttpRequest)
				xmlhttp = new XMLHttpRequest();
			else
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				xmlhttp.onreadystatechange = function(){
				if(this.readyState == 4 && this.status == 200){
					if (this.responseText == 1)	{	
						location.href = "view_available_patient.php";
					}
					else
						$("#display_hstry_msg").html("<div class='alert alert-danger'>"+xmlhttp.responseText+"</div>");		
			}
		};
			xmlhttp.open('GET','php/save_history.php?action=save_history_2&history='+history.value+"&id="+id.value,true);
		 	xmlhttp.send();	
		 }else{
		 		var fname = document.getElementById('stud_fname');
				var mname = document.getElementById('stud_mname');
		 		if(selection.value == "lab_request"){
		 			if(window.XMLHttpRequest)
				xmlhttp = new XMLHttpRequest();
			else
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				xmlhttp.onreadystatechange = function(){
				if(this.readyState == 4 && this.status == 200){
					console.log(this.responseText);
					if (this.responseText == 1)	{	
						location.href = "send_to_lab.php?stud_id="+id.value+"&fname="+fname.value+"&mname="+mname.value;
						console.log(id.value+fname.value+mname.value);
					}
					else
						$("#display_hstry_msg").html("<div class='alert alert-danger'>"+xmlhttp.responseText+"</div>");		
			}
		};
			xmlhttp.open('GET','php/save_history.php?action=save_history&history='+history.value+"&id="+id.value,true);
		 	xmlhttp.send();
		 		}
		 		else if(selection.value == "prescrive"){
		 			if(window.XMLHttpRequest)
				xmlhttp = new XMLHttpRequest();
			else
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				xmlhttp.onreadystatechange = function(){
				if(this.readyState == 4 && this.status == 200){

					if (this.responseText == 1)	{	
						location.href = "prescription.php?stud_id="+id.value;
					}
					else
						$("#display_hstry_msg").html("<div class='alert alert-danger'>"+xmlhttp.responseText+"</div>");		
			}
		};
			xmlhttp.open('GET','php/save_history.php?action=save_history&history='+history.value+"&id="+id.value,true);
		 	xmlhttp.send();	
		 		}
		 		else if(selection.value == "write_reffer"){
		 			// console.log("Write Reffer");
		 			if(window.XMLHttpRequest)
				xmlhttp = new XMLHttpRequest();
			else
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				xmlhttp.onreadystatechange = function(){
				if(this.readyState == 4 && this.status == 200){

					if (this.responseText == 1)	{	
						location.href = "refferal.php?stud_id="+id.value;
					}
					else
						$("#display_hstry_msg").html("<div class='alert alert-danger'>"+xmlhttp.responseText+"</div>");		
			}
		};
			xmlhttp.open('GET','php/save_history.php?action=save_history&history='+history.value+"&id="+id.value,true);
		 	xmlhttp.send();
		 		}
		 }
	}
				
}
	</script>
	</body>
	</html>