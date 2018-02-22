<main id="main-container">
    <!-- Page Header -->
    <div class="content bg-primary-dark">
        <div class="row items-push">
            <div class="col-sm-8">
                <h1 class="page-heading text-white">
                    <i class="fa fa-inbox push-20-r"></i>{MESSAGES}
                </h1>
            </div>
            <div class="col-sm-4 text-right">
            </div>
        </div>
    </div>

    <!-- Menu -->
    <div class="content padding-5-t bg-white border-b">
        <div class="push-15 push-10-t">
            <div class="row">
                <div class="col-md-6">
                    <a class="btn btn-default" href="{D_SITEURL}">
                        <i class="fa fa-home"></i>
                    </a>
                    <a id="btn-notifications" class="btn btn-default" href="#" data-toggle="layout" data-action="side_overlay_toggle">
                        <i class="fa fa-bell push-5-r"></i><span id="dashboard-total-notifications" class="font-w700">0</span> {NOTIFICATIONS}
                    </a>
                </div>
                <div class="col-md-6 text-right">
                    <button id="btn-compose" class="btn btn-success" type="button" onclick="javascript:Compose();">
                        <i class="fa fa-send push-5-r"></i>{NEW_MSG}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- END Menu -->

    <!-- Page Content -->
    <div class="content content-narrow">
        <form class="form-horizontal">
        <div class="row">
            <div class="col-xs-12">
                <div id="div-msg" class="text-center"></div>
                <div class="block block-themed block-rounded">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="content_toggle">
                                    <i class="si si-arrow-up"></i>
                                </button>
                            </li>
                        </ul>
                        <h3 class="block-title">
                            <i class="fa fa-inbox push-10-r"></i>{MESSAGES}
                        </h3>
                    </div>
                    <div class="block-content">
                        <div id="msg-header">
                            <div class="row push-5">
                                <div class="col-xs-6 font-w300 h5">
                                    #HeaderTitle#
                                </div>
                                <div class="col-xs-6 text-right">
                                    <div class="btn-group">
                                        <button class="btn btn-default" type="button" onclick="javascript:window.location.href='{D_SITEURL}/messages';return false;">
                                            <i class="fa fa-arrow-left text-primary"></i> 
                                            <span class="hidden-xs">{BACK}</span>
                                        </button>
                                        <button class="btn btn-default" type="button" onclick="javascript:DeleteConversation('#cid#','1');return false;">
                                            <i class="fa fa-times text-danger"></i> 
                                            <span class="hidden-xs">{DELETE}</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pull-r-l">
                            <div id="msg"></div>
                            <input type="hidden" id="msg-data-page" value="0">
                            <div id="msg-loadmore" class="block remove-margin hover hide">
                                <div class="block-content block-content-full block-content-mini text-center">
                                    <button id="msg-btn-loadmore" class="btn btn-sm btn-primary" onclick="javascript:LoadMore('read-message','msg','#cid#');return false;">
                                        <i class="fa fa-arrow-down push-5-r"></i>{LOAD_MORE}
                                    </button>
                                </div>
                            </div>
                            
                            <div id="reply_textarea" class="block push-10-t">
                                <div class="block-content block-content-narrow remove-padding-t remove-padding-b">
                                    <div class="form-group push-5">
                                        <textarea rows="2" data-autogrow class="form-control h5 font-w300" rows="1" id="reply_txt" name="reply_txt" placeholder="{ENTER_YOUR_MESSAGE}..."></textarea>
                                    </div>
                                    <div class="form-group text-right remove-margin-b">
                                        <span id="p-reply" class="h6 font-w300 hide pull-left">
                                            <i class="fa fa-cog fa-spin"></i> &nbsp;{PLEASE_WAIT}...
                                        </span>
                                        <button id="btn-reply" class="btn btn-sm btn-primary" onclick="javascript:PMReply('#cid#');" type="button">
                                            <i class="fa fa-reply push-5-r"></i>{REPLY}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->
#COMPOSE#