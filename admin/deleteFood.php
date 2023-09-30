<?php 
	include('../cn/constants.php');
	if(isset($_GET['id']) AND isset($_GET['image_name'])){
		$id =$_GET['id'];
		$image_name=$_GET['image_name'];//to remove image from our file
		
		if($image_name !=""){
			
			$path="../images/food/".$image_name;
			$remove=unlink($path);
			if($remove==false){
				$_SESSION['remove'] = "<div class='error'>Failed to remove food image.</div>";
				header("location:".sURL.'admin/foodManage.php');
				die();
			}
		}
		
		
		$sql="DELETE FROM food_t WHERE id=$id";
		if (mysqli_query($conn, $sql)) {
			$_SESSION['delete'] = "<div class='success'>Food deleted successfully</div>";
			header("location:".sURL.'admin/foodManage.php');
		} 
		else{
			$_SESSION['delete'] = "<div class='error'>Failed to delete food.</div>";
			header("location:".sURL.'admin/foodManage.php');
		}
	}
	else {
		$_SESSION['delete'] = "<div class='error'>Access Error.</div>";
		header("location:".sURL.'admin/foodManage.php');
	}
	
	
?>