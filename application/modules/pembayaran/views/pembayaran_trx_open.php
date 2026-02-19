
<!doctype html>
<html>
    <head> 
	<?php $this->theme->head('theme_default'); ?> 
	<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>
	<title>Fast Clinic - Bina Medika</title>
	<style>
	body {
		font-size: 1.2rem;
	}
	.list_reg {
	  height:100vh;
	  overflow-y: scroll;
	}
	.table td, .table th {
		padding: 1rem .75rem;
	}
	.btn {
		padding: 1px 5px;
	}
	
	.btn-gede {
		padding: 15px 35px;
	}
	.row_header_inv{
		font-weight: bold;
	}
	select.form-control {
		background-color: ghostwhite;
	}
	.form-group {
		margin-bottom: 0.7em;
	}
	.card .card-header {
		padding: 5px 10px;
	}
	.card .card-block {
		padding: 0.7rem;
	}
	.card {
		margin-bottom: 10px;
	}
	strong {
		font-weight: 700;
		color : blue;
	}
	.input-sm{
		
	}
	#table_invoice{
		max-width : 2000px;
	}
	#table_invoice tbody td input{
		text-align : right;
		width : 90px;
	}
	#table_invoice .td_press{
		width : 10px !important;
	}
	.dt_disc_p{
		width : 60px !important;
		text-align : center !important;
	}
	/* Chrome, Safari, Edge, Opera */
	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
	  -webkit-appearance: none;
	  margin: 0;
	}

	/* Firefox */
	input[type=number] {
	  -moz-appearance: textfield;
	}
	label {
		margin-bottom: .1rem;
		font-weight: 600;
	}
	.form-control-static{
		font-size: 80%;
		font-style: italic;

	}
	.table-warning, .table-warning > td, .table-warning > th {
		background-color: #fffae9;
	}
	.table-hover tbody tr:hover {
		background-color: rgba(255, 245, 235,0.4);
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
                                            <h5>Pembayaran</h5><span>Rincian Biaya Pasien</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="page-header-breadcrumb">
                                        <ul class=" breadcrumb breadcrumb-title">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('./'); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('pembayaran/'); ?>">Pembayaran</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-body">
										<!-- <div class="col-sm-10 offset-md-1"> -->
										<div class="col-sm-12">
											<div class="card">
																	<div class="card-header">
																		<h5>Data Registrasi Pasien</h5>
																	</div>
																	<div class="card-block">
																		
																		<div class="row">
																		
																			<div class="col-sm-3">
																				<!-- STATIC CONTROL -->
																				<div class="form-group">
																					<label class="col-sm-12 control-label">Nama Pasien</label>
																					<div class="col-sm-12">
																						<p class="form-control-static"><?php echo $data_reg->name; ?></p>
																					</div>
																				</div>
																			</div>
																			
																			<div class="col-sm-3">
																				<!-- STATIC CONTROL -->
																				<div class="form-group">
																					<label class="col-sm-12 control-label">No. RM</label>
																					<div class="col-sm-12">
																						<p class="form-control-static"><?php echo $data_reg->id_pasien; ?></p>
																					</div>
																				</div>
																			</div>
																			
																			<div class="col-sm-3">
																				<!-- STATIC CONTROL -->
																				<div class="form-group">
																					<label class="col-sm-12 control-label">Asuransi/Penjamin</label>
																					<div class="col-sm-12">
																						<p class="form-control-static"><?php echo $data_reg->asuransi; ?></p>
																					</div>
																				</div>
																			</div>
																		
																			<div class="col-sm-3">
																				<!-- STATIC CONTROL -->
																				<div class="form-group">
																					<label class="col-sm-12 control-label">Total Deposit</label>
																					<div class="col-sm-12">
																						<p class="form-control-static"><?php echo $data_reg->total_dp; ?></p>
																					</div>
																				</div>
																			</div>
																			
																		</div>
																		
																		<div class="row">
																			
																			<div class="col-sm-3">
																				<!-- STATIC CONTROL -->
																				<div class="form-group">
																					<label class="col-sm-12 control-label">No. Registrasi</label>
																					<div class="col-sm-12">
																						<p class="form-control-static"><?php echo $data_reg->id_reg; ?></p>
																					</div>
																				</div>
																			</div>
																			
																			<!-- STATIC CONTROL -->
																			<div class="col-sm-3">
																				<div class="form-group">
																					<label class="col-sm-12 control-label">Waktu Registrasi</label>
																					<div class="col-sm-12">
																						<p class="form-control-static"><?php echo $data_reg->regdate; ?></p>
																					</div>
																				</div>
																			</div>
																			
																			<div class="col-sm-3">
																				<!-- STATIC CONTROL -->
																				<div class="form-group">
																					<label class="col-sm-12 control-label">Dokter</label>
																					<div class="col-sm-12">
																						<p class="form-control-static"><?php echo $data_reg->dokter; ?></p>
																					</div>
																				</div>
																			</div>
																			
																		</div>
																		
																	
																	</div>
																</div>
																
										</div>
										
                                        <div class="row">
                                            <div class="col-sm-12">
                                                
                                                    <div class="container-fluid">
                                                        <!-- Main content -->
                                                        <div class="row" style="">
                                                            <!-- <div id="div_pre_trx_open" class="col-md-10 offset-md-1"> -->
															<div id="div_pre_trx_open" class="col-md-12">
																
																<div class="card" style="background-color: rgba(224, 186, 141,0.1);">
                                                                <div class="card-header">
																	<h5>Rincian biaya pasien (Belum terbayar)</h5>
																</div>
																<div class="card-block">
																	<div class="row">
																		<div class="col-md-12"> 
																		<!-- <?php #echo anchor(site_url('trx_reg/create'),'<i class="fa fa-plus"></i> Tambah Data', 'btn btn-success waves-effect"'); ?>  -->
																		<!-- <button type="button" class="btn btn-success waves-effect" data-toggle="modal" data-target="#large-Modal"><i class="fa fa-plus"></i>Jenis Tindakan</button> -->
																		<!--
																		<button type="button" class="btn btn-success waves-effect"><?php echo anchor(site_url('trx_reg/cari_pasien'),'<i class="fa fa-plus"></i> Registrasi Baru', 'style="color:white;"'); ?> </button>
																		-->
																			<h6>Pilih / Centang rincian yang akan dibayar kemudian klik tombol tanda 2 panah ( >> )</h6>
																		</div>
																		
																	</div>
																	<form id="form_pre_trx">
																	<div class="table-responsive" id="box_tabel_pre_trx">
																		<!-- INNER WILL BE LOAD HERE -->
																	</div>
																	</form>
																	<div class="row">
																		<div class="col-sm-6">
																			<button type="button" class="btn btn-gede btn-success waves-effect btn-grd-success" data-toggle="modal" data-target="#large-Modal"><i class="fa fa-plus"></i> Tindakan </button>
																		</div>
																		<div class="col-sm-6 text-right">
																			<button id="masukan_ke_invoice" class="btn btn-gede waves-effect waves-light btn-grd-success"> Invoice &gt;&gt; </button>
																		</div>
																	</div>
																</div>
																</div>
															
															</div>
															
															<!--
															<div class="col-md-1 d-flex justify-content-center" style="padding:150px 0;">
																<button id="masukan_ke_invoice" class="btn waves-effect waves-light btn-grd-success"> Invoice &gt;&gt; </button>
															</div>
															-->
															<div id="div_list_invoice" class="col-md-12 d-none" style="margin-top:30px;">
																<div class="card">
																 <div class="card-header">
																	<h5>Rincian biaya pasien yang akan dibayar</h5>
																</div>
																<div class="card-block">
																	<form id="form_invoice" method="post" action="<?php echo base_url('pembayaran/buat_invoice'); ?>">
																	<div class="row">
																		<div class="col-md-6 offset-md-6 text-right"> 
																			<div class="form-group row">
																				<label for="id_vcr" class="col-sm-6 col-form-label">Kode Voucher Diskon :</label>
																				<div class="col-sm-4">
																					<input type="text" class="form-control text-center" id="kode_vcr" name="kode_vcr" value="">
																				</div>
																				<div class="col-sm-2 text-left">
																					<button type="button" id="butt_vcr_gunakan" class=""> Gunakan </button>
																				</div>
																			</div>
																		</div>
																		
																	</div>
																	
																	<div class="table-responsive">
																		<table class="table table-bordered table-hover" id="table_invoice" align="right">
																			<thead>
																				<tr>
																					<th scope="col">#</th>
																					<th scope="col">Item</th>
																					<th scope="col" style="text-align: right;">Harga Satuan</th>
																					<th scope="col" style="text-align: right;">Diskon(%)</th>
																					<th scope="col" style="text-align: right;">Diskon(Rp)</th>
																					<th scope="col" style="text-align: right;">Harga Satuan<br>Setelah Diskon</th>
																					<th scope="col" style="text-align: right;">Jumlah</th>
																					<th scope="col" style="text-align: right;">Tuslah</th>
																					<th scope="col" style="text-align: right;">Subtotal</th>
																					
																				</tr>
																			</thead>
																			<tbody>
																				 
																				
																			</tbody>
																			<tfoot>
																				<tr>
																				
																					<td colspan="7">
																						
																					</td>
																					
																					<td align="right"><span class="row_header_inv">Total</span></td>
																					<td align="right" id="total">0</td>
																				</tr>
																			</tfoot>
																		</table>
																	</div>
																	
																	<div id="box_bayar" class="row d-none">
																		<div class="col-md-6 offset-md-6">
																			<div class="card">
																				<div class="card-header">
																					<h5>Pembayaran</h5>
																				</div>
																				<div class="card-block">
																				
																					<div class="form-group row text-right">
																						<label for="subtotal" class="col-sm-9 col-form-label text-right">TOTAL </label>
																						<div class="col-sm-3">
																							<input type="text" class="form-control text-right" id="subtotal" name="subtotal" value="0" readonly >
																						</div>
																					</div>
																					
																					<div class="form-group row text-right d-none">
																						<label for="disc_persen" class="col-sm-4 col-form-label text-right">Diskon</label>
																						<div class="col-sm-2" style="padding-right:0;">
																							<input type="text" class="form-control text-center" id="disc_persen" name="disc_persen" value="0" style="width:65px;" maxlength="5">
																						</div>
																						<label for="disc_persen" class="col-sm-1 col-form-label text-left" style="padding-left:0;">%</label>
																						<label for="vcdisc_m" class="col-sm-2 col-form-label text-right">Diskon Rp (-) </label>
																						<div class="col-sm-3">
																							<input type="text" class="form-control text-right" id="vcdisc_m" name="vcdisc_m" value="0">
																						</div>
																					</div>
																					
																					<div class="form-group row text-right">
																						<label for="ppn" class="col-sm-9 col-form-label text-right">PPN (11%) (+) </label>
																						<div class="col-sm-3">
																							<input type="text" class="form-control text-right" id="ppn" name="ppn" value="0" readonly>
																						</div>
																					</div>
																					
																					<div class="form-group row text-right">
																						<label for="total_dp" class="col-sm-9 col-form-label text-right">Total Deposit (-) </label>
																						<div class="col-sm-3">
																							<input type="text" class="form-control text-right" id="total_dp" name="total_dp" value="<?php echo round($data_reg->total_dp) ?>" readonly>
																						</div>
																					</div>
																					
																					<div class="form-group row text-right">
																						<label for="yg_harus_dibayar" class="col-sm-9 col-form-label text-right">Total yang harus dibayar </label>
																						<div class="col-sm-3">
																							<input type="text" class="form-control text-right" id="yg_harus_dibayar" name="yg_harus_dibayar" value="0" readonly>
																						</div>
																					</div>
																					
																					<div class="cardx border">
																						<div class="card-header">
																							<h5>Jaminan / Asuransi</h5>
																						</div>
																						<div class="card-bodyx">
																							 <div class="form-group row text-right">
																								<label for="total_noncash" class="col-sm-9 col-form-label text-right">Dijamin Asuransi </label>
																								<div class="col-sm-3">
																									<input type="number" class="form-control text-right" id="total_noncash" name="total_noncash" value="">
																								</div>
																							</div>
																						</div>
																					</div>
																					
																					<div class="cardx border">
																						<div class="card-header">
																							<h5>Pembayaran Menggunakan Kartu</h5>
																						</div>
																						<div class="card-bodyx">
																							<!--
																							<div class="form-group row text-right">
																								<label for="inv_id_cctype1" class="col-sm-9 col-form-label text-right">Jenis Kartu </label>
																								<div class="col-sm-3">
																									<input type="text" class="form-control text-right" id="inv_id_cctype1" name="inv_id_cctype1" value="0">
																								</div>
																							</div>
																							-->
																							<div class="form-group row text-right">
																								<label for="id_bank1" class="col-sm-9 col-form-label text-right">Bank EDC </label>
																								<div class="col-sm-3">
																									<?php echo $dropdown_id_bank ?>
																								</div>
																							</div>
																							
																							<div class="form-group row text-right">
																								<label for="nocc1" class="col-sm-9 col-form-label text-right">Nomor Kartu </label>
																								<div class="col-sm-3">
																									<input type="text" class="form-control text-right" id="nocc1" name="nocc1" value="">
																								</div>
																							</div>
																							
																							<div class="form-group row text-right">
																								<label for="total_cc1" class="col-sm-9 col-form-label text-right">Total Dibayar Kartu </label>
																								<div class="col-sm-3">
																									<input type="number" class="form-control text-right" id="total_cc1" name="total_cc1" value="">
																								</div>
																							</div>
																						</div>
																					</div>
																					
																					<div class="cardx border">
																						<div class="card-header">
																							<h5>Pembayaran Tunai</h5>
																						</div>
																						<div class="card-bodyx">
																							<div class="form-group row text-right">
																								<label for="total_cash" class="col-sm-9 col-form-label text-right">Tunai </label>
																								<div class="col-sm-3">
																									<input type="number" inputmode="numeric" class="form-control text-right" id="total_cash" name="total_cash" value="0">
																								</div>
																							</div>
																						</div>
																					</div>
																					
																					<div class="cardx border">
																						<div class="card-header">
																							<h5>Lainnya</h5>
																						</div>
																						<div class="card-bodyx">
																							<div class="form-group row text-right">
																								<label for="kembalian" class="col-sm-9 col-form-label text-right">Kembali </label>
																								<div class="col-sm-3">
																									<input type="text" class="form-control text-right" id="kembalian" name="kembalian" value="0" readonly>
																								</div>
																							</div>
																							
																							<div class="form-group row text-right">
																								<label for="kembalian" class="col-sm-9 col-form-label text-right">Deposit Digunakan U/ Pembayaran</label>
																								<div class="col-sm-3">
																									<input type="text" class="form-control text-right" id="dp_use" name="dp_use" value="0" readonly>
																								</div>
																							</div>
																							
																							<div class="form-group row text-right">
																								<label for="kembalian" class="col-sm-9 col-form-label text-right">Pengembalian Deposit </label>
																								<div class="col-sm-3">
																									<input type="text" class="form-control text-right" id="dp_ret" name="dp_ret" value="0" readonly>
																								</div>
																							</div>
																						</div>
																					</div>
																					
																				</div>
																					
																					<div class="form-group row text-right">
																						<div class="col-sm-12">
																							<input type="hidden" name="id_reg" value="<?php echo $data_reg->id_reg; ?>" />
																							<input type="hidden" name="id_asuransi" value="<?php echo $data_reg->id_asuransi; ?>" />
																							<!-- Provides extra visual weight and identifies the success action in a set of buttons -->
																							<button type="button" class="btn btn-gede btn-success btn-grd-success" id="butt_simpan_inv">Simpan</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																							<button type="button" class="btn btn-gede btn-default btn-grd-default" onClick="javascript: location='<?php echo site_url('pembayaran'); ?>';">Batal </button>
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
                                                        <!-- /.content -->
                                                    </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
					<?php #$this->theme->wrapper_close('theme_default'); ?>
</div>
</div>
</div>
</div>

<div class="modal fade" id="large-Modal" tabindex="-1" role="dialog">
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
									<?php echo $dropdown_id_dokter ?>
								</div>
							</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Tutup</button>
				<button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
			</div>
		</div>
		</form>
	</div>
</div>


					
<?php #$this->theme->script('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-js.php');?>
<script>
	
$("#txt_id_act").autocomplete({
	source: "<?php echo base_url('pembayaran/inner_get_data_autocomplete_tindakan/'.$data_reg->id_asuransi); ?>",
	minLength: 3,
	select: function( event, ui ) {
		$("#price").val(ui.item.price);
		$("#txt_id_act").val(ui.item.label);
		$("#id_act").val(ui.item.idx);
		
		$('#qty').focus();
	}
});

$('#form_tambah_tindakan').on( "submit", function(e) {
	e.preventDefault();
	$.ajax({
		type: "POST",
		url: '<?php echo base_url('pembayaran/add_tindakan_act/trx_open/'.$id_reg); ?>',
		data: $('#form_tambah_tindakan').serialize(),
		success: function(response) {
			//alert(response['response']);
			$("#box_tabel_pre_trx").load("<?php echo base_url('pembayaran/inner_load_pre_trx_open/'.$id_reg); ?>");
			$('#form_tambah_tindakan')[0].reset()
			$('#large-Modal').modal('hide');
		},
		error: function() {
			alert('Error');
		}
	});
	return false;
});

function delete_pre_act(id_trx,nama_tindakan)
{
	if(!window.confirm("Hapus : "+nama_tindakan)) return;
	$.get("<?php echo base_url('pembayaran/delete_trx_reg_act/'.$id_reg); ?>/"+id_trx, function( data ) {
	  $( ".result" ).html( data );
		//alert(data);
	  $("#box_tabel_pre_trx").load("<?php echo base_url('pembayaran/inner_load_pre_trx_open/'.$id_reg); ?>");
	});
}

function hitung_ulang_invoice()
{
	derupiah_ulang();
	var disc_inputs = $('#table_invoice input[id^="dt_disc_p_"]');
	var subtotal = 0;
	$.each( disc_inputs, function( kk, vv )
	{
		var price_ori = $('#dt_price_ori_'+kk);  	var price_ori_val 	= parseInt(price_ori.val());
		var disc_p    = $('#dt_disc_p_'+kk);	var disc_p_val 		= parseFloat(disc_p.val());
		var disc_m    = $('#dt_disc_m_'+kk);	var disc_m_val 		= parseInt(disc_m.val());
		var price     = $('#dt_price_'+kk);  	var price_val 	  	= parseInt(price.val());
		var qty       = $('#dt_qty_'+kk);  		var qty_val 		= parseInt(qty.val());
		var tuslah    = $('#dt_tuslah_'+kk);  	var tuslah_val 		= parseInt(tuslah.val());
		var total     = $('#dt_total_'+kk);  	var total_val 		= parseInt(total.val());
		
		disc_m_val = parseInt((price_ori_val * disc_p_val) / 100);
		disc_m.val(disc_m_val);
		
		price_val = price_ori_val - disc_m_val;
		price.val(price_val);
		
		total_val = (price_val * qty_val) + tuslah_val;
		total.val(total_val);
		
		subtotal += total_val;
	});
	// total di kanan
	$('#total').html(subtotal);
	$('#subtotal').val(subtotal);
	//$('#yg_harus_dibayar').val(subtotal);
	hitung_ulang_ppn();
	hitung_ulang_yg_harus_dibayar();
	//rupiah_ulang()
}

function rupiah_ulang()
{
	var disc_inputs = $('#table_invoice input[id^="dt_disc_p_"]');
	$.each( disc_inputs, function( kk, vv )
	{
		var price_ori = $('#dt_price_ori_'+kk);	var price_ori_val 	= parseInt(price_ori.val());	price_ori.val(rupiah(price_ori_val));
		var disc_p    = $('#dt_disc_p_'+kk);	var disc_p_val 		= parseFloat(disc_p.val());		disc_p.val(rupiah(disc_p_val));
		var disc_m    = $('#dt_disc_m_'+kk);	var disc_m_val 		= parseInt(disc_m.val());		disc_m.val(rupiah(disc_m_val));
		var price     = $('#dt_price_'+kk);  	var price_val 	  	= parseInt(price.val());		price.val(rupiah(price_val));
		var qty       = $('#dt_qty_'+kk);  		var qty_val 		= parseInt(qty.val());			qty.val(rupiah(qty_val));
		var tuslah    = $('#dt_tuslah_'+kk);  	var tuslah_val 		= parseInt(tuslah.val());		tuslah.val(rupiah(tuslah_val));
		var total     = $('#dt_total_'+kk);  	var total_val 		= parseInt(total.val());		total.val(rupiah(total_val));
	});
}

function derupiah_ulang()
{
	var disc_inputs = $('#table_invoice input[id^="dt_disc_p_"]');
	$.each( disc_inputs, function( kk, vv )
	{
		var price_ori = $('#dt_price_ori_'+kk); var price_ori_val 	= parseInt(price_ori.val().replace('.','').replace('.',''));	price_ori.val(price_ori_val);
		var disc_p    = $('#dt_disc_p_'+kk);	var disc_p_val 		= parseFloat(disc_p.val());										disc_p.val(disc_p_val);
		var disc_m    = $('#dt_disc_m_'+kk);	var disc_m_val 		= parseInt(disc_m.val().replace('.','').replace('.',''));		disc_m.val(disc_m_val);
		var price     = $('#dt_price_'+kk);  	var price_val 	  	= parseInt(price.val().replace('.','').replace('.',''));		price.val(price_val);
		var qty       = $('#dt_qty_'+kk);  		var qty_val 		= parseInt(qty.val().replace('.','').replace('.',''));			qty.val(qty_val);
		var tuslah    = $('#dt_tuslah_'+kk);  	var tuslah_val 		= parseInt(tuslah.val().replace('.','').replace('.',''));		tuslah.val(tuslah_val);
		var total     = $('#dt_total_'+kk);  	var total_val 		= parseInt(total.val().replace('.','').replace('.',''));		total.val(total_val);
	});
}

$('#masukan_ke_invoice').click(function(){
	var inputs = document.querySelectorAll("#form_pre_trx input[name='chk_id_trx[]']");
	var no = 0;
	var pre_subtotal = 0;
	var subtotal = 0;
	for (i = 0; i < inputs.length; i++) 
	{
		
		var tr_td = "";
		var cheked = $("#chk_id_trx\\["+i+"\\]");
		var val_id_act = $("#val_id_act\\["+i+"\\]").val();
		var val_id_group = $("#val_id_group\\["+i+"\\]").val();
		var val_grup = $("#val_grup\\["+i+"\\]").val();
		var is_paket = $("#is_paket\\["+i+"\\]").val();
		var readonly = "";
		if(is_paket==1){readonly="readonly";}else{readonly="";}
		var is_farmasi = $("#is_farmasi\\["+i+"\\]").val();
		var td_total = $('#td_total_'+i).html();
		new_subtotal = parseInt(td_total.replace('.','').replace('.',''));
		//alert(new_total);
		var curr_id_group;
		if(cheked.is(':checked'))   // checked
		{
			
			if(curr_id_group != val_id_group)
			{
				tr_td += '		<tr class="table-warning warning-light">';
				tr_td += '			<td colspan="9" nowrap><span class="row_header_inv">'+val_grup+'</span></td>';
				tr_td += '		</tr>'; 
				
				curr_id_group = val_id_group;
			}
			
			var dt_name 	 = $('#td_name_'+i).html();
			var dt_price_ori = $('#td_price_'+i).html();  dt_price_ori = parseInt(dt_price_ori.replace('.','').replace('.',''));
			var dt_price     = $('#td_price_'+i).html();  dt_price = parseInt(dt_price.replace('.','').replace('.',''));
			var dt_disc_p    = 0;
			var dt_disc_m    = 0;
			var dt_qty       = $('#td_qty_'+i).html();  dt_qty = parseInt(dt_qty.replace('.','').replace('.',''));
			var dt_tuslah    = $('#td_tuslah_'+i).html();  dt_tuslah = parseInt(dt_tuslah.replace('.','').replace('.',''));
			var dt_total     = $('#td_total_'+i).html();  dt_total = parseInt(dt_total.replace('.','').replace('.',''));
			
			tr_td += '		<tr id="tr_'+no+'">';
			tr_td += '			<td nowrap>'+(no+1);
			tr_td += '				</td>';
			tr_td += '			<td>'+ dt_name; 
			tr_td += '				<input type="hidden" name="id_group[]" value="'+ val_id_group +'" >';
			tr_td += '				<input type="hidden" name="id_trx[]" value="'+ cheked.val() +'" readonly >';
			tr_td += '				<input type="hidden" id="val_id_act_'+no+'" name="val_id_act['+no+']" value="'+val_id_act+'" />';
			tr_td += '				<input type="hidden" id="is_paket_'+no+'" name="is_paket['+no+']" value="'+is_paket+'" />';
			tr_td += '				<input type="hidden" id="is_farmasi_'+no+'" name="is_farmasi['+no+']" value="'+is_farmasi+'" />';
			tr_td += '				</td>';
			tr_td += '			<td style="text-align: right;" nowrap class="td_press">'+ '<input type="text" class="form-control dt_price_ori" id="dt_price_ori_'+no+'" name="dt_price_ori['+no+']" 	value="'+dt_price_ori+'" data-id="'+no+'" readonly>' + '</td>';
			tr_td += '			<td style="text-align: right;" nowrap class="td_press">'+ '<input type="number" class="form-control dt_disc_p" id="dt_disc_p_'+no+'" 		name="dt_disc_p['+no+']" 	value="0" class="text-center" size="6" min="0" max="100" data-id="'+no+'" '+readonly+'>' + '</td>';
			tr_td += '			<td style="text-align: right;" nowrap class="td_press">'+ '<input type="number" class="form-control dt_disc_m" id="dt_disc_m_'+no+'" 		name="dt_disc_m['+no+']" 	value="0" class="text-right" size="12" data-id="'+no+'" '+readonly+'>' +'</td>';
			tr_td += '			<td style="text-align: right;" nowrap class="td_press">'+ '<input type="text" class="form-control dt_price" id="dt_price_'+no+'" 		name="dt_price['+no+']" 		value="'+dt_price+'" data-id="'+no+'" readonly>' + '</td>';
			tr_td += '			<td style="text-align: right;" nowrap class="td_press">'+ '<input type="text" class="form-control dt_qty" id="dt_qty_'+no+'" 			name="dt_qty['+no+']" 		value="'+dt_qty+'" data-id="'+no+'" readonly>' + '</td>';
			tr_td += '			<td style="text-align: right;" nowrap class="td_press">'+ '<input type="text" class="form-control dt_tuslah" id="dt_tuslah_'+no+'" 		name="dt_tuslah['+no+']" 	value="'+dt_tuslah+'" data-id="'+no+'" readonly>' + '</td>';
			tr_td += '			<td style="text-align: right;" nowrap class="td_press">'+ '<input type="text" class="form-control dt_total" id="dt_total_'+no+'" 		name="dt_total['+no+']" 		value="'+dt_total+'" data-id="'+no+'" readonly>' + '</td>';
			tr_td += '		</tr>'; 
			
			$("#table_invoice tbody").append(tr_td);			
			$('.tr_'+i).remove();			
			subtotal += new_subtotal;
			no++;
		}			
		else	  // unchecked
		{
			pre_subtotal += new_subtotal;
		}
	} 
	
	// total di kiri
	$('#pre_subtotal').html(pre_subtotal);
	
	/*
	// total di kanan
	$('#total').html(subtotal);
	// total di kanan : input box
	$('#subtotal').val(subtotal);
	$('#yg_harus_dibayar').val(subtotal);
	//$('#total_cash').val(subtotal);
	*/
	
	$('#box_bayar').removeClass('d-none');
	$('#div_list_invoice').removeClass('d-none');
	$('#div_pre_trx_open').addClass('d-none');
	
	hitung_ulang_ppn();
	hitung_ulang_yg_harus_dibayar();
	hitung_ulang_invoice();
	//rupiah_ulang();
	
	$('.dt_disc_p').on('input',function(){
		var idx = $(this).data("id");
		var kk = $(this).data("id");
		
		var persentase = $(this).val();
		persentase = parseFloat(persentase);
		
		if(persentase > (100.00))
			$("#dt_disc_p_"+idx).val(100);
		if(persentase < (0))
			$("#dt_disc_p_"+idx).val(0);
		if(persentase== 'NaN')
			$("#dt_disc_p_"+idx).val(0);
		if(persentase== 'undefined')
			$("#dt_disc_p_"+idx).val(0);

		hitung_ulang_invoice();
	});
	
	$(".dt_disc_m").on( "focusin", function() {
		derupiah_ulang();		
	});
	$(".dt_disc_m").on( "focusout", function() {
		hitung_ulang_invoice();
	});
	$('.dt_disc_m').on('input',function(){
		var idx = $(this).data("id");
		var kk = $(this).data("id");
	
		var price_ori = $('#dt_price_ori_'+kk);  	var price_ori_val 	= parseInt(price_ori.val());
		var disc_p    = $('#dt_disc_p_'+kk);		var disc_p_val 		= parseFloat(disc_p.val());
		var disc_m    = $('#dt_disc_m_'+kk);		var disc_m_val 		= parseInt(disc_m.val());
		var price     = $('#dt_price_'+kk);  		var price_val 	  	= parseInt(price.val());
		
		if(disc_m_val > price_ori_val)
		{
			$("#dt_disc_m_"+idx).val(price_ori_val);
			console.log('kelebihan');
		}
		if(disc_m_val < (0))
			$("#dt_disc_m_"+idx).val(0);
		if(disc_m_val== 'NaN')
			$("#dt_disc_m_"+idx).val(0);
		if(disc_m_val== 'undefined')
			$("#dt_disc_m_"+idx).val(0);
		
		disc_p_val = 100 - (((price_ori_val - disc_m_val) * 100) / price_ori_val);
		disc_p.val(disc_p_val);
	});
});

function hitung_ulang_ppn()
{
	// PPN dinonaktifkan: selalu 0
	var ppn = 0;
	$("#ppn").val(ppn);
	return ppn;
}

function hitung_ulang_yg_harus_dibayar()
{
	// --- Hitung ulang ---
	/*
	var subtotal = $("#subtotal").val();
	var vcdisc_m = $("#vcdisc_m").val();
	var total_dp = $("#total_dp").val();
	var ppn 	 = $("#ppn").val(); 
	*/
	var subtotal = toInt($("#subtotal").val());
  var vcdisc_m = toInt($("#vcdisc_m").val());
  var total_dp = toInt($("#total_dp").val());
  var ppn = toInt($("#ppn").val());
	
	var yg_harus_dibayar = parseInt(subtotal) - parseInt(vcdisc_m) - parseInt(total_dp) + parseInt(ppn);
	var dp_use = parseInt(total_dp);
	if(yg_harus_dibayar<0)
	{
		//var kembalian = yg_harus_dibayar * (-1);
		var dp_ret = yg_harus_dibayar * (-1);
		var dp_use = parseInt(subtotal) - parseInt(vcdisc_m) + parseInt(ppn);
		yg_harus_dibayar = 0;
	}
	else
	{
		//var kembalian = 0;
		var dp_ret = 0;
	}
	
	$("#yg_harus_dibayar").val(yg_harus_dibayar);
	$("#id_bank").val('');
	$("#nocc1").val('');
	$("#total_cc1").val(0);
	$('#total_cash').val(yg_harus_dibayar);
	//$("#kembalian").val(kembalian);
	$("#dp_ret").val(dp_ret);
	$("#dp_use").val(dp_use);
	
	return yg_harus_dibayar;
}

$("#disc_persen").on("keydown", function(evt) {
    if (evt.which == 188) 
	{
		alert('Gunakan tanda titik(.) sebagai koma pada diskon persen');
		evt.preventDefault();
		return;
	}
	
	if ((evt.which >= 48 && evt.which <= 57) || evt.which==190 || evt.which==8 || evt.which==9) 
	{
	}
	else
	{
		evt.preventDefault();
		return;
	}
});

$("#disc_persen").on("keyup", function(evt) {
	var persentase = $("#disc_persen").val();
	persentase = parseFloat(persentase);
	
	if(persentase > (100.00))
		$("#disc_persen").val(100);
	if(persentase < (0))
		$("#disc_persen").val(0);
	if(persentase== 'NaN')
		$("#disc_persen").val(0);
	if(persentase== 'undefined')
		$("#disc_persen").val(0);
	
	var persentase = $("#disc_persen").val();
	var subtotal = $("#subtotal").val();
	var total_dp = $("#total_dp").val();
	var vcdisc_m = $("#vcdisc_m").val();
		
	var diskon_rp = (parseInt(subtotal) * persentase )/100;
	diskon_rp = parseInt(diskon_rp);
	
	$("#vcdisc_m").val(diskon_rp);
	
	hitung_ulang_ppn();
	var yg_harus_dibayar = hitung_ulang_yg_harus_dibayar();
	$("#total_cash").val(yg_harus_dibayar);
});

$("#vcdisc_m").on( "input", function() {
	
	$("#total_noncash").val(0);
	$("#total_cc1").val(0);
	$("#total_cash").val(0);
	$("#kembalian").val(0);
	
	var subtotal = $("#subtotal").val();
	var total_dp = $("#total_dp").val();
	var vcdisc_m = $("#vcdisc_m").val();
	
	if(parseInt(vcdisc_m) > (parseInt(subtotal)))
	{
		$("#vcdisc_m").val(parseInt(subtotal));
	}
	
	hitung_ulang_ppn();
	var yg_harus_dibayar = hitung_ulang_yg_harus_dibayar();
	
	var diskon_persen = parseInt(vcdisc_m)*100 / (parseInt(subtotal));
	diskon_persen = parseFloat(diskon_persen);
	
	$("#disc_persen").val(diskon_persen);
	$("#yg_harus_dibayar").val(yg_harus_dibayar);
	$("#total_cash").val(yg_harus_dibayar);
});

$("#total_noncash").on( "input", function() {
	
	$("#total_dp").val(0);
	//$("#dp_ret").val(0);
	hitung_ulang_yg_harus_dibayar()
	
	$("#total_cc1").val(0);
	$("#total_cash").val(0);
	$("#kembalian").val(0);

	/*
	var yg_harus_dibayar = $("#yg_harus_dibayar").val();
	var total_noncash = $("#total_noncash").val();
	*/
	var yg_harus_dibayar = toInt($("#yg_harus_dibayar").val());
  var total_noncash = toInt($("#total_noncash").val());
	
	if(parseInt(yg_harus_dibayar) <= 0 || parseInt(total_noncash) > parseInt(yg_harus_dibayar)) 
	{
		$("#total_noncash").val(parseInt(yg_harus_dibayar));
		$("#total_cc1").val(0);
		$("#total_cash").val(0);
		$("#kembalian").val(0);
		return;
	}
	
	var sisa = parseInt(yg_harus_dibayar) - parseInt(total_noncash);
	
	$("#total_cash").val(sisa);
	
	// if(sisa < 0) $("#total_noncash").val(yg_harus_dibayar);
	
});

$("#total_cc1").on( "input", function() {
	
	$("#kembalian").val(0);
	/*
	var yg_harus_dibayar = $("#yg_harus_dibayar").val();
	var total_noncash = $("#total_noncash").val();
	var total_cc1 = $("#total_cc1").val();
	*/
	var yg_harus_dibayar = toInt($("#yg_harus_dibayar").val());
  var total_noncash = toInt($("#total_noncash").val());
  var total_cc1 = toInt($("#total_cc1").val());
	var total_cash = $("#total_cash").val();
	
	if(parseInt(yg_harus_dibayar) <= 0) 
	{
		$("#total_noncash").val(0);
		$("#total_cc1").val(0);
		$("#total_cash").val(0);
		$("#kembalian").val(0);
		return;
	}
	
	var sisa = parseInt(yg_harus_dibayar) - parseInt(total_noncash) - parseInt(total_cc1);
	if(sisa < 0)
	{
		$("#total_cash").val(0);
		$("#kembalian").val(Math.abs(sisa));
	}
	else
	{
		$("#total_cash").val(sisa);
		$("#kembalian").val(0);
	}
});

$("#total_cash").on( "input", function() {
	/*
	var yg_harus_dibayar = $("#yg_harus_dibayar").val();
	var total_noncash = $("#total_noncash").val();
	var total_cc1 = $("#total_cc1").val();
	var total_cash = $("#total_cash").val();
	*/
	var yg_harus_dibayar = toInt($("#yg_harus_dibayar").val());
  var total_noncash    = toInt($("#total_noncash").val());
  var total_cc1        = toInt($("#total_cc1").val());
  var total_cash       = toInt($("#total_cash").val());
	
	if(parseInt(yg_harus_dibayar) <= 0) 
	{
		$("#total_noncash").val(0);
		$("#total_cc1").val(0);
		$("#total_cash").val(0);
		$("#kembalian").val(0);
		return;
	}
	
	var kembalian =  parseInt(total_cash) - (parseInt(yg_harus_dibayar) - parseInt(total_noncash) - parseInt(total_cc1));
	
	if(kembalian < 0 )
		$("#kembalian").val(0);
	else
		$("#kembalian").val(kembalian);
});

$('#butt_simpan_inv').on('click',function(){
	$("#butt_simpan_inv").attr( "disabled", "disabled" );
	Swal.showLoading();
	derupiah_ulang();
	
	var yg_harus_dibayar = $("#yg_harus_dibayar").val();
		yg_harus_dibayar = parseInt(yg_harus_dibayar);
	var total_noncash = $("#total_noncash").val();
	var total_cc1 = $("#total_cc1").val();
	var total_cash = $("#total_cash").val();
	
	var total_pembayaran =  parseInt(total_noncash) + parseInt(total_cc1) + parseInt(total_cash);
	
	if(total_pembayaran < yg_harus_dibayar)
	{
		Swal.fire({
		  title: "Total jumlah pembayaran masih kurang",
		  text: "Silahkan periksa kembali",
		  icon: "question"
		});
		e.preventDefault();
		rupiah_ulang();
	}
	
	$('#form_invoice').submit();
	setTimeout(function(){$("#butt_simpan_inv").removeAttr("disabled");},60000);
});

/*
$('#form_invoice').on('submit',function(e){
	
});
*/

$("#box_tabel_pre_trx").load("<?php echo base_url('pembayaran/inner_load_pre_trx_open/'.$id_reg); ?>");

$('#large-Modal').on('shown.bs.modal', function () {
  $('#txt_id_act').trigger('focus');
})

function cek_is_paket(is_paket)
{
	if(is_paket==1)
	{
		alert('Item paket tidak dapat diubah, Pembayaran dalam 1 paket');
		return false;
	}
	else
		return true;
}
</script>

<script>

$('#butt_vcr_gunakan').on('click',function(e){
	derupiah_ulang();
	var kode_vcr = $('#kode_vcr').val();
	//alert(kode_vcr);
	$.ajax({
		type: "GET",
		url: '<?php echo base_url('voucher_disc/cek_voucher/'); ?>' + kode_vcr ,
		dataType: "json",
		beforeSend: function() {
						Swal.showLoading();
					},
		success: function(data) {
			//console.log(data);
			var disc_inputs = $('#table_invoice input[id^="dt_disc_p_"]');
			$.each( disc_inputs, function( kk, vv )
			{
				$('#dt_disc_p_'+kk).val(0);
			});
			
			if( $.isArray(data.det) && data.det.length ) {
				//console.log(disc_inputs);
				$.each(data.det, function( k, v ) {
					$.each( disc_inputs, function( kk, vv )
					{
						var is_farmasi = $('#is_farmasi_'+kk).val();
						var val_id_act = $('#val_id_act_'+kk).val();
						var is_paket = $('#is_paket_'+kk).val();

						if(is_paket==1) return;
						
						if(v['is_farmasi']==0 && is_farmasi==0 && val_id_act!=(-1))
						{
							if(v['id_act_fa']=='00000' || v['id_act_fa']==val_id_act)
							{
								$('#dt_disc_p_'+kk).val(Math.round(v['disc_p']));
							}
						}
						
						if(v['is_farmasi']==1 && is_farmasi==1)
						{
							if(v['id_act_fa']=='00000' || v['id_act_fa']==val_id_act)
								$('#dt_disc_p_'+kk).val(Math.round(v['disc_p']));
						}
						
					});
					
				});
				
			}
			hitung_ulang_invoice();
			Swal.fire({
			  title: "Voucher Diskon",
			  text: "Berhasil diterapkan!",
			  icon: "success"
			});
		},
		error: function() {
			Swal.fire({
			  icon: "error",
			  title: "Voucher Diskon",
			  text: "Mohon maaf, kode voucher \""+kode_vcr+"\" tidak dapat digunakan",
			  footer: ''
			});
			$('#kode_vcr').val('');
		}
	});
})

const rupiah = (number)=>{
    return new Intl.NumberFormat("id-ID", {
      //style: "currency",
      currency: "IDR",
	  maximumFractionDigits: 0, 
	  minimumFractionDigits: 0, 
    }).format(number);
  }
</script>
<script>
	function toInt(val) {
		if (val === null || val === undefined) return 0;
		// pastikan string, buang semua selain digit dan minus
		val = String(val).replace(/[^0-9-]/g, '');
		if (val === '' || val === '-') return 0;
		return parseInt(val, 10) || 0;
	}
</script>
</body>
</html>
