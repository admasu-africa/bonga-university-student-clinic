$(document).ready(function(){
	$("#approve_request").click(function(){
		if(confirm("Are you sure to Approve Request listed below?")){
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
			url:'php/save_approved_request.php',
			method:'post',
			data:{requested_id:id,provided_drug_id:store_id,requested_amount:requested_qty},
			success:function(response){
				if(response == 1){
				$("#success").html("<div class='alert alert-success'>Data Approved Succesfully</div>");
				}
			else
				$("#display_msg_appr").html("<div class='alert alert-danger'>"+response+"</div>");
			}
		});
	 }
	});
});