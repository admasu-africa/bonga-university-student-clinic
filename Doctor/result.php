<?php
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Doctor"){
  header("location:../index.php");
}
 include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Doctor | Lab Result</title>
	<link rel="stylesheet" type="text/css" href="include/style.css">
	<link rel="stylesheet" type="text/css" href="../include/bootstrap/css/bootstrap.css">
    <script src="../include/bootstrap/js/bootstrap.js"></script>
    <script src="../include/jquery/jquery-3.6.2.js"></script>
     <link rel="stylesheet" type="text/css" href="../include/fontawesome/css/all.css">
</head>
<body  style="background: #E4E9F7">

	<?php include 'include/side_bar.php'; ?>


     <?php include 'include/navbar.php'; ?>

       <div class="home">

      <div class="text">
        <span class="left_second_header">Doctor</span>
        <span class="right_second_header"><i class="fas fa-"></i>Lab Result</span>
      </div>
      <hr class="text-primary">
      <div class="row content"> 
        <!--  -->
	      <div class="col col-12 col-md-12">     
	         <div>
	         <div id="display_lab_result_msg">
			
		</div>
		<?php  
		 $conn = mysqli_connect("localhost", "root", "", "BUC");
		 $sql = "select pa.student_id, pa.fname, pa.mname from patient as pa inner join patient_info on pa.student_id = patient_info.student_id where patient_info.status = 3";
		 $result = mysqli_query($conn, $sql);
		 $resultCheck = mysqli_num_rows($result);
		 if ($resultCheck > 0) {
					?>
					<table class="table">
						<thead>
		 					<tr>
		 						<th>#</th>
		 						<th>ID</th>
		 						<th>Name</th>
		 						<th>Last Name</th>
		 						<th></th>
		 					</tr>
		 				</thead>
					<tbody>

					<?php
					$i = 1;
					while($rows2 = mysqli_fetch_assoc($result)){
						$fname = $rows2['fname'];
						$lname = $rows2['mname'];
						$id = $rows2['student_id'];
						?> 			
		 					<tr>
		 						<td><?php echo $i; ?></td>
		 						<td><?php echo $fname; ?></td>
		 						<td><?php echo $lname; ?></td>
		 						<td><a href="prescription.php?stud_id=<?php echo $rows2['student_id']; ?>"><button class="btn btn-success">View Result</button></a></td>
		 					</tr>
		 			<?php
		 			$i++;
		 		}
		 		?>
		 			</tbody>
		 			</table>
		 		<?php
		 	}else
		 		echo "<script>document.getElementById('display_lab_result_msg').innerHTML = \"<div class='alert alert-info'>No Reached Lab Result</div>\"</script>";	 	

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
      // setTimeout("location.reload(true);", 5000);
</script>

</body>
</html>
