<!-- Lockscreen //-->
<div id="lock_screen" class="locked"><div class="lockedpanel">
    <div class="loginuser">
        <img src="#avatar#" width="100" class="img-circle #online_status#-64" />
    </div>
    <div class="logged">
        <h4>#fullname#</h4>
        <small class="text-muted">{ENTER_PASSWORD_TO_UNLOCK}</small>
    </div>
    <form id="unlock_screen" method="post" onSubmit="javascript:return unlock_screen();">
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input type="password" id="pwd-unlock-screen" class="form-control" placeholder="{ENTER_YOUR_PASSWORD}">
        </div>
        <button type="submit" class="btn btn-success btn-block" id="btn-unlock-screen">{UNLOCK_SCREEN}</button>
    </form>
</div></div>