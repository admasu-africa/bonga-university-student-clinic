<?php 
	session_start();
	if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Admin"){
  header("location:../index.php");
}
	include '../include/dbc.inc.php';
 ?>
  	<form>
      Enter Old Password: <input type="password" name="old_pass" id="old_pass" required><br>
      Enter New Password:<input type="password" name="new" id="new" required><br>
      Repeat New Password:<input type="password" name="repeat" id="repeat" required><br>
      <code id="password_error" style="display:none;"></code>
      <span class="text-success" style="display:none;" id="pass_success"></span>
      <button class="btn btn-success" name="save_update_pass" id="save_pass">Update password</button>
    </form>

    <?php 
    if(isset($_POST['save_update_pass'])){

    }
 ?> 