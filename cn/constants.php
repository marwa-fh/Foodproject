<?php 
	session_start();
	
	define('sURL','http://localhost/foodproject/');
	$servername = "localhost";
	$usern = 'root';
	$pass = '';
	$dbname = "foodproject";
	
	// Create connection
	$conn = mysqli_connect($servername, $usern, $pass, $dbname);
	
	// Check connection
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
?>