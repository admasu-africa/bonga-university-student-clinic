<?php include 'include/header.php';
include 'include/dbc.inc.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php //include 'include/navbar.php';
        //include 'include/menubar.php'; ?>
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="mb-3">
        Search 
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-search"></i> Search</a></li>
        <li class="active">Search</li>
      </ol>
    </section>
<?php if(isset($_SESSION['transfer'])){
        if($_SESSION['transfer'] == 1)
          echo "<h3 class='text-success'>Transfered to Doctor </h3>";
        else
          echo "<h3 class='text-danger'>".$_SESSION['transfer']."</h3>";
          unset($_SESSION['transfer']);
      } ?>

<div class="mx-3">

    Enter Search value: <input type="text" name="search_stud" id="search_txt" placeholder="Enter stud ID or Name">
    <?php $sqlt = "select * from patient";
      $rest = mysqli_query($conn, $sqlt);
      $resCht = mysqli_num_rows($rest); ?>
    <table class="table" id="table1">
      <thead>
        <tr>
        <th>#</th>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Dept</th>
        <th>R.Date</th>
        <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        if($resCht > 0){
          $i = 1;
          while ($rowt = mysqli_fetch_assoc($rest)) {
         ?>
        <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $rowt['student_id']; ?></td>
        <td><?php echo $rowt['fname']; ?></td>
        <td><?php echo $rowt['lname']; ?></td>
        <td><?php echo $rowt['dept']; ?></td>
        <td><?php echo $rowt['registered_date']; ?></td>
        <td><a href="../Clerk/php/transfer_to_doctor.php?id=<?php echo $rowt['student_id']; ?>"><button class="btn btn-primary">Send</button></a></td>
        </tr>
      <?php $i++;}} ?>
      </tbody>

    </table>
    <?php //include 'include/scripts.php'; ?>
    </div>
</div>

  




  </div>
  <script type="text/javascript">
$(document).ready(function (){
  //alert("wow its working");
  $("#search_txt").keyup(function(){
    var search = $(this).val().trim();
    //alert(search);
    $.ajax({
      url:'php/search_value.php',
      method:'post',
      data:{action:search},
      success:function(response){
      $("#table1").html(response);
        //alert("its working till now");
      }
    });
  });
});

</script>
</body>

