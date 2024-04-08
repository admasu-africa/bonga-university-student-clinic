<?php 
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Manager"){
  header("location:../index.php");
}
include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Manager | Approve Request</title>
	<link rel="stylesheet" type="text/css" href="include/style.css">
	<link rel="stylesheet" type="text/css" href="../include/bootstrap/css/bootstrap.css">
    <script src="../include/bootstrap/js/bootstrap.js"></script>
    <script src="../include/jquery/jquery-3.6.2.js"></script>
     <link rel="stylesheet" type="text/css" href="../include/fontawesome/css/all.css">

</head>
<body>


	<?php include "include/dbc.inc.php"; ?>
		<?php include 'include/side_bar.php'; ?>


     <?php include 'include/navbar.php'; ?>

     <div class="home">

      <div class="text">
        <span class="left_second_header">Manager</span>
        <span class="right_second_header"><i class="fas fa-"></i>Approve Request</span>
      </div>
      <hr class="text-primary">
      <div class="row content"> 
        <!--  -->
	      <div class="col col-12 col-md-12">     
	         <div class="inside_text">
	         	<div class="display_msg_mr" id="display_msg_appr">
			
		</div>
		<div class="container-fluid" id="success">	
		<?php 

		$sql = "SELECT ds.drug_name, prr.requested_quantity, ds.quantity, ds.measure, ds.expire_date, ds.drug_id, prr.request_id from provide_request as prr inner join drug_store as ds on ds.drug_id = prr.drug_id where  prr.status = 2";
		$res = mysqli_query($conn, $sql);
		$resCheck = mysqli_num_rows($res);
		if($resCheck > 0){
			$i = 1;
			 ?>
		<table class="table" id="mtable">
			<thead>
				<tr>
					<th>#</th>
					<th>Drug Name</th>
					<th>Requested Quantity</th>
					<th>Available Quantity</th>
					<th>Expire Date</th>
					<th>Drug ID</th>
					<th>Request ID</th>
				</tr>
			</thead>
		<tbody>
		<?php					
			while ($row = mysqli_fetch_assoc($res)) {
				echo "<tr class='edit_table' id='row".$i."'>";
				//echo "<td><input type='checkbox' class='checkItem' name='id[]' value='".$row['request_id']."'></td>";
				echo "<td>".$i."</td>";
				echo "<td>".$row['drug_name']."</td>";
				echo "<td class='requested_amount'>".$row['requested_quantity']." </td>";
				echo "<td>".$row['quantity']." ".$row['measure']."</td>";
				echo "<td>".$row['expire_date']." </td>";
				echo "<td class='store_drug_id'>".$row['drug_id']." </td>";
				echo "<td class='requested_drug_id'>".$row['request_id']." </td>";
				echo "</tr>";
				$i++;
			}

			echo "</tbody></table>
			<button class='btn btn-success' id='approve_request' style='text-align: left;'>Approve Request</button>";
		}else{
		?>
			<div class="alert alert-info">
				No Request for Approval
			</div> 
			<?php
		}
		?>
	         </div>
	      </div> 

    </div>

    <!-- <hr class="text-"> -->

        <?php //include 'include/footer.html'; ?>
  
    </div> 


  <script src="js/approve_request.js"></script>
    <script src="js/script.js"></script>

       <script type="text/javascript">
      var subMenu = document.getElementById('subMenu');

      function toggleMenu(){
        subMenu.classList.toggle('open-menu');
      }


</script>


</body>
</html>