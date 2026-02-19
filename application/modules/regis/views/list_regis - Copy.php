<!DOCTYPE html>
<html lang="en">
    <head> <?php $this->theme->head('theme_default'); ?> <?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?> <title>Registrasi Pasien</title>
    </head>
    <body> <?php $this->theme->wrapper_open('theme_default'); ?> <div class="loader-bg">
            <div class="loader-bar"></div>
        </div>
        <div id="pcoded" class="pcoded">
            <div class="pcoded-overlay-box"></div>
            <div class="pcoded-container navbar-wrapper">
                <div class="pcoded-main-container">
                    <div class="pcoded-wrapper">
                        <div class="pcoded-content">
                            <div class="page-header card">
                                <div class="row align-items-end">
                                    <div class="col-lg-8">
                                        <div class="page-header-title">
                                            <i class="feather icon-book bg-c-blue"></i>
                                            <div class="d-inline">
                                                <h5>Registrasi</h5>
                                                <span>Registrasi pasien lama / pasien baru</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="page-header-breadcrumb">
                                            <ul class=" breadcrumb breadcrumb-title">
                                                <li class="breadcrumb-item">
                                                    <a href="
														<?php echo base_url('./'); ?>">
                                                        <i class="feather icon-home"></i>
                                                    </a>
                                                </li>
                                                <li class="breadcrumb-item">
                                                    <a href="
														<?php echo base_url('regis/'); ?>">Form Registrasi </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pcoded-inner-content">
                                <div class="main-body">
                                    <div class="page-wrapper">
                                        <div class="page-body">
                                            <!--tab-->
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="card">
                                                        <!--<div class="card-header"><h5>Tab Variant</h5></div>-->
                                                        <div class="card-block tab-icon">
                                                            <div class="row">
                                                                <div class="col-lg-12 col-xl-12">
                                                                    <!--<div class="sub-title">Tab With Icon</div>-->
                                                                    <ul class="nav nav-tabs md-tabs " role="tablist">
                                                                        <li class="nav-item">
                                                                            <a class="nav-link" data-toggle="tab" href="#registrasi" id="regpasnew" role="tab" aria-selected="false">
                                                                                <i class="icofont icofont-book"></i>Pasien Baru </a>
                                                                            <div class="slide"></div>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <a class="nav-link active show" data-toggle="tab" href="#pasien_baru" role="tab" aria-selected="false">
                                                                                <i class="icofont icofont-ui-user "></i>Pasien Lama</a>
                                                                            <div class="slide"></div>
                                                                        </li>
																		
                                                                        <li class="nav-item d-none">
                                                                            <a class="nav-link" data-toggle="tab" href="#pasien_paket" id="pasien_paket_aktif" role="tab" aria-selected="false">
                                                                                <i class="icofont icofont-ui-check"></i>checkin Pasien Paket </a>
                                                                            <div class="slide"></div>
                                                                        </li>
                                                                        <!--<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#settings7" role="tab" aria-selected="true"><i class="icofont icofont-ui-settings"></i>Settings</a><div class="slide"></div></li>-->
                                                                    </ul>
                                                                    <div class="tab-content card-block">
                                                                        <div class="tab-pane" id="registrasi" role="tabpanel">
                                                                            <!--Row 1-->
                                                                            <div class="row">
                                                                                <div class="card-header">
                                                                                    <h5>Data Pasien</h5>
                                                                                </div>
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-2 col-form-label">Nama</label>
                                                                                        <div class="col-sm-4">
                                                                                            <input type="text" class="form-control nama_pasien_pasien_baru" id="nama_pasien_pasien_baru" name="nama_pasien_pasien_baru" required>
                                                                                        </div>
                                                                                        <label class="col-sm-2 col-form-label">Tgl. Lahir</label>
                                                                                        <div class="col-sm-4">
                                                                                            <input class="form-control fill" type="text" id="tgllhr_pasien_baru" name="tgllhr_pasien_baru" required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-2 col-form-label">Tempat Lahir</label>
                                                                                        <div class="col-sm-4">
                                                                                            <input type="text" class="form-control" id="tempatlhr_pasien_baru" name="tempatlhr_pasien_baru">
                                                                                        </div>
                                                                                        <label class="col-sm-2 col-form-label">JK</label>
                                                                                        <div class="col-sm-4">
                                                                                            <select class="js-example-basic-single1 col-sm-12 selmstgender_pasien_baru" id="gender_pasien_baru" name="gender_pasien_baru"></select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-2 col-form-label">GD</label>
                                                                                        <div class="col-sm-4">
                                                                                            <select class="js-example-basic-single1 col-sm-12 selmstgoldar_pasien_baru" id="goldar_pasien_baru" name="goldar_pasien_baru"></select>
                                                                                        </div>
                                                                                        <label class="col-sm-2 col-form-label">RH</label>
                                                                                        <div class="col-sm-4">
                                                                                            <select class="js-example-basic-single1 col-sm-12 selmstrh_pasien_baru" id="rh_pasien_baru" name="rh_pasien_baru"></select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-2 col-form-label">No. Telp</label>
                                                                                        <div class="col-sm-4">
                                                                                            <input type="text" class="form-control" id="telp_pasien_baru" name="telp_pasien_baru">
                                                                                        </div>
                                                                                        <label class="col-sm-2 col-form-label">No. HP</label>
                                                                                        <div class="col-sm-4">
                                                                                            <input type="text" class="form-control" id="hp_pasien_baru" name="hp_pasien_baru">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-2 col-form-label">Alamat</label>
                                                                                        <div class="col-sm-4">
                                                                                            <input type="text" class="form-control setalamat_pasien_baru" id="setalamat_pasien_baru" name="setalamat_pasien_baru">
                                                                                        </div>
                                                                                        <label class="col-sm-2 col-form-label">Kelurahan</label>
                                                                                        <div class="col-sm-4">
                                                                                            <select class="js-example-basic-single1 col-sm-12 selmstkelurahan_pasien_baru" id="idkelurahan_pasien_baru" name="idkelurahan_pasien_baru"></select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-2 col-form-label">Kecamatan</label>
                                                                                        <div class="col-sm-4">
                                                                                            <select class="js-example-basic-single1 col-sm-12 selmstkecamatan_pasien_baru" id="idkecamatan_pasien_baru" name="idkecamatan_pasien_baru"></select>
                                                                                        </div>
                                                                                        <label class="col-sm-2 col-form-label">Kabupaten</label>
                                                                                        <div class="col-sm-4">
                                                                                            <select class="js-example-basic-single1 col-sm-12 selmstkota_pasien_baru" id="idkota_pasien_baru" name="idkota_pasien_baru"></select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-2 col-form-label">Propinsi</label>
                                                                                        <div class="col-sm-4">
                                                                                            <select class="js-example-basic-single1 col-sm-12 selmstpropinsi_pasien_baru" id="idpropinsi_pasien_baru" name="idpropinsi_pasien_baru"></select>
                                                                                        </div>
                                                                                        <label class="col-sm-2 col-form-label">Kode Pos</label>
                                                                                        <div class="col-sm-4">
                                                                                            <input type="text" class="form-control selmstkodepos_pasien_baru" id="kodepos_pasien_baru" name="kodepos_pasien_baru">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-2 col-form-label">Tanda Pengenal</label>
                                                                                        <div class="col-sm-4">
                                                                                            <select class="js-example-basic-single col-sm-12 selmsttandapengenal_pasien_baru" id="tandapengenal_pasien_baru" name="tandapengenal_pasien_baru"></select>
                                                                                        </div>
                                                                                        <label class="col-sm-2 col-form-label">Nomor Pengenal</label>
                                                                                        <div class="col-sm-4">
                                                                                            <input type="text" class="form-control" id="nomorpengenal_pasien_baru" name="nomorpengenal_pasien_baru">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-2 col-form-label">Suku</label>
                                                                                        <div class="col-sm-4">
                                                                                            <select class="js-example-basic-single col-sm-12 selmstsuku_pasien_baru" id="idsuku_pasien_baru" name="idsuku_pasien_baru"></select>
                                                                                        </div>
                                                                                        <label class="col-sm-2 col-form-label">NIK</label>
                                                                                        <div class="col-sm-4">
                                                                                            <input type="text" class="form-control" id="nik_pasien_baru" name="nik_pasien_baru">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-2 col-form-label">Agama</label>
                                                                                        <div class="col-sm-4">
                                                                                            <select class="js-example-basic-single col-sm-12 selmstagama_pasien_baru" id="idagama_pasien_baru" name="idagama_pasien_baru"></select>
                                                                                        </div>
                                                                                        <label class="col-sm-2 col-form-label">Status</label>
                                                                                        <div class="col-sm-4">
                                                                                            <select class="js-example-basic-single col-sm-12 selmststatus_pasien_baru" id="status_pasien_baru" name="status_pasien_baru"></select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-2 col-form-label">Pendidikan</label>
                                                                                        <div class="col-sm-4">
                                                                                            <select class="js-example-basic-single col-sm-12 selmstpendidikan_pasien_baru" id="idpendidikan_pasien_baru" name="idpendidikan_pasien_baru"></select>
                                                                                        </div>
                                                                                        <label class="col-sm-2 col-form-label">Pekerjaan</label>
                                                                                        <div class="col-sm-4">
                                                                                            <select class="js-example-basic-single col-sm-12 selmstpekerjaan_pasien_baru" id="idpekerjaan_pasien_baru" name="idpekerjaan_pasien_baru"></select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-2 col-form-label">Jabatan</label>
                                                                                        <div class="col-sm-4">
                                                                                            <input type="text" class="form-control" id="jabatan_pasien_baru" name="jabatan_pasien_baru">
                                                                                        </div>
                                                                                        <label class="col-sm-2 col-form-label">Departemen</label>
                                                                                        <div class="col-sm-4">
                                                                                            <input type="text" class="form-control" id="departemen_pasien_baru" name="departemen_pasien_baru">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-2 col-form-label">Nama Keluarga</label>
                                                                                        <div class="col-sm-4">
                                                                                            <input type="text" class="form-control" id="namakeluarga_pasien_baru" name="namakeluarga_pasien_baru">
                                                                                        </div>
                                                                                        <label class="col-sm-2 col-form-label">Alamat</label>
                                                                                        <div class="col-sm-4">
                                                                                            <input type="text" class="form-control setalamatkeluarga_pasien_baru" id="setalamatkeluarga_pasien_baru" name="setalamatkeluarga_pasien_baru">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-2 col-form-label">&nbsp;</label>
                                                                                        <div class="col-sm-4">
                                                                                            <button class="btn btn-primary setcopy_pasien_baru">Copy Alamat</button>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-2 col-form-label">Telp</label>
                                                                                        <div class="col-sm-4">
                                                                                            <input type="text" class="form-control" id="telpkeluarga_pasien_baru" name="telpkeluarga_pasien_baru">
                                                                                        </div>
                                                                                        <label class="col-sm-2 col-form-label">HP</label>
                                                                                        <div class="col-sm-4">
                                                                                            <input type="text" class="form-control" id="hpkeluarga_pasien_baru" name="hpkeluarga_pasien_baru">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!--End Row 1-->
                                                                            
                                                                            
                                                                        </div>
                                                                        <div class="tab-pane active show" id="pasien_baru" role="tabpanel">
                                                                            <div class="row">
                                                                                <div class="col-sm-3 col-xl-3 m-b-30">
                                                                                    <h4 class="sub-title">Nama</h4>
                                                                                    <input type="text" class="form-control" id="search_nama_pasien" name="search_nama_pasien">
                                                                                </div>
                                                                                <div class="col-sm-3 col-xl-3 m-b-30">
                                                                                    <h4 class="sub-title">No. MR</h4>
                                                                                    <input type="text" class="form-control" id="search_id_pasien" name="search_id_pasien">
                                                                                </div>
                                                                                <div class="col-sm-3 col-xl-3 m-b-30">
                                                                                    <h4 class="sub-title">Tgl. Lahir</h4>
                                                                                    <input type="text" class="form-control" id="search_tgl_lahir" name="search_tgl_lahir">
                                                                                </div>
                                                                                <div class="col-sm-3 col-xl-3 m-b-30">
                                                                                    <h4 class="sub-title">&nbsp;</h4>
                                                                                    <button class="btn waves-effect waves-light btn-primary checkdata">
                                                                                        <i class="fa fa-search"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <div class="card">
                                                                                        <div class="card-block">
                                                                                            <div class="card-block contresdatapasien"></div>
                                                                                            <div id="datapasienreg">
                                                                                                <!--<h5>Default Modal</h5>
REGISTRASI PASIEN LAMA-->
                                                                                                <div class="row">
                                                                                                    <div class="col-sm-12">
                                                                                                        <!--Pasien-->
                                                                                                        <div class="card">
                                                                                                            <div class="card-header">
                                                                                                                <h5>Data Pasien</h5>
                                                                                                                <span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag </span>
                                                                                                            </div>
                                                                                                            <div class="card-block">
                                                                                                                <!--Row 1-->
                                                                                                                <div class="row">
                                                                                                                    <div class="col-sm-12">
                                                                                                                        <div class="form-group row">
                                                                                                                            <label class="col-sm-2 col-form-label">No. RM</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <input type="text" class="form-control" id="id_pasien_lama" name="id_pasien_lama" readonly>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="form-group row">
                                                                                                                            <label class="col-sm-2 col-form-label">Nama</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <input type="text" class="form-control nama_pasien_pasien_lama" id="nama_pasien_lama" name="nama_pasien_lama" readonly>
                                                                                                                            </div>
                                                                                                                            <label class="col-sm-2 col-form-label">Tgl. Lahir</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <input class="form-control fill" id="tgllhr_pasien_lama" name="tgllhr_pasien_lama" readonly>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="form-group row">
                                                                                                                            <label class="col-sm-2 col-form-label">Tempat Lahir</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <input type="text" class="form-control" id="tempatlahir_pasien_lama" name="tempatlahir_pasien_lama" readonly>
                                                                                                                            </div>
                                                                                                                            <label class="col-sm-2 col-form-label">JK</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <select class="js-example-basic-single col-sm-12 selmstgender_pasien_lama" disabled></select>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="form-group row">
                                                                                                                            <label class="col-sm-2 col-form-label">GD</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <select class="js-example-basic-single col-sm-12 selmstgoldar_pasien_lama" disabled></select>
                                                                                                                            </div>
                                                                                                                            <label class="col-sm-2 col-form-label">RH</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <select class="js-example-basic-single col-sm-12 selmstrh_pasien_lama" disabled></select>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="form-group row">
                                                                                                                            <label class="col-sm-2 col-form-label">No. Telp</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <input type="text" class="form-control" id="telp_pasien_lama" name="telp_pasien_lama" readonly>
                                                                                                                            </div>
                                                                                                                            <label class="col-sm-2 col-form-label">No. HP</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <input type="text" class="form-control" id="hp_pasien_lama" name="hp_pasien_lama" readonly>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="form-group row">
                                                                                                                            <label class="col-sm-2 col-form-label">Alamat</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <input type="text" class="form-control setalamat" id="alamat_pasien_lama" name="alamat_pasien_lama" readonly>
                                                                                                                            </div>
                                                                                                                            <label class="col-sm-2 col-form-label">Kelurahan</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <select class="js-example-basic-single col-sm-12 selmstkelurahan_pasien_lama" disabled></select>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="form-group row">
                                                                                                                            <label class="col-sm-2 col-form-label">Kecamatan</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <select class="js-example-basic-single col-sm-12 selmstkecamatan_pasien_lama" disabled></select>
                                                                                                                            </div>
                                                                                                                            <label class="col-sm-2 col-form-label">Kabupaten</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <select class="js-example-basic-single col-sm-12 selmstkota_pasien_lama" disabled></select>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="form-group row">
                                                                                                                            <label class="col-sm-2 col-form-label">Propinsi</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <select class="js-example-basic-single col-sm-12 selmstpropinsi_pasien_lama" disabled></select>
                                                                                                                            </div>
                                                                                                                            <label class="col-sm-2 col-form-label">Kode Pos</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <input type="text" class="form-control" id="kodepos_pasien_lama" name="kodepos_pasien_lama" readonly>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="form-group row">
                                                                                                                            <label class="col-sm-2 col-form-label">Tanda Pengenal</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <select class="js-example-basic-single col-sm-12 selmsttandapengenal_pasien_lama" disabled></select>
                                                                                                                            </div>
                                                                                                                            <label class="col-sm-2 col-form-label">Nomor Pengenal</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <input type="text" class="form-control" id="nomorpengenal_pasien_lama" name="nomorpengenal_pasien_lama" readonly>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="form-group row">
                                                                                                                            <label class="col-sm-2 col-form-label">Kebangsaan</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <select class="js-example-basic-single col-sm-12 selmstsuku_pasien_lama" disabled></select>
                                                                                                                            </div>
                                                                                                                            <label class="col-sm-2 col-form-label">NIK</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <input type="text" class="form-control" id="nik_pasien_lama" name="nik_pasien_lama" readonly>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="form-group row">
                                                                                                                            <label class="col-sm-2 col-form-label">Agama</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <select class="js-example-basic-single col-sm-12 selmstagama_pasien_lama" disabled></select>
                                                                                                                            </div>
                                                                                                                            <label class="col-sm-2 col-form-label">Status</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <select class="js-example-basic-single col-sm-12 selmststatus_pasien_lama" disabled></select>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="form-group row">
                                                                                                                            <label class="col-sm-2 col-form-label">Pendidikan</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <select class="js-example-basic-single col-sm-12 selmstpendidikan_pasien_lama" disabled></select>
                                                                                                                            </div>
                                                                                                                            <label class="col-sm-2 col-form-label">Pekerjaan</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <select class="js-example-basic-single col-sm-12 selmstpekerjaan_pasien_lama" disabled></select>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="form-group row">
                                                                                                                            <label class="col-sm-2 col-form-label">Jabatan</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <input type="text" class="form-control" id="jabatan_pasien_lama" name="jabatan_pasien_lama" readonly>
                                                                                                                            </div>
                                                                                                                            <label class="col-sm-2 col-form-label">Departemen</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <input type="text" class="form-control" id="departemen_pasien_lama" name="departemen_pasien_lama" readonly>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="form-group row">
                                                                                                                            <label class="col-sm-2 col-form-label">Nama Keluarga</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <input type="text" class="form-control" id="namakeluarga_pasien_lama" name="namakeluarga_pasien_lama" readonly>
                                                                                                                            </div>
                                                                                                                            <label class="col-sm-2 col-form-label">Alamat</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <input type="text" class="form-control" id="alamatkeluarga_pasien_lama" name="alamatkeluarga_pasien_lama" readonly>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="form-group row">
                                                                                                                            <label class="col-sm-2 col-form-label">Telp</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <input type="text" class="form-control" id="telpkeluarga_pasien_lama" name="telpkeluarga_pasien_lama" readonly>
                                                                                                                            </div>
                                                                                                                            <label class="col-sm-2 col-form-label">HP</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <input type="text" class="form-control" id="hpkeluarga_pasien_lama" name="hpkeluarga_pasien_lama" readonly>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <!--End Row 1-->
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <!--End Pasien-->
                                                                                                        <!--Registrasi-->
                                                                                                        <div class="card">
                                                                                                            <div class="card-header">
                                                                                                                <h5>Registrasi</h5>
                                                                                                                <span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag </span>
                                                                                                            </div>
                                                                                                            <div class="card-block">
                                                                                                                <!--Row 1-->
                                                                                                                <div class="row">
                                                                                                                    <div class="col-sm-12">
                                                                                                                        <div class="form-group row">
                                                                                                                            <label class="col-sm-2 col-form-label">Dokter 1</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <select class="js-example-basic-single col-sm-12 selmstdokter_pasien_lama" id="iddokter1_pasien_lama" name="iddokter1_pasien_lama"></select>
                                                                                                                            </div>
                                                                                                                            <label class="col-sm-2 col-form-label">Paket</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <select class="js-example-basic-single col-sm-12 selmstpaket_pasien_lama" id="selmstpaket_pasien_lama" name="selmstpaket_pasien_lama"></select>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="form-group row">
                                                                                                                            <label class="col-sm-2 col-form-label">RS. Rujukan</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <select class="js-example-basic-single col-sm-12 selmstrujukan_pasien_lama" id="selmstrujukan_pasien_lama" name="selmstrujukan_pasien_lama"></select>
                                                                                                                            </div>
                                                                                                                            <label class="col-sm-2 col-form-label">Dr./Prwt. Perujuk</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <input type="text" class="form-control" id="drperujuk_pasien_lama" name="drperujuk_pasien_lama">
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="form-group row">
                                                                                                                            <label class="col-sm-2 col-form-label">Penanggung</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <input type="text" class="form-control setpenanggung_pasien_lama" id="penanggung_pasien_lama" name="penanggung_pasien_lama">
                                                                                                                            </div>
                                                                                                                            <label class="col-sm-2 col-form-label">Rujukan</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <input type="text" class="form-control" id="rujukan_pasien_lama" name="rujukan_pasien_lama">
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="form-group row">
                                                                                                                            <label class="col-sm-2 col-form-label">&nbsp;</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <button class="btn btn-primary setcopypenanggung_pasien_lama">Copy nama penanggung</button>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="form-group row" hidden>
                                                                                                                            <label class="col-sm-2 col-form-label">&nbsp;</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <select class="js-example-basic-single col-sm-12 selmstcomp3_pasien_lama" id="selmstcomp3_pasien_lama" name="selmstcomp3_pasien_lama"></select>
                                                                                                                            </div>
                                                                                                                            <label class="col-sm-2 col-form-label">Provider/TPA</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <select class="js-example-basic-single col-sm-12 selmstcomp2_pasien_lama" id="selmstcomp2_pasien_lama" name="selmstcomp2_pasien_lama"></select>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="form-group row">
                                                                                                                            <label class="col-sm-2 col-form-label">Perusahaan</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <select class="js-example-basic-single col-sm-12 selmstcomp1_pasien_lama" id="selmstcomp1_pasien_lama" name="selmstcomp1_pasien_lama"></select>
                                                                                                                            </div>
                                                                                                                            <label class="col-sm-2 col-form-label">Nomor</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <input type="text" class="form-control" id="nomorkartu_pasien_lama" name="nomorkartu_pasien_lama" readonly>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="form-group row">
                                                                                                                            <label class="col-sm-2 col-form-label">Nama</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <input type="text" class="form-control" id="namakartu_pasien_lama" name="namakartu_pasien_lama" readonly>
                                                                                                                            </div>
                                                                                                                            <label class="col-sm-2 col-form-label">Asal Perusahaan</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <input type="text" class="form-control" id="asalperusahaan_pasien_lama" name="asalperusahaan_pasien_lama" readonly>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="form-group row">
                                                                                                                            <label class="col-sm-2 col-form-label">Hub. Keluarga</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <select class="js-example-basic-single col-sm-12 selmsthubkel_pasien_lama" id="idhub_pasien_lama" name="idhub_pasien_lama"></select>
                                                                                                                            </div>
                                                                                                                            <label class="col-sm-2 col-form-label">Keterangan</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <textarea class="form-control" id="keterangan_pasien_lama" name="keterangan_pasien_lama"></textarea>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="form-group row">
                                                                                                                            <label class="col-sm-2 col-form-label">Dikonfirmasi Oleh</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <input type="text" class="form-control" id="dikonfirmasi_pasien_lama" name="dikonfirmasi_pasien_lama">
                                                                                                                            </div>
                                                                                                                            <label class="col-sm-2 col-form-label">Tanggal</label>
                                                                                                                            <div class="col-sm-4">
                                                                                                                                <input type="text" class="form-control" id="tglkonfirmasi_pasien_lama" name="tglkonfirmasi_pasien_lama" value=<?php echo date('Y-m-d'); ?>>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <!--End Row 1-->
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <!--End Registrasi-->
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="modal-footer">
                                                                                                    <button type="button" class="btn btn-primary waves-effect waves-light set_reg_old">Register Pasien Lama</button>
                                                                                                </div>
                                                                                                <!--END REGISTRASI PASIEN LAMA-->
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="tab-pane" id="pasien_paket" role="tabpanel">
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <div class="card">
                                                                                        <div class="card-block">
                                                                                            <span>Klik Row untuk checkin data pasien</span>
                                                                                            <div class="card-block contresdatapasienpaket"></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!--<div class="tab-pane" id="settings7" role="tabpanel"><p class="m-0">4.Cras consequat in enim ut efficitur. Nulla posuere elit quis auctor interdum praesent sit amet nulla vel enim amet. Donec convallis tellus neque, et imperdiet felis amet.</p></div>-->
                                                                    </div>
                                                                
																	
																	<!--Row 2-->
																			<div class="card">
																			<div class="card-header">
																				<h5>Registrasi XXX</h5>
																				<span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag </span>
																			</div>
																			<div class="card-block">
                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-2 col-form-label">Dokter 1 xxx</label>
                                                                                        <div class="col-sm-4">
                                                                                            <select class="js-example-basic-single col-sm-12 selmstdokter_pasien_baru" id="iddokter1_pasien_baru" name="iddokter1_pasien_baru"></select>
                                                                                        </div>
                                                                                        <label class="col-sm-2 col-form-label">Paket</label>
                                                                                        <div class="col-sm-4">
                                                                                            <select class="js-example-basic-single col-sm-12 selmstpaket_pasien_baru" id="selmstpaket_pasien_baru" name="selmstpaket_pasien_baru"></select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-2 col-form-label">RS. Rujukan</label>
                                                                                        <div class="col-sm-4">
                                                                                            <select class="js-example-basic-single col-sm-12 selmstrujukan_pasien_baru" id="selmstrujukan_pasien_baru" name="selmstrujukan_pasien_baru"></select>
                                                                                        </div>
                                                                                        <label class="col-sm-2 col-form-label">Dr./Prwt. Perujuk</label>
                                                                                        <div class="col-sm-4">
                                                                                            <input type="text" class="form-control" id="drperujuk_pasien_baru" name="drperujuk_pasien_baru">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-2 col-form-label">Penanggung</label>
                                                                                        <div class="col-sm-4">
                                                                                            <input type="text" class="form-control setpenanggung_pasien_baru" id="setpenanggung_pasien_baru" name="setpenanggung_pasien_baru">
                                                                                        </div>
                                                                                        <label class="col-sm-2 col-form-label">Rujukan</label>
                                                                                        <div class="col-sm-4">
                                                                                            <input type="text" class="form-control" id="rujukan_pasien_baru" name="rujukan_pasien_baru">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-2 col-form-label">&nbsp;</label>
                                                                                        <div class="col-sm-4">
                                                                                            <button class="btn btn-primary setcopypenanggung_pasien_baru">Copy nama penanggung</button>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row" hidden>
                                                                                        <label class="col-sm-2 col-form-label">&nbsp;</label>
                                                                                        <div class="col-sm-4">
                                                                                            <select class="js-example-basic-single col-sm-12 selmstcomp3_pasien_baru" id="selmstcomp3_pasien_baru" name="selmstcomp3_pasien_baru"></select>
                                                                                        </div>
                                                                                        <label class="col-sm-2 col-form-label">Provider/TPA</label>
                                                                                        <div class="col-sm-4">
                                                                                            <select class="js-example-basic-single col-sm-12 selmstcomp2_pasien_baru" id="selmstcomp2_pasien_baru" name="selmstcomp2_pasien_baru"></select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-2 col-form-label">Perusahaan</label>
                                                                                        <div class="col-sm-4">
                                                                                            <select class="js-example-basic-single col-sm-12 selmstcomp1_pasien_baru" id="selmstcomp1_pasien_baru" name="selmstcomp1_pasien_baru"></select>
                                                                                        </div>
                                                                                        <label class="col-sm-2 col-form-label">Nomor</label>
                                                                                        <div class="col-sm-4">
                                                                                            <input type="text" class="form-control" id="nomorasuransi_pasien_baru" name="nomorasuransi_pasien_baru">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-2 col-form-label">Nama</label>
                                                                                        <div class="col-sm-4">
                                                                                            <input type="text" class="form-control" id="namakartu_pasien_baru" name="namakartu_pasien_baru">
                                                                                        </div>
                                                                                        <label class="col-sm-2 col-form-label">Asal Perusahaan</label>
                                                                                        <div class="col-sm-4">
                                                                                            <input type="text" class="form-control" id="asalperusahaan_pasien_baru" name="asalperusahaan_pasien_baru">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-2 col-form-label">Hub. Keluarga</label>
                                                                                        <div class="col-sm-4">
                                                                                            <select class="js-example-basic-single col-sm-12 selmsthubkel_pasien_baru" id="idhub_pasien_baru" name="idhub_pasien_baru"></select>
                                                                                        </div>
                                                                                        <label class="col-sm-2 col-form-label">Keterangan</label>
                                                                                        <div class="col-sm-4">
                                                                                            <textarea class="form-control" id="keterangan_pasien_baru" name="keterangan_pasien_baru"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-2 col-form-label">Dikonfirmasi Oleh</label>
                                                                                        <div class="col-sm-4">
                                                                                            <select class="js-example-basic-single col-sm-12 selmsthubkel_pasien_baru" id="idhub_pasien_baru" name="idhub_pasien_baru"></select>
                                                                                        </div>
                                                                                        <label class="col-sm-2 col-form-label">Tanggal</label>
                                                                                        <div class="col-sm-4">
                                                                                            <input type="text" class="form-control" id="tglkonfirmasi_pasien_baru" name="tglkonfirmasi_pasien_baru" value=<?php echo date('Y-m-d'); ?>>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
																			
																			
																			
                                                                            </div>
																			
																			<div class="modal-footer">
                                                                                <button type="button" class="btn btn-primary waves-effect waves-light set_reg_new">Register Pasien Baru</button>
                                                                            </div>
																			</div>
																			<!--End Row 2-->
																
																
																
																
																
																
																
																
																
																
																</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end tab-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="styleSelector"></div>
                    </div>
                </div>
            </div>
        </div>
        <!--MODAL SEGMENT 3-->
        <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document" style="max-width:80%;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Checkin Pasien Paket || <small> Klik 2x pada row untuk proses checkin</small>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!--<h5>Default Modal</h5>-->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card table-card">
                                    <div class="card-header">
                                        <h5 class="descdetailpaket"></h5>
                                        <div class="card-header-right">
                                            <ul class="list-unstyled card-option">
                                                <li class="first-opt">
                                                    <i class="feather icon-chevron-left open-card-option" />
                                                </li>
                                                <li>
                                                    <i class="feather icon-maximize full-card" />
                                                </li>
                                                <li>
                                                    <i class="feather icon-minus minimize-card" />
                                                </li>
                                                <li>
                                                    <i class="feather icon-refresh-cw reload-card" />
                                                </li>
                                                <li>
                                                    <i class="feather icon-trash close-card" />
                                                </li>
                                                <li>
                                                    <i class="feather icon-chevron-left open-card-option" />
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <div class="table-responsive">
                                            <input type="text" class="form-control idtrxaktif" id="idtrxaktif" name="idtrxaktif" readonly hidden>
                                            <div class="col-sm-4 col-xl-4 m-b-30">
                                                <select class="js-example-basic-single col-sm-12 selmstdokter_pasien_checkin" id="iddokter1_pasien_check" name="iddokter1_pasien_check"></select>
                                            </div>
                                            <table class="table table-hover m-b-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Tanggal Checkin</th>
                                                        <th>ID Reg</th>
                                                        <th>Dokter</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="contcheckinpasienaktif"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!--END MODAL SEGMENT 3-->
    </body> <?php $this->theme->wrapper_close('theme_default'); ?> 
	<?php #$this->theme->script('theme_default'); ?> 
	<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-js.php');?> 
	<script src=<?php echo base_url('assets/app_hn/depofnc/fncdepo.js'); ?>>
    </script>