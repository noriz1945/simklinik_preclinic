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
										<input type="text" class="form-control mb-2 mr-sm-2 cr_id_pasien" id="cr_id_pasien" name="cr_id_pasien" placeholder="No.RM">
										
										<label class="sr-only" for="cr_nama">Nama</label>
										<input type="text" class="form-control mb-2 mr-sm-2 cr_nama" id="cr_nama" name="cr_nama" placeholder="Nama">
										
										<label class="sr-only" for="cr_nik">Nik</label>
										<input type="numeric" class="form-control mb-2 mr-sm-2 cr_nik" id="cr_nik" name="cr_nik" placeholder="Nik">
										
										<label class="sr-only" for="cr_birthdate">Tgl. Lahir</label>
										<input type="text" class="form-control mb-2 mr-sm-2 cr_birthdate" id="cr_birthdate" name="cr_birthdate" placeholder="Tgl. Lahir">
										
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
											<th scope="col">Kota</th>
											<th scope="col">Catatan</th>
											<th scope="col">Aktif</th>
										</tr>
									</thead>
									<tbody class="contpasienlama"></tbody>
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
var baseUrl = window.location.origin + '/' + window.location.pathname.split ('/') [1] + '/';
function reg_pasien_lama(id_pasien)
{
	//tambahan fungsi rihan 15-12-2024
	$('.getidpasien_booknyah').val(id_pasien);
	//end tambahan fungsi rihan 15-12-2024
	$("#tab_pas_lama").load("<?php echo site_url('trx_reg_book/trx_reg/inner_pasien_lama_reg/'); ?>"+id_pasien);
}


$( document ).ready(function() {
	setlistpasienlama();
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
		setlistpasienlama();
	});	
	
});

function setlistpasienlama(){
	var set_id_dokter  		= $('.getiddokter_booknyah').val();
	var set_tgl_slot 		= $('.tanggalslot_booknyah').val();
	var set_cr_id_pasien 	= $('.cr_id_pasien').val();
	var set_cr_nama 		= $('.cr_nama').val();
	var set_cr_nik 			= $('.cr_nik').val();
	var set_cr_birthdate 	= $('.cr_birthdate').val();
	$.ajax({
      url : baseUrl+"trx_reg_book/trx_reg/listdata_inner_pasienlama",
      method : "POST",
      data : {set_id_dokter:set_id_dokter,set_tgl_slot:set_tgl_slot,set_cr_id_pasien:set_cr_id_pasien,set_cr_nama:set_cr_nama,set_cr_nik:set_cr_nik,set_cr_birthdate:set_cr_birthdate},
      async : true,
      dataType : 'json',
      success: function(datares_detail){
		var iresdata;
		var cont="";
        for (iresdata = 0; iresdata < datares_detail.length; iresdata++){
			if(datares_detail[iresdata].sudah_checkin==0){
				var but_check = "Sudah Book";
			}else if(datares_detail[iresdata].sudah_checkin==1){
				var but_check = "Sudah Checkin";
			}else{
				var but_check = "<button type='button' class='btn btn-success pasienlamaproses' data-set-idpasien='"+datares_detail[iresdata].id_pasien+"'>Register</button>";
			}
		cont +="<tr>"
		+"<td nowrap>"+but_check+"</td>"
		+"<td>"+datares_detail[iresdata].id_pasien+"</td>"
		+"<td>"+datares_detail[iresdata].name+"</td>"
		+"<td>"+datares_detail[iresdata].nik+"</td>"
		+"<td>"+datares_detail[iresdata].tgl_lahir+"</td>"
		+"<td>"+datares_detail[iresdata].birthplace+"</td>"
		+"<td>"+datares_detail[iresdata].gender+"</td>"
		+"<td>"+datares_detail[iresdata].address+"</td>"
		+"<td>"+datares_detail[iresdata].hp+"</td>"
		+"<td>"+datares_detail[iresdata].email+"</td>"
		+"<td>"+datares_detail[iresdata].kota+"</td>"
		+"<td>"+datares_detail[iresdata].description+"</td>"
		+"<td>"+datares_detail[iresdata].aktif+"</td>"
		+"</tr>";
		}
		$('.contpasienlama').html(cont);
		$('.pasienlamaproses').on('click',function(){
			var id_pasien  = $(this).attr('data-set-idpasien');
			reg_pasien_lama(id_pasien);
		});
	  }
	});
}

/* 
			<a onclick="javascript : reg_pasien_lama('<?php echo $mst_pasien->id_pasien; ?>');" href="#"><img src="<?php echo base_url("assets/img/register-button.png"); ?>" style="max-height:25px;"></a>
*/
</script>