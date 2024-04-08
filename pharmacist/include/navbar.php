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
          <?php 
              $sql = "SELECT * FROM notification where status = 1";
              $res = mysqli_query($conn,$sql);
              $result = mysqli_num_rows($res);
              if($result == 0)
                $result = null;
             ?>
      <span class="notification" onclick="document.getElementById('subMenu1').classList.toggle('open-menu')">
          <span><i class="fas fa-bell"></i></span>
          <sup class="text-danger" style="font-weight:bolder;"><?php echo $result; ?></sup>
        </span>
<!-- onclick="toggles('subMenu')" onclick="toggles('subMenu1');"-->
        <span class="profile" onclick="document.getElementById('subMenu').classList.toggle('open-menu')">
          <span>
            <?php echo $_SESSION['user_name']." ".$_SESSION['user_lname']; ?></span>
            <i class="fas fa-angle-down"></i>
        </span>
        </span>

        <div class="sub-menu-wrap" id="subMenu">
          <div class="sub-menu">
            <div class="user-info">
               <h3><?php echo $_SESSION['user_name']." ".$_SESSION['user_lname']; ?></h3>
            </div>

            <hr>

            <a href="../include/change_password.php" class="sub-menu-link" id="edit_profile">
              <i class="fas fa-user-edit" id="edit_icon"></i>
              <p>change password</p>
            </a>

            <a href="logout.php" class="sub-menu-link">
              <i class="fas fa-sign-out-alt icon" id="logout_icon"></i>
              <p>Logout</p>
              
            </a>

          </div>
        </div>

        <div class="sub-menu-wrap-notify" id="subMenu1">
          <div class="sub-menu">
            <?php 
                if($result > 0){
                  ?>
                  <button class="btn btn-danger" id="clear_notified">Clear</button>
                  <?php
                    while ($row = mysqli_fetch_assoc($res)) {
                      ?>
                       <a href="#" class="sub-menu-link">
                        <p><?php echo $row['notification']; ?></p>
                    </a>
                    <?php
                  }

                }else{
                ?>
                    <span>No Notification</span>
                  <?php
                }
               ?>
           

            <!-- <a href="#" class="sub-menu-link">
              <p>Notification two</p>
            </a>
             <a href="#" class="sub-menu-link">
              <p>Notification three</p>
            </a>

             <a href="#" class="sub-menu-link">
              <p>Notification four</p>
            </a> -->


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
        profile Picture <br>
        Name: <input type="text" id="fname">
        Last Name: <input type="text" id="fname">
        Employee ID: <input type="text" id="fname">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> 
<script type="text/javascript">
  $(document).ready(function(){
    $(".profile").click(function(){
      // $("#subMenu").css("max-height","400px");    
      $(".sub-menu-wrap").addClass("open-menu");
      $(".sub-menu-wrap").removeClass("closes");
      $(".sub-menu-wrap-notify").addClass("closes");

    });
    $(".notification").click(function(){
      // $("#subMenu").css("max-height","400px");
      $(".sub-menu-wrap-notify").addClass("open-menu");
      $(".sub-menu-wrap-notify").removeClass("closes");
      $(".sub-menu-wrap").addClass("closes");
    });
    $(".home").click(function(){
      $(".sub-menu-wrap").addClass("closes");
      $(".sub-menu-wrap-notify").addClass("closes");
    });
    $(".left_header").click(function(){
      $(".sub-menu-wrap").addClass("closes");
      $(".sub-menu-wrap-notify").addClass("closes");
    });
    $("#clear_notified").click(function(){
      $.ajax({
        url:'php/seen_notification.php',
        method:'post',
        data:{clear:""},
        success:function(response){
           console.log("Cleared");
        }
      });
    })
  });
  function toggles(id){
    // if(id == "subMenu1"){
    //   document.getElementById("subMenu1").classList.toggle('open-menu');
    //   document.getElementById("subMenu").classList.toggle('closes');
    //   console.log("subMenu 1 is called");
    // }
    // else if(id == "subMenu"){
    //   document.getElementById("subMenu").classList.toggle('open-menu');
    //   document.getElementById("subMenu1").classList.toggle('closes');
    //   console.log("subMenu is called else");
    // }
  }
</script>