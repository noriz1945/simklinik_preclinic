
<!doctype html>
<html>
    <head> 
	<?php $this->theme->head('theme_default'); ?> 
	<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>
	<style>
	.list_reg {
	  height:100vh;
	  overflow-y: scroll;
	}
	.btn {
		font-size: 12px;
		padding: 6px 14px;
		margin-right : 5px;
		min-width : 50px;
	}
	.table td, .table th {
		padding: 0.8rem .50rem;
	}
	tr td {
		vertical-align: middle !important;
	}
	.clickable
	{
	  cursor: pointer
	}
	.padding-expand-div{
		padding : 10px 20px 25px 20px;
		border : #ccc 1px solid;
	}
	.row {
		flex-wrap: nowrap;
	}
	.yourTableClass tr:nth-child(4n+1) td, .yourTableClass tr:nth-child(4n+2) td {
	  background: rgba(64,153,255,.1);
	}
	.pcoded[theme-layout="horizontal"] .page-header {
		margin-top: 70px;
	}
	.page-header.card {;
		margin: 5px 35px;
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
                                            <h5>Pembayaran</h5><span>List Pembayaran / Tagihan / Deposit / Refund</span>
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
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="container-fluid">
                                                        <!-- Main content -->
                                                        <div class="" style="">
                                                            <div class="col-md-12 box-shadow--16dp">
															<!-- 
                                                                <div class="card-header">
																	<h5>Data Registrasi Pasien</h5> 
																</div>
															-->
																<div class="card-block">
																	<div class="row">
																		
																		<div class="col-md-9">																			
																			<table>
																				<tr>
																					<td><button type="button" class="btn btn-success waves-effect"><i class="fa fa-plus"></i></button> Buat invoice</td>
																					<td width="15">&nbsp;</td>
																					<td><button type="button" class="btn btn-success waves-effect"><i class="fa fa-print"></i></button> Print invoice (POS)</td>
																					<td width="15">&nbsp;</td>
																					<td><button type="button" class="btn btn-warning waves-effect"><i class="fa fa-plus"></i></button> Tambah Deposit</td>
																					<td width="15">&nbsp;</td>
																					<td><button type="button" class="btn btn-warning waves-effect"><i class="fa fa-print"></i></button> Print Deposit (POS)</td>
																					<td width="15">&nbsp;</td>
																					<!-- <td><button type="button" c
																					<!-- <td><button type="button" class="btn btn-default waves-effect"><i class="fa fa-print"></i></button> Print invoice (Laser)</td> -->
																					<td width="15">&nbsp;</td>
																					<td><button type="button" class="btn btn-danger waves-effect"><i class="fa fa-plus"></i></button> Buat invoice Refund</td>
																					<td width="15">&nbsp;</td>
																					<td><button type="button" class="btn btn-danger waves-effect"><i class="fa fa-print"></i></button> Print invoice Refund (POS)</td>
																				</tr>
																			</table>
																		</div>

																		<div class="col-md-3 text-right">
																			<form action="<?php echo site_url('pembayaran/index'); ?>" class="form-inline" method="get">
																				<div class="input-group" style="width:100%;">
																					<input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
																					<span class="input-group-btn">
																					<?php 
																					if ($q <> "")
																					{
																					?> 
																						<a href="<?php echo site_url('pembayaran'); ?>" class="btn btn-default">Reset </a> 
																					<?php
																					}
																					?> 
																					<button class="btn btn-success" type="submit">Cari</button>
																					</span>
																				</div>
																			</form>
																		</div>
																	</div>
																	<div class="table-responsive">
																		<table class="table table-bordered table-stripedx yourTableClass">
																			<thead>
																				<tr>
																					<th scope="col">#</th>
																					<th scope="col">Pasien</th>
																					<th scope="col">Reg/Aps</th>
																					<th scope="col">No. Registrasi</th>
																					<th scope="col">Waktu Registrasi</th>
																					<th scope="col">No. RM</th>
																					<th scope="col">Tunai/<br>Asuransi</th>
																					<th scope="col">Dokter</th>
																				</tr>
																			</thead>
																			<tbody>
																				<?php
																				$arr_reg_aps = array('','<i style="color:purple; font-weight:bold;">APS</i>');
																				foreach ($data_reg as $k => $v)
																				{
																				?> 
																				<tr data-toggle="collapse" data-target="#accordion<?php echo $k; ?>" class="clickable" data-href="#">
																					<td><?php echo $k+1 ?></td>
																					<td><?php echo $v->nama_pasien ?></td>
																					<td>
																						<?php echo $arr_reg_aps[$v->is_reg_aps] ?>
																					</td>
																					<td><?php echo $v->id_reg ?></td>
																					<td><?php echo $v->regdate ?></td>
																					<td><?php echo $v->id_pasien ?></td>
																					<td><?php echo $v->asuransi ?></td>
																					<td><?php echo $v->dokter ?></td>
																					<td nowrap>
																						
																					</td>
																				</tr> 
																				<tr>
																					<td colspan="10" style="padding:0">
																						<div id="accordion<?php echo $k; ?>" class="collapse">
																							<div class="row" style="min-height: 10px;">
																								<div class="col-md-3 padding-expand-div">
																									Invoice : 	<?php  
																													echo anchor(site_url("pembayaran/trx_open/".$v->id_reg),"<button type=\"button\" class=\"btn btn-success waves-effect\"><i class=\"fa fa-plus\"></i></button>") . " &nbsp;  &nbsp; ";
																												?>
																												<?php
																												if(!empty($v->inv))
																												{
																													foreach($v->inv as $kk => $vv)
																													{
																														echo '<button type="button" class="btn btn-success waves-effect" onClick="javascript : openPopUp(\''. $vv->id_inv .'\');"><i class="fa fa-print"></i></button>' . ""; 
																														#echo "<br>";
																														echo '<button type="button" class="btn btn-default waves-effect" onClick="javascript : openPopUp2(\''. $vv->id_inv .'\');"><i class="fa fa-print"></i></button>' . " &nbsp; &nbsp;"; 
																														if(strtotime($v->regdate) > strtotime('0 days')) {
																															#echo "<br>";
																															echo '<button type="button" onClick="location.replace(\''. base_url('pembayaran/refund/add/').$vv->id_inv.'\')" class="btn btn-danger waves-effect"><i class="fa fa-plus"></i></button> &nbsp;'; 
																														}
																													}
																												}
																												if(!empty($v->inv))
																												{
																													echo "<br> Refund (Aksi) : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ";
																													foreach($v->inv as $kk => $vv)
																													{
																														if(strtotime($vv->invdate) > strtotime('-1 days')) {
																															#echo "<br>";
																															echo '<button type="button" onClick="location.replace(\''. base_url('pembayaran/refund/add/').$vv->id_inv.'\')" class="btn btn-danger waves-effect"><i class="fa fa-plus"></i></button> '; 
																														}
																													}
																												}
																												?>
																								</div>
																								<div class="col-md-3 padding-expand-div">
																									Deposit : 	<?php
																													echo anchor(site_url("trx_reg_dp/list_dp_pasien/".$v->id_reg),"<button type=\"button\" class=\"btn btn-warning waves-effect\"><i class=\"fa fa-plus\"></i></button>") . " &nbsp; ";
																												?>
																												<?php
																												if(!empty($v->id_trx_dp))
																												{
																													foreach($v->id_trx_dp as $kk => $vv)
																													{
																														echo '<button type="button" class="btn btn-warning waves-effect" onClick="javascript : openPopUp_deposit(\''. $vv->id_trx .'\',\'Deposit '.$kk.'\',0);"><i class="fa fa-print"></i></button>'; 
																													}
																												}
																												?>
																								</div>
																								<div class="col-md-3 padding-expand-div">
																									Refund (Print) : 	<?php
																													if(!empty($v->inv))
																													{
																														if(!empty($v->inv_refund))
																														{
																															foreach($v->inv_refund as $kk => $vv)
																															{
																																echo '<button type="button" class="btn btn-danger waves-effect" onClick="javascript : openPopUp_refund(\''. $vv->id_refund .'\');"><i class="fa fa-print"></i></button>'; 
																																
																															}
																														}
																													}
																												?>
																								</div>
																								<div class="col-md-3 padding-expand-div">
																									Treatment/Nakes/Operator : <?php 
																													echo anchor(site_url("treatment/index/".$v->id_reg),"<button type=\"button\" class=\"btn btn-primary waves-effect\"><i class=\"fa fa-edit\"></i></button>") . " &nbsp; ";
																													?>
																													<button type="button" 
																																				class="btn btn-primary waves-effect show_chk_treat" 
																																				data-toggle="modal" 
																																				data-target="#treatment-Modal"
																																				data-id-reg="<?php echo $v->id_reg ?>">
																													  <i class="fa fa-check-square"></i>
																													</button>
																								</div>
																							</div>
																						</div>
																					</td>
																				</tr>
																				<?php
																				}
																				?>
																			</tbody>
																			<tfoot>
																				<tr>
																					
																				</tr>
																			</tfoot>
																		</table>
																	</div>
																	<div class="row">
																		<div class="col-md-12">
																			
																			<table>
																				<tr>
																					
																				</tr>
																			</table>
																			
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
                                </div>
                            </div>
                        </div>
					</div>
					<?php #$this->theme->wrapper_close('theme_default'); ?>
</div>
</div>
</div>
</div>

<!--refund-->
<div class="modal fade" id="large-Modal" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Refund</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<h5>Data Pasien</h5>
<div class="form-group row">
<div class="col-sm-2">
<label>ID Reg : </label>
</div>
<div class="col-sm-3">
<label class="id_reg_set"></label>
</div>
<div class="col-sm-2">
<label>Tanggal Reg : </label>
</div>
<div class="col-sm-5">
<label class="tgl_reg_set"></label>
</div>
</div>

<div class="form-group row">
<div class="col-sm-2">
<label>ID Pasien : </label>
</div>
<div class="col-sm-3">
<label class="id_pasien_set"></label>
</div>
<div class="col-sm-2">
<label>Nama : </label>
</div>
<div class="col-sm-5">
<label class="nama_pasien_set"></label>
</div>
</div>

<div class="card text-white card-primary">
<div class="card-header">Total Refund</div>
<div class="card-body">
<h5 class="card-title det_total_harga_refund"></h5>
</div>
</div>

<div class="form-group row">
<div class="col-sm-2">
<label>Password : </label>
</div>
<div class="col-sm-6">
<input type="password" class="form-control kon_pass" id="kon_pass" name="kon_pass" placeholder="Konfirmasi Password">
</div>
</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
<button type="button" class="btn btn-primary waves-effect waves-light refund_auth">Refund</button>
</div>
</div>
</div>
</div>
<!--end refund-->

<!-- Modal -->
<div class="modal fade" id="treatment-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">List Treatment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="div_treatment"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php #$this->theme->script('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-js.php');?>

<script>
$('#treatment-Modal').on('show.bs.modal', function (e) {
	var id_reg = $(e.relatedTarget).data('id-reg');
	//alert('oke nih : ' + id_reg);
	$.get("<?php echo base_url('treatment/inner_load_treatment/'); ?>"+id_reg+"/modal" , function( data ) {
		$("#div_treatment").html(data);
	});
});
</script>

<script>
//var baseUrl = '/fastclinic_binamedika/';
var baseUrl = window.location.origin + '/' + window.location.pathname.split ('/') [1] + '/';
// ------------ CETAK INVOICE -----------------------------------------------
function openPopUp(id_inv) {
	let url = '<?php echo base_url('pembayaran/cetak_invoice_pos/') ?>'+id_inv;
	let height = 600;
	let width = 400;
	var left = ( screen.width - width ) / 2;
	var top = ( screen.height - height ) / 2;
	var newWindow = window.open( url, "Invoice POS", 'resizable = yes, width=' + width + ', height=' + height + ', top='+ top + ', left=' + left);
}

function openPopUp2(id_inv) {
	let url = '<?php echo base_url('pembayaran/cetak_invoice/') ?>'+id_inv;
	let height = 600;
	let width = 1000;
	var left = ( screen.width - width ) / 2;
	var top = ( screen.height - height ) / 2;
	var newWindow = window.open( url, "Invoice Large", 'resizable = yes, width=' + width + ', height=' + height + ', top='+ top + ', left=' + left);
}
var id_inv_auto_print = '<?php echo $id_inv ?>';
if(id_inv_auto_print!='') openPopUp(id_inv_auto_print);

// ------------ CETAK INVOICE REFUND ----------------------------------------
function openPopUp_refund(id_inv_refund) {
	let url = '<?php echo base_url('pembayaran/refund/cetak_invoice_refund_pos/') ?>'+id_inv_refund;
	let height = 600;
	let width = 400;
	var left = ( screen.width - width ) / 2;
	var top = ( screen.height - height ) / 2;
	var newWindow = window.open( url, "center window", 'resizable = yes, width=' + width + ', height=' + height + ', top='+ top + ', left=' + left);
}
var id_refund_auto_print = '<?php echo $id_refund ?>';
if(id_refund_auto_print!='') openPopUp_refund(id_refund_auto_print);

// ------------ CETAK INVOICE DEPOSIT ----------------------------------------
function openPopUp_deposit(id_trx,title,posisi) {
	let url = '<?php echo base_url('trx_reg_dp/cetak_invoice_dp_pos/') ?>'+id_trx;
	let height = 600;
	let width = 400;
	var left = (( screen.width - width ) / 2) + posisi;
	var top = ( screen.height - height ) / 2;
	var newWindow = window.open( url, title, 'resizable = yes, width=' + width + ', height=' + height + ', top='+ top + ', left=' + left);
}
var id_trx_auto_print = '<?php echo $id_trx1 ?>';
if(id_trx_auto_print!='') openPopUp_deposit(id_trx_auto_print,'Invoice Deposit 1',(-205));

var id_trx_auto_print = '<?php echo $id_trx2 ?>';
if(id_trx_auto_print!='') openPopUp_deposit(id_trx_auto_print,'Invoice Deposit 2',205);

var id_ret_dp_auto_print = '<?php echo $id_ret_dp ?>';
if(id_ret_dp_auto_print!='') openPopUp_deposit(id_ret_dp_auto_print,'Bukti Refund Deposit',(405));

</script>

<script>
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////28112023
 //Format uang
 formatMoney();
  function formatMoney(amount, decimalCount = 0/*ganti 2 kalo mau pake decimal*/, decimal = ".", thousands = ",") {
  try {
    decimalCount = Math.abs(decimalCount);
    decimalCount = isNaN(decimalCount) ? 2 : decimalCount;
  const negativeSign = amount < 0 ? "-" : "";
  let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
  let j = (i.length > 3) ? i.length % 3 : 0;
    return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
  } catch (e) {
    console.log(e)
  }
 };
 //End Format uang

 $('.refundset').click(function(){
    var pass_set 	= $('#kon_pass').val('');
	var id_inv		= $(this).attr('data-id-inv');
	var reg			= $(this).attr('data-id-reg');
	var regdate		= $(this).attr('data-id-regdate');
	var id_pasien	= $(this).attr('data-id-id_pasien');
	var nama_pasien	= $(this).attr('data-id-nama_pasien');

	$.ajax({
      url : baseUrl+"pembayaran/pembayaran/refundproses",
      method : "POST",
      data : {id_inv:id_inv},
      async : true,
      dataType : 'json',
      success: function(datares){
        var harga        = datares;
		$('.det_total_harga_refund').html("Rp. "+formatMoney(harga,0));
		$('.id_reg_set').html(reg);
		$('.tgl_reg_set').html(regdate);
		$('.id_pasien_set').html(id_pasien);
		$('.nama_pasien_set').html(nama_pasien);

		$('.refund_auth').click(function() {
			var pass_set = $('#kon_pass').val();
			if(pass_set==''){
  			Swal.fire(
  			    'Konfirmasi ?',
  			    'Konfirmasi Password tidak boleh kosong',
  			    'question'
  			  )
  			  return false;
  			}else{
 				/////
 				Swal.fire({
 				  title: 'Refund',
 				  text: 'Refund A/N :'+nama_pasien,
 				  showDenyButton: true,
 				  showCancelButton: false,
 				  confirmButtonText: 'Yes',
 				  denyButtonText: 'No',
 				  customClass: {
 				    actions: 'my-actions',
 				    //cancelButton: 'order-1 right-gap',
 				    confirmButton: 'order-2',
 				    denyButton: 'order-3',
 				  }
 				  }).then((result) => {
 				  if (result.isConfirmed) {

					//cek password
					$.ajax({
 				           url : baseUrl+"pembayaran/pembayaran/cekpassword",
 				           method : "POST",
 				           data : {pass_set:pass_set},
 				           async : true,
 				           dataType : 'json',
 				           success: function(datares){
							if(datares==null){
								Swal.fire({
								  icon: "error",
								  title: "Konfirmasi",
								  text: "Password Salah"//,
								  //footer: '<a href="#">Why do I have this issue?</a>'
								});
							}else{
								swal.fire('Refund!','Refund A/N :'+nama_pasien+' Berhasil!', 'success').then(function(){ 
								$.ajax({
								  url : baseUrl+"pembayaran/pembayaran/refundprosesupdate",
								  method : "POST",
								  data : {id_inv:id_inv,reg:reg},
								  async : true,
								  dataType : 'json',
								  success: function(datares){
									location.reload(); 
								  }
								});
					   			});
							}
 				           }
 				    });
					//end cek password

				  
 				    } else if (result.isDenied) {
 				      Swal.fire('Batal!', 'Batal Konfirmasi!', 'info')
 				    }
 				})
 				////
  			}//END VALIDASI OTENTIFIKASI               
 		});
      }
    });
	
 });

 
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////END 28112023
</script>
<body>
</html>