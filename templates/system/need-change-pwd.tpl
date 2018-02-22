<!-- Need Change Pwd //-->
<div id="need_chgpwd" class="locked #ext#"><div class="lockedpanel">
    <div class="loginuser">
        <img src="#avatar#" class="img-avatar img-avatar96 #online_status#-64" />
    </div>
    <div class="logged">
        <h4>#fullname#</h4>
        <small class="text-muted">
            {NEED_CHANGE_PASSWD}
        </small>
    </div>
    <form id="chg_pwd" method="post" onSubmit="javascript:return chg_pwd();">
        <div class="input-group push-10">
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
            <input type="password" id="pwd-new" class="form-control" placeholder="{ENTER_NEW_PASSWORD}">
        </div>
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
            <input type="password" id="retype-pwd-new" class="form-control" placeholder="{RETYPE_PASSWORD}">
        </div>
        <button type="submit" class="btn btn-success btn-block" id="btn-chg-pwd">{CHANGE_PASSWORD}</button>
    </form>
</div></div>