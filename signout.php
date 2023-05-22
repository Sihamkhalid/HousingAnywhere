<?php
session_start();

// Destroying All Sessions
if ($_SESSION['role'] == 'homeseeker') {
	if(session_destroy()){
		// Redirecting To Login Page
		header("Location: index.html");
	}
}
else{
    if ($_SESSION['role'] == 'homeowner') {
		if(session_destroy()){
			// Redirecting To Login Page
            header("Location: index.html");
		}	
	}
}
?>
