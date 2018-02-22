<div id="PMDialog" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-popout">
        <div class="modal-content">
            <form class="js-pm" method="post" onsubmit="javascript:return SendPM('#refresh#');">
            <div class="block block-themed block-transparent remove-margin-b">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">
                        <i class="fa fa-send push-10-r"></i>{NEW_MSG}
                    </h3>
                </div>
                <div class="block-content block-content-full">
                    <p class="h5 font-w300 remove-margin-b">{PLEASE_SELECT_RECIPIENT} :</p>
                    <div class="form-group remove-margin-b push-10-t">
                        <div>
                            <select multiple class="form-control" id="_to" name="_to" style="width:100%;" data-placeholder="{RECIPIENT}">
                                #USERS#
                            </select>
                        </div>
                    </div>
                    <div class="form-group remove-margin-b push-10-t">
                        <div>
                            <textarea id="pm_txt" name="pm_txt" rows="6" class="form-control js-emojis h5 font-w300" placeholder="{YOUR_MESSAGE}..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btn-sendpm" class="btn btn-sm btn-primary" type="submit">
                    <i class="fa fa-send push-5-r"></i>{SEND}
                </button>
                <button class="btn btn-sm btn-default" type="button" data-dismiss="modal" onclick="javascript:ClearPM();">
                    <i class="fa fa-times push-5-r"></i>{CANCEL}
                </button>                
            </div>
            </form>
        </div>
    </div>
</div>