
<!doctype html>
<html>
    <head> <?php $this->theme->head('theme_default'); ?>
	<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>
	<title>FastMedik - LYND</title>
    </head>
    </head> <?php $this->theme->wrapper_open('theme_default','BreadCrumb'); ?>
	<div class="loader-bg">
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
                                    <div class="page-header-title"><i class="feather icon-book bg-c-blue"></i>
                                        <div class="d-inline">
                                            <h5>Page Title</h5><span>Menu</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="page-header-breadcrumb">
                                        <ul class=" breadcrumb breadcrumb-title">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('./'); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('Trx_reg/'); ?>">List Menu</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="container-fluid">
                                                        <!-- Main content -->
                                                        <div class="container" style="margin-top:20px;">
                                                            <div class="col-md-6 offset-md-3 card z-depth-5">
																<div class="card-header">
																	<h5>Trx_reg</h5>
																</div>
																<div class="card-block">
                                                                <form class="form-horizontal">
                                                                    
																	
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Regdate</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $regdate; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Pasien</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_pasien; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Dokter Krm</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_dokter_krm; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Dokter Prt1</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_dokter_prt1; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Dokter Prt2</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_dokter_prt2; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Dokter Jaga</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_dokter_jaga; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Icd</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_icd; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Diag</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $diag; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Asuransi</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_asuransi; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Company</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_company; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Provider</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_provider; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Pod</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_pod; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Status</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $status; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Mrstat</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $mrstat; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Rwjn</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $rwjn; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Rwip</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $rwip; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Ugd</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $ugd; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Note</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $note; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Penanggung</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $penanggung; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Rujukan</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_rujukan; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Person Rjk</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $person_rjk; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Confirmby</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $confirmby; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Confirmdate</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $confirmdate; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Card Id</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $card_id; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Card Name</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $card_name; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Card Comp</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $card_comp; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Card Fam</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $card_fam; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Card Rjk</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $card_rjk; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Lab</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $lab; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Rad</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $rad; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Farm</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $farm; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Fisio</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $fisio; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Total Dp</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $total_dp; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Kamar</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_kamar; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Bed</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_bed; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Kelas</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_kelas; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Iostatus</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $iostatus; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Cash</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $cash; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Is Odc</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $is_odc; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Is Kpri</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $is_kpri; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Paket</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_paket; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Trx Paket</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_trx_paket; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Paket Aktif</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $paket_aktif; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Paket Selesai</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $paket_selesai; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Kelaspkt</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_kelaspkt; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Mrstatend Igd</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $mrstatend_igd; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Mrstatend Rwip</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $mrstatend_rwip; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Mrstatdcs</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $mrstatdcs; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Mod</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_mod; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Created</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $created; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Creator</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $creator; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Updated</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $updated; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Updater</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $updater; ?></p>
																		</div>
																	</div>
																	
                                                                    <!-- BUTTON -->
                                                                    <!-- Standard button -->
                                                                    <div class="form-group">
                                                                        <div class="col-sm-2 col-sm-offset-5">
                                                                            <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
                                                                            <!--<button type="button" class="btn btn-primary">Simpan</button>-->
                                                                            <button type="button" class="btn btn-default" onClick="javascript: location='<?php echo site_url('trx_reg'); ?>';">Kembali </button>
                                                                        </div>
                                                                    </div>
                                                                </form>
																</div>
															</div>
                                                        </div>
                                                        <!-- /.content -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
					<?php $this->theme->wrapper_close('theme_default'); ?>
                    
<?php #$this->theme->script('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-js.php');?>
