 <?php 
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Admin"){
  header("location:../index.php");
} ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin | Employee Acc</title>
	<link rel="stylesheet" type="text/css" href="include/style.css">
	<link rel="stylesheet" type="text/css" href="../include/bootstrap/css/bootstrap.css">
	<script src="../include/bootstrap/js/bootstrap.js"></script>
	<script src="../include/jquery/jquery-3.6.2.js"></script>
	<link rel="stylesheet" type="text/css" href="../include/fontawesome/css/all.css">
	<link href="../include/datatable/datatables.min.css" rel="stylesheet"/>
    <script src="../include/datatable/datatables.min.js"></script>
</head>
<body>
	<?php include "include/dbc.inc.php"; ?>

		<?php include 'include/side_bar.html'; ?>


     <?php include 'include/navbar.php'; ?>

     <div class="home">

      <div class="text">
        <span class="left_second_header">Admin</span>
        <span class="right_second_header"><i class="fas fa-"></i> Employee Account</span>
      </div>
      <hr class="text-primary">
      <div class="row content"> 
        <!--  -->
	      <div class="col ">     
	         <div class="">
	         	 <!-- <div class="mb-3">
						    <label for="search_emp" class="form-label">Search</label>
						    <input type="text" class="form-control form-control-lg" id="search_emp" aria-describedby="emailHelp" placeholder="Enter employee ID or Name" style="border: 2px solid #87CEFA;">	 
  						</div> -->
	         	<!-- Enter Search value: <input type="text" name="search_emp" id="search_emp" placeholder="Enter employee ID or Name"> -->
		<?php 
		$conn = mysqli_connect('localhost','root','','BUC');
	
			$sql = "SELECT * from employee WHERE position != 'Admin'";

			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);
			if($resultCheck > 0){
					?>
			<table class="table table-bordered table-hover" id="table1">
			<thead>
				<tr>
				<th>#</th>
				<th>ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Address</th>
				<th>Position</th>
				<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$i = 1;
			while ($rowt = mysqli_fetch_assoc($result)) {
			?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rowt['employee_id']; ?></td>
				<td><?php echo $rowt['fname']; ?></td>
				<td><?php echo $rowt['lname']; ?></td>
				<td><?php echo $rowt['address']; ?></td>
				<td><?php echo $rowt['position']; ?></td>
				<td>
					<button class="btn btn-primary employee_detail" value="<?php echo $rowt['employee_id']; ?>">Detail</button>
					<?php if($rowt['status'] == 1){
						?>			
					<button class="btn btn-danger employee_deactive" value="<?php echo $rowt['employee_id']; ?>" style="width: 75px;">Deactive</button>
					<?php
					}else {
						?>			
					<button class="btn btn-success employee_active" value="<?php echo $rowt['employee_id']; ?>" style="width: 75px;">Active</button>
					<?php
					}
					?>
					<!-- <button class="btn btn-secondary employee_reset_pass" value="<?php //echo $rowt['employee_id']; ?>">Reset</button> -->
				</td>
				</tr>
				<?php $i++;
		}
	}else
		echo "No Registered employee<br>";
	?>
	         </div>
	      </div> 

    </div>


        <?php //include 'include/footer.html'; ?>
  
    </div> 

    <?php //include 'include/footer.html'; ?>

 <div class="modal fade" id="employee_detail">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h1>Employee Details</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body" id="display_employee_detail">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
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
		$("#table1").DataTable({});
	$("#search_emp").keyup(function(){
		var search = $(this).val().trim();
		//alert(search);
		$.ajax({
			url:'php/search_value.php',
			method:'post',
			data:{searchemp:search},
			success:function(response){
			$("#table1").html(response);
			}
		});
	});
	$("#table1 tbody").on('click','.employee_detail',function(){
// $(".employee_detail").click(function(){
		var id = $(this).val();
		$.ajax({
			url:'php/display_person_detail.php',
			method:'post',
			data:{employe_detail:"detail",employee_id:id},
			success:function(response){
				$("#display_employee_detail").html(response);
				$("#employee_detail").modal('show');
			}
		});
		
	});	
	$("#table1 tbody").on('click','.employee_deactive',function(){
// $(".employee_deactive").click(function(){
	var id = $(this).val();
	if(confirm("Are You Sure to Deactive employee account?")){
		$.ajax({
			url:'php/display_person_detail.php',
			method:'post',
			data:{deactive_emp:"detail",employee_id:id},
			success:function(response){
				if(response == 1)
					alert("Selected employee account deactivated");
				else
					alert(response);
				// $("#display_employee_detail").html(response);
				// $("#employee_detail").modal('show');
			}
		});
	}
});
	$("#table1 tbody").on('click','.employee_active',function(){
// $(".employee_active").click(function(){
	var id = $(this).val();
	if(confirm("Are You Sure to Active employee account?")){
		$.ajax({
			url:'php/display_person_detail.php',
			method:'post',
			data:{active_emp:"detail",employee_id:id},
			success:function(response){
				if(response == 1)
					alert("Selected employee account activated");
				else
					alert(response);
				// $("#display_employee_detail").html(response);
				// $("#employee_detail").modal('show');
			}
		});
	}
});
$(".employee_reset_pass").click(function(){
	var id = $(this).val();
	if(confirm("Are You Sure to Reset employee Password?")){
		$.ajax({
			url:'php/display_person_detail.php',
			method:'post',
			data:{reset_emp_pass:"detail",employee_id:id},
			success:function(response){
				if(response == 1)
					alert("Selected employee Password Resseted");
				else
					alert(response);
				// $("#display_employee_detail").html(response);
				// $("#employee_detail").modal('show');
			}
		});
	}
});

});
</script>
</body>
</html>