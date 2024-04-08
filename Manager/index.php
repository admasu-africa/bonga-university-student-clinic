<?php 
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Manager"){
  header("location:../index.php");
}
include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Manager | Dashbord</title>
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

     	<?php 
    $sql = "SELECT * FROM patient";
    $res = mysqli_query($conn, $sql);
    $no_of_patient = mysqli_num_rows($res);


      $sql2 = "SELECT * FROM employee";
      $res2 = mysqli_query($conn, $sql2);
      $no_of_employee = mysqli_num_rows($res2);


       $sql3 = "SELECT * FROM provide_request where status = 2";
      $res3 = mysqli_query($conn, $sql3);
      $no_of_waiting_approval = mysqli_num_rows($res3);
    
      $sql4 = "SELECT * FROM feedback where status = 1";
      $res4 = mysqli_query($conn, $sql4);
      $view_feedback = mysqli_num_rows($res4);

      $sql5 = "SELECT * FROM news";
      $res5 = mysqli_query($conn, $sql5);
      $total_news = mysqli_num_rows($res5);
   ?>

      <div class="text">
        <span class="left_second_header">Manager</span>
        <span class="right_second_header"><i class="fas fa-home"></i>Home</span>
      </div>
      <hr class="text-primary">
      <div class="row content"> 
        <!--  -->
	      <!-- <div class="col col-12 col-md-12 col-lg-3" onclick="location.href='view_patient_info.php'" style="border: 1px solid #696969;border-radius: 26px;">     
	         <div class="inside_text_1">View patient Info</div>
	          <div class="inside_text_1">Total: <?php //echo $no_of_patient; ?></div>
	      </div>  -->
	       <div class="col col-12 col-md-12 col-lg-3" onclick="location.href='register_employee.php'" style="border-left: 4px solid red; box-shadow: 0 0 1px 1px skyblue; margin: 5px;">
	          <div class="inside_text_1">Add Employee</div>
	      </div> 
	       <div class="col col-12 col-md-12 col-lg-3" onclick="location.href='view_employee.php'" style="border-left: 4px solid red; box-shadow: 0 0 1px 1px skyblue; margin: 5px;">
	        <div class="inside_text_1">View Employee Info</div>
	        <div class="inside_text_1">Total: <?php echo $no_of_employee; ?></div>
	      </div> 

    </div>

    <div class="row content"> 
        <!--  -->
	      <div class="col col-12 col-md-12 col-lg-3" onclick="location.href='approve_request.php'" style="border-left: 4px solid red; box-shadow: 0 0 1px 1px skyblue; margin: 5px;">     
	        <div class="inside_text_1"> Waiting Approval Request</div>
	        <div class="inside_text_1">Total: <?php echo $no_of_waiting_approval; ?></div>
	      </div> 
	       <div class="col col-12 col-md-12 col-lg-3" onclick="location.href='post_news.php'" style="border-left: 4px solid red; box-shadow: 0 0 1px 1px skyblue; margin: 5px;">
	          <div class="inside_text_1">Post News</div>
	      </div> 
	       <div class="col col-12 col-md-12 col-lg-3" onclick="location.href='view_news.php'" style="border-left: 4px solid red; box-shadow: 0 0 1px 1px skyblue; margin: 5px;">
	        <div class="inside_text_1">View News</div>
	        <div class="inside_text_1">total: <?php echo $total_news; ?></div>
	      </div> 
        <div class="col col-12 col-md-12 col-lg-3" onclick="location.href='view_feedback.php'"style="border-left: 4px solid red; box-shadow: 0 0 1px 1px skyblue; margin: 5px;">
          <div class="inside_text_1">View Feedback</div>
          <div class="inside_text_1">Total: <?php echo $view_feedback; ?></div>
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
    </script>


</body>
</html>