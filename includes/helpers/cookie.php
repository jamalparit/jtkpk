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
 * Set cookie
 *
 * Accepts six parameter, or you can submit an associative
 * array in the first parameter containing all the values.
 *
 * @access	public
 * @param	mixed
 * @param	string	the value of the cookie
 * @param	string	the number of seconds until expiration
 * @param	string	the cookie domain.  Usually:  .yourdomain.com
 * @param	string	the cookie path
 * @param	string	the cookie prefix
 * @return	void
 */
function set_cookie($name = '', $value = '', $expire = '', $domain = '', $path = '/', $prefix = '') {
	if (is_array($name)) {
		foreach (array('value', 'expire', 'domain', 'path', 'prefix', 'name') as $item) {
			if (isset($name[$item])) {
				$$item = $name[$item];
			}
		}
	}
			
	if ( ! is_numeric($expire)) {
		$expire = time() - 86500;
	} else {
		if ($expire > 0) {
			$expire = time() + $expire;
		} else {
			$expire = 0;
		}
	}
	
	setcookie($prefix.$name, $value, $expire, $path, $domain, 0);
}
	
// --------------------------------------------------------------------

/**
 * Delete a COOKIE
 *
 * @param	mixed
 * @param	string	the cookie domain.  Usually:  .yourdomain.com
 * @param	string	the cookie path
 * @param	string	the cookie prefix
 * @return	void
 */
function delete_cookie($name = '', $domain = '', $path = '/', $prefix = '') {
	set_cookie($name, '', '', $domain, $path, $prefix);
}
?>