
<!doctype html>
<html>
    <head> 
	<?php $this->theme->head('theme_default'); ?></head> 
	<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>
	<title>Fast Clinic - Bina Medika</title>
	<style>
	.no-border {
		border: 0;
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
                                            <h5>Voucher Diskon</h5><span>Menu</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="page-header-breadcrumb">
                                        <ul class=" breadcrumb breadcrumb-title">
                                            <li class="breadcrumb-item"><a href="
											<?php echo base_url('./'); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="
											<?php echo base_url('voucher_disc/'); ?>">List Menu</a></li>
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
												<form class="form-horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                                                    <div class="container-fluid">
                                                        <!-- Main content -->
                                                        <div class="row">
														
															<div class="col-md-4">
																<div class="card z-depth-1" style="min-height:660px;">
																<div class="card-header">
																	<h5>Form Generator - Voucher Diskon</h5>
																	</div>
																	<div class="card-block">
																		
																		<!-- RADIO -->
																		<div class="form-group">
																			<label class="col-sm-4 control-label">Is Aktif</label>
																			<div class="col-sm-12">
																				<?php echo $radio_is_aktif ?>
																			</div>
																		</div>
																		<hr>
																		<!-- TEXT -->
																		<!--
																		<div class="form-group d-none">
																			<label for="prefix_kode_vcr" class="col-sm-4 control-label">Kode Voucher</label>
																			<div class="col-sm-12">
																				<input type="text" class="form-control" name="prefix_kode_vcr" id="prefix_kode_vcr" placeholder="Prefix Kode Voucher (Akan Terisi Otomatis)" value="<?php echo $prefix_kode_vcr; ?>" readonly />
																			</div>
																		</div>
																		-->
																		<!-- RADIO -->
																		<div class="form-group">
																			<label class="col-sm-4 control-label">Penjamin</label>
																			<div class="col-sm-12">
																				<?php echo $radio_penjamin ?>
																			</div>
																		</div>
																		
																		<div class="row">
																			<div class="col-sm-6">	
																				<!-- DATE PICKER -->
																				<div class="form-group">
																					<label for="start" class="col-sm-12 control-label">Mulai Berlaku</label>
																					<div class="col-sm-12">			
																						<input type="text" class="form-control" name="start" id="start" placeholder="Pilih Tanggal" value="<?php echo $start; ?>" required <?php echo $disabled ?> />
																					</div>
																				</div>
																			</div>
																			
																			<div class="col-sm-6">	
																				<!-- DATE PICKER -->
																				<div class="form-group">
																					<label for="end" class="col-sm-12 control-label">Akhir Berlaku</label>
																					<div class="col-sm-12">			
																						<input type="text" class="form-control" name="end" id="end" placeholder="Pilih Tanggal" value="<?php echo $end; ?>" required <?php echo $disabled ?> />
																					</div>
																				</div>
																			</div>
																		</div>
																		
																		<!-- NUMERIC -->
																		<div class="form-group">
																			<label for="quota" class="col-sm-12 control-label">Jumlah Voucher Yang Akan Diterbitkan<br>(1 Voucher dapat digunakan untuk 1 invoice)</label>
																			<div class="col-sm-12">
																				<input type="text" inputmode="numeric" class="form-control" name="quota" id="quota" placeholder="Quota (Isi hanya boleh angka saja)" value="<?php echo $quota; ?>" <?php echo $disabled ?> />
																			</div>
																		</div>
																		
																		<!-- BUTTON -->
																		<!-- Standard button -->
																		<div class="form-group" style="margin-top:30px;">
																		<hr>
																			<div class="col-sm-12 text-right">
																				<input type="hidden" name="id_vcr" value="<?php echo $id_vcr; ?>" />
																				<!-- Provides extra visual weight and identifies the success action in a set of buttons -->
																				<button type="submit" class="btn btn-success">Simpan</button>
																				<button type="button" class="btn btn-default" onClick="javascript: location='<?php echo site_url('voucher_disc'); ?>';">Kembali </button>
																			</div>
																		</div>
																	
																	</div>
																</div>
															</div>
															
															<div class="col-md-8">
																
																<div class="col-md-12">
																	<div id="card_tbl" class="card z-depth-5">
																		<div class="card-header">
																			<h5>List Item Jasa/Tindakan</h5>
																		</div>
																		
																		<div class="form-group" style="margin-top:10px;">
																			<label class="col-sm-12 control-label">Tindakan Yang Di-diskon</label>
																			<div class="col-sm-12">
																				<?php echo $radio_item_vcr ?>
																			</div>
																		</div>
																		<div class="card-block">
																			<table id="tbl_list_tindakan" class="table table-bordered table-striped">
																				<thead>
																					<tr>
																						<td>#</td>
																						<td>Jasa/Tindakan/Item</td>
																						<td>Diskon(%)</td>
																						<!-- <td>Diskon(Rp)</td> -->
																						<td>Aksi</td>
																					</tr>
																				</thead>
																				<tbody id="tbody_tbl_tindakan">
																					
																				</tbody>
																				<tfoot>
																					<tr>
																						<th colspan="3" align="left">
																							<button type="button" id="butt_add_tind" class="btn btn-gede btn-success waves-effect btn-grd-success d-none" data-toggle="modal" data-target="#large-Modal_tindakan"><i class="fa fa-plus"></i> Jasa/Tindakan </button>
																						</th>
																					</tr>
																				</tfoot>
																			</table>
																		</div>
																	</div>
																</div>
																
																<div class="col-md-12">
																	<div id="card_tbl_farm" class="card z-depth-5">
																		<div class="card-header">
																			<h5>List Item Farmasi</h5>
																		</div>
																		<div class="form-group" style="margin-top:10px;">
																			<label class="col-sm-12 control-label">Farmasi Yang Di-diskon</label>
																			<div class="col-sm-12">
																				<?php echo $radio_item_vcr_farm ?>
																			</div>
																		</div>
																		<div class="card-block">
																			<table id="tbl_list_farmasi" class="table table-bordered table-striped">
																				<thead>
																					<tr>
																						<td>#</td>
																						<td>Item Farmasi</td>
																						<td>Diskon(%)</td>
																						<!-- <td>Diskon(Rp)</td> -->
																						<td>Aksi</td>
																					</tr>
																				</thead>
																				<tbody id="tbody_tbl_farmasi">
																					
																				</tbody>
																				<tfoot>
																					<tr>
																						<th colspan="3" align="left">
																							<button type="button" id="butt_add_farm" class="btn btn-gede btn-success waves-effect btn-grd-success d-none" data-toggle="modal" data-target="#large-Modal_farmasi"><i class="fa fa-plus"></i> Farmasi </button>
																						</th>
																					</tr>
																				</tfoot>
																			</table>
																		</div>
																	</div>
																</div>
																
															</div>
															
														</div>
													</div>
												</form>
											</div>
										</div>
									</div> 
								</div>
							</div>
					<?php $this->theme->wrapper_close('theme_default'); ?>

<div class="modal fade" id="large-Modal_tindakan" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<form id="form_tambah_tindakan" method="post">
		<div class="modal-content">
			<!--
			<div class="modal-header">
				<h4 class="modal-title">Modal title</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			-->
			<div class="modal-body">
				<div class="card">
					<div class="card-header">
						<h5>Tambah Tindakan</h5>
					</div>
					<div class="card-block">
						<h4 class="sub-title">Masukan tindakan yang akan ditambahkan</h4>
						
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Tindakan</label>
								<div class="col-sm-9">
									<input type="hidden" class="form-control" id="id_act"  name="id_act">
									<input type="text" class="form-control" id="txt_id_act"  name="txt_id_act" placeholder="auto complete tindakan">
								</div>
							</div>
							
							<div class="form-group row" id="div_diskon_p">
								<label for="disc_p" class="col-sm-3 control-label">Diskon(%)<br>Isikan tanpa tanda %<br>Contoh : 25</label>
								<div class="col-sm-9">
									<input type="number" class="form-control" name="disc_p" id="disc_p" placeholder="" value="0" min="0" max="100" />
								</div>
							</div>
							<!--
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Harga</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="price"  name="price" value="0" readonly>
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Jumlah</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="qty" name="qty" value="1">
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Nakes</label>
								<div class="col-sm-10">
									<?php #echo $dropdown_id_dokter ?>
								</div>
							</div>
							-->
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" 		class="btn btn-default waves-effect " data-dismiss="modal">Tutup</button>
				<button type="button" id="butt_tambahkan_tindakan" class="btn btn-primary waves-effect waves-light">Tambahkan</button>
			</div>
		</div>
		</form>
	</div>
</div>

<div class="modal fade" id="large-Modal_farmasi" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<form id="form_tambah_farmasi" method="post">
		<div class="modal-content">
			<div class="modal-body">
				<div class="card">
					<div class="card-header">
						<h5>Tambah Farmasi</h5>
					</div>
					<div class="card-block">
						<h4 class="sub-title">Masukan item farmasi yang akan ditambahkan</h4>
						
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Nama Obat/Alkes</label>
								<div class="col-sm-9">
									<input type="hidden" class="form-control" id="id_fa"  name="id_fa">
									<input type="text" class="form-control" id="txt_id_fa"  name="txt_id_fa" placeholder="auto complete farmasi">
								</div>
							</div>
							
							<div class="form-group row" id="div_diskon_p_fa">
								<label for="disc_p_fa" class="col-sm-3 control-label">Diskon(%)<br>Isikan tanpa tanda %<br>Contoh : 25</label>
								<div class="col-sm-9">
									<input type="number" class="form-control" name="disc_p_fa" id="disc_p_fa" placeholder="" value="0" min="0" max="100" <?php echo $disabled ?> />
								</div>
							</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Tutup</button>
				<button type="button" id="butt_tambahkan_farmasi" class="btn btn-primary waves-effect waves-light">Tambahkan</button>
			</div>
		</div>
		</form>
	</div>
</div>

				
<?php #$this->theme->script('theme_default'); ?> 
<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-js.php');?> 


<script>		
	$('#start').datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
	changeYear: true
		});
		$('#start').datepicker( "option", "dateFormat", "yy-mm-dd" );
</script>

<script>		
	$('#end').datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
	changeYear: true
		});
		$('#end').datepicker( "option", "dateFormat", "yy-mm-dd" );
</script>

<script>
var rowno = 0;
$("#txt_id_act").autocomplete({
	source: "<?php echo base_url('pembayaran/inner_get_data_autocomplete_tindakan'); ?>",
	minLength: 3,
	select: function( event, ui ) {
		//$("#price").val(ui.item.price);
		$("#txt_id_act").val(ui.item.label);
		$("#id_act").val(ui.item.idx);
		
		//$('#qty').focus();
	}
});

$("#txt_id_fa").autocomplete({
	source: "<?php echo base_url('mst_paket/inner_get_data_autocomplete_farmasi'); ?>",
	minLength: 3,
	select: function( event, ui ) {
		//$("#price").val(ui.item.price);
		$("#txt_id_fa").val(ui.item.label);
		$("#id_fa").val(ui.item.idx);
		
		//$('#qty').focus();
	}
});

$('input:radio[name="item_vcr"]').on('change', function(){	
	var butt_add_tind 		= $('#butt_add_tind');
	var tbody_tbl_tindakan 	= $('#tbody_tbl_tindakan');	
	
	if ($(this).is(':checked') && $(this).val() == 'SATUAN')
	{
		butt_add_tind.removeClass('d-none');
		tbody_tbl_tindakan.empty();
	}
	else
	{
		butt_add_tind.addClass('d-none');
		init_row_tindakan();
	}
});

$('input:radio[name="item_vcr_farm"]').on('change', function(){	
	var butt_add_farm = $('#butt_add_farm');
	var tbody_tbl_farmasi = $('#tbody_tbl_farmasi');	
	
	if ($(this).is(':checked') && $(this).val() == 'SATUAN')
	{
		butt_add_farm.removeClass('d-none');
		tbody_tbl_farmasi.empty();
	}
	else
	{
		butt_add_farm.addClass('d-none');
		init_row_farmasi();
	}
});

$('#butt_tambahkan_tindakan').on( "click", function(e) {
	var id_act 		= $('#id_act');			var id_act_val 		= $('#id_act').val();
	var txt_id_act 	= $('#txt_id_act');		var txt_id_act_val 	= $('#txt_id_act').val();
	var disc_p 		= $('#disc_p');			var disc_p_val 		= $('#disc_p').val();
	var is_farmasi	= 0;					var txt_is_farmasi 	= 'TINDAKAN';
	var newrow 		= '';
	
	rowno++;
	newrow  = '<tr id="tr_'+rowno+'">';
	newrow += '		<td>#</td>';
	newrow += '		<td>';
	newrow += '			<input type="hidden" id="rowno['+rowno+']" name="rowno['+rowno+']" class="form-control no-border" value="'+rowno+'" readonly>';
	newrow += '			<input type="text" id="dt_is_farmasi['+rowno+']" name="dt_is_farmasi['+rowno+']" class="form-control no-border" value="'+is_farmasi+'" readonly >';
	newrow += '			<input type="text" id="dt_txt_is_farmasi['+rowno+']" name="dt_txt_is_farmasi['+rowno+']" class="form-control no-border" value="'+txt_is_farmasi+'" readonly >';
	newrow += '			<input type="text" id="dt_id_act['+rowno+']" name="dt_id_act['+rowno+']" class="form-control no-border" value="'+id_act_val+'" readonly >';
	newrow += '			<input type="text" id="dt_txt_id_act['+rowno+']" name="dt_txt_id_act['+rowno+']" class="form-control no-border" value="'+txt_id_act_val+'" readonly >';
	newrow += '			</td>';
	newrow += '		<td><input type="number" id="dt_disc_p['+rowno+']" name="dt_disc_p['+rowno+']" class="form-control text-center" value="'+disc_p_val+'" maxlength="5" size="5" min="0" max="100" ></td>';
	//newrow += '		<td><input type="number" id="dt_disc_m['+rowno+']" name="dt_disc_m['+rowno+']" class="form-control text-center" value="'+disc_m+'" ></td>';
	newrow += '		<td align="center"><button type="button" class="btn btn-danger waves-effect" onclick="javascript : delete_row(\''+rowno+'\');"><i class="fa fa-trash"></i></button></td>';
	newrow += '</tr>';
			
    tableBody = $("#tbl_list_tindakan tbody");
    tableBody.append(newrow); 
	
	id_act.val('');
	txt_id_act.val('');
	disc_p.val('0');
	
	$('#large-Modal_tindakan').modal('hide');
});

$('#butt_tambahkan_farmasi').on( "click", function(e) {
	var id_act 		= $('#id_fa');			var id_act_val 		= $('#id_fa').val();
	var txt_id_act 	= $('#txt_id_fa');		var txt_id_act_val 	= $('#txt_id_fa').val();
	var disc_p 		= $('#disc_p_fa');			var disc_p_val 		= $('#disc_p_fa').val();
	var is_farmasi	= 1;					var txt_is_farmasi 	= 'FARMASI';
	var newrow 		= '';
	
	rowno++;
	newrow  = '<tr id="tr_'+rowno+'">';
	newrow += '		<td>#</td>';
	newrow += '		<td>';
	newrow += '			<input type="hidden" id="rowno['+rowno+']" name="rowno['+rowno+']" class="form-control no-border" value="'+rowno+'" readonly>';
	newrow += '			<input type="text" id="dt_is_farmasi['+rowno+']" name="dt_is_farmasi['+rowno+']" class="form-control no-border" value="'+is_farmasi+'" readonly >';
	newrow += '			<input type="text" id="dt_txt_is_farmasi['+rowno+']" name="dt_txt_is_farmasi['+rowno+']" class="form-control no-border" value="'+txt_is_farmasi+'" readonly >';
	newrow += '			<input type="text" id="dt_id_act['+rowno+']" name="dt_id_act['+rowno+']" class="form-control no-border" value="'+id_act_val+'" readonly >';
	newrow += '			<input type="text" id="dt_txt_id_act['+rowno+']" name="dt_txt_id_act['+rowno+']" class="form-control no-border" value="'+txt_id_act_val+'" readonly >';
	newrow += '			</td>';
	newrow += '		<td><input type="number" id="dt_disc_p['+rowno+']" name="dt_disc_p['+rowno+']" class="form-control text-center" value="'+disc_p_val+'" maxlength="5" size="5" min="0" max="100" ></td>';
	//newrow += '		<td><input type="number" id="dt_disc_m['+rowno+']" name="dt_disc_m['+rowno+']" class="form-control text-center" value="'+disc_m+'" ></td>';
	newrow += '		<td align="center"><button type="button" class="btn btn-danger waves-effect" onclick="javascript : delete_row(\''+rowno+'\');"><i class="fa fa-trash"></i></button></td>';
	newrow += '</tr>';
			
    tableBody = $("#tbl_list_farmasi tbody");
    tableBody.append(newrow); 
	
	id_act.val('');
	txt_id_act.val('');
	disc_p.val('0');
	
	$('#large-Modal_farmasi').modal('hide');
});

function delete_row(idx)
{
	if(window.confirm('Hapus item ini ?')) $('#tr_'+idx).remove();
}

function init_row_tindakan()
{
	rowno++;
	var tbody_tbl_tindakan = $('#tbody_tbl_tindakan');			
		tbody_tbl_tindakan.empty();
	var is_farmasi = 0;
	var tr_td = '';
	tr_td += '	<tr id="tr_'+rowno+'">';
	tr_td += '		<td>#</td>';
	tr_td += '		<td>';
	tr_td += '			<input type="hidden" id="rowno['+rowno+']" name="rowno['+rowno+']" class="form-control no-border" value="'+rowno+'" readonly>';
	tr_td += '			<input type="hidden" id="dt_is_farmasi['+rowno+']" name="dt_is_farmasi['+rowno+']" class="form-control no-border" value="'+is_farmasi+'" readonly>';
	tr_td += '			<input type="hidden" id="dt_txt_is_farmasi['+rowno+']" name="dt_txt_is_farmasi['+rowno+']" class="form-control no-border" value="TINDAKAN" readonly>';
	tr_td += '			<input type="hidden" id="dt_id_act['+rowno+']" name="dt_id_act['+rowno+']" class="form-control no-border" value="00000" readonly>';
	tr_td += '			<input type="text" id="dt_txt_id_act['+rowno+']" name="dt_txt_id_act['+rowno+']" class="form-control no-border" value="SEMUA JASA/TINDAKAN" readonly>';
	tr_td += '			</td>';
	tr_td += '		<td>';
	tr_td += '			<input type="number" id="dt_disc_p['+rowno+']" name="dt_disc_p['+rowno+']" class="form-control text-center" value="0" maxlength="5" size="5" min="0" max="100">';
	tr_td += '			</td>';
	tr_td += '		<td align="center">';
	tr_td += '			</td>';
	tr_td += '	</tr>';
	tbody_tbl_tindakan.append(tr_td);
}

function init_row_farmasi()
{
	rowno++;
	var tbody_tbl_farmasi = $('#tbody_tbl_farmasi');
		tbody_tbl_farmasi.empty();
	var is_farmasi = 1;
	var tr_td = '';
	tr_td += '	<tr id="tr_'+rowno+'">';
	tr_td += '		<td>#</td>';
	tr_td += '		<td>';
	tr_td += '			<input type="hidden" id="rowno['+rowno+']" name="rowno['+rowno+']" class="form-control no-border" value="'+rowno+'" readonly>';
	tr_td += '			<input type="hidden" id="dt_is_farmasi['+rowno+']" name="dt_is_farmasi['+rowno+']" class="form-control no-border" value="'+is_farmasi+'" readonly>';
	tr_td += '			<input type="hidden" id="dt_txt_is_farmasi['+rowno+']" name="dt_txt_is_farmasi['+rowno+']" class="form-control no-border" value="FARMASI" readonly>';
	tr_td += '			<input type="hidden" id="dt_id_act['+rowno+']" name="dt_id_act['+rowno+']" class="form-control no-border" value="00000" readonly>';
	tr_td += '			<input type="text" id="dt_txt_id_act['+rowno+']" name="dt_txt_id_act['+rowno+']" class="form-control no-border" value="SEMUA FARMASI" readonly>';
	tr_td += '			</td>';
	tr_td += '		<td>';
	tr_td += '			<input type="number" id="dt_disc_p['+rowno+']" name="dt_disc_p['+rowno+']" class="form-control text-center" value="0" maxlength="5" size="5" min="0" max="100">';
	tr_td += '			</td>';
	tr_td += '		<td align="center">';
	tr_td += '			</td>';
	tr_td += '	</tr>';
	tbody_tbl_farmasi.append(tr_td);
}

var button = '<?php echo $button ?>';
if(button=='Update')
{
	// -------------- TINDAKAN --------------------------------------------------
	var data_tindakan = <?php echo json_encode($data_mst_vcr_disc->tindakan) ?>;
	console.log(data_tindakan);
	$.each(data_tindakan, function( k, v ) {
	  alert( "Key: " + k + ", Value: " + v['id_act_fa'] );
	
		var id_act_val 		= pad(v['id_act_fa'], 5);
		var txt_id_act_val 	= v['txt_id_act_fa'];
		var disc_p_val 		= v['disc_p'];
		var is_farmasi 		= 0;
		var txt_is_farmasi 	= 'TINDAKAN';
		var newrow 			= '';
		
		rowno++;
		newrow  = '<tr id="tr_'+rowno+'">';
		newrow += '		<td>#</td>';
		newrow += '		<td>';
		newrow += '			<input type="hidden" id="rowno['+rowno+']" name="rowno['+rowno+']" class="form-control no-border" value="'+rowno+'" readonly>';
		newrow += '			<input type="hidden" id="dt_is_farmasi['+rowno+']" name="dt_is_farmasi['+rowno+']" class="form-control no-border" value="'+is_farmasi+'" readonly >';
		newrow += '			<input type="hidden" id="dt_txt_is_farmasi['+rowno+']" name="dt_txt_is_farmasi['+rowno+']" class="form-control no-border" value="'+txt_is_farmasi+'" readonly >';
		newrow += '			<input type="hidden" id="dt_id_act['+rowno+']" name="dt_id_act['+rowno+']" class="form-control no-border" value="'+id_act_val+'" readonly >';
		newrow += '			<input type="text" id="dt_txt_id_act['+rowno+']" name="dt_txt_id_act['+rowno+']" class="form-control no-border" value="'+txt_id_act_val+'" readonly >';
		newrow += '			</td>';
		newrow += '		<td><input type="number" id="dt_disc_p['+rowno+']" name="dt_disc_p['+rowno+']" class="form-control text-center" value="'+disc_p_val+'" maxlength="5" size="5" min="0" max="100" readonly></td>';
		//newrow += '		<td><input type="number" id="dt_disc_m['+rowno+']" name="dt_disc_m['+rowno+']" class="form-control text-center" value="'+disc_m+'" ></td>';
		newrow += '		<td align="center"><!--<button type="button" class="btn btn-danger waves-effect" onclick="javascript : delete_row(\''+rowno+'\');"><i class="fa fa-trash"></i></button>--></td>';
		newrow += '</tr>';
				
		tableBody = $("#tbl_list_tindakan tbody");
		tableBody.append(newrow); 
	});
	
	// -------------- FARMASI --------------------------------------------------
	var data_farmasi = <?php echo json_encode($data_mst_vcr_disc->farmasi) ?>;
	console.log(data_farmasi);
	$.each(data_farmasi, function( k, v ) {
	  alert( "Key: " + k + ", Value: " + v['id_act_fa'] );
	
		var id_act_val 		= pad(v['id_act_fa'], 5);
		var txt_id_act_val 	= v['txt_id_act_fa'];
		var disc_p_val 		= v['disc_p'];
		var is_farmasi 		= 1;
		var txt_is_farmasi 	= 'FARMASI';
		var newrow 			= '';
		
		rowno++;
		newrow  = '<tr id="tr_'+rowno+'">';
		newrow += '		<td>#</td>';
		newrow += '		<td>';
		newrow += '			<input type="hidden" id="rowno['+rowno+']" name="rowno['+rowno+']" class="form-control no-border" value="'+rowno+'" readonly>';
		newrow += '			<input type="hidden" id="dt_is_farmasi['+rowno+']" name="dt_is_farmasi['+rowno+']" class="form-control no-border" value="'+is_farmasi+'" readonly >';
		newrow += '			<input type="hidden" id="dt_txt_is_farmasi['+rowno+']" name="dt_txt_is_farmasi['+rowno+']" class="form-control no-border" value="'+txt_is_farmasi+'" readonly >';
		newrow += '			<input type="hidden" id="dt_id_act['+rowno+']" name="dt_id_act['+rowno+']" class="form-control no-border" value="'+id_act_val+'" readonly >';
		newrow += '			<input type="text" id="dt_txt_id_act['+rowno+']" name="dt_txt_id_act['+rowno+']" class="form-control no-border" value="'+txt_id_act_val+'" readonly >';
		newrow += '			</td>';
		newrow += '		<td><input type="number" id="dt_disc_p['+rowno+']" name="dt_disc_p['+rowno+']" class="form-control text-center" value="'+disc_p_val+'" maxlength="5" size="5" min="0" max="100" readonly></td>';
		//newrow += '		<td><input type="number" id="dt_disc_m['+rowno+']" name="dt_disc_m['+rowno+']" class="form-control text-center" value="'+disc_m+'" ></td>';
		newrow += '		<td align="center"><!--<button type="button" class="btn btn-danger waves-effect" onclick="javascript : delete_row(\''+rowno+'\');"><i class="fa fa-trash"></i></button>--></td>';
		newrow += '</tr>';
				
		tableBody = $("#tbl_list_farmasi tbody");
		tableBody.append(newrow); 
	});
}
else
{
	init_row_tindakan();
	init_row_farmasi();
}

function pad (str, max) {
  str = str.toString();
  return str.length < max ? pad("0" + str, max) : str;
}
</script>

