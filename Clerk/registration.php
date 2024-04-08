<?php 
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Clerk"){
  header("location:../index.php");
}
include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Clerk | Registration</title>
	<link rel="stylesheet" type="text/css" href="include/style.css">
	<link rel="stylesheet" type="text/css" href="../include/bootstrap/css/bootstrap.css">
    <script src="../include/bootstrap/js/bootstrap.js"></script>
    <script src="../include/jquery/jquery-3.6.2.js"></script>
     <link rel="stylesheet" type="text/css" href="../include/fontawesome/css/all.css">
	<script src="js/validate.js"></script>
</head>
<body style="background: #E4E9F7">

    <?php include 'include/side_bar.html'; ?>


     <?php include 'include/navbar.php'; ?>
     


     <div class="home">

      <div class="text">
        <span class="left_second_header">Clerk</span>
        <span class="right_second_header"><i class="fas fa-registered"></i> Register</span>
      </div>
      <hr class="text-primary">
        <div class="inside_text_1">
        	<?php 
		include 'section/register_patient.html';
	?>


    </div>

    <hr class="text-success">

        <?php //include 'include/footer.html'; ?>
  
    </div> 
    


<script src="js/script.js"></script>
       <script type="text/javascript">
      var subMenu = document.getElementById('subMenu');

      function toggleMenu(){
        subMenu.classList.toggle('open-menu');
      }
    </script>

	<!-- 	</div>
	</div>
</div> -->
</body>
</html>