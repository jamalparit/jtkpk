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

$parts = explode(DS,WEB_BASE);
define('IP_ADDRESS',GRIP());

# Web Default (Location)
define('WEB_ROOT',				implode(DS,$parts));
define('WEB_VENDOR',			WEB_ROOT.DS.'vendor'.DS);
define('WEB_INCLUDES',			WEB_ROOT.DS.'includes'.DS);
define('WEB_TEMPLATES',			WEB_ROOT.DS.'templates'.DS);
define('WEB_TEMPLATES_SYSTEM',	WEB_ROOT.DS.'templates'.DS.'system'.DS);
define('WEB_HELPER',			WEB_INCLUDES.'helpers'.DS);
define('WEB_LANGUAGES',			WEB_ROOT.DS.'languages'.DS);
define('WEB_THEMES_LOC',		WEB_ROOT.DS.'themes'.DS);
define('WEB_MEDIA',				WEB_ROOT.DS.'media'.DS);
define('WEB_CSS',				WEB_MEDIA.'css'.DS);
define('WEB_FONTS',				WEB_MEDIA.'fonts'.DS);
define('WEB_IMAGES',			WEB_MEDIA.'images'.DS);
define('WEB_JS',				WEB_MEDIA.'js'.DS);

# Web Default (URL)
define('SITEURL',				$config->SiteUrl);
define('URL_MEDIA',				SITEURL.'/media');
define('URL_CSS',				SITEURL.'/media/css');
define('URL_FONT',				SITEURL.'/media/fonts');
define('URL_IMAGES',			SITEURL.'/media/images');
define('URL_JS',				SITEURL.'/media/js');
define('URL_ATHEMES',			SITEURL.'/themes');
define('URL_VENDOR',			SITEURL.'/vendor');

# Themes
define('WEB_THEMES',			WEB_THEMES_LOC.$config->DefaultTheme.DS);
define('WEB_THEMES_CSS',		WEB_THEMES.'css'.DS);
define('WEB_THEMES_FONTS',		WEB_THEMES.'fonts'.DS);
define('WEB_THEMES_IMAGES',		WEB_THEMES.'images'.DS);
define('WEB_THEMES_JS',			WEB_THEMES.'js'.DS);
define('WEB_THEMES_TEMPLATES',	WEB_THEMES.'templates'.DS);

# Themes (URL)
define('URL_THEMES_L',			"../themes/".$config->DefaultTheme);
define('URL_THEMES',			URL_ATHEMES.'/'.$config->DefaultTheme);
define('URL_THEMES_CSS',		URL_THEMES.'/css');
define('URL_THEMES_FONTS',		URL_THEMES.'/fonts');
define('URL_THEMES_IMAGES',		URL_THEMES.'/images');
define('URL_THEMES_JS',			URL_THEMES.'/js');

# Database Tables Define
define('DB_PREFIX',"");
define('TBL_BANNED',DB_PREFIX."banned");
define('TBL_CONFIG',DB_PREFIX."config");
define('TBL_MENU',DB_PREFIX."menu");
define('TBL_LANG',DB_PREFIX."languages");
define('TBL_LANG_DEFINE',DB_PREFIX."languages_defined");
define('TBL_LOGS',DB_PREFIX."logs");
define('TBL_SESSIONS',DB_PREFIX."sessions");
define('TBL_ROLES',DB_PREFIX."roles");
define('TBL_USER_ROLES',DB_PREFIX."user_roles");
define('TBL_USERGROUPS',DB_PREFIX."usergroups");
define('TBL_USER_GROUPS',DB_PREFIX."user_groups");
define('TBL_USERS',DB_PREFIX."users");
define('TBL_USERS_DETAIL',DB_PREFIX."users_detail");
define('TBL_STAT_COUNTER',DB_PREFIX."stats_counter");
define('TBL_STAT_YEAR',DB_PREFIX."stats_year");
define('TBL_STAT_MONTH',DB_PREFIX."stats_month");
define('TBL_STAT_DATE',DB_PREFIX."stats_date");
define('TBL_STAT_HOUR',DB_PREFIX."stats_hour");
define('TBL_TRANSACTIONS',DB_PREFIX."transactions");
define('TBL_CONVERSATION',DB_PREFIX."conversation");
define('TBL_CONVERSATION_MSG',DB_PREFIX."conversation_msg");
define('TBL_CONVERSATION_FOLDER',DB_PREFIX."conversation_folder");
define('TBL_MESSAGES',DB_PREFIX."messages");
define('TBL_MESSAGES_REPLY',DB_PREFIX."messages_reply");
define('TBL_NOTIFICATIONS',DB_PREFIX."notifications");
define('TBL_RATING',DB_PREFIX."data_rating");

/**

	TABLES DEFINE

*/
define('TBL_GRED',DB_PREFIX."gred");
define('TBL_JPN',DB_PREFIX."jpn");
define('TBL_PPD',DB_PREFIX."ppd");
define('TBL_PKG',DB_PREFIX."pkg");
define('TBL_SEKOLAH',DB_PREFIX."sekolah");
define('TBL_AKADEMIK',DB_PREFIX."akademik");
define('TBL_TARAF_JAWATAN',DB_PREFIX."taraf_jawatan");
define('TBL_NEGERI',DB_PREFIX."negeri");
define('TBL_PERJAWATAN_ICT',DB_PREFIX."perjawatan_ict");
define('TBL_JAWATAN',DB_PREFIX."jawatan");

?>