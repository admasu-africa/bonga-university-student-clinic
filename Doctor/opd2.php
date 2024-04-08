<!DOCTYPE html>
<html>
<head>
	<title>Doctor | OPD2</title>
	<!-- <link rel="stylesheet" type="text/css" href="include/style.css"> -->
	<style type="text/css">
		#divlabtest, #divprescription{
			display: none;
		}
	</style>

	</script>
</head>
<body>
<?php include_once "include/header.php"; 
	 include '../include/dbc.inc.php';
	 ?>
	
	<div class="column" style="border: 2px solid blue;">
			<?php  
				$pid = $_GET['id'];
				$date = date("Y/m/d");
				//$conn = mysqli_connect('localhost','root','','BUC');
				//echo "The Id of student is: ".$pid;
					?>
					<form action="" method="post" name="form1">
					<button name="what" >view history</button><br>

					<?php if(isset($_POST['what'])){
			$pid = $_GET['id'];
			//$conn = mysqli_connect('localhost','root','','BUC');
			$sql5 = "select * from patient_info where id = '$pid'";
			$result1 = mysqli_query($conn, $sql5);
			if ($result1 == true) {
				$resultCheck1 = mysqli_num_rows($result1);
				if ($resultCheck1 > 0) {
					while ($row1 = mysqli_fetch_assoc($result1)) {
						$history1 = $row1['history'];
						//$prescription1 = $row1['prescription'];
						$lab_result1 = $row1['lab_result'];
						if($lab_result1 == "")
							$lab_result1 = "No Lab Result";
						echo "History: ".$history1."<br> Lab Result: ".$lab_result1."<br><br>";
					}
				}else
					echo "No Previous History<br>";
			}
		}
		 ?>

				Write History: <br><textarea id="historys" name="history" rows="5" cols="30"></textarea> <br>
						
					<input type="button" name="labtest" value="labtest need?" onclick="labTest()"><br>		
					<div id="divlabtest">
					Lab test:<br>
					<input type="checkbox" name="labtest[]" value="Urine">Urine
					<input type="checkbox" name="labtest[]" value="Saliva">Saliva
					<input type="checkbox" name="labtest[]" value="Blood">Blood
					<input type="checkbox" name="labtest[]" value="Faeces">Faeces<br>
					</div>
					<br>

					<!-- <a href="prescription.php?id=<?php //echo $pid; ?>"><button  class="one">Prescribe??</button></a><br> -->

					<input type="button" name="labtest" value="Prescribe?" onclick="testing()"><br>
					<!-- <button id="prescription" onclick="testing();">Prescribe?</button><br> -->

						<div id="divprescription">
						Prescription:<br>

				<table border="1" id="tbl">
					
					Drug Name: <input type="text" name="drugName" id="drugname">
					Amount: <input type="number" name="drugAmount" id="drugdose">
					Description: <input type="text" name="drugDesc" id="drugdescribe"><br>

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
						</div><br>

					<input type="submit" name="finish" value="Finish"><br>
					</form>

					<?php 
					// exit();
					if (isset($_POST['finish'])) {
						
						$history = $_POST['history'];
						$drugName = $_POST['drugName'];
						$drugAmount = $_POST['drugAmount'];
						$drugDesc = $_POST['drugDesc'];

						if(!isset($_POST['labtest']) && $history == ""  && $drugName == "" && $drugAmount == "" && $drugDesc == ""){

							$sql = "update patient set visit = 0 where id = '$pid'";
							if(mysqli_query($conn, $sql)){
								header("location:view_info.php");
							}else{
								echo "Unknown Error 1 ";
							}
							
						}
						else if(!isset($_POST['labtest']) && $drugName == "" && $drugAmount == "" && $drugDesc == "" && $history != ""){
							$sql = "insert into patient_info(id, history, visit, visited_date) values('$pid','$history',0,'$date') ";
							$sql2 = "update patient set visit = 0 where id = '$pid'";
							if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)){
								header("location:view_info.php");
							}else{
								echo "Unknown Error 2";
							}
						}

						else if(isset($_POST['labtest'])){
							$labtest = $_POST['labtest'];
							$labtest_vlaue = "";
							
							foreach ($labtest as $value) {
								$labtest_vlaue = $labtest_vlaue.$value.",";
							}
							$sql = "insert into patient_info(id, history, visit, visited_date, lab_test) values('$pid','$history',1,'$date', '$labtest_vlaue') ";
							$sql2 = "update patient set visit = 0 where id = '$pid'";
							if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)){
								header("location:view_info.php");
							}else{
								echo "Unknown Error 3: ".mysqli_error($conn);
							}
						}
						else if($drugName != "" && $drugAmount != "" && $drugDesc != ""){
							$sql = "insert into patient_info(id, history, visit, visited_date) values('$pid','$history',3,'$date') ";
							$sql2 = "update patient set visit = 0 where id = '$pid'";
							if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)){
								$sql3 = "select * from patient_info where id = '$pid' AND visit = 3";
								$result = mysqli_query($conn, $sql3);
								$resultCheck = mysqli_num_rows($result);
								if($resultCheck > 0){
									while ($rows = mysqli_fetch_assoc($result)) {
										$id = $rows['id'];
										$history = $rows['history'];
										$visit = $rows['visit'];
										$p_id = $rows['patient_id'];
										

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
									$sql4 = "insert into prescription(id, drug_name, amount, description,patient_id) values('$pid', '$arr1', '$arr2', '$arr3', '$p_id')";
											if(!mysqli_query($conn, $sql4)){
												echo "There is an Error 4 <br>";
											}
											//echo "$arr1,$arr2,$arr3 <br>";
										}

										header("location:view_info.php");
											
									}
								}else{
									echo "0 Result";
								}
								
							}else{
								echo "Unknown Error 5: ".mysqli_error($conn);
							}
						}
						else{
							echo "Unknown Error 6";
						}
			
				}		
			  		
		?>
		<script type="text/javascript">
			function addDrug() {
				var drugName = document.form1.drugName.value;
				var drugAmount = document.form1.drugAmount.value;
				var drugDesc = document.form1.drugDesc.value;

				var one = document.getElementById('drugname').value;
				var two = document.getElementById('drugdose').value;
				var three = document.getElementById('drugdescribe').value;

				//if(drugName != "" && drugAmount != "" && drugDesc != ""){
					if(one != "" && two != "" && three != ""){
				var tr = document.createElement("tr");

				var td1 = tr.appendChild(document.createElement("td"));
				var td2 = tr.appendChild(document.createElement("td"));
				var td3 = tr.appendChild(document.createElement("td"));
				var td4 = tr.appendChild(document.createElement('td'));
                var td5 = tr.appendChild(document.createElement('td'));

			td1.innerHTML = '<input type="hidden" name="drugName[]" id="drugNames" value="'+drugName+'">'+drugName;
			td2.innerHTML = '<input type="hidden" name="drugAmount[]" id="drugAmount" svalue="'+drugAmount+'">'+drugAmount;
			td3.innerHTML = '<input type="hidden" name="drugDesc[]" id="drugDescs" value="'+drugDesc+'">'+drugDesc;
			td4.innerHTML = '<input type="button" name="up" value="Update" onclick="UpDrug(this);">';
			td5.innerHTML = '<input type="button" name="del" value="Delete" onclick="delDrug(this);">';
                
				document.getElementById('tbl').appendChild(tr);

		}else{
			alert("Please fill all input ");
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
            
			function labTest(){
				document.getElementById('divlabtest').style.display = "inline";//or block
				// document.write("Thi is testing");prescription
				//document.getElementById('prescriptionid').innerHTML = "What";
				document.getElementById('divprescription').style.display = "none";
				//document.getElementById('divprescription').value = "none";
			}
			function testing(){
				
				document.getElementById('divprescription').style.display = "block";
				document.getElementById('divlabtest').style.display = "none";
			}
		</script>
		</div>
	</div>
</div>
</body>
</html>