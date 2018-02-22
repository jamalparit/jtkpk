<main id="main-container">
    <!-- Page Header -->
    <div class="content bg-primary-dark">
        <div class="row items-push">
            <div class="col-sm-8">
                <h1 class="page-heading text-white">
                    <i class="fa fa-bars push-20-r"></i>{MENU}
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
        <form class="form-horizontal">
        <div class="row">
            
            <div class="col-md-4">
                <div id="_menu" class="block block-themed block-rounded push-10">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="content_toggle">
                                    <i class="si si-arrow-up"></i>
                                </button>
                            </li>
                        </ul>
                        <h3 class="block-title cursor-pointer" onclick="javascript:App.blocks('#_menu','content_toggle');">
                            <i class="fa fa-bars push-10-r"></i>{MENU}
                        </h3>
                    </div>
                    <div class="block-content block-content-full block-content-mini bg-gray-lighter">
                        <div class="row js-draggable-items">
                            <div class="col-xs-12 draggable-column">
                                #SYSTEM_MENU#
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div id="_menu_add" class="block block-themed block-rounded push-10">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="content_toggle">
                                    <i class="si si-arrow-up"></i>
                                </button>
                            </li>
                        </ul>
                        <h3 class="block-title cursor-pointer" onclick="javascript:App.blocks('#_menu_add','content_toggle');">
                            <i class="fa fa-bars push-10-r"></i>{ADD_NEW_MENU}
                        </h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{MENU_NAME} :</label>
                            <div class="col-sm-9">
                                <input type="text" id="_menu_name" class="form-control" maxlength="255" placeholder="{MENU_NAME}">
                                <label class="css-input css-radio css-radio-primary push-10-r">
                                    <input type="radio" name="mn" class="mn" value="original" id="mn_original" checked><span></span> {ORIGINAL}
                                </label>
                                <label class="css-input css-radio css-radio-primary">
                                    <input type="radio" name="mn" class="mn" value="language" id="mn_language"><span></span> {LANGUAGE}
                                </label>
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{PARENT_MENU} :</label>
                            <div class="col-sm-9">
                                <select class="js-select2-nosearch form-control" id="_parent_menu" style="width: 100%;" data-placeholder="{PARENT_MENU}">
                                    <option></option>
                                    #PARENT_MENU#
                                </select>
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{MENU_KEY} :</label>
                            <div class="col-sm-9">
                                <input type="text" id="_menu_key" class="form-control" maxlength="255" placeholder="{MENU_KEY}">
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{MENU_ICON} :</label>
                            <div class="col-sm-9">
                                <input type="text" id="_menu_icon" class="form-control" maxlength="255" placeholder="{MENU_ICON}">
                            </div>
                        </div>
                        <div class="form-group items-push border-b">
                            <label class="col-sm-3 control-label">{URL} :</label>
                            <div class="col-sm-9">
                                <input type="text" id="_menu_url" class="form-control" maxlength="255" placeholder="http://">
                            </div>
                        </div>
                        <div class="form-group items-push remove-margin-b border-b">
                            <label class="col-sm-3 control-label">{ROLES} :</label>
                            <div class="col-sm-9">
                                <select multiple id="_menu_roles" data-placeholder="{ROLES}" class="form-control js-select2-nosearch" style="width:100%;">
                                  #ROLES#
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="block-content block-content-full text-right">
                        <input type="hidden" name="_id" id="_id" value="0">
                        <button type="button" class="btn btn-primary" name="btn-save" id="btn-save" onclick="javascript:SaveMenu();">
                            <i class="fa fa-save push-5-r"></i> {SAVE}
                        </button>
                        <button type="button" class="btn btn-danger" name="btn-cancel" id="btn-cancel" onclick="javascript:ClearSaveMenu();">
                            <i class="fa fa-times push-5-r"></i> {CANCEL}
                        </button>
                    </div>
                </div>
            </div>

        </div>
        </form>
    </div>
    <!-- END Page Content -->
</main>
<!-- END Main Container -->