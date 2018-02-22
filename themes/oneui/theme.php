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
require_once(WEB_ROOT.DS."global.php");

function ThemesHeader() {
	global $config, $user, $db, $cookie, $locale, $w_user, $body, $pagetitle, $page_description, $cssload, $module_name, $captcha, $meta, $author;
	$module_name = strtolower(MODULE);
	$_p = strtolower($_REQUEST['p']);

	if (is_online($w_user)) {
		cookiedecode($w_user);
	}

	# HTML 5
	echo "<!DOCTYPE html>\n";

	# Copyright
	include_once(WEB_INCLUDES."copyright.php");
	
	echo "<!--[if IE 9]><html class=\"ie9 no-focus\"><![endif]-->\n";
	echo "<!--[if gt IE 9]><!--> <html class=\"no-focus\"> <!--<![endif]-->\n";
	
	# Meta Tags
	include_once(WEB_INCLUDES."meta.php");

	if (isset($author)) {
		echo "<meta name=\"author\" content=\"$author\" />\n";
	}

	# Facebook Metas
	if (isset($meta))
	{
		echo $meta;
	}

	# Google Sign-In Meta
	if (strlen($config->GoogleClientID) != 0)
	{
		echo "<meta name=\"google-signin-client_id\" content=\"".$config->GoogleClientID.".apps.googleusercontent.com\">\n";
	}

	# Mobile Friendly
	echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1.0\" />\n";
	
	# Pagetitle
	if (isset($pagetitle)) {
		$pagetitle = $pagetitle;
	} else {
		if (strlen($config->Slogan) != 0) {
			$pagetitle = SITENAME ." &#8211; ". $config->Slogan;
		} else {
			$pagetitle = SITENAME;
		}
	}
	echo "<title>$pagetitle</title>\n";

	# Favorite Icon
	if (file_exists(WEB_IMAGES."favicon.ico")) {
		echo "<link rel=\"shortcut icon\" href=\"".URL_IMAGES."/favicon.ico\" type=\"image/x-icon\">\n";
	} else if (file_exists(WEB_IMAGES."favicon.png")) {
		echo "<link rel=\"shortcut icon\" href=\"".URL_IMAGES."/favicon.png\" type=\"image/x-icon\">\n";
	} else if (file_exists(WEB_IMAGES."favicons".DS."favicon.ico")) {
		echo "<link rel=\"shortcut icon\" href=\"".URL_IMAGES."/favicons/favicon.ico\" type=\"image/x-icon\">\n";
	} else if (file_exists(WEB_IMAGES."favicons".DS."favicon.png")) {
		echo "<link rel=\"shortcut icon\" href=\"".URL_IMAGES."/favicons/favicon.png\" type=\"image/x-icon\">\n";
	} else {
		echo "<link rel=\"shortcut icon\" href=\"".URL_IMAGES."/favicon.ico\" type=\"image/x-icon\">\n";
	}

	# Mobile Icon
	if (file_exists(WEB_IMAGES."favicons".DS."favicon-16x16.png")) {
		echo "<link rel=\"icon\" type=\"image/png\" href=\"".URL_IMAGES."/favicons/favicon-16x16.png\" sizes=\"16x16\">\n";
	}
	if (file_exists(WEB_IMAGES."favicons".DS."favicon-32x32.png")) {
		echo "<link rel=\"icon\" type=\"image/png\" href=\"".URL_IMAGES."/favicons/favicon-32x32.png\" sizes=\"32x32\">\n";
	}
	if (file_exists(WEB_IMAGES."favicons".DS."favicon-96x96.png")) {
		echo "<link rel=\"icon\" type=\"image/png\" href=\"".URL_IMAGES."/favicons/favicon-96x96.png\" sizes=\"96x96\">\n";
	}
	if (file_exists(WEB_IMAGES."favicons".DS."favicon-160x160.png")) {
		echo "<link rel=\"icon\" type=\"image/png\" href=\"".URL_IMAGES."/favicons/favicon-160x160.png\" sizes=\"160x160\">\n";
	}
	if (file_exists(WEB_IMAGES."favicons".DS."favicon-192x192.png")) {
		echo "<link rel=\"icon\" type=\"image/png\" href=\"".URL_IMAGES."/favicons/favicon-192x192.png\" sizes=\"192x192\">\n";
	}

	# Apple Touch
	if (file_exists(WEB_IMAGES."favicons".DS."apple-touch-icon-57x57.png")) {
		echo "<link rel=\"apple-touch-icon\" sizes=\"57x57\" href=\"".URL_IMAGES."/favicons/apple-touch-icon-57x57.png\">\n";
	}
	if (file_exists(WEB_IMAGES."favicons".DS."apple-touch-icon-60x60.png")) {
		echo "<link rel=\"apple-touch-icon\" sizes=\"60x60\" href=\"".URL_IMAGES."/favicons/apple-touch-icon-60x60.png\">\n";
	}
	if (file_exists(WEB_IMAGES."favicons".DS."apple-touch-icon-72x72.png")) {
		echo "<link rel=\"apple-touch-icon\" sizes=\"72x72\" href=\"".URL_IMAGES."/favicons/apple-touch-icon-72x72.png\">\n";
	}
	if (file_exists(WEB_IMAGES."favicons".DS."apple-touch-icon-76x76.png")) {
		echo "<link rel=\"apple-touch-icon\" sizes=\"76x76\" href=\"".URL_IMAGES."/favicons/apple-touch-icon-76x76.png\">\n";
	}	
	if (file_exists(WEB_IMAGES."favicons".DS."apple-touch-icon-114x114.png")) {
		echo "<link rel=\"apple-touch-icon\" sizes=\"114x114\" href=\"".URL_IMAGES."/favicons/apple-touch-icon-114x114.png\">\n";
	}
	if (file_exists(WEB_IMAGES."favicons".DS."apple-touch-icon-120x120.png")) {
		echo "<link rel=\"apple-touch-icon\" sizes=\"120x120\" href=\"".URL_IMAGES."/favicons/apple-touch-icon-120x120.png\">\n";
	}
	if (file_exists(WEB_IMAGES."favicons".DS."apple-touch-icon-144x144.png")) {
		echo "<link rel=\"apple-touch-icon\" sizes=\"144x144\" href=\"".URL_IMAGES."/favicons/apple-touch-icon-144x144.png\">\n";
	}
	if (file_exists(WEB_IMAGES."favicons".DS."apple-touch-icon-152x152.png")) {
		echo "<link rel=\"apple-touch-icon\" sizes=\"152x152\" href=\"".URL_IMAGES."/favicons/apple-touch-icon-152x152.png\">\n";
	}
	if (file_exists(WEB_IMAGES."favicons".DS."apple-touch-icon-180x180.png")) {
		echo "<link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"".URL_IMAGES."/favicons/apple-touch-icon-180x180.png\">\n";	
	}	

	# Fonts
	echo "<link href=\"http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400italic,600,700%7COpen+Sans:300,400,400italic,600,700\" rel=\"stylesheet\" />\n";
	
	# Forms Styles
	if (defined('LIB.FORMS')) {
		echo "<link rel=\"stylesheet\" href=\"".URL_THEMES_L."/assets/js/plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css\" />\n";
		echo "<link rel=\"stylesheet\" href=\"".URL_THEMES_L."/assets/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css\" />\n";
		echo "<link rel=\"stylesheet\" href=\"".URL_THEMES_L."/assets/js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css\" />\n";
		echo "<link rel=\"stylesheet\" href=\"".URL_THEMES_L."/assets/js/plugins/select2/select2.min.css\" />\n";
		echo "<link rel=\"stylesheet\" href=\"".URL_THEMES_L."/assets/js/plugins/select2/select2-bootstrap.min.css\" />\n";
		echo "<link rel=\"stylesheet\" href=\"".URL_THEMES_L."/assets/js/plugins/ion-rangeslider/css/ion.rangeSlider.min.css\" />\n";
		echo "<link rel=\"stylesheet\" href=\"".URL_THEMES_L."/assets/js/plugins/ion-rangeslider/css/ion.rangeSlider.skinHTML5.min.css\" />\n";
		echo "<link rel=\"stylesheet\" href=\"".URL_THEMES_L."/assets/js/plugins/dropzonejs/dropzone.css\" />\n";
		echo "<link rel=\"stylesheet\" href=\"".URL_THEMES_L."/assets/js/plugins/jquery-tags-input/jquery.tagsinput.min.css\" />\n";

		// Text Editor
		echo "<link rel=\"stylesheet\" href=\"".URL_THEMES_L."/assets/js/plugins/summernote/summernote.min.css\" />\n";		
	}

	if (defined('LIB.SLIDER')) {
		echo "<link rel=\"stylesheet\" href=\"".URL_THEMES_L."/assets/js/plugins/slick/slick.min.css\" />\n";
		echo "<link rel=\"stylesheet\" href=\"".URL_THEMES_L."/assets/js/plugins/slick/slick-theme.min.css\" />\n";
	}
	
	if (defined('LIB.GALLERY')) {
		echo "<link rel=\"stylesheet\" href=\"".URL_THEMES_L."/assets/js/plugins/magnific-popup/magnific-popup.min.css\" />\n";
	}

	if (defined('LIB.DATATABLES')) {
		echo "<link rel=\"stylesheet\" href=\"".URL_THEMES_L."/assets/js/plugins/datatables/jquery.dataTables.min.css\" />\n";
	}

	if (defined('LIB.CALENDAR')) {
		echo "<link rel=\"stylesheet\" href=\"".URL_THEMES_L."/assets/js/plugins/fullcalendar/fullcalendar.min.css\" />\n";
	}

	# CSS Loader (Page Level Plugins)
	for($cssl=0; $cssl < count($cssload); $cssl++)
	{
		echo "<link href=\"".URL_THEMES_L."/assets/".$cssload[$cssl]."\" rel=\"stylesheet\" type=\"text/css\" />\n";
	}

	# CSS Load - All Pages
	echo "<link rel=\"stylesheet\" href=\"".URL_THEMES_L."/assets/js/plugins/sweetalert2/sweetalert2.min.css\" />\n";	
	echo "<link rel=\"stylesheet\" href=\"".URL_THEMES_L."/assets/js/plugins/jquery-auto-complete/jquery.auto-complete.min.css\" />\n";
	echo "<link rel=\"stylesheet\" href=\"".URL_THEMES_L."/assets/js/plugins/highlightjs/github-gist.min.css\" />\n";

	# <!-- Bootstrap and OneUI CSS framework -->
	echo "<link rel=\"stylesheet\" href=\"".URL_THEMES_L."/assets/css/bootstrap.min.css\" />\n";
	echo "<link rel=\"stylesheet\" id=\"css-main\" href=\"".URL_THEMES_L."/assets/css/oneui.css\" />\n";
	echo "<link rel=\"stylesheet\" href=\"".URL_THEMES_L."/assets/css/custom.css\" />\n";

	# EmojiOne
	if (class_exists('Emojione\\Emojione')) {
		echo "<link rel=\"stylesheet\" href=\"".URL_VENDOR."/emojione/emojione/assets/css/emojione.min.css\" />\n";
		echo "<link rel=\"stylesheet\" href=\"".URL_VENDOR."/emojione/emojione/assets/css/emojione-awesome.css\" />\n";
		echo "<link rel=\"stylesheet\" href=\"".URL_THEMES_L."/assets/css/emojione.css\" />\n"; // Dropdown Smiley
	}

	# Themes Color
	//echo "<link href=\"".URL_THEMES_L."/assets/css/themes/flat.min.css\" id=\"css-theme\" rel=\"stylesheet\" type=\"text/css\" />\n";

	# reCAPTCHA
	if ($config->SecurityCheck == true)
	{
		if (strlen($config->GoogleCaptchaKey) != 0)
		{
			if (count($captcha) > 0)
			{
				echo "<script type=\"text/javascript\">";
				echo "var GCCallback = function() {";
			    for ($gcaptcha=0; $gcaptcha < count($captcha); $gcaptcha++)
			    {
			    	echo "grecaptcha.render('".$captcha[$gcaptcha]."', {'sitekey' : '".$config->GoogleCaptchaKey."'});";
			    }
			    echo "};";
				echo "</script>\n";
				echo "<script src=\"https://www.google.com/recaptcha/api.js?onload=GCCallback&render=explicit\" async defer></script>\n";
			}
		}
	}

	echo "</head>\n";
	
	# Body
	if (isset($body)) {
		echo "$body\n";
	} else {
		echo "<body>\n";
	}

	# Anchor Named
	echo "<a name=\"top\" id=\"top\"></a>\n";

	#################

	# USERS FUNCTIONALITY
	if (is_online($w_user))
	{
		# Welcome
		$FirstTime = intval(getUser("FirstTimeLogin"));
		if ($FirstTime == 1 || $FirstTime == '1')
		{
			$welcome_msg = filter_decode(get_vv("WelcomeMessage",TBL_CONFIG,""));
			$t_welcome = new Template;
			$t_welcome->Load(WEB_TEMPLATES."system".DS."welcome.tpl");
			$t_welcome->Replace("fullname",getUserDetail("fullname"));
			$t_welcome->Replace("WELCOME_MSG",$welcome_msg);
			$t_welcome->Publish();			
		}

		# Need Change Passwd
		$NeedChangePwd = intval(getUser("NeedChangePwd"));
		if ($NeedChangePwd == 1 || $NeedChangePwd == '1')
		{
			if ($FirstTime == 1 || $FirstTime == '1') {
				$ext = "hide";
			} else {
				$ext = "";
			}
			$t_cp = new Template;
			$t_cp->Load(WEB_TEMPLATES."system".DS."need-change-pwd.tpl");
			$t_cp->Replace("avatar",getUserAvatar());
			$t_cp->Replace("fullname",getUserDetail("fullname"));
			$t_cp->Replace("online_status",strtolower(getUser("StatusOnline")));
			$t_cp->Replace("ext",$ext);
			$t_cp->Publish();
		}

		# Lockscreen
		$UserLockscreen = intval(getUser("isLockscreen"));
		if ($UserLockscreen == 1 || $UserLockscreen == '1')
		{
			$t_lock = new Template;
			$t_lock->Load(WEB_TEMPLATES."system".DS."locked.tpl");
			$t_lock->Replace("avatar",getUserAvatar());
			$t_lock->Replace("fullname",getUserDetail("fullname"));
			$t_lock->Replace("online_status",strtolower(getUser("StatusOnline")));
			$t_lock->Publish();			
		}

		/*--------------------------------------------------
		|
		|	TOP MENU
		|
		--------------------------------------------------*/
		$t_tm = new Template;
		$t_tm->Load(WEB_TEMPLATES."system".DS."top-menu.tpl");
		$t_tm->Replace("avatar",getUserAvatar());
		$t_tm->Replace("fullname",getUserDetail("fullname"));
		$t_tm->Replace("online_status",strtolower(getUser("StatusOnline")));
		
		# Inbox PM
		$TotalMsgNew = getTotalMsg_New();
		if ($TotalMsgNew > 0) {
			$inbox = "<span class=\"badge badge-primary pull-right font-w300\">".num($TotalMsgNew)."</span>";
		} else {
			$inbox = "";
		}
		$t_tm->Replace("inbox",$inbox);
		$top_menu = $t_tm->Evaluate();

		/*--------------------------------------------------
		|
		|	SYSTEM MENU
		|
		--------------------------------------------------*/
		$rmenu = dbe('select',"SELECT ID,ParentID,Menu,Icon,URL,role_id,MN FROM ".TBL_MENU." WHERE ParentID=0 ORDER BY MenuSort ASC",array('DBQUERY','theme.php','SystemMenu'));
		while (list($MenuID,$MenuParentID,$MenuName,$MenuIcon,$MenuURL,$MenuRole,$MN) = $rmenu->FetchRow())
		{
			$active_menu = (strcmp(trim($_SERVER['REQUEST_URI'],'/'), trim($MenuURL,'/')) === 0) ? 'active':'';

			# SUB MENU
			$rsm = dbe('select',"SELECT ID,ParentID,Menu,Icon,URL,role_id,MN FROM ".TBL_MENU." WHERE ParentID=".$MenuID." ORDER BY MenuSort ASC",array('DBQUERY','theme.php','SystemMenu-SubMenu'));
			if ($rsm->RecordCount() > 0)
			{
				$menu_open = '';
	            $submenu = '';
	            while (list($smMenuID,$smMenuParentID,$smMenuName,$smMenuIcon,$smMenuURL,$smMenuRole,$smMN) = $rsm->FetchRow())
	            {
	            	$active_menu_sm = (strcmp(trim($_SERVER['REQUEST_URI'],'/'), trim($smMenuURL,'/')) === 0) ? 'active':'';
	            	if ($active_menu_sm == 'active')
	            	{
	            		$menu_open = 'open';
	            	}

	            	if (preg_match('#^https?://#i', $smMenuURL) === 1) {
    					$smMenuURL = $smMenuURL;
					} else {
						$smMenuURL = SITEURL.$smMenuURL;
					}

	            	if (is_sadmin($w_user) || $user->hasRole($smMenuRole))
	            	{
	            		$smIcon = (strlen($smMenuIcon)!=0) ? "<i class=\"$smMenuIcon push-10-r\"></i>":"";
						$smMenuName = (strtolower($MN) == 'original') ? $smMenuName:"{".$smMenuName."}";
	            		$submenu .= '<li>
						<a class="'.$active_menu_sm.'" href="'.$smMenuURL.'">
						   	'.$smIcon.$smMenuName.'
						</a></li>';
					}
	            }

	            if (is_sadmin($w_user) || $user->hasRole($MenuRole))
	            {
		            $mIcon = (strlen($MenuIcon)!=0) ? "<i class=\"$MenuIcon\"></i>":"";
					$MenuName = (strtolower($MN) == 'original') ? $MenuName:"{".$MenuName."}";
	            	$system_menu .= '<li class="'.$menu_open.'">
	                <a class="nav-submenu" data-toggle="nav-submenu" href="#">
	                    '.$mIcon.'<span class="sidebar-mini-hide">'.$MenuName.'</span>
	                </a><ul>'.$submenu.'</ul></li>';
	            }
			}
			else
			{
				if (is_sadmin($w_user) || $user->hasRole($MenuRole))
				{
					if (preg_match('#^https?://#i', $MenuURL) === 1) {
    					$MenuURL = $MenuURL;
					} else {
						$MenuURL = SITEURL.$MenuURL;
					}

					$mIcon = (strlen($MenuIcon)!=0) ? "<i class=\"$MenuIcon\"></i>":"";
					$MenuName = (strtolower($MN) == 'original') ? $MenuName:"{".$MenuName."}";
            		$system_menu .= '<li>
		                <a class="'.$active_menu.'" href="'.$MenuURL.'">
		                    '.$mIcon.'<span class="sidebar-mini-hide">'.$MenuName.'</span>
		                </a>
		            </li>';
				}
			}
		}
		# Logout
		$system_menu .= '<li>
            <a href="#" onclick="javascript:logout();return false;">
                <i class="fa fa-sign-out"></i><span class="sidebar-mini-hide">'._LOGOUT.'</span>
            </a>
        </li>';

		/*--------------------------------------------------
		|
		|	SITE MENU
		|
		--------------------------------------------------*/
		$t_sum = new Template;
		$t_sum->Load(WEB_TEMPLATES."system".DS."user-sidemenu.tpl");
		$t_sum->Replace("avatar",getUserAvatar());
		$t_sum->Replace("fullname",getUserDetail("fullname"));
		$t_sum->Replace("online_status",strtolower(getUser("StatusOnline")));
		$side_menu = $t_sum->Evaluate();
	}
	else
	{
		$top_menu = '';
		$system_menu = '';
		$side_menu = '';
	}

	if ( (!defined('FULLBODY')) && (!defined('CLOSED')) )
	{
		$t = new Template;
		$t->Load(WEB_TEMPLATES."system".DS."header.tpl");
		$t->Replace("TOP_MENU", $top_menu);
		$t->Replace("SYSTEM_MENU", $system_menu);
		$t->Replace("SITE_MENU", $side_menu);
		$t->Publish();
	}
}

function ThemesFooter() {
	global $config, $user, $db, $cookie, $locale, $w_user, $jsload, $jsplugins, $jquery, $app, $jscript, $module_name, $pagetitle;
	$AppExtension = array();
	$module_name = strtolower(MODULE);
	if (is_online($w_user)) {
		cookiedecode($w_user);
	}

	echo "\n\n";
	
	# Footer Template
	if ( (!defined('FULLBODY')) && (!defined('CLOSED')) )
	{
		$t = new Template;
		$t->Load(WEB_TEMPLATES."system".DS."footer.tpl");
		$t->Replace("COPYRIGHT",sprintf(_COPYRIGHT_FOOTER,YEAR,SITENAME));
		$t->Publish();	
	}

	echo "\n\n";

    # Load javascript libraries
	echo "<script src=\"".URL_THEMES_L."/assets/js/core/jquery.min.js\"></script>\n";
	echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/jquery-ui/jquery-ui.min.js\"></script>\n";
	echo "<script src=\"".URL_THEMES_L."/assets/js/core/bootstrap.min.js\"></script>\n";
	echo "<script src=\"".URL_THEMES_L."/assets/js/core/jquery.slimscroll.min.js\"></script>\n";
	echo "<script src=\"".URL_THEMES_L."/assets/js/core/jquery.scrollLock.min.js\"></script>\n";
	echo "<script src=\"".URL_THEMES_L."/assets/js/core/jquery.appear.min.js\"></script>\n";
	echo "<script src=\"".URL_THEMES_L."/assets/js/core/jquery.countTo.min.js\"></script>\n";
	echo "<script src=\"".URL_THEMES_L."/assets/js/core/jquery.placeholder.min.js\"></script>\n";
	echo "<script src=\"".URL_THEMES_L."/assets/js/core/js.cookie.min.js\"></script>\n";

	/**
		EXTRA PARAMETER TO apps.js.php
	*/
	$ext_param = "";
	echo "<script src=\"".URL_THEMES_L."/assets/js/app.js.php?m=$module_name$ext_param\"></script>\n";

	# Google Sign-In
	if (strlen($config->GoogleClientID) != 0)
	{
		echo "<script src=\"https://apis.google.com/js/platform.js\" async defer></script>\n";
	}
	    
    # Twitter Platform
    if ($config->TwitterIntegration == true)
    {
    	echo "<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>\n";
    }
	
	# Facebook Javascript SDK
	if ($config->FacebookIntegration == true)
	{
		if ($config->FacebookJS == true)
		{
			if (strtolower(LOCALE) == 'ms') {
				$fb_locale = 'ms_MY';
			} else {
				$fb_locale = 'en_US';
			}

			if ($config->FacebookBeta == true) {
				$beta = '.beta';
			} else {
				$beta = '';
			}
			echo "<div id=\"fb-root\"></div>
			<script>
	  window.fbAsyncInit = function() {
	    FB.init({
	      appId      : '".$config->FacebookAppID."',
	      status 	 : true,
		  cookie 	 : true,
	      xfbml      : true,
	      version    : '".$config->FacebookGraph."'
	    });
	  };

	  (function(d, s, id){
	     var js, fjs = d.getElementsByTagName(s)[0];
	     if (d.getElementById(id)) {return;}
	     js = d.createElement(s); js.id = id;
	     js.src = \"//connect$beta.facebook.net/$fb_locale/sdk.js\";
	     fjs.parentNode.insertBefore(js, fjs);
	   }(document, 'script', 'facebook-jssdk'));
	</script>\n";
		}
	}

	# JS Load - All Pages
	echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/bootstrap-notify/bootstrap-notify.min.js\"></script>\n";
	echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/sweetalert2/sweetalert2.min.js\"></script>\n";
	echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/jquery-auto-complete/jquery.auto-complete.min.js\"></script>\n";
	echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/highlightjs/highlight.pack.js\"></script>\n";
	
	# Not in assets
	echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/jquery-autogrow/jquery.autogrow.min.js\"></script>\n";
	echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/jquery-shiftenter/jquery.shiftenter.js\"></script>\n";
	
	# Forms Input
	if (defined('LIB.FORMS')) {
		echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js\"></script>\n";
		echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/bootstrap-datetimepicker/moment.min.js\"></script>\n";
		echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js\"></script>\n";		
		echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js\"></script>\n";
		echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js\"></script>\n";
		echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/select2/select2.full.min.js\"></script>\n";
		echo "<script type=\"text/javascript\">";
		echo '$.fn.modal.Constructor.prototype.enforceFocus = function(){};';
		echo "</script>\n";	
		echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/masked-inputs/jquery.maskedinput.min.js\"></script>\n";
		echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js\"></script>\n";
		echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/dropzonejs/dropzone.min.js\"></script>\n";
		echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/jquery-tags-input/jquery.tagsinput.min.js\"></script>\n";
		echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js\"></script>\n";

		// Text Editor
		echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/summernote/summernote.min.js\"></script>\n";
		echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/ckeditor/ckeditor.js\"></script>\n";

		$AppExtension[] = array('datepicker','datetimepicker','colorpicker','maxlength','select2','masked-inputs','rangeslider','tags-inputs','summernote','ckeditor');
	}

	# Charts
	if (defined('LIB.CHARTS')) {
		echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/sparkline/jquery.sparkline.min.js\"></script>\n";
		echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/easy-pie-chart/jquery.easypiechart.min.js\"></script>\n";
		echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/chartjs/Chart.min.js\"></script>\n";
		echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/flot/jquery.flot.min.js\"></script>\n";
		echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/flot/jquery.flot.pie.min.js\"></script>\n";
		echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/flot/jquery.flot.stack.min.js\"></script>\n";
		echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/flot/jquery.flot.resize.min.js\"></script>\n";
		echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/flot/jquery.flot.spline.min.js\"></script>\n";
	}

	# Form Validation
	echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/jquery-validation/jquery.validate.min.js\"></script>\n";
	echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/jquery-validation/additional-methods.min.js\"></script>\n";

	if (defined('LIB.RATING')) {
		echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/jquery-raty/jquery.raty.min.js\"></script>\n";
		echo "<script type=\"text/javascript\" src=\"".URL_JS."/pages/rating.js.php\"></script>\n";
	}

	if (defined('LIB.SLIDER')) {
		echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/slick/slick.min.js\"></script>\n";
		$AppExtension[] = array('slick');
	}

	if (defined('LIB.GALLERY')) {
		echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/magnific-popup/magnific-popup.min.js\"></script>\n";
		$AppExtension[] = array('magnific-popup');
	}

	if (defined('LIB.DATATABLES')) {
		echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/datatables/jquery.dataTables.min.js\"></script>\n";
		echo "<script src=\"".URL_THEMES_L."/assets/js/pages/datatables.js\"></script>\n";
	}

	if (defined('LIB.CALENDAR')) {
		echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/fullcalendar/fullcalendar.min.js\"></script>\n";
		echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/fullcalendar/gcal.min.js\"></script>\n";
	}

	if ($config->GoogleMaps == true) {
		echo "<script src=\"//maps.googleapis.com/maps/api/js?key=".$config->GoogleAPIKey."\"></script>\n";
		echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/gmapsjs/gmaps.min.js\"></script>\n";
		echo "<script src=\"".URL_JS."/pages/maps.js.php\"></script>\n";
	}

	# Emojione
	if (class_exists('Emojione\\Emojione')) {
		echo "<script src=\"".URL_VENDOR."/emojione/emojione/lib/js/emojione.min.js\"></script>\n";
		echo "<script src=\"".URL_THEMES_L."/assets/js/plugins/jquery-textcomplete/jquery.textcomplete.min.js\"></script>\n";
	}

	###############################################

	# ZM : System Default Ajax & JS Library
	echo "<script type=\"text/javascript\" src=\"".URL_JS."/ajax/ajax.js\"></script>\n";	
	echo "<script type=\"text/javascript\" src=\"".URL_JS."/jscript.php?m=".$module_name."\"></script>\n\n";	

	# Javascript Loader (Plugins)
	for ($jsp=0; $jsp < count($jsplugins); $jsp++) {
		echo "<script type=\"text/javascript\" src=\"".URL_THEMES_L."/assets/js/plugins/".$jsplugins[$jsp]."\"></script>\n";
	}

	# Javascript Loader (Page Level Plugins)
	for ($jsl=0; $jsl < count($jsload); $jsl++) {
		echo "<script type=\"text/javascript\" src=\"".URL_JS."/".$jsload[$jsl]."\"></script>\n";
	}

	# jQuery Ready
	if (isset($jquery)) {
		echo "<script type=\"text/javascript\">\n";
		echo "$(document).ready(function() {\n";
		echo $jquery."\n";
		echo "});\n";
		echo "</script>\n";
	}

	# App Script
	$App_Extension = array_to_list($AppExtension);
	if (strlen($App_Extension) == 0) {
		$App_Extension = '';
	} else {
		$App_Extension = $App_Extension.',';
	}

	if (isset($app)) {
		echo "<script>\n";
		echo "jQuery(function() {\n";
		echo "App.initHelpers([".$app.",".$App_Extension."'highlightjs','slimscroll','notify','appear','appear-countTo']);\n";
		echo "});\n";
		echo "</script>\n";
	} else {
		echo "<script>\n";
		echo "jQuery(function() {\n";
		echo "App.initHelpers([".$App_Extension."'highlightjs','slimscroll','notify','appear','appear-countTo']);\n";
		echo "});\n";
		echo "</script>\n";
	}

	# JScript
	if (isset($jscript)) {
		echo "<script>\n";
		echo $jscript."\n";
		echo "</script>\n";
	}

	# Google Analytic
	if (strlen($config->GoogleAnalytic) != 0)
	{
		echo "<!-- Powered by Google Analytics. Thanks to the Google for providing it! //-->\n";
		echo "<script>\n";
		echo "(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){\n";
		echo "(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),\n";
		echo "m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)\n";
		echo "})(window,document,'script','//www.google-analytics.com/analytics.js','ga');\n\n";

		echo "ga('create', '".$config->GoogleAnalytic."', 'auto');\n";
		
		# Referrer
		$hostReferrer = $_SERVER['HTTP_REFERRER'];
		if (strlen($hostReferrer) != 0) {
			echo "ga('set','referrer', '".$hostReferrer."');\n";
		}

		# Languages
		echo "ga('set','language', '".LOCALE."');\n";
		echo "ga('send', 'pageview');\n";
		echo "</script>\n";
	}
}
?>