<?php
	ob_start();

	session_start(); //enables use of sessions

	$timezone = date_default_timezone_set("America/Denver");

	$con = mysqli_connect("localhost", "root", "", "slotify");

	if(mysqli_connect_errno()) {
		echo "Failed to conncect: " . mysqli_connect_errno();

	}



?>