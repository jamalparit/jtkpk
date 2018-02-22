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

function CalculateRating($type, $data_id) {
	global $db;

	$type = strtoupper($type);
	$star1 = RecordCount("SELECT * FROM ".TBL_RATING." WHERE DataType='$type' AND DataID='$data_id' AND Score='1'");
	$star2 = RecordCount("SELECT * FROM ".TBL_RATING." WHERE DataType='$type' AND DataID='$data_id' AND Score='2'");
	$star3 = RecordCount("SELECT * FROM ".TBL_RATING." WHERE DataType='$type' AND DataID='$data_id' AND Score='3'");
	$star4 = RecordCount("SELECT * FROM ".TBL_RATING." WHERE DataType='$type' AND DataID='$data_id' AND Score='4'");
	$star5 = RecordCount("SELECT * FROM ".TBL_RATING." WHERE DataType='$type' AND DataID='$data_id' AND Score='5'");
	$totalrate = RecordCount("SELECT * FROM ".TBL_RATING." WHERE DataType='$type' AND DataID='$data_id'");

	if ($totalrate != 0) {
		$score = ceil(((1*$star1)+(2*$star2)+(3*$star3)+(4*$star4)+(5*$star5))/$totalrate);
	} else {
		$score = 0;
	}
	return $score;
}
?>