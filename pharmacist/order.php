<?php 
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Pharmacist"){
  header("location:../index.php");
}
include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Pharmacist | Order</title>
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
        <span class="left_second_header">Pharmacist</span>
        <span class="right_second_header"><i class="fas fa-"></i>Order</span>
      </div>
      <hr class="text-primary">
      <div class="row content"> 
        <!--  -->
	      <div class="col col-12 col-md-12">     
	         <div>
		<?php 
		 		
		 	$sql2 = "SELECT pa.fname, pa.mname, pa.student_id from patient as pa inner join patient_info as pai on pa.student_id = pai.student_id where pai.status = 4";
		 		$result2 = mysqli_query($conn, $sql2);
				$resultCheck2 = mysqli_num_rows($result2);

				if($resultCheck2 > 0){
					?>
					<table class="table table-bordered table-hover">
		 				<thead>
		 					<tr>
		 						<th>#</th>
		 						<th>ID</th>
		 						<th>Name</th>
		 						<th>Middle Name</th>
		 						<th>Action</th>
		 					</tr>
		 				</thead>
		 				<tbody>
		 					<?php
		 						$i = 1;
					while($rows2 = mysqli_fetch_assoc($result2)){
						$id = $rows2['student_id'];
						$fname = $rows2['fname'];
						$mname = $rows2['mname'];
						?>
						<tr>
		 						<td><?php echo $i; ?></td>
		 						<td><?php echo $id; ?></td>
		 						<td><?php echo $fname; ?></td>
		 						<td><?php echo $mname; ?></td>
						<td><a href="prescription.php?id=<?php echo $id; ?>&fname=<?php echo $fname; ?>&mname=<?php echo $mname; ?>"><button class="btn btn-primary">Give Drug</button></a></td>
						<?php
					}
		 }else
		 	echo "No Order given from Doctor";


		 ?>
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
      //setTimeout("location.reload(true);", 5000);
</script>

</body>
</html>