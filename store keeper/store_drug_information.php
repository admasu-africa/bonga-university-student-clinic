<?php 
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Storekeeper"){
  header("location:../index.php");
}
include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>StoreKeeper | View Store Drug Info</title>
	<link rel="stylesheet" type="text/css" href="include/style.css">
	<link rel="stylesheet" type="text/css" href="../include/bootstrap/css/bootstrap.css">
    <script src="../include/bootstrap/js/bootstrap.js"></script>
    <script src="../include/jquery/jquery-3.6.2.js"></script>
     <link rel="stylesheet" type="text/css" href="../include/fontawesome/css/all.css">
</head>
<script type="text/javascript">
		function printContent(el){
			var restorePage = document.body.innerHTML;
			var printcontent = document.getElementById(el).innerHTML;
			 document.body.innerHTML = printcontent;
			 window.print();
			 document.body.innerHTML = restorePage; 
		}
	</script>
<body>

	<?php include 'include/side_bar.php'; ?>


     <?php include 'include/navbar.php'; ?>

       <div class="home">

      <div class="text">
        <span class="left_second_header">StoreKeeper</span>
        <span class="right_second_header"><i class="fas fa-"></i> Store/ view drug info</span>
      </div>
      <hr class="text-primary">
      <div class="row content" style="cursor: auto;"> 
        <!--  -->
	      <div class="col col-12 col-md-12" style="cursor: auto;">     
	         <div class="mb-3 row">
		<input class="form-control col m-3" type="text" name="search_store_drug" id="search_store_drug" placeholder="Search by Drug Name" style="cursor: auto; font-size: 20px;">
		<!-- <label>View On expire</label> -->
		<select class="form-select col m-3" id="select_expire" style="cursor: auto; font-size: 20px;">
			<option value="" >Please Select what drug you want to see on store</option>
			<option value="near_to_expire">expire soon</option>
			<option value="expired">expired</option>
			<option value="out_of_store">Out of store</option>
		</select>

		<div class="display_drug" id="display_drug">
		<?php
		$today = date("Y-m-d");
		$sql = "SELECT ds.drug_name, ds.quantity, ds.measure, ds.expire_date,ds.drug_id from drug_store as ds where ds.expire_date > '$today' order by quantity asc";
		$res = mysqli_query($conn,$sql);
		$resCheck = mysqli_num_rows($res);
		if($resCheck > 0){
			?>
			<table class="table" id="ssdtable">
				<thead>
					<tr>
						<th>#</th>
						<th>Drug Name</th>
						<th>Available Quantity</th>
						<th>Expire Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>					
			<?php
			$i = 1;
			while ($row = mysqli_fetch_assoc($res)) {
				?>
				<tr>
				<td><?php echo $i; ?></td>
				<td> <?php echo $row['drug_name'] ; ?> </td>
				<td> <?php echo $row['quantity']." ".$row['measure'] ; ?> </td>
				<td> <?php echo $row['expire_date'] ; ?> </td>
				<td> <button class="btn btn-success drug_details" value="<?php echo $row['drug_id'] ; ?>">Ditails</button> </td>
				</tr>
				<?php
				$i++;
			 }
			?>
				</tbody>
			</table>		
			</div>
			<button class="btn btn-success m-10" id="print" onclick="printContent('display_drug')" style="width: 10%; margin: auto;">Print</button>
			<?php
		}else{
				?>
			<div class="alert alert-info">
				No Drug in Store
			</div> 
			<?php
		}
		?>
	         </div>
	      </div> 

    </div>

    

    <hr class="text-">

        <?php //include 'include/footer.html'; ?>
  
    </div>

   <div class="modal fade" id="store_drug_details">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h1>Drug Details</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body" id="display_sdrug_detail">
				
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
	$(document).ready(function (){
	//alert("wow its working");
	$("#search_store_drug").keyup(function(){
		var search = $(this).val().trim();
		//console.log(search);
		$.ajax({
			url:'php/search_drug.php',
			method:'post',
			data:{action1:search},
			success:function(response){
			$("#ssdtable").html(response);
			}
		});
	});

	$("#select_expire").change(function(){
		var value = $(this).val();
		if(value == "")
			$(this).focus();	
		else{
			$.ajax({
			url:'php/search_drug.php',
			method:'post',
			data:{expire1:value},
			success:function(response){
			$("#ssdtable").html(response);
			}
		});
		}		

	});

	$("#expired_store_drug").click(function(){
		//var search = $(this).val().trim();
		//console.log("Its clicked");
		$.ajax({
			url:'php/search_drug.php',
			method:'post',
			data:{expire1:"search"},
			success:function(response){
			$("#ssdtable").html(response);
			}
		});
	});
	$(".drug_details").click(function(){
		var id = $(this).val();
		$.ajax({
			url:'php/display_drug_detail.php',
			method:'post',
			data:{drug_id:id,store:""},
			success:function(response){
				$("#display_sdrug_detail").html(response);
				$("#store_drug_details").modal('show');
			}
		});
		
	});

});
</script>
</body>
</html>