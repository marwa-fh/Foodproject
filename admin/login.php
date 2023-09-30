<?php include('../cn/constants.php'); ?>
<html>
	<head>
		<title>LOGIN - FOOD ORDERING WEBSITE</title>
		<link rel="stylesheet" href="../css/admin.css">
	</head>
	
	<body>
		<div class="login">
			<h1 class="textcenter">LOGIN</h1>
			<br>
			
	<?php 
		
		if(isset($_SESSION['login']))
		{
			echo $_SESSION['login'];
			
			unset($_SESSION['login']	);
		}
		if(isset($_SESSION['nologin']))
		{
			echo $_SESSION['nologin'];
			
			unset($_SESSION['nologin']	);
		}
		?><br><br>
			<form action="" method="POST" class="textcenter">
				
				
				Username:<br>
				
				<input type="text" name="username">
				<br>
				<br>
				Password:
				<br>
				<input type="password" name="password">
				<br>
				<br>
				<input type="submit" name="submit" value="login" class="bttn">
				
			</div>
			
		</body>
	</html>
<?php if(isset($_POST['submit']))
		{
			
		
			$username=$_POST['username'];
			$password=($_POST['password']);
			
			
			//add data to database
			$sql= "SELECT * FROM admin_t WHERE username='$username' AND password='$password' ";
			
			$result=mysqli_query($conn, $sql);
		if ($result) {
			//find data
			if(mysqli_num_rows($result)==1){
				
				$row=mysqli_fetch_assoc($result);
				
				
				$_SESSION['login'] ='<div class="success">Login successfull</div>';
				$_SESSION['user'] = $username;//check if user logged in
				header("location:".sURL.'admin/');
				
			}
			
			else {
			
				//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				
				$_SESSION['login'] = '<div class="error">Username and password did not match</div>';
				header("location:".sURL.'admin/login.php');
				
			}
		}
		}
			
		
		
		
		
		
		
		
		?>
						