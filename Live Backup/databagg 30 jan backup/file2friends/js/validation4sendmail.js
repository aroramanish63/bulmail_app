$(document).ready(function(){
	//global vars
	var indexform = $("#form1");
	var email_csv = $("#email_csv");
	var emailInfo = $("#emailInfo");
	var subject = $("#subject");
	var subjectInfo = $("#subjectInfo");
	var message = $("#message");
	var messageInfo = $("#messageInfo");
	var uploaded_file = $("#uploaded_file");
	var fileInfo = $("#fileInfo");
	
	//console.log( $("#uploadfile").val() );
	//On blur
	/*email.blur(validateEmail);
	frndsmail.blur(validateFrndEmail);
	uploadfile.blur(validateUploadFile);
	fullname.blur(validateName);
	pass1.blur(validatePass1);
	pass2.blur(validatePass2);*/
	//On key press
	//name.keyup(validateName);
	//pass1.keyup(validatePass1);
	//pass2.keyup(validatePass2);
	//message.keyup(validateMessage);
	
	//On Submitting Index form
	indexform.submit(function(){
		if(validateUploadEmailFile() & validateSubject() & validateMessage() & validateUploadFile())
			return true
		else
			return false;
	});
	
	//validation functions
	function validateUploadEmailFile(){
		var email_csv_length = $("#email_csv").length;
		var email_file = $("#email_csv").val();
		var extension = $('#email_csv').val().split('.').pop().toLowerCase();
		if(email_csv_length == 0 || email_file == ""){
			//frndsmail.addClass("error");
			emailInfo.text("Please select a file with specific format.");
			emailInfo.addClass("error");
			return false;
		}
		else if(extension != 'csv'){
			emailInfo.text("Only csv file allowed.");
			emailInfo.addClass("error");
			return false;
		}
		else{
			//frndsmail.removeClass("error");
			emailInfo.text("");
			emailInfo.removeClass("error");
			return true;
		}
	}
	
	function validateSubject(){
		//if it's valid
		var subject = $("#subject").val();
		if(subject!=""){
			//frndsmail.removeClass("error");
			subjectInfo.text("");
			subjectInfo.removeClass("error");
			return true;
		}
		//if it's NOT valid
		else{
			//frndsmail.addClass("error");
			subjectInfo.text("Please enter subject.");
			subjectInfo.addClass("error");
			return false;
		}
	}
	
	function validateMessage(){
		var message = $("#message").val();
		if(message != "" && message.length >= 10){
			messageInfo.text("");
			messageInfo.removeClass("error");
			return true;
		}
		else{	
			messageInfo.text("Please enter message min 10 char.");
			messageInfo.addClass("error");
			return false;
		}
	}
	
	function validateUploadFile(){
		var upload_files_length = $("#uploaded_file").length;
		var upload_files = $("#uploaded_file").val();
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
});