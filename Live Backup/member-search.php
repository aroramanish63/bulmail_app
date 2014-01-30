<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Databagg</title>
<link type="text/css" href="css/style-admin.css" rel="stylesheet" />
 <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
  <link href='fonts/font.css' rel='stylesheet' type='text/css'>
  
  <!--Drop down menu start here-->
  
<link rel="stylesheet" type="text/css" href="css/dropdownmenu.css" />


<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/dropdownmenu.js">

/***********************************************
* Smooth Navigational Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>

<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "smoothmenu1", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'menu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

ddsmoothmenu.init({
	mainmenuid: "smoothmenu2", //Menu DIV id
	orientation: 'v', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu-v', //class added to menu's outer DIV
	method: 'toggle', // set to 'hover' (default) or 'toggle'
	arrowswap: true, // enable rollover effect on menu arrow images?
	//customtheme: ["#804000", "#482400"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

</script>
  <!--Drop down menu end here-->
  
</head>

<body>
<!--header start here-->
<?php include 'header.php'; ?>
<!--header end here-->
<div class="page-wrap">
<div class="wrapper">
<!--full conatiner first start here-->
<div class="full-conatiner">
	<div class="heading">Member Search</div>
    <div class="blue-container">
    
    <div class="container-row">
    <div class="search-colums1">
    <div class="search-box"><input type="checkbox" />Individual Having Plan</div>
    <div class="search-box"><input type="checkbox" />Business Having Plan</div>
    
     <div class="search-box"><select style="margin-left:0px !important;">
     	<option>Option1</option>
     </select></div>
    
    </div>
    
    
    
    
    <div class="search-colums1">
    <div class="search-box">Where<select>
    	<option value="txt_first_name" selected="">Name</option>
      <option value="txt_email">Email</option>
      <option value="txt_phone">Phone</option>
      <option value="txt_country">Country</option>
    	</select></div>
         <div class="search-box"><input type="text" class="input2" /></div>
    </div>
    
    
    
    
    
    
    
    
    <div class="search-colums1" style="border-right:none;">
    
    <div class="date-search">
    <div class="search-box"><input type="checkbox" name="regbetween" value="ON" id="regbetween">Registered Between
    <br>
     From
          <input type="text" name="int_from_date" size="8" id="int_from_date" class="formfield_date" readonly="" onkeydown="dateUpDownHandler(event,this)" autocomplete="off" value="05/10/2013">
          <a class="date-icon" href="javascript:displayDatePicker('int_from_date',false,'mdy','/')"><img width="21" height="16" align="absmiddle" style="cursor:pointer;cursor:hand" src="../images/calander.jpg"></a>
        <br>
        To&nbsp;&nbsp;&nbsp;&nbsp;
          <input type="text" name="int_to_date" size="8" id="int_to_date" class="formfield_date" readonly="" onkeydown="dateUpDownHandler(event,this)" autocomplete="off" value="05/10/2013">
          <a class="date-icon" href="javascript:displayDatePicker('int_to_date',false,'mdy','/')"><img width="21" height="16" align="absmiddle" style="cursor:pointer;cursor:hand" src="../images/calander.jpg"></a>&nbsp;&nbsp;&nbsp;
      
    </div>
    </div>
    
   
    </div>
    
    </div>
    
    <div class="container-row">
    
    <div class="search-colums2">
    <div class="search-box">Show Only
    <br>
    <input type="checkbox" name="blck_tick">Block Members <br>
    <input type="checkbox" name="unblck_tick">Unblock Members
    </div>
         </div>
     <div class="show-button"><input type="submit" class="button-green" value="Show" name="B1"></div>
    </div>
    
    
    
    
    
    
    
    
    </div>
    
    <div class="table-container">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table-section1">
  <tr>
    <td width="10%" style="font-size:14px !important; font-weight:bold;">S.No.</td>
    <td width="30%" style="font-size:14px !important; font-weight:bold;">Client Details</td>
    <td width="20%" style="font-size:14px !important; font-weight:bold;">Reg. Date</td>
    <td width="20%" style="font-size:14px !important; font-weight:bold;">Plan Details</td>
    <td style="font-size:14px !important; font-weight:bold;">Action</td>
  </tr>
  
   <tr>
    <td>1.</td>
    <td>Client Details</td>
    <td>Reg. Date</td>
    <td>Plan Details</td>
    <td class="actionlink"><a onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'" href="javascript:void(0)">Edit</a> <a href="#">Block</a> <a href="#" >Dashboard</a></td>
   
  </tr>
  
   <tr>
    <td>2.</td>
    <td>Client Details</td>
    <td>Reg. Date</td>
    <td>Plan Details</td>
    <td class="actionlink"><a href="#">Edit</a> <a href="#">Block</a> <a href="#">Dashboard</a></td>
  </tr>
  
  
 
</table>
<div class="paginations">
	<a  href="#"><< Prev</a><a class="active" href="#">1</a><a href="#">2</a><a href="#">3</a> <a href="#">Next >></a>
</div>
</div>
</div> 
<!--full conatiner first end here-->
   <div class="profile-container" id="light" style="display:none;">
  
   <a onclick="document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none';if(document.getElementById('upd').value=='1')location.reload();" href="javascript:void(0)" style="float:right;">
        
       <img src="images/close_u.png">
        
        </a>
         <h1>Profile Details</h1>
   <form class="form-container">
            <ul>
         
             <li>  <label>First Name :</label>
            <input type="text" id="txt-firstname" name="txt-firstname" class="large-input" /></li>
            
            <li>  <label>Last Name :</label>
            <input type="text" id="txt-lastname" name="txt-lastname" class="large-input" /></li>
            
            <li>  <label>Company :</label>
            <input type="text" id="txt-company" name="txt-company" class="large-input" /></li>
            
             <li>  <label>Designation :</label>
            <input type="text" id="txt-designation" name="txt-designation" class="large-input" /></li>
            
             <li>  <label>Phone :</label>
            <input type="text" id="txt-phone" name="txt-phone" class="large-input" /></li>
            
             <li>  <label>Address :</label>
            <textarea class="textarea-input" id="txt-address" name="txt-address" rows="20" cols="5"></textarea></li>
            
           
            <li>  <label>Country :</label>
            <select class="select-input">
            	<option>India</option>
            </select></li>
            
             <li>  <label>State :</label>
            <input type="text" id="txt-state" name="txt-state" class="large-input" /></li>
             <li>  <label>City :</label>
            <input type="text" id="txt-city" name="txt-city" class="large-input" /></li>
            <li>  <label>Zip :</label>
            <input type="text" id="txt-zip" name="txt-zip" class="large-input" /></li>
            
      
              <li>
              <label>&nbsp;</label>
              <input type="submit" class="button-green" value="Update" /> <input type="submit" class="button-red" value="Cancel" /> 
             
              </li>
            </ul>
            </form>
   </div>
   <div class="black_overlay" id="fade" style="display: none;"></div>
    <div class="clear"></div>

</div>

</div>
<!--footer Continer start here--> 
<?php include 'footer.php'; ?>
<!--footer Continer end here--> 
</body>
</html>
