<?php include('partials/menu.php');?>

<div class="main-content">
	<h1>Update Food</h1>
	<?php 
		//include('../cn/constants.php');
		if(isset($_GET['id'])){
			
			$id =$_GET['id'];
			$image_name=$_GET['image_name'];
			
			$sql="SELECT * FROM food_t where id=$id";
			$result=mysqli_query($conn, $sql);
			if ($result) {
				//find data
				if(mysqli_num_rows($result)==1){
					
					$row=mysqli_fetch_assoc($result);
					
					$id=$row['id'];
					$title=$row['title'];
					$description=$row['description'];
					$price=$row['price'];
					$current_image=$row['image_name'];
					$current_category=$row['category_id'];
					$featured=$row['featured'];
					$active=$row['active'];
					
				}
				
				else {
					$_SESSION['notfound'] = '<div class="error">Failed to find food</div>';
					header("location:".sURL.'admin/foodManage.php');
					
				}
				
			}	
		}
		else {
			
			header("location:".sURL.'admin/foodManage.php');
		}
	?>
	<br>
	<form method="POST" enctype="multipart/form-data" action="updateFood.php">
		<table class="table30">
			<tr>
				<td>Title</td>
				<td>
					<input type="text" name="title" value="<?php echo $title;?>">
				</td>
			</tr>
			<tr>
				<td>Description </td>
				<td>
					<textarea name="description"  cols="30" rows="5" ><?php echo $description;?></textarea>
				</td>
			</tr>
			<tr>
				<td>Price</td>
				<td>
					<input type="number" name="price" value="<?php echo $price;?>">
				</td>
			</tr>
			<tr>
				<td>Current Image</td>
				<td><?php
					if($current_image!=""){
					?>
					<img  src="<?php echo sURL; ?>images/food/<?php echo $current_image;?>" width="100px">
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
				<td>Category</td>
				<td>
					<select name="category" >
						<?php
							$sql="SELECT * FROM category_t WHERE active='Yes'";
							$result=mysqli_query($conn, $sql);
							$n=1;
							if ($result) {
								if(mysqli_num_rows($result) >0){
									
									while($row=mysqli_fetch_assoc($result))
									{
										$idcat=$row['id'];
										$titlecat=$row['title'];
										
									?>
									<option <?php if($current_category==$idcat) echo "selected"; ?> value="<?php echo $idcat ?>"><?php echo $titlecat ?></option>
									<?php
									}
								}
								else{
								?>
								<option value="">No Category Found!</option>
								<?php }
								
							}
						?>
						
					</td>
				</tr>
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
					<input type="submit" name="submit" value="Update Food" class="bttn-d">
				</td>
			</tr>
			
			
		</table>
	</form>
	
	<?php if(isset($_POST['submit']))
		{		
			$id=$_POST['id'];
			$title=$_POST['title'];
			$description=$_POST['description'];
			$price=$_POST['price'];
			$current_image=$_POST['current_image'];
			$category=$_POST['category'];
			$featured=$_POST['featured'];
			$active=$_POST['active'];
			
			if(isset($_FILES['image']['name'])){
				
				$image_name=$_FILES['image']['name'];
				if($image_name!=""){
					$extension=end(explode('.',$image_name));
					$image_name="food_".rand(000,999).'.'.$extension;//bcz if we upload same image name,image will be replaced,so we change its name
					$source_path=$_FILES['image']['tmp_name'];
					$destination_path="../images/food/".$image_name;
					$upload=move_uploaded_file($source_path, $destination_path);
					
					if ($upload!=1) {
						
						$_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
						header("location:".sURL.'admin/categoryManage.php');
						die();//don't insert data without image, so we stop the proccess
					}	
					if($current_image!=""){
						$path="../images/food/".$current_image;
						$remove=unlink($path);
						if($remove==false){
							$_SESSION['remove'] = "<div class='error'>Failed to remove category.</div>";
							header("location:".sURL.'admin/foodManage.php');
							die();
						}
					}
					
				}
				else{
					
					$image_name=$current_image;
					
				}
			}
			
			else{
					
					$image_name=$current_image;
					
				}
			
			
			$sql= "UPDATE food_t SET title= '$title', description='$description',price='$price',image_name='$image_name',category_id='$category', featured='$featured', active='$active' WHERE id='$id' ";
			
			
			//execute and save data
			if (mysqli_query($conn, $sql)) {
				
				$_SESSION['update'] = '<div class="success">Food updated successfully</div>';
				
				header("location:".sURL.'admin/foodManage.php');
				
			} 
			else {
				
				$_SESSION['update'] = '<div class="error">Failed to update food</div>';
				
				header("location:".sURL.'admin/updateFood.php');
			}
			
		}
		
	?>
	
</div>
<?php include('partials/footer.php');?>