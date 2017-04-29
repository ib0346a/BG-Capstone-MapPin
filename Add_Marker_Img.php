<?php
require('php_cred.php');
$name  = $_POST['Name'];
$img = $_POST['img'];

// Create connection
$connect = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
} 

//Execute the query

$query="SELECT * FROM `$table` WHERE `Marker_Name`='$name'";

$result = mysqli_query($connect, $query);
if (!$result) {
    die("Error description: " . mysqli_error($connect));
}
if (mysqli_num_rows($result) > 0) {
    
    while($row = mysqli_fetch_array($result))
        {
    
            $lat[] = $row['lat'];
            $lng[] = $row['lng'];
            $Note[] = $row['Note'];
            $img_verify[]=$row['img'];
            
        } 
    //if img has "" then upload image there
    if (in_array('', $img_verify)){
        $query3="UPDATE `$table` SET `img`= '$img' WHERE `img`=' '";
        $result3 = mysqli_query($connect,$query3);
        if (!$result3) {
            die("Error description: " . mysqli_error($connect));
        }
        echo "Success";
        
       
    }else{
        $firstElementlat = reset($lat);
        $firstElementlng = reset($lng);
        $firstElementNote = reset($Note);
 
        $query2="INSERT INTO `$table` (`Marker_Name`, `lat`, `lng`, `Note`, `img`) VALUES ('$name','$firstElementlat','$firstElementlng','$firstElementNote','$img')";
        
        $result2 = mysqli_query($connect,$query2);
        if (!$result2) {
            die("Error description: " . mysqli_error($connect));
        }
        echo "Success";
    }

} else {
    echo "no results";
}

$connect->close();

?>