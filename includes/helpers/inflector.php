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
 * Singular
 *
 * Takes a plural word and makes it singular
 *
 * @access	public
 * @param	string
 * @return	str
 */		
function singular($str) {
    $str = strtolower(trim($str));
    $end = substr($str, -3);
    
    if ($end == 'ies') {
        $str = substr($str, 0, strlen($str)-3).'y';
    } elseif ($end == 'ses') {
        $str = substr($str, 0, strlen($str)-2);
    } else {
        $end = substr($str, -1);
        
        if ($end == 's') {
            $str = substr($str, 0, strlen($str)-1);
        }
    }
    
    return $str;
}

/**
 * Plural
 *
 * Takes a singular word and makes it plural
 *
 * @access	public
 * @param	string
 * @param	bool
 * @return	str
 */		
function plural($str, $force = FALSE) {
    $str = strtolower(trim($str));
    $end = substr($str, -1);

    if ($end == 'y') {
        $str = substr($str, 0, strlen($str)-1).'ies';
    } elseif ($end == 's') {
        if ($force == TRUE) {
            $str .= 'es';
        }
    } else {
        $str .= 's';
    }

    return $str;
}

/**
 * Camelize
 *
 * Takes multiple words separated by spaces or underscores and camelizes them
 *
 * @access	public
 * @param	string
 * @return	str
 */		
function camelize($str) {		
	$str = 'x'.strtolower(trim($str));
	$str = ucwords(preg_replace('/[\s_]+/', ' ', $str));
	return substr(str_replace(' ', '', $str), 1);
}

/**
 * Underscore
 *
 * Takes multiple words separated by spaces and underscores them
 *
 * @access	public
 * @param	string
 * @return	str
 */		
function underscore($str) {
	return preg_replace('/[\s]+/', '_', strtolower(trim($str)));
}

/**
 * Humanize
 *
 * Takes multiple words separated by underscores and changes them to spaces
 *
 * @access	public
 * @param	string
 * @return	str
 */		
function humanize($str) {
	return ucwords(preg_replace('/[_]+/', ' ', strtolower(trim($str))));
}
?>