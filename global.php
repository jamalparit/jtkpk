<?php
/*
#############################################################################
#  
#  Developed & Published by:
#  Copyright (c) 2008 by ZULMD DOT COM (IP0445886-X). All right reserved.
#  Hakcipta Terpelihara (c) 2008 oleh ZULMD DOT COM (IP0445886-X)
#   
#  Website : http://www.zulmd.com
#  E-mail : enquiry@zulmd.com
#  Phone : +6013 500 9007 (Zulkifli Mohamed)
#
############################################################################
*/

define('_WEB', true);

# Start Loading Time
if (!defined('CRONJOB'))
{
	session_start();
}
$mtime = microtime();
$mtime = explode(" ",$mtime);
$mtime = $mtime[1] + $mtime[0];
$start_time = $mtime;

function GRIP() {
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		if (defined('CRONJOB')) {
			$ip = '127.0.0.1';
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
	}
	return $ip;
}

define('WEB_BASE',dirname(__FILE__));
define('DS',DIRECTORY_SEPARATOR);

# Setting configuration files
if (!file_exists(WEB_BASE.DS."configuration.php") || (filesize(WEB_BASE.DS."configuration.php") < 10)) {
	die('No configuration file found !');
}
require_once(WEB_BASE.DS."configuration.php");
require_once(WEB_BASE.DS.'includes'.DS.'defines.php');
require_once(WEB_HELPER.'user.php');

# PHP Display Error
if ($config->DisplayError == true) {
	error_reporting(E_ALL & ~E_NOTICE);	// default
} else {
	error_reporting(0);
}

# Seting Date
if (version_compare(PHP_VERSION, '5.1.0', '>=')) {
    date_default_timezone_set("Asia/Kuala_Lumpur");
}

# Handling Variables
if (version_compare(PHP_VERSION, '4.1.0', '<')) {
	$_GET = $HTTP_GET_VARS;
	$_POST = $HTTP_POST_VARS;
	$_SERVER = $HTTP_SERVER_VARS;
	$_FILES = $HTTP_POST_FILES;
	$_ENV = $HTTP_ENV_VARS;
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$_REQUEST = $_POST;
	} else if ($_SERVER['REQUEST_METHOD'] == "GET") {
		$_REQUEST = $_GET;
	}
	if (isset($HTTP_COOKIE_VARS)) {
  		$_COOKIE = $HTTP_COOKIE_VARS;
	}
	if (isset($HTTP_SESSION_VARS)) {
  		$_SESSION = $HTTP_SESSION_VARS;
 	}
}
if (version_compare(PHP_VERSION, '4.1.0', '>=')) {
	$HTTP_GET_VARS = $_GET;
  	$HTTP_POST_VARS = $_POST;
  	$HTTP_SERVER_VARS = $_SERVER;
	$HTTP_POST_FILES = $_FILES;
  	$HTTP_ENV_VARS = $_ENV;
	$PHP_SELF = $_SERVER['PHP_SELF'];	
	if (isset($_SESSION)) {
    	$HTTP_SESSION_VARS = $_SESSION;
	}	
  	if (isset($_COOKIE)) {
    	$HTTP_COOKIE_VARS = $_COOKIE;
	}
}
if (PHP_VERSION >= '4.0.4pl1' && isset($_SERVER['HTTP_USER_AGENT']) && strstr($_SERVER['HTTP_USER_AGENT'],'compatible')) {
	if (extension_loaded('zlib')) {
    	@ob_end_clean();
	    ob_start('ob_gzhandler');
  	}
} else if (PHP_VERSION > '4.0' && isset($_SERVER['HTTP_ACCEPT_ENCODING']) && !empty($_SERVER['HTTP_ACCEPT_ENCODING'])) {
	if (strstr($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
    	if (extension_loaded('zlib')) {
      		$do_gzip_compress = true;
			ob_start('ob_gzhandler');
      		ob_implicit_flush(0);
			if (preg_match("/MSIE/i", $_SERVER['HTTP_USER_AGENT'])) {
				header('Content-Encoding: gzip');
      		}
    	}
  	}
}
if (version_compare(PHP_VERSION, '5.3.0', '<')) {
	if (!ini_get('register_globals')) {
		import_request_variables("GPC", "");
	}
}
if (!function_exists('stripos')) {
	function stripos_clone($haystack, $needle, $offset=0) {
    	return strpos(strtoupper($haystack), strtoupper($needle), $offset);
	}
} else {
  	function stripos_clone($haystack, $needle, $offset=0) {
    	return stripos($haystack, $needle, $offset=0);
  	}
}
if (stristr(htmlentities($_SERVER['PHP_SELF']), "global.php")) {
    header("Location: index.php");
    exit();
}
if((isset($w_user) && $w_user != $_COOKIE['w_user'])) {
	header("Location: index.php");
}
if (isset($_COOKIE['w_user'])) {
	$w_user = $_COOKIE['w_user'];
	$w_user = base64_decode($w_user);
	$w_user = addslashes($w_user);
	$w_user = base64_encode($w_user);
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if (isset($_SERVER['HTTP_REFERER'])) {
    	if (!stripos_clone($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST'])) {
        	header("Location: index.php");
    	}
  	} else {
    	header("Location: index.php");
  	}
}

if (!file_exists(WEB_BASE.DS.'vendor'.DS.'autoload.php')) {
	die('Composer Autoload Failed ! Please make sure you have install composer on your machine. https://getcomposer.org');
}
require_once(WEB_BASE.DS.'vendor'.DS.'autoload.php');
require_once(WEB_INCLUDES."database.php");
require_once(WEB_INCLUDES."functions.php");

# Modules & Template
$WebClosed = get_vv("WebClosed",TBL_CONFIG,"");
if (defined('MAIN_MODULE'))
{
	if (is_online($w_user))
	{
		if ($WebClosed == 1)
		{
			if (is_user($w_user))
			{
				define('MODULE', 'Closed');
			}
			else
			{
				define('MODULE',MAIN_MODULE);
			}
		}
		else
		{
			define('MODULE',MAIN_MODULE);
		}
	}
	else
	{
		define('MODULE','Login');
	}
}
if ($WebClosed == 1)
{
	if (!is_sadmin($w_user) && !is_admin($w_user))
	{
		$TheModule = strtolower(MODULE);
		$TheModuleAjx = strtolower($_REQUEST['m']);
		if ($TheModule != "closed" && $TheModuleAjx != "closed" && $TheModule != "login" && $TheModuleAjx != "login")
		{
			header("Location: " . SITEURL);		
		}
	}
}

if (!defined('MODULE'))
{
	if (isset($_REQUEST['m']))
	{
		$_m = $_REQUEST['m'] . DS;
		define('MODULE', $_REQUEST['m']);
	}
	else if (isset($_POST['m']))
	{
		$_m = $_POST['m'] . DS;
		define('MODULE', $_POST['m']);
	}
	else
	{
		$_m = "";
		define('MODULE', '');
	}

	define('WEB_MODULE',			WEB_ROOT.DS.'modules'.DS.$_m.DS);
	define('WEB_MODULE_TEMPLATE',	WEB_TEMPLATES.strtolower($_m));
}
else
{
	define('WEB_MODULE',			WEB_ROOT.DS.'modules'.DS.MODULE.DS);
	define('WEB_MODULE_TEMPLATE',	WEB_TEMPLATES.strtolower(MODULE).DS);
}

$loc = rawurldecode($_SERVER["QUERY_STRING"]);
if (strstr($loc,"*") || strstr($loc,"'") || strstr($loc,'"'))
{
	$browser = $_SERVER['HTTP_USER_AGENT'];
	$cdate = date('d/m/Y h:i:s A');
	$rqi = $db->Execute("INSERT INTO ".TBL_LOGS." (LogType,LogDate,LogIP,LogBrowser,LogDetail) VALUES ('HACKING_ATTEMPT',NOW(),'".IP_ADDRESS."','$browser','Hacking Attempt :\nLog From : $ipa\nLog Date : $cdate\nBrowser : $browser\n\nCode:\n$loc')");
	if (!$rqi)
	{
		header("Location: index.php");
	}
	header("Location: index.php");
} 
if (isset($_SERVER['QUERY_STRING']))
{
	$qs = strtolower($_SERVER['QUERY_STRING']);
    if (stripos_clone($qs,'%20union%20') OR stripos_clone($qs,'/*') OR stripos_clone($qs,'%27') OR 
		stripos_clone($qs,'*/union/*') OR stripos_clone($qs,'c2nyaxb0') OR 
		stripos_clone($qs,'+union+') OR stripos_clone($qs,'\'') OR 
		stripos_clone($qs,'"') OR stripos_clone($qs,'%22') OR 
		stripos_clone($qs,'%20union') OR stripos_clone($qs,' union ') OR
		(stripos_clone($qs,'cmd=') AND !stripos_clone($qs,'&cmd')) OR 
		(stripos_clone($qs,'exec') AND !stripos_clone($qs,'execu')) OR stripos_clone($qs,'concat')	
		)
    {
    	$browser = $_SERVER['HTTP_USER_AGENT'];
    	$cdate = date('d/m/Y h:i:s A');
    	$rqi = $db->Execute("INSERT INTO ".TBL_LOGS." (LogType,LogDate,LogIP,LogBrowser,LogDetail) VALUES ('HACKING_ATTEMPT',NOW(),'".IP_ADDRESS."','$browser','Hacking Attempt :\nLog From : $ipa\nLog Date : $cdate\nBrowser : $browser\n\nCode:\n$qs')");
    	if (!$rqi)
    	{
    		header("Location: index.php");
    	}
		header("Location: index.php");
    }
}
$postString = ""; $ps = "";
foreach ($_POST as $postkey => $postvalue)
{
    if ($postString > "")
    {
		$postString .= "&".$postkey."=".$postvalue;
    }
    else
    {
   		$postString .= $postkey."=".$postvalue;
    }
}
str_replace("%09", "%20", $ps);
$ps_64 = base64_decode($ps);
if (stripos_clone($ps,'%20union%20') OR stripos_clone($ps,'*/union/*') OR stripos_clone($ps,'%27') OR 
	stripos_clone($ps,' union ') OR stripos_clone($ps_64,'%20union%20') OR 
	stripos_clone($ps_64,'*/union/*') OR stripos_clone($ps_64,' union ') OR 
	stripos_clone($ps_64,'+union+'))
{
	$browser = $_SERVER['HTTP_USER_AGENT'];
	$cdate = date('d/m/Y h:i:s A');
	$rqi = $db->Execute("INSERT INTO ".TBL_LOGS." (LogType,LogDate,LogIP,LogBrowser,LogDetail) VALUES ('HACKING_ATTEMPT',NOW(),'".IP_ADDRESS."','$browser','Hacking Attempt :\nLog From : $ipa\nLog Date : $cdate\nBrowser : $browser\n\nCode:\n$ps$ps_64')");
	if (!$rqi)
	{
		header("Location: index.php");
	}
	header("Location: index.php");
}

# Language
$newlang = $_REQUEST['newlang'];
$locale = $_COOKIE['locale'];
$default_lang = getDefaultLanguage();
if (isset($newlang) AND !stripos_clone($newlang,"."))
{
	if (file_exists(WEB_LANGUAGES."lang-".$newlang.".php"))
	{
		set_cookie("locale",$newlang,time()+31536000,$config->SiteDomain);
		include_once(WEB_LANGUAGES."lang-".$newlang.".php");
		$config->setLanguage($newlang);
	}
	else
	{
		set_cookie("locale",$default_lang,time()+31536000,$config->SiteDomain);
		include_once(WEB_LANGUAGES."lang-".$default_lang.".php");
		$config->setLanguage($default_lang);
	}
}
else if (isset($locale))
{
	include_once(WEB_LANGUAGES."lang-".$locale.".php");
	$config->setLanguage($locale);
}
else
{
	set_cookie("locale",$default_lang,time()+31536000,$config->SiteDomain);
	include_once(WEB_LANGUAGES."lang-".$default_lang.".php");
	$config->setLanguage($default_lang);
}

# Banned Host
require_once(WEB_INCLUDES."banned.php");

# Web Initialize
if (!defined('CRONJOB'))
{
	WebInit();
}

# GD Security Check
if (isset($_REQUEST['gx']))
{
	switch($_REQUEST['gx'])
	{
		case "gxf":
			$font = WEB_FONTS."MyriadLight.ttf";
			$datekey = date("F j");
			$rcode = hexdec(md5($_SERVER['HTTP_USER_AGENT'] . $config->LicenseKey . $_REQUEST['num'] . $datekey));
			$code = substr($rcode, 2, 6);
			if (file_exists(WEB_THEMES_IMAGES."code_bg.jpg")) {
				$image = imagecreatefromjpeg(WEB_THEMES_IMAGES."code_bg.jpg");
			} else {
				$image = imagecreatefromjpeg(WEB_IMAGES."code_bg.jpg");
			}
			$text_color = Imagecolorallocate($image, 0, 0, 0);
			header("Content-type: image/jpeg");
			imagettftext($image,15,0,7,17,$text_color,$font,$code);
			imagejpeg($image,NULL, 75);
			imagedestroy($image);
			die();
		break;

		case "gxl":
			$datekey = date("F j");
			$rcode = hexdec(md5($_SERVER['HTTP_USER_AGENT'] . $config->LicenseKey . $_REQUEST['num'] . $datekey));
			$code = substr($rcode, 2, 6);
			if (file_exists(WEB_THEMES_IMAGES."code_bg.jpg")) {
				$image = imagecreatefromjpeg(WEB_THEMES_IMAGES."code_bg.jpg");
			} else {
				$image = imagecreatefromjpeg(WEB_IMAGES."code_bg.jpg");
			}
			$text_color = Imagecolorallocate($image, 80, 80, 80);
			header("Content-Type: image/jpeg");
			imagestring($image, 5, 12, 2, $code, $text_color);
			imagejpeg($image,NULL, 75);
			imagedestroy($image);
			die();
		break;
		
		case "gxs":
			$datekey = date("F j");
			$rcode = hexdec(md5($_SERVER['HTTP_USER_AGENT'] . $config->LicenseKey . $_REQUEST['num'] . $datekey));
			$code = substr($rcode, 2, 3);
			if (file_exists(WEB_THEMES_IMAGES."code_bg_small.jpg")) {
				$image = imagecreatefromjpeg(WEB_THEMES_IMAGES."code_bg_small.jpg");
			} else {
				$image = imagecreatefromjpeg(WEB_IMAGES."code_bg_small.jpg");
			}
			$text_color = Imagecolorallocate($image, 80, 80, 80);
			header("Content-type: image/jpeg");
			imagestring($image, 5, 12, 2, $code, $text_color);
			imagejpeg($image,NULL, 75);
			imagedestroy($image);
			die();
		break;

		case "avatar":
			if (isset($_REQUEST['uid']) && numonly($_REQUEST['uid']) == true) {
				$user_id = $_REQUEST['uid'];
			} else {
				if (is_online($w_user)) {
					$user_id = USERID;
				} else {
					header("Location: ".SITEURL);
				}
			}
			$imgType = getv("AvatarType",TBL_USERS_DETAIL,"UID",$user_id);
			$content = getv("AvatarPic",TBL_USERS_DETAIL,"UID",$user_id);
			if ($imgType != "") {
				header("Cache-Control: no-cache, must-revalidate");
				header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
				header("Content-Type: $imgType");
				echo $content;
			} else {
				die();
			}
		break;

		case "paspot":
			if (isset($_REQUEST['uid']) && numonly($_REQUEST['uid']) == true) {
				$user_id = $_REQUEST['uid'];
			} else {
				if (is_online($w_user)) {
					$user_id = USERID;
				} else {
					header("Location: ".SITEURL);
				}
			}
			$imgType = getv("PaspotType",TBL_USERS_DETAIL,"UID",$user_id);
			$content = getv("PaspotPic",TBL_USERS_DETAIL,"UID",$user_id);
			if ($imgType != "") {
				header("Cache-Control: no-cache, must-revalidate");
				header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
				header("Content-Type: $imgType");
				echo $content;
			} else {
				die();
			}
		break;
   	}
}
?>