<?php 
session_start();
if(!isset($_SESSION['user_name'])){
  header("location:../index.php");
}
include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Patient | Give feedback</title>
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
        <span class="right_second_header"><i class="fas fa-"></i> Give feedback</span>
      </div>
      <hr class="text-primary">
      <div class="row content"> 
        <!--  -->
      <div class="col col-12 col-md-12">     
        <div class="inside_text">

          <div id="post_error">
            
          </div>
         <form action="" method="POST">
          <div>
      			<label class="form-label" for="feedback">Please Write your feedback</label>
      			<textarea name="feedback" class="form-control" id="feedback"  rows="3" required placeholder="Write your feedback in here....."></textarea><br>
      			<input class="btn btn-success" type="submit" name="submit" value="Submit" id="submit_feedback">
          </div>
		</form>
    <?php if(isset($_POST['submit'])){
      $feedback = $_POST['feedback'];
      $date = date("Y-m-d H:i:s");
      $student_id = $_SESSION['student_id'];
      $sql = "INSERT INTO feedback(feedback_by, feedbacked_date, feedback, status) values('$student_id','$date','$feedback',1)";
      $res = mysqli_query($conn, $sql);
      if($res)
        echo "<script>location.href='index.php'</script>";
      else
        echo "<script>$('#post_error').html('".mysqli_error($conn)."')</script>";
    } ?>
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