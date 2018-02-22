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

use Emojione\Emojione;

# Get numbers only even have words
function filter_num($s) {
	return preg_replace("/[^0-9]+/i", "", html_entity_decode($s, ENT_QUOTES));
}

# Get Boolean 1,0 or true,false
function filter_bool($s,$reverse=NULL) {
	if ($reverse != NULL)
	{
		if (!empty($s)) {
			$s = "true";
		} else {
			$s = "false";
		}
	}
	else
	{
		$s = ($s == "true") ? 1 : 0;
	}
	return $s;
}

# Get Email if valid, else return nothing
function filter_email($s) {
	return filter_var($s, FILTER_VALIDATE_EMAIL);
}

# Clean text [a-z A-Z 0-9 - . [space]] - Searching
function cleantxt($txt) {
	$txt = str_replace('+','', $txt);
	$txt = preg_replace('/[^a-zA-Z0-9-. ]/i', '', $txt); // Removes special chars.
	$txt = str_replace(' ','+', $txt);
   	return $txt;
}
function cleantxt_query($txt) {
	$txt = preg_replace('/[^a-zA-Z0-9-. ]/i', '', $txt); // Removes special chars.
   	return $txt;
}
function remove_quotes($s) {
    $result = trim($s);
    $result = str_replace('"', '', $result);
    $result = str_replace('&quot;', '', $result);
    $result = str_replace("'", '', $result);
    $result = str_replace("&#039;", '', $result);
    return $result;
}
function return_ajax_html($txt) {
	$txt = preg_replace('/^\s+|\n|\r|\s+$/m',' ',addslashes($txt));
	return $txt;
}
function trim_nospaces($s) {
	$s = preg_replace('/\s+/', '', $s);
	return $s;
}
function trim_newlines($s) {
	$s = strip_tags($s,"<br>");
	$s = strip_tags($s,"<br />");
	$s = str_replace("\n", " ", $s);
	$s = preg_replace('/\s+/', ' ', $s);
	return $s;
}

function filter_txt($s) {
	$s = trim($s); // trim [start] and [end] white spaces
	$s = nl2br($s); // new line to <br />
	$s = preg_replace('/\s+/', ' ', $s); // remove extra spaces
	$s = htmlentities($s, ENT_QUOTES); // encode html
	return $s;
}

function filter_decode($s, $mode = NULL, $emoticons = false, $codes = false) {
	$mode = strtolower($mode);

	if ($mode == NULL || $mode == "view")
	{
		$s = html_entity_decode($s, ENT_QUOTES);
	}
	else if ($mode == "no-html")
	{
		$s = html_entity_decode($s, ENT_QUOTES);
		//$s = htmlentities($s, ENT_QUOTES); // html2txt
		$s = strip_tags($s,'<code><br>');
	}
	else if ($mode == "view-trim")
	{
		$s = html_entity_decode($s, ENT_QUOTES);
		$s = strip_tags($s);
	}
	else if ($mode == "edit-input")
	{
		$s = html_entity_decode($s, ENT_QUOTES);
		$s = str_replace("<br />","",$s);
		$s = preg_replace('/\s+/', ' ', $s);
		$s = htmlentities($s, ENT_QUOTES); // html2txt
	}
	else if ($mode == "edit-input-ajax")
	{
		$s = html_entity_decode($s, ENT_QUOTES);
		$s = addslashes($s);
	}
	else if ($mode == "edit-textarea")
	{
		$s = html_entity_decode($s, ENT_QUOTES);
		$s = str_replace("<br /> ",'\n',$s);
		$s = htmlentities($s, ENT_QUOTES); // html2txt
	}

	/**
		CONVERT <CODES>
	*/
	if ($codes == true) {
		$s = render_codes($s);
	}

	/**
		CONVERT EMOJIS
	*/
	if ($emoticons == true) {
		$client = new \Emojione\Client(new \Emojione\Ruleset());
		$s = $client->toImage($s);
	}

	return $s;
}

/**
	Codes
*/
function str_replace_first($from, $to, $subject)
{
    $from = '/'.preg_quote($from, '/').'/';
    return preg_replace($from, $to, $subject, 1);
}
function render_codes($s) {
	$pattern = '/\[(.*?)\](.*?)\[\/(.*?)\]/is'; // [php] code [/php]
	
	$s = preg_replace_callback($pattern,
		function($m) {
			$_m = html_entity_decode($m[2], ENT_QUOTES);
			$_m = preg_replace('/^(<br \/> )/', '', $_m);
			$_m = preg_replace('/(<br \/> )+$/', '', $_m);
			$_m = htmlentities($_m, ENT_QUOTES);
			$_m = str_replace('&lt;br /&gt; ', '<br />', $_m);
			$_m = str_replace('&#039;', "'", $_m);
			return "<pre class=\"pre-sh text-left\"><code class=\"".$m[1]."\">".$_m."</code></pre>";
		}
	,$s);

	return $s;
}

/**
 * Word Limiter
 *
 * Limits a string to X number of words.
 *
 * @access	public
 * @param	string
 * @param	integer
 * @param	string	the end character. Usually an ellipsis
 * @return	string
 */	
function word_limiter($str, $n = 100, $end_char = '&#8230;') {
	if (strlen($str) < $n) {
		return $str;
	}
	
	$words = explode(' ', preg_replace("/\s+/", ' ', preg_replace("/(\r\n|\r|\n)/", " ", $str)));
	
	if (count($words) <= $n) {
		return $str;
	}
			
	$str = '';
	for ($i = 0; $i < $n; $i++) {
		$str .= $words[$i].' ';
	}

	return trim($str).$end_char;
}
	
/**
 * Character Limiter
 *
 * Limits the string based on the character count.  Preserves complete words
 * so the character count may not be exactly as specified.
 *
 * @access	public
 * @param	string
 * @param	integer
 * @param	string	the end character. Usually an ellipsis
 * @return	string
 */	
function character_limiter($str, $n = 500, $end_char = '&#8230;') {
	if (strlen($str) < $n) {
		return $str;
	}
		
	$str = preg_replace("/\s+/", ' ', preg_replace("/(\r\n|\r|\n)/", " ", $str));

	if (strlen($str) <= $n) {
		return $str;
	}
									
	$out = "";
	foreach (explode(' ', trim($str)) as $val) {
		$out .= $val.' ';			
		if (strlen($out) >= $n) {
			return trim($out).$end_char;
		}		
	}
}

/**
 * High ASCII to Entities
 *
 * Converts High ascii text and MS Word special characters to character entities
 *
 * @access	public
 * @param	string
 * @return	string
 */	
function ascii_to_entities($str) {
   $count	= 1;
   $out	= '';
   $temp	= array();
	
   for ($i = 0, $s = strlen($str); $i < $s; $i++) {
	   $ordinal = ord($str[$i]);
	
	   if ($ordinal < 128) {
		   $out .= $str[$i];
	   } else {
		   if (count($temp) == 0) {
			   $count = ($ordinal < 224) ? 2 : 3;
		   }
		
		   $temp[] = $ordinal;
		
		   if (count($temp) == $count) {
			   $number = ($count == 3) ? (($temp['0'] % 16) * 4096) + (($temp['1'] % 64) * 64) + ($temp['2'] % 64) : (($temp['0'] % 32) * 64) + ($temp['1'] % 64);

			   $out .= '&#'.$number.';';
			   $count = 1;
			   $temp = array();
		   }
	   }
   }

   return $out;
}

/**
 * Entities to ASCII
 *
 * Converts character entities back to ASCII
 *
 * @access	public
 * @param	string
 * @param	bool
 * @return	string
 */	
function entities_to_ascii($str, $all = TRUE) {
   if (preg_match_all('/\&#(\d+)\;/', $str, $matches)) {
	   for ($i = 0, $s = count($matches['0']); $i < $s; $i++) {
		   $digits = $matches['1'][$i];

		   $out = '';

		   if ($digits < 128) {
			   $out .= chr($digits);
		   } elseif ($digits < 2048) {
			   $out .= chr(192 + (($digits - ($digits % 64)) / 64));
			   $out .= chr(128 + ($digits % 64));
		   } else {
			   $out .= chr(224 + (($digits - ($digits % 4096)) / 4096));
			   $out .= chr(128 + ((($digits % 4096) - ($digits % 64)) / 64));
			   $out .= chr(128 + ($digits % 64));
		   }
		   
		   $str = str_replace($matches['0'][$i], $out, $str);				
	   }
   }

   if ($all) {
	   $str = str_replace(array("&amp;", "&lt;", "&gt;", "&quot;", "&apos;", "&#45;"),
						  array("&","<",">","\"", "'", "-"),
						  $str);
   }

   return $str;
}
	
/**
 * Word Censoring Function
 *
 * Supply a string and an array of disallowed words and any
 * matched words will be converted to #### or to the replacement
 * word you've submitted.
 *
 * @access	public
 * @param	string	the text string
 * @param	string	the array of censoered words
 * @param	string	the optional replacement value
 * @return	string
 */	
function word_censor($str, $censored, $replacement = '') {
	if ( ! is_array($censored)) {
		return $str;
	}

	$str = ' '.$str.' ';
	foreach ($censored as $badword) {
		if ($replacement != '') {
			$str = preg_replace("/\b(".str_replace('\*', '\w*?', preg_quote($badword)).")\b/i", $replacement, $str);
		} else {
			$str = preg_replace("/\b(".str_replace('\*', '\w*?', preg_quote($badword)).")\b/ie", "str_repeat('#', strlen('\\1'))", $str);
		}
	}
	
	return trim($str);
}
	
/**
 * Code Highlighter
 *
 * Colorizes code strings
 *
 * @access	public
 * @param	string	the text string
 * @return	string
 */	
function highlight_code($str) {		
	// The highlight string function encodes and highlights
	// brackets so we need them to start raw
	$str = str_replace(array('&lt;', '&gt;'), array('<', '>'), $str);
	
	// Replace any existing PHP tags to temporary markers so they don't accidentally
	// break the string out of PHP, and thus, thwart the highlighting.
	
	$str = str_replace(array('&lt;?php', '?&gt;',  '\\'), array('phptagopen', 'phptagclose', 'backslashtmp'), $str);
		
	// The highlight_string function requires that the text be surrounded
	// by PHP tags.  Since we don't know if A) the submitted text has PHP tags,
	// or B) whether the PHP tags enclose the entire string, we will add our
	// own PHP tags around the string along with some markers to make replacement easier later
	
	$str = '<?php //tempstart'."\n".$str.'//tempend ?>';
	
	// All the magic happens here, baby!
	$str = highlight_string($str, TRUE);

	// Prior to PHP 5, the highlight function used icky font tags
	// so we'll replace them with span tags.	
	if (abs(phpversion()) < 5) {
		$str = str_replace(array('<font ', '</font>'), array('<span ', '</span>'), $str);
		$str = preg_replace('#color="(.*?)"#', 'style="color: \\1"', $str);
	}
	
	// Remove our artificially added PHP
	$str = preg_replace("#\<code\>.+?//tempstart\<br />\</span\>#is", "<code>\n", $str);
	$str = preg_replace("#\<code\>.+?//tempstart\<br />#is", "<code>\n", $str);
	$str = preg_replace("#//tempend.+#is", "</span>\n</code>", $str);
	
	// Replace our markers back to PHP tags.
	$str = str_replace(array('phptagopen', 'phptagclose', 'backslashtmp'), array('&lt;?php', '?&gt;', '\\'), $str); //<?
				
	return $str;
}
	
/**
 * Phrase Highlighter
 *
 * Highlights a phrase within a text string
 *
 * @access	public
 * @param	string	the text string
 * @param	string	the phrase you'd like to highlight
 * @param	string	the openging tag to precede the phrase with
 * @param	string	the closing tag to end the phrase with
 * @return	string
 */	
function highlight_phrase($str, $phrase, $tag_open = '<strong>', $tag_close = '</strong>') {
	if ($str == '') {
		return '';
	}
	
	if ($phrase != '') {
		return preg_replace('/('.preg_quote($phrase).')/i', $tag_open."\\1".$tag_close, $str);
	}

	return $str;
}
	
/**
 * Word Wrap
 *
 * Wraps text at the specified character.  Maintains the integrity of words.
 * Anything placed between {unwrap}{/unwrap} will not be word wrapped, nor
 * will URLs.
 *
 * @access	public
 * @param	string	the text string
 * @param	integer	the number of characters to wrap at
 * @return	string
 */	
function word_wrap($str, $charlim = '76') {
	// Se the character limit
	if ( ! is_numeric($charlim))
		$charlim = 76;
	
	// Reduce multiple spaces
	$str = preg_replace("| +|", " ", $str);
	
	// Standardize newlines
	$str = preg_replace("/\r\n|\r/", "\n", $str);
	
	// If the current word is surrounded by {unwrap} tags we'll 
	// strip the entire chunk and replace it with a marker.
	$unwrap = array();
	if (preg_match_all("|(\{unwrap\}.+?\{/unwrap\})|s", $str, $matches)) {
		for ($i = 0; $i < count($matches['0']); $i++) {
			$unwrap[] = $matches['1'][$i];				
			$str = str_replace($matches['1'][$i], "{{unwrapped".$i."}}", $str);
		}
	}
	
	// Use PHP's native function to do the initial wordwrap.  
	// We set the cut flag to FALSE so that any individual words that are 
	// too long get left alone.  In the next step we'll deal with them.
	$str = wordwrap($str, $charlim, "\n", FALSE);
	
	// Split the string into individual lines of text and cycle through them
	$output = "";
	foreach (explode("\n", $str) as $line) {
		// Is the line within the allowed character count?
		// If so we'll join it to the output and continue
		if (strlen($line) <= $charlim) {
			$output .= $line."\n";			
			continue;
		}
			
		$temp = '';
		while((strlen($line)) > $charlim) {
			// If the over-length word is a URL we won't wrap it
			if (preg_match("!\[url.+\]|://|wwww.!", $line)) {
				break;
			}

			// Trim the word down
			$temp .= substr($line, 0, $charlim-1);
			$line = substr($line, $charlim-1);
		}
		
		// If $temp contains data it means we had to split up an over-length 
		// word into smaller chunks so we'll add it back to our current line
		if ($temp != '') {
			$output .= $temp.$this->newline.$line;
		} else {
			$output .= $line;
		}

		$output .= "\n";
	}

	// Put our markers back
	if (count($unwrap) > 0) {	
		foreach ($unwrap as $key => $val) {
			$output = str_replace("{{unwrapped".$key."}}", $val, $output);
		}
	}

	// Remove the unwrap tags
	$output = str_replace(array('{unwrap}', '{/unwrap}'), '', $output);

	return $output;	
}

function trimall($str, $charlist = "\t\n\r\0\x0B") {
  return str_replace(str_split($charlist), '', $str);
}

function EncodeHTML($sHTML) {
	$sHTML = addslashes($sHTML);
	$sHTML = ereg_replace("&","&amp;",$sHTML);
    $sHTML = ereg_replace("<","&lt;",$sHTML);
    $sHTML = ereg_replace(">","&gt;",$sHTML);
    return $sHTML;
}

function DecodeHTML($sHTML) {
	$sHTML = TrimAll($sHTML); // trim
    $sHTML = ereg_replace("&amp;","&",$sHTML);
    $sHTML = ereg_replace("&lt;","<",$sHTML);
    $sHTML = ereg_replace("&gt;",">",$sHTML);
    return $sHTML;
}

function html2txt($txt) {
	$txt = str_replace("&","&amp;",$txt);
    $txt = str_replace("<","&lt;",$txt);
    $txt = str_replace(">","&gt;",$txt);
    $txt = str_replace("&lt;br /&gt;","<br />",$txt);
	return $txt;
}

function StripBBCode($txt) {
	$pattern = '|[[\/\!]*?[^\[\]]*?]|si';
	$replace = '';
 	return preg_replace($pattern, $replace, $txt);
}

function ShowSource($filecode,$fileorstring,$withLineNums=false) {
	ini_set('highlight.html', '000000');
	ini_set('highlight.default', '#800000');
	ini_set('highlight.keyword','#0000ff');
	ini_set('highlight.string', '#ff00ff');
	ini_set('highlight.comment','#008000');

	if (strtolower($fileorstring) == "string") {
		if (!($source = @highlight_string($filecode,true))) { return 'Operation Failed'; }
	} else {
		if (!($source = @highlight_file($filecode,true))) {	return 'Operation Failed'; }
	}
	$source = explode("<br />", $source);

	$ln = 1;	
	$txt = "<p class=\"code\">";
	foreach( $source as $line ) {
		$txt .= "<code>";
		if ($withLineNums) {
			$txt .= "<font color=\"#aaaaaa\">";
			$txt .= str_replace( ' ', '&nbsp;', sprintf( "%4d:", $ln ) );
			$txt .= "</font>";
		}
		$txt .= "$line<br /><code>";
		$ln++;
	}
	$txt .= "</p>";
	return $txt;
}
?>