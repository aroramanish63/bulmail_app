var htmltag_sep_char=";;--m-s--;;;;--m-s--;;;;--m-s--;;;;--m-s--;;;;--m-s--;;";
function setData()
	{
	var islocmulti=false
	for(ii=0;ii<datafields.length;ii++)
		{
		try
			{
			if(document.getElementById(datafields[ii]).type=="checkbox")
				{
				if(parseInt(data[ii])==0)
					document.getElementById(datafields[ii]).checked=false
				else
					document.getElementById(datafields[ii]).checked=true
				}

			else if(document.getElementById(datafields[ii]).type=="radio")
				{
				try
					{
					for(jj=0;jj<document.getElementsByName(datafields[ii]).length;jj++)
						{
						if(document.getElementsByName(datafields[ii])[jj].value==data[ii])
							{
							document.getElementsByName(datafields[ii])[jj].checked=true
							break;
							}
						}
					}
				catch(e)
					{
					if(document.getElementById(datafields[ii])[jj].value==data[ii])
						document.getElementById(datafields[ii]).checked=true
					}
				}

			else if(document.getElementById(datafields[ii]).type=="select-one")
				{
				setSelectedCombo(document.getElementById(datafields[ii]),data[ii])
				if(document.getElementById(datafields[ii]).name=="int_state_id")
					selectState(document.getElementById("int_country_id").options[document.getElementById("int_country_id").selectedIndex].value,document.getElementById(datafields[ii]).options[document.getElementById(datafields[ii]).selectedIndex].value)
				}
			else if(document.getElementById(datafields[ii]).type=="select-multiple")
				setSelectedComboMulti(document.getElementById(datafields[ii]),data[ii].split(","))
			else if(document.getElementById(datafields[ii]).type=="textarea")
				document.getElementById(datafields[ii]).value=parseEscapeString(data[ii])
			else if(document.getElementById(datafields[ii]).type=="text")
				document.getElementById(datafields[ii]).value=parseEscapeString(data[ii])
			else
				document.getElementById(datafields[ii]).value=data[ii]
			}
		catch(e)
			{
			}

		}

	}

function parseEscapeString(str1)
	{
	tempstr=str1.split(htmltag_sep_char);
	str1="";
	for(m=0;m<tempstr.length;m++)
		{
		if(m==0)
			str1=tempstr[m];
		else
			str1=str1+"<"+tempstr[m];
		}
	tempstr=str1.split("<bn>");
	str1="";
	for(m=0;m<tempstr.length;m++)
		{
		if(m==0)
			str1=tempstr[m];
		else
			str1=str1+"\n"+tempstr[m];
		}
	tempstr=str1.split("<brn>");
	str1="";
	for(m=0;m<tempstr.length;m++)
		{
		if(m==0)
			str1=tempstr[m];
		else
			str1=str1+tempstr[m];
		}
	tempstr=str1.split("<qot>");
	str1="";
	for(m=0;m<tempstr.length;m++)
		{
		if(m==0)
			str1=tempstr[m];
		else
			str1=str1+"\""+tempstr[m];
		}
	return str1;
	}

function setSelectedCombo(cmb,str1)
	{
	for(kk=0;kk<cmb.options.length;kk++)
		{
		if(cmb.options[kk].value==str1)
			{
			cmb.selectedIndex=kk
			break;
			}
		}
	}

function setSelectedComboMulti(cmb,arr1)
	{
	for(k=0;k<arr1.length;k++)
		{
		for(l=0;l<cmb.options.length;l++)
			{
			if(cmb.options[l].value.toString()==arr1[k].toString())
				{
				cmb.options[l].selected=true
				break;
				}
			}
		}
	}


// ========================================***********************************

function trim_string(obj) {
     var ichar, icount;
     var strValue = obj.value
     ichar = strValue.length - 1;
     icount = -1;
     while (strValue.charAt(ichar)==' ' && ichar > icount)
         --ichar;
     if (ichar!=(strValue.length-1))
         strValue = strValue.slice(0,ichar+1);
     ichar = 0;
     icount = strValue.length - 1;
     while (strValue.charAt(ichar)==' ' && ichar < icount)
         ++ichar;
     if (ichar!=0)
         strValue = strValue.slice(ichar,strValue.length);
     return strValue;
 }

function trim_string_str(str1) {
     var ichar, icount;
     var strValue = str1
     ichar = strValue.length - 1;
     icount = -1;
     while (strValue.charAt(ichar)==' ' && ichar > icount)
         --ichar;
     if (ichar!=(strValue.length-1))
         strValue = strValue.slice(0,ichar+1);
     ichar = 0;
     icount = strValue.length - 1;
     while (strValue.charAt(ichar)==' ' && ichar < icount)
         ++ichar;
     if (ichar!=0)
         strValue = strValue.slice(ichar,strValue.length);
     return strValue;
 }


function allowOnlyCharKeys(e)
{
var key = parseInt(e.keyCode);
if((key < 65 || key > 90) && (key < 97 || key > 122 ))
	{
	e.keyCode=0;
	}
}

function allowOnlyNumKeys(e)
{
var key = parseInt(e.keyCode);
if((key < 48 || key > 57))
	{
	e.keyCode=0;
	}
}


function allowNumAndCharKeys(e)
{
var key = parseInt(e.keyCode);
if((key < 65 || key > 90) && (key < 97 || key > 122 ) && (key < 48 || key > 57) )
	{
	e.keyCode=0;
	}
}


function checkValidBirthDate(dd,mm,yy)
{
var monthDays="31,28,31,30,31,30,31,31,30,31,30,31".split(",")

var d=parseInt(dd.options[dd.selectedIndex].value)
var m=parseInt(mm.options[mm.selectedIndex].value)
var y=parseInt(yy.options[yy.selectedIndex].value)

if(y%4==0)
	monthDays[1]=29;

if(d>parseInt(monthDays[m-1]))
	{
	alert("The month you have selected only have " + monthDays[m-1] + " days.")
	dd.focus()
	return false;
	}

return true
}

function checkDateLessCurrent(dd,mm,yy,checkdate,focusobj)
	{

	if(mm.length<2)
		mm="0"+mm
	if(dd.length<2)
		dd="0"+dd
	var todate=yy + "" + mm + "" + dd;
	todate=parseFloat(todate)
	checkdate=parseFloat(checkdate)
	if(todate<checkdate)
		{
		alert("Publish date should not be less than today date")
		focusobj.focus()
		return false
		}
	return true
	}

var chars_type_1="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
var chars_type_2="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
var chars_type_3="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789._@-()#!$%/ ";
var chars_type_4="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789#,./?!;:'+=-_)(*&%$@\n\r\t\"";
var chars_type_5="0123456789";
var chars_type_6="0123456789.";
var chars_type_7="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789._@-()#!$%";

function checkValidText(obj,disptext,allowblank,charsallowed,emailfield,allowspace,minlength,maxlength,minvalue,maxvalue,checkvalue,checkstart)
	{
	// Function checkValidText Parameters 
	// Text Object , Alert Display Value, Allow Blank, Allowed Characters, Email Field, Allow Space, Min Length, Max Length	, MinValue , MaxValue, Checkvalue, Check Starting Letter
	var objvalue=trim_string(obj);
	obj.value=objvalue

	if(objvalue=="" && allowblank==true)  // Return True IF Allowed Blank
		return true;
	else if(objvalue=="")
		{
		alert("Please fill " + disptext + " field.");
		obj.focus()
		obj.select()
		return false
		}
	
	if(emailfield==true)
		{
		if(!checkValidEmail(obj))
			return false
		}

	if(allowspace==true)
		charsallowed+=" ";
	if(!checkCharsAllowed(objvalue,charsallowed,obj))
		return false

	if(objvalue.length<minlength && minlength>0)
		{
		alert("Please enter at least " + minlength + " characters in " + disptext + " field.")
		obj.select()
		obj.focus()
		return false
		}

	if(objvalue.length>maxlength && maxlength>0)
		{
		alert("Only " + maxlength + " characters are allowed in " + disptext + " field.")
		obj.select()
		obj.focus()
		return false
		}

	
	if(checkvalue==true)
		{
		if(parseFloat(objvalue)<minvalue || parseFloat(objvalue)>maxvalue)
			{
			alert("Please enter a numeric value between " + minvalue + " and " + maxvalue)
			obj.focus()
			obj.select()
			return false
			}
		}


	if(!checkStartLetter(obj,objvalue,checkstart,disptext))
		return false


	return true
	}

function checkStartLetter(obj,objvalue,checkstart,disptext)
	{
	if(checkstart!="")
		{
		var startarr=checkstart.split("|");
		var startchars=startarr[0]
		var startflag=startarr[1]

		for(i=0;i<startchars.length;i++)
			{
			if(startflag=="yes")
				{
				if(objvalue.charAt(0).toLowerCase()!=checkstart.charAt(i))
					{
					alert("Please enter the value staring with " + startchars + " in " + disptext + " field.")
					obj.select()
					obj.focus()
					return false
					}
				}
			else
				{
				if(objvalue.charAt(0).toLowerCase()==checkstart.charAt(i))
					{
					alert("Please do not enter the value staring with " + startchars + " in " + disptext + " field.")
					obj.select()
					obj.focus()
					return false
					}
				}
				
			}
		}

	return true;
	}


function checkCharsAllowed(objvalue,charsallowed,obj)
{
var str=objvalue
for(i=0;i<str.length;i++)
	{
	if(charsallowed.indexOf(str.charAt(i))==-1)
		{
		alert("You are only allowed to enter the following characters\n" + charsallowed)
		obj.focus()
		obj.select()
		return false
		}
	}
return true
}


function checkValidEmail(obj)
	{
obj.value=trim_string(obj)
    if(obj.value.length == 0)
	{
        alert("Email is required");
	obj.focus();
        return false;    
	}

    if(obj.value.indexOf("@",0) < 0)
			{
			alert('Please Enter Valid Email Aaddress!');	
			obj.focus();	
			return false;
			}
	if(obj.value.indexOf(".",0) < 0)
		{
		alert('Please Enter Valid Email Aaddress!');
		obj.focus();		
		return false;
		}
	if(obj.value.indexOf(" ",0) >= 0)
		{
		alert('Email Cannot Have Spaces');
		obj.focus();
		return false;
		}
	return true;
	}


function checkSelectedCombo(obj,disptext)
	{
	if(obj.selectedIndex<0)
		{
		alert("Please select " + disptext + " field.")
		obj.focus()
		return false
		}
	return true
	}

function selectTextField(obj)
	{
	obj.select()
	}

function openClientWindow(urlname,params,wid,ht,lft,tp,winname)
	{
	window.open("client_window.php?id="+urlname+params,winname,"scrollbars=yes,toolbar=no,top="+tp+",left="+lft+",width="+wid+",height="+ht)
	}

function SiteopenClientWindow(urlname,params,wid,ht,lft,tp,winname)
	{
	window.open("members/client_window.php?pagename="+urlname+params,winname,"scrollbars=yes,toolbar=no,top="+tp+",left="+lft+",width="+wid+",height="+ht)
	}

function checkRadios(obj)
	{
	var isfound=false
	for(mm=0;mm<obj.length;mm++)
		{
		if(obj[mm].checked==true)
			isfound=true
		}
	
	if(isfound==false)
		return false;

	return true;
	}


function checkPasswordValue(pwd,id)
	{
	var navapptemp=navigator.appName.toLowerCase();
	if(navapptemp.indexOf('microsoft')==-1)
		var temphttp = new XMLHttpRequest();
	else
		var temphttp = new ActiveXObject("Microsoft.XMLHTTP");

	var tempresponse="";
	var myurl = "checkpassword.php?pwd=" + pwd + "&id=" + id;
	tempresponse=""
	temphttp.open("GET", myurl , false);
	temphttp.send(null);
	return temphttp.responseText;
	}


// GET The Browser Name
function getBrName()
	{
	/*
	var navapp=navigator.appName.toLowerCase();
	if(navapp.indexOf('microsoft')==-1)
		return "fire";
	else
		return "ie";
	*/

	var navapp=navigator.userAgent.toLowerCase();
	if(navapp.indexOf('msie')!=-1)
		return "ie";
	else if(navapp.indexOf('firefox')!=-1)
		return "fire";
	else if(navapp.indexOf('chrome')!=-1)
		return "chrome";
	else
		return "other";
	}

// GET THE XML OBJECT BY BROWSER
function getXMLObject()
	{
	var navapp=navigator.appName.toLowerCase();
	if(navapp.indexOf('microsoft')==-1)
		var xhttp = new XMLHttpRequest();
	else
		var xhttp = new ActiveXObject("Microsoft.XMLHTTP");
	return xhttp;
	}


// GET RESPONSE TEXT FROm ANY FILE
function getResponseText(urlpath)
	{
	var temphttp = getXMLObject();
	var tempresponse="";
	var myurl = urlpath;
	tempresponse=""
	temphttp.open("GET", myurl , false);
	temphttp.send(null);
	return temphttp.responseText;
	}

function getRowTypeDisplay()
	{
	if(getBrName()=="ie")
		return "block";
	else
		return "table-row";
	}


function validateFileExtension(fld) 
	{
	if(!/(\.png|\.gif|\.jpg|\.jpeg)$/i.test(fld.value)) 
		{
		alert("You should choose atleast one valid image file type.");
		fld.focus();
		return false;
		}
	return true;
	}


function comboDataTransfer(thisobj,thisstind,trfobj,trfstind)
	{
	// thisobj is Combo from where data exists
	// trfobj  is where data is transferred
	// thisstind  is thisobj start index
	// trfstind is trfobj start index

	if(thisobj.selectedIndex<thisstind)
		return;
	var opt=document.createElement("option")
	opt.innerHTML=thisobj.options[thisobj.selectedIndex].text;
	opt.value=thisobj.options[thisobj.selectedIndex].value;
	trfobj.appendChild(opt)
	
	thisobj.removeChild(thisobj.options[thisobj.selectedIndex])
	}


function setMultiComboListByDatabase(thisobj,trfobj,str1)
	{
	for(i=0;i<datafields.length;i++)
		{
		if(datafields[i]==str1)
			{
			var temp=data[i].split(",")
			break;
			}
		}
	
	for(j=0;j<temp.length;j++)	
		{
		for(i=0;i<thisobj.options.length;i++)
			{
			if(thisobj.options[i].value==temp[j])
				{
				var opt=document.createElement("option")
				opt.innerHTML=thisobj.options[i].text;
				opt.value=thisobj.options[i].value;
				trfobj.appendChild(opt)
	
				thisobj.removeChild(thisobj.options[i])
				break;
				}
			}
		}
	}



function showDynaDisplay(str1,str2)
	{
	var obj=document.getElementById(str1)
	var dynaobj=document.getElementById(str2)
	var x=findPosX(obj)
	var y=findPosY(obj)
	dynaobj.style.display=getRowTypeDisplay()
	dynaobj.style.left=(x+obj.offsetWidth)-(parseInt(dynaobj.offsetWidth))
	dynaobj.style.top=y+parseInt(obj.offsetHeight)+5
	dynaobj.style.display=getRowTypeDisplay()
	}

function hideDynaDisplay(str1)
	{
	var dynaobj=document.getElementById(str1)
	dynaobj.style.display="none"
	}

function findPosX(obj)
  {
    var curleft = 0;
    if(obj.offsetParent)
        while(1) 
        {
          curleft += obj.offsetLeft;
          if(!obj.offsetParent)
            break;
          obj = obj.offsetParent;
        }
    else if(obj.x)
        curleft += obj.x;
    return curleft;
  }


function findPosY(obj)
	{
	var curtop = 0;
	if(obj.offsetParent)
		{
		while(1)
			{
			curtop += obj.offsetTop;
			if(!obj.offsetParent)
				break;
			obj = obj.offsetParent;
			}
		}
	    else if(obj.y)
        	curtop += obj.y;

	return curtop;
	}

function m_setMultiSelectedComboValues(objcombo,objvalue,objtext,chsep)
	{
	var tempvalue=""; var temptext="";
	for(i=0;i<objcombo.options.length;i++)
		{
		if(tempvalue=="")
			{
			tempvalue=objcombo.options[i].value + ","
			temptext=objcombo.options[i].text + chsep
			}
		else
			{
			tempvalue=tempvalue + objcombo.options[i].value + ","
			temptext=temptext + objcombo.options[i].text + chsep
			}
		}
	objvalue.value=tempvalue
	objtext.value=temptext
	}


function checkValidExtension(obj,exts)
	{
	obj.value=trim_string(obj)
	if(obj.value=="")
		return true
	var ext=obj.value.substring(obj.value.lastIndexOf(".")+1,obj.value.length).toLowerCase()
	for(s=0;s<exts.length;s++)
		{
		if(ext==exts[s])
			return true
		}
	
	var temp="";
	for(s=0;s<exts.length;s++)
		{
		if(temp=="")
			temp=exts[s]
		else
			temp+=","+exts[s]
		}	

	alert("You are trying to attach an invalid file. Please correct and try again.\nValid extensions are " + temp)
	return false
	}


function contact_highlight(obj,str1)
	{
	obj.className=str1
	}

function arttitle_highlight(obj,str1)
	{
	obj.style.color=str1
	}


// -----------------------------Start Date Code DATE PICKER-----------------

function dateUpDownHandler(e,obj)
	{
	var kcode = (e.which) ? e.which : event.keyCode
	if(kcode==38)
		{
		obj.value=getDateOfNextDay(obj.value, "/", false,false)
		}
	else if(kcode==40)
		{
		obj.value=getDateOfNextDay(obj.value, "/", false,true)
		}
	}


function getDateOfNextDay(datestring, separator, nozero,ispre)
	{  
	if(!separator)
		{  
		separator="/";//="yyyy-mm-dd" format   
		}  

	var a_date = datestring.split(separator);

	var myday = new Date(a_date[0]+'/'+a_date[1]+'/'+a_date[2]);  

	if(ispre)
		myday.setDate(myday.getDate()-1); 
	else
		myday.setDate(myday.getDate()+1); 
   
	var next_day_year = myday.getFullYear();  


	var next_day_month = myday.getMonth()+1; 
   
	if(!nozero)   
		{  
		next_day_month = (parseInt(next_day_month)<10)?"0"+next_day_month:next_day_month;  
		}  

	var next_day_day = myday.getDate();  

	next_day_day = (parseInt(next_day_day)<10)?"0"+next_day_day:next_day_day;  

	return next_day_month+"/"+next_day_day+"/"+next_day_year;  
	} 


function convertDateFromNumber(obj,dformat,sepch)
	{
	var dtarr=new Array(3);
	if(obj.value.indexOf("/")!=-1)
		return;
	obj.value=obj.value.toString()
	dtarr[0]=obj.value.substring(0,4);
	dtarr[1]=obj.value.substring(4,6);
	dtarr[2]=obj.value.substring(6,8);

	//alert(obj.value + " " + dtarr[0] + " " + dtarr[1] + " " + dtarr[2])

	if(dformat=="mdy")
		obj.value=dtarr[1] + "" + sepch + "" + dtarr[2] + "" + sepch + "" + dtarr[0];
	else if(dformat=="dmy")
		obj.value=dtarr[2] + sepch + dtarr[1] + sepch + dtarr[0];
	else if(dformat=="ymd")
		obj.value=dtarr[0] + sepch + dtarr[1] + sepch + dtarr[2];

	}


// xxxxxxxxxxxxxxxxxxxxxxxxxxxxxEND Date COde -------------------


function matri_setMultiSelectedComboValues(objcombo,objvalue,objtext)
	{
	var tempvalue=""; var temptext="";
	for(i=0;i<objcombo.options.length;i++)
		{
		if(tempvalue=="")
			{
			tempvalue=objcombo.options[i].value
			temptext=objcombo.options[i].text
			}
		else
			{
			tempvalue=tempvalue + "," + objcombo.options[i].value
			temptext=temptext + "," + objcombo.options[i].text
			}
		}
	objvalue.value=tempvalue
	objtext.value=temptext
	}