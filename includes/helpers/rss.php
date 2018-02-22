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

function ReadRSS($url) {
	global $db, $config;

	if (empty($url)) {
		die();
	}

	$rdf = parse_url($url);
	$fp = fsockopen($rdf['host'], 80, $errno, $errstr, 15);
	if (!$fp) {
		$info = _RSSPROBLEM;
	}
	if ($fp) {
		# Title
		if (!ereg("http://", $url)) {
			$url = "http://$url";
		}
		$rssurl = eregi_replace("http://", "", $url);
		$rssurl = explode("/", $rssurl);
		$title = "http://$rssurl[0]";
		
		$info = "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
		$info .= "<tr><td colspan=\"2\" valign=\"middle\" class=\"border-bottom bold\">"._HEADLINES_FROM.": <a href=\"http://$rssurl[0]\" target=\"_blank\" title=\"$title\">$title</a></td></tr>";
		
		fputs($fp, "GET " . $rdf['path'] . "?" . $rdf['query'] . " HTTP/1.0\r\n");
		fputs($fp, "HOST: " . $rdf['host'] . "\r\n\r\n");
		$string	= "";
		while(!feof($fp)) {
			$pagetext = fgets($fp,300);
			$string .= chop($pagetext);
		}
		fputs($fp,"Connection: close\r\n\r\n");
		fclose($fp);
		$items = explode("</item>",$string);
		
		for ($i=0; $i<10; $i++) {
			
			$link = ereg_replace(".*<link>","",$items[$i]);
			$link = ereg_replace("</link>.*","",$link);
			$title2 = ereg_replace(".*<title>","",$items[$i]);
			$title2 = ereg_replace("</title>.*","",$title2);
			
			if (empty($items[$i]) AND $cont != 1) {
				$info .= _RSSPROBLEM;
			} else {
				if (strcmp($link,$title2) AND !empty($items[$i])) {
					$cont = 1;
					$info .= "<tr><td valign=\"middle\" align=\"center\" width=\"15\"><img src=\"".URL_IMAGES_THEMES."/rss.png\"></td><td valign=\"top\" class=\"lh1-5\">";
					$info .= "<a href=\"$link\" target=\"_blank\" title=\"$title2\">".html_entity_decode($title2)."</a>\n";
					$info .= "</td></tr>";
				}
			}
			
		}
		$info .= "</table><br />";
	}

	
	return $info;
}
?>