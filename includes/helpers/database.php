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
 * 	Logs
 */
function l($type,$module,$func,$detail) {
	global $db;

	$browser = $_SERVER['HTTP_USER_AGENT'];
	$detail = addslashes($detail);

	$r = $db->Execute("INSERT INTO ".TBL_LOGS." (LogType,LogDate,LogModule,LogFunc,LogIP,LogBrowser,LogDetail) VALUES ('$type',NOW(),'$module','$func','".IP_ADDRESS."','$browser','$detail')");
	if (!$r)
	{
		die($db->ErrorMsg());
	}
}

/**
 * 	Database Execute
 *
 * $err = array(type,module,functions);
 *
 */
function dbe($mode,$sql,$err = array()) {
	global $db;

	$r = $db->Execute($sql);
	if (!$r)
	{
		l($err[0],$err[1],$err[2],$db->ErrorMsg());
		return false;
	}
	else
	{
		if (strtolower($mode) == "insert")
		{
			return $db->Insert_ID();
		}
		else if (strtolower($mode) == "select")
		{
			return $r;
		}
		else
		{
			return true;
		}
	}
}

/**
 * 	Database Execute Prepare
 */
function dbep($mode,$sql,$array = array(), $err = array()) {
	global $db;
	
	$rp = $db->Prepare($sql);
	$re = $db->Execute($rp, $array);
	if (!$re)
	{
		l($err[0],$err[1],$err[2],$db->ErrorMsg());
		return false;
	}
	else
	{
		if (strtolower($mode) == "insert")
		{
			return $db->Insert_ID();
		}
		else if (strtolower($mode) == "select")
		{
			return $r;
		}
		else
		{
			return true;
		}
	}
}

/**
 * 	Return Record Count
 */
function RecordCount($sql) {
	global $db;

	$rs = $db->Execute($sql);
	if (!$rs)
	{
		die($db->ErrorMsg());
	}
	else
	{
		$tr = $rs->RecordCount();
	}

	return $tr;
}

/**
 * 	Get Database Value
 */
function getv($field,$table,$where,$value) {
	global $db;

	$rs = $db->Execute("SELECT ".$field." FROM ".$table." WHERE ".$where."='".$value."'");
	if (!$rs)
	{
		return $db->ErrorMsg();
		die($db->ErrorMsg());
	}
	$retn = $rs->fields[0];
	return $retn;
}
function get_v($field,$table,$where) {
	global $db;

	$rs = $db->Execute("SELECT ".$field." FROM ".$table." WHERE ".$where."");
	if (!$rs)
	{
		return $db->ErrorMsg();
		die($db->ErrorMsg());
	}
	$retn = $rs->fields[0];
	return $retn;
}
function get_vv($field,$table,$where) {
	global $db;

	$rs = $db->Execute("SELECT ".$field." FROM ".$table." ".$where."");
	if (!$rs)
	{
		return $db->ErrorMsg();
		die($db->ErrorMsg());
	}
	$retn = $rs->fields[0];
	return $retn;
}
function selectdb($sql,$key,$field,$selected=null) {
	global $db;

	$rs = $db->Execute($sql);
	if (!$rs) {
		return '';
		die();
	}

	$data = '<option></option>';
	while ($row = $rs->FetchRow())
	{
		$datakey = $row[''.$key.''];
		if ($selected !== null) {
			$select = ($datakey == $selected) ? " selected":"";
		} else {
			$select = '';
		}

		$fieldView = replaceVariables($field, $row);
		$data .= '<option value="'.$row[''.$key.''].'"'.$select.'>'.$fieldView.'</option>';
	}
	
	return $data;
}

/**
 * 	Get Database Version & Size
 */
function getDatabaseVersion() {
	global $db;

	$r = $db->Execute("SELECT VERSION() AS VER");
	list($DBVersion) = $r->FetchRow();
	return $DBVersion;
}
function getDatabaseSize() {
	global $db, $config;
	
	$rs = $db->Execute("SHOW TABLE STATUS FROM ".$config->DatabaseName);
	$rk = $rs->RecordCount();
	
	while ($row = $rs->FetchRow())
	{
		$TotalData = $row['Data_length'];
		$TotalIndex  = $row['Index_length'];
		$Total = ($TotalData + $TotalIndex);
		$Total = ($Total / 1024);
		$Total = round($Total,3);
		$TotalSize += $Total;
	}	
	return number_format($TotalSize,2,".",",")." KB";
}
?>