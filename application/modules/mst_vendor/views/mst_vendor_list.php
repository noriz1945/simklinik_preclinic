
<!doctype html>
<html>
    <head> 
	<?php $this->theme->head('theme_default'); ?> 
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
                                            <h5>Page Title</h5><span>Menu</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="page-header-breadcrumb">
                                        <ul class=" breadcrumb breadcrumb-title">
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('./'); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="<?php echo base_url('Mst_vendor/'); ?>">List Menu</a></li>
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
																	<h5>Mst_vendor</h5>
																</div>
																<div class="card-block">
																	<div class="row">
																		<div class="col-md-4"> 
																		<!-- <?php #echo anchor(site_url('mst_vendor/create'),'<i class="fa fa-plus"></i> Tambah Data', 'btn btn-success waves-effect"'); ?>  -->
																		<!-- <button type="button" class="btn btn-success waves-effect" data-toggle="modal" data-target="#large-Modal"><i class="fa fa-plus"></i>Jenis Tindakan</button> -->
																		<button type="button" class="btn btn-success waves-effect"><?php echo anchor(site_url('mst_vendor/create'),'<i class="fa fa-plus"></i> Tambah Data', 'style="color:white;"'); ?> </button>
																		</div>
																		<div class="col-md-4 text-center">
																			<div style="margin-top: 8px" id="message">
																				<!-- Isi Mesage -->
																			</div>
																		</div>
																		<div class="col-md-1 text-right"></div>
																		<div class="col-md-3 text-right">
																			<form action="<?php echo site_url('mst_vendor/index'); ?>" class="form-inline" method="get">
																				<div class="input-group" style="width:100%;">
																					<input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
																					<span class="input-group-btn">
																					<?php 
																					if ($q <> "")
																					{
																					?> 
																						<a href="<?php echo site_url('mst_vendor'); ?>" class="btn btn-default">Reset </a> 
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
																					
																					<th scope="col">Vendor</th>
																					<th scope="col">Alamat</th>
																					<th scope="col">Nama Kontak</th>
																					<th scope="col">No Telp</th>
																					<th scope="col">No Hp Wa</th>
																					<th scope="col">Creator</th>
																					<th scope="col">Created</th>
																					<th scope="col">Updater</th>
																					<th scope="col">Updated</th>
																				</tr>
																			</thead>
																			<tbody>
																				<?php
																				foreach ($mst_vendor_data as $mst_vendor)
																				{
																				?> 
																				<tr>
																					
																					<td><?php echo $mst_vendor->vendor ?></td>
																					<td><?php echo $mst_vendor->alamat ?></td>
																					<td><?php echo $mst_vendor->nama_kontak ?></td>
																					<td><?php echo $mst_vendor->no_telp ?></td>
																					<td><?php echo $mst_vendor->no_hp_wa ?></td>
																					<td><?php echo $mst_vendor->creator ?></td>
																					<td><?php echo $mst_vendor->created ?></td>
																					<td><?php echo $mst_vendor->updater ?></td>
																					<td><?php echo $mst_vendor->updated ?></td>
																					<td nowrap> 
																						<?php  
																						#echo anchor(site_url("mst_vendor/read/".$mst_vendor->id_vendor),"<img src=\"".base_url('assets/img/doc_read.png')."\" style=\"max-height:20px;\">") . " &nbsp; ";
																						echo anchor(site_url("mst_vendor/update/".$mst_vendor->id_vendor),"<img src=\"".base_url('assets/img/doc_edit.png')."\" style=\"max-height:20px;\">") . " &nbsp; ";
																						echo anchor(site_url("mst_vendor/delete/".$mst_vendor->id_vendor),"<img src=\"".base_url('assets/img/doc_delete.png')."\" style=\"max-height:20px;\">","onclick=\"javasciprt: return confirm('Yakin hapus ?');\"");
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
					<?php $this->theme->wrapper_close('theme_default'); ?>
					
<?php #$this->theme->script('theme_default'); ?>
