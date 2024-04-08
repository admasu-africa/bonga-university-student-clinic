<?php include '../include/dbc.inc.php'; ?>
<nav class="sidebar">
      <header>
        <div class="image-text">
          <span class="image">
            <img src="../image/bu.jfif" alt="User Pic">
          </span>
          <d iv class="text header-text">
            <span class="name">Doctor</span>
          </div>
        </div>

        <i class="fas fa-angle-right toggle"></i>
      </header>

      <div class="menu-bar">
        <div class="menu">
          <ul class="menu-links">
            <li class="nav-link">
              <a href="index.php">
                <i class="fas fa-home icon"></i>
                <span class="text nav-text">Dashboard</span>
              </a>
            </li>
            <?php $sql = "SELECT * FROM patient WHERE status = 1";
                  $res = mysqli_query($conn, $sql);
                  $count = mysqli_num_rows($res);
                  if($count == 0)
                    $count = null; ?>
              <li class="nav-link">
                <a href="view_available_patient.php">
                  <i class="fas fa-stethoscope icon"></i>
                  <span class="text nav-text">Need Treat <span class="text-danger" style="background:black; border-radius: 1.8rem;"><?php echo $count; ?></span></span>
                </a>
              </li>
              <?php $sql1 = "SELECT * FROM patient_info WHERE status = 3";
                  $res1 = mysqli_query($conn, $sql1);
                  $count1 = mysqli_num_rows($res1);
                  if($count1 == 0)
                    $count1 = null; ?>
              <li class="nav-link">
                <a href="result.php">
                  <i class="fas fa-microscope icon"></i>
                  <span class="text nav-text">Lab Result <span class="text-danger" style="background:black; border-radius: 1.8rem;"><?php echo $count1; ?></span></span>
                </a>
              </li>
              <?php $sql2 = "SELECT * FROM patient_info WHERE status = 2 or status = 3 or status = 4";
                  $res2 = mysqli_query($conn, $sql2);
                  $count2 = mysqli_num_rows($res2);
                  if($count2 == 0)
                    $count2 = null; ?>
              <li class="nav-link">
                <a href="order.php">
                  <i class="fas fa-sliders-h icon"></i>
                  <span class="text nav-text">Ordered <span class="text-danger" style="background:black; border-radius: 1.8rem;"><?php echo $count2; ?></span></span>
                </a>
              </li>

              <!-- <li class="nav-link">
              <a href="view_patient_info.php">
                <i class="fas fa-newspaper icon"></i>
                <span class="text nav-text">Approved refer</span>
              </a>
            </li> -->

              <li class="nav-link">
              <a href="approved_refer.php">
                <i class="fas fa-newspaper icon"></i>
                <span class="text nav-text">Approved refer</span>
              </a>
            </li>

             <?php $sql3 = "SELECT * FROM patient_info WHERE status = 3";
                  $res3 = mysqli_query($conn, $sql3);
                  $count3 = mysqli_num_rows($res3);
                  if($count3 == 0)
                    $count3 = null; ?>
              <li class="nav-link">
                <a href="view_appointment.php">
                  <i class="fas fa-clock icon"></i>
                  <span class="text nav-text">View Appointment </span></span>
                </a>
              </li>
              <li class="nav-link">
                <a href="give_appointment.php">
                  <i class="fas fa-calendar-alt icon"></i>
                  <span class="text nav-text">Give Appointment</span>
                </a>
              </li>



            <li class="nav-link">
              <a href="view_news.php">
                <i class="fas fa-newspaper icon"></i>
                <span class="text nav-text">View News</span>
              </a>
            </li>
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
