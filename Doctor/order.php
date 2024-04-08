<?php
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Doctor"){
  header("location:../index.php");
}
 include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Doctor | Order</title>
	<link rel="stylesheet" type="text/css" href="include/style.css">
	<link rel="stylesheet" type="text/css" href="../include/bootstrap/css/bootstrap.css">
    <script src="../include/bootstrap/js/bootstrap.js"></script>
    <script src="../include/jquery/jquery-3.6.2.js"></script>
     <link rel="stylesheet" type="text/css" href="../include/fontawesome/css/all.css">
</head>
<body style="background: #E4E9F7">


	<?php include 'include/side_bar.php'; ?>


     <?php include 'include/navbar.php'; ?>

       <div class="home">

      <div class="text">
        <span class="left_second_header">Doctor</span>
        <span class="right_second_header"><i class="fas fa-"></i>order</span>
      </div>
      <hr class="text-primary">
      <div class="row content"> 
        <!--  -->
	      <div class="col col-12 col-md-12">     
	         <div>
	         <div id="display_lab_result_msg">
			
		</div>
		<div id="display_status_msg">
			
		</div>
		<?php  
		 $conn = mysqli_connect("localhost", "root", "", "BUC");
		 $sql = "select patient.student_id, patient.fname, patient.mname, patient_info.status from patient_info INNER JOIN patient on patient.student_id = patient_info.student_id where patient_info.status != 0";
		 $res = mysqli_query($conn, $sql);
		 	$resCheck = mysqli_num_rows($res);
		 	if($resCheck > 0){
		 		?>
		 		<table class="table">
		 				<thead>
		 					<tr>
		 						<th>#</th>
		 						<th>ID</th>
		 						<th>Name</th>
		 						<th>Last Name</th>
		 						<th>Status</th>
		 					</tr>
		 				</thead>
		 				<tbody>
		 		<?php
		 		$i = 1;
		 		while ($row = mysqli_fetch_assoc($res)) {
		 			$id = $row['student_id'];
		 			$fname = $row['fname'];
		 			$lname = $row['mname'];
		 			$status = $row['status'];
		 			if($status == 1)
		 				$status = "Not Ordered";
		 			else if($status == 2)
		 				$status = "Waiting Lab Result";
		 			elseif ($status == 3) 
		 				$status = "Lab Result Reached";
		 			elseif ($status == 4) 
		 				$status = "Prescribed";

		 			?>
		 			
		 					<tr>
		 						<td><?php echo $i; ?></td>
		 						<td><?php echo $id; ?></td>
		 						<td><?php echo $fname; ?></td>
		 						<td><?php echo $lname; ?></td>
		 						<td><?php echo $status; 
		 							if($row['status'] == 1){
		 								?>
		 								<a href="opd.php?id=<?php echo $row['student_id']; ?>"><button class="btn btn-success treat">Treate</button></a>		
					<button class='btn btn-danger remove' id="remove_patient" onclick="removePatient('<?php echo  $row['student_id'];  ?>','<?php echo  $row['fname'];  ?>')">Remove</button>
					<?php
		 							}?></td>
		 					</tr>
		 			<?php
		 			$i++;
		 		}
		 		?>
		 			</tbody>
		 			</table>
		 		<?php
		 	}else{
		 		echo "<script>document.getElementById('display_status_msg').innerHTML = \"<div class='alert alert-info'>There is no circulation on Clinic</div>\"</script>";
		 	}

		 
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
        	function removePatient(id,name){
		if(confirm('Are You Sure to remove the given patient from OPD?')){
		if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			xmlhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				if (this.responseText == 1)	{	
					alert(name+": Removed from OPD");	
					location.href = 'view_available_patient.php';
					//refresh();
				}
				else
					$("#display_va_patient").html("<div class='alert alert-danger'>"+this.responseText+"</div>");
			
		}
	};
		xmlhttp.open('GET','php/remove_patient.php?action=remove_from_OPD2&student_id='+id,true);
	 	xmlhttp.send();	
	}	
}
      // setTimeout("location.reload(true);", 5000);
</script>

</body>
</html>