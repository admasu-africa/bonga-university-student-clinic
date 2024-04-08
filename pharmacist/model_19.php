<?php 
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Pharmacist"){
  header("location:../index.php");
}
include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pharmacist | Model 19</title>
	<script type="text/javascript">
		function printContent(){
			var restorePage = document.body.innerHTML;
			var printcontent = document.getElementById('display_page').innerHTML;
			 document.body.innerHTML = printcontent;
			 window.print();
			 document.body.innerHTML = restorePage; 
		}
	</script>
</head>
<body>
		<?php include "include/header.php"; 
		include "include/dbc.inc.php";?>

	<div class="column" style="border: 2px solid blue; ">

		<h1>Select the model below</h1>
		<div>
			<a href="model_19.php"><button class="btn btn-primary">Model 19</button></a>
			<a href="model_20.php"><button class="btn btn-primary">Model 20</button></a>

		</div>

		<h1>You can print model 19, search by registerd date</h1>

		<div>
			
				<label>Search by Registered Date:  </label><input class="m-2 date" id="date" type="date" name="search_by_date" placeholder="search by date">
				<code id="date_error" style="display: none;"></code>
				<!-- <label>Supplier: </label><input id="supplier" type="text" name="search_by_supplier" placeholder="search by Supplier"> -->
				<!-- <input type="submit" class="btn btn-primary" id="search" name="search_value" value="Search"> -->
				<button class="btn btn-primary" id="search">Search</button>

				<div class="display_drug" id="display_drug">
					<?php 
					$sql = "SELECT Distinct registered_date from drug_store order by registered_date desc";
					$res = mysqli_query($conn, $sql);
					$resCheck = mysqli_num_rows($res);
					if($resCheck > 0){
						?>
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>Registered Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
						<?php
						$i = 1;
						while($row = mysqli_fetch_assoc($res)){
							?>
									<tr>
										<td><?php echo $i ; ?></td>
										<td><?php echo $row['registered_date'] ; ?></td>
										<td>
											<button class="btn btn-success set_btn" value="<?php echo $row['registered_date']; ?>">View</button>
										</td>
									</tr>
								
							<?php
							$i++;
						}
						?>
						</tbody>
					</table>
						<?php
					}else
						echo "<div class='alert alert-info'>Store is empty</div>";
				   ?>

				</div>

			
		</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$("#search").click(function(){
			var date_val = document.getElementById('date');
			var date = $(".date").val();
			if(!validateDate(date)){
				date_val.focus();
			}
			else{
				$.ajax({
					url: 'php/print_model_19.php',
					method: 'post',
					data: {value:date},
					success:function(response){
						if(response == 1)
							$(".display_drug").html("<div class='alert alert-danger'>No Drug Registered on: "+date+" </div>");
						else
						$(".display_drug").html(response);
					}
				});
			}			
		});	
		$(".set_btn").click(function(){
			var date = $(this).val();
			$.ajax({
					url: 'php/print_model_19.php',
					method: 'post',
					data: {value:date},
					success:function(response){
						if(response == 1)
							$(".display_drug").html("<div class='alert alert-danger'>No Drug Registered on: "+date+" </div>");
						else
						$(".display_drug").html(response);
					}
				});
		});	
	});
	function validateDate(date){
		var error = document.getElementById('date_error');
		var error_msg = document.getElementById('display_drug');
		if(date == ""){			
			error_msg.innerHTML = "<div class='alert alert-danger'>Please Enter Date to Search </div>";
			return false;
		}
		if(new Date(date) > new Date()){
			error_msg.innerHTML = "<div class='alert alert-danger'>Please Correct Your Date, You Entered future date</div>";
			return false;
		}
		error.style.display = 'none';
		return true;
	}
</script>
</body>
</html>