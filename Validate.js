//_______________LOGIN FORM_______________
function validateUser(){
	if(check_user_email() && check_user_passwrd()){
		return true;
	}
	else{
		alert("Please enter valid information");
		return false;
	}
}
function check_user_email(){
	var user_email = document.forms["login_form"]["user_email"].value;
    
    if (user_email.length <= 5) {
        document.getElementById("user_email").style.borderColor = "red";
        document.getElementById("user_email").style.borderWidth = "2px";
        return false;
    }
    else if (user_email.length > 5) {
        document.getElementById("user_email").style.borderColor = "white";
        document.getElementById("user_email").style.borderWidth = "1px";
        return true;
    } 
}
function check_user_passwrd(){
	var user_passwrd = document.forms["login_form"]["user_passwrd"].value;
    var user_passwrd_digit = /\d/.test(user_passwrd);
    var user_passwrd_symbol= /\W/.test(user_passwrd);
    var user_passwrd_case= /[A-Z]/.test(user_passwrd);  

     if (user_passwrd.length <10||user_passwrd_digit===false||user_passwrd_symbol===false||user_passwrd_case===false) {
        document.getElementById("user_passwrd").style.borderColor = "red";
        document.getElementById("user_passwrd").style.borderWidth = "2px";
        return false;
    }
    else if (user_passwrd.length >= 10 && user_passwrd_digit===true && user_passwrd_symbol===true && user_passwrd_case===true) {
        document.getElementById("user_passwrd").style.borderColor = "white";
        document.getElementById("user_passwrd").style.borderWidth = "1px";
        return true;
    } 
}
//_______________NEW SUBMISSION FORM_______________
function validateForm() {
       if(check_fname() && check_lname() && check_email() && check_re_email() && check_passwrd() && check_re_passwrd())
         {
	      return true;
	 }
      else{
          alert('Validation failed!');
          return false;    
        }
}

function check_fname() {
    
    var first_name = document.forms["submit_form"]["first_name"].value;
    var name_number = /\d/.test(first_name);
    var name_symbol= /\W/.test(first_name);

    if (first_name.length < 2||name_number===true||name_symbol===true) {
        document.getElementById("first_name").style.borderColor = "red";
        return false;
    }

    else if (first_name.length > 2) {
        document.getElementById("first_name").style.borderColor = "white";
        return true;
    } 
}

function check_lname() {
    
    var last_name = document.forms["submit_form"]["last_name"].value;
    var name_number = /\d/.test(last_name);
    var name_symbol= /\W/.test(last_name);
    
    if (last_name.length <= 2||name_number===true||name_symbol===true) {
        document.getElementById("last_name").style.borderColor = "red";
        return false;
    }
    else if (last_name.length > 2) {
        document.getElementById("last_name").style.borderColor = "white";
        return true;
    }
}

function check_email() {
    
    var email = document.forms["submit_form"]["email"].value;
    
    
    if (email.length <= 5) {
        document.getElementById("email").style.borderColor = "red";
        return false;
    }
    else if (email.length > 5) {
        document.getElementById("email").style.borderColor = "white";
        return true;
    } 
}

function check_re_email() {
    
    var re_email = document.forms["submit_form"]["re_email"].value;
    var email = document.forms["submit_form"]["email"].value;
    
    if (re_email.length <= 5||re_email!==email) {
        document.getElementById("re_email").style.borderColor = "red";
        return false;
    }
    else if (re_email.length > 5 && re_email===email) {
        document.getElementById("re_email").style.borderColor = "white";
        return true;
    } 
}

function check_passwrd() {
    
    var passwrd = document.forms["submit_form"]["passwrd"].value;
    var passwrd_digit = /\d/.test(passwrd);
    var passwrd_symbol= /\W/.test(passwrd);
    var passwrd_case= /[A-Z]/.test(passwrd);  

     if (passwrd.length <10||passwrd_digit===false||passwrd_symbol===false||passwrd_case===false) {
        document.getElementById("passwrd").style.borderColor = "red";
        return false;
    }
    else if (passwrd.length >= 10 && passwrd_digit===true && passwrd_symbol===true && passwrd_case===true) {
        document.getElementById("passwrd").style.borderColor = "white";
        return true;
    } 
   
}
function check_re_passwrd() {
    
    var re_passwrd = document.forms["submit_form"]["re_passwrd"].value;
    var passwrd = document.forms["submit_form"]["passwrd"].value;
    
    if (re_passwrd.length <10||re_passwrd!==passwrd) {
        document.getElementById("re_passwrd").style.borderColor = "red";
        return false;
    }
    else if (re_passwrd.length >= 10||re_passwrd===passwrd) {
        document.getElementById("re_passwrd").style.borderColor = "white";
        return true;
    } 
    
}