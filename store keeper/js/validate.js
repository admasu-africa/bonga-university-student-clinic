function validateName(name, error){
	var result = document.getElementById(error);
	result.style.display = 'block';
	if(name.trim() == ""){
		result.innerHTML = "Must be filled out!";
		return false;
	}
	for (var i = 0; i < name.length; i++) {
		if(!((name[i] >= 'a' && name[i] <= 'z') || (name[i] >= 'A' && name[i] <= 'Z')) || name[i] == ' '){
			result.innerHTML = "Must contain only letters!";
			return false;
		} 
	}
	result.style.display = 'none';
	return true;
}
function validateDrugName(name, error){
	var result = document.getElementById(error);
	result.style.display = 'block';
	if(name.trim() == ""){
		result.innerHTML = "Must be filled out!";
		return false;
	}
	result.style.display = 'none';
	return true;
}
function validateQty(qty, error){
	var result = document.getElementById(error);
	result.style.display = 'block';

	if(qty == ""){
		result.innerHTML = "Must be filled out!";
		return false;
	}
	if(qty <= 0 || !Number.isInteger(parseFloat(qty))){
		result.innerHTML = "Invalid Quantity!";	
		return false;
	}
	result.style.display = 'none';
	return true;
}
function validateMeasure(measure, error){
		var result = document.getElementById(error);
		result.style.display = 'block';
		if(measure == 'default'){
			result.innerHTML = "Please Select Measure of Drug";
			return false;
		}
		result.style.display = 'none';
		return true;
}
function validateBatchNo(batch, error){
	  var result = document.getElementById(error);
	  result.style.display = "block";
	  if(batch == ""){
		result.innerHTML = "Must be filled out!";
		return false;
	}
	result.style.display = 'none';
		return true;
}
function validateDate(date, error) {
  var result = document.getElementById(error);
  if(date == ""){
  	 result.style.display = "block";
    result.innerHTML = "Mustn't be empty!!";
     return false;
  }
  if(new Date(date) <= new Date()){
  	 result.style.display = "block";
     result.innerHTML = "The drug is already expired";
     return false;
  } 
    result.style.display = "none";
    return true;

 
}
function checkDrugAvailability(req, error){
	var required_error = document.getElementById(error);
	//var req_qty = document.getElementById('required_qty').value;
	var av_qty = document.getElementById('available_qty').value;

	if(req == ""){
		required_error.style.display = 'block';
		required_error.innerHTML = "Must be filled out!";
		return false;
	}
	if (req < 0) {
		required_error.style.display = 'block';
		required_error.innerHTML = "Invalid Quantity!";
		return false;
	}
	if (Number.parseInt(req) > Number.parseInt(av_qty) ) {
		required_error.style.display = 'block';
		required_error.innerHTML = "Only "+av_qty+" in store";
		return false;
	}
	required_error.style.display = 'none';
	return true;
}

function validateMedicine(medicine, error){
	var name = document.getElementById("medicine_name");
	var error = document.getElementById(error);
		if(name.value.trim() == ""){
				error.style.display = 'block';
				error.innerHTML = "Please fill the field";
				return false;
			}
		if(window.XMLHttpRequest)
		xmlhttp = new XMLHttpRequest();
		else
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		xmlhttp.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
				if (xmlhttp.responseText != 1) {
					error.style.display = 'block';
					error.innerHTML = xmlhttp.responseText;
					document.getElementById('medicine_name').value = "";
					document.getElementById('available_qty').value = "";
					document.getElementById('required_qty').value = "";
					document.getElementById('expire_date').value = "";
					//document.getElementById('required_qty_measure').innerHTML = "";
				return false;
				}
		}
	};
	xmlhttp.open('GET','php/provide_drug_request.php?action=is_drug_available&drug_name='+medicine,true);
 	xmlhttp.send();	

	error.style.display = 'none';
	return true;
}

