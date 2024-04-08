<!DOCTYPE html>
<html>
<head>
	<title>Pharmacist | Register Drug</title>
	<link rel="stylesheet" type="text/css" href="include/style.css">
</head>
<body>
<?php include_once "include/header.php";
	include "include/dbc.inc.php"; ?>

	<div class="column" style="border: 2px solid blue;">	

	<form action="" method="POST" name="form1">

		<table border="1" id="tbl" >

		Drug Name: <input type="text" name="drugName" > <br><br>
		Amount: <input type="number" name="drugAmount" > <br><br>
		Measure: <input type="text" name="drugMeasure" > <br><br>
		Expire date: <input type="date" name="expiredate" > <br><br>
		

		<input type="button" name="add" value="Add Drug" onclick="addDrug()"><br><br>

		<thead>
			<th>Name</th>
			<th>Amount</th>
			<th>Measure</th>
			<th>Expire Date</th>
			<th>Update</th>
			<th>Delete</th>
		</thead>
		<tbody>

		</tbody>
	</table>
		<br>
		<input type="submit" name="finish" value="Register"><br><br>
	</form>	


		<?php 
		if(isset($_POST['finish'])){
			$drugName = $_POST['drugName'];
			$drugAmount = $_POST['drugAmount'];
			$drugMeasure = $_POST['drugMeasure'];
			$expiredate = $_POST['expiredate'];

			if($drugName != "" && $drugAmount != "" && $drugMeasure !="" && $expiredate != ""){
				$array1 = array();
				$array2 = array();
				$array3 = array();
				$array4 = array();

				$x1 = $x2 = $x3 = $x4 = 0;

				foreach ($drugName as $dname) {
					$array1[$x1] = $dname;
					$x1++;
				}

				foreach ($drugAmount as $damount) {
					$array2[$x2] = $damount;
					$x2++;
				}

				foreach ($drugMeasure as $dmeasure) {
					$array3[$x3] = $dmeasure;
					$x3++;
				}

				foreach ($expiredate as $dexpire) {
					$array4[$x4] = $dexpire;
					$x4++;
				}

				$length = count($array1);

				for ($i=0; $i < $length; $i++) { 
					$arr1 = $array1[$i];
					$arr2 = $array2[$i];
					$arr3 = $array3[$i];
					$arr4 = $array4[$i];
				// $sql4 = "insert into prescription(id, drug_name, amount, description,patient_id) values('$id', '$arr1', '$arr2', '$arr3', '$p_id')";
				// 				if(!mysqli_query($conn, $sql4)){
				// 					echo "There is an Error 1 <br>";
				// 				}
								echo "$arr1,$arr2,$arr3,$arr4 <br>";
							//}
				
					//header("location:view_info.php");
							
			}
		}else{
			echo "Empty";
		}
	}	

	// 	$conn = mysqli_connect('localhost','root','','BUC');
	// 	if (isset($_POST['submit'])) {
	// 		$name = test_input($_POST['name']);
	// 		$melekia = test_input($_POST['melekia']);
	// 		$bizat = test_input($_POST['bizat']);
	// 		$expiredate = test_input($_POST['expiredate']);
	// 		//$registered_date = date("Y-m-d");
	// 		$sql = "insert into drug values('$name','$bizat','$melekia','$expiredate')";
	// 		if(mysqli_query($conn,$sql)){
	// 		echo "Registered succesfully <br>";
	// 	 }else
	// 		echo mysqli_error($conn);
	// 	}
	// function test_input($data) {
 //    $data = trim($data);
 //    $data = stripslashes($data);
 //    $data = htmlspecialchars($data);
 //    return $data;
 //  }
	?>
	</div>
	</div>
</div>

		<script type="text/javascript">
			function addDrug() {
				var drugName = document.form1.drugName.value;
				var drugAmount = document.form1.drugAmount.value;
				var drugMeasure = document.form1.drugMeasure.value;
				var expiredate = document.form1.expiredate.value;
				

				if(drugName != "" && drugAmount != "" && drugMeasure != "" && expiredate != ""){
				var tr = document.createElement("tr");

				var td1 = tr.appendChild(document.createElement("td"));
				var td2 = tr.appendChild(document.createElement("td"));
				var td3 = tr.appendChild(document.createElement("td"));
				var td4 = tr.appendChild(document.createElement('td'));
                var td5 = tr.appendChild(document.createElement('td'));
                var td6 = tr.appendChild(document.createElement('td'));

		td1.innerHTML = '<input type="hidden" name="drugName[]" id="drugNames" value="'+drugName+'">'+drugName;
		td2.innerHTML = '<input type="hidden" name="drugAmount[]" id="drugAmounts" value="'+drugAmount+'">'+drugAmount;
		td3.innerHTML = '<input type="hidden" name="drugMeasure[]" id="drugMeasures" value="'+drugMeasure+'">'+drugMeasure;
		td4.innerHTML = '<input type="hidden" name="expiredate[]" id="expiredates" value="'+expiredate+'">'+expiredate;
		td5.innerHTML = '<input type="button" name="up" value="Update" onclick="UpDrug(this);">';
		td6.innerHTML = '<input type="button" name="del" value="Delete" onclick="delDrug(this);">';
                
				document.getElementById('tbl').appendChild(tr);

				//document.getElementById('abc').value = "";
		}else{
			alert("Please fill all input");
		}
		
			}
			function UpDrug(stud){
                var drugNames = document.getElementByName('drugNames').value;
				var drugAmounts = document.getElementById('drugAmounts').value;;
				var drugMeasures = document.getElementById('drugMeasures').value;;
				var expiredates = document.getElementById('expiredates').value;
				//var drugNames = document.getElementsByTagName('drugName').value;


                var s = stud.parentNode.parentNode;
                var tr = document.createElement('tr');

                var td1 = tr.appendChild(document.createElement("td"));
				var td2 = tr.appendChild(document.createElement("td"));
				var td3 = tr.appendChild(document.createElement("td"));
				var td4 = tr.appendChild(document.createElement('td'));
                var td5 = tr.appendChild(document.createElement('td'));
                var td6 = tr.appendChild(document.createElement('td'));

            td1.innerHTML = '<input type="text" name="drugName1" value="'+drugNames+'">';
			td2.innerHTML = '<input type="number" name="drugAmount1" value="'+drugAmounts+'">';
			td3.innerHTML = '<input type="text" name="drugMeasure1" value="'+drugMeasures+'">';
			td4.innerHTML = '<input type="date" name="expiredate1" value="'+expiredates+'">';

            td5.innerHTML = '<input type="button" name="up" value="Save Update" onclick="addUpDrug(this);">';
            td6.innerHTML = '<input type="button" name="del" value="Delete" onclick="delDrug(this);">';
                
                document.getElementById("tbl").replaceChild(tr, s);
            	}
            	function addUpDrug(stud){
                var drugName = document.form1.drugName1.value;
				var drugAmount = document.form1.drugAmount1.value;
				var drugMeasure = document.form1.drugMeasure1.value;
				var expiredate = document.form1.expiredate1.value;

                var s = stud.parentNode.parentNode;
                if(drugName != "" && drugAmount != "" && drugMeasure != "" && expiredate != ""){
                var tr = document.createElement('tr');

                var td1 = tr.appendChild(document.createElement("td"));
				var td2 = tr.appendChild(document.createElement("td"));
				var td3 = tr.appendChild(document.createElement("td"));
				var td4 = tr.appendChild(document.createElement('td'));
                var td5 = tr.appendChild(document.createElement('td'));
                var td6 = tr.appendChild(document.createElement('td'));

            td1.innerHTML = '<input type="hidden" name="drugName[]" value="'+drugName+'">'+drugName;
			td2.innerHTML = '<input type="hidden" name="drugAmount[]" value="'+drugAmount+'">'+drugAmount;
			td3.innerHTML = '<input type="hidden" name="drugMeasure[]" value="'+drugMeasure+'">'+drugMeasure;
			td4.innerHTML = '<input type="hidden" name="expiredate[]" value="'+expiredate+'">'+expiredate;
			td5.innerHTML = '<input type="button" name="up" value="Update" onclick="UpDrug(this);">';
			td6.innerHTML = '<input type="button" name="del" value="Delete" onclick="delDrug(this);">';
                
                document.getElementById("tbl").replaceChild(tr, s);
            }else{
            	alert("Please fill all input");
            }
            	}
            	function delDrug(stud){
            		var s = stud.parentNode.parentNode;
            		document.getElementById('tbl').removeChild(s);
            	}
            
		</script>

</body>
</html>