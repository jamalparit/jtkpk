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

function MessagesCenter() {
	global $config, $db, $jquery, $pagetitle, $w_user;

	$MessageID = $_REQUEST['mid'];
	if (isset($MessageID) && strlen($MessageID)!=0 && is_numeric($MessageID))
	{
		$jquery = "App.initLoaderStatic('messages-center','load-msg','$MessageID');";
	}
	else
	{
		$jquery = "App.initLoaderStatic('messages-center','load-msg','');";
	}

	$pagetitle = SITENAME.' - '._MESSAGES_CENTER;
	
	include(WEB_INCLUDES."header.php");	
	$t = new Template;
	$t->Load(WEB_MODULE_TEMPLATE."messages-center.tpl");
	$t->Replace('q','');
	$t->Publish();
	include(WEB_INCLUDES."footer.php");
}

#-------------------------------------------------
if (!empty($_REQUEST['p'])) { $p = $_REQUEST['p']; }
switch ($p)
{
	default:
		MessagesCenter();
	break;
}
?>