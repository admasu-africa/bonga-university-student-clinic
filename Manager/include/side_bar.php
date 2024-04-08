<?php include '../include/dbc.inc.php'; ?> 
<nav class="sidebar">
      <header>
        <div class="image-text">
          <span class="image">
            <img src="../image/bu.jfif" alt="User Pic">
          </span>
          <d iv class="text header-text">
            <span class="name">Manager</span>
          </div>
        </div>

        <i class="fas fa-angle-right toggle"></i>
      </header>

      <div class="menu-bar">
        <div class="menu">
         <!--  <li class="nav-link">
              <a href="#">
                <i class="fas fa-home"></i>
                <span class="text nav-text">Dashboard</span>
              </a>
            </li> -->
          <ul class="menu-links">
            <li class="nav-link">
              <a href="index.php">
                <i class="fas fa-home icon"></i>
                <span class="text nav-text">Dashboard</span>
              </a>
            </li>
            <!-- <li class="nav-link">
              <a href="view_patient_info.php">
                <i class="fas fa- icon"></i>
                <span class="text nav-text">View Patient info</span>
              </a>
            </li> -->
            <?php $sql = "SELECT * FROM feedback where status = 1";
                  $res = mysqli_query($conn, $sql);
                  $feedback = mysqli_num_rows($res); 
                  if($feedback == 0)
                    $feedback = null; ?>
            <li class="nav-link">
              <a href="view_feedback.php">
                <i class="fas fa-comment icon"></i>
                <span class="text nav-text">view feedback <span class="text-danger" style="background:black;"><?php //echo " ".$feedback; ?></span></span>
              </a>
            </li>
              <?php $sql1 = "SELECT * FROM provide_request where status = 2";
                  $res1 = mysqli_query($conn, $sql1);
                  $approve = mysqli_num_rows($res1); 
                  if($approve == 0)
                    $approve = null; ?>
            <li class="nav-link">
              <a href="approve_request.php">
                <i class="fas fa-folder-open icon"></i>
                <span class="text nav-text"style="font-size: 18px">View drug request<span class="text-danger" style="background: black; color: red"><?php echo " ".$approve; ?></span></span>
              </a>
            </li>

            <li class="nav-link">
                <a href="approve_refer.php">
                  <i class="fas fa-check-double icon"></i>
                  <span class="text nav-text">Approve refer</span>
                </a>
              </li>

              <li class="nav-link">
                <a href="register_employee.php">
                  <i class="fas fa-user-plus icon"></i>
                  <span class="text nav-text">Add employee</span>
                </a>
              </li>
              <li class="nav-link">
                <a href="view_employee.php">
                  <i class="fas fa-user icon"></i>
                  <span class="text nav-text">View employee</span>
                </a>
              </li>
            </li>



              <!-- <li class="header_nav_link"><i class="fas fa-newspaper icon"></i> News<i class="fas fa-angle-right toggle"></i> -->
              <li class="nav-link">
                <a href="post_news.php">
                  <i class="fas fa-upload icon"></i>
                  <span class="text nav-text">Post News</span>
                </a>
              </li>
              
              <li class="nav-link">
                <a href="view_news.php">
                  <i class="fas fa-folder-open icon"></i>
                  <span class="text nav-text">View News</span>
                </a>
              </li>
             <li class="nav-link">
                <a href="generate_report.php">
                  <i class="fas fa-download icon"></i>
                  <span class="text nav-text">Generate Report</span>
                </a>
              </li> 
            <!-- </li> -->

            

          </ul>
          <div class="bottom-content">
            <li class="mode">
              <div class="moon-sun">
                <i class="fas fa-moon icon moon"></i>
                <i class="fas fa-sun icon sun"></i>
              </div>
              <span class="mode-text text">Dark Mode</span>

              <div class="toggle-switch">
                <span class="switch"></span>
              </div>
            </li>
          </div>
        </div>
      </div>
    </nav>
