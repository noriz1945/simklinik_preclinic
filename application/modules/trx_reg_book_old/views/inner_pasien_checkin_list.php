												<div class="card">
                                                    <div class="container-fluid">
                                                        <!-- Main content -->
                                                        <div class="" style="">
                                                            <div class="col-md-12 box-shadow--16dp">
																<!--
                                                                <div class="card-header">
																	<h5>Pilih registrasi dari data pasien lama atau klik pasien baru</h5>
																</div>
																-->
																<div class="card-block">
																	<div class="row">
																		<div class="col-md-4">
																			<!--
																			<button type="button" class="btn btn-success waves-effect"><?php #echo anchor(site_url('mst_pasien/create/redir_regis'),'<i class="fa fa-plus"></i> Pasien Baru', 'style="color:white;"'); ?> </button>
																			-->
																		</div>
																		<div class="col-md-12 text-right">
																			<div style="margin-top: 8px" id="message">
																				<!-- Isi Mesage -->
																			</div>
																		
																			<form id="form_pas_lama_cari" class="form-inline">
																				
																				<label class="sr-only" for="cr_id_pasien">No.RM</label>
																				<input type="text" class="form-control mb-2 mr-sm-2" id="cr_id_pasien" name="cr_id_pasien" placeholder="No.RM">
																				
																				<label class="sr-only" for="cr_nama">Nama</label>
																				<input type="text" class="form-control mb-2 mr-sm-2" id="cr_nama" name="cr_nama" placeholder="Nama">
																				
																				<label class="sr-only" for="cr_nik">Nik</label>
																				<input type="numeric" class="form-control mb-2 mr-sm-2" id="cr_nik" name="cr_nik" placeholder="Nik">
																				
																				<label class="sr-only" for="cr_birthdate">Tgl. Lahir</label>
																				<input type="text" class="form-control mb-2 mr-sm-2" id="cr_birthdate" name="cr_birthdate" placeholder="Tgl. Lahir">
																				
																				<button class="btn btn-success" type="submit">Cari</button>
																			</form>
																		</div>
																	</div>
																	<div class="table-responsive">
																		<table class="table table-bordered table-hover table-striped table-responsive">
																			<thead>
																				<tr>
																					<th scope="col">Aksi</th>
																					<th scope="col">No. RM</th>
																					<th scope="col">Nama Pasien</th>
																					<th scope="col">NIK/No.KTP</th>
																					<th scope="col">Tgl. Lahir</th>
																					<th scope="col">Tempat Lahir</th>
																					<th scope="col">J. Kelamin</th>
																					
																					<th scope="col">Alamat</th>
																					
																					
																					<th scope="col">No.Hp</th>
																					<th scope="col">Email</th>
																					<!--
																					<th scope="col">Propinsi</th>
																					-->
																					<th scope="col">Kota</th>
																					<!--
																					<th scope="col">Kecamatan</th>
																					<th scope="col">Kelurahan</th>
																					<th scope="col">Kodepos</th>
																					-->
																					
																					
																					<th scope="col">Catatan</th>
																					
																					<th scope="col">Aktif</th>
																					
																					
																				</tr>
																			</thead>
																			<tbody>
																				<?php
																				foreach ($mst_pasien_data as $mst_pasien)
																				{
																				?> 
																				<tr>
																					<td nowrap> 
																						<?php  
																						
																						#echo anchor(site_url("trx_reg/inner_reg_pasien_lama/".$mst_pasien->id_pasien),"<img src=\"".base_url('assets/img/register-button.png')."\" style=\"max-height:20px;\">") . " &nbsp; ";
																						
																						?>
																						<a onclick="javascript : reg_pasien_lama('<?php echo $mst_pasien->id_pasien; ?>');" href="#"><img src="<?php echo base_url("assets/img/register-button.png"); ?>" style="max-height:25px;"></a>
																					</td>
																					<td><?php echo $mst_pasien->id_pasien ?></td>
																					
																					
																					<td><?php echo $mst_pasien->name ?></td>
																					<td><?php echo $mst_pasien->nik ?></td>
																					<td><?php echo $mst_pasien->tgl_lahir ?></td>
																					<td><?php echo $mst_pasien->birthplace ?></td>
																					<td><?php echo $mst_pasien->gender ?></td>
																					
																					<td><?php echo $mst_pasien->address ?></td>
																					
																					<td><?php echo $mst_pasien->hp ?></td>
																					<td><?php echo $mst_pasien->email ?></td>
																					<!--
																					<td><?php #echo $mst_pasien->id_propinsi ?></td>
																					-->
																					<td><?php echo $mst_pasien->kota ?></td>
																					<!--
																					<td><?php #echo $mst_pasien->id_kecamatan ?></td>
																					<td><?php #echo $mst_pasien->id_kelurahan ?></td>
																					<td><?php #echo $mst_pasien->kodepos ?></td>
																					-->
																					
																					<td><?php echo $mst_pasien->description ?></td>
																					
																					<td><?php echo $mst_pasien->aktif ?></td>
																					
																					
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
																		<div class="col-md-6">
																			
																		</div>
																		<div class="col-md-6 text-right"> <?php #echo $pagination ?> </div>
																	</div>
																	
																</div>
															</div>
                                                        </div>
                                                        <!-- /.content -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
<script>

function reg_pasien_lama(id_pasien)
{
	//tambahan fungsi rihan 15-12-2024
	$('.getidpasien_booknyah').val(id_pasien);
	//end tambahan fungsi rihan 15-12-2024
	$("#tab_pas_lama").load("<?php echo site_url('trx_reg_book/trx_reg/inner_pasien_lama_reg/'); ?>"+id_pasien);
}


$( document ).ready(function() {
	
	$('#cr_birthdate').datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		changeYear: true,
		yearRange: "-100:+0", // last hundred years
		maxDate: 0,
	});
	$('#cr_birthdate').datepicker( "option", "dateFormat", "yy-mm-dd" );
	
	$("#form_pas_lama_cari").submit(function(e) {
		e.preventDefault(); // avoid to execute the actual submit of the form.
		var form = $(this);
		$.ajax({
			type: "POST",
			url: "<?php echo site_url('trx_reg_book/trx_reg/inner_pasien_lama_list'); ?>",
			data: form.serialize(), // serializes the form's elements.
			success: function(data)
			{
			  $("#tab_pas_lama").html(data);
			}
		});
	});	
	
});
</script>