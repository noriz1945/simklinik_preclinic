
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
		width : 70px;
	}
	.input-lg{
		width : 300px;
	}
	
	.input-number{
		text-align : right;
		padding-right : 5px;
	}
	.input-qty{
		text-align : center;
	}
	#tbody_tbl_tindakan .form-control {
		font-size: 7px;
		padding: .375rem .35rem;
	}
	.no-border {
		border: 0;
		background-color: rgba(255, 255, 255, 0) !important;
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
													
													<div class="col-md-3">
														<div class="card z-depth-5">
															<div class="card-header">
																<h5>Form Tambah / Edit - Paket</h5>
															</div>
															<div class="card-block">
																
																
																<!-- RADIO -->
																<div class="form-group">
																	<label class="col-sm-4 control-label">Aktif</label>
																	<div class="col-sm-12">
																		{radio-aktif}
																	</div>
																</div>
																
																<!-- TEXT -->
																<div class="form-group">
																	<label for="name" class="col-sm-4 control-label">Nama Paket</label>
																	<div class="col-sm-12">
																		<input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>PAKET GLOWING 3D" />
																	</div>
																</div>
																
																<!-- TEXT -->
																<div class="form-group d-none">
																	<label for="id_type" class="col-sm-4 control-label">Id Type</label>
																	<div class="col-sm-12">
																		<input type="text" class="form-control" name="id_type" id="id_type" placeholder="Id Type" value="<?php echo $id_type; ?>" />
																	</div>
																</div>
																
																<!-- RADIO -->
																<div class="form-group">
																	<label class="col-sm-4 control-label">Penjamin</label>
																	<div class="col-sm-12">
																		{radio-penjamin}
																	</div>
																</div>
																
																<!-- NUMERIC -->
																<div class="form-group">
																	<label for="duration" class="col-sm-12 control-label">Jumlah Kunjungan (Dalam paket ini)</label>
																	<div class="col-sm-12">
																		<input type="number" class="form-control" name="duration" id="duration" placeholder="Duration" value="<?php echo $duration; ?>4" />
																	</div>
																</div>
																
																<!-- NUMERIC -->
																<div class="form-group">
																	<label for="price" class="col-sm-4 control-label">Tarif Total</label>
																	<div class="col-sm-12">
																		<input type="number" class="form-control" name="price" id="price" placeholder="Price" value="<?php echo $price; ?>" readonly />
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
																
																	<!-- BUTTON -->
																	<!-- Standard button -->
																	<div class="form-group">
																		<div class="col-sm-12">
																			<input type="hidden" name="id_paket" value="<?php echo $id_paket; ?>" />
																			<!-- Provides extra visual weight and identifies the success action in a set of buttons -->
																			<button type="submit" class="btn btn-success">Simpan</button>
																			<button type="button" class="btn btn-default" onClick="javascript: location='<?php echo site_url('mst_paket'); ?>';">Kembali </button>
																		</div>
																	</div>
																
															</div>
														</div>
													</div>
													
													<div class="col-md-9">
														<!-- <div class="col-md-12"> -->
														
															<div id="card_tbl" class="card z-depth-5">
																<div class="card-header">
																	<h5>Rincian jasa/tindakan/obat/alkes yang termasuk ke dalam paket</h5>
																</div>
																<div class="card-block">
																	<table id="tbl_list_tindakan" class="table table-bordered table-striped">
																		<thead>
																			<tr>
																				<td>#</td>
																				<td>Kunjungan ke :</td>
																				<td>Jasa/Tindakan</td>
																				<td>Harga/Tarif<br>(Satuan)</td>
																				<td>Diskon(%)<br>(Paket)</td>
																				<td>Harga/Tarif<br>(Satuan Paket)</td>
																				<td>Qty</td>
																				<td>Harga/Tarif<br>(Subtotal)</td>
																				<td>Harga/Tarif<br>(Subtotal Paket)</td>
																				<td></td>
																			</tr>
																		</thead>
																		<tbody id="tbody_tbl_tindakan">
																		  <tr id="det_tr_1">
																			<td><input type="text" id="rowno[1]" name="rowno[]" class="form-control input-xs no-border" value="1" readonly >
																				<input type="text" id="det_id_group[1]" name="det_id_group[]" class="form-control input-xs " value="1" readonly=""></td>
																			<td>
																			  <input type="number" id="det_no_kunj[1]" name="det_no_kunj[]" class="form-control input-sm" value="0" min="0" max="10">
																			</td>
																			<td>
																			  <input type="hidden" id="det_id_act[1]" name="det_id_act[]" class="form-control input-sm" value="00040" readonly="">
																			  <input type="text" id="det_id_act_txt[1]" name="det_id_act_txt[]" class="form-control input-lg" value="Ekstraksi Gigi Molar 3 Atas" readonly="">
																			</td>
																			<td>
																			  <input type="text" id="det_price_ori[1]" name="det_price_ori[]" class="form-control input-md input-number" value="800000" readonly="">
																			</td>
																			<td nowrap="">
																			  <input type="number" id="det_disc_pkt[1]" name="det_disc_pkt[]" class="form-control input-sm disc_pkt" value="0" min="0" max="100" data-id="1">
																			</td>
																			<td>
																			  <input type="text" id="det_price_pkt[1]" name="det_price_pkt[]" class="form-control input-md input-number price_pkt" value="800000" data-id="1">
																			</td>
																			<td>
																			  <input type="number" id="det_qty[1]" name="det_qty[]" class="form-control input-sm input-qty qty" value="1" data-id="1">
																			</td>
																			<td>
																			  <input type="text" id="det_price_subtotal_ori[1]" name="det_price_subtotal_ori[]" class="form-control input-md input-number" value="800000" readonly="">
																			</td>
																			<td>
																			  <input type="text" id="det_price_subtotal_pkt[1]" name="det_price_subtotal_pkt[]" class="form-control input-md input-number" value="800000" readonly>
																			</td>
																			<td align="center">
																			  <button type="button" class="btn btn-danger waves-effect" onclick="javascript : delete_det_tr('1');">
																				<i class="fa fa-trash"></i>
																			  </button>
																			</td>
																		  </tr>
																		  <tr id="det_tr_2">
																			<td><input type="text" id="rowno[2]" name="rowno[]" class="form-control input-xs no-border" value="2" readonly >
																				<input type="text" id="det_id_group[2]" name="det_id_group[]" class="form-control input-xs " value="1" readonly=""></td>
																			<td>
																			  <input type="number" id="det_no_kunj[2]" name="det_no_kunj[]" class="form-control input-sm" value="0" min="0" max="10">
																			</td>
																			<td>
																			  <input type="hidden" id="det_id_act[2]" name="det_id_act[]" class="form-control input-sm" value="00041" readonly="">
																			  <input type="text" id="det_id_act_txt[2]" name="det_id_act_txt[]" class="form-control input-lg" value="Ekstraksi Gigi Molar 3 Atas + Penyulit" readonly="">
																			</td>
																			<td>
																			  <input type="text" id="det_price_ori[2]" name="det_price_ori[]" class="form-control input-md input-number" value="1250000" readonly="">
																			</td>
																			<td nowrap="">
																			  <input type="number" id="det_disc_pkt[2]" name="det_disc_pkt[]" class="form-control input-sm disc_pkt" value="0" min="0" max="100" data-id="2">
																			</td>
																			<td>
																			  <input type="text" id="det_price_pkt[2]" name="det_price_pkt[]" class="form-control input-md input-number price_pkt" value="1250000" data-id="2">
																			</td>
																			<td>
																			  <input type="number" id="det_qty[2]" name="det_qty[]" class="form-control input-sm input-qty qty" value="1" data-id="2">
																			</td>
																			<td>
																			  <input type="text" id="det_price_subtotal_ori[2]" name="det_price_subtotal_ori[]" class="form-control input-md input-number" value="1250000" readonly="">
																			</td>
																			<td>
																			  <input type="text" id="det_price_subtotal_pkt[2]" name="det_price_subtotal_pkt[]" class="form-control input-md input-number" value="1250000" readonly>
																			</td>
																			<td align="center">
																			  <button type="button" class="btn btn-danger waves-effect" onclick="javascript : delete_det_tr('2');">
																				<i class="fa fa-trash"></i>
																			  </button>
																			</td>
																		  </tr>
																		  <tr id="det_tr_3">
																			<td><input type="text" id="rowno[3]" name="rowno[]" class="form-control input-xs no-border" value="3" readonly >
																				<input type="text" id="det_id_group[3]" name="det_id_group[]" class="form-control input-xs " value="1" readonly=""></td>
																			<td>
																			  <input type="number" id="det_no_kunj[3]" name="det_no_kunj[]" class="form-control input-sm" value="0" min="0" max="10">
																			</td>
																			<td>
																			  <input type="hidden" id="det_id_act[3]" name="det_id_act[]" class="form-control input-sm" value="00055" readonly="">
																			  <input type="text" id="det_id_act_txt[3]" name="det_id_act_txt[]" class="form-control input-lg" value="Root Planning / Gigi " readonly="">
																			</td>
																			<td>
																			  <input type="text" id="det_price_ori[3]" name="det_price_ori[]" class="form-control input-md input-number" value="125000" readonly="">
																			</td>
																			<td nowrap="">
																			  <input type="number" id="det_disc_pkt[3]" name="det_disc_pkt[]" class="form-control input-sm disc_pkt" value="0" min="0" max="100" data-id="3">
																			</td>
																			<td>
																			  <input type="text" id="det_price_pkt[3]" name="det_price_pkt[]" class="form-control input-md input-number price_pkt" value="125000" data-id="3">
																			</td>
																			<td>
																			  <input type="number" id="det_qty[3]" name="det_qty[]" class="form-control input-sm input-qty qty" value="1" data-id="3">
																			</td>
																			<td>
																			  <input type="text" id="det_price_subtotal_ori[3]" name="det_price_subtotal_ori[]" class="form-control input-md input-number" value="125000" readonly="">
																			</td>
																			<td>
																			  <input type="text" id="det_price_subtotal_pkt[3]" name="det_price_subtotal_pkt[]" class="form-control input-md input-number" value="125000" readonly>
																			</td>
																			<td align="center">
																			  <button type="button" class="btn btn-danger waves-effect" onclick="javascript : delete_det_tr('3');">
																				<i class="fa fa-trash"></i>
																			  </button>
																			</td>
																		  </tr>
																		  
																		  <tr id="det_tr_4">
																			<td>
																				<input type="text" id="rowno[4]" name="rowno[]" class="form-control input-xs no-border" value="4" readonly="">
																				<input type="text" id="det_id_group[4]" name="det_id_group[]" class="form-control input-xs " value="2" readonly="">
																			</td>
																			<td>
																				<input type="number" id="det_no_kunj[4]" name="det_no_kunj[]" class="form-control input-sm" value="0" min="0" max="10">
																			</td>
																			<td>
																				<input type="hidden" id="det_id_act[4]" name="det_id_act[]" class="form-control input-sm" value="00025" readonly="">
																				<input type="text" id="det_id_act_txt[4]" name="det_id_act_txt[]" class="form-control input-lg" value="Amoxsan 500 MG Tablet" readonly="">
																			</td>
																			<td>
																				<input type="text" id="det_price_ori[4]" name="det_price_ori[]" class="form-control input-md input-number" value="5594" readonly="">
																			</td>
																			<td nowrap="">
																				<input type="number" id="det_disc_pkt[4]" name="det_disc_pkt[]" class="form-control input-sm disc_pkt" value="0" min="0" max="100" data-id="4">
																			</td>
																			<td>
																				<input type="text" id="det_price_pkt[4]" name="det_price_pkt[]" class="form-control input-md input-number price_pkt" value="5594" data-id="4">
																			</td>
																			<td>
																				<input type="number" id="det_qty[4]" name="det_qty[]" class="form-control input-sm input-qty qty" value="1" data-id="4">
																			</td>
																			<td>
																				<input type="text" id="det_price_subtotal_ori[4]" name="det_price_subtotal_ori[]" class="form-control input-md input-number" value="5594" readonly="">
																			</td>
																			<td>
																				<input type="text" id="det_price_subtotal_pkt[4]" name="det_price_subtotal_pkt[]" class="form-control input-md input-number" value="5594" readonly="">
																			</td>
																			<td align="center">
																				<button type="button" class="btn btn-danger waves-effect" onclick="javascript : delete_det_tr('4');">
																					<i class="fa fa-trash"></i>
																				</button>
																			</td>
																		</tr>
																		<tr id="det_tr_5">
																			<td>
																				<input type="text" id="rowno[5]" name="rowno[]" class="form-control input-xs no-border" value="5" readonly="">
																				<input type="text" id="det_id_group[5]" name="det_id_group[]" class="form-control input-xs " value="2" readonly="">
																			</td>
																			<td>
																				<input type="number" id="det_no_kunj[5]" name="det_no_kunj[]" class="form-control input-sm" value="0" min="0" max="10">
																			</td>
																			<td>
																				<input type="hidden" id="det_id_act[5]" name="det_id_act[]" class="form-control input-sm" value="00169" readonly="">
																				<input type="text" id="det_id_act_txt[5]" name="det_id_act_txt[]" class="form-control input-lg" value="Paracetamol Tablet 500 MG" readonly="">
																			</td>
																			<td>
																				<input type="text" id="det_price_ori[5]" name="det_price_ori[]" class="form-control input-md input-number" value="466" readonly="">
																			</td>
																			<td nowrap="">
																				<input type="number" id="det_disc_pkt[5]" name="det_disc_pkt[]" class="form-control input-sm disc_pkt" value="0" min="0" max="100" data-id="5">
																			</td>
																			<td>
																				<input type="text" id="det_price_pkt[5]" name="det_price_pkt[]" class="form-control input-md input-number price_pkt" value="466" data-id="5">
																			</td>
																			<td>
																				<input type="number" id="det_qty[5]" name="det_qty[]" class="form-control input-sm input-qty qty" value="1" data-id="5">
																			</td>
																			<td>
																				<input type="text" id="det_price_subtotal_ori[5]" name="det_price_subtotal_ori[]" class="form-control input-md input-number" value="466" readonly="">
																			</td>
																			<td>
																				<input type="text" id="det_price_subtotal_pkt[5]" name="det_price_subtotal_pkt[]" class="form-control input-md input-number" value="466" readonly="">
																			</td>
																			<td align="center">
																				<button type="button" class="btn btn-danger waves-effect" onclick="javascript : delete_det_tr('5');">
																					<i class="fa fa-trash"></i>
																				</button>
																			</td>
																		</tr>
																		</tbody>
																		<tfoot>
																			<tr>
																				<td colspan="4" align="right">Set diskon global (%) : </td>
																				<td><input type="number" id="disc_global" name="disc_global" class="form-control input-sm disc_pkt" value="0" ></td>
																				<td></td>
																				<td align="right">TOTAL</td>
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
								<label class="col-sm-2 col-form-label">Item Farmasi</label>
								<div class="col-sm-10">
									<input type="hidden" class="form-control" id="id_fa"  name="id_fa">
									<input type="text" class="form-control" id="txt_id_fa"  name="txt_id_fa" placeholder="auto complete item farmasi">
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Tarif</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="price_fa"  name="price_fa" value="0" readonly>
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
				<button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Tutup</button>
				<button type="button" id="butt_tambahkan_farmasi" class="btn btn-primary waves-effect waves-light">Tambahkan</button>
			</div>
		</div>
		</form>
	</div>
</div>

<?php #$this->theme->script('theme_default'); ?> 

<script>
var rowno = 3;

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
	//var qty 		= $('#qty');				var qty_val 		= $('#qty').val();
	var tr_td = "";
	
	tr_td += '	<tr id="det_tr_'+rowno+'">';
	tr_td += '		<td><input type="text" id="rowno['+rowno+']" name="rowno[]" class="form-control input-xs no-border" value="'+rowno+'" readonly ></td>';
	tr_td += '		<td><input type="text" id="det_id_group['+rowno+']" name="det_id_group[]" class="form-control input-xs no-border" value="1" readonly ></td>';
	tr_td += '		<td><input type="number" id="det_no_kunj['+rowno+']" name="det_no_kunj[]" class="form-control input-sm" value="0" min="0" max="10" ></td>';
	tr_td += '		<td>';
	tr_td += '			<input type="hidden" id="det_id_act['+rowno+']" name="det_id_act[]" class="form-control input-sm" value="'+id_act_val+'" readonly >';
	tr_td += '			';
	tr_td += '			<input type="text" id="det_id_act_txt['+rowno+']" name="det_id_act_txt[]" class="form-control input-lg" value="'+txt_id_act_val+'" readonly >';
	tr_td += '			</td>';
	tr_td += '		<td><input type="text" id="det_price_ori['+rowno+']" name="det_price_ori[]" class="form-control input-md input-number" value="'+price_act_val+'" readonly ></td>';
	tr_td += '		<td nowrap><input type="number" id="det_disc_pkt['+rowno+']" name="det_disc_pkt[]" class="form-control input-sm disc_pkt" value="0" min="0" max="100" data-id="'+rowno+'" ></td>';
	tr_td += '		<td><input type="text" id="det_price_pkt['+rowno+']" name="det_price_pkt[]" class="form-control input-md input-number price_pkt" value="'+price_act_val+'" data-id="'+rowno+'" ></td>';
	tr_td += '		<td><input type="number" id="det_qty['+rowno+']" name="det_qty[]" class="form-control input-sm input-qty qty" value="1" data-id="'+rowno+'" ></td>';
	tr_td += '		<td><input type="text" id="det_price_subtotal_ori['+rowno+']" name="det_price_subtotal_ori[]" class="form-control input-md input-number" value="'+price_act_val+'" readonly ></td>';
	tr_td += '		<td><input type="text" id="det_price_subtotal_pkt['+rowno+']" name="det_price_subtotal_pkt[]" class="form-control input-md input-number" value="'+price_act_val+'" readonly ></td>';
	tr_td += '		<td align="center"><button type="button" class="btn btn-danger waves-effect" onclick="javascript : delete_det_tr(\''+rowno+'\');"><i class="fa fa-trash"></i></button></td>';
	tr_td += '	</tr>'; 
			
			
	$("#tbody_tbl_tindakan").append(tr_td);	

	$('#large-Modal_tindakan').modal('hide');

	$("#price_act").val('0');
	$("#txt_id_act").val('');
	$("#id_act").val('');
	
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
		
		//$('#qty').focus();
	}
});

$('#butt_tambahkan_farmasi').on( "click", function(e) {
	rowno++;
	
	var id_act 		= $('#id_fa');				var id_act_val 		= $('#id_fa').val();
	var txt_id_act 	= $('#txt_id_fa');			var txt_id_act_val 	= $('#txt_id_fa').val();
	var price_act 	= $('#price_fa');			var price_act_val 	= Math.round($('#price_fa').val());
	//var qty 		= $('#qty');				var qty_val 		= $('#qty').val();
	var tr_td = "";
	
	tr_td += '	<tr id="det_tr_'+rowno+'">';
	tr_td += '		<td><input type="text" id="rowno['+rowno+']" name="rowno[]" class="form-control input-xs no-border" value="'+rowno+'" readonly >';
	tr_td += '		<input type="text" id="det_id_group['+rowno+']" name="det_id_group[]" class="form-control input-xs no-border" value="2" readonly ></td>';
	tr_td += '		<td><input type="number" id="det_no_kunj['+rowno+']" name="det_no_kunj[]" class="form-control input-sm" value="0" min="0" max="10" ></td>';
	tr_td += '		<td>';
	tr_td += '			<input type="hidden" id="det_id_act['+rowno+']" name="det_id_act[]" class="form-control input-sm" value="'+id_act_val+'" readonly >';
	tr_td += '			';
	tr_td += '			<input type="text" id="det_id_act_txt['+rowno+']" name="det_id_act_txt[]" class="form-control input-lg" value="'+txt_id_act_val+'" readonly >';
	tr_td += '			</td>';
	tr_td += '		<td><input type="text" id="det_price_ori['+rowno+']" name="det_price_ori[]" class="form-control input-md input-number" value="'+price_act_val+'" readonly ></td>';
	tr_td += '		<td nowrap><input type="number" id="det_disc_pkt['+rowno+']" name="det_disc_pkt[]" class="form-control input-sm disc_pkt" value="0" min="0" max="100" data-id="'+rowno+'" ></td>';
	tr_td += '		<td><input type="text" id="det_price_pkt['+rowno+']" name="det_price_pkt[]" class="form-control input-md input-number price_pkt" value="'+price_act_val+'" data-id="'+rowno+'" ></td>';
	tr_td += '		<td><input type="number" id="det_qty['+rowno+']" name="det_qty[]" class="form-control input-sm input-qty qty" value="1" data-id="'+rowno+'" ></td>';
	tr_td += '		<td><input type="text" id="det_price_subtotal_ori['+rowno+']" name="det_price_subtotal_ori[]" class="form-control input-md input-number" value="'+price_act_val+'" readonly ></td>';
	tr_td += '		<td><input type="text" id="det_price_subtotal_pkt['+rowno+']" name="det_price_subtotal_pkt[]" class="form-control input-md input-number" value="'+price_act_val+'" readonly ></td>';
	tr_td += '		<td align="center"><button type="button" class="btn btn-danger waves-effect" onclick="javascript : delete_det_tr(\''+rowno+'\');"><i class="fa fa-trash"></i></button></td>';
	tr_td += '	</tr>'; 
			
			
	$("#tbody_tbl_tindakan").append(tr_td);	

	$('#large-Modal_farmasi').modal('hide');

	$("#price_fa").val('0');
	$("#txt_id_fa").val('');
	$("#id_fa").val('');
	
	hitung_ulang();
	
});
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
		
		var det_price_subtotal_ori 	= parseInt(det_price_ori) * parseInt(det_qty);
		var det_price_subtotal_pkt 	= parseInt(det_price_pkt) * parseInt(det_qty);
		
		$("#det_price_subtotal_ori\\["+i+"\\]").val(det_price_subtotal_ori);
		$("#det_price_subtotal_pkt\\["+i+"\\]").val(det_price_subtotal_pkt);
		
		subtotal_tunai += det_price_subtotal_ori;
		subtotal_paket += det_price_subtotal_pkt;
	});
	$("#subtotal_tunai").val(subtotal_tunai);
	$("#subtotal_paket").val(subtotal_paket);
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
	var diskon 			= (parseInt(det_price_ori) * parseInt(persentase))/100;
	var det_price_pkt 	= parseInt(det_price_ori) - parseInt(diskon);
	
	$("#det_price_pkt\\["+idx+"\\]").val(det_price_pkt);
	
	var det_price_pkt 	= $("#det_price_pkt\\["+idx+"\\]").val();
	var det_qty 		= $("#det_qty\\["+idx+"\\]").val();
	var det_price_subtotal_pkt 	= parseInt(det_price_pkt) * parseInt(det_qty);
	
	$("#det_price_subtotal_pkt\\["+idx+"\\]").val(det_price_subtotal_pkt);
	
	hitung_ulang();
});

$(document).on("change",".price_pkt",function(){
	var idx = $(this).data("id");
	
	var price_pkt = $(this).val();
	
	if(price_pkt < (0))
		$("#det_price_pkt\\["+idx+"\\]").val(0);
	if(price_pkt== 'NaN')
		$("#det_price_pkt\\["+idx+"\\]").val(0);
	if(price_pkt== 'undefined')
		$("#det_price_pkt\\["+idx+"\\]").val(0);
	
	//alert(idx);
	var det_price_pkt 	= $("#det_price_pkt\\["+idx+"\\]").val();
	var det_price_ori 	= $("#det_price_ori\\["+idx+"\\]").val();
	
	var diskon 			= 100 - (parseInt(det_price_pkt) / parseInt(det_price_ori))*100;
	var det_disc_pkt 	= $("#det_disc_pkt\\["+idx+"\\]").val(diskon);
	
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
		
		$("#det_price_pkt\\["+i+"\\]").val(det_price_pkt);
		
		var det_price_pkt 	= $("#det_price_pkt\\["+i+"\\]").val();
		var det_qty 		= $("#det_qty\\["+i+"\\]").val();
		var det_price_subtotal_pkt 	= parseInt(det_price_pkt) * parseInt(det_qty);
		
		$("#det_price_subtotal_pkt\\["+i+"\\]").val(det_price_subtotal_pkt);
		
	});

	hitung_ulang();
});

function delete_det_tr(idx)
{
	if(window.confirm('Hapus item ini ?')) $('#det_tr_'+idx).remove();
	hitung_ulang();
}
hitung_ulang();
</script>