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
	<link rel="stylesheet" type="text/css" href="../include/bootstrap/css/bootstrap.css">
	<script src="../include/bootstrap/js/bootstrap.js"></script>
	<script src="../include/jquery/jquery-3.6.2.js"></script>
	<link rel="stylesheet" type="text/css" href="../include/fontawesome/css/all.css">
</head>
<body>

		<?php include 'include/side_bar.php'; ?>


     <?php include 'include/navbar.php'; ?>

     <div class="home">

      <div class="text">
        <span class="left_second_header">Manager</span>
        <span class="right_second_header"><i class="fas fa-home"></i>Edit News</span>
      </div>
      <hr class="text-primary">
      <div class="row content"> 
        <!--  -->
	      <div class="col col-12 col-md-12">     
	         <div class="inside_text">
	         	<div id="display_post_error">
	         		
	         	</div>
	         	
	         	<?php 
			$post_id = $_GET['id'];
			$conn = mysqli_connect('localhost','root','','BUC');
			 $sql = "SELECT * from news where post_id = '$post_id'";
			 $result = mysqli_query($conn, $sql);
			 $resultCheck = mysqli_num_rows($result);
			if($resultCheck > 0){
				?>  
				<form method="POST">
				<?php
				while ($rows = mysqli_fetch_assoc($result)) {
					$header = $rows['header'];
					$content = $rows['content'];
					$posted_date = $rows['posted_date'];
					$access = $rows['view'];
					?>
					<input type="hidden" id="access" value="<?php echo $access; ?>">

					<div class="mb-3">
						<label for="header" class="form-label">Header</label>
						<textarea class="form-control" id="header" rows="2" placeholder="write header in here.." required><?php echo "$header"; ?></textarea>
						<code id="header_error" style="display:none;"></code>
					</div>

					<div class="mb-3">
						<label for="content" class="form-label">Content</label>
						<textarea class="form-control" id="content" rows="5" placeholder="write news contents in here.." required><?php echo "$content"; ?></textarea>
						<code id="content_error" style="display:none;"></code>
					</div>
					<label class="form-label">who should see the post</label>
					<div class="form-check">
						<input class="form-check-input" type="radio" name="view" value="student" id="student" required>
						<label class="form-check-label" for="student">
							Student
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" name="view" value="employee" id="employee">
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


				<!-- 	<textarea id="header" name="header"><?php echo "$header"; ?></textarea>
					<code id="header_error" style="display:none;"></code>
					<textarea id="content" name="content"><?php echo "$content"; ?></textarea>
					<code id="content_error" style="display:none;"></code> -->
					<?php
					
				}
				?>
				<input type="hidden" id="post_id" value="<?php echo $post_id; ?>">
					<input class="btn btn-success" type="button" name="submit" value="Update" id="update_news">
					</form>
				<?php
			}else{
				echo "No News on this Id";
			}
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
      	var access = $("#access").val();
      	if(access == "all")
      		$('#all').attr('checked', true);
      	else if(access == "employee")
      		$('#employee').attr('checked', true);
      	else if(access == "student")
      		$('#student').attr('checked', true);
      	console.log(access);
      	$("#update_news").click(function(){
      		var header = $("#header").val();
      		var content = $("#content").val();
      		var view = $("input[name=view]:checked").val();
      		var post_id = $("#post_id").val();
      		 //console.log(post_id);

      		if(!validateNews(header,'header_error'))
      			$("#header").focus();
      		else if(!validateNews(content,'content_error'))
      			$("#content").focus();
      		else{
      			if(confirm("Are You Sure to Update the post?")){
      				$.ajax({
      				url:'php/update_news.php',
      				method:'post',
      				data:{update:"",header:header,content:content,view:view,post_id:post_id},
      				success:function(response){
      					if(response == 1)
      						location.href = 'view_news.php';
      					else
      						 $('#display_post_error').html("<div class='alert alert-danger'>"+response+"<div>");
      				}
      			});
      			}
      			
      		}

      	});
      });
function validateNews(value,error){
	var result = document.getElementById(error);
	result.style.display = 'block';
	if(value == ""){
		result.innerHTML = "Field Mustn't be Empty to Update!";
		return false;
	}
	result.style.display = 'none';
	return true;
}
</script>


















	<?php include_once "include/header.php"; ?>
	
	<div class="column" style="border: 2px solid blue;">
		
		</div>
	</div>
</div>
</body>
</html>