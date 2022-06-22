<?php
	$conn = new mysqli("127.0.0.1:3307","root","","toystore");

	if($conn->connect_error)
	{
		die("Sorry! Could not connect to the database.".$conn->connect_error);
	}
?>