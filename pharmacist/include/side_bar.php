<?php include '../include/dbc.inc.php'; ?>
<nav class="sidebar">
      <header>
        <div class="image-text">
          <span class="image">
            <img src="../image/bu.jfif" alt="User Pic">
          </span>
          <d iv class="text header-text">
            <span class="name">Pharmacist</span>
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
            
                <?php $sql = "SELECT * FROM patient_info WHERE status = 4";
                  $res = mysqli_query($conn, $sql);
                  $count = mysqli_num_rows($res);
                  if($count == 0)
                    $count = null; ?>
            <li class="nav-link">
              <a href="order.php">
                <i class="fas fa-folder-open icon"></i>
                <span class="text nav-text">View Order 
                  <span class="text-danger" style="background:black; border-radius: 1.8rem;"><?php echo $count; ?></span></span>
              </a>
            </li>

               <?php $sql1 = "SELECT * FROM provide_request WHERE status = 3";
                  $res1 = mysqli_query($conn, $sql1);
                  $count1 = mysqli_num_rows($res1);
                  if($count1 == 0)
                    $count1 = null; ?>
              
              <li class="nav-link">
                <a href="register_provided_to_pharmacy.php">
                  <i class="fas fa-registered icon"></i>
                  <span class="text nav-text">Register drug
                    <span class="text-danger" style="background:black; border-radius: 1.8rem;"><?php echo $count1; ?></span></span>
                </a>
              </li>
              <li class="nav-link">
                <a href="provide_request.php">
                  <i class="fas fa-flask icon"></i>
                  <span class="text nav-text">Request Drug</span>
                </a>
              </li>
              <li class="nav-link">
                <a href="store_drug_information.php">
                  <i class="fas fa-store icon"></i>
                  <span class="text nav-text">Store drug info</span>
                </a>
              </li>




            <li class="nav-link">
                <a href="drug_information.php">
                  <i class="fas fa-plus-square icon"></i>
                  <span class="text nav-text">Pharmacy info</span>
                </a>
              </li>
            
            <li class="nav-link">
              <a href="model_22.php">
                <i class="fas fa-print icon"></i>
                <span class="text nav-text">Print Model</span>
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
