// <!-- Initiate WYIWYG text area 
//        $.noConflict();
jQuery(document).ready(function($) {                           
                        $('.password').pstrength();             
				$("#myTable") 
				.tablesorter({
					// zebra coloring
					widgets: ['zebra'],
					// pass the headers argument and assing a object 
					headers: { 
						// assign the sixth column (we start counting zero) 
						6: { 
							// disable it by setting the property sorter to false 
							sorter: false 
						} 
					}
				}) 
			.tablesorterPager({container: $("#pager")});
                
         
                

			           
                // initialise plugin
				var example = $('#example').superfish({
					//add options here if required
				});

				// buttons to demonstrate Superfish's public methods
				$('.destroy').on('click', function(){
					example.superfish('destroy');
				});

				$('.init').on('click', function(){
					example.superfish();
				});

				$('.open').on('click', function(){
					example.children('li:first').superfish('show');
				});

				$('.close').on('click', function(){
					example.children('li:first').superfish('hide');
				});

	$('a.loginButton').click(function() {
		
		// Getting the variable's value from a link 
		var loginBox = $(this).attr('href');
		//Fade in the Popup and add close button
		$(loginBox).fadeIn(300);
		
		//Set the center alignment padding + border
		var popMargTop = ($(loginBox).height() + 24) / 2; 
		var popMargLeft = ($(loginBox).width() + 24) / 2; 
		
		$(loginBox).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		// Add the mask to body
		$('body').append('<div id="mask"></div>');
		$('#mask').fadeIn(300);
		
		return false;
	});
	
	// When clicking on the button close or the mask layer the popup closed
	$('a.close, #mask').on('click', function() { 
	  $('#mask , .login-popup').fadeOut(300 , function() {
		$('#mask').remove();  
	}); 
	return false;
	});
	
	
	
	
	
	
	
	$('a.login-window2').click(function() {
		
		// Getting the variable's value from a link 
		var loginBox = $(this).attr('href');

		//Fade in the Popup and add close button
		$(loginBox).fadeIn(300);
		
		//Set the center alignment padding + border
		var popMargTop = ($(loginBox).height() + 24) / 2; 
		var popMargLeft = ($(loginBox).width() + 24) / 2; 
		
		$(loginBox).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		// Add the mask to body
		$('body').append('<div id="mask"></div>');
		$('#mask').fadeIn(300);
		
		return false;
	});
	
	// When clicking on the button close or the mask layer the popup closed
	$('a.close, #mask').on('click', function() { 
	  $('#mask , .login-popup2').fadeOut(300 , function() {
		$('#mask').remove();  
	}); 
	return false;
	});
	
	
	
	
	$('a.login-window3').click(function() {
		
		// Getting the variable's value from a link 
		var loginBox = $(this).attr('href');

		//Fade in the Popup and add close button
		$(loginBox).fadeIn(300);
		
		//Set the center alignment padding + border
		var popMargTop = ($(loginBox).height() + 24) / 2; 
		var popMargLeft = ($(loginBox).width() + 24) / 2; 
		
		$(loginBox).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		// Add the mask to body
		$('body').append('<div id="mask"></div>');
		$('#mask').fadeIn(300);
		
		return false;
	});
	
	// When clicking on the button close or the mask layer the popup closed
	$('a.close, #mask').on('click', function() { 
	  $('#mask , .login-popup3').fadeOut(300 , function() {
		$('#mask').remove();  
	}); 
	return false;
	});
	
	
	
	
	$('a.login-window4').click(function() {
		
		// Getting the variable's value from a link 
		var loginBox = $(this).attr('href');

		//Fade in the Popup and add close button
		$(loginBox).fadeIn(300);
		
		//Set the center alignment padding + border
		var popMargTop = ($(loginBox).height() + 24) / 2; 
		var popMargLeft = ($(loginBox).width() + 24) / 2; 
		
		$(loginBox).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		// Add the mask to body
		$('body').append('<div id="mask"></div>');
		$('#mask').fadeIn(300);
		
		return false;
	});
	
	// When clicking on the button close or the mask layer the popup closed
	$('a.close, #mask').on('click', function() { 
	  $('#mask , .login-popup4').fadeOut(300 , function() {
		$('#mask').remove();  
	}); 
	return false;
	});
	
	
	
	
});




/*
 * Ajax Requests Functions Start Here 
 * @type XMLHttpRequest
 */

var xmlhttp;
function testXML(){

	if(window.XMLHttpRequest)
  {
	//code for IE7 and hiegher version
	xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=ActiveXObject("Microsoft.XMLHTTP");
	}
return xmlhttp;	
}
/**
 * Changes the Status actuve/inactive
 */

function statusChange(statusid,id,classn) {

		var req = testXML();		
		if (req) {			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {					
					// only if "OK"
					if (req.status == 200) {											
                                            if(req.responseText == 0)
                                            {
//                                                console.log(req.responseText);
                                                document.getElementById(statusid).src = 'images/minus-circle.gif';
                                            }
                                            else{
//                                                console.log('manish   '+req.responseText);
                                                document.getElementById(statusid).src = 'images/tick-circle.gif';
                                            }
					}
				}				
			}			
			req.open("POST",'index.php',true);
                        req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        req.send("ajx=Yes&id="+id+"&func_name=statusActiveInactive&page=ajaxFunctions&class="+classn);
		}	        
}


/**
 * Function for filter record active or inactive
 */
function getvaluesByStatus(status,func_name,classn) {
    if(status != ''){
        var req = testXML();		
		if (req) {			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {					
					// only if "OK"
					if (req.status == 200) {											
                                            if(req.responseText)
                                            {
                                                $('#myTable tbody').html(req.responseText);
                                            }                                            
					}
				}				
			}			
			req.open("POST",'index.php',true);
                        req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        req.send("ajx=Yes&status="+status+"&func_name="+func_name+"&page=ajaxFunctions&class="+classn);
		}
     }
}

/**
 * Function for Get emails list for export.
 */
function exportList(siteid,func_name,classn) {
    if(siteid != ''){
        var req = testXML();		
		if (req) {			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {					
					// only if "OK"
					if (req.status == 200) {											
                                            if(req.responseText == 0)
                                            {
                                                document.getElementById('dynamic').style.color = '#FF0000';
                                                document.getElementById('dynamic').innerHTML = "No data Available for export.";
                                                setTimeout(function(){document.getElementById('dynamic').innerHTML = ''},3000);
                                            }
                                            else{
//                                                document.getElementById('dynamic').style.color = '#000000';
//                                                document.getElementById('dynamic').innerHTML = req.responseText;
                                                $('#dynamic').html('<input class="submit-green" type="submit" name="saveButton" value="Export" id="saveButton" />');
//                                                document.getElementById('dynamic').appendChild('<input class="submit-green" type="submit" name="saveButton" value="Export" id="saveButton" />');
                                            }
					}
				}				
			}			
			req.open("POST",'index.php',true);
                        req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        req.send("ajx=Yes&id="+siteid+"&func_name="+func_name+"&page=ajaxFunctions&class="+classn);
		}
      }
}

/*
 * Function for filter using emails
 */

function filter(id,filterby,func_name,classn) {
    if(id != ''){
         var req = testXML();		
		if (req) {			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {					
					// only if "OK"
					if (req.status == 200) {											
                                             if(req.responseText)
                                            {
                                                $('#myTable tbody').html(req.responseText);
                                            } 
					}
				}				
			}			
			req.open("POST",'index.php',true);
                        req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        req.send("ajx=Yes&id="+id+"&filterby="+filterby+"&func_name="+func_name+"&page=ajaxFunctions&class="+classn);
		}
    }
}

/*
 * Function for filter using emails
 */

function getAllemails(func_name,classn) {
         var req = testXML();		
		if (req) {			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {					
					// only if "OK"
					if (req.status == 200) {											
                                             if(req.responseText)
                                            {
                                                jQuery('#dynamicemails').css('display','block');
                                                jQuery('#dynamicemails').html(req.responseText);
                                                 jQuery('#emailbysite').css('display','none');
                                            } 
					}
				}				
			}			
			req.open("POST",'index.php',true);
                        req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        req.send("ajx=Yes&func_name="+func_name+"&page=ajaxFunctions&class="+classn);
		}   
}

/*
 * Function for filter using emails
 */

function getemailsBysiteid(siteid,func_name,classn) {
    
    if(siteid.checked == true){
        siteid.parentNode.className = 'multiselect-on';
         var req = testXML();		
		if (req) {			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {					
					// only if "OK"
					if (req.status == 200) {											
                                             if(req.responseText)
                                            {
                                                jQuery('#emailbysite').css('display','block');
                                                jQuery('#emailbysite .multiselect').append(req.responseText);
                                                jQuery('#dynamiemails').css('display','none');
                                            } 
					}
				}				
			}			
			req.open("POST",'index.php',true);
                        req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        req.send("ajx=Yes&id="+siteid.value+"&func_name="+func_name+"&page=ajaxFunctions&class="+classn);
		}   
            }
            else{
                siteid.parentNode.className = '';
                jQuery('#emailbysite').css('display','none');
                 jQuery('#emailbysite .multiselect').html('');
                console.log(siteid.checked);
            }   
}

/**
 * Function for popup email
 */
function emailPopup(id,classn) {
    if(id == ''){
        return false;
    }
            document.getElementById('light').innerHTML = '<center><img src="images/mail-loader.gif" /></center>';
            document.getElementById('light').style.display='block';
            document.getElementById('fade').style.display='block';
         var req = testXML();		
		if (req) {			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {					
					// only if "OK"
					if (req.status == 200) {											
                                             if(req.responseText != 0)
                                            {
                                              document.getElementById('light').innerHTML = req.responseText;
//                                              $('#light').html(req.responseText);                                              
                                            }
                                            else
                                                alert('No Email address found.');
					}
				}				
			}			
			req.open("POST",'index.php',true);
                        req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        req.send("ajx=Yes&id="+id+"&func_name=emailPopup&page=ajaxFunctions&class="+classn);
		}   
}

/**
  * function for save values using ajax
  */
    function formValues(value1) {
        if(value1 != ''){
            $('#loader').show();
            var datastr =new Array();
            jQuery.each( value1, function( i, field ) {
                datastr[field.name] = field.value;
             });
//             datastr += 'func_name:saveMailbeforeSend,page:ajaxFunctions,class:sendMailFunctions}';
//             console.log(datastr);
            $.ajax({
                type:"POST",
                url:"index.php",
                data:{email_id:datastr['email_id'],emails:datastr['emails'],message:datastr['message'],site:datastr['site'],subject:datastr['subject'],func_name:'saveMailbeforeSend',page:'ajaxFunctions',class:'sendMailFunctions',ajx:'Yes',saveButton:'1'},
                success:function(data){
                    $('#loader').hide();
                     $("input[type=text], textarea").val("");
                     $('#messsuc').addClass('n-success');
                     $('#messsuc').html(data);  
                     $('#messsuc').show();
                     setTimeout(function(){$('#messsuc').hide();},3000);
                     setTimeout(function(){$('#light').hide(),$('#fade').hide()},5000);                                 
               }
            });
             
        }
    }

/*
 * Ajax Requests Functions End Here 
 * @type XMLHttpRequest
 */

/**
 * Function for add category textbox using javascript
 */
function addmore_category(textboxid) {
    var counttextbox = document.getElementById('counttextbox');
    if(textboxid != ''){
//        var addformid = document.getElementById(formid);
        var newtextbox = document.createElement("p");
        var input  = document.createElement('input');
        input.setAttribute('type','text');
        input.setAttribute('name',textboxid+'[]');
        input.setAttribute('class','input-short');
        input.setAttribute('id',textboxid+(parseInt(counttextbox.value)+parseInt(1)));
        newtextbox.appendChild(input);       
         document.getElementById('dynamic').appendChild(newtextbox);
        var pretextbox = document.getElementById(textboxid).setAttribute('name',textboxid+'[]');
//        pretextbox.setAttribute('name',textboxid+'[]');
        counttextbox = counttextbox.setAttribute('value',parseInt(counttextbox.value)+parseInt(1));        
    }
}

/**
 * function change the input textbox case
 */
function changecase(obj) {   
    obj.value = obj.value.toUpperCase();
}

/**document.getElementById(selectid)
 * Function for validate selectbox
 */
function validateSelectbox(selectid) {
    var e = document.getElementById(selectid);
    var strUser = e.options[e.selectedIndex].value;
	if(strUser != ''){
		return true;
	}
	else
		return false;
}

function validateInputBox(inputid){
	var e = document.getElementById(inputid);
        var strUser = e.value;
	if((strUser != '') && (strUser.replace(/\s+$/, "") != "")){
		return true;
	}
	else
		return false;
}


function checkEmail(inputid) {
        var email = document.getElementById(inputid);
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if (!filter.test(email.value)) {
            return false;
        }
        else{
            return true;
        }
}


/**
 * Function for validate email form
 */
function validate_emailform() {
    var errors=new Array("selecterror","emailerror","emailusererror");    
    clearerrors(errors);
    var site_id = document.getElementById('site_id');
    var email_id = document.getElementById('email_id');
    var email_user = document.getElementById('email_user');
    if(!validateSelectbox('site_id')){
        setError('site_id','selecterror','Please select site.');
        return false;
    }
    if(!validateInputBox('email_user')){
        setError('email_user','emailusererror','Please enter email user name.');
        return false;
    }
    if(!validateInputBox('email_id')){
        setError('site_id','emailerror','Please enter email address.');
        return false;
    }
    else{
        if(!checkEmail('email_id')){
            setError('site_id','emailerror','Please enter valid email address.');
            return false;
        }
        else
            return true;
    }
    window.email_form.submit();
}

/**
 * Function for validate URL
 */

    function checkUrl(inputid) {
        var url = document.getElementById(inputid).value;
        var pattern =  /^(?:(ftp|http|https):\/\/)?(?:[\w-]+\.)+[a-z]{3,6}$/;
        if (pattern.test(url)) {
            return true;
        }
        else
            return false;
}
/**
 * Function for clear errors.
 */
function clearerrors(errors) {
    var i;
    for(i=0;i<errors.length;i++){
        document.getElementById(errors[i]).innerHTML = '';        
    }    
}

/**
 * Set Error Message
 */
function setError(elementid,errorid,errormsg) {
        document.getElementById(elementid).focus();
        document.getElementById(errorid).style.color = '#ff0000';
        document.getElementById(errorid).className = 'erorr';
        document.getElementById(errorid).innerHTML = errormsg;
}


/*
 * function for validate site form
 */

function validate_siteform() {
    var errors=new Array("siteerror","urlerror");    
    clearerrors(errors);
    var site_name = document.getElementById('site_name');
    var site_url = document.getElementById('site_url');
    if(!validateInputBox('site_name')){
        setError('site_name','siteerror','Please enter site name.');
        return false;
    }
    if(!validateInputBox('site_url')){
        setError('site_url','urlerror','Please enter site url.');
        return false;
    }
    else{
        if(!checkUrl('site_url')){
            setError('site_url','urlerror','Please enter valid site url.');
            return false;
        }
        else
            return true;
    }
    window.sites.submit();
}

/*
 * function for validate category form
 */

function validate_catform() {
    var errors=new Array("caterror");    
    clearerrors(errors);
    var cate_name = document.getElementById('cate_name');
    if(!validateInputBox('cate_name')){
        setError('cate_name','caterror','Please enter category name.');
        return false;
    }
    window.main_categories.submit();
}



/**
 * Function for validate subcategory form
 */
function validate_subcatform() {
    var errors=new Array("caterror","subcaterror");    
    clearerrors(errors);
    var cat_id = document.getElementById('cat_id');
    var subcat_name = document.getElementById('subcat_name');
    if(!validateSelectbox('cat_id')){
        setError('cat_id','caterror','Please select category.');
        return false;
    }
    if(!validateInputBox('subcat_name')){
        setError('subcat_name','subcaterror','Please enter sub category name.');
        return false;
    }    
    window.sub_categories.submit();
}

/*
 * function for reset selectbox
 */

function resetSelect(selectid) {
     var e = document.getElementById(selectid);
     return e.options[e.selectedIndex].value = '';	
}

 /*
  * Function for select all checkbox
  */
 
function checkAll(source,elementname) {
    checkboxes = document.getElementsByName(elementname);
    if(source.checked){
        getAllemails('getAllemails','sendMailFunctions');
    }
    for(var i=0, n=checkboxes.length;i<n;i++) {
      checkboxes[i].checked = source.checked;
      if(source.checked){
          source.parentNode.className = 'multiselect-on';
         checkboxes[i].parentNode.className = 'multiselect-on';         
      }
      else{
          source.parentNode.className = '';
          checkboxes[i].parentNode.className = '';
          document.getElementById('dynamicemails').innerHTML = '';
      }    
    }
}

/**
 * Function for Emails Select All
 */
function checkEmailAll(source,elementname) {
    checkboxes = document.getElementsByName(elementname);   
    for(var i=0, n=checkboxes.length;i<n;i++) {
      checkboxes[i].checked = source.checked;
      if(source.checked){
          source.parentNode.className = 'multiselect-on';
         checkboxes[i].parentNode.className = 'multiselect-on';         
      }
      else{
          source.parentNode.className = '';
          checkboxes[i].parentNode.className = '';
      }    
    }
    
}

/**
 * Function for checkbox handle
 */
function handleCheck(source) {
    if(source.checked){
        source.parentNode.className = 'multiselect-on';
    }
    else
        source.parentNode.className = '';
}