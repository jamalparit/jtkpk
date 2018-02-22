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

function SendSMS($sms_to,$sms_msg,$ret_result=false) {
	global $config, $db;

	$query_string = "api2.aspx?apiusername=".$config->SMSUser."&apipassword=".$config->SMSPwd;
	$query_string .= "&senderid=MNET&mobileno=".rawurlencode($sms_to);
	$query_string .= "&message=".rawurlencode(stripslashes($sms_msg)) . "&languagetype=1";

	$url = $config->SMS_MTURL.$query_string;
	//$fd = implode('', file($url));
	$fd = file_get_contents($url);
	if ($fd)
	{
		if ($ret_result == true)
		{
			return $fd;
		}
		else
		{
			return true;
		}		
	}
	else
	{
		if ($ret_result == true)
		{
			return 0;
		}
		else
		{
			return false;
		}		
	}
}
?>