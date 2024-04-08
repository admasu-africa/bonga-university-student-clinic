function validate(value, error){
	var result = document.getElementById(error);
	result.style.display = "block";
  	if(value.trim() == "") {
    result.innerHTML = "Must be filled out!";
    return false;
  }
  result.style.display = "none";
  return true;
}
$(document).ready(function(){
    $("#save_referal").click(function(){
    var to = document.getElementById('refer_to');
    var cc = document.getElementById('cc');
    var brief_hx_diagnosis = document.getElementById('brief_hx_diagnosis');
    var pe = document.getElementById('pe');
    var investigation_done = document.getElementById('investigation_done');
    // var assesment = document.getElementById('assesment');
    var treatment_given = document.getElementById('treatment_given');
    var reason_for_referal = document.getElementById('reason_for_referal');
    var student_id = document.getElementById('student_id').value;

    if(!validate(to.value,'refer_to_error'))
        to.focus();
    else if(!validate(cc.value,'cc_error'))
        cc.focus();
    else if(!validate(brief_hx_diagnosis.value,'brief_hx_diagnosis_error'))
        brief_hx_diagnosis.focus();
    else if(!validate(pe.value,'pe_error'))
        pe.focus();
    else if(!validate(investigation_done.value,'investigation_done_error'))
        investigation_done.focus();
    // else if(!validate(assesment.value,'assesment_error'))
    //     assesment.focus();
    else if(!validate(treatment_given.value,'treatment_given_error'))
        treatment_given.focus();
    else if(!validate(reason_for_referal.value,'reason_for_referal_error'))
        reason_for_referal.focus();
    else{
        if(confirm("Are You Sure to Submit refer listed below?")){
            $.ajax({
            url:'php/save_referal.php',
            method:'post',
            data:{to:to.value,cc:cc.value,brief_hx_diagnosis:brief_hx_diagnosis.value,pe:pe.value,investigation_done:investigation_done.value,
                student_id:student_id,treatment_given:treatment_given.value,reason_for_referal:reason_for_referal.value},
                success:function(response){
                    if(response == 1){
                        alert("Refer is given successfully");
                        location.href = '../Doctor/order.php';
                    }
                    else
                        alert(response);
                }
        });
        }
        
    }

    });
});
