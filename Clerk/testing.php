<?php
//include('project/include/include.php');
session_start();
$id = $_GET['id'];
$conn = mysqli_connect('localhost','root','','BUC');
$sql2 = "UPDATE patient SET visit = 1 WHERE id = '$id'";
$res = mysqli_query($conn, $sql2);
	if($res == true){
		$_SESSION['transfer'] = "Transfered to Doctor";
		header("location:search.php");
	}else{
		$_SESSION['transfer'] = "Failed to transfer<br>";
		echo mysqli_error($conn)."<br>";
		header("location:search.php");
	}

