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

function getDomainFromEmail($email) {
	$domain = substr(strrchr($email, "@"), 1);
	return $domain;
}

function SendingMail($email,$subject,$message_plain,$message_html,$senderName=NULL,$senderMail=NULL,$MailPriority="normal",$AttachmentFile=NULL) {
	global $db, $config, $w_user;
	
	$Messages = "";
	$mailHeader = 'MIME-Version: 1.0' . "\r\n";
	$mailHeader .= 'X-Mailer: '. $config->WebSystem . "\r\n";
	$mailHeader .= 'Return-Path: '. $config->AdminMail ."\r\n";
	
	# Priority
	if ($MailPriority == "high") {
		$mailHeader .= 'X-Priority: 1' . "\r\n";
		$mailHeader .= 'X-MSMail-Priority: High' . "\r\n";
	} else if ($MailPriority == "low") {
		$mailHeader .= 'X-Priority: 5' . "\r\n";
		$mailHeader .= 'X-MSMail-Priority: Low' . "\r\n";
	} else {
		$mailHeader .= 'X-Priority: 3' . "\r\n";
		$mailHeader .= 'X-MSMail-Priority: Normal' . "\r\n";
	}

	# Attachment Content
	if ($AttachmentFile != '') {
		$MimeBoundary = "WebApps-".strtoupper(md5(time()));
		$mailHeader .= "Content-Type: multipart/mixed;
		boundary=\"Attach-$MimeBoundary\"\n";		
		$Messages .= "--Attach-$MimeBoundary\n";
		$Messages .= "Content-Type: multipart/alternative; boundary=\"Alt-$MimeBoundary\"\n";
		$AltMixed = "Alt-";
	} else {
		$MimeBoundary = "WebApps-".strtoupper(md5(time()));
		$mailHeader .= "Content-Type: multipart/alternative;
		boundary=\"$MimeBoundary\"\n";
		$AltMixed = "";
	}

	# Plain
	if ($message_plain != "") {
		$Messages .= "--$AltMixed$MimeBoundary\n";
		$Messages .= "Content-Type: text/plain; charset=\"UTF-8\"\n";
		$Messages .= "Content-Transfer-Encoding: 8bit\n";
		$Messages .= "\n".$message_plain."\n\n";
	}
	
	# HTML
	if ($message_html != "") {
		$Messages .= "--$AltMixed$MimeBoundary\n";
		$Messages .= "Content-Type: text/html; charset=\"UTF-8\"\n";
		$Messages .= "Content-Transfer-Encoding: 8bit\n";
		$Messages .= "\n".$message_html."\n\n";
	}
	
	# End Plain/HTML
	$Messages .= "--$AltMixed$MimeBoundary--\n\n";
	
	# Attachment
	if ($AttachmentFile != "") {
		list($AttachmentType,$AttachmentValue) = explode("|",$AttachmentFile);		
		if ($AttachmentType == "-") {
			// nothing
		} else {
			// File Attachment
		}
	}
	
	# Sender
	if (isset($senderName) || isset($senderMail)) {
		$mailHeader .= "From: ".$senderName." <".$senderMail.">" . "\r\n";
	} else {
		$mailHeader .= "From: ".$config->SiteName." <".$config->AdminMail.">" . "\r\n";
	}

	$sendMail = mail($email,$subject,$Messages,$mailHeader);
	if ($sendMail === true) {
		return true;
	} else {
		return false;
	}
}

function SendingMailSMTP($email,$cc=NULL,$bcc=NULL,$subject,$message_plain,$message_html,$senderName=NULL,$senderMail=NULL,$MailPriority="normal",$AttachmentFile=NULL) {
	global $db, $config, $w_user;
	
	$add_reply = false;

	$mail = new PHPMailer(true);
	$mail->SMTPDebug = $config->MailDebug;
	$mail->isSMTP();
	$mail->Username = $config->MailUser;
	$mail->Host = $config->MailHost;
	$mail->Port = $config->MailPort; 
	$mail->SMTPSecure = $config->MailSecure;
	$mail->SMTPAuth = true;

	$SenderData = explode('@', $senderMail);
	$SenderUser = $SenderData[0];
	$SenderDomain = $SenderData[1];

	if (strtolower($SenderUser) != 'no-reply') {
		$add_reply = true;
	}

	$mail->Password = $config->MailPwd;
	$mail->isHTML(true);
	$mail->SMTPKeepAlive = true;

	# Priority
	if ($MailPriority == "high") {
		$mail->Priority = 1;
	} else if ($MailPriority == "low") {
		$mail->Priority = 5;
	} else {
		$mail->Priority = 3;
	}

	# Sender
	if (isset($senderName) || isset($senderMail)) {
		if ($add_reply == true) {
			$mail->setFrom('no-reply@'.$config->SiteDomain, $senderName);
		} else {
			$mail->setFrom($senderMail, $senderName);
		}
	} else {
		$mail->setFrom($config->AdminMail, $config->SiteName);
	}

	# Add Reply To
	if ($add_reply == true) {
		$mail->addReplyTo($senderMail, $senderName);
	}

	# Sent To
	$email = explode(",", $email);
	for ($i=0; $i < count($email); $i++) { 
		$mail->addAddress($email[$i]);
	}

	# CC & BCC
	if (isset($cc)) {
		$cc = explode(",", $cc);
		for ($ic=0; $ic < count($cc); $ic++) { 
			$mail->addCC($cc[$ic]);
		}
	}
	if (isset($bcc)) {
		$bcc = explode(",", $bcc);
		for ($ibc=0; $ibc < count($bcc); $ibc++) { 
			$mail->addBCC($bcc[$ibc]);
		}
	}

	# Attachment
	if ($AttachmentFile != "")
	{
		list($AttachmentType,$AttachmentValue) = explode("|",$AttachmentFile);		
		if (strtoupper($AttachmentType) == "-")
		{
			//
		}
		else
		{
			// File Attachment
		}
	}

	$mail->Subject = $subject;
	$mail->Body    = $message_html;
	$mail->AltBody = $message_plain;

	try {
		$mail->send();
		return true;
	} catch (phpmailerException $e) {
		l('SENDMAIL','SendMail',$subject, $e->errorMessage());
		return false;
	} catch (Exception $e) {
		l('SENDMAIL','SendMail',$subject, $e->getMessage());
		return false;
	}
}

/**

	SEND EMAIL FUNCTIONS

*/
function SendEmail($to, $cc=NULL, $bcc=NULL, $subject, $template, $from, $priority="normal", $data = array(), $attachment=NULL) {
	global $db, $config;

	$Email_Subject = $subject;
	$fromName = $config->SiteName;
	
	# Load Template (Plain)
	$t = new Template;
	$t->Load(WEB_TEMPLATES."mail".DS.strtolower($template)."-plain.tpl");
	$t->Replace("Email_Subject",$Email_Subject);
	foreach ($data as $key => $value) {
		$t->Replace($key,$value);
	}
	$MsgPlain = $t->Evaluate("plain");
	
	# Load Template (HTML)
	$t2 = new Template;
	$t2->Load(WEB_TEMPLATES."mail".DS.strtolower($template)."-html.tpl");
	$t2->Replace("Email_Subject",$Email_Subject);
	foreach ($data as $key => $value) {
		$t2->Replace($key,$value);
	}
	$MsgHTML = $t2->Evaluate();

	if (SendingMailSMTP($to,$cc,$bcc,$Email_Subject,$MsgPlain,$MsgHTML,$fromName,$from,$priority,$attachment) == true) {
		return true;
	} else {
		return false;
	}
}
function SendEmailFrom($to, $cc=NULL, $bcc=NULL, $subject, $template, $fromName, $from, $priority="normal", $data = array(), $attachment=NULL) {
	global $db, $config;

	$Email_Subject = $subject;

	# Load Template (Plain)
	$t = new Template;
	$t->Load(WEB_TEMPLATES."mail".DS.strtolower($template)."-plain.tpl");
	$t->Replace("Email_Subject",$Email_Subject);
	foreach ($data as $key => $value) {
		$t->Replace($key,$value);
	}
	$MsgPlain = $t->Evaluate("plain");
	
	# Load Template (HTML)
	$t2 = new Template;
	$t2->Load(WEB_TEMPLATES."mail".DS.strtolower($template)."-html.tpl");
	$t2->Replace("Email_Subject",$Email_Subject);
	foreach ($data as $key => $value) {
		$t2->Replace($key,$value);
	}
	$MsgHTML = $t2->Evaluate();

	if (SendingMailSMTP($to,$cc,$bcc,$Email_Subject,$MsgPlain,$MsgHTML,$fromName,$from,$priority,$attachment) == true) {
		return true;
	} else {
		return false;
	}
}
?>