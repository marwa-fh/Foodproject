<?php include('partialsf/menu.php'); ?>
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

	<?php
			$sql="SELECT * FROM category_t WHERE active='Yes'";
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
            <a href="category-foods.html">

            </a>

           
 

            <div class="clearfix"></div>
        </div>
    </section>
 

   <?php include('partialsf/footer.php'); ?>