$(document).ready(function(){
	//console.log("Give Drug is working");
	$(".remark").change(function(){
		var value = $(this).val();
		if(value == 2)
			$(this).val(4);
		else
			$(this).val(2);
		// console.log("Its changed:"+value);
	});
	$("#give_drug").click(function(){
		//console.log('submit clicked');
		if (confirm("Are You Sure to Submit?")) {
			var student_id = document.getElementById('student_id').value;
			var paii = document.getElementById('paii').value;
			var drug_id = [];
			// var drug_name = [];
			var dose = [];
			// var description = [];
			var status = [];

			$(".drug_id").each(function(){
				drug_id.push($(this).val());
				// console.log($(this).val());
			});
			// $(".drug_name").each(function(){
			// 	drug_name.push($(this).val());
			// 	// console.log($(this).val());
			// });
			$(".dose").each(function(){
				dose.push($(this).val());
				// console.log($(this).val());
			});
			// $(".description").each(function(){
			// 	description.push($(this).val());
			// 	// console.log($(this).val());
			// });
			$(".remark").each(function(){
				status.push($(this).val());
				 // console.log($(this).val());
			});
			$.ajax({
				url: 'php/give_drug.php',
				method: 'post',
				data:{student_id:student_id,paii:paii,did:drug_id,dosage:dose,status:status},
				success:function(response){
					if(response == 1)
						location.href = '../store keeper/order.php';
					else{
						$("#display_pr_error_msg").html("<div class='alert alert-danger'>"+response+"</div>")
					}
				}
			});
		}
	});
});