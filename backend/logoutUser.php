<?php
	// Include needed functions
	include 'redirectToLastPage.php';

	// This script logs out the current user
	session_destroy();	
	
	echo "You are now logged out!";
	displayRedirect();
	die;
?>