<DOCTYPE html>
<html>
<head>
	<meta charset="UFT-8">
	<title>
		MapPin
	</title>
	<link rel="stylesheet" type="text/css" href="LoginPageCSS.css">
	<script type="text/javascript" src="Validate.js"></script>
	
</head>	
<body>
	
	<div class="center_div">
		<div class="image_div">
			<img src="Pics\Camera_Image.PNG" alt="Image" class="center_image">
		</div><!--close image_div-->
		
		<div class = "user_login_signup_div">
			<div class = "user_form">
				<h2>Place Logo Here</h2>
				<div class="login">
					<form method="Post" class="login_form" name="login_form" action="/Check_User.php" onsubmit="return validateUser()">
						<input type="text" placeholder="Email" name="user_email" id="user_email" onkeyup="check_user_email()" >
						<input type="password" placeholder="Password" name="user_passwrd" id="user_passwrd" onkeyup="check_user_passwrd()">
						<input type="submit" id="login_button" value="Login"/>
					</form>	
				</div><!--close login-->
				
				<div id="signup" class="signup_div">			
				
				<h2 >OR</h2> 
					<form method="Post" class="signup_form" name="submit_form" action="/Create_User.php" onsubmit="return validateForm()">
						<div id="TopRow">
					    	<input type="text" placeholder="First Name" id="first_name" name="first_name" onkeyup="check_fname()" />
					        <input type="text" placeholder="Last Name" id="last_name" name="last_name" onkeyup="check_lname()"/>       
						</div><!--close TopRow-->
						    
						<input type="email" placeholder="Email" id="email" name="email" onkeyup="check_email()"/>
						<input type="email" placeholder="Re-enter Email" id="re_email" onkeyup="check_re_email()"/>
	
						<input type="password" placeholder="New Password" id="passwrd" name="passwrd" onkeyup="check_passwrd()"/>
						<input type="password" placeholder="Re-enter Password" id="re_passwrd" onkeyup="check_re_passwrd()"/>
						   
						<input type="submit" name="register" class="create_account_button" value="Create Account"/>
				          
					</form>    
				</div><!--close signup_div--> 
			</div><!--close user_form-->         
		</div><!--close user_login_signup_div-->
	</div><!--close center_div-->
   

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


