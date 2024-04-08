<?php 
session_start();
if(!isset($_SESSION['user_name'])){
  header("location:../index.php");
}
include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Patient | View Information</title>
		<link rel="stylesheet" type="text/css" href="include/style.css">
    <link rel="stylesheet" type="text/css" href="../include/bootstrap/css/bootstrap.css">
    <script src="../include/bootstrap/js/bootstrap.js"></script>
    <script src="../include/jquery/jquery-3.6.2.js"></script>
     <link rel="stylesheet" type="text/css" href="../include/fontawesome/css/all.css">
</head>
<body>

<?php include 'include/side_bar.html'; ?>


     <?php include 'include/navbar.php'; ?>

    <div class="home">
       

      <div class="text">
        <span class="left_second_header">Student</span>
        <span class="right_second_header"><i class="fas fa-"></i> View Information</span>
      </div>
      <hr class="text-primary">
      <div class="row content"> 
        <!--  -->
      <div class="col col-12 col-md-12">     
        <div class="inside_text">
         <?php 
		include 'include/dbc.inc.php';
		$student_id = $_SESSION['student_id'];
		$sql = "select * from patient_info where student_id = '$student_id' ";
		$res = mysqli_query($conn, $sql);
			$resCheck = mysqli_num_rows($res);
			if($resCheck > 0){
				?>
				<table class=" table table-bordered table-hover">
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
		 	while ($row = mysqli_fetch_assoc($res)) {
		 		$paii = $row['patient_info_id'];
		 		?>
		 		<tr>
		 			<td><?php echo $i; ?></td>
		 			<td><?php echo $row['history']; ?></td>
		 			<td><?php echo $row['visited_date']; ?></td>
		 			<td><?php echo $row['lab_result']; ?></td>
		 			<td>
		 				<table class="table table-bordered table-hover">
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
			echo "<div class='alert alert-info'>No Previously Registered History</div>";	
		?>

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