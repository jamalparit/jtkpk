<main id="main-container">
    <!-- Page Header -->
    <div class="content bg-primary-dark">
        <div class="row items-push">
            <div class="col-sm-8">
                <h1 class="page-heading text-white">
                    <i class="fa fa-microphone push-20-r"></i>{MESSAGES_CENTER}
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

    <!-- Message Dialog //-->
    <div id="MsgDialog" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-popout">
            <div class="modal-content">
                <form method="post" class="form-horizontal" onSubmit="javascript:return AddMsg();">
                    <div class="block block-themed block-transparent remove-margin-b">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">
                                <i class="fa fa-microphone push-10-r"></i>{NEW_MSG}
                            </h3>
                        </div>
                        <div class="block-content">
                            <div class="form-group push-5">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                                        <input type="text" id="_title" placeholder="{TITLE}" class="form-control" maxlength="255" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group push-5">
                                <div class="col-sm-12 col-md-6">
                                    <label class="css-input css-radio css-radio-primary text-primary push-10-r">
                                        <input type="radio" name="_msgtype" id="_msg_general" value="GENERAL"><span></span>
                                        <i class="fa fa-bullhorn push-5-r"></i>{GENERAL}
                                    </label>
                                    <label class="css-input css-radio css-radio-info text-info push-10-r">
                                        <input type="radio" name="_msgtype" id="_msg_info" value="INFO"><span></span>
                                        <i class="fa fa-info-circle push-5-r"></i>{INFO}
                                    </label>
                                    <label class="css-input css-radio css-radio-warning text-warning push-10-r">
                                        <input type="radio" name="_msgtype" id="_msg_warning" value="WARNING"><span></span>
                                        <i class="fa fa-exclamation-circle push-5-r"></i>{WARNING}
                                    </label>
                                    <label class="css-input css-radio css-radio-danger text-danger">
                                        <input type="radio" name="_msgtype" id="_msg_critical" value="CRITICAL"><span></span>
                                        <i class="fa fa-exclamation-triangle push-5-r"></i>{CRITICAL}
                                    </label>
                                </div>
                                <div class="col-sm-12 col-md-6 text-right">
                                    <label class="css-input switch switch-sm switch-primary push-10-r">
                                        <input type="checkbox" id="_active"><span></span> {STATUS_ACTIVE}
                                    </label>
                                    <label class="css-input switch switch-sm switch-primary">
                                        <input type="checkbox" id="_allow_reply"><span></span> {ALLOW_REPLY}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group remove-margin-b">
                                <div class="col-sm-12">
                                    <div id="_txt" class="js-summernote"></div>
                                </div>
                            </div>
                            <div class="form-group items-push border-b">
                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                        <input type="text" id="_expired_on" placeholder="{EXPIRED_ON}" class="form-control js-date" maxlength="10" autocomplete="off" />
                                    </div>
                                    <span class="push-10-r">{ACTION_WHEN_EXPIRED} : </span>
                                    <label class="css-input css-radio css-radio-primary push-10-r">
                                        <input type="radio" name="_action_expired" id="_ae_inactive" value="INACTIVE"><span></span> <b>{INACTIVE}</b>
                                    </label>
                                    <label class="css-input css-radio css-radio-primary">
                                        <input type="radio" name="_action_expired" id="_ae_delete" value="DELETE"><span></span> <b>{DELETE}</b>
                                    </label>
                                </div>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                                        <input type="text" id="_tags" class="form-control js-tags-input" placeholder="{ADD_TAGS}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group push-5">
                                <div class="col-xs-12">
                                    <h3 class="h4 font-w400">{MESSAGE_FOR} :</h3>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <label class="css-input css-checkbox css-checkbox-rounded css-checkbox-primary">
                                        <input type="checkbox" id="_select_all_usergroups" onclick="javascript:ToggleUG();"><span></span> &nbsp;{SELECT_ALL}
                                    </label>
                                </div>
                                #USERGROUPS#
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btn_save" class="btn btn-primary" type="submit">
                            <i class="fa fa-save push-5-r"></i>{SAVE}
                        </button>
                        <button id="btn_cancel" data-dismiss="modal" class="btn btn-danger" type="button" onClick="javascript:ClearNewMsg();">
                            <i class="fa fa-times push-5-r"></i>{CANCEL}
                        </button>
                        <input id="MID" type="hidden" value="0" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Page Content -->
    <div class="content content-narrow">
        <form class="form-horizontal">
        <div class="row push-10">
            <div class="col-md-12">
                <button type="button" class="btn btn-primary" onclick="javascript:NewMsg();">
                    <i class="fa fa-pencil-square-o push-5-r"></i>{NEW_MSG}
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="block block-themed block-rounded">
                    <div class="block-content">
                        <table id="Messages" class="table table-striped table-bordered responsive h6">
                            <thead>
                                <tr>
                                    <th class="text-center" width="50">#</th>
                                    <th class="text-left">{TITLE}</th>
                                    <th class="text-center">{EXPIRED_ON}</th>
                                    <th class="text-center" width="80">{STATUS}</th>
                                    <th width="100"></th>
                                </tr>
                            </thead>
                            <tbody>
                                #messages#
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</main>