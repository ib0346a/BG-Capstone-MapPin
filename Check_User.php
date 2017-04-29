<?php
    session_start();
	$servername = "www.bgcapstone.x10host.com";
	$username = "bgcapsto_capstone";
	$password = "bgcapsto_capstone123!";
	$dbname = "bgcapsto_user";
	 
	// Create connection
	$connect = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($connect->connect_error) {
	    die("Connection failed: " . $connect->connect_error);
	} 
	 
	// create a variable
	$user_email=$_POST['user_email'];
	$user_password=$_POST['user_passwrd'];

	//Execute the query
	 
	$sql=mysqli_query($connect,"SELECT * FROM `User_Information` WHERE `Email`='$user_email' and `password` = '$user_password'");
        while($row=mysqli_fetch_assoc($sql)){
		// add each row returned into an array
		         $array[] = $row;
                 $user_fname=$row['First_Name'];
                 $user_lname=$row['Last_Name'];
                 $user_email=$row['Email'];
                 header("Location: /Map.php");
                
                 $_SESSION['user_fname'] = $user_fname;
                 $_SESSION['user_lname']=$user_lname;
                 $_SESSION['email'] = $user_email;



	}

	$connect->close();
?>