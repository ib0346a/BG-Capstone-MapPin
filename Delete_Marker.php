<?php
require('php_cred.php');
$lat  = $_POST['lat'];
$lng  = $_POST['lng'];
$name = $_POST['Name'];
//echo("Name: $Marker_Name Lat: $lat Lng: $lng");

// Create connection
$connect = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
//Execute the query

$query2="DELETE FROM `$table` WHERE `lat`='$lat' AND `lng`='$lng'";

if ($connect->query($query2) === TRUE) {
    
} else {
    die("Error description: " . mysqli_error($connect));
}

$connect->close();

?>