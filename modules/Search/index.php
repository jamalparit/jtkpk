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

function Search() {
	global $config, $db, $jquery, $pagetitle, $w_user;

	$pagetitle = SITENAME.' - '._SEARCH;
	define('LIB.FORMS', true);

	if (isset($_REQUEST['q'])) {
		$q = $_REQUEST['q'];
	} else if (isset($_POST['q'])) {
		$q = $_POST['q'];
	} else {
		$q = '';
	}

	include(WEB_INCLUDES."header.php");	
	$t = new Template;
	$t->Load(WEB_MODULE_TEMPLATE."search.tpl");
	$t->Replace('q',$q);
	$t->Publish();
	include(WEB_INCLUDES."footer.php");
}

#-------------------------------------------------
if (!empty($_REQUEST['p'])) { $p = $_REQUEST['p']; }
switch ($p)
{
	default:
		Search();
	break;
}
?>