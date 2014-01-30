var url = window.location.href;  
url = url.replace("http://", "");   
var urlExplode = url.split("/");  
var serverName = urlExplode[0];  
serverName = 'http://'+serverName+'/imszend/main/public/';

//alert(serverName);

//General

function show(str4,StrModule4,StrContoller4,StrAction4,StrId4,Id4InnerHtml)
{
//alert(str4);
if (str4.length==0)
  {
/*  document.getElementById(Id4InnerHtml).innerHTML="";
  return;*/
  
  return false;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById(Id4InnerHtml).innerHTML=xmlhttp.responseText;
    }
  }

xmlhttp.open("GET",serverName+StrModule4+'/'+StrContoller4+'/'+StrAction4+'/'+StrId4+'/'+str4,true);
xmlhttp.send();
}



// Validations

function showvalidation(str5,StrModule5,StrContoller5,StrAction5,StrId5,Id5InnerHtml)
{
	//var str5 = '11^PO^SD^1';
	var mySplitResult = str5.split("^");
 if(mySplitResult[0]=='')
  {
	   alert('Please select the values from drop down');
	   //alert(str5.length);
	   return false;
 }
  else if(mySplitResult[1]=='')
  {
	   alert('Please select the values from drop down');
	   //alert(str5.length);
	   return false;
 }
  else if(mySplitResult[2]=='')
  {
	   alert('Please select the values from drop down');
	   //alert(str5.length);
	   return false;
 }
else if(mySplitResult[3]=='')
  {
	   alert('Please select the values from drop down');
	   //alert(str5.length);
	   return false;
 }
 else
 {
	if (str5.length==0)
	  {
	  document.getElementById(Id5InnerHtml).innerHTML="";
	  return;
	  }
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		document.getElementById(Id5InnerHtml).innerHTML=xmlhttp.responseText;
		}
	  }
	
	xmlhttp.open("GET",serverName+StrModule5+'/'+StrContoller5+'/'+StrAction5+'/'+StrId5+'/'+str5,true);
	xmlhttp.send();
 }
}



