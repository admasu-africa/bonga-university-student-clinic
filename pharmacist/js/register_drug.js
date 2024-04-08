var edit_row = null;	
		$(document).ready(function(){				
			var count = 0;
			var a = 0;
			$("#add_drug").click(function(){
				var drug_name = document.getElementById('drug_name');
				var drug_qty = document.getElementById('drug_qty');
				var drug_measure = document.getElementById('drug_measure');
				var drug_batch_no = document.getElementById('drug_batch_no');
				var drug_expire_date = document.getElementById('drug_expire_date');

				if (!validateName(drug_name.value, 'drug_name_error'))
					drug_name.focus();
				else if(!validateQty(drug_qty.value,'drug_qty_error'))
					drug_qty.focus();
				else if(!validateMeasure(drug_measure.value,'drug_measure_error'))
					drug_measure.focus();
				else if(!validateBatchNo(drug_batch_no.value, 'drug_batch_no_error'))
					drug_batch_no.focus();
				else if(!validateDate(drug_expire_date.value, 'drug_expire_date_error'))
					drug_expire_date.focus();
				else{
					if(edit_row == null){
				count += 1;
				var drug_name = document.getElementById('drug_name').value;
				var drug_qty = document.getElementById('drug_qty').value;
				var drug_measure = document.getElementById('drug_measure').value;
				var drug_batch_no = document.getElementById('drug_batch_no').value;
				var drug_expire_date = document.getElementById('drug_expire_date').value;

				var insert_table = "<tr id='row"+count+"'>";
					insert_table += "<td>"+count+"</td>";
					insert_table += "<td class='drug_name'>"+drug_name+"</td>";
					insert_table += "<td class='drug_qty'>"+drug_qty+"</td>";
					insert_table += "<td class='drug_measure'>"+drug_measure+"</td>";
					insert_table += "<td class='drug_batch_no'>"+drug_batch_no+"</td>";
					insert_table += "<td class='drug_expire_date'>"+drug_expire_date+"</td>";
					insert_table += "<td> <button class='btn btn-primary edit' name='edit' data-row='row"+count+"'>Edit</button>"+
										"<button class='btn btn-danger delete' name='delete' data-row='row"+count+"'>Delete</button> </td>";
					insert_table += "</tr>";
					$("#tbl").append(insert_table);
				}else{
					var drug_name = document.getElementById('drug_name').value;
					var drug_qty = document.getElementById('drug_qty').value;
					var drug_measure = document.getElementById('drug_measure').value;
					var drug_batch_no = document.getElementById('drug_batch_no').value;
					var drug_expire_date = document.getElementById('drug_expire_date').value;


					 document.getElementById(edit_row).childNodes[1].innerHTML = drug_name;
					 document.getElementById(edit_row).childNodes[2].innerHTML = drug_qty;
					 document.getElementById(edit_row).childNodes[3].innerHTML = drug_measure;
					 document.getElementById(edit_row).childNodes[4].innerHTML = drug_batch_no;
					 document.getElementById(edit_row).childNodes[5].innerHTML = drug_expire_date;


					}
					resetData();
				}
				
			});
			$(document).on('click','.edit',function(){
				 edit_row = $(this).data('row');
				var drug_name = document.getElementById(edit_row).childNodes[1].innerHTML;
				var drug_qty = document.getElementById(edit_row).childNodes[2].innerHTML;
				var drug_measure = document.getElementById(edit_row).childNodes[3].innerHTML;
				var drug_batch_no = document.getElementById(edit_row).childNodes[4].innerHTML;
				var drug_expire_date = document.getElementById(edit_row).childNodes[5].innerHTML;
				document.getElementById('drug_name').value = drug_name;
				document.getElementById('drug_qty').value = drug_qty;
				document.getElementById('drug_measure').value = drug_measure;
				document.getElementById('drug_batch_no').value = drug_batch_no;
				document.getElementById('drug_expire_date').value = drug_expire_date;
			});

			$(document).on('click','.delete',function(){
				
				var delete_row = $(this).data('row');
				// alert("row to remove :"+delete_row);
				if(confirm("Are You Sure delete the row?"))
					$("#"+delete_row).remove();
				
			});

			$("#register").click(function(){
				if(document.getElementById("tbl").getElementsByTagName('tbody')[0].childNodes[1] != undefined) {
				if(confirm("Are you sure to Register the data listed below?")){
				var drug_name = [];
				var drug_qty = [];
				var drug_measure = [];
				var drug_batch_no = [];
				var drug_expire_date = [];

				$(".drug_name").each(function(){
					drug_name.push($(this).text());
				});

				$(".drug_qty").each(function(){
					drug_qty.push($(this).text());
				});

				$(".drug_measure").each(function(){
					drug_measure.push($(this).text());
				});

				$(".drug_batch_no").each(function(){
					drug_batch_no.push($(this).text());
				});

				$(".drug_expire_date").each(function(){
					drug_expire_date.push($(this).text());
				});

				$.ajax({
					url: 'php/save_drug_db.php',
					method: 'post',
					data:{name:drug_name,qty:drug_qty,measure:drug_measure,batch_no:drug_batch_no,expire_date:drug_expire_date},
					success:function(response){
						if(response == 1){
							alert("Data Inserted Succesfully");
							document.getElementById("tbl").getElementsByTagName('tbody')[0].innerHTML = "";
						}else{
							alert(response);
						}
						
					}
				});

					}
				}else{
					alert("Please fill data to Register");
				}
				
			});
		});

		function resetData(){
			document.getElementById('drug_name').value = "";
			document.getElementById('drug_qty').value = "";
			document.getElementById('drug_measure').value = "";
			document.getElementById('drug_batch_no').value = "";
			document.getElementById('drug_expire_date').value = "";
			edit_row = null;
		}