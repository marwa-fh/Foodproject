<?php include('partialsf/menu.php'); ?>


<section class="food-search text-center">
	<div class="container">
		
		<form action="<?php echo sURL;?>food-search.php" method="POST">
			<input type="search" name="search" placeholder="Search for Food.." required>
			<input type="submit" name="submit" value="Search" class="btn btn-primary">
		</form>
		
	</div>
</section>
	<?php 
		
		if(isset($_SESSION['order']))
		{
			echo $_SESSION['order'];
			
			unset($_SESSION['order']	);
			}
		
		
		
		?>

<section class="categories">
	<div class="container">
		<h2 class="text-center">Explore Foods</h2>
		<?php
			$sql="SELECT * FROM category_t WHERE featured='Yes' AND active='Yes' LIMIT 3; ";
			$result=mysqli_query($conn, $sql);
			
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
					
					<a href="<?php echo sURL;?>category-foods.php?category_id=<?php echo $id;?>">
						<div class="box-3 float-container">
							<?php if($image_name!=""){
							?>
							<img class="img-responsive img-curve" alt="Pizza" src="<?php echo sURL; ?>images/category/<?php echo $image_name;?>">
							
							<?php
							}
							else{ 
								echo "<div class='error'>image not avialable</div>";
							}	?>
							<h3 class="float-text text-white"><?php echo $title; ?></h3>
						</div>
					</a>
					<?php
					}			
				}
			} 
			else{
				echo "<div class='error'>Category not added.</div>";
			}
			
		?>
		
		<div class="clearfix"></div>
	</div>
</section>

<section class="food-menu">
	<div class="container">
		<h2 class="text-center">Food Menu</h2>
		
		
		<?php
			$sql="SELECT * FROM food_t WHERE active='Yes' AND featured='Yes' LIMIT 6; ";
			$result=mysqli_query($conn, $sql);
			
			if ($result) {
				if(mysqli_num_rows($result) >0){
					
					while($row=mysqli_fetch_assoc($result))
					{
						$id=$row['id'];
						$title=$row['title'];
						$description=$row['description'];
						$price=$row['price'];
						$image_name=$row['image_name'];
						//$current_category=$row['category_id'];
						$featured=$row['featured'];
						$active=$row['active'];					
					?>
					
					<a href="<?php echo sURL;?>category-foods.php">
						<div class="food-menu-box">
								<div class="food-menu-img">
							<?php if($image_name!=""){
							?>
							
						
									<img class="img-responsive img-curve"  alt="Chicke Hawain Pizza" src="<?php echo sURL; ?>images/food/<?php echo $image_name;?>">
								
								<?php
								}
								else{ 
									echo "<div class='error'>image not avialable</div>";
								}	?>
								<div class="food-menu-desc">
									<h4><?php echo $title; ?></h4>
									<p class="food-price"><?php echo $price; ?></p>
									<p class="food-detail">
										<?php echo $description; ?>
									</p>
									</div>
									<br>
									
									<a href="<?php echo sURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
								
							</div>
						</div>
						
						
					</a>
					<?php
					}			
				}
			} 
			else{
				echo "<div class='error'>Food not added.</div>";
			}
			
		?>
		<div class="clearfix"></div>
		
	</div>
	
	<p class="text-center">
		<a href="foods.php">See All Foods</a>
	</p>
</section>


<?php include('partialsf/footer.php'); ?>	