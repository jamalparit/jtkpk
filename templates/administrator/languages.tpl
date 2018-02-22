<main id="main-container">
    <!-- Page Header -->
    <div class="content bg-primary-dark">
        <div class="row items-push">
            <div class="col-sm-8">
                <h1 class="page-heading text-white">
                    <i class="fa fa-language push-20-r"></i>{LANGUAGES}
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

    <!-- New Lang Pack //-->
    <div id="LangPackDialog" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popout">
            <div class="modal-content">
                <form method="post" class="form-horizontal form-bordered" onSubmit="javascript:return AddLangPack();">
                    <div class="block block-themed block-transparent remove-margin-b">
                        <div class="block-header bg-primary-dark">
                            <ul class="block-options">
                                <li>
                                    <button type="button" data-dismiss="modal"><i class="si si-close"></i></button>
                                </li>
                            </ul>
                            <h3 class="block-title">
                                <i class="fa fa-language push-10-r"></i>{NEW_LANGUAGE_PACK}
                            </h3>
                        </div>
                        <div class="block-content">
                            <div class="panel panel-default">
                                <div class="panel-body remove-padding-b">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <div id="inp-reg_name" class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>                                    
                                                <input type="text" id="lang_code" placeholder="{CODE}" class="form-control" maxlength="255" autocomplete="off" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group remove-margin-b">
                                        <div class="col-sm-12">
                                            <textarea placeholder="{DESCRIPTION}" id="lang_desc" class="form-control" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btn_lpsave" class="btn btn-primary" type="submit">
                            <i class="fa fa-save push-5-r"></i>{NEW_LANGUAGE_PACK}
                        </button>
                        <button id="btn_lpcancel" data-dismiss="modal" class="btn btn-danger" type="button" onClick="javascript:ClearLangPack();">
                            <i class="fa fa-times push-5-r"></i>{CANCEL}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- New Lang Define //-->
    <div id="LDDialog" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popout">
            <div class="modal-content">
                <form method="post" class="form-horizontal form-bordered" onSubmit="javascript:return AddLD();">
                    <div class="block block-themed block-transparent remove-margin-b">
                        <div class="block-header bg-primary-dark">
                            <ul class="block-options">
                                <li>
                                    <button type="button" data-dismiss="modal"><i class="si si-close"></i></button>
                                </li>
                            </ul>
                            <h3 class="block-title">{NEW_PHRASE}</h3>
                        </div>
                        <div class="block-content">
                            <div class="panel panel-default">
                                <div class="panel-body remove-padding-b">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <div id="inp-reg_name" class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-flag"></i></span>                                    
                                                <input type="text" style="text-transform:uppercase;" id="phrase_define" placeholder="{PHRASE}" class="form-control" maxlength="255" autocomplete="off" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group remove-margin-b">
                                        <div class="col-sm-12">
                                            <textarea placeholder="{DESCRIPTION}" id="phrase_value" class="form-control" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btn_ldsave" class="btn btn-primary" type="submit">
                            <i class="fa fa-save push-5-r"></i>{SAVE}
                        </button>
                        <button id="btn_ldcancel" data-dismiss="modal" class="btn btn-danger" type="button" onClick="javascript:ClearLD();">
                            <i class="fa fa-times push-5-r"></i>{CANCEL}
                        </button>
                        <input id="phraseID" type="hidden" value="" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Page Content -->
    <div class="content content-narrow">
        <form class="form-horizontal">
        <div class="row push-10">
            <div class="col-md-8">
                <button type="button" class="btn btn-primary" onclick="javascript:NewLangPack();">
                    <i class="fa fa-language push-5-r"></i>{NEW_LANGUAGE_PACK}
                </button>
                <button type="button" class="btn btn-primary" onclick="javascript:NewDefine();">
                    <i class="fa fa-plus push-5-r"></i>{NEW_PHRASE}
                </button>
                #btn_del#
            </div>
            <div class="col-md-4">
                <select id="SelectLang" onchange="JumpMenu('parent',this,1)" class="form-control input-md">
                    <option value="{D_SITEURL}/administrator/?p=languages">{ALL_LANGUAGES}</option>
                    #language_pack#
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="block block-themed block-rounded">
                    <div class="block-content">
                        <table id="Languages" class="table table-striped table-bordered responsive h6">
                            <thead class="">
                                <tr>
                                    <th class="text-center">{LANGUAGE}</th>
                                    <th class="text-center">{PHRASE}</th>
                                    <th class="text-center">{DESCRIPTION}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                #languages#
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</main>