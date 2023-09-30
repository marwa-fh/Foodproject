<?php include('partials/menu.php');?>



<div class="main-content">
	<h1>Add Admin</h1>
	<?php 
		
		if(isset($_SESSION['add']))
		{
			echo $_SESSION['add'];
			
			unset($_SESSION['add']	);
			}
		
		
		
		?>
	<br>
	<form action="" method="POST">
		<table class="table30">
			<tr>
				<td>Full Name</td>
				<td>
					<input type="text" name="full_name">
				</td>
			</tr>
			
			<tr>
				<td>User Name</td>
				<td>
					<input type="text" name="username">
				</td>
			</tr>
			
			<tr>
				<td>Password</td>
				<td>
					<input type="password" name="password">
				</td>
			</tr>
			
			<tr>
				<td colspan="2">
					<input type="submit" name="submit" value="Add admin" class="bttn-d">
					
				</td>
			</tr>
			
			
		</table>
		
	</div>
	
	<?php include('partials/footer.php');?>
	<?php if(isset($_POST['submit']))
		{
			
			$full_name=$_POST['full_name'];
			$username=$_POST['username'];
			$password=($_POST['password']);
			
			
			//add data to database
			$sql= "INSERT INTO admin_t SET full_name= '$full_name', username='$username', password='$password' ";
			//$sql = "INSERT INTO admin_t ('full_name', 'username', 'password')
			//VALUES ($full_name,$username,$password)";
			
			//execute and save data
			if (mysqli_query($conn, $sql)) {
				
				$_SESSION['add'] = '<div class="success">Admin added successfully</div>';
				//go to AdminManage page
				header("location:".sURL.'admin/adminManage.php');
				
				} else {
				//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				
				$_SESSION['add'] = '<div class="success">Failed to add Admin</div>';
				//go to addAdmin page again
				header("location:".sURL.'admin/addAdmin.php');
			}
	
		}
		
		?>
						