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
	<title>Pharmacist | Model 22</title>
	<link rel="stylesheet" type="text/css" href="include/style.css">
	<link rel="stylesheet" type="text/css" href="../include/bootstrap/css/bootstrap.css">
    <script src="../include/bootstrap/js/bootstrap.js"></script>
    <script src="../include/jquery/jquery-3.6.2.js"></script>
     <link rel="stylesheet" type="text/css" href="../include/fontawesome/css/all.css">
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

	<?php include 'include/side_bar.php';
       include 'include/navbar.php'; ?>

       <div class="home">

      <div class="text">
        <span class="left_second_header">Pharmacist</span>
        <span class="right_second_header"><i class="fas fa-"></i> Print Model</span>
      </div>
      <hr class="text-primary">
      <div class="row content"> 
        <!--  -->
	      <div class="col col-12 col-md-12">     
	         <div>
				<div>
			<h2 style="font-size: 20px;">Search By Registered Date To print Model 22</h2>
				<label style="font-size: 20px;">Enter Registered Date:  </label><input class="form-control m-2 date" id="date" type="date" name="search_by_date" placeholder="search by date">
				<code id="date_error" style="display: none;"></code>
				<!-- <label>Supplier: </label><input id="supplier" type="text" name="search_by_supplier" placeholder="search by Supplier"> -->
				<!-- <input type="submit" class="btn btn-primary" id="search" name="search_value" value="Search"> -->
				<button class="btn btn-primary mb-2" id="search">Search</button>

				<div class="display_drug" id="display_drug">
		<?php
		$today = date("Y-m-d");
		//$sql = "SELECT ds.drug_name, ph.quantity, ph.measure, ds.expire_date, ph.registered_date from pharmacy as ph INNER JOIN drug_store as ds on ph.drug_id = ds.drug_id";
		$sql = "SELECT Distinct registered_date from provide_request where registered_date != '' order by registered_date desc ";
		$res = mysqli_query($conn,$sql);
		$resCheck = mysqli_num_rows($res);
		if($resCheck > 0){
			?>
			<table class="table table-bordered table-hover" id="ssdtable">
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
			while ($row = mysqli_fetch_assoc($res)) {
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
				
			</div>
			<!-- <button class="btn btn-success" id="print" onclick="printContent('display_drug')">Print</button> -->
			<?php
		}else{
				?>
			<div class="alert alert-info">
				No Registered Drug in Dispensary
			</div> 
			<?php
		}
		?>
			
				</div>
	         </div>
	      </div> 

    </div>

    

    <hr class="text-">

        <?php //include 'include/footer.html'; ?>
  
    </div>
<script src="js/register_drug.js"></script>	
 <script src="js/script.js"></script> 

<script type="text/javascript">
	var subMenu = document.getElementById('subMenu');

      function toggleMenu(){
        subMenu.classList.toggle('open-menu');
      }
</script>

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
					url: 'php/print_model_22.php',
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
					url: 'php/print_model_22.php',
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
			error_msg.innerHTML = "<div class='alert alert-danger'>Please Correct Your Date</div>";
			return false;
		}
		error.style.display = 'none';
		return true;
	}
</script>

</body>
</html>