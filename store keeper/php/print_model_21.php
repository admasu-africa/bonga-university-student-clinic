<?php 
	include '../include/dbc.inc.php';
	if(isset($_POST['value'])){
		$date = $_POST['value'];
		//$sql = "SELECT ds.drug_name, ph.quantity, ph.measure, ph.provided_by, ph.comfirmed_by, ds.expire_date FROM pharmacy as ph INNER JOIN drug_store as ds ON ds.drug_id = ph.drug_id WHERE ph.registered_date = '$date'";
		//$sql = "SELECT emp.fname, ds.drug_name, ph.quantity, ph.measure, ph.provided_by, ph.comfirmed_by, ds.expire_date FROM pharmacy as ph JOIN drug_store as ds ON ds.drug_id = ph.drug_id JOIN employee as emp on emp.employee_id = ph.provided_by OR emp.employee_id = ph.comfirmed_by WHERE ph.registered_date = '$date';";
		$sql = "SELECT ph.quantity, ph.measure, ph.registered_date, ph.provided_by, ph.comfirmed_by, ds.drug_name, ds.expire_date FROM pharmacy as ph INNER JOIN drug_store as ds ON ph.drug_id = ds.drug_id WHERE ph.registered_date = '$date'";



/////// you stoped here and how to join more than tables ////////////////////////////

		$res = mysqli_query($conn, $sql);
		$resCheck = mysqli_num_rows($res);
		if($resCheck > 0){
			$i = 1;
			$output = '';
			$row = mysqli_fetch_array($res);
			$store_keeper = $row['provided_by'];
			$pharmacist = $row['comfirmed_by'];
			$output .= " <div class='display_page' id='display_page'>
				<table class='table'>
					<thead>
						<tr>
							<td colspan='3'>Registered Date: <u>". $date." </u></td>
						</tr>
						<tr>
							<td colspan='3'>Provided By: <u>".$store_keeper."</u> </td>
						</tr>
						<tr>
							<td colspan='3'>Registered By: <u>".$pharmacist."</u> </td>
						</tr>
						<tr>
							<th>#</th>
							<th>Drug Name</th>
							<th>Quantity</th>						
							<th>Expire Date</th>
						</tr>
					</thead>
					<tbody>";
					$output .= "<tr>
							<td>".$i."</td>
							<td>".$row['drug_name']."</td>
							<td>".$row['quantity']." ".$row['measure']."</td>
							<td>".$row['expire_date'] ."</td>
						</tr>";
						$i += 1;

						while ($row = mysqli_fetch_assoc($res)) {
				$output .= "<tr>
							<td>".$i."</td>
							<td>".$row['drug_name']."</td>
							<td>".$row['quantity']." ".$row['measure']."</td>
							<td>".$row['expire_date'] ."</td>
						</tr>";
						$i++;
					}
					$output .= "</tbody>
						     </table>
						     </div>
						     <button class='btn btn-success' id='print' onclick='printContent();'>Print</button>";
							     echo $output;

				}else
					echo 1;
		}
	
 ?>

