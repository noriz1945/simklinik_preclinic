
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
                                            <span>Refund</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="page-header-breadcrumb">
                                        <ul class=" breadcrumb breadcrumb-title">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('pembayaran/'); ?>"><i class="feather icon-home">Pembayaran</i></a></li>
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('pembayaran/'); ?>">Refund</a></li>
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
																				<p class="form-control-static"><?php echo $data_inv_header->name; ?></p>
																			</div>
																		</div>
																		</div>
																		
																		<div class="col-sm-2">
																		<!-- STATIC CONTROL -->
																		<div class="form-group">
																			<label class="col-sm-12 control-label">No. RM</label>
																			<div class="col-sm-12">
																				<p class="form-control-static"><?php echo $data_inv_header->id_pasien; ?></p>
																			</div>
																		</div>
																		</div>
																		
																		<div class="col-sm-2">
																		<!-- STATIC CONTROL -->
																		<div class="form-group">
																			<label class="col-sm-12 control-label">No. Registrasi</label>
																			<div class="col-sm-12">
																				<p class="form-control-static"><?php echo $data_inv_header->id_reg; ?></p>
																			</div>
																		</div>
																		</div>
																		
																		<!-- STATIC CONTROL -->
																		<div class="col-sm-2">
																		<div class="form-group">
																			<label class="col-sm-12 control-label">Waktu Registrasi</label>
																			<div class="col-sm-12">
																				<p class="form-control-static"><?php echo $data_inv_header->regdate; ?></p>
																			</div>
																		</div>
																		</div>
																		
																		
																		
																		<div class="col-sm-2">
																		<!-- STATIC CONTROL -->
																		<div class="form-group">
																			<label class="col-sm-12 control-label">Asuransi</label>
																			<div class="col-sm-12">
																				<p class="form-control-static"><?php echo $data_inv_header->asuransi; ?></p>
																			</div>
																		</div>
																		</div>
																		<div class="col-sm-2">
																		<!-- STATIC CONTROL -->
																		<div class="form-group">
																			<label class="col-sm-12 control-label">Dokter</label>
																			<div class="col-sm-12">
																				<p class="form-control-static"><?php echo $data_inv_header->dokter; ?></p>
																			</div>
																		</div>
																		</div>
																		<div class="col-sm-2">
																		<div class="form-group">
																			<label class="col-sm-12 control-label">No Invoice</label>
																			<div class="col-sm-12">
																				<p class="form-control-static"><?php echo $data_inv_header->id_inv; ?></p>
																				
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
																	<h5>Rincian Item Invoice (Sudah dibayar/Closed)</h5>
																</div>
																<div class="card-block">
																	<div class="row">
																		<div class="col-md-12"> 
																			<h6>Pilih / Centang rincian yang akan direfund kemudian klik tombol tanda 2 panah ( >> )</h6>
																		</div>
																		
																	</div>
																	<form id="form_pre_refund" action="<?php echo base_url('pembayaran/refund')?>" method="post">
																	<div class="table-responsive" id="box_tabel_pre_refund">
																		
																		
																		
																		
																		
																		
																		
																		<table class="table table-bordered table-striped">
																			<thead>
																				<tr>
																					<th scope="col">Pilih</th>
																					<th scope="col">Item</th>
																					<th scope="col" style="text-align: right;">Harga Satuan</th>
																					<th scope="col" style="text-align: right;">Qty</th>
																					<th scope="col" style="text-align: right;">Subtotal</th>
																					<th scope="col" style="text-align: right;">-Diskon Item</th>
																					<th scope="col" style="text-align: right;">-Diskon All</th>
																					<th scope="col" style="text-align: right;">Total</th>
																				</tr>
																			</thead>
																			<tbody>
																				<?php
																				#$arr_status = array('Open','Closed');
																				$no = 0;
																				$pre_subtotal = 0;
																				$curr_grup = "";
																				foreach ($data_inv_detail as $k => $v)
																				{
																					if($curr_grup != $v->grup)
																					{
																						echo '	<tr class="table-info tr_'.$no,'">			
																									<td colspan="8" nowrap=""><span class="row_header_inv">'.$v->grup.'</span></td>		
																								</tr>';
																						$curr_grup = $v->grup;
																					}
																				?> 
																				
																				<tr class="tr_<?php echo $no; ?>">
																					<td nowrap> 
																						<input type="checkbox" id="chk_id_trx[<?php echo $no ?>]" name="chk_id_trx[]" value="<?php echo $v->id_trx ?>" />
																						<input type="hidden" id="val_id_group[<?php echo $no ?>]" name="val_id_group[]" value="<?php echo $v->id_group ?>" />
																						<input type="hidden" id="val_grup[<?php echo $no ?>]" name="val_grup[]" value="<?php echo $v->grup ?>" />
																						<input type="hidden" id="is_farmasi[<?php echo $no ?>]" name="is_farmasi[]" value="<?php echo $v->is_farmasi ?>" />
																					</td>
																					
																					<td id="td_name_<?php echo $no; ?>"><?php echo $v->name ?></td>
																					<td id="td_price_<?php echo $no; ?>" style="text-align: right;"><?php echo number_format($v->price,0,",",".") ?></td>
																					<td id="td_qty_<?php echo $no; ?>" style="text-align: right;"><?php echo $v->qty ?></td>
																					<td id="td_total_<?php echo $no; ?>" style="text-align: right;"><?php echo number_format($v->total,0,",",".") ?></td>
																					<td id="td_min_diskon_item_<?php echo $no; ?>" style="text-align: right;"><?php echo number_format($v->min_disc_item,0,",",".") ?></td>
																					<td id="td_min_diskon_all_<?php echo $no; ?>" style="text-align: right;"><?php echo number_format($v->min_disc_all,0,",",".") ?></td>
																					<td id="td_total_refund_<?php echo $no; ?>" style="text-align: right;"><?php echo number_format($v->total_refund,0,",",".") ?></td>
																					
																				</tr> 
																				<?php
																				$pre_subtotal += $v->total_refund;
																				$no++;
																				}
																				?>
																			</tbody>
																			<tfoot>
																				<tr>
																				
																					<td colspan=6></td>
																					<td align="right"><span class="row_header_inv">Total</span></td>
																					<td align="right" id="pre_subtotal"><?php echo number_format($pre_subtotal,0,",",".") ?></td>
																				</tr>
																			</tfoot>
																		</table>
																	
																		
																		
																		
																		
																		
																		
																		
																		
																		
																		
																		
																	</div>
																	</form>
																	<div class="row">
																		<div class="col-sm-6">
																			
																		</div>
																		<div class="col-sm-6 text-right">
																			<button id="masukan_ke_refund" class="btn btn-gede waves-effect waves-light btn-grd-success"> Masukan ke Refund &gt;&gt; </button>
																		</div>
																	</div>
																</div>
																</div>
															
															</div>
															
															<div class="col-md-6">
																<div class="card">
																 <div class="card-header">
																	<h5>Rincian item invoice yang akan di-refund</h5>
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
																	<form id="form_invoice" method="post" action="<?php echo base_url('pembayaran/refund/buat_invoice_refund'); ?>">
																	<div class="table-responsive">
																		<table class="table table-bordered table-hover" id="table_invoice">
																			<thead>
																				<tr>
																					<th scope="col">#</th>
																					<th scope="col">Item</th>
																					<th scope="col" style="text-align: right;">Harga Satuan</th>
																					<th scope="col" style="text-align: right;">Qty</th>
																					<th scope="col" style="text-align: right;">Subtotal</th>
																					<th scope="col" style="text-align: right;">-Diskon Item</th>
																					<th scope="col" style="text-align: right;">-Diskon All</th>
																					<th scope="col" style="text-align: right;">Total</th>
																					
																				</tr>
																			</thead>
																			<tbody>
																				 
																				
																			</tbody>
																			<tfoot>
																				<tr>
																				
																					<td colspan=6>
																						
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
																					<h5>Total Refund</h5>
																				</div>
																				<div class="card-block">
																				
																					<div class="form-group row text-right">
																						<label for="yg_harus_dibayar" class="col-sm-9 col-form-label text-right">Total yang direfund </label>
																						<div class="col-sm-3">
																							<input type="text" class="form-control text-right" id="yg_direfund" name="yg_direfund" value="0" readonly>
																						</div>
																					</div>
																					
																					<div class="cardx border">
																						<div class="card-header">
																							<h5>Jaminan / Asuransi</h5>
																						</div>
																						<div class="card-bodyx">
																							 <div class="form-group row text-right">
																								<label for="total_noncash" class="col-sm-9 col-form-label text-right">Refund Asuransi </label>
																								<div class="col-sm-3">
																									<input type="number" class="form-control text-right" id="total_noncash" name="total_noncash" value="0" readonly>
																								</div>
																							</div>
																						</div>
																					</div>
																					
																					<div class="form-group row text-right">
																						<label for="total_cash" class="col-sm-9 col-form-label text-right">Refund Tunai </label>
																						<div class="col-sm-3">
																							<input type="number" inputmode="numeric" class="form-control text-right" id="total_cash" name="total_cash" value="0" readonly>
																						</div>
																					</div>
																					
																				</div>
																					
																					<div class="form-group row text-right">
																						<div class="col-sm-12">
																							<input type="hidden" name="id_inv" value="<?php echo $data_inv_header->id_inv; ?>" />
																							<input type="hidden" name="id_reg" value="<?php echo $data_inv_header->id_reg; ?>" />
																							<input type="hidden" name="id_asuransi" value="<?php echo $data_inv_header->id_asuransi; ?>" />
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

$('#masukan_ke_refund').click(function(){
	$("#table_invoice tbody").html('');
	var inputs = document.querySelectorAll("#form_pre_refund input[name='chk_id_trx[]']");
	var no = 0;
	var pre_subtotal = 0;
	var subtotal = 0;
	var id_asuransi = "<?php echo $data_inv_header->id_asuransi; ?>";
	var total_asuransi = 0;
	var total_tunai = 0;
	for (i = 0; i < inputs.length; i++) 
	{
		no++;
		var tr_td = "";
		var cheked = $("#chk_id_trx\\["+i+"\\]");
		var val_id_group = $("#val_id_group\\["+i+"\\]").val();
		var val_grup = $("#val_grup\\["+i+"\\]").val();
		var is_farmasi = $("#is_farmasi\\["+i+"\\]").val();
		var td_total_refund = $('#td_total_refund_'+i).html();
		new_subtotal = parseInt(td_total_refund.replace('.','').replace('.',''));
		//alert(new_total);
		var curr_id_group;
		if(cheked.is(':checked'))   // checked
		{
			if(curr_id_group != val_id_group)
			{
				tr_td += '		<tr class="table-info">';
				tr_td += '			<td colspan="8" nowrap><span class="row_header_inv">'+val_grup+'</span></td>';
				tr_td += '		</tr>'; 
				
				curr_id_group = val_id_group;
			}
			
			tr_td += '		<tr>';
			tr_td += '			<td nowrap>'+no+'</td>';
			tr_td += '			<td>'+ $('#td_name_'+i).html() +' <input type="hidden" name="id_group[]" value="'+ val_id_group +'" ></td>';
			tr_td += '			<td style="text-align: right;">'+ $('#td_price_'+i).html() +'<input type="hidden" name="price[]" value="'+ $('#td_price_'+i).html() +'" > <input type="hidden" name="id_trx[]" value="'+ cheked.val() +'" > <input type="hidden" name="is_farmasi[]" value="'+ is_farmasi +'" ></td>';
			tr_td += '			<td style="text-align: right;">'+ $('#td_qty_'+i).html() +' <input type="hidden" name="qty[]" value="'+ $('#td_qty_'+i).html() +'" > </td>';
			tr_td += '			<td style="text-align: right;">'+ $('#td_total_'+i).html() +' <input type="hidden" name="price_total[]" value="'+ $('#td_total_'+i).html() +'" ></td>';
			tr_td += '			<td style="text-align: right;">'+ $('#td_min_diskon_item_'+i).html() +' <input type="hidden" name="min_disc_item[]" value="'+ $('#td_min_diskon_item_'+i).html() +'" ></td>';
			tr_td += '			<td style="text-align: right;">'+ $('#td_min_diskon_all_'+i).html() +' <input type="hidden" name="min_disc_inv[]" value="'+ $('#td_min_diskon_all_'+i).html() +'" ></td>';
			tr_td += '			<td style="text-align: right;">'+ $('#td_total_refund_'+i).html() +' <input type="hidden" name="price_refund[]" value="'+ $('#td_total_refund_'+i).html() +'" ></td>';
			tr_td += '		</tr>'; 
			
			
			$("#table_invoice tbody").append(tr_td);			
			//$('.tr_'+i).remove();			
			subtotal += new_subtotal;
			//console.log(new_subtotal);
			if(id_asuransi!='0001')
				total_asuransi += new_subtotal;
			else
				total_tunai += new_subtotal;
		}			
		else	  // unchecked
		{
			pre_subtotal += new_subtotal;
		}
		
		// --- TOTAL DP BELUM BISA ---
		///total_dp = $("#total_dp").val(0);
	} 
	
	// --- total di kiri
	//$('#pre_subtotal').html(pre_subtotal);
	
	// --- total di kanan
	subtotal = roundToNearest10(subtotal);
	$('#total').html(subtotal);
	
	// --- total di kanan : input box
	//$('#subtotal').val(subtotal);
	$('#yg_direfund').val(subtotal);
	$('#total_cash').val(total_tunai);
	$('#total_noncash').val(total_asuransi);
	
	$('#box_bayar').removeClass('d-none');
});

function roundToNearest10(num) {
  return Math.round(num / 10) * 10;
}


</script>
</body>
</html>