<!-- Main Container -->
<main id="main-container">
    <!-- Page Header -->
    <div class="content bg-primary-dark">
        <div class="row items-push">
            <div class="col-sm-8">
                <h1 class="page-heading text-white">
                    <i class="fa fa-users push-20-r"></i>{DEPARTMENTS}
                </h1>
            </div>
            <div class="col-sm-4 text-right">
            </div>
        </div>
    </div>
    <!-- END Page Header -->

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

    <!-- User Dialog //-->
    <div id="DeptDialog" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popout">
            <div class="modal-content">
                <form method="post" class="form-horizontal form-bordered" onSubmit="javascript:return doNewDept();">
                    <div class="block block-themed block-transparent remove-margin-b">
                        <div class="block-header bg-primary-dark">
                            <ul class="block-options">
                                <li>
                                    <button type="button" data-dismiss="modal"><i class="si si-close"></i></button>
                                </li>
                            </ul>
                            <h3 class="block-title">{DEPARTMENTS}</h3>
                        </div>
                        <div class="block-content">
                            <div class="panel panel-default">
                                <div class="panel-body remove-padding-b">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                                <input type="text" id="deptname" placeholder="{DEPARTMENTS}" class="form-control" maxlength="255" autocomplete="off" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btn_cancel" data-dismiss="modal" class="btn btn-danger" type="button" onClick="javascript:CancelNewDept();">
                            <i class="fa fa-times push-5-r"></i>{CANCEL}
                        </button>                
                        <button id="btn_save" class="btn btn-primary" type="submit">
                            <i class="fa fa-check push-5-r"></i>{SAVE}
                        </button>
                        <input id="ID" type="hidden" value="0" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End User Dialog //-->
    
    <!-- Page Content -->
    <div class="content content-narrow">
        <form class="form-horizontal">
        <div class="row push-10">
            <div class="col-md-12">
                <button type="button" class="btn btn-primary" onclick="javascript:NewDept();">
                    <i class="fa fa-users push-5-r"></i>{NEW_DEPARTMENT}
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="block block-themed block-rounded">
                    <div class="block-content">
                        <table id="departments" class="table table-striped table-bordered responsive h6">
                            <thead class="">
                                <tr>
                                    <th class="text-center">{DEPARTMENT}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                #departments#
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->