<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="images/profile.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        Admasu Bashu
        <p><?php //echo $user['firstname'].' '.$user['lastname']; ?></p>
        <a><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">

      <li class=""><a href="home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <li class=""><a href="search.php"><i class="fa fa-search"></i></span> <span>Search</span></a></li>

      <li class=""><a href="registration.php"><i class="fa fa-registered"></i> <span>Register</span></a></li>
      <li class=""><a href="view_news.php"><i class="fa fa-black-tie"></i> <span>News</span></a></li>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
<?php include 'config_modal.php'; ?>