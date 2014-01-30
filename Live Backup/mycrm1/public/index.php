<?php
session_start();
// Define path to application directory
//error_reporting(E_ALL|E_STRICT);
error_reporting(1);


ini_set('display_errors',false);

ini_set('max_execution_time','3600');
ini_set('max_input_time','3600');
ini_set('memory_limit','2048M');
ini_set('post_max_size','2000M');


defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

//echo APPLICATION_PATH;
// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));


define('SITE_URL', "http://".$_SERVER['SERVER_NAME']);
define('SITE_PATH',realpath(dirname(__FILE__)));
//define('SITE_PATH_All_Files',substr(SITE_PATH,0,strlen(SITE_PATH)-strlen('public')).'allfiles');
define('SITE_PATH_All_Files',SITE_PATH.'/allfiles');

define('SITE_URL_ALLFILES', "http://".$_SERVER['SERVER_NAME']."/allfiles/");
define('SITE_URL_PUBLIC_P', "http://".$_SERVER['SERVER_NAME']."/");


require_once 'Zend/Controller/Front.php';
require_once 'Zend/Registry.php';
require_once 'Zend/Db/Adapter/Pdo/Mysql.php';
require_once 'Zend/Config.php';

require_once 'Zend/Auth.php';
require_once 'Zend/Auth/Adapter/DbTable.php';

require_once 'Zend/Session.php';
require_once 'Zend/Controller/Action.php';


/* Database Connection Start  */
$params = array('host'		=>'localhost',
		'username'	=>'askpcexp_process',
		'password'  =>'?n)*$aktFy~d',
		'dbname'	=>'askpcexp_process'
	   );
$DB = new Zend_Db_Adapter_Pdo_Mysql($params);
$DB->setFetchMode(Zend_Db::FETCH_OBJ);
Zend_Registry::set('DB',$DB);



$paramsAsk = array('host' =>'localhost',
		'username'	=>'askpcexp_askpcm',
		'password'  =>'@p!2GHu(dE_S',
		'dbname'	=>'askpcexp_askpcmain'
	   );
$DBAsk = new Zend_Db_Adapter_Pdo_Mysql($paramsAsk);
$DBAsk->setFetchMode(Zend_Db::FETCH_OBJ);
Zend_Registry::set('DBAsk',$DBAsk);


//Zend_Session::start();
/* Database Connection End  */

/*$session = new Zend_Session_Namespace('lang');
if(isset($_SESSION['lang']))
{
 Zend_Registry::set('lang',$_SESSION['lang']);
}*/




/** Zend_Application */
require_once 'Zend/Application.php';

require_once 'php_xls.php';

function imagepathrestriction($img_src)
{

$img_src = str_replace('\\', '/', $img_src);

	$imgbinary = fread(fopen($img_src, "r"), filesize($img_src));
	$img_str = base64_encode($imgbinary);
	return  "data:image/jpg;base64,$img_str";
}

/*Auto Loader*/
//require_once 'Zend/Loader/Autoloader.php';

/*Mail*/
require_once 'Zend/Mail.php';
require_once 'Zend/Mail/Transport/Smtp.php';
$host='localhost';
$tr = new Zend_Mail_Transport_Smtp($host);
Zend_Mail::setDefaultTransport($tr);


// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);


$application->bootstrap()
            ->run();



			
			
