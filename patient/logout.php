<?php 
session_start();
if(isset($_SESSION['student_name'])){
	unset($_SESSION['student_name']);
	unset($_SESSION['student_mname']);
	unset($_SESSION['student_id']);
	header("location:../index.php");
 }
?>