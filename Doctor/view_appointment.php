<?php
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Doctor"){
  header("location:../index.php");
}
 include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Doctor | View Appointment</title>
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
        <span class="left_second_header">Doctor</span>
        <span class="right_second_header"><i class="fas fa-"></i>View Appointment</span>
      </div>
      <hr class="text-primary">
      <div class="row content"> 
        <!--  -->
	      <div class="col col-12 col-md-12">     
	         <div>
	         <div id="display_lab_result_msg">
			
		</div>
		<div id="display_status_msg">
			
		</div>
		
		<div id="display_app_msg">
			
		</div>
		
			<!-- <label>Enter Search Value: </label>
			<input type="text" id="search_value" name="search_value" placeholder="Search on stud Name or stud ID"> -->
		<?php 
		 $conn = mysqli_connect("localhost", "root", "", "BUC");
		$sqlt = $sql = "SELECT pa.fname, pa.lname, pa.student_id, app.app_for_date from patient as pa INNER JOIN appointment as app on pa.student_id = app.student_id WHERE app.status = 1";
			$rest = mysqli_query($conn, $sqlt);
			$resCht = mysqli_num_rows($rest); 
			if($resCht > 0){
					$i = 1;
					?>
				<div class="mb-3">
				  <label for="search_value" class="form-label">Search</label>
				  <input type="text" class="form-control" id="search_value" placeholder="Search on stud Name or stud ID">
				</div>	
		<table class="table" id="satable">
			<thead>
				<tr>
				<th>#</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>ID</th>
				<th>Appointment Date</th>
				<th>Status</th>
				<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					while ($rowt = mysqli_fetch_assoc($rest)) {
				 ?>
				<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rowt['fname']; ?></td>
				<td><?php echo $rowt['lname']; ?></td>
				<td><?php echo $rowt['student_id']; ?></td>
				<td><?php echo $rowt['app_for_date']; ?></td>
				<td>
					<?php if($rowt['app_for_date'] > date("Y-m-d")){
						echo "Waiting";
						}else{
							echo "Date Passed";
					} ?>
				</td>
				<td><button  value="<?php echo $rowt['student_id']; ?>" class="btn btn-primary app_btn">Treate</button></td>
				</tr>
			<?php $i++;
		}
	}else
		echo "<h3> No Appointment is Given yet </h3>" ?>
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
		$("#search_value").keyup(function(){
			var value = document.getElementById('search_value').value;
			$.ajax({
				url:'php/search_appointment.php',
				method:'get',
				data:{value:value},
				success:function(response){
					$("#satable").html(response);
				}
			});
		});
	$(".app_btn").click(function(){
		var student_id = $(this).val();
		$.ajax({
			url:'php/finish_appointment.php',
			method:'post',
			data:{student_id:student_id},
			success:function(response){
				if(response == 1)
					location.href = "opd.php?id="+student_id;
				else
					$("#display_app_msg").html("<div class='alert alert-danger'>" +response+ "</div>");
			}
		});
	});
})
</script>

</body>
</html>