$(document).ready(function(){
	$('#edit_request').click(function(){
		// var edit_row = $(this).data('row');
		// var show = document.getElementById(edit_row).childNodes[2];
		// //$("td[contentEditable='true']")
		// //$(show).html("contentEditable='true'");
		// document.getElementById(edit_row).childNodes[0].innerHTML = "true";
		// document.getElementById(edit_row).childNodes[2].focus();
		//alert(show);

		// alert("Its called bro");
		// var edit_row = $(this).data('row');
		// var name = document.getElementById(edit_row).childNodes[1].innerHTML;
		// var av_qty = document.getElementById(edit_row).childNodes[2].innerHTML;
		// var req_qty = document.getElementById(edit_row).childNodes[3].innerHTML;
		// var expire = document.getElementById(edit_row).childNodes[4].innerHTML;
		// //document.getElementById('editable_name').value
		// //$('#editable_name').val() = name;
		// console.log("If this display i dont know what i have to do");
	});
	$("#save_edited").click(function(){
		var counts = 0;
		//alert("Save edited is clicked");
		$(".edit_table").each(function(){
			counts++;
		});
		alert(counts);
	});
	$(document).on('click','.delete',function(){
				
		var delete_row = $(this).data('row');
		if(confirm("Are You Sure delete the row?")){
			cellName = document.getElementById(delete_row).childNodes[1].innerHTML;
			alert(cellName);
			// $.ajax({
			// 	url:'php/delete_value',
			// 	method:'post',
			// 	data:{cellName:cellName},
			// 	success:function(response){
			// 		//or find another way Admasu
			// 	}
			// });
			//$("#"+delete_row).remove();
		}
		
	});

});