<?php
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Doctor"){
  header("location:../index.php");
}
 include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Doctor | Sending to lab</title>
	<link rel="stylesheet" type="text/css" href="include/style.css">
	<link rel="stylesheet" type="text/css" href="../include/bootstrap/css/bootstrap.css">
    <script src="../include/bootstrap/js/bootstrap.js"></script>
    <script src="../include/jquery/jquery-3.6.2.js"></script>
     <link rel="stylesheet" type="text/css" href="../include/fontawesome/css/all.css">
</head>
<body>
<?php include 'include/side_bar.php';
       include 'include/navbar.php'; ?>

       <div class="home">

      <div class="text">
        <span class="left_second_header">Doctor</span>
        <span class="right_second_header"><i class="fas fa-"></i> Send lab request</span>
      </div>
      <hr class="text-primary">
      <div class="row content"> 
        <!--  -->
	      <div class="col col-12 col-md-12">     
	         <div>
	         	<div id="display_lab_msg">
			
		</div>
					<?php 

	
	$student_id = $_GET['stud_id'];
	$student_fname = $_GET['fname'];
	$student_mname = $_GET['mname'];
 
// 	if(isset($_POST['submit'])){
// 		if(isset($_POST['labtest'])){
// 			$labtest = $_POST['labtest'];
// 			$labtest_vlaue = "";
			
// 			foreach ($labtest as $value) {
// 				$labtest_vlaue = $labtest_vlaue.$value.",";
// 			}
// 			$sql = "UPDATE patient_info set status = 2, lab_test = '$labtest_vlaue' WHERE student_id = '$student_id' AND status = 1";
// 			$res = mysqli_query($conn, $sql);
// 			if($res){
// 				$_SESSION['sent_to_doctor'] = "Lab Request Sent";
// 				header("location:view_available_patient.php");
// 			}
// 			else
// 				echo "<script>document.getElementById('display_lab_msg').innerHTML = \"<div class='alert alert-danger'>Error: ".mysqli_error($conn)."</div> \"</script>";
// 	}else
// 		echo "<script>document.getElementById('display_lab_msg').innerHTML = \"<div class='alert alert-danger'>Please Select at least one or click cancel</div> \"</script>";
// }
	// if(isset($_POST['cancel'])){
	// 	$sql = "UPDATE patient_info set status = 0 WHERE student_id = '$student_id' AND status = 1;";
	// 	$res = mysqli_query($conn, $sql);
	// 	if($res){
	// 		$_SESSION['sent_to_doctor'] = "you Cancelled Lab Request ";
	// 		header("location:view_available_patient.php");
	// 	}
	// 	else
	// 		echo "<script>document.getElementById('display_lab_msg').innerHTML = \"<div class='alert alert-danger'>Error: ".mysqli_error($conn)."</div> \"</script>";
	// }

 ?>
 		<input type="hidden" name="stud_id" id="stud_id" value="<?php echo $student_id;  ?>">
				<input type="hidden" name="stud_fname" id="stud_fname" value="<?php echo $student_fname;  ?>">
				<input type="hidden" name="stud_mname" id="stud_mname" value="<?php echo $student_mname;  ?>">

<table class="table">
	<thead>
		<tr>
			<th>Name</th>
			<th>Middle</th>
			<th>ID</th>
		</tr>
	</thead>
	<tbody>
			<td><?php echo $student_fname; ?></td>
			<td><?php echo $student_mname; ?></td>
			<td><?php echo $student_id; ?></td>
	</tbody>
</table>
	<div id="form_div">
 		<form method="post">
 			<h4>Please Check You want to request lab</h4>
		<div class="form-check">
			  <input class="form-check-input labtest" name="selector[]" type="checkbox" value="Urine_HG" id="one">
			  <label class="form-check-label" for="one">
			    Urine HG
			  </label>
			</div>
			<div class="form-check">
			  <input class="form-check-input labtest" name="selector[]" type="checkbox" value="TB" id="two">
			  <label class="form-check-label" for="two">
			    TB
			  </label>
		</div>
		<div class="form-check">
			  <input class="form-check-input labtest" name="selector[]" type="checkbox" value="HIV" id="three">
			  <label class="form-check-label" for="three">
			    HIV
			  </label>
		</div>
		<div class="form-check">
			  <input class="form-check-input labtest" name="selector[]" type="checkbox" value="SE" id="four">
			  <label class="form-check-label" for="four">
			    S/E
			  </label>
		</div>
		<div class="form-check">
			  <input class="form-check-input labtest" name="selector[]" type="checkbox" value="Microscopy" id="five">
			  <label class="form-check-label" for="five">
			    Microscopy
			  </label>
		</div>
		<div class="form-check">
			  <input class="form-check-input labtest" name="selector[]" type="checkbox" value="BF" id="six">
			  <label class="form-check-label" for="six">
			    B/F
			  </label>
		</div>


			<!-- <input type="checkbox" name="selector[]"  class="labtest" value="Urine_HG">Urine HG
			<input type="checkbox" name="selector[]" class="labtest" value="TB">TB
			<input type="checkbox" name="selector[]" class="labtest" value="HIV">HIV	
			<input type="checkbox" name="selector[]" class="labtest" value="SE">S/E
			<input type="checkbox" name="selector[]" class="labtest" value="Microscopy">Microscopy
			<input type="checkbox" name="selector[]" class="labtest" value="BF">B/F<br> -->

				<code id="labtest_sent_error" style="display:none;"></code>

				<input class="btn btn-success" type="button" id="submit" value="Submit">
				<input class="btn btn-danger" type="button" id="cancel" value="Cancel">
				</form>
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
$(document).ready(function(){
	$("#submit").click(function(){
		var labtest = '';
		var id  = $("#stud_id").val();
		var fname = $("#stud_fname").val();
		var mname  = $("#stud_mname").val();
		$(":checkbox:checked").each(function(i){
			 labtest += $(this).val()+",";
		});
		if(labtest == ""){
			$("#labtest_sent_error").css("display","block");
			$("#labtest_sent_error").html("Please select at least one or click cancel button");
		}else{
			$.ajax({
				url:'php/send_lab_request.php',
				method:'post',
				data:{labtest:labtest,id:id,fname:fname,mname:mname},
				success:function(response){
					if(response == 1)
						location.href = 'view_available_patient.php';
					else
						$("#display_lab_msg").html("<div class='alert alert-danger'>"+response+"</div>");
				}
			});
		}
	});
});
</script>
	
</body>
</html>
