<!-- Main Container -->
<main id="main-container">
    <!-- Page Header -->
    <div class="content bg-primary-dark">
        <div class="row items-push">
            <div class="col-sm-8">
                <h1 class="page-heading text-white">
                    <i class="fa fa-list-alt push-20-r"></i>{TEMPLATES}
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

    <!-- Message Dialog //-->
    <div id="TemplateDialog" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-popout">
            <div class="modal-content">
                <form method="post" class="form-horizontal form-bordered" onSubmit="javascript:return do_NewTemplates();">
                    <div class="block block-themed block-transparent remove-margin-b">
                        <div class="block-header bg-primary-dark">
                            <ul class="block-options">
                                <li>
                                    <button type="button" data-dismiss="modal"><i class="si si-close"></i></button>
                                </li>
                            </ul>
                            <h3 class="block-title">Template</h3>
                        </div>
                        <div class="block-content">
                            <div class="panel panel-default">
                                <div class="panel-body remove-padding-b">
                                    <div class="form-group">
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                                                <input type="text" id="Title" placeholder="{TITLE}" class="form-control" maxlength="255" autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                                                <input type="text" id="JenisTemplate" placeholder="Jenis Template" class="form-control" maxlength="255" autocomplete="off" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group remove-margin-b">
                                        <div class="col-sm-12">
                                            <!--<textarea id="js-ckeditor" name="js-ckeditor" rows="10"></textarea>//-->
                                            <div id="Template" class="js-summernote"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btn_cancel" data-dismiss="modal" class="btn btn-danger" type="button" onClick="javascript:CancelNewTemplates();">
                            <i class="fa fa-times push-5-r"></i>{CANCEL}
                        </button>
                        <button id="btn_save" class="btn btn-primary" type="submit">
                            <i class="fa fa-save push-5-r"></i>{SAVE}
                        </button>
                        <input id="TID" type="hidden" value="0" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Message Dialog //-->
    
    <!-- Page Content -->
    <div class="content content-narrow">
        <form class="form-horizontal">
        <div class="row push-10">
            <div class="col-md-12">
                <button type="button" class="btn btn-primary" onclick="javascript:NewTemplates();">
                    <i class="fa fa-list-alt push-5-r"></i>Template Baru
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="block block-themed block-rounded">
                    <div class="block-content">
                        <table id="Templates" class="table table-striped table-bordered responsive h6">
                            <thead class="">
                                <tr>
                                    <th class="text-center" width="50">#</th>
                                    <th class="text-left">{TITLE}</th>
                                    <th width="100"></th>
                                </tr>
                            </thead>
                            <tbody>
                                #templates#
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