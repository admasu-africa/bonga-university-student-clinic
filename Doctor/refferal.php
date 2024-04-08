<?php  session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Doctor"){
  header("location:../index.php");
}
include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Write Refferal</title>
    <link rel="stylesheet" type="text/css" href="include/style.css">
	<link rel="stylesheet" type="text/css" href="../include/bootstrap/css/bootstrap.css">
	<script src="../include/bootstrap/js/bootstrap.js"></script>
	<script src="../include/jquery/jquery-3.6.2.js"></script>
	<link rel="stylesheet" type="text/css" href="../include/fontawesome/css/all.css">
    <script src="js/write_referal.js"></script>
    <style type="text/css">
        body{
            /*background: #111;*/
        }
        #write_refferal{
            margin: 100px;
            /*width: 50%;*/
            align-items: center;
        }
    </style>
</head>
<body>
    <div id="write_refferal">
        <div class="container">
        	<div id="display_update">
        		
        	</div>
        	<?php 
        	if(!isset($_GET['stud_id']))
        		header("location:index.php");
        	else{
        		$stud_id = $_GET['stud_id'];
        	}
        	$sql = "SELECT * FROM patient WHERE student_id = '$stud_id'";
        	$res = mysqli_query($conn, $sql);
        	$resCheck = mysqli_num_rows($res);
        	if($resCheck > 0){
        		while ($row = mysqli_fetch_assoc($res)) {
        		
        	 ?>

             <table class="table">
                 <thead>
                     <tr>
                         <th>Student ID</th>
                         <th>First Name</th>
                         <th>Last Name</th>
                     </tr>
                 </thead>
                 <tbody>
                     <tr>
                         <td><?php echo $stud_id; ?></td>
                         <td><?php echo $row['fname']; ?></td>
                         <td><?php echo $row['mname']; ?></td>
                     </tr>
                 </tbody>
             </table>

            	<div class="mb-3">
            		<label for="refer_to" class="form-label">To</label>
					  <input name="id" type="text" class="form-control" id="refer_to" placeholder="refer to" value="TO G/TSADIK SHAWO GENERAL HOSPITAL">
					  <code id="refer_to_error" style="display: none; font-size: 15px;"></code>
            	</div>
              <div class="mb-3">
                <label for="cc" class="form-label">C/C</label>
				  <input type="text" class="form-control" id="cc" placeholder="enter c/c" >
				  <code id="cc_error" style="display: none; font-size: 15px;"></code>
            </div>
            <div class="mb-3">
                 <label for="brief_hx_diagnosis" class="form-label">Brief HX and Diagnosis</label>
                  <textarea class="form-control rows-3" id="brief_hx_diagnosis" placeholder="enter here hx and Diagnosis"></textarea>
				  <code id="brief_hx_diagnosis_error" style="display: none; font-size: 15px;"></code>
            </div>
            <div class="mb-3">
                 <label for="pe" class="form-label">P/E (Patient finding)</label>
                  <textarea class="form-control rows-3" id="pe" placeholder="enter P/E (Patient finding)"></textarea>
                  <code id="pe_error" style="display: none; font-size: 15px;"></code>
            </div>
            <div class="mb-3">
                 <label for="investigation_done" class="form-label">Investigation Done</label>
                  <textarea class="form-control rows-3" id="investigation_done" placeholder="enter investigation"></textarea>
                  <code id="investigation_done_error" style="display: none; font-size: 15px;"></code>
            </div>
            <!-- <div class="mb-3">
                <label for="assesment" class="form-label">Assessement</label>
                  <input type="text" class="form-control" id="assesment" placeholder="enter assesment">
                  <code id="assesment_error" style="display: none; font-size: 15px;"></code>
            </div> -->
            <div class="mb-3">
                <label for="treatment_given" class="form-label">Treatment Given</label>
                  <input type="text" class="form-control" id="treatment_given" placeholder="enter given treatment">
                  <code id="treatment_given_error" style="display: none; font-size: 15px;"></code>
            </div>
            <div class="mb-3">
                <label for="reason_for_referal" class="form-label">Reason for referal</label>
                  <input type="text" class="form-control" id="reason_for_referal" placeholder="referal reason">
                  <code id="reason_for_referal_error" style="display: none; font-size: 15px;"></code>
            </div>
            <input type="hidden" id="student_id" value="<?php echo $stud_id; ?>">
            <button type="button" class="btn btn-primary" name="update" id="save_referal">Submit</button>
            <button type="button" class="btn btn-danger" name="cancel" id="cancel">Cancel</button>
        <!-- </form> -->
        <?php
        }
        	}else
        	echo "Unknown Employee ID ".$stud_id;
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
    	//console.log(the_position);
    	//$('#position_1').val(the_position).attr("selected", "selected");
        var student_id = document.getElementById('student_id').value;

        $("#cancel").click(function(){
            if(confirm("Are You Sure to Cancel refer")){
                $.ajax({
                url:'php/cancel_refer.php',
                method:'post',
                data:{student_id:student_id},
                success:function(response){
                    if(response == 1)
                        location.href='order.php';
                    else
                        alert(response);
                }
            });
            }
            
        });
    });
</script>