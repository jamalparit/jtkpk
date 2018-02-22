<!-- Users Menu -->
<li>
    <div class="btn-group">
        <button class="btn btn-default btn-image dropdown-toggle" data-toggle="dropdown" type="button">
            <img class="img-avatar" src="#avatar#" title="#fullname#">
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-menu-right">
            <li class="dropdown-header">{PROFILE}</li>
            <li>
                <a tabindex="-1" href="{D_SITEURL}/profile">
                    <i class="fa fa-user pull-right"></i> {PROFILE}
                </a>
            </li>
            <li>
                <a tabindex="-1" href="{D_SITEURL}/messages">
                    <i class="fa fa-inbox pull-right"></i>#inbox#{MESSAGES}
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a tabindex="-1" href="#" onclick="javascript:lock_screen();return false;">
                    <i class="fa fa-lock pull-right"></i> {LOCK_SCREEN}
                </a>
            </li>
            <li>
                <a tabindex="-1" href="#" onclick="javascript:logout();return false;">
                    <i class="fa fa-sign-out pull-right"></i> {LOGOUT}
                </a>
            </li>
        </ul>
    </div>
</li>

<!-- Select Languages -->
<li>
    <div class="btn-group">
        <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" type="button">           
            <span class="fa fa-language"></span>
        </button>
        <ul class="dropdown-menu dropdown-menu-right">
            <li class="dropdown-header">{LANGUAGES}</li>
            <li>
                <a tabindex="-1" href="?newlang=en">
                    {ENGLISH}
                </a>
            </li>
            <li>
                <a tabindex="-1" href="?newlang=ms">
                    {BAHASA}
                </a>
            </li>
        </ul>
    </div>
</li>

<!-- Sidebar Menu -->
<li>
    <button class="btn" data-toggle="layout" data-action="side_overlay_toggle" type="button">
        <i class="fa fa-tasks"></i><span id="total-notifications" class="badge badge-danger push-5-l font-w500"></span>
    </button>    
</li>