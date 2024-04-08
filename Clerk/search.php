<?php 
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Clerk"){
  header("location:../index.php");
}
include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Clerk | Search patient</title>
	<link rel="stylesheet" type="text/css" href="include/style.css">
    <link rel="stylesheet" type="text/css" href="../include/bootstrap/css/bootstrap.css">
    <script src="../include/bootstrap/js/bootstrap.js"></script>
    <script src="../include/jquery/jquery-3.6.2.js"></script>
     <link rel="stylesheet" type="text/css" href="../include/fontawesome/css/all.css">
     <link href="../include/datatable/datatables.min.css" rel="stylesheet"/>
    <script src="../include/datatable/datatables.min.js"></script>
</head>
<body style="background: #E4E9F7">
	 <?php include 'include/dbc.inc.php'; ?>
	 
	

	 	  <?php include 'include/side_bar.html'; ?>


     	<?php include 'include/navbar.php'; ?>




     	<div class="home">

      <div class="text">
        <span class="left_second_header">Clerk</span>
        <span class="right_second_header"><i class="fas fa-search"></i> Search</span>
      </div>
      <hr class="text-primary">
      <div class="row content"> 
        <!--  -->
      <div class="col col-12 col-md-12 srch"> 
        <div class="inside_text">
          <!--  -->

           			<?php if(isset($_SESSION['transfer'])){
 				if($_SESSION['transfer'] == 1)
 					echo "<h3 class='text-success'>Transfered to Doctor </h3>";
				else
					echo "<h3 class='text-danger'>".$_SESSION['transfer']."</h3>";
					unset($_SESSION['transfer']);
			} ?>


		<!-- Enter Search value: <input type="text" name="search_stud" id="search_txt" placeholder="Enter stud ID or Name"> -->
		<!-- <div class="mb-3">
						    <label for="search_emp" class="form-label">Search</label>
						    <input type="text" name="search_stud"  class="form-control form-control-lg" id="search_txt" aria-describedby="emailHelp" placeholder="search by stud ID or Name" style="border: 2px solid #87CEFA;">	 
  						</div> -->
		<?php $sqlt = "select * from patient";
			$rest = mysqli_query($conn, $sqlt);
			$resCht = mysqli_num_rows($rest); ?>
		<table class="table table-bordered table-hover" id="table1">
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
				if($resCht > 0){
					$i = 1;
					while ($rowt = mysqli_fetch_assoc($rest)) {
				 ?>
				<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rowt['student_id']; ?></td>
				<td><?php echo $rowt['fname']; ?></td>
				<td><?php echo $rowt['mname']; ?></td>
				<td><?php echo $rowt['dept']; ?></td>
				<td><?php echo $rowt['registered_date']; ?></td>
				<td><a href="../Clerk/php/transfer_to_doctor.php?id=<?php echo $rowt['student_id']; ?>"><button class="btn btn-primary">Send</button></a></td>
				</tr>
			<?php $i++;
			}
		} ?>
			</tbody>

		</table>

<script type="text/javascript">
$(document).ready(function (){
	$("#table1").DataTable({});
	//alert("wow its working");
	// $("#search_txt").keyup(function(){
	// 	var search = $(this).val().trim();
	// 	//alert(search);
	// 	$.ajax({
	// 		url:'php/search_value.php',
	// 		method:'post',
	// 		data:{action:search},
	// 		success:function(response){
	// 		$("#table1").html(response);
	// 			//alert("its working till now");
	// 		}
	// 	});
	// });
});

</script>





          <!--  -->
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

</body>
</html>