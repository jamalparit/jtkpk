<!-- Welcome //-->
<div id="WelcomeDialog" class="modal fade" data-backdrop="static" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin">
        <div class="modal-content">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">
                        <i class="fa fa-bullhorn push-10-r"></i>
                        <span class="font-w300">{WELCOME_TO}</span> <b>{D_SITENAME}</b>
                    </h3>
                </div>
                <div class="block-content text-left">
                    <div class="nice-copy font-w300 push-20">
                        #WELCOME_MSG#
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="pull-left">
                    <label class="css-input css-checkbox css-checkbox-primary font-w300 h6 push-5-t">
                        <input type="checkbox" id="dont_show" name="dont_show" value="1"><span></span> {S_DONT_SHOW_THIS_DIALOG}
                    </label>
                </div>
                <button class="btn btn-sm btn-primary" type="button" data-dismiss="modal" onclick="javascript:welcome();">
                    <i class="fa fa-thumbs-up push-5-r"></i>{OK}
                </button>
            </div>
        </div>
    </div>
</div>