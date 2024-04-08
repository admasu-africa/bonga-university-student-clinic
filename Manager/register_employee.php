<?php 
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Manager"){
  header("location:../index.php");
}
include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Manager | Add employee</title>
	<link rel="stylesheet" type="text/css" href="include/style.css">
		<link rel="stylesheet" type="text/css" href="../include/bootstrap/css/bootstrap.css">
    <script src="../include/bootstrap/js/bootstrap.js"></script>
    <script src="../include/jquery/jquery-3.6.2.js"></script>
     <link rel="stylesheet" type="text/css" href="../include/fontawesome/css/all.css">
	<script src="js/register_employee.js"></script>
</head>
<body>



	<?php include "include/dbc.inc.php"; ?>
		<?php include 'include/side_bar.php'; ?>


     <?php include 'include/navbar.php'; ?>

     <div class="home">

      <div class="text">
        <span class="left_second_header">Manager</span>
        <span class="right_second_header"><i class="fas fa-"></i> Employee/ Add</span>
      </div>
      <hr class="text-primary">
      <div class="row content"> 
        <!--  -->
	      <div class="col col-12 col-md-12">     
	         <div class="inside_text_2">

 	<div class="mb-0">
	  <label for="emp_id" class="form-label">Employee ID</label>
	  <input name="id" type="text" class="form-control" id="emp_id" placeholder="enter employee id" onkeyup="validateId(this.value,'id_error');" onblur="validateId(this.value,'id_error');">
	  <code id="id_error" style="display: none;"></code>
	</div>


<div class="mb-0">
  <label for="fname" class="form-label">First Name</label>
  <input type="text" class="form-control" id="fname" placeholder="employee first name" onkeyup="validateName(this.value,'fname_error');" onblur="validateName(this.value,'fname_error');">
  <code id="fname_error" style="display: none;"></code>
</div>

<div class="mb-0">
  <label for="lname" class="form-label">Last Name</label>
  <input type="text" class="form-control" id="lname" placeholder="employee last name" onkeyup="validateName(this.value,'lname_error');" onblur="validateName(this.value,'lname_error');">
  <code id="lname_error" style="display: none;"></code>
</div>


<div class="mb-0">
 	<label for="position" class="form-label">Position</label>
 	<select class="form-select "  id="position" onchange="validatePosition(this.value,'position_error');" onblur="validatePosition(this.value,'position_error');">
  <option value="">Select Position</option>
  <option value="Doctor">Doctor</option>
  <option value="Pharmacist">Pharmacist</option>
  <option value="Lab technician">Lab Technician</option>
  <option value="Clerk">Clerk</option>
</select>
<code id="position_error" style="display: none;"></code>
</div>

<div class="mb-0">
  <label for="phone_no" class="form-label">Phone Number</label>
  <input type="text" class="form-control" id="phone_no" placeholder="09...." onblur="validatePhonNo(this.value, 'phone_no_error');">
  <code id="phone_no_error" style="display: none;"></code>
</div>

<div class="mb-0">
  <label for="address" class="form-label">Address</label>
  <textarea id="address" class="form-control" rows="3"></textarea>
  <code id="address_error" style="display: none;"></code>
</div>

<div class="mb-0">
  <label for="salary" class="form-label">Salary</label>
  <input type="number" class="form-control" id="salary" placeholder="salary" min="1" onkeyup="validateSalary(this.value, 'salary_error');" onblur="validateSalary(this.value, 'salary_error');">
  <code id="salary_error" style="display: none;"></code>
</div>


	         	
<!-- 		Id: <input type="text" name="id" id="emp_id" onkeyup="validateId(this.value,'id_error');" onblur="validateId(this.value,'id_error');"> <br><br>
		<code id="id_error" style="display: none;"></code>
		First Name: <input type="text" name="fname" id="fname" onkeyup="validateName(this.value,'fname_error');" onblur="validateName(this.value,'fname_error');"> <br><br>
		<code id="fname_error" style="display: none;"></code>
		Last Name: <input type="text" name="lname" id="lname" onkeyup="validateName(this.value,'lname_error');" onblur="validateName(this.value,'lname_error');"> <br><br>
		<code id="lname_error" style="display: none;"></code>
		Position: <select id="position" onchange="validatePosition(this.value,'position_error');" onblur="validatePosition(this.value,'position_error');">
			<option value="">Select Position</option>
			<option value="3">Doctor</option>
			<option value="4">Pharmacist</option>
			<option value="5">Lab Technician</option>
			<option value="6">Clerk</option>
		</select> <br><br>
		<code id="position_error" style="display: none;"></code>
		Phone Number: <input type="text" name="phone_no" id="phone_no" onblur="validatePhonNo(this.value, 'phone_no_error');"> <br><br>
		<code id="phone_no_error" style="display: none;"></code>
		Address: <textarea id="address"></textarea><br><br>
		<code id="address_error" style="display: none;"></code>
		Salary: <input type="number" name="salary" id="salary" min="1" onkeyup="validateSalary(this.value, 'salary_error');" onblur="validateSalary(this.value, 'salary_error');"> <br><br>
		<code id="salary_error" style="display: none;"></code> -->

		<button class="btn btn-success" type="button" name="submit" id="register">Register</button><br>

		<hr class="text-success">

		<div id="display_reg_success">
			
		</div>
	         </div>
	      </div> 

    </div>

    <hr class="text-">

        <?php //include 'include/footer.html'; ?>
  
    </div> 



<script src="js/script.js"></script>
<script type="text/javascript">
	  var subMenu = document.getElementById('subMenu');

	  function toggleMenu(){
	    subMenu.classList.toggle('open-menu');
	  }
</script>

</body>
</html>