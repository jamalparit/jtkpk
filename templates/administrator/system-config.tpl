<main id="main-container">
    <!-- Page Header -->
    <div class="content bg-primary-dark">
        <div class="row items-push">
            <div class="col-sm-8">
                <h1 class="page-heading text-white">
                    <i class="fa fa-cogs push-20-r"></i>{SYSTEM_CONFIG}
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
                    <button id="btn-save" class="btn btn-success" type="button" onclick="javascript:SaveSystemConfig();">
                        <i class="fa fa-save push-5-r"></i>{SAVE_CHANGES}
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
            
            <!-- SYSTEM CONFIGURATIONS -->
            <div class="col-xs-12">
                <div id="_system_config" class="block block-themed block-rounded push-10">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="content_toggle">
                                    <i class="si si-arrow-up"></i>
                                </button>
                            </li>
                        </ul>
                        <h3 class="block-title cursor-pointer" onclick="javascript:App.blocks('#_system_config','content_toggle');">
                            <i class="fa fa-cogs push-10-r"></i>{SYSTEM_CONFIG}
                        </h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label hidden-xs"></label>
                            <div class="col-sm-9">
                                <label class="css-input switch switch-sm switch-primary">
                                    <input type="checkbox" id="_close_system"><span></span> &nbsp; {CLOSE_SYSTEM}
                                </label>
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{CLOSE_REASON} :</label>
                            <div class="col-sm-9">
                                <div id="_close_reason" class="js-summernote-min">#CLOSED_REASON#</div>
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label hidden-xs"></label>
                            <div class="col-sm-9">
                                <label class="css-input switch switch-sm switch-primary">
                                    <input type="checkbox" id="_display_error"><span></span> &nbsp; {DISPLAY_ERROR}
                                </label>
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label hidden-xs"></label>
                            <div class="col-sm-9">
                                <label class="css-input switch switch-sm switch-primary">
                                    <input type="checkbox" id="_allow_register"><span></span> &nbsp; {ALLOW_REGISTRATION}
                                </label>
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{DEFAULT_THEME} :</label>
                            <div class="col-sm-9">
                                <select class="js-select2-nosearch form-control" id="_default_theme" style="width: 100%;" data-placeholder="{DEFAULT_THEME}">
                                    <option></option>
                                    #THEMES#
                                </select>
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{LOGIN_TYPE} :</label>
                            <div class="col-sm-9">
                                <input type="text" id="_logintype" class="form-control" maxlength="255" value="#LOGIN_TYPE#" placeholder="{EMAIL_OR_ID}">
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{LOGIN_USER_SESSION} :</label>
                            <div class="col-sm-9">
                                <input type="text" id="_login_user_session" class="form-control" maxlength="255" value="#LOGIN_SESSION#">
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{LOGIN_SESSION_REMEMBER} :</label>
                            <div class="col-sm-9">
                                <input type="text" id="_login_session_remember" class="form-control" maxlength="255" value="#LOGIN_SESSION_REMEMBER#">
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{WEB_PIPELINE} :</label>
                            <div class="col-sm-9">
                                <input type="text" id="_web_pipeline" class="form-control" maxlength="255" value="#WEB_PIPELINE#">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">{LOAD_PM} :</label>
                            <div class="col-sm-9">
                                <input type="text" id="_loadpm" class="form-control" maxlength="255" value="#LOAD_PM#">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SITE CONFIGURATIONS -->
            <div class="col-xs-12">
                <div id="_site_config" class="block block-themed block-rounded push-10">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="content_toggle">
                                    <i class="si si-arrow-up"></i>
                                </button>
                            </li>
                        </ul>
                        <h3 class="block-title cursor-pointer" onclick="javascript:App.blocks('#_site_config','content_toggle');">
                            <i class="fa fa-globe push-10-r"></i>{SITE_CONFIGURATION}
                        </h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{SITE_NAME}</label>
                            <div class="col-sm-9">
                                <input type="text" id="_site_name" class="form-control" maxlength="255" value="#SITE_NAME#">
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{SITE_URL}</label>
                            <div class="col-sm-9">
                                <input type="text" id="_site_url" class="form-control" maxlength="255" value="#SITE_URL#">
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{SITE_DOMAIN}</label>
                            <div class="col-sm-9">
                                <input type="text" id="_site_domain" class="form-control" maxlength="255" value="#SITE_DOMAIN#">
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{SITE_SLOGAN}</label>
                            <div class="col-sm-9">
                                <input type="text" id="_site_slogan" class="form-control" maxlength="255" value="#SITE_SLOGAN#">
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{SITE_DESCRIPTION}</label>
                            <div class="col-sm-9">
                                <div id="_site_description" class="js-summernote-min">#SITE_DESCRIPTION#</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">{SITE_KEYWORDS}</label>
                            <div class="col-sm-9">
                                <div id="_site_keywords" class="js-summernote-min">#SITE_KEYWORDS#</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DATABASES -->
            <div class="col-xs-12">
                <div id="_db_config" class="block block-themed block-rounded push-10">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="content_toggle">
                                    <i class="si si-arrow-up"></i>
                                </button>
                            </li>
                        </ul>
                        <h3 class="block-title cursor-pointer" onclick="javascript:App.blocks('#_db_config','content_toggle');">
                            <i class="fa fa-database push-10-r"></i>{DATABASE_CONFIGURATION}
                        </h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{DBTYPE}</label>
                            <div class="col-sm-9">
                                <select class="js-select2-nosearch form-control" id="_dbtype" style="width: 100%;" data-placeholder="{DBTYPE}">
                                    <option></option>
                                    <option value="MySQL" #sel_mysql#>MySQL</option>
                                    <option value="MSSQL" #sel_mssql#>Microsoft SQL Server</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{DBNAME}</label>
                            <div class="col-sm-9">
                                <input type="text" id="_dbname" class="form-control" maxlength="255" value="#DBNAME#">
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{DBHOST}</label>
                            <div class="col-sm-9">
                                <input type="text" id="_dbhost" class="form-control" maxlength="255" value="#DBHOST#">
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{DBUSER}</label>
                            <div class="col-sm-9">
                                <input type="text" id="_dbuser" class="form-control" maxlength="255" value="#DBUSER#">
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{DBPWD}</label>
                            <div class="col-sm-9">
                                <input type="password" id="_dbpwd" class="form-control" maxlength="255" value="#DBPWD#">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label hidden-xs"></label>
                            <div class="col-sm-9">
                                <label class="css-input switch switch-sm switch-primary">
                                    <input type="checkbox" id="_dbdebug"><span></span> &nbsp; {DBDEBUG}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECURITY -->
            <div class="col-xs-12">
                <div id="_security_config" class="block block-themed block-rounded push-10">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="content_toggle">
                                    <i class="si si-arrow-up"></i>
                                </button>
                            </li>
                        </ul>
                        <h3 class="block-title cursor-pointer" onclick="javascript:App.blocks('#_security_config','content_toggle');">
                            <i class="fa fa-lock push-10-r"></i>{SECURITY}
                        </h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label hidden-xs"></label>
                            <div class="col-sm-9">
                                <label class="css-input switch switch-sm switch-primary">
                                    <input type="checkbox" id="_security_check"><span></span> &nbsp; {SECURITY_CHECK}
                                </label>
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{GOOGLE_CAPTCHA_KEY}</label>
                            <div class="col-sm-9">
                                <input type="password" id="_gcaptcha_key" class="form-control" maxlength="255" value="#GCAPTCHA_KEY#">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">{GOOGLE_CAPTCHA_SECRET}</label>
                            <div class="col-sm-9">
                                <input type="password" id="_gcaptcha_secret" class="form-control" maxlength="255" value="#GCAPTCHA_SECRET#">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MAIL -->
            <div class="col-xs-12">
                <div id="_mail_config" class="block block-themed block-rounded push-10">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="content_toggle">
                                    <i class="si si-arrow-up"></i>
                                </button>
                            </li>
                        </ul>
                        <h3 class="block-title cursor-pointer" onclick="javascript:App.blocks('#_mail_config','content_toggle');">
                            <i class="fa fa-envelope push-10-r"></i>{MAIL_CONFIGURATION}
                        </h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{ADMIN_MAIL}</label>
                            <div class="col-sm-9">
                                <input type="text" id="_admin_mail" class="form-control" maxlength="255" value="#ADMIN_MAIL#">
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{MAIL_HOST}</label>
                            <div class="col-sm-9">
                                <input type="text" id="_mail_host" class="form-control" maxlength="255" value="#MAIL_HOST#">
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{MAIL_USER}</label>
                            <div class="col-sm-9">
                                <input type="text" id="_mail_user" class="form-control" maxlength="255" value="#MAIL_USER#">
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{MAIL_PWD}</label>
                            <div class="col-sm-9">
                                <input type="password" id="_mail_pwd" class="form-control" maxlength="255" value="#MAIL_PWD#">
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{MAIL_PORT}</label>
                            <div class="col-sm-9">
                                <input type="text" id="_mail_port" class="form-control" maxlength="255" value="#MAIL_PORT#">
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{MAIL_SECURE}</label>
                            <div class="col-sm-9">
                                <input type="text" id="_mail_secure" class="form-control" maxlength="255" value="#MAIL_SECURE#" placeholder="{SSL_OR_TLS}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">{MAIL_DEBUG}</label>
                            <div class="col-sm-9">
                                <input type="text" id="_mail_debug" class="form-control" maxlength="255" value="#MAIL_DEBUG#" placeholder="0 - 4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- LANGUAGES -->
            <div class="col-xs-12">
                <div id="_language_config" class="block block-themed block-rounded push-10">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="content_toggle">
                                    <i class="si si-arrow-up"></i>
                                </button>
                            </li>
                        </ul>
                        <h3 class="block-title cursor-pointer" onclick="javascript:App.blocks('#_language_config','content_toggle');">
                            <i class="fa fa-language push-10-r"></i>{SYSTEM_LANGUAGE}
                        </h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">{SYSTEM_LANGUAGE}</label>
                            <div class="col-sm-9">
                                <select class="js-select2-nosearch form-control" id="_language" style="width: 100%;" data-placeholder="{SYSTEM_LANGUAGE}">
                                    <option></option>
                                    #LANGUAGES#
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- WELCOME MESSAGES -->
            <div class="col-xs-12">
                <div id="_welcome_config" class="block block-themed block-rounded push-10">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="content_toggle">
                                    <i class="si si-arrow-up"></i>
                                </button>
                            </li>
                        </ul>
                        <h3 class="block-title cursor-pointer" onclick="javascript:App.blocks('#_welcome_config','content_toggle');">
                            <i class="fa fa-comment push-10-r"></i>{WELCOME_MESSAGE}
                        </h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="_welcome_msg">{WELCOME_MESSAGE} :</label>
                            <div class="col-sm-9">
                                <div id="_welcome_msg" class="js-summernote-min">#WELCOME_MSG#</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- GOOGLE INTEGRATIONS -->
            <div class="col-xs-12">
                <div id="_google_config" class="block block-themed block-rounded push-10">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="content_toggle">
                                    <i class="si si-arrow-up"></i>
                                </button>
                            </li>
                        </ul>
                        <h3 class="block-title cursor-pointer" onclick="javascript:App.blocks('#_google_config','content_toggle');">
                            <i class="fa fa-google push-10-r"></i>{GOOGLE_INTEGRATION}
                        </h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{GOOGLE_CLIENT_ID}</label>
                            <div class="col-sm-9">
                                <input type="text" id="_gclient_id" class="form-control" maxlength="255" value="#GCLIENT_ID#">
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{GOOGLE_APIKEY}</label>
                            <div class="col-sm-9">
                                <input type="text" id="_gapikey" class="form-control" maxlength="255" value="#GAPIKEY#">
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{GOOGLE_ANALYTIC}</label>
                            <div class="col-sm-9">
                                <input type="text" id="_ganalytic" class="form-control" maxlength="255" value="#GANALYTIC#">
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label hidden-xs"></label>
                            <div class="col-sm-9">
                                <label class="css-input switch switch-sm switch-primary">
                                    <input type="checkbox" id="_gmaps"><span></span> &nbsp; {GOOGLE_MAPS}
                                </label>
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{GOOGLE_DEFAULT_LATITUDE}</label>
                            <div class="col-sm-9">
                                <input type="text" id="_gdeflat" class="form-control" maxlength="255" value="#GDEF_LAT#">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">{GOOGLE_DEFAULT_LONGITUDE}</label>
                            <div class="col-sm-9">
                                <input type="text" id="_gdeflon" class="form-control" maxlength="255" value="#GDEF_LON#">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">{GOOGLE_DEFAULT_ZOOM}</label>
                            <div class="col-sm-9">
                                <input type="text" id="_gdefzom" class="form-control" maxlength="255" value="#GDEF_ZOM#">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FACEBOOK -->
            <div class="col-xs-12">
                <div id="_fb_config" class="block block-themed block-rounded push-10">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="content_toggle">
                                    <i class="si si-arrow-up"></i>
                                </button>
                            </li>
                        </ul>
                        <h3 class="block-title cursor-pointer" onclick="javascript:App.blocks('#_fb_config','content_toggle');">
                            <i class="fa fa-facebook push-10-r"></i>{FACEBOOK_INTEGRATION}
                        </h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label hidden-xs"></label>
                            <div class="col-sm-9">
                                <label class="css-input switch switch-sm switch-primary">
                                    <input type="checkbox" id="_fbintegration"><span></span> &nbsp; {FACEBOOK_INTEGRATION}
                                </label>
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label hidden-xs"></label>
                            <div class="col-sm-9">
                                <label class="css-input switch switch-sm switch-primary">
                                    <input type="checkbox" id="_fbbeta"><span></span> &nbsp; {ENABLE_FB_BETA}
                                </label>
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label hidden-xs"></label>
                            <div class="col-sm-9">
                                <label class="css-input switch switch-sm switch-primary">
                                    <input type="checkbox" id="_fbjs"><span></span> &nbsp; {ENABLE_FACEBOOK_JS}
                                </label>
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{FACEBOOK_GRAPH}</label>
                            <div class="col-sm-9">
                                <input type="text" id="_fbgraph" class="form-control" maxlength="255" value="#FB_GRAPH#">
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{FACEBOOK_APP_ID}</label>
                            <div class="col-sm-9">
                                <input type="text" id="_fbappid" class="form-control" maxlength="255" value="#FB_APPID#">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">{FACEBOOK_APP_SECRET}</label>
                            <div class="col-sm-9">
                                <input type="text" id="_fbappsecret" class="form-control" maxlength="255" value="#FB_APPSECRET#">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TWITTER -->
            <div class="col-xs-12">
                <div id="_twitter_config" class="block block-themed block-rounded push-10">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="content_toggle">
                                    <i class="si si-arrow-up"></i>
                                </button>
                            </li>
                        </ul>
                        <h3 class="block-title cursor-pointer" onclick="javascript:App.blocks('#_twitter_config','content_toggle');">
                            <i class="fa fa-twitter push-10-r"></i>{TWITTER_INTEGRATION}
                        </h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label hidden-xs"></label>
                            <div class="col-sm-9">
                                <label class="css-input switch switch-sm switch-primary">
                                    <input type="checkbox" id="_twintegration"><span></span> &nbsp; {TWITTER_INTEGRATION}
                                </label>
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{TWITTER_ACCESS_TOKEN}</label>
                            <div class="col-sm-9">
                                <input type="text" id="_tw_access_token" class="form-control" maxlength="255" value="#TW_ACCESS_TOKEN#">
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{TWITTER_TOKEN_SECRET}</label>
                            <div class="col-sm-9">
                                <input type="text" id="_tw_token_secret" class="form-control" maxlength="255" value="#TW_TOKEN_SECRET#">
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{TWITTER_CONSUMER_KEY}</label>
                            <div class="col-sm-9">
                                <input type="text" id="_tw_consumer_key" class="form-control" maxlength="255" value="#TW_CONSUMER_KEY#">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">{TWITTER_CONSUMER_SECRET}</label>
                            <div class="col-sm-9">
                                <input type="text" id="_tw_consumer_secret" class="form-control" maxlength="255" value="#TW_CONSUMER_SECRET#">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SMS -->
            <div class="col-xs-12">
                <div id="_sms_config" class="block block-themed block-rounded">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="content_toggle">
                                    <i class="si si-arrow-up"></i>
                                </button>
                            </li>
                        </ul>
                        <h3 class="block-title cursor-pointer" onclick="javascript:App.blocks('#_sms_config','content_toggle');">
                            <i class="fa fa-phone push-10-r"></i>{SMS_INTEGRATION}
                        </h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{SMS_MTURL}</label>
                            <div class="col-sm-9">
                                <input type="text" id="_sms_mturl" class="form-control" maxlength="255" value="#SMS_MTURL#">
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{SMS_USER}</label>
                            <div class="col-sm-9">
                                <input type="text" id="_sms_user" class="form-control" maxlength="255" value="#SMS_USER#">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">{SMS_PWD}</label>
                            <div class="col-sm-9">
                                <input type="password" id="_sms_pwd" class="form-control" maxlength="255" value="#SMS_PWD#">
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