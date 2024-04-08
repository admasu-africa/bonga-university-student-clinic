<?php include '../include/dbc.inc.php'; 
$output = "Its called ";
if(isset($_POST['create'])){
$output .= "Its setted ";
$current_date = date("Y-m-d");
  $current_time = date("H:i:s");
  $notified_date = date("Y-m-d H:i:s");
  $sql3 = "SELECT date(notification.notified_date) FROM notification where date(notification.notified_date) = '$current_date';";
  $res3 = mysqli_query($conn, $sql3);
  $resCheck3 = mysqli_num_rows($res3);
  $output .= $resCheck3." ";
  if ($resCheck3 < 1) { 
    $output .= "Today not notified ";        
      $sql = "SELECT * FROM drug_store where expire_date > '$current_date' and quantity > 0";
      $res = mysqli_query($conn, $sql);
       $result = mysqli_num_rows($res);	
        if($result > 0){
         $output .= "There is expired date is greater than today"; 
         while ($row = mysqli_fetch_assoc($res)) {
            $expire_date = strtotime($row['expire_date']);
            $current_date = strtotime(date("Y-m-d"));
            $diff = $expire_date - $current_date;
            $x = abs(floor($diff / (60 * 60 * 24)));
            if($x <= 30){
             $output .= "There is a drug expire soon";
              $notification = "The Drug ".$row['drug_name']." is only ".$x." Days to expire";

                $sql2 = "INSERT INTO notification values('$notification','$notified_date',1)";
                $res2 = mysqli_query($conn, $sql2);
               }
                       
            }
        }

  }else
    $output .= "Today notified";
}
echo $output;
 ?>