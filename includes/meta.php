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

# Define Page Description
if (!$page_description) {
	$page_description = $config->SiteDescription;
} else {
	$page_description = trimall(stripslashes($page_description));
}

$metastring = meta(array(
	'pragma'=>'no-cache',
	'expires'=>'-1',
	'cache-control'=>'no-cache',
	'X-UA-Compatible'=>'IE=edge',
	'content-type'=>'text/html; charset='.CHARSET
));
$metastring .= meta_name(array(
	'developer'=> $config->Developer,
	'copyright'=>'Copyright (c) '.YEAR.' by '.SITENAME.'. All right reserved.',
	'description'=> $page_description,
	'keywords'=> $config->Keywords,
	'slogan'=> $config->Slogan,
	'robots'=>'index, follow',
	'googlebot'=>'noarchive'
));
echo $metastring;
?>