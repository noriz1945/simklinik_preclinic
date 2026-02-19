
<!doctype html>
<html>
    <head> 
	<?php $this->theme->head('theme_default'); ?> 
	<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>
	<title>Fast Clinic - Bina Medika</title>
	<style>
	/*
	input{
		text-transform: uppercase;
	}
	*/
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
                                            <h5>1. Pilih Tenaga Kesehatan</h5><span>List 100 Registrasi Terbaru</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="page-header-breadcrumb">
                                        <ul class=" breadcrumb breadcrumb-title">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('./'); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('trx_reg/'); ?>">Registrasi</a></li>
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
												
												
													<div class="card-block tab-icon">
														<div class="row">
															<div class="col-md-12">
																<div class="sub-title">Silahkan Pilih Tab</div>
																<ul class="nav nav-tabs md-tabs " role="tablist">
																	
																	<li class="nav-item">
																		<a class="nav-link" data-toggle="tab" href="#tab_pas_lama" id="id_pas_lama" role="tab" aria-selected="false">
																			<i class="icofont icofont-ui-user "></i>Pasien Lama </a>
																		<div class="slide"></div>
																	</li>
																	<li class="nav-item">
																		<a class="nav-link" data-toggle="tab" href="#tab_pas_baru" id="id_pas_baru" role="tab" aria-selected="false">
																			<i class="icofont icofont-ui-user"></i>Pasien Baru </a>
																		<div class="slide"></div>
																	</li>
																	<li class="nav-item">
																		<a class="nav-link" data-toggle="tab" href="#tab_pas_aps" id="id_pas_aps" role="tab" aria-selected="false">
																			<i class="icofont icofont-ui-user"></i>Pasien APS </a>
																		<div class="slide"></div>
																	</li>
																</ul>
																<div class="tab-content card-block">
																	
																	<!-- START CONTENT TAB PASIEN LAMA -->
																	<div class="tab-pane" id="tab_pas_lama" role="tabpanel">
																		A
																	</div>
																	<!-- END CONTENT TAB PASIEN LAMA -->
																	
																	<!-- START CONTENT TAB PASIEN BARU -->
																	<div class="tab-pane" id="tab_pas_baru" role="tabpanel">
																		B
																	</div>
																	<!-- END CONTENT TAB PASIEN BARU -->
																	
																	<!-- START CONTENT TAB PASIEN APS -->
																	<div class="tab-pane" id="tab_pas_aps" role="tabpanel">
																		C
																	</div>
																	<!-- END CONTENT TAB PASIEN APS -->
																</div>
															</div>
															
														</div>
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

</div></div></div></div>

					
<?php #$this->theme->script('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-js.php');?>
<script>
$('#id_pas_lama').on('click',function(e){
	$.ajax({
		url: '<?php echo site_url('trx_reg/inner_pasien_lama_list'); ?>',
		dataType: 'html',
		success: function(html) {
			$('#tab_pas_lama').html(html);
		}
	});	
});

$('#id_pas_baru').on('click',function(e){
	$.ajax({
		url: '<?php echo site_url('mst_pasien/inner_pasien_baru_reg/yes'); ?>',
		dataType: 'html',
		success: function(html) {
			$('#tab_pas_baru').html(html);
		}
	});	
});

$('#id_pas_aps').on('click',function(e){
	$.ajax({
		url: '<?php echo site_url('trx_reg/inner_pasien_aps_reg'); ?>',
		dataType: 'html',
		success: function(html) {
			$('#tab_pas_aps').html(html);
		}
	});	
});

</script>
<body>
</html>