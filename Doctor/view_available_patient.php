<?php
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Doctor"){
  header("location:../index.php");
}
 include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Doctor | View Info</title>
	<link rel="stylesheet" type="text/css" href="include/style.css">
	<link rel="stylesheet" type="text/css" href="../include/bootstrap/css/bootstrap.css">
    <script src="../include/bootstrap/js/bootstrap.js"></script>
    <script src="../include/jquery/jquery-3.6.2.js"></script>
     <link rel="stylesheet" type="text/css" href="../include/fontawesome/css/all.css">
</head>
<body style="background: #E4E9F7">
	<?php include 'include/side_bar.php'; ?>


     <?php include 'include/navbar.php'; ?>

       <div class="home">

      <div class="text">
        <span class="left_second_header">Doctor</span>
        <span class="right_second_header"><i class="fas fa-"></i>Need Treat</span>
      </div>
      <hr class="text-primary">
      <div class="row content"> 
        <!--  -->
	      <div class="col col-12 col-md-12">     
	         <div>
	         	<div class="display_va_patient" id="display_va_patient">
			
		</div>
			<?php  
			//echo "This is doctor dad"
			if(isset($_SESSION['sent_to_doctor'])){
				echo "<div class='alert alert-success'>".$_SESSION['sent_to_doctor']."</div>";;
				unset($_SESSION['sent_to_doctor']);
			}
			include 'include/dbc.inc.php';
			$sql = "select student_id, fname, mname from patient where status = 1 ";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);
		 if($resultCheck > 0){
		 	?>
		 	<table class="table" id="infotable">
		 		<thead>
		 			<tr>
		 				<th>#</th>
		 				<th>ID</th>
		 				<th>Student Name</th>
		 				<th>Last Name</th>
		 				<th>Action</th>
		 			</tr>
		 		</thead>
		 		<tbody>

		 	<?php
		 	$i = 1;
		 	while ($row = mysqli_fetch_assoc($result)) {
		 		?>
		 		<tr>
		 			<td><?php echo $i; ?></td>
		 			<td><?php echo $row['student_id']; ?></td>
		 			<td><?php echo $row['fname']; ?></td>
		 			<td><?php echo $row['mname']; ?></td>
		 			<td><a href="opd.php?id=<?php echo $row['student_id']; ?>"><button class="btn btn-success treat">Treate</button></a>		
					<button class='btn btn-danger remove' id="remove_patient" onclick="removePatient('<?php echo  $row['student_id'];  ?>','<?php echo  $row['fname'];  ?>')">Remove</button></td>
		 		</tr>
		 		<?php
		 		$i++;
		 	}	
				?>
				</tbody>
		 	</table>
			<?php
		 }
			else
			echo "<div class='alert alert-info'>No waiting Patient in OPD</div>";
			
		?>
	         </div>
	      </div> 

    </div>
  
    <hr class="text-">

        <?php //include 'include/footer.html'; ?>
  
    </div> 


    <script src="js/script.js"></script>
       <script type="text/javascript">
       	function removePatient(id,name){
		if(confirm('Are You Sure to remove the given patient from OPD?')){
		if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			xmlhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				if (this.responseText == 1)	{	
					$("#display_va_patient").html("<div class='alert alert-success'><strong>"+name+"</strong>: Removed from OPD</div>");		
					refresh();
				}
				else
					$("#display_va_patient").html("<div class='alert alert-danger'>"+this.responseText+"</div>");
			
		}
	};
		xmlhttp.open('GET','php/remove_patient.php?action=remove_from_OPD&student_id='+id,true);
	 	xmlhttp.send();	
	}	
}
function refresh(){
	if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			xmlhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
					$("#infotable").html(xmlhttp.responseText);			
		}
	};
		xmlhttp.open('GET','php/remove_patient.php?action=refresh',true);
	 	xmlhttp.send();	
}
      var subMenu = document.getElementById('subMenu');

      function toggleMenu(){
        subMenu.classList.toggle('open-menu');
      }

setTimeout("location.reload(true);", 5000);

    </script>


</body>
</html>