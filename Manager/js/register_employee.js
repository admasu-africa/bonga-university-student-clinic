function validateId(value,error){	
	var result = document.getElementById(error);
	result.style.display = 'block';
	if(value.trim() == ""){
		result.innerHTML = "Must be filled out!";
		return false;
	}
	result.style.display = 'none';
	return true;
}
function validateName(value,error){
	var result = document.getElementById(error);
	result.style.display = 'block';
	if(value.trim() == ""){
		result.innerHTML = "Must be filled out!";
		return false;
	}
	for (var i = 0; i < value.length; i++) {
		if(!((value[i] >= 'a' && value[i] <= 'z') || (value[i] >= 'A' && value[i] <= 'Z')) || value[i] == ' '){
			result.innerHTML = "Must contain only letters!";
			return false;
		} 
	}
	result.style.display = 'none';
	return true;
}
function validatePosition(value, error){
	var result = document.getElementById(error);
		result.style.display = 'block';
		if(value == ''){
			result.innerHTML = "Please Select Position";
			return false;
		}
		result.style.display = 'none';
		return true;
}

function validatePhonNo(value,error){
	var result = document.getElementById(error);
	result.style.display = 'block';
	//console.log(value.trim().charAt(0));
	if(value.trim() == ""){
		result.innerHTML = "Must be filled out!";
		return false;
	}
	if(value.trim().charAt(0) != '0' || value.trim().charAt(1) != '9'){
		result.innerHTML = "Please start your number with 09";
		return false;
	}
	if(value.trim().length < 10 || value.trim().length > 10){
		result.innerHTML = "The length of phone number must be 10";
		return false;
	}
	result.style.display = 'none';
	return true;
}
function validateAddress(value,error){
	var result = document.getElementById(error);
	result.style.display = 'block';
	if(value.trim() == ""){
		result.innerHTML = "Must be filled out!";
		return false;
	}
	result.style.display = 'none';
	return true;
}
function validateSalary(value,error){
	var result = document.getElementById(error);
	result.style.display = 'block';
	if(value == ''){
		result.innerHTML = "Must be filled out!";
		return false;
	}
	if(value <= 0){
		result.innerHTML = "Invalid salary!";
		return false;
	}
	result.style.display = 'none';
	return true;
}
$(document).ready(function(){
	$("#register").click(function(){
		var employee_id = document.getElementById('emp_id');
		var fname = document.getElementById('fname');
		var lname = document.getElementById('lname');
		var position = document.getElementById('position');
		var phone_number = document.getElementById('phone_no');
		var address = document.getElementById('address');
		var salary  = document.getElementById('salary');

		if(!validateId(employee_id.value, 'id_error'))
			employee_id.focus();
		else if(!validateName(fname.value,'fname_error'))
			fname.focus();
		else if(!validateName(lname.value,'lname_error'))
			lname.focus();
		else if(!validatePosition(position.value,'position_error'))
			position.focus();
		else if(!validatePhonNo(phone_number.value,'phone_no_error'))
			phone_number.focus();
		else if(!validateAddress(address.value,'address_error'))
			address.focus();
		else if(!validateSalary(salary.value, 'salary_error'))
			salary.focus();
		else{
			$.ajax({
				url:'php/register_employee.php',
				method: 'post',
				data:{register:"register",id:employee_id.value,fname:fname.value,lname:lname.value,position:position.value,phone_no:phone_number.value,address:address.value,salary:salary.value},
				success:function(response){
					if(response == 1){
						$("#display_reg_success").html("<div class='text-success'><strong>"+fname.value+" "+lname.value+"</strong> is Registered Successfully</div>");
							document.getElementById('emp_id').value = "";
							document.getElementById('fname').value = "";
							document.getElementById('lname').value = "";
							document.getElementById('position').value = "";
							document.getElementById('phone_no').value = "";
							document.getElementById('address').value = "";
							document.getElementById('salary').value = "";
					}
					else if(response == 2){
						$("#display_reg_success").html("<div class='text-danger'>Failed to Register "+fname.value+"</div>");
					}else
					$("#display_reg_success").html("<div class='text-danger'>"+response+"</div>");
				}
			});
		}

	});
	$("#update_emp_info").click(function(){
		var employee_id = document.getElementById('emp_id_1');
		var fname = document.getElementById('fname_1');
		var lname = document.getElementById('lname_1');
		var position = document.getElementById('position_1');
		var phone_number = document.getElementById('phone_no_1');
		var address = document.getElementById('address_1');
		var salary  = document.getElementById('salary_1');

		if(!validateId(employee_id.value, 'id_error_1'))
			employee_id.focus();
		else if(!validateName(fname.value,'fname_error_1'))
			fname.focus();
		else if(!validateName(lname.value,'lname_error_1'))
			lname.focus();
		else if(!validatePosition(position.value,'position_error_1'))
			position.focus();
		else if(!validatePhonNo(phone_number.value,'phone_no_error_1'))
			phone_number.focus();
		else if(!validateAddress(address.value,'address_error_1'))
			address.focus();
		else if(!validateSalary(salary.value, 'salary_error_1'))
			salary.focus();
		else{
			if(confirm("Are You Sure to Update?")){
				$.ajax({
				url:'php/register_employee.php',
				method: 'post',
				data:{update:"",id:employee_id.value,fname:fname.value,lname:lname.value,position:position.value,phone_no:phone_number.value,address:address.value,salary:salary.value},
				success:function(response){
					if(response == 1){
						alert("Updated Successfully");
						location.href = '../manager/view_employee.php';
					}
					else if(response == 2){
						$("#display_update").html("<div class='text-danger'>Failed to Update "+fname.value+" Check ID no</div>");
					}else
						$("#display_update").html("<div class='text-danger'>"+response+"</div>");
				}
			});
			}
			
		}

	});
	
});