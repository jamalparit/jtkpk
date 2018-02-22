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

# Database Native-Case fields name
# 0 - Lowercase
# 1 - Uppercase
# 2 - Native-case
define('ADODB_ASSOC_CASE', 2);

if (strtolower($config->DatabaseType) == 'mysql')
{
	# MySQL Database
	$db = newAdoConnection('mysqli');
	$db->debug = $config->DatabaseDebug;
	$db->connect($config->DatabaseHost,$config->DatabaseUser,$config->DatabasePass,$config->DatabaseName);
	if (!$db->isConnected())
	{
		include_once(WEB_TEMPLATES.'system'.DS.'database-error.tpl');
		die();
	}
}
else if (strtolower($config->DatabaseType) == 'mssql')
{
	# MSSQL Database
	$db = newAdoConnection('mssqlnative');
	$db->setConnectionParameter('characterSet','UTF-8');
	$db->setConnectionParameter('ReturnDatesAsStrings',false);
	$db->debug = $config->DatabaseDebug;
	$db->connect($config->DatabaseHost,$config->DatabaseUser,$config->DatabasePass,$config->DatabaseName);
	if (!$db->isConnected())
	{
		include_once(WEB_TEMPLATES.'system'.DS.'database-error.tpl');
		die();
	}
}
else
{
	include_once(WEB_TEMPLATES.'system'.DS.'database-error.tpl');
	die();
}
?>