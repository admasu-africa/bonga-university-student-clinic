<?php 
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Pharmacist"){
  header("location:../index.php");
}
include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Pharmacist | Dashbord</title>
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
        <span class="right_second_header"><i class="fas fa-"></i> View News</span>
      </div>
      <hr class="text-primary">
      <div class="row content"> 
        <!--  -->
	        <div class="col col-12 col-md-12 srch"> 
        <div class="inside_text_n">
		<?php 
		//include 'include/dbc.inc.php';
		$sql = "SELECT * from news where (view = 'all' or view = 'employee') order by posted_date desc";
		$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);
			if($resultCheck > 0){
				while ($rows = mysqli_fetch_assoc($result)) {
					$header = $rows['header'];
					$content = $rows['content'];
					$posted_date = $rows['posted_date'];
					$access = $rows['view'];
					?>
					<div class="news">
						<div class="news_header">
							<?php 
							echo $header; 
							?>
							<div id="date">
								<?php echo $posted_date;?>
							</div>
						</div>
						<div class="news_content">
							<?php echo $content; ?>
						</div>
						
					</div>
					<?php
				
				}
			}else
				echo "No News Posted yet";

		 ?>
	         </div>
	      </div> 

    </div>

    

    <hr class="text-">

        <?php //include 'include/footer.html'; ?>
  
    </div>
<script src="js/register_drug.js"></script>	
 <script src="js/script.js"></script> 

<script type="text/javascript">
	var subMenu = document.getElementById('subMenu');

      function toggleMenu(){
        subMenu.classList.toggle('open-menu');
      }

     
</script>
</body>
</html>