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

class Template {
   	public $template;
   
   	function Load($filepath) {
      	$this->template = file_get_contents($filepath);
   	}
   
   	function Replace($var, $content) {
     	$this->template = str_replace("#$var#", $content, $this->template);
   	}
   
   	function Publish() {
		# Replace {D_DEFINE}
		preg_match_all('#\{D_([A-Z0-9\-_]+)\}#', $this->template, $matches2, PREG_SET_ORDER);
		foreach ($matches2 as $val2) {
			$value2 = substr($val2[0],3,-1);
			$this->template = str_replace($val2[0], "<?php echo ".$value2."; ?>", $this->template);
		}
		
		# Replace {S_DEFINE}
		preg_match_all('#\{S_([A-Z0-9\-_]+)\}#', $this->template, $matches_s, PREG_SET_ORDER);
		foreach ($matches_s as $val_s) {
			$value_s = substr($val_s[0],3,-1);
			$this->template = str_replace($val_s[0], "<?php echo removeslashes(_".$value_s."); ?>", $this->template);
		}
		
		# Replace {DEFINE}
		preg_match_all('#\{([A-Z0-9\-_]+)\}#', $this->template, $matches, PREG_SET_ORDER);
		foreach ($matches as $val) {
			$value = "_".substr($val[0],1,-1);
			$this->template = str_replace($val[0], "<?php echo ".$value."; ?>", $this->template);
		}
				
		eval('?>'.$this->template);
   	}	
	
   	function Evaluate($plain=NULL) {
		# Replace {D_DEFINE}
		preg_match_all('#\{D_([A-Z0-9\-_]+)\}#', $this->template, $matches2, PREG_SET_ORDER);
		foreach ($matches2 as $val2) {
			$value2 = substr($val2[0],3,-1);
			eval('$value2 = '.$value2.';');
			$this->template = str_replace($val2[0], $value2, $this->template);
		}
		
		# Replace {S_DEFINE}
		preg_match_all('#\{S_([A-Z0-9\-_]+)\}#', $this->template, $matches_s, PREG_SET_ORDER);
		foreach ($matches_s as $val_s) {
			$value_s = substr($val_s[0],3,-1);
			eval('$value_s = _'.$value_s.';');
			$this->template = str_replace($val_s[0], removeslashes($value_s), $this->template);
		}

		# Replace {DEFINE}
		preg_match_all('#\{([A-Z0-9\-_]+)\}#', $this->template, $matches, PREG_SET_ORDER);
		foreach ($matches as $val) {
			$value = "_".substr($val[0],1,-1);
			eval('$value = '.$value.';');
			$this->template = str_replace($val[0], $value, $this->template);
		}
		
		if ($plain != NULL) {
			# <br> -> new line
			preg_match_all('#<br[^>]*>#is', $this->template, $matches_br, PREG_SET_ORDER);
			foreach ($matches_br as $val_br) {
				$this->template = str_replace($val_br[0], "\n", $this->template);
			}
			
			// HTML -> Text
			preg_match_all('#<[^>]*>#is', $this->template, $matches_all, PREG_SET_ORDER);
			foreach ($matches_all as $val_all) {
				$this->template = str_replace($val_all[0], "", $this->template);
			}			
		}

		return $this->template;
   	}	
}

function EvaluateTemplate($subject, $template, $format, $data = array()) {
	global $db, $config;

	$t = new Template;
	if (strtolower($format) == 'plain')
	{
		$t->Load(WEB_TEMPLATES.strtolower($template)."-plain.tpl");
	}
	else
	{
		$t->Load(WEB_TEMPLATES.strtolower($template)."-html.tpl");
	}
	
	$t->Replace("Email_Subject",$subject);
	foreach ($data as $key => $value)
	{
		$t->Replace($key,$value);
	}
	
	if (strtolower($format) == 'plain')
	{
		$MsgReturn = $t->Evaluate('plain');
	}
	else
	{
		$MsgReturn = $t->Evaluate();
	}

	return $MsgReturn;	
}
?>