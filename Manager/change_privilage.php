<?php  session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Manager"){
  header("location:../index.php");
}
include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change Password</title>
    <link rel="stylesheet" type="text/css" href="include/style.css">
	<link rel="stylesheet" type="text/css" href="../include/bootstrap/css/bootstrap.css">
	<script src="../include/bootstrap/js/bootstrap.js"></script>
	<script src="../include/jquery/jquery-3.6.2.js"></script>
	<link rel="stylesheet" type="text/css" href="../include/fontawesome/css/all.css">
    <script src="js/register_employee.js"></script>
    <style type="text/css">
        body{
            /*background: #111;*/
        }
        #change_previlage{
            margin: 100px;
            /*width: 50%;*/
            align-items: center;
        }
    </style>
</head>
<body>
    <div id="change_previlage">
        <div class="container">
        	<div id="display_update">
        		
        	</div>
        	<?php 
        	if(!isset($_GET['emp_id']))
        		header("location:index.php");
        	else{
        		$emp_id = $_GET['emp_id'];
        		$_SESSION['chng_emp_id'] = $emp_id;
        	}
        	$sql = "SELECT * FROM employee WHERE employee_id = '$emp_id'";
        	$res = mysqli_query($conn, $sql);
        	$resCheck = mysqli_num_rows($res);
        	if($resCheck > 0){
        		while ($row = mysqli_fetch_assoc($res)) {
        		
        	 ?>
        	 <input type="hidden" id="the_position_1" value="<?php echo $row['position']; ?>">
            <!-- <form method="POST"> -->
            	<div class="mb-3">
            		<label for="emp_id_1" class="form-label">Employee ID</label>
					  <input name="id" type="text" class="form-control" id="emp_id_1" placeholder="enter employee id" onkeyup="validateId(this.value,'id_error_1');" onblur="validateId(this.value,'id_error_1');" value="<?php echo $emp_id; ?>">
					  <code id="id_error_1" style="display: none;"></code>
            	</div>
              <div class="mb-3">
                <label for="fname_1" class="form-label">First Name</label>
				  <input type="text" class="form-control" id="fname_1" placeholder="employee first name" onkeyup="validateName(this.value,'fname_error_1');" onblur="validateName(this.value,'fname_error_1');" value="<?php echo $row['fname']; ?>">
				  <code id="fname_error_1" style="display: none;"></code>
            </div>
            <div class="mb-3">
                 <label for="lname_1" class="form-label">Last Name</label>
				  <input type="text" class="form-control" id="lname_1" placeholder="employee last name" onkeyup="validateName(this.value,'lname_error_1');" onblur="validateName(this.value,'lname_error_1');" value="<?php echo $row['lname']; ?>">
				  <code id="lname_error_1" style="display: none;"></code>
            </div>
            <div class="mb-3">
                	<label for="position_1" class="form-label">Position</label>
				 	<select class="form-select " id="position_1" onchange="validatePosition(this.value,'position_error_1');" onblur="validatePosition(this.value,'position_error_1');">
				  <option value="">Select Position</option>
				  <option value="Doctor">Doctor</option>
				  <option value="Pharmacist">Pharmacist</option>
				  <option value="Storekeeper">Storekeeper</option>
				  <option value="Lab technician">Lab Technician</option>
				  <option value="Clerk">Clerk</option>
				</select>
				<code id="position_error_1" style="display: none;"></code>
            </div>
            <div class="mb-3">
            	<label for="phone_no_1" class="form-label">Phone Number</label>
				  <input type="text" class="form-control" id="phone_no_1" placeholder="09...." onblur="validatePhonNo(this.value, 'phone_no_error_1');" value="<?php echo $row['phone_no']; ?>">
				  <code id="phone_no_error_1" style="display: none;"></code>
            </div>
            <div class="mb-3">
            	<label for="address_1" class="form-label">address</label>
				  <textarea id="address_1" class="form-control" rows="3"><?php echo $row['address']; ?></textarea>
				  <code id="address_error_1" style="display: none;"></code>
            </div>
            <div class="mb-3">
            	<label for="salary_1" class="form-label">Salary</label>
				  <input type="number" class="form-control" id="salary_1" placeholder="salary" min="1" onkeyup="validateSalary(this.value, 'salary_error_1');" onblur="validateSalary(this.value, 'salary_error_1');" value="<?php echo $row['salary'] ?>">
				  <code id="salary_error_1" style="display: none;"></code>
            </div>
            <button type="button" class="btn btn-primary" name="update" id="update_emp_info">Update</button>
            <button type="button" class="btn btn-danger" name="cancel" id="cancel">Cancel</button>
        <!-- </form> -->
        <?php
        }
        	}else
        	echo "Unknown Employee ID ".$emp_id;
        ?>
    </div>
</div>
</body>
</html>
<?php 

// if(isset($_POST)){
//         echo "<script> console.log('Its submitted');</script>";
// }

?>
<script type="text/javascript">
    $(document).ready(function(){
    	var the_position = $("#the_position_1").val();
    	console.log(the_position);
    	$('#position_1').val(the_position).attr("selected", "selected");

        $("#cancel").click(function(){
            $.ajax({
                url:'../include/cancel_pass_change.php',
                method:'post',
                data:{cancel:"cancel"},
                success:function(response){
                    location.href=response;
                }
            });
        });
    });
</script>