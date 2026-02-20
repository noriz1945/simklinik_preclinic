
<!doctype html>
<html>
    <head> 
	<?php $this->theme->head('theme_default'); ?> 
	<style>
	.table td, .table th {
		padding: 0.55rem 0.75rem;
	}
	.btn {
		padding: 5px 10px;
	}
	.input-xs{
		width : 40px;
		text-align : center;
	}
	.input-sm{
		width : 60px;
		text-align : center;
	}
	.input-md{
		width : 80px;
	}
	.input-lg{
		width : 400px;
	}
	.input-mdlg{
		width : 200px;
	}
	.input-slg{
		width : 284px;
	}
	.input-number{
		text-align : right;
		padding-right : 5px;
	}
	.input-qty{
		text-align : center;
	}
	#tbody_tbl_tindakan .form-control {
		font-size: 10px;
		padding: .375rem .35rem;
	}
	.no-border {
		border: 0;
		background-color: rgba(255, 255, 255, 0) !important;
	}
	.form-group {
		margin-bottom: 0.25em;
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
											<?php echo base_url('Mst_paket/'); ?>">List Menu</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-body">
                                        <div class="container-fluid">
											<form class="form-horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
												<div class="row">
													
													<div class="col-md-12">
														<div class="card z-depth-5">
															<div class="card-header">
																<h5>Form Tambah / Edit - Paket</h5>
															</div>
															<div class="card-block">
																<div class="row">
																	<div class="col-md-2">
																
																		<!-- RADIO -->
																		<div class="form-group">
																			<label class="col-sm-4 control-label">Aktif</label>
																			<div class="col-sm-12">
																				{radio-aktif}
																			</div>
																		</div>
																	
																	</div>
																	<div class="col-md-3">
																	
																		<!-- TEXT -->
																		<div class="form-group">
																			<label for="name" class="col-sm-4 control-label">Nama Paket</label>
																			<div class="col-sm-12">
																				<input type="text" class="form-control input-slg" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" />
																			</div>
																		</div>
																		
																		<!-- TEXT -->
																		<div class="form-group d-none">
																			<label for="id_type" class="col-sm-4 control-label">Id Type</label>
																			<div class="col-sm-12">
																				<input type="text" class="form-control" name="id_type" id="id_type" placeholder="Id Type" value="<?php echo $id_type; ?>" />
																			</div>
																		</div>
																	
																	</div>
																	<div class="col-md-3">
																	
																		<!-- RADIO -->
																		<div class="form-group">
																			<label class="col-sm-4 control-label">Penjamin</label>
																			<div class="col-sm-12">
																				{radio-penjamin}
																			</div>
																		</div>
																		
																	</div>
																	<div class="col-md-2">
																	
																		<!-- NUMERIC -->
																		<div class="form-group">
																			<label for="duration" class="col-sm-12 control-label">Jumlah Kunjungan (Dalam paket ini)</label>
																			<div class="col-sm-12">
																				<input type="number" class="form-control input-md" name="duration" id="duration" placeholder="Duration" value="<?php echo $duration; ?>" />
																			</div>
																		</div>
																	
																	</div>
																	<div class="col-md-2">
																	
																		<!-- NUMERIC -->
																		<div class="form-group">
																			<label for="price" class="col-sm-12 control-label">Tarif Total</label>
																			<div class="col-sm-12">
																				<input type="text" class="form-control input-md input-number" name="price" id="price" placeholder="Price" value="<?php echo $price; ?>" readonly />
																			</div>
																		</div>
																		
																		<!-- TEXT -->
																		<div class="form-group d-none">
																			<label for="created" class="col-sm-4 control-label">Created</label>
																			<div class="col-sm-12">
																				<input type="text" class="form-control" name="created" id="created" placeholder="Created" value="<?php echo $created; ?>" />
																			</div>
																		</div>
																		
																		<!-- TEXT -->
																		<div class="form-group d-none">
																			<label for="creator" class="col-sm-4 control-label">Creator</label>
																			<div class="col-sm-12">
																				<input type="text" class="form-control" name="creator" id="creator" placeholder="Creator" value="<?php echo $creator; ?>" />
																			</div>
																		</div>
																		
																		<!-- TEXT -->
																		<div class="form-group d-none">
																			<label for="updated" class="col-sm-4 control-label">Updated</label>
																			<div class="col-sm-12">
																				<input type="text" class="form-control" name="updated" id="updated" placeholder="Updated" value="<?php echo $updated; ?>" />
																			</div>
																		</div>
																		
																		<!-- TEXT -->
																		<div class="form-group d-none">
																			<label for="updater" class="col-sm-4 control-label">Updater</label>
																			<div class="col-sm-12">
																				<input type="text" class="form-control" name="updater" id="updater" placeholder="Updater" value="<?php echo $updater; ?>" />
																			</div>
																		</div>
																		
																	</div>
																</div>
															</div>
														</div>
													</div>
													
													<div class="col-md-12">
														<!-- <div class="col-md-12"> -->
														
															<div id="card_tbl" class="card z-depth-5">
																<div class="card-header">
																	<h5>Rincian jasa/tindakan/obat/alkes yang termasuk ke dalam paket</h5>
																</div>
																<div class="card-block">
																	<table id="tbl_list_tindakan" class="table table-bordered table-striped">
																		<thead>
																			<tr class="d-none row-simpan">
																				<td>#</td>
																				<td>Grup item :</td>
																				<td>Kunjungan<br>ke :</td>
																				<td>Item</td>
																				<td>Harga/Tarif<br>Satuan</td>
																				<td>Diskon(%)<br><br>(Paket)</td>
																				<td>Diskon(Rp)<br><br>(Paket)</td>
																				<td>Harga/Tarif<br>Satuan<br>(Paket)</td>
																				<td>Qty</td>
																				<td>Tuslah</td>
																				<td>Subtotal</td>
																				<td>Subtotal<br><br>(Paket)</td>
																				<td>Fungsi</td>
																			</tr>
																		</thead>
																		<tbody id="tbody_tbl_tindakan">
																		  
																		</tbody>
																		<tfoot>
																			<tr class="d-none row-simpan">
																				<td colspan="5" align="right">Set diskon global (%) : </td>
																				<td><input type="number" id="disc_global" name="disc_global" class="form-control input-sm disc_pkt" value="0" ></td>
																				<td colspan=4 align="right">TOTAL</td>
																				<td><input type="text" id="subtotal_tunai" name="subtotal_tunai" class="form-control input-md input-number" value="0" readonly ></td>
																				<td><input type="text" id="subtotal_paket" name="subtotal_paket" class="form-control input-md input-number" value="0" readonly ></td>
																				<td></td>
																			</tr>
																			<tr>
																				<td colspan="10">
																					<button type="button" class="btn btn-gede btn-primary waves-effect btn-grd-primary" data-toggle="modal" data-target="#large-Modal_tindakan"><i class="fa fa-plus"></i> Jasa/Tindakan </button>
																					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																					<button type="button" class="btn btn-gede btn-warning waves-effect btn-grd-warning" data-toggle="modal" data-target="#large-Modal_farmasi"><i class="fa fa-plus"></i> Farmasi </button>
																					</td>
																					<td nowrap><div id="subtotal_tunai_p" class="text-center">100 %</td>
																					<td nowrap><div id="subtotal_paket_p" class="text-center">100 %</td>
																					<td></td>
																			</tr>
																			<tr class="d-none row-simpan">
																				<td colspan="12" align="right">
																					<!-- BUTTON -->
																					<!-- Standard button -->
																					<div class="form-group">
																						<div class="col-sm-12">
																							<input type="hidden" name="id_paket" value="<?php echo $id_paket; ?>" />
																							<!-- Provides extra visual weight and identifies the success action in a set of buttons -->
																							<button type="button" class="btn btn-default" onClick="javascript: location='<?php echo site_url('mst_paket'); ?>';">Kembali </button> &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; 
																							<button type="submit" class="btn btn-success">Simpan</button>
																						</div>
																					</div>
																				</td>
																			</tr>
																		</tfoot>
																	</table>
																</div>
															</div>
														
														<!-- </div> -->
														<!--
														<div class="col-md-12">
															<div id="card_tbl" class="card z-depth-5">
																<div class="card-header">
																	<h5>Pengaturan global</h5>
																</div>
																<div class="card-block">
																	
																</div>
															</div>
														</div>
														-->
													</div>
												
												</div>
											</form>
										</div>
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
								<label class="col-sm-2 col-form-label">Tindakan</label>
								<div class="col-sm-10">
									<input type="hidden" class="form-control" id="id_act"  name="id_act">
									<input type="text" class="form-control" id="txt_id_act"  name="txt_id_act" placeholder="auto complete tindakan">
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Tarif</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="price_act"  name="price_act" value="0" readonly>
								</div>
							</div>
							<!--
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Qty</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="qty" name="qty" value="1">
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
						<h5>Tambah Item Farmasi</h5>
					</div>
					<div class="card-block">
						<h4 class="sub-title">Masukan item farmasi yang akan ditambahkan</h4>
						
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Item Farmasi</label>
								<div class="col-sm-9">
									<input type="hidden" class="form-control" id="id_fa"  name="id_fa">
									<input type="text" class="form-control" id="txt_id_fa"  name="txt_id_fa" placeholder="auto complete item farmasi">
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Tarif</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="price_fa"  name="price_fa" value="0" readonly>
								</div>
							</div>
							<!--
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Qty</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="qty" name="qty" value="1">
								</div>
							</div>
							-->
							
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Jenis Obat</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="jenis_obat" name="jenis_obat" value="" readonly >
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Dosis</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="dosis" name="dosis" value="">
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Frekwensi</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="frekwensi" name="frekwensi" value="">
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Waktu Penggunaan</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="tme" name="tme" value="">
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

<script>
var rowno = 0;

// ----------- TAMBAH TINDAKAN DARI AUTOCOMPLETE ---------------------------------------
$("#txt_id_act").autocomplete({
	source: "<?php echo base_url('mst_paket/inner_get_data_autocomplete_tindakan'); ?>",
	minLength: 3,
	select: function( event, ui ) {
		$("#price_act").val(ui.item.price);
		$("#txt_id_act").val(ui.item.label);
		$("#id_act").val(ui.item.idx);
		
		//$('#qty').focus();
	}
});

$('#butt_tambahkan_tindakan').on( "click", function(e) {
	rowno++;
	
	var id_act 		= $('#id_act');				var id_act_val 		= $('#id_act').val();
	var txt_id_act 	= $('#txt_id_act');			var txt_id_act_val 	= $('#txt_id_act').val();
	var price_act 	= $('#price_act');			var price_act_val 	= Math.round($('#price_act').val());
	var tuslah_val		= 0;
	var tr_td = "";
	var dnone = "d-none";
	var input_type = "text";
	
	tr_td += '	<tr id="det_tr_'+rowno+'">';
	tr_td += '		<td><input type="text" id="rowno['+rowno+']" name="rowno[]" class="form-control input-xs no-border" value="'+rowno+'" readonly >';
	tr_td += '			<input type="hidden" id="det_id_group['+rowno+']" name="det_id_group[]" class="form-control input-xs no-border" value="1" readonly ></td>';
	tr_td += '		<td>Tindakan</td>';
	tr_td += '		<td><input type="number" id="det_no_kunj['+rowno+']" name="det_no_kunj[]" class="form-control input-sm" value="0" min="0" max="10" ></td>';
	tr_td += '		<td>';
	tr_td += '			<input type="hidden" id="det_id_act['+rowno+']" name="det_id_act[]" class="form-control input-sm" value="'+id_act_val+'" readonly >';
	tr_td += '			';
	tr_td += '			<input type="text" id="det_id_act_txt['+rowno+']" name="det_id_act_txt[]" class="form-control input-lg" value="'+txt_id_act_val+'" readonly >';
	
	tr_td += '<div class="form-group row '+dnone+'" style="margin-top:5px;">';
	tr_td += '	<label class="col-sm-3">Jenis</label>';
	tr_td += '	<div class="col-sm-9">';
	tr_td += '		<input type="'+input_type+'" id="det_jenis_obat['+rowno+']" name="det_jenis_obat[]" class="form-control input-slg" value="" readonly >';
	tr_td += '	</div>';
	tr_td += '</div>';

	tr_td += '<div class="form-group row '+dnone+'">';
	tr_td += '	<label class="col-sm-3">Dosis</label>';
	tr_td += '	<div class="col-sm-9">';
	tr_td += '		<input type="'+input_type+'" id="det_dosis['+rowno+']" name="det_dosis[]" class="form-control input-slg" value="" >';
	tr_td += '	</div>';
	tr_td += '</div>';

	tr_td += '<div class="form-group row '+dnone+'">';
	tr_td += '	<label class="col-sm-3">Frekwensi</label>';
	tr_td += '	<div class="col-sm-9">';
	tr_td += '		<input type="'+input_type+'" id="det_frekwensi['+rowno+']" name="det_frekwensi[]" class="form-control input-slg" value="" >';
	tr_td += '	</div>';
	tr_td += '</div>';

	tr_td += '<div class="form-group row '+dnone+'">';
	tr_td += '	<label class="col-sm-3">Waktu Penggunaan</label>';
	tr_td += '	<div class="col-sm-9">';
	tr_td += '		<input type="'+input_type+'" id="det_tme['+rowno+']" name="det_tme[]" class="form-control input-slg" value="" >';
	tr_td += '	</div>';
	tr_td += '</div>';
	
	tr_td += '			</td>';
	tr_td += '		<td><input type="text" id="det_price_ori['+rowno+']" name="det_price_ori[]" class="form-control input-md input-number" value="'+price_act_val+'" readonly ></td>';
	tr_td += '		<td nowrap><input type="text" id="det_disc_pkt['+rowno+']" name="det_disc_pkt[]" class="form-control input-sm disc_pkt" value="0" min="0" max="100" data-id="'+rowno+'" ></td>';
	tr_td += '		<td nowrap><input type="text" id="det_disc_pkt_m['+rowno+']" name="det_disc_pkt_m[]" class="form-control input-md input-number disc_pkt_m" value="0" data-id="'+rowno+'" ></td>';
	tr_td += '		<td><input type="text" id="det_price_pkt['+rowno+']" name="det_price_pkt[]" class="form-control input-md input-number price_pkt" value="'+price_act_val+'" data-id="'+rowno+'" ></td>';
	tr_td += '		<td><input type="number" id="det_qty['+rowno+']" name="det_qty[]" class="form-control input-sm input-qty qty" value="1" data-id="'+rowno+'" ></td>';
	tr_td += '		<td><input type="text" id="det_tuslah['+rowno+']" name="det_tuslah[]" class="form-control input-sm input-number" value="'+tuslah_val+'" readonly ></td>';
	tr_td += '		<td><input type="text" id="det_price_subtotal_ori['+rowno+']" name="det_price_subtotal_ori[]" class="form-control input-md input-number" value="'+price_act_val+'" readonly ></td>';	
	tr_td += '		<td><input type="text" id="det_price_subtotal_pkt['+rowno+']" name="det_price_subtotal_pkt[]" class="form-control input-md input-number" value="'+price_act_val+'" readonly ></td>';
	tr_td += '		<td align="center"><button type="button" class="btn btn-danger waves-effect" onclick="javascript : delete_det_tr(\''+rowno+'\');"><i class="fa fa-trash"></i></button></td>';
	tr_td += '	</tr>'; 
			
			
	$("#tbody_tbl_tindakan").append(tr_td);	

	$('#large-Modal_tindakan').modal('hide');

	$("#price_act").val('0');
	$("#txt_id_act").val('');
	$("#id_act").val('');
	
	$(".row-simpan").removeClass("d-none");
	hitung_ulang();
});

// ----------- TAMBAH FARMASI DARI AUTOCOMPLETE ---------------------------------------

$("#txt_id_fa").autocomplete({
	source: "<?php echo base_url('mst_paket/inner_get_data_autocomplete_farmasi'); ?>",
	minLength: 3,
	select: function( event, ui ) {
		$("#price_fa").val(ui.item.price);
		$("#txt_id_fa").val(ui.item.label);
		$("#id_fa").val(ui.item.idx);
		$("#jenis_obat").val(ui.item.jenis_obat);		
		//$('#qty').focus();
	}
});

/*
$("#txt_id_fa").autocomplete({
    source: "<?php echo base_url('soap_eresep/inner_get_data_autocomplet_obat'); ?>",
    minLength: 3,
    select: function(event, ui) {
		console.log();
	  $("#price_fa").val(ui.item.price);
	  $("#txt_id_fa").val(ui.item.label);
      $("#jenis_obat").val(ui.item.jenis_obat);
      $("#id_fa").val(ui.item.id_fa);
    }
});
*/
$('#butt_tambahkan_farmasi').on( "click", function(e) {
	rowno++;
	
	var id_act 		= $('#id_fa');				var id_act_val 		= $('#id_fa').val();
	var txt_id_act 	= $('#txt_id_fa');			var txt_id_act_val 	= $('#txt_id_fa').val();
	var price_act 	= $('#price_fa');			var price_act_val 	= Math.round($('#price_fa').val());
	
	var jenis_obat 	= $('#jenis_obat');			var jenis_obat_val 	= $('#jenis_obat').val();
	var dosis 		= $('#dosis');				var dosis_val 		= $('#dosis').val();
	var frekwensi 	= $('#frekwensi');			var frekwensi_val 	= $('#frekwensi').val();
	var tme 		= $('#tme');				var tme_val 		= $('#tme').val();
	
	var tuslah_val		= '<?php echo round($tuslah) ?>';
	var tr_td = "";
	var dnone = "";
	var input_type = "text";
	
	tr_td += '	<tr id="det_tr_'+rowno+'">';
	tr_td += '		<td><input type="text" id="rowno['+rowno+']" name="rowno[]" class="form-control input-xs no-border" value="'+rowno+'" readonly >';
	tr_td += '			<input type="hidden" id="det_id_group['+rowno+']" name="det_id_group[]" class="form-control input-xs no-border" value="2" readonly ></td>';
	tr_td += '		<td>Farmasi</td>';
	tr_td += '		<td><input type="number" id="det_no_kunj['+rowno+']" name="det_no_kunj[]" class="form-control input-sm" value="0" min="0" max="10" ></td>';
	tr_td += '		<td>';
	tr_td += '			<input type="hidden" id="det_id_act['+rowno+']" name="det_id_act[]" class="form-control input-sm" value="'+id_act_val+'" readonly >';
	tr_td += '			';
	tr_td += '			<input type="text" id="det_id_act_txt['+rowno+']" name="det_id_act_txt[]" class="form-control input-lg" value="'+txt_id_act_val+'" readonly >';

	tr_td += '<div class="form-group row '+dnone+'" style="margin-top:5px;">';
	tr_td += '	<label class="col-sm-3">Jenis</label>';
	tr_td += '	<div class="col-sm-9">';
	tr_td += '		<input type="'+input_type+'" id="det_jenis_obat['+rowno+']" name="det_jenis_obat[]" class="form-control input-slg" value="'+jenis_obat_val+'" readonly >';
	tr_td += '	</div>';
	tr_td += '</div>';

	tr_td += '<div class="form-group row '+dnone+'">';
	tr_td += '	<label class="col-sm-3">Dosis</label>';
	tr_td += '	<div class="col-sm-9">';
	tr_td += '		<input type="'+input_type+'" id="det_dosis['+rowno+']" name="det_dosis[]" class="form-control input-slg" value="'+dosis_val+'" >';
	tr_td += '	</div>';
	tr_td += '</div>';

	tr_td += '<div class="form-group row '+dnone+'">';
	tr_td += '	<label class="col-sm-3">Frekwensi</label>';
	tr_td += '	<div class="col-sm-9">';
	tr_td += '		<input type="'+input_type+'" id="det_frekwensi['+rowno+']" name="det_frekwensi[]" class="form-control input-slg" value="'+frekwensi_val+'" >';
	tr_td += '	</div>';
	tr_td += '</div>';

	tr_td += '<div class="form-group row '+dnone+'">';
	tr_td += '	<label class="col-sm-3">Waktu Penggunaan</label>';
	tr_td += '	<div class="col-sm-9">';
	tr_td += '		<input type="'+input_type+'" id="det_tme['+rowno+']" name="det_tme[]" class="form-control input-slg" value="'+tme_val+'" >';
	tr_td += '	</div>';
	tr_td += '</div>';
	
	tr_td += '			</td>';
	tr_td += '		<td><input type="text" id="det_price_ori['+rowno+']" name="det_price_ori[]" class="form-control input-md input-number" value="'+price_act_val+'" readonly ></td>';
	tr_td += '		<td nowrap><input type="text" id="det_disc_pkt['+rowno+']" name="det_disc_pkt[]" class="form-control input-sm disc_pkt" value="0" min="0" max="100" data-id="'+rowno+'" ></td>';
	tr_td += '		<td nowrap><input type="text" id="det_disc_pkt_m['+rowno+']" name="det_disc_pkt_m[]" class="form-control input-md input-number disc_pkt_m" value="0" data-id="'+rowno+'" ></td>';
	tr_td += '		<td><input type="text" id="det_price_pkt['+rowno+']" name="det_price_pkt[]" class="form-control input-md input-number price_pkt" value="'+price_act_val+'" data-id="'+rowno+'" ></td>';
	tr_td += '		<td><input type="number" id="det_qty['+rowno+']" name="det_qty[]" class="form-control input-sm input-qty qty" value="1" data-id="'+rowno+'" ></td>';
	tr_td += '		<td><input type="text" id="det_tuslah['+rowno+']" name="det_tuslah[]" class="form-control input-sm input-number" value="'+tuslah_val+'" readonly ></td>';
	tr_td += '		<td><input type="text" id="det_price_subtotal_ori['+rowno+']" name="det_price_subtotal_ori[]" class="form-control input-md input-number" value="'+price_act_val+'" readonly ></td>';
	tr_td += '		<td><input type="text" id="det_price_subtotal_pkt['+rowno+']" name="det_price_subtotal_pkt[]" class="form-control input-md input-number" value="'+price_act_val+'" readonly ></td>';
	tr_td += '		<td align="center"><button type="button" class="btn btn-danger waves-effect" onclick="javascript : delete_det_tr(\''+rowno+'\');"><i class="fa fa-trash"></i></button></td>';
	tr_td += '	</tr>'; 
			
	$("#tbody_tbl_tindakan").append(tr_td);	

	$('#large-Modal_farmasi').modal('hide');

	$("#price_fa").val('0');
	$("#txt_id_fa").val('');
	$("#id_fa").val('');
	$('#jenis_obat').val('');
	$('#dosis').val('');
	$('#frekwensi').val('');
	$('#tme').val('');
	
	$(".row-simpan").removeClass("d-none");
	hitung_ulang();
});

function load_data_from_db(rs) {
	rs = JSON.parse(JSON.stringify(rs).replace(/\:null/gi, "\:\"\""));
	console.log(rs);
	$.each(rs, function(k, v) {
		//alert(v.id_trx_det);
		rowno++;
		
		var id_group_val 	= v.id_group;
		var no_kunj_val 	= v.no_kunj;
		var id_act_val 		= v.id_trx_det;
		var txt_id_act_val 	= v.id_trx_det_txt;
		var price_src_val 	= Math.round(v.price_src);			var price_pkt_val 	= Math.round(v.price);
		var disc_pkt_val 	= v.disc_p;
		var disc_pkt_m_val 	= Math.round(v.disc_m);
		var total_src_val 	= Math.round(v.total_src);			var total_pkt_val 	= Math.round(v.total);
		var qty_val 		= v.qty;
		var tuslah_val 		= Math.round(v.tuslah);
		var jenis_obat_val 	= v.jenis_obat;
		var dosis_val 		= v.dosis;
		var frekwensi_val 	= v.frekwensi;
		var tme_val 		= v.tme;

		var id_group_txt_val = '';
		var input_type = 'text';
		var dnone = '';
		if(id_group_val==1)
		{
			id_group_txt_val = 'Tindakan';
			input_type = 'text';
			dnone = 'd-none';
		}
		if(id_group_val==2)
		{
			id_group_txt_val = 'Farmasi';
			input_type = 'text';
			dnone = '';
		}
		
		var tr_td = "";
		tr_td += '	<tr id="det_tr_'+rowno+'">';
		tr_td += '		<td><input type="text" id="rowno['+rowno+']" name="rowno[]" class="form-control input-xs no-border" value="'+rowno+'" readonly >';
		tr_td += '			<input type="hidden" id="det_id_group['+rowno+']" name="det_id_group[]" class="form-control input-xs no-border" value="'+id_group_val+'" readonly ></td>';
		tr_td += '		<td>'+id_group_txt_val+'</td>';
		tr_td += '		<td><input type="number" id="det_no_kunj['+rowno+']" name="det_no_kunj[]" class="form-control input-sm" value="'+no_kunj_val+'" min="0" max="10" ></td>';
		tr_td += '		<td>';
		tr_td += '			<input type="hidden" id="det_id_act['+rowno+']" name="det_id_act[]" class="form-control input-sm" value="'+id_act_val+'" readonly >';
		tr_td += '			<input type="text" id="det_id_act_txt['+rowno+']" name="det_id_act_txt[]" class="form-control input-lg" value="'+txt_id_act_val+'" readonly >';
		
		tr_td += '<div class="form-group row '+dnone+'" style="margin-top:5px;">';
		tr_td += '	<label class="col-sm-3">Jenis</label>';
		tr_td += '	<div class="col-sm-9">';
		tr_td += '		<input type="'+input_type+'" id="det_jenis_obat['+rowno+']" name="det_jenis_obat[]" class="form-control input-slg" value="'+jenis_obat_val+'" readonly >';
		tr_td += '	</div>';
		tr_td += '</div>';

		tr_td += '<div class="form-group row '+dnone+'">';
		tr_td += '	<label class="col-sm-3">Dosis</label>';
		tr_td += '	<div class="col-sm-9">';
		tr_td += '		<input type="'+input_type+'" id="det_dosis['+rowno+']" name="det_dosis[]" class="form-control input-slg" value="'+dosis_val+'" >';
		tr_td += '	</div>';
		tr_td += '</div>';

		tr_td += '<div class="form-group row '+dnone+'">';
		tr_td += '	<label class="col-sm-3">Frekwensi</label>';
		tr_td += '	<div class="col-sm-9">';
		tr_td += '		<input type="'+input_type+'" id="det_frekwensi['+rowno+']" name="det_frekwensi[]" class="form-control input-slg" value="'+frekwensi_val+'" >';
		tr_td += '	</div>';
		tr_td += '</div>';

		tr_td += '<div class="form-group row '+dnone+'">';
		tr_td += '	<label class="col-sm-3">Waktu Penggunaan</label>';
		tr_td += '	<div class="col-sm-9">';
		tr_td += '		<input type="'+input_type+'" id="det_tme['+rowno+']" name="det_tme[]" class="form-control input-slg" value="'+tme_val+'" >';
		tr_td += '	</div>';
		tr_td += '</div>';
		
		tr_td += '			</td>';
		tr_td += '		<td><input type="text" id="det_price_ori['+rowno+']" name="det_price_ori[]" class="form-control input-md input-number" value="'+price_src_val+'" readonly ></td>';
		tr_td += '		<td nowrap><input type="text" id="det_disc_pkt['+rowno+']" name="det_disc_pkt[]" class="form-control input-sm disc_pkt" value="'+disc_pkt_val+'" min="0" max="100" data-id="'+rowno+'" ></td>';
		tr_td += '		<td nowrap><input type="text" id="det_disc_pkt_m['+rowno+']" name="det_disc_pkt_m[]" class="form-control input-md input-number disc_pkt_m" value="'+disc_pkt_m_val+'" data-id="'+rowno+'" ></td>';
		tr_td += '		<td><input type="text" id="det_price_pkt['+rowno+']" name="det_price_pkt[]" class="form-control input-md input-number price_pkt" value="'+price_pkt_val+'" data-id="'+rowno+'" ></td>';
		tr_td += '		<td><input type="number" id="det_qty['+rowno+']" name="det_qty[]" class="form-control input-sm input-qty qty" value="'+qty_val+'" data-id="'+rowno+'" ></td>';
		tr_td += '		<td><input type="text" id="det_tuslah['+rowno+']" name="det_tuslah[]" class="form-control input-sm input-number" value="'+tuslah_val+'" readonly ></td>';
		tr_td += '		<td><input type="text" id="det_price_subtotal_ori['+rowno+']" name="det_price_subtotal_ori[]" class="form-control input-md input-number" value="'+total_src_val+'" readonly ></td>';
		tr_td += '		<td><input type="text" id="det_price_subtotal_pkt['+rowno+']" name="det_price_subtotal_pkt[]" class="form-control input-md input-number" value="'+total_pkt_val+'" readonly ></td>';
		tr_td += '		<td align="center"><button type="button" class="btn btn-danger waves-effect" onclick="javascript : delete_det_tr(\''+rowno+'\');"><i class="fa fa-trash"></i></button></td>';
		tr_td += '	</tr>'; 
			
		$("#tbody_tbl_tindakan").append(tr_td);	
	});
	/*
	$('#large-Modal_tindakan').modal('hide');
	$("#price_act").val('0');
	$("#txt_id_act").val('');
	$("#id_act").val('');
	*/
	$(".row-simpan").removeClass("d-none");
	hitung_ulang();
}
var rs = <?php echo $rs ?>;
if(rs != '') load_data_from_db(rs);

function hitung_ulang()
{
	var inputs = $('#tbl_list_tindakan input[id^="rowno["]');
	//console.log(inputs);
	var subtotal_tunai = 0;
	var subtotal_paket = 0;
	//for (i=1; i<=inputs.length; i++) 
	$.each( inputs, function( key, v )
	{
		var i = v.value;
		var det_price_ori 	= $("#det_price_ori\\["+i+"\\]").val();
		var det_price_pkt 	= $("#det_price_pkt\\["+i+"\\]").val();
		var det_qty 		= $("#det_qty\\["+i+"\\]").val();
		var det_tuslah 		= $("#det_tuslah\\["+i+"\\]").val();
		
		var det_price_subtotal_ori 	= (parseInt(det_price_ori) * parseInt(det_qty)) + parseInt(det_tuslah);
		var det_price_subtotal_pkt 	= parseInt(det_price_pkt) * parseInt(det_qty) + parseInt(det_tuslah);
		
		$("#det_price_subtotal_ori\\["+i+"\\]").val(det_price_subtotal_ori);
		$("#det_price_subtotal_pkt\\["+i+"\\]").val(det_price_subtotal_pkt);
		
		subtotal_tunai += det_price_subtotal_ori;
		subtotal_paket += det_price_subtotal_pkt;
	});
	
	var subtotal_paket_p = (subtotal_paket * 100) / subtotal_tunai;
		subtotal_paket_p = (Math.round((subtotal_paket_p) * 100) / 100).toFixed(2);
	
	$("#subtotal_tunai").val(subtotal_tunai);
	$("#subtotal_paket").val(subtotal_paket);
	$("#subtotal_paket_p").html(subtotal_paket_p + ' %');
	$("#price").val(subtotal_paket);
}

$(document).on("change",".disc_pkt",function(){
	var idx = $(this).data("id");
	
	var persentase = $(this).val();
	persentase = parseFloat(persentase).toFixed(2);
	
	if(persentase > (100.00))
		$("#det_disc_pkt\\["+idx+"\\]").val(100);
	if(persentase < (0))
		$("#det_disc_pkt\\["+idx+"\\]").val(0);
	if(persentase== 'NaN')
		$("#det_disc_pkt\\["+idx+"\\]").val(0);
	if(persentase== 'undefined')
		$("#det_disc_pkt\\["+idx+"\\]").val(0);
	
	//alert(idx);
	var persentase 		= $("#det_disc_pkt\\["+idx+"\\]").val();
	var det_price_ori 	= $("#det_price_ori\\["+idx+"\\]").val();
	var diskon 			= (parseInt(det_price_ori) * parseFloat(persentase))/100;
	var det_price_pkt 	= parseInt(det_price_ori) - parseInt(diskon);
	
	var det_disc_pkt_m = parseInt(diskon);
	$("#det_disc_pkt_m\\["+idx+"\\]").val(det_disc_pkt_m);
	
	$("#det_price_pkt\\["+idx+"\\]").val(det_price_pkt);
	
	hitung_ulang();
});

$(document).on("change",".disc_pkt_m",function(){
	var idx = $(this).data("id");
	
	var price_disc 		= $("#det_disc_pkt_m\\["+idx+"\\]").val();
	var det_price_ori 	= $("#det_price_ori\\["+idx+"\\]").val();
	det_price_ori = parseInt(det_price_ori);
	
	if(price_disc > (det_price_ori))
		$("#det_disc_pkt_m\\["+idx+"\\]").val(det_price_ori);
	if(price_disc < (0))
		$("#det_disc_pkt_m\\["+idx+"\\]").val(0);
	if(price_disc== 'NaN')
		$("#det_disc_pkt_m\\["+idx+"\\]").val(0);
	if(price_disc== 'undefined')
		$("#det_disc_pkt_m\\["+idx+"\\]").val(0);
	
	//alert(idx);
	var price_disc 		= $("#det_disc_pkt_m\\["+idx+"\\]").val();
	var det_price_ori 	= $("#det_price_ori\\["+idx+"\\]").val();
	
	var diskon_persen 	= (Math.round(((parseInt(price_disc)*100) / parseInt(det_price_ori)) * 100) / 100).toFixed(1);;
	//var diskon_persen 	= Math.round(((parseInt(price_disc)*100) / parseInt(det_price_ori)));
	$("#det_disc_pkt\\["+idx+"\\]").val(diskon_persen);
	
	var det_price_pkt = parseInt(det_price_ori) - parseInt(price_disc);
	$("#det_price_pkt\\["+idx+"\\]").val(det_price_pkt);
	
	hitung_ulang();
});

$(document).on("change",".price_pkt",function(){
	var idx = $(this).data("id");
	
	var price_ori = parseInt($("#det_price_ori\\["+idx+"\\]").val());
	var price_pkt = parseInt($("#det_price_pkt\\["+idx+"\\]").val());
	//alert(price_pkt + "<<>>" + price_ori);
	if(price_pkt > price_ori)
		$("#det_price_pkt\\["+idx+"\\]").val(price_ori);
	if(price_pkt < (0))
		$("#det_price_pkt\\["+idx+"\\]").val(0);
	if(price_pkt== 'NaN')
		$("#det_price_pkt\\["+idx+"\\]").val(0);
	if(price_pkt== 'undefined')
		$("#det_price_pkt\\["+idx+"\\]").val(0);
	
	//alert(idx);
	var det_price_pkt 	= parseInt($("#det_price_pkt\\["+idx+"\\]").val());
	var det_price_ori 	= parseInt($("#det_price_ori\\["+idx+"\\]").val());
	
	var diskon 			= 100 - (parseInt(det_price_pkt) / parseInt(det_price_ori))*100;
	//var diskon 			= Math.round(diskon);
	var diskon 			= Math.round(diskon * 100) / 100
	var det_disc_pkt 	= $("#det_disc_pkt\\["+idx+"\\]").val(diskon);
	
	$("#det_disc_pkt\\["+idx+"\\]").trigger("change");
	
	hitung_ulang();
});

$(document).on("change",".qty",function(){
	var idx = $(this).data("id");
	
	var qty = $("#det_qty\\["+idx+"\\]").val();
	
	if(qty < (1))
		$("#det_qty\\["+idx+"\\]").val(1);
	if(qty== 'NaN')
		$("#det_qty\\["+idx+"\\]").val(1);
	if(qty== 'undefined')
		$("#det_qty\\["+idx+"\\]").val(1);
	
	hitung_ulang();
});

$('#disc_global').on('change',function(){
	var persentase = $(this).val();
	persentase = parseFloat(persentase).toFixed(2);
	
	if(persentase > (100.00))
		$("#disc_global").val(100);
	if(persentase < (0))
		$("#disc_global").val(0);
	if(persentase== 'NaN')
		$("#disc_global").val(0);
	if(persentase== 'undefined')
		$("#disc_global").val(0);
	
	var persentase 		= $("#disc_global").val();
	
	var inputs = $('#tbl_list_tindakan input[id^="rowno["]');
	//for (i=1; i<=inputs.length; i++) 
	$.each( inputs, function( key, v )
	{
		var i = parseInt(v.value);
		//alert(i);
		$("#det_disc_pkt\\["+i+"\\]").val(persentase);
		
		//var persentase 		= $("#det_disc_pkt\\["+i+"\\]").val();
		
		var det_price_ori 	= $("#det_price_ori\\["+i+"\\]").val();
		var diskon 			= (parseInt(det_price_ori) * parseInt(persentase))/100;
		var det_price_pkt 	= parseInt(det_price_ori) - parseInt(diskon);
		
		var det_disc_pkt_m = parseInt(diskon);
		$("#det_disc_pkt_m\\["+i+"\\]").val(det_disc_pkt_m);
	
		$("#det_price_pkt\\["+i+"\\]").val(det_price_pkt);
	});

	hitung_ulang();
});

function delete_det_tr(idx)
{
	if(window.confirm('Hapus item ini ?')) $('#det_tr_'+idx).remove();
	hitung_ulang();
}

$(function() {
	$("#dosis").keydown(function(e) {
		//console.log(e.which);
    if (e.which == 190) {
			alert('Mohon maaf, simbol .(titik) pada keyboard tidak bisa digunakan untuk input resep, mungkin anda bisa mencoba tanda ,(koma)');
			return false;
    }
  });
  $("#dosis").autocomplete({
    source: "<?php echo base_url('soap_eresep/inner_get_data_autocomplet_obat_dosis'); ?>",
    minLength: 1,
    select: function(event, ui) {}
  });
});

$(function() {
	$("#qty").keydown(function(e) {
		//console.log(e.which);
    if (e.which == 190) {
			alert('Mohon maaf, simbol .(titik) pada keyboard tidak bisa digunakan untuk input resep, mungkin anda bisa mencoba tanda ,(koma)');
			return false;
    }
  });
});

$(function() {
	$("#frekwensi").keydown(function(e) {
		//console.log(e.which);
    if (e.which == 190) {
			alert('Mohon maaf, simbol .(titik) pada keyboard tidak bisa digunakan untuk input resep, mungkin anda bisa mencoba tanda ,(koma)');
			return false;
    }
  });
  $("#frekwensi").autocomplete({
    source: "<?php echo base_url('soap_eresep/inner_get_data_autocomplet_obat_frekwensi'); ?>",
    minLength: 1,
    select: function(event, ui) {}
  });
});


$(function() {
  $("#tme").autocomplete({
    source: "<?php echo base_url('soap_eresep/inner_get_data_autocomplet_obat_tme'); ?>",
    minLength: 1,
    select: function(event, ui) {}
  });
});

</script>