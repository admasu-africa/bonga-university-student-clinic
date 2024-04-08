<?php 
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Manager"){
  header("location:../index.php");
}
include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Manager | View Feedback</title>
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
        <span class="left_second_header">Manager</span>
        <span class="right_second_header"><i class="fas fa-"></i>View Feedback</span>
      </div>
      <hr class="text-primary">
      <div class="row content"> 
        <!--  -->
	      <div class="col col-12 col-md-12">     
	         <div class="inside_text_n">
	         	<?php 
			// $conn = mysqli_connect('localhost','root','','BUC');
			$sql = "SELECT * from feedback inner join patient on student_id = feedback_by order by feedbacked_date desc";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);
			if($resultCheck > 0){
				while ($rows = mysqli_fetch_assoc($result)) {
					$date = $rows['feedbacked_date'];
					$feedback = $rows['feedback'];
					$feedback_by = $rows['fname'];
					$feedback_by1 = $rows['mname'];
					?>
					<div class="news">
						<div class="news_header mb-3">
							<div id="date">
								<label>Feedback given at: </label><?php echo $date;?>
							</div>
						</div>
						<i>feedback</i>
						<div class="news_content">
							 <?php echo $feedback; ?>
							 <div class="visible_to mt-3">
							Given by : <?php echo $feedback_by." ".$feedback_by1; ?>
							</div>
						</div>
					</div>
					<?php
				}
			}else
			echo "No feedback is given yet";

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