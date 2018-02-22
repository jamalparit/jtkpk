<main id="main-container">
    <!-- Page Header -->
    <div class="content bg-primary-dark">
        <div class="row items-push">
            <div class="col-sm-8">
                <h1 class="page-heading text-white">
                    <i class="fa fa-user push-20-r"></i>{PROFILE}
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
                    <!--
                    <button id="btn-save" class="btn btn-success" type="button" onclick="javascript:SaveProfile();">
                        <i class="fa fa-save push-5-r"></i>{SAVE_CHANGES}
                    </button>
                    //-->
                </div>
            </div>
        </div>
    </div>
    <!-- END Menu -->

    <!-- Dialog PICT //-->
    <div id="DialogPICT" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popout">
            <div class="modal-content">
                <form method="post" class="form-horizontal" onSubmit="javascript:return AddPICT();">
                    <div class="block block-themed block-transparent remove-margin-b">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title">
                                <i class="fa fa-users push-10-r"></i>MAKLUMAT PERJAWATAN ICT
                            </h3>
                        </div>
                        <div class="block-content">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group clearfix items-push border-b">
                                        <label class="col-sm-3 control-label">JAWATAN</label>
                                        <div class="col-sm-9">
                                            <select id="_jawatan" name="_jawatan" data-placeholder="Sila pilih Jawatan" class="form-control js-select2-nosearch" style="width: 100%" required>
                                                #JAWATAN#
                                            </select>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group clearfix items-push border-b">
                                        <label class="col-sm-3 control-label">NAMA PENUH</label>
                                        <div class="col-sm-9">
                                            <input class="form-control text-uppercase" type="text" id="_nama_pict" name="_nama_pict" placeholder="NAMA PENUH" maxlength="255" required>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group clearfix items-push border-b">
                                        <label class="col-sm-3 control-label">NO. KAD PENGENALAN</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="_nokp_pict" name="_nokp_pict" placeholder="NO. KAD PENGENALAN" maxlength="12" required>
                                        </div>
                                    </div>
                                </div>               
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group clearfix items-push border-b">
                                        <label class="col-sm-3 control-label">NO. TELEFON BIMBIT</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="_mobileno_pict" name="_mobileno_pict" placeholder="NO. TELEFON BIMBIT" maxlength="30" required>
                                        </div>
                                    </div>
                                </div>               
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group clearfix">
                                        <label class="col-sm-3 control-label">E-MEL RASMI</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" id="_email_pict" name="_email_pict" placeholder="E-MEL RASMI" maxlength="255" required>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btn_pict_save" class="btn btn-primary" type="submit">
                            <i class="fa fa-check push-5-r"></i>Simpan
                        </button>
                        <button id="btn_pict_cancel" data-dismiss="modal" class="btn btn-danger" type="button" onClick="javascript:ClearPICT();">
                            <i class="fa fa-times push-5-r"></i>Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="content content-narrow">
        <form class="form-horizontal">
        <div class="row">
            <!-- Avatar -->
            <div class="col-sm-12 col-md-3 col-md-push-9">
                <div class="block block-themed block-rounded">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="content_toggle">
                                    <i class="si si-arrow-up"></i>
                                </button>
                            </li>
                        </ul>
                        <h3 class="block-title">
                            <i class="fa fa-camera push-10-r"></i>GAMBAR PASPOT
                        </h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group clearfix">
                            <div class="col-xs-12 text-center">
                                <img class="img-avatar128" title="#_fullname#" src="#_paspot#" width="128"><br><br>
                                <button type="button" id="btn-paspot" class="btn btn-sm btn-primary">
                                    <i class="fa fa-user push-5-r"></i>Tukar Gambar
                                </button>
                                <button type="button" id="btn-delete-paspot" class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="block block-themed block-rounded">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="content_toggle">
                                    <i class="si si-arrow-up"></i>
                                </button>
                            </li>
                        </ul>
                        <h3 class="block-title">
                            <i class="fa fa-camera push-10-r"></i>{AVATAR}
                        </h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group clearfix">
                            <div class="col-xs-12 text-center">
                                <img class="img-avatar img-avatar96" title="#_fullname#" src="#_avatar#" width="100"><br><br>
                                <button type="button" id="btn-avatar" class="btn btn-sm btn-primary">
                                    <i class="fa fa-user push-5-r"></i>Tukar Avatar
                                </button>
                                <button type="button" id="btn-delete-avatar" class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
            
            <!-- Profile -->
            <div class="col-sm-12 col-md-9 col-md-pull-3">
                <div id="div-msg" class="text-center"></div>
                <div class="block block-themed block-rounded">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="content_toggle">
                                    <i class="si si-arrow-up"></i>
                                </button>
                            </li>
                        </ul>
                        <h3 class="block-title">
                            <i class="fa fa-user push-10-r"></i>MAKLUMAT PROFIL
                        </h3>
                    </div>
                    <div class="block-content">
                        <div class="form-group clearfix items-push border-b">
                            <label class="col-sm-3 control-label" for="_firstname">NAMA PENUH</label>
                            <div class="col-sm-9">
                                <input class="form-control text-uppercase" type="text" id="_firstname" name="_firstname" placeholder="NAMA PENUH" value="#_firstname#" maxlength="255">
                            </div>
                        </div>
                        <div class="form-group clearfix items-push border-b">
                            <label class="col-sm-3 control-label" for="_nokp">NO. KAD PENGENALAN</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="_nokp" name="_nokp" placeholder="NO. KAD PENGENALAN" value="#_nokp#" maxlength="12">
                            </div>
                        </div>
                        <div class="form-group clearfix items-push border-b">
                            <label class="col-sm-3 control-label" for="_gred">GRED & JAWATAN</label>
                            <div class="col-sm-9">
                                <select id="_gred" name="_gred" data-placeholder="Sila pilih Gred & Jawatan" class="form-control js-select2-nosearch" style="width: 100%" required>
                                    #GRED#
                                </select>
                            </div>
                        </div>
                        <div class="form-group clearfix items-push border-b">
                            <label class="col-sm-3 control-label" for="_email">E-MEL RASMI</label>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                    <input class="form-control" type="text" id="_email" name="_email" placeholder="E-MEL RASMI" value="#_email#" maxlength="255">
                                </div>
                            </div>
                            <label class="col-sm-3 control-label" for="_mobileno">NO. TELEFON BIMBIT</label>
                            <div class="col-sm-3">                                
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                    <input class="form-control" type="text" id="_mobileno" name="_mobileno" placeholder="NO. TELEFON BIMBIT" value="#_mobileno#" maxlength="30">
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix items-push border-b">
                            <label class="col-sm-3 control-label" for="_akademik">KELAYAKAN AKADEMIK TERTINGGI</label>
                            <div class="col-sm-9">
                                <select id="_akademik" name="_akademik" data-placeholder="KELAYAKAN AKADEMIK TERTINGGI" class="form-control js-select2-nosearch" style="width: 100%" required>
                                    #AKADEMIK#
                                </select>
                            </div>
                        </div>
                        <div class="form-group clearfix items-push border-b">
                            <label class="col-sm-3 control-label" for="_pengkhususan">PENGKHUSUSAN</label>
                            <div class="col-sm-9">
                                <input class="form-control text-uppercase" type="text" id="_pengkhususan" name="_pengkhususan" placeholder="PENGKHUSUSAN" value="#_pengkhususan#" maxlength="255">
                            </div>
                        </div>
                        <div class="form-group clearfix items-push border-b">
                            <label class="col-sm-3 control-label" for="_tarafjawatan">TARAF JAWATAN</label>
                            <div class="col-sm-9">
                                <select id="_tarafjawatan" name="_tarafjawatan" data-placeholder="TARAF JAWATAN" class="form-control js-select2-nosearch" style="width: 100%" required>
                                    #TARAFJAWATAN#
                                </select>
                            </div>
                        </div>
                        <div class="form-group clearfix items-push border-b">
                            <label class="col-sm-3 control-label" for="_tarikh_lantikan_pertama">TARIKH LANTIKAN PERTAMA</label>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    <input type="text" id="_tarikh_lantikan_pertama" placeholder="TARIKH LANTIKAN PERTAMA" class="form-control js-date" value="#_tarikh_lantikan_pertama#" maxlength="10" autocomplete="off" />
                                </div>
                            </div>
                            <label class="col-sm-3 control-label" for="_tarikh_khidmat">TARIKH KHIDMAT SEKOLAH SEMASA</label>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    <input type="text" id="_tarikh_khidmat" placeholder="TARIKH KHIDMAT SEKOLAH SEMASA" class="form-control js-date" value="#_tarikh_khidmat#" maxlength="10" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix items-push border-b">
                            <label class="col-sm-3 control-label" for="_opsyen">OPSYEN BERSARA (TAHUN)</label>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user-circle-o"></i></span>
                                    <input class="form-control" type="text" id="_opsyen" name="_opsyen" placeholder="OPSYEN BERSARA" value="#_opsyen#" maxlength="2">
                                </div>
                            </div>
                            <label class="col-sm-3 control-label" for="_jarak">JARAK KE TEMPAT BERTUGAS (KM)</label>
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-car"></i></span>
                                    <input class="form-control" type="text" id="_jarak" name="_jarak" placeholder="JARAK KE TEMPAT BERTUGAS (KM)" value="#_jarak#" maxlength="2">
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix items-push border-b">
                            <label class="col-sm-3 control-label" for="_alamat1">ALAMAT TEMPAT TINGGAL SEMASA</label>
                            <div class="col-sm-9">
                                <input class="form-control text-uppercase" type="text" id="_alamat1" name="_alamat1" placeholder="ALAMAT" value="#_alamat1#" maxlength="255">
                            </div>
                        </div>
                        <div class="form-group clearfix items-push border-b">
                            <label class="col-sm-3 control-label" for="_alamat2"></label>
                            <div class="col-sm-9">
                                <input class="form-control text-uppercase" type="text" id="_alamat2" name="_alamat2" placeholder="ALAMAT" value="#_alamat2#" maxlength="255">
                            </div>
                        </div>
                        <div class="form-group clearfix items-push border-b">
                            <label class="col-sm-3 control-label" for="_poskod">POSKOD</label>
                            <div class="col-sm-3">
                                <input class="form-control" type="text" id="_poskod" name="_poskod" placeholder="POSKOD" value="#_poskod#" maxlength="5">
                            </div>
                            <label class="col-sm-2 control-label" for="_bandar">BANDAR</label>
                            <div class="col-sm-4">
                                <input class="form-control text-uppercase" type="text" id="_bandar" name="_bandar" placeholder="BANDAR" value="#_bandar#" maxlength="255">
                            </div>
                        </div>
                        <div class="form-group clearfix items-push border-b">
                            <label class="col-sm-3 control-label" for="_negeri">NEGERI</label>
                            <div class="col-sm-9">
                                <select id="_negeri" name="_negeri" data-placeholder="NEGERI" class="form-control js-select2-nosearch" style="width: 100%" required>
                                    #NEGERI#
                                </select>
                            </div>
                        </div>
                        <div class="form-group clearfix items-push border-b">                            
                            <label class="col-sm-3 text-right" for="_tempat_bertugas">TEMPAT BERTUGAS</label>
                            <div class="col-sm-9" id="_tempat_bertugas">
                                <label class="css-input css-radio css-radio-primary push-10-r">
                                    <input type="radio" name="_tempatbertugas" value="JPN" #CHK_JPN#><span></span> JPN
                                </label>
                                <label class="css-input css-radio css-radio-primary push-10-r">
                                    <input type="radio" name="_tempatbertugas" value="PPD" #CHK_PPD#><span></span> PPD
                                </label>
                                <label class="css-input css-radio css-radio-primary push-10-r">
                                    <input type="radio" name="_tempatbertugas" value="PKG" #CHK_PKG#><span></span> PKG
                                </label>
                                <label class="css-input css-radio css-radio-primary push-10-r">
                                    <input type="radio" name="_tempatbertugas" value="SEK" #CHK_SEK#><span></span> SEKOLAH
                                </label>
                            </div>
                        </div>
                        <div class="form-group clearfix items-push border-b">
                            <label class="col-sm-3 text-right" for="detail_tempat_bertugas"></label>
                            <div class="col-sm-9" id="detail_tempat_bertugas">
                                <select id="_jpn" name="_jpn" data-placeholder="JPN Negeri" class="form-control js-select2-nosearch" style="width: 100%;" required>
                                    #JPN#
                                </select>
                                <select id="_ppd" name="_ppd" data-placeholder="Pejabat Pendidikan Daerah (PPD)" class="form-control js-select2-nosearch" style="width: 100%">
                                    <option></option>
                                    #PPD#
                                </select>
                                <select id="_pkg" name="_pkg" data-placeholder="Pusat Kegiatan Guru Daerah (PKG)" class="form-control js-select2-nosearch" style="width: 100%">
                                    <option></option>
                                    #PKG#
                                </select>
                                <select id="_sekolah" name="_sekolah" data-placeholder="Nama Sekolah" class="form-control js-select2-nosearch" style="width: 100%">
                                    <option></option>
                                    #SEKOLAH#
                                </select>
                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <div class="col-sm-12 text-right">
                                <button id="btn-save" class="btn btn-success" type="button" onclick="javascript:SaveProfile();">
                                    <i class="fa fa-save push-5-r"></i>Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                #PERJAWATAN_ICT#

                <div class="block block-themed block-rounded">
                    <div class="block-header bg-primary-dark">
                        <ul class="block-options">
                            <li>
                                <button type="button" data-toggle="block-option" data-action="content_toggle">
                                    <i class="si si-arrow-up"></i>
                                </button>
                            </li>
                        </ul>
                        <h3 class="block-title">
                            <i class="fa fa-lock push-10-r"></i>TUKAR KATA LALUAN
                        </h3>
                    </div>
                    <div class="block-content block-content-full block-content-mini border-b">
                        <span class="text-danger">Kosongkan ruangan jika anda tidak mahu menukar kata laluan.</span>
                    </div>
                    <div class="block-content">
                        <div class="form-group clearfix items-push border-b">
                            <label class="col-sm-3 control-label" for="pwd">Kata Laluan Baru</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="password" id="pwd" name="pwd" placeholder="Kata Laluan Baru">
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <label class="col-sm-3 control-label" for="rpwd">Taip Semula</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="password" id="rpwd" name="rpwd" placeholder="Taip Semula">
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
        </form>
    </div>
</main>