<!-- Registration Dialog //-->
<div id="RegisterDialog" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-popout">
        <div class="modal-content">
            <form method="post" class="js-register-validation" onSubmit="javascript:return doRegister();">
                <div class="block block-themed remove-margin-b">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title"><i class="fa fa-user push-10-r"></i>{REGISTER}</h3>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="_loginid">#LOGIN_ID# :</label>
                                    <input class="form-control" type="text" id="_loginid" name="_loginid" maxlength="255">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="_pwd">{PASSWORD} :</label>
                                    <input class="form-control" type="password" id="_pwd" name="_pwd" maxlength="255">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="_firstname">{FIRSTNAME} :</label>
                                    <input class="form-control" type="text" id="_firstname" name="_firstname" maxlength="255">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="_lastname">{LASTNAME} :</label>
                                    <input class="form-control" type="text" id="_lastname" name="_lastname" maxlength="255">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="_email">{EMAIL_ADDRESS} :</label>
                                    <input class="form-control" type="email" id="_email" name="_email" maxlength="255">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="_jobpos">{JOB_POSITION}</label>
                                    <input class="form-control" type="text" id="_jobpos" name="_jobpos" maxlength="255">
                                </div>
                            </div>
                        </div>
                        #SECURITY#
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btn-register" class="btn btn-primary" type="submit">
                        <i class="fa fa-send push-5-r"></i>{REGISTER}
                    </button>
                    <button id="btn-cancel" class="btn btn-danger" type="button" data-dismiss="modal" onClick="javascript:ClearRegister();">
                        <i class="fa fa-times push-5-r"></i>{CANCEL}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Registration Dialog //-->