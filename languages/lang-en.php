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

global $config, $db, $w_user, $cookie;

if (is_online($w_user)) {
	cookiedecode($w_user);
	define("USERID",strtolower($cookie[0]));
	define("SID",strtoupper($cookie[1]));
} else {
	define("USERID","");
	define("SID","");
}

# Global
define("CHARSET","UTF-8");
define("SITENAME",$config->SiteName);
define("SLOGAN",$config->Slogan);
define("YEAR",date('Y'));
define("LOCALE",'en');
define("SALT",strtoupper(md5($config->LicenseKey.$_SERVER['REMOTE_ADDR'].time())));

# Declare Language from Database
$r = $db->Execute("SELECT Define,DefineValue FROM ".TBL_LANG_DEFINE." WHERE CodeLang='en' ORDER BY ID ASC");
if (!$r) {
	die($db->ErrorMsg());
} else {
	while (list($L_Define,$L_Value) = $r->FetchRow()) {
		eval('define("_'.$L_Define.'","'.addslashes($L_Value).'");');
	}
}
?>