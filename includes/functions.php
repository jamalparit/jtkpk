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

defined('_WEB') or die('No Access');

# Include Helper
include_once(WEB_HELPER."array.php");
include_once(WEB_HELPER."cookie.php");
include_once(WEB_HELPER."database.php");
include_once(WEB_HELPER."date.php");
include_once(WEB_HELPER."directory.php");
include_once(WEB_HELPER."download.php");
include_once(WEB_HELPER."email.php");
include_once(WEB_HELPER."file.php");
include_once(WEB_HELPER."html.php");
include_once(WEB_HELPER."image.php");
include_once(WEB_HELPER."inflector.php");
include_once(WEB_HELPER."maps.php");
include_once(WEB_HELPER."misc.php");
include_once(WEB_HELPER."rating.php");
include_once(WEB_HELPER."rss.php");
include_once(WEB_HELPER."security.php");
include_once(WEB_HELPER."sms.php");
include_once(WEB_HELPER."string.php");
include_once(WEB_HELPER."system.php");
include_once(WEB_HELPER."template.php");
include_once(WEB_HELPER."text.php");
include_once(WEB_HELPER."twitter.php");
include_once(WEB_HELPER."typography.php");
include_once(WEB_HELPER."url.php");
//include_once(WEB_HELPER."user.php");
include_once(WEB_HELPER."widgets.php");
include_once(WEB_HELPER."xml.php");

function WebInit() {
	global $db, $config, $w_user, $cookie;
	$module = strtolower(MODULE);
	if (isset($_REQUEST['p'])) {
		$submodule = strtolower($_REQUEST['p']);
	} else {
		$submodule = strtolower($_POST['p']);
	}
	
	$timeout = 60;	$guest = 0;
	$uagent = $_SERVER['HTTP_USER_AGENT'];

	/**

		UPDATE USERS (SESSIONS TIMEOUT)
	
	*/
	$r = $db->Execute("UPDATE ".TBL_USERS." SET SID='', SessionTime=0, StatusOnline='OFFLINE', LoginIP='".IP_ADDRESS."' WHERE SessionTime < ".now()."");
	if (!$r) {
		l('DBQUERY','functions.php','WebInit()->Update_User_Session_To_OFFLINE',$db->ErrorMsg());
		die();
	}


	/**

		UPDATE USERS (SESSIONS TIME)
	
	*/
	if (is_online($w_user))
	{
		cookiedecode($w_user);
		
		if (strtolower($cookie[2]) == "true" || strtolower($cookie[2]) == "1")
		{
			$usession = $config->SessionRemember;
			$usession_db = time() + $usession;
		}
		else
		{
			$usession = $config->UserSession;
			$usession_db = time() + $usession;
		}

		$uusr = $db->Execute("UPDATE ".TBL_USERS." SET SessionTime='$usession_db', Locale='".LOCALE."' WHERE UID='".USERID."' AND SID='".strtoupper(SID)."'");
		if (!$uusr)
		{
			l('DBQUERY','functions.php','WebInit()->Update_User_Session_Time',$db->ErrorMsg());
			die();	
		}		
		
		$cookie_value = base64_encode(USERID."|".strtoupper(SID)."|".strtoupper($cookie[2]));
		set_cookie("w_user",$cookie_value,$usession,$config->SiteDomain);

		$uname = USERID;
		$guest = 0;
	}
	else
	{
		$uname = IP_ADDRESS;
		$guest = 1;
	}
  
	/**

		CLEAR ALL SESSIONS
	
	*/
  	$past = time()-$timeout;  // 5 minutes default:3600 (1 hour) // realtime = 1
  	$rsess = $db->Execute("DELETE FROM ".TBL_SESSIONS." WHERE CurrentTime < '$past'"); // delete all session after ? minutes
	if (!$rsess)
	{
		l('DBQUERY','functions.php','WebInit()->Delete_All_Session',$db->ErrorMsg());
		die();
	}

	$ruses = $db->Execute("SELECT CurrentTime FROM ".TBL_SESSIONS." WHERE VisitorID='$uname'");
	if (!$ruses)
	{
		l('DBQUERY','functions.php','WebInit()',$db->ErrorMsg());
		die();
	}
	
	if (!empty($uname))
	{
		$row = $ruses->FetchRow();
		if ($row)
		{
			$ru = $db->Execute("UPDATE ".TBL_SESSIONS." SET VisitorID='$uname', CurrentTime='".now()."', HostAddress='".IP_ADDRESS."', isGuest='$guest', UserAgent='$uagent', Module='$module', SubModule='$submodule', DataID='$dataid', Locale='".LOCALE."' WHERE VisitorID='$uname'");
			if (!$ru) {
				l('DBQUERY','functions.php','WebInit()->UpdateSession',$db->ErrorMsg());
				die();
			}
		}
		else
		{
			$ri = $db->Execute("INSERT INTO ".TBL_SESSIONS." (VisitorID, CurrentTime, HostAddress, isGuest, UserAgent, Module, SubModule, DataID, Locale) VALUES ('$uname', '".now()."', '".IP_ADDRESS."', '$guest', '$uagent', '$module', '$submodule', '$dataid','".LOCALE."')");
			if (!$ri) {
				l('DBQUERY','functions.php','WebInit()->InsertSession',$db->ErrorMsg());
				die();
			}
		}
	}
}

function HitCounter() {
	global $db, $config;
	
	/* Get the Browser data */
	if (preg_match("/Chrome/i", $_SERVER["HTTP_USER_AGENT"])) {
		$browser = "Chrome";
	} else if (preg_match("/Firefox/i", $_SERVER["HTTP_USER_AGENT"])) {
		$browser = "Firefox";
	} else if(preg_match("/Safari/i", $_SERVER["HTTP_USER_AGENT"])) {
		$browser = "Safari";
	} else if(preg_match("/MSIE/i", $_SERVER["HTTP_USER_AGENT"])) {
		$browser = "MSIE";
	} else if(preg_match("/Lynx/i", $_SERVER["HTTP_USER_AGENT"])) {
		$browser = "Lynx";
	} else if(preg_match("/Opera/i", $_SERVER["HTTP_USER_AGENT"])) {
		$browser = "Opera";
	} else if(preg_match("/WebTV/i", $_SERVER["HTTP_USER_AGENT"])) {
		$browser = "WebTV";
	} else if(preg_match("/Konqueror/i", $_SERVER["HTTP_USER_AGENT"])) {
		$browser = "Konqueror";
	} else if (	(preg_match("/bot/i", $_SERVER["HTTP_USER_AGENT"])) || 
				(preg_match("/Google/i", $_SERVER["HTTP_USER_AGENT"])) || 
				(preg_match("/Slurp/i", $_SERVER["HTTP_USER_AGENT"])) || 
				(preg_match("/Scooter/i", $_SERVER["HTTP_USER_AGENT"])) || 
				(preg_match("/Spider/i", $_SERVER["HTTP_USER_AGENT"])) || 
				(preg_match("/Infoseek/i", $_SERVER["HTTP_USER_AGENT"]))) {
		$browser = "Bot";
	} else {
		$browser = "Other";
	}

	/* Get the Operating System data */
	if (preg_match("/Win/i", $_SERVER["HTTP_USER_AGENT"])) {
		$os = "Windows";
	} else if (preg_match("/iPhone/i", $_SERVER["HTTP_USER_AGENT"])) {
		$os = "iPhone";
	} else if (preg_match("/iPad/i", $_SERVER["HTTP_USER_AGENT"])) {
		$os = "iPad";
	} else if (preg_match("/Android/i", $_SERVER["HTTP_USER_AGENT"])) {
		$os = "Android";
	} else if ((preg_match("/Mac/i", $_SERVER["HTTP_USER_AGENT"])) || (preg_match("/PPC/i", $_SERVER["HTTP_USER_AGENT"]))) {
		$os = "Mac OS";
	} else if (preg_match("/Linux/i", $_SERVER["HTTP_USER_AGENT"])) {
		$os = "Linux";
	} else if (preg_match("/FreeBSD/i", $_SERVER["HTTP_USER_AGENT"])) {
		$os = "FreeBSD";
	} else if (preg_match("/SunOS/i", $_SERVER["HTTP_USER_AGENT"])) {
		$os = "SunOS";
	} else if (preg_match("/IRIX/i", $_SERVER["HTTP_USER_AGENT"])) {
		$os = "IRIX";
	} else if (preg_match("/BeOS/i", $_SERVER["HTTP_USER_AGENT"])) {
		$os = "BeOS";
	} else if (preg_match("/OS\/2/i", $_SERVER["HTTP_USER_AGENT"])) {
		$os = "OS/2";
	} else if (preg_match("/AIX/i", $_SERVER["HTTP_USER_AGENT"])) {
		$os = "AIX";
	} else {
		$os = "Other";
	}

	/* Save on the databases the obtained values */
	$r = $db->Execute("UPDATE ".TBL_STAT_COUNTER." SET count=count+1 WHERE (type='total' AND var='hits') OR (var='$browser' AND type='browser') OR (var='$os' AND type='os')");
	if (!$r) { die($db->ErrorMsg()); }

	/* Start Detailed Statistics */
	$dot = date("d-m-Y-H");
	$now = explode ("-",$dot);
	$nowHour = $now[3];
	$nowYear = $now[2];
	$nowMonth = $now[1];
	$nowDate = $now[0];
	
	$ryear = $db->Execute("SELECT syear FROM ".TBL_STAT_YEAR." WHERE syear='$nowYear'");
	$jml = $ryear->RecordCount();
	if ($jml <= 0) {
		$db->Execute("INSERT INTO ".TBL_STAT_YEAR." (syear,hits) VALUES ('$nowYear','0')");
		for ($i=1; $i <= 12; $i++) {
			$db->Execute("INSERT INTO ".TBL_STAT_MONTH." (syear, smonth, hits) VALUES ('$nowYear','$i','0')");
			if ($i == 1) $TotalDay = 31;
			if ($i == 2) {
				if (date("L") == true) {
					$TotalDay = 29;
				} else {
					$TotalDay = 28;
				}
			}
			if ($i == 3) $TotalDay = 31;
			if ($i == 4) $TotalDay = 30;
			if ($i == 5) $TotalDay = 31;
			if ($i == 6) $TotalDay = 30;
			if ($i == 7) $TotalDay = 31;
			if ($i == 8) $TotalDay = 31;
			if ($i == 9) $TotalDay = 30;
			if ($i == 10) $TotalDay = 31;
			if ($i == 11) $TotalDay = 30;
			if ($i == 12) $TotalDay = 31;
			for ($k=1; $k <= $TotalDay; $k++) {
				$db->Execute("INSERT INTO ".TBL_STAT_DATE." (syear, smonth, sdate, hits) VALUES ('$nowYear','$i','$k','0')");
			}
		}
	}

	$result = $db->Execute("SELECT hour FROM ".TBL_STAT_HOUR." WHERE (syear='$nowYear') AND (smonth='$nowMonth') AND (sdate='$nowDate')");
	$numrows = $result->RecordCount();	
	if ($numrows <= 0) {
		for ($z=0; $z <= 23; $z++) {
			$db->Execute("INSERT INTO ".TBL_STAT_HOUR." (syear, smonth, sdate, hour, hits) VALUES ('$nowYear','$nowMonth','$nowDate','$z','0')");
		}
	}
	
	$db->Execute("UPDATE ".TBL_STAT_YEAR." SET hits=hits+1 WHERE syear='$nowYear'");
	$db->Execute("UPDATE ".TBL_STAT_MONTH." SET hits=hits+1 WHERE (syear='$nowYear') AND (smonth='$nowMonth')");
	$db->Execute("UPDATE ".TBL_STAT_DATE." SET hits=hits+1 WHERE (syear='$nowYear') AND (smonth='$nowMonth') AND (sdate='$nowDate')");
	$db->Execute("UPDATE ".TBL_STAT_HOUR." SET hits=hits+1 WHERE (syear='$nowYear') AND (smonth='$nowMonth') AND (sdate='$nowDate') AND (hour='$nowHour')");
}
?>