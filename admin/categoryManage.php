<?php include('partials/menu.php');?>

<div class="main-content"><h1>Manage Category</h1>
	<br>	<br>
	<?php 
		
		if(isset($_SESSION['add']))
		{
			echo $_SESSION['add'];
			
			unset($_SESSION['add']	);
		}
		if(isset($_SESSION['delete']))
		{
			echo $_SESSION['delete'];
			
			unset($_SESSION['delete']	);
		}
		if(isset($_SESSION['remove']))
		{
			echo $_SESSION['remove'];
			
			unset($_SESSION['remove']	);
		}
		
		if(isset($_SESSION['update']))
		{
			echo $_SESSION['update'];
			
			unset($_SESSION['update']	);
		}
		
		
		if(isset($_SESSION['notfound']))
		{
			echo $_SESSION['notfound'];
			
			unset($_SESSION['notfound']	);
		}
		if(isset($_SESSION['upload']))
		{
			echo $_SESSION['upload'];
			
			unset($_SESSION['upload']	);
		}
		
		
		
	?>
	<br><br>	<br>
	<a href="addCategory.php" class="bttn">Add Category </a>
	
	
	<br><br><br>
	
	
	<table class="tables">
		<tr>
			<th>N</th>
			<th>Title</th>
			<th>Image</th>
			<th>Featured</th>
			<th>Active</th>
			<th>Action</th>
		</tr>
		<?php
			$sql="SELECT * FROM category_t";
			$result=mysqli_query($conn, $sql);
			$n=1;
			if ($result) {
				if(mysqli_num_rows($result) >0){
					
					while($row=mysqli_fetch_assoc($result))
					{
						$id=$row['id'];
						$title=$row['title'];
						$image_name=$row['image_name'];
						$featured=$row['featured'];
						$active=$row['active'];
						
					?>
					
					<tr>
						<td><?php echo $n++?></td>
						<td><?php echo $title?></td>
						<td><?php 
							if($image_name!=""){
							?>
							<img class="center" src="<?php echo sURL; ?>images/category/<?php echo $image_name;?>" width="100px">
							<?php
							}
							else{
								echo "<div class='error'>image not added.</div>";
							}
						?>
						</td>
						<td><?php echo $featured?></td>
						<td><?php echo $active?></td>
						<td>
							<a href="<?php echo sURL;?>admin/updateCategory.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="bttn-u">Update Category </a>
							<a href="<?php echo sURL;?>admin/deleteCategory.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="bttn-d">Delete Category </a>	
						</td>
					</tr>
					<?php
						
					}
				} 
			}
		?>
		
		
		
	</table>
	
	
</div>
<?php include('partials/footer.php');?>					