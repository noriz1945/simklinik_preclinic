															<div class="card z-depth-5">
																
																<div class="card-header">
																	<h5>Form Tambah / Edit - Mst_promo</h5>
																	</div>
																	<div class="card-block">
																	
																		<form class="form-horizontal" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
																			
																			
																			<!-- RADIO -->
																			<div class="form-group">
																				<label class="col-sm-4 control-label">Is Aktif</label>
																				<div class="col-sm-12">
																					{radio-is_aktif}
																				</div>
																			</div>
																			
																			<!-- TEXT -->
																			<div class="form-group">
																				<label for="nama_promo" class="col-sm-4 control-label">Nama Promo</label>
																				<div class="col-sm-12">
																					<input type="text" class="form-control" name="nama_promo" id="nama_promo" placeholder="Nama Promo" value="<?php echo $nama_promo; ?>" />
																				</div>
																			</div>
																			
																			<!-- RADIO -->
																			<div class="form-group">
																				<label class="col-sm-4 control-label">Penjamin</label>
																				<div class="col-sm-12">
																					{radio-penjamin}
																				</div>
																			</div>
																			
																			<!-- DATE PICKER -->
																			<div class="form-group">
																				<label for="start" class="col-sm-4 control-label">Start</label>
																				<div class="col-sm-12">			
																					<input type="text" class="form-control" name="start" id="start" placeholder="Pilih Tanggal" value="<?php echo $start; ?>" />
																				</div>
																			</div>
																			
																			<!-- DATE PICKER -->
																			<div class="form-group">
																				<label for="end" class="col-sm-4 control-label">End</label>
																				<div class="col-sm-12">			
																					<input type="text" class="form-control" name="end" id="end" placeholder="Pilih Tanggal" value="<?php echo $end; ?>" />
																				</div>
																			</div>
																			
																			<!-- NUMERIC -->
																			<div class="form-group">
																				<label for="quota" class="col-sm-4 control-label">Quota</label>
																				<div class="col-sm-12">
																					<input type="text" inputmode="numeric" class="form-control" name="quota" id="quota" placeholder="Quota (Isi hanya boleh angka saja)" value="<?php echo $quota; ?>" />
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
																				<label for="created" class="col-sm-4 control-label">Created</label>
																				<div class="col-sm-12">
																					<input type="text" class="form-control" name="created" id="created" placeholder="Created" value="<?php echo $created; ?>" />
																				</div>
																			</div>
																			
																			<!-- RADIO -->
																			<div class="form-group">
																				<label class="col-sm-4 control-label">Item Promo</label>
																				<div class="col-sm-12">
																					{radio-item_promo}
																				</div>
																			</div>
																			
																			
																			<!-- BUTTON -->
																			<!-- Standard button -->
																			<div class="form-group">
																				<div class="col-sm-12">
																					<input type="hidden" name="id_promo" value="<?php echo $id_promo; ?>" />
																					<!-- Provides extra visual weight and identifies the success action in a set of buttons -->
																					<button type="submit" class="btn btn-success">Simpan</button>
																					<button type="button" class="btn btn-default" onClick="javascript: location='<?php echo site_url('mst_promo'); ?>';">Kembali </button>
																				</div>
																			</div>
																		</form>
																		
																	</div>
																
																</div>