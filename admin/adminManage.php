<?php include('partials/menu.php');?>

<div class="main-content">
	<h1>Manage Admin</h1>
	
	
	<?php 
		
		if(isset($_SESSION['add']))
		{
			echo $_SESSION['add'];
			
			unset($_SESSION['add']	);
		}
		if(isset($_SESSION['delete']))
		{
			echo $_SESSION['delete'];
			
			unset($_SESSION['delete']	);
		}
		
		if(isset($_SESSION['update']))
		{
			echo $_SESSION['update'];
			
			unset($_SESSION['update']	);
		}
		
		
		
	?>
	<br><br>	<br>
	<a href="addAdmin.php" class="bttn">Add Admin </a>
	
	
	<br><br><br>
	
	
	<table class="tables">
		<tr>
			<th>S.N</th>
			<th>Full name</th>
			<th>UserName</th>
			<th>Actions</th>
		</tr>
		<?php
			$sql="SELECT * FROM admin_t";
			$result=mysqli_query($conn, $sql);
			$n=1;
			if ($result) {
				if(mysqli_num_rows($result) >0){
					
					while($row=mysqli_fetch_assoc($result))
					{
						$id=$row['id'];
						$full_name=$row['full_name'];
						$username=$row['username'];
					?>
					
					<tr>
						<td><?php echo $n++?></td>
						<td><?php echo $full_name?></td>
						<td><?php echo $username?></td>
						<td>
							<a href="<?php echo sURL;?>admin/updateAdmin.php?id=<?php echo $id;?>" class="bttn-u">Update Admin </a>
							<a href="<?php echo sURL;?>admin/deleteAdmin.php?id=<?php echo $id;?>" class="bttn-d">Delete Admin </a>	
						</td>
					</tr>
					<?php
						
					}
				} 
			}
		?>
		
		
		
		</table>
		</div>
					<?php include('partials/footer.php');?>					