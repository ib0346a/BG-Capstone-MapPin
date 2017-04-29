<?php
require('php_cred.php');

//$table="Brennan_isabellabrennan95@gmail.com";
function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}
// Create connection
$connect = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
} 

//Execute the query
$query="SELECT MIN(`Marker_Name`) AS `Marker_Name`,`lat`,`lng`,`Note` FROM `$table`GROUP BY `Marker_Name`";
$result = mysqli_query($connect,$query);
if (!$result) {
  die("Error description: " . mysqli_error($connect));
}

header("Content-type: text/xml");
echo '<markers>';
echo '<user ';
echo 'User_Table="'.$table. '"';
echo '/>';
// Iterate through the rows, adding XML nodes for each
while ($row = @mysqli_fetch_assoc($result)){
  // Add to XML document node
  echo '<marker ';
  echo 'Marker_Name="' . parseToXML($row['Marker_Name']) . '" ';
  echo 'lat="' . $row['lat'] . '" ';
  echo 'lng="' . $row['lng'] . '" ';
  echo 'Note="' . $row['Note'] . '" ';
  echo '/>';
}
echo '</markers>';
$connect->close();

?>