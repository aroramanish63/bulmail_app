$(document).ready(function(){
	//global vars
	var indexform = $("#form1");
	var email = $("#email");
	var emailInfo = $("#emailInfo");
	var frndsmail = $("#tags_1");
	var frndemailInfo = $("#frndemailInfo");
	var uploadfile = $("#uploadfile");
	var fileInfo = $("#fileInfo");
	var message = $("#message");
	
	var regisform = $("#form_regis");
	var fullname = $("#firstname");
	var nameInfo = $("#nameInfo");
	var pass1 = $("#password");
	var pass1Info = $("#pass1Info");
	var pass2 = $("#cpassword");
	var pass2Info = $("#pass2Info");
	
	var loginform = $("#form_login");
	//console.log( $("#uploadfile").val() );
	//On blur
	email.blur(validateEmail);
	frndsmail.blur(validateFrndEmail);
	uploadfile.blur(validateUploadFile);
	fullname.blur(validateName);
	pass1.blur(validatePass1);
	pass2.blur(validatePass2);
	//On key press
	//name.keyup(validateName);
	//pass1.keyup(validatePass1);
	//pass2.keyup(validatePass2);
	//message.keyup(validateMessage);
	
	//On Submitting Index form
	indexform.submit(function(){
		if(validateEmail() & validateFrndEmail() & validateUploadFile())
			return true
		else
			return false;
	});
	
	//On Submitting Registration form
	regisform.submit(function(){
		if(validateName() & validateEmail() & validatePass1() & validatePass2())
			return true
		else
			return false;
	});
	
	//On Submitting Login form
	loginform.submit(function(){
		if(validateEmail() & validatePass1())
			return true
		else
			return false;
	});
	
	//validation functions
	function validateEmail(){
		//testing regular expression
		var a = $("#email").val();
		var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
		//if it's valid email
		if(filter.test(a)){
			email.removeClass("error");
			emailInfo.text("");
			emailInfo.removeClass("error");
			return true;
		}
		//if it's NOT valid
		else{
			email.addClass("error");
			emailInfo.text("Enter a valid email please");
			emailInfo.addClass("error");
			return false;
		}
	}
	
	function validateFrndEmail(){
		//if it's valid
		var a = $("#tags_1").val();
		if(a!=""){
			//frndsmail.removeClass("error");
			frndemailInfo.text("");
			frndemailInfo.removeClass("error");
			return true;
		}
		//if it's NOT valid
		else{
			//frndsmail.addClass("error");
			frndemailInfo.text("Add your friend's email please");
			frndemailInfo.addClass("error");
			return false;
		}
	}
	
	function validateUploadFile(){
		var upload_files_length = $("#uploadfile").length;
		var upload_files = $("#uploadfile").val();
		if(upload_files_length == 0 || upload_files == ""){
			//frndsmail.addClass("error");
			fileInfo.text("Select a file please");
			fileInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			//frndsmail.removeClass("error");
			fileInfo.text("");
			fileInfo.removeClass("error");
			return true;
		}
	}
	
	function validateName(){
		//if it's NOT valid
		if(fullname.val().length < 4){
			fullname.addClass("error");
			nameInfo.text("Please enter your name at least 4 characters");
			nameInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			fullname.removeClass("error");
			nameInfo.text("");
			nameInfo.removeClass("error");
			return true;
		}
	}
	
	function validatePass1(){
		var a = $("#password");
		var b = $("#cpassword");

		//it's NOT valid
		if(pass1.val().length < 5){
			pass1.addClass("error");
			pass1Info.text("Please enter password at least 5 characters");
			pass1Info.addClass("error");
			return false;
		}
		//it's valid
		else{			
			pass1.removeClass("error");
			pass1Info.text("");
			pass1Info.removeClass("error");
			validatePass2();
			return true;
		}
	}
	
	function validatePass2(){
		var a = $("#password");
		var b = $("#cpassword");
		//are NOT valid
		if( pass1.val() != pass2.val() ){
			pass2.addClass("error");
			pass2Info.text("Passwords doesn't match!");
			pass2Info.addClass("error");
			return false;
		}
		//are valid
		else{
			pass2.removeClass("error");
			pass2Info.text("");
			pass2Info.removeClass("error");
			return true;
		}
	}
	
	/*function validateMessage(){
		//it's NOT valid
		if(message.val().length < 10){
			message.addClass("error");
			return false;
		}
		//it's valid
		else{			
			message.removeClass("error");
			return true;
		}
	}*/
});