<?php 
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Doctor"){
  header("location:../index.php");
}
include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Doctor | View Approve Request</title>
  <link rel="stylesheet" type="text/css" href="include/style.css">
    <link rel="stylesheet" type="text/css" href="../include/bootstrap/css/bootstrap.css">
    <script src="../include/bootstrap/js/bootstrap.js"></script>
    <script src="../include/jquery/jquery-3.6.2.js"></script>
     <link rel="stylesheet" type="text/css" href="../include/fontawesome/css/all.css">
  <script type="text/javascript">
    function printContent(el){
      var restorePage = document.body.innerHTML;
      var printcontent = document.getElementById(el).innerHTML;
       document.body.innerHTML = printcontent;
       window.print();
       document.body.innerHTML = restorePage; 
    }
  </script>
</head>
<body>



  <?php include "include/dbc.inc.php"; ?>
    <?php include 'include/side_bar.php'; ?>


     <?php include 'include/navbar.php'; ?>

     <div class="home">

      <div class="text">
        <span class="left_second_header">Doctor</span>
        <span class="right_second_header"><i class="fas fa-"></i>Approved Refer</span>
      </div>
      <hr class="text-primary">
      <div class="row content"> 
        <!--  -->
        <div class="col col-12 col-md-12">     
           <div class="inside_text_2">
            <?php 
            $date = date("Y-m-d");
            $sql = "SELECT rf.refer_to, rf.cc, rf.brief_diagnosis, rf.pe, rf.investigation, rf.treatment_given, rf.reason_for_referal, rf.time_of_referal, emp.fname as doctor_name, emp.lname as doctor_lname, pa.fname as stud_name, pa.mname as stud_mname, pa.age, pa.sex, pa.phone_no, rf.student_id  FROM referal as rf inner join patient as pa on rf.student_id = pa.student_id inner join employee as emp on emp.employee_id = rf.refered_by where rf.status = 2 limit 1";
            $res = mysqli_query($conn, $sql);
            $resCheck = mysqli_num_rows($res);
            if($resCheck > 0){
              while($row = mysqli_fetch_assoc($res)){
             ?>
             <div id="print">
            <input type="hidden" id="student_id" value="<?php echo $row['student_id']; ?>">
            <table class="table">
              <tr>
                <th>Bonga University Student Clinic</th>
              </tr>
                <tr>
                  <td><b>MRN:</b>  <u></u></td>
                </tr>
                <tr>
                  <td><b>Date:</b>  <u><?php echo $date; ?></u></td>
                </tr>
                <tr>
                  <td><b>TO:</b> <u><?php echo $row['refer_to']; ?></u> </td>
                </tr>
                <tr>
                  <td><b>PTS Name:</b>  <u><?php echo $row['stud_name']; ?></u> <b>Age:</b> <u><?php echo $row['age']; ?></u> <b>Sex:</b> <u><?php echo $row['sex']; ?></u> Address <u><?php echo $row['phone_no']; ?></u> </td>
                </tr>
                <tr>
                  <td><b>C/C:</b> <?php echo $row['cc']; ?> </td>
                </tr>
                <tr>
                  <td><b>BRIEF HX & DIAGNOSIS:</b> <?php echo $row['brief_diagnosis']; ?></td>
                </tr>
                <tr>
                  <td><b>P/E-(partinent finding):</b> <?php echo $row['pe']; ?></td>
                </tr>
                <tr>
                  <td><b>Investigation Done:</b> <?php echo $row['investigation']; ?></td>
                </tr>
                <tr>
                  <td><b>Treatment Given:</b> <?php echo $row['treatment_given']; ?></td>
                </tr>
                <tr>
                  <td><b>Reason for referal:</b> <?php echo $row['reason_for_referal']; ?></td>
                </tr>
                <tr>
                  <td><b>Time of referal:</b> <?php echo $row['time_of_referal']; ?></td>
                </tr>
                <tr>
                  <td><b>Name & Proffession of Physician:</b> <u><?php echo $row['doctor_name']." ".$row['doctor_lname']; ?></u> <b>Signature:</b></td>
                </tr>
            </table>
            </div>
            <button class='btn btn-success' id='print' onclick='printContent("print");'>Print</button>
             <button id="close_refer" class="btn btn-danger">Remove</button>
            <?php

              } 
            }else
              echo "<div class='alert alert-info'>No Approved Refer Request</div>";
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
    $(document).ready(function(){
      $("#close_refer").click(function(){
        var student_id = $("#student_id").val();
        $.ajax({
          url:'php/clear_referal.php',
          method:'post',
          data:{student_id:student_id},
          success:function(response){
            console.log(response);
          }
        });
      });
    });
</script>

</body>
</html>