
<!doctype html>
<html>
    <head> 
	<?php $this->theme->head('theme_default'); ?></head> 
	<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>
	<title>Fast Clinic - Bina Medika</title>
	<style>
	.form-group {
		margin-bottom: 1.0em;
	}
	input{
		text-transform: uppercase;
	}
	select.form-control {
		background-color: ghostwhite;
	}
	</style>
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
											<?php echo base_url('trx_reg/'); ?>">Registrasi</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-body">
									
									<form class="form-horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
									<div class="row">
									<div class="col-md-6">
									
									
									
									
									<div class="card" style="min-height : 670px;">
										<div class="card-header">
											<h5>Data Pasien</h5>
										</div>
									<div class="card-block">
										
										
										<div class="row">  
                                                        <div class="col-md-6">    
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="id_pasien" class="col-sm-6 control-label">No. Rekam Medis</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="id_pasien" name="id_pasien" placeholder="Otomatis Terisi" value="<?php echo $row->id_pasien; ?>" readonly />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="name" class="col-sm-6 control-label">Nama Pasien</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $row->name; ?>" readonly />
																</div>
															</div>
															
															<!-- DATE PICKER -->
															<div class="form-group">
																<label for="birthdate" class="col-sm-6 control-label">Tanggal Lahir</label>
																<div class="col-sm-12">			
																	<input type="text" class="form-control" name="birthdate" id="birthdate" placeholder="Pilih Tanggal" value="<?php echo $row->birthdate; ?>" readonly />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="birthplace" class="col-sm-6 control-label">Tempat Lahir</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="birthplace" id="birthplace" placeholder="Birthplace" value="<?php echo $row->birthplace; ?>" readonly />
																</div>
															</div>
															
															<!-- RADIO -->
															<div class="form-group">
																<label class="col-sm-6 control-label">Jenis Kelamin</label>
																<div class="col-sm-12">
																	<?php
																		$arr_jk = array('','Laki-laki','Perempuan');
																	?>
																	<input type="text" class="form-control" name="gender" id="gender" placeholder="gender" value="<?php echo $arr_jk[$row->gender]; ?>" readonly />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="address" class="col-sm-12 control-label">Alamat (Nama Jalan & No.Rumah & RT/RW)</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="address" id="address" placeholder="Address" value="<?php echo $row->address; ?>" readonly />
																</div>
															</div>
															
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="hp" class="col-sm-6 control-label">No. Hp (WA)</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="hp" id="hp" placeholder="Hp" value="<?php echo $row->hp; ?>" readonly />
																</div>
															</div>
															
															<!-- EMAIL -->
															<div class="form-group">
																<label for="email" class="col-sm-6 control-label">Email</label>
																<div class="col-sm-12">
																	<input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $row->email; ?>" readonly />
																</div>
															</div>
														
														</div>	
														
														<div class="col-md-6">	
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="fam_name" class="col-sm-6 control-label">Nama Keluarga</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="fam_name" id="fam_name" placeholder="Fam Name" value="<?php echo $row->fam_name; ?>" readonly />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="fam_addr" class="col-sm-6 control-label">Alamat Keluarga</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="fam_addr" id="fam_addr" placeholder="Fam Addr" value="<?php echo $row->fam_addr; ?>" readonly />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="fam_telp" class="col-sm-6 control-label">No. Telp Keluarga</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="fam_telp" id="fam_telp" placeholder="Fam Telp" value="<?php echo $row->fam_telp; ?>" readonly />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="fam_hp" class="col-sm-6 control-label">No. Hp/WA Keluarga</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="fam_hp" id="fam_hp" placeholder="Fam Hp" value="<?php echo $row->fam_hp; ?>" readonly />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="asm_id" class="col-sm-6 control-label">No. Asuransi</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="asm_id" id="asm_id" placeholder="Asm Id" value="<?php echo $row->asm_id; ?>" readonly />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="asm_name" class="col-sm-6 control-label">Nama Asuransi</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="asm_name" id="asm_name" placeholder="Asm Name" value="<?php echo $row->asm_name; ?>" readonly />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="asm_comp" class="col-sm-6 control-label">Nama Perusahaan</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="asm_comp" id="asm_comp" placeholder="Asm Comp" value="<?php echo $row->asm_comp; ?>" readonly />
																</div>
															</div>
															
															<!-- TEXTAREA -->
															<div class="form-group">
																<label for="description" class="col-sm-6 control-label">Keterangan Data Pasien</label>
																<div class="col-sm-12">
																	<textarea class="form-control" name="description" id="description" rows="1" placeholder="Description" readonly><?php echo $row->description; ?></textarea>
																</div>
															</div>
															
														</div>
														
														
										</div>
													
										
										
										
									</div>
									</div>
									
									</div>
									<div class="col-md-6">
									
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card" style="min-height : 670px;">
                                                    
                                                        <!-- Main content -->
                                                       
                                                           
																<div class="card-header">
																	<h5>Input Registrasi Baru</h5>
																</div>
														<div class="card-block">
														
														
                                                            
															
													<div class="row">  
                                                        <div class="col-md-12">    
														
															<!-- TEXT -->
															<div class="form-group">
																<label for="no_reg" class="col-sm-6 control-label">No. Registrasi</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="no_reg" placeholder="Otomatis Terisi" value="<?php echo $row->id_reg; ?>" readonly />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="id_dokter_prt1" class="col-sm-4 control-label">Dokter</label>
																<div class="col-sm-12">
																	<?php echo $dropdown_id_dokter_prt1 ?>
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="diag" class="col-sm-6 control-label">Diagnosa Awal / Keluhan</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="diag" id="diag" placeholder="Keluhan" value="<?php echo $row->diag; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="penanggung" class="col-sm-6 control-label">Penanggung / Keluarga</label>
																<button type="button" id="copy_penanggung" class="btn btn-warning" style="padding:0 5px;">COPY</button>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="penanggung" id="penanggung" placeholder="Penanggung" value="<?php echo $row->penanggung; ?>" />
																	
																</div>
															</div>
														<!--
														</div>
                                                        <div class="col-md-6">
														-->
															<!-- TEXT -->
															<div class="form-group">
																<label for="id_asuransi" class="col-sm-4 control-label">Nama Asuransi</label>
																<div class="col-sm-12">
																	<input type="hidden" class="form-control" name="id_asuransi" id="id_asuransi" placeholder="Id Asuransi" value="<?php echo $row->id_asuransi; ?>" />
																	<!-- <input type="text" class="form-control" name="txt_id_asuransi" id="txt_id_asuransi" placeholder="Auto Complete Nama Asuransi" value="<?php echo $row->asuransi; ?>" <?php if($button=='Update') echo 'readonly';?> /> -->
																	<input type="text" class="form-control" name="txt_id_asuransi" id="txt_id_asuransi" placeholder="Auto Complete Nama Asuransi" value="<?php echo $row->asuransi; ?>"  />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="card_id" class="col-sm-6 control-label">No. Kartu Asuransi</label>
																<button type="button" id="copy_card_id" class="btn btn-warning" style="padding:0 5px;">COPY</button>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="card_id" id="card_id" placeholder="Card Id" value="<?php echo $row->card_id; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="note" class="col-sm-4 control-label">Keterangan Registrasi</label>
																<div class="col-sm-12">
																	<textarea class="form-control" name="note" id="note" rows="1" placeholder="Note" /><?php echo $row->note; ?></textarea>
																</div>
															</div>
															
															
															<!-- TEXT -->
															<div class="form-group d-none">
																<label for="id_paket" class="col-sm-4 control-label">Id Paket</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="id_paket" id="id_paket" placeholder="Id Paket" value="<?php echo $row->id_paket; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group d-none">
																<label for="id_trx_paket" class="col-sm-4 control-label">Id Trx Paket</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="id_trx_paket" id="id_trx_paket" placeholder="Id Trx Paket" value="<?php echo $row->id_trx_paket; ?>" />
																</div>
															</div>
														
													
															
															
															
															
															
                                                            
														
														</div>
                                                        
														
														
														
													<div class="col-md-12 text-right">
													<!-- BUTTON -->
                                                            <!-- Standard button -->
                                                            <div class="form-group">
                                                                <div class="col-sm-12">
                                                                    <input type="hidden" name="id_reg" value="<?php echo $row->id_reg; ?>" />
                                                                    <!-- Provides extra visual weight and identifies the success action in a set of buttons -->
                                                                    <button type="submit" class="btn btn-success">Simpan</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <button type="button" class="btn btn-default" onClick="javascript: location='<?php echo site_url('trx_reg'); ?>';">Kembali </button>
                                                                </div>
                                                            </div>
														</div>
												
														
														</div>
													
														
                                                        
														</div>
													
														
														<!-- /.content -->
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
									
									</div>
									</form>
                                </div>
                            </div>
                        </div> 
					</div></div>
					<?php $this->theme->wrapper_close('theme_default'); ?>
					
<?php #$this->theme->script('theme_default'); ?> 
<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-js.php');?> 
<script>
$("#copy_penanggung").click(function(){
	var nama_pasien = $("#name").val();
	$("#penanggung").val(nama_pasien);
});

$("#copy_card_id").click(function(){
	var card_id = $("#asm_id").val();
	$("#card_id").val(card_id);
});
</script>

<script>
	$( function() {
		$("#txt_id_asuransi").autocomplete({
			source: "<?php echo base_url('trx_reg/inner_get_data_autocomplete_id_asuransi'); ?>",
			minLength: 3,
			select: function( event, ui ) {
				$("#txt_id_asuransi").val(ui.item.label);
				$("#id_asuransi").val(ui.item.idx);
			}
		});
	});
</script>

<script>
$("#id_dokter").attr('required', '');
$("#txt_id_asuransi").attr('required', '');
</script>
