
<!doctype html>
<html>
    <head> 
	<?php $this->theme->head('theme_default'); ?> 
	<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>
	<title>Fast Clinic - Bina Medika</title>
	<style>
	/*
	.bg-success {
		background: #00ced1 !important;;;
	}
	*/
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
                                            <h5>Registrasi</h5><span>List 100 Registrasi Terbaru</span>
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
                                                    <div class="container-fluid">
                                                        <!-- Main content -->
                                                        <div class="" style="">
                                                            <div class="col-md-12 box-shadow--16dp">
                                                                <div class="card-header">
																	<h5>Data Registrasi Pasien</h5>
																</div>
																<div class="card-block">
																	<div class="row">
																		<div class="col-md-4"> 
																			<!--
																			<button type="button" class="btn btn-success waves-effect"><?php #echo anchor(site_url('trx_reg/cari_pasien'),'<i class="fa fa-plus"></i> Registrasi Baru', 'style="color:white;"'); ?> </button>
																			-->
																			<?php echo anchor(site_url('trx_reg/tab_reg'),'<button type="button" class="btn btn-success waves-effect"><i class="fa fa-plus"></i> Registrasi Baru </button>', 'style="color:white;"'); ?> 
																		</div>
																		<div class="col-md-4 text-center">
																			<div style="margin-top: 8px" id="message">
																				<!-- Isi Mesage -->
																			</div>
																		</div>
																		<div class="col-md-1 text-right"></div>
																		<div class="col-md-3 text-right">
																			<form action="<?php echo site_url('trx_reg/index'); ?>" class="form-inline" method="get">
																				<div class="input-group" style="width:100%;">
																					<input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
																					<span class="input-group-btn">
																					<?php 
																					if ($q <> "")
																					{
																					?> 
																						<a href="<?php echo site_url('trx_reg'); ?>" class="btn btn-default">Reset </a> 
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
																		<table class="table table-bordered table-striped">
																			<thead>
																				<tr>
																					<th scope="col">No. Registrasi</th>
																					<th scope="col">Waktu Registrasi</th>
																					<th scope="col">No. RM</th>
																					<th scope="col">NIK</th>
																					<th scope="col">Pasien</th>
																					<!-- <th scope="col">Alamat</th> -->
																					<th scope="col">Dokter</th>
																					
																					<!--
																					<th scope="col">Diagnosa Awal / Keluhan</th>
																					<th scope="col">Note</th>
																					<th scope="col">Penanggung</th>
																					-->
																					<th scope="col">Asuransi</th>
																					
																					
																					<!-- <th scope="col">Status</th> -->
																					<th scope="col"></th>
																				</tr>
																			</thead>
																			<tbody>
																				<?php
																				$arr_status = array('Open','Closed');
																				foreach ($trx_reg_data as $trx_reg)
																				{
																				?> 
																				<tr>
																					<td><?php echo $trx_reg->id_reg ?></td>
																					<td><?php echo $trx_reg->regdate ?></td>
																					<td><?php echo $trx_reg->id_pasien ?></td>
																					<td><?php echo $trx_reg->nik ?></td>
																					<td><?php echo $trx_reg->nama_pasien ?></td>
																					<!--
																					<td><?php #echo $trx_reg->address ?></td>
																					-->
																					<td><?php echo $trx_reg->dokter ?></td>
																					
																					<!--
																					<td><?php #echo $trx_reg->diag ?></td>
																					<td><?php #echo $trx_reg->note ?></td>
																					<td><?php #echo $trx_reg->penanggung ?></td>
																					-->
																					
																					<td><?php echo $trx_reg->asuransi ?></td>
																					
																					<!--
																					<td><?php #echo $arr_status[$trx_reg->status] ?></td>
																					-->
																					<td nowrap> 
																						<?php  
																						#echo anchor(site_url("trx_reg/read/".$trx_reg->id_reg),"<img src=\"".base_url('assets/img/doc_read.png')."\" style=\"max-height:20px;\">") . " &nbsp; ";
																						echo anchor(site_url("trx_reg/update/".$trx_reg->id_reg),"<button type=\"button\" class=\"btn btn-warning waves-effect\"><i class=\"fa fa-edit\"></i></button>") . " &nbsp; ";
																						#echo anchor(site_url("trx_reg/delete/".$trx_reg->id_reg),"<img src=\"".base_url('assets/img/doc_delete.png')."\" style=\"max-height:20px;\">","onclick=\"javasciprt: return confirm('Yakin hapus ?');\"");
																						?> 
																						
																					</td>
																				</tr> 
																				<?php
																				}
																				?>
																			</tbody>
																			<tfoot>
																				<tr>
																					
																				</tr>
																			<tfoot>
																		</table>
																	</div>
																	<div class="row">
																		<div class="col-md-6">
																			<a href="#" class="btn btn-success">Total Data : <?php echo $total_rows ?> </a>
																		</div>
																		<div class="col-md-6 text-right"> <?php echo $pagination ?> </div>
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


					
<?php #$this->theme->script('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-js.php');?>
<body>
</html>