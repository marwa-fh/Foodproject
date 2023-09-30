<?php include('partials/menu.php');?>

<div class="main-content">
	<h1>Update Category</h1>
	<?php 
		//include('../cn/constants.php');
		if(isset($_GET['id'])){
			
			$id =$_GET['id'];
			$image_name=$_GET['image_name'];
			
			$sql="SELECT * FROM category_t where id=$id";
			$result=mysqli_query($conn, $sql);
			if ($result) {
				//find data
				if(mysqli_num_rows($result)==1){
					
					$row=mysqli_fetch_assoc($result);
					
					$id=$row['id'];
					$title=$row['title'];
					$current_image=$row['image_name'];
					$featured=$row['featured'];
					$active=$row['active'];
					
				}
				
				else {
					$_SESSION['notfound'] = '<div class="error">Failed to find category</div>';
					header("location:".sURL.'admin/categoryManage.php');
					
				}
				
			}	
		}
		else {
			
			header("location:".sURL.'admin/categoryManage.php');
		}
	?>
	<br>
	<form method="POST" enctype="multipart/form-data" action="updateCategory.php">
		<table class="table30">
			<tr>
				<td>Title</td>
				<td>
					<input type="text" name="title" value="<?php echo $title;?>">
				</td>
			</tr>
			
			<tr>
				<td>Current Image</td>
				<td><?php
					if($current_image!=""){
					?>
					<img  src="<?php echo sURL; ?>images/category/<?php echo $current_image;?>" width="100px">
					<?php 
					}
					else{
						echo 'Image was not added';
					}?>
					
				</td>
			</tr>
			<tr>
				<td>New Image</td>
				<td>
					<input type="file" name="image">
				</td>
			</tr>
			<tr>
				<td>Featured</td>
				<td>
					<input <?php if($featured=="Yes") echo"checked";?> type="radio" name="featured" value="Yes">Yes
					<input <?php if($featured=="No") echo"checked";?> type="radio" name="featured" value="No">No
				</td>
			</tr>
			
			<tr>
				<td>Active</td>
				<td>
					<input <?php if($active=="Yes") echo"checked";?> type="radio" name="active" value="Yes">Yes
					<input <?php if($active=="No") echo"checked";?> type="radio" name="active" value="No">No
				</td>
			</tr>
			
			<tr>
				<td colspan="3">
					
					<input type="hidden" name="current_image" value="<?php echo $current_image;?>">
					<input type="hidden" name="id" value="<?php echo $id;?>">
					<input type="submit" name="submit" value="Update Category" class="bttn-d">
				</td>
			</tr>
			
			
		</table>
	</form>
	
	<?php if(isset($_POST['submit']))
		{		
			$id=$_POST['id'];
			$title=$_POST['title'];
			$current_image=$_POST['current_image'];
			$featured=$_POST['featured'];
			$active=$_POST['active'];
			
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
						header("location:".sURL.'admin/categoryManage.php');
						die();//don't insert data without image, so we stop the proccess
					}	
					if($current_image!=""){
						$path="../images/category/".$current_image;
						$remove=unlink($path);
						if($remove==false){
							$_SESSION['remove'] = "<div class='error'>Failed to remove category.</div>";
							header("location:".sURL.'admin/categoryManage.php');
							die();
						}
					}
				}
				else{
					
					$image_name=$current_image;
					
				}
			}
	
			$sql= "UPDATE category_t SET title= '$title',image_name='$image_name', featured='$featured', active='$active' WHERE id='$id'";
			
			//execute and save data
			if (mysqli_query($conn, $sql)) {
				
				$_SESSION['update'] = '<div class="success">Category updated successfully</div>';
				//go to categoryManage page
				header("location:".sURL.'admin/categoryManage.php');
				
			} 
			else {
				
				$_SESSION['update'] = '<div class="error">Failed to update category</div>';
				//go to addCategory page again
				header("location:".sURL.'admin/updateCategory.php');
			}
			
		}
		
	?>
	
</div>
<?php include('partials/footer.php');?>