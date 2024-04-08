<?php 
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Clerk"){
  header("location:../index.php");
}
include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Clerk | Dashboard</title>
   <?php include 'include/header.php'; ?>
</head>
<body style="background: #E4E9F7">

  <?php 
  $sql = "SELECT * FROM patient";
  $res = mysqli_query($conn, $sql);
  $no_of_patient = mysqli_num_rows($res);
   ?>
    
    <?php include 'include/side_bar.html'; ?>


     <?php include 'include/navbar.php'; ?>

    <div class="home">
       

      <div class="text">
        <span class="left_second_header">Clerk</span>
        <span class="right_second_header"><i class="fas fa-home"></i>Home</span>
      </div>
      <hr class="text-primary">
      <div class="row content" style="gap: 3px; padding: 20px;"> 
        <!--  -->
      <div class="col col-12 col-md-12 col-lg-3 columns" onclick="location.href='registration.php'"style="border-left: 4px solid red; box-shadow: 0 0 1px 1px skyblue; margin: 5px;">     
        <div class="inside_text_1">
          Register New Patient
        </div>
      </div> 
       <div class="col col-12 col-md-12 col-lg-3" onclick="location.href='search.php'"style="border-left: 4px solid red; box-shadow: 0 0 1px 1px skyblue; margin: 5px;">
          <div class="inside_text_1">Search Existing Patient</div>
          <div class="inside_text_1">Total: <?php echo $no_of_patient; ?></div>
      </div> 
       <div class="col col-12 col-md-12 col-lg-3" onclick="location.href='view_news.php'"style="border-left: 4px solid red; box-shadow: 0 0 1px 1px skyblue; margin: 5px;">
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
</body>
</html>