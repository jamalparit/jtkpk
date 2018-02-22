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

class WebConfig
{
	# Copyright. Please do not change this copyright.
	var $WebSystem = "ZackFramework (OneUI)";
	var $WebVersion = "3.1";
	var $Developer = "ZULMD DOT COM (IP0445886-X) - http://www.zulmd.com";

	# License Key
	var $LicenseKey = "ZMD63303S47G621R45Y5722842783492";

	# Site Configuration
	var $DisplayError = true;
	var $SiteName = "Portal Bersepadu JTKPK";
	var $SiteUrl = "http://www.jtkpk.dev";
	var $SiteDomain = "jtkpk.dev";
	var $Slogan = "Sharing is Caring !";
	var $SiteDescription = "Sistem Bersepadu Juruteknik Komputer Negeri Perak (JTKPK). Ianya direka khas buat juruteknik komputer perkhidmatan awam bagi melaksanakan proses kerja dengan lebih teratur dan sistematik.";
	var $Keywords = "web, system, integration, website, sistem, integrasi, sistem bersepadu, jtkpk, jtk perak, jtk, komputer, juruteknik, juruteknik komputer";

	# Themes
	var $DefaultTheme = "oneui";

	# Users
	var $AllowRegister = false;
	var $LoginID = "EMAIL"; // EMAIL | ID
	var $UserSession = 3600; // 1 hour
	var $SessionRemember = 86400; // 24 hours

	# Database Configuration
	var $DatabaseType = "MySQL"; // MySQL or MSSQL
	var $DatabaseName = "jtkpkv2";
	var $DatabaseHost = "localhost";
	var $DatabaseUser = "root";
	var $DatabasePass = 'sa';
	var $DatabaseDebug = false;

	# Security Graphic Check (reCAPTCHA)
	var $SecurityCheck = false;
	var $GoogleCaptchaKey = "";
	var $GoogleCaptchaSecret = "";
	
	/*---------------------------------------
	/ PRODUCTS INTEGRATIONS
	/---------------------------------------*/

	# SMTP Configuration (PHPMailer)
	var $AdminMail = "webmaster@jtkpk.dev";
	var $MailHost = "";
	var $MailUser = "";
	var $MailPwd = '';
	var $MailPort = 465;
	var $MailSecure = "ssl";
	var $MailDebug = 0;

	# Google Integration
	# ---------------------------------------
	# Google Sign-In
	var $GoogleClientID = "";

	# Google API Key
	var $GoogleAPIKey = "";
	
	# Google Analytics
	var $GoogleAnalytic = "";
	
	# Google Maps
	var $GoogleMaps = false;
	var $GoogleDefaultLat = "4.2529308";
	var $GoogleDefaultLon = "100.7967065";
	var $GoogleDefaultZoom = "10";

	# Facebook Integration
	# ---------------------------------------
	var $FacebookIntegration = false;
	var $FacebookBeta = false;
	var $FacebookJS = false;
	var $FacebookGraph = 'v2.7';
	var $FacebookAppID = "";
	var $FacebookAppSecret = "";

	# Twitter Integration
	# ---------------------------------------
	var $TwitterIntegration = false;
	var $TwitterAccessToken = "";
	var $TwitterTokenSecret = "";
	var $TwitterConsumerKey = "";
	var $TwitterConsumerSecret = "";

	# SMS Integration
	# ---------------------------------------
	var $SMS_MTURL = "";
	var $SMSUser = "";
	var $SMSPwd = "";

	# Web Settings
	# ---------------------------------------
	var $PipelineDelay = 30;
	var $LoadPM = 20;
	
	var $CurrentLang;
	
	#################################################################
	
	public function setLanguage($NewLang) {
		$this->CurrentLang = $NewLang;
	}
	public function getLanguage() {
		return $this->CurrentLang;
	}
	public function setTheme($NewTheme) {
		$this->DefaultTheme = $NewTheme;
	}
	public function getTheme() {
		return $this->DefaultTheme;
	}

}
$config = new WebConfig();
?>