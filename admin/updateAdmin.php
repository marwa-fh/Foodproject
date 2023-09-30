<?php include('partials/menu.php');?>

<div class="main-content">
	<h1>Update Admin</h1>
	<?php 
		//include('../cn/constants.php');
		$id =$_GET['id'];
		
		$sql="SELECT * FROM admin_t where id=$id";
		$result=mysqli_query($conn, $sql);
		if ($result) {
			//find data
			if(mysqli_num_rows($result)==1){
				
				$row=mysqli_fetch_assoc($result);
				
				$id=$row['id'];
				$full_name=$row['full_name'];
				$username=$row['username'];
				$password=$row['password'];
				
			}
			
			else {
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				//header("location:".sURL.'admin/adminManage.php');
				
			}
		}	
	?>
	<br>
	<form action="" method="POST">
		<table class="table30">
			<tr>
				<td>Full Name</td>
				<td>
					<input type="text" name="full_name" value="<?php echo $full_name;?>">
				</td>
			</tr>
			
			<tr>
				<td>User Name</td>
				<td>
					<input type="text" name="username" value="<?php echo $username;?>">
				</td>
			</tr>
			
			<tr>
				<td>Password</td>
				<td>
					<input type="password" name="password" value="<?php echo $password;?>">
				</td>
			</tr>
			
			<tr>
				<td colspan="2">
					
					<input type="submit" name="submit" value="update admin" class="bttn-d">
					<input type="hidden" name="id" value="<?php echo $id;?>">
					
				</td>
			</tr>
			
			
		</table>
	</form>
</div>

<?php if(isset($_POST['submit']))
	{
		//getting values from the form
		$id=$_POST['id'];
		$full_name=$_POST['full_name'];
		$username=$_POST['username'];
		$password=($_POST['password']);
		
		
		//add data to database
		$sql= "UPDATE admin_t SET full_name= '$full_name', username='$username' ,password='$password' where id='$id'";
		//execute and save data
		if (mysqli_query($conn, $sql)) {
			
			$_SESSION['update'] = 'Admin updated successfully';
			//go to AdminManage page
			header("location:".sURL.'admin/adminManage.php');
			
			} else {
			//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			
			$_SESSION['update'] = 'Failed to add admin';
			
			header("location:".sURL.'admin/Manage.php');
			
		}
	}
	
?>


<?php include('partials/footer.php');?>