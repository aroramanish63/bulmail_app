<?php
session_start();



mysql_connect("localhost","askpcexp_process",'?n)*$aktFy~d')or die(mysql_error());

mysql_select_db("askpcexp_process") or die('Could not select database'.mysql_error());

//print_r($_SESSION);





       function get_query()
       {
       
        $DateFrom = $_REQUEST['DateFrom'];
		$DateTo = $_REQUEST['DateTo'];
		$FirstName = $_REQUEST['FirstName'];
		$MiddleName = $_REQUEST['MiddleName'];
		$LastName = $_REQUEST['LastName'];
		$PhoneNumber = $_REQUEST['PhoneNumber'];
		$Email = $_REQUEST['Email'];
		$Processid = $_REQUEST['Processid'];
		$Calltype = $_REQUEST['Calltype'];
		$Disposition = $_REQUEST['Disposition'];
		$Planid = $_REQUEST['Planid'];
		$Salesamount = $_REQUEST['Salesamount'];
		$Issues = $_REQUEST['Issues'];
		$Solutions = $_REQUEST['Solutions'];
		$Orderid = $_REQUEST['Orderid'];
		$Casenumber = $_REQUEST['Casenumber'];
		$Teamviewerid = $_REQUEST['Teamviewerid'];
		$Calldate = $_REQUEST['Calldate'];
		$Salesagent = $_REQUEST['Salesagent'];
		$PaymentGateway = $_REQUEST['PaymentGateway'];
		$Center = $_REQUEST['Center'];

$DateFrom = strtotime($DateFrom)+(6 * 3600)+(45/60*3600);
$DateTo = strtotime($DateTo)+(30 * 3600)+(45/60*3600)-1;


 $select_all_report_data="select * from userproocessdataz_details,users,userproocessdataz where userproocessdataz_details.Userid = users.Id and  userproocessdataz_details.Customerid = userproocessdataz.Id  " ;
    if($DateFrom)
        $select_all_report_data.=" and  UNIX_TIMESTAMP(Calldate) >=$DateFrom   ";

    if($DateTo)
        $select_all_report_data.=" and UNIX_TIMESTAMP(Calldate) <= $DateTo  ";

    if($FirstName!="")
	  {
	    $select_all_report_data.=" and Firstname like '% $FirstName %' or Lastname like '% $FirstName %' or Middlename like '% $FirstName %'    ";
	  }
	  
	   if($MiddleName!="")
	  {
	   $select_all_report_data.=" and Middlename like  '% $Middlename %'  "; 
	  } 
	  
	  if($LastName!="")
	  {
	    $select_all_report_data.=" and Lastname like '% $Lastname %'  "; 
	  }
	  
	    if($PhoneNumber!="")
	  {
	   $select_all_report_data.=" and Phonenumber like '% $PhoneNumber %'  "; 
	  }
	  
	      if($Email!="")
	  {
	    $select_all_report_data.=" and Email like  '% $Email %' "; 
	  }
      
      if($Processid!="")
	  {
	   $select_all_report_data.=" and Processid = '$Processid' ";  
	  }
	  	 if($Calltype!="")
	  {
	     $select_all_report_data.=" and Calltype ='$Calltype'";  
	  }
	  
	   if($Disposition!="")
	  {
	     $select_all_report_data.=" and Disposition ='$Disposition'";  
	  }
	   	 if($Planid!="")
	  {
	    $select_all_report_data.=" and Planid ='$Planid'";  
	  }
	   	 if($Salesamount!="")
	  {
	     $select_all_report_data.=" and Salesamount ='$Salesamount'";  
	  }
	   	 if($Orderid!="")
	  {
	    $select_all_report_data.=" and Orderid ='$Orderid'";  
	  }
	   	 if($Casenumber!="")
	  {
	    $select_all_report_data.=" and Casenumber ='$Casenumber'";  
	  }
	   	 if($Teamviewerid!="")
	  {
	     $select_all_report_data.=" and Teamviewerid ='$Teamviewerid'";  
	  }
	  
	  	 if($Calldate!="")
	  {
	    $select_all_report_data.=" and Calldate ='$Calldate'";  
	  }
	  
	  	   	 if($Salesagent!="")
	  {
	    $select_all_report_data.=" and Salesagent ='$Salesagent'";  
	  }
	  
	    	   	 if($PaymentGateway!="")
	  {
	    $select_all_report_data.=" and Paymentgateway ='$PaymentGateway'"; 
	  }
      $select_all_report_data.=" order by Calldate   desc ";
      
      return $select_all_report_data;
      
      }
      
   
    if(isset($_REQUEST['DateFrom']))
    {
    $select_all_report_data1=get_query();  
    
    session_register("select");
    $_SESSION['select']=$select_all_report_data1;
    
    }
    else
    $select_all_report_data1=$_SESSION['select'];
    
    
      
    
    
    
    
      //pagination
    $result_count=mysql_query($select_all_report_data1) or die(mysql_error());
    $total_pages=mysql_num_rows($result_count);
      		
	$targetpage = "test.php"; 	
	$limit = 20; 
//pagination
$stages = 3;
  
	if(isset($_GET['page']))
    $page = ($_GET['page']);
    else
    $page=0;
	if($page){
		$start = ($page - 1) * $limit; 
	}else{
		$start = 0;	
		}	

   	if ($page == 0){$page = 1;}
	$prev = $page - 1;	
	$next = $page + 1;							
	$lastpage = ceil($total_pages/$limit);		
	$LastPagem1 = $lastpage - 1;					
	
	
	$paginate = '';
	if($lastpage > 1)
	{	
	

	
	
		$paginate .= "<div class='paginate'>";
		// Previous
		if ($page > 1){
			$paginate.= "<a href='$targetpage&page=$prev'>previous</a>";
		}else{
			$paginate.= "<span class='disabled'>previous</span>";	}
			

		
		// Pages	
		if ($lastpage < 7 + ($stages * 2))	// Not enough pages to breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page){
					$paginate.= "<span class='current'>$counter</span>";
				}else{
					$paginate.= "<a href='$targetpage?page=$counter'>$counter</a>";}					
			}
		}
		elseif($lastpage > 5 + ($stages * 2))	// Enough pages to hide a few?
		{
			// Beginning only hide later pages
			if($page < 1 + ($stages * 2))		
			{
				for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage?page=$counter'>$counter</a>";}					
				}
				$paginate.= "...";
				$paginate.= "<a href='$targetpage?page=$LastPagem1'>$LastPagem1</a>";
				$paginate.= "<a href='$targetpage?page=$lastpage'>$lastpage</a>";		
			}
			// Middle hide some front and some back
			elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
			{
				$paginate.= "<a href='$targetpage?page=1'>1</a>";
				$paginate.= "<a href='$targetpage?page=2'>2</a>";
				$paginate.= "...";
				for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage?page=$counter'>$counter</a>";}					
				}
				$paginate.= "...";
				$paginate.= "<a href='$targetpage?page=$LastPagem1'>$LastPagem1</a>";
				$paginate.= "<a href='$targetpage?page=$lastpage'>$lastpage</a>";		
			}
			// End only hide early pages
			else
			{
				$paginate.= "<a href='$targetpage?page=1'>1</a>";
				$paginate.= "<a href='$targetpage?page=2'>2</a>";
				$paginate.= "...";
				for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage?page=$counter'>$counter</a>";}					
				}
			}
		}
					
				// Next
		if ($page < $counter - 1){ 
			$paginate.= "<a href='$targetpage?page=$next'>next</a>";
		}else{
			$paginate.= "<span class='disabled'>next</span>";
			}
			
		$paginate.= "</div>";		

}
      
      //end pagination
      
      
      $select_all_report_data1.="   LIMIT $start, $limit  ";
      
      
      
      
      $result_all_data=mysql_query($select_all_report_data1) or die(mysql_error());
      
      ?>
      <br />
      <center>Customer Data Report</center>
      <br />
      <br />
      <table id='alternatecolor'  class="altrowstable">
      <tr>
      <th>
      #
      </th>
      <th>
      Date
      </th>
      <th>
      Time
      </th>
      <th>
      Customer Name
      </th>
      <th>
      Case Number
      </th>
      <th>
      Call Type
      </th>
      <th>
      Disposition
      </th>
      <th>
      Plan Name
      </th>
      <th>
      Sales Price
      </th>
      <th>
      Order in
      </th>
      <th>
      Login Agent User
      </th>
      <th>
      Sales Agent
      </th>
      <th>
      Campaign
      </th>
      <th>
      Time
      </th>
      <th>
      Teamviewer Id
      </th>
      <th>
      Assigned To
      </th>
      <th>
      Comments
      </th>
      <th>
      Payment Gateway
      </th>
      <th>
      Center
      </th>
      </tr>
      <?php
      if(isset($_GET['page']))
      $cnt=(20*($_GET['page']-1))+1;
      else
      $cnt=1;
      
      while($fetch_data=mysql_fetch_array($result_all_data))
      {
        ?>
        <tr>
            <td>
            <?php echo $cnt; $cnt++ ?>
            </td>
            <td>
            <?php echo date("F j, Y",strtotime($fetch_data['Calldate'])); ?>
            </td>
            <td>
            <?php echo date("H:i:s",strtotime($fetch_data['Calldate'])); ?>
            </td>
            <td>
            <?php echo $fetch_data['Firstname']." ".$fetch_data['Middlename']." ".$fetch_data['Lastname']; ?>
            </td>
            <td>
            <?php echo $fetch_data['Casenumber']; ?>
            </td>
            <td>
            <?php echo $fetch_data['Calltype']; ?>
            </td>
            <td>
            <?php echo $fetch_data['Disposition']; ?>
            </td>
            <td>
            <?php echo $fetch_data['Planid']; ?>
            </td>
            <td>
             <?php echo $fetch_data['Salesamount']; ?>
            </td>
             <td>
             <?php echo $fetch_data['Orderid']; ?>
            </td>
             <td>
             <?php echo $fetch_data['Name']; ?>
            </td>
            <td>
             <?php echo $fetch_data['Salesagent']; ?>
            </td>
            <td>
             <?php echo $fetch_data['Processid']; ?>
            </td>
             <td>
            <?php echo date("H:i:s",$fetch_data['Starttime']); ?>
            </td>
             <td>
            <?php echo $fetch_data['Teamviewerid']; ?>
            </td>
             <td>
            <?php echo $fetch_data['Issues']; ?>
            </td>
             <td>
            <?php echo $fetch_data['Solutions']; ?>
            </td>
             <td>
            <?php echo $fetch_data['PaymentGateway']; ?>
            </td>
             <td>
            <?php if($fetch_data['Center']==1) echo "Noida"; else echo "Jaipur"; ?>
            </td>
        </tr>
        <?php
      }
      
      
      ?>
      
      
      </table>
      <?php
      
    echo $paginate;

?>

<script type="text/javascript">
function altRows(id){
	if(document.getElementsByTagName){  
		
		var table = document.getElementById(id);  
		var rows = table.getElementsByTagName("tr"); 
		 
		for(i = 0; i < rows.length; i++){          
			if(i % 2 == 0){
				rows[i].className = "evenrowcolor";
			}else{
				rows[i].className = "oddrowcolor";
			}      
		}
	}
}
window.onload=function(){
	altRows('alternatecolor');
    
}
</script>


<style type="text/css">
table.altrowstable {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #a9c6c9;
	border-collapse: collapse;
}
table.altrowstable th {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #a9c6c9;
}
table.altrowstable td {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #a9c6c9;
}
.oddrowcolor{
	background-color:#d4e3e5;
}
.evenrowcolor{
	background-color:#c3dde0;
}


</style>
<style>
.paginate {
font-family:Arial, Helvetica, sans-serif;
	padding: 3px;
	margin: 3px;
}

.paginate a {
	padding:2px 5px 2px 5px;
	margin:2px;
	border:1px solid #999;
	text-decoration:none;
	color: #666;
}
.paginate a:hover, .paginate a:active {
	border: 1px solid #999;
	color: #000;
}
.paginate span.current {
    margin: 2px;
	padding: 2px 5px 2px 5px;
		border: 1px solid #999;
		
		font-weight: bold;
		background-color: #999;
		color: #FFF;
	}
	.paginate span.disabled {
		padding:2px 5px 2px 5px;
		margin:2px;
		border:1px solid #eee;
		color:#DDD;
	}
	
	
	
</style>