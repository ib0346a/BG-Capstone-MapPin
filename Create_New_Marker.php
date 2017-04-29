<?php
require('php_cred.php');
$Marker_Name  = $_POST['name'];
$lat  = $_POST['lat'];
$lng  = $_POST['lng'];

//echo("Name: $Marker_Name Lat: $lat Lng: $lng");

// Create connection
$connect = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

$query="INSERT INTO `$table` (`Marker_Name`, `lat`, `lng`) VALUES ('$Marker_Name','$lat','$lng')";

if ($connect->query($query) === TRUE) {
    echo "Success";
} else {
    die("Error description: " . mysqli_error($connect));
}

$connect->close();

?>