<?php 
session_start();
if(!isset($_SESSION['user_name'])){
  header("location:../index.php");
}
include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Patient | View Appointment</title>
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
        <span class="right_second_header"><i class="fas fa-"></i> View Appoint.</span>
      </div>
      <hr class="text-primary">
      <div class="row content"> 
        <!--  -->
      <div class="col col-12 col-md-12">     
        <div class="inside_text">
         <?php 
		include 'include/dbc.inc.php';
		$student_id = $_SESSION['student_id'];
		$sql = "select * from appointment inner join patient on patient.student_id = appointment.student_id where appointment.student_id = '$student_id'";
		$res = mysqli_query($conn, $sql);
		if($res == true){
			$resCheck = mysqli_num_rows($res);
			if($resCheck > 0){
				while ($row = mysqli_fetch_assoc($res)) {
					$ketero = $row['app_for_date'];
					echo "<br> Appointment date: ".$ketero."<br>";
				}
			}else
				echo "No Given Appointment ";
		}else
			echo mysqli_error($conn);

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