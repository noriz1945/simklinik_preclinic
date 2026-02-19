
<!doctype html>
<html>
    <head> <?php $this->theme->head('theme_default'); ?>
	<title>Fast Clinic - Bina Medika</title>
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
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('mst_pasien/'); ?>">List Menu</a></li>
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
                                                <div class="card z-depth-5">
                                                    <div class="container-fluid">
                                                        <!-- Main content -->
                                                        
                                                            <div class="col-md-12">
																<div class="card-header">
																	<h5>Data Pasien</h5>
																</div>
																<div class="card-block">
                                                                <form class="form-horizontal">
                                                                    
													<div class="row">  
                                                        <div class="col-md-6">  	
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Name</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $name; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Social</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_social; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Pid</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_pid; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Pid Num</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $pid_num; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Birthdate</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $birthdate; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Birthplace</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $birthplace; ?></p>
																		</div>
																	</div>
																	<!-- RADIO -->
																	<fieldset disabled>
																		<div class="form-group">
																			<label class="col-sm-4 control-label">Gender</label>
																			<div class="col-sm-8">
																				{radio-gender}
																			</div>
																		</div>
																	</fieldset>
																	
																	<!-- RADIO -->
																	<fieldset disabled>
																		<div class="form-group">
																			<label class="col-sm-4 control-label">Id Mar</label>
																			<div class="col-sm-8">
																				{radio-id_mar}
																			</div>
																		</div>
																	</fieldset>
																	
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Pend</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_pend; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Nation</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_nation; ?></p>
																		</div>
																	</div>
																	<!-- DROPDOWN -->
																	<fieldset disabled>
																		<div class="form-group">
																			<label for="mli_id" class="col-sm-4 control-label">Id Agama</label>
																			<div class="col-sm-8">
																				{dropdown-id_agama}
																			</div>
																		</div>
																	</fieldset>
																	
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Blood Type</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $blood_type; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Rh Type</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $rh_type; ?></p>
																		</div>
																	</div>
																	
															</div>	
														
															<div class="col-md-6">	
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Address</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $address; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Address Em</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $address_em; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Telp</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $telp; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Hp</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $hp; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Nama Ayah</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $father_name; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Nama Ibu</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $mother_name; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Email</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $email; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Propinsi</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_propinsi; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Kota</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_kota; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Kecamatan</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_kecamatan; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Kelurahan</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_kelurahan; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Kodepos</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $kodepos; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Id Job</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $id_job; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Job Position</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $job_position; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Departemen</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $departemen; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Nik</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $nik; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Is Bth</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $is_bth; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Description</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $description; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Paslb</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $paslb; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Fam Name</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $fam_name; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Fam Addr</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $fam_addr; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Fam Telp</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $fam_telp; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Fam Hp</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $fam_hp; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Asm Id</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $asm_id; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Asm Name</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $asm_name; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Asm Comp</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $asm_comp; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Asm Fam</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $asm_fam; ?></p>
																		</div>
																	</div>
																	<!-- STATIC CONTROL -->
																	<div class="form-group">
																		<label class="col-sm-4 control-label">Aktif</label>
																		<div class="col-sm-8">
																			<p class="form-control-static"><?php echo $aktif; ?></p>
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
															</div>
														</div>
                                                                    <!-- BUTTON -->
                                                                    <!-- Standard button -->
                                                                    <div class="form-group">
                                                                        <div class="col-sm-2 col-sm-offset-5">
                                                                            <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
                                                                            <!--<button type="button" class="btn btn-primary">Simpan</button>-->
                                                                            <button type="button" class="btn btn-default" onClick="javascript: location='<?php echo site_url('mst_pasien'); ?>';">Kembali </button>
                                                                        </div>
                                                                    </div>
                                                                </form>
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
