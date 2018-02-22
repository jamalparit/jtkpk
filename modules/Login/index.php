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

if (!defined('MODULE')) { die("No Access"); }
require_once(WEB_ROOT.DS."global.php");

function Login() {
	global $config, $db, $jquery, $w_user, $captcha;
	define('FULLBODY', true);
	define('LIB.FORMS', true);

	# LoginID (EMAIL | ID)
	$_LOGINID = ($config->LoginID == 'EMAIL') ? _EMAIL:_LOGINID;

	# reCAPTCHA
	if ($config->SecurityCheck == true)
	{
		if (strlen($config->GoogleCaptchaKey) != 0)
		{
			$captcha = array('captcha-register','captcha-login');
			$_SECURITY = '<center><div id="captcha-login"></div></center>';
			$_SECURITY_REGISTER = '<center><div id="captcha-register"></div></center>';
		}
		else
		{
			if (extension_loaded('gd'))
			{
				mt_srand ((double)microtime()*1000000);
				$maxran = 1000000;
				$_SecCode = mt_rand(0, $maxran);
				$_SECURITY = '
            	<center><img src="/?gx=gxl&num='.$_SecCode.'" class="push-20"></center>
            	<input type="hidden" name="_num" id="_num" value="'.$_SecCode.'">
				<div class="form-group">
                    <div class="col-xs-12">
                        <div class="form-material form-material-primary floating">
                            <input class="form-control" type="text" id="_sec" name="_sec">
                            <label for="_sec">'._SECURITY_CODE.' :</label>
                        </div>
                    </div>
                </div>';
                $_SECURITY_REGISTER = '
            	<img src="/?gx=gxl&num='.$_SecCode.'" class="push-10">
            	<input type="hidden" name="_num_register" id="_num_register" value="'.$_SecCode.'">
				<div class="form-group">
                    <label for="_sec">'._SECURITY_CODE.' :</label>
                    <input class="form-control" type="text" id="_sec_register" name="_sec_register" maxlength="255">
                </div>';
			}
			else
			{
				$_SECURITY = '<div class="alert alert-danger text-center"><i class="fa fa-exclamation push-10-r"></i>'._ENABLE_GD_EXTENSION.'</div>';
				$_SECURITY_REGISTER = '<div class="alert alert-danger text-center"><i class="fa fa-exclamation push-10-r"></i>'._ENABLE_GD_EXTENSION.'</div>';
			}
		}
	}

	# Registration Dialog
	if ($config->AllowRegister == true)
	{
		$tr = new Template;
		$tr->Load(WEB_TEMPLATES."system".DS."dialog-register.tpl");
		$tr->Replace('LOGIN_ID', $_LOGINID);
		$tr->Replace('SECURITY', $_SECURITY_REGISTER);
		$DialogRegister = $tr->Evaluate();

		$BtnRegister = '<button id="btn-reg" class="btn btn-success" type="button" onclick="javascript:Register();">
            <i class="fa fa-user pull-right"></i>'._REGISTER.'
        </button>';
	}

	# Autofocus
	$jquery = "$('#loginid').focus();";

	# Img Logo
	if (file_exists(WEB_IMAGES."logo.png")) {
		$_IMG_LOGO = '<a href="'.SITEURL.'"><img src="'.URL_IMAGES.'/logo.png" width="50%"></a>';
	} else if (file_exists(WEB_IMAGES."logo.jpg")) {
		$_IMG_LOGO = '<a href="'.SITEURL.'"><img src="'.URL_IMAGES.'/logo.jpg" width="50%"></a>';
	} else {
		$_IMG_LOGO = '';
	}

	include(WEB_INCLUDES."header.php");
	$t = new Template;
	$t->Load(WEB_TEMPLATES."system".DS."login.tpl");
	$t->Replace('DIALOG_REGISTER', $DialogRegister);
	$t->Replace('LOGIN_ID', $_LOGINID);
	$t->Replace('BTN_REGISTER', $BtnRegister);
	$t->Replace('IMG_LOGO', $_IMG_LOGO);
	$t->Replace('SECURITY', $_SECURITY);
	$t->Replace('COPYRIGHT', sprintf(_COPYRIGHT_FOOTER,YEAR,SITENAME));
	$t->Publish();
	include(WEB_INCLUDES."footer.php");
}

#-------------------------------------------------
if (!empty($_REQUEST['p'])) { $p = $_REQUEST['p']; }
switch ($p)
{
	default:
		Login();
	break;
}
?>