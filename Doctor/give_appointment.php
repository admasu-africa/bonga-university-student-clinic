<?php
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Doctor"){
  header("location:../index.php");
}
 include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Doctor | Give Appointment</title>
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
        <span class="right_second_header"><i class="fas fa-"></i>Give Appointment</span>
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
		
		<form method="post" action="">
			<div class="md-3 mb-3">
				  <label for="id" class="form-label">Student ID</label>
				  <input type="text" class="form-control" id="id" placeholder="Enter student ID" name="id" required>
				</div>

				<div class="md-3 mb-3">
				  <label for="app_date" class="form-label">Apointment Date</label>
				  <input type="date" class="form-control" id="app_date" name="app_date" required>
				</div>


			<!-- Id: <input type="text" name="id" required><br><br> -->
			<!-- Apointment Date: <input type="Date" name="app_date" required><br><br> -->
			<input class="btn btn-primary" type="submit" name="submit" value="submit">
		</form>
			<?php 
	if (isset($_POST['submit'])) {
			$date = date("Y-m-d");
			$id = test_input($_POST['id']);
			$app_date = $_POST['app_date'];
			$doc_id = $_SESSION['user_id'];
			if($app_date <= $date){
				echo "<script>alert('please enter correct date')</script>";
			}else{
				$sql1 = "SELECT * FROM patient WHERE student_id = '$id'";
				$res1 = mysqli_query($conn, $sql1);
				$resCheck1 = mysqli_num_rows($res1);
				if($resCheck1 > 0){
					$sql = "insert into appointment values('$id','$doc_id','$date','$app_date',1)";
				if(mysqli_query($conn,$sql)){
					echo "<script>alert('Appointment Registered succesfully ')</script>";
				}
				
			else{
				echo "Not registererd";
			}
			// header("location: ../registration.php");
		}else{
			echo "<script>alert('Not Available student ID')</script>";
		}			
			}
			
		}
	function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
	        
?>

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