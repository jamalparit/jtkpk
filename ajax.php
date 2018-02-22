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

require_once("global.php");
use Abraham\TwitterOAuth\TwitterOAuth;
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

/**
##################################################
# USERS ONLINE
##################################################
*/
if (is_online($w_user))
{

/**

	ADMINISTRATORS FUNCTIONS

*/
// SYSTEM
function SaveSystemConfig() {
	global $config, $db, $w_user;

	if (!is_sadmin($w_user))
	{
		SweetAlert('error','Ops !',_SUPER_ADMIN_ONLY_DESC);
	}
	else
	{
		# Get Data
		$ClosedReason = filter_txt($_POST['ClosedReason']);
		$DefaultTheme = $_POST['DefaultTheme'];
		$LoginType = $_POST['LoginType'];
		$LoginUserSession = $_POST['LoginUserSession'];
		$LoginSessionRemember = $_POST['LoginSessionRemember'];
		$WebPipeline = $_POST['WebPipeline'];
		$LoadPM = $_POST['LoadPM'];
		$SiteName = filter_txt($_POST['SiteName']);
		$SiteUrl = $_POST['SiteUrl'];
		$SiteDomain = $_POST['SiteDomain'];
		$SiteSlogan = filter_txt($_POST['SiteSlogan']);
		$SiteDescription = filter_txt($_POST['SiteDescription']);
		$SiteKeywords = filter_txt($_POST['SiteKeywords']);
		$DBType = $_POST['DBType'];
		$DBName = $_POST['DBName'];
		$DBHost = $_POST['DBHost'];
		$DBUser = $_POST['DBUser'];
		$DBPwd = $_POST['DBPwd'];
		$GCaptchaKey = $_POST['GCaptchaKey'];
		$GCaptchaSecret = $_POST['GCaptchaSecret'];
		$AdminMail = $_POST['AdminMail'];
		$MailHost = $_POST['MailHost'];
		$MailUser = $_POST['MailUser'];
		$MailPwd = $_POST['MailPwd'];
		$MailPort = $_POST['MailPort'];
		$MailSecure = $_POST['MailSecure'];
		$MailDebug = $_POST['MailDebug'];
		$Language = $_POST['Language'];
		$WelcomeMsg = filter_txt($_POST['WelcomeMsg']);
		$GClientID = $_POST['GClientID'];
		$GAPIKey = $_POST['GAPIKey'];
		$GAnalytic = $_POST['GAnalytic'];
		$GDefLat = $_POST['GDefLat'];
		$GDefLon = $_POST['GDefLon'];
		$GDefZom = $_POST['GDefZom'];
		$FBGraph = $_POST['FBGraph'];
		$FBAppID = $_POST['FBAppID'];
		$FBAppSecret = $_POST['FBAppSecret'];
		$TWAccessToken = $_POST['TWAccessToken'];
		$TWTokenSecret = $_POST['TWTokenSecret'];
		$TWConsumerKey = $_POST['TWConsumerKey'];
		$TWConsumerSecret = $_POST['TWConsumerSecret'];
		$SMS_MTURL = $_POST['SMS_MTURL'];
		$SMSUser = $_POST['SMSUser'];
		$SMSPwd = $_POST['SMSPwd'];

		# Save Configuration
		$rec = RecordCount("SELECT * FROM ".TBL_CONFIG."");
		if ($rec == 0)
		{
			# Insert Configuration
			$LicenseKey = strtoupper(random_string('alnum',32));
			$r = dbep('_INSERT',"INSERT INTO ".TBL_CONFIG." (LicenseKey,WebClosed,ClosedReason,WelcomeMessage,DisplayError,SiteName,SiteUrl,
				 SiteDomain,SiteSlogan,SiteDescription,SiteKeywords,DefaultTheme,AllowRegister,LoginType,LoginUserSession,LoginSessionRemember,
				 DBType,DBName,DBHost,DBUser,DBPwd,DBDebug,SecurityCheck,GoogleCaptchaKey,GoogleCaptchaSecret,AdminMail,MailHost,MailUser,MailPwd,MailPort,
				 MailSecure,MailDebug,GoogleClientID,GoogleAPIKey,GoogleAnalytic,GoogleMaps,MapDefaultLat,MapDefaultLon,MapDefaultZoom,FacebookIntegration,FacebookBeta,
				 FacebookJS,FacebookGraph,FacebookAppID,FacebookAppSecret,TwitterIntegration,TwitterAccessToken,TwitterTokenSecret,TwitterConsumerKey,
				 TwitterConsumerSecret,SMS_MTURL,SMSUser,SMSPwd,WebPipeline,LoadPM) VALUES (?,0,?,?,0,?,?,?,?,?,?,?,0,?,?,?,?,?,?,?,?,0,0,?,?,?,?,?,?,?,?,?,?,?,?,0,?,?,?,0,0,0,?,?,?,0,?,?,?,?,?,?,?,?,?)",
				 array($LicenseKey,$ClosedReason,$WelcomeMsg,$SiteName,$SiteUrl,$SiteDomain,$SiteSlogan,$SiteDescription,$SiteKeywords,$DefaultTheme,
				 $LoginType,$LoginUserSession,$LoginSessionRemember,$DBType,$DBName,$DBHost,$DBUser,$DBPwd,$GCaptchaKey,$GCaptchaSecret,
				 $AdminMail,$MailHost,$MailUser,$MailPwd,$MailPort,$MailSecure,$MailDebug,$GClientID,$GAPIKey,$GAnalytic,$GDefLat,
				 $GDefLon,$GDefZom,$FBGraph,$FBAppID,$FBAppSecret,$TWAccessToken,$TWTokenSecret,$TWConsumerKey,$TWConsumerSecret,$SMS_MTURL,
				 $SMSUser,$SMSPwd,$WebPipeline,$LoadPM),
				 array('DBQUERY','ajax.php','SaveSystemConfig()->InsertConfiguration'));
			if (!$r)
			{
				die();
			}

			$DisplayError = "false";
			$DBDebug = "false";
			$SecurityCheck = "false";
			$GoogleMaps = "false";
			$FacebookIntegration = "false";
			$FacebookBeta = "false";
			$FacebookJS = "false";
			$TwitterIntegration = "false";
			$AllowRegister = "false";
		}
		else
		{
			# Update Configuration
			$r = dbep('UPDATE',"UPDATE ".TBL_CONFIG." SET ClosedReason=?,WelcomeMessage=?,SiteName=?,SiteUrl=?,SiteDomain=?,SiteSlogan=?,
				 SiteDescription=?,SiteKeywords=?,DefaultTheme=?,LoginType=?,LoginUserSession=?,LoginSessionRemember=?,DBType=?,DBName=?,
				 DBHost=?,DBUser=?,DBPwd=?,GoogleCaptchaKey=?,GoogleCaptchaSecret=?,AdminMail=?,MailHost=?,MailUser=?,MailPwd=?,MailPort=?,
				 MailSecure=?,MailDebug=?,GoogleClientID=?,GoogleAPIKey=?,GoogleAnalytic=?,MapDefaultLat=?,MapDefaultLon=?,MapDefaultZoom=?,
				 FacebookGraph=?,FacebookAppID=?,FacebookAppSecret=?,TwitterAccessToken=?,TwitterTokenSecret=?,TwitterConsumerKey=?,
				 TwitterConsumerSecret=?,SMS_MTURL=?,SMSUser=?,SMSPwd=?,WebPipeline=?,LoadPM=?",
				 array($ClosedReason,$WelcomeMsg,$SiteName,$SiteUrl,$SiteDomain,$SiteSlogan,$SiteDescription,$SiteKeywords,$DefaultTheme,
				 $LoginType,$LoginUserSession,$LoginSessionRemember,$DBType,$DBName,$DBHost,$DBUser,$DBPwd,$GCaptchaKey,$GCaptchaSecret,
				 $AdminMail,$MailHost,$MailUser,$MailPwd,$MailPort,$MailSecure,$MailDebug,$GClientID,$GAPIKey,$GAnalytic,$GDefLat,
				 $GDefLon,$GDefZom,$FBGraph,$FBAppID,$FBAppSecret,$TWAccessToken,$TWTokenSecret,$TWConsumerKey,$TWConsumerSecret,
				 $SMS_MTURL,$SMSUser,$SMSPwd,$WebPipeline,$LoadPM),
				 array('DBQUERY','ajax.php','SaveSystemConfig()->UpdateConfiguration'));
			if (!$r)
			{
				die();
			}

			$LicenseKey = get_vv('LicenseKey',TBL_CONFIG,'');
			$DisplayError = (get_vv('DisplayError',TBL_CONFIG,'') == 1) ? "true":"false";
			$DBDebug = (get_vv('DBDebug',TBL_CONFIG,'') == 1) ? "true":"false";
			$SecurityCheck = (get_vv('SecurityCheck',TBL_CONFIG,'') == 1) ? "true":"false";
			$GoogleMaps = (get_vv('GoogleMaps',TBL_CONFIG,'') == 1) ? "true":"false";
			$FacebookIntegration = (get_vv('FacebookIntegration',TBL_CONFIG,'') == 1) ? "true":"false";
			$FacebookBeta = (get_vv('FacebookBeta',TBL_CONFIG,'') == 1) ? "true":"false";
			$FacebookJS = (get_vv('FacebookJS',TBL_CONFIG,'') == 1) ? "true":"false";
			$TwitterIntegration = (get_vv('TwitterIntegration',TBL_CONFIG,'') == 1) ? "true":"false";
			$AllowRegister = (get_vv('AllowRegister',TBL_CONFIG,'') == 1) ? "true":"false";
		}

		# Language
		$db->Execute("UPDATE ".TBL_LANG." SET DefaultLang='1' WHERE CodeLang='$Language'");
		$db->Execute("UPDATE ".TBL_LANG." SET DefaultLang='0' WHERE CodeLang!='$Language'");
		
		# Write configuration.php
		$data = '<?php
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

defined(\'_WEB\') or die(\'No Access\');

class WebConfig
{
	# Copyright. Please do not change this copyright.
	var $WebSystem = "ZackFramework (OneUI)";
	var $WebVersion = "3.1";
	var $Developer = "ZULMD DOT COM (IP0445886-X) - http://www.zulmd.com";

	# License Key
	var $LicenseKey = "'.$LicenseKey.'";

	# Site Configuration
	var $DisplayError = '.$DisplayError.';
	var $SiteName = "'.filter_decode($SiteName,'view-trim',false,false).'";
	var $SiteUrl = "'.$SiteUrl.'";
	var $SiteDomain = "'.$SiteDomain.'";
	var $Slogan = "'.addslashes(filter_decode($SiteSlogan,'view-trim',false,false)).'";
	var $SiteDescription = "'.addslashes(filter_decode($SiteDescription,'view-trim',false,false)).'";
	var $Keywords = "'.addslashes(filter_decode($SiteKeywords,'view-trim',false,false)).'";

	# Themes
	var $DefaultTheme = "'.$DefaultTheme.'";

	# Users
	var $AllowRegister = '.$AllowRegister.';
	var $LoginID = "'.$LoginType.'"; // EMAIL | ID
	var $UserSession = '.$LoginUserSession.'; // 1 hour
	var $SessionRemember = '.$LoginSessionRemember.'; // 24 hours

	# Database Configuration
	var $DatabaseType = "'.$DBType.'"; // MySQL or MSSQL
	var $DatabaseName = "'.$DBName.'";
	var $DatabaseHost = "'.$DBHost.'";
	var $DatabaseUser = "'.$DBUser.'";
	var $DatabasePass = \''.$DBPwd.'\';
	var $DatabaseDebug = '.$DBDebug.';

	# Security Graphic Check (reCAPTCHA)
	var $SecurityCheck = '.$SecurityCheck.';
	var $GoogleCaptchaKey = "'.$GoogleCaptchaKey.'";
	var $GoogleCaptchaSecret = "'.$GoogleCaptchaSecret.'";
	
	/*---------------------------------------
	/ PRODUCTS INTEGRATIONS
	/---------------------------------------*/

	# SMTP Configuration (PHPMailer)
	var $AdminMail = "'.$AdminMail.'";
	var $MailHost = "'.$MailHost.'";
	var $MailUser = "'.$MailUser.'";
	var $MailPwd = \''.$MailPwd.'\';
	var $MailPort = '.$MailPort.';
	var $MailSecure = "'.$MailSecure.'";
	var $MailDebug = '.$MailDebug.';

	# Google Integration
	# ---------------------------------------
	# Google Sign-In
	var $GoogleClientID = "'.$GClientID.'";

	# Google API Key
	var $GoogleAPIKey = "'.$GAPIKey.'";
	
	# Google Analytics
	var $GoogleAnalytic = "'.$GAnalytic.'";
	
	# Google Maps
	var $GoogleMaps = '.$GoogleMaps.';
	var $GoogleDefaultLat = "'.$GDefLat.'";
	var $GoogleDefaultLon = "'.$GDefLon.'";
	var $GoogleDefaultZoom = "'.$GDefZom.'";

	# Facebook Integration
	# ---------------------------------------
	var $FacebookIntegration = '.$FacebookIntegration.';
	var $FacebookBeta = '.$FacebookBeta.';
	var $FacebookJS = '.$FacebookJS.';
	var $FacebookGraph = \''.$FBGraph.'\';
	var $FacebookAppID = "'.$FacebookAppID.'";
	var $FacebookAppSecret = "'.$FacebookAppSecret.'";

	# Twitter Integration
	# ---------------------------------------
	var $TwitterIntegration = '.$TwitterIntegration.';
	var $TwitterAccessToken = "'.$TWAccessToken.'";
	var $TwitterTokenSecret = "'.$TWTokenSecret.'";
	var $TwitterConsumerKey = "'.$TWConsumerKey.'";
	var $TwitterConsumerSecret = "'.$TWConsumerSecret.'";

	# SMS Integration
	# ---------------------------------------
	var $SMS_MTURL = "'.$SMS_MTURL.'";
	var $SMSUser = "'.$SMSUser.'";
	var $SMSPwd = "'.$SMSPwd.'";

	# Web Settings
	# ---------------------------------------
	var $PipelineDelay = '.$WebPipeline.';
	var $LoadPM = '.$LoadPM.';
	
	var $CurrentLang;
	
	#################################################################
	
	public function setLanguage($NewLang) {
		$this->CurrentLang = $NewLang;
	}
	public function getLanguage() {
		return $this->CurrentLang;
	}
	public function setTheme($NewTheme) {
		$this->DefaultTheme = $NewTheme;
	}
	public function getTheme() {
		return $this->DefaultTheme;
	}

}
$config = new WebConfig();
?>';
		$w = write_file(WEB_ROOT.DS.'configuration.php', $data, 'wb');
		if (!$w) {
			SweetAlert('error','Ops !', "Unable to write configuration.php !");
			die();
		}

	    Notify("success",_SUCCESSFULLY_UPDATE_SYSTEM);
	}
}
function UpdateConfig() {
	global $config, $db, $w_user;

	if (!is_sadmin($w_user))
	{
		SweetAlert('error','Ops !',_SUPER_ADMIN_ONLY_DESC);
	}
	else
	{
		$mode = $_POST['mode'];
	    $value = $_POST['val'];
	    
	    $thev = get_vv($mode,TBL_CONFIG,"");
	    if ($thev == 0) {
	    	$u = 1;
	    } else {
	    	$u = 0;
	    }

		$r = dbe('UPDATE',"UPDATE ".TBL_CONFIG." SET $mode='$u'", array('DBQUERY','AJAX','UpdateConfig()'));
		if (!$r) { die(); }

		# Get Configurations
		$rd = dbe('SELECT',"SELECT * FROM ".TBL_CONFIG,array('DBQUERY',$module_name,'SystemConfig()'));
		while ($rw = $rd->FetchRow())
		{
			$LicenseKey = $rw['LicenseKey'];
			$WebClosed = $rw['WebClosed'];
			$DisplayError = $rw['DisplayError'];
			$SiteName = $rw['SiteName'];
			$SiteUrl = $rw['SiteUrl'];
			$SiteDomain = $rw['SiteDomain'];
			$SiteSlogan = $rw['SiteSlogan'];
			$SiteDescription = $rw['SiteDescription'];
			$SiteKeywords = $rw['SiteKeywords'];
			$DefaultTheme = $rw['DefaultTheme'];
			$AllowRegister = $rw['AllowRegister'];
			$LoginType = $rw['LoginType'];
			$LoginUserSession = $rw['LoginUserSession'];
			$LoginSessionRemember = $rw['LoginSessionRemember'];
			$DBType = $rw['DBType'];
			$DBName = $rw['DBName'];
			$DBHost = $rw['DBHost'];
			$DBUser = $rw['DBUser'];
			$DBPwd = $rw['DBPwd'];
			$DBDebug = $rw['DBDebug'];
			$SecurityCheck = $rw['SecurityCheck'];
			$GoogleCaptchaKey = $rw['GoogleCaptchaKey'];
			$GoogleCaptchaSecret = $rw['GoogleCaptchaSecret'];
			$AdminMail = $rw['AdminMail'];
			$MailHost = $rw['MailHost'];
			$MailUser = $rw['MailUser'];
			$MailPwd = $rw['MailPwd'];
			$MailPort = $rw['MailPort'];
			$MailSecure = $rw['MailSecure'];
			$MailDebug = $rw['MailDebug'];
			$GoogleClientID = $rw['GoogleClientID'];
			$GoogleAPIKey = $rw['GoogleAPIKey'];
			$GoogleAnalytic = $rw['GoogleAnalytic'];
			$GoogleMaps = $rw['GoogleMaps'];
			$MapDefaultLat = $rw['MapDefaultLat'];
			$MapDefaultLon = $rw['MapDefaultLon'];
			$MapDefaultZoom = $rw['MapDefaultZoom'];
			$FacebookIntegration = $rw['FacebookIntegration'];
			$FacebookBeta = $rw['FacebookBeta'];
			$FacebookJS = $rw['FacebookJS'];
			$FacebookGraph = $rw['FacebookGraph'];
			$FacebookAppID = $rw['FacebookAppID'];
			$FacebookAppSecret = $rw['FacebookAppSecret'];
			$TwitterIntegration = $rw['TwitterIntegration'];
			$TwitterAccessToken = $rw['TwitterAccessToken'];
			$TwitterTokenSecret = $rw['TwitterTokenSecret'];
			$TwitterConsumerKey = $rw['TwitterConsumerKey'];
			$TwitterConsumerSecret = $rw['TwitterConsumerSecret'];
			$WebPipeline = $rw['WebPipeline'];
			$LoadPM = $rw['LoadPM'];
			$SMS_MTURL = $rw['SMS_MTURL'];
			$SMSUser = $rw['SMSUser'];
			$SMSPwd = $rw['SMSPwd'];

			$DisplayError = ($DisplayError == 1) ? "true":"false";
			$DBDebug = ($DBDebug == 1) ? "true":"false";
			$SecurityCheck = ($SecurityCheck == 1) ? "true":"false";
			$GoogleMaps = ($GoogleMaps == 1) ? "true":"false";
			$FacebookIntegration = ($FacebookIntegration == 1) ? "true":"false";
			$FacebookBeta = ($FacebookBeta == 1) ? "true":"false";
			$FacebookJS = ($FacebookJS == 1) ? "true":"false";
			$TwitterIntegration = ($TwitterIntegration == 1) ? "true":"false";
			$AllowRegister = ($AllowRegister == 1) ? "true":"false";
		}

		# Write configuration.php
		$data = '<?php
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

defined(\'_WEB\') or die(\'No Access\');

class WebConfig
{
	# Copyright. Please do not change this copyright.
	var $WebSystem = "ZackFramework (OneUI)";
	var $WebVersion = "3.1";
	var $Developer = "ZULMD DOT COM (IP0445886-X) - http://www.zulmd.com";

	# License Key
	var $LicenseKey = "'.$LicenseKey.'";

	# Site Configuration
	var $DisplayError = '.$DisplayError.';
	var $SiteName = "'.filter_decode($SiteName,'view-trim',false,false).'";
	var $SiteUrl = "'.$SiteUrl.'";
	var $SiteDomain = "'.$SiteDomain.'";
	var $Slogan = "'.addslashes(filter_decode($SiteSlogan,'view-trim',false,false)).'";
	var $SiteDescription = "'.addslashes(filter_decode($SiteDescription,'view-trim',false,false)).'";
	var $Keywords = "'.addslashes(filter_decode($SiteKeywords,'view-trim',false,false)).'";

	# Themes
	var $DefaultTheme = "'.$DefaultTheme.'";

	# Users
	var $AllowRegister = '.$AllowRegister.';
	var $LoginID = "'.$LoginType.'"; // EMAIL | ID
	var $UserSession = '.$LoginUserSession.'; // 1 hour
	var $SessionRemember = '.$LoginSessionRemember.'; // 24 hours

	# Database Configuration
	var $DatabaseType = "'.$DBType.'"; // MySQL or MSSQL
	var $DatabaseName = "'.$DBName.'";
	var $DatabaseHost = "'.$DBHost.'";
	var $DatabaseUser = "'.$DBUser.'";
	var $DatabasePass = \''.$DBPwd.'\';
	var $DatabaseDebug = '.$DBDebug.';

	# Security Graphic Check (reCAPTCHA)
	var $SecurityCheck = '.$SecurityCheck.';
	var $GoogleCaptchaKey = "'.$GoogleCaptchaKey.'";
	var $GoogleCaptchaSecret = "'.$GoogleCaptchaSecret.'";
	
	/*---------------------------------------
	/ PRODUCTS INTEGRATIONS
	/---------------------------------------*/

	# SMTP Configuration (PHPMailer)
	var $AdminMail = "'.$AdminMail.'";
	var $MailHost = "'.$MailHost.'";
	var $MailUser = "'.$MailUser.'";
	var $MailPwd = \''.$MailPwd.'\';
	var $MailPort = '.$MailPort.';
	var $MailSecure = "'.$MailSecure.'";
	var $MailDebug = '.$MailDebug.';

	# Google Integration
	# ---------------------------------------
	# Google Sign-In
	var $GoogleClientID = "'.$GoogleClientID.'";

	# Google API Key
	var $GoogleAPIKey = "'.$GoogleAPIKey.'";
	
	# Google Analytics
	var $GoogleAnalytic = "'.$GoogleAnalytic.'";
	
	# Google Maps
	var $GoogleMaps = '.$GoogleMaps.';
	var $GoogleDefaultLat = "'.$MapDefaultLat.'";
	var $GoogleDefaultLon = "'.$MapDefaultLon.'";
	var $GoogleDefaultZoom = "'.$MapDefaultZoom.'";

	# Facebook Integration
	# ---------------------------------------
	var $FacebookIntegration = '.$FacebookIntegration.';
	var $FacebookBeta = '.$FacebookBeta.';
	var $FacebookJS = '.$FacebookJS.';
	var $FacebookGraph = \''.$FacebookGraph.'\';
	var $FacebookAppID = "'.$FacebookAppID.'";
	var $FacebookAppSecret = "'.$FacebookAppSecret.'";

	# Twitter Integration
	# ---------------------------------------
	var $TwitterIntegration = '.$TwitterIntegration.';
	var $TwitterAccessToken = "'.$TwitterAccessToken.'";
	var $TwitterTokenSecret = "'.$TwitterTokenSecret.'";
	var $TwitterConsumerKey = "'.$TwitterConsumerKey.'";
	var $TwitterConsumerSecret = "'.$TwitterConsumerSecret.'";

	# SMS Integration
	# ---------------------------------------
	var $SMS_MTURL = "'.$SMS_MTURL.'";
	var $SMSUser = "'.$SMSUser.'";
	var $SMSPwd = "'.$SMSPwd.'";

	# Web Settings
	# ---------------------------------------
	var $PipelineDelay = '.$WebPipeline.';
	var $LoadPM = '.$LoadPM.';
	
	var $CurrentLang;
	
	#################################################################
	
	public function setLanguage($NewLang) {
		$this->CurrentLang = $NewLang;
	}
	public function getLanguage() {
		return $this->CurrentLang;
	}
	public function setTheme($NewTheme) {
		$this->DefaultTheme = $NewTheme;
	}
	public function getTheme() {
		return $this->DefaultTheme;
	}

}
$config = new WebConfig();
?>';
		$w = write_file(WEB_ROOT.DS.'configuration.php', $data, 'wb');
		if (!$w) {
			SweetAlert('error','Ops !', "Unable to write configuration.php !");
			die();
		}
		
	    Notify("success",_SUCCESSFULLY_UPDATE_SYSTEM);
	}
}

// MENU
function SaveMenu() {
	global $config, $db, $w_user;

	if (!is_sadmin($w_user))
	{
		SweetAlert('error','Ops !',_SUPER_ADMIN_ONLY_DESC);
	}
	else
	{
		$MenuName = filter_txt($_POST['MenuName']);
		$MN = strtolower($_POST['MN']);
		$ParentMenu = ($_POST['ParentMenu']=='null' || $_POST['ParentMenu']==null) ? 0:$_POST['ParentMenu'];
		$MenuKey = $_POST['MenuKey'];
		$MenuIcon = $_POST['MenuIcon'];
		$MenuURL = $_POST['MenuURL'];
		$MenuRoles = $_POST['MenuRoles'];
		$MenuRoles = ($MenuRoles != 'null') ? ",$MenuRoles,":"";
		$MenuID = $_POST['MenuID'];

		$CurrentMenuSort = get_v('MAX(MenuSort)',TBL_MENU,"ParentID LIKE '%'");
		$MenuSort = ($CurrentMenuSort + 1);

		if (!empty($MenuID))
		{
			/**
				UPDATE MENU
			*/
			$iUpdate = dbe('UPDATE',"UPDATE ".TBL_MENU." SET ParentID='$ParentMenu', MenuKey='$MenuKey', Menu='$MenuName', MN='$MN', Icon='$MenuIcon', URL='$MenuURL', role_id='$MenuRoles' WHERE ID='$MenuID'",array('DBQUERY','ajax.php','SaveMenu()->Update'));
			if (!$iUpdate) {
				SweetAlert_Error();
				die();
			} else {
				redirect(SITEURL."/administrator/?p=menu");
			}
		}
		else
		{
			/**
				INSERT MENU
			*/
			$NewID = dbe('INSERT',"INSERT INTO ".TBL_MENU." (ParentID,MenuSort,MenuKey,Menu,MN,Icon,URL,role_id) VALUES ('$ParentMenu','$MenuSort','$MenuKey','$MenuName','$MN','$MenuIcon','$MenuURL','$MenuRoles')",array('DBQUERY','ajax.php','SaveMenu()->InsertMenu'));
			if (empty($NewID)) {
				SweetAlert_Error();
				die();
			} else {
				redirect(SITEURL."/administrator/?p=menu");
			}
		}
	}
}
function EditMenu() {
	global $config, $db, $w_user;

	if (!is_sadmin($w_user))
	{
		SweetAlert('error','Ops !',_SUPER_ADMIN_ONLY_DESC);
	}
	else
	{
		$MenuID = filter_num($_POST['id']);
		$recMenu = RecordCount("SELECT * FROM ".TBL_MENU." WHERE ID='$MenuID'");
		if ($recMenu == 1)
		{
			$mn = strtolower(getv('MN',TBL_MENU,'ID',$MenuID));
			dom_setvalue('_menu_name',filter_decode(getv('Menu',TBL_MENU,'ID',$MenuID)));
			dom_select2_set('_parent_menu',filter_decode(getv('ParentID',TBL_MENU,'ID',$MenuID)));
			dom_setvalue('_menu_key',filter_decode(getv('MenuKey',TBL_MENU,'ID',$MenuID)));
			dom_setvalue('_menu_icon',filter_decode(getv('Icon',TBL_MENU,'ID',$MenuID)));
			dom_setvalue('_menu_url',filter_decode(getv('URL',TBL_MENU,'ID',$MenuID)));
			dom_select2multiple_set('_menu_roles',filter_decode(getv('role_id',TBL_MENU,'ID',$MenuID)));
			dom_checked("mn_$mn");
			dom_setvalue('_id',$MenuID);
			settimeout('$("#_menu_name").focus();',500);
		}
	}
}
function DeleteMenu() {
	global $config, $db, $w_user;

	if (!is_sadmin($w_user))
	{
		SweetAlert('error','Ops !',_SUPER_ADMIN_ONLY_DESC);
	}
	else
	{
		$MenuID = filter_num($_POST['id']);
		$recMenu = RecordCount("SELECT * FROM ".TBL_MENU." WHERE ID='$MenuID'");
		if ($recMenu == 1)
		{
			$iDelete = dbe('DELETE',"DELETE FROM ".TBL_MENU." WHERE ID='$MenuID'",array('DBQUERY','ajax.php','DeleteMenu()->Delete'));
			if (!$iDelete) {
				SweetAlert_Error();
				die();
			} else {
				SweetAlert('success',_SUCCESS.' !',_RECORD_SUCCESSFULLY_DELETED,"window.location.href='".SITEURL."/administrator/?p=menu';");
			}
		}
	}
}
function MenuOrder() {
	global $config, $db, $w_user;

	if (!is_sadmin($w_user))
	{
		SweetAlert('error','Ops !',_SUPER_ADMIN_ONLY_DESC);
	}
	else
	{
		$data = $_POST['data'];
		$data = str_replace('&', '', $data);
		$data = trim(str_replace('menu[]=', ',', $data),',');

		$i = 1;
		foreach (explode(',', $data) as $MenuID)
		{
			dbe('UPDATE',"UPDATE ".TBL_MENU." SET MenuSort=".$i++." WHERE ID=$MenuID",array('DBQUERY','ajax.php','MenuOrder()'));
		}
	}
}

// LANGUAGES
function AddLangPack() {
	global $config, $db, $w_user;

	if (!is_sadmin($w_user))
	{
		SweetAlert('error','Ops !',_SUPER_ADMIN_ONLY_DESC);
	}
	else
	{
		$lang_code = $_POST['lang_code'];
		$lang_desc = filter_txt($_POST['lang_desc']);
	
		$Record = RecordCount("SELECT * FROM ".TBL_LANG." WHERE CodeLang='$lang_code'");
		if ($Record > 0)
		{
			SweetAlert('error','Ops !',_RECORD_ALREADY_EXISTS);
		}
		else
		{
			$r = $db->Execute("INSERT INTO ".TBL_LANG." (CodeLang, Description, DefaultLang) VALUES ('$lang_code','$lang_desc','0')");
			if (!$r) {
				l('DBQUERY','ajax.php','AddLangPack()->InsertLanguagePack',$db->ErrorMsg());
				SweetAlert_Error();
				die();
			} else {
				$DefaultLang = getv("CodeLang",TBL_LANG,"DefaultLang","1");
				$ra = $db->Execute("SELECT Define, DefineValue FROM ".TBL_LANG_DEFINE." WHERE CodeLang='$DefaultLang' ORDER BY ID ASC");
				if (!$ra) {
					l('DBQUERY','ajax.php','AddLangPack()->SelectLanguagePack',$db->ErrorMsg());
					SweetAlert_Error();
					die();
				} else {
					while (list($aDefine, $aDefineValue) = $ra->FetchRow()) {
						$db->Execute("INSERT INTO ".TBL_LANG_DEFINE." (CodeLang, Define, DefineValue) VALUES ('$lang_code','$aDefine','$aDefineValue')");
					}
				}
			}
		}

		dom_hidemodal("LangPackDialog");
		redirect(SITEURL."/administrator/?p=languages");
	}
}
function AddLangPhrase() {
	global $config, $db, $w_user;

	if (!is_sadmin($w_user))
	{
		SweetAlert('error','Ops !',_SUPER_ADMIN_ONLY_DESC);
	}
	else
	{
		$phrase_define = strtoupper($_POST['phrase_define']);
		$phrase_value = addslashes($_POST['phrase_value']);
		$phraseID = $_POST['phraseID'];

		if ($phraseID != "" && $phraseID != "0")
		{
			/**
				UPDATE PHRASE
			*/
			$cl = getv("CodeLang",TBL_LANG_DEFINE,"ID",$phraseID);
			$db->Execute("UPDATE ".TBL_LANG_DEFINE." SET Define='$phrase_define', DefineValue='$phrase_value' WHERE ID='$phraseID'");
			dom_hidemodal("LDDialog");
			eecho("ClearLD();");
			//redirect(SITEURL."/administrator/?p=languages&lg=$cl");
		}
		else
		{
			/**
				INSERT PHRASE
			*/
			$DefaultLang = getv("CodeLang",TBL_LANG,"DefaultLang","1");
			$Record = RecordCount("SELECT * FROM ".TBL_LANG_DEFINE." WHERE Define='$phrase_define' AND CodeLang='$DefaultLang'");
			if ($Record == 1)
			{
				SweetAlert('error','Ops !',_WARN_PHRASE_ALREADY_EXISTS);
				dom_select("phrase_define");
			}
			else
			{
				$r = $db->Execute("SELECT CodeLang FROM ".TBL_LANG." ORDER BY ID ASC");
				if (!$r) {
					l('DBQUERY','ajax.php','AddLangPhrase()->SelectLanguage',$db->ErrorMsg());
					SweetAlert_Error();
					die();
				} else {
					while (list($CodeLang) = $r->FetchRow())
					{
						$db->Execute("INSERT INTO ".TBL_LANG_DEFINE." (CodeLang, Define, DefineValue) VALUES ('$CodeLang','$phrase_define','$phrase_value')");
					}
				}				

				dom_hidemodal("LDDialog");		
				redirect(SITEURL."/administrator/?p=languages");
			}
		}
	}
}
function EditPhrase() {
	global $config, $db, $w_user;

	if (!is_sadmin($w_user))
	{
		SweetAlert('error','Ops !',_SUPER_ADMIN_ONLY_DESC);
	}
	else
	{
		$id = $_POST['id'];
		$lang_define = getv("DefineValue",TBL_LANG_DEFINE,"ID",$id);
		$return = addslashes(trimall(nl2br($lang_define)));
		$return = str_replace("<br />",'\n',$return);

		eecho("$('#phrase_value').val('".$return."');");
	}
}
function DeleteLang() {
	global $config, $db, $w_user;

	if (!is_sadmin($w_user))
	{
		SweetAlert('error','Ops !',_SUPER_ADMIN_ONLY_DESC);
	}
	else
	{
		$lang = $_POST['lang'];
		$Record = RecordCount("SELECT * FROM ".TBL_LANG." WHERE CodeLang='$lang'");
		if ($Record == 1)
		{
			$isDefault = RecordCount("SELECT * FROM ".TBL_LANG." WHERE CodeLang='$lang' AND DefaultLang=1");
			if ($isDefault == 1)
			{
				SweetAlert('error','Ops !',_CANNOT_DELETE_DEFAULT_LANG);
				die();
			}

			$r = $db->Execute("DELETE FROM ".TBL_LANG." WHERE CodeLang='$lang'");
			if (!$r) {
				l('DBQUERY','ajax.php','DeleteLang()->DeleteLanguagePack',$db->ErrorMsg());
				SweetAlert_Error();
				die();
			} else {
				$ra = $db->Execute("DELETE FROM ".TBL_LANG_DEFINE." WHERE CodeLang='$lang'");
				if (!$ra) {
					l('DBQUERY','ajax.php','DeleteLang()->DeleteLanguageDefine',$db->ErrorMsg());
					SweetAlert_Error();
					die();
				}
			}
		}

		redirect(SITEURL."/administrator/?p=languages");
	}
}
function DeletePhrase() {
	global $config, $db, $w_user;

	if (!is_sadmin($w_user))
	{
		SweetAlert('error','Ops !',_SUPER_ADMIN_ONLY_DESC);
	}
	else
	{
		$id = $_POST['id'];
		$Record = RecordCount("SELECT * FROM ".TBL_LANG_DEFINE." WHERE ID='$id'");
		if ($Record == 1)
		{
			$phrased = getv("Define",TBL_LANG_DEFINE,"ID",$id);

			$r = $db->Execute("DELETE FROM ".TBL_LANG_DEFINE." WHERE ID='$id'");
			if (!$r) {
				l('DBQUERY','ajax.php','DeletePhrase()->DeleteLanguagePhrase',$db->ErrorMsg());
				SweetAlert_Error();
				die();
			} else {
				$db->Execute("DELETE FROM ".TBL_LANG_DEFINE." WHERE Define='$phrased'");
			}
		}

		redirect(SITEURL."/administrator/?p=languages");	    
	}
}

// USER ROLES
function SaveUserrole() {
	global $config, $db, $w_user;

	if (!is_admin($w_user) && !is_sadmin($w_user))
	{
		SweetAlert('error','Ops !',_ADMIN_ONLY_DESC);
	}
	else
	{
		$ID = $_POST['ID'];
		$role = filter_txt($_POST['role']);
		$role_name = filter_txt($_POST['role_name']);

		if ($ID != 0 || $ID != "0")
		{
			/**
				UPDATE USER ROLE
			*/
			$rec = RecordCount("SELECT * FROM ".TBL_ROLES." WHERE role='$role' AND ID!='$ID'");
			if ($rec == 1)
			{
				SweetAlert('error','Ops !',_RECORD_ALREADY_EXISTS);
			}
			else
			{
				$iUpdate = dbe('UPDATE',"UPDATE ".TBL_ROLES." SET role='$role', role_name='$role_name' WHERE ID='$ID'",array('DBQUERY','ajax.php','SaveUserRole()->Update'));
				if (!$iUpdate) {
					SweetAlert_Error();
					die();
				} else {
					dom_hidemodal('URDialog');
					redirect(SITEURL."/administrator/?p=users");					
				}
			}
		}
		else
		{
			/**
				INSERT USER ROLE
			*/
			$rec = RecordCount("SELECT * FROM ".TBL_ROLES." WHERE role='$role'");
			if ($rec == 1) {
				SweetAlert('error','Ops !',_RECORD_ALREADY_EXISTS);
				die();
			}
			else
			{
				$NewID = dbe('INSERT',"INSERT INTO ".TBL_ROLES." (role,role_name) VALUES ('$role','$role_name')",array('DBQUERY','ajax.php','SaveUserrole()->InsertUserRole'));
				if (empty($NewID)) {
					SweetAlert_Error();
					die();
				} else {
					dom_hidemodal('UDDialog');
					redirect(SITEURL."/administrator/?p=users");
				}
			}
		}
	}
}
function EditUserrole() {
	global $config, $db, $w_user;

	if (!is_admin($w_user) && !is_sadmin($w_user))
	{
		SweetAlert('error','Ops !',_ADMIN_ONLY_DESC);
	}
	else
	{
		$ID = $_POST['id'];
		$rec = RecordCount("SELECT * FROM ".TBL_ROLES." WHERE ID='$ID'");
		if ($rec == 1)
		{
			dom_setvalue('_urole',getv('role',TBL_ROLES,'ID',$ID));
			dom_setvalue('_urolename',getv('role_name',TBL_ROLES,'ID',$ID));
			dom_setvalue('ID',$ID);
			dom_showmodal('URDialog');
			settimeout('$("#_urole").focus();',500);
		}
	}
}
function DeleteUserrole() {
	global $config, $db, $w_user;

	if (!is_admin($w_user) && !is_sadmin($w_user))
	{
		SweetAlert('error','Ops !',_ADMIN_ONLY_DESC);
	}
	else
	{
		$ID = $_POST['id'];
		$rec = RecordCount("SELECT * FROM ".TBL_ROLES." WHERE ID='$ID'");
		if ($rec == 1)
		{
			if ($ID == 1 || $ID == '1') {
				SweetAlert('error','Ops !',_CANNOT_DELETE_SUPER_ADMIN_USER_ROLE.' !');
				die();
			}

			$default = getv('isDefault',TBL_ROLES,'ID',$ID);
			if ($default == 1) {
				SweetAlert('error','Ops !',_CANNOT_DELETE_DEFAULT_USER_ROLE);
				die();
			}

			$iDelete = $db->Execute("DELETE FROM ".TBL_ROLES." WHERE ID='$ID'");
			if (!$iDelete) {
				SweetAlert_Error();
				die();
			} else {
				SweetAlert('success',_SUCCESS.' !',_RECORD_SUCCESSFULLY_DELETED,"window.location.href='".SITEURL."/administrator/?p=users';");
			}
		}
	}
}
function DefaultUserrole() {
	global $config, $db, $w_user;

	if (!is_admin($w_user) && !is_sadmin($w_user))
	{
		SweetAlert('error','Ops !',_ADMIN_ONLY_DESC);
	}
	else
	{
		$ID = $_POST['id'];
		$rec = RecordCount("SELECT * FROM ".TBL_ROLES." WHERE ID='$ID'");
		if ($rec == 1)
		{
			$iUpdate = $db->Execute("UPDATE ".TBL_ROLES." SET isDefault=1 WHERE ID='$ID'");
			if (!$iUpdate) {
				SweetAlert_Error();
				die();
			} else {
				$iUpdateOther = $db->Execute("UPDATE ".TBL_ROLES." SET isDefault=0 WHERE ID!='$ID'");
				SweetAlert('success',_SUCCESS.' !',_RECORD_SUCCESSFULLY_UPDATED,"window.location.href='".SITEURL."/administrator/?p=users';");
			}
		}
	}
}

// USERS
function SaveUser() {
	global $config, $db, $w_user;

	if (!is_sadmin($w_user) && !is_admin($w_user))
	{
		SweetAlert('error','Ops !',_ADMIN_ONLY_DESC);
	}
	else
	{
		$UserID = $_POST['UserID'];
		$loginid = filter_txt($_POST['loginid']);
		$firstname = filter_txt($_POST['firstname']);
		$lastname = filter_txt($_POST['lastname']);
		$email = filter_txt($_POST['email']);
		$user_roles = $_POST['user_roles'];
		$user_groups = $_POST['user_groups'];
		$accstatus = strtoupper($_POST['accstatus']);
		$pwd = $_POST['pwd'];
		$chgpwd = $_POST['chgpwd'];

		if (strlen($pwd) != 0) {
			$pwd_encrypted = strtoupper(md5(strtoupper($pwd) . $config->LicenseKey));
		}

		if (!empty($UserID))
		{
			/**
				UPDATE USER
			*/
			$pwd_chg = (strlen($pwd) != 0) ? ", Passwd='$pwd_encrypted'":"";

			$recUser = RecordCount("SELECT * FROM ".TBL_USERS." WHERE LOWER(LoginID)='".strtolower($loginid)."' AND UID!='$UserID'");
			if ($recUser == 1)
			{
				SweetAlert('error','Ops !',_USER_ALREADY_EXISTS);
			}
			else
			{
				$iUpdate = dbe('UPDATE',"UPDATE ".TBL_USERS." SET NeedChangePwd='$chgpwd', LoginID='$loginid', AccStatus='$accstatus', Lastupdate=NOW() $pwd_chg WHERE UID='$UserID'",array('DBQUERY','ajax.php','SaveUser()->Update'));
				if (!$iUpdate) {
					SweetAlert_Error();
					die();
				} else {
					$iUpdateUD = dbe('UPDATE',"UPDATE ".TBL_USERS_DETAIL." SET Firstname='$firstname', Lastname='$lastname', Email='$email' WHERE UID='$UserID'",array('DBQUERY','ajax.php','SaveUser()->UpdateUserDetail'));
					if (!$iUpdateUD) {
						SweetAlert_Error();
						die();
					} else {
						// User Roles
						dbe('DELETE',"DELETE FROM ".TBL_USER_ROLES." WHERE user_id='$UserID'");
						if (strlen($user_roles) != 0)
						{
							foreach (explode(',', $user_roles) as $role_id)
							{
								if (RecordCount("SELECT * FROM ".TBL_USER_ROLES." WHERE role_id='$role_id' AND user_id='$UserID'") == 0)
								{
									dbe('INSERT',"INSERT INTO ".TBL_USER_ROLES." (user_id,role_id) VALUES ('$UserID','$role_id')",array('DBQUERY','ajax.php','SaveUser()->InsertUserRoles'));
								}
							}
						}

						// User Groups
						dbe('DELETE',"DELETE FROM ".TBL_USER_GROUPS." WHERE user_id='$UserID'");
						if (strlen($user_groups) != 0)
						{
							foreach (explode(',', $user_groups) as $group_id)
							{
								if (RecordCount("SELECT * FROM ".TBL_USER_GROUPS." WHERE group_id='$group_id' AND user_id='$UserID'") == 0)
								{
									dbe('INSERT',"INSERT INTO ".TBL_USER_GROUPS." (user_id,group_id) VALUES ('$UserID','$group_id')",array('DBQUERY','ajax.php','SaveUser()->InsertUserGroups'));
								}
							}
						}

						dom_hidemodal('UserDialog');
						redirect(SITEURL."/administrator/?p=users");
					}
				}
			}
		}
		else
		{
			/**
				INSERT USER
			*/
			$recUser = RecordCount("SELECT * FROM ".TBL_USERS." WHERE LOWER(LoginID)='".strtolower($loginid)."'");
			if ($recUser == 1)
			{
				SweetAlert('error','Ops !',_USER_ALREADY_EXISTS);
			}
			else
			{
				$NewUID = dbe('INSERT',"INSERT INTO ".TBL_USERS." (LoginID,Passwd,NeedChangePwd,AccStatus,Lastupdate) VALUES ('$loginid','$pwd_encrypted','$chgpwd','$accstatus',NOW())",array('DBQUERY','ajax.php','SaveUser()->InsertUser'));
				if (empty($NewUID)) {
					SweetAlert_Error();
					die();
				} else {
					$iCreateUD = dbe('_INSERT',"INSERT INTO ".TBL_USERS_DETAIL." (UID,Firstname,Lastname,Email) VALUES ('$NewUID','$firstname','$lastname','$email')",array('DBQUERY','ajax.php','SaveUser()->InsertUserDetail'));
					if (!$iCreateUD) {
						SweetAlert_Error();
						die();
					} else {
						// User Roles
						if (strlen($user_roles) != 0)
						{
							foreach (explode(',', $user_roles) as $role_id)
							{
								dbe('INSERT',"INSERT INTO ".TBL_USER_ROLES." (user_id,role_id) VALUES ('$NewUID','$role_id')",array('DBQUERY','ajax.php','SaveUser()->InsertUserRoles'));
							}
						}

						// User Groups
						if (strlen($user_groups) != 0)
						{
							foreach (explode(',', $user_groups) as $group_id)
							{
								dbe('INSERT',"INSERT INTO ".TBL_USER_GROUPS." (user_id,group_id) VALUES ('$UserID','$group_id')",array('DBQUERY','ajax.php','SaveUser()->InsertUserGroups'));
							}
						}

						dom_hidemodal('UserDialog');
						redirect(SITEURL."/administrator/?p=users");
					}
				}
			}
		}
	}
}
function EditUser() {
	global $config, $db, $w_user;

	if (!is_admin($w_user) && !is_sadmin($w_user))
	{
		SweetAlert('error','Ops !',_ADMIN_ONLY_DESC);
	}
	else
	{
		$UserID = filter_num($_POST['uid']);
		$recUser = RecordCount("SELECT * FROM ".TBL_USERS." WHERE UID='$UserID'");
		if ($recUser == 1)
		{
			dom_setvalue('_loginid',getUser('LoginID',$UserID));
			dom_setvalue('_firstname',filter_decode(getUserDetail('Firstname',$UserID)));
			dom_setvalue('_lastname',filter_decode(getUserDetail('Lastname',$UserID)));
			dom_setvalue('_email',filter_decode(getUserDetail('Email',$UserID)));
			dom_select2multiple_set('_ur',getUserRoles($UserID,'array'));
			dom_select2multiple_set('_ug',getUserGroups($UserID,'array'));
			$accststus = strtolower(getUser('AccStatus',$UserID));
			dom_checked("_acc_$accststus");
			dom_setvalue('UserID',$UserID);
			dom_setvalue('pwd','');
			dom_showmodal('UserDialog');
			settimeout('$("#loginid").focus();',500);
		}
	}
}
function DeleteUser() {
	global $config, $db, $w_user;

	if (!is_admin($w_user) && !is_sadmin($w_user))
	{
		SweetAlert('error','Ops !',_ADMIN_ONLY_DESC);
	}
	else
	{
		$UserID = filter_num($_POST['uid']);
		$recUser = RecordCount("SELECT * FROM ".TBL_USERS." WHERE UID='$UserID'");
		if ($recUser == 1)
		{
			$super = userHasRole($UserID,'super-admin');
			if ($super == true) {
				SweetAlert('error','Ops !',_CANNOT_DELETE_SUPER_ADMIN_USER_ROLE);
				die();
			}

			$iDelete = dbe('DELETE',"DELETE FROM ".TBL_USERS." WHERE UID='$UserID'",array('DBQUERY','ajax.php','DeleteUser()->Delete'));
			if (!$iDelete) {
				SweetAlert_Error();
				die();
			} else {
				$iDeleteUD = dbe('DELETE',"DELETE FROM ".TBL_USERS_DETAIL." WHERE UID='$UserID'",array('DBQUERY','ajax.php','DeleteUser()->DeleteUserDetail'));
				if (!$iDeleteUD) {
					SweetAlert_Error();
					die();
				} else {
					SweetAlert('success',_SUCCESS.' !',_RECORD_SUCCESSFULLY_DELETED,"window.location.href='".SITEURL."/administrator/?p=users';");
				}
			}
		}
	}
}

// USERGROUPS
function SaveGroup() {
	global $config, $db, $w_user;

	if (!is_sadmin($w_user))
	{
		SweetAlert('error','Ops !',_SUPER_ADMIN_ONLY_DESC);
	}
	else
	{
		$GID = $_POST['gid'];
		$GroupCode = filter_txt($_POST['groupcode']);
		$GroupName = filter_txt($_POST['groupname']);
		
		if (!empty($GID))
		{
			/**
				UPDATE USERGROUPS
			*/
			$rec = RecordCount("SELECT * FROM ".TBL_USERGROUPS." WHERE group_code='$GroupCode' AND ID!='$GID'");
			if ($rec == 1)
			{
				SweetAlert('error','Ops !',_RECORD_ALREADY_EXISTS);
			}
			else
			{
				$iUpdate = dbe('UPDATE',"UPDATE ".TBL_USERGROUPS." SET group_code='$GroupCode', group_name='$GroupName' WHERE ID='$GID'",array('DBQUERY','ajax.php','SaveGroup()->Update'));
				if (!$iUpdate) {
					SweetAlert_Error();
					die();
				} else {
					dom_hidemodal('UGDialog');
					redirect(SITEURL."/administrator/?p=users");					
				}
			}
		}
		else
		{
			/**
				INSERT USERGROUPS
			*/
			$rec = RecordCount("SELECT * FROM ".TBL_USERGROUPS." WHERE group_code='$GroupCode'");
			if ($rec == 1) {
				SweetAlert('error','Ops !',_RECORD_ALREADY_EXISTS);
				die();
			}
			else
			{
				$NewGID = dbe('INSERT',"INSERT INTO ".TBL_USERGROUPS." (group_code,group_name) VALUES ('$GroupCode','$GroupName')",array('DBQUERY','ajax.php','SaveGroup()->InsertGroup'));
				if (empty($NewGID)) {
					SweetAlert_Error();
					die();
				} else {
					dom_hidemodal('UGDialog');
					redirect(SITEURL."/administrator/?p=users");
				}
			}
		}
	}
}
function EditGroup() {
	global $config, $db, $w_user;

	if (!is_sadmin($w_user))
	{
		SweetAlert('error','Ops !',_SUPER_ADMIN_ONLY_DESC);
	}
	else
	{
		$GID = $_POST['gid'];
		$rec = RecordCount("SELECT * FROM ".TBL_USERGROUPS." WHERE ID='$GID'");
		if ($rec == 1)
		{
			dom_setvalue('_groupcode',getv('group_code',TBL_USERGROUPS,'ID',$GID));
			dom_setvalue('_groupname',getv('group_name',TBL_USERGROUPS,'ID',$GID));
			dom_setvalue('GID',$GID);
			dom_showmodal('UGDialog');
			settimeout('$("#_groupcode").focus();',500);
		}
	}
}
function DeleteGroup() {
	global $config, $db, $w_user;

	if (!is_sadmin($w_user))
	{
		SweetAlert('error','Ops !',_SUPER_ADMIN_ONLY_DESC);
	}
	else
	{
		$GID = $_POST['gid'];
		$rec = RecordCount("SELECT * FROM ".TBL_USERGROUPS." WHERE ID='$GID'");
		if ($rec == 1)
		{
			$default = getv('isDefault',TBL_USERGROUPS,'ID',$GID);
			if ($default == 1) {
				SweetAlert('error','Ops !',_CANNOT_DELETE_DEFAULT_USERGROUP);
				die();
			}

			$db->Execute("DELETE FROM ".TBL_USERGROUPS." WHERE ID='$GID'");
			SweetAlert('success',_SUCCESS.' !',_RECORD_SUCCESSFULLY_DELETED,"window.location.href='".SITEURL."/administrator/?p=users';");
		}
	}
}
function DefaultGroup() {
	global $config, $db, $w_user;

	if (!is_sadmin($w_user))
	{
		SweetAlert('error','Ops !',_SUPER_ADMIN_ONLY_DESC);
	}
	else
	{
		$GID = $_POST['gid'];
		$rec = RecordCount("SELECT * FROM ".TBL_USERGROUPS." WHERE ID='$GID'");
		if ($rec == 1)
		{
			$iUpdate = $db->Execute("UPDATE ".TBL_USERGROUPS." SET isDefault=1 WHERE ID='$GID'");
			if (!$iUpdate) {
				SweetAlert_Error();
				die();
			} else {
				$iUpdateOther = $db->Execute("UPDATE ".TBL_USERGROUPS." SET isDefault=0 WHERE ID!='$GID'");
				SweetAlert('success',_SUCCESS.' !',_RECORD_SUCCESSFULLY_UPDATED,"window.location.href='".SITEURL."/administrator/?p=users';");
			}
		}
	}
}

// MESSAGES CENTER
function SaveMsg() {
	global $config, $db, $w_user;

	if (!is_admin($w_user) && !is_sadmin($w_user))
	{
		SweetAlert('error','Ops !',_ADMIN_ONLY_DESC);
	}
	else
	{
		$MID = $_POST['MID'];
		$title = filter_txt($_POST['title']);
		$msgtype = strtoupper($_POST['msgtype']);
		$msgstatus = filter_bool(strtolower($_POST['msgstatus'])); // true || false --> 1 | 0
		$allowreply = filter_bool(strtolower($_POST['allowreply'])); // true || false --> 1 | 0
		$txt = filter_txt($_POST['txt']);
		$expired_on = $_POST['expired_on']; // dd/mm/yyyy
		$action_expired = strtoupper($_POST['action_expired']); // INACTIVE || DELETE
		$_depts = $_POST['depts'];
		$depts = $_depts;
		$tags = remove_quotes(strtolower($_POST['tags']));

		if (strlen($expired_on)!= 0) {
			$expired_on = FormatDateToDB($expired_on) . ' 23:59:59';
			$_ExpiredOn = "UNIX_TIMESTAMP('$expired_on')";
		} else {
			$_ExpiredOn = "''";
		}

		# Validation
		if (strlen($title) == 0)
		{
			dom_focus('_title');
			die();
		}
		if (strlen($txt) == 0)
		{
			eecho("$('#_txt').summernote('focus');");
			die();
		}
		if (strlen($msgtype) == 0)
		{
			SweetAlert('error','Ops !',_PLEASE_CHOOSE_MESSAGE_TYPE);
			die();
		}
		if (strlen($expired_on) != 0) {
			if (strlen($action_expired) == 0)
			{
				SweetAlert('error','Ops !',_PLEASE_CHOOSE_ACTION_WHEN_EXPIRED);
				die();
			}
		}
		if (strlen($depts) == 0)
		{
	        SweetAlert('error','Ops !',_PLEASE_SELECT_RECIPIENT);
	        die();
	    }

	    $depts = ",$depts,";

		if ($MID != 0)
		{
			/**
				UPDATE MESSAGE
			*/
			$rec = RecordCount("SELECT * FROM ".TBL_MESSAGES." WHERE ID='$MID'");
			if ($rec == 1)
			{
				$recMsg = RecordCount("SELECT * FROM ".TBL_MESSAGES." WHERE Title='$title' AND ID!='$MID'");
				if ($recMsg > 0) {
					SweetAlert('error','Ops !',_RECORD_ALREADY_EXISTS);
					die();
				}

				$iUpdate = dbe('UPDATE',"UPDATE ".TBL_MESSAGES." SET Title='$title', Txt='$txt', PostDate=NOW(), ExpiredOn=$_ExpiredOn, MsgStatus='$msgstatus', AllowReply='$allowreply', ActionExpired='$action_expired', MsgType='$msgtype', MsgFor='$depts', Tags='$tags' WHERE ID='$MID'",array('DBQUERY','ajax.php','SaveMsg()->UpdateMessage'));
				if (!$iUpdate) {
					SweetAlert_Error();
					die();
				} else {

					# Notifications for all users in departments
					$notifydepts = explode(',', $_depts);
					foreach ($notifydepts as $dept)
					{
						$su = dbe('SELECT',"SELECT u.UID FROM ".TBL_USERS." u, ".TBL_USERS_DETAIL." ud WHERE u.UID=ud.UID AND u.AccStatus='ACTIVE' AND ud.DepartmentID='$dept' GROUP BY UID ORDER BY UID ASC");
						if ($su->RecordCount() > 0)
						{
							while (list($UID) = $su->FetchRow())
							{
								notifications('WEB','MESSAGES-CENTER','',$MID,'',$UID,'SYSTEM');
							}
						}
					}

					dom_hidemodal('MsgDialog');
					SweetAlert('success',_SUCCESS.' !',_MESSAGE_SUCCESSFULLY_UPDATED,"window.location.href='".SITEURL."/administrator/?p=messages_center';");
				}
			}
		}
		else
		{
			/**
				INSERT MESSAGE
			*/
			$recMsg = RecordCount("SELECT * FROM ".TBL_MESSAGES." WHERE Title='$title'");
			if ($recMsg > 0)
			{
				SweetAlert('error','Ops !',_RECORD_ALREADY_EXISTS);
				die();
			}

			$NewMsgID = dbe('INSERT',"INSERT INTO ".TBL_MESSAGES." (Title,Txt,PostDate,ExpiredOn,ActionExpired,MsgStatus,AllowReply,MsgType,MsgFor,Tags) VALUES ('$title','$txt',NOW(),$_ExpiredOn,'$action_expired','$msgstatus','$allowreply','$msgtype','$depts','$tags')",array('DBQUERY','ajax.php','SaveMsg()->InsertMsg'));
			if (!$NewMsgID) {
				SweetAlert_Error();
				die();
			} else {

				# Notifications for all users in departments
				$notifydepts = explode(',', $_depts);
				foreach ($notifydepts as $dept)
				{
					$su = dbe('SELECT',"SELECT u.UID FROM ".TBL_USERS." u, ".TBL_USERS_DETAIL." ud WHERE u.UID=ud.UID AND u.AccStatus='ACTIVE' AND ud.DepartmentID='$dept' GROUP BY UID ORDER BY UID ASC");
					if ($su->RecordCount() > 0)
					{
						while (list($UID) = $su->FetchRow())
						{
							notifications('WEB','MESSAGES-CENTER','',$NewMsgID,'',$UID,'SYSTEM');
						}
					}
				}

				dom_hidemodal('MsgDialog');
				SweetAlert('success',_SUCCESS.' !',_MESSAGE_SUCCESSFULLY_RECORD,"window.location.href='".SITEURL."/administrator/?p=messages_center';");
			}
		}
	}
}
function EditMsg() {
	global $config, $db, $w_user;

	if (!is_admin($w_user) && !is_sadmin($w_user))
	{
		SweetAlert('error','Ops !',_ADMIN_ONLY_DESC);
	}
	else
	{
		$MsgID = filter_num($_POST['mid']);
		$rec = RecordCount("SELECT * FROM ".TBL_MESSAGES." WHERE ID='$MsgID'");
		if ($rec == 1)
		{
			$ExpiredOn = getv('ExpiredOn',TBL_MESSAGES,'ID',$MsgID);
			$MsgExpiredOn = getv('FROM_UNIXTIME(ExpiredOn)',TBL_MESSAGES,'ID',$MsgID);
			if (strlen($ExpiredOn) != 0) {
				$MsgExpiredOn = FormatDateTimeDate($MsgExpiredOn);
				dom_setvalue('_expired_on',$MsgExpiredOn);
			}

			$MsgTitle = getv('Title',TBL_MESSAGES,'ID',$MsgID);
			$MsgTxt = getv('Txt',TBL_MESSAGES,'ID',$MsgID);
			$txt = addslashes(filter_decode($MsgTxt,'view',false,false));
			$MsgType = strtolower(getv('MsgType',TBL_MESSAGES,'ID',$MsgID));
			$MsgStatus = getv('MsgStatus',TBL_MESSAGES,'ID',$MsgID);
			$AllowReply = getv('AllowReply',TBL_MESSAGES,'ID',$MsgID);
			$ActionExpired = strtolower(getv('ActionExpired',TBL_MESSAGES,'ID',$MsgID));
			$MsgFor = getv('MsgFor',TBL_MESSAGES,'ID',$MsgID);
			$Tags = getv('Tags',TBL_MESSAGES,'ID',$MsgID);

			dom_setvalue('_title', filter_decode($MsgTitle,'edit-input-ajax',false,false));			
			eecho("$('#_txt').summernote('code','$txt');");
			dom_checked("_msg_$MsgType");
			if ($MsgStatus == 1) {
				dom_checked('_active');
			} else {
				dom_unchecked('_active');
			}
			if ($AllowReply == 1) {
				dom_checked('_allow_reply');
			} else {
				dom_unchecked('_allow_reply');
			}
			dom_checked("_ae_$ActionExpired");
			dom_setvalue('MID',$MsgID);
			dom_importtags('_tags',$Tags);

			$depts = explode(',', $MsgFor);
			foreach ($depts as $dept) {
				dom_checked("_dept_$dept");
			}

			dom_showmodal('MsgDialog');
			settimeout('$("#_title").focus();',500);
		}
	}
}
function DeleteMsg() {
	global $config, $db, $w_user;

	if (!is_admin($w_user) && !is_sadmin($w_user))
	{
		SweetAlert('error','Ops !',_ADMIN_ONLY_DESC);
	}
	else
	{
		$MsgID = filter_num($_POST['mid']);
		$rec = RecordCount("SELECT * FROM ".TBL_MESSAGES." WHERE ID='$MsgID'");
		if ($rec > 0) {
			$iDelete = dbe('DELETE',"DELETE FROM ".TBL_MESSAGES." WHERE ID='$MsgID'",array('DBQUERY','ajax.php','DeleteMsg()'));
			if (!$iDelete) {
				SweetAlert_Error();
				die();
			} else {
				SweetAlert('success',_SUCCESS.' !',_RECORD_SUCCESSFULLY_DELETED,"window.location.href='".SITEURL."/administrator/?p=messages_center';");
			}
		}
	}
}

// TEMPLATES
// NOT IMPLEMENTED
function SaveTemplate() {
	global $config, $db, $w_user;

	if (!is_admin($w_user) && !is_sadmin($w_user))
	{
		SweetAlert('error','Ops !',_ADMIN_ONLY_DESC);
	}
	else
	{
		$ID = filter_num($_POST['ID']);
		$JenisTemplate = strtoupper($_POST['JenisTemplate']);
		$_Title = $_POST['Title'];
		$Title = filter_txt($_POST['Title']);
		$_Template = $_POST['Template'];
		$Template = filter_txt($_Template,'editor');

		// Validation
		if (strlen($Title) == 0)
		{
			SweetAlert('error','Ops !',_PLEASE_ENTER_TITLE);
			die();
		}
		if (strlen($JenisTemplate) == 0)
		{
			SweetAlert('error','Ops !',"Sila masukkan Jenis Template !");
			die();
		}
		if (strlen($Template) == 0)
		{
			SweetAlert('error','Ops !',"Sila masukkan teks template !");
			die();
		}

		if ($ID != 0)
		{
			// UPDATE
			$rec = RecordCount("SELECT * FROM ".TBL_TEMPLATES." WHERE ID='$ID'");
			if ($rec > 0)
			{
				$rec = RecordCount("SELECT * FROM ".TBL_TEMPLATES." WHERE TajukTemplate='$Title' AND ID!='$ID'");
				if ($rec > 0) {
					SweetAlert('error','Ops !',_RECORD_ALREADY_EXISTS);
					die();
				}

				$iUpdate = $db->Execute("UPDATE ".TBL_TEMPLATES." SET JenisTemplate='$JenisTemplate', TajukTemplate='$Title', Template='$Template', Lastupdate=NOW(), LastupdateBy='".USERID."' WHERE ID='$ID'");
				if (!$iUpdate) {
					l('DBQUERY','AJAX','SaveTemplate',$db->ErrorMsg());
					die();
				} else {
					eecho('$("#TemplateDialog").modal("hide");');
					SweetAlert('success',_SUCCESS.' !',_MESSAGE_SUCCESSFULLY_UPDATED,"window.location.href='".SITEURL."/system/?p=templates';");
				}
			}
		}
		else
		{
			// INSERT
			$rec = RecordCount("SELECT * FROM ".TBL_TEMPLATES." WHERE TajukTemplate='$Title'");
			if ($rec > 0) {
				SweetAlert('error','Ops !',_RECORD_ALREADY_EXISTS);
				die();
			}

			$iCreate = $db->Execute("INSERT INTO ".TBL_TEMPLATES." (JenisTemplate,TajukTemplate,Template,Lastupdate,LastupdateBy) VALUES ('$JenisTemplate','$Title','$Template',NOW(),'".USERID."')");
			if (!$iCreate) {
				l('DBQUERY','AJAX','SaveTemplate',$db->ErrorMsg());
				die();
			} else {
				eecho('$("#TemplateDialog").modal("hide");');
				SweetAlert('success',_SUCCESS.' !',_MESSAGE_SUCCESSFULLY_RECORD,"window.location.href='".SITEURL."/system/?p=templates';");
			}
		}
	}
}
function EditTemplate() {
	global $config, $db, $w_user;

	if (!is_admin($w_user) && !is_sadmin($w_user))
	{
		SweetAlert('error','Ops !',_ADMIN_ONLY_DESC);
	}
	else
	{
		$ID = filter_num($_POST['id']);

		$rec = RecordCount("SELECT * FROM ".TBL_TEMPLATES." WHERE ID='$ID'");
		if ($rec > 0)
		{
			$Title = getv('TajukTemplate',TBL_TEMPLATES,'ID',$ID);
			$JenisTemplate = getv('JenisTemplate',TBL_TEMPLATES,'ID',$ID);
			$Template = getv('Template',TBL_TEMPLATES,'ID',$ID);
			$Template = filter_decode($Template,'edit-editor',false);

			dom_setvalue('Title', filter_decode($Title,'view',false));
			dom_setvalue('JenisTemplate', filter_decode($JenisTemplate,'view',false));
			//dom_settextarea('Template', filter_decode($Template,'view',false));
			//eecho("CKEDITOR.instances['js-ckeditor'].setData('".$Template."');");
			eecho("$('#Template').summernote('code','".$Template."');");
			dom_setvalue('TID',$ID);

			eecho('$("#TemplateDialog").modal("show");');
			settimeout('$("#Title").focus();',500);
		}
	}
}
function DeleteTemplate() {
	global $config, $db, $w_user;

	if (!is_admin($w_user) && !is_sadmin($w_user))
	{
		SweetAlert('error','Ops !',_ADMIN_ONLY_DESC);
	}
	else
	{
		$ID = filter_num($_POST['id']);

		$rec = RecordCount("SELECT * FROM ".TBL_TEMPLATES." WHERE ID='$ID'");
		if ($rec > 0) {
			$iDelete = $db->Execute("DELETE FROM ".TBL_TEMPLATES." WHERE ID='$ID'");
			if (!$iDelete) {
				l('DBQUERY','AJAX','DeleteTemplate',$db->ErrorMsg());
				die();
			} else {
				SweetAlert('success',_SUCCESS.' !',_RECORD_SUCCESSFULLY_DELETED,"window.location.href='".SITEURL."/system/?p=templates';");
			}
		}
	}
}

//=================================================

/**

	[ONLINE] : USERS

*/
# GENERAL
function Welcome() {
	global $config, $db;

	$dont_show = filter_bool($_POST['dont_show']);
	$ds = ($dont_show == 1 || $dont_show == "1") ? "0":"1";

	$UserAccept = dbe('UPDATE',"UPDATE ".TBL_USERS." SET FirstTimeLogin='$ds', Lastupdate=NOW() WHERE UID='".USERID."'",array('DBQUERY','ajax.php','Welcome()->UpdateUserWelcome'));
	if ($UserAccept == true)
	{
		# Need to change password
		$NeedChangePwd = intval(getUser("NeedChangePwd"));
		if ($NeedChangePwd == 1)
		{
			settimeout("$('#need_chgpwd').removeClass(\"hide\"); $('#pwd-new').focus();",1000);
		}
	}	
}
function LockScreen() {
	global $config, $db;
	
	$redirect = $_POST['redirect'];
	if (strlen($redirect) != 0)
	{
		$url = $redirect;
	}
	else
	{
		$url = "";
	}

	$Lock = dbe('UPDATE',"UPDATE ".TBL_USERS." SET isLockscreen=1 WHERE UID='".USERID."'",array('DBQUERY','ajax.php','LockScreen()'));
	if ($Lock == true)
	{
		redirect(SITEURL.$url);
	}	
}
function UnlockScreen() {
	global $config, $db;
	
	$pwd = $_POST['pwd'];
	if (strlen($pwd) == 0)
	{
		dom_focus("pwd-unlock-screen");
		die();
	}
	
	$pwd_encrypted = strtoupper(md5(strtoupper($pwd) . $config->LicenseKey));
	$Unlock = RecordCount("SELECT * FROM ".TBL_USERS." WHERE UID='".USERID."' AND Passwd='$pwd_encrypted'");
	if ($Unlock == 1)
	{
		$iUpdate = dbe('UPDATE',"UPDATE ".TBL_USERS." SET isLockscreen=0 WHERE UID='".USERID."' AND Passwd='$pwd_encrypted'",array('DBQUERY','ajax.php','UnlockScreen()'));
		if ($iUpdate == true)
		{
			dom_fadeout('lock_screen');
		}
		else
		{
			SweetAlert('error','Ops !',_INVALID_ACC);
			dom_select("pwd-unlock-screen");			
		}
	}
	else
	{
		SweetAlert('error','Ops !',_INVALID_ACC);
		dom_select("pwd-unlock-screen");
	}
}
function NeedChangePwd() {
	global $config, $db, $w_user;

	$pwd = $_POST['pwd'];
	if (strlen($pwd) < 5)
	{
		SweetAlert('error','Ops !',sprintf(_PLEASE_ENTER_AT_LEAST, 5));
		dom_select("pwd-new");
		die();
	}

	$pwd_encrypted = strtoupper(md5(strtoupper($pwd) . $config->LicenseKey));
	$ChangePassword = dbe('UPDATE',"UPDATE ".TBL_USERS." SET NeedChangePwd=0, Passwd='$pwd_encrypted', Lastupdate=NOW() WHERE UID='".USERID."'",array('DBQUERY','ajax.php','NeedChangePwd()'));
	if ($ChangePassword == true)
	{
		dom_fadeout('need_chgpwd');
		Notify("success",_NEW_PASSWORD_CHANGED);
	}
}
function Logout() {
	global $config, $db, $w_user;

	$redirect = $_POST['redirect'];
	if (strlen($redirect) != 0)
	{
		$url = $redirect;
	}
	else
	{
		$url = SITEURL;
	}

	$LogSID = strtoupper(md5(uniqid(microtime()).$config->LicenseKey.IP_ADDRESS.$_SERVER['HTTP_USER_AGENT']));
	$Logout = dbe("UPDATE","UPDATE ".TBL_USERS." SET SID='$LogSID', Lastvisit=NOW(), Lastupdate=NOW(), LoginIP='".IP_ADDRESS."', StatusOnline='OFFLINE', SessionTime='0' WHERE UID='".USERID."'",array('DBQUERY','MEMBERS','Logout()'));
	if ($Logout == true)
	{
		delete_cookie("w_user",$config->SiteDomain);
	}
	
	redirect($url);
}

# PROFILE
function SavePerjawatanICT() {
	global $config, $db, $w_user;
	
	$jawatan = filter_txt($_POST['jawatan']);
    $nama = strtoupper(filter_txt($_POST['nama']));
    $nokp = filter_txt($_POST['nokp']);
    $mobileno = filter_txt($_POST['mobileno']);
    $email = filter_txt($_POST['email']);

    $Record = RecordCount("SELECT * FROM ".TBL_PERJAWATAN_ICT." WHERE KodSekolah='".getUserDetail('KodSekolah')."' AND NoKP='$nokp'");
	if ($Record > 0)
	{
		SweetAlert('error','Ops !',_RECORD_ALREADY_EXISTS);
	}
	else
	{
		$r = $db->Execute("INSERT INTO ".TBL_PERJAWATAN_ICT." (KodSekolah,Jawatan,Nama,NoKP,NoMobile,EmelRasmi) VALUES ('".getUserDetail('KodSekolah')."','$jawatan','$nama','$nokp','$mobileno','$email')");
		if (!$r) {
			l('DBQUERY','ajax.php','SavePerjawatanICT()->InsertPerjawatanICT',$db->ErrorMsg());
			SweetAlert_Error();
			die();
		} else {
			dom_hidemodal("DialogPICT");
			SweetAlert('success',_SUCCESS.' !',_RECORD_SUCCESSFULLY_UPDATED,"window.location.href='".SITEURL."/profile';");
		}
	}
}
function DeletePerjawatanICT() {
	global $config, $db, $w_user;

	$ID = $_POST['id'];

	$rec = RecordCount("SELECT * FROM ".TBL_PERJAWATAN_ICT." WHERE ID='$ID'");
	if ($rec == 1)
	{
		$iDelete = $db->Execute("DELETE FROM ".TBL_PERJAWATAN_ICT." WHERE ID='$ID'");
		if (!$iDelete) {
			SweetAlert_Error();
			die();
		} else {
			SweetAlert('success',_SUCCESS.' !',_RECORD_SUCCESSFULLY_DELETED,"window.location.href='".SITEURL."/profile';");
		}
	}
}
function ChangePPD() {
	global $config, $db, $w_user;
	
	$KodJPN = strtolower($_POST['JPN']);

	$r = $db->Execute("SELECT KodPPD,PPD FROM ".TBL_PPD." WHERE KodJPN='$KodJPN' ORDER BY KodPPD ASC");
	$data = array();
	$data[] = array('id' => '' ,'text' => "");
	while (list($kod,$d) = $r->FetchRow())
	{
		$data[] = array('id' => $kod ,'text' => "$kod - $d");
	}

	echo '$(\'#_ppd\').empty().trigger(\'change\');';
	echo '$(\'#_ppd\').select2({ data:'.json_encode($data).' });';	
	
	echo '$(\'#_jpn\').next(\'.select2-container\').addClass(\'push-10\');';
	echo '$(\'#_ppd\').next(\'.select2-container\').addClass(\'push-10\');';
}
function ChangePKGSEK() {
	global $config, $db, $w_user;
	
	$mode = strtolower($_POST['mode']);
	$KodPPD = strtolower($_POST['PPD']);

	if ($mode != 'ppd')
	{
		// PKG
		$r = $db->Execute("SELECT KodPKG,PKG FROM ".TBL_PKG." WHERE KodPPD='$KodPPD' ORDER BY KodPKG ASC");
		$data_pkg = array();
		$data_pkg[] = array('id' => '' ,'text' => "");
		while (list($kod_pkg,$d_pkg) = $r->FetchRow())
		{
			$data_pkg[] = array('id' => $kod_pkg ,'text' => "$kod_pkg - $d_pkg");
		}
		echo '$(\'#_pkg\').empty().trigger(\'change\');';
		echo '$(\'#_pkg\').select2({ data:'.json_encode($data_pkg).' });';	
		echo '$(\'#_pkg\').next(\'.select2-container\').addClass(\'push-10\');';
	}

	if ($mode != 'pkg')
	{
		// SEKOLAH
		$r = $db->Execute("SELECT KodSekolah,NamaSekolah FROM ".TBL_SEKOLAH." WHERE KodPPD='$KodPPD' ORDER BY KodSekolah ASC");
		$data_sekolah = array();
		$data_sekolah[] = array('id' => '' ,'text' => "");
		while (list($kod_sekolah,$d_sekolah) = $r->FetchRow())
		{
			$data_sekolah[] = array('id' => $kod_sekolah ,'text' => "$kod_sekolah - $d_sekolah");
		}
		echo '$(\'#_sekolah\').empty().trigger(\'change\');';
		echo '$(\'#_sekolah\').select2({ data:'.json_encode($data_sekolah).' });';	
	}
}
function SaveProfile() {
	global $config, $db, $w_user;
	
	$firstname = strtoupper(filter_txt($_POST['firstname']));
    $nokp = filter_txt($_POST['nokp']);
    $gred = filter_txt($_POST['gred']);
    $email = filter_txt($_POST['email']);
    $mobileno = filter_txt($_POST['mobileno']);
    $akademik = filter_txt($_POST['akademik']);
    $pengkhususan = strtoupper(filter_txt($_POST['pengkhususan']));
    $taraf_jawatan = filter_txt($_POST['taraf_jawatan']);
    $tarikh_lantikan_pertama = FormatDateToDB($_POST['tarikh_lantikan_pertama']);
    $tarikh_khidmat = FormatDateToDB($_POST['tarikh_khidmat']);
    $opsyen = filter_txt($_POST['opsyen']);
    $jarak = filter_txt($_POST['jarak']);
    $alamat1 = strtoupper(filter_txt($_POST['alamat1']));
    $alamat2 = strtoupper(filter_txt($_POST['alamat2']));
    $poskod = filter_txt($_POST['poskod']);
    $bandar = strtoupper(filter_txt($_POST['bandar']));
    $negeri = filter_txt($_POST['negeri']);
    $tempat_bertugas = filter_txt($_POST['tempat_bertugas']);
    $jpn = filter_txt($_POST['jpn']);
    $ppd = filter_txt($_POST['ppd']);
    $pkg = filter_txt($_POST['pkg']);
    $sekolah = filter_txt($_POST['sekolah']);
	$pwd = $_POST['pwd'];

	if (strlen($pwd) != 0) {
		$pwd_encrypted = strtoupper(md5(strtoupper($pwd) . $config->LicenseKey));
		$UpdatePwd = dbe("UPDATE","UPDATE ".TBL_USERS." SET Passwd='$pwd_encrypted' WHERE UID='".USERID."'",array('DBQUERY','ajax.php','SaveProfile()'));
		$change = 1;
	}

	$UpdateUserDetail = dbe("UPDATE","UPDATE ".TBL_USERS_DETAIL." SET Firstname='$firstname', Lastname='', Email='$email', 
	TempatBertugas='$tempat_bertugas', GredID='$gred', KodJPN='$jpn', KodPPD='$ppd', KodPKG='$pkg', KodSekolah='$sekolah',
	NoKP='$nokp', MobilePhone='$mobileno', Akademik='$akademik', Pengkhususan='$pengkhususan', TarikhLantikan='$tarikh_lantikan_pertama',
	TarikhKhidmat='$tarikh_khidmat', OpsyenBersara='$opsyen', TarafJawatan='$taraf_jawatan', Alamat1='$alamat1', Alamat2='$alamat2',
	Poskod='$poskod', Bandar='$bandar', Negeri='$negeri', JarakRumah='$jarak' WHERE UID='".USERID."'",array('DBQUERY','ajax.php','SaveProfile()'));
	
	dom_setvalue('pwd','');
	dom_setvalue('rpwd','');
	SweetAlert('success',_SUCCESS.' !',_PROFILE_UPDATED,"window.location.href='".SITEURL."/profile';");
	if ($change == 1)
	{
		$LogSID = strtoupper(md5(uniqid(microtime()).$config->LicenseKey.IP_ADDRESS.$_SERVER['HTTP_USER_AGENT']));
		$Logout = dbe("UPDATE","UPDATE ".TBL_USERS." SET SID='$LogSID', Lastupdate=NOW(), LoginIP='".IP_ADDRESS."', StatusOnline='OFFLINE', SessionTime='0' WHERE UID='".USERID."'",array('DBQUERY','ajax.php','Need2Relogin()'));
		if ($Logout == true)
		{
			delete_cookie("w_user",$config->SiteDomain);
		}
	}
}
function DeleteAvatar() {
	global $config, $db, $w_user;
	$UpdateUser = dbe("UPDATE","UPDATE ".TBL_USERS_DETAIL." SET AvatarType='', AvatarPic='' WHERE UID='".USERID."'",array('DBQUERY','ajax.php','DeleteAvatar()'));
	redirect(SITEURL."/profile");
}
function DeletePaspot() {
	global $config, $db, $w_user;
	$UpdateUser = dbe("UPDATE","UPDATE ".TBL_USERS_DETAIL." SET PaspotType='', PaspotPic='' WHERE UID='".USERID."'",array('DBQUERY','ajax.php','DeletePaspot()'));
	redirect(SITEURL."/profile");
}
function DeleteNotifications() {
	global $db, $config, $w_user;

	$_MonYear = $_POST['data'];
	
	if (strlen($_MonYear) == 0) {
		die();
	}
	$_MonYearData = explode('-', $_MonYear);

	$iDel = dbe('DELETE',"DELETE FROM ".TBL_NOTIFICATIONS." WHERE UID='".USERID."' AND MONTH(NotifyDate)='".$_MonYearData[0]."' AND YEAR(NotifyDate)='".$_MonYearData[1]."'",array('DBQUERY','ajax.php','DeleteNotifications()'));
	if ($iDel)
	{
		SweetAlert('success',_SUCCESS.' !',_RECORD_SUCCESSFULLY_DELETED,"window.location.href='".SITEURL."/profile/?p=notifications';");
		eecho("$('#Notifications_".$_MonYear."').fadeOut();");
	}
}

# MESSAGES CENTER
function ReplyMsgCenter() {
	global $config, $db;

	$MsgID = $_POST['_mid'];
	$Msg = filter_txt($_POST['_msg']);

    if ($MsgID == '') {
    	SweetAlert_Error();
    	die();
    }

    if (strlen($Msg) == 0)
    {
        Notify('danger',_PLEASE_ENTER_YOUR_MESSAGE);
        dom_focus('_reply_txt_'.$MsgID);
        die;
    }

    $ReplyID = dbep('INSERT',"INSERT INTO ".TBL_MESSAGES_REPLY." (MsgID,UserID,ReplyDate,Msg) VALUES (?,?,NOW(),?)",
    array($MsgID,USERID,$Msg),array('DBQUERY','ajax.php','ReplyMsgCenter()->InsertReply'));

    if (empty($ReplyID))
    {
    	SweetAlert_Error();
    	die();
    }
    else
    {
    	$ReplyDate = getv('ReplyDate',TBL_MESSAGES_REPLY,'ID',$ReplyID);
    	$_BtnExtra = '<button type="button" class="btn btn-xs btn-danger" onclick="javascript:DeleteReply(\''.$ReplyID.'\');"><i class="fa fa-trash-o"></i></button>';

	    $t = new Template;
		$t->Load(WEB_TEMPLATES."messagescenter".DS."reply-msg.tpl");
		$t->Replace("MsgID",$ReplyID);
		$t->Replace("Msg",filter_decode($Msg,null,true,true));
		$t->Replace("PosterName",getUserDetail('fullname'));
		$t->Replace("ReplyDate",nicetime($ReplyDate));
		$t->Replace("REPLY",strtolower(_REPLY));
		$t->Replace("BtnExtra",$_BtnExtra);
		$_print .= $t->Evaluate();
    	dom_prepend('reply-div-'.$MsgID,return_ajax_html($_print));

    	# Clear
		eecho("$('#_reply_txt_$MsgID').autogrow('destroy');");
		dom_setvalue('_reply_txt_'.$MsgID,'');
		eecho("$('#_reply_txt_$MsgID').autogrow();");
		eecho("$('pre code').each(function(i, block) { hljs.highlightBlock(block); });");
    }
}
function DeleteReply() {
	global $config, $db, $w_user;

	$MsgID = $_POST['mid'];

	if (RecordCount("SELECT ID FROM ".TBL_MESSAGES_REPLY." WHERE ID='$MsgID'") == 0) {
		SweetAlert('error','Ops !',_RECORD_NOT_EXISTS);
		die();
	}

	$Poster = getv('UserID',TBL_MESSAGES_REPLY,'ID',$MsgID);
	if (is_admin($w_user) || is_sadmin($w_user) || $Poster == USERID)
	{
		$iDelete = dbe('DELETE',"DELETE FROM ".TBL_MESSAGES_REPLY." WHERE ID='$MsgID'");
		if (!$iDelete)
		{
			SweetAlert_Error();
			die();
		}
		else
		{
			SweetAlert('success',_SUCCESS.' !',_RECORD_SUCCESSFULLY_DELETED);
			dom_fadeout('rmsg_'.$MsgID);
		}
	}
	else
	{
		SweetAlert('error','Ops !',_ACCESS_DENIED);
	}
}

/**

	MESSAGE CONVERSATIONS

*/
function SendPM() {
	global $config, $db, $w_user;

	/**
		GET DATA
	*/
	$_ConversationID = filter_num($_POST['_cid']);
	$_Receivers = $_POST['_receivers'];
	$_Msg = filter_txt($_POST['_msg']);
	$_Refresh = $_POST['refresh'];
	
	/**
		VALIDATION
	*/
	if (empty($_ConversationID) && empty($_Receivers))
	{
		SweetAlert('error','Ops !',_PLEASE_SELECT_RECIPIENT);
		die();
	}
	if (empty($_Msg))
	{
		SweetAlert('error','Ops !',_PLEASE_ENTER_YOUR_MESSAGE);
		die();
	}

	/**
		CHECK CONVERSATION
	*/
	if (empty($_ConversationID))
	{
		$ReceiversData = implode(',', array(USERID,$_Receivers));
		$Receivers = explode(',', $ReceiversData);
		$_SQLExt = array();
		foreach ($Receivers as $Receiver) {
			$_SQLExt[] = "Receivers LIKE '%,$Receiver,%'";
		}
		$SQL_Extension = implode(' AND ', $_SQLExt);

		$r = $db->Execute("SELECT CID FROM ".TBL_CONVERSATION." WHERE ($SQL_Extension)");
		$RecordConversation = $r->RecordCount();
		if ($RecordConversation == 0)
		{
			$ConversationID = dbep('INSERT',"INSERT INTO ".TBL_CONVERSATION." (Author,Receivers,MID,LastSender,SendDate,Msg) VALUES (?,?,0,?,NOW(),?)",
			array(USERID,','.$ReceiversData.',',USERID,$_Msg),
			array('DBQUERY','ajax.php','SendPM()->Insert_Conversation_Record'));
		}
		else
		{

			$ConversationID = $r->fields['CID'];
		}
	}
	else
	{
		$ConversationID = $_ConversationID;
		$ReceiversData = trim(getv('Receivers',TBL_CONVERSATION,'CID',$ConversationID),',');
	}

	/**
		INSERT MESSAGE
	*/
	$New_MsgID = dbep('INSERT',"INSERT INTO ".TBL_CONVERSATION_MSG." (CID,Author,SendDate,Msg) VALUES (?,?,NOW(),?)",
	array($ConversationID,USERID,$_Msg),
	array('DBQUERY','ajax.php','SendPM()->Insert_Conversation_Msg'));
	
	$UpdateConversation = dbep('UPDATE',"UPDATE ".TBL_CONVERSATION." SET MID=?, LastSender=?, SendDate=NOW(), Msg=? WHERE CID=?",
	array($New_MsgID,USERID,$_Msg,$ConversationID),
	array('DBQUERY','ajax.php','SendPM()->Update_Conversation'));
	
	/**
		INSERT CONVERSATION FOLDER
	*/
	$ReceiversUID = explode(',',$ReceiversData);
	foreach ($ReceiversUID as $Receiver)
	{
		$RecordFolder = RecordCount("SELECT * FROM ".TBL_CONVERSATION_FOLDER." WHERE Receiver='$Receiver' AND CID='$ConversationID'");
		if ($RecordFolder > 0)
		{
			if ($Receiver == USERID)
			{
				dbe('UPDATE',"UPDATE ".TBL_CONVERSATION_FOLDER." SET ReadStatus='READ', InOutStatus='OUT' WHERE Receiver='$Receiver' AND CID='$ConversationID'",
				array('DBQUERY','ajax.php','SendPM()->Update_Conversation_Folder_1'));
			}
			else
			{
				dbe('UPDATE',"UPDATE ".TBL_CONVERSATION_FOLDER." SET ReadStatus='UNREAD', InOutStatus='IN' WHERE Receiver='$Receiver' AND CID='$ConversationID'",
				array('DBQUERY','ajax.php','SendPM()->Update_Conversation_Folder_2'));
			}
		}
		else
		{
			if ($Receiver == USERID)
			{
				dbe('_INSERT',"INSERT INTO ".TBL_CONVERSATION_FOLDER." (CID,Author,Receiver,ReadStatus,InOutStatus) VALUES ('$ConversationID','".USERID."','$Receiver','READ','OUT')",
				array('DBQUERY','ajax.php','SendPM()->Insert_Conversation_Folder_1'));
			}
			else
			{
				dbe('_INSERT',"INSERT INTO ".TBL_CONVERSATION_FOLDER." (CID,Author,Receiver,ReadStatus,InOutStatus) VALUES ('$ConversationID','".USERID."','$Receiver','UNREAD','IN')",
				array('DBQUERY','ajax.php','SendPM()->Insert_Conversation_Folder_2'));
			}
		}
	}

	/**

		NOTIFICATIONS

	*/
	settimeout("Notify('success','"._SUCCESSFUL_SEND_PM."');",1000);
	foreach ($ReceiversUID as $Receiver)
	{
		if (strlen($Receiver) != 0 && $Receiver != USERID)
		{
			notifications('WEB','PM','',$New_MsgID,'',$Receiver);
		}
	}

	if (empty($_ConversationID))
	{
		// New Compose
		eecho("ClearPM();");
		dom_hidemodal('PMDialog');
		if ($_Refresh == 1 || $_Refresh == '1')
		{
			eecho("LoadMsg();");
		}
	}
	else
	{
		// Replies
		$ReplyMsg = filter_decode($_Msg,null,true,true);
		$ReplyMsgDate = nicetime(getv('SendDate',TBL_CONVERSATION_MSG,'MID',$New_MsgID));

		$uos = getStatusOnline();
		$online_status = (strlen($uos) != 0) ? strtolower($uos).'-64':'';

		$t = new Template;
		$t->Load(WEB_TEMPLATES.'messages'.DS.'view-msg.tpl');
		$t->Replace('avatar',getUserAvatar());
		$t->Replace('fullname',getUserDetail('fullname'));
		$t->Replace('online_status',$online_status);
		$t->Replace('mid',$New_MsgID);
		$t->Replace('date',$ReplyMsgDate);
		$t->Replace("msg",$ReplyMsg);
		$PM = return_ajax_html($t->Evaluate());

		eecho("$('#msg').prepend('$PM');"); // prepend
		eecho("jQuery('html, body').animate({ scrollTop: jQuery($('#top')).offset().top }, 500);"); // scroll to top
		eecho("setTimeout(function(){ $('#msgid_$New_MsgID').addClass('animated splash'); },600);"); // animate row
		eecho("$('#reply_txt').autogrow('destroy');"); // destroy autogrow
		dom_setvalue('reply_txt',''); // clear text
		eecho("$('#reply_txt').autogrow();"); // initiate autogrow back
		eecho("$('pre code').each(function(i, block) { hljs.highlightBlock(block); });"); // highlight js for <code>
	}
}
function DeleteConversation() {
	global $db, $config, $w_user;

	$cids = $_POST['cid'];
	$ret = $_POST['ret'];

	if (!empty($cids))
	{
		$cid_exp = explode(",", $cids);
		foreach ($cid_exp as $cid)
		{
			$iCheck = RecordCount("SELECT * FROM ".TBL_CONVERSATION_FOLDER." WHERE CID='$cid' AND Receiver != '".USERID."'");
			if ($iCheck > 0)
			{
				$iDel = dbe('DELETE',"DELETE FROM ".TBL_CONVERSATION_FOLDER." WHERE CID='$cid' AND Receiver = '".USERID."'",array('DBQUERY','ajax.php','DeleteConversationFolder(1)'));
				if (!$iDel) { die(); }
			}
			else
			{
				$iDelF = dbe('DELETE',"DELETE FROM ".TBL_CONVERSATION_FOLDER." WHERE CID='$cid'",array('DBQUERY','ajax.php','DeleteConversationFolder(2)'));
				if (!$iDelF) { die(); }

				$iDelM = dbe('DELETE',"DELETE FROM ".TBL_CONVERSATION_MSG." WHERE CID='$cid'",array('DBQUERY','ajax.php','DeleteConversationMsg(3)'));
				if (!$iDelM) { die(); }

				$iDelC = dbe('DELETE',"DELETE FROM ".TBL_CONVERSATION." WHERE CID='$cid'",array('DBQUERY','ajax.php','DeleteConversation(4)'));
				if (!$iDelC) { die(); }
			}
		}

		if ($ret == 1 || $ret == "1")
		{
			redirect(SITEURL."/messages");
		}
		else
		{
			eecho("LoadMsg();");
		}
	}
}
function getUsersJSON() {
	global $db, $config, $w_user;

	$q = filter_txt($_REQUEST['q']);

	$r = $db->Execute("SELECT UID, Firstname, Lastname FROM ".TBL_USERS_DETAIL." WHERE UID != '".USERID."' AND (Firstname LIKE '%$q%' OR Lastname LIKE '%$q%')");
	if ($r->RecordCount() > 0)
	{
		$return = array();
		while (list($UID, $Firstname, $Lastname) = $r->FetchRow())
		{
			$Firstname = filter_decode($Firstname,'edit-input',false);
			$Lastname = filter_decode($Lastname,'edit-input',false);
			$return[] = array($UID, $Firstname." ".$Lastname);
		}

		echo json_encode($return);
	}
}



} else {
/**
##################################################
# ANONYMOUS ONLY
##################################################
*/
function Auth() {
	global $db, $config;
	
	$LoginID = strtolower($_POST['loginid']);
	$Password = $_POST['pwd'];
	$Remember = $_POST['remember_me'];
	$login_redirect = $_POST['redirect'];
	$num = $_POST['num'];
	$sec = $_POST['sec'];
	$GCaptcha = $_POST['g-recaptcha-response'];

	$datekey = date("F j");
	$rcode = hexdec(md5($_SERVER['HTTP_USER_AGENT'] . $config->LicenseKey . $num . $datekey));
	$codec = substr($rcode, 2, 6);

	/**
		VALIDATION ON SERVER-SIDE
	*/
	if (strlen($LoginID) == 0)
	{
		dom_focus("loginid");
		die();
	}
	if (strlen($Password) == 0)
	{
		dom_focus("pwd");
		die();
	}

	if ($config->SecurityCheck == true)
	{
		if (strlen($config->GoogleCaptchaKey) != 0)
		{
			if (strlen($GCaptcha) == 0)
			{
				SweetAlert('error','Ops !',_VERIFY_GOOGLE_CAPTCHA);
				die();
			}
			$recaptcha = new \ReCaptcha\ReCaptcha($config->GoogleCaptchaSecret);
			$resp = $recaptcha->verify($GCaptcha, IP_ADDRESS);
			if ($resp->isSuccess() == false)
			{
			    SweetAlert('error','Ops !',_VERIFY_GOOGLE_CAPTCHA);
			    die();
			}
		}
		else
		{
			if (extension_loaded('gd'))
			{
				if ($sec != $codec)
				{
					SweetAlert('error','Ops !', _ENTER_VALID_SECURITY_CODE);
					die();
				}
			}
			else
			{
				SweetAlert('error','Ops !', _ENABLE_GD_EXTENSION);
				die();
			}
		}
	}

	$pwd_encrypted = strtoupper(md5(strtoupper($Password) . $config->LicenseKey));

	/**
		QUERY USER DATA
	*/
	$rs = $db->Execute("SELECT * FROM ".TBL_USERS." WHERE LOWER(LoginID)='$LoginID' AND Passwd='$pwd_encrypted'");
	if (!$rs)
	{
		die();
	}

	if ($rs->RecordCount() == 1)
	{
		$AccountStatus = strtoupper($rs->fields['AccStatus']);

		if ($AccountStatus == "INACTIVE")
		{
			eecho("$('#return-login').html(\"<i class='fa fa-user push-10-r'></i><span class='h6 font-w300'>"._ACC_INACTIVE."</span>\").addClass(\"alert alert-danger\"); $('#return-login').fadeIn();");
			settimeout("$('#return-login').hide(); $('#return-login').removeClass('alert alert-danger');",5000);
			die();
		}
		else if ($AccountStatus == "ACTIVATION")
		{
			eecho("$('#return-login').html(\"<i class='fa fa-user push-10-r'></i><span class='h6 font-w300'>"._ACC_ACTIVATION."</span>\").addClass(\"alert alert-danger\"); $('#return-login').fadeIn();");
			settimeout("$('#return-login').hide(); $('#return-login').removeClass('alert alert-danger');",5000);
			die();
		}
		else if ($AccountStatus == "SUSPENDED")
		{
			eecho("$('#return-login').html(\"<i class='fa fa-user push-10-r'></i><span class='h6 font-w300'>"._ACC_SUSPENDED."</span>\").addClass(\"alert alert-danger\"); $('#return-login').fadeIn();");
			settimeout("$('#return-login').hide(); $('#return-login').removeClass('alert alert-danger');",5000);
			die();
		}
		else
		{
			$wonline = strtoupper(md5(uniqid(microtime()).$config->LicenseKey.IP_ADDRESS.$_SERVER['HTTP_USER_AGENT'].$pwd_encrypted));
			
			if ($Remember == 1 || $Remember == '1')
			{
				$usession = $config->SessionRemember;
				$usession_db = time() + $usession;
			}
			else
			{
				$usession = $config->UserSession;
				$usession_db = time() + $usession;
			}

			$uid = getUserID($LoginID);
			$rdb = $db->Execute("UPDATE ".TBL_USERS." SET SID='$wonline', LoginIP='".IP_ADDRESS."', StatusOnline='ONLINE', SessionTime='$usession_db' WHERE LoginID='$LoginID'");
			if (!$rdb)
			{
				l('DBQUERY','ajax.php',"Auth()->Login", $db->ErrorMsg());
				die();
			}

			$cookie_value = base64_encode("$uid|$wonline|$Remember");
			set_cookie("w_user",$cookie_value,$usession,$config->SiteDomain);

			if (strlen($login_redirect) != 0)
			{
				$url = $login_redirect;
			}
			else
			{
				$url = "";
			}

			settimeout("window.location.href = '".SITEURL."$url';",1000);
		}
	}
	else
	{
		eecho("$('#return-login').html(\"<i class='fa fa-user push-10-r'></i><span class='h6 font-w300'>"._INVALID_ACC."</span>\").addClass(\"alert alert-danger\"); $('#return-login').fadeIn();");
		settimeout("$('#return-login').hide();  $('#return-login').removeClass('alert alert-danger');",3000);
		dom_select("loginid");
	}				
}
function Register() {
	global $config, $db;

	# Get Data
	$loginid = strtolower($_POST['loginid']);
	$pwd = $_POST['pwd'];
	$firstname = filter_txt($_POST['firstname']);
	$lastname = filter_txt($_POST['lastname']);
	$email = $_POST['email'];
	$jobpos = filter_txt($_POST['jobpos']);
	$num = $_POST['num'];
	$sec = $_POST['sec'];
	$GCaptcha = $_POST['g-recaptcha-response'];

	$datekey = date("F j");
	$rcode = hexdec(md5($_SERVER['HTTP_USER_AGENT'] . $config->LicenseKey . $num . $datekey));
	$codec = substr($rcode, 2, 6);

	# Validation
	if (strlen($loginid) == 0)
	{
		dom_focus('_loginid');
		die();
	}
	if (strlen($pwd) < 5)
	{
		dom_focus('_pwd');
		die();
	}
	if (strlen($firstname) == 0)
	{
		dom_focus('_firstname');
		die();
	}
	if (strlen($lastname) == 0)
	{
		dom_focus('_lastname');
		die();
	}
	if (ValidEmail($email) == false)
	{
		dom_focus('_email');
		die();
	}

	if ($config->SecurityCheck == true)
	{
		if (strlen($config->GoogleCaptchaKey) != 0)
		{
			if (strlen($GCaptcha) == 0)
			{
				SweetAlert('error','Ops !',_VERIFY_GOOGLE_CAPTCHA);
				die();
			}
			$recaptcha = new \ReCaptcha\ReCaptcha($config->GoogleCaptchaSecret);
			$resp = $recaptcha->verify($GCaptcha, IP_ADDRESS);
			if ($resp->isSuccess() == false)
			{
			    SweetAlert('error','Ops !',_VERIFY_GOOGLE_CAPTCHA);
			    die();
			}
		}
		else
		{
			if (extension_loaded('gd'))
			{
				if ($sec != $codec)
				{
					SweetAlert('error','Ops !', _ENTER_VALID_SECURITY_CODE);
					die();
				}
			}
			else
			{
				SweetAlert('error','Ops !', _ENABLE_GD_EXTENSION);
				die();
			}
		}
	}


	$rec = RecordCount("SELECT * FROM ".TBL_USERS." WHERE LOWER(LoginID)='$loginid'");
	if ($rec > 0)
	{
		SweetAlert('error','Ops !', _USER_ALREADY_EXISTS);
		die();
	}
	else
	{
		$pwd_encrypted = strtoupper(md5(strtoupper($pwd) . $config->LicenseKey));
		$NewUID = dbep('INSERT',"INSERT INTO ".TBL_USERS." (LoginID,Passwd,Lastupdate,Locale,UserGroup) VALUES (?,?,NOW(),?,?)",
		array($loginid,$pwd_encrypted,LOCALE,getDefaultUserGroup()),
		array('DBQUERY','ajax.php','Register()->InsertUser'));

		if (!empty($NewUID))
		{
			dbep('_INSERT',"INSERT INTO ".TBL_USERS_DETAIL." (UID,DepartmentID,Firstname,Lastname,Email,JobPosition) VALUES (?,?,?,?,?,?)",
			array($NewUID,getDefaultDepartment(),$firstname,$lastname,$email,$jobpos),
			array('DBQUERY','ajax.php','Register()->InsertUserDetail'));
		}

		eecho('ClearRegister();');
		dom_hidemodal('RegisterDialog');
		SweetAlert('success',_SUCCESS.' !',_USER_REGISTRATION_SUCCESSFUL);
		dom_focus('loginid');
	}
}
/**
##################################################
# END USERS ONLINE
##################################################
*/
}

/**
##################################################
# ALL ACCESS
##################################################
*/

/**
	[ALL] GLOBAL
*/
function Rating() {
	global $db, $config;
	$type = strtoupper($_POST['type']);
	$id = filter_num($_POST['id']);
	$score = filter_num($_POST['score']);
	dbe("INSERT","INSERT INTO ".TBL_RATING." (DataType, DataID, Score) VALUES ('$type','$id','$score')",array('DBQUERY','GENERAL','InsertRating()'));
}
function Maar() {
	global $db, $config;
	$db->Execute("UPDATE ".TBL_NOTIFICATIONS." SET ReadStatus='READ' WHERE UID='".USERID."'");
	eecho("App.gData('notifications');");
}
function Pipeline() {
	global $config, $db, $w_user;
	$module = strtolower($_POST['m']);

	// Get Users Online
	eecho("App.gData('online');");

	// Notification Center
	eecho("App.gData('notifications');");
	
	/**

		SYNC

	*/
	settimeout('Pipeline();',($config->PipelineDelay*1000));
}
function Loader() {
	global $config, $db, $w_user;

	$type = strtoupper($_POST['type']);
	$page = filter_num($_POST['page']);
	$data_id = $_POST['id'];

    if (!is_numeric($page))
    {
        alert("ERROR_LOADER_REQUEST");
        die();
    }

	if ($type == 'MESSAGES')
	{
		/**
			MESSAGES - INBOX
		*/
		$TotalConversation = RecordCount("SELECT C.CID FROM ".TBL_CONVERSATION_FOLDER." F, ".TBL_CONVERSATION." C WHERE F.CID=C.CID AND F.Receiver='".USERID."'");
		if ($TotalConversation == 0)
		{
			if ($page == 0) {
				eecho("<div class=\"border-t padding-10 padding-20-t font-w300 text-center push-15 h6\">- "._NO_MESSAGES." -</div>");
			}
		}
		else
		{
			$perpage = $config->LoadPM;
		    $position = ($page * $perpage);

			$r = dbe('SELECT',"SELECT C.CID,C.Receivers,F.ReadStatus,C.Author,C.LastSender,C.SendDate,C.Msg 
			FROM ".TBL_CONVERSATION_FOLDER." F, ".TBL_CONVERSATION." C WHERE F.CID=C.CID AND F.Receiver='".USERID."' 
			ORDER BY C.SendDate DESC LIMIT $position, $perpage",array('DBQUERY','ajax.php','Loader(MESSAGES)->SelectInbox'));
			if ($r->RecordCount() > 0)
			{
				$pm = "<table class=\"js-table-checkable table table-hover remove-margin-b\"><tbody>";
				while (list($CID, $Receivers, $ReadStatus, $Author, $LastSender, $SendDate, $Msg) = $r->FetchRow())
				{
					$Receivers = explode(",", $Receivers);
					if (count($Receivers) > 2)
					{
						foreach ($Receivers as $Receiver)
						{
							if ($Receiver == USERID) { continue; }
							$Sender = $LastSender;
						}
					}
					else
					{
						foreach ($Receivers as $Receiver)
						{
							if ($Receiver == USERID) { continue; }
							$Sender = $Receiver;
						}
					}

					# Text
					$msg = filter_decode($Msg,'view-trim',false);
					$msg = filter_decode(substr($msg, 0, 100),'view-trim',true);

					# Read Status
					if (strtolower($ReadStatus) == "unread") {
						$read_status = "<i class=\"fa fa-circle text-info push-5-r\"></i>";
					} else {
						$read_status = "";
					}
						
					# Online Status
					$UserOnlineStatus = getStatusOnline($Sender);
					$online_status = (strlen($UserOnlineStatus) != 0) ? strtolower($UserOnlineStatus)."-64":"";

					$t = new Template;
					$t->Load(WEB_TEMPLATES."messages".DS."msg-list.tpl");
					$t->Replace("cid",$CID);
					$t->Replace("sender",$Sender);
					$t->Replace("date",nicetime($SendDate));
					$t->Replace("fullname",getUserDetail("Fullname",$Sender));
					$t->Replace("avatar",getUserAvatar($Sender));
					$t->Replace("online_status",$online_status);
					$t->Replace("msg",$msg);
					$t->Replace("read_status",$read_status);
					$pm .= $t->Evaluate();
			    }
			    $pm .= "</tbody></table>";
				echo $pm;
			}
		}
		eecho_script("$('#total-conversations').html('".num($TotalConversation)."'); $('#block-msg').removeClass('block-opt-refresh');");
	}
	else if ($type == 'READ-MESSAGE')
	{
		/**
			MESSAGES - READ MESSAGE
		*/
		$ConversationID = $data_id;

		$r = dbe('SELECT',"SELECT Receivers,MID FROM ".TBL_CONVERSATION." WHERE CID='$ConversationID' AND Receivers LIKE '%,".USERID.",%'",array('DBQUERY','ajax.php','Loader(READ-MESSAGE)->SelectConversationMsg'));
		if ($r->RecordCount() == 0)
		{
			echo "<div class=\"font-w300 text-center push-20\">- "._NO_MESSAGES." -</div>";
		}
		else
		{
			list($Receivers, $MsgID) = $r->FetchRow();

			# Loop Messages
			$perpage = $config->LoadPM;
		    $position = ($page * $perpage);
			$position_next = (($page+1) * $perpage);

			$NextRecord = RecordCount("SELECT * FROM ".TBL_CONVERSATION_MSG." WHERE CID='$ConversationID' ORDER BY SendDate DESC LIMIT $position_next, $perpage");
			$rm = dbe('SELECT',"SELECT MID,Author,SendDate,Msg FROM ".TBL_CONVERSATION_MSG." WHERE CID='$ConversationID' ORDER BY SendDate DESC LIMIT $position, $perpage",array('DBQUERY','ajax.php','Loader(READ-MESSAGE)->SelectConversationMsg'));
			if ($rm->RecordCount() > 0)
			{
				while (list($MsgID,$MsgAuthor,$MsgDate,$MsgTxt) = $rm->FetchRow())
				{
					$MsgTxt = filter_decode($MsgTxt,null,true,true);
					$uos = getStatusOnline($MsgAuthor);
					$online_status = (strlen($uos) != 0) ? strtolower($uos)."-64":"";

					$t = new Template;
					$t->Load(WEB_TEMPLATES."messages".DS."view-msg.tpl");
					$t->Replace("avatar",getUserAvatar($MsgAuthor));
					$t->Replace("online_status",$online_status);
					$t->Replace("mid",$MsgID);
					$t->Replace("fullname",getUserDetail("Fullname",$MsgAuthor));
					$t->Replace("date",nicetime($MsgDate));
					$t->Replace("msg",$MsgTxt);
					$Message .= $t->Evaluate();
			    }
			    echo $Message;
			}

			if ($NextRecord == 0) {
				eecho_script("$('#msg-loadmore').hide();");
			} else {
				$LoadMore_page = ($page+1);
				eecho_script("$('#msg-loadmore').removeClass('hide');");
				eecho_script("$('#msg-data-page').val('$LoadMore_page'); $('#msg-btn-loadmore').prop('disabled',false);");
			}
		}
	}
	else if ($type == 'ONLINE')
	{
		$ro = dbe('SELECT',"SELECT UID FROM ".TBL_USERS." WHERE StatusOnline='ONLINE' AND UID!='".USERID."' ORDER BY Lastvisit",array('DBQUERY','ajax.php','Loader(ONLINE)->SelectOnline'));
		if ($ro->RecordCount() > 0)
		{
			$_output_users = '<ul class="nav-users remove-margin-b">';
			while (list($_uid) = $ro->FetchRow())
			{
				$_fullname = getUserDetail('fullname',$_uid);
				$_lastvisit = nicetime(getUser('Lastvisit',$_uid));
				$_output_users .= '<li>
	                                <a href="#">
	                                    <img class="img-avatar" src="'.getUserAvatar($_uid).'" alt="'.$_fullname.'" title="'.$_fullname.'">
	                                    <i class="fa fa-circle text-success"></i> '.$_fullname.'
	                                    <div class="font-w400 text-muted"><small>'._ONLINE.' (<i>'.$_lastvisit.'</i>)</small></div>
	                                </a>
	                            </li>';
			}
			$_output_users .= '</ul>';
			$totalonline = num($ro->RecordCount());
			dom_update('total-online'," ($totalonline)");
		}
		else
		{
			$_output_users = '<p class="h6 text-center remove-margin">- '._NO_USER_ONLINE.' -</p>';
			dom_update('total-online',"");
		}
		dom_update('whos-online',trimall($_output_users));
	}
	else if ($type == 'NOTIFICATIONS')
	{
		/**
		NOTIFICATIONS
		*/

		# Live
		$live = $db->Execute("SELECT *,DATE_FORMAT(NotifyDate,'%d/%m/%Y %h:%i %p') NotifyDateFormat FROM ".TBL_NOTIFICATIONS." WHERE UID='".USERID."' AND NType='LIVE' AND ReadStatus='UNREAD' ORDER BY NotifyDate DESC");
		if ($live->RecordCount() > 0)
		{
			while ($rwlive = $live->FetchRow())
			{
				$l_NotifyID = $rwlive['ID'];
				$l_PerformerUID = $rwlive['PerformerUID'];
				$l_PerformerName = getUserDetail('fullname',$l_PerformerUID);
				$l_NotifyType = strtoupper($rwlive['NotifyType']);
				$l_EventType = strtoupper($rwlive['EventType']);
				$l_DataID = $rwlive['NotifyData'];
				$l_DataExt = $rwlive['NotifyDataExt'];
				$l_NotifyDate = nicetime($rwlive['NotifyDate']);
				$l_NotifyDateFormat = $rwlive['NotifyDateFormat'];

				$_l_NotifyDate = "<div class=\"push-5 h6\"><em><i class=\"fa fa-clock-o push-5-r\"></i> $l_NotifyDate</em></div>";

				if ($l_NotifyType == 'PM')
				{
					$_Type = 'info'; $_Time = 20000;
					$_Title = "<i class=\"fa fa-inbox push-10-r\"></i>"._PRIVATE_MESSAGE;
					$_Msg = sprintf(_NEW_PM_RECEIVED_FROM, "<b>$l_PerformerName</b>");
					$_Msg = "<a href=\"".SITEURL."/messages\">$_Msg</a>";
				}
				else if ($l_NotifyType == 'MESSAGES-CENTER')
				{
					$_Type = 'info'; $_Time = 20000;
					$_Title = "<i class=\"fa fa-envelope push-10-r\"></i>"._MESSAGES_CENTER;

					$MsgTitle = filter_decode(getv('Title',TBL_MESSAGES,'ID',$l_DataID),null,false,false);
					$_Msg = sprintf(_RECEIVED_NEW_MESSAGES_CENTER, "<b>$MsgTitle</b>");
					$_Msg = "<a href=\"".SITEURL."/messages-center/?mid=$l_DataID\">$_Msg</a>";
				}
				

				NotifyTitle($_Type,$_Title,$_Msg.$_l_NotifyDate,'',$_Time);				
				$db->Execute("DELETE FROM ".TBL_NOTIFICATIONS." WHERE ID='$l_NotifyID'");
			}
		}
		// End Live
		//=====================================

		# Total Unread
		$TotalUnread = RecordCount("SELECT * FROM ".TBL_NOTIFICATIONS." WHERE UID='".USERID."' AND NType != 'LIVE' AND ReadStatus='UNREAD'");
		if ($TotalUnread > 0)
		{
			dom_update('total-notifications',num($TotalUnread));
			dom_update('dashboard-total-notifications',num($TotalUnread));
			eecho("$('#btn-notifications').removeClass('btn-default').addClass('btn-danger');");
		}
		else
		{
			dom_update('total-notifications','');
			dom_update('dashboard-total-notifications','0');
			eecho("$('#btn-notifications').removeClass('btn-success').addClass('btn-default');");			
		}

		$rn = $db->Execute("SELECT *,DATE_FORMAT(NotifyDate,'%d/%m/%Y %h:%i %p') NotifyDateFormat FROM ".TBL_NOTIFICATIONS." WHERE UID='".USERID."' AND NType != 'LIVE' ORDER BY NotifyDate DESC LIMIT 0, 5");
		if ($rn->RecordCount() > 0)
		{
			$_output_notifications = '
				<div class="text-center push-5 border-b">
				<button id="btn-maar" type="button" class="btn btn-xs btn-primary push-10" onclick="javascript:MAAR();">
					<i class="fa fa-check-circle push-5-r"></i>'._MARK_ALL_AS_READ.'
				</button> 
				<button id="btn-view-notifications" type="button" class="btn btn-xs btn-primary push-10" onclick="javascript:window.location.href=\''.SITEURL.'/profile/?p=notifications\';">
					<i class="fa fa-bell push-5-r"></i>'._VIEW_ALL.'
				</button></div>';
			$_output_notifications .= '<ul class="list list-activity">';
			
			while ($rwn = $rn->FetchRow())
			{
				$NotifyID = $rwn['ID'];
				$PerformerUID = $rwn['PerformerUID'];
				$PerformerName = getUserDetail('fullname',$PerformerUID);
				$NotifyType = strtoupper($rwn['NotifyType']);
				$EventType = strtoupper($rwn['EventType']);
				$ReadStatus = strtoupper($rwn['ReadStatus']);
				$DataID = $rwn['NotifyData'];
				$DataExt = $rwn['NotifyDataExt'];
				$NotifyDate = nicetime($rwn['NotifyDate']);
				$NotifyDateFormat = $rwn['NotifyDateFormat'];

				$_TxtColor = ($ReadStatus == 'UNREAD') ? 'text-danger':'text-muted';

				if ($NotifyType == 'PM')
				{
					$_Icon = '<i class="fa fa-inbox '.$_TxtColor.' push-5-r"></i>';
					$Msg = sprintf(_NEW_PM_RECEIVED_FROM, "<b>$PerformerName</b>");
					$_NotifyTxt = "<a href=\"".SITEURL."/messages\">$Msg</a>";
				}
				else if ($NotifyType == 'MESSAGES-CENTER')
				{
					$_Icon = '<i class="fa fa-envelope '.$_TxtColor.' push-5-r"></i>';
					$MsgTitle = filter_decode(getv('Title',TBL_MESSAGES,'ID',$DataID),null,false,false);
					$Msg = sprintf(_RECEIVED_NEW_MESSAGES_CENTER, "<b>$MsgTitle</b>");
					$_NotifyTxt = "<a href=\"".SITEURL."/messages-center/?mid=$DataID\">$Msg</a>";
				}
				
				$_output_notifications .= '<li>'.$_Icon.'
					<div>'.$_NotifyTxt.'</div>
					<div><small class="text-muted">'.$NotifyDateFormat.' (<i>'.nicetime($NotifyDate).'</i>)</small></div>
				</li>';
			}		
			$_output_notifications .= '</ul>';
			dom_update('notifications',return_ajax_html($_output_notifications));
		}
		else
		{
			dom_update('notifications','<p class="text-center h6 remove-margin">- '._NO_NOTIFICATIONS.' -</p>');
		}
	}
	else if ($type == 'MESSAGES-CENTER')
	{
		# Update Messages Expired to INACTIVE/DELETED
		$rmall = dbe('SELECT',"SELECT ID,ActionExpired FROM ".TBL_MESSAGES." WHERE ExpiredOn != '' AND ExpiredOn <= ".now()."");
		if ($rmall->RecordCount() > 0)
		{
			while (list($_dbMID, $_dbActionExpired) = $rmall->FetchRow())
			{
				if (strtoupper($_dbActionExpired) == 'INACTIVE')
				{
					dbe('UPDATE',"UPDATE ".TBL_MESSAGES." SET MsgStatus=0, ExpiredOn='' WHERE ID='$_dbMID'",array('DBQUERY','ajax.php','Loader(MESSAGES-CENTER)->UpdateExpiredMsg'));
				}
				else
				{
					dbe('DELETE',"DELETE FROM ".TBL_MESSAGES." WHERE ID='$_dbMID'",array('DBQUERY','ajax.php','Loader(MESSAGES-CENTER)->DeleteExpiredMsg'));
				}
			}
		}

		// All done, continue

		$MessageData = explode('|', $data_id); // S|testing
		$MessageID = $MessageData[0];
		$q = $MessageData[1];

		if (strlen($MessageID) != 0 && strtoupper($MessageID) != 'S')
		{
			$SQL_Extension = "AND ID='$MessageID'";
			$single_msg = true;
		}
		else
		{
			if (strlen($q) != 0) {
				$SQL_Extension = "AND (Title LIKE '%$q%' OR Txt LIKE '%$q%' OR Tags LIKE '%$q%')";
			}
			$single_msg = false;
		}

		$perpage = $config->LoadPM;
	    $position = ($page * $perpage);
		$position_next = (($page+1) * $perpage);

		$UserDept = getUserDetail('DepartmentID');
		$NextRecord = RecordCount("SELECT * FROM ".TBL_MESSAGES." WHERE MsgStatus=1 AND MsgFor LIKE '%,$UserDept,%' $SQL_Extension ORDER BY PostDate DESC LIMIT $position_next, $perpage");
		$r = dbe('SELECT',"SELECT *,DATE_FORMAT(PostDate,'%d/%m/%Y %h:%i %p') PostDateFormat FROM ".TBL_MESSAGES." WHERE MsgStatus=1 AND MsgFor LIKE '%,$UserDept,%' $SQL_Extension ORDER BY PostDate DESC LIMIT $position, $perpage",array('DBQUERY','ajax.php','Loader(MESSAGES-CENTER)->SelectMsg'));
		if (!$r) {
			SweetAlert_Error_script();
			die();
		}

		if ($r->RecordCount() == 0)
		{
			eecho('<div class="block-content block-content-full bg-gray-lighter h6 text-center">- '._NO_MESSAGES_AVAILABLE.' -</div>');
		}
		else
		{
			if ($single_msg == true)
			{
				$msg .= '<button type="button" class="btn btn-primary push-5" onclick="javascript:window.location.href=\''.SITEURL.'/messages-center\';">
					<i class="fa fa-arrow-circle-left push-5-r"></i>'._BACK.'
				</button>';
			}

			while ($rw = $r->FetchRow())
			{
				$MsgID = $rw['ID'];
				$MsgTitle = $rw['Title'];
				$MsgTxt = $rw['Txt'];
				$Views = num($rw['Views']);
				$_MsgTxt = filter_decode($MsgTxt,null,true,true);
				$PostDateFormat = $rw['PostDateFormat'];
				$PostDate = nicetime($rw['PostDate']);
				$MsgType = strtolower($rw['MsgType']);
				eval("\$Msg_Type = _".strtoupper($MsgType).";");
				$Tags = $rw['Tags'];
				$AllowReply = $rw['AllowReply'];

				if ($MsgType == 'general') {
					$_MsgType = '<span class="label label-default"><i class="fa fa-bullhorn"></i> '.$Msg_Type.'</span>';
				} else if ($MsgType == 'info') {
					$_MsgType = '<span class="label label-info"><i class="fa fa-info-circle"></i> '.$Msg_Type.'</span>';
				} else if ($MsgType == 'warning') {
					$_MsgType = '<span class="label label-warning"><i class="fa fa-info-circle"></i> '.$Msg_Type.'</span>';
				} else if ($MsgType == 'critical') {
					$_MsgType = '<span class="label label-danger"><i class="fa fa-exclamation-triangle"></i> '.$Msg_Type.'</span>';
				}

				if ($single_msg == true)
				{
					# Views
					dbe('UPDATE',"UPDATE ".TBL_MESSAGES." SET Views=Views+1 WHERE ID='$MsgID'",array('DBQUERY','ajax.php','Loader(MESSAGES-CENTER)->UpdateViews'));
				}

				# Tags
				if (strlen($Tags) != 0)
				{
					$Tags = explode(',', $Tags);
					foreach ($Tags as $tag) {
						$q = urlencode($tag);
						$tags .= ' <a href="'.SITEURL.'/search/?q='.$q.'"><span class="label label-primary font-w300 label-rounded"><i class="fa fa-tag"></i> '.$tag.'</span></a> ';
					}
					$_Tags = '<div class="block-content block-content-full block-content-mini border-b">
						'.$tags.'
					</div>';
				}
				else
				{
					$_Tags = '';
				}

				# Reply
				if ($AllowReply == 1 || $AllowReply == '1')
				{
					$_Reply = '<div id="main-reply-div-'.$MsgID.'" class="block-content block-content-full block-content-mini border-b">';
					$_Reply .= '<div class="row">
							<div class="col-xs-12 push-5">
								<textarea class="form-control js-emojis js-autogrow h5 font-w300" id="_reply_txt_'.$MsgID.'" rows="2" placeholder="'._ENTER_YOUR_MESSAGE.'..."></textarea>
							</div>
							<div class="col-xs-12 text-right">
								<span id="p-reply-'.$MsgID.'" class="pull-left clearfix push-5-t h6 font-w300 hide"><i class="fa fa-cog fa-spin"></i> &nbsp;'._PLEASE_WAIT.'...</span>
								<button id="btn-reply-msg-'.$MsgID.'" type="button" class="btn btn-sm btn-primary" onclick="javascript:Reply(\''.$MsgID.'\');">
									<i class="fa fa-reply push-5-r"></i>'._REPLY.'
								</button>
							</div>
						</div>';

					# List top 5 reply
					if ($single_msg == false) {
						$SQL_Extension_Reply = "LIMIT 0, 5";
					} else {
						$SQL_Extension_Reply = "";
					}

					$_Reply .= '<div id="reply-div-'.$MsgID.'">';
					$rr = dbe('SELECT',"SELECT ID,UserID,ReplyDate,Msg FROM ".TBL_MESSAGES_REPLY." WHERE MsgID='$MsgID' ORDER BY ReplyDate DESC $SQL_Extension_Reply",array('DBQUERY','ajax.php','Loader(MESSAGES-CENTER)->LoadReplies'));
					if ($rr->RecordCount() > 0)
					{
						while (list($_ReplyID,$_ReplyPoster,$_ReplyDate,$_ReplyMsg) = $rr->FetchRow())
						{
							if (is_admin($w_user) || is_sadmin($w_user) || $_ReplyPoster == USERID)
							{
								$_BtnExtra = '<button type="button" class="btn btn-xs btn-danger" onclick="javascript:DeleteReply(\''.$_ReplyID.'\');"><i class="fa fa-trash-o"></i></button>';
							}
							else
							{
								$_BtnExtra = '';
							}

							$tr = new Template;
							$tr->Load(WEB_TEMPLATES."messagescenter".DS."reply-msg.tpl");
							$tr->Replace("MsgID",$_ReplyID);
							$tr->Replace("Msg",filter_decode($_ReplyMsg,null,true,true));
							$tr->Replace("PosterName",getUserDetail('fullname',$_ReplyPoster));
							$tr->Replace("ReplyDate",nicetime($_ReplyDate));
							$tr->Replace("REPLY",strtolower(_REPLY));
							$tr->Replace("BtnExtra",$_BtnExtra);
							$_Reply .= $tr->Evaluate();
						}
					}
					$_Reply .= '</div></div>';
				}
				else
				{
					$_Reply = '';
				}

				$t = new Template;
				$t->Load(WEB_TEMPLATES."messagescenter".DS."messages-list.tpl");
				$t->Replace("MID",$MsgID);
				$t->Replace("MsgTitle",$MsgTitle);
				$t->Replace("MsgTxt",$_MsgTxt);
				$t->Replace("PostDate",$PostDateFormat." (<i>$PostDate</i>)");
				$t->Replace("MsgType",$_MsgType);
				$t->Replace("Views",$Views);
				$t->Replace("TAGS",$_Tags);
				$t->Replace("REPLY",$_Reply);
				$msg .= $t->Evaluate();
			}
			echo $msg;

			if ($NextRecord == 0) {
				eecho_script("$('#load-msg-loadmore').hide();");
			} else {
				$LoadMore_page = ($page+1);
				eecho_script("$('#load-msg-loadmore').removeClass('hide');");
				eecho_script("$('#load-msg-data-page').val('$LoadMore_page'); $('#load-msg-btn-loadmore').prop('disabled',false);");
			}

			eecho_script("$('pre code').each(function(i, block) { hljs.highlightBlock(block); });");
		}

	}
}


#--------------------------------------------------
if (isset($_REQUEST['op'])) {
	$op = $_REQUEST['op'];
} else if (isset($_POST['op'])) {
	$op = $_POST['op'];
} else if (isset($_GET['op'])) {
	$op = $_GET['op'];
} else {
	$op = "";
}

switch($op)
{
	default:
		header("Location: ".SITEURL);
	break;

	#########################################
	# Anonymous Only
	#########################################
	case "auth":
		Auth();
	break;
	case "register":
		Register();
	break;

	#########################################
	# Global Functions
	#########################################
	case "loader":
		Loader();
	break;
	case "pipeline":
		Pipeline();
	break;

	case "rating":
		Rating();
	break;
	case "maar":
		Maar();
	break;
	
	#########################################
	# Administrators Functions
	#########################################
	// System
	case "save_system_config":
		SaveSystemConfig();
	break;
	case "update_config":
		UpdateConfig();
	break;

	// Menu
	case "save_menu":
		SaveMenu();
	break;
	case "edit_menu":
		EditMenu();
	break;
	case "delete_menu":
		DeleteMenu();
	break;
	case "menu_order":
		MenuOrder();
	break;

	// Languages
	case "add_langpack":
		AddLangPack();
	break;
	case "add_langdefine":
		AddLangPhrase();
	break;
	case "edit_phrase":
		EditPhrase();
	break;
	case "delete_lang":
		DeleteLang();
	break;
	case "delete_phrase":
		DeletePhrase();
	break;

	// User Roles
	case "save_userrole":
		SaveUserrole();
	break;
	case "edit_userrole":
		EditUserrole();
	break;
	case "delete_userrole":
		DeleteUserrole();
	break;
	case "default_userrole":
		DefaultUserrole();
	break;

	// Users
	case "save_user":
		SaveUser();
	break;
	case "edit_user":
		EditUser();
	break;
	case "delete_user":
		DeleteUser();
	break;

	// Usergroups
	case "save_group":
		SaveGroup();
	break;
	case "edit_group":
		EditGroup();
	break;
	case "delete_group":
		DeleteGroup();
	break;
	case "default_group":
		DefaultGroup();
	break;

	// Messages
	case "save_msg":
		SaveMsg();
	break;
	case "edit_msg":
		EditMsg();
	break;
	case "delete_msg":
		DeleteMsg();
	break;

	#########################################
	# Users Functions
	#########################################
	
	# General
	case "welcome":
		Welcome();
	break;
	case "logout":
		Logout();
	break;	
	case "change_pwd":
		NeedChangePwd();
	break;
	case "lock_screen":
		LockScreen();
	break;
	case "unlock_screen":
		UnlockScreen();
	break;

	# Profiles
	case "save_pict":
		SavePerjawatanICT();
	break;
	case "delete_pict":
		DeletePerjawatanICT();
	break;
	case "change-ppd":
		ChangePPD();
	break;
	case "change-pkgsek":
		ChangePKGSEK();
	break;
	case "save_profile":
		SaveProfile();
	break;
	case "delete_avatar":
		DeleteAvatar();
	break;
	case "delete_paspot":
		DeletePaspot();
	break;
	case "delete_notifications":
		DeleteNotifications();
	break;

	# Messages Center
	case "msgcenter_reply":
		ReplyMsgCenter();
	break;
	case "delete_reply":
		DeleteReply();
	break;

	/**

		MESSAGE CONVERSATIONS

	*/
	case "send_pm":
	case "pm_reply":
		SendPM();
	break;
	case "delete_conversation":
		DeleteConversation();
	break;
	case "get_users_json":
		getUsersJSON();
	break;
}
?>