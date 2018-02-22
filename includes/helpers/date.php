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

# 0000-00-00 -> 00/00/0000
function FormatDate($date) {
	if ($date) {
		list($year,$month,$day) = explode("-",$date);
		return $day."/".$month."/".$year;
	} else {
		return '';
	}
}

# 0000-00-00 00:00:00 -> 00/00/0000 00:00:00
function FormatDateTime($date) {
	if ($date) {
		list($adate,$atime) = explode(" ",$date);
		return FormatDate($adate)." ".$atime;
	} else {
		return '';
	}
}

# 0000-00-00 00:00:00 -> 00/00/0000
function FormatDateTimeDate($date) {
	if ($date) {
		list($adate,$atime) = explode(" ",$date);
		return FormatDate($adate);
	} else {
		return '';
	}
}

# 00/00/0000 00:00 AM -> 0000-00-00 00:00:00
function FormatDateTimeToDB($date) {	
	if ($date) {
		list($day, $month, $year, $hour, $minute, $dayType) = preg_split('/[\/\s:]+/', $date); 
    	return $d1me = $year . '-' . $month. '-' .  $day . ' ' . ($dayType == "PM"?$hour+12: $hour) . ":" . $minute . ":00";
	} else {
		return '';
	}
}

#  00/00/0000 -> 0000-00-00
function FormatDateToDB($date) {
	if ($date) {
		list($day,$month,$year) = explode("/",$date);
		return $year."-".$month."-".$day;
	} else {
		return '';
	}
}

function getServerDate() {
	global $db;
	$r = $db->Execute("SELECT CURRENT_DATE() AS SVR_DATE");
	if (!$r) {
		echo $db->ErrorMsg();
	}
	$row = $r->FetchRow();
	
	return FormatDate($row['SVR_DATE']);
}

function getServerTime() {
	global $db;
	$r = $db->Execute("SELECT CURRENT_TIME() AS SVR_TIME");
	if (!$r) {
		die($db->ErrorMsg());
	}	
	return $r->fields['SVR_TIME'];
}

function getServerDateTime() {
	global $db;
	$r = $db->Execute("SELECT NOW() AS SvrDateTime");
	if (!$r) {
		die($db->ErrorMsg());
	}
	return $r->fields['SvrDateTime'];
}

function getServerDateTimeFormat() {
	global $db;
	$r = $db->Execute("SELECT DATE_FORMAT(NOW(),'%d/%m/%Y %h:%i:%s %p') AS SvrDateTime");
	if (!$r) {
		die($db->ErrorMsg());
	}
	return $r->fields['SvrDateTime'];
}

function getServerMonth() {
	global $db;
	$r = $db->Execute("SELECT MONTH(NOW()) AS SVR_MON");
	if (!$r) {
		die($db->ErrorMsg());
	}
	return $r->fields['SVR_MON'];
}

function getServerYear() {
	global $db;
	$r = $db->Execute("SELECT YEAR(NOW()) AS SVR_YEAR");
	if (!$r) {
		die($db->ErrorMsg());
	}
	return $r->fields['SVR_YEAR'];
}

/**
 * Get "now" time
 *
 * Returns time()
 *
 * @access	public
 * @return	integer
 */	
function now() {
	return time();
}
	
/**
 * Convert MySQL Style Datecodes
 *
 * This function is identical to PHPs date() function,
 * except that it allows date codes to be formatted using
 * the MySQL style, where each code letter is preceded
 * with a percent sign:  %Y %m %d etc...
 *
 * The benefit of doing dates this way is that you don't
 * have to worry about escaping your text letters that
 * match the date codes.
 *
 * @access	public
 * @param	string
 * @param	integer
 * @return	integer
 */	
function mdate($datestr = '', $time = '') {
	if ($datestr == '')
		return '';
	
	if ($time == '')
		$time = now();
		
	$datestr = str_replace('%\\', '', preg_replace("/([a-z]+?){1}/i", "\\\\\\1", $datestr));
	return date($datestr, $time);
}

/**
 * Standard Date
 *
 * Returns a date formatted according to the submitted standard.
 *
 * @access	public
 * @param	string	the chosen format
 * @param	integer	Unix timestamp
 * @return	string
 */	
function standard_date($fmt = 'DATE_RFC822', $time = '') {
	$formats = array(
					'DATE_ATOM'		=>	'%Y-%m-%dT%H:%i:%s%Q',
					'DATE_COOKIE'	=>	'%l, %d-%M-%y %H:%i:%s UTC',
					'DATE_ISO8601'	=>	'%Y-%m-%dT%H:%i:%s%O',
					'DATE_RFC822'	=>	'%D, %d %M %y %H:%i:%s %O',
					'DATE_RFC850'	=>	'%l, %d-%M-%y %H:%m:%i UTC',
					'DATE_RFC1036'	=>	'%D, %d %M %y %H:%i:%s %O',
					'DATE_RFC1123'	=>	'%D, %d %M %Y %H:%i:%s %O',
					'DATE_RSS'		=>	'%D, %d %M %Y %H:%i:%s %O',
					'DATE_W3C'		=>	'%Y-%m-%dT%H:%i:%s%Q'
					);

	if ( ! isset($formats[$fmt])) {
		return FALSE;
	}
	
	return mdate($formats[$fmt], $time);
}

/**
 * Number of days in a month
 *
 * Takes a month/year as input and returns the number of days
 * for the given month/year. Takes leap years into consideration.
 *
 * @access	public
 * @param	integer a numeric month
 * @param	integer	a numeric year
 * @return	integer
 */	
function days_in_month($month = 0, $year = '') {
	if ($month < 1 OR $month > 12) {
		return 0;
	}
	
	if ( ! is_numeric($year) OR strlen($year) != 4) {
		$year = date('Y');
	}
	
	if ($month == 2) {
		if ($year % 400 == 0 OR ($year % 4 == 0 AND $year % 100 != 0)) {
			return 29;
		}
	}

	$days_in_month	= array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
	return $days_in_month[$month - 1];
}
	
/**
 * Converts a local Unix timestamp to GMT
 *
 * @access	public
 * @param	integer Unix timestamp
 * @return	integer
 */	
function local_to_gmt($time = '') {
	if ($time == '')
		$time = time();
	
	return mktime( gmdate("H", $time), gmdate("i", $time), gmdate("s", $time), gmdate("m", $time), gmdate("d", $time), gmdate("Y", $time));
}
	
/**
 * Converts GMT time to a localized value
 *
 * Takes a Unix timestamp (in GMT) as input, and returns
 * at the local value based on the timezone and DST setting
 * submitted
 *
 * @access	public
 * @param	integer Unix timestamp
 * @param	string	timezone
 * @param	bool	whether DST is active
 * @return	integer
 */	
function gmt_to_local($time = '', $timezone = 'UTC', $dst = FALSE) {
	if ($time == '') {
		return now();
	}
	
	$time += timezones($timezone) * 3600;

	if ($dst == TRUE) {
		$time += 3600;
	}
	
	return $time;
}
	
/**
 * Converts a MySQL Timestamp to Unix
 *
 * @access	public
 * @param	integer Unix timestamp
 * @return	integer
 */	
function mysql_to_unix($time = '') {
	// We'll remove certain characters for backward compatibility
	// since the formatting changed with MySQL 4.1
	// YYYY-MM-DD HH:MM:SS
	
	$time = str_replace('-', '', $time);
	$time = str_replace(':', '', $time);
	$time = str_replace(' ', '', $time);
	
	// YYYYMMDDHHMMSS
	return  mktime(
					substr($time, 8, 2),
					substr($time, 10, 2),
					substr($time, 12, 2),
					substr($time, 4, 2),
					substr($time, 6, 2),
					substr($time, 0, 4)
					);
}
	
/**
 * Unix to "Human"
 *
 * Formats Unix timestamp to the following prototype: 2006-08-21 11:35 PM
 *
 * @access	public
 * @param	integer Unix timestamp
 * @param	bool	whether to show seconds
 * @param	string	format: us or euro
 * @return	string
 */	
function unix_to_human($time = '', $seconds = FALSE, $fmt = 'us') {
	$r  = date('Y', $time).'-'.date('m', $time).'-'.date('d', $time).' ';
		
	if ($fmt == 'us') {
		$r .= date('h', $time).':'.date('i', $time);
	} else {
		$r .= date('H', $time).':'.date('i', $time);
	}
	
	if ($seconds) {
		$r .= ':'.date('s', $time);
	}
	
	if ($fmt == 'us') {
		$r .= ' '.date('A', $time);
	}

	return $r;
}
	
/**
 * Convert "human" date to GMT
 *
 * Reverses the above process
 *
 * @access	public
 * @param	string	format: us or euro
 * @return	integer
 */	
function human_to_unix($datestr = '') {
	if ($datestr == '') {
		return FALSE;
	}
	
	$datestr = trim($datestr);
	$datestr = preg_replace("/\040+/", "\040", $datestr);

	if ( ! ereg("^[0-9]{2,4}\-[0-9]{1,2}\-[0-9]{1,2}\040[0-9]{1,2}:[0-9]{1,2}.*$", $datestr)) {
		return FALSE;
	}

	$split = preg_split("/\040/", $datestr);

	$ex = explode("-", $split['0']);
	
	$year  = (strlen($ex['0']) == 2) ? '20'.$ex['0'] : $ex['0'];
	$month = (strlen($ex['1']) == 1) ? '0'.$ex['1']  : $ex['1'];
	$day   = (strlen($ex['2']) == 1) ? '0'.$ex['2']  : $ex['2'];

	$ex = explode(":", $split['1']);
	
	$hour = (strlen($ex['0']) == 1) ? '0'.$ex['0'] : $ex['0'];
	$min  = (strlen($ex['1']) == 1) ? '0'.$ex['1'] : $ex['1'];

	if (isset($ex['2']) AND ereg("[0-9]{1,2}", $ex['2'])) {
		$sec  = (strlen($ex['2']) == 1) ? '0'.$ex['2'] : $ex['2'];
	} else {
		// Unless specified, seconds get set to zero.
		$sec = '00';
	}
	
	if (isset($split['2'])) {
		$ampm = strtolower($split['2']);
		
		if (substr($ampm, 0, 1) == 'p' AND $hour < 12)
			$hour = $hour + 12;
			
		if (substr($ampm, 0, 1) == 'a' AND $hour == 12)
			$hour =  '00';
			
		if (strlen($hour) == 1)
			$hour = '0'.$hour;
	}
			
	return mktime($hour, $min, $sec, $month, $day, $year);
}
	
/**
 * Timezone Menu
 *
 * Generates a drop-down menu of timezones.
 *
 * @access	public
 * @param	string	timezone
 * @param	string	classname
 * @param	string	menu name
 * @return	string
 */	
function timezone_menu($default = 'UTC', $class = "", $name = 'timezones') {
	if ($default == 'GMT')
		$default = 'UTC';

	$menu = '<select name="'.$name.'"';
	
	if ($class != '') {
		$menu .= ' class="'.$class.'"';
	}
	
	$menu .= ">\n";
	
	foreach (timezones() as $key => $val) {
		$selected = ($default == $key) ? " selected='selected'" : '';
		$menu .= "<option value='{$key}'{$selected}>".$key."</option>\n";
	}

	$menu .= "</select>";

	return $menu;
}
	
/**
 * Timezones
 *
 * Returns an array of timezones.  This is a helper function
 * for various other ones in this library
 *
 * @access	public
 * @param	string	timezone
 * @return	string
 */	
function timezones($tz = '') {
	// Note: Don't change the order of these even though
	// some items appear to be in the wrong order
		
	$zones = array(
					'UM12' => -12,
					'UM11' => -11,
					'UM10' => -10,
					'UM9'  => -9,
					'UM8'  => -8,
					'UM7'  => -7,
					'UM6'  => -6,
					'UM5'  => -5,
					'UM4'  => -4,
					'UM25' => -2.5,
					'UM3'  => -3,
					'UM2'  => -2,
					'UM1'  => -1,
					'UTC'  => 0,
					'UP1'  => +1,
					'UP2'  => +2,
					'UP3'  => +3,
					'UP25' => +2.5,
					'UP4'  => +4,
					'UP35' => +3.5,
					'UP5'  => +5,
					'UP45' => +4.5,
					'UP6'  => +6,
					'UP7'  => +7,
					'UP8'  => +8,
					'UP9'  => +9,
					'UP85' => +8.5,
					'UP10' => +10,
					'UP11' => +11,
					'UP12' => +12
				);
				
	if ($tz == '') {
		return $zones;
	}
	
	if ($tz == 'GMT')
		$tz = 'UTC';
	
	return ( ! isset($zones[$tz])) ? 0 : $zones[$tz];
}

# Format: dd/mm/yyyy
function getAge($date) {
	list($day,$month,$year) = explode("/",$date);
	$year_diff  = date("Y") - $year;
	$month_diff = date("m") - $month;
	$day_diff   = date("d") - $day;

	return $year_diff;
}

function monthReplace($MonthNo) {
	$MonthNo = intval($MonthNo);
	
	if ($MonthNo == 1) {
		$ret = _JANUARY;
	} else if ($MonthNo == 2) {
		$ret = _FEBRUARY;
	} else if ($MonthNo == 3) {
		$ret = _MARCH;
	} else if ($MonthNo == 4) {
		$ret = _APRIL;
	} else if ($MonthNo == 5) {
		$ret = _MAY;
	} else if ($MonthNo == 6) {
		$ret = _JUNE;
	} else if ($MonthNo == 7) {
		$ret = _JULY;
	} else if ($MonthNo == 8) {
		$ret = _AUGUST;
	} else if ($MonthNo == 9) {
		$ret = _SEPTEMBER;
	} else if ($MonthNo == 10) {
		$ret = _OCTOBER;
	} else if ($MonthNo == 11) {
		$ret = _NOVEMBER;
	} else if ($MonthNo == 12) {
		$ret = _DECEMBER;
	}
	return $ret;
}

# Format: yyyy-mm-yy -> dd Month Year
function FormatDateMonth($date) {
	list($year,$month,$day) = explode("-",$date);
	$ret = $day." ".monthReplace($month)." ".$year;
	return $ret;
}

/*
 *	Format : yyyy-mm-dd hh:mm:ss
 */
function NiceTime($date) {
	global $config;
	
	if (empty($date)) {
		return "-";
    }
   
	if (strtolower($config->getLanguage()) == "ms") {
		$periods = array("saat", "minit", "jam", "hari", "minggu", "bulan", "tahun", "dekat");
		$atense = "lepas";
	} else if (strtolower($config->getLanguage()) == "en") {
		$periods = array("seconds", "minutes", "hour", "days", "weeks", "months", "years", "decades");		
		$atense = "ago";
	}
	$lengths = array("60","60","24","7","4.35","12","10");
	$now = time();
	$unix_date = strtotime($date);

	// check validity of date
	if (empty($unix_date)) {   
		return "-";
	}

	// is it future date or past date
	if ($now > $unix_date) {   
		$difference = $now - $unix_date;
		$tense = $atense;
	} else {
		$difference = $unix_date - $now;
		$tense = "";
	}

	for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
		$difference /= $lengths[$j];
	}

	$difference = round($difference);

	if ($difference != 1) {
		$periods[$j].= "";
	}

	if ($periods[$j] == "saat" || $periods[$j] == "seconds") {
		if ($difference < 5) {
			return _JUST_NOW;
		} else {
			return "$difference $periods[$j] {$tense}";
		}
	} else {
		return "$difference $periods[$j] {$tense}";
	}
}

function format_interval(DateInterval $interval) {
    $result = "";
    if ($interval->y) { $result .= $interval->format("%y "._YEARS." "); }
    if ($interval->m) { $result .= $interval->format("%m "._MONTHS." "); }
    if ($interval->d) { $result .= $interval->format("%d "._DAYS." "); }
    if ($interval->h) { $result .= $interval->format("%h "._HOURS." "); }
    if ($interval->i) { $result .= $interval->format("%i "._MINUTES." "); }
    if ($interval->s) { $result .= $interval->format("%s "._SECONDS." "); }
    return $result;
}
?>