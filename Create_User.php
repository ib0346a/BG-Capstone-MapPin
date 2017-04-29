<?php
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
	$first_name=$_POST['first_name'];
	$last_name=$_POST['last_name'];
	$email=$_POST['email'];
	$password=$_POST['passwrd'];
	 
	//Execute the query
	 
	 
	$sql="INSERT INTO User_Information (Email,First_Name,Last_Name,password)
			        VALUES ('$email','$first_name','$last_name','$password')";
	if ($connect->query($sql) === TRUE) {
            //Redirect to Map.php
	    header("Location: /Map.php");
            $_SESSION['user_fname'] = $first_name;
            $_SESSION['user_lname']=$last_name;
            $_SESSION['email'] = $email;

	} else {
	    echo "Error: " . $sql . "<br>" . $connect->error;
	}			
	
	$connect->close();
?>