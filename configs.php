<?php
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$data = 'demo';

	$conn = mysqli_connect($host, $user, $pass, $data);
	if ($conn -> connect_errno) {
	  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
	  exit();
	}
?>