<?php ?>
<?php 
	if(isset($_GET['action']) &&  $_GET['action'] == "addRow")
		createMedicineInfo();
	if(isset($_GET['action']) && $_GET['action']=='medicine_list')
		showMedicineList($_GET['text']);
	if(isset($_GET['action']) && $_GET['action']=='fill')
		fill($_GET['name'], $_GET['column']);
	if(isset($_GET['action']) && $_GET['action']=='insert')
		insert();

	function createMedicineInfo(){
		$row_id = $_GET['row_id'];
		$row_number = $_GET['row_number'];
		?>
		
		<div>
			<table>
				<tbody>
					<tr>
						<td>
						<div>
							<input id="medicine_name_<?php echo $row_number ?>" type="text" name="medicine_name" 
							list="medicine_list_<?php echo $row_number ?>" placeholder="Select Medicine" 
							onkeydown="medicineOption(this.value, 'medicine_list_<?php echo $row_number ?>');"
							onfocus="medicineOption(this.value, 'medicine_list_<?php echo $row_number ?>');"
							onchange="fillfield(this.value, '<?php echo $row_number ?>');">
							<datalist id="medicine_list_<?php echo $row_number; ?>" 
								style="display: none; max-height: 200px; overflow: auto;">
         						 <?php showMedicineList("") ?>
        					</datalist>
						</div>
						</td>
						<td>
							<div>
								<input id="available_qty_<?php echo $row_number ?>" type="text"  disabled><!--I dont know why it is not working -->
							</div>
						</td>
						<td>
							<div>
								<input id="provide_qty_<?php echo $row_number ?>" type="number" value=0 name="provide_qty"><!--I dont know why it is not working -->
							</div>
						</td>
						<td>
							<div>
								<input id="expire_date_<?php echo $row_number ?>" type="text" disabled>
							</div>
						</td>

						<td>
							<div>
								<span><button onclick="addRow();">+</button></span>
								<span><button onclick="removeRow('<?php echo $row_id; ?>');">-</button></span>
							</div>
						</td>
						
						
					</tr>
				</tbody>
				
			</table>
		</div>

		
		<?php
	}



	function showMedicineList($txt){
		require '../include/dbc.inc.php';
		if($conn){
			if($txt == "")
				$sql = "select * from drug_store";
			else
				$sql = "select * from drug_store where drug_name like '%$txt%'";
			$res = mysqli_query($conn,  $sql);
			while($row = mysqli_fetch_assoc($res))
				echo '<option value="'.$row['drug_name'].'">'.$row['drug_name'].'</option>';

		}else{
			echo "Database Not conncted";
		}
	}

 function fill($name, $column){
 	require '../include/dbc.inc.php';
 	if($conn){
 		$sql = "select * from drug_store where drug_name = '$name'";
 		$res = mysqli_query($conn, $sql);
 		if(mysqli_num_rows($res) != 0) {
	        $row = mysqli_fetch_array($res);
	        echo $row[$column];
      		}
 	}else
 		echo "Database Not conncted";
 }

function insert(){
	$mname = $_GET['mname'];
	$qty = $_GET['qty'];
	$expire_date = $_GET['expire_date'];
	//echo $mname ." : ".$qty."<br>";
	//foreach($mname as $mn){
	
		echo $mname."<br>";
	//}

/////////////---- may be an other time -------- /////////////////

		// $prescription = $_POST['prescription'];
			// if ($prescription != "") {
			// 	$sql2 = "update patient_info set prescription = '$prescription', visit = 3 where id = '$id'";
			// 	if (mysqli_query($conn, $sql2)) {
			// 		header("location:result.php");
			// 	}else
			// 		echo mysqli_error($conn);
			// }else{
			// 	$sql2 = "update patient_info set visit = 0 where id = '$id'";
			// 	if (mysqli_query($conn, $sql2)) {
			// 		header("location:result.php");
			// 	}else
			// 		echo mysqli_error($conn);
			// }

			//$sql3 = "select * from patient_info where student_id = '$id' AND status = 1";

		 		// $result2 = mysqli_query($conn, $sql3);
				//  if ($result2 == true) {	 
				//  $resultCheck2 = mysqli_num_rows($result2);
				//  if ($resultCheck2 > 0) {
				//  while ($rows2 = mysqli_fetch_assoc($result2)) {	
		 		// $lab_result = $rows2['lab_result'];
		 		// echo "ID: $id <br>First Name: $fname<br> Last Name: $lname<br>Lab Result: $lab_result<br>";
}
?>
/////////////---- may be an other time -------- /////////////////

<script type="text/javascript">
	
			function addDrug() {
				var drugName = document.form1.drugName.value;
				var drugAmount = document.form1.drugAmount.value;
				var drugDesc = document.form1.drugDesc.value;

				if(drugName != "" && drugAmount != "" && drugDesc != ""){
				var tr = document.createElement("tr");

				var td1 = tr.appendChild(document.createElement("td"));
				var td2 = tr.appendChild(document.createElement("td"));
				var td3 = tr.appendChild(document.createElement("td"));
				var td4 = tr.appendChild(document.createElement('td'));
                var td5 = tr.appendChild(document.createElement('td'));

				td1.innerHTML = '<input type="hidden" name="drugName[]" id="drugNames" value="'+drugName+'">'+drugName;
				td2.innerHTML = '<input type="hidden" name="drugAmount[]" id="drugAmounts" value="'+drugAmount+'">'+drugAmount;
				td3.innerHTML = '<input type="hidden" name="drugDesc[]" id="drugDescs" value="'+drugDesc+'">'+drugDesc;
				td4.innerHTML = '<input type="button" name="up" value="Update" onclick="UpDrug(this);">';
				td5.innerHTML = '<input type="button" name="del" value="Delete" onclick="delDrug(this);">';
                
				document.getElementById('tbl').appendChild(tr);

				//document.getElementById('abc').value = "";
		}else{
			alert("Please fill all input");
		}
		
			}
			function UpDrug(stud){
                var drugNames = document.getElementById('drugNames').value;
				var drugAmounts = document.getElementById('drugAmounts').value;
				var drugDescs = document.getElementById('drugDescs').value;

				

                var s = stud.parentNode.parentNode;
                var tr = document.createElement('tr');

                var td1 = tr.appendChild(document.createElement('td'));
                var td2 = tr.appendChild(document.createElement('td'));
                var td3 = tr.appendChild(document.createElement('td'));
                var td4 = tr.appendChild(document.createElement('td'));
                var td5 = tr.appendChild(document.createElement('td'));

             td1.innerHTML = '<input type="text" name="drugName1" value="'+drugNames+'">';
             td2.innerHTML = '<input type="number" name="drugSize1" value="'+drugAmounts+'">';
             td3.innerHTML = '<input type="text" name="drugDesc1" value="'+drugDescs+'">';  

            td4.innerHTML = '<input type="button" name="up" value="Save Update" onclick="addUpDrug(this);">';
            td5.innerHTML = '<input type="button" name="del" value="Delete" onclick="delDrug(this);">';
                
                document.getElementById("tbl").replaceChild(tr, s);
            	}
            	function addUpDrug(stud){
                var drugName = document.form1.drugName1.value;
				var drugAmount = document.form1.drugSize1.value;
				var drugDesc = document.form1.drugDesc1.value;
                var s = stud.parentNode.parentNode;
                var tr = document.createElement('tr');

                var td1 = tr.appendChild(document.createElement('td'));
                var td2 = tr.appendChild(document.createElement('td'));
                var td3 = tr.appendChild(document.createElement('td'));
                var td4 = tr.appendChild(document.createElement('td'));
                var td5 = tr.appendChild(document.createElement('td'));

                td1.innerHTML = '<input type="hidden" name="drugName[]" value="'+drugName+'">'+drugName;
				td2.innerHTML = '<input type="hidden" name="drugAmount[]" value="'+drugAmount+'">'+drugAmount;
				td3.innerHTML = '<input type="hidden" name="drugDesc[]" value="'+drugDesc+'">'+drugDesc;
				td4.innerHTML = '<input type="button" name="up" value="Update" onclick="UpDrug(this);">';
				td5.innerHTML = '<input type="button" name="del" value="Delete" onclick="delDrug(this);">';
                
                document.getElementById("tbl").replaceChild(tr, s);
            	}
            	function delDrug(stud){
	        		var s = stud.parentNode.parentNode;
	        		document.getElementById('tbl').removeChild(s);
            	}
            
</script>

/////////////---- may be an other time -------- /////////////////
		 		<form action="" method="post" name="form1">

		 		<table border="1" id="tbl">
					
					Drug Name: <input type="text" name="drugName">
					Amount: <input type="number" name="drugAmount">
					Description: <input type="text" name="drugDesc"><br>

					<input type="button" name="add" value="Add Drug" onclick="addDrug()"><br><br>

					<thead>
					<th>Name</th>
					<th>Amount</th>
					<th>Description</th>
					<th>Update</th>
					<th>Delete</th>
					</thead>
					<tbody>
						
					</tbody>
				</table>
					<input type="submit" name="finish" value="Finish"><br>
					</div><br>
		 		</form>
		 		<?php

		if (isset($_POST['finish'])) {


			//$history = $_POST['history'];
			$drugName = $_POST['drugName'];
			$drugAmount = $_POST['drugAmount'];
			$drugDesc = $_POST['drugDesc'];

			if($drugName != "" && $drugAmount != "" && $drugDesc != ""){

				//$sql = "insert into patient_info(id, history, visit, visited_date) values('$id','$history',3,'$date') ";
				$sql = "update patient_info set visit = 3 where id = '$id' AND visit = 2";
			if(mysqli_query($conn, $sql)){
				$sql3 = "select * from patient_info where id = '$id' AND visit = 3";
				$result = mysqli_query($conn, $sql3);
				$resultCheck = mysqli_num_rows($result);
				if($resultCheck > 0){
					while ($rows = mysqli_fetch_assoc($result)) {
						$id = $rows['id'];
						$history = $rows['history'];
						$visit = $rows['visit'];
						$p_id = $rows['patient_id'];
						//echo "ID: $id, History: $history, Visit: $visit, P_ID: $p_id <br>";

						

				$array1 = array();
				$array2 = array();
				$array3 = array();
				$x1 = $x2 = $x3 = 0;

				foreach ($drugName as $dname) {
					$array1[$x1] = $dname;
					$x1++;
				}

				foreach ($drugAmount as $damount) {
					$array2[$x2] = $damount;
					$x2++;
				}

				foreach ($drugDesc as $ddesc) {
					$array3[$x3] = $ddesc;
					$x3++;
				}

				$length = count($array1);

				for ($i=0; $i < $length; $i++) { 
					$arr1 = $array1[$i];
					$arr2 = $array2[$i];
					$arr3 = $array3[$i];
			$sql4 = "insert into prescription(id, drug_name, amount, description,patient_id) values('$id', '$arr1', '$arr2', '$arr3', '$p_id')";
					if(!mysqli_query($conn, $sql4)){
						echo "There is an Error 1 <br>";
					}
					//echo "$arr1,$arr2,$arr3 <br>";
				}
	
				header("location:view_info.php");
				
			  }
				}else{
				echo "0 Result";
			}
								
				}else{
					echo "Unknown Error 3";
		      	}
			}else{
				$sql = "update patient_info set visit = 0 where id = '$id' AND visit = 2";
				if(mysqli_query($conn, $sql)){
					header("location:view_info.php");
				}else{
					echo "Unknown Error 4";
				}	
			}


			
			
			}
		?>

			<?php $sql = $conn->query("SELECT count(fname) AS num from patient_info where status = 1");?>
			   <?php while ($row= $sql->fetch_assoc()):
        
        ?>
        <?php  echo $row["num"];?>
              <?php endwhile;?>


              //////////////////////////////// lab test receiving form

              	 $resultCheck = mysqli_num_rows($result);
		 if ($resultCheck > 0) {
		 	echo "<form action='' method='post'>";
		 	while ($rows = mysqli_fetch_assoc($result)) {
		 		
		 			if($value){
		 			echo $value."  <input type='text' name='techno[]' required> <br>";
		 			 $arr[$x] = $value;
		 			 $x = $x + 1;
		 			}	
		 		}
		 	}
		 	echo "<input type='submit' name='submit' value='submit'>";
		 	echo "</form>";
		 	
		 }else
		 	echo "No Result";