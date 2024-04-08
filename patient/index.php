<?php 
session_start();
if(!isset($_SESSION['user_name'])){
  header("location:../index.php");
}
include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Patient | Dashboard</title>
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
        <span class="right_second_header"><i class="fas fa-home"></i> Dashboard</span>
      </div>
      <hr class="text-primary">
      <div class="row content"> 
        <!--  -->
      <div class="col col-12 col-md-12 col-lg-3" onclick="location.href='view_information.php'" style="border-left: 4px solid red; box-shadow: 0 0 1px 1px skyblue; margin: 5px;">     
        <div class="inside_text_1">
         View Information
        </div>
      </div> 
       <div class="col col-12 col-md-12 col-lg-3" onclick="location.href='view_appointment.php'" style="border-left: 4px solid red; box-shadow: 0 0 1px 1px skyblue; margin: 5px;">
          <div class="inside_text_1">View Appointment</div>
      </div> 
       <div class="col col-12 col-md-12 col-lg-3" onclick="location.href='view_news.php'" style="border-left: 4px solid red; box-shadow: 0 0 1px 1px skyblue; margin: 5px;">
        <div class="inside_text_1">View News</div>
        <div class="inside_text_1"></div>
      </div> 
       <div class="col col-12 col-md-12 col-lg-3" onclick="location.href='give_feedback.php'" style="border-left: 4px solid red; box-shadow: 0 0 1px 1px skyblue; margin: 5px;">
          <div class="inside_text_1">Give Feedback</div>
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