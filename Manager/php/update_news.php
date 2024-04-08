<?php 
session_start();
include '../../include/dbc.inc.php';
if(isset($_POST['update']) && isset($_POST['header']) && isset($_POST['content'])){
	$header  = $_POST['header'];
	$content  = $_POST['content'];
	$post_id = $_POST['post_id'];
	$view = $_POST['view'];

	$sql2 = "UPDATE news set header = '$header', content = '$content', view = '$view' where post_id = '$post_id'";
	$res2 = mysqli_query($conn, $sql2);
	 if($res2)
	 	echo 1;
	 else
	 	echo "Error Occurred".mysqli_error($conn);
}
if(isset($_POST['delete']) && isset($_POST['post_id'])){
	$post_id = $_POST['post_id'];
	$sql = "DELETE FROM news where post_id = '$post_id'";
	$res = mysqli_query($conn,$sql);
	if($res)
		echo 1;
	else
		echo "Error: ".mysqli_error($conn);
}
if(isset($_POST['post'])){
	$header = $_POST['header'];
	$content = $_POST['content'];
	$view = $_POST['view'];
	$manager = $_SESSION['user_id'];
	//echo $header.$content.$view;
	$date = date("Y-m-d h:i:s");
	//$conn = mysqli_connect('localhost','root','','BUC');
	$sql = "INSERT into news(header, content, posted_date,posted_by,view) values('$header', '$content','$date','$manager','$view')";
	if(mysqli_query($conn, $sql)){
		echo 1;
	}else{
		echo mysqli_error($conn);
	}
}

?>