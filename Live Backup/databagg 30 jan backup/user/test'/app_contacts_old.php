<?php
if(!isset($_REQUEST["member_id"]))
{
    
}
else
$_SESSION["user_id"]=$_REQUEST["member_id"];
if(!isset($_REQUEST["pid"]))
	$pid=0;
else
	$pid=$_REQUEST["pid"];
?>

<?php
function checkduplicate($email)
{
    $select_email="select * from users_contact where txt_contact_email='".trim($email)."' and int_uid='".$_SESSION['user_id']."'";
    $result_email=mysql_query($select_email);
    if(mysql_num_rows($result_email)==0)
    return true;
    else
    return false;
}

if(isset($_REQUEST['txt_contact_email']))
{
    if(checkduplicate($_REQUEST['txt_contact_email']))
    {
    $insert_query="insert into users_contact (int_uid,txt_contact_name,txt_contact_email)values('".$_SESSION['user_id']."','".$_REQUEST['txt_contact_name']."',
    '".$_REQUEST['txt_contact_email']."')";
    mysql_query($insert_query);
    $msg= "Contact added successfully.";
    }
    else
    $msg= "Contact allready exists.";
}
?>

<?php
if(isset($_REQUEST['del_id']))
{
    $delete_contact="delete from users_contact where int_contact_id='".$_REQUEST['del_id']."'";
    mysql_query($delete_contact) or die(mysql_error());
    $msg= "Contact deleted successfully.";
}
?>
<script type="text/javascript" src="js/jquery.js"></script>
<style>
.login_error{
    color:red;
 }
.tablesorter_bg
{background-color: #FFFFFF;
    font-family: PT Sans;
    font-size: 13px;
    margin: 10px 0 15px;
    text-align: left;
    
}
table {
    border-collapse: collapse;
    border-spacing: 0;
}
</style>
<br>
<h2>Contacts List</h2>

<?php
if(isset($msg))
echo $msg;
?>
<div class="sub_container" >
 <style>

.sub{
background:url(images/addcontactbut.png);
background-position:left top;
border:none;
    color: #555454;
    cursor: pointer;
    font-family: PT Sans;
    font-size: 13px;
    height: 34px;
    margin-left:10px;
    padding: 0;
    text-align: center;
    width: 117px;
}.sub:hover { background-position:left -34px;}
.sub1{
background:url(images/add_button.png);
background-position:left top;
border:none;
    
    cursor: pointer;
    
    height: 34px;
    margin-top: 5px;
    padding: 0;
    
    width: 63px;
}
.sub1:hover { background-position:left -34px;}
.gmail_input
{border: 1px solid #BEBEBE;
    color: #666666;
    display: block;
    font-family: PT Sans;
    font-size: 13px;
    height: 24px;
    width: 200px;}
</style>
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
</head>
<body>
<button class="sub" style="margin-bottom: 20px;" ></button>

 <div id="error_email" class="login_error" style="display: none;position: absolute;margin-top: 95px;">
Enter your email
</div>

<form id="form1" name="form1" action="#" method="post" style="margin-left:10px;">
       <p style="display: none;">
        <label for="name">Contact Name:</label>
       
        <input type="text" id="txt_contact_name" name="txt_contact_name" class="gmail_input" />
        <br />
        
        <label for="username" >E-mail:</label>
       <input type="text" id="txt_contact_email" name="txt_contact_email" class="gmail_input" />
        
       
        
        <input type="button" value="" onClick="submit_form1();"  class="sub1">
        
         
        </p>
        <input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
        
        </form>


<script>
$("button").click(function () {
    
$("p").toggle("slow");
 $('#error_email').fadeOut('slow');
});
</script>

<?php
$list_contact="select * from users_contact where int_uid='".$_SESSION['user_id']."' ";
$list_result=mysql_query($list_contact) or die(mysql_error());
while($row=mysql_fetch_array($list_result))
	{
?>
<div class="main">

<div class="icon_sep">
	<h4>
<?php echo $row['txt_contact_name']; ?>
</h4>
    <h6><?php echo $row['txt_contact_email']; ?> </h6>
</div>

<div class="share_btns">
<a href="javascript:cnfrm_del('<?php echo $row['int_contact_id'];  ?>')"><img src="image/delete.png" title="Delete Contact" style="margin-top: 3px;" /> </a>
</div>
</div>

<?php
	}
?>


</div>
<script>
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
            
            function specialcharecterforemail(val)

            {

                var iChars = "!`#$%^&*()+=-[]\\\';,/{}|\":<>?~";   

                var data = val;

                for (var i = 0; i < data.length; i++)

                {      

                    if (iChars.indexOf(data.charAt(i)) != -1)

                    {    

                     return false; 

                    } 

                }
                return true;

            }
function submit_form1()
{document.getElementById("error_email").style.display='none';
    
    if(trim_string_str(document.getElementById("txt_contact_email").value)=="")
    {
         $('#error_email').fadeIn('slow');
        //document.getElementById("error_email").style.display='block';
        document.getElementById("txt_contact_email").focus();
        return false;
    }
    if(!specialcharecterforemail(document.getElementById("txt_contact_email").value))
    {
          $('#error_email').fadeIn('slow');
         //document.getElementById("error_email").style.display='block';
         document.getElementById("error_email").innerHTML="Remove special chars"
        document.getElementById("txt_contact_email").focus();
        return false;
    }
    if(trim_string_str(document.getElementById("txt_contact_email").value)!="")
    {
        var x=document.getElementById("txt_contact_email").value;
        var atpos=x.indexOf("@");
        var dotpos=x.lastIndexOf(".");
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
             {
                 $('#error_email').fadeIn('slow');
                //document.getElementById("error_email").style.display='block';
                document.getElementById("error_email").innerHTML="Enter valid email.";
              document.getElementById("txt_contact_email").focus();
                return false;
             }
    }
    
    
    document.form1.submit();
}
function cnfrm_del(id)
{
    if(confirm("Are you sure to delete this contact ?"))
    location.href="app_index.php?name_page=app_contacts&del_id="+id;
}
</script>

