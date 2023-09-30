<?php include('partials/menu.php');?>

<div class="main-content">
	<h1>Add Food</h1>
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
	<form method="POST" enctype="multipart/form-data" action="addFood.php">
		<table class="table30">
			<tr>
				<td>Title</td>
				<td>
					<input type="text" name="title">
				</td>
			</tr>
			<tr>
				<td>Description</td>
				<td>
					<textarea name="description"  cols="30" rows="5" ></textarea>
				</td>
			</tr>
			<tr>
				<td>Price</td>
				<td>
					<input type="text" name="price" >
					
				</td>
			</tr>
			
			<tr>
				<td>Select Image</td>
				<td>
					<input type="file" name="image">
				</td>
			</tr>
			<tr>
				<td>Category</td>
				<td>
					<select name="category">
						<?php
							$sql="SELECT * FROM category_t WHERE active='Yes'";
							$result=mysqli_query($conn, $sql);
							$n=1;
							if ($result) {
								if(mysqli_num_rows($result) >0){
									
									while($row=mysqli_fetch_assoc($result))
									{
										$id=$row['id'];
										$title=$row['title'];
										//$current_image=$row['image_name'];
										//$featured=$row['featured'];
										//$active=$row['active'];
										
									?>
									<option value="<?php echo $id ?>"><?php echo $title ?></option>
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
						<input type="submit" name="submit" value="Add Food" class="bttn-d">
						
					</td>
				</tr>	
			</table>
		</form>
		<?php if(isset($_POST['submit']))
			{		
				$title=$_POST['title'];
				$description=$_POST['description'];
				$price=$_POST['price'];
				$category=$_POST['category'];
				
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
							header("location:".sURL.'admin/addFood.php');
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
						
						
						$sql= "INSERT INTO food_t SET title= '$title', description='$description',price='$price',image_name='$image_name',category_id='$category', featured='$featured', active='$active' ";
						
						if (mysqli_query($conn, $sql)) {
						
						$_SESSION['add'] = '<div class="success">Food added successfully</div>';
						
						header("location:".sURL.'admin/foodManage.php');
						
						} 
						else {
						
						$_SESSION['add'] = '<div class="error">Failed to add category</div>';
						
						header("location:".sURL.'admin/addFood.php');
						}
						
						}
						
						?>
						
						</div>
						
						
						<?php include('partials/footer.php');?>						