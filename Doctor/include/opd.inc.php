<form action="" method="post">
					History: <br><textarea name="history" rows="10" cols="40"></textarea> <br>
					<input type="submit" name="labtest" value="labtest need?"><br>					
					Lab test:<br>
					<input type="checkbox" name="labtest[]" value="Urine">Urine
					<input type="checkbox" name="labtest[]" value="Saliva">Saliva
					<input type="checkbox" name="labtest[]" value="Blood">Blood<br>
					<input type="checkbox" name="labtest[]" value="Faeces">Faeces<br>
					<input type="submit" name="prescribe" value="Prescribe?"><br>
					Write Prescription:<br>
					<textarea cols="40" rows="10"></textarea><br>
					<input type="submit" name="finish" value="Finish"><br>
					</form>
					<?php 
					// exit();
					if (isset($_POST['finish'])) {					
						
						if(isset($_POST['labtest']) && $history != "" ){
						$history = $_POST['history'];
						$chkbx = $_POST['labtest'];
						$chk = "";
						foreach ($chkbx as $value) {
							$chk = $chk.$value.",";
						}
						
						$sql2 = "update patient_info set history = '$history' where id = '$pid' and visited_date = '$date'";
						if(mysqli_query($conn, $sql2)){
							echo "Updated successfully";
						}
						else
							echo "Some errors";				
					}							
					else
						echo "Empty";
				 }