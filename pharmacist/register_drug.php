<?php 
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Pharmacist"){
  header("location:../index.php");
}
include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Pharmacist | Register Drug</title>
	<script src="js/validate.js"></script>
</head>
<body>
	<?php include_once "include/header.php"; ?>

	<div class="column" style="border: 2px solid blue;">

		<?php require 'section/register_drug.html'; ?>

		</div>
	</div>
</div>

	<script src="js/register_drug.js"></script>	


</body>
</html>