<?php include('partialsf/menu.php'); ?>
<?php
	if(isset($_GET['food_id'])){
		$food_id=$_GET['food_id'];
		//to get the title
		//$search=$_POST['search'];
		$sql="SELECT * FROM food_t where id='$food_id'";
		$result=mysqli_query($conn, $sql);
		if ($result) {
			//find data
			if(mysqli_num_rows($result)==1){
				
			$row=mysqli_fetch_assoc($result);
					$id=$row['id'];
					$title=$row['title'];
					$price=$row['price'];
					$image_name=$row['image_name'];
			
			}
			
		}
		else{
				
				header("location:".sURL);
			}
	}
	else{
				
				header("location:".sURL);
			}
	
?>

<section class="food-search">
	<div class="container">
		
		<h2 class="text-center ">Fill this form to confirm your order.</h2>
		
		<form action="order.php" method="POST" class="order">
			<fieldset>
				<legend>Selected Food</legend>
				
				<div class="food-menu-img">
					
					<?php if($image_name!=""){
					?>
					<img class="img-responsive img-curve"  alt="Chicke Hawain Pizza" src="<?php echo sURL; ?>images/food/<?php echo $image_name;?>">
					
					<?php
					}
					else{ 
						echo "<div class='error'>image not avialable</div>";
					}	?>	</div>
					
					<div class="food-menu-desc">
						<h3><?php echo $title;?></h3>
						<input type="hidden" name="food" value ="<?php echo $title ;?>">
						<p class="food-price"><?php echo $price.'L.L';?></p>
							<input type="hidden" name="price" value ="<?php echo $price;?>">
						<div class="order-label">Quantity</div>
						<input type="number" name="qty" class="input-responsive" value="1" required>
						
					</div>
					
			</fieldset>
			
			<fieldset>
				<legend>Delivery Details</legend>
				<div class="order-label">Full Name</div>
				<input type="text" name="full-name" placeholder="Full Name" class="input-responsive" required>
				
				<div class="order-label">Phone Number</div>
				<input type="tel" name="contact" placeholder="E.G. +961 ** *** ***" class="input-responsive" required>
				
				<div class="order-label">Email</div>
				<input type="email" name="email" placeholder="E.G. *****@email.com" class="input-responsive" required>
				
				<div class="order-label">Address</div>
				<textarea name="address" rows="10" placeholder="City, Street" class="input-responsive" required></textarea>
				
				<input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
			</fieldset>
			
		</form>
		
		<?php if(isset($_POST['submit'])){
			$food=$_POST['food'];
			$price=$_POST['price'];
			$qty=$_POST['qty'];
			$total=$price*$qty;
			$order_date=date("Y-m-d h:i:sa");
			$status="ordered";
			$customer_name=$_POST['full-name'];
			$customer_contact=$_POST['contact'];
			$customer_email=$_POST['email'];
			$customer_address=$_POST['address'];
			
				$sql="INSERT INTO order_t SET food='$food',price=$price,quantity=$qty,total='$total',
				status='$status',customer_name='$customer_name',customer_contact='$customer_contact',
				customer_email='$customer_email',customer_address='$customer_address',order_date='$order_date'";
				
				//execute and save data
			if (mysqli_query($conn, $sql)) {
				
				$_SESSION['order'] = '<div class="success text-center">Food Ordered successfully</div>';
				
				header("location:".sURL);
				
				} else {
				//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				
				$_SESSION['order'] = '<div class="fail text-center">Failed to order food</div>';
			
				header("location:".sURL);
			}
	
			
			
			
			}
			
			?>
		
	</div>
</section>


<?php include('partialsf/footer.php'); ?>