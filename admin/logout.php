<?php include('../cn/constants.php'); ?>
<?php 
	
	session_destroy();
	
	header("location:".sURL.'admin/login.php');
	
	
?>