<?
define("HTMLTAG_SEP_CHAR",";;--m-s--;;;;--m-s--;;;;--m-s--;;;;--m-s--;;;;--m-s--;;");
function getAccess()
	{
	if(isset($_SESSION["acc_user"]))
		return true;
	else
		return false;
	}

function getSessionValue($vari)
	{
	return $_SESSION["real_".$vari];
	}

function getThisScriptName()
	{
	$tscrpath=explode("/",$_SERVER["PHP_SELF"]);
	$tscrname=$tscrpath[count($tscrpath)-1];
	return $tscrname;
	}

function wr($str1)
	{
	return stripslashes(trim($str1));
	}

function wrNum($str1,$num)
	{
	$str1=round($str1,0);
	return number_format($str1,$num,".","");
	}

function setNumberFormat($num)
	{
	return number_format($num,2,".","");
	}

function wrSpecial($str1)
	{
	$str1=trim($str1);
	$temp=str_replace("\n","<br>",$str1);
	return stripslashes($temp);
	}

function wrZeroOneValue($str1,$zero,$one)
	{
	if($str1=="0")
		return $zero;
	else
		return $one;
	}

function parseTheString($str1,$maxlen)
	{
	$newstr=mysql_real_escape_string(trim($str1));
	if($maxlen=="inf" || $maxlen=="")
		return $newstr;
	else
		return substr($newstr,0,strlen($newstr));
	}

function setLength($str1,$num) // Set the length of a string to the desired number of characters by adding a traling zero at the beginning of the string
	{
	$temp="";
	if(strlen($str1)<$num)
		{
		for($m=$num;$m>strlen($str1);$m--)
			$temp=$temp . "0";
		}
	$finalStr=$temp . $str1;
	return $finalStr;
	}
	
function setDateFormat($thedate)  // CONVERT int date to mm/dd/yyyy format
	{
	$mdays=explode(",","Jan,Feb,Mar,Apr,May,Jun,Jul,Aug,Sept,Oct,Nov,Dec");
	$thedate=setLength($thedate,8);
	if($thedate=="" || $thedate==0)
		return "";
	else
		return substr($thedate,6,2) . "-" . $mdays[substr($thedate,4,2)-1] . "-" .substr($thedate,0,4);
	}


function setDateFormatAdvanced($thedate,$format)
	{
	$y=substr($thedate,0,4);
	$m=substr($thedate,4,2);
	$d=substr($thedate,6,2);

	return date($format,mktime(0,0,0,$m,$d,$y));
	}


function setTimeFormat($time,$showsecs,$format)
	{
	$time=setLength($time,6);
	$hr=substr($time,0,2);
	$min=substr($time,2,2);
	$secs=substr($time,4,2);

	if($format=="ampm")
		{
		if($hr>12)
			{
			$hr=$hr-12;
			$ampm="PM";
			}
		else
			{
			if($hr<12)
				$ampm="AM";
			else
				$ampm="PM";
			}
		if($showsecs==false)
			return $hr . ":" . $min . " " . $ampm;
		else
			return $hr . ":" . $min . ":" . $secs . " " . $ampm;
		}
	else
		{
		return $hr . ":" . $min . ":" . $secs;
		}	
	}

function printAlertMessage($str)
	{
	print("<script>alert('$str')</script>");
	}

function replaceLocation($str)
	{
	print("<script>window.location.replace('$str')</script>");
	die();
	}

function fill_dynamic($arr)
	{
	for($i=0;$i<count($arr);$i++)
		print("<option value=\"" . $arr[$i] . "\">" . $arr[$i] . "</option>");
	}

function getFieldsValue($tabname,$id,$fld)
	{
	$result=mysql_query("Select * from $tabname where " . $fld . "=" . $id) or die(mysql_error());
	if(mysql_num_rows($result)<1)
		return 0;

	$row=mysql_fetch_assoc($result);
	return $row;
	}

function generateDataFields($arr)
	{
	if($arr==0)
		{
		print("<" . "script>");
		print("\nvar datafields=new Array(1)");
		print("\nvar data=new Array(1)");
		print("<" . "/script>");
		return;
		}
	$n=0;
	print("<" . "script>");
	print("\nvar datafields=new Array(" . count($arr) . ")");
	print("\nvar data=new Array(" . count($arr) . ")");
	foreach($arr as $key=>$value)
		{
		$value=str_replace("\n","<bn>",$value);
		$value=str_replace("\r","<brn>",$value);
		$value=str_replace("\"","<qot>",$value);
		$value=str_replace("<",HTMLTAG_SEP_CHAR,$value);
		print("\ndatafields[$n]=\"$key\"" . "\ndata[$n]=\"$value\"");
		$n++;
		}
	print("\n<" . "/script>");
	}

function setStatusFormat($stat)
	{
	if($stat==0)
		return "Active";
	else if($stat==1)
		return "Blocked";
	}


function fillDateCombo($mdy)
	{
	if($mdy=="d")
		{
		$st=1; 
		$ed=31;
		}
	else if($mdy=="m")
		{
		$st=1; 
		$ed=12;
		}
	else if($mdy=="y")
		{
		$st=date("Y")-5; 
		$ed=date("Y");
		}
	for($i=$st;$i<=$ed;$i++)
		print("<option value=$i>$i</option>");

	}

function fillBirthDateCombo($min)
	{
	for($i=date("Y");$i>=$min;$i--)
		print("<option value=$i>$i</option>");

	}

function fillMinMaxCombo($min,$max,$ord)
	{
	if($ord=="ASC")
		{
		for($i=$min;$i<=$max;$i++)
			print("<option value=$i>$i</option>");
		}
	else
		{
		for($i=$max;$i>=$min;$i--)
			print("<option value=$i>$i</option>");
		}
	}

function getMailFrom($t)
	{
	if($t=="enquiry")
		$from="support@kyrosnetwork.com";

	return $from;
	}

function setFileAccess($utype,$sessutype)
	{
	if(!isset($_SESSION["matri_userid"]))
		{
		printAlertMessage("Cookie must be enabled to access users area. To enable the cookie goto Tools -> Internet Options -> Privacy, and set the cookie level to Medium.");
		replaceLocation("logout.php");
		}
	else if($_SESSION["matri_userid"]=="")
		{
		printAlertMessage("Cookie must be enabled to access users area. To enable the cookie goto Tools -> Internet Options -> Privacy, and set the cookie level to Medium.");
		replaceLocation("logout.php");
		}

	$rurl="logout.php";
	$isfound=false;
	$arr=explode(",",$utype);
	for($i=0;$i<count($arr);$i++)
		{
		if($arr[$i]==$sessutype)
			{
			$isfound=true;
			break;
			}
		}

	if($isfound==false)
		{
		printAlertMessage("You are not authorized to access this feature.");
		replaceLocation($rurl);
		}
	}

function closeCurrentWindow()
	{
	print("<script>self.close();</script>");
	die();
	}

function getMonthName($mon)
	{
	$mons=explode(",","Jan,Feb,Mar,Apr,May,Jun,Jul,Aug,Sept,Oct,Nov,Dec");
	return $mons[$mon-1];
	}

function getMonthNumDays($mon,$year)
	{
	$days=explode(",","31,28,31,30,31,30,31,31,30,31,30,31");
	if($year%4==0 && $mon==2)
		$days[$mon-1]=29;
	return $days[$mon-1];
	}

function openNewWindow($url,$params)
	{
	echo "<script>if(!window.open('" . $url . "',$params,'scrollbars=yes,toolbar=no,width=1000,height=600,top=0,left=0,resizable=yes')) alert('Alert! Popup window is blocked. Popup window must be allowed in order to access login area. To allow popups goto Tools -> Internet Options -> Privacy and turn on popup blocker.');</script>";
	}

function generateUniqueNumber($len,$addtimestamp)
	{
	$rnum=md5(uniqid(rand()));
	$s1=substr($rnum,0,$len);
	if($addtimestamp==true)
		$s1=$s1 . date("YmdHis");
	return $s1;
	}

function setDrCr($num)
	{
	if($num<0)
		return $num . " Cr.";
	else
		return $num . " Dr.";
	}

function getMonthDiff($curdatefrom,$curdateto)
	{
	$newdatefrom=mktime(0,0,0,substr($curdatefrom,4,2),1,substr($curdatefrom,0,4));
	$newdateto=mktime(0,0,0,substr($curdateto,4,2),31,substr($curdateto,0,4));
	$diff=$newdateto-$newdatefrom;
	return intval($diff/60/60/24/30);
	}


function getAgeDate($age)
	{
	$newage=date("Ymd",mktime(0,0,0,date("m"),date("d"),date("Y")-$age));
	return $newage;
	}


function getAge($birthdate)
	{
	$newage=intval((mktime(0,0,0,date("m"),date("d"),date("Y"))-mktime(0,0,0,substr($birthdate,4,2),substr($birthdate,6,2),substr($birthdate,0,4)))/31556926);
	return $newage;
	}


function convertToInches($feet,$inch)
	{
	return (($feet*12)+$inch);
	}

function convertToMeter($inches)
	{
	$newfeets=round($inches/12,2);
	$mtr=round($newfeets/3.280839895,2);
	return $mtr;
	}

function convertToFeet($inches)
	{
	$feets=round($inches/12,2);
	$arr=explode("\.",$feets);
	if($arr[1]>0 && $arr[1]<10)
		{
		if(strlen($arr[1])==1)
			$arr[1]=$arr[1] . "0";
		}

	$restinches=round($arr[1]/8.33,0);

	echo $arr[1] . " end " . $restinches . " = ";
	if($restinches>=12)
		{
		$arr[0]+=1;
		$restinches=0;
		}
	return $arr[0] . "' " . $restinches . "\"";
	}


function getFieldValueFromTable($tabname,$retfldname,$wherefldname,$value)
	{
	$result=mysql_query("Select * from " . $tabname . " where " . $wherefldname . "='" . $value . "'") or die(mysql_error());
	$row=mysql_fetch_array($result);
	return $row[$retfldname];
	}


function getDocRoot($defroot)
	{
	if(isset($_SERVER["DOCUMENT_ROOT"]))
		$docroot=$_SERVER["DOCUMENT_ROOT"];
	else
		$docroot=$defroot;
	return $docroot;
	}


function m_createDynamicPageLink($totalrecords,$recsperpage,$m_current_page,$url)
	{
	if($totalrecords==0)
		$totpages=0;
	else
		$totpages=ceil($totalrecords/$recsperpage);

	$temp="<span class='m_pagination_links'>";
	if($m_current_page!=0)
		$temp .= "<a href='" . $url . "&m_current_page=0'>First</a>";
	else
		$temp .= "First";
	$temp .= " | ";
	if($m_current_page!=0)
		$temp .= "<a href='" . $url . "&m_current_page=" . ($m_current_page-1) . "'>Previous</a>";
	else
		$temp .= "Previous";		
	$temp .= "</span>";

	$temp .= "<span class='m_pagination_text'>";	
	if($totpages>0)
		{
		$temp .= "&nbsp;&nbsp;&nbsp;&nbsp;Page ";
		$temp .= "<select class='m_pagination_combo' name='m_pageselect' id='m_pageselect' onchange=\"window.location.replace('" . $url . "&m_current_page='+this.options[this.selectedIndex].value)\">";
		for($i=0;$i<$totpages;$i++)
			{
			if($i==$m_current_page)
				$temp .= "<option value=" . $i . " selected>" . ($i+1) . "</option>";
			else
				$temp .= "<option value=" . $i . ">" . ($i+1) . "</option>";
			}
		$temp .= "</select>"; 
		$temp .= " of " . $totpages;
		}
	else
		$temp .= "&nbsp;&nbsp;&nbsp;&nbsp;Page 0 of 0";
	$temp .= "</span>";

	$temp .= "&nbsp;&nbsp;&nbsp;&nbsp;";

	$temp .= "<span class='m_pagination_links'>";
	if($m_current_page<($totpages-1))
		$temp .= "<a href='" . $url . "&m_current_page=" . ($m_current_page+1) . "'>Next</a>";
	else
		$temp .= "Next";	
	$temp .= " | ";
	if($m_current_page<($totpages-1))
		$temp .= "<a href='" . $url . "&m_current_page=" . ($totpages-1) . "'>Last</a>";
	else
		$temp .= "Last";
	$temp .= "</span>";

	$temp .= "&nbsp;&nbsp;&nbsp;&nbsp;";
	
	return $temp;
	}


function checkWhetherRecordAlreadyExist($tabname,$retfldname,$wherefldname,$value,$extracrit)
	{
	$result=mysql_query("Select * from " . $tabname . " where " . $wherefldname . "='" . $value . "'" . $extracrit) or die(mysql_error());
	if(mysql_num_rows($result)>0)
		return true;
	return false;
	}



function createStringForURL($str,$num)
	{
	if(function_exists("str_ireplace"))
		{
		$str=str_ireplace(" ","_",$str);
		$str=str_ireplace("-","_",$str);
		$str=str_ireplace("'","",$str);
		$str=str_ireplace("\"","",$str);
		$str=str_ireplace(".","_",$str);
		$str=str_ireplace("/'","_",$str);
		$str=str_ireplace("\\'","_",$str);
		}
	return $str;


	/*
function GenerateUrl ($s) {
//Convert accented characters, and remove parentheses and apostrophes
$from = explode (',', "ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u,(,),[,],'");
$to = explode (',', 'c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u,,,,,,');
//Do the replacements, and convert all other non-alphanumeric characters to spaces
$s = preg_replace ('~[^\w\d]+~', '-', str_replace ($from, $to, trim ($s)));
//Remove a - at the beginning or end and make lowercase
return strtolower (preg_replace ('/^-/', '', preg_replace ('/-$/', '', $s)));
}
*/
	}


function loadTimeList($sel,$min,$max)
	{
	for($i=$min;$i<=$max;$i++)
		{
		if($sel==$i)
			echo "<option value='" . $i . "' selected>" . setLength($i,2) . "</option>";
		else
			echo "<option value='" . $i . "'>" . setLength($i,2) . "</option>";		
		}
	}


function getNumericalDateFromDate($tdate)
	{
	$tdate_arr=explode("/",parseTheString($tdate,""));
	$datedd=$tdate_arr[1];
	$datemm=$tdate_arr[0];
	$dateyy=$tdate_arr[2];
	$date=$tdate_arr[2] . setLength($tdate_arr[0],2) . setLength($tdate_arr[1],2);	
	return $date;
	}
?>