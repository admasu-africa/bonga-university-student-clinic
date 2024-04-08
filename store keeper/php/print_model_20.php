<?php 
	include '../include/dbc.inc.php';
	if(isset($_POST['value'])){
		$date = $_POST['value'];
		//$sql = "SELECT * FROM drug_store INNER JOIN supplier ON drug_store.supplier_id = supplier.supplier_id WHERE drug_store.registered_date = '$date'";
		$sql = "SELECT emp.fname, prr.requested_date, ds.drug_name, prr.requested_quantity, ds.measure, ds.batch_no, ds.expire_date FROM provide_request as prr INNER JOIN drug_store as ds ON ds.drug_id = prr.drug_id inner join employee as emp on (emp.employee_id = prr.comfirmed_by )  where prr.requested_date = '$date'";

		$res = mysqli_query($conn, $sql);
		$resCheck = mysqli_num_rows($res);
		if($resCheck > 0){
			$i = 1;
			$output = '';
			$row = mysqli_fetch_array($res);
			$comfirmed = $row['fname'];
			// $requested = $row['fname'];
			$output .= " <div class='display_page' id='display_page'>
				<table class='table table-bordered table-striped table-hover'>
					<thead>
						<tr>
							<td colspan='5'>Requested Date: <u>". $date."</u> </td>
						</tr>
						<tr>
							<td colspan='5'>Comfirmed by: <u>". $comfirmed."</u> </td>
						</tr>
						
						<tr>
							<th>#</th>
							<th>Drug Name</th>
							<th>Quantity</th>
							<th>Batch Number</th>
							<th>Expire Date</th>
						</tr>
					</thead>
					<tbody>";
					$output .= "<tr>
							<td>".  $i."</td>
							<td>".  $row['drug_name']."</td>
							<td>".  $row['requested_quantity']." ".$row['measure']."</td>
							<td>".  $row['batch_no'] ."</td>
							<td>".  $row['expire_date'] ."</td>
						</tr>";
						$i += 1;

						while ($row = mysqli_fetch_assoc($res)) {
				$output .= "<tr>
							<td>".  $i."</td>
							<td>".  $row['drug_name']."</td>
							<td>".  $row['requested_quantity']." ".$row['measure']."</td>
							<td>".  $row['batch_no'] ."</td>
							<td>".  $row['expire_date'] ."</td>
						</tr>";
						$i++;
					}
					$output .= "</tbody>
							     </table>
							     </div>
								<button class='btn btn-success' id='print' onclick='printContent(\"display_drug\");'>Print</button>";
				     echo $output;

				}else
					echo 1;
		}
	
 ?>
