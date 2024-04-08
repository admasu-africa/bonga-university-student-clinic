<?php 
	$output = '';
	include '../include/dbc.inc.php';
	$today = date("Y-m-d");
	if(isset($_POST['action'])){
		$search = $_POST['action'];
		if($search == "")
			$sql = "SELECT ds.drug_name, ph.quantity, ds.expire_date, ph.measure, ph.drug_id from pharmacy as ph INNER JOIN drug_store as ds ON ph.drug_id = ds.drug_id AND ds.expire_date > '$today'";
		else
			$sql = "SELECT drug_store.drug_name, pharmacy.quantity, pharmacy.measure, drug_store.expire_date, drug_store.drug_id from pharmacy INNER JOIN drug_store ON pharmacy.drug_id = drug_store.drug_id WHERE drug_store.expire_date > '$today' AND drug_name like '%$search%'";
		//$sql = "SELECT * FROM pharmacy WHERE drug_name like '%$search%' AND expire_date > '$today'";
		
	
	 	$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		$output = "";
		if($resultCheck > 0){
			$i = 1;
			$output .= "
				<thead>
					<tr>
						<th>#</th>
						<th>Drug Name</th>
						<th>Available Quantity</th>
						<th>Expire Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>";
			while($row = mysqli_fetch_assoc($result)){
				$output .= "
				<tr>
					<td>".$i."</td>
					<td>".$row['drug_name']."</td>
					<td>".$row['quantity']." ".$row['measure']."</td>
					<td>".$row['expire_date']."</td>
					<td> <button class='btn btn-success drug_details1' value='". $row['drug_id']."'>Ditails</button>  </td>
				</tr>";
				$i++;
			}	
			$output .= "</tbody>";
			echo $output;
		
		}else
			echo "<div class='alert alert-info'>No drug <strong>".$search." </strong> on Pharmacy</div>";
	}
	if(isset($_POST['expire'])){
		$value = $_POST['expire'];
		if($value == "near_to_expire")	
			$sql = "SELECT ds.drug_name, ph.quantity, ph.measure, ds.expire_date, ds.drug_id from pharmacy as ph INNER JOIN drug_store as ds ON ph.drug_id = ds.drug_id WHERE ds.expire_date - curdate() < 200 AND ds.expire_date > '$today' ";
		else if($value == "expired")		
			$sql = "SELECT ds.drug_name, ph.quantity, ph.measure, ds.expire_date, ds.drug_id from pharmacy as ph INNER JOIN drug_store as ds ON ph.drug_id = ds.drug_id WHERE ds.expire_date < '$today' "; 
		else if($value == "out_of_pharmacy")
			$sql = "SELECT ds.drug_name, ph.quantity, ph.measure, ds.expire_date, ds.drug_id from pharmacy as ph INNER JOIN drug_store as ds ON ph.drug_id = ds.drug_id WHERE ds.expire_date > '$today' AND ph.quantity = 0 "; 
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		$output = "";
		if($resultCheck > 0){
			$i = 1;
			$output .= "
				<thead>
					<tr>
						<th>#</th>
						<th>Drug Name</th>
						<th>Available Quantity</th>
						<th>Expire Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>";
			while($row = mysqli_fetch_assoc($result)){
				$output .= "
				<tr>
					<td>".$i."</td>
					<td>".$row['drug_name']."</td>
					<td>".$row['quantity']." ".$row['measure']."</td>
					<td>".$row['expire_date']."</td>
					<td> <button class='btn btn-success drug_details1' value='". $row['drug_id']."'>Ditails</button>  </td>
				</tr>";
				$i++;
			}	
			$output .= "</tbody>";
			echo $output;
		
		}else{
			if($value == "near_to_expire")	
				echo "<div class='alert alert-info'><strong> No less than 2 month to expire On Pharmacy </strong></div>";
			if($value == "expired")	
				echo "<div class='alert alert-info'><strong> No Expired Drug On Pharmacy </strong></div>";	
		}
	}
	if(isset($_POST['action1'])){
		$search = $_POST['action1'];
		if($search == "")
			$sql = "SELECT ds.drug_name, ds.quantity, ds.measure, ds.expire_date,ds.drug_id from drug_store as ds where ds.expire_date > '$today'";
		else
			$sql = "SELECT ds.drug_name, ds.quantity, ds.measure, ds.expire_date,ds.drug_id from drug_store as ds where ds.expire_date > '$today' AND drug_name like '%$search%' ";
			//$sql = "SELECT drug_store.drug_name, pharmacy.quantity, pharmacy.measure, drug_store.expire_date from pharmacy INNER JOIN drug_store ON pharmacy.drug_id = drug_store.drug_id WHERE drug_store.expire_date > '$today' AND drug_name like '%$search%' ";
		//$sql = "SELECT * FROM pharmacy WHERE drug_name like '%$search%' AND expire_date > '$today'";
		
	
	 	$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		$output = "";
		if($resultCheck > 0){
			$i = 1;
			$output .= "
				<thead>
					<tr>
						<th>#</th>
						<th>Drug Name</th>
						<th>Available Quantity</th>
						<th>Expire Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>";
			while($row = mysqli_fetch_assoc($result)){
				$output .= "
				<tr>
					<td>".$i."</td>
					<td>".$row['drug_name']."</td>
					<td>".$row['quantity']." ".$row['measure']."</td>
					<td>".$row['expire_date']."</td>
					<td> <button class='btn btn-success drug_details' value='". $row['drug_id']."'>Ditails</button>  </td>
				</tr>";
				$i++;
			}	
			$output .= "</tbody>";
			echo $output;
		
		}else
			echo "<div class='alert alert-info'>No drug <strong>".$search." </strong> on Store</div>";
	}
	if(isset($_POST['expire1'])){

		$value = $_POST['expire1'];
		if($value == "near_to_expire")
			$sql = "SELECT ds.drug_name, ds.quantity, ds.measure, ds.expire_date,ds.drug_id from drug_store as ds where ds.expire_date - curdate() < 200 AND ds.expire_date > '$today'";
		else if($value == "expired")		
			$sql = "SELECT ds.drug_name, ds.quantity, ds.measure, ds.expire_date,ds.drug_id from drug_store as ds where ds.expire_date < '$today'";
		else if($value == "out_of_store")		
			$sql = "SELECT ds.drug_name, ds.quantity, ds.measure, ds.expire_date,ds.drug_id from drug_store as ds where ds.expire_date > '$today' AND ds.quantity = 0";
		//$sql = "SELECT drug_store.drug_name, pharmacy.quantity, pharmacy.measure, drug_store.expire_date from pharmacy INNER JOIN drug_store ON pharmacy.drug_id = drug_store.drug_id WHERE drug_store.expire_date < '$today' ";
		//$sql = "SELECT * FROM pharmacy WHERE expire_date < '$today'";	

		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		$output = "";
		if($resultCheck > 0){
			$i = 1;
			$output .= "
				<thead>
					<tr>
						<th>#</th>
						<th>Drug Name</th>
						<th>Available Quantity</th>
						<th>Expire Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>";
			while($row = mysqli_fetch_assoc($result)){
				$output .= "
				<tr>
					<td>".$i."</td>
					<td>".$row['drug_name']."</td>
					<td>".$row['quantity']." ".$row['measure']."</td>
					<td>".$row['expire_date']."</td>
					<td> <button class='btn btn-success drug_details' value='". $row['drug_id']."'>Ditails</button>  </td>
				</tr>";
				$i++;
			}	
			$output .= "</tbody>";
			echo $output;
		
		}else{
			if($value == "near_to_expire")	
				echo "<div class='alert alert-info'><strong> No less than 2 month to expire On Store </strong></div>";
			if($value == "expired")	
				echo "<div class='alert alert-info'><strong> No Expired Drug On Store </strong></div>";
			if($value == "out_of_store")	
				echo "<div class='alert alert-info'><strong> No Balance 0 drug On Store </strong></div>";
			
		}
	}
 ?>
 <script type="text/javascript">
$(document).ready(function (){
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
$(".drug_details1").click(function(){
		var id = $(this).val();
		$.ajax({
			url:'php/display_drug_detail.php',
			method:'post',
			data:{drug_id:id,pharmacy:""},
			success:function(response){
				$("#display_pdrug_detail").html(response);
				$("#pharmacy_drug_details").modal('show');
			}
		});
		
	});	
	});
 </script>