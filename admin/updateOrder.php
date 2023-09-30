<?php include('partials/menu.php');?>

<div class="main-content">
	<h1>Update Order</h1>
	<?php 
		if(isset($_GET['id'])){
			
			$id =$_GET['id'];
			$sql="SELECT * FROM order_t where id='$id'";
			$result=mysqli_query($conn, $sql);
			if ($result) {
				//find data
				if(mysqli_num_rows($result)==1){
					$row=mysqli_fetch_assoc($result);
					$id=$row['id'];
					$food=$row['food'];
					$price=$row['price'];
					$quantity=$row['quantity'];
					$total=$row['total'];
					
					$status=$row['status'];
					$customer_name=$row['customer_name'];
					$customer_contact=$row['customer_contact'];
					$customer_email=$row['customer_email'];
					$customer_address=$row['customer_address'];
					$order_date=$row['order_date'];
				}
				else {
					
					header("location:".sURL.'admin/orderManage.php');
				}
				
			}	
		}
		else {
			
			header("location:".sURL.'admin/orderManage.php');
		}
	?>
	<br>
	<form method="POST" action="updateOrder.php">
		<table class="table30">
			<tr>
				<td>Food</td>
				<td>
					<input type="text" name="food" value="<?php echo $food;?>">
				</td>
			</tr>
			
			<tr>
				<td>Price</td>
				<td>
					<input type="number" name="price" value="<?php echo $price;?>">
				</td>
			</tr>
			<tr>
				<td>Quatity</td>
				<td>
					<input type="number" name="quantity" value="<?php echo $quantity;?>">
				</td>
			</tr>
			<tr>
				<td>Total</td>
				<td>
					<input type="number" name="total" value="<?php echo $total;?>">
				</td>
			</tr>
			
			<tr>
				<td>Status</td>
				<td>
					<input type="text" name="status" value="<?php echo $status;?>">
				</td>
			</tr>
			
			<tr>
				<td>Customer Name</td>
				<td>
					<input type="text" name="customer_name" value="<?php echo "$customer_name";?>">
				</td>
			</tr>
			
			<tr>
				<td>Contact</td>
				<td>
					<input type="text" name="customer_contact" value="<?php echo $customer_contact;?>">
				</td>
			</tr>
			
			<tr>
				<td>Email</td>
				<td>
					<input type="text" name="customer_email" value="<?php echo $customer_email;?>">
				</td>
			</tr>
			
			<tr>
				<td>Address</td>
				<td>
					<textarea name="customer_address" rows="10" class="input-responsive" required><?php echo $customer_address;?></textarea>
					
				</td>
			</tr>
			
			
			
			<tr>
				<td colspan="2">
					
					
					<input type="hidden" name="id" value="<?php echo $id;?>">
					<input type="hidden" name="order_date" value="<?php echo $order_date;?>">
					<input type="submit" name="submit" value="Update Order" class="bttn-d">
				</td>
			</tr>
			
			
		</table>
	</form>
	
	<?php if(isset($_POST['submit']))
		{	
	
	
			$id=$_POST['id'];
			$food=$_POST['food'];
			$price=$_POST['price'];
			$quantity=$_POST['quantity'];
			$total=$_POST['total'];
			$order_date=$_POST['order_date'];
		$status=$_POST['status'];
			$customer_name=$_POST['customer_name'];
			$customer_contact=$_POST['customer_contact'];
			$customer_email=$_POST['customer_email'];
			$customer_address=$_POST['customer_address'];
		
			$sql="UPDATE order_t SET food='$food',price=$price,quantity=$quantity,total=$total,
			status='$status',customer_name='$customer_name',customer_contact='$customer_contact',
			customer_email='$customer_email',customer_address='$customer_address' WHERE id='$id'";
			
			
			//execute and save data
			if (mysqli_query($conn, $sql)) {
				
				$_SESSION['update'] = '<div class="success">Order updated successfully</div>';
				
				header("location:".sURL.'admin/orderManage.php');
				
			} 
			else {
				
				$_SESSION['update'] = '<div class="error">Failed to update order</div>';
				
				header("location:".sURL.'admin/orderManage.php');
			}
			
		}
		
	?>
	
</div>
<?php include('partials/footer.php');?>