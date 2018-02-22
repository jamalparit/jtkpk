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
                <div id="block-msg" class="block block-themed block-rounded">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="refresh-inbox">
                                    <i class="si si-refresh"></i>
                                </button>
                            </li>
                            <li>
                                <button type="button" data-toggle="block-option" data-action="content_toggle">
                                    <i class="si si-arrow-up"></i>
                                </button>
                            </li>
                        </ul>
                        <h3 class="block-title">
                            <i class="fa fa-envelope push-10-r"></i>
                            <span id="total-conversations" class="font-w700">0</span> <span class="font-w300">{CONVERSATIONS}</span>
                        </h3>
                    </div>
                    <div class="block-content">
                        <div id="msg-header-main" class="push">
                            <div class="btn-group">
                                <button class="btn btn-default" type="button" onclick="javascript:SelectAllMsg();">
                                    <i class="fa fa-check text-success"></i> 
                                    <span class="hidden-xs">{SELECT_ALL}</span>
                                </button>
                                <button class="btn btn-default" type="button" onclick="javascript:DeselectAllMsg();">
                                    <i class="fa fa-circle-thin text-success"></i> 
                                    <span class="hidden-xs">{CLEAR}</span>
                                </button>
                                <button class="btn btn-default" type="button" onclick="javascript:DeleteConversation('','0');">
                                    <i class="fa fa-times text-danger"></i> 
                                    <span class="hidden-xs">{DELETE}</span>
                                </button>
                            </div>
                        </div>
                        <div id="msg-header"></div>
                        <div class="pull-r-l">
                            <div id="load-msg"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</main>
#COMPOSE#