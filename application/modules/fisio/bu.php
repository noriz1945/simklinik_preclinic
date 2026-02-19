<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>REHAB MEDIK</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/jquery.dataTables.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/dataTables.bootstrap4.css'?>">
</head>
<body>

           
                    <div class="float-right"><a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#Modal_Add"><span class="fa fa-plus"></span> Add New</a></div>
          

            <table class="table table-bordered">
					<thead>
						<tr>
						<th scope="col">ID Order</th>
						<th scope="col">Nama</th>
						<th scope="col">Diagnosa</th>
						<th scope="col">Terapi</th>
						<th scope="col">Tanggal</th>
						<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody id="show_data">
					</tbody>
				</table>
                      

		<!-- MODAL ADD -->
            <form>
            <div class="modal fade" id="Modal_Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                  
                    <h5 class="modal-title" id="exampleModalLabel">Rujukan Rehab Medik</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                  <div class="form-group row">
                  <?php foreach($datPasien as $u){  ?>
                        <input type="text" hidden id="registrasi" name="registrasi" value="<?php echo $u->id_reg; ?>" readonly>
                        <input type="text" hidden id="rm" name="rm" value="<?php echo $u->id_pasien; ?>" readonly>
                        <input type="text" hidden id="nama" name="nama" value="<?php echo $u->name; ?>" readonly>
                        <input type="text" hidden id="tgl_request" name="tgl_request" value="<?php echo date('Y-m-d'); ?>" readonly>
                       <?php } ?>
                            <label class="col-md-2 col-form-label">Tanggal</label>
                            <div class="col-md-10">
                              <input type="text" name="tgl_request" id="tgl_request" value="<?php echo date('Y-m-d'); ?>" class="form-control" placeholder="Tanggal" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Diagnosa</label>
                            <div class="col-md-10">
                              <input type="text" name="diagnosa" id="diagnosa" class="form-control" placeholder="Diagnosa">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Terapi</label>
                            <div class="col-md-10">
                              <input type="text" name="tindakan" id="tindakan" class="form-control" placeholder="Terapi">
                            </div>
                        </div>
                        <label class="col-md-10 col-form-label">Belum dapat dikembalikan ke fasilitas perujuk dengan alasan</label>
                        <div class="form-group row">
                        <label class="col-md-2 col-form-label">1. </label>
                            <div class="col-md-10">
                              <input type="text" name="tindakan_id" id="tindakan_id" class="form-control" placeholder="alasan">
                            </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
		<button type="button" class="btn btn-inverse" data-dismiss="modal">Cancel</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
        <!--END MODAL ADD-->

        <!-- MODAL EDIT -->
        <form>
            <div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Rujukan Rehab Medik</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">ID Order</label>
                            <div class="col-md-10">
                              <input type="text" name="id_digital_request_edit" id="id_digital_request_edit" class="form-control" placeholder="ID Order" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Diagnosa</label>
                            <div class="col-md-10">
                              <input type="text" name="diagnosa_edit" id="diagnosa_edit" class="form-control" placeholder="Diagnosa">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Terapi</label>
                            <div class="col-md-10">
                              <input type="text" name="tindakan_edit" id="tindakan_edit" class="form-control" placeholder="Terapi">
                            </div>
                        </div>
                        <label class="col-md-10 col-form-label">Belum dapat dikembalikan ke fasilitas perujuk dengan alasan</label>
                        <div class="form-group row">
                        <label class="col-md-2 col-form-label">1. </label>
                            <div class="col-md-10">
                              <input type="text" name="tindakan_id_edit" id="tindakan_id_edit" class="form-control" placeholder="alasan">
                            </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" type="submit" id="btn_update" class="btn btn-primary">Update</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
        <!--END MODAL EDIT-->

        <!--MODAL DELETE-->
         <form>
            <div class="modal fade" id="Modal_Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                       <strong>Hapus Order Rehab Medik ?</strong>
                  </div>
                  <div class="modal-footer">
                    <input type="hidden" name="id_digital_request_delete" id="id_digital_request_delete" class="form-control">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" type="submit" id="btn_delete" class="btn btn-primary">Yes</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
        <!--END MODAL DELETE-->

<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-3.2.1.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.dataTables.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/dataTables.bootstrap4.js'?>"></script>

<script type="text/javascript">
	$(document).ready(function(){
		show_rehab();	//call function show all order rehab medik
		
		$('#mydata').dataTable();
		 
		//function show all list order rehab medik
		function show_rehab(){
		    $.ajax({
		        type  : 'ajax',
		        url   : '<?php echo site_url('fisio/rehabmedik/rehab_data')?>',
		        async : false,
		        dataType : 'json',
		        success : function(data){
		            var html = '';
		            var i;
		            for(i=0; i<data.length; i++){
		                html += '<tr>'+
		                  		'<td>'+data[i].id_digital_request+'</td>'+
                                '<td>'+data[i].nama+'</td>'+
                                '<td>'+data[i].diagnosa+'</td>'+
                                '<td>'+data[i].tindakan+'</td>'+
                                '<td>'+data[i].tgl_request+'</td>'+
		                        '<td style="text-align:right;">'+
                                    '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data-id_digital_request="'+data[i].id_digital_request+'" data-diagnosa="'+data[i].diagnosa+'" data-tindakan="'+data[i].tindakan+'" data-tindakan_id="'+data[i].tindakan_id+'">Edit</a>'+' '+
                                    '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data-id_digital_request="'+data[i].id_digital_request+'">Delete</a>'+
                                '</td>'+
		                        '</tr>';
		            }
		            $('#show_data').html(html);
		        }

		    });
        }

        
        //Save product
        $('#btn_save').on('click',function(){
            var registrasi    = $('#registrasi').val();
            var rm    = $('#rm').val();
            var nama    = $('#nama').val();
            var tgl_request    = $('#tgl_request').val();
            var diagnosa    = $('#diagnosa').val();
            var tindakan    = $('#tindakan').val();
            var tindakan_id  = $('#tindakan_id').val();
            var tgl_request  = $('#tgl_request').val();

            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('fisio/rehabmedik/save')?>",
                dataType : "JSON",
                data : {tgl_request:tgl_request ,nama:nama ,rm:rm ,registrasi:registrasi , diagnosa:diagnosa , tindakan:tindakan , tindakan_id:tindakan_id , tgl_request:tgl_request},
                success: function(data){
                    $('[name="registrasi"]').val("");
                    $('[name="rm"]').val("");
                    $('[name="nama"]').val("");
                    $('[name="tgl_request"]').val("");
                    $('[name="diagnosa"]').val("");
                    $('[name="tindakan"]').val("");
                    $('[name="tindakan_id"]').val("");
                    $('[name="tgl_request"]').val("");
                    $('#Modal_Add').modal('hide');
                    show_rehab();
                }
            });
            return false;
        });

        //get data for update record
        $('#show_data').on('click','.item_edit',function(){
            var id_digital_request = $(this).data('id_digital_request');
            var diagnosa           = $(this).data('diagnosa');
            var tindakan           = $(this).data('tindakan');
            var tindakan_id           = $(this).data('tindakan_id');
            
            $('#Modal_Edit').modal('show');
            $('[name="id_digital_request_edit"]').val(id_digital_request);
            $('[name="diagnosa_edit"]').val(diagnosa);
            $('[name="tindakan_edit"]').val(tindakan);
            $('[name="tindakan_id_edit"]').val(tindakan_id);
        });

        //update record to database
         $('#btn_update').on('click',function(){
            var id_digital_request = $('#id_digital_request_edit').val();
            var diagnosa = $('#diagnosa_edit').val();
            var tindakan        = $('#tindakan_edit').val();
            var tindakan_id        = $('#tindakan_id_edit').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('fisio/rehabmedik/update')?>",
                dataType : "JSON",
                data : {id_digital_request:id_digital_request , diagnosa:diagnosa, tindakan:tindakan , tindakan_id:tindakan_id},
                success: function(data){
                    $('[name="id_digital_request_edit"]').val("");
                    $('[name="diagnosa_edit"]').val("");
                    $('[name="tindakan_edit"]').val("");
                    $('[name="tindakan_id_edit"]').val("");
                    $('#Modal_Edit').modal('hide');
                    show_rehab();
                }
            });
            return false;
        });

        //get data for delete record
        $('#show_data').on('click','.item_delete',function(){
            var id_digital_request = $(this).data('id_digital_request');
            
            $('#Modal_Delete').modal('show');
            $('[name="id_digital_request_delete"]').val(id_digital_request);
        });

        //delete record to database
         $('#btn_delete').on('click',function(){
            var id_digital_request = $('#id_digital_request_delete').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('fisio/rehabmedik/delete')?>",
                dataType : "JSON",
                data : {id_digital_request:id_digital_request},
                success: function(data){
                    $('[name="id_digital_request_delete"]').val("");
                    $('#Modal_Delete').modal('hide');
                    show_rehab();
                }
            });
            return false;
        });

	});

</script>