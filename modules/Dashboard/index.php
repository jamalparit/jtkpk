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

function Dashboard() {
	global $config, $db, $jquery, $pagetitle, $w_user;

	$pagetitle = SITENAME . ' - ' . SLOGAN;

	include(WEB_INCLUDES."header.php");

	$t = new Template;
	$t->Load(WEB_MODULE_TEMPLATE."dashboard.tpl");
	$t->Replace("fullname",getUserDetail('fullname'));
	$t->Replace("lastvisit",getUser("DATE_FORMAT(Lastvisit,'%d/%m/%Y %h:%i %p')"));
	$t->Publish();
	include(WEB_INCLUDES."footer.php");
}

#-------------------------------------------------
if (!empty($_REQUEST['p'])) { $p = $_REQUEST['p']; } else { $p = "";}
switch ($p)
{
	default:
		Dashboard();
	break;
}
?>