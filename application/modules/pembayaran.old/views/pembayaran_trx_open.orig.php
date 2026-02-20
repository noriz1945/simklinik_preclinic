
<!doctype html>
<html>
    <head> 
	<?php $this->theme->head('theme_default'); ?> 
	<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>
	<title>Fast Clinic - Bina Medika</title>
	<style>
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
										<div class="col-sm-12">
											<div class="card">
																	<div class="card-header">
																		<h5>Data Registrasi Pasien</h5>
																	</div>
																	<div class="card-block">
																	
																		<div class="row">
																		
																		<div class="col-sm-2">
																		<!-- STATIC CONTROL -->
																		<div class="form-group">
																			<label class="col-sm-12 control-label">Nama Pasien</label>
																			<div class="col-sm-12">
																				<p class="form-control-static"><?php echo $data_reg->name; ?></p>
																			</div>
																		</div>
																		</div>
																		
																		<div class="col-sm-2">
																		<!-- STATIC CONTROL -->
																		<div class="form-group">
																			<label class="col-sm-12 control-label">No. RM</label>
																			<div class="col-sm-12">
																				<p class="form-control-static"><?php echo $data_reg->id_pasien; ?></p>
																			</div>
																		</div>
																		</div>
																		
																		<div class="col-sm-2">
																		<!-- STATIC CONTROL -->
																		<div class="form-group">
																			<label class="col-sm-12 control-label">No. Registrasi</label>
																			<div class="col-sm-12">
																				<p class="form-control-static"><?php echo $data_reg->id_reg; ?></p>
																			</div>
																		</div>
																		</div>
																		
																		<!-- STATIC CONTROL -->
																		<div class="col-sm-2">
																		<div class="form-group">
																			<label class="col-sm-12 control-label">Waktu Registrasi</label>
																			<div class="col-sm-12">
																				<p class="form-control-static"><?php echo $data_reg->regdate; ?></p>
																			</div>
																		</div>
																		</div>
																		
																		
																		
																		<div class="col-sm-2">
																		<!-- STATIC CONTROL -->
																		<div class="form-group">
																			<label class="col-sm-12 control-label">Asuransi</label>
																			<div class="col-sm-12">
																				<p class="form-control-static"><?php echo $data_reg->asuransi; ?></p>
																			</div>
																		</div>
																		</div>
																		<div class="col-sm-2">
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
                                                            <div class="col-md-6">
															
																
																<div class="card">
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
															<div class="col-md-6">
																<div class="card">
																 <div class="card-header">
																	<h5>Rincian biaya pasien yang akan dibayar</h5>
																</div>
																<div class="card-block">
																	<div class="row">
																		<div class="col-md-12"> 
																			<br>
																			<!--
																			<h6>Pilih / Centang rincian yang akan dibayar kemudian klik tombol tanda 2 panah ( >> )</h6>
																			-->
																		</div>
																		
																	</div>
																	<form id="form_invoice" method="post" action="<?php echo base_url('pembayaran/buat_invoice'); ?>">
																	<div class="table-responsive">
																		<table class="table table-bordered table-hover" id="table_invoice">
																			<thead>
																				<tr>
																					<th scope="col">#</th>
																					<th scope="col">Item</th>
																					<th scope="col" style="text-align: right;">Harga Satuan</th>
																					<th scope="col" style="text-align: right;">Jumlah</th>
																					<th scope="col" style="text-align: right;">Subtotal</th>
																					
																				</tr>
																			</thead>
																			<tbody>
																				 
																				
																			</tbody>
																			<tfoot>
																				<tr>
																				
																					<td colspan=3>
																						
																					</td>
																					
																					<td align="right"><span class="row_header_inv">Total</span></td>
																					<td align="right" id="total">0</td>
																				</tr>
																			</tfoot>
																		</table>
																	</div>
																	
																	<div id="box_bayar" class="row d-none">
																		<div class="col-md-12">
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
																					
																					<div class="form-group row text-right">
																						<label for="vcdisc_m" class="col-sm-9 col-form-label text-right">Diskon </label>
																						<div class="col-sm-3">
																							<input type="text" class="form-control text-right" id="vcdisc_m" name="vcdisc_m" value="0">
																						</div>
																					</div>
																					
																					<div class="form-group row text-right d-none">
																						<label for="total_dp" class="col-sm-9 col-form-label text-right">Total DP </label>
																						<div class="col-sm-3">
																							<input type="text" class="form-control text-right" id="total_dp" name="total_dp" value="0" readonly>
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
																									<input type="number" class="form-control text-right" id="total_noncash" name="total_noncash" value="0" readonly>
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
																								<label for="id_bank1" class="col-sm-9 col-form-label text-right">Bank Kartu </label>
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
																									<input type="number" class="form-control text-right" id="total_cc1" name="total_cc1" value="0">
																								</div>
																							</div>
																						</div>
																					</div>
																					
																					<div class="form-group row text-right">
																						<label for="total_cash" class="col-sm-9 col-form-label text-right">Tunai </label>
																						<div class="col-sm-3">
																							<input type="number" inputmode="numeric" class="form-control text-right" id="total_cash" name="total_cash" value="0">
																						</div>
																					</div>
																					
																					<div class="form-group row text-right">
																						<label for="kembalian" class="col-sm-9 col-form-label text-right">Kembali </label>
																						<div class="col-sm-3">
																							<input type="text" class="form-control text-right" id="kembalian" name="kembalian" value="0" readonly>
																						</div>
																					</div>
																					
																				</div>
																					
																					<div class="form-group row text-right">
																						<div class="col-sm-12">
																							<input type="hidden" name="id_reg" value="<?php echo $data_reg->id_reg; ?>" />
																							<input type="hidden" name="id_asuransi" value="<?php echo $data_reg->id_asuransi; ?>" />
																							<!-- Provides extra visual weight and identifies the success action in a set of buttons -->
																							<button type="submit" class="btn btn-gede btn-success btn-grd-success">Simpan</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
	source: "<?php echo base_url('pembayaran/inner_get_data_autocomplete_tindakan'); ?>",
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
	if(!window.confirm('Hapus : '+nama_tindakan)) return;
	$.get("<?php echo base_url('pembayaran/delete_trx_reg_act/'.$id_reg); ?>/"+id_trx, function( data ) {
	  $( ".result" ).html( data );
		//alert(data);
	  $("#box_tabel_pre_trx").load("<?php echo base_url('pembayaran/inner_load_pre_trx_open/'.$id_reg); ?>");
	});
}

$('#masukan_ke_invoice').click(function(){
	var inputs = document.querySelectorAll("#form_pre_trx input[name='chk_id_trx[]']");
	var no = 0;
	var pre_subtotal = 0;
	var subtotal = 0;
	for (i = 0; i < inputs.length; i++) 
	{
		no++;
		var tr_td = "";
		var cheked = $("#chk_id_trx\\["+i+"\\]");
		var val_id_group = $("#val_id_group\\["+i+"\\]").val();
		var val_grup = $("#val_grup\\["+i+"\\]").val();
		var td_total = $('#td_total_'+i).html();
		new_subtotal = parseInt(td_total.replace('.','').replace('.',''));
		//alert(new_total);
		var curr_id_group;
		if(cheked.is(':checked'))   // checked
		{
			if(curr_id_group != val_id_group)
			{
				tr_td += '		<tr class="table-info">';
				tr_td += '			<td colspan="6" nowrap><span class="row_header_inv">'+val_grup+'</span></td>';
				tr_td += '		</tr>'; 
				
				curr_id_group = val_id_group;
			}
			
			tr_td += '		<tr>';
			tr_td += '			<td nowrap>'+no+'</td>';
			tr_td += '			<td>'+ $('#td_name_'+i).html() +' <input type="hidden" name="id_group[]" value="'+ val_id_group +'" ></td>';
			tr_td += '			<td style="text-align: right;">'+ $('#td_price_'+i).html() +' <input type="hidden" name="id_trx[]" value="'+ cheked.val() +'" ></td>';
			tr_td += '			<td style="text-align: right;">'+ $('#td_qty_'+i).html() +'</td>';
			tr_td += '			<td style="text-align: right;">'+ $('#td_total_'+i).html() +'</td>';
			tr_td += '		</tr>'; 
			
			
			$("#table_invoice tbody").append(tr_td);			
			$('.tr_'+i).remove();			
			subtotal += new_subtotal;
			console.log(new_subtotal);
		}			
		else	  // unchecked
		{
			pre_subtotal += new_subtotal;
		}
		
		// --- TOTAL DP BELUM BISA ---
		total_dp = $("#total_dp").val(0);
	} 
	
	// total di kiri
	$('#pre_subtotal').html(pre_subtotal);
	
	// total di kanan
	$('#total').html(subtotal);
	
	// total di kanan : input box
	$('#subtotal').val(subtotal);
	$('#yg_harus_dibayar').val(subtotal);
	$('#total_cash').val(subtotal);
	
	$('#box_bayar').removeClass('d-none');
});

$("#vcdisc_m").on( "input", function() {
	
	$("#total_noncash").val(0);
	$("#total_cc1").val(0);
	$("#total_cash").val(0);
	$("#kembalian").val(0);
	
	var subtotal = $("#subtotal").val();
	var total_dp = $("#total_dp").val();
	var vcdisc_m = $("#vcdisc_m").val();
	
	if(parseInt(vcdisc_m) > (parseInt(subtotal)-parseInt(total_dp)))
	{
		$("#vcdisc_m").val(parseInt(subtotal)-parseInt(total_dp));
		
	}
	// Ulangi
	var subtotal = $("#subtotal").val();
	var total_dp = $("#total_dp").val();
	var vcdisc_m = $("#vcdisc_m").val();
		
	var yg_harus_dibayar = parseInt(subtotal) - parseInt(total_dp) - parseInt(vcdisc_m);
	
	$("#yg_harus_dibayar").val(yg_harus_dibayar);
	$("#total_cash").val(yg_harus_dibayar);
});

$("#total_noncash").on( "input", function() {
	
	$("#total_cc1").val(0);
	$("#total_cash").val(0);
	$("#kembalian").val(0);

	var yg_harus_dibayar = $("#yg_harus_dibayar").val();
	var total_noncash = $("#total_noncash").val();
	
	if(parseInt(yg_harus_dibayar) <= 0) 
	{
		$("#total_noncash").val(0);
		$("#total_cc1").val(0);
		$("#total_cash").val(0);
		$("#kembalian").val(0);
		return;
	}
	
	var sisa = parseInt(yg_harus_dibayar) - parseInt(total_noncash);
	
	if(sisa < 0)
		$("#total_noncash").val(yg_harus_dibayar);
	
});

$("#total_cc1").on( "input", function() {
	
	$("#kembalian").val(0);
	
	var yg_harus_dibayar = $("#yg_harus_dibayar").val();
	var total_noncash = $("#total_noncash").val();
	var total_cc1 = $("#total_cc1").val();
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
	
	var yg_harus_dibayar = $("#yg_harus_dibayar").val();
	var total_noncash = $("#total_noncash").val();
	var total_cc1 = $("#total_cc1").val();
	var total_cash = $("#total_cash").val();
	
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

$('#form_invoice').on('submit',function(e){
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
	}
	//e.preventDefault();
});

$("#box_tabel_pre_trx").load("<?php echo base_url('pembayaran/inner_load_pre_trx_open/'.$id_reg); ?>");

$('#large-Modal').on('shown.bs.modal', function () {
  $('#txt_id_act').trigger('focus');
})
</script>

<script>
/*
$('#vcdisc_m').change(function(){
    var vcdisc_m_set = $('#vcdisc_m').val();
    var total_inv_total_set   = $('#inv_total').val();

    var proses_total_inv = (parseInt(total_inv_total_set)-parseInt(vcdisc_m_set));
    $('#inv_total').val(proses_total_inv);
});
*/
</script>
</body>
</html>