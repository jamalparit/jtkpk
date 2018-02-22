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

class Users
{
	public $UserID = '';
	public $UserName = '';

	public function __construct($uid = null)
    {
    	global $w_user;
    	
    	if ($uid !== null) {
    		$this->UserID = $uid;
    	} else {
    		if (is_online($w_user)) {
    			$this->UserID = USERID;
    		} else {
    			$this->UserID = '';
    		}
    	}	        	
    }

	public function id() {
		global $w_user;		
		return $this->UserID;
	}

	public function detail($info) {
		global $w_user;

		if (is_online($w_user)) {
			$info = getv($info,TBL_USERS_DETAIL,'UID',USERID);
		} else {
			$info = '';
		}
		return $info;
	}

	public function fullname() {
		global $w_user;

		if (is_online($w_user)) {
			$firstname = $this->detail('Firstname');
			$lastname = $this->detail('Lastname');
			$this->UserName = "$firstname $lastname";
		}
		return $this->UserName;
	}

	# User Roles
	public function getUserRoles($uid=NULL,$type=NULL,$getWhat=NULL) {
		global $db;
	    
	    if (is_online($w_user))
	    {	    	
		    $r = $db->Execute("SELECT r.ID,r.role,r.role_name FROM ".TBL_ROLES." r,".TBL_USER_ROLES." ur WHERE ur.user_id='$uid' AND ur.role_id=r.id");
			if ($r)
			{
				if ($r->RecordCount() > 0)
				{
					$roles = array();
					$roles_array = array();
					while (list($id,$role,$role_name) = $r->FetchRow()) {
						$roles[] = array('id' => $id, 'role' => $role, 'role_name' => $role_name);
						if ($getWhat == 'role') {
							$roles_array[] = $role;
						} else if ($getWhat == 'role_name') {
							$roles_array[] = $role_name;
						} else {
							$roles_array[] = $id;
						}
						
					}
					$_roles_array = implode(',', $roles_array);
				}
				
			}
			if ($type == 'array') {
				return $_roles_array;
			} else {
				return $roles;
			}
		}
		else
		{
			return '';
		}
	}

	public function userHasRole($role_id) {
		global $w_user;

		if (is_online($w_user))
		{
			$record = RecordCount("SELECT r.ID,r.role,r.role_name FROM ".TBL_ROLES." r,".TBL_USER_ROLES." ur WHERE ur.user_id='".USERID."' AND ur.role_id=r.id AND r.id=$role_id");
			if ($record > 0) {
				return true;
			} else {
				return false;
			}
		}
		else
		{
			return false;
		}
	}

	public function hasRole($role_id) {
		global $w_user;

		if (strlen($role_id) == 0 || $role_id == '')
		{
			return true;
		}
		else
		{
			if (is_online($w_user))
			{
				foreach (explode(',', $role_id) as $role)
				{
					if (!empty($role)) {
						if ($this->userHasRole($role)) {
							return true;
						}
					}
				}
			}
			else
			{
				return false;
			}
		}
	}

	# User Groups
	public function getUserGroups($uid=NULL,$type=NULL,$getWhat=NULL) {
		global $db;
	    
	    if (is_online($w_user))
	    {
		    $r = $db->Execute("SELECT g.ID,g.group_code,g.group_name FROM ".TBL_USERGROUPS." g,".TBL_USER_GROUPS." ug WHERE ug.user_id='$uid' AND ug.group_id=g.id");
			if ($r)
			{
				if ($r->RecordCount() > 0)
				{
					$groups = array();
					$groups_array = array();
					while (list($id,$group,$group_name) = $r->FetchRow()) {
						$groups[] = array('id' => $id, 'group' => $group, 'group_name' => $group_name);
						if ($getWhat == 'group') {
							$groups_array[] = $group;
						} else if ($getWhat == 'group_name') {
							$groups_array[] = $group_name;
						} else {
							$groups_array[] = $id;
						}
					}
					$_groups_array = implode(',', $groups_array);
				}				
			}
			if ($type == 'array') {
				return $_groups_array;
			} else {
				return $groups;
			}
		}
		else
		{
			return '';
		}
	}

	public function userHasGroup($group_id) {
		global $w_user;

		if (is_online($w_user))
		{
			$record = RecordCount("SELECT g.ID,g.group_code,g.group_name FROM ".TBL_USERGROUPS." g,".TBL_USER_GROUPS." ug WHERE ug.user_id='".USERID."' AND ug.group_id=g.id AND g.id=$group_id");
			if ($record > 0) {
				return true;
			} else {
				return false;
			}
		}
		else
		{
			return false;
		}
	}

	public function hasGroup($group_id) {
		global $w_user;

		if (strlen($group_id) == 0 || $group_id == '')
		{
			return true;
		}
		else
		{
			if (is_online($w_user))
			{
				foreach (explode(',', $group_id) as $group)
				{
					if (!empty($group)) {
						if ($this->userHasGroup($group)) {
							return true;
						}
					}
				}
			}
			else
			{
				return false;
			}
		}
	}
}
$user = new Users();

//------------------------------------------------

function cookiedecode($w_user) {
    global $cookie, $db;
    static $sidOnline;
	
    if (!is_array($w_user)) {
        $w_user = base64_decode($w_user);
        $w_user = addslashes($w_user);
        $cookie = explode("|", $w_user);
    } else {
        $cookie = $w_user;
    }
	
    $uid = $cookie[0];
    $sid = $cookie[1];

    if (!isset($sidOnline)) {
		$rs = $db->Execute("SELECT SID FROM ".TBL_USERS." WHERE UID='$uid' AND SID='$sid' AND StatusOnline='ONLINE' AND AccStatus='ACTIVE'");
		list($sidOnline) = $rs->FetchRow();
	}
	
    if ($cookie[1] == $sidOnline && !empty($sidOnline)) { return $cookie; }
}
function getUserID($loginid) {
	global $db;
    $uid = getv("UID",TBL_USERS,"LoginID",$loginid);
	return $uid;
}
function getUser($field,$uid=NULL) {
	global $db;
    if ($uid != NULL) { $u_id = $uid; } else { $u_id = USERID; }
	$get_field = getv($field,TBL_USERS,"UID",$u_id);
	return $get_field;
}
function getUserDetail($field,$uid=NULL,$decode = false) {
	global $db;
    if ($uid != NULL) { $u_id = $uid; } else { $u_id = USERID; }
    
    if (strtolower($field) == "fullname") {
		$firstname = getv("Firstname",TBL_USERS_DETAIL,"UID",$u_id);
		$lastname = getv("Lastname",TBL_USERS_DETAIL,"UID",$u_id);
		$get_field = $firstname." ".$lastname;
    } else {
		$get_field = getv($field,TBL_USERS_DETAIL,"UID",$u_id);
	}
	
	if ($decode == true) {
		$get_field = filter_decode($get_field,null,false,false);
	} else {
		$get_field = filter_decode($get_field,'edit-input',false,false);
	}
	return $get_field;
}
function getDefaultUserRole() {
	global $db;
	$usrgrp = get_v("ID",TBL_ROLES,"isDefault=1");
	return $usrgrp;
}
function getDefaultDepartment() {
	global $db;
	$dept = get_v("ID",TBL_DEPARTMENTS,"isDefault=1");
	return $dept;
}
function getUserAvatar($uid=NULL) {
	global $config, $db;
	if ($uid != NULL) { $u_id = $uid; } else { $u_id = USERID; }
	
	$UserAvatar = getv("AvatarType",TBL_USERS_DETAIL,"UID",$u_id);	
	if ($UserAvatar != "") {
		if ($uid != NULL) {
			$avatar_url = SITEURL."/?gx=avatar&uid=$uid";
		} else {
			$avatar_url = SITEURL."/?gx=avatar";
		}
	} else {
		$avatar_url = URL_IMAGES."/default_avatar.jpg";
	}
	return $avatar_url;
}
function getUserPaspot($uid=NULL) {
	global $config, $db;
	if ($uid != NULL) { $u_id = $uid; } else { $u_id = USERID; }
	
	$UserPaspot = getv("PaspotType",TBL_USERS_DETAIL,"UID",$u_id);	
	if ($UserPaspot != "") {
		if ($uid != NULL) {
			$paspot_url = SITEURL."/?gx=paspot&uid=$uid";
		} else {
			$paspot_url = SITEURL."/?gx=paspot";
		}
	} else {
		$paspot_url = URL_IMAGES."/default_paspot.jpg";
	}
	return $paspot_url;
}
function getStatusOnline($uid=NULL) {
	global $config, $db;
	if (isset($uid)) { $user_id = $uid; } else { $user_id = USERID;}	
	$ret = getUser("StatusOnline",$user_id);	
	return $ret;
}
function getUserExist($uid) {
	global $config, $db;
	$isuser = RecordCount("SELECT UID FROM ".TBL_USERS." WHERE UID='$uid'");
	if ($isuser == 0) {
		return false;
	} else {
		return true;
	}
}
function getUserRoles($uid=NULL,$type=NULL,$getWhat=NULL) {
	global $db;
    if ($uid != NULL) { $u_id = $uid; } else { $u_id = USERID; }
	
	$r = $db->Execute("SELECT r.ID,r.role,r.role_name FROM ".TBL_ROLES." r,".TBL_USER_ROLES." ur WHERE ur.user_id='$u_id' AND ur.role_id=r.id");
	if ($r)
	{
		if ($r->RecordCount() > 0)
		{
			$roles = array();
			$roles_array = array();
			while (list($id,$role,$role_name) = $r->FetchRow()) {
				$roles[] = array('id' => $id, 'role' => $role, 'role_name' => $role_name);
				if ($getWhat == 'role') {
					$roles_array[] = $role;
				} else if ($getWhat == 'role_name') {
					$roles_array[] = $role_name;
				} else {
					$roles_array[] = $id;
				}
				
			}
			$_roles_array = implode(',', $roles_array);
		}
		
	}
	if ($type == 'array') {
		return $_roles_array;
	} else {
		return $roles;
	}
}
function userHasRole($uid=NULL, $role) {
	global $db;
    if ($uid != NULL) { $u_id = $uid; } else { $u_id = USERID; }

	$rec = RecordCount("SELECT r.ID,r.role,r.role_name FROM ".TBL_ROLES." r,".TBL_USER_ROLES." ur WHERE ur.user_id='$u_id' AND ur.role_id=r.id AND r.role='$role'");
	if ($rec > 0) {
		return true;
	} else {
		return false;
	}
}
function getUserGroups($uid=NULL,$type=NULL,$getWhat=NULL) {
	global $db;
    if ($uid != NULL) { $u_id = $uid; } else { $u_id = USERID; }
	
	$r = $db->Execute("SELECT g.ID,g.group_code,g.group_name FROM ".TBL_USERGROUPS." g,".TBL_USER_GROUPS." ug WHERE ug.user_id='$u_id' AND ug.group_id=g.id");
	if ($r)
	{
		if ($r->RecordCount() > 0)
		{
			$groups = array();
			$groups_array = array();
			while (list($id,$group,$group_name) = $r->FetchRow()) {
				$groups[] = array('id' => $id, 'group' => $group, 'group_name' => $group_name);
				if ($getWhat == 'group') {
					$groups_array[] = $group;
				} else if ($getWhat == 'group_name') {
					$groups_array[] = $group_name;
				} else {
					$groups_array[] = $id;
				}
			}
			$_groups_array = implode(',', $groups_array);
		}				
	}
	if ($type == 'array') {
		return $_groups_array;
	} else {
		return $groups;
	}
}
function userHasGroup($uid=NULL, $group) {
	global $db;
    if ($uid != NULL) { $u_id = $uid; } else { $u_id = USERID; }

	$record = RecordCount("SELECT g.ID,g.group_code,g.group_name FROM ".TBL_USERGROUPS." g,".TBL_USER_GROUPS." ug WHERE ug.user_id='$u_id' AND ug.group_id=g.id AND g.id=$group");
	if ($record > 0) {
		return true;
	} else {
		return false;
	}
}
function is_online($w_user) {
    if (!$w_user) { return 0; }
    if (isset($userSave)) return $userSave;
    if (!is_array($w_user)) {
        $w_user = base64_decode($w_user);
        $w_user = addslashes($w_user);
        $w_user = explode("|", $w_user);
    }
    $userid = $w_user[0];
    $sid = $w_user[1];
    $userid = intval($userid);
    if (!empty($userid) AND !empty($sid)) {
        global $db;
		$rs = $db->Execute("SELECT UID,SID FROM ".TBL_USERS." WHERE UID='$userid' AND SID='$sid' AND StatusOnline='ONLINE' AND AccStatus='ACTIVE'");
		list($dbuserid,$dbsid) = $rs->FetchRow();
		if (($sid==strtoupper($dbsid)) && ($userid==$dbuserid)) {
			static $userSave;
			return $userSave = 1;
		}
    }
    static $userSave;
    return $userSave = 0;
}
function is_user_online($uid=NULL) {
	if (isset($uid)) { $user_id = $uid; } else { $user_id = USERID; }	
	$isOnline = RecordCount("SELECT * FROM ".TBL_USERS." WHERE StatusOnline='ONLINE' AND UID='$user_id'");
	if ($isOnline == 1) {
		return true;
	} else {
		return false;
	}
}
function is_sadmin($w_user) {
    if (!$w_user) { return 0; }
    if (isset($userSave_SA)) return $userSave_SA;
    if (!is_array($w_user)) {
        $w_user = base64_decode($w_user);
        $w_user = addslashes($w_user);
        $w_user = explode("|", $w_user);
    }
    $userid = $w_user[0];
    $sid = $w_user[1];
    $userid = intval($userid);
    if (!empty($userid) AND !empty($sid))
    {
        global $db;
		$rs = $db->Execute("SELECT UID,SID FROM ".TBL_USERS." WHERE UID='$userid' AND SID='$sid' AND AccStatus='ACTIVE'");
		list($dbuserid,$dbsid) = $rs->FetchRow();
		if (($sid==strtoupper($dbsid)) && ($userid==$dbuserid) && (userHasRole($userid,'super-admin'))) {
			static $userSave_SA;
			return $userSave_SA = 1;
		}
    }
    static $userSave_SA;
    return $userSave_SA = 0;
}
function is_admin($w_user) {
    if (!$w_user) { return 0; }
    if (isset($userSave_S)) return $userSave_S;
    if (!is_array($w_user)) {
        $w_user = base64_decode($w_user);
        $w_user = addslashes($w_user);
        $w_user = explode("|", $w_user);
    }
    $userid = $w_user[0];
    $sid = $w_user[1];
    $userid = intval($userid);
    if (!empty($userid) AND !empty($sid)) {
        global $db;
		$rs = $db->Execute("SELECT UID,SID FROM ".TBL_USERS." WHERE UID='$userid' AND SID='$sid' AND AccStatus='ACTIVE'");
		list($dbuserid,$dbsid) = $rs->FetchRow();
		if (($sid==strtoupper($dbsid)) && ($userid==$dbuserid) && (userHasRole($userid,'admin'))) {
			static $userSave_S;
			return $userSave_S = 1;
		}
    }
    static $userSave_S;
    return $userSave_S = 0;
}
function is_user($w_user) {
    if (!$w_user) { return 0; }
    if (isset($userSave_U)) return $userSave_U;
    if (!is_array($w_user)) {
        $w_user = base64_decode($w_user);
        $w_user = addslashes($w_user);
        $w_user = explode("|", $w_user);
    }
    $userid = $w_user[0];
    $sid = $w_user[1];
    $userid = intval($userid);
    if (!empty($userid) AND !empty($sid)) {
        global $db;
		$rs = $db->Execute("SELECT UID,SID FROM ".TBL_USERS." WHERE UID='$userid' AND SID='$sid' AND AccStatus='ACTIVE'");
		list($dbuserid,$dbsid) = $rs->FetchRow();
		if (($sid==strtoupper($dbsid)) && ($userid==$dbuserid) && (userHasRole($userid,'user'))) {
			static $userSave_U;
			return $userSave_U = 1;
		}
    }
    static $userSave_U;
    return $userSave_U = 0;
}

/**
	GENERAL
*/
function SuperAdminOnly() {
    global $config, $pagetitle;
    $pagetitle = SITENAME." - "._SUPER_ADMIN_ONLY;
    include(WEB_INCLUDES."header.php");
    $t = new Template;
    $t->Load(WEB_TEMPLATES_SYSTEM."super-admin-only.tpl"); 
    $t->Publish();
    include(WEB_INCLUDES."footer.php");
    die();
}
function AdminOnly() {
    global $config, $pagetitle;
    $pagetitle = SITENAME." - "._ADMIN_ONLY;
    include(WEB_INCLUDES."header.php");
    $t = new Template;
    $t->Load(WEB_TEMPLATES_SYSTEM."admin-only.tpl"); 
    $t->Publish();
    include(WEB_INCLUDES."footer.php");
    die();
}
function AuthorizedOnly() {
    global $config, $pagetitle;
    $pagetitle = SITENAME." - "._AUTHORIZED_ONLY;
    include(WEB_INCLUDES."header.php");
    $t = new Template;
    $t->Load(WEB_TEMPLATES_SYSTEM."authorized-only.tpl"); 
    $t->Publish();
    include(WEB_INCLUDES."footer.php");
    die();
}


/**
	PM
*/
function getTotalConversation() {
	global $db, $config, $w_user;
	$rec = RecordCount("SELECT C.CID FROM ".TBL_CONVERSATION_FOLDER." F, ".TBL_CONVERSATION." C WHERE F.CID=C.CID AND F.Receiver='".USERID."'");
	return $rec;
}
function getTotalMsg($cid) {
	global $db, $config, $w_user;
	$rec = RecordCount("SELECT * FROM ".TBL_CONVERSATION_MSG." WHERE CID='$cid'");
	return $rec;
}
function getTotalMsg_New() {
	global $db, $config, $w_user;
	$TotalUnread = RecordCount("SELECT * FROM ".TBL_CONVERSATION_FOLDER." WHERE Receiver='".USERID."' AND ReadStatus='UNREAD'");
	return $TotalUnread;
}
?>