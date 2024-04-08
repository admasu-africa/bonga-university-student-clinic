<?php 
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Manager"){
  header("location:../index.php");
}
include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Manager | Genrate Report</title>
	<link rel="stylesheet" type="text/css" href="include/style.css">
	<link rel="stylesheet" type="text/css" href="../include/bootstrap/css/bootstrap.css">
    <script src="../include/bootstrap/js/bootstrap.js"></script>
    <script src="../include/jquery/jquery-3.6.2.js"></script>
     <link rel="stylesheet" type="text/css" href="../include/fontawesome/css/all.css">
     <script src="js/generate_report.js"></script>
     <script type="text/javascript">
    function printContent(){
      var restorePage = document.body.innerHTML;
      var printcontent = document.getElementById('print_content').innerHTML;
       document.body.innerHTML = printcontent;
       window.print();
       document.body.innerHTML = restorePage; 
    }
  </script>
</head>
<body>
	
		<?php include 'include/side_bar.php'; ?>


     <?php include 'include/navbar.php'; ?>

     <div class="home">
      <div class="text">
        <span class="left_second_header">Manager</span>
        <span class="right_second_header"><i class="fas fa-"></i>Generate Report</span>
      </div>
      <hr class="text-primary">
      <div class="row content"> 
        <!--  -->
	      <div class="col col-12 col-md-12">     
	         <div class="inside_text" style="cursor: auto;">
            <!-- <h1>Generating Report</h1>  -->
            <p>Please select the department you want to generate<p> <br>
            <select class="form-select mt-0" id="select_department">
              <option value="">Click Me to Select the department</option>
              <option value="card">Card</option>
              <option value="lab">Laboratory</option>
              <option value="opd">OPD</option>
            </select>
           </div>

            <div id="display_report_form" style="display: none;">
              <h4>Please Enter start and end date</h4>
              <div class="mb-3">
                <label for="start_date" class="form-label">Start date</label>
                <input type="date" class="form-control" id="start_date">
                <code id="start_date_error" style="display: none; font-size: 15px;"></code>
              </div>

               <div class="mb-3">
                <label for="end_date" class="form-label">End date</label>
                <input type="date" class="form-control" id="end_date">
                <code id="end_date_error" style="display: none; font-size: 15px;"></code>
              </div>

             <!--  Please Enter start and end date <br>
              <label>Enter Start Date: </label><input type="date" id="start_date">
              <code id="start_date_error" style="display: none;"></code><br>
              <label>Enter End Date: </label><input type="date" id="end_date">
              <code id="end_date_error" style="display: none;"></code><br> -->
              <input type="button" value="Generate" class="btn btn-success" id="generate">
            
          </div>
          <div id="display_report" style="cursor:auto;">
          
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
<script type="text/javascript">
  $(document).ready(function(){
    $("#select_department").change(function(){
      var dept = $(this).val();
      if(dept != ""){
        $("#display_report_form").css("display","block");
        $("#start_date").val("");
        $("#end_date").val("");
        $("#display_report").html("");
      }
      else if(dept == "")
        $("#display_report_form").css("display","none");
    });
    $("#generate").click(function(){
       var dept = $("#select_department").val();

      var start = $("#start_date").val();
      var end = $("#end_date").val();
      if(!validateStart(start,"start_date_error"))
        $("start_date").focus();
      else if(!validateEnd(end,"end_date_error"))
        $("end_date").focus();
      else if(!validateBoth(start,end,"end_date_error"))
        $("end_date").focus();
      else{
        $.ajax({
          url:'php/generate_report.php',
          method:'post',
          data:{start_date:start,end_date:end,department:dept},
          success:function(response){
            if(response == 1)
              $("#display_report").html("<div class='alert alert-danger'>No data registered between "+start+" And "+end+"</div>");
            else
              $("#display_report").html(response);
          }
        });
      }
    });
  });
</script>
</body>
</html>