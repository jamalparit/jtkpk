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

function Notify($type,$msg,$position=NULL,$delay=2000) {
	if ($position == NULL && $delay == 2000) {
		echo "Notify('".addslashes($type)."','".addslashes($msg)."');";
	} else {
		echo "Notify('".addslashes($type)."','".addslashes($msg)."','$position','$delay');";
	}
}
function NotifyTitle($type,$title,$msg,$position=NULL,$delay=10000) {
	echo "NotifyTitle('".addslashes($type)."','<h5>".addslashes($title)."</h5>".addslashes($msg)."','$position','$delay');";
}
function SweetAlert($type,$title,$msg,$func=NULL) {
	echo "SweetAlert('".$type."','".addslashes($title)."','".addslashes($msg)."','".addslashes($func)."');";
}
function scrollto($target,$speed) {
	echo "jQuery('html, body').animate({ scrollTop: jQuery($('#".$target."')).offset().top }, $speed);";
}
function SweetAlert_Error($msg=NULL) {
	echo "SweetAlert('error','Ops !','<b>"._ERROR." :</b> $msg');";
}
function SweetAlert_Error_Script($msg=NULL) {
	echo "<script>SweetAlert('error','Ops !','<b>"._ERROR." :</b> $msg');</script>";
}
?>