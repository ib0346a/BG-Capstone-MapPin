<?php
require('php_cred.php');
$Marker_Name  = $_POST['marker'];



// Create connection
$connect = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
} 

//Execute the query

$query="SELECT `img` FROM `$table` WHERE `Marker_Name`='$Marker_Name'";
$result = mysqli_query($connect,$query);
if (!$result) {
  die("Error description: " . mysqli_error($connect));
}
$new_array=array();
// Iterate through the rows, adding XML nodes for each
while ($row = @mysqli_fetch_assoc($result)){
     $new_array[] = $row['img'];
}

echo implode(" ",$new_array);
//echo json_encode($row)
$connect->close();

?>
