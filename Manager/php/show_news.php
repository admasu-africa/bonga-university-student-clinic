	<?php include "../include/dbc.inc.php"; 
	if(isset($_POST['show'])){
			$sql = "select * from news";
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
					$output .= "Posted at: ".$posted_date."<br>";
					$output .= "News: <strong><u>".$header." </u></strong><br>".$content."<br>";
					$output .= "Allowed to: ".$access."<br>";
			$output .= "<a href='edit_news.php?id=".$post_id."'><button class='btn btn-success' name='edit'>Edit</button></a>";
			$output .= "<button class='btn btn-danger delete_news' value='".$rows['post_id']."'>Delete</button><br>";
				}
			}else
				$output .= "No News Posted yet";
		echo $output;	
	}else
	echo "Its called by the news";		
 ?>