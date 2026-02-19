	<style type="text/css">
		/* Important part */
		.modal-dialog {
			width: 1280px;
			overflow-y: initial !important
		}

		.modal-body {
			height: 550px;
			overflow-y: auto;
		}
	</style>
	<div class="container-fluid">
		<!-- Start Page Content -->
		<div class="row">
			<div class="col-lg-12">
				<div class="card card-outline-success">
					<div class="card-body">
						<form id="frm_order_rehab" action="<?php echo base_url(). 'fisio/rehabmedik/tambah_aksi/'.$optional_page; ?>" method="post">
							<!-- Container fluid  -->
							<div class="container-fluid">
								<!-- Start Page Content -->
								<div class="row">
									<div class="col-lg-12">
										<div class="card card-outline-success">
											<div class="card-header">
												<h4 class="m-b-0 text-white">Formulir Permohonan Fisiotherapi</h4>
											</div>
											<?php foreach($mst_dokter_dta as $drinput) ?>
											<input hidden type="text" name="id_dokter" class="form-control"
												value="<?php echo $drinput['id_dokter']; ?>" readonly>
											<input hidden type="text" name="name" class="form-control"
												value="<?php echo $drinput['name']; ?>" readonly>


											<?php foreach($datPasien as $u)  ?>
											<input hidden type="text" name="rm" class="form-control"
												value="<?php echo $u->id_pasien; ?>" placeholder="ID Pasien" readonly>
											<input hidden type="text" name="id_reg" class="form-control"
												value="<?php echo $u->id_reg; ?>" hidden="" readonly>
											<input hidden type="text" name="nama" class="form-control"
												value="<?php echo $u->name; ?>" placeholder="Nama Pasien" readonly>
											<!--line 1-->
											<h4></h4>
											<!--line 1.2-->												
											<div class="card-body">
												<div class="form-body">
													<div class="form-group row">
													<label for="uname" class="col-sm-2 control-label"
                                                        style="color:black" style="color:black">Tanggal Periksa</label>
														<div class="col-sm-3">
															<input type="text" name="tgl_periksa" id="tgl_periksa" class="form-control tanggalfisio" placeholder="Tanggal Periksa" required>
															</div>
													</div>
												</div>
											</div>
											<div class="card-body">
												<div class="form-body">
													<div class="form-group row">
														<div class="col-sm-1">
															<div class="input-group has-warning">
																<input type="checkbox" class="form-control" name="rwip"
																	value="1">
															</div>
														</div>
														<label for="uname" class="col-sm-2 control-label"
															style="color:black" style="color:black">Rawat Inap</label>

														<label for="uname" class="col-sm-1 control-label"
															style="color:black" style="color:black">Alergi</label>


														<div class="col-sm-1">
															<div class="input-group has-warning">
																<input type="checkbox" class="form-control" name="alergi"
																	value="0">
															</div>
														</div>
														<label for="uname" class="col-sm-1 control-label"
															style="color:black" style="color:black">Tidak </label>

														<label for="uname" class="col-sm-4 control-label"
															style="color:black" style="color:black">Jika Ya,
															Tempelkan Label Alergi Disini</label>

													</div>
												</div>
											</div>
											<!--line 2-->
											<div class="card-body">
												<div class="form-body">
													<div class="form-group row">
														<div class="col-sm-1">
															<div class="input-group has-warning">
																<input type="checkbox" class="form-control" name="rwjn">
															</div>
														</div>
														<label for="uname" class="col-sm-2 control-label"
															style="color:black" style="color:black">Rawat Jalan</label>

														<label for="uname" class="col-sm-1 control-label"
															style="color:black" style="color:black">&nbsp;</label>


														<div class="col-sm-1">
															<div class="input-group has-warning">
																<input type="checkbox" class="form-control" name="alergi"
																	value="1">
															</div>
														</div>
														<label for="uname" class="col-sm-1 control-label"
															style="color:black" style="color:black">Ya </label>

														<label for="uname" class="col-sm-2 control-label"
															style="color:black" style="color:black">&nbsp;</label>

													</div>
												</div>
											</div>
											<!--line 3-->
											<div class="card-body">
												<div class="form-body">
													<div class="form-group row">
														<label for="uname" class="col-sm-2 control-label"
															style="color:black" style="color:black">Diagnosa</label>

														<div class="col-sm-10">
															<div class="input-group has-warning">
																<textarea class="form-control" id="diag" name="diag"
																	cols="4" rows="8" placeholder="Diagnosa..."></textarea>
															</div>
														</div>
													</div>
												</div>
											</div>
											<!--line 4-->
											<div class="card-body">
												<div class="form-body">
													<div class="form-group row">
														<label for="uname" class="col-sm-6 control-label"
															style="color:black" style="color:black">Electhroteraphy</label>

														<label for="uname" class="col-sm-6 control-label"
															style="color:black" style="color:black">Massage &
															Manipulation</label>
													</div>
												</div>
											</div>
											<!--line 5-->
											<div class="card-body">
												<div class="form-body">
													<div class="form-group row">
														<div class="col-sm-1">
															<div class="input-group has-warning">
																<input type="checkbox" class="form-control" name="miwadi"
																	value="1">
															</div>
														</div>
														<label for="uname" class="col-sm-1 control-label"
															style="color:black" style="color:black">59011</label>
														<label for="uname" class="col-sm-4 control-label"
															style="color:black" style="color:black">Micro Wave
															Diathermy</label>

														<div class="col-sm-1">
															<div class="input-group has-warning">
																<input type="checkbox" class="form-control" name="masman"
																	value="1">
															</div>
														</div>
														<label for="uname" class="col-sm-1 control-label"
															style="color:black" style="color:black">59101</label>
														<label for="uname" class="col-sm-4 control-label"
															style="color:black" style="color:black">Massage &
															Manipulation</label>
													</div>
												</div>
											</div>
											<!--line 6-->
											<div class="card-body">
												<div class="form-body">
													<div class="form-group row">
														<div class="col-sm-1">
															<div class="input-group has-warning">
																<input type="checkbox" class="form-control" name="ultthe"
																	value="1">
															</div>
														</div>
														<label for="uname" class="col-sm-1 control-label"
															style="color:black" style="color:black">59021</label>
														<label for="uname" class="col-sm-4 control-label"
															style="color:black" style="color:black">UltraSonic
															Therapy</label>

														<label for="uname" class="col-sm-6 control-label"
															style="color:black"
															style="color:black">Excercisetherapy</label>
													</div>
												</div>
											</div>
											<!--line 7-->
											<div class="card-body">
												<div class="form-body">
													<div class="form-group row">
														<div class="col-sm-1">
															<div class="input-group has-warning">
																<input type="checkbox" class="form-control" name="infthe"
																	value="1">
															</div>
														</div>
														<label for="uname" class="col-sm-1 control-label"
															style="color:black" style="color:black">59031</label>
														<label for="uname" class="col-sm-4 control-label"
															style="color:black" style="color:black">Inferential
															Therapy</label>

														<div class="col-sm-1">
															<div class="input-group has-warning">
																<input type="checkbox" class="form-control" name="genexe"
																	value="1">
															</div>
														</div>
														<label for="uname" class="col-sm-1 control-label"
															style="color:black" style="color:black">59301</label>
														<label for="uname" class="col-sm-4 control-label"
															style="color:black" style="color:black">General
															Exercise</label>
													</div>
												</div>
											</div>
											<!--line 8-->
											<div class="card-body">
												<div class="form-body">
													<div class="form-group row">
														<div class="col-sm-1">
															<div class="input-group has-warning">
																<input type="checkbox" class="form-control" name="elesti"
																	value="1">
															</div>
														</div>
														<label for="uname" class="col-sm-1 control-label"
															style="color:black" style="color:black">59041</label>
														<label for="uname" class="col-sm-4 control-label"
															style="color:black" style="color:black">Electrical
															Stimulation</label>

														<div class="col-sm-1">
															<div class="input-group has-warning">
																<input type="checkbox" class="form-control" name="pasexe"
																	value="1">
															</div>
														</div>
														<label for="uname" class="col-sm-1 control-label"
															style="color:black" style="color:black">59311</label>
														<label for="uname" class="col-sm-4 control-label"
															style="color:black" style="color:black">Pasive Exercise</label>
													</div>
												</div>
											</div>
											<!--line 9-->
											<div class="card-body">
												<div class="form-body">
													<div class="form-group row">
														<label for="uname" class="col-sm-6 control-label"
															style="color:black" style="color:black">Actinotherapy</label>

														<div class="col-sm-1">
															<div class="input-group has-warning">
																<input type="checkbox" class="form-control" name="actexe"
																	value="1">
															</div>
														</div>
														<label for="uname" class="col-sm-1 control-label"
															style="color:black" style="color:black">59321</label>
														<label for="uname" class="col-sm-4 control-label"
															style="color:black" style="color:black">Active Exercise</label>
													</div>
												</div>
											</div>
											<!--line 10-->
											<div class="card-body">
												<div class="form-body">
													<div class="form-group row">
														<div class="col-sm-1">
															<div class="input-group has-warning">
																<input type="checkbox" class="form-control" name="infrera"
																	value="1">
															</div>
														</div>
														<label for="uname" class="col-sm-1 control-label"
															style="color:black" style="color:black">59201</label>
														<label for="uname" class="col-sm-4 control-label"
															style="color:black" style="color:black">Infra Red
															Radiation</label>

														<div class="col-sm-1">
															<div class="input-group has-warning">
																<input type="checkbox" class="form-control" name="wallbar"
																	value="1">
															</div>
														</div>
														<label for="uname" class="col-sm-1 control-label"
															style="color:black" style="color:black">59331</label>
														<label for="uname" class="col-sm-4 control-label"
															style="color:black" style="color:black">Walking
															Bar/Walker/Crutch/Tripod</label>
													</div>
												</div>
											</div>
											<!--line 11-->
											<div class="card-body">
												<div class="form-body">
													<div class="form-group row">
														<label for="uname" class="col-sm-6 control-label"
															style="color:black" style="color:black">Traction</label>


														<div class="col-sm-1">
															<div class="input-group has-warning">
																<input type="checkbox" class="form-control" name="brepos"
																	value="1">
															</div>
														</div>
														<label for="uname" class="col-sm-1 control-label"
															style="color:black" style="color:black">59341</label>
														<label for="uname" class="col-sm-4 control-label"
															style="color:black" style="color:black">Breating, Postural
															Drainage</label>
													</div>
												</div>
											</div>
											<!--line 12-->
											<div class="card-body">
												<div class="form-body">
													<div class="form-group row">
														<div class="col-sm-1">
															<div class="input-group has-warning">
																<input type="checkbox" class="form-control" name="certra"
																	value="1">
															</div>
														</div>
														<label for="uname" class="col-sm-1 control-label"
															style="color:black" style="color:black">59401</label>
														<label for="uname" class="col-sm-4 control-label"
															style="color:black" style="color:black">Cervical
															Traction</label>

														<div class="col-sm-1">
															<div class="input-group has-warning">
																<input type="checkbox" class="form-control" name="prepost"
																	value="1">
															</div>
														</div>
														<label for="uname" class="col-sm-1 control-label"
															style="color:black" style="color:black">59351</label>
														<label for="uname" class="col-sm-4 control-label"
															style="color:black" style="color:black">Pre & Post
															Operative</label>
													</div>
												</div>
											</div>
											<!--line 13-->
											<div class="card-body">
												<div class="form-body">
													<div class="form-group row">
														<div class="col-sm-1">
															<div class="input-group has-warning">
																<input type="checkbox" class="form-control" name="lamtra"
																	value="1">
															</div>
														</div>
														<label for="uname" class="col-sm-1 control-label"
															style="color:black" style="color:black">59411</label>
														<label for="uname" class="col-sm-4 control-label"
															style="color:black" style="color:black">Lambal Traction</label>


														<label for="uname" class="col-sm-6 control-label"
															style="color:black" style="color:black">Test &
															Evaluation</label>
													</div>
												</div>
											</div>
											<!--line 14-->
											<div class="card-body">
												<div class="form-body">
													<div class="form-group row">
														<label for="uname" class="col-sm-6 control-label"
															style="color:black" style="color:black">Ultrasonic
															Nebulizer</label>

														<div class="col-sm-1">
															<div class="input-group has-warning">
																<input type="checkbox" class="form-control" name="musstr"
																	value="1">
															</div>
														</div>
														<label for="uname" class="col-sm-1 control-label"
															style="color:black" style="color:black">59701</label>
														<label for="uname" class="col-sm-4 control-label"
															style="color:black" style="color:black">Muscle Strength</label>
													</div>
												</div>
											</div>
											<!--line 15-->
											<div class="card-body">
												<div class="form-body">
													<div class="form-group row">
														<div class="col-sm-1">
															<div class="input-group has-warning">
																<input type="checkbox" class="form-control" name="ultneb"
																	value="1">
															</div>
														</div>
														<label for="uname" class="col-sm-1 control-label"
															style="color:black" style="color:black">59201</label>
														<label for="uname" class="col-sm-4 control-label"
															style="color:black" style="color:black">Ultrasonic
															Nebulizer</label>

														<div class="col-sm-1">
															<div class="input-group has-warning">
																<input type="checkbox" class="form-control" name="joimot"
																	value="1">
															</div>
														</div>
														<label for="uname" class="col-sm-1 control-label"
															style="color:black" style="color:black">59711</label>
														<label for="uname" class="col-sm-4 control-label"
															style="color:black" style="color:black">Joint Motion</label>
													</div>
												</div>
											</div>
											<!--line 16-->
											<div class="card-body">
												<div class="form-body">
													<div class="form-group row">
														<div class="col-sm-6">
															<div class="input-group has-warning">
																<input type="checkbox" class="form-control" name="notdisp"
																	hidden="">
																<!--belum ada field nya di db-->
															</div>
														</div>

														<div class="col-sm-1">
															<div class="input-group has-warning">
																<input type="checkbox" class="form-control" name="actdai"
																	value="1">
															</div>
														</div>
														<label for="uname" class="col-sm-1 control-label"
															style="color:black" style="color:black">59721</label>
														<label for="uname" class="col-sm-4 control-label"
															style="color:black" style="color:black">Activity Daily
															Living</label>
													</div>
												</div>
											</div>
											<!--line 17-->
											<div class="card-body">
												<div class="form-body">
													<div class="form-group row">
														<div class="col-sm-1">
															<div class="input-group has-warning">
																<input type="checkbox" class="form-control"
																	name="lainlain">
															</div>
														</div>
														<label for="uname" class="col-sm-1 control-label"
															style="color:black" style="color:black">59999</label>
														<!--<label for="uname" class="col-sm-2 control-label"
															style="color:black" style="color:black">Lain-lain</label>-->
														<div class="col-sm-4">
															<div class="input-group has-warning">
																<textarea class="form-control" name="lainlaintext"
																	placeholder="Lain - Lain"></textarea>
															</div>
														</div>


														<label for="uname" class="col-sm-1 control-label"
															style="color:black" style="color:black">Dosis</label>

														<div class="col-sm-2">
															<div class="input-group has-warning">
																<input type="text" class="form-control" name="sebanyak"
																	placeholder="Sebanyak">
															</div>
														</div>
														<div class="col-sm-2">
															<div class="input-group has-warning">
																<input type="text" class="form-control" name="frekuensi"
																	placeholder="Frekuensi">
															</div>
														</div>
													</div>
												</div>
											</div>
											<!--line 3-->
											<div class="card-body">
												<div class="form-body">
													<div class="form-group row">
														<label for="uname" class="col-sm-2 control-label"
															style="color:black" style="color:black">Catatan</label>

														<div class="col-sm-10">
															<div class="input-group has-warning">
																<textarea class="form-control" id="catatan" name="catatan"
																	cols="4" rows="8" placeholder="Catatan..."></textarea>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="form-actions">
												<button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>
													Save</button>
												<button type="button" class="btn btn-inverse"
													data-dismiss="modal">Cancel</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- End PAge Content -->
	</div>
	<!-- End Container fluid  -->
	<?php #$this->theme->script('theme_default'); ?>
<script>
	// Date picker only
	$('.tanggalfisio').datepicker({
		dateFormat: "yy-mm-dd",
		autoclose: true,
		language: 'id',
	});


    // Date picker only
	$('.tanggalcr').datepicker({
		dateFormat: "yy-mm-dd",
		autoclose: true,
		language: 'id',
	});

	$(".tanggalcr").datepicker("setDate", new Date());
</script>
<script>
var optional_page ='<?php echo $optional_page; ?>';
if(optional_page!='')
{
	$('#frm_order_rehab').submit(function(event) {
		event.preventDefault(); //prevent default action 
	
		var post_url = $(this).attr("action"); //get form action url
		var form_data = $(this).serialize(); //Encode form elements for submission
	
		$.post(post_url, form_data, function(response) {
			//$("#box_new_eresep").html(response);
			alert('Response : ' + response);
			inner_loader('<?php echo base_url('fisio/rehabmedik/fisio_modal_lad/'.$id_reg.'/asm_ri') ?>', '#loader_box_rehab', false, '');
			$('#Modalfisiomod').modal('hide');
		});
	});
}
</script>
