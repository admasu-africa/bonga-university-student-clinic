
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
          <span><?php echo $_SESSION['user_name']." ".$_SESSION['user_lname']; ?></span>
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

            <a href="logout.php" class="sub-menu-link">
              <i class="fas fa-sign-out-alt"></i>
              <p>Logout</p>
              
            </a>

          </div>
        </div>
      </div>
    </div>
