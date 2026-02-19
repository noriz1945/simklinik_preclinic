
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
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('./'); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('Pembayaran/'); ?>">List Menu</a></li>
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
                                            
											<div class="col-md-4 offset-md-4">
												<form class="form-horizontal" action="<?php echo site_url('pembayaran/opening_kasir_act'); ?>" method="post" enctype="multipart/form-data">
													<div class="card">
														<div class="container-fluid">
															<!-- Main content -->

															<div class="card-header">
																<h5>Form - Opening Kasir</h5>
															</div>
																<div class="card-block">
																	
																	<div class="jumbotron jumbotron-fluid">
																	  <div class="container">
																		<h1 class="display-4">Opening Kasir</h1>
																		<p class="lead">Sepertinya status kasir kamu masih terbuka dan belum ditutup.</p>
																	  </div>
																	</div>
																	
																	<div class="form-group row">
																		<div class="col-sm-6">
																			<button type="button" class="btn btn-warning" onClick="javascript: location='<?php echo site_url('pembayaran'); ?>';">Kembali </button>
																		</div>
																		<div class="col-sm-6 text-right">
																			<button type="button" class="btn btn-primary" onClick="javascript: location='<?php echo site_url('pembayaran/closing_kasir'); ?>';">Closing Kasir </button>
																		</div>
																	</div>
															   
																</div>
																<!-- /.content -->
																									
														</div>
													</div>
												</form>
                                            </div>
                                        
										</div>
										
										
										
										<div class="row">
                                            
										</div>
										
										
										
										
										
										
										
										
										
                                    </div>
										</div>
                            </div>
                        </div>
					</div>
					<?php $this->theme->wrapper_close('theme_default'); ?>


<?php #$this->theme->script('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-js.php');?>
<script>

</script>