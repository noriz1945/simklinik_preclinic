						<style>
						.form-group.required .control-label:after {
						  content:" *";
						  color:red;
						}
						</style>
						<form id="form_aps" class="form-horizontal" action="<?php echo site_url('trx_reg/create_action_aps'); ?>" method="post" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-12">
									
									
									
									
									<div class="card">
										<div class="card-header">
											<h5>Data Pasien APS</h5>
										</div>
										<div class="card-block">
										
										
										<div class="row">  
                                                        <div class="col-md-6">    
															
															<!-- TEXT -->
															<div class="form-group row">
																<label for="id_pasien" class="col-sm-3 control-label">No. Rekam Medis</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control" name="id_pasien" id="id_pasien" placeholder="Otomatis Terisi" value="<?php echo $row->id_pasien; ?>" readonly />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group row required">
																<label for="name" class="col-sm-3 control-label">Nama Pasien</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control" name="name" id="name" placeholder="" value="<?php echo $row->name; ?>" required />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group row">
																<label for="nik" class="col-sm-3 control-label">NIK</label>
																<div class="col-sm-8">
																	<input type="number" class="form-control" name="nik" id="nik" placeholder="" value="<?php echo $row->nik; ?>" />
																</div>
															</div>
															
															<!-- DATE PICKER -->
															<div class="form-group row">
																<label for="birthdate" class="col-sm-3 control-label">Tanggal Lahir</label>
																<div class="col-sm-8">			
																	<input type="text" class="form-control" name="birthdate" id="birthdate" placeholder="Pilih Tanggal" value="<?php echo $row->birthdate; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group row">
																<label for="birthplace" class="col-sm-3 control-label">Tempat Lahir</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control" name="birthplace" id="birthplace" placeholder="" value="<?php echo $row->birthplace; ?>" />
																</div>
															</div>
															
															<!-- RADIO -->
															<div class="form-group row">
																<label class="col-sm-3 control-label">Jenis Kelamin</label>
																<div class="col-sm-8">
																	<?php echo $radio_gender ?>
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group row required">
																<label for="hp" class="col-sm-3 control-label">No. Hp (WA)</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control" name="hp" id="hp" placeholder="" value="<?php echo $row->hp; ?>" required />
																</div>
															</div>
														
														</div>	
														
														<div class="col-md-6">	
															
															<!-- TEXT -->
															<div class="form-group row">
																<label for="address" class="col-sm-3 control-label">Alamat</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control" name="address" id="address" placeholder="" value="<?php echo $row->address; ?>" />
																</div>
															</div>
															
															<!-- AUTOCOMPLETE -->
															<div class="form-group row">
																<label for="id_kelurahan" class="col-sm-3 control-label">Kelurahan</label>
																<div class="col-sm-8">
																	<input type="hidden" class="form-control" name="id_kelurahan" id="id_kelurahan" placeholder="" value="<?php echo $row->id_kelurahan; ?>" />
																	<input type="text" class="form-control" name="txt_id_kelurahan" id="txt_id_kelurahan" placeholder="" value="<?php echo $row->kelurahan; ?>" />
																</div>
															</div>
															
															<!-- AUTOCOMPLETE -->
															<div class="form-group row">
																<label for="id_kecamatan" class="col-sm-3 control-label">Kecamatan</label>
																<div class="col-sm-8">
																	<input type="hidden" class="form-control" name="id_kecamatan" id="id_kecamatan" placeholder="" value="<?php echo $row->id_kecamatan; ?>" />
																	<input type="text" class="form-control" name="txt_id_kecamatan" id="txt_id_kecamatan" placeholder="" value="<?php echo $row->kecamatan; ?>" />
																</div>
															</div>
															
															<!-- AUTOCOMPLETE -->
															<div class="form-group row">
																<label for="id_kota" class="col-sm-3 control-label">Kota</label>
																<div class="col-sm-8">
																	<input type="hidden" class="form-control" name="id_kota" id="id_kota" placeholder="" value="<?php echo $row->id_kota; ?>" />
																	<input type="text" class="form-control" name="txt_id_kota" id="txt_id_kota" placeholder="" value="<?php echo $row->kota; ?>" />
																</div>
															</div>
															
															<!-- AUTOCOMPLETE -->
															<div class="form-group row">
																<label for="id_propinsi" class="col-sm-3 control-label">Propinsi</label>
																<div class="col-sm-8">
																	<input type="hidden" class="form-control" name="id_propinsi" id="id_propinsi" placeholder="" value="<?php echo $row->id_propinsi; ?>" />
																	<input type="text" class="form-control" name="txt_id_propinsi" id="txt_id_propinsi" placeholder="" value="<?php echo $row->propinsi; ?>" />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group row">
																<label for="kodepos" class="col-sm-3 control-label">Kodepos</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control" name="kodepos" id="kodepos" placeholder="" value="<?php echo $row->kodepos; ?>" />
																</div>
															</div>
															
														</div>
														
														
										</div>
													
										
										
										
									</div>
									</div>
									
									</div>
									<div class="col-md-12">
									
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card" style="min-height : 670px;">
                                                    
                                                        <!-- Main content -->
                                                       
                                                           
																<div class="card-header">
																	<h5>Registrasi APS</h5>
																</div>
														<div class="card-block">
														
														
                                                            
															
													<div class="row">  
                                                        <div class="col-md-12">    
														
															<!-- TEXT -->
															<div class="form-group">
																<label for="no_reg" class="col-sm-6 control-label">No. Registrasi</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" id="no_reg" placeholder="Otomatis Terisi" value="" readonly />
																</div>
															</div>
															
															<!--
															<div class="form-group">
																<label for="id_dokter_prt1" class="col-sm-4 control-label">Dokter</label>
																<div class="col-sm-12">
																	<?php #echo $dropdown_id_dokter_prt1 ?>
																</div>
															</div>
															
															<div class="form-group">
																<label for="diag" class="col-sm-6 control-label">Diagnosa Awal / Keluhan</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="diag" id="diag" placeholder="Keluhan" value="" />
																</div>
															</div>
															
															<div class="form-group">
																<label for="penanggung" class="col-sm-6 control-label">Penanggung / Keluarga</label>
																<button type="button" id="copy_penanggung" class="btn btn-warning" style="padding:0 5px;">COPY</button>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="penanggung" id="penanggung" placeholder="Penanggung" value="" />
																	
																</div>
															</div>
															
															<div class="form-group">
																<label for="id_asuransi" class="col-sm-4 control-label">Nama Asuransi</label>
																<div class="col-sm-12">
																	<input type="hidden" class="form-control" name="id_asuransi" id="id_asuransi" placeholder="Id Asuransi" value="001" />
																	<input type="text" class="form-control" name="txt_id_asuransi" id="txt_id_asuransi" placeholder="Auto Complete Nama Asuransi" value="TUNAI" />
																</div>
															</div>
															
															<div class="form-group">
																<label for="card_id" class="col-sm-6 control-label">No. Kartu Asuransi</label>
																<button type="button" id="copy_card_id" class="btn btn-warning" style="padding:0 5px;">COPY</button>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="card_id" id="card_id" placeholder="Card Id" value="" />
																</div>
															</div>
															-->
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="note" class="col-sm-4 control-label">Keterangan Registrasi</label>
																<div class="col-sm-12">
																	<textarea class="form-control" name="note" id="note" rows="1" placeholder="Note" /></textarea>
																</div>
															</div>
															
															
															
															
															
                                                            
														
														</div>
                                                        
														
														
														
													<div class="col-md-12 text-right">
													<!-- BUTTON -->
                                                            <!-- Standard button -->
                                                            <div class="form-group">
                                                                <div class="col-sm-12">
                                               
                                                                    <!-- Provides extra visual weight and identifies the success action in a set of buttons -->
                                                                    <button type="submit" class="btn btn-success">Simpan</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <button type="button" class="btn btn-default" onClick="javascript: location='<?php echo site_url('trx_reg/tab_reg'); ?>';">Kembali </button>
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
<script>		
	$('#birthdate').datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		changeYear: true,
		yearRange: "-100:+0", // last hundred years
		maxDate: 0,
	});
	$('#birthdate').datepicker( "option", "dateFormat", "yy-mm-dd" );
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
$('#form_aps input[name="gender"]').attr('required', true);
//$('#form_aps input[name="id_dokter"]').attr('required', '');
//$("#txt_id_asuransi").attr('required', '');

$('input[type="text"]').on('input', function() {
	$('input[type=text]').val (function () {
	return this.value.toUpperCase();
	})
});
</script>
