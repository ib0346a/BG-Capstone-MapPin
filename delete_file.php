<?php
    require('php_cred.php');
    $img  = $_POST['imgs'];
    $single_img = explode(",", $img);

    foreach($single_img as $item)
    {
        $filepath="Uploads/$table/$item";

            $base = '/home/bgcapsto/public_html/';  // it seems this one is good to be realpath too.. meaning not a symlinked path.. 
          //  if (strpos($file = realpath($base.$filepath), $base) === 0 && is_file($file)) { 
                chdir($base);
                unlink($filepath); 
                echo "Successfully deleted";
                
         /*   } else { 
                die('blah!'.$item); 
            } */
        } 
 
   
   

?>