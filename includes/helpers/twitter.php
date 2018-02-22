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

use Abraham\TwitterOAuth\TwitterOAuth;

class Twitter {

   	public $twitter;
   
	public function __construct($AccessToken = NULL)
	{
		global $db, $config;

		if ($AccessToken != NULL) {
			$_AccessToken = getUserDetail("TwOAuth_Token", $AccessToken);
			$_TokenSecret = getUserDetail("TwOAuth_Secret", $AccessToken);
		} else {
			$_AccessToken = $config->TwitterAccessToken;
			$_TokenSecret = $config->TwitterTokenSecret;
		}

		$this->twitter = new TwitterOAuth($config->TwitterConsumerKey, $config->TwitterConsumerSecret, $_AccessToken, $_TokenSecret);
		$this->twitter->setTimeouts(10, 15);
	}

   	public function getUser($what) {
		$TwitterUser = $this->twitter->get("account/verify_credentials");
		return $TwitterUser->{$what};
	}

	public function Tweet($status, $return_true = false) {
		$response = $this->twitter->post("statuses/update", ["status" => $status]);

		if ($this->twitter->getLastHttpCode() == 200)
		{
		    if ($return_true == true) {
		    	return true;
		    } else {
		    	return $response;
		    }
		}
		else
		{
		    return false;
		}		
	}

	public function TweetMedia($status, $media, $return_true = false) {
		$mediaFile = $this->twitter->upload('media/upload', ['media' => $media]);
		$parameters = [
			'status' => $status,
		    'media_ids' => $mediaFile->media_id_string
		];

		$response = $this->twitter->post('statuses/update', $parameters);		

		if ($this->twitter->getLastHttpCode() == 200)
		{
		    if ($return_true == true) {
		    	return true;
		    } else {
		    	return $response;
		    }
		}
		else
		{
		    return false;
		}		
	}

	public function getLastHttpCode() {
		return $this->twitter->getLastHttpCode();
	}
}
?>