<?php 
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Admin"){
  header("location:../index.php");
}
include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin | Dashboard</title>
  <?php include 'include/header.php'; ?>
</head>
<body>
  <?php 
    $sql = "SELECT * FROM patient";
    $res = mysqli_query($conn, $sql);
    $no_of_patient = mysqli_num_rows($res);


      $sql2 = "SELECT * FROM employee";
      $res2 = mysqli_query($conn, $sql2);
      $no_of_employee = mysqli_num_rows($res2);


      //  $sql = "SELECT * FROM patient";
      // $res = mysqli_query($conn, $sql);
      // $no_of_patient = mysqli_num_rows($res);
   
   ?>
	
    <?php include 'include/side_bar.html'; ?>


     <?php include 'include/navbar.php'; ?>

    <div class="home">
       

      <div class="text">
        <span class="left_second_header">Admin</span>
        <span class="right_second_header"><i class="fas fa-home"></i>Home</span>
      </div>
      <hr class="text-primary">
      <div class="row content" style="gap: 3px; padding: 20px;"> 
        <!--  -->
          <div class="col col-12 col-md-12 col-lg-3 m-3  columns" id="one" onclick="location.href='employee.php'" class="inside_text_1" style="border-left: 4px solid red; box-shadow: 0 0 1px 1px skyblue; margin: 5px;">     
            <div >
              View Employee Account
            </div>
            <div class="inside_text_1">Total: <?php echo $no_of_employee; ?></div>
          </div> 
           <div class="col col-12 col-md-12 col-lg-3 m-3 " onclick="location.href='patient.php'" style="border-left: 4px solid red; box-shadow: 0 0 1px 1px skyblue;">
              <div class="inside_text_1">View Patient Account</div>
              <div class="inside_text_1">Total: <?php echo $no_of_patient; ?></div>
          </div> 
           <div class="col col-12 col-md-12 col-lg-3 m-3 " onclick="location.href='view_news.php'" style="border-left: 4px solid red; box-shadow: 0 0 1px 1px skyblue;">
            <div class="inside_text_1">View News</div>
            <div class="inside_text_1"></div>
          </div> 
 


         


    </div>

    <!-- <hr class="text-"> -->
    </div> 
<?php //include 'include/footer.html'; ?>

    <script src="js/script.js"></script>
       <script type="text/javascript">
      var subMenu = document.getElementById('subMenu');

      function toggleMenu(){
        subMenu.classList.toggle('open-menu');
      }
    </script>
</body>
</html>