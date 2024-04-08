<?php include '../include/dbc.inc.php'; 
if(isset($_POST['search'])){
$current_date = date("Y-m-d");
  $current_time = date("H:i:s");
  //echo "$current_time <br>";
  $notified_date = date("Y-m-d H:i:s");
  // if($current_time > '05:10:00')
  // 	 echo "Its good";
$sql = "SELECT * FROM drug_store where expire_date > '$current_date'";
$res = mysqli_query($conn, $sql);
 $result = mysqli_num_rows($res);	
  if($result > 0){
   while ($row = mysqli_fetch_assoc($res)) {
      $expire_date = strtotime($row['expire_date']);
      $current_date = strtotime(date("Y-m-d"));
      $diff = $expire_date - $current_date;
      $x = abs(floor($diff / (60 * 60 * 24)));
      //echo "The Drug ".$row['drug_name']." is only ".$x." Days to expire";
      if($x <= 150 && $current_time = '06:00:00'){
      	//echo "<br>Its in if statement<br>";
        $sql1 = "SELECT employee_id from employee WHERE position = 4";
        $res1 = mysqli_query($conn, $sql1);
        $notification = "The Drug ".$row['drug_name']." is only ".$x." Days to expire";
        //echo "<br>$notification<br>";
        //$res1Check = mysqli_num_rows
        while ($row = mysqli_fetch_assoc($res1)) {	
        	$employee = $row['employee_id'];
        	 //echo "<br>$employee<br>";
        	$sql2 = "INSERT INTO notification values('$employee','$notification','$notified_date',1)";
        	$res2 = mysqli_query($conn, $sql2);
        }
        
      }
   }

  }
 }
 ?>