
<!doctype html>
<html>
    <head> 
	<?php $this->theme->head('theme_default'); ?></head> 
	<title>Fast Clinic - Bina Medika</title>
    </head> 
	<?php $this->theme->wrapper_open('theme_default','BreadCrumb'); ?>
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
                                            <li class="breadcrumb-item"><a href="
											<?php echo base_url('./'); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="
											<?php echo base_url('Mst_vendor/'); ?>">List Menu</a></li>
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
															<h5>Form Tambah / Edit - Mst_vendor</h5>
														</div>
														<div class="card-block">
														
														<form class="form-horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                                                            
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="vendor" class="col-sm-4 control-label">Vendor</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="vendor" id="vendor" placeholder="Vendor" value="<?php echo $vendor; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="alamat" class="col-sm-4 control-label">Alamat</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $alamat; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="nama_kontak" class="col-sm-4 control-label">Nama Kontak</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="nama_kontak" id="nama_kontak" placeholder="Nama Kontak" value="<?php echo $nama_kontak; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="no_telp" class="col-sm-4 control-label">No Telp</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="No Telp" value="<?php echo $no_telp; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="no_hp_wa" class="col-sm-4 control-label">No Hp Wa</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="no_hp_wa" id="no_hp_wa" placeholder="No Hp Wa" value="<?php echo $no_hp_wa; ?>" />
																</div>
															</div>
															
															<!-- BUTTON -->
                                                            <!-- Standard button -->
                                                            <div class="form-group">
                                                                <div class="col-sm-12">
                                                                    <input type="hidden" name="id_vendor" value="<?php echo $id_vendor; ?>" />
                                                                    <!-- Provides extra visual weight and identifies the success action in a set of buttons -->
                                                                    <button type="submit" class="btn btn-success">Simpan</button>
                                                                    <button type="button" class="btn btn-default" onClick="javascript: location='<?php echo site_url('mst_vendor'); ?>';">Kembali </button>
                                                                </div>
                                                            </div>
                                                        </form>
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
					</div></div>
					<?php $this->theme->wrapper_close('theme_default'); ?>
					
<?php #$this->theme->script('theme_default'); ?> 



