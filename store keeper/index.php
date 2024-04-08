<?php 
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Storekeeper"){
  header("location:../index.php");
}
include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Storekeeper | Dashbord</title>
	<link rel="stylesheet" type="text/css" href="include/style.css">
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
        $sql = "SELECT * FROM patient_info WHERE status = 4";
        $res = mysqli_query($conn, $sql);
        $resCheck = mysqli_num_rows($res);

       ?>
      <div class="text">
        <span class="left_second_header">StoreKeeper</span>
        <span class="right_second_header"><i class="fas fa-home"></i> Dashboard/ Home</span>
      </div>
      <hr class="text-primary">
      <div class="row content"> 
        <!--  -->
      <div class="col col-12 col-md-12 col-lg-3" onclick="location.href='order.php'" style="border-left: 4px solid red; box-shadow: 0 0 1px 1px skyblue; margin: 5px;">     
        <div class="inside_text_1"> View Order</div>
        <div class="inside_text_1"> Total: <?php echo $resCheck; ?></div>
      </div> 
       <div class="col col-12 col-md-12 col-lg-3" onclick="location.href='register_drug.php'" style="border-left: 4px solid red; box-shadow: 0 0 1px 1px skyblue; margin: 5px;">
          <div class="inside_text_1">Register New Drug to Store</div>
      </div> 
      <div class="col col-12 col-md-12 col-lg-3" onclick="location.href='manage_request.php'" style="border-left: 4px solid red; box-shadow: 0 0 1px 1px skyblue; margin: 5px;">     
        <div class="inside_text_1"> Manage Request</div>
      </div> 
      <div class="col col-12 col-md-12 col-lg-3" onclick="location.href='store_drug_information.php'" style="border-left: 4px solid red; box-shadow: 0 0 1px 1px skyblue; margin: 5px;">
          <div class="inside_text_1" >View Store Drug Information</div>
      </div> 
      <div class="col col-12 col-md-12 col-lg-3" onclick="location.href='drug_information.php'" style="border-left: 4px solid red; box-shadow: 0 0 1px 1px skyblue; margin: 5px;">
          <div class="inside_text_1">View Dispensary Drug Information</div>
      </div> 
      <div class="col col-12 col-md-12 col-lg-3" onclick="location.href='model.php'" style="border-left: 4px solid red; box-shadow: 0 0 1px 1px skyblue; margin: 5px;">
          <div class="inside_text_1">Print Model</div>
      </div> 
       <div class="col col-12 col-md-12 col-lg-3" onclick="location.href='view_news.php'" style="border-left: 4px solid red; box-shadow: 0 0 1px 1px skyblue; margin: 5px;">
        <div class="inside_text_1">View News</div>
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

<script type="text/javascript">
	$(document).ready(function(){
		$.ajax({
			url: "php/create_notification.php",
			method:'post',
			data:{search:""},
			success:function(response){
				console.log(response);
			}
		});
	});
</script>
</body>
</html>