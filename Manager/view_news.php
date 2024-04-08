<?php 
session_start();
if(!isset($_SESSION['user_name']) || $_SESSION['position'] != "Manager"){
  header("location:../index.php");
}
include 'include/dbc.inc.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Manager | View News</title>
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
        <span class="right_second_header"><i class="fas fa-newspaper"></i>News/ View</span>
      </div>
      <hr class="text-primary">
      <div class="row content"> 
        <!--  -->
	      <div class="col col-12 col-md-12">     
	         <div class="inside_text_n">
	         	<?php 
							$sql = "SELECT * from news order by posted_date desc";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);
			$output = '';
			if($resultCheck > 0){
				while ($rows = mysqli_fetch_assoc($result)) {
					$header = $rows['header'];
					$content = $rows['content'];
					$posted_date = $rows['posted_date'];
					$access = $rows['view'];
					$post_id = $rows['post_id'];
					?>
					<div class="news">
						<div class="news_header">
							<?php 
							echo $header; 
							?>
							<div id="date">
								<?php echo $posted_date;?>
							</div>
						</div>
						<div class="news_content">
							<?php echo $content; ?>
							<div class="visible_to">
							Visible to : <?php echo $access; ?>
							</div>
						</div>
						<a href="edit_news.php?id=<?php echo $rows['post_id']; ?>"><button class="btn btn-success edit_news">Edit</button></a>		
			<button class='btn btn-danger delete_news' value='<?php echo $post_id; ?>'>Delete</button><br>
					</div>
					<?php
				
				}
			}else
				echo "No News Posted yet";

		 ?>






					<!-- echo "Posted at: ".$posted_date."<br>";
					echo "News: <strong><u>".$header." </u></strong><br>".$content."<br>";
					echo "Allowed to: ".$access."<br>";
					?>
			<a href="edit_news.php?id=<?php //echo $rows['post_id']; ?>"><button class="btn btn-success edit_news">Edit</button></a>		
			<button class='btn btn-danger delete_news' value='<?php //echo $post_id; ?>'>Delete</button><br>
			<?php
			//	}
			//}else
				//echo "No News Posted yet";
				 ?> -->
	         </div>
	      </div> 

    </div>

    <hr class="text-">

        <?php //include 'include/footer.html'; ?>
  
    </div> 

  <div class="modal fade" id="delete_news">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h1>Drug Details</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body" id="display_sdrug_detail">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div> 

    <script src="js/script.js"></script>
       <script type="text/javascript">
      var subMenu = document.getElementById('subMenu');

      function toggleMenu(){
        subMenu.classList.toggle('open-menu');
      }


$(document).ready(function(){
	$(".delete_news").click(function(){
		var post_id = $(this).val();
		// console.log("ID is "+post_id);
		if(confirm("Are You Sure to delete?")){
			$.ajax({
			url:'php/update_news.php',
			method:'post',
			data:{delete:"",post_id:post_id},
			success:function(response){
				if(response == 1)
					refresh();
			}
		});
		}	
	});
});
function refresh(){
	$.ajax({
		url:'php/show_news.php',
			method:'post',
			data:{show:""},
			success:function(response){
				$("#inside_text").html(response);
			}
	});
}
</script>
</body>
</html>