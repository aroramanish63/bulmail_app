//jQuery.noConflict(); 


$(document).ready(function(){    
var edit = "Edit";
var save = "Save";
var Required = "Required";
var processing = 'Processing';
var invalidDate = 'Should be a valid date in yyyy-mm-dd format';
var datepickerDateFormat = 'yy-mm-dd';
var fileModified = 0;
var readOnlyFields = []; 

$('#login_form').validate({
   rules:{
       user_name:{
           required:true
       },
       pass_word:{
           required:true
       }
   },
   messages: {
     user_name: {
            required:Required
       },
     pass_word: {
               required: Required
       }
   }
});

$('#langForm').validate({
    rules: {
        languageTitle: {
            required:true
        },
        lang_abrv:{
            required:true
        },
        lang_charset: {
            required:true
        }
    },
    messages: {
        languageTitle: {
            required:Required
        },
        lang_abrv:{
            required:Required
        },
        lang_charset: {
            required:Required
        }
    }
});

$('#userForm').validate({
    rules: {
        username: {
            required:true
        },
        email:{
            required:true
        },
        password: {
            required:true
        },
        first_name:{
            required:true
        },
        last_name: {
            required:true
        },
        country:{
            required:true
        }
    },
    messages: {
        username: {
            required:Required
        },
        email:{
            required:Required
        },
        password: {
            required:Required
        },
        first_name:{
            required:Required
        },
        last_name: {
            required:Required
        },
        country:{
            required:Required
        }
    }
});


// Disable input fields
$(".editfield").each(function(){
	$(this).attr("disabled", "disabled");
});

$("#saveButton").click(function() {
	//if user clicks on Edit make all fields editable
	if($("#saveButton").attr('value') == edit) {
		
		$(".box-content .editfield").each(function(){
			$(this).removeAttr("disabled");
		});
		
		$("#saveButton").attr('value', save);
		return false;
	} 

}); 

// Disable calendar elements
//$(".editable.calendar").datepicker('disable'); 


    $("#check_all").click(function(e){
		if($(this).is(":checked")){ 
			$("input[type=checkbox]").prop('checked',true); 
		}else{ 
			$("input[type=checkbox]").prop('checked',false); 
		} 
	}); 
	$("input[type=checkbox]:not(#check_all)").click(function(e){ 
		$("input[type=checkbox]").each(function(index, element) {
			if(element.checked==false){
				$("#check_all").prop('checked',false);	
			}
		});
	});		

});