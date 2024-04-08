<?php include '../include/dbc.inc.php'; ?>
<nav class="sidebar">
      <header>
        <div class="image-text">
          <span class="image">
            <img src="../image/bu.jfif" alt="User Pic">
          </span>
          <d iv class="text header-text">
            <span class="name" style="font-size: 22px;">Lab Technician</span>
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
            <?php $sql = "SELECT * FROM patient_info WHERE status = 2";
                  $res = mysqli_query($conn, $sql);
                  $count = mysqli_num_rows($res);
                  if($count == 0)
                    $count = null; ?>
            <li class="nav-link">
              <a href="order.php">
                <i class="fas fa-folder-open icon"></i>
                <span class="text nav-text">Order <span class="text-danger" style="background:black; border-radius: 1.8rem;"><?php echo $count; ?></span></span>
              </a>
            <li class="nav-link">
              <a href="view_news.php">
                <i class="fas fa-newspaper icon"></i>
                <span class="text nav-text">News</span>
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
