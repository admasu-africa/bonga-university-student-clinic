<?php
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Doctor"){
  header("location:../index.php");
}
 include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Doctor | Dashbord</title>
	 <?php include 'include/header.php'; ?>
</head>
<body style="background: #E4E9F7">

	<?php $sql = "SELECT * from patient where status = 1";
		$res = mysqli_query($conn, $sql);
		$no_of_waiting_patient = mysqli_num_rows($res); 


		$sql2 = "SELECT * from patient_info where status = 2 or status = 3 or status = 4";
		$res2 = mysqli_query($conn, $sql2);
		$no_of_circulation = mysqli_num_rows($res2); 

		$sql3 = "SELECT * from patient_info where status = 3";
		$res3 = mysqli_query($conn, $sql3);
		$no_of_lab_result = mysqli_num_rows($res3); 

		$sql4 = "SELECT * from appointment where status = 1";
		$res4 = mysqli_query($conn, $sql4);
		$no_of_app = mysqli_num_rows($res4); 

		?>

	<?php include 'include/side_bar.php'; ?>


     <?php include 'include/navbar.php'; ?>

     <div class="home">

      <div class="text">
        <span class="left_second_header">Doctor</span>
        <span class="right_second_header"><i class="fas fa-home"></i>Home</span>
      </div>
      <hr class="text-primary">
      <div class="row content"> 
        <!--  -->
     
	      <div class="col col-12 col-md-12 col-lg-3" onclick="location.href='view_available_patient.php'" style="border-left: 4px solid red; box-shadow: 0 0 1px 1px skyblue; margin: 5px;">     
	         <div class="inside_text_1">View Waiting patient in OPD</div>
	          <div class="inside_text_1">Total: <?php echo $no_of_waiting_patient; ?>  </div>
	      </div> 
	       <div class="col col-12 col-md-12 col-lg-3" onclick="location.href='order.php'" style="border-left: 4px solid red; box-shadow: 0 0 1px 1px skyblue; margin: 5px;">
	          <div class="inside_text_1">View Ordered</div>
	          <div class="inside_text_1">Total: <?php echo $no_of_circulation; ?></div>
	      </div> 
	       <div class="col col-12 col-md-12 col-lg-3" onclick="location.href='result.php'" style="border-left: 4px solid red; box-shadow: 0 0 1px 1px skyblue; margin: 5px;">
	        <div class="inside_text_1">Lab Result</div>
	        <div class="inside_text_1">Total: <?php echo $no_of_lab_result; ?></div>
	      </div> 

    </div>

    <div class="row content"> 
        <!--  -->
	      <div class="col col-12 col-md-12 col-lg-3" onclick="location.href='give_appointment.php'" style="border-left: 4px solid red; box-shadow: 0 0 1px 1px skyblue; margin: 5px;">     
	        <div class="inside_text_1">
	          Give Appointment
	        </div>
	      </div> 
	       <div class="col col-12 col-md-12 col-lg-3" onclick="location.href='view_appointment.php'" style="border-left: 4px solid red; box-shadow: 0 0 1px 1px skyblue; margin: 5px;">
	          <div class="inside_text_1">View Appointment</div>
	          <div class="inside_text_1">Total: <?php echo $no_of_app; ?></div>
	      </div> 
	       <div class="col col-12 col-md-12 col-lg-3" onclick="location.href='view_news.php'" style="border-left: 4px solid red; box-shadow: 0 0 1px 1px skyblue; margin: 5px;">
	        <div class="inside_text_1">View News</div>
	        <div class="inside_text_1">4 new posts</div>
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
      // setTimeout("location.reload(true);", 5000);
    </script>

	
</body>
</html>