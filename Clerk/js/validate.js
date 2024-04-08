function validateId(id, error){
	var result = document.getElementById(error);
	result.style.display = "block";
  	if(id.trim() == "") {
    result.innerHTML = "Must be filled out!";
    return false;
  }
  // for (var i = 0; i < id.length; i++) 
  // if(!((id[i] >= 'a' && id[i] <= 'z') || (id[i] >= 'A' && id[i] <= 'Z') || id[i] == ' ')){
  //   	result.innerHTML = "Must contain only letters!";
  //       return false;
  //   }
  result.style.display = "none";
  return true;
}
function validateName(name, error){
	var result = document.getElementById(error);
	result.style.display = "block";
  if(name.trim() == "") {
    result.innerHTML = "Must be filled out!";
    return false;
  }
  
  for(var i = 0; i < name.length; i++)
    if(!((name[i] >= 'a' && name[i] <= 'z') || (name[i] >= 'A' && name[i] <= 'Z') || name[i] == ' ')){
    	result.innerHTML = "Must contain only letters!";
        return false;
    }
  result.style.display = "none";
  return true;
}
function validatePhoneNo(value,error){
	var result = document.getElementById(error);
	result.style.display = "block";
  if(value.trim() == "") {
    result.innerHTML = "Must be filled out!";
    return false;
  }
   result.style.display = "none";
  return true;
}
function validateBatch(value,error){
	var result = document.getElementById(error);
	result.style.display = "block";
  if(value.trim() == "") {
    result.innerHTML = "Must be filled out!";
    return false;
  }
  if(value.trim().length < 4 || value.trim().length > 4) {
    result.innerHTML = "Please Enter correct batch / year!";
    return false;
  }
   result.style.display = "none";
  return true;
}
function validateZone(value,error){
	var result = document.getElementById(error);
	result.style.display = "block";
  if(value.trim() == "") {
    result.innerHTML = "Must be filled out!";
    return false;
  }
   result.style.display = "none";
  return true;
}
function validateAge(value,error){
	var result = document.getElementById(error);
	result.style.display = "block";
  if(value.trim() == "") {
    result.innerHTML = "Please Enter Age of student!";
    return false;
  }
  if(value.trim().length < 2 || value.trim().length > 2) {
    result.innerHTML = "Please Enter correct batch / year!";
    return false;
  }
   result.style.display = "none";
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
function validateSex(value, error){
	var result = document.getElementById(error);
	result.style.display = "block";
  if(value == undefined) {
    result.innerHTML = "Please Select Sex!";
    return false;
  }
  result.style.display = 'none';
	return true;
}

$(document).ready(function(){
	$("#register_patient").click(function(){
			document.getElementById('patient_acknowledgment').innerHTML = "";
	var patient_id = document.getElementById('patient_id');
	var patient_fname = document.getElementById('patient_fname');
	var patient_mname = document.getElementById('patient_mname');
	var patient_lname = document.getElementById('patient_lname');
	var patient_dept = document.getElementById('patient_dept');
	var batch = document.getElementById('patient_batch');
	var sex = $("input[name=sex]:checked").val();
	var sex_error = document.getElementById('sex');
	var age = document.getElementById('pateint_age');
	var region = document.getElementById('pateint_region');
	var zone = document.getElementById('patient_zone');
	var kebele = document.getElementById('patient_kebele');
	var phone_no = document.getElementById('phone_no');


	if(!validateId(patient_id.value,'id_error'))
		patient_id.focus();
	else if(!validateName(patient_fname.value,'fname_error'))
		patient_fname.focus();
	else if(!validateName(patient_mname.value,'mname_error'))
		patient_mname.focus();
	else if(!validateName(patient_lname.value,'lname_error'))
		patient_lname.focus();
	else if(!validateName(patient_dept.value,'dept_error'))
		patient_dept.focus();
	else if(!validateBatch(batch.value,'batch_error'))
		batch.focus();
	else if(!validateSex(sex,'sex_error'))// need something
		sex_error.focus();
	else if(!validateAge(age.value,'age_error'))
		age.focus();
	else if(!validateName(region.value,'region_error'))
		region.focus();
	else if(!validateZone(zone.value,'zone_error'))
		zone.focus();
	else if(!validateZone(kebele.value,'kebele_error'))
		kebele.focus();
	else if(!validatePhonNo(phone_no.value,'phone_no_error'))
		phone_no.focus();
	else{
			$.ajax({
				url:'php/register_patient.php',
				method:'post',
				data:{id:patient_id.value,fname:patient_fname.value,lname:patient_lname.value,mname:patient_mname.value,dept:patient_dept.value,batch:batch.value,sex:sex,age:age.value,
							region:region.value,zone:zone.value,kebele:kebele.value,phone_no:phone_no.value},
				success:function(response){
					if(response == 1){
						$("#patient_acknowledgment").html("<div class='text-success'><strong>"+patient_fname.value+" "+patient_mname.value+"</strong> is Registered Successfully and Sent to Doctor </div>");
							 document.getElementById('patient_id').value = "";
							 document.getElementById('patient_fname').value = "";
							 document.getElementById('patient_mname').value = "";
							 document.getElementById('patient_lname').value = "";
							 document.getElementById('patient_dept').value = "";
							 document.getElementById('patient_batch').value = "";
							 document.getElementById('sex').value = "";
							 document.getElementById('pateint_age').value = "";
							 document.getElementById('pateint_region').value = "";
							 document.getElementById('patient_zone').value = "";
							 document.getElementById('patient_kebele').value = "";
							 document.getElementById('phone_no').value = "";
							 $("input[type=radio][name=sex]").prop('checked',false);
					}
					else if(response == 2){
						$("#patient_acknowledgment").html("<div class='text-danger'>Failed to Register "+patient_fname.value+"</div>");
					}else
					$("#patient_acknowledgment").html("<div class='text-danger'>"+response+"</div>");
				}
			});
		}
	 });
});

/////////////// may be /////////////


function addPatient(){
	// document.getElementById('patient_acknowledgment').innerHTML = "";
	// var patient_id = document.getElementById('patient_id');
	// var patient_fname = document.getElementById('patient_fname');
	// var patient_lname = document.getElementById('patient_lname');
	// var patient_dept = document.getElementById('patient_dept');
	
	// var batch = document.getElementById('patient_batch');
	// var region = document.getElementById('pateint_region');
	// var zone = document.getElementById('patient_zone');
	// var kebele = document.getElementById('patient_kebele');
	// var family_phone_no = document.getElementById('patient_family_phone_no');


	// if(!validateId(patient_id.value,'id_error'))
	// 	patient_id.focus();
	// else if(!validateName(patient_fname.value,'fname_error'))
	// 	patient_fname.focus();

	// else if(!validateName(patient_lname.value,'lname_error'))
	// 	patient_lname.focus();
	// else if(!validateName(patient_dept.value,'dept_error'))
	// 	patient_dept.focus();

	// 	else if(!validateBatch(batch.value,'batch_error'))
	// 	batch.focus();

	// else if(!validateName(region.value,'region_error'))
	// 	region.focus();
	// else if(!validateName(zone.value,'zone_error'))
	// 	zone.focus();
	// else if(!validateName(kebele.value,'kebele_error'))
	// 	kebele.focus();
	// else if(!validateName(family_phone_no.value,'phone_no_error'))
	// 	family_phone_no.focus();

	// else{
	// 	if (window.XMLHttpRequest) {
 //    	xmlhttp = new XMLHttpRequest();
	//  	} else {
 //    		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	// 	}

	// 	xmlhttp.onreadystatechange = function(){
	// 		if(this.readyState == 4 && this.status == 200){
	// 			if(this.responseText == 1)
	// 			{
	// 				// document.getElementById('patient_acknowledgment_1').style.color = "red";
	// 				document.getElementById('patient_acknowledgment_1').innerHTML = "Jirra";
	// 			}else
	// 				document.getElementById('patient_acknowledgment').innerHTML = this.responseText;
	// 		}
	// 	};
	// 	xmlhttp.open("GET","php/register_patient.php?id="+patient_id.value+"&fname="+patient_fname.value+"&lname="+patient_lname.value+"&dept="+patient_dept.value,true);
	// 	xmlhttp.send();
	// }


	//alert(patient_dept.value+patient_lname.value+patient_fname.value+patient_id.value);
}