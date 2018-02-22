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
define('FOOTER', true);

function LoadingTime() {
	global $start_time;
	$mtime = microtime();
	$mtime = explode(" ",$mtime);
	$mtime = $mtime[1] + $mtime[0];
	$end_time = $mtime;
	$total_time = ($end_time - $start_time);
	$total_time = substr($total_time,0,4);
	return $total_time;
}

function WebFooter() {
	global $config, $jquery, $jscript, $jsload, $w_user;

	ThemesFooter();
	echo "\n<!-- Loading Time: ".LoadingTime()." //-->\n";
	echo "</body>\n";
	echo "</html>";
	ob_end_flush();
	die();
}

WebFooter();
?>