<main id="main-container">
    <!-- Page Header -->
    <div class="content bg-primary-dark">
        <div class="row items-push">
            <div class="col-sm-8">
                <h1 class="page-heading text-white">
                    <i class="fa fa-users push-20-r"></i>{USERS_AND_ROLES}
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

    <!-- User Roles Dialog //-->
    <div id="URDialog" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popout">
            <div class="modal-content">
                <form method="post" class="form-horizontal" onSubmit="javascript:return AddUR();">
                    <div class="block block-themed block-transparent remove-margin-b">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">
                                <i class="fa fa-users push-10-r"></i>{USER_ROLES}
                            </h3>
                        </div>
                        <div class="block-content">
                            <div class="form-group">
                                <div class="col-xs-4">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text" id="_urole" placeholder="{ROLE}" class="form-control" maxlength="255" autocomplete="off" />
                                    </div>
                                </div>
                                <div class="col-xs-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text" id="_urolename" placeholder="{USER_ROLES}" class="form-control" maxlength="255" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btn_ur_save" class="btn btn-primary" type="submit">
                            <i class="fa fa-save push-5-r"></i>{SAVE}
                        </button>
                        <button id="btn_ur_cancel" data-dismiss="modal" class="btn btn-danger" type="button" onClick="javascript:ClearUR();">
                            <i class="fa fa-times push-5-r"></i>{CANCEL}
                        </button>                
                        <input id="ID" type="hidden" value="0" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Usergroups Dialog //-->
    <div id="UGDialog" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popout">
            <div class="modal-content">
                <form method="post" class="form-horizontal" onSubmit="javascript:return AddUG();">
                    <div class="block block-themed block-transparent remove-margin-b">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">
                                <i class="fa fa-users push-10-r"></i>{USERGROUPS}
                            </h3>
                        </div>
                        <div class="block-content">                 
                            <div class="form-group">
                                <div class="col-xs-4">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-code"></i></span>
                                        <input type="text" id="_groupcode" placeholder="{GROUP_CODE}" class="form-control" maxlength="50" autocomplete="off" />
                                    </div>
                                </div>
                                <div class="col-xs-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text" id="_groupname" placeholder="{GROUP_NAME}" class="form-control" maxlength="255" autocomplete="off" />
                                    </div>
                                </div>
                            </div>                    
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btn_group_save" class="btn btn-primary" type="submit">
                            <i class="fa fa-save push-5-r"></i>{SAVE}
                        </button>
                        <button id="btn_group_cancel" data-dismiss="modal" class="btn btn-danger" type="button" onClick="javascript:ClearUG();">
                            <i class="fa fa-times push-5-r"></i>{CANCEL}
                        </button>                
                        <input id="GID" type="hidden" value="0" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- User Dialog //-->
    <div id="UserDialog" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-popout">
            <div class="modal-content">
                <form method="post" class="form-horizontal" onSubmit="javascript:return AddUser();">
                    <div class="block block-themed block-transparent remove-margin-b">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">
                                <i class="fa fa-user push-10-r"></i>{NEW_USER}
                            </h3>
                        </div>
                        <div class="block-content">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group items-push border-b">
                                        <label class="col-sm-4 control-label">{LOGINID} :</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="_loginid" class="form-control" maxlength="255" placeholder="{LOGINID}" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group items-push border-b">
                                        <label class="col-sm-4 control-label">{PASSWORD} :</label>
                                        <div class="col-sm-8">
                                            <input type="password" id="_pwd" class="form-control" maxlength="255" placeholder="{PASSWORD}" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group items-push border-b">
                                        <label class="col-sm-4 control-label">{FIRSTNAME} :</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="_firstname" class="form-control" maxlength="255" placeholder="{FIRSTNAME}" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group items-push border-b">
                                        <label class="col-sm-4 control-label">{LASTNAME} :</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="_lastname" class="form-control" maxlength="255" placeholder="{LASTNAME}" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group items-push border-b">
                                        <label class="col-sm-2 control-label">{EMAIL_ADDRESS} :</label>
                                        <div class="col-sm-10">
                                            <input type="email" id="_email" class="form-control" maxlength="255" placeholder="{EMAIL_ADDRESS}" autocomplete="off">
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group items-push border-b">
                                        <label class="col-sm-4 control-label">{USER_ROLES} :</label>
                                        <div class="col-sm-8">
                                            <select multiple id="_ur" data-placeholder="{USER_ROLES}" class="form-control js-select2-nosearch" style="width:100%;">
                                              #UROLES#
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group items-push border-b">
                                        <label class="col-sm-4 control-label">{USERGROUPS} :</label>
                                        <div class="col-sm-8">
                                            <select multiple id="_ug" data-placeholder="{USERGROUPS}" class="form-control js-select2-nosearch" style="width:100%;">                                              
                                              #UGROUPS#
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group items-push border-b">
                                <label class="col-sm-3 control-label">{ACCOUNT_STATUS} :</label>
                                <div class="col-sm-9">
                                    <label class="css-input css-radio css-radio-primary push-10-r">
                                        <input type="radio" id="_acc_active" name="_accstatus" value="ACTIVE"><span></span>
                                        <i class="fa fa-check-circle text-success push-5-r"></i>{ACTIVE}
                                    </label>
                                    <label class="css-input css-radio css-radio-primary push-10-r">
                                        <input type="radio" id="_acc_inactive" name="_accstatus" value="INACTIVE"><span></span>
                                        <i class="fa fa-times text-danger push-5-r"></i>{INACTIVE}
                                    </label>
                                    <label class="css-input css-radio css-radio-primary">
                                        <input type="radio" id="_acc_suspended" name="_accstatus" value="SUSPENDED"><span></span>
                                        <i class="fa fa-exclamation text-warning push-5-r"></i>{SUSPENDED}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label hidden-xs"></label>
                                <div class="col-sm-9">
                                    <label class="css-input switch switch-sm switch-primary">
                                        <input type="checkbox" id="_need_chg_pwd"><span></span> {NEED_CHG_PWD}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btn_u_save" class="btn btn-primary" type="submit">
                            <i class="fa fa-save push-5-r"></i>{SAVE}
                        </button>
                        <button id="btn_u_cancel" data-dismiss="modal" class="btn btn-danger" type="button" onClick="javascript:ClearNewUser();">
                            <i class="fa fa-times push-5-r"></i>{CANCEL}
                        </button>                
                        <input id="UserID" type="hidden" value="0" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Page Content -->
    <div class="content content-narrow">
        <form class="form-horizontal">
        <div class="row">
            
            <!-- ROLES -->
            <div class="col-xs-12">
                <div id="_userroles" class="block block-themed block-rounded push-10">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="content_toggle">
                                    <i class="si si-arrow-up"></i>
                                </button>
                            </li>
                        </ul>
                        <h3 class="block-title cursor-pointer" onclick="javascript:App.blocks('#_userroles','content_toggle');">
                            <i class="fa fa-users push-10-r"></i>{USER_ROLES}
                        </h3>
                    </div>
                    <div class="block-content block-content-full block-content-mini border-b bg-gray-lighter">
                        <button type="button" class="btn btn-primary" onclick="javascript:NewUR();">
                            <i class="fa fa-plus push-5-r"></i><i class="fa fa-users"></i>
                        </button>
                    </div>
                    <div class="block-content">
                        <table id="Userroles" class="table table-striped table-bordered responsive h6">
                            <thead class="">
                                <tr>
                                    <th class="text-center">{ROLE}</th>
                                    <th class="text-center">{ROLE_NAME}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                #USERROLES#
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- USERGROUPS -->
            <div class="col-xs-12">
                <div id="_usergroups" class="block block-themed block-rounded push-10">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="content_toggle">
                                    <i class="si si-arrow-up"></i>
                                </button>
                            </li>
                        </ul>
                        <h3 class="block-title cursor-pointer" onclick="javascript:App.blocks('#_usergroups','content_toggle');">
                            <i class="fa fa-users push-10-r"></i>{USERGROUPS}
                        </h3>
                    </div>
                    <div class="block-content block-content-full block-content-mini border-b bg-gray-lighter">
                        <button type="button" class="btn btn-primary" onclick="javascript:NewUG();">
                            <i class="fa fa-plus push-5-r"></i><i class="fa fa-users"></i>
                        </button>
                    </div>
                    <div class="block-content">
                        <table id="Usergroups" class="table table-striped table-bordered responsive h6">
                            <thead class="">
                                <tr>
                                    <th class="text-center">{GROUP_CODE}</th>
                                    <th class="text-center">{GROUP_NAME}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                #USERGROUPS#
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- USERS -->
            <div class="col-xs-12">
                <div id="_users" class="block block-themed block-rounded push-5">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="content_toggle">
                                    <i class="si si-arrow-up"></i>
                                </button>
                            </li>
                        </ul>
                        <h3 class="block-title cursor-pointer" onclick="javascript:App.blocks('#_users','content_toggle');">
                            <i class="fa fa-users push-10-r"></i>{USERS}
                        </h3>
                    </div>
                    <div class="block-content block-content-full block-content-mini border-b bg-gray-lighter">
                        <button type="button" class="btn btn-primary" onclick="javascript:NewUser();">
                            <i class="fa fa-plus push-5-r"></i><i class="fa fa-user"></i>
                        </button>
                    </div>
                    <div class="block-content">
                        <table id="Users" class="table table-striped table-bordered responsive h6">
                            <thead>
                                <tr>
                                    <th class="text-center">{NAME}</th>
                                    <th class="text-center">{USER_ROLES}</th>
                                    <th class="text-center">{USERGROUPS}</th>
                                    <th class="text-center">{LASTVISIT}</th>
                                    <th class="text-center">{ACCOUNT_STATUS}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                #USERS#
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        </form>
    </div>
</main>