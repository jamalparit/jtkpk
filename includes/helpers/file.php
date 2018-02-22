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
 * Read File
 *
 * Opens the file specfied in the path and returns it as a string.
 *
 * @access	public
 * @param	string	path to file
 * @return	string
 */	
function read_file($file) {
	if ( ! file_exists($file)) {
		return FALSE;
	}
	
	if (function_exists('file_get_contents')) {
		return file_get_contents($file);		
	}

	if ( ! $fp = @fopen($file, 'rb')) {
		return FALSE;
	}
		
	flock($fp, LOCK_SH);
	
	$data = '';
	if (filesize($file) > 0) {
		$data =& fread($fp, filesize($file));
	}

	flock($fp, LOCK_UN);
	fclose($fp);

	return $data;
}

/**
 * Write File
 *
 * Writes data to the file specified in the path.
 * Creates a new file if non-existent.
 *
 * @access	public
 * @param	string	path to file
 * @param	string	file data
 * @return	bool
 */	
function write_file($path, $data, $mode = 'wb') {
	if ( ! $fp = @fopen($path, $mode)) {
		return FALSE;
	}
		
	flock($fp, LOCK_EX);
	fwrite($fp, $data);
	flock($fp, LOCK_UN);
	fclose($fp);	

	return TRUE;
}

/**
 * Delete Files
 *
 * Deletes all files contained in the supplied directory path.
 * Files must be writable or owned by the system in order to be deleted.
 * If the second parameter is set to TRUE, any directories contained
 * within the supplied base directory will be nuked as well.
 *
 * @access	public
 * @param	string	path to file
 * @param	bool	whether to delete any directories found in the path
 * @return	bool
 */	
function delete_files($path, $del_dir = FALSE, $level = 0) {
	// Trim the trailing slash
	$path = preg_replace("|^(.+?)/*$|", "\\1", $path);
			
	if ( ! $current_dir = @opendir($path))
		return;
	
	while(FALSE !== ($filename = @readdir($current_dir))) {
		if ($filename != "." and $filename != "..") {
			if (is_dir($path.'/'.$filename)) {
				$level++;
				delete_files($path.'/'.$filename, $del_dir, $level);
			} else {
				unlink($path.'/'.$filename);
			}
		}
	}
	@closedir($current_dir);
	
	if ($del_dir == TRUE AND $level > 0) {
		@rmdir($path);
	}
}

/**
 * Get Filenames
 *
 * Reads the specified directory and builds an array containing the filenames.  
 * Any sub-folders contained within the specified path are read as well.
 *
 * @access	public
 * @param	string	path to source
 * @param	bool	whether to include the path as part of the filename
 * @return	array
 */	
function get_filenames($source_dir, $include_path = FALSE) {
	static $_filedata = array();
	
	if ($fp = @opendir($source_dir)) {
		while (FALSE !== ($file = readdir($fp))) {
			if (@is_dir($source_dir.$file) && substr($file, 0, 1) != '.') {
				 get_filenames($source_dir.$file."/", $include_path);
			} elseif (substr($file, 0, 1) != ".") {
				$_filedata[] = ($include_path == TRUE) ? $source_dir.$file : $file;
			}
		}
		return $_filedata;
	}
}

/**
* Return file extension from specific path
*
* @access public
* @param string $path File path
* @param boolean $leading_dot Include leading dot (or not...)
* @return string
*/
function get_file_extension($path, $leading_dot = false) {
	$filename = basename($path);
	$dot_offset = (boolean) $leading_dot ? 0 : 1;

	if( ($pos = strrpos($filename, '.')) !== false ) {
  		return substr($filename, $pos + $dot_offset, strlen($filename));
	}

	return '';
}
?>