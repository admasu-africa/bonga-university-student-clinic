<div class="header_navbar">
      <div class="left_header">
        <img src="../image/bu_header.jpeg">
        <span>BU Student Clinic Management System</span>
      </div>
      <div class="left_header_little">
        <img src="../image/bu_header.jpeg">
        <span>BUSCMS</span>
      </div>
      <div class="right_header">
        <span class="profile" onclick="document.getElementById('subMenu').classList.toggle('open-menu')">

          <span>
            <?php echo $_SESSION['user_name']." ".$_SESSION['user_lname']; ?></span>
            <i class="fas fa-angle-down"></i>
        </span>


        <div class="sub-menu-wrap" id="subMenu">
          <div class="sub-menu">
            <div class="user-info">
              <h3><?php echo $_SESSION['user_name']." ".$_SESSION['user_lname']; ?></h3>
            </div>

            <hr>

            <a href="../include/change_password.php" class="sub-menu-link" id="change_password">
              <i class="fas fa-user-edit" id="edit_icon"></i>
              <p>change password</p>
            </a>

            <a href="logout.php" class="sub-menu-link" >
              <i class="fas fa-sign-out-alt icon" id="logout_icon"></i>
              <p>Logout</p>
            </a>

          </div>
        </div>
 
      </div>
    </div>
 <div class="modal fade" id="edit_profile_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h1>Edit Profile</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="chng_pass_div">
          <!-- <form> -->
          Old Password: <input type="password" name="old_pass" id="old_pass"><br>
          New Password:<input type="password" name="new" id="new"><br>
          Repeat:<input type="password" name="repeat" id="repeat"><br>
          <code id="password_error" style="display:none;"></code>
          <span class="text-success" style="display:none;" id="pass_success"></span>
          <button class="btn btn-success" id="save_pass" onclick="documentTesting();">Save Change</button>
          <!-- </form> -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>  
<script type="text/javascript">
  function documentTesting(){
      

    }
  $(document).ready(function(){
    
    // $("#change_password").click(function(){
    //   $("#edit_profile_modal").modal("show");
    // });
    // $("#chng_profile").click(function(){
    //   $("#chng_profile_div").css("display","block");
    // });
    // $("#chng_pass").click(function(){
    //   $("#chng_pass_div").css("display","block");
    // });
    //  $(".home").click(function(){
    //   $(".sub-menu-wrap").addClass("closes");
    // });
    // $(".left_header").click(function(){
    //   $(".sub-menu-wrap").addClass("closes");
    // });
    // $("#save_pass").click(function(){
    //     var old_pass = document.getElementById("old_pass").value;
    //   var new_pass = document.getElementById("new").value;
    //   var repeat_pass = document.getElementById("repeat").value;

    //   if(!validatePass(new_pass,repeat_pass))
    //     $("#new").focus();
    //     else{
    //        //console.log("You are on co");
    //     $.ajax({
    //       url:'../include/change_password.php',
    //       method:'post',
    //       data:{old_password:old_pass,new_password:new_pass},
    //       success:function(response){
    //         if(response == 1){
    //           // $("#pass_success").css("display","block");
    //           // $("#pass_success").text("Password Updated successfully");
    //           alert("Password Updated Successfully");
    //         }else if(response == 2){
    //          $("#password_error").text("Password Doesn't match");
    //         }else{
    //            $("#password_error").text(response);
    //           console.log(response);
    //         }     
            
    //       }

    //     });
        // $("#edit_profile_modal").modal("hide");
      });
        
    //});
   //});

 function validatePass(new_pass, repeat_passe){
  var result = document.getElementById("password_error");
  result.style.display = "block";
  if(new_pass == "" || old_pass == ""){
    result.innerHTML = "All fields Must be fill!";
    return false;
  }
  if(new_pass != repeat_passe){
    result.innerHTML = "Repeated Password Doesn't match!";
    document.getElementById("new").value = "";
    document.getElementById("repeat").value = "";
    document.getElementById("old_pass").value = "";
    return false;
  }
  
  result.style.display = "none";
  return true;
 } 
</script>