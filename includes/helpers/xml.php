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
 * Convert Reserved XML characters to Entities
 *
 * @access	public
 * @param	string
 * @return	string
 */	
function xml_convert($str)
{
	$temp = '__TEMP_AMPERSANDS__';

	// Replace entities to temporary markers so that 
	// ampersands won't get messed up
	$str = preg_replace("/&#(\d+);/", "$temp\\1;", $str);
	$str = preg_replace("/&(\w+);/",  "$temp\\1;", $str);
	
	$str = str_replace(array("&","<",">","\"", "'", "-"),
					   array("&amp;", "&lt;", "&gt;", "&quot;", "&#39;", "&#45;"),
					   $str);

	// Decode the temp markers back to entities		
	$str = preg_replace("/$temp(\d+);/","&#\\1;",$str);
	$str = preg_replace("/$temp(\w+);/","&\\1;", $str);
		
	return $str;
}
?>