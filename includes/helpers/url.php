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
 * Mailto Link
 *
 * @access	public
 * @param	string	the email address
 * @param	string	the link title
 * @param	mixed 	any attributes
 * @return	string
 */
function mailto($email, $title = '', $attributes = '') {
	$title = (string) $title;
	
	if ($title == "") {
		$title = $email;
	}
	
	$attributes = _parse_attributes($attributes);
	
	return '<a href="mailto:'.$email.'"'.$attributes.'>'.$title.'</a>';
}
	
/**
 * Encoded Mailto Link
 *
 * Create a spam-protected mailto link written in Javascript
 *
 * @access	public
 * @param	string	the email address
 * @param	string	the link title
 * @param	mixed 	any attributes
 * @return	string
 */
function safe_mailto($email, $title = '', $attributes = '') {
	$title = (string) $title;
	
	if ($title == "") {
		$title = $email;
	}
					
	for ($i = 0; $i < 16; $i++) {
		$x[] = substr('<a href="mailto:', $i, 1);
	}
	
	for ($i = 0; $i < strlen($email); $i++) {
		$x[] = "|".ord(substr($email, $i, 1));
	}

	$x[] = '"';

	if ($attributes != '') {
		if (is_array($attributes)) {
			foreach ($attributes as $key => $val) {
				$x[] =  ' '.$key.'="';
				for ($i = 0; $i < strlen($val); $i++) {
					$x[] = "|".ord(substr($val, $i, 1));
				}
				$x[] = '"';
			}
		} else {
			for ($i = 0; $i < strlen($attributes); $i++) {
				$x[] = substr($attributes, $i, 1);
			}
		}
	}	
	
	$x[] = '>';
	
	$temp = array();
	for ($i = 0; $i < strlen($title); $i++) {
		$ordinal = ord($title[$i]);
	
		if ($ordinal < 128) {
			$x[] = "|".$ordinal;
		} else {
			if (count($temp) == 0) {
				$count = ($ordinal < 224) ? 2 : 3;
			}
		
			$temp[] = $ordinal;
			if (count($temp) == $count) {
				$number = ($count == 3) ? (($temp['0'] % 16) * 4096) + (($temp['1'] % 64) * 64) + ($temp['2'] % 64) : (($temp['0'] % 32) * 64) + ($temp['1'] % 64);
				$x[] = "|".$number;
				$count = 1;
				$temp = array();
			}
		}
	}
	
	$x[] = '<'; $x[] = '/'; $x[] = 'a'; $x[] = '>';
	
	$x = array_reverse($x);
	ob_start();
?><script type="text/javascript">
//<![CDATA[
var l=new Array();
<?php
$i = 0;
foreach ($x as $val){ ?>l[<?php echo $i++; ?>]='<?php echo $val; ?>';<?php } ?>

for (var i = l.length-1; i >= 0; i=i-1){
if (l[i].substring(0, 1) == '|') document.write("&#"+unescape(l[i].substring(1))+";");
else document.write(unescape(l[i]));}
//]]>
</script><?php
	$buffer = ob_get_contents();
	ob_end_clean();
	return $buffer;
}
	
/**
 * Auto-linker
 *
 * Automatically links URL and Email addresses.
 * Note: There's a bit of extra code here to deal with
 * URLs or emails that end in a period.  We'll strip these
 * off and add them after the link.
 *
 * @access	public
 * @param	string	the string
 * @param	string	the type: email, url, or both
 * @param	bool 	whether to create pop-up links
 * @return	string
 */
function auto_link($str, $type = 'both', $popup = FALSE) {
	if ($type != 'email') {
		if (preg_match_all("#(^|\s|\()((http(s?)://)|(www\.))(\w+[^\s\)\<]+)#i", $str, $matches)) {
			$pop = ($popup == TRUE) ? " target=\"_blank\" " : "";
		
			for ($i = 0; $i < sizeof($matches['0']); $i++) {
				$period = '';
				if (preg_match("|\.$|", $matches['6'][$i])) {
					$period = '.';
					$matches['6'][$i] = substr($matches['6'][$i], 0, -1);
				}

				$str = str_replace($matches['0'][$i],
									$matches['1'][$i].'<a href="http'.
									$matches['4'][$i].'://'.
									$matches['5'][$i].
									$matches['6'][$i].'"'.$pop.'>http'.
									$matches['4'][$i].'://'.
									$matches['5'][$i].
									$matches['6'][$i].'</a>'.
									$period, $str);
			}
		}
	}

	if ($type != 'url') {	
		if (preg_match_all("/([a-zA-Z0-9_\.\-]+)@([a-zA-Z0-9\-]+)\.([a-zA-Z0-9\-\.]*)/i", $str, $matches)) {
			for ($i = 0; $i < sizeof($matches['0']); $i++) {
				$period = '';
				if (preg_match("|\.$|", $matches['3'][$i])) {
					$period = '.';
					$matches['3'][$i] = substr($matches['3'][$i], 0, -1);
				}
			
				$str = str_replace($matches['0'][$i], safe_mailto($matches['1'][$i].'@'.$matches['2'][$i].'.'.$matches['3'][$i]).$period, $str);
			}
		}
	}
	return $str;
}
	
/**
 * Prep URL
 *
 * Simply adds the http:// part if missing
 *
 * @access	public
 * @param	string	the URL
 * @return	string
 */
function prep_url($str = '') {
	if ($str == 'http://' OR $str == '') {
		return '';
	}
	
	if (substr($str, 0, 7) != 'http://' && substr($str, 0, 8) != 'https://') {
		$str = 'http://'.$str;
	}
	
	return $str;
}
	
/**
 * Create URL Title
 *
 * Takes a "title" string as input and creates a
 * human-friendly URL string with either a dash
 * or an underscore as the word separator.
 *
 * @access	public
 * @param	string	the string
 * @param	string	the separator: dash, or underscore
 * @return	string
 */
function url_title($str, $separator = 'dash') {
	if ($separator == 'dash') {
		$search		= '_';
		$replace	= '-';
	} else {
		$search		= '-';
		$replace	= '_';
	}

	$trans = array(
					$search								=> $replace,
					"\s+"								=> $replace,
					"[^a-z0-9".$replace."]"				=> '',
					$replace."+"						=> $replace,
					$replace."$"						=> '',
					"^".$replace						=> ''
				   );

	$str = strip_tags(strtolower($str));
	
	foreach ($trans as $key => $val) {
		$str = preg_replace("#".$key."#", $val, $str);
	}
	
	return trim(stripslashes($str));
}
	
/**
 * Header Redirect
 *
 * Header redirect in two flavors
 *
 * @access	public
 * @param	string	the URL
 * @param	string	the method: location or redirect
 * @return	string
 */
function HeaderRedirect($uri = '', $method = 'location') {
	switch($method) {
		case 'refresh'	: header("Refresh:0;url=".$uri);
		break;
		
		default			: header("Location: ".$uri);
		break;
	}
	exit;
}

function Redirect($uri) {
	echo "window.location.href='".$uri."';";
}
function redirect_to($uri) {
	echo "<script>window.location.href='".$uri."';</script>";
}
	
/**
 * Parse out the attributes
 *
 * Some of the functions use this
 *
 * @access	private
 * @param	array
 * @param	bool
 * @return	string
 */
function _parse_attributes($attributes, $javascript = FALSE) {
	if (is_string($attributes)) {
		return ($attributes != '') ? ' '.$attributes : '';
	}

	$att = '';
	foreach ($attributes as $key => $val) {
		if ($javascript == TRUE) {
			$att .= $key . '=' . $val . ',';
		} else {
			$att .= ' ' . $key . '="' . $val . '"';
		}
	}
	
	if ($javascript == TRUE AND $att != '') {
		$att = substr($att, 0, -1);
	}
	
	return $att;
}
?>