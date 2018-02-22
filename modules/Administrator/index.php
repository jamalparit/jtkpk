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

if (!defined('MODULE')) { die("No Access"); }
require_once(WEB_ROOT.DS."global.php");

function SystemConfig() {
	global $config, $db, $jquery, $pagetitle, $w_user;
	$module_name = strtolower(MODULE);

	if (moduleGetAccess('system_config')==false)
	{
		AuthorizedOnly();
	}
	else
	{
		
		# Check Configuration Records
		$RecordConfig = RecordCount("SELECT * FROM ".TBL_CONFIG."");
		if ($RecordConfig == 0)
		{
			die("No configuration in the database ! Please check.");
		}

		# Get Configurations
		$r = dbe('SELECT',"SELECT * FROM ".TBL_CONFIG,array('DBQUERY',$module_name,'SystemConfig()'));
		while ($rw = $r->FetchRow())
		{
			$ID = $rw['ID'];
			$LicenseKey = $rw['LicenseKey'];
			$WebClosed = $rw['WebClosed'];
			$ClosedReason = $rw['ClosedReason'];
			$WelcomeMessage = $rw['WelcomeMessage'];
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
			$SMS_MTURL = $rw['SMS_MTURL'];
			$SMSUser = $rw['SMSUser'];
			$SMSPwd = $rw['SMSPwd'];
			$WebPipeline = $rw['WebPipeline'];
			$LoadPM = $rw['LoadPM'];
		}

		# Languages
		$r = $db->Execute("SELECT CodeLang, Description, DefaultLang FROM ".TBL_LANG." ORDER BY ID ASC");
		if ($r->RecordCount() > 0)
		{
			while (list($CodeLang, $Description, $DefaultLang) = $r->FetchRow()) {
				$sel = $DefaultLang ? "selected" : "";
				$languages .= "<option value=\"$CodeLang\" $sel>$Description</option>\n";
			}
		}

		# Themes
		foreach (glob(WEB_THEMES_LOC.'*', GLOB_ONLYDIR) as $dir)
		{
			$dir = basename($dir);
			$sel_theme = $DefaultTheme ? "selected" : "";
			$themes .= "<option value=\"$dir\" $sel_theme>$dir</option>\n";
		}

		//-------------------------------------------------
		$pagetitle = SITENAME." - "._SYSTEM_CONFIG;
		define('LIB.FORMS', true);
		$jquery = "
		App.blocks('#_system_config','content_toggle');
		App.blocks('#_site_config','content_toggle');
		App.blocks('#_db_config','content_toggle');
		App.blocks('#_security_config','content_toggle');
		App.blocks('#_mail_config','content_toggle');
		App.blocks('#_language_config','content_toggle');
		App.blocks('#_welcome_config','content_toggle');
		App.blocks('#_google_config','content_toggle');
		App.blocks('#_fb_config','content_toggle');
		App.blocks('#_twitter_config','content_toggle');
		App.blocks('#_sms_config','content_toggle');

		$('#_close_system').prop(\"checked\",".$WebClosed.");
		$('#_close_system').click(function(e){
			UpdateConfig('WebClosed','');
		});
		
		$('#_display_error').prop(\"checked\",".$DisplayError.");
		$('#_display_error').click(function(e){
			UpdateConfig('DisplayError','');
		});

		$('#_allow_register').prop(\"checked\",".$AllowRegister.");
		$('#_allow_register').click(function(e){
			UpdateConfig('AllowRegister','');
		});

		$('#_dbdebug').prop(\"checked\",".$DBDebug.");
		$('#_dbdebug').click(function(e){
			UpdateConfig('DBDebug','');
		});

		$('#_security_check').prop(\"checked\",".$SecurityCheck.");
		$('#_security_check').click(function(e){
			UpdateConfig('SecurityCheck','');
		});
		
		$('#_gmaps').prop(\"checked\",".$GoogleMaps.");
		$('#_gmaps').click(function(e){
			UpdateConfig('GoogleMaps','');
		});

		$('#_fbintegration').prop(\"checked\",".$FacebookIntegration.");
		$('#_fbintegration').click(function(e){
			UpdateConfig('FacebookIntegration','');
		});

		$('#_fbbeta').prop(\"checked\",".$FacebookBeta.");
		$('#_fbbeta').click(function(e){
			UpdateConfig('FacebookBeta','');
		});

		$('#_fbjs').prop(\"checked\",".$FacebookJS.");
		$('#_fbjs').click(function(e){
			UpdateConfig('FacebookJS','');
		});

		$('#_twintegration').prop(\"checked\",".$TwitterIntegration.");
		$('#_twintegration').click(function(e){
			UpdateConfig('TwitterIntegration','');
		});";

		include(WEB_INCLUDES."header.php");		
		$t = new Template;
		$t->Load(WEB_MODULE_TEMPLATE."system-config.tpl");
		
		# System Configuration
		$t->Replace("CLOSED_REASON",filter_decode($ClosedReason,null,false,false));
		$t->Replace("THEMES",$themes);
		$t->Replace("LOGIN_TYPE",$LoginType);
		$t->Replace("LOGIN_SESSION",$LoginUserSession);
		$t->Replace("LOGIN_SESSION_REMEMBER",$LoginSessionRemember);
		$t->Replace("WEB_PIPELINE",$WebPipeline);
		$t->Replace("LOAD_PM",$LoadPM);
		
		# Site Configuration
		$t->Replace("SITE_NAME",$SiteName);
		$t->Replace("SITE_URL",$SiteUrl);
		$t->Replace("SITE_DOMAIN",$SiteDomain);
		$t->Replace("SITE_SLOGAN",$SiteSlogan);
		$t->Replace("SITE_DESCRIPTION",$SiteDescription);
		$t->Replace("SITE_KEYWORDS",$SiteKeywords);
		
		# Database Configuration
		$sel_mysql = (strtolower($DBType) == 'mysql') ? "selected":"";
		$sel_mssql = (strtolower($DBType) == 'mssql') ? "selected":"";
		$t->Replace("sel_mysql",$sel_mysql);
		$t->Replace("sel_mssql",$sel_mssql);
		$t->Replace("DBNAME",$DBName);
		$t->Replace("DBHOST",$DBHost);
		$t->Replace("DBUSER",$DBUser);
		$t->Replace("DBPWD",$DBPwd);

		# Security Configuration
		$t->Replace("GCAPTCHA_KEY",$GoogleCaptchaKey);
		$t->Replace("GCAPTCHA_SECRET",$GoogleCaptchaSecret);

		# Mail Configuration
		$t->Replace("ADMIN_MAIL",$AdminMail);
		$t->Replace("MAIL_HOST",$MailHost);
		$t->Replace("MAIL_USER",$MailUser);
		$t->Replace("MAIL_PWD",$MailPwd);
		$t->Replace("MAIL_PORT",$MailPort);
		$t->Replace("MAIL_SECURE",$MailSecure);
		$t->Replace("MAIL_DEBUG",$MailDebug);

		# Languages Configuration
		$t->Replace("LANGUAGES",$languages);

		# Welcome Configuration
		$t->Replace("WELCOME_MSG",filter_decode($WelcomeMessage,null,false,false));
		
		# Google Integration
		$t->Replace("GCLIENT_ID",$GoogleClientID);
		$t->Replace("GAPIKEY",$GoogleAPIKey);
		$t->Replace("GANALYTIC",$GoogleAnalytic);
		$t->Replace("GDEF_LAT",$MapDefaultLat);
		$t->Replace("GDEF_LON",$MapDefaultLon);
		$t->Replace("GDEF_ZOM",$MapDefaultZoom);
		
		# Facebook Integration
		$t->Replace("FB_GRAPH",$FacebookGraph);
		$t->Replace("FB_APPID",$FacebookAppID);
		$t->Replace("FB_APPSECRET",$FacebookAppSecret);
		
		# Twitter Integration
		$t->Replace("TW_ACCESS_TOKEN",$TwitterAccessToken);
		$t->Replace("TW_TOKEN_SECRET",$TwitterTokenSecret);
		$t->Replace("TW_CONSUMER_KEY",$TwitterConsumerKey);
		$t->Replace("TW_CONSUMER_SECRET",$TwitterConsumerSecret);

		# SMS Integration
		$t->Replace("SMS_MTURL",$SMS_MTURL);
		$t->Replace("SMS_USER",$SMSUser);
		$t->Replace("SMS_PWD",$SMSPwd);
		
		$t->Publish();
		include(WEB_INCLUDES."footer.php");
	}
}
function Menu() {
	global $config, $db, $jquery, $pagetitle, $w_user, $app;
	$module_name = strtolower(MODULE);

	if (moduleGetAccess('menu')==false)
	{
		AuthorizedOnly();
	}
	else
	{
		$rmenu = dbe('select',"SELECT ID,ParentID,Menu,Icon,URL,role_id,MN FROM ".TBL_MENU." WHERE ParentID=0 ORDER BY MenuSort ASC",array('DBQUERY','modules/administrator/index.php','SystemMenu'));
		while (list($MenuID,$MenuParentID,$MenuName,$MenuIcon,$MenuURL,$MenuRole,$MN) = $rmenu->FetchRow())
		{
			# SUB MENU
			$rsm = dbe('select',"SELECT ID,ParentID,Menu,Icon,URL,role_id,MN FROM ".TBL_MENU." WHERE ParentID=".$MenuID." ORDER BY MenuSort ASC",array('DBQUERY','modules/administrator/index.php','SystemMenu-SubMenu'));
			if ($rsm->RecordCount() > 0)
			{
			    $system_sub_menu = '';
			    while (list($smMenuID,$smMenuParentID,$smMenuName,$smMenuIcon,$smMenuURL,$smMenuRole,$smMN) = $rsm->FetchRow())
	            {
	            	$smMenuName = (strtolower($smMN) == 'original') ? $smMenuName:"{".$smMenuName."}";
	            	$system_sub_menu .= '<div id="menu-'.$smMenuID.'" class="block draggable-item push-5">
			            <div class="block-header bg-gray-light">
			                <ul class="block-options">
			                    <li>
			                        <i class="fa fa-trash-o text-danger"></i>
			                    </li>
			                    <li>
			                        <span class="draggable-handler text-gray"><i class="si si-cursor-move"></i></span>
			                    </li>
			                </ul>
			                <h3 class="block-title">
			                	<a href="#" onclick="javascript:EditMenu(\''.$smMenuID.'\');return false;">'.$smMenuName.'</a>
			                </h3>
			            </div>
			        </div>';
	            }

	            $MenuName = (strtolower($MN) == 'original') ? $MenuName:"{".$MenuName."}";
	            $system_menu .= '<div id="menu-'.$MenuID.'" class="block draggable-item push-5">
		            <div class="block-header">
		                <ul class="block-options">
		                    <li>
		                        <a href="#" onclick="javascript:DeleteMenu(\''.$MenuID.'\');return false;">
		                        	<i class="fa fa-trash-o text-danger"></i>
		                        </a>
		                    </li>
			                <li>
		                        <span class="text-gray"><i class="si si-arrow-down"></i></span>
		                    </li>
		                    <li>
		                        <span class="draggable-handler text-gray"><i class="si si-cursor-move"></i></span>
		                    </li>
		                </ul>
		                <h3 class="block-title">
		                	<a href="#" onclick="javascript:EditMenu(\''.$MenuID.'\');return false;">'.$MenuName.'</a>
		                </h3>
		            </div>
		        </div>'.$system_sub_menu;
	        }
	        else
	        {
	        	$MenuName = (strtolower($MN) == 'original') ? $MenuName:"{".$MenuName."}";
	        	$system_menu .= '<div id="menu-'.$MenuID.'" class="block draggable-item push-5">
		            <div class="block-header">
		                <ul class="block-options">
		                    <li>
		                        <a href="#" onclick="javascript:DeleteMenu(\''.$MenuID.'\');return false;">
		                        	<i class="fa fa-trash-o text-danger"></i>
		                        </a>
		                    </li>
			                <li>
		                        <span class="draggable-handler text-gray"><i class="si si-cursor-move"></i></span>
		                    </li>
		                </ul>
		                <h3 class="block-title">
		                	<a href="#" onclick="javascript:EditMenu(\''.$MenuID.'\');return false;">'.$MenuName.'</a>
		                </h3>
		            </div>
		        </div>';
			}

	        $parent_menu .= '<option value="'.$MenuID.'">'.$MenuName.'</option>';        
	    }

	    # Roles
		$rur = $db->Execute("SELECT ID,role,role_name,isDefault FROM ".TBL_ROLES." ORDER BY ID ASC");
		if (!$rur) {
			l('DBQUERY','modules/admin/index.php','Users()->SelectUserRoles',$db->ErrorMsg());
			die($db->ErrorMsg());
		}
		while (list($rid,$role,$rolename,$isDefault) = $rur->FetchRow())
		{
			$_roles .= "<option value=\"$rid\">$rolename</option>";
		}

		//-------------------------------------------------
		
		$pagetitle = SITENAME." - "._MENU;
		define('LIB.FORMS', true);
		$app = "'draggable-items'";

		include(WEB_INCLUDES."header.php");
		$t = new Template;
		$t->Load(WEB_MODULE_TEMPLATE."system-menu.tpl");
		$t->Replace('SYSTEM_MENU', $system_menu);
		$t->Replace('PARENT_MENU', $parent_menu);
		$t->Replace('ROLES', $_roles);
		$t->Publish();
		include(WEB_INCLUDES."footer.php");
	}
}
function Languages() {
	global $config, $db, $pagetitle, $jquery, $w_user;

	if (moduleGetAccess('languages')==false)
	{
		AuthorizedOnly();
	}
	else
	{
		$lg = $_REQUEST['lg'];

		# Language Pack
		$rl = $db->Execute("SELECT ID, CodeLang, Description, DefaultLang FROM ".TBL_LANG);
		if (!$rl) { die($db->ErrorMsg()); }
		while (list($LangID, $LangCode, $LangDesc, $DefaultLang) = $rl->FetchRow())
		{
			$DefaultLan = ($DefaultLang == "1") ? "(Default)":"";
			if (isset($lg) && $lg != "") {
				$sel = ($lg == $LangCode) ? "selected":"";
			}
			$lp .= "<option value=\"".SITEURL."/administrator/?p=languages&lg=$LangCode\" $sel>$LangDesc $DefaultLan</option>\n";
		}
		
		# Language Define
		if (isset($lg) && $lg != "") {
			$sqlex = " WHERE CodeLang='$lg' ";
			$btn_del = "<button type=\"button\" id=\"btn_dl\" class=\"btn btn-danger\" onclick=\"javascript:DeleteLang('$lg');\"><i class=\"fa fa-trash-o push-5-r\"></i>"._DELETE_LANGUAGE."</button>";
		} else {
			$sqlex = "";
			$btn_del = "";
		}
		$r = $db->Execute("SELECT ID, CodeLang, Define, DefineValue FROM ".TBL_LANG_DEFINE." $sqlex ORDER BY ID ASC");
		if (!$r) { die($db->ErrorMsg()); }	
		while (list($ID, $CodeLang, $Define, $DefineValue) = $r->FetchRow())
		{
			$ret .= "<tr>
			<td width=\"120\" align=\"center\">".getv("Description",TBL_LANG,"CodeLang",$CodeLang)."</td>
			<td><a href=\"#\" onClick=\"javascript:EditPhrase('$ID','$Define');return false;\">$Define</a></td>
			<td>$DefineValue</td>
			<td align=\"center\">
				<button type=\"button\" class=\"btn btn-sm btn-danger\" onClick=\"javascript:DeletePhrase('$ID');\">
					<i class=\"fa fa-trash-o\"></i>
				</button>
			</td>
			</tr>";
		}

		//-------------------------------------------------
		$pagetitle = SITENAME." - "._LANGUAGES;
		$jquery = "$('#Languages').DataTable({ responsive: true });";	
		define('LIB.DATATABLES', true);
		define('LIB.FORMS', true);

		include(WEB_INCLUDES."header.php");
		$t = new Template;
		$t->Load(WEB_MODULE_TEMPLATE."languages.tpl");
		$t->Replace("languages",$ret);
		$t->Replace("language_pack",$lp);
		$t->Replace("btn_del",$btn_del);
		$t->Publish();		
		include(WEB_INCLUDES."footer.php");
	}
}
function Users() {
	global $config, $db, $pagetitle, $jquery, $w_user;

	if (moduleGetAccess('users')==false)
	{
		AuthorizedOnly();
	}
	else
	{
		# Users
		$r = $db->Execute("SELECT UID,LoginID,StatusOnline,AccStatus,Lastvisit,DATE_FORMAT(Lastvisit,'%d/%m/%Y %h:%i %p') AS _Lastvisit FROM ".TBL_USERS);
		if (!$r) {
			l('DBQUERY','modules/administrator/index.php','Users()->SelectUsers',$db->ErrorMsg());
			die($db->ErrorMsg());
		}	
		while (list($UID,$LoginID,$StatusOnline,$AccStatus,$Lastvisit,$_Lastvisit) = $r->FetchRow())
		{
			$UserName = getUserDetail("Fullname", $UID);
			$User_Groups = explode(',',getUserGroups($UID,'array','group_name'));
			$UserRoles = explode(',',getUserRoles($UID,'array','role_name'));
			$_UserRoles = '';
			$_User_Groups = '';
			foreach ($UserRoles as $ur) {
				$_UserRoles .= '<span class="badge badge-primary">'.$ur.'</span> ';
			}
			foreach ($User_Groups as $ug) {
				$_User_Groups .= '<span class="badge badge-primary">'.$ug.'</span> ';
			}
			$Lastvisit = nicetime($Lastvisit);
			if ($AccStatus == "ACTIVE") {
				$Acc_Status = "<i class=\"fa fa-check-circle text-success push-5-r\"></i>"._ACTIVE;
			} else if ($AccStatus == "INACTIVE") {
				$Acc_Status = "<i class=\"fa fa-times text-danger push-5-r\"></i>"._INACTIVE;
			} else if ($AccStatus == "SUSPENDED") {
				$Acc_Status = "<i class=\"fa fa-lock text-info push-5-r\"></i>"._SUSPENDED;
			}

			if ($StatusOnline == "ONLINE") {
				$StatusOnline = "<span class=\"text-success\"><i class=\"fa fa-circle text-success push-5-r\"></i>".ucwords(strtolower($StatusOnline))."</span>";
			} else if ($StatusOnline == "OFFLINE") {
				$StatusOnline = "<span class=\"text-danger\"><i class=\"fa fa-circle text-danger push-5-r\"></i>".ucwords(strtolower($StatusOnline))."</span>";
			}

			if ($Lastvisit != "-") {
				$lastvisit = "$_Lastvisit<br>($Lastvisit)";
			} else {
				$lastvisit = "-";
			}

			$users .= "<tr>
			<td>
				<a href=\"#\" class=\"font-w300 h4 text-primary\" onclick=\"javascript:EditUser('$UID');return false;\">
					$UserName
				</a><br>
				<i class=\"fa fa-user\"></i>&nbsp; $LoginID<br>
				$StatusOnline
			</td>
			<td align=\"left\">$_UserRoles</td>
			<td align=\"left\">$_User_Groups</td>
			<td align=\"left\">$lastvisit</td>
			<td align=\"center\">$Acc_Status</td>
			<td align=\"center\">
				<button type=\"button\" class=\"btn btn-sm btn-danger\" onClick=\"javascript:DeleteUser('$UID');\">
					<i class=\"fa fa-trash-o\"></i>
				</button>
			</td>
			</tr>";
		}

		//-------------- ADMIN ONLY
		# Roles
		$rur = $db->Execute("SELECT ID,role,role_name,isDefault FROM ".TBL_ROLES." ORDER BY ID ASC");
		if (!$rur) {
			l('DBQUERY','modules/administrator/index.php','Users()->SelectUserRoles',$db->ErrorMsg());
			die($db->ErrorMsg());
		}
		while (list($rid,$role,$rolename,$isDefault) = $rur->FetchRow())
		{
			$default = ($isDefault == 1) ? " (<i class=\"text-danger\">Default</i>)":"";
			$_roles .= "<option value=\"$rid\">$rolename</option>";
			$roles .= "<tr>
				<td>
					<a href=\"#\" onclick=\"javascript:EditUR('$rid');return false;\">
						$role $default
					</a>
				</td>
				<td>
					<a href=\"#\" onclick=\"javascript:EditUR('$rid');return false;\">
						$rolename
					</a>
				</td>
				<td align=\"center\" width=\"100\">
					<button type=\"button\" class=\"btn btn-sm btn-primary\" onClick=\"javascript:DefaultUR('$rid');\" data-toggle=\"tooltip\" title=\"Set Default\">
						<i class=\"fa fa-bookmark\"></i>
					</button>
					<button type=\"button\" class=\"btn btn-sm btn-danger\" onClick=\"javascript:DeleteUR('$rid');\">
						<i class=\"fa fa-trash-o\"></i>
					</button>
				</td>
			</tr>";
		}

		# Usergroups
		$r = $db->Execute("SELECT ID,group_code,group_name,isDefault FROM ".TBL_USERGROUPS." ORDER BY group_name ASC");
		if (!$r) {
			l('DBQUERY','modules/administrator/index.php','Users()->SelectUsergroups',$db->ErrorMsg());
			die($db->ErrorMsg());
		}
		while (list($gid,$group_code,$group_name,$gdefault) = $r->FetchRow())
		{
			$default_group = ($gdefault == 1) ? " (<i class=\"text-danger\">Default</i>)":"";
			$_usergroups .= "<option value=\"$gid\">$group_name</option>";
			$usergroups .= "<tr>
				<td>
					<a href=\"#\" onclick=\"javascript:EditUG('$gid');return false;\">
						$group_code $default_group
					</a>
				</td>
				<td>
					<a href=\"#\" onclick=\"javascript:EditUG('$gid');return false;\">
						$group_name
					</a>
				</td>
				<td align=\"center\" width=\"100\">
					<button type=\"button\" class=\"btn btn-sm btn-primary\" onClick=\"javascript:DefaultUG('$gid');\" data-toggle=\"tooltip\" title=\"Set Default\">
						<i class=\"fa fa-bookmark\"></i>
					</button>
					<button type=\"button\" class=\"btn btn-sm btn-danger\" onClick=\"javascript:DeleteUG('$gid');\">
						<i class=\"fa fa-trash-o\"></i>
					</button>
				</td>
			</tr>";
		}

		//-------------------------------------------------
		$pagetitle = SITENAME." - "._USERS_AND_ROLES;
		define('LIB.DATATABLES', true);
		define('LIB.FORMS', true);
		$jquery = "$('#Users').DataTable({ responsive: true });
		$('#Userroles').DataTable({ responsive: true });
		$('#Usergroups').DataTable({ responsive: true });
		App.blocks('#_userroles','content_toggle');
		App.blocks('#_usergroups','content_toggle');
		";

		include(WEB_INCLUDES."header.php");
		$t = new Template;
		$t->Load(WEB_MODULE_TEMPLATE."users.tpl");
		$t->Replace("USERS",$users);
		$t->Replace("USERROLES",$roles);
		$t->Replace("USERGROUPS",$usergroups);
		$t->Replace("UROLES",$_roles);		
		$t->Replace("UGROUPS",$_usergroups);
		$t->Publish();		
		include(WEB_INCLUDES."footer.php");
	}
}
function MessagesCenter() {
	global $config, $db, $pagetitle, $jquery, $w_user;
	
	if (moduleGetAccess('messages_center')==false)
	{
		AuthorizedOnly();
	}
	else
	{
		$r = 	$db->Execute("SELECT *, DATE_FORMAT(PostDate,'%d/%m/%Y %h:%i %p') AS Post_Date,
				FROM_UNIXTIME(ExpiredOn) AS Expired_On, 
				DATE_FORMAT(FROM_UNIXTIME(ExpiredOn),'%d/%m/%Y %h:%i %p') AS Expired_On_Nice
				FROM ".TBL_MESSAGES." ORDER BY PostDate DESC");
		if (!$r) { die($db->ErrorMsg()); }

		$i = 0;
		while ($rw = $r->FetchRow())
		{
			$i++;
			$MsgID = $rw['ID'];
			
			# Messages
			$Title = filter_decode($rw['Title'],null,false);
			$PostDate = $rw['Post_Date'].' (<i>'.nicetime($rw['PostDate']).'</i>)';
			$ExpiredOn = $rw['ExpiredOn'];
			if (strlen($ExpiredOn) != 0) {
				$ExpiredDate = $rw['Expired_On_Nice'].' (<i>'.nicetime($rw['Expired_On']).'</i>)';
			} else {
				$ExpiredDate = '-';
			}
			$ActionExpired = ucwords(strtolower($rw['ActionExpired']));
			$MsgStatus = $rw['MsgStatus'];
			if ($MsgStatus == '1') {
				$MsgStatus = '<span class="text-success"><i class="fa fa-check-circle push-5-r"></i>'._ACTIVE.'</span>';
			} else {
				$MsgStatus = '<span class="text-danger"><i class="fa fa-times push-5-r"></i>'._INACTIVE.'</span>';
			}

			$_output .= "<tr>
			<td align=\"center\">$i.</td>
			<td>
				<h2 class=\"h5 font-w400\">
					<a href=\"#\" onClick=\"javascript:EditMsg('$MsgID');return false;\">$Title</a>
				</h2>
				<div>
					<b>"._POSTDATE." :</b> $PostDate
				</div>
			</td>
			<td align=\"center\">
				$ExpiredDate
			</td>
			<td align=\"center\">
				$MsgStatus
			</td>
			<td align=\"center\" width=\"100\">
				<button type=\"button\" class=\"btn btn-sm btn-primary\" onClick=\"javascript:EditMsg('$MsgID');\">
					<i class=\"fa fa-pencil\"></i>
				</button>
				<button type=\"button\" class=\"btn btn-sm btn-danger\" onClick=\"javascript:DeleteMsg('$MsgID');\">
					<i class=\"fa fa-trash-o\"></i>
				</button>
			</td>
			</tr>";
		}

		# Usergroups
		$rd = $db->Execute("SELECT ID,group_code,group_name FROM ".TBL_USERGROUPS." ORDER BY group_name ASC");
		if (!$rd) {
			l('DBQUERY','modules/administrator/index.php','Messages()->SelectUsergroups',$db->ErrorMsg());
			die($db->ErrorMsg());
		}
		while (list($gid,$group_code,$group_name) = $rd->FetchRow())
		{
			$ugroups .= '<div class="col-xs-12 col-sm-6 col-md-4">
	            <label class="css-input css-checkbox css-checkbox-rounded css-checkbox-primary">
	                <input type="checkbox" name="_ugroups" id="_ug_'.$gid.'" value="'.$gid.'"><span></span> &nbsp;'.$group_name.'
	            </label>
	        </div>';
	    }

		//-------------------------------------------------
		$pagetitle = SITENAME." - "._MESSAGES_CENTER;
		$jquery = "$('#Messages').DataTable({ responsive: true });";
		define('LIB.DATATABLES', true);
		define('LIB.FORMS', true);

		include(WEB_INCLUDES."header.php");
		$t = new Template;
		$t->Load(WEB_MODULE_TEMPLATE."messages.tpl");
		$t->Replace("messages",$_output);
		$t->Replace("USERGROUPS",$ugroups);
		$t->Publish();
		include(WEB_INCLUDES."footer.php");
	}
}
function Templates() {
	global $config, $db, $pagetitle, $jquery, $w_user;
	
	if (!is_sadmin($w_user) && !is_admin($w_user))
	{
		AdminOnly();
	}
	else
	{
		$pagetitle = SITENAME." - "._TEMPLATES;
		$jquery = "$('#Templates').DataTable({ responsive: true });";
		define('DATATABLES', true);	
		define('FORMS', true);

		include(WEB_INCLUDES."header.php");

		$r = 	$db->Execute("SELECT *, DATE_FORMAT(Lastupdate,'%d/%m/%Y %h:%i %p') AS LastupdateFormat
				FROM ".TBL_TEMPLATES." ORDER BY ID ASC");
		if (!$r) { die($db->ErrorMsg()); }

		$i = 0;
		while ($rw = $r->FetchRow())
		{
			$i++;
			$TID = $rw['ID'];
			
			# Templates
			$Title = filter_decode($rw['TajukTemplate'],null,false);
			
			$_output .= "<tr>
			<td align=\"center\">$i.</td>
			<td>
				<div class=\"mb5\">
					<a href=\"#\" onClick=\"javascript:EditTemplate('$TID');return false;\"><b>$Title</b></a>
				</div>
				<div class=\"mb5\">
					<b>"._LASTUPDATE." :</b> ".$rw['LastupdateFormat']." (<i>".nicetime($rw['Lastupdate'])."</i>)"."
				</div>
			</td>
			<td align=\"center\" width=\"100\">
				<button type=\"button\" class=\"btn btn-sm btn-primary\" onClick=\"javascript:EditTemplate('$TID');\">
					<i class=\"fa fa-pencil\"></i>
				</button>
				<button type=\"button\" class=\"btn btn-sm btn-danger\" onClick=\"javascript:DeleteTemplate('$TID');\">
					<i class=\"fa fa-trash-o\"></i>
				</button>		
			</td>
			</tr>";
		}

		# Load Template
		$temp = new Template;
		$temp->Load(WEB_MODULE_TEMPLATE."templates.tpl");
		$temp->Replace("templates",$_output);
		$temp->Publish();
		
		include(WEB_INCLUDES."footer.php");
	}
}

#############################################################################
if (!empty($_REQUEST['p'])) { $p = $_REQUEST['p']; }
switch ($p)
{
	default:
		redirect_to(SITEURL);
	break;

	# System Configurations
	case "config":
		SystemConfig();
	break;

	# Menu
	case "menu":
		Menu();
	break;

	# Languages
	case "languages":
		Languages();
	break;

	# Users & Groups
	case "users":
		Users();
	break;

	# Messages Center
	case "messages_center":
		MessagesCenter();
	break;
}
?>