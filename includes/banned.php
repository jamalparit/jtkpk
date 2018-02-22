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
global $db;

# 000.000.000.000
$result = dbe('SELECT',"SELECT Reason FROM ".TBL_BANNED." WHERE IP='".IP_ADDRESS."'",array('DBQUERY','GENERAL','SelectReason-Banned'));
if (!$result){ die($db->ErrorMsg()); }
$numrow = $result->RecordCount();
if ($numrow != 0)
{
	list($dbReason) = $result->FetchRow();
	$dbReason = filter_decode($dbReason);
	if ($dbReason != "")
	{
		$dbReason = "<font face=\"Verdana\" size=\"2\">$dbReason</font><br/>";
	}

	die("<center><br/><br/><img src=\"".URL_IMAGES."/logo.png\" /><br /><br /><br /><br /><img src=\"".URL_IMAGES."/banned.png\" /><br /><br />$dbReason</center>");
}

# 000.000.000.*
$ip_class = explode(".", IP_ADDRESS);
$ip = "$ip_class[0].$ip_class[1].$ip_class[2].*";
$rs = dbe('SELECT',"SELECT IP,Reason FROM ".TBL_BANNED." WHERE IP='$ip'", array('DBQUERY','GENERAL','SelectReason-Banned'));
if ($rs->RecordCount() > 0)
{
	list($ip_address, $dbReason2) = $rs->FetchRow();
	$ip_class_banned = explode(".", $ip_address);
	$dbReason2 = filter_decode($dbReason2);

	if ($ip_class_banned[3] == "*")
	{
		if ($ip_class[0] == $ip_class_banned[0] && $ip_class[1] == $ip_class_banned[1] && $ip_class[2] == $ip_class_banned[2])
		{
			if ($dbReason2 != "")
			{
				$dbReason2 = "<font face=\"Verdana\" size=\"2\">$dbReason2</font><br/>";
			}

			die("<center><br/><br/><img src=\"".URL_IMAGES."/logo.png\" /><br /><br /><br /><br /><img src=\"".URL_IMAGES."/banned.png\" /><br /><br />$dbReason2</center>");
		}
	}
	unset($ip);
}
?>