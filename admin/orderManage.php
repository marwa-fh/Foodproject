<?php include('partials/menu.php');?>

<div class="main-content2">
	<h1>Manage Order</h1>
	<?php	if(isset($_SESSION['update']))
		{
			echo $_SESSION['update'];
			
			unset($_SESSION['update']	);
		}
	?>	
	<table class="tables2">
		<tr>
			<th>Nb</th>
			<th>Food</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>Total</th>
			<th>Status</th>
			<th>Customer Name</th>
			<th>Contact</th>
			<th>Email</th>
			<th>Address</th>
			<th>Order Date</th>
			<th>Actions</th>
		</tr>
		<?php
			$sql="SELECT * FROM order_t ORDER BY id DESC";
			$result=mysqli_query($conn, $sql);
			$n=1;
			if ($result) {
				if(mysqli_num_rows($result) >0){
					
					while($row=mysqli_fetch_assoc($result))
					{
						$id=$row['id'];
						$food=$row['food'];
						$price=$row['price'];
						$quantity=$row['quantity'];
						$total=$row['total'];
						$order_date=$row['order_date'];
						$status=$row['status'];
						$customer_name=$row['customer_name'];
						$customer_contact=$row['customer_contact'];
						$customer_email=$row['customer_email'];
						$customer_address=$row['customer_address'];
						
						
					?>
					
					<tr>
						<td><?php echo $n++?></td>
						<td><?php echo $food?></td>
						<td><?php echo $price?></td>
						<td><?php echo $quantity?></td>
						<td><?php echo $total?></td>
						
						<td><?php echo $status?></td>
						<td><?php echo $customer_name?></td>
						<td><?php echo $customer_contact?></td>
						<td><?php echo $customer_email?></td>
						<td><?php echo $customer_address?></td>
						<td><?php echo $order_date?></td>
						<td>
							<a href="<?php echo sURL;?>admin/updateOrder.php?id=<?php echo $id;?>" class="bttn-u">Update Order </a>
							
						</td>
						<?php
						}
					}
				}
				
			?>
			
		</tr>
		
	</table>
</div>
<?php include('partials/footer.php');?>