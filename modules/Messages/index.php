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

function Messages() {
	global $config, $db, $jquery, $pagetitle, $w_user, $app;

	$cid = $_REQUEST['cid'];
	if (isset($cid))
	{
		if (strlen($cid)!=0 || numonly($cid)==true)
		{
			$r = dbe('SELECT',"SELECT Receivers,MID FROM ".TBL_CONVERSATION." WHERE CID='$cid' AND Receivers LIKE '%,".USERID.",%'",array('DBQUERY','modules/Messages/index.php','Messages()'));
			if (!$r) { die(); }

			if ($r->RecordCount() == 0)
			{
				HeaderRedirect(SITEURL."/messages");
			}
			else
			{
				list($Receivers, $MsgID) = $r->FetchRow();
				
				// Mark Message as Read
				dbe('UPDATE',"UPDATE ".TBL_CONVERSATION_FOLDER." SET ReadStatus='READ' WHERE Receiver='".USERID."' AND CID='$cid'",array('DBQUERY','modules/Messages/index.php','Messages()->MarkAsRead'));
				
				// Conversation between
				$Receivers = explode(",", $Receivers);
				$ConversationBetween = array();
				foreach ($Receivers as $Receiver)
				{
					if (strlen($Receiver) != 0)
					{
						if ($Receiver != USERID)
						{
							$ConvName = getUserDetail("Fullname",$Receiver);
							$ConversationBetween[] .= "<b>$ConvName</b>";
						}
					}
				}
				$ConverBetween = implode(", ",$ConversationBetween);
				$HeaderTitle = _CONVERSATION_BETWEEN_YOU_AND." ".$ConverBetween;
			}
			$jquery = "App.initLoaderStatic('read-message','msg','$cid');";
		}
	}
	else
	{
		$app = "'table-tools'";
		$jquery = "LoadMsg();";
	}

	//-------------------------------------------------
	$pagetitle = SITENAME.' - '._MESSAGES;
	define('LIB.FORMS', true);
	$jquery .= "$('#_to').select2({
		multiple: true,
		tokenSeparators: [',', ' ']
	});";

	include(WEB_INCLUDES."header.php");	
	$t = new Template;
	if (isset($cid))
	{
		if (strlen($cid)!=0 || numonly($cid)==true)
		{
			$t->Load(WEB_MODULE_TEMPLATE."read-message.tpl");
			$t->Replace("HeaderTitle",$HeaderTitle);
			$t->Replace("cid",$cid);
			$refresh = "0";
		}
	}
	else
	{
		$t->Load(WEB_MODULE_TEMPLATE."messages.tpl");
		$t->Replace("avatar",getUserAvatar());
		$refresh = "1";
	}

	# Compose Dialog
	$tc = new Template;
	$tc->Load(WEB_MODULE_TEMPLATE."compose.tpl");
	$ru = $db->Execute("SELECT UID,Firstname,Lastname FROM ".TBL_USERS_DETAIL." WHERE UID!='".USERID."' ORDER BY Firstname ASC, Lastname ASC");
	while (list($_uid,$_firstname,$_lastname) = $ru->FetchRow()) {
		$_users .= "<option value=\"$_uid\">$_firstname $_lastname</option>";
	}
	$tc->Replace("USERS",$_users);
	$tc->Replace("refresh",$refresh);
	$compose = $tc->Evaluate();
	$t->Replace("COMPOSE",$compose);

	$t->Publish();
	include(WEB_INCLUDES."footer.php");
}

#-------------------------------------------------
if (!empty($_REQUEST['p'])) { $p = $_REQUEST['p']; }
switch ($p)
{
	default:
		Messages();
	break;
}
?>