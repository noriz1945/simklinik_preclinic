
<!doctype html>
<html>
    <head> 
	<?php $this->theme->head('theme_default'); ?></head> 
	<title>Fast Clinic - Bina Medika</title>
	<style>
	select.form-control {
		background-color: ghostwhite;
	}

    /* Ensure jQuery UI datepicker overlays correctly near the input */
    .ui-datepicker {
        position: absolute !important;
        z-index: 10000 !important;
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
                                            <h5>Data Pasien</h5><span>Menu</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="page-header-breadcrumb">
                                        <ul class=" breadcrumb breadcrumb-title">
                                            <li class="breadcrumb-item"><a href="
											<?php echo base_url('./'); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="
                                            <?php echo base_url('mst_pasien/'); ?>">Data Pasien</a></li>
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
																	<h5>Form Tambah / Edit - Data Pasien</h5>
																</div>
															<div class="card-block">
														
            <form class="form-horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" <?php echo (isset($button) && $button==='Update') ? 'novalidate' : ''; ?>>
													<div class="row">  
                                                        <div class="col-md-6">    
															
															<!-- RADIO -->
															<div class="form-group row">
																<label class="col-sm-3 control-label">Aktif</label>
																<div class="col-8">
																	{radio-aktif}
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group row">
																<label for="id_pasien" class="col-sm-3 control-label">No. Rekam Medis</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control" id="txt_id_pasien" placeholder="Otomatis Terisi" value="<?php echo $id_pasien; ?>" disabled />
																</div>
															</div>
															<!-- TEXT -->
															<div class="form-group row">
                                        <label for="nik" class="col-sm-3 control-label">NIK <span class="text-danger">(Wajib isi)</span></label>
																<div class="col-sm-8">
                                                <input type="number" class="form-control" name="nik" id="nik" placeholder="" value="<?php echo $nik; ?>" <?php echo (isset($button) && $button==='Create') ? 'required' : ''; ?> />
																</div>
															</div>
																													
															<!-- TEXT -->
															<div class="form-group row">
                                        <label for="name" class="col-sm-3 control-label">Nama Pasien <span class="text-danger">(Wajib isi)</span></label>
																<div class="col-sm-8">
                                                <input type="text" class="form-control" name="name" id="name" placeholder="" value="<?php echo $name; ?>" <?php echo (isset($button) && $button==='Create') ? 'required' : ''; ?> />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group row">
																<label for="birthplace" class="col-sm-3 control-label">Tempat Lahir</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control" name="birthplace" id="birthplace" placeholder="" value="<?php echo $birthplace; ?>" />
																</div>
															</div>
															
															<!-- DATE PICKER -->
															<div class="form-group row">
                                        <label for="birthdate" class="col-sm-3 control-label">Tanggal Lahir <span class="text-danger">(Wajib isi)</span></label>
																<div class="col-sm-8">			
                                                <input type="text" class="form-control" name="birthdate" id="birthdate" placeholder="Pilih Tanggal" value="<?php echo $birthdate; ?>" <?php echo (isset($button) && $button==='Create') ? 'required' : ''; ?> />
																</div>
															</div>
															
															<!-- RADIO -->
															<div class="form-group row">
                                        <label class="col-sm-3 control-label">Jenis Kelamin <span class="text-danger">(Wajib isi)</span></label>
																<div class="col-sm-8">
																	{radio-gender}
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group row">
																<label for="blood_type" class="col-sm-3 control-label">Golongan Darah</label>
																<div class="col-sm-8">
																	{radio-blood_type}
																</div>
															</div>
															
															<!-- DROPDOWN -->
															<div class="form-group row">
                                        <label for="id_agama" class="col-sm-3 control-label">Agama <span class="text-danger">(Wajib isi)</span></label>
																<div class="col-sm-8">
																	{dropdown-id_agama}
																</div>
															</div>
															
															<!-- RADIO -->
															<div class="form-group row">
																<label class="col-sm-3 control-label">Status (Pernikahan)</label>
																<div class="col-sm-8">
																	{radio-id_mar}
																</div>
															</div>
															
															<!-- DROPDOWN -->
															<div class="form-group row">
																<label for="id_job" class="col-sm-3 control-label">Pekerjaan</label>
																<div class="col-sm-8">
																	{dropdown-id_job}
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group row">
																<label for="name" class="col-sm-3 control-label">Nama Ayah</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control" name="father_name" id="father_name" placeholder="" value="<?php echo $father_name; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group row">
																<label for="name" class="col-sm-3 control-label">Nama Ibu</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control" name="mother_name" id="mother_name" placeholder="" value="<?php echo $mother_name; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group row d-none">
																<label for="id_pend" class="col-sm-3 control-label">Pendidikan Terakhir</label>
																<div class="col-sm-8">
																	{dropdown-id_pend}
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group row d-none">
																<label for="id_nation" class="col-sm-3 control-label">Suku Bangsa</label>
																<div class="col-sm-8">
																	<input type="hidden" class="form-control" name="id_nation" id="id_nation" placeholder="" value="<?php echo $id_nation; ?>" />
																	<input type="text" class="form-control" name="txt_id_nation" id="txt_id_nation" placeholder="" value="<?php echo $id_nation; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group row d-none">
																<label for="rh_type" class="col-sm-3 control-label">Rh Darah</label>
																<div class="col-sm-8">
																	{radio-rh_type}
																</div>
															</div>
															
            <!-- TEXT -->
            <div class="form-group row">
                <label for="asm_name" class="col-sm-3 control-label">Nama Asuransi</label>
                <div class="col-sm-8">
                    <?php echo $dropdown_asm_comp; ?>
                </div>
            </div>
															
            <!-- TEXT -->
            <div class="form-group row">
                <label for="asm_id" class="col-sm-3 control-label">No.(Kartu / 	Member) Asuransi</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="asm_id" id="asm_id" placeholder="" value="<?php echo $asm_id; ?>" />
                </div>
            </div>
															
															<div class="form-group row">
                                                                <div class="col-sm-11 text-right">
																	<hr>
																</div>
                                                            </div>
															
															<!-- TEXT -->
															<div class="form-group row">
                                        <label for="hp" class="col-sm-3 control-label">No. Hp (WA) <span class="text-danger">(Wajib isi)</span></label>
																<div class="col-sm-8">
                                                <input type="text" class="form-control" name="hp" id="hp" placeholder="" value="<?php echo $hp; ?>" <?php echo (isset($button) && $button==='Create') ? 'required' : ''; ?> />
																</div>
															</div>
															
															<!-- EMAIL -->
															<div class="form-group row">
																<label for="email" class="col-sm-3 control-label">Email</label>
																<div class="col-sm-8">
																	<input type="email" class="form-control" name="email" id="email" placeholder="" value="<?php echo $email; ?>" />
																</div>
															</div>
															
															<!-- TEXTAREA -->
															<div class="form-group row">
																<label for="description" class="col-sm-3 control-label">Catatan</label>
																<div class="col-sm-8">
																	<textarea class="form-control" name="description" id="description" placeholder=""><?php echo $description; ?></textarea>
																</div>
															</div>
															
														</div>	
														
														<!-- DIV KANAN ---------------------------------------------------------------------------------------------------------------------------->
														<div class="col-md-6">
															
															<!-- TEXT -->
															<div class="form-group row">
																<label for="address" class="col-sm-3 control-label">Alamat</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control" name="address" id="address" placeholder="" value="<?php echo $address; ?>" />
																</div>
															</div>
															
															<!-- AUTOCOMPLETE -->
															<div class="form-group row">
																<label for="id_kelurahan" class="col-sm-3 control-label">Kelurahan</label>
																<div class="col-sm-8">
																	<input type="hidden" class="form-control" name="id_kelurahan" id="id_kelurahan" placeholder="" value="<?php echo $id_kelurahan; ?>" />
																	<input type="text" class="form-control" name="txt_id_kelurahan" id="txt_id_kelurahan" placeholder="" value="<?php echo $kelurahan; ?>" />
																</div>
															</div>
															
															<!-- AUTOCOMPLETE -->
															<div class="form-group row">
																<label for="id_kecamatan" class="col-sm-3 control-label">Kecamatan</label>
																<div class="col-sm-8">
																	<input type="hidden" class="form-control" name="id_kecamatan" id="id_kecamatan" placeholder="" value="<?php echo $id_kecamatan; ?>" />
																	<input type="text" class="form-control" name="txt_id_kecamatan" id="txt_id_kecamatan" placeholder="" value="<?php echo $kecamatan; ?>" />
																</div>
															</div>
															
															<!-- AUTOCOMPLETE -->
															<div class="form-group row">
																<label for="id_kota" class="col-sm-3 control-label">Kota</label>
																<div class="col-sm-8">
																	<input type="hidden" class="form-control" name="id_kota" id="id_kota" placeholder="" value="<?php echo $id_kota; ?>" />
																	<input type="text" class="form-control" name="txt_id_kota" id="txt_id_kota" placeholder="" value="<?php echo $kota; ?>" />
																</div>
															</div>
															
															<!-- AUTOCOMPLETE -->
															<div class="form-group row">
																<label for="id_propinsi" class="col-sm-3 control-label">Propinsi</label>
																<div class="col-sm-8">
																	<input type="hidden" class="form-control" name="id_propinsi" id="id_propinsi" placeholder="" value="<?php echo $id_propinsi; ?>" />
																	<input type="text" class="form-control" name="txt_id_propinsi" id="txt_id_propinsi" placeholder="" value="<?php echo $propinsi; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group row">
																<label for="kodepos" class="col-sm-3 control-label">Kodepos</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control" name="kodepos" id="kodepos" placeholder="" value="<?php echo $kodepos; ?>" />
																</div>
															</div>
															
															<div class="form-group row">
                                                                <div class="col-sm-11 text-right">
																	<hr>
																</div>
                                                            </div>
															
															<!-- TEXT -->
															<div class="form-group row d-none">
																<label for="fam_name" class="col-sm-3 control-label">Nama Keluarga</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control" name="fam_name" id="fam_name" placeholder="" value="<?php echo $fam_name; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group row d-none">
																<label for="fam_addr" class="col-sm-3 control-label">Alamat Keluarga</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control" name="fam_addr" id="fam_addr" placeholder="" value="<?php echo $fam_addr; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group row d-none">
																<label for="fam_hp" class="col-sm-3 control-label">No. Hp / WA Keluarga</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control" name="fam_hp" id="fam_hp" placeholder="" value="<?php echo $fam_hp; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group row">
																<label for="sosmed_instagram" class="col-sm-3 control-label">Akun Instagram</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control" name="sosmed_instagram" id="sosmed_instagram" placeholder="Akun Instagram" value="<?php echo $sosmed_instagram; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group row">
																<label for="sosmed_tiktok" class="col-sm-3 control-label">Akun Tiktok</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control" name="sosmed_tiktok" id="sosmed_tiktok" placeholder="Akun TikTok" value="<?php echo $sosmed_tiktok; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group row">
																<label for="sosmed_facebook" class="col-sm-3 control-label">Akun Facebook</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control" name="sosmed_facebook" id="sosmed_facebook" placeholder="Akun Facebook" value="<?php echo $sosmed_facebook; ?>" />
																</div>
															</div>
															
															<div class="form-group row">
                                                                <div class="col-sm-11 text-right">
																	<hr>
																</div>
                                                            </div>
															
															<!-- TEXT -->
															<div class="form-group row">
																<label for="Perekomendasi_nama" class="col-sm-3 control-label">Rekomendasi dari (Nama)</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control" name="recom_nama" id="recom_nama" placeholder="Nama Perekomendasi" value="<?php echo $recom_nama; ?>" />
																</div>
															</div>
															
															<div class="form-group row">
																<label for="recom_wa" class="col-sm-3 control-label">Rekomendasi dari (WA)</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control" name="recom_wa" id="recom_wa" placeholder="WA Perekomendasi" value="<?php echo $recom_wa; ?>" />
																</div>
															</div>
															
															<div class="form-group row">
                                                                <div class="col-sm-11 text-right">
																&nbsp;
																</div>
                                                            </div>
																
															<!-- BUTTON -->
                                                            <!-- Standard button -->
                                                            <div class="form-group row">
                                                                <div class="col-sm-11 text-right">
                                                                    <input type="hidden" name="id_pasien" value="<?php echo $id_pasien; ?>" />
                                                                    <!-- Provides extra visual weight and identifies the success action in a set of buttons -->
                                                                    <button type="submit" class="btn btn-success">Simpan</button> &nbsp; &nbsp; &nbsp;
                                                                    <button type="button" class="btn btn-default" onClick="javascript: location='<?php echo site_url('mst_pasien'); ?>';">Kembali </button>
                                                                </div>
                                                            </div>
														</div>
														</div>
														
														<div class="col-sm-12">	
                                                            
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
					</div></div>
					<?php $this->theme->wrapper_close('theme_default'); ?>
					
<?php #$this->theme->script('theme_default'); ?> 


<script>		
    // Initialize datepicker and ensure it appends to body to avoid layout shifts
    $('#birthdate').datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        yearRange: '-100:+0', // last hundred years
        maxDate: 0,
        appendTo: 'body'
    });
    $('#birthdate').datepicker('option', 'dateFormat', 'yy-mm-dd');
</script>

<script>
	$( function() {
		$( "#txt_id_propinsi" ).autocomplete({
			source: "<?php echo base_url('mst_pasien/inner_get_data_autocomplete_id_propinsi'); ?>",
			minLength: 3,
			select: function( event, ui ) {
				$("#txt_id_propinsi").val(ui.item.label);
				$("#id_propinsi").val(ui.item.idx);
			}
		});
	});
</script>

<script>
	$( function() {
		$( "#txt_id_kota" ).autocomplete({
			source: "<?php echo base_url('mst_pasien/inner_get_data_autocomplete_id_kota'); ?>",
			minLength: 3,
			select: function( event, ui ) {
				$("#txt_id_kota").val(ui.item.label);
				$("#id_kota").val(ui.item.idx);
			}
		});
	});
</script>

<script>
	$( function() {
		$( "#txt_id_kecamatan" ).autocomplete({
			source: "<?php echo base_url('mst_pasien/inner_get_data_autocomplete_id_kecamatan'); ?>",
			minLength: 3,
			select: function( event, ui ) {
				$("#txt_id_kecamatan").val(ui.item.label);
				$("#id_kecamatan").val(ui.item.idx);
			}
		});
	});
</script>

<script>
	$( function() {
		$( "#txt_id_kelurahan" ).autocomplete({
			source: "<?php echo base_url('mst_pasien/inner_get_data_autocomplete_id_kelurahan'); ?>",
			minLength: 3,
			select: function( event, ui ) {
				$("#txt_id_kelurahan").val(ui.item.label);
				$("#id_kelurahan").val(ui.item.idx);
				
				$("#txt_id_kecamatan").val(ui.item.kecamatan);
				$("#id_kecamatan").val(ui.item.id_kecamatan);
				
				$("#txt_id_kota").val(ui.item.kota);
				$("#id_kota").val(ui.item.id_kota);
				
				$("#txt_id_propinsi").val(ui.item.propinsi);
				$("#id_propinsi").val(ui.item.id_propinsi);
				
				$("#kodepos").val(ui.item.kodepos);
			}
		});
	});
	
</script>

<script>
	$( function() {
		$( "#txt_id_nation" ).autocomplete({
			source: "<?php echo base_url('mst_pasien/inner_get_data_autocomplete_id_nation'); ?>",
			minLength: 2,
			select: function( event, ui ) {
				$("#txt_id_nation").val(ui.item.label);
				$("#id_id_nation").val(ui.item.idx);
			}
		});
	});
</script>

<script>
<?php if (isset($button) && $button==='Create'): ?>
  $("#id_agama").attr('required', '');
  $('input[name="gender"]').attr('required', true);
  // Insurance (asm_comp) is optional; do not force required so it remains focusable when visible
  // $('select[name="asm_comp"]').attr('required', '');
<?php endif; ?>

$('input[type="text"]').on('input', function() {
	$('input[type=text]').val (function () {
	return this.value.toUpperCase();
	})
});

</script>
