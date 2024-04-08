   <!DOCTYPE html>
   <html>
   <head>
   	<title>Semonun</title>
   	<link rel="stylesheet" type="text/css" href="../include/bootstrap/css/bootstrap.css">
		<script src="../include/bootstrap/js/bootstrap.js"></script>
		<script src="../include/jquery/jquery-3.6.2.min.js"></script>
   </head>
   <body>



   	<table>
   		<thead>
   			<tr>
   				<th>Name</th>
   				<th>ID</th>
   			</tr>
   			
   		</thead>
   		<tbody>
   			<tr>
   				<td contenteditable='true'>one</td>
   				<td contenteditable='true'>two</td>
   			</tr>
   		</tbody>
   	</table>




   	<div>
   		<div>
   		Name: <input type="text" class="names" id="names"><br>
   		ID: <input type="text" class="ids" id="ids"><br>
   		</div>
   		<div>
   		<button id="add_drug">Add Drug</button><br>
   		</div>

   		<table id="tables">
   			<thead>
   				<tr>
   				<th>Name</th>
   				<th>ID</th>
   				<th>Action</th>
   				</tr>
   			</thead>
   			<tbody>
   				
   			</tbody>
   		</table>

   		<div>
   			<button id="save_data_db">Save on database</button>
   		</div>
   	</div>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
   	<script>
   		var update_row = null;
   		$(document).ready(function(){
   			var count = 0;
   			
   			$("#add_drug").click(function(){
   				if(update_row == null){
		   				count += 1;
		   				var name = document.getElementById("names").value;
		   				var id = document.getElementById("ids").value;
		   				//alert("Name: "+name+" ID: "+id);
		   				var add_table = "<tr id='row"+count+"'>";
		   				add_table += "<td class='named'>"+name+"</td>";
		   				add_table += "<td class='idd'>"+id+"</td>";
		   				add_table += "<td><button class='update' name='update' data-row='row"+count+"'>Update</button>"+
		   				"<button class='delete' name='delete' data-row='row"+count+"'>Delete</button></td>";
		   				add_table += "</tr>";
		   				$("#tables").append(add_table);
   				}else{
						var name = document.getElementById("names").value;
   					var id = document.getElementById("ids").value;
   					document.getElementById(update_row).cells[0].innerHTML = name;
						document.getElementById(update_row).cells[1].innerHTML = id;

   				}
   			resetData();
   			});

   			$(document).on('click','.delete',function(){
   				if(confirm("Are you sure to delete this row?")){
   				var delete_row = $(this).data("row");
   				//alert(delete_row);
   				$("#"+delete_row).remove();
   				}
   			});

   			$(document).on('click','.update',function(){
   				 update_row = $(this).data("row");
   				var name = document.getElementById(update_row).cells[0].innerHTML;
   				var id = document.getElementById(update_row).cells[1].innerHTML;
   				document.getElementById("names").value = name; 
   				document.getElementById("ids").value = id;
   			});

   			$("#save_data_db").click(function(){
   				var name = [];
   				var id = [];
   				$(".named").each(function(){
   					name.push($(this).text());
   				});
   				$(".idd").each(function(){
   					id.push($(this).text());
   				});

   				$.ajax({
   					url:'php_testing2.php',
   					method:'post',
   					data:{name:name,id:id},
   					success:function(response){
   						if(response == "Inserted succesfully"){
   							alert(response);
   							// $("#tables").val() = "";
   							document.getElementById("tables").getElementsByTagName('tbody')[0].innerHTML = "";
   						}else{
   							alert(response);
   						}
   				}
   				  });
   			});

   		});
   		function resetData(){
   			document.getElementById("names").value = "";
				document.getElementById("ids").value = "";
				update_row = null;
   		}
   	</script>



   	
   	<div id="testingdiv1">
   		<div>
   			<label>Div 1</label><br>
   			<input type="text" name="" value="ones"><br><br>
   		</div>
   		<div>
   			<label>Div 2</label><br>
   			<input type="text" name="" value="ones"> <br><br>
   			<input type="text" name="" value="ones"><br><br>
   		</div>
   		<div>
   			<label>Div 3</label><br>
   			<input type="text" name="" value="ones"><br><br>
   			<input type="text" name="" value="ones"><br><br>
   			<input type="text" name="" value="ones"><br><br>
   		</div>
   		<div>
   			<table>
   				<tr>
   					<th>one</th>
   					<th>two</th>
   				</tr>
   				<tr>
   					<td>1</td>
   					<td>2</td>
   				</tr>
   			</table>
   		</div>
   	</div>
   	<button onclick="somewhere();">Div testing</button> <br><br><br><br><br>


   	<script type="text/javascript">
   		function somewhere(){
   			var parent = document.getElementById("testingdiv1");
   			var mi = parent.children;
				  var el = mi[3].children;
				  var mn = el[0].children[0].children[0].children[0];
				  var mn1 = el[2];
				 // var q = el[0].children[0].children[1];
				 // console.log(mn.value+":");
   			console.log(mi);//displays 4 div, cause there total number of element testingdiv1 contains 4 
   			console.log(el);
   			console.log(mn);
   			console.log(mn1);

   		}
   	</script>

<input id="expire_date_<?php echo $row_number ?>" type="text"  disabled><!--I dont know why it is not working -->
   	<?php
   	echo "Today's Day: ".date("Y-m-d");
   	if(isset($_POST['submit1'])){
   		$thn = $_POST['thenumber'];
   		$conn = mysqli_connect("localhost", "root", "", "BUC");
   		
   		//$sql6 = "insert into test2(number) value('$thn') ";
   		$sql6 = "update test2 set number = '$thn' where two = 'admasu'";
   		if(mysqli_query($conn, $sql6))
   			echo "inseted Successfully";
   		else
   			"I dont Know";

   	}

   	$conn = mysqli_connect("localhost", "root", "", "BUC");
   	$sql7 = "select * from test2";
   	$res7 = mysqli_query($conn,$sql7);
   	$res7Check = mysqli_num_rows($res7);
   	if($res7Check > 0){
   		while ($row7 = mysqli_fetch_assoc($res7)) {
   			$amnt = $row7['number'];
   			?>
   			<input type="number" name="numver" value="<?php echo $amnt; ?>">
   			<?php
   		}
   	}



   	?>

   	<br>
   	<br>
   	<br>
   	<br>
   	<br>
   	
   	<?php
   	$conn = mysqli_connect("localhost", "root", "", "BUC");
		 $sql = "select * from patient_info where id = 'aku1106160' order by visited_date desc";
		 $result = mysqli_query($conn, $sql);
		 if ($result == true) {	 
		 $resultCheck = mysqli_num_rows($result);
		 if ($resultCheck > 0) {
		 	while ($rows = mysqli_fetch_assoc($result)) {
		 		$history = $rows['history'];
		 		$lab_result = $rows['lab_result'];
		 		$patient_id = $rows['patient_id'];
		 		$visited_date = $rows['visited_date'];

		 		echo "History: ".$history.", lab_result: $lab_result, visited_date: $visited_date <br>";

		 		$sql2 = "select * from prescription where patient_id = '$patient_id'";
		 		$result2 = mysqli_query($conn, $sql2);
		 		if ($result2 == true) {	
		 			 $resultCheck2 = mysqli_num_rows($result2);
		 			if ($resultCheck2 > 0) {
		 				echo "Prescription: ";
		 				while ($rows2 = mysqli_fetch_assoc($result2)) {
		 					$drugName = $rows2['drug_name'];
		 					$dose = $rows2['amount'];
		 					$desc = $rows2['description'];

		 					echo "Name: $drugName, Dose: $dose, Description: $desc <br>";
		 				}
		 			}else{
		 	echo "0 Result";
		 }
		 		}else{
			echo "Error: ".mysqli_error($conn);
		}

		 	}
		 }else{
		 	echo "0 Result";
		 }
		}else{
			echo "Error: ".mysqli_error($conn);
		}
   	

		 	?>
  <!--  <form action="" method="post" enctype="multipart/form-data">  
   <div style="width:200px;border-radius:6px;margin:0px auto">  
<table border="1">  
   <tr>  
      <td colspan="2">Select Technolgy:</td>  
   </tr>  
   <tr>  
      <td>PHP</td>  
      <td><input type="checkbox" name="techno[]" value="PHP"></td>  
   </tr>  
   <tr>  
      <td>.Net</td>  
      <td><input type="checkbox" name="techno[]" value=".Net"></td>  
   </tr>  
   <tr>  
      <td>Java</td>  
      <td><input type="checkbox" name="techno[]" value="Java"></td>  
   </tr>  
   <tr>  
      <td>Javascript</td>  
      <td><input type="checkbox" name="techno[]" value="javascript"></td>  
   </tr>  
   <tr>  
      <td colspan="2" align="center"><input type="submit" value="submit" name="sub"></td>  
   </tr>  
</table>  
</div>  
</form>   -->
<?php //function thefunction(){
	//echo "The function is called";
//}
 ?>
<!-- <a href="<?php //thefunction(); ?>"><button>Call the function</button></a> -->

	<!-- <table border="1">
						<tr>
							<th>drug</th>
							<th>amount</th>
						</tr> -->
						<?php 
						// $x = 0;
						// while ( $x <= 5) { ?>
							<!-- <tr>
								<td><input type="text" name="one"></td>
								<td><input type="text" name=""></td>
							</tr> -->
							<?php
						// 	$x++;
						// } 

						?>
					<!-- </table>
						<button onclick="thefunction();">one</button>
						<script type="text/javascript">
							function thefunction(){
							//alert("what");
							document.getElementsByName('one') = "waht";
						}
						</script> -->

<?php  
// if(isset($_POST['sub']))  
// {  
// $host="localhost";//host name  
// $username="root"; //database username  
// $word="";//database word  
// $db_name="BUC";//database name  
// $tbl_name="patient_info"; //table name  
// $con=mysqli_connect("$host", "$username", "$word","$db_name")or die("cannot connect");//connection string  

// $checkbox1=$_POST['techno'];  
// $chk="";  
// foreach($checkbox1 as $chk1)  
//    {  
//       $chk .= $chk1.",";  
//    }
//    echo $chk;  
//$in_ch=mysqli_query($con,"insert into request_quote(technology) values ('$chk')");  
// if($in_ch==1)  
//    {  
//       echo'<script>alert("Inserted Successfully")</script>';  
//    }  
// else  
//    {  
//       echo'<script>alert("Failed To Insert")</script>';  
//    }  
 // }  
	
	echo "<br> <form method='post' action = ''>";
	$x = $y = 0;
	$arrayName = array();
	while ($x < 3) {?>
		Name: <input type="input" name="name[]" required><br>
		<?php 
		$x++;
	}
	echo "<input type='submit' name='submit' value='submit'><br>";
	echo "</form>";

	if (isset($_POST['submit'])) {
		foreach ($_POST['name'] as  $value) {
			if ($value == "") {
				// echo "Empty<br>";
				$arrayName[$y] = $value;
				echo "$arrayName[$y] <br>";
			}else{
			$arrayName[$y] = $value;
			echo "$arrayName[$y] <br>";
			// echo "$value <br>";
		}
			$y = $y + 1;
		}
		
	}
	$length = count($arrayName);
	
	// $length = count($arrayName);
	// echo $length;
	for ($i=0; $i < $length; $i++) { 
	 	echo $arrayName[$i]."<br>";
	 }
	//  for ($i=0; $i < 3; $i++) { 
	//  	echo $arrayName[$i]."<br>";
	//  } 

	 // $pid = 'aku1106160';
		// 	$conn = mysqli_connect('localhost','root','','BUC');
		// 	$sql5 = "select * from patient_info where id = '$pid'";
		// 	$result1 = mysqli_query($conn, $sql5);
		// 	if ($result1 == true) {
		// 		$resultCheck1 = mysqli_num_rows($result1);
		// 		if ($resultCheck1 > 0) {
		// 			while ($row1 = mysqli_fetch_assoc($result1)) {
		// 				$history1 = $row1['history'];
		// 				$prescription1 = $row1['prescription'];
		// 				$lab_result1 = $row1['lab_result'];
		// 				echo "History: ".$history1."<br> Lab Result: ".$lab_result1."<br> Prescription: ".$prescription1."<br>";
		// 			}
		// 		}
		// }
?>  
<button onclick="myFunction()">Click</button>
<div id="texts">
					<form>
					<textarea  cols="30" rows="5" name="Prescription"></textarea><br>
					</form>
</div>

<script type="text/javascript">
	function myFunction() {
		document.getElementById('texts').style.display = "none";

	}
</script>
<br><br><br><br>

<p id="ad"></p>
	
	<form name="formn" method="POST">
		<table border="1" id="tbl">
			NO: <input type="number" name="rollno"  >
			FName: <input type="text" name="fname" id="abc">
			LName: <input type="text" name="lname" ><br><br>
			<input type="button" name="add" value="Add Data" onclick="addData();"><br><br>
			<thead>
			<th>one</th>
			<th>two</th>
			<th>three</th>
			</thead>
			<tbody>
				
			</tbody>
		</table>
		<input type="submit" name="save_data" value="Save Data"><br><br><br>
	</form>
	<script type="text/javascript">
		function addData() {
			var rollno = document.formn.rollno.value;
		

			if(rollno != ""){
				var tr = document.createElement("tr");

			var td1 = tr.appendChild(document.createElement("td"));
			var td2 = tr.appendChild(document.createElement("td"));
			var td3 = tr.appendChild(document.createElement("td"));

			td1.innerHTML = '<input type="hidden" name="rollno[]" value="'+rollno+'">'+rollno;
			

			td2.innerHTML = '<input type="button" name="up" value="Update" onclick="UpDrug(this);">';
			td3.innerHTML = '<input type="button" name="del" value="Delete" onclick="delDrug(this);">';

			document.getElementById('tbl').appendChild(tr);

			document.getElementById('abc').value = "";
		}else{
			alert("Please fill all input");
		}

		}
		function UpDrug(stud) {
			document.getElementById('ad').innerHTML = stud.children.listChildren[1];
		}
	</script>

	<?php 
	if(isset($_POST['save_data'])){
		$rollno = $_POST['rollno'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		if($rollno != "" && $fname != "" && $lname != ""){
		$x1 = $y1 = 0;
		$x2 = $y2 = 0;
		$x3 = $y3 = 0;
		$arrayName1 = array();
		$arrayName2 = array();
		$arrayName3 = array();

		foreach ($rollno as $roll) {
			$arrayName1[$x1] = $roll;
			$x1++;
		}
		foreach ($fname as $fnm){
			$arrayName2[$x2] = $fnm;
			$x2++;
		}	
		foreach ($lname as $lnm) {
			$arrayName3[$x3] = $lnm;
			$x3++;
		}
		$length1 = count($arrayName1);
		for ($i1=0; $i1 < $length1; $i1++) { 
			echo "Roll No: ".$arrayName1[$i1]." "."First Name: ".$arrayName2[$i1]." Last Name: ".$arrayName3[$i1]."<br>";
		}
	}else{

		echo "Its empty";
	}
		
	}
		 ?>

		 <form method="POST">
		 <input type="text" name="fname1" id="fname2" >
		 <input type="button" name="btn" id="btn1" value="Disable" onclick="myFunction1();">
		 <input type="submit" name="Submit1" value="submit1"><br><br><br>
		 </form>
		 <script type="text/javascript">
		 	function myFunction1(){
		 		//document.getElementById('fname2').disabled = true;
		 		//document.getElementById('fname2').required = true;
		 	}
		 </script>
	<?php 
	if(isset($_POST['Submit1'])){
		
		if($_POST['fname1'] != NULL){
			$fname1 = $_POST['fname1'];
		echo "The First Name: $fname1";

	}
		else
			echo "It's Not Fair";
	} ?>
</body>  
</html>  
