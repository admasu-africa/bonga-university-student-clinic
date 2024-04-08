<?php 
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Pharmacist"){
  header("location:../index.php");
}
include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Pharmacist | Prescription</title>
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
        <span class="left_second_header">Pharmacist</span>
        <span class="right_second_header"><i class="fas fa-"></i>Order</span>
      </div>
      <hr class="text-primary">
      <div class="row content"> 
        <!--  -->
	      <div class="col col-12 col-md-12">     
	         <div>
		<div id="display_pr_error_msg">
			
		</div>
		<?php 

		 $id = $_GET['id'];
		 $fname = $_GET['fname'];
		 $lname = $_GET['mname'];

		 ?>
		 <table class="table table-bordered table-hover">
		 		<thead>
		 					<tr>
		 						<th>ID</th>
		 						<th>Name</th>
		 						<th>Middle Name</th>
		 					</tr>
		 				</thead>
		 				<tbody>
		 					<td><?php echo $id; ?></td>
		 						<td><?php echo $fname; ?></td>
		 						<td><?php echo $lname; ?></td>
		 				</tbody>
		 </table>
		 <?php

		  $conn = mysqli_connect("localhost", "root", "", "BUC");

		  $sql = "SELECT pr.drug_id, pr.drug_name, pr.dose, pr.description, pai.patient_info_id FROM prescription as pr INNER JOIN patient_info as pai on pr.patient_info_id = pai.patient_info_id WHERE pai.student_id = '$id' and pai.status = 4;";

		  $result = mysqli_query($conn, $sql);
		 
		  if ($result == true) {	 
		  $resultCheck = mysqli_num_rows($result);
		  if ($resultCheck > 0) {
		  	?> 

		  	<table class="table">
		  			<tr>
		  				<th>#</th>
		  				<th>Drug Name</th>
		  				<th>Amount</th>
		  				<th>Description</th>
		  				<th>Availability</th>
		  				<th>Remark</th>
		  			</tr>
		  	<?php
		  	$nameArray = array();
		  	$amountArray = array();
		  	$x1 = $x2 = $X3  = 0;
		  	$i = 1;
		  	while ($rows = mysqli_fetch_assoc($result)){
		  		$paii = $rows['patient_info_id'];

		  		$drug_id = $rows['drug_id'];
		  		$dname = $rows['drug_name'];
		  		$damount = $rows['dose'];
		  		$description = $rows['description'];
		  		$check = checkingAmount($drug_id, $dname, $damount);
		  		
		  		?>
		  		
		  		<!-- <input type="checkbox" name="prescription[]" value="<?php //echo $dname.$damount; ?>"><br> -->
		  		<input type="hidden" class="drug_id" value="<?php echo $drug_id; ?>">
		  		<tr>
		  			<td><?php echo $i; ?></td>
		  			<td><input type="text" class="drug_name" value="<?php echo $dname; ?>" disabled></td>
		  			<td><input type="text" class="dose" value="<?php echo $damount;?>" disabled></td>
		  			<td><textarea class="description" disabled><?php echo $description; ?></textarea></td>
		  			<?php if($check == 0){
		  				?>
		  				<td><span></span>Not Avalilable drug</td>
		  				<td><input type="hidden" class="remark" value="0"></td>
		  				<?php
		  			}else if ($check == 1) {
		  			?>
		  				<td><span>Available</span></td>
		  				<td><input type="hidden" class="remark" value="1"></td>
		  				<?php
		  		}else if($check == 2){
		  			$conn = mysqli_connect("localhost", "root", "", "BUC");
					$sql = "SELECT ph.quantity from pharmacy as ph where ph.drug_id = '$drug_id'";
					$res = mysqli_query($conn,$sql);
					//$resCheck = mysqli_num_rows($res);
					$row = mysqli_fetch_assoc($res);
					$available = $row['quantity'];
		  		?>
		  			<td><span>only <?php echo $available; ?> in pharmacy</span></td>
		  			<td><input type="checkbox" class="remark" value="2"> Give <?php echo $available; ?></td>
		  			<?php
		  		}else{
		  			?>
		  			<td><span>Unknown</span></td>
		  			<td><input type="checkbox" class="remark" value="3"></td>
		  			<?php
		  		} 
		  			?>

		  		</tr>
		  		
		  		<?php  	
		  		$x1++;
		  		$i++;
		  	 }

		  	?>
		  	</table>
		  	<button class="btn btn-success" type="button" id="give_drug">Submit</button>
		  	<input type="hidden" id="paii" value="<?php echo $paii; ?>">
		  	<input type="hidden" id="student_id" value="<?php echo $id; ?>">
		  	<!-- <input type="submit" class="submit" value="Submit" id="give_drug"> -->
		  		<!-- </form> -->
		  	<?php	
		  }else echo "0 Result";

		}else echo "Error ".mysqli_error($conn);
		

		function checkingAmount($drug_id,$name,$value){
			if($drug_id == null)
				return 0;
			else{
			$conn = mysqli_connect("localhost", "root", "", "BUC");
			$sql = "SELECT ph.quantity from pharmacy as ph where ph.drug_id = '$drug_id' AND quantity > 0";
			$res = mysqli_query($conn,$sql);
			$resCheck = mysqli_num_rows($res);
			if($resCheck > 0){
			while ($row = mysqli_fetch_assoc($res)) {
				$am = $row['quantity'];

				if($am >= $value ){
					return 1;
				}else{
					return 2;
				}
			}
		 }else{
		 	return 3;
		 }
	  }
	}
		?>
	         </div>
	      </div> 

    </div>

    

        <?php //include 'include/footer.html'; ?>
  
    </div>

     <script src="js/script.js"></script> 
     <script src="js/give_drug.js"></script>

<script type="text/javascript">
	var subMenu = document.getElementById('subMenu');

      function toggleMenu(){
        subMenu.classList.toggle('open-menu');
      }
</script>

</body>
</html>