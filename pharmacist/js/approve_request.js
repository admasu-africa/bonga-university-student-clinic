$(document).ready(function(){
	$("#save_edited").click(function(){
		// if(document.getElementById("mtable").getElementsByTagName('tbody')[0].childNodes[1] != undefined) {
		 if(confirm("Are you sure to Comfirm Request the data listed below?")){
		var store_id = [];
		var id = [];
		var requested_qty = [];
		$(".requested_drug_id").each(function(){
			id.push($(this).text());
		});
		$(".requested_amount").each(function(){
			requested_qty.push($(this).text());
			//console.log($(this).val());
		});
		$(".store_drug_id").each(function(){
			store_id.push($(this).text());
			//console.log($(this).val());
		});

		$.ajax({
			url:'php/approve_request.php',
			method:'post',
			data:{requested_id:id,requested_amount:requested_qty,provided_drug_id:store_id},
			success:function(response){
				if(response == 1){
				$("#success").html("<div class='alert alert-success'>Data Approved Succesfully</div>");
				}
			else
				$("#display_msg_mr").html("<div class='alert alert-danger'>"+response+"</div>");
			}
		});
	 }
	// 	}else{
	// 		alert("Please fill data to Register");
	// 	}	
	});

	$("#select_request").change(function(){
		var value = $(this).val();
		$.ajax({
			url:'php/approve_request.php',
			method:'post',
			data:{value:value},
			success:function(response){
				$("#success").html(response);
		}
	});
});
	});
function refresh(){
	if(window.XMLHttpRequest)
			xmlhttp = new XMLHttpRequest();
		else
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
			document.getElementById('mtable').getElementsByTagName('tbody')[0].innerHTML = xmlhttp.responseText;
			//alert(xmlhttp.responseText);
		}
	};
		xmlhttp.open('GET','php/refresh.php?action=refresh',true);
	 	xmlhttp.send();	
}