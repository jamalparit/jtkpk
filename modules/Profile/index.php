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

function Profile() {
	global $config, $db, $jquery, $pagetitle, $w_user;

	$pagetitle = SITENAME.' - '._PROFILE;
	define('LIB.FORMS', true);
	$jquery = '';

	# Tempat Bertugas
	$TempatBertugas = strtolower(getUserDetail('TempatBertugas'));
	if (!empty($TempatBertugas))
	{
		$KodJPN = getUserDetail('KodJPN');
		$KodPPD = getUserDetail('KodPPD');
		$KodPKG = getUserDetail('KodPKG');
		$KodSekolah = getUserDetail('KodSekolah');

		if ($TempatBertugas == 'jpn')
		{
			$chk_jpn = 'checked';
			$jquery .= 'setTimeout(function() {
				$(\'#_jpn\').val(\''.$KodJPN.'\').trigger(\'change\');
				$(\'#_jpn\').next(\'.select2-container\').show();

				$(\'#_ppd\').next(\'.select2-container\').hide();
				$(\'#_pkg\').next(\'.select2-container\').hide();
				$(\'#_sekolah\').next(\'.select2-container\').hide();
			},100);';
		}
		else if ($TempatBertugas == 'ppd')
		{
			$chk_ppd = 'checked';
			$jquery .= '
			$(\'#_jpn\').val(\''.$KodJPN.'\').trigger(\'change\');
			$(\'#_jpn\').next(\'.select2-container\').show();
			ChangePPD(\''.$KodJPN.'\');

			setTimeout(function() {
				$(\'#_ppd\').val(\''.$KodPPD.'\').trigger(\'change\');
				$(\'#_ppd\').next(\'.select2-container\').show();

				$(\'#_pkg\').next(\'.select2-container\').hide();
				$(\'#_sekolah\').next(\'.select2-container\').hide();
			},1000);';
		}
		else if ($TempatBertugas == 'pkg')
		{
			$chk_pkg = 'checked';
			$jquery .= '
			$(\'#_jpn\').val(\''.$KodJPN.'\').trigger(\'change\');
			$(\'#_jpn\').next(\'.select2-container\').show();
			ChangePPD(\''.$KodJPN.'\');
			ChangePKGSEK(\''.$KodPPD.'\');

			setTimeout(function() {
				$(\'#_ppd\').val(\''.$KodPPD.'\').trigger(\'change\');
				$(\'#_ppd\').next(\'.select2-container\').show();

				$(\'#_pkg\').val(\''.$KodPKG.'\').trigger(\'change\');
				$(\'#_pkg\').next(\'.select2-container\').show();

				$(\'#_sekolah\').next(\'.select2-container\').hide();
			},1000);';
		}
		else if ($TempatBertugas == 'sek')
		{
			$chk_sek = 'checked';
			$jquery .= '
			$(\'#_jpn\').val(\''.$KodJPN.'\').trigger(\'change\');
			$(\'#_jpn\').next(\'.select2-container\').show();
			ChangePPD(\''.$KodJPN.'\');
			ChangePKGSEK(\''.$KodPPD.'\');

			setTimeout(function() {
				$(\'#_ppd\').val(\''.$KodPPD.'\').trigger(\'change\');
				$(\'#_ppd\').next(\'.select2-container\').show();
				$(\'#_pkg\').val(\''.$KodPKG.'\').trigger(\'change\');
				$(\'#_pkg\').next(\'.select2-container\').show();
				$(\'#_sekolah\').val(\''.$KodSekolah.'\').trigger(\'change\');
				$(\'#_sekolah\').next(\'.select2-container\').show();
			},1000);';
		}			
	}
	else
	{
		$jquery .= 'setTimeout(function() {
			$(\'#_jpn\').next(\'.select2-container\').hide();
			$(\'#_ppd\').next(\'.select2-container\').hide();
			$(\'#_pkg\').next(\'.select2-container\').hide();
			$(\'#_sekolah\').next(\'.select2-container\').hide();
		},100);';
	}

	$jquery .= '
$(\'input[name="_tempatbertugas"]\').on("click", function() { 
    LayoutTempatBertugas(this.value);
});

$(\'#_jpn\').on("select2:select", function(e) { 
    ChangePPD($(this).select2(\'val\'));
});
$(\'#_ppd\').on("select2:select", function(e) { 
    ChangePKGSEK($(this).select2(\'val\'));
});

$("#btn-delete-avatar").click(function(){
	var ajax = new sack();
	ajax.setVar("op","delete_avatar");
	Ajx(ajax); 	
});
$("#btn-delete-paspot").click(function(){
	var ajax = new sack();
	ajax.setVar("op","delete_paspot");
	Ajx(ajax); 	
});
var dz_UserAvatar = $("#btn-avatar").dropzone({ 
	url: \''.SITEURL.'/profile/?p=u_avatar\',
    acceptedFiles: \'image/jpg,image/jpeg,image/png\',
    maxFilesize: 2,
    maxFiles: 1,
    createImageThumbnails: false,
    previewTemplate : \'<div style="display:none"></div>\',
    init: function() {
        this.on("processing", function(file) {
            $("#btn-avatar").html(\'<i class="fa fa-cog fa-spin push-5-r"></i>\');
        });
        this.on("success", function(file) {
            var ret = file.xhr.response;
            if (ret == "OK") {
                var randomId = new Date().getTime();
                $("#btn-avatar").html(\'Tukar Avatar\');
                $(".img-avatar").attr("src","'.SITEURL.'/?gx=avatar&true="+randomId);
            }
        });
        this.on("complete", function() {
            if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                this.removeAllFiles();
            }
        });
    }
});
var dz_Paspot = $("#btn-paspot").dropzone({ 
	url: \''.SITEURL.'/profile/?p=u_paspot\',
    acceptedFiles: \'image/jpg,image/jpeg,image/png\',
    maxFilesize: 2,
    maxFiles: 1,
    createImageThumbnails: false,
    previewTemplate : \'<div style="display:none"></div>\',
    init: function() {
        this.on("processing", function(file) {
            $("#btn-paspot").html(\'<i class="fa fa-cog fa-spin push-5-r"></i>\');
        });
        this.on("success", function(file) {
            var ret = file.xhr.response;
            if (ret == "OK") {
                var randomId = new Date().getTime();
                $("#btn-paspot").html(\'Tukar Gambar\');
                $(".img-avatar128").attr("src","'.SITEURL.'/?gx=paspot&true="+randomId);
            }
        });
        this.on("complete", function() {
            if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                this.removeAllFiles();
            }
        });
    }
});';

	# MAKLUMAT PERJAWATAN ICT
	if (strtolower(getUserDetail('TempatBertugas')) == 'sek')
	{
		$r = $db->Execute("SELECT ID,Jawatan,Nama,NoKP,NoMobile,EmelRasmi FROM ".TBL_PERJAWATAN_ICT." WHERE KodSekolah='".getUserDetail('KodSekolah')."'");
		if ($r->RecordCount() == 0)
		{
			$pict_data = '<h4>- TIADA MAKLUMAT PERJAWATAN ICT. SILA KEMASKINI -</h4>';
		}
		else
		{
			$pict_data = '<table class="table table-striped">
			<thead>
                <tr>
                    <th class="hidden-xs">JAWATAN</th>
                    <th>NAMA</th>
                    <th class="hidden-xs text-center">NO. TEL</th>
                    <th class="hidden-xs text-center">E-MEL</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>';
			while (list($ID,$Jawatan,$Nama,$NoKP,$NoMobile,$EmelRasmi) = $r->FetchRow()) {
				$pict_data .= '<tr>
					<td class="text-left hidden-xs">'.getv('Jawatan',TBL_JAWATAN,'ID',$Jawatan).'</td>
					<td class="text-left">'.$Nama.'<br>No. K/P : '.$NoKP.'</td>
					<td class="hidden-xs text-center">'.$NoMobile.'</td>
					<td class="hidden-xs text-center">'.$EmelRasmi.'</td>
					<td class="text-center">
						<button type="button" class="btn btn-sm btn-danger" onClick="javascript:DeletePICT(\''.$ID.'\');">
							<i class="fa fa-trash-o"></i>
						</button>
					</td>
				</tr>';
			}
			$pict_data .= '</tbody></table>';
		}

		$tp = new Template;
		$tp->Load(WEB_MODULE_TEMPLATE."perjawatan-ict.tpl");
		$tp->Replace('DATA',$pict_data);
		$pict = $tp->Evaluate();
	}
	else
	{
		$pict = '';
	}

	include(WEB_INCLUDES."header.php");
	$t = new Template;
	$t->Load(WEB_MODULE_TEMPLATE."profile.tpl");
	$t->Replace('_avatar',getUserAvatar());
	$t->Replace('_paspot',getUserPaspot());

	$t->Replace('PERJAWATAN_ICT',$pict);
	$t->Replace('GRED',selectdb("SELECT ID,Gred,NamaJawatan FROM ".TBL_GRED." ORDER BY ID ASC","ID","Gred - NamaJawatan",getUserDetail('GredID')));
	$t->Replace('JPN',selectdb("SELECT ID,KodJPN,JPN FROM ".TBL_JPN." ORDER BY ID ASC","KodJPN","KodJPN - JPN"));
	$t->Replace('AKADEMIK',selectdb("SELECT ID,Akademik FROM ".TBL_AKADEMIK." ORDER BY ID ASC","ID","Akademik",getUserDetail('Akademik')));
	$t->Replace('TARAFJAWATAN',selectdb("SELECT ID,TarafJawatan FROM ".TBL_TARAF_JAWATAN." ORDER BY ID ASC","ID","TarafJawatan",getUserDetail('TarafJawatan')));
	$t->Replace('NEGERI',selectdb("SELECT ID,Negeri FROM ".TBL_NEGERI." ORDER BY ID ASC","ID","Negeri",getUserDetail('Negeri')));
	$t->Replace('JAWATAN',selectdb("SELECT ID,Jawatan FROM ".TBL_JAWATAN." ORDER BY ID ASC","ID","Jawatan"));

	$t->Replace('CHK_JPN',$chk_jpn);
	$t->Replace('CHK_PPD',$chk_ppd);
	$t->Replace('CHK_PKG',$chk_pkg);
	$t->Replace('CHK_SEK',$chk_sek);

	$t->Replace('_fullname',getUserDetail('fullname'));
	$t->Replace('_firstname',getUserDetail('Firstname'));
	$t->Replace('_nokp',getUserDetail('NoKP'));
	$t->Replace('_email',getUserDetail('Email'));
	$t->Replace('_mobileno',getUserDetail('MobilePhone'));
	$t->Replace('_pengkhususan',getUserDetail('Pengkhususan'));
	$t->Replace('_tarikh_lantikan_pertama',FormatDate(getUserDetail('TarikhLantikan')));
	$t->Replace('_tarikh_khidmat',FormatDate(getUserDetail('TarikhKhidmat')));
	$t->Replace('_opsyen',getUserDetail('OpsyenBersara'));
	$t->Replace('_alamat1',getUserDetail('Alamat1'));
	$t->Replace('_alamat2',getUserDetail('Alamat2'));
	$t->Replace('_poskod',getUserDetail('Poskod'));
	$t->Replace('_bandar',getUserDetail('Bandar'));
	$t->Replace('_jarak',getUserDetail('JarakRumah'));

	$t->Publish();
	include(WEB_INCLUDES."footer.php");
}
function UploadUserAvatar() {
	global $config, $db;

	// Get Data
	$FileType = strtolower($_FILES['file']['type']);
	$tmpName = $_FILES['file']['tmp_name']; 
	$isUploadedFile = is_uploaded_file($_FILES['file']['tmp_name']);

	if ($isUploadedFile == true)
	{
		$fp = fopen($tmpName, 'r');
		$content = fread($fp, filesize($tmpName));
		$content = addslashes($content);
		fclose($fp);

		$iUserAvatar = $db->Execute("UPDATE ".TBL_USERS_DETAIL." SET AvatarType='$FileType', AvatarPic='$content' WHERE UID='".USERID."'");
		if ($iUserAvatar) {
			echo "OK";
		} else {
			echo "KO";
		}		
	}
}
function UploadUserPaspot() {
	global $config, $db;

	// Get Data
	$FileType = strtolower($_FILES['file']['type']);
	$tmpName = $_FILES['file']['tmp_name']; 
	$isUploadedFile = is_uploaded_file($_FILES['file']['tmp_name']);

	if ($isUploadedFile == true)
	{
		$fp = fopen($tmpName, 'r');
		$content = fread($fp, filesize($tmpName));
		$content = addslashes($content);
		fclose($fp);

		$iUserPaspot = $db->Execute("UPDATE ".TBL_USERS_DETAIL." SET PaspotType='$FileType', PaspotPic='$content' WHERE UID='".USERID."'");
		if ($iUserPaspot) {
			echo "OK";
		} else {
			echo "KO";
		}		
	}
}
function NotificationsList() {
	global $config, $db;

	$r = $db->Execute("SELECT NotifyDate, MONTH(NotifyDate), YEAR(NotifyDate), DATE_FORMAT(NotifyDate,'%M, %Y') MonYear FROM ".TBL_NOTIFICATIONS." WHERE UID='".USERID."' GROUP BY MonYear ORDER BY NotifyDate DESC");
	if (!$r) { die($db->ErrorMsg()); } else
	{
		if ($r->RecordCount() == 0)
		{
			$_notifications = '<p class="text-center">- '._NO_NOTIFICATIONS.' -</p>';
		}
		else
		{
			while (list($NotifyDate, $Mon, $Yea, $MonYear) = $r->FetchRow())
			{
				$_notifications .= "<div id=\"Notifications_$Mon-$Yea\">";
				$_notifications .= "<p class=\"h5 font-w300 border-b padding-5 push-10\"><i class=\"fa fa-calendar push-5-r\"></i> $MonYear 
				<span class=\"pull-right\">
					<a href=\"#\" onclick=\"javascript:DeleteNotifications('$Mon-$Yea');return false;\" title=\"".sprintf(_DELETE_ALL_NOTIFICATIONS,$MonYear)."\" data-toggle=\"tooltip\" data-placement=\"top\">
						<i class=\"fa fa-trash-o text-danger\"></i>
					</a>
				</span></p>";

				$rn = $db->Execute("SELECT *,DATE_FORMAT(NotifyDate,'%d/%m/%Y %h:%i %p') NotifyDateFormat FROM ".TBL_NOTIFICATIONS." WHERE UID='".USERID."' AND NType != 'LIVE' AND MONTH(NotifyDate)='$Mon' AND YEAR(NotifyDate)='$Yea' ORDER BY NotifyDate DESC");
				if ($rn->RecordCount() > 0)
				{
					$_notifications .= '<ul class="list list-activity">';					
					while ($rwn = $rn->FetchRow())
					{
						$NotifyID = $rwn['ID'];
						$PerformerUID = $rwn['PerformerUID'];
						$PerformerName = getUserDetail('fullname',$PerformerUID);
						$NotifyType = strtoupper($rwn['NotifyType']);
						$EventType = strtoupper($rwn['EventType']);
						$ReadStatus = strtoupper($rwn['ReadStatus']);
						$DataID = $rwn['NotifyData'];
						$DataExt = $rwn['NotifyDataExt'];
						$NotifyDate = nicetime($rwn['NotifyDate']);
						$NotifyDateFormat = $rwn['NotifyDateFormat'];

						$_TxtColor = ($ReadStatus == 'UNREAD') ? 'text-danger':'text-muted';

						if ($NotifyType == 'PM')
						{
							$_Icon = '<i class="fa fa-inbox '.$_TxtColor.' push-5-r"></i>';
							$Msg = sprintf(_NEW_PM_RECEIVED_FROM, "<b>$PerformerName</b>");
							$_NotifyTxt = "<a href=\"".SITEURL."/messages\">$Msg</a>";
						}
						else if ($NotifyType == 'MESSAGES-CENTER')
						{
							$_Icon = '<i class="fa fa-envelope '.$_TxtColor.' push-5-r"></i>';
							$MsgTitle = filter_decode(getv('Title',TBL_MESSAGES,'ID',$DataID),null,false,false);
							$Msg = sprintf(_RECEIVED_NEW_MESSAGES_CENTER, "<b>$MsgTitle</b>");
							$_NotifyTxt = "<a href=\"".SITEURL."/messages-center/?mid=$DataID\">$Msg</a>";
						}
						
						$_notifications .= '<li>'.$_Icon.'
							<div>'.$_NotifyTxt.'</div>
							<div><small class="text-muted">'.$NotifyDateFormat.' (<i>'.nicetime($NotifyDate).'</i>)</small></div>
						</li>';
					}		
					$_notifications .= '</ul>';
				}
				else
				{
					$_notifications = '<p class="text-center">- '._NO_NOTIFICATIONS.' -</p>';
				}
				$_notifications .= "<p></p></div>";
			}
		}
	}

	$pagetitle = SITENAME.' - '._NOTIFICATIONS;
	include(WEB_INCLUDES."header.php");	
	$t = new Template;
	$t->Load(WEB_MODULE_TEMPLATE."notifications.tpl");
	$t->Replace('notifications',$_notifications);
	$t->Publish();
	include(WEB_INCLUDES."footer.php");
}

#-------------------------------------------------
if (!empty($_REQUEST['p'])) { $p = $_REQUEST['p']; }
switch ($p)
{
	default:
		Profile();
	break;
	case "u_avatar":
		UploadUserAvatar();
	break;
	case "u_paspot":
		UploadUserPaspot();
	break;
	case "notifications":
		NotificationsList();
	break;
}
?>