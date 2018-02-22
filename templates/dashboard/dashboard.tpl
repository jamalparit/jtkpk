<main id="main-container">
    <!-- Page Header -->
    <div class="content bg-image overflow-hidden" style="background-image: url('{D_URL_IMAGES}/bg/bg-dashboard.jpg');">
        <div class="push-50-t push-15">
            <h1 class="h2 text-black animated zoomIn">{D_SITENAME}</h1>
            <h2 class="h6 text-black-op animated zoomIn">{WELCOME} <b><i>#fullname#</i></b> [ {LASTVISIT} : <i>#lastvisit#</i> ]</h2>
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
    <div class="content">
        <div class="row">
            <div class="col-xs-12">
                <div id="div-msg" class="text-center"></div>
                <div class="block block-themed block-rounded">

                    <div class="block-content bg-gray-light">
                        <div class="row">
                            
                            <!-- Profile -->
                            <div class="col-sm-6 col-md-3">
                                <a class="block block-bordered block-rounded block-link-hover3" href="{D_SITEURL}/profile">
                                    <div class="block-content block-content-full text-center">
                                        <div>
                                            <i class="fa fa-user fa-3x"></i>
                                        </div>
                                        <div class="text-uppercase h5 font-w500 push-15-t push-5">{PROFILE}</div>
                                    </div>
                                </a>
                            </div>

                            <!-- Messages -->
                            <div class="col-sm-6 col-md-3">
                                <a class="block block-bordered block-rounded block-link-hover3" href="{D_SITEURL}/messages">
                                    <div class="block-content block-content-full text-center">
                                        <div>
                                            <i class="fa fa-inbox fa-3x"></i>
                                        </div>
                                        <div class="text-uppercase h5 font-w500 push-15-t push-5">{MESSAGES}</div>
                                    </div>
                                </a>
                            </div>

                            <!-- Messages Center -->
                            <div class="col-sm-6 col-md-3">
                                <a class="block block-bordered block-rounded block-link-hover3" href="{D_SITEURL}/messages-center">
                                    <div class="block-content block-content-full text-center">
                                        <div>
                                            <i class="fa fa-envelope fa-3x"></i>
                                        </div>
                                        <div class="text-uppercase h5 font-w500 push-15-t push-5">{MESSAGES_CENTER}</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->