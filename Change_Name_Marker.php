<?php
require('php_cred.php');
$name  = $_POST['Name'];
$note = $_POST['note'];


// Create connection
$connect = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
} 

$query=" UPDATE `$table` SET `Note`='$note' WHERE `Marker_Name`='$name'";
 
if ($connect->query($query) === TRUE) {
    echo "Success";
} else {
    die("Error description: " . mysqli_error($connect));
}

$connect->close();

?>