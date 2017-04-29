<DOCTYPE html>
<html>

<head>
	<!--<meta charset="UFT-8">-->
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<title>
		Photo_Map Website
	</title>
   <!-- <link rel="stylesheet" type="text/css" href="MapPageCSS.css">-->
    <script type="text/javascript" src="Image_Map_View_43.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
   <!-- <link rel="stylesheet" type="text/css" href="MapPageCSS.css?version=1">
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    -->
    <link rel="stylesheet" type="text/css" href="MapPageCSS_25.css?<php echo time(); ?>" />
</head>	
<body>
	<div class="logout_container">
		<div class="logo" style="float:left">
			<img src="Pics\camera.png" alt="Image" class="logo_image">
			<div class="logo_title">
				<img src="Pics\logo_here.png" alt="Image" class="logo_title_image">
			</div><!--close logo_title-->
		</div><!--close logo-->
	
		<div class="logout_form">
			<button id="logout_button" onclick="location.href ='/';">Log Out</button>
		</div><!--close logout_form div-->
		
		
	</div><!--close div logout_container-->
	
	<div class="User_Profile">
		<div class="user_pic_div">
			<img src="Pics\IMAGE_UNAVAILABLE.jpg" alt="Image" class="user_pic" id="user_pic" onclick="userImage()">
		</div><!--close user_pic_div-->	
		<div class="user_info_div">
			<?php 
				session_start(); //grabs data from php page
				$user_fname = $_SESSION["user_fname"];
				$user_lname = $_SESSION["user_lname"];
				$user_email = $_SESSION["email"];  
				$user_img_folder=$user_lname."_".$user_email;    	
				//get current directory
				$curdir=getcwd();
				//if user image file does not already exhists then
				if(!file_exists($curdir."/Uploads/".$user_img_folder)){
					mkdir($curdir."/Uploads/".$user_img_folder,0777);
				}
                	?>
			<h1>
		                <?php echo $user_fname;?>
		              	<?php echo $user_lname;?>
			</h1>
			</br>
			<p1>
		                # of albums created:
			</p1>
			</br></br>
			<p1>
		                # of photos uploaded:
			</p1>
			
		</div><!--close user_info_div-->
		
		<!--INVISIBLE DIV-->
		
        <div id="myModal" class="modal">
            <span class="close" onclick="return closeModal()">&times;</span>
            <div class="modal-content">
                <img src="Pics\IMAGE_UNAVAILABLE.jpg" alt="Image" class="m-content" id="img01">
                <button id="change_user_profile_button">Change Profile</button>
            </div>
            
            <!--
            
            HERE I NEED TO ADD A BUTTON WHEN CLICKED ALL IMAGES ON SERVER WILL POP UP AND ONCLICK:THE IMAGE WILL BECOME USER BACKGROUND.
            
            OR A BUTTON WHICH WILL CALL FOR FILE TO UPLOAD
            -->
            
        </div>
	

	</div><!--close div User_Profile-->
	<div class="center_div">
		<!--MAP-->
		<div id="map_div" onload="initMap()">
            <div id="map"></div>

            <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD90Zcj1ruoGpydEF2CC0zC1WYW7l-InXQ&callback=initMap">
            </script>
		</div><!--close map_div-->
		
		<!--PICTURES-->
		<div id="picture_div">
		    
		    
		    <!--Hidden Module with add image, edit location, delete location buttons-->
		    <div id="my_edit_Modal" class="edit_Modal">
                <div class="edit_modal-content">
                    <span class="edit_close" onclick="return close_edit_Modal()">&times;</span>
                    <img src='Pics\add_image.gif' alt="Image" class="edit-content" id="Add_IMG" onclick='return AddImage()'>
                    <img src='Pics\edit_name.gif' alt="Image" class="edit-content" id="Edit_NAME" onclick='return EditName()'>
                    <img src='Pics\delete.gif' alt="Image" class="edit-content" id="Delete_Mark" onclick='return DeleteMarker()'>
                </div>
                <div class="edit_add-content">
                    <h2>Upload Image</h2>
                    
                    <script>
                    function ImageUpload(){
                    var x=false;
                        //if image is successfully uploaded to the server Upload_Image will be called 
                            // this will place the image into the file system
                    Upload_to_Server(x);
                    if(x=true){
                		return true;
                	}
                	else{
                		alert("There was an error uploading your image please try again.");
                		return false;
                		}
                    }
                    </script>
                    
                    <form enctype="multipart/form-data" action="/Upload_Image.php" method="post" onsubmit="return ImageUpload()">
        				<input type="hidden" name="MAX_FILE_SIZE" />
        				<p style="line-height:2.5px;">Step 1: Select an image.</p>
        				<label class="edit_buttons" id="img_file">
        				    <input name="uploadedfile" type="file" id="uploadedfile" onchange="loadFile(event)" style="margin-top:10px;"/>
        				    <span>Choose File</span>
        				</label>
        				<br/>
                        <img id="output" style="width: 100px; height:auto;display: inline-block;margin-left:15%;margin-right:35%;">
                        <script>
                          var loadFile = function(event) {
                            var output = document.getElementById('output');
                            output.src = URL.createObjectURL(event.target.files[0]);
                          };
                        </script>
        				<br/><br/>
        				<p style="line-height:.5px;">Step 2: Click the button below.<p/>
        				<input type="submit" value="Upload File" class="edit_buttons"/>
    				</form> 
                </div>
                <div class="edit_name-content">
                    <h2>Edit Location Name</h2>
                    <form id="change_marker" action="#" onsubmit="return ChangeMarkerNote(this);">
                        <p style="line-height:2px;">New Location Name:</p>
                        <input type="text" name="firstname" value="Enter Location Name" id="edit_name_input"><br/><br/>
                        <input type="submit" value="Submit" class="edit_buttons">
                    </form>
                </div>
                <div class="edit_delete-content">
                    <h2>Delete Marker</h2>
                    <button type="button" class="edit_buttons"id="delete_mark_button"onclick="return DeleteMarkerNow()">Delete</button>
                </div>
            </div>
		    
			<div id="pictures"> 
			    <div id="headers">
    				<p id="pic_p">Pictures</p>
                    <!--Edit button-->
    		        <img src='Pics\edit_add.gif'id='edit_add' alt='Image' onclick='return modalEdit()'>
    			</div>	
				<!--DISPLAY ALL USER IMAGES-->
                <div id='marker_pic_div'> 
                    <div id='inner_marker_div'>
                        <div class='user_images_thumbnail' style='display: initial;'>
                            <img src='Pics/camera.png' 
                            class='User_Images' id='user_img' alt='Image' 
                            onclick='return modalImage(this)'
                            style='width:auto; height:250px;'>
                        </div>
                    </div>   
    			</div>
				<!--INVISIBLE DIV-->
		
        <div id="myModal2" class="modal2">
            <div class="modal2-content">
                <span class="close2" onclick="return closeModal2()">&times;</span>
                <img src="" alt="Image" class="m2-content" id="clicked_image">
            </div>
            
        </div>
	
		</div>
	</div>
	
	<footer>
		<table class="foot" cellspacing="2" cellpadding="3">
			<tr id="border">
				<td>Language 1</td>
				<td>Language 2</td>
				<td>Language 3</td>
			</tr>
			<tr>
				<td>Page 4</td>
				<td>Page 5</td>
				<td>Page 6</td>
			</tr>
		</table>
    	   
	</footer>
</body>
</html>
