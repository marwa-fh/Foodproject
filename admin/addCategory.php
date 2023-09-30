<?php include('partials/menu.php');?>

<div class="main-content">
	<h1>Add Category</h1>
	<?php 
		
		if(isset($_SESSION['add']))
		{
			echo $_SESSION['add'];
			
			unset($_SESSION['add']	);
		}
		
		if(isset($_SESSION['upload']))
		{
			echo $_SESSION['upload'];
			
			unset($_SESSION['upload']	);
		}
		
		
		
	?>
	<br>
	<form method="POST" enctype="multipart/form-data" action="addCategory.php">
		<table class="table30">
			<tr>
				<td>Title</td>
				<td>
					<input type="text" name="title">
				</td>
			</tr>
			
			<tr>
				<td>Select Image</td>
				<td>
					<input type="file" name="image">
				</td>
			</tr>
			<tr>
				<td>Featured</td>
				<td>
					<input type="radio" name="featured" value="Yes">Yes
					<input type="radio" name="featured" value="No">No
				</td>
			</tr>
			
			<tr>
				<td>Active</td>
				<td>
					<input type="radio" name="active" value="Yes">Yes
					<input type="radio" name="active" value="No">No
				</td>
			</tr>
			
			<tr>
				<td colspan="2">
					<input type="submit" name="submit" value="Add Category" class="bttn-d">
					
				</td>
			</tr>
			
			
		</table>
	</form>
	<?php if(isset($_POST['submit']))
		{		
			$title=$_POST['title'];
			
			if(isset($_FILES['image']['name'])){
				
				$image_name=$_FILES['image']['name'];
				if($image_name!=""){
				$extension=end(explode('.',$image_name));
				$image_name="category_".rand(000,999).'.'.$extension;//bcz if we upload same image name,image will be replaced,so we change its name
				$source_path=$_FILES['image']['tmp_name'];
				$destination_path="../images/category/".$image_name;
				$upload=move_uploaded_file($source_path, $destination_path);
				
				if ($upload!=1) {
					
					$_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
					header("location:".sURL.'admin/addCategory.php');
					die();//don't insert data without image, so we stop the proccess
				}	
				}
			}
			else{
				
				$image_name="";
				
			}	
			if(isset($_POST['featured'])){
				$featured=$_POST['featured'];
			}
			else{
				$featured="No";
			}
			if(isset($_POST['active'])){
				$active=$_POST['active'];			
			}
			else{
				$active="No";
			}
			
			
			$sql= "INSERT INTO category_t SET title= '$title',image_name='$image_name', featured='$featured', active='$active' ";
			
			//execute and save data
			if (mysqli_query($conn, $sql)) {
				
				$_SESSION['add'] = '<div class="success">Category added successfully</div>';
				//go to categoryManage page
				header("location:".sURL.'admin/categoryManage.php');
				
			} 
			else {
				
				$_SESSION['add'] = '<div class="error">Failed to add category</div>';
				//go to addCategory page again
				header("location:".sURL.'admin/addCategory.php');
			}
			
		}
		
	?>
	
</div>


<?php include('partials/footer.php');?>