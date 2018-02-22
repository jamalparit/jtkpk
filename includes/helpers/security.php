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
 *  Block/Unblock IP Address
 */ 
function BlockIP($ipa,$reason=NULL) {
    global $db;

    $Record = RecordCount("SELECT * FROM ".TBL_BANNED." WHERE IP='$ipa'");
    $reason = addslashes($reason);
    if ($Record <= 0)
    {
        $r = $db->Execute("INSERT INTO ".TBL_BANNED." (IP,Reason) VALUES ('$ipa','$reason')");
        if (!$r)
        {
            die($db->ErrorMsg());
        }
    }
    else
    {
        $r = $db->Execute("UPDATE ".TBL_BANNED." SET Reason='$reason' WHERE IP='$ipa'");
        if (!$r)
        {
          die($db->ErrorMsg());
        }
    }
}
function UnblockIP($ipa) {
    global $db;

    $r = $db->Execute("DELETE FROM ".TBL_BANNED." WHERE IP='$ipa'");
    if (!$r)
    {
        die($db->ErrorMsg());
    }
}

/**
 * Strip Image Tags
 *
 * @access	public
 * @param	string
 * @return	string
 */	
function strip_image_tags($str) {
	$str = preg_replace("#<img\s+.*?src\s*=\s*[\"'](.+?)[\"'].*?\>#", "\\1", $str);
	$str = preg_replace("#<img\s+.*?src\s*=\s*(.+?).*?\>#", "\\1", $str);
			
	return $str;
}

/**
 * Convert PHP tags to entities
 *
 * @access	public
 * @param	string
 * @return	string
 */	
function encode_php_tags($str) {
	return str_replace(array('<?php', '<?PHP', '<?', '?>'),  array('&lt;?php', '&lt;?PHP', '&lt;?', '?&gt;'), $str);
}

function parse_signed_request($signed_request) {
  list($encoded_sig, $payload) = explode('.', $signed_request, 2); 

  $secret = $config->FacebookAppSecret;
  $sig = base64_url_decode($encoded_sig);
  $data = json_decode(base64_url_decode($payload), true);
  $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
  if ($sig !== $expected_sig) {
    error_log('Bad Signed JSON signature!');
    return null;
  }
  return $data;
}

function base64_url_decode($input) {
  return base64_decode(strtr($input, '-_', '+/'));
}
?>