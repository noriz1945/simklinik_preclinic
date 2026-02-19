						<form class="form-horizontal setsimpanpasienlama_checkin" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-6">
									
									
								<input type="text" class="form-control slot_booknyah_set" id="slot_booknyah_set" name="slot_booknyah_set" readonly hidden>
								<input type="text" class="form-control jamslot_booknyah_set" id="jamslot_booknyah_set" name="jamslot_booknyah_set" readonly hidden>
								<input type="text" class="form-control tanggalslot_booknyah_set" id="tanggalslot_booknyah_set" name="tanggalslot_booknyah_set" readonly hidden>
								<input type="text" class="form-control diagnosa_set" id="diagnosa_set" name="diagnosa_set" readonly hidden>
									
									<div class="card" style="min-height : 670px;">
										<div class="card-header">
											<h5>Data Pasien Checkin</h5>
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
																	<p class="ininamadokternya"></p>
																	<input type="text" class="form-control" name="id_dokter" id="id_dokter" placeholder="Dokter" readonly />
																</div>
															</div>
															
															<!-- TEXT -->
															<div class="form-group">
																<label for="diag" class="col-sm-6 control-label">Diagnosa Awal / Keluhan</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control diagnosa_set" name="diag" id="diag" placeholder="Keluhan" value="<?php echo $row->diag; ?>" />
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
																	<input type="text" class="form-control" name="txt_id_asuransi" id="txt_id_asuransi" placeholder="Auto Complete Nama Asuransi" value="<?php echo $row->asuransi; ?>" <?php if($button=='Update') echo 'readonly';?> />
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
                                                                    <button type="button" class="btn btn-success simpanpasienlama_checkin">Simpan</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <!--<button type="button" class="btn btn-default" onClick="javascript: location='<?php echo site_url('trx_reg'); ?>';">Kembali </button>-->
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
var baseUrl = window.location.origin + '/' + window.location.pathname.split ('/') [1] + '/';

$(document).ready(function() {
	var slot 		= $('.slot_booknyah').val();
	var jam 		= $('.jamslot_booknyah').val();
	var tanggal 	= $('.tanggalslot_booknyah').val();
	var getiddokter = $('.getiddokter_booknyah').val();
	var diagnosa	= $('.diagnosa_booknyah').val();
	
	$('#slot_booknyah_set').val(slot);
	$('#jamslot_booknyah_set').val(jam);
	$('#tanggalslot_booknyah_set').val(tanggal);
	$('.diagnosa_set').val(diagnosa);
	$('#id_dokter').val(getiddokter);
	var gettextnamadokter = $('.selmst_dokter option:selected').text();
	$('.ininamadokternya').html(gettextnamadokter);
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
			source: "<?php echo base_url('trx_reg_book/trx_reg/inner_get_data_autocomplete_id_asuransi'); ?>",
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

$('input[type="text"]').on('input', function() {
	$('input[type=text]').val (function () {
	return this.value.toUpperCase();
	})
});
</script>

<!--tambahan fungsi rihan 15-12-2024-->
<script>
	$(".simpanpasienlama_checkin").click(function(e) {
		e.preventDefault(); // avoid to execute the actual submit of the form.
		var form = $('.setsimpanpasienlama_checkin');

		var slot          = $('.slot_booknyah').val();
		var hari_slot     = $('.harislot_booknyah').val();
		var jam_slot      = $('.jamslot_booknyah').val();
		var tanggal_slot  = $('.tanggalslot_booknyah').val();
		var total_slot    = $('.totalslot_booknyah').val();
		var id_pasien     = $('.getidpasien_booknyah').val();
		var id_dokter     = $('.getiddokter_booknyah').val();

		$.ajax({
			type: "POST",
			url : baseUrl+"trx_reg_book/trx_reg/create_action_checkin",
			data: form.serialize(), // serializes the form's elements.
        success: function(data)
        {
                $('.checkinlarge-Modal').modal('hide');
                //getschdule();
                $('.contslot').html('');
                $('.contcheckin').html('');
                //sendrequestautoclickdate(hari_slot,tanggal_slot,total_slot);
                
        }
		});
		
	});	

	function sendrequestautoclickdate(hari_slot,tanggal_slot,total_slot){
		var inidoktercuti  = 0;
        var initanggalnya  = tanggal_slot;
        var iniharinya     = hari_slot;
        const days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
        var today = new Date(initanggalnya);
        var tahunnya   = today.getFullYear();
        var bulannya   = today.getMonth()+1;
        var tanggalnya = today.getDate();
        var dayse = days[today.getDay()];
        //var set_dow =dia+"-"+mes+"-"+year+"-> "+dayse;
        var set_dow  = dayse;
        var set_date    = tahunnya+"-"+bulannya+"-"+tanggalnya;
        var set_tglslot = tahunnya+"-"+bulannya+"-"+iniharinya;
        //alert(set_tglslot);
        var totalslotnyah  = total_slot;


        
        pilihtglini(inidoktercuti,set_dow,set_date,set_tglslot,totalslotnyah);
	}
	


</script>
<!--end tambahan fungsi rihan 15-12-2024-->
