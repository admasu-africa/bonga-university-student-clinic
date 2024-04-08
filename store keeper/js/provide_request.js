function fillTheFields(medicine_name){
		
		fillFields(medicine_name, 'available_qty','quantity');
		fillFields(medicine_name, 'expire_date', 'expire_date');
		fillFields(medicine_name, 'drug_id', 'drug_id');
		fillFields(medicine_name, 'available_qty', 'measure');
		//available_qty_measure
}
function fillFields(medicine_name, id, column){
	var id1 = document.getElementById(id);
	if(window.XMLHttpRequest)
		xmlhttp = new XMLHttpRequest();
	else
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			 if(column == "measure")
				id1.value = id1.value+""+this.responseText;
			else{
				id1.value = this.responseText;
				id1.value.trim();
			}
		}
	};
	xmlhttp.open("GET","php/provide_drug_request.php?action=fill&drug_name="+medicine_name+"&column="+column,true);
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
		}
	};
	xmlhttp.open('GET','php/provide_drug_request.php?action=show_drug_list&drug_name='+txt,true);
 	xmlhttp.send();
}


var edit_row = null;

$(document).ready(function(){
	var count = 0;
	$('#add_request').click(function(){
		//alert("Add request is called");
		console.log("please atgegmibgn");
		var name = document.getElementById('medicine_name');
		var av_qty = document.getElementById('available_qty');
		var req_qty = document.getElementById('required_qty');
		var expire = document.getElementById('expire_date');
		var id = document.getElementById('drug_id');

		console.log(name.value+av_qty.value,req_qty.value,expire.value,id.value);

	 if(!validateMedicine(name.value, 'medicine_name_error'))
	  	name.focus();

	 else if(!checkDrugAvailability(req_qty.value,'required_qty_error'))
		req_qty.focus();

	//  else if(!isRequested(id.value, name.value)){
	// 	console.log("am in if else 2");
	//  	name.focus();	
		
	//  }
	else {
		//console.log("am in else yessss");
		if(edit_row == null){
		count++;
		var insert_table = "<tr id='row"+count+"'>";		
			insert_table += "<td class='drug_name'>"+name.value+"</td>";
			insert_table += "<td class='available_qty'>"+av_qty.value+"</td>";
			insert_table += "<td class='reqiured_qtyt'>"+req_qty.value+"</td>";
			insert_table += "<td class='expire_date'>"+expire.value+"</td>";
			insert_table += "<td class='drug_idt'>"+id.value+ "</td>";
			insert_table += "<td> <button class='btn btn-primary edit' name='edit' data-row='row"+count+"'>Edit</button>"+
								"<button class='btn btn-danger delete' name='delete' data-row='row"+count+"'>Delete</button> </td>";
			insert_table += "</tr>";
			$("#rtable").append(insert_table);

		}else{


			
			var name = document.getElementById('medicine_name').value;
			var av_qty = document.getElementById('available_qty').value;
			var req_qty = document.getElementById('required_qty').value ;
			var expire = document.getElementById('expire_date').value;
			var id = document.getElementById('drug_id').value;

			document.getElementById(edit_row).childNodes[0].innerHTML = name;
			document.getElementById(edit_row).childNodes[1].innerHTML = av_qty;
			document.getElementById(edit_row).childNodes[2].innerHTML = req_qty;
			document.getElementById(edit_row).childNodes[4].innerHTML = id;
		}
		resetData();			
	}

	});
	$(document).on('click','.edit',function(){
		 edit_row = $(this).data('row');
		var drug_name = document.getElementById(edit_row).childNodes[0].innerHTML;
		var drug_qty = document.getElementById(edit_row).childNodes[1].innerHTML;
		var require_qty = document.getElementById(edit_row).childNodes[2].innerHTML;
		var expire = document.getElementById(edit_row).childNodes[3].innerHTML;
		var id = document.getElementById(edit_row).childNodes[4].innerHTML;

		document.getElementById('medicine_name').value = drug_name;
		document.getElementById('available_qty').value = drug_qty;
		document.getElementById('required_qty').value = require_qty;
		document.getElementById('expire_date').value = expire;
		document.getElementById('drug_id').value = id;

	});

	$(document).on('click','.delete',function(){
				
		var delete_row = $(this).data('row');
		if(confirm("Are You Sure delete the row?"))
			$("#"+delete_row).remove();
		
	});

	$('#save_requested').click(function(){
		if(document.getElementById("rtable").getElementsByTagName('tbody')[0].childNodes[1] != undefined) {
			if(confirm("Are you sure to Request the data listed below?")){
				//var drug_name = [];
				var reqiured_qty = [];
				//var expire_date = [];
				var drug_id = [];

				// $('.drug_name').each(function(){
				// 	drug_name.push($(this).text());
				// });
				$('.reqiured_qtyt').each(function(){
					reqiured_qty.push($(this).text());
				});
				// $('.expire_date').each(function(){
				// 	expire_date.push($(this).text());
				// });
				$('.drug_idt').each(function(){
					drug_id.push($(this).text());
					
				});

				$.ajax({
					url: 'php/provide_drug_request.php',
					method: 'post',
					data:{id:drug_id,qty:reqiured_qty}, 
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
	
});
function resetData(){
		document.getElementById('medicine_name').value = "";
		document.getElementById('available_qty').value = "";
		document.getElementById('required_qty').value = "";
		document.getElementById('expire_date').value = "";
		document.getElementById('drug_id').value = "";
		//document.getElementById('available_qty_measure').innerHTML = "";
		edit_row = null;
}

function isRequested(medicine_id, name){
	 	//var error = document.getElementById('medicine_name_error');
	 	//var name = document.getElementById('medicine_name');

	if(window.XMLHttpRequest)
		xmlhttp = new XMLHttpRequest();
	else
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");

		xmlhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			if (this.responseText == 1) {
				// error.style.display = 'block';
				// error.innerHTML = medicine_id+": is already requested";			
				document.getElementById('display_msg_pr').innerHTML = "<div class='alert alert-danger'>Drug<strong> "+name+"</strong> is requested Previously</div>";
				//name.focus();
				return false;
			}else{
					//error.style.display = 'none';
					return true;
			}
		}
	};
	xmlhttp.open('GET','php/provide_drug_request.php?action=is_drug_requested&drug_id='+medicine_id,true);
 	xmlhttp.send();	



}