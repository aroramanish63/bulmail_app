$(function()
{
  $('#email').blur(function()
  {
  var checkemail=$(this).val();
  var availemail=remove_whitespaces(checkemail);
  if(availemail!=''){
  $('#emailInfo').html('');
  $('#emailInfo').fadeIn(400).html('<img src="images/ajax-loading.gif" /> ');

  var String = 'email='+ availemail;
  
  $.ajax({
		  type: "POST",
		  url: "checkemail.php",
		  data: String,
		  cache: false,
		  success: function(result){
			   var result=remove_whitespaces(result);
			   if(result==''){
					   $('#emailInfo').html('<img src="images/accept.png" /> This Email Is Avaliable');
					   $('#emailInfo').css("color", "green");
					   $("#email").removeClass("error");
					   $("#email").addClass("valid");
			   }else if(result=='Invalid'){
					   $('#emailInfo').html('Enter a valid email please');
					   $('#emailInfo').css("color", "#B94A48");
					   $("#email").removeClass("valid");
					   $("#email").addClass("error");
			   }else{
					   $('#emailInfo').html('<img src="images/error.png" /> This Email Is Already Taken');
					   $('#emailInfo').css("color", "#B94A48");
					   $("#email").removeClass("valid");
					   $("#email").addClass("error");
			   }
		  }
	  });
   }else{
	
   }
  });

});

function remove_whitespaces(str){
	 var str=str.replace(/^\s+|\s+$/,'');
	 return str;
}