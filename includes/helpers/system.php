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

function getDefaultLanguage() {
	global $db;
	$ret = getv("CodeLang",TBL_LANG,"DefaultLang","1");
	return $ret;
}

function moduleGetAccess($menu_key = null) {
	global $db, $w_user, $user;
    
	if ($menu_key !== null)
	{
		$roles = getv('role_id',TBL_MENU,'MenuKey',$menu_key);
		if (is_sadmin($w_user) || $user->hasRole($roles)) {
			return true;
		} else {
			return false;
		}
	}
	else
	{
		return false;
	}
}
?>