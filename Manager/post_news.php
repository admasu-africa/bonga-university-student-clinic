<?php 
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Manager"){
  header("location:../index.php");
}
include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Manager | Post News</title>
	<link rel="stylesheet" type="text/css" href="include/style.css">
	<link rel="stylesheet" type="text/css" href="../include/bootstrap/css/bootstrap.css">
	<script src="../include/bootstrap/js/bootstrap.js"></script>
	<script src="../include/jquery/jquery-3.6.2.js"></script>
	<link rel="stylesheet" type="text/css" href="../include/fontawesome/css/all.css">
</head>

</body>
<?php include "include/dbc.inc.php"; ?>
<?php include 'include/side_bar.php'; ?>


<?php include 'include/navbar.php'; ?>

<div class="home">

	<div class="text">
		<span class="left_second_header">Manager</span>
		<span class="right_second_header"><i class="fas fa-newspaper"></i>Post news</span>
	</div>
	<hr class="text-primary">
	<div class="row content"> 
		<!--  -->
		<div id="display_post_error1">

		</div>
		<div class="col col-12 col-md-12">     
			<div class="inside_text">

				<form action="" method="post">
					<div class="mb-3">
						<label for="header" class="form-label">News Header</label>
						<textarea class="form-control" id="header" rows="2" placeholder="write header in here.." required></textarea>
						<code id="header_error1" style="display:none;"></code>
					</div>

					<div class="mb-3">
						<label for="content" class="form-label">News Content</label>
						<textarea class="form-control" id="content" rows="5" placeholder="write news contents in here.." required></textarea>
						<code id="content_error1" style="display:none;"></code>
					</div>
					<!-- Header:<br>
					<textarea required id="header"></textarea><br>
					<code id="header_error1" style="display:none;"></code> -->
					<!-- Content:<br>
					<textarea required id="content" cols="50" rows="5"></textarea><br>
					<code id="content_error1" style="display:none;"></code> -->
					<label class="form-label">who should see the post</label>
					<div class="form-check">
						<input class="form-check-input" type="radio" value="student" name="view" id="student" required>
						<label class="form-check-label" for="student">
							Student
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" value="employee" name="view" id="employee" >
						<label class="form-check-label" for="employee">
							Employee
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" name="view" value="all" id="all">
						<label class="form-check-label" for="all">
							All
						</label>
					</div>
					<code id="view_error" style="display:none;"></code>
					

					<!-- who should see the post:<br>
					<div id="view">
						<input type="radio" name="view" value="all" required>all 
						<input type="radio" name="view" value="employee">employee 
						<input type="radio" name="view" value="patient">patient <br>
						<code id="view_error" style="display:none;"></code>
					</div> -->
					<input class="btn btn-primary" type="button" name="submit" id="post" value="Post">
				</form>
				<?php
			//መምህራን በሙሉ
			//እንኳን ለብርሃነ መስቀሉ በሰላም አድረሳችሁ
			// if(isset($_POST['submit'])){
			// 	$header = $_POST['headers'];
			// 	$content = $_POST['content'];
			// 	$view = $_POST['view'];
			// 	$date = date("Y-m-d h:i:s");
			// 	//echo "<u><strong>".$header."</strong></u><br>".$content."<br>".$view."<br>";
			// 	$conn = mysqli_connect('localhost','root','','BUC');
			// 	$sql = "insert into news(header, content, posted_date,posted_by,view) values('$header', '$content','$date','BUE002','$view')";
			// 	if(mysqli_query($conn, $sql)){
			// 		//echo "News Is Posted";
			// 		header(("location:view_news.php"));
			// 	}else{
			// 		echo mysqli_error($conn);
			// 	}
			// }
				?>	
			</div>
		</div> 

	</div>

	<hr class="text-">

	<?php //include 'include/footer.html'; ?>

</div> 



<script src="js/script.js"></script>
<script type="text/javascript">
	var subMenu = document.getElementById('subMenu');

	function toggleMenu(){
		subMenu.classList.toggle('open-menu');
	}

	$(document).ready(function(){
		$("#post").click(function(){
			var header = $("#header").val();
			var content = $("#content").val();
			var view = $("input[name=view]:checked").val();
			// var post_id = $("#post_id").val();
      		 //console.log(header+content+view);

      		 if(!validateNews(header,'header_error1'))
      		 	$("#header").focus();
      		 else if(!validateNews(content,'content_error1'))
      		 	$("#content").focus();
      		 else if(!validateView(view,'view_error'))
      		 	$("#view").focus();
      		 else{
      		 	$.ajax({
      		 		url:'php/update_news.php',
      		 		method:'post',
      		 		data:{post:"",header:header,content:content,view:view},
      		 		success:function(response){
      		 			if(response == 1){
      		 				alert("News Posted");
      		 				location.href = 'view_news.php';
      		 			}
      		 			else
      		 				$('#display_post_error1').html("<div class='alert alert-danger'>"+response+"<div>");
      		 		}
      		 	});
      		 }

      		});
	});
	function validateNews(value,error){
		var result = document.getElementById(error);
		result.style.display = 'block';
		if(value == ""){
			result.innerHTML = "Field Must be fill!";
			return false;
		}
		result.style.display = 'none';
		return true;
	}
	function validateView(value,error){
		var result = document.getElementById(error);
		result.style.display = 'block';
		if(value == undefined){
			result.innerHTML = "Please select who should see the post";
			return false;
		}
		result.style.display = 'none';
		return true;
	}
</script>

</body>
</html>