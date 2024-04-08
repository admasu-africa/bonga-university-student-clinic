function fillTheFields(medicine_name){		
		fillFields(medicine_name, 'drug_id','drug_id');
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
			 //console.log("Drug Id is: "+id1.value);
			}	
	};
	xmlhttp.open("GET","php/provide_prescription.php?action=fill&drug_name="+medicine_name+"&column="+column,true);
	xmlhttp.send();
}
function showMedicineOption(txt, id){
	if(window.XMLHttpRequest)
		xmlhttp = new XMLHttpRequest();
	else
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			document.getElementById(id).innerHTML = xmlhttp.responseText;
			document.getElementById('drug_id').value = '';
		}
	};
	xmlhttp.open('GET','php/provide_prescription.php?action=show_drug_list&drug_name='+txt,true);
 	xmlhttp.send();
}
function checkDrugAvailability(medicine_name, id){
	if(window.XMLHttpRequest)
		xmlhttp = new XMLHttpRequest();
	else
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			if(xmlhttp.responseText == 0){
				//document.getElementById(id).innerHTML = xmlhttp.responseText;
			document.getElementById('drug_id').value = '';
		}else
			document.getElementById('drug_id').value = xmlhttp.responseText;
			//console.log(xmlhttp.responseText);
		}
	};
	xmlhttp.open('GET','php/provide_prescription.php?action=is_drug_available&drug_name='+medicine_name,true);
 	xmlhttp.send();
}

function validateName(name, error){
	var result = document.getElementById(error);
	if(name.trim() == ""){
		result.style.display = 'block';
		result.innerHTML = "Must be filled out!";
		return false;
	}
	result.style.display = 'none';
	return true;
}

var edit_row = null;

$(document).ready(function(){
	var count = 0;
	$('#add_prescription').click(function(){

	 	var name = document.getElementById('medicine_name');
		var dose = document.getElementById('dose');
		var description = document.getElementById('description');
	 	var id = document.getElementById('drug_id');

	 	if(!validateName(name.value, 'medicine_name_error'))
	 		name.focus();
	 	else if(!validateName(dose.value, 'dose_error'))
	 		dose.focus();
	  	else if(!validateName(description.value,'description_error'))
		description.focus();
	else{
		if(edit_row == null){
		count++;
		var insert_table = "<tr id='row"+count+"'>";		
			insert_table += "<td class='drug_namet'>"+name.value+"</td>";
			insert_table += "<td class='doset'>"+dose.value+"</td>";
			insert_table += "<td class='descriptiont'>"+description.value+"</td>";
			insert_table += "<td class='drug_idt'>"+id.value+ "</td>";
			insert_table += "<td> <button class='btn btn-primary edit' name='edit' data-row='row"+count+"'>Edit</button>"+
								"<button class='btn btn-danger delete' name='delete' data-row='row"+count+"'>Delete</button> </td>";
			insert_table += "</tr>";
			$("#prtable").append(insert_table);

		}else{


			
	 	var name = document.getElementById('medicine_name').value;
		var dose = document.getElementById('dose').value;
		var description = document.getElementById('description').value;
	 	var id = document.getElementById('drug_id').value;

			document.getElementById(edit_row).childNodes[0].innerHTML = name;
			document.getElementById(edit_row).childNodes[1].innerHTML = dose;
			document.getElementById(edit_row).childNodes[2].innerHTML = description;
			document.getElementById(edit_row).childNodes[3].innerHTML = id;
		}
		resetData();			
	}

	});
	$(document).on('click','.edit',function(){
		 edit_row = $(this).data('row');
		var drug_name = document.getElementById(edit_row).childNodes[0].innerHTML;
		var dose = document.getElementById(edit_row).childNodes[1].innerHTML;
		var description = document.getElementById(edit_row).childNodes[2].innerHTML;
		var id = document.getElementById(edit_row).childNodes[3].innerHTML;

		document.getElementById('medicine_name').value = drug_name;
		document.getElementById('dose').value = dose;
		document.getElementById('description').value = description;
		document.getElementById('drug_id').value = id;

	});

	$(document).on('click','.delete',function(){
				
		var delete_row = $(this).data('row');
		if(confirm("Are You Sure delete the row?"))
			$("#"+delete_row).remove();
		
	});

	$('#save_requested').click(function(){
		if(document.getElementById("prtable").getElementsByTagName('tbody')[0].childNodes[1] != undefined) {
			if(confirm("Are you sure to Request the data listed below?")){
				var drug_name = [];
				var dose = [];
				var description = [];
				var drug_id = [];


				$('.drug_namet').each(function(){
					drug_name.push($(this).text());
				});
				$('.doset').each(function(){
					dose.push($(this).text());
				});
				$('.descriptiont').each(function(){
					description.push($(this).text());
				});
				$('.drug_idt').each(function(){
					drug_id.push($(this).text());
					
				});

				$.ajax({
					url: 'php/provide_prescription.php',
					method: 'post',
					data:{name:drug_name,dose:dose,description:description,id:drug_id}, 
					success:function(response){
						if(response == 1){
							$(".display_msg_pr").html("<div class='alert alert-success'>Request Has been sent successfully</div>");
							document.getElementById('rtable').getElementsByTagName('tbody')[0].innerHTML = "";
						}else
							$(".display_msg_pr").html("<div class='alert alert-danger'>"+response+"</div>");
					}
				});
			}
		}else{
			alert("Please, fill data to Register");
		}	
	});
	$('#save_prescription').click(function(){
		
		if(document.getElementById("prtable").getElementsByTagName('tbody')[0].childNodes[1] == undefined) {
			if(confirm("Are you sure to Finish With out write any prescription?")){
				var id = document.getElementById('pr_stud_id').value;
				var paii = document.getElementById('pr_paii').value;
				var history = document.getElementById('lab_history').value;
				//console.log(id+paii);
				console.log(history);
				$.ajax({
					url: 'php/provide_prescription.php',
					method: 'post',
					data:{stud_id:id,paii:paii,history:history}, 
					success:function(response){
						if(response == 1){
							//$(".display_msg_pr").html("<div class='alert alert-success'>Request Has been sent successfully</div>");
							//document.getElementById('rtable').getElementsByTagName('tbody')[0].innerHTML = "";
							location.href = "view_available_patient.php";
							//console.log("The response is: 1");
						}else
							$(".display_error_msg_pr").html("<div class='alert alert-danger'>"+response+"</div>");
					}
				});
			 }
			}else{
				if(confirm("Are you sure to prescribe the date listed below")){
				var drug_name = [];
				var dose = [];
				var description = [];
				var drug_id = [];

				var id = document.getElementById('pr_stud_id').value;
				var paii = document.getElementById('pr_paii').value;
				var history = document.getElementById('lab_history').value;

				console.log(history);

				$('.drug_namet').each(function(){
					drug_name.push($(this).text());
				});
				$('.doset').each(function(){
					dose.push($(this).text());
				});
				$('.descriptiont').each(function(){
					description.push($(this).text());
				});
				$('.drug_idt').each(function(){
					drug_id.push($(this).text());
					
				});

				$.ajax({
					url: 'php/provide_prescription.php',
					method: 'post',
					data:{student_id:id,paii_s:paii,name:drug_name,dose:dose,description:description,id:drug_id,history:history}, 
					success:function(response){
						if(response == 1){
							//$(".display_msg_pr").html("<div class='alert alert-success'>Request Has been sent successfully</div>");
							//document.getElementById('rtable').getElementsByTagName('tbody')[0].innerHTML = "";
							//alert("ITS Inserted");
							location.href = "view_available_patient.php";
						}else
							$(".display_error_msg_pr").html("<div class='alert alert-danger'>"+response+"</div>");					}
				});
		}
	}	
	});
	
});
function resetData(){
	 	document.getElementById('medicine_name').value = "";
		document.getElementById('dose').value = "";
		document.getElementById('description').value = "";
	 	document.getElementById('drug_id').value = "";
		//document.getElementById('available_qty_measure').innerHTML = "";
		edit_row = null;
}
