<!-- Login Content -->
<div class="content overflow-hidden push-50-t">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
            <!-- Login Block -->
            <div class="block block-themed animated fadeIn block-rounded">
                <div class="block-header bg-primary text-center">
                    <h3 class="block-title">{LOGIN}</h3>
                </div>
                <div class="block-content block-content-full block-content-narrow">
                    <!-- Login Title -->
                    <div class="text-center">
                        #IMG_LOGO#
                        <h2 class="h2 font-w600 push-30-t push-5">{D_SITENAME}</h2>
                        <p>{D_SLOGAN}</p>
                    </div>
                    <!-- END Login Title -->

                    <!-- Login Form -->
                    <form class="js-login-validation form-horizontal push-30-t" method="post" onSubmit="javascript:return auth();">
                        <div id="return-login"></div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="form-material form-material-primary floating">
                                    <input class="form-control" type="text" id="loginid" name="loginid">
                                    <label for="loginid">#LOGIN_ID#</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="form-material form-material-primary floating">
                                    <input class="form-control" type="password" id="pwd" name="pwd">
                                    <label for="pwd">{PASSWORD}</label>
                                </div>
                            </div>
                        </div>
                        #SECURITY#
                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="css-input switch switch-sm switch-primary">
                                    <input type="checkbox" id="remember_me" name="remember_me"><span></span> {REMEMBER_ME}
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 text-center">
                                <button id="btn-login" class="btn btn-primary" type="submit">
                                    <i class="fa fa-sign-in push-5-r"></i>{LOGIN}
                                </button>
                                #BTN_REGISTER#
                            </div>
                        </div>
                    </form>
                    <!-- END Login Form -->
                </div>
            </div>
            <!-- END Login Block -->
        </div>
    </div>
</div>
<!-- END Login Content -->
#DIALOG_REGISTER#
<!-- Login Footer -->
<div class="push-20-t text-center animated fadeInUp">
    <small class="text-muted push-20">#COPYRIGHT#</small>
</div>
<!-- END Login Footer -->