
<!doctype html>
<html>
    <head> 
	<?php $this->theme->head('theme_default'); ?></head> 
	<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>
	<title>Fast Clinic - Bina Medika</title>
	<style>
	.form-group {
		margin-bottom: 0.5em;
	}
	.card .card-header {
		padding: 20px 20px 0;
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
                                            <h5>Form Pembuatan Pembagian Jasa Vendor</h5><span>Menu</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="page-header-breadcrumb">
                                        <ul class=" breadcrumb breadcrumb-title">
                                            <li class="breadcrumb-item"><a href="
											<?php echo base_url('./'); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="
											<?php echo base_url('Trx_jasdor/'); ?>">List Menu</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-body">
										<form id="frm_jasdor" class="" action="<?php echo base_url('v_jasmed/vendor/save') ?>" method="post" enctype="multipart/form-data">
											<div class="row">
												<div class="col-sm-6">		
												
													<div class="card" style="min-height:370px;padding: 0 20px;">
														<div class="card-header">
															<h4>Pilih Vendor & Periode Invoice </h4>
														</div>
														<div class="card-block">
															<h4 class="sub-title"></h4>
																
															<!--
															<div class="form-group">
																<label for="waktu_jasmed" class="col-sm-4 control-label">Jasa medis dibuat pada</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="waktu_jasmed" id="waktu_jasmed" placeholder="Waktu Jasmed" value="<?php echo $waktu_jasmed; ?>" readonly />
																</div>
															</div>
															-->

															<div class="form-group row">
																<label for="id_vendor" class="col-sm-3 control-label">Vendor</label>
																<div class="col-sm-6">
																	<?php echo $dropdown_id_vendor ?>
																</div>
															</div>
															
															<div class="form-group row">
																<label for="periode_start" class="col-sm-3 control-label">Dari</label>
																<div class="col-sm-4">
																	<input type="text" class="form-control" id="periode_start" name="periode_start" placeholder="Dari" value="<?php echo $periode_start?>" required>
																</div>
															</div>
															<div class="form-group row">
																<label for="periode_end" class="col-sm-3 control-label">Sampai</label>
																<div class="col-sm-4">
																	<input type="text" class="form-control" id="periode_end" name="periode_end" placeholder="Sampai" value="<?php echo $periode_end?>" required >
																</div>
															</div>
															
															<!--
															<div class="form-group">
																<label for="subtotal" class="col-sm-4 control-label">Subtotal</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="subtotal" id="subtotal" placeholder="Subtotal" value="<?php echo $subtotal; ?>" readonly />
																</div>
															</div>
															<div class="form-group">
																<label for="total" class="col-sm-4 control-label">Total</label>
																<div class="col-sm-12">
																	<input type="text" class="form-control" name="total" id="total" placeholder="Total" value="<?php echo $total; ?>" readonly />
																</div>
															</div>
															-->															
															<!-- BUTTON -->
															<!-- Standard button -->
															<div class="form-group row">
																<div class="col-sm-4">
																	<button type="button" class="btn btn-default" onClick="javascript: location='<?php echo site_url('v_jasmed/vendor'); ?>';">Kembali </button>
																</div>
																<div class="col-sm-4 text-right">
																	<button type="submit" class="btn btn-success">Tampilkan pembagian vendor</button>
																</div>
															</div>
																
														</div>
																
																
																
													</div>
															
														
												</div>
												
												<div class="col-sm-6">		
												
													<div class="card d-none" id="box_rekap_share" style="min-height:370px;padding: 0 20px;">
														<div class="card-header">
															<h4>Rekap Pembagian Vendor</h4>
														</div>
														<div class="card-block">
															<h4 class="sub-title"></h4>
															<div class="form-group row">
																<label for="r_id_vendor" class="col-sm-4 col-form-label">Id. Vendor</label>
																<div class="col-sm-8">
																  <input type="text" class="form-control" id="r_id_vendor" name="r_id_vendor" readonly >
																</div>
															</div>
															<div class="form-group row">
																<label for="r_nama_nakes" class="col-sm-4 col-form-label">Nama Vendor</label>
																<div class="col-sm-8">
																  <input type="text" class="form-control" id="r_nama_vendor" name="r_nama_vendor" readonly >
																</div>
															</div>
															<div class="form-group row">
																<label for="r_periode_start" class="col-sm-4 control-label">Periode tindakan (dari)</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control" id="r_periode_start" name="r_periode_start" placeholder="Dari" value="<?php echo $periode_start?>" readonly>
																</div>
															</div>
															<div class="form-group row">
																<label for="r_periode_end" class="col-sm-4 control-label">Periode tindakan (Sampai)</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control" id="r_periode_end" name="r_periode_end" placeholder="Sampai" value="<?php echo $periode_end?>" readonly >
																</div>
															</div>
															<div class="form-group row">
																<label for="r_total_text" class="col-sm-4 control-label">Total (Rp)</label>
																<div class="col-sm-8">
																	<input type="text" class="form-control" id="r_total_text" name="r_total_text" placeholder="total" value="0" readonly >
																	<input type="hidden" class="form-control" id="r_total" name="r_total" placeholder="total" value="0" readonly >
																</div>
															</div>
															<!-- Standard button -->
															<div class="form-group row">
																<div class="col-sm-4">
																	<button type="button" class="btn btn-default" onClick="javascript: location='<?php echo site_url('v_jasmed/vendor/add'); ?>';">Ulangi </button>
																</div>
																<div class="col-sm-4 text-right">
																	<button type="button" id="simpan" class="btn btn-success">Simpan</button>
																</div>
															</div>
																
														</div>
																
																
																
													</div>
															
														
												</div>
												
												
												<div class="col-sm-12" id="box_detail">
													<!-- BOX_DETAIL DISINI -->
												</div>
											</div>
										</form>
										
									</div>
								</div> 
							</div>
						</div>
					<?php #$this->theme->wrapper_close('theme_default'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php #$this->theme->script('theme_default'); ?> 
<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-js.php');?> 

<script>
$('select[name="id_vendor"]').attr("required","required");

$('#periode_start').datepicker({
	dateFormat: "yy-mm-dd",
	changeMonth: true,
	changeYear: true,
	//yearRange: "-1:+1", // million years ago
	maxDate: 0,
});
$('#periode_start').datepicker( "option", "dateFormat", "yy-mm-dd" );

$('#periode_end').datepicker({
	dateFormat: "yy-mm-dd",
	changeMonth: true,
	changeYear: true,
	//yearRange: "-1:+1", // million years ago
	maxDate: 0,
});
$('#periode_end').datepicker( "option", "dateFormat", "yy-mm-dd" );
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/dt/jq-3.7.0/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/fh-3.4.0/r-2.5.0/datatables.min.js"></script>

<script>
$('#frm_jasdor').on('submit', function(e){
	e.preventDefault();

	$.ajax({
		url: '<?php echo site_url('v_jasmed/vendor/add_detail'); ?>',
		type : 'POST',
		data : $('#frm_jasdor').serialize(),
		success: function(html) {
			$('#box_detail').html(html);
			$('#box_rekap_share').removeClass('d-none');
			
			var val_id_vendor = $('#id_vendor').find(":selected").val();
			$('#r_id_vendor').val(val_id_vendor);
			
			var text_id_vendor = $('#id_vendor').find(":selected").text();
			$('#r_nama_vendor').val(text_id_vendor);
			
			var periode_start = $('#periode_start').val();
			$('#r_periode_start').val(periode_start);
			
			var periode_end = $('#periode_end').val();
			$('#r_periode_end').val(periode_end);
			
			var total = $('#table_total_share_vendor').val();
			$('#r_total').val(total);
			$('#r_total_text').val(new Intl.NumberFormat('id-ID').format(total));
		}
	});
});

/*
$("#simpan").on("click", function() {
	$.ajax({
		url		: '<?php echo site_url('v_jasmed/vendor/save'); ?>',
		type 	: 'POST',
		data 	: $('#frm_jasmed').serialize(),
		success	: function(html) {}
	});
});
*/
$("#simpan").on("click", function() {
	$('#frm_jasdor').submit();
});
</script>
