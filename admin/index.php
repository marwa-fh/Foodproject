<?php include('partials/menu.php');?>

<div class="main-content"><h1>dashboard</h1>
	<br><br>
	<?php 
		
		if(isset($_SESSION['login']))
		{
			echo $_SESSION['login'];
			
			unset($_SESSION['login']	);
		}
	?>
	<br><br>
	<div class="boxes text-center" >
		
		<?php
			$sql="SELECT * FROM category_t";
			$result=mysqli_query($conn, $sql);
			$count=0;
			if ($result) {
				if(mysqli_num_rows($result) >0){
					
					$count=mysqli_num_rows($result);
				}
			}
		?>
		
		
		<h1><?php echo $count?></h1>
		Categories			
		
		</div><div class="boxes text-center" >
		<?php
			$sql="SELECT * FROM food_t";
			$result=mysqli_query($conn, $sql);
			$count=0;
			if ($result) {
				if(mysqli_num_rows($result) >0){
					
					$count=mysqli_num_rows($result);
				}
			}
		?>
		
		
		<h1><?php echo $count?></h1>
		Foods
		</div><div class="boxes text-center" >
		<?php
			$sql="SELECT * FROM order_t";
			$result=mysqli_query($conn, $sql);
			$count=0;
			if ($result) {
				if(mysqli_num_rows($result) >0){
					
					$count=mysqli_num_rows($result);
				}
			}
		?>
		
		
		<h1><?php echo $count?></h1>
		Total Orders
		</div><div class="boxes text-center" >
		<?php
			$sql="SELECT SUM(total) AS Total FROM order_t";
			$result=mysqli_query($conn, $sql);
			$count=0;
			if ($result) {
				
					$row=mysqli_fetch_assoc($result);
				$count=$row['Total'];
				
			}
		?>
		
		
		<h1><?php echo $count.'L.L.'?></h1>
		Total Earnings
	</div>
	<div class="clearfix">
	</div>
</div>
<?php include('partials/footer.php');?>

</body>









</html>			