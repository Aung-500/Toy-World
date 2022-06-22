<?php

 		$username = $_POST['username'];
		$password = $_POST['passwd'];

 		//ctoney ctoney123
		 if ($username =='admin' AND $password=='admin') {
    		header("Location: inde.php");
			} 
		else {
    		echo "<h1 align=center> Invalid User name or password</h1>
    		<h2 align=center>Please Try Again!</h2>";
			} 
?>