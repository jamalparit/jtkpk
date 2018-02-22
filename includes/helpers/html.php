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
 * Heading
 *
 * Generates an HTML heading tag.  First param is the data.
 * Second param is the size of the heading tag.
 *
 * @access	public
 * @param	string
 * @param	integer
 * @return	string
 */	
function heading($data = '', $h = '1') {
	return "<h".$h.">".$data."</h".$h.">";
}

/**
 * Unordered List
 *
 * Generates an HTML unordered list from an single or multi-dimensional array.
 *
 * @access	public
 * @param	array
 * @param	mixed
 * @return	string
 */	
function ul($list, $attributes = '') {
	return _list('ul', $list, $attributes);
}

/**
 * Ordered List
 *
 * Generates an HTML ordered list from an single or multi-dimensional array.
 *
 * @access	public
 * @param	array
 * @param	mixed
 * @return	string
 */	
function ol($list, $attributes = '') {
	return _list('ol', $list, $attributes);
}

/**
 * Generates the list
 *
 * Generates an HTML ordered list from an single or multi-dimensional array.
 *
 * @access	private
 * @param	string
 * @param	mixed		
 * @param	mixed		
 * @param	intiger		
 * @return	string
 */	
function _list($type = 'ul', $list, $attributes = '', $depth = 0) {
	// If an array wasn't submitted there's nothing to do...
	if ( ! is_array($list)) {
		return $list;
	}
	
	// Set the indentation based on the depth
	$out = str_repeat(" ", $depth);
	
	// Were any attributes submitted?  If so generate a string
	if (is_array($attributes)) {
		$atts = '';
		foreach ($attributes as $key => $val) {
			$atts .= ' ' . $key . '="' . $val . '"';
		}
		$attributes = $atts;
	}
	
	// Write the opening list tag
	$out .= "<".$type.$attributes.">\n";

	// Cycle through the list elements.  If an array is 
	// encountered we will recursively call _list()
	static $_last_list_item = '';
	foreach ($list as $key => $val) {
		$_last_list_item = $key;

		$out .= str_repeat(" ", $depth + 2);
		$out .= "<li>";
		
		if ( ! is_array($val)) {
			$out .= $val;
		} else {
			$out .= $_last_list_item."\n";
			$out .= _list($type, $val, '', $depth + 4);
			$out .= str_repeat(" ", $depth + 2);
		}

		$out .= "</li>\n";		
	}

	// Set the indentation for the closing tag
	$out .= str_repeat(" ", $depth);
	
	// Write the closing list tag
	$out .= "</".$type.">\n";

	return $out;
}

/**
 * Generates HTML BR tags based on number supplied
 *
 * @access	public
 * @param	integer
 * @return	string
 */	
function br($num = 1) {
	return str_repeat("<br />", $num);
}

/**
 * Generates non-breaking space entities based on number supplied
 *
 * @access	public
 * @param	integer
 * @return	string
 */	
function nbs($num = 1) {
	return str_repeat("&nbsp;", $num);
}

/**
 * Generates meta tags from an array of key/values
 *
 * @access	public
 * @param	array
 * @return	string
 */	
function meta($meta = array(), $newline = "\n") {
	$str = '';
	foreach ($meta as $key => $val) {
		$str .= '<meta http-equiv="'.$key.'" content="'.$val.'">'.$newline;
	}

	return $str;
}

function meta_name($meta = array(), $newline = "\n") {
	$str = '';
	foreach ($meta as $key => $val) {
		$str .= '<meta name="'.$key.'" content="'.$val.'">'.$newline;
	}

	return $str;
}

function meta_property($meta = array(), $newline = "\n") {
	$str = '';
	foreach ($meta as $key => $val) {
		$str .= '<meta property="'.$key.'" content="'.$val.'">'.$newline;
	}

	return $str;
}

function eecho($txt) {
	echo $txt;
}
function eecho_script($txt) {
	echo '<script>'.$txt.'</script>';
}

function alertscript($txt) {
	$txt = str_replace("\n",'\n',$txt);
	$alert = "<script>alert('" . $txt . "');</script>\n";
	echo $alert;
}

function alert_error($msg) {
	$msg = str_replace("\n",'\n',$msg);
	$ErrMsg = "alert('Error: ".$msg."');";
	echo $ErrMsg;
}

function alert($msg) {
	$msg = str_replace("\n",'\n',$msg);
	$InfoMsg = "alert('".$msg."');";
	echo $InfoMsg;
}

function OpenWindow($theURL,$winName,$features) {
	echo "window.open('$theURL','$winName','$features');";	
}

# Document Object Model (DOM) + jQuery
function dom_prop($id,$prop,$value) { echo "$('#$id').prop(\"$prop\",\"$value\");"; }
function dom_removeattr($id,$prop) { echo "$('#$id').removeAttr(\"$prop\");"; }
function dom_show($id) { echo "$('#$id').show();"; }
function dom_hide($id) { echo "$('#$id').hide();"; }
function dom_fadeout($id) { echo "$('#$id').fadeOut();"; }
function dom_enable($id) { echo "$('#$id').prop(\"disabled\",false);"; }
function dom_disable($id) { echo "$('#$id').prop(\"disabled\",true);"; }
function dom_focus($id) { echo "$('#$id').focus();"; }
function dom_select($id) { echo "$('#$id').select();"; }
function dom_setvalue($id,$value) { echo "$('#$id').val(\"$value\");"; }
function dom_getvalue($id) { echo "$('#$id').val();"; }
function dom_checked($id) { echo "$('#$id').prop(\"checked\",true);"; }
function dom_unchecked($id) { echo "$('#$id').prop(\"checked\",false);"; }
function dom_addclass($id,$class) { echo "$('#$id').addClass(\"$class\");"; }
function dom_removeclass($id,$class) { echo "$('#$id').removeClass(\"$class\");"; }
function dom_select2_set($id,$value) { echo "$('#$id').val(\"$value\").trigger(\"change\");"; }
function dom_select2multiple_set($id,$value) { echo "$('#$id').val([$value]).trigger(\"change\");"; }
function dom_importtags($id,$value) { echo "$('#$id').importTags(\"$value\");"; }

function dom_showmodal($id) {
	echo "$('#$id').modal();";
}
function dom_hidemodal($id) {
	echo "$('#$id').modal(\"hide\");";
}
function settimeout($content,$time) {
	echo "setTimeout(function() { $content },$time);";
}
function dom_update($id,$txt) {
	echo "$('#$id').html('".$txt."');";
}
function dom_prepend($id,$txt) {
	echo "$('#$id').prepend('".$txt."');";
}
function dom_append($id,$txt) {
	echo "$('#$id').append('".$txt."');";
}
?>