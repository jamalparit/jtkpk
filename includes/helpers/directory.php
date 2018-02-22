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
 * Create a Directory Map
 *
 * Reads the specified directory and builds an array
 * representation of it.  Sub-folders contained with the
 * directory will be mapped as well.
 *
 * @access	public
 * @param	string	path to source
 * @param	bool	whether to limit the result to the top level only
 * @return	array
 */	
function directory_map($source_dir, $top_level_only = FALSE) {	
	if ($fp = @opendir($source_dir)) {
		$filedata = array();
		while (FALSE !== ($file = readdir($fp))) {
			if (@is_dir($source_dir.$file) && substr($file, 0, 1) != '.' AND $top_level_only == FALSE) {
				$temp_array = array();
				$temp_array = directory_map($source_dir.$file."/");
				$filedata[$file] = $temp_array;
			} elseif (substr($file, 0, 1) != ".") {
				$filedata[] = $file;
			}
		}
		return $filedata;
	}
}

/**
* Remove specific directory
*
* @access public
* @param string $dir Directory path
* @return boolean
*/
function delete_dir($dir) {
	$dh = opendir($dir);
	while($file = readdir($dh)) {
		if(($file != ".") && ($file != "..")) {
			$fullpath = $dir . "/" . $file;
		
			if(!is_dir($fullpath)) {
				unlink($fullpath);
			} else {
				delete_dir($fullpath);
			}
		}
	}

	closedir($dh);
	return rmdir($dir) ? true : false;
}

/**
* Force creation of all dirs
*
* @access public
* @param void
* @return null
*/
function force_mkdir($path, $chmod = null) {
	if(is_dir($path)) return true;
	$real_path = str_replace('\\', '/', $path);
	$parts = explode('/', $real_path);

	$forced_path = '';
	foreach($parts as $part) {
		if($forced_path == '') {
			$start = substr(__FILE__, 0, 1) == '/' ? '/' : '';
			$forced_path = $start . $part;
  		} else {
			$forced_path .= '/' . $part;
  		}
  
		if(!is_dir($forced_path)) {
			if(!is_null($chmod)) {
	  			if(!mkdir($forced_path)) return false;
			} else {
	  			if(!mkdir($forced_path, $chmod)) return false;
			}
		}
	}

	return true;
}
?>