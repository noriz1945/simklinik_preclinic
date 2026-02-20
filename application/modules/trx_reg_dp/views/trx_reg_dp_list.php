
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
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('Trx_reg_dp/'); ?>">List Menu</a></li>
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
                                                            <div class="col-md-12 box-shadow--16dp" style="margin-top:30px;">
                                                                <div class="card-header">
																	<h5>Trx_reg_dp</h5>
																</div>
																<div class="card-block">
																	<div class="row">
																		
																		<div class="col-md-3 text-right">
																			<form action="<?php echo site_url('trx_reg_dp/index'); ?>" class="form-inline" method="get">
																				<div class="input-group" style="width:100%;">
																					<input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
																					<span class="input-group-btn">
																					<?php 
																					if ($q <> "")
																					{
																					?> 
																						<a href="<?php echo site_url('trx_reg_dp'); ?>" class="btn btn-default">Reset </a> 
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
																		<table class="table table-bordered table-hover table-striped table-responsive">
																			<thead>
																				<tr>
																					<th scope="col">#</th>
																					<th scope="col"></th>
																					<th scope="col">Id Pasien</th>
																					<th scope="col">Nama Pasien</th>
																					<th scope="col">Id Reg</th>
																					<th scope="col">Tgl. Reg.</th>
																					<th scope="col">Dokter</th>
																					<th scope="col">Penjamin</th>
																					<th scope="col">Total</th>
																					
																				</tr>
																			</thead>
																			<tbody>
																				<?php
																				$no = 0;
																				foreach ($trx_reg_dp_data as $trx_reg_dp)
																				{
																					$no++;
																				?> 
																				<tr>
																					<td><?php echo $no ?></td>
																					<td width="1" nowrap=""> 
																						<?php  
																						echo anchor(site_url("trx_reg_dp/list_dp_pasien/".$trx_reg_dp->id_reg),"<button type=\"button\" class=\"btn btn-success waves-effect\"><i class=\"fa fa-plus\"></i></button>") . " &nbsp; ";
																						?> 
																					</td>
																					<td><?php echo $trx_reg_dp->id_pasien ?></td>
																					<td><?php echo $trx_reg_dp->nama_pasien ?></td>
																					<td><?php echo $trx_reg_dp->id_reg ?></td>
																					<td><?php echo $trx_reg_dp->regdate ?></td>
																					<td><?php echo $trx_reg_dp->dokter ?></td>
																					<td><?php echo $trx_reg_dp->asuransi ?></td>
																					<td><?php echo $trx_reg_dp->total ?></td>
																					
																					<td nowrap> 
																						<?php  
																						
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
					<?php $this->theme->wrapper_close('theme_default'); ?>
					
<?php #$this->theme->script('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-js.php');?>
