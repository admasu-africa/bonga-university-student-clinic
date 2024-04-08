<?php
	if(isset($_GET['action']) && $_GET['action'] == 'refresh'){
		//echo " Refresh is called";
		include "../include/dbc.inc.php";
		$i = 1;
		$sql = "SELECT ds.drug_name, prr.requested_quantity, ds.quantity, ds.measure, ds.expire_date, ds.drug_id, prr.request_id from provide_request as prr inner join drug_store as ds on ds.drug_id = prr.drug_id where  prr.status = 1";
		$res = mysqli_query($conn,$sql);
		if($res){
		$resCheck = mysqli_num_rows($res);
		if($resCheck > 0){
			while ($row = mysqli_fetch_assoc($res)) {
				echo "<tr class='edit_table' id='row".$i."'>";
				echo "<td>".$i."</td>";
				echo "<td>".$row['drug_name']."</td>";
				echo "<td>".$row['requested_quantity']." </td>";
				echo "<td>".$row['amount']." ".$row['measure']."</td>";
				echo "<td>".$row['expire_date']." </td>";
				echo "<td class='requested_drug_id'>".$row['request_id']." </td>";
				echo "<td><a href='php/edit_request.php?id=".$row['request_id']."&name=".$row['drug_name']."&amount=".$row['amount']."&measure=".$row['measure']."&required=".$row['requested_quantity']."&expire_date=".$row['expire_date']."'><button class='btn btn-primary'>Edit</button></a>
					<button onclick='deleteRequest(".$row['request_id'].");' class='btn btn-danger delete'>Delete</button>
					</td>";
				echo "</tr>";
				$i++;
			}
		}else
			?>
			<div class="alert alert-info">
				No Request Is Provided to store
			</div> 
			<?php
	}else
		echo "Error: ".mysqli_error($conn);
}