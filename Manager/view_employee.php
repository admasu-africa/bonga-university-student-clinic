<?php 
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Manager"){
  header("location:../index.php");
}
include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Manager | View employee</title>
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

		<?php include 'include/side_bar.php'; ?>


     <?php include 'include/navbar.php'; ?>

     <div class="home">

      <div class="text">
        <span class="left_second_header">Manager</span>
        <span class="right_second_header"><i class="fas fa-"></i>View Employee Info</span>
      </div>
      <hr class="text-primary">
      <div class="row content"> 
        <!--  -->
	      <div class="col col-12 col-md-12">     
	         <!-- <div class="inside_text"> -->
	         	 <!-- <div class="mb-3">
						  <label for="search_emp" class="form-label">Search</label>
						  <input type="text" class="form-control" id="search_emp" placeholder="Enter employee ID or Name"  style="border: 2px solid #87CEFA;">
						</div>  --> 
	         	<!-- Enter Search value: <input type="text" name="search_emp" id="search_emp" placeholder="Enter employee ID or Name"> -->
		<?php 
		$conn = mysqli_connect('localhost','root','','BUC');
	
			$sql = "SELECT * from employee";

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
					<?php if(($rowt['position'] != "Admin") && ($rowt['position'] != "Manager")){
						?>
					<a href="change_privilage.php?emp_id=<?php echo $rowt['employee_id']; ?>"><button class="btn btn-success update_privilage" style="width: 90px;">Update</button></a>
					<?php
				}
				?>
			</td>
				</tr>

				<?php
				 $i++;
				}
				
	}else
		echo "No Registered employee<br>";
	?>
	         <!-- </div> -->
	      </div> 

    </div>

    <hr class="text-success">

        <?php //include 'include/footer.html'; ?>
  
    </div> 
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
		 // $('.dropdown-menu').dropdown('show');
	//alert("wow its working");
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
		var id = $(this).val();
		$.ajax({
			url:'php/display_person_detail.php',
			method:'post',
			data:{employee_id:id},
			success:function(response){
				$("#display_employee_detail").html(response);
				$("#employee_detail").modal('show');
			}
		});
		
	});
	// $(".update_privilage").click(function(){
	// 	var id = $(this).val();
	// 		$.ajax({
	// 		url:'php/change_privilage.php',
	// 		method:'post',
	// 		data:{add:"add",employee_id:id},
	// 		success:function(response){
	// 			if(response == 1)
	// 				alert("Employee Updated successfully");
	// 			else
	// 			alert(response);
	// 	});
	// 	}		
		
	// });

	// $(".remove_privilage").click(function(){
	// 	var id = $(this).val();
	// 	if(confirm("Are You Sure to Remove storeKeeper Privilage?")){
	// 		$.ajax({
	// 		url:'php/change_privilage.php',
	// 		method:'post',
	// 		data:{remove:"add",employee_id:id},
	// 		success:function(response){
	// 			if(response == 1)
	// 				alert("Privilage removed successfully");
	// 			else
	// 			alert(response);
	// 		}
	// 	});
	// 	}		
		
	// });


});

    //  $(document).ready(function(){
    //     $('.dropdown-toggle').toggle();
    // });
</script>
</body>
</html>