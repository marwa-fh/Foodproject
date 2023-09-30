<?php include('partialsf/menu.php'); ?>

<section class="food-search text-center">
	<div class="container">
		<?php 
			$search=$_POST['search'];
			?>
		<h2>Result of searching for: <a href="#" class="text-c"><?php 
			echo "$search";?></a></h2>
		
	</div>
</section>

<section class="food-menu">
	<div class="container">
		<h2 class="text-center">Food Menu</h2>
		<?php 
			//$search=$_POST['search'];
			$sql="SELECT * FROM food_t where active='Yes' AND title LIKE '$search' OR active='Yes' AND description LIKE '$search'";
			$result=mysqli_query($conn, $sql);
			if ($result) {
				//find data
				if(mysqli_num_rows($result)==1){
					
					$row=mysqli_fetch_assoc($result);
					
					$id=$row['id'];
					$title=$row['title'];
					$description=$row['description'];
					$price=$row['price'];
					$image_name=$row['image_name'];
					//$current_category=$row['category_id'];
					//$featured=$row['featured'];
					//$active=$row['active'];
					
				?>
				
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
						<a href="order.php?food_id=<?php echo $id;?>" class="btn-primary btn">Order Now</a>
					</div>
				</div>
				<?php }
				
				else {
				echo "<p> The food you searched for is not available right now</p>";
					
				}
	
			}	
		
		?>

		<div class="clearfix"></div>

</div>

</section>

    <?php include('partialsf/footer.php'); ?>			