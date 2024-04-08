/////////////////////////// first file ////////////////////////////////////
<?php 
	if(isset($_GET['action']) && $_GET['action'] == 'add_row')
		createMedicineInfo();
	if(isset($_GET['action']) && $_GET['action'] == 'show_drug_list')
		showMedicineList($_GET['drug_name']);
	if(isset($_GET['action']) && $_GET['action'] == 'fill')
		fillField($_GET['drug_name'], $_GET['column']);
	if(isset($_GET['action']) && $_GET['action'] == 'save_request')
		saveRequest($_GET['drug_name'],$_GET['qty'],$_GET['expire_date']);
	if(isset($_POST['arrays']))
		saveRequestT();

	function createMedicineInfo(){
		$row_id = $_GET['row_id'];
		$row_number = $_GET['row_number'];
		?>

		<div class="row col col-md-12">
			<div class="col">
				<input class="medicine_name" type="text" name="medicine_name" id="medicine_name_<?php echo $row_number; ?>"
				list="medicine_list_<?php echo $row_number; ?>" onfocus="showMedicineOption(this.value,'medicine_list_<?php echo $row_number; ?>');"
				onkeyup="showMedicineOption(this.value,'medicine_list_<?php echo $row_number; ?>');" onchange="fillTheFields(this.value,'<?php echo $row_number; ?>');"
				placeholder='Please select drug'>
				<datalist id="medicine_list_<?php echo $row_number; ?>">
					 <?php showMedicineList("") ?>
				</datalist>
			</div>
			<div class="col">
				<input class="available_qty" type="text" name="available_qty" id="available_qty_<?php echo $row_number; ?>" disabled>
			</div>
			<div class="col">
				<input class="provided_qty" type="text" name="provide_qty" id="provide_qty_<?php echo $row_number; ?>">
			</div>
			<div class="col">
				<input class="expire_date" type="text" name="expire_date" id="expire_date_<?php echo $row_number; ?>" disabled>
			</div>

			<div class="col">
				<button class="btn btn-success" onclick="addRequestRow();">Add</button>
				<button class="btn btn-danger" onclick="removeRequestRow('<?php echo $row_id; ?>');">Remove</button>
			</div>
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
			$resCheck = mysqli_num_rows($conn, $res);
			while($row = mysqli_fetch_assoc($res))
				echo '<option value="'.$row['drug_name'].'">'.$row['drug_name'].'</option>';

		}else{
			echo "Database Not conncted";
		}
	}
	function fillField($name, $column){
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

	function saveRequest($name, $qty, $expire_date){

		//echo "Name: ".$name.", Quantity: ".$qty.", Expire Date: ".$expire_date."<br>";

		echo count($_GET['arrays']);

		// require '../include/dbc.inc.php';
		// $date = date("Y-m-d");
		// if ($conn) {
		// 	$sql = "INSERT INTO provide_request(drug_name,requested_quantity, expire_date, requested_by, requested_date) 
		// 	VALUES('$name','$qty','$expire_date','Pharmacist','$date');";
		// 	$res = mysqli_query($conn, $sql);
		// 		echo ($res) ? 1:mysqli_error($conn);
		// }else
		// 	echo "Error: ".mysqli_error($conn);

		// $sql = '';
		// $name = $_POST['dname'];
		// $qty = $_POST['dqty'];
		// $expire_date = $_POST['dexpire_date'];
		// for ($i=0; $i < count($name); $i++) { 
		// 	$name_clean = mysqli_real_escape_string($conn,$name[$i]);
		// 	$qty_clean = mysqli_real_escape_string($conn,$qty[$i]);
		// 	$expire_date_clean = mysqli_real_escape_string($conn,$expire_date[$i]);

		// 	if($name_clean != "" || $qty_clean != "" || $expire_date_clean != ""){
		// 		$sql .= "INSERT INTO provide_request(drug_name,requested_quantity, expire_date, requested_by, requested_date) 
		// 		VALUES('$name_clean','$qty_clean','$expire_date_clean','Pharmacist','$date');";
		// 	}else
		// 		echo "Please fill all fields";		
		// }

		// if($sql != null){
		// 	if (mysqli_multi_query($conn,$sql)) {
		// 		echo 1;
		// 	}else
		// 		echo "Error: ".mysqli_error($conn);
		// }else
		// 	echo "Please fill all fields";	

	}

	function saveRequestT(){
		//echo count($_POST['arrays']);
		echo "Wow Its called";
	}
 ?>
 /////////////////////////// second file ////////////////////////////////////

 <script type="text/javascript">
 	var row = 0;
	var failed = 0;
	var success = 0;
class MedicineInfo {
  constructor(name, quantity, expire_date) {
    this.name = name;
    this.expire_date = expire_date;
    this.quantity = quantity;
  }
}
function addRequestRow(){
	if(addRequestRow.counter == undefined)
		addRequestRow.counter = 1;
	//alert(addRequestRow.counter);
	var previous_div = document.getElementById('provide_request_div');
	var node = document.createElement('div');
	cls = document.createAttribute('id');
	cls.value = 'medicine_row_'+addRequestRow.counter;
	node.setAttributeNode(cls);

	if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
 } else {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}

 xmlhttp.onreadystatechange = function(){
 	if(this.readyState == 4 && this.status == 200){
 		node.innerHTML = xmlhttp.responseText;
 		document.getElementById('provide_request_div').appendChild(node);
 		//alert(xmlhttp.responseText);
 	}
 	
 };

 	xmlhttp.open('GET','php/provide_drug_request.php?action=add_row&row_id='+cls.value+'&row_number='+addRequestRow.counter,true);
 	xmlhttp.send();

 	addRequestRow.counter++;
 	row++;
}
function showMedicineOption(txt, id){
	if(window.XMLHttpRequest)
		xmlhttp = new XMLHttpRequest();
	else
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			document.getElementById(id).innerHTML = xmlhttp.responseText;
		}
	};
	xmlhttp.open('GET','php/provide_drug_request.php?action=show_drug_list&drug_name='+txt,true);
 	xmlhttp.send();
}
function fillTheFields(medicine_name, id){
	fillFields(medicine_name, 'available_qty_'+id, 'amount');
	fillFields(medicine_name, 'expire_date_'+id, 'expire_date');
}
function fillFields(medicine_name, id, column){
	var id1 = document.getElementById(id);
	if(window.XMLHttpRequest)
		xmlhttp = new XMLHttpRequest();
	else
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			id1.value = this.responseText;
		}
	};
	xmlhttp.open("GET","php/provide_drug_request.php?action=fill&drug_name="+medicine_name+"&column="+column,true);
	xmlhttp.send();
}

function removeRequestRow(row_id){
	if(row==1)
		alert("There is only 1 row so, you can\'t delete");
	else{
		document.getElementById(row_id).remove();
		row--;
	}
}

function addRequest(){


	var parent = document.getElementById('provide_request_div');
	var row_count = parent.childElementCount;
	var medicine_info = parent.children;

	//var elements = medicine_info[1];

		var name = [];
		var qty = [];
		var expire_date = [];
	//console.log(elements.children[0].children[0].children[0]);
	var medicine = new Array(row_count -1);
	for (var i = 1; i < row_count; i++) {
		var elements = medicine_info[i];
		var drug_name = elements.children[0].children[0].children[0];
		var drug_available_qty = elements.children[0].children[1].children[0];
		var drug_qty = elements.children[0].children[2].children[0];
		var drug_expire_date = elements.children[0].children[3].children[0];

		medicine[i-1] = new MedicineInfo(drug_name.value, drug_qty.value, drug_expire_date.value);
		//console.log("Before Send: "+medicine[i-1].name+":"+ medicine[i-1].quantity+":"+ medicine[i-1].expire_date+"\n");

		// name.push(drug_name);
		// qty.push(drug_qty);
		// expire_date.push(drug_expire_date);
	}
		
		// if(window.XMLHttpRequest)
		// 	xmlhttp = new XMLHttpRequest();
		// else
		// 	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		// xmlhttp.onreadystatechange = function(){
		// 	if(this.readyState == 4 && this.status == 200){
		// 		// if(xmlhttp.responseText == 1)
		// 		// 	success++;
		// 		// else if(xmlhttp.responseText == 0)
		// 		// 	failed++;
		// 		// else
		// 		 	alert(xmlhttp.responseText);
		// 	}
		// };
			// xmlhttp.open("post","php/provide_drug_request.php?action=save_request&drug_name="+name+"&qty="+qty+"&expire_date="+expire_date,true);
			// xmlhttp.send();

	for (var i = 0; i < row_count - 1; i++) {
		//console.log("Sending: "+medicine[i].name+":"+medicine[i].quantity+":"+medicine[i].expire_date+"\n");
		saveRequest(medicine[i].name, medicine[i].quantity,medicine[i].expire_date);
	}
	
	// failed = 0;
	// 		 success = 0;
}

	function saveRequest(name, qty, expire_date){

		var arra = new Array();
		arra.push("one");
		arra.push("two");
		arra.push("three");
		alert("The type is: "+typeof(arra))
		
		if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				 // if(xmlhttp.responseText == 1)
				 // 	alert(success++);
				 // else
				 	alert("Posted is: "+xmlhttp.responseText);
					//alert("Data Inserted Succesfully");
				// if (xmlhttp.responseText == 0) 
				// 	alert("Erro Occured");
			}
		};
			//console.log("Sent: "+name+":"+qty+":"+expire_date+"\n");
			//xmlhttp.open("GET","php/provide_drug_request.php?action=save_request&drug_name="+name+"&qty="+qty+"&expire_date="+expire_date+"&arrays="+arra,true);
			xmlhttp.open("post","php/provide_drug_request.php?arrays="+arra,true);
			xmlhttp.send();
			//alert(success+": Success and "+failed+" Failed");

		// console.log(name+"\n");

		// console.log(qty+"\n");

		// console.log(expire_date+"\n");
			 
	}

$(document).ready(function(){
	//$('#save_provided').click(function(){
		// var parent = document.getElementById('provide_request_div');
		 //var row_count = parent.childElementCount;
		// var medicine_info = parent.children;


		// $(".medicine_name").each(function(){
		// 	if($(this).val() == "")
		// 		$(".provided_qty").focus();
		// 		//$(this).focus();
		// })
		

		// var name = [];
		// var qty = [];
		// var expire_date = [];

		// $(".medicine_name").each(function(){
		// 	name.push($(this).val());
		// });
		// $(".provided_qty").each(function(){
		// 	qty.push($(this).val());
		// });
		// $(".expire_date").each(function(){
		// 	expire_date.push($(this).val());
		// });


		// $.ajax({
		// 	url: 'php/provide_drug_request.php',
		// 	method: 'post',
		// 	data:{dname:name,dqty:qty,dexpire_date:expire_date},
		// 	success:function(response){
		// 		if(response == 1)
		// 			alert("Data Inserted Succesfully");
		// 		else
		// 			alert(response);
		// 	}
		// });
	//});
});
 </script>

 ///////////////////////// other file /////////////////////////////////
 <?php 
			$sql = "SELECT * FROM drug_store;";
			$res = mysqli_query($conn, $sql);
			$resCheck = mysqli_num_rows($res);
			if($resCheck > 0){
			 ?>
			<div class="display_drug">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Amount</th>
							<th>Registered Date</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$i = 1;
						while ($row = mysqli_fetch_assoc($res)) {
						 ?>
						<tr>
							<td><?php echo $i ?></td>
							<td><?php echo $row['drug_name'] ?></td>
							<td><?php echo $row['amount']." ".$row['measure']   ?></td>
							<td><?php echo $row['registered_date']  ?></td>
						</tr>
						<?php 
						$i++;
					}
				}
						 ?>
					</tbody>
				</table>
			</div>


			///// model 20 table ..... ////

			<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $row['drug_name']; ?></td>
							<td><?php echo $row['requested_quantity']; ?></td>
							<td><?php echo $row['requested_date']; ?></td>
							<td><?php echo $row['provided_date']; ?></td>
							<td><?php echo $row['requested_by']; ?></td>
							<td><?php echo $row['comfirmed_by']; ?></td>
						</tr>	

			///// model 21 table ..... ////


						<tr>
				<td><?php echo $i; ?></td>
				<td> <?php echo $row['drug_name'] ; ?> </td>
				<td> <?php echo $row['quantity']." ".$row['measure'] ; ?> </td>
				<td> <?php echo $row['expire_date'] ; ?> </td>
				<td> <?php echo $row['registered_date'] ; ?> </td>
				<td> <button class="btn btn-success">Ditails</button> </td>
				</tr>
