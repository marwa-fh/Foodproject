<?php 
	include('../cn/constants.php');
	$id =$_GET['id'];
	
	$sql="DELETE FROM admin_t where id=$id";
	if (mysqli_query($conn, $sql)) {
		$_SESSION['delete'] = 'Admin deleted successfully';
		//go to AdminManage page
		header("location:".sURL.'admin/adminManage.php');
		} else {
		//echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		$_SESSION['delete'] = 'Failed to delete admin,try again.';
	}
	
	
	
	
	
	
	
?>