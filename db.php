<?php
	$serverCon = mysqli_connect("localhost", "root", "");
	
	if(!$serverCon)
		die (mysqli_connect_errno());

	$databaseCon = mysqli_connect("localhost", "root", "", "web_project");
	
	if(!$databaseCon)
		die (mysqli_connect_errno());
?>
