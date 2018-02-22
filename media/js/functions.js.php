<?php
/*###############################################################
#  ZM : Web System												#
#  ===========================									#
#  Design & Code by : Zulkifli Mohamed (putera)					#
###############################################################*/
require_once("../../global.php");
global $w_user;
$m = strtolower($_REQUEST['m']);
header("Content-Type: text/javascript");
?>
/* Copyright <?php echo date('Y'); ?> <?php echo $config->WebSystem;?>. All Rights Reserved. */
<?php if (!is_online($w_user)) {
/**
#---------------------------------------------
# ANONYMOUS ONLY
#---------------------------------------------
*/?>
function ClearRegister() {
    $('#_loginid').val('');
    $('#_pwd').val('');
    $('#_firstname').val('');
    $('#_lastname').val('');
    $('#_email').val('');
    $('#_jobpos').val('');
}
function Register() {
    ClearRegister();
    $('#RegisterDialog').modal();
    setTimeout(function(){
        $('#_loginid').focus();
    },500);
}
function doRegister() {
    if ($("#_loginid").val().length == 0) {
        $("#_loginid").focus();
        return false;
    }
    if ($("#_pwd").val().length == 0) {
        $("#_pwd").focus();
        return false;
    }
    if ($("#_firstname").val().length == 0) {
        $("#_firstname").focus();
        return false;
    }
    if ($("#_lastname").val().length == 0) {
        $("#_lastname").focus();
        return false;
    }
    if ($("#_email").val().length == 0) {
        $("#_email").focus();
        return false;
    }

    var ajax = new sack();
    ajax.setVar("loginid",$("#_loginid").val());
    ajax.setVar("pwd",$("#_pwd").val());
    ajax.setVar("firstname",$("#_firstname").val());
    ajax.setVar("lastname",$("#_lastname").val());
    ajax.setVar("email",$("#_email").val());
    ajax.setVar("jobpos",$("#_jobpos").val());
    ajax.setVar("m","<?php echo $m; ?>");
    <?php if ($config->SecurityCheck == true) { if (strlen($config->GoogleCaptchaKey) != 0){ ?>
        var gcaptcha = $('.js-register-validation').find('textarea[name="g-recaptcha-response"]').val();
        if (gcaptcha.length == 0) {
            SweetAlert('error','Ops !','<?php echo _VERIFY_GOOGLE_CAPTCHA?>');
            return false;
        }
        ajax.setVar("g-recaptcha-response",gcaptcha);
    <?php } else { ?>
        if ($("#_sec_register").val().length == 0) {
            $("#_sec_register").focus();
            return false;
        }
        ajax.setVar("num",$('#_num_register').val());
        ajax.setVar("sec",$('#_sec_register').val());
    <?php }} ?>
    ajax.setVar("op","register");
    Ajx(ajax,'btn-register');
    return false;
}
function auth() {
    if ($("#loginid").val().length == 0) {
        $("#loginid").focus();
        return false;
    }
    if ($("#pwd").val().length == 0) {
        $("#pwd").focus();
        return false;
    }

    var ajax = new sack();
    ajax.setVar("loginid",$("#loginid").val());
    ajax.setVar("pwd",$("#pwd").val());
    if ($("#remember_me").prop('checked')) {
        ajax.setVar("remember_me","1");
    } else {
        ajax.setVar("remember_me","0");
    }
    ajax.setVar("m","<?php echo $m; ?>");
    <?php if ($config->SecurityCheck == true) { if (strlen($config->GoogleCaptchaKey) != 0){ ?>
        var gcaptcha = $('.js-login-validation').find('textarea[name="g-recaptcha-response"]').val();
        if (gcaptcha.length == 0) {
            SweetAlert('error','Ops !','<?php echo _VERIFY_GOOGLE_CAPTCHA?>');
            return false;
        }
        ajax.setVar("g-recaptcha-response",gcaptcha);
    <?php } else { ?>
        if ($("#_sec").val().length == 0) {
            $("#_sec").focus();
            return false;
        }
        ajax.setVar("num",$('#_num').val());
        ajax.setVar("sec",$('#_sec').val());
    <?php }} ?>
    ajax.setVar("op","auth");
    Ajx(ajax,'btn-login');
    return false;
}
function change_pwd() {
    if ($("#new_pwd").val().length == 0) {
        SweetAlert('error','Ops !','<?php echo sprintf(_PLEASE_ENTER_AT_LEAST, 5)?>');
        $("#new_pwd").select();
        return false;
    }
    if ($("#r_new_pwd").val().length == 0) {
        SweetAlert('error','Ops !','<?php echo sprintf(_PLEASE_ENTER_AT_LEAST, 5)?>');
        $("#r_new_pwd").select();
        return false;
    }
    if ($("#new_pwd").val() != $("#r_new_pwd").val()) {
        SweetAlert('error','Ops !','<?php echo _PASSWORD_DID_NOT_MATCH; ?>');
        $("#r_new_pwd").select();
        return false;
    }

    var ajax = new sack();
    ajax.setVar("pwd",$("#new_pwd").val());    
    ajax.setVar("code",$("#code").val());    
    ajax.setVar("op","reset_pwd");
    Ajx(ajax,'btn-changepwd','p-changepwd');
    return false;
}
<?php } else {
/**
#---------------------------------------------
# [ONLINE] - GLOBAL
#---------------------------------------------
*/?>
<?php
		# First Time Login
		$FirstTimeLogin = intval(getUser("FirstTimeLogin"));
		if ($FirstTimeLogin == 1) {
?>
setTimeout(function() {
	$('#WelcomeDialog').modal('show');
},2000);
<?php   } # End First Time Login ?>
<?php
		# User Lockscreen
		$UserLockscreen = intval(getUser("isLockscreen"));
		if ($UserLockscreen == 1) {
			echo "$(\"#pwd-unlock-screen\").focus();";
		}
		
		# User Need to Change Password
		$NeedChangePwd = intval(getv("NeedChangePwd",TBL_USERS,"UID",USERID));
		if ($NeedChangePwd == 1 && $FirstTimeLogin == 0) {
			echo "setTimeout(function(){ $(\"#pwd-new\").focus(); }, 1000);";
		}
?>
/* GENERAL */
function Rating(type,id,score) {
    var ajax = new sack();
    ajax.setVar("type",type);
    ajax.setVar("id",id);
    ajax.setVar("score",score);
    ajax.setVar("op","rating");
    Ajx(ajax);
    return false;
}
function MAAR() {
    var ajax = new sack();
    ajax.setVar("op","maar");
    Ajx(ajax,'btn-maar');
    return false;
}

/* USERS */
function welcome() {
    var ajax = new sack();
    ajax.setVar("dont_show",$('#dont_show').prop('checked'));
    ajax.setVar("op","welcome");
    Ajx(ajax);
}
function lock_screen(redirect) {
    if (typeof(redirect) === 'undefined') {
        redirect = '';
    }
    var ajax = new sack();
    ajax.setVar("redirect",redirect);
    ajax.setVar("op","lock_screen");
    Ajx(ajax);
}
function unlock_screen() {
    if ($("#pwd-unlock-screen").val().length == 0) {
        $("#pwd-unlock-screen").focus();
        return false;
    }

    var ajax = new sack();
    ajax.setVar("op","unlock_screen");
    ajax.setVar("pwd",$("#pwd-unlock-screen").val());
    Ajx(ajax,'btn-unlock-screen');
    return false;
}
function chg_pwd() {
    if ($("#pwd-new").val().length == 0) {
        SweetAlert('error','Ops !','<?php echo _WARN_ENTER_NEW_PASSWORD; ?>');
        $("#pwd-new").select();
        return false;
    }

    if ($("#pwd-new").val().length == 0) {
        SweetAlert('error','Ops !','<?php echo sprintf(_PLEASE_ENTER_AT_LEAST, 5)?>');
        $("#pwd-new").select();
        return false;
    }

    if ($("#pwd-new").val() != $("#retype-pwd-new").val()) {
        SweetAlert('error','Ops !','<?php echo _PASSWORD_DID_NOT_MATCH; ?>');
        $("#pwd-new").select();
        return false;
    }

    var ajax = new sack();
    ajax.setVar("op","change_pwd");
    ajax.setVar("pwd",$("#pwd-new").val());
    Ajx(ajax,'btn-chg-pwd');
    return false;
}
function logout(redirect) {
    if (typeof(redirect) === 'undefined') {
        redirect = '';
    }
    swal({
        title: "<?php echo _LOGOUT; ?> ?",
        html: "<?php echo _WARN_LOGOUT; ?>",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "<?php echo _YES;?>",
        cancelButtonText: "<?php echo _CANCEL;?>",
        showLoaderOnConfirm: true,
        allowOutsideClick: false
    }).then(function()
    {
        $.ajax({
            method: "POST",
            url: "../../ajax.php",
            data: {
                op: "logout",
                redirect: redirect,
                m: "<?php echo $m;?>"
            }
        }).success(function(data) {
            eval(data);
        });
    });
}

/* PROFILE */
function ClearPICT() {
    $('#_jawatan').val('').trigger('change');
    $('#_nama_pict').val('');
    $('#_nokp_pict').val('');
    $('#_mobileno_pict').val('');
    $('#_email_pict').val('');
}
function DialogPICT() {
    ClearPICT();
    $('#DialogPICT').modal();    
}
function AddPICT() {
    if ($("#_jawatan").val().length == 0) {
        $("#_jawatan").select2('open');
        return false;
    }

    if ($("#_nama_pict").val().length == 0) {
        $("#_nama_pict").focus();
        return false;
    }

    if ($("#_nokp_pict").val().length == 0) {
        $("#_nokp_pict").focus();
        return false;
    }

    if ($("#_mobileno_pict").val().length == 0) {
        $("#_mobileno_pict").focus();
        return false;
    }

    if ($("#_email_pict").val().length == 0) {
        $("#_email_pict").focus();
        return false;
    }
    
    var ajax = new sack();
    ajax.setVar("jawatan",$('#_jawatan').val());
    ajax.setVar("nama",$('#_nama_pict').val());
    ajax.setVar("nokp",$('#_nokp_pict').val());
    ajax.setVar("mobileno",$('#_mobileno_pict').val());
    ajax.setVar("email",$('#_email_pict').val());
    ajax.setVar("op","save_pict");
    Ajx(ajax,'btn_pict_save');
    return false;    
}
function DeletePICT(id) {
    swal({
        title: "<?php echo _CONFIRM_DELETE; ?>",
        html: "<?php echo _WARN_CONFIRM_DELETE; ?>",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "<?php echo _YES;?>",
        cancelButtonText: "<?php echo _CANCEL;?>",
        showLoaderOnConfirm: true,
        allowOutsideClick: false
    }).then(function()
    {
        var ajax = new sack();
        ajax.setVar("id",id);
        ajax.setVar("op","delete_pict");
        Ajx(ajax);
    });    
}

function LayoutTempatBertugas(jab) {
    
    $('#_jpn').val('').trigger('change');

    if (jab == 'JPN')
    {
        $('#_jpn').next('.select2-container').show();
        $('#_ppd').next('.select2-container').hide();
        $('#_pkg').next('.select2-container').hide();
        $('#_sekolah').next('.select2-container').hide();
    }
    else if (jab == 'PPD')
    {
        $('#_ppd').val('').trigger('change');        

        $('#_jpn').next('.select2-container').addClass('push-10');
        $('#_jpn').next('.select2-container').show();        
        $('#_ppd').next('.select2-container').show();

        $('#_pkg').next('.select2-container').hide();
        $('#_sekolah').next('.select2-container').hide();
    }
    else if (jab == 'PKG')
    {
        $('#_ppd').val('').trigger('change');
        $('#_pkg').val('').trigger('change');

        $('#_jpn').next('.select2-container').addClass('push-10');
        $('#_jpn').next('.select2-container').show();
        $('#_ppd').next('.select2-container').addClass('push-10');
        $('#_ppd').next('.select2-container').show();
        $('#_pkg').next('.select2-container').show();

        $('#_sekolah').next('.select2-container').hide();
    }
    else if (jab == 'SEK')
    {
        $('#_ppd').val('').trigger('change');
        $('#_pkg').val('').trigger('change');
        $('#_sekolah').val('').trigger('change');

        $('#_jpn').next('.select2-container').addClass('push-10');
        $('#_jpn').next('.select2-container').show();
        $('#_ppd').next('.select2-container').addClass('push-10');
        $('#_ppd').next('.select2-container').show();
        $('#_pkg').next('.select2-container').addClass('push-10');
        $('#_pkg').next('.select2-container').show();
        $('#_sekolah').next('.select2-container').show();
    }
    else
    {
        return;
    }
}
function ChangePPD(jpn) {
    var sel = '';
    $('input[name="_tempatbertugas"]').filter(':checked').each(function(){
        sel = this.value;
    });

    if (sel != 'JPN')
    {
        var ajax = new sack();
        ajax.setVar("mode",sel);
        ajax.setVar("JPN",jpn);
        ajax.setVar("op","change-ppd");
        Ajx(ajax);
    }
}
function ChangePKGSEK(ppd) {
    var sel = '';
    $('input[name="_tempatbertugas"]').filter(':checked').each(function(){
        sel = this.value;
    });

    if (sel != 'PPD')
    {
        var ajax = new sack();
        ajax.setVar("mode",sel);
        ajax.setVar("PPD",ppd);
        ajax.setVar("op","change-pkgsek");
        Ajx(ajax);
    }
}
function SaveProfile() {
    if ($("#_firstname").val().length == 0) {
        $("#_firstname").focus();
        return false;
    }
    if ($("#_nokp").val().length != 12) {
        $("#_nokp").focus();
        return false;
    }
    if ($("#_gred").val().length == 0) {
        $('#_gred').select2('open');
        return false;
    }
    if ($("#_email").val().length == 0) {
        $('#_email').focus();
        return false;
    }
    if ($("#_mobileno").val().length == 0) {
        $('#_mobileno').focus();
        return false;
    }    
    if ($("#_akademik").val().length == 0) {
        $('#_akademik').select2('open');
        return false;
    }
    if ($("#_tarafjawatan").val().length == 0) {
        $('#_tarafjawatan').select2('open');
        return false;
    }
    if ($("#_tarikh_lantikan_pertama").val().length == 0) {
        $('#_tarikh_lantikan_pertama').focus();
        return false;
    }
    if ($("#_tarikh_khidmat").val().length == 0) {
        $('#_tarikh_khidmat').focus();
        return false;
    }
    if ($("#_opsyen").val().length == 0) {
        $('#_opsyen').focus();
        return false;
    }    
    if ($("#_jarak").val().length == 0) {
        $('#_jarak').focus();
        return false;
    }
    if ($("#_alamat1").val().length == 0) {
        $('#_alamat1').focus();
        return false;
    }
    if ($("#_poskod").val().length != 5) {
        $('#_poskod').focus();
        return false;
    }
    if ($("#_bandar").val().length == 0) {
        $('#_bandar').focus();
        return false;
    }
    if ($("#_negeri").val().length == 0) {
        $('#_negeri').select2('open');
        return false;
    }
    
    var tb = '';
    $('input[name="_tempatbertugas"]').filter(':checked').each(function(){
        tb = this.value;
    });
    if (tb.length == 0) {
        SweetAlert('error','Ops !','Sila masukkan maklumat tempat bertugas anda.<br>Terima kasih.');
        return false;
    }
    if (tb == 'JPN') {
        if ($("#_jpn").val().length == 0) {
            $('#_jpn').select2('open');
            return false;
        }
    }
    if (tb == 'PPD') {
        if ($("#_jpn").val().length == 0) {
            $('#_jpn').select2('open');
            return false;
        }
        if ($("#_ppd").val().length == 0) {
            $('#_ppd').select2('open');
            return false;
        }
    }
    if (tb == 'PKG') {
        if ($("#_jpn").val().length == 0) {
            $('#_jpn').select2('open');
            return false;
        }
        if ($("#_ppd").val().length == 0) {
            $('#_ppd').select2('open');
            return false;
        }
        if ($("#_pkg").val().length == 0) {
            $('#_pkg').select2('open');
            return false;
        }
    }
    if (tb == 'SEK') {
        if ($("#_jpn").val().length == 0) {
            $('#_jpn').select2('open');
            return false;
        }
        if ($("#_ppd").val().length == 0) {
            $('#_ppd').select2('open');
            return false;
        }
        if ($("#_pkg").val().length == 0) {
            $('#_pkg').select2('open');
            return false;
        }
        if ($("#_sekolah").val().length == 0) {
            $('#_sekolah').select2('open');
            return false;
        }
    }
    
    if ($("#pwd").val().length != 0)
    {
        if ($("#rpwd").val() != $("#pwd").val()) {
            $("#rpwd").select();
            return false;
        }    
    }

    var ajax = new sack();
    ajax.setVar("firstname",$('#_firstname').val());
    ajax.setVar("nokp",$('#_nokp').val());
    ajax.setVar("gred",$('#_gred').val());    
    ajax.setVar("email",$('#_email').val());
    ajax.setVar("mobileno",$('#_mobileno').val());
    ajax.setVar("akademik",$('#_akademik').val());
    ajax.setVar("pengkhususan",$('#_pengkhususan').val());
    ajax.setVar("taraf_jawatan",$('#_tarafjawatan').val());
    ajax.setVar("tarikh_lantikan_pertama",$('#_tarikh_lantikan_pertama').val());
    ajax.setVar("tarikh_khidmat",$('#_tarikh_khidmat').val());
    ajax.setVar("opsyen",$('#_opsyen').val());
    ajax.setVar("jarak",$('#_jarak').val());
    ajax.setVar("alamat1",$('#_alamat1').val());
    ajax.setVar("alamat2",$('#_alamat2').val());
    ajax.setVar("poskod",$('#_poskod').val());
    ajax.setVar("bandar",$('#_bandar').val());
    ajax.setVar("negeri",$('#_negeri').val());
    ajax.setVar("tempat_bertugas",tb);
    ajax.setVar("jpn",$('#_jpn').val());
    ajax.setVar("ppd",$('#_ppd').val());
    ajax.setVar("pkg",$('#_pkg').val());
    ajax.setVar("sekolah",$('#_sekolah').val());
    ajax.setVar("pwd",$('#pwd').val());
    ajax.setVar("op","save_profile");
    Ajx(ajax,'btn-save');
    return false;
}
function DeleteNotifications(period) {
    swal({
        title: "<?php echo _DELETE_NOTIFICATIONS; ?> ?",
        html: "<?php echo _WARN_DELETE_NOTIFICATIONS; ?>",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "<?php echo _YES;?>",
        cancelButtonText: "<?php echo _CANCEL;?>",
        showLoaderOnConfirm: true,
        allowOutsideClick: false
    }).then(function()
    {
        $.ajax({
            method: "POST",
            url: "../../ajax.php",
            data: { op: "delete_notifications", data: period }
        }).success(function(data) {
            eval(data);
        });
    });
}

/* PM */
function LoadMsg() {
    $('#msg-header-main').show();
    $('#msg-header').hide();
    $('#block-msg').toggleClass('block-opt-refresh');
    App.initLoaderStatic('messages','load-msg','');
}
function ViewMsg(cid) {
    window.location.href = '<?php echo SITEURL;?>/messages/?cid='+cid;
}
function PMReply(cid) {
    var txt = $('#reply_txt');
    if (txt.val().length == 0)
    {
        Notify('danger','<?php echo _PLEASE_ENTER_YOUR_MESSAGE; ?>');
        txt.focus();
        return false;
    }

    var ajax = new sack();
    ajax.setVar("_cid",cid);
    ajax.setVar("_msg",txt.val());
    ajax.setVar("op","pm_reply");
    Ajx(ajax,'btn-reply','p-reply');
    return false;
}
function DeleteConversation(cid,ret) {
    if (cid.length == 0)
    {
        var cid = [];
        $('.js-table-checkable input:checkbox').filter(':checked').each(function(){
            cid.push(this.value);
        });

        if (cid.length == 0)
        {
            Notify('danger','<?php echo _PLEASE_SELECT_YOUR_MSG_TO_DELETE;?>');
            return false;
        }
    }

    swal({
        title: "<?php echo _CONFIRM_DELETE; ?>",
        html: "<?php echo _WARN_CONFIRM_DELETE; ?>",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "<?php echo _YES;?>",
        cancelButtonText: "<?php echo _CANCEL;?>",
        showLoaderOnConfirm: false,
        allowOutsideClick: false
    }).then(function()
    {
        var ajax = new sack();
        ajax.setVar("op","delete_conversation");
        ajax.setVar("cid",cid);
        ajax.setVar("ret",ret);
        Ajx(ajax);
    });
}
function Compose() {
    ClearPM();
    $('#PMDialog').modal();
}
function SendPM(refresh) {
    if ($('.js-pm').valid())
    {
        if ($('#_to').val().length == 0) {
            $('#_to').select2('open');
            return false;
        }

        var ajax = new sack();
        ajax.setVar("_receivers",$('#_to').val());
        ajax.setVar("_msg",$('#pm_txt').val());
        ajax.setVar("refresh",refresh);        
        ajax.setVar("m","<?php echo $m; ?>");
        ajax.setVar("op","send_pm");
        Ajx(ajax,'btn-sendpm');
    }
    return false;
}
function ClearPM() {
    $('#_to').val('');
    $('#_to').select2().val('');
    $('#pm_txt').val('');
}
function SelectAllMsg() {
    var $table = jQuery('.js-table-checkable');
    jQuery('tbody input:checkbox', $table).each(function() {
        var $checkbox = jQuery(this);
        $checkbox.prop('checked', true);
    });
}
function DeselectAllMsg() {
    var $table = jQuery('.js-table-checkable');
    jQuery('tbody input:checkbox', $table).each(function() {
        var $checkbox = jQuery(this);
        $checkbox.prop('checked', false);
    });
}

/* MESSAGES CENTER */
function Reply(mid) {
    var txt = $('#_reply_txt_'+mid);

    if (txt.val().length == 0) {
        Notify('danger','<?php echo _PLEASE_ENTER_YOUR_MESSAGE;?>');
        txt.focus();
        return false;
    }

    var ajax = new sack();
    ajax.setVar("_mid",mid);
    ajax.setVar("_msg",txt.val());
    ajax.setVar("op","msgcenter_reply");
    Ajx(ajax,'btn-reply-msg-'+mid,'p-reply-'+mid);
    return false;
}
function DeleteReply(mid) {
    swal({
        title: "<?php echo _CONFIRM_DELETE; ?>",
        html: "<?php echo _WARN_CONFIRM_DELETE; ?>",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "<?php echo _YES;?>",
        cancelButtonText: "<?php echo _CANCEL;?>",
        showLoaderOnConfirm: true,
        allowOutsideClick: false
    }).then(function()
    {
        $.ajax({
            method: "POST",
            url: "../../ajax.php",
            data: { op: "delete_reply", mid: mid }
        }).success(function(data) {
            eval(data);
        });
    });
}
function SearchMessage(q) {
    $('#btn-search-msg').prop("disabled",true);
    App.initLoaderStatic('messages-center','load-msg','S|' + q);
    $('#btn-search-msg').prop("disabled",false);
    return false;
}

<?php if (is_admin($w_user) || is_sadmin($w_user)) {
/**
#---------------------------------------------
# [ONLINE] - ADMINISTRATORS ONLY (BOTH) [GLOBAL]
#---------------------------------------------
*/?>
/* USERS */
function ClearNewUser() {
    $('#UserID').val('0');
    $('#_loginid').val('');
    $('#_pwd').val('');
    $('#_firstname').val('');
    $('#_lastname').val('');
    $('#_email').val('');
    $('#_jobpos').val('');
    $('#_ur').val('').trigger('change');
    $('#_ug').val('').trigger('change');
    $('input[name="_accstatus"]').each(function(){
        $(this).prop('checked',false);
    });
    $('#_accactive').prop('checked',true);    
    $('#_need_chg_pwd').prop('checked',false);
}
function NewUser() {
    ClearNewUser();
    $('#UserDialog').modal();
    setTimeout(function(){
        $('#_loginid').focus();
    },500);    
}
function AddUser() {
    var uid = $('#UserID').val();
    var accstatus = '';

    $('input[name="_accstatus"]').filter(':checked').each(function(){
        accstatus = this.value;
    });    
    if ($("#_loginid").val().length == 0) {
        $("#_loginid").focus();
        return false;
    }
    if ($("#_firstname").val().length == 0) {
        $("#_firstname").focus();
        return false;
    }
    if ($("#_lastname").val().length == 0) {
        $("#_lastname").focus();
        return false;
    }
    
    if (uid == 0)
    {
        if ($("#_pwd").val().length == 0) {
            $("#_pwd").focus();
            return false;
        }
    }
    
    var ajax = new sack();
    ajax.setVar("loginid",$('#_loginid').val());
    ajax.setVar("pwd",$('#_pwd').val());
    ajax.setVar("firstname",$('#_firstname').val());
    ajax.setVar("lastname",$('#_lastname').val());
    ajax.setVar("email",$('#_email').val());
    ajax.setVar("job",$('#_jobpos').val());
    ajax.setVar("user_roles",$('#_ur').select2('val'));
    ajax.setVar("user_groups",$('#_ug').select2('val'));    
    ajax.setVar("accstatus",accstatus);
    ajax.setVar("UserID",$('#UserID').val());
    if ($("#_need_chg_pwd").prop('checked')) {
        ajax.setVar("chgpwd","1");
    } else {
        ajax.setVar("chgpwd","0");
    }
    ajax.setVar("op","save_user");
    Ajx(ajax,'btn_u_save');
    return false;    
}
function EditUser(uid) {
    var ajax = new sack();
    ajax.setVar("uid",uid);
    ajax.setVar("op","edit_user");
    Ajx(ajax);    
}
function DeleteUser(uid) {
    swal({
        title: "<?php echo _CONFIRM_DELETE; ?>",
        html: "<?php echo _WARN_CONFIRM_DELETE; ?>",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "<?php echo _YES;?>",
        cancelButtonText: "<?php echo _CANCEL;?>",
        showLoaderOnConfirm: true,
        allowOutsideClick: false
    }).then(function()
    {
        var ajax = new sack();
        ajax.setVar("uid",uid);
        ajax.setVar("op","delete_user");
        Ajx(ajax);
    });    
}

/* USER ROLES */
function ClearUR() {
    $('#_urole').val('');
    $('#_urolename').val('');
}
function NewUR() {
    ClearUR();
    $('#URDialog').modal();
    setTimeout(function(){
        $('#_urole').focus();
    },500);    
}
function AddUR() {
    var id = $('#ID').val();

    if ($("#_urole").val().length == 0) {
        $("#_urole").focus();
        return false;
    }

    if ($("#_urolename").val().length == 0) {
        $("#_urolename").focus();
        return false;
    }
    
    var ajax = new sack();
    ajax.setVar("role",$('#_urole').val());
    ajax.setVar("role_name",$('#_urolename').val());
    ajax.setVar("ID",$('#ID').val());
    ajax.setVar("op","save_userrole");
    Ajx(ajax,'btn_ur_save');
    return false;
}
function EditUR(id) {
    var ajax = new sack();
    ajax.setVar("id",id);
    ajax.setVar("op","edit_userrole");
    Ajx(ajax);    
}
function DeleteUR(id) {
    swal({
        title: "<?php echo _CONFIRM_DELETE; ?>",
        html: "<?php echo _WARN_CONFIRM_DELETE; ?>",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "<?php echo _YES;?>",
        cancelButtonText: "<?php echo _CANCEL;?>",
        showLoaderOnConfirm: true,
        allowOutsideClick: false
    }).then(function()
    {
        var ajax = new sack();
        ajax.setVar("id",id);
        ajax.setVar("op","delete_userrole");
        Ajx(ajax);
    });
}
function DefaultUR(id) {
    swal({
        title: "<?php echo _SET_DEFAULT; ?> ?",
        html: "<?php echo _WARN_SET_DEFAULT; ?>",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "<?php echo _YES;?>",
        cancelButtonText: "<?php echo _CANCEL;?>",
        showLoaderOnConfirm: true,
        allowOutsideClick: false
    }).then(function()
    {
        var ajax = new sack();
        ajax.setVar("id",id);
        ajax.setVar("op","default_userrole");
        Ajx(ajax);
    });
}

/* USERGROUPS */
function ClearUG() {
    $('#_groupcode').val('');
    $('#_groupname').val('');
}
function NewUG() {
    ClearUG();
    $('#UGDialog').modal();
    setTimeout(function(){
        $('#_groupcode').focus();
    },500);    
}
function AddUG() {
    if ($("#_groupcode").val().length == 0) {
        $("#_groupcode").focus();
        return false;
    }
    
    if ($("#_groupname").val().length == 0) {
        $("#_groupname").focus();
        return false;
    }

    var ajax = new sack();
    ajax.setVar("groupcode",$('#_groupcode').val());
    ajax.setVar("groupname",$('#_groupname').val());
    ajax.setVar("gid",$('#GID').val());
    ajax.setVar("op","save_group");
    Ajx(ajax,'btn_group_save');
    return false;
}
function EditUG(gid) {
    var ajax = new sack();
    ajax.setVar("gid",gid);
    ajax.setVar("op","edit_group");
    Ajx(ajax);    
}
function DeleteUG(gid) {
    swal({
        title: "<?php echo _CONFIRM_DELETE; ?>",
        html: "<?php echo _WARN_CONFIRM_DELETE; ?>",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "<?php echo _YES;?>",
        cancelButtonText: "<?php echo _CANCEL;?>",
        showLoaderOnConfirm: true,
        allowOutsideClick: false
    }).then(function()
    {
        var ajax = new sack();
        ajax.setVar("gid",gid);
        ajax.setVar("op","delete_group");
        Ajx(ajax);
    });
}
function DefaultUG(gid) {
    swal({
        title: "<?php echo _SET_DEFAULT; ?> ?",
        html: "<?php echo _WARN_SET_DEFAULT; ?>",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "<?php echo _YES;?>",
        cancelButtonText: "<?php echo _CANCEL;?>",
        showLoaderOnConfirm: true,
        allowOutsideClick: false
    }).then(function()
    {
        var ajax = new sack();
        ajax.setVar("gid",gid);
        ajax.setVar("op","default_group");
        Ajx(ajax);
    });
}

/* MESSAGES */
function ToggleUG() {
    $("#_select_all_usergroups").change(function() {
        $('input[name="_ugroups"]').prop('checked', $(this).prop("checked"));
    });
}
function ClearNewMsg() {
    $('#MID').val('0');
    $('#_title').val('');
    $('input[name="_msgtype"]').each(function(){
        $(this).prop('checked',false);
    });
    $('#_txt').summernote('reset');
    $('#_active').prop('checked', true);
    $('#_allow_reply').prop('checked', true);
    $('#_expired_on').val('');
    $('input[name="_action_expired"]').each(function(){
        $(this).prop('checked',false);
    });
    $('#_ae_inactive').prop('checked', true);
    $('#_select_all_usergroups').prop('checked', false);
    $('input[name="_ugroups"]').each(function(){
        $(this).prop('checked',false);
    });
}
function NewMsg() {
    ClearNewMsg();
    $('#MsgDialog').modal();
    setTimeout(function(){
        $('#_title').focus();
    },500);    
}
function AddMsg() {
    var mid = $('#MID').val();
    var msgtype = '';
    var aes = '';
    var depts = [];

    if ($("#_title").val().length == 0) {
        $("#_title").focus();
        return false;
    }
    if ($('#_txt').summernote('isEmpty')) {
        $("#_txt").summernote('focus');
        return false;
    }
    $('input[name="_msgtype"]').filter(':checked').each(function(){
        msgtype = this.value;
    });
    if (msgtype.length == 0) {
        SweetAlert('error','Ops !','<?php echo _PLEASE_CHOOSE_MESSAGE_TYPE;?>');
        return false;
    }
    $('input[name="_action_expired"]').filter(':checked').each(function(){
        aes = this.value;
    });
    if ($('#_expired_on').val().length != 0) {
        if (aes.length == 0) {
            SweetAlert('error','Ops !','<?php echo _PLEASE_CHOOSE_ACTION_WHEN_EXPIRED;?>');
            return false;
        }
    }
    $('input[name="_depts"]').filter(':checked').each(function(){
        depts.push(this.value);
    });
    if (depts.length == 0) {
        SweetAlert('error','Ops !','<?php echo _PLEASE_SELECT_RECIPIENT;?>');
        return false;
    }

    var ajax = new sack();
    ajax.setVar("title",$('#_title').val());
    ajax.setVar("msgtype",msgtype);
    ajax.setVar("msgstatus",$('#_active').prop('checked'));
    ajax.setVar("allowreply",$('#_allow_reply').prop('checked'));
    ajax.setVar("txt",$('#_txt').summernote('code'));
    ajax.setVar("expired_on",$('#_expired_on').val());
    ajax.setVar("action_expired",aes);
    ajax.setVar("depts",depts);
    ajax.setVar("tags",$('#_tags').val());
    ajax.setVar("MID",mid);
    ajax.setVar("op","save_msg");
    Ajx(ajax,'btn_save');
    return false;    
}
function EditMsg(mid) {
    var ajax = new sack();
    ajax.setVar("mid",mid);
    ajax.setVar("op","edit_msg");
    Ajx(ajax);    
}
function DeleteMsg(mid) {
    swal({
        title: "<?php echo _CONFIRM_DELETE; ?>",
        html: "<?php echo _WARN_CONFIRM_DELETE; ?>",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "<?php echo _YES;?>",
        cancelButtonText: "<?php echo _CANCEL;?>",
        showLoaderOnConfirm: true,
        allowOutsideClick: false
    }).then(function()
    {
        var ajax = new sack();
        ajax.setVar("mid",mid);
        ajax.setVar("op","delete_msg");
        Ajx(ajax);
    });
}

<?php if (is_sadmin($w_user)) {
/**
#---------------------------------------------
# [ONLINE] - SUPER ADMINISTRATORS ONLY
#---------------------------------------------
*/?>
function SaveSystemConfig() {
    if ($('#_close_reason').summernote('isEmpty')) {
        Notify('danger','<?php echo _PLEASE_ENTER_CLOSED_REASON;?>');
        App.blocks('#_system_config', 'content_show');
        $("#_close_reason").summernote('focus');
        return false;
    }
    if ($("#_logintype").val().length == 0) {
        Notify('danger','<?php echo _PLEASE_ENTER_LOGIN_TYPE;?>');
        App.blocks('#_system_config', 'content_show');
        $("#_logintype").focus();
        return false;
    }
    if ($("#_login_user_session").val().length == 0) {
        Notify('danger','<?php echo _PLEASE_ENTER_USER_SESSION;?>');
        App.blocks('#_system_config', 'content_show');
        $("#_login_user_session").focus();
        return false;
    }
    if ($("#_login_session_remember").val().length == 0) {
        Notify('danger','<?php echo _PLEASE_ENTER_SESSION_REMEMBER;?>');
        App.blocks('#_system_config', 'content_show');
        $("#_login_session_remember").focus();
        return false;
    }
    if ($("#_web_pipeline").val().length == 0) {
        Notify('danger','<?php echo _PLEASE_ENTER_WEB_PIPELINE;?>');
        App.blocks('#_system_config', 'content_show');
        $("#_web_pipeline").focus();
        return false;
    }
    if ($("#_loadpm").val().length == 0) {
        Notify('danger','<?php echo _PLEASE_ENTER_LOAD_PM;?>');
        App.blocks('#_system_config', 'content_show');
        $("#_loadpm").focus();
        return false;
    }


    if ($("#_site_name").val().length == 0) {
        Notify('danger','<?php echo _PLEASE_ENTER_SITE_NAME;?>');
        App.blocks('#_site_config', 'content_show');
        $("#_site_name").focus();
        return false;
    }
    if ($("#_site_url").val().length == 0) {
        Notify('danger','<?php echo _PLEASE_ENTER_SITE_URL;?>');
        App.blocks('#_site_config', 'content_show');
        $("#_site_url").focus();
        return false;
    }
    if ($("#_site_domain").val().length == 0) {
        Notify('danger','<?php echo _PLEASE_ENTER_SITE_DOMAIN;?>');
        App.blocks('#_site_config', 'content_show');
        $("#_site_domain").focus();
        return false;
    }
    if ($("#_site_slogan").val().length == 0) {
        Notify('danger','<?php echo _PLEASE_ENTER_SITE_SLOGAN;?>');
        App.blocks('#_site_config', 'content_show');
        $("#_site_slogan").focus();
        return false;
    }
    if ($('#_site_description').summernote('isEmpty')) {
        Notify('danger','<?php echo _PLEASE_ENTER_SITE_DESCRIPTION;?>');
        App.blocks('#_site_config', 'content_show');
        $("#_site_description").summernote('focus');
        return false;
    }
    if ($('#_site_keywords').summernote('isEmpty')) {
        Notify('danger','<?php echo _PLEASE_ENTER_SITE_KEYWORDS;?>');
        App.blocks('#_site_config', 'content_show');
        $("#_site_keywords").summernote('focus');
        return false;
    }
    

    if ($('#_dbtype').select2('val').length == 0) {
        Notify('danger','<?php echo _PLEASE_ENTER_DBTYPE;?>');
        App.blocks('#_db_config', 'content_show');
        $("#_dbtype").select2('open');
        return false;
    }
    if ($("#_dbname").val().length == 0) {
        Notify('danger','<?php echo _PLEASE_ENTER_DBNAME;?>');
        App.blocks('#_db_config', 'content_show');
        $("#_dbname").focus();
        return false;
    }
    if ($("#_dbhost").val().length == 0) {
        Notify('danger','<?php echo _PLEASE_ENTER_DBHOST;?>');
        App.blocks('#_db_config', 'content_show');
        $("#_dbhost").focus();
        return false;
    }
    if ($("#_dbuser").val().length == 0) {
        Notify('danger','<?php echo _PLEASE_ENTER_DBUSER;?>');
        App.blocks('#_db_config', 'content_show');
        $("#_dbuser").focus();
        return false;
    }
    if ($("#_dbpwd").val().length == 0) {
        Notify('danger','<?php echo _PLEASE_ENTER_DBPWD;?>');
        App.blocks('#_db_config', 'content_show');
        $("#_dbpwd").focus();
        return false;
    }

    if ($("#_admin_mail").val().length == 0) {
        Notify('danger','<?php echo _PLEASE_ENTER_ADMIN_MAIL;?>');
        App.blocks('#_mail_config', 'content_show');
        $("#_admin_mail").focus();
        return false;
    }
    if ($('#_welcome_msg').summernote('isEmpty')) {
        Notify('danger','<?php echo _PLEASE_ENTER_WELCOME_MSG;?>');
        App.blocks('#_welcome_config', 'content_show');
        $("#_welcome_msg").summernote('focus');
        return false;
    }
    
    var ajax = new sack();
    ajax.setVar("ClosedReason",$('#_close_reason').summernote('code'));
    ajax.setVar("DefaultTheme",$('#_default_theme').select2('val'));
    ajax.setVar("LoginType",$('#_logintype').val());
    ajax.setVar("LoginUserSession",$('#_login_user_session').val());
    ajax.setVar("LoginSessionRemember",$('#_login_session_remember').val());
    ajax.setVar("WebPipeline",$('#_web_pipeline').val());
    ajax.setVar("LoadPM",$('#_loadpm').val());
    ajax.setVar("SiteName",$('#_site_name').val());
    ajax.setVar("SiteUrl",$('#_site_url').val());
    ajax.setVar("SiteDomain",$('#_site_domain').val());
    ajax.setVar("SiteSlogan",$('#_site_slogan').val());
    ajax.setVar("SiteDescription",$('#_site_description').summernote('code'));
    ajax.setVar("SiteKeywords",$('#_site_keywords').summernote('code'));
    ajax.setVar("DBType",$('#_dbtype').select2('val'));
    ajax.setVar("DBName",$('#_dbname').val());
    ajax.setVar("DBHost",$('#_dbhost').val());
    ajax.setVar("DBUser",$('#_dbuser').val());
    ajax.setVar("DBPwd",$('#_dbpwd').val());
    ajax.setVar("GCaptchaKey",$('#_gcaptcha_key').val());
    ajax.setVar("GCaptchaSecret",$('#_gcaptcha_secret').val());
    ajax.setVar("AdminMail",$('#_admin_mail').val());
    ajax.setVar("MailHost",$('#_mail_host').val());
    ajax.setVar("MailUser",$('#_mail_user').val());
    ajax.setVar("MailPwd",$('#_mail_pwd').val());
    ajax.setVar("MailPort",$('#_mail_port').val());
    ajax.setVar("MailSecure",$('#_mail_secure').val());
    ajax.setVar("MailDebug",$('#_mail_debug').val());
    ajax.setVar("Language",$('#_language').val());
    ajax.setVar("WelcomeMsg",$('#_welcome_msg').summernote('code'));
    ajax.setVar("GClientID",$('#_gclient_id').val());
    ajax.setVar("GAPIKey",$('#_gapikey').val());
    ajax.setVar("GAnalytic",$('#_ganalytic').val());
    ajax.setVar("GDefLat",$('#_gdeflat').val());
    ajax.setVar("GDefLon",$('#_gdeflon').val());
    ajax.setVar("GDefZom",$('#_gdefzom').val());
    ajax.setVar("FBGraph",$('#_fbgraph').val());
    ajax.setVar("FBAppID",$('#_fbappid').val());
    ajax.setVar("FBAppSecret",$('#_fbappsecret').val());
    ajax.setVar("TWAccessToken",$('#_tw_access_token').val());
    ajax.setVar("TWTokenSecret",$('#_tw_token_secret').val());
    ajax.setVar("TWConsumerKey",$('#_tw_consumer_key').val());
    ajax.setVar("TWConsumerSecret",$('#_tw_consumer_secret').val());
    ajax.setVar("SMS_MTURL",$('#_sms_mturl').val());
    ajax.setVar("SMSUser",$('#_sms_user').val());
    ajax.setVar("SMSPwd",$('#_sms_pwd').val());
    ajax.setVar("op","save_system_config");
    Ajx(ajax,'btn-save');
    return false;
}
function UpdateConfig(mode,val) {
    var ajax = new sack();
    ajax.setVar("mode",mode);
    ajax.setVar("val",val);
    ajax.setVar("op","update_config");
    Ajx(ajax);
}

/* MENU */
function ClearSaveMenu() {
    $('#_menu_name').val('');
    $('#_parent_menu').val('').trigger('change');
    $('#_menu_key').val('');
    $('#_menu_icon').val('');
    $('#_menu_url').val('');
    $('#_menu_roles').val('').trigger('change');
    $('#_id').val('0');
    $('#_menu_name').focus();
}
function EditMenu(id) {
    var ajax = new sack();
    ajax.setVar("id",id);
    ajax.setVar("op","edit_menu");
    Ajx(ajax);
}
function DeleteMenu(id) {
    swal({
        title: "<?php echo _CONFIRM_DELETE; ?>",
        html: "<?php echo _WARN_CONFIRM_DELETE; ?>",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "<?php echo _YES;?>",
        cancelButtonText: "<?php echo _CANCEL;?>",
        showLoaderOnConfirm: false,
        allowOutsideClick: false
    }).then(function()
    {
        var ajax = new sack();
        ajax.setVar("id",id);
        ajax.setVar("op","delete_menu");
        Ajx(ajax);
    });
}
function SaveMenu() {
    var MenuID = $('#_id').val();

    if ($("#_menu_name").val().length == 0) {
        Notify('danger','<?php echo _PLEASE_ENTER_MENU_NAME;?>');
        $("#_menu_name").focus();
        return false;
    }

    var ajax = new sack();
    ajax.setVar("MenuName",$('#_menu_name').val());
    ajax.setVar("ParentMenu",$('#_parent_menu').select2('val'));
    ajax.setVar("MenuKey",$('#_menu_key').val());
    ajax.setVar("MenuIcon",$('#_menu_icon').val());
    ajax.setVar("MenuURL",$('#_menu_url').val());
    ajax.setVar("MenuRoles",$('#_menu_roles').select2('val'));
    ajax.setVar("MenuID",$('#_id').val());
    $('.mn').filter(':checked').each(function(){
        ajax.setVar("MN",this.value);
    });
    ajax.setVar("op","save_menu");
    Ajx(ajax,'btn-save');
    return false;
}

/* LANGUAGES */
function NewLangPack() {
    $('#LangPackDialog').modal();
    setTimeout(function(){
        $('#lang_code').focus();
    },500);
}
function NewDefine() {
    $('#LDDialog').modal();
    setTimeout(function(){
        $('#phrase_define').focus();
    },500);
}
function AddLangPack() {
    if ($("#lang_code").val().length <= 0) {
        SweetAlert('error','Ops !',"<?php echo _WARN_ENTER_LANG_CODE; ?>");
        $("#lang_code").focus();
        return false;
    }
    
    var ajax = new sack();
    ajax.setVar("lang_code",$('#lang_code').val());
    ajax.setVar("lang_desc",$('#lang_desc').val());
    ajax.setVar("op","add_langpack");
    Ajx(ajax,'btn_lpsave');
    return false;
}
function ClearLangPack() {
    $('#lang_code').val("");
    $('#lang_desc').val("");
}
function AddLD() {
    if ($("#phrase_define").val().length <= 0) {
        SweetAlert('error','Ops !',"<?php echo _WARN_ENTER_PHRASE_DEFINE; ?>");
        $("#phrase_define").focus();
        return false;
    }
    if ($("#phrase_value").val().length <= 0) {
        SweetAlert('error','Ops !',"<?php echo _WARN_ENTER_PHRASE_VALUE; ?>");
        $("#phrase_value").focus();
        return false;
    }
    
    var ajax = new sack();
    ajax.setVar("phrase_define",$('#phrase_define').val());
    ajax.setVar("phrase_value",$('#phrase_value').val());
    ajax.setVar("phraseID",$('#phraseID').val());
    ajax.setVar("op","add_langdefine");
    Ajx(ajax,'btn_ldsave');
    return false;
}
function ClearLD() {
    $('#phrase_define').val("");
    $('#phrase_value').val("");
    $('#phraseID').val("");
}
function DeleteLang(lg) {
    swal({
        title: "<?php echo _CONFIRM_DELETE; ?>",
        html: "<?php echo _WARN_CONFIRM_DELETE; ?>",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "<?php echo _YES;?>",
        cancelButtonText: "<?php echo _CANCEL;?>",
        showLoaderOnConfirm: false,
        allowOutsideClick: false
    }).then(function()
    {
        var ajax = new sack();
        ajax.setVar("lang",lg);
        ajax.setVar("op","delete_lang");
        Ajx(ajax,'btn_dl');
    });
}
function DeletePhrase(id) {
    swal({
        title: "<?php echo _CONFIRM_DELETE; ?>",
        html: "<?php echo _WARN_CONFIRM_DELETE; ?>",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "<?php echo _YES;?>",
        cancelButtonText: "<?php echo _CANCEL;?>",
        showLoaderOnConfirm: false,
        allowOutsideClick: false
    }).then(function()
    {
        var ajax = new sack();
        ajax.setVar("id",id);
        ajax.setVar("op","delete_phrase");
        Ajx(ajax);
    });
}
function EditPhrase(id,define) {
    $('#phrase_define').val(define);
    $('#phraseID').val(id);

    var ajax = new sack();
    ajax.setVar("id",id);
    ajax.setVar("op","edit_phrase");
    Ajx(ajax);

    $('#LDDialog').modal();
    setTimeout(function(){
        $('#phrase_define').focus();
    },500);
}
<?php } # END SUPER ADMINISTRATOR ?>
<?php } # END ADMINISTRATORS ?>
<?php } # END USER ONLINE ?>