function validateStart(date, error){
	var result = document.getElementById(error);
	result.style.display = 'block';
	if(date.trim() == ""){
		result.innerHTML = "Mustn't be empty!";
		return false;
	}
	if(new Date(date) == new Date()){
		result.innerHTML = "Start date must be lessthan today";
		return false;
	}
	if(new Date(date) > new Date()){
		result.innerHTML = "Start date mustn't be future";
		return false;
	}
	result.style.display = 'none';
	return true;
}
function validateEnd(date, error){
	var result = document.getElementById(error);
	result.style.display = 'block';
	if(date.trim() == ""){
		result.innerHTML = "Mustn't be empty!";
		return false;
	}
	if(new Date(date) > new Date()){
		result.innerHTML = "End date mustn't be future";
		return false;
	}
	result.style.display = 'none';
	return true;
}
function validateBoth(start,end, error){
	var result = document.getElementById(error);
	result.style.display = 'block';
	if((new Date(start) - new Date(end)) == 0){
		result.innerHTML = "Start and end date can't be the same day";
		return false;
	}
	if(new Date(start) > new Date(end)){
		result.innerHTML = "Start date mustn't be greater than end date";
		return false;
	}
	result.style.display = 'none';
	return true;
}