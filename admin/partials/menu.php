	<?php include('../cn/constants.php');?>
	
	<?php 
		
		if(!isset($_SESSION['user']))
		{
			$_SESSION['nologin'] = '<div class="error">You have to login first.</div>';
			header("location:".sURL.'admin/login.php');
		}
		?>
<html>
	<head>
		<title> FOOD ORDERING WEBSITE - HOME PAGE </title>
		<link rel="stylesheet" href="../css/admin.css">
	</head>
	
	<body>
		<div class="menu">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="adminManage.php">Admin</a></li>
				<li><a href="categoryManage.php">Category</a></li>
				<li><a href="foodManage.php">Food</a></li>
				<li><a href="orderManage.php">Order</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
		