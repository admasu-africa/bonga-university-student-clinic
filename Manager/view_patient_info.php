<?php 
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Manager"){
  header("location:../index.php");
}
include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Manager | View Ptient Info</title>
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
        <span class="left_second_header">Manager</span>
        <span class="right_second_header"><i class="fas fa-"></i>View Patient info</span>
      </div>
      <hr class="text-primary">
      <div class="row content"> 
        <!--  -->
	      <div class="col col-12 col-md-12"> 

	      

	         <div class="inside_text">
			         <div class="mb-3">
						  <label for="search_txt" class="form-label">Search</label>
						  <input type="text" class="form-control" id="search_txt" placeholder="Enter stud ID or Name"  style="border: 2px solid #87CEFA;">
						</div>   
	         	 <!-- Search : <input type="text" name="search_stud" id="search_txt" placeholder="Enter stud ID or Name"> -->
	<?php
		$conn = mysqli_connect('localhost','root','','BUC');

			$sql = "select * from patient";
			$result = mysqli_query($conn, $sql);

			$resultCheck = mysqli_num_rows($result);
				
			if($resultCheck > 0){
				?>
			<table class="table" id="table1">
			<thead>
				<tr>
				<th>#</th>
				<th>ID</th>
				<th>First Name</th>
				<th>Middle Name</th>
				<th>Dept</th>
				<th>R.Date</th>
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
				<td><?php echo $rowt['student_id']; ?></td>
				<td><?php echo $rowt['fname']; ?></td>
				<td><?php echo $rowt['mname']; ?></td>
				<td><?php echo $rowt['dept']; ?></td>
				<td><?php echo $rowt['registered_date']; ?></td>
				<td><button class="btn btn-primary student_detail" value="<?php echo $rowt['student_id']; ?>">Detail</button></td>
				</tr>
				<?php $i++;
		}
	}else
		echo "No Registered Patient<br>";
	?>
	         </div>
	      </div> 

    </div>

    <hr class="text-">

        <?php //include 'include/footer.html'; ?>
  
    </div> 


  <div class="modal fade" id="student_detail">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h1>Patient Details</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body" id="display_student_detail">
				
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

      $(document).ready(function(){
$("#table1").DataTable({});
	//alert("wow its working");
	$("#search_txt").keyup(function(){
		var search = $(this).val().trim();
		//alert(search);
		$.ajax({
			url:'php/search_value.php',
			method:'post',
			data:{searchp:search},
			success:function(response){
			$("#table1").html(response);
			}
		});
	});

	$("#table1 tbody").on('click','.student_detail',function(){
		var id = $(this).val();
		$.ajax({
			url:'php/display_person_detail.php',
			method:'post',
			data:{student_id:id},
			success:function(response){
				$("#display_student_detail").html(response);
				$("#student_detail").modal('show');
			}
		});
		
	});
	});
</script>
</body>
</html>