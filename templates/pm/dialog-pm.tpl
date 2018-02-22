<div class="modal fade" id="pmdialog" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin">
        <div class="modal-content">
            <form class="js-pm-validation" method="post" onsubmit="javascript:return doPM('#ow_id#');">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary-dark">
                    <ul class="block-options">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                        </li>
                    </ul>
                    <h3 class="block-title">
                        <i class="fa fa-envelope push-5-r"></i>{PRIVATE_MSG}
                    </h3>
                </div>
                <div class="block-content block-content-full">
                    <p class="h5 font-w300 remove-margin-b">{TO} : &nbsp; <b>#ow_name#</b></p>
                    <div class="form-group remove-margin-b push-10-t">
                        <div>
                        <textarea id="pm_txt" name="pm_txt" rows="6" class="form-control h6 font-w300" placeholder="{YOUR_MESSAGE}..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="pull-left">
                    <span id="p-sendpm" class="h6 font-w300 hide"><i class="fa fa-cog fa-spin"></i> &nbsp;{PLEASE_WAIT}...</span>
                </div>
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">{CANCEL}</button>
                <button id="btn-sendpm" class="btn btn-sm btn-primary" type="submit">
                    <i class="fa fa-envelope push-5-r"></i>{SEND_PM}
                </button>
                <input id="pm-alert" type="hidden" value="#pm-alert#">
            </div>
            </form>
        </div>
    </div>
</div>