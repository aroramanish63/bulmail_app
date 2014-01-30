// <!-- Initiate WYIWYG text area 
    $(function()
    {
			$('#wysiwyg').wysiwyg(
			{
			controls : {
			separator01 : { visible : true },
			separator03 : { visible : true },
			separator04 : { visible : true },
			separator00 : { visible : true },
			separator07 : { visible : false },
			separator02 : { visible : false },
			separator08 : { visible : false },
			insertOrderedList : { visible : true },
			insertUnorderedList : { visible : true },
			undo: { visible : true },
			redo: { visible : true },
			justifyLeft: { visible : true },
			justifyCenter: { visible : true },
			justifyRight: { visible : true },
			justifyFull: { visible : true },
			subscript: { visible : true },
			superscript: { visible : true },
			underline: { visible : true },
            increaseFontSize : { visible : false },
            decreaseFontSize : { visible : false }
			}
			} );
});

        
      //   Initiate tablesorter script -->
  
    $(document).ready(function() { 
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
}); 
		
$(function() {
			$('.password').pstrength();
});


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

function statusChange(statusid,id,page) {
        var SITEURL = document.getElementById('header-status').className;
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
                        req.send("ajx=Yes&id="+id+"&func_name=statusActiveInactive&page="+page);
		}	        
}

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

/**
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

/**
 * Function for Get emails list for export.
 */
function exportList(siteid,page) {
    var req = testXML();		
		if (req) {			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {					
					// only if "OK"
					if (req.status == 200) {											
                                            if(req.responseText == 0)
                                            {
//                                                console.log(req.responseText);
                                                document.getElementById('dynamic').style.color = '#FF0000';
                                                document.getElementById('dynamic').innerHTML = "No data Available for export.";
                                                setTimeout(function(){document.getElementById('dynamic').innerHTML = ''},3000);
                                            }
                                            else{
//                                                console.log('manish   '+req.responseText);
                                                document.getElementById('dynamic').innerHTML = '<input class="submit-green" type="submit" name="saveButton" value="Export" id="saveButton" /> ';
                                            }
					}
				}				
			}			
			req.open("POST",'index.php',true);
                        req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        req.send("ajx=Yes&id="+siteid+"&func_name=getEmailsListing&page="+page);
		}	
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

/**
 * Function for filter record active or inactive
 */
function getvaluesByStatus(status,page) {
     var req = testXML();		
		if (req) {			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {					
					// only if "OK"
					if (req.status == 200) {											
                                            if(req.responseText)
                                            {
                                                $('#myTable tbody').html(req.responseText);
//                                                document.getElementById('myTable').getElementsByTagName('tbody').innerHTML = req.responseText;
                                            }                                            
					}
				}				
			}			
			req.open("POST",'index.php',true);
                        req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                        req.send("ajx=Yes&status="+status+"&func_name=getRecordsByStatus&page="+page);
		}
}
