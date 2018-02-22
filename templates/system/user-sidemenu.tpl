<aside id="side-overlay">
    <div id="side-overlay-scroll">
        <div class="side-header side-content">
            <button class="btn btn-default pull-right" type="button" data-toggle="layout" data-action="side_overlay_close">
                <i class="fa fa-times"></i>
            </button>
            <span>
                <img class="img-avatar img-avatar32" src="#avatar#" title="#fullname#">
                <span class="font-w600 push-10-l">
                    <a href="{D_SITEURL}/profile">#fullname#</a>
                </span>
            </span>
        </div>

        <div class="side-content remove-padding-t">
            <div class="block pull-r-l border-t">
                <div class="block-content tab-content remove-padding-t">
                    <div class="tab-pane fade fade-right in active" id="tabs-side-overlay-overview">
                        
                        <!-- Notifications -->
                        <div class="block pull-r-l push-5">
                            <div class="block-header bg-gray-lighter">
                                <ul class="block-options">
                                    <li>
                                        <button type="button" data-toggle="tooltip" title="{MARK_ALL_AS_READ}" onclick="javascript:MAAR();">
                                            <i class="si si-check"></i>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="refresh-notifications">
                                            <i class="si si-refresh"></i>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
                                    </li>
                                </ul>
                                <h3 class="block-title">
                                    <i class="fa fa-bell text-primary push-10-r"></i>{NOTIFICATIONS}
                                </h3>
                            </div>
                            <div class="block-content block-content-full">
                                <div id="notifications"></div>
                            </div>
                        </div>
                        <!-- END Notifications -->

                        <!-- Who's Online -->
                        <div class="block pull-r-l push-5">
                            <div class="block-header bg-gray-lighter">
                                <ul class="block-options">
                                    <li>
                                        <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="refresh-people-online"><i class="si si-refresh"></i></button>
                                    </li>
                                    <li>
                                        <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
                                    </li>
                                </ul>
                                <h3 class="block-title">
                                    <i class="fa fa-users text-primary push-10-r"></i>{ONLINE} <span id="total-online" class="font-w300"></span>
                                </h3>
                            </div>
                            <div class="block-content block-content-full">
                                <div id="whos-online"></div>
                            </div>
                        </div>
                        <!-- END Who's Online -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>