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

function is_number($number) {
	$text = (string)$number;
   	$textlen = strlen($text);
   	if ($textlen==0) return false;
	
   	for ($i=0;$i < $textlen;$i++){
		$ch = ord($text{$i});
    	if (($ch<48) || ($ch>57)) return false;
   	}
	
   	return true;
}

function is_odd($number){
	return($number & 1);
}

function is_even($number){
	return(!($number & 1));
}

function price($number) {
	return number_format($number,2,".",",");
}

function num($number) {
	return number_format($number,0,"",",");
}

function is_positive($nr){
	if (ereg("^[0-9]+$", $nr) && $nr > 0) {
  		return true;
  	} else {
  		return false;
 	}
}

function NumOnly($input) {
	if (!preg_match("/^[0-9]+$/i", $input) ) {
        return false;
    }
    return true;
} 

function ValidMobile($input) {
	if (!preg_match("/^[0-9]+$/i", $input) ) {
        return false;
    }
    return true;
} 

// a-z 0-9 _
function ValidUserID($input) {
	if (!preg_match("/^[a-z0-9_]+$/i", $input) ) {
        return false;
    }
    return true;
} 

function is_alnum($input) {
	if (!preg_match("/^[a-zA-Z0-9]+$/i", $input) ) {
        return false;
    }
    return true;
} 

function ValidName($input) {
	if (!preg_match("/^[a-zA-Z _]+$/i", $input) ) {
        return false;
    }
    return true;
} 

function ValidEmail($str) {
	return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? false : true;
}

function ValidDate($txt) {
	# DD/MM/YYYY
	if (!preg_match("/^[0-9\/]+$/i", $txt) ) {
        return false;
    }
	if (strlen($txt) != 10) {
		return false;
	}
    return true;
}

function ValidURL($url) {
	if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
	    return true;
	} else {
	    return false;
	}
}

/**
 * Trim Slashes
 *
 * Removes any leading/traling slashes from a string:
 *
 * /this/that/theother/
 *
 * becomes:
 *
 * this/that/theother
 *
 * @access	public
 * @param	string
 * @return	string
 */	
function trim_slashes($str) {
    return trim($str, '/');
}

function removeslashes($string)
{
    $string=implode("",explode("\\",$string));
    return stripslashes(trim($string));
}

/**
 * Reduce Double Slashes
 *
 * Converts double slashes in a string to a single slash,
 * except those found in http://
 *
 * http://www.some-site.com//index.php
 *
 * becomes:
 *
 * http://www.some-site.com/index.php
 *
 * @access	public
 * @param	string
 * @return	string
 */	
function reduce_double_slashes($str) {
	return preg_replace("#([^:])//+#", "\\1/", $str);
}

/**
 * Create a Random String
 *
 * Useful for generating passwords or hashes.
 *
 * @access	public
 * @param	string 	type of random string.  Options: alunum, numeric, nozero, unique
 * @param	integer	number of characters
 * @return	string
 */	
function random_string($type = 'alnum', $len = 6) {
	switch($type) {
		case 'alnum'	:
		case 'numeric'	:
		case 'nozero'	:
		
				switch ($type) {
					case 'alnum'	:	$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					break;
					
					case 'numeric'	:	$pool = '0123456789';
					break;
					
					case 'nozero'	:	$pool = '123456789';
					break;
				}

				$str = '';
				for ($i=0; $i < $len; $i++) {
					$str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
				}
				return $str;
		break;
		
		case 'unique' : return md5(uniqid(mt_rand()));
		break;
	}
}

/**
 * Alternator
 *
 * Allows strings to be alternated.
 *
 * @access	public
 * @param	string (as many parameters as needed)
 * @return	string
 */		
function alternator() {
	static $i;	

	if (func_num_args() == 0) {
		$i = 0;
		return '';
	}
	$args = func_get_args();
	return $args[($i++ % count($args))];
}

/**
 * Repeater function
 *
 * @access	public
 * @param	string
 * @param	integer	number of repeats
 * @return	string
 */	
function repeater($data, $num = 1) {
	return (($num > 0) ? str_repeat($data, $num) : '');
}
function replaceVariables($template, array $variables){
	//#{(.*?)}#
 	return preg_replace_callback('/(\w+)/i',function($match) use ($variables) {
		$match[1]=trim($match[1],'$');
        return $variables[$match[1]];
	},$template);
}
?>