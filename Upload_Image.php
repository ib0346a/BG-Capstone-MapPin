<?php
require('php_cred.php');
// Create connection
$connect = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
    

session_start(); //grabs data from php page
$user_fname = $_SESSION["user_fname"];
$user_lname = $_SESSION["user_lname"];
$user_email = $_SESSION["email"];  
$user_img_folder=$user_lname."_".$user_email; 

$target_dir = "Uploads/".$user_img_folder;
$target_file = $target_dir."/".basename($_FILES["uploadedfile"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["uploadedfile"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $message = "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    $message ="You already uploaded this exists.";
    $uploadOk = 0;
}
//Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    $message ="Your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "PNG" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $message ="Only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    //delete from database
    $img=basename($_FILES["uploadedfile"]["name"]);

    $query="DELETE FROM `$table` WHERE `img`='$img'";
    
    if ($connect->query($query) === TRUE) {
        echo "Success";
    } else {
        die("Error description: " . mysqli_error($connect));
    }
    
    $connect->close();

    
    
    $message2 = "There was an error uploading file: ".basename( $_FILES['uploadedfile']['tmp_name']).".";
    $newline= "\\n";
    $message1="$message2/n$message";
    echo "<script type='text/javascript'>
    alert('$message2$newline$message');
    window.location.href='/Map.php';
    </script>";
    
    

        
// if everything is ok, try to upload file
} else {
    if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_file)) {
        $message = "Image ".basename( $_FILES["uploadedfile"]["name"]). " has been successfully uploaded.";
        echo "<script type='text/javascript'>
        alert('$message');
        window.location.href='/Map.php';
        </script>";
    }
    // unforseen error uploading file
    else {
        $message="There was an error uploading ".basename( $_FILES['uploadedfile']['tmp_name']).". Please try again!";
        echo "<script type='text/javascript'>
        alert('$message');
        window.location.href='/Map.php';
        </script>";
        
        $img=basename($_FILES["uploadedfile"]["name"]);

        $query="DELETE FROM `$table` WHERE `img`='$img'";
        
        if ($connect->query($query) === TRUE) {
            echo "Success";
        } else {
            die("Error description: " . mysqli_error($connect));
        }
        
        $connect->close();


    }
}
?>