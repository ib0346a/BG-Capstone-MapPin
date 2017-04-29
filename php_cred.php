<?php
	$servername = "www.bgcapstone.x10host.com";
	$username = "bgcapsto_capstone";
	$password = "bgcapsto_capstone123!";
	$dbname = "bgcapsto_user";
	  
    session_start(); //grabs data from php page
    $user_lname = $_SESSION["user_lname"];
    $user_email = $_SESSION["email"]; 
    $table=$user_lname._.$user_email;
?>