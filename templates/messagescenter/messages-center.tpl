<main id="main-container">
    <!-- Page Header -->
    <div class="content bg-primary-dark">
        <div class="row items-push">
            <div class="col-sm-8">
                <h1 class="page-heading text-white">
                    <i class="fa fa-envelope push-20-r"></i>{MESSAGES_CENTER}
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
                </div>
            </div>
        </div>
    </div>
    <!-- END Menu -->

    <!-- Page Content -->
    <div class="content content-narrow">
        <div class="row">
            <div class="col-xs-12">
                <div id="block-search-msg" class="block block-rounded push-10">
                    <form class="form-horizontal" onsubmit="javascript:return SearchMessage($('#qm').val());">
                    <div class="input-group">
                        <input class="form-control input-lg" type="text" id="qm" placeholder="{SEARCH_MESSAGES}...">
                        <span class="input-group-btn">
                            <button id="btn-search-msg" class="btn btn-lg btn-success" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                    </form>
                </div>
            </div>
            <div class="col-xs-12">
                <div id="load-msg"></div>
                <!-- Load More -->
                <input type="hidden" id="load-msg-data-page" value="0">
                <div id="load-msg-loadmore" class="block block-rounded remove-margin hide">
                    <div class="block-content block-content-full block-content-mini text-center bg-gray-lighter">
                        <button id="load-msg-btn-loadmore" class="btn btn-sm btn-primary" onclick="javascript:LoadMore('messages-center','load-msg','#q#');return false;">
                            <i class="fa fa-arrow-down push-5-r"></i>{LOAD_MORE}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>