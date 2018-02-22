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

/**

	TRANSACTIONS

*/
function transactions($module,$type,$detail,$data_value=NULL,$uid=NULL) {
	global $config, $db;
	
	if ($uid != NULL) { $user_id = $uid; } else { $user_id = USERID; }
	
	$detail = filter_txt($detail);
	$module = strtoupper($module);
	$type = strtoupper($type);
	if ($data_value != NULL) {
		$data_value = $data_value;
	} else {
		$data_value = '';
	}

	$r = $db->Execute("INSERT INTO ".TBL_TRANSACTIONS." (UID,LogModule,LogType,LogDate,LogIP,LogData,LogDetail) VALUES ('$user_id','$module','$type',NOW(),'".IP_ADDRESS."','$data_value','$detail')");
	if (!$r)
	{
		die($db->ErrorMsg());
	}
}

/**

	NOTIFICATIONS

*/
function _notifications($UserID,$PerformerUID,$NType=NULL,$NotifyType,$EventType,$NotifyData,$NotifyDataExt=NULL) {
	global $config, $db;

	if ($NType == NULL || strlen($NType) == 0) {
		$NType = '';
	} else {
		$NType = strtoupper($NType);
	}

	$iNotify = dbe('_INSERT',"INSERT INTO ".TBL_NOTIFICATIONS." (UID,PerformerUID,NType,NotifyType,EventType,NotifyData,NotifyDataExt,NotifyDate,ReadStatus) VALUES ('$UserID','$PerformerUID','$NType','$NotifyType','$EventType','$NotifyData','$NotifyDataExt',NOW(),'UNREAD')",array('DBQUERY','misc.php','_notifications()'));
	if (!$iNotify) {
		return false;
	} else {
		return true;
	}
}

function notifications($Method,$Type,$EventType,$DataValue,$DataValueExt,$uid,$performer=NULL) {
	global $config, $db;

	$Method = strtoupper($Method);				# EMAIL, WEB, SMS
	$Type = strtoupper($Type);					# Notification Type (LIKE, DISLIKE, ...)
	$EventType = strtoupper($EventType); 		# Event Type (POST, COMMENT, ...)
	$DataValue = strtoupper($DataValue);		# Data ID
	$DataValueExt = strtoupper($DataValueExt);	# Extra Data

	if (strtoupper($performer) != 'SYSTEM')
	{
		if ($performer == NULL) {
			$PerformerName = getUserDetail('fullname', USERID);
			$performer = USERID;
		} else {
			$PerformerName = getUserDetail('fullname', $performer);
			$performer = $performer;
		}
	}
	else
	{
		$performer = 0;
	}

	# Get User Data
	$OwnerName = getUserDetail('fullname', $uid);
	$OwnerEmail = getUserDetail('Email', $uid);

	if ($Method == 'WEB')
	{
		// Send Notification on Web
		_notifications($uid,$performer,NULL,$Type,$EventType,$DataValue,$DataValueExt);
		if (is_user_online($uid))
		{
			_notifications($uid,$performer,'LIVE',$Type,$EventType,$DataValue,$DataValueExt);
		}
	}
	else if ($Method == 'EMAIL')
	{
		// Not Implemented
	}
	else if ($Method == 'SMS')
	{
		// Not Implemented
	}
}

function notify_admin($Method,$Type,$EventType,$DataValue,$DataValueExt,$uid) {
	global $config, $db;

	$r = $db->Execute("SELECT UID FROM ".TBL_USERS." WHERE UserGroup IN (1,2)");
	while (list($uid) = $r->FetchRow())
	{
		notifications($Method,$Type,$EventType,$DataValue,$DataValueExt,$uid,USERID);
	}
}
?>