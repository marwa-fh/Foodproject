<?php include('partialsf/menu.php'); ?>

<section class="food-search text-center">
	<div class="container">
		
		<form action="<?php echo sURL;?>food-search.php" method="POST">
			<input type="search" name="search" placeholder="Search for Food.." required>
			<input type="submit" name="submit" value="Search" class="btn btn-primary">
		</form>
		
	</div>
</section>

<section class="food-menu">
	<div class="container">
		<h2 class="text-center">Food Menu</h2>
		<?php
			$sql="SELECT * FROM food_t WHERE active='Yes' LIMIT 6; ";
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
					
					<a href="category-foods.html">
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
									<br>
								</div>
								<a href="<?php echo sURL;?>order.php?food_id=<?php echo $id;?>" class="btn-primary btn">Order Now</a>
								
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
		
	</section>
	
<?php include('partialsf/footer.php'); ?>