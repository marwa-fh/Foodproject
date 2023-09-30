<?php 
	include('../cn/constants.php');
	if(isset($_GET['id']) AND isset($_GET['image_name'])){
		$id =$_GET['id'];
		$image_name=$_GET['image_name'];//to remove image from our file
		
		if($image_name !=""){
			
			$path="../images/category/".$image_name;
			$remove=unlink($path);
			if($remove==false){
				$_SESSION['remove'] = "<div class='error'>Failed to remove category image.</div>";
				header("location:".sURL.'admin/categoryManage.php');
				die();
			}
		}
		
		
		$sql="DELETE FROM category_t WHERE id=$id";
		if (mysqli_query($conn, $sql)) {
			$_SESSION['delete'] = "<div class='success'>Category deleted successfully</div>";
			header("location:".sURL.'admin/categoryManage.php');
		} 
		else{
			$_SESSION['delete'] = "<div class='error'>Failed to delete category.</div>";
			header("location:".sURL.'admin/categoryManage.php');
		}
	}
	else {
		
		header("location:".sURL.'admin/categoryManage.php');
	}
	
	
?>