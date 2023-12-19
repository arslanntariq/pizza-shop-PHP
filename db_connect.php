<?php 

	// connect to the database
	$conn = mysqli_connect('localhost', 'yourname', 'yourpasword', 'yourdatabasename');

	// check connection
	if(!$conn){
		echo 'Connection error: '. mysqli_connect_error();
	}


?>