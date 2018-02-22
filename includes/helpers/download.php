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
 * Force Download
 *
 * Generates headers that force a download to happen
 *
 * @access	public
 * @param	string	filename
 * @param	mixed	the data to be downloaded
 * @return	void
 */	
function force_download($filename = '', $data = '',$title = '') {
	if ($filename == '' OR $data == '') {
		return FALSE;
	}

	// Try to determine if the filename includes a file extension.
	// We need it in order to set the MIME type
	if (FALSE === strpos($filename, '.')) {
		return FALSE;
	}
	
	// Grab the file extension
	$x = explode('.', $filename);
	$extension = end($x);

	// Load the mime types
	include(WEB_INCLUDES.'mimes.php');
	
	// Set a default mime if we can't find it
	if ( ! isset($mimes[$extension])) {
		$mime = 'application/octet-stream';
	} else {
		$mime = (is_array($mimes[$extension])) ? $mimes[$extension][0] : $mimes[$extension];
	}
	
	// set title
	if ($title != '') {
		$title = html2txt($title);
		$title = str_replace("'","",$title);
		$title = str_replace(" ","_",$title);
		$title = $title.".".$extension;
	} else {
		$title = $filename;
	}

	// Generate the server headers
	if (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE")) {
		header('Content-Type: '.$mime.'');
		header('Content-Disposition: attachment; filename="'.$title.'"');
		header("Content-Transfer-Encoding: binary");
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header("Content-Length: ".filesize($data));
	} else {
		header('Content-Type: '.$mime.'');
		header('Content-Disposition: attachment; filename="'.$title.'"');
		header("Content-Transfer-Encoding: binary");
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: no-cache');
		header("Content-Length: ".filesize($data));
	}
	
	ob_clean();
    flush();	
	readfile($data);
	exit;
}
?>