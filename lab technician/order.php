<?php
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Lab technician"){
  header("location:../index.php");
}
 include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Lab technician | Order</title>
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
        <span class="left_second_header">Lab Technician</span>
        <span class="right_second_header"><i class="fas fa-"></i> Order</span>
      </div>
      <hr class="text-primary">
      <div class="row content"> 
        <!--  -->
      <div class="col col-12 col-md-12">     
        <div class="inside_text">
         <div id="display_lab_msg">

	</div>
		<?php 

		 $conn = mysqli_connect("localhost", "root", "", "BUC");
		 $sql = "SELECT pa.student_id, pa.fname, pa.lname, pai.lab_test from patient as pa inner join patient_info as pai on pa.student_id = pai.student_id  where pai.status = 2";
		 $result = mysqli_query($conn, $sql);
		 if ($result == true) {	 
		 $resultCheck = mysqli_num_rows($result);

		 if ($resultCheck > 0) {
			?>
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Student Name</th>
							<th>Last Name</th>
							<th>ID</th>
							<th>Lab Request</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
			<?php
		        $i = 1;
		 	while ($row = mysqli_fetch_assoc($result)) {
				?>
					<tr>
					<td><?php echo $i; ?></td>
						<td><?php echo $row['fname']; ?></td>
						<td><?php echo $row['lname']; ?></td>
						<td><?php echo $row['student_id']; ?></td>
						<td><?php echo $row['lab_test']; ?></td>
						<td><a href="lab_test.php?id=<?php echo $row['student_id']; ?>"><button class="btn btn-success">Test on lab</button></a><br></td>
						
					</tr>
					<?php
					 $i++;
			}
					?>
				</tbody>
			</table>
		<?php				
						
			}else
				echo "<script>document.getElementById('display_lab_msg').innerHTML = '<div class=\"alert alert-info\">No Lab Request Given From Doctor</div>'</script>";
		 }else
		 echo "Error: ".mysqli_error($conn);			
			
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

</body>
</html>