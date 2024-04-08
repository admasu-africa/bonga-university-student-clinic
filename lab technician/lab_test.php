<?php
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Lab technician"){
  header("location:../index.php");
}
 include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Lab technician | Dashbord</title>
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
        <span class="left_second_header">Lab Technician</span>
        <span class="right_second_header"><i class="fas fa-"></i> Order</span>
      </div>
      <hr class="text-primary">
      <div class="row content"> 
        <!--  -->
      <div class="col col-12 col-md-12">     
        <div class="inside_text">
         <div id="display_lab_msg">
         	
         </div>
         <?php 

		 $id = $_GET['id'];
		 //$conn = mysqli_connect("localhost", "root", "", "BUC");
		 $sql2 = "SELECT * from patient inner join patient_info on patient.student_id = patient_info.student_id where patient_info.student_id = '$id' and patient_info.status = 2 limit 1";

		 $res = mysqli_query($conn, $sql2);
		 $resCheck = mysqli_num_rows($res);
		 $arr = array();
		 $x = 0;
		 if($resCheck > 0){
		 	echo "<form action='' method='post'>";
		 	while ($row = mysqli_fetch_assoc($res)){
		 		$fname = $row['fname'];
		 		$mname = $row['mname'];

		 		 ?>
		 		 <table class="table">
		 		 		<thead>
		 		 			<tr>
		 		 				<th>First Name</th>
		 		 				<th>Middle Name</th>
		 		 				<th>Lab Request</th>
		 		 			</tr>
		 		 		</thead>
		 		 		<tbody>
		 		 			<tr>
		 		 				<td><?php echo $fname; ?></td>
		 		 				<td><?php echo $mname; ?></td>
		 		 				<td><?php echo $row['lab_test']; ?></td>
		 		 			</tr>
		 		 		</tbody>
		 		 </table>
		 		 <?php
		 		 $mark = explode(",", $row['lab_test']);
		 		foreach ($mark as $value) {
		 			//echo $value.":";
		 			if($value == "Urine_HG"){
		 				?>
		 				<div class="mb-3">
		 				<select name="lab_result[]" class="form-select sending_lab_result" required>
		 					<option value="">Please select Urine HG result</option>
		 					<option value="+ve">+ve</option>
		 					<option value="-ve">-ve</option>
		 				</select>
		 				</div>
		 				<?php
		 				$arr[$x] = $value;
		 			 $x = $x + 1;
		 			}
		 			else if($value == "TB")	{
		 				?>
		 			<div class="mb-3">
		 				<select name="lab_result[]" class="form-select sending_lab_result"  required>
		 					<option value="">Please select TB result</option>
		 					<option value="+ve">+ve</option>
		 					<option value="-ve">-ve</option>
		 				</select>
		 			</div>
		 				<?php
		 				$arr[$x] = $value;
		 			 $x = $x + 1;
		 			}
		 			else if($value == "HIV"){
						?>
					<div class="mb-3">
		 				<select name="lab_result[]" class="form-select sending_lab_result" required>
		 					<option value="">Please select HIV result</option>
		 					<option value="+ve">+ve</option>
		 					<option value="-ve">-ve</option>
		 				</select>
		 			<div>
		 				<?php
		 				$arr[$x] = $value;
		 			 $x = $x + 1;
		 			}
		 			else if($value == "SE"){
		 				?>
		 			<div class="mb-3">
		 				<select name="lab_result[]" class="form-select sending_lab_result"  required>
		 					<option value="">Please select SE result</option>
		 					<option value="Amoeba">Amoeba</option>
		 					<option value="gardia">Gardia</option>
		 					<option value="Bacteria">Bacteria</option>
		 				</select>
		 			</div>
		 				<?php
		 				$arr[$x] = $value;
		 			 $x = $x + 1;
		 			}
		 			else if($value == "Microscopy")	{
		 				?>
		 			<div class="mb-3">
		 				<label class="form-label" for="microscopy_id">Microscopy: </label> <input class="form-control" type="text" class="sending_lab_result" pattern="[0-9]*-[0-9]*" placeholder="enter microscopy result 0 - 5 " name="lab_result[]" id="microscopy_id" required>
		 			</div>
		 				<?php
		 				$arr[$x] = $value;
		 			 $x = $x + 1;
		 			}
		 			else if($value == "BF"){
						?>
					<div class="mb-3">
						<label class="form-label" for="bf_id">BF: </label>
		 				<select name="lab_result[]" class="form-select sending_lab_result" id="bf_id" required>
		 					<option value="">Please select BF result</option>
		 					<option value="+ve">+ve</option>
		 					<option value="-ve">-ve</option>
		 				</select>
		 			</div>
		 				<?php
		 				$arr[$x] = $value;
		 			 $x = $x + 1;
		 			}
		 	}
		}
			echo "<br><input class='btn btn-success' type='submit' name='Send_result' value='submit' id='Send_result'>";
		 	echo "</form>";
	}

		 
	

			if(isset($_POST['Send_result'])){
				$y = 0;
				$str = "";
				// foreach ($_POST['lab_result'] as $value) {
				// 	if($value == "")
				// 		return;
				// }
				foreach ($_POST['lab_result'] as $value) {
					//echo $arr[$y].": $value <br>";
					$str = $str.$arr[$y].": ".$value.", ";
					$y++;
				}
				//echo $str;
				$sql2 = "UPDATE patient_info set lab_result = '$str', status = 3 where student_id = '$id' AND status = 2";
				if(mysqli_query($conn, $sql2)){
					echo "<script>location.href='order.php'</script>";
				}else
					echo "Error: ".mysqli_error($conn);
			   }

		 ?>
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
      	$("#Send_result").click(function(){

      	});
      })
    </script>
</body>
</html>

</body>
</html>