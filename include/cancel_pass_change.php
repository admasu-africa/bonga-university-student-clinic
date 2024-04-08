<?php 
session_start();
	if(isset($_POST['cancel'])){
		$location = '';
		if($_SESSION['position'] == "Admin"){
           $location .= "../admin/index.php";
           
       }
       else if($_SESSION['position'] == "Manager"){
           $location .= "../manager/index.php";
           
       }
       else if($_SESSION['position'] == "Doctor"){
           $location .= "../doctor/index.php";
           
       }
       else if($_SESSION['position'] == "Pharmacist"){
           $location .= "../pharmacist/index.php";
           
       }
       else if($_SESSION['position'] == "Lab technician"){
           $location .= "../lab technician/index.php";
           
       }
       else if($_SESSION['position'] == "Clerk"){
           $location .= "../clerk/index.php";
           
       }
       else if($_SESSION['position'] == "Storekeeper"){
           $location .= "../store keeper/index.php";
           
       }

       echo $location;
	}
 ?>