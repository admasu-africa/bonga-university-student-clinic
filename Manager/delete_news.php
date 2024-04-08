<?php 
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Manager"){
  header("location:../index.php");
}
include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Manager | Edit News</title>
	<link rel="stylesheet" type="text/css" href="include/style.css">
</head>
<body>
	<?php include_once "include/header.php"; ?>
	
	<div class="column" style="border: 2px solid blue;">
		<?php 
		$id = $_GET['id'];
			$conn = mysqli_connect('localhost','root','','BUC');
			$sql = "select * from news where post_id = '$id'";
			$result = mysqli_query($conn, $sql);
			if($result == true){
			$resultCheck = mysqli_num_rows($result);
			if($resultCheck > 0){
				?>  
				<form action="" method="POST">
				<?php
				while ($rows = mysqli_fetch_assoc($result)) {
					$header = $rows['header'];
					$content = $rows['content'];
					$posted_date = $rows['posted_date'];
					$access = $rows['view'];
					?>
					<textarea name="header"><?php echo "$header"; ?></textarea>
					<textarea name="content"><?php echo "$content"; ?></textarea>
					<?php
					
				}
				?>
					<input type="submit" name="submit" value="Delete">
					</form>
				<?php
			}else{
				echo "0 Result";
			}
		}else{
			echo "Error: ".mysqli_error($conn);
		}

		if (isset($_POST['submit'])) {
			$header1 = $_POST['header'];
			$content1 = $_POST['content'];

			echo "Header: $header1 <br>";
			echo "Content: $content1<br>";
		}
		 ?>
		</div>
	</div>
</div>
</body>
</html>