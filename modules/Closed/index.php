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

function SystemClosed() {
	global $config, $db, $pagetitle, $cssload, $jsload;
	$pagetitle = SITENAME." - "._SYSTEM_IS_CLOSED;
	define('CLOSED', true);
	
	$ClosedReason = get_vv("ClosedReason",TBL_CONFIG,"");
	$ClosedReason = filter_decode($ClosedReason,'view',true,true);

	include(WEB_INCLUDES."header.php");
	$t = new Template;
	$t->Load(WEB_TEMPLATES_SYSTEM."system-closed.tpl");
	$t->Replace("CloseReason",$ClosedReason);	
	$t->Replace('COPYRIGHT', sprintf(_COPYRIGHT_FOOTER,YEAR,SITENAME));
	$t->Publish();
	include(WEB_INCLUDES."footer.php");
}

#-------------------------------------------------
if (!empty($_REQUEST['p'])) { $p = $_REQUEST['p']; } else { $p = "";}
switch ($p)
{
	default:
		SystemClosed();
	break;
}
?>