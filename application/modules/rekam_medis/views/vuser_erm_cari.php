<!doctype html>
<html>

<head>
  <?php $this->theme->head('theme_default'); ?>

  <style>

  </style>

</head>

<?php $this->theme->wrapper_open('theme_default', $breadcrumb); ?>

<div class="container-fluid">
  <!-- Start Page Content -->
  <div class="row">
    <div class="col-sm-8">
      <div class="form-group">

        <form name="form1" method="post" action="<?php echo base_url('rekam_medis/user_erm_cari') ?>" class="form-inline">
          <div class="form-group">
            <input type="text" name="id_pasien" id="id_pasien" class="form-control" placeholder="No. RM Pasien"
              value="<?php echo $id_pasien; ?>">
          </div> &nbsp&nbsp&nbsp
          <div class="form-group">
            <input type="text" name="nama_pasien" id="nama_pasien" class="form-control" placeholder="Nama Pasien"
              value="<?php echo $nama_pasien; ?>">
          </div>&nbsp&nbsp&nbsp
          <input class="btn btn-secondary" type="submit" name="button" value="Tampilkan">
        </form>
      </div>
    </div>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Pasien</th>
            <th scope="col">Regdate</th>
            <th scope="col">Poli</th>
            <th scope="col">Dokter</th>
            <th scope="col">Asuransi</th>
            <th scope="col">Diagnosa</th>
            <th scope="col">ICD10</th>
            <th scope="col">Status</th>
            <th>Action </th>
            <!-- <th scope="col">Action</th> -->
          </tr>
        </thead>
        <tbody>
          <?php
        $i=1;
        foreach($data_row as $k)
        {
					$id_pasien= $k['id_pasien'];
					$id_reg		= $k['id_reg'];
					$regdate	= $k['trxdate'];
					$regdate	= date("d-m-Y", strtotime($regdate) );
          $id_cppt  = $k['id_cppt'];

					if($k['jml_soap'] >= 1 || $k['jml_asm'] >= 1)
						$status = '<span class="badge badge-success">E-RM Ready</span>';
					else
						$status = '<span class="badge badge-danger">Belum ERM</span>';
      ?>
          <tr class="table-row">
            <td>
              <?php echo $i; ?>
            </td>
            <td>
              <b><?php echo $k['name']; ?></b> <br>
              <i><?php echo $id_pasien; ?> / <?php echo $id_reg;   ?></i>
            </td>
            <td>
              <?php echo $regdate ?>
            </td>
            <td>
              <?php echo $k['unit']; ?>
            </td>
            <td>
              <?php echo $k['dokter']; ?>
            </td>
            <td>
              <?php echo $k['asuransi']; ?>
            </td>
            <td><?php echo $k['assesment']; ?></td>
            <td>

                <a href="#" class="prekitiew" data-id="<?php echo $id_cppt; ?>" data-title="<?php echo $id_reg; ?>">


                  <?php echo $k['id_icd']; ?>


                </a>
              </td>
            <td>
              <?php echo $status; ?>
            </td>
            <td nowrap>
              <a href="#" onClick="javascript:void window.open('<?php echo base_url('soap/epoli/print_cppt_byid/'.$id_cppt) ?>','1541221517736','width=1024,height=600,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;">
                SOAP
              </a>&nbsp;&nbsp;&nbsp;&nbsp;

              <a href="#" onClick="javascript:void window.open('<?php echo base_url('soap_awal/soap_awal_print/' . $k['id_asm']) ?>','1541221517736', 'width=1024,height=600,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;">
                ASM AWAL
              </a>&nbsp;&nbsp;&nbsp;&nbsp;

            </td>

          </tr>
          <?php
        $i++;
        }
      ?>
        </tbody>
      </table>
      <br>
    </div>
  </div>
</div>

<?php $this->theme->wrapper_close('theme_default'); ?>

<!-- The Modal -->
<div class="modal animated bounce" id="modalUpload" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-lg-smart" role="document">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
      	<div class="row">
        	<div class="col-sm-11">
            <h4 class="modal-title">Form Upload Gambar</h4>
          </div>
          <div class="col-sm-1">
            <button type="button" class="close" data-dismiss="modal" style="font-size:22px;">&times;</button>
          </div>
        </div>
			</div>
			<!-- Modal body -->
			<div class="modal-body modal-body-scroll" id="modal-body-upl" style="overflow:auto; max-height:80vh">
				<div class="row">
        	<div class="col-md-6" id="box-intip-soap"></div>
          <div class="col-md-6" id="box-input-icd">







          	<form id="frm_icd" name="frm_icd" method="post" action="<?php echo base_url('rekam_medis/act_save_icd'); ?>">
							<input type="text" id="id_reg_icd" name="id_reg_icd">
              <h4 class="text-center">ICD 10</h1>
              <hr>

              <?php
              for($i=0;$i<=4;$i++){
              $caption = ($i==0) ? "Utama" : ("Sekundari ".($i+1)) ;
              ?>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label"><?php echo $caption; ?></label>
                <div class="col-sm-7">
                  <div class="ui-widget">
                    <input id="name_icd_ten[<?php echo $i; ?>]" name="name_icd_ten[<?php echo $i; ?>]" class="form-control">
                  </div>
                </div>

                <div class="col-sm-2">
                  <input id="id_icd_ten[<?php echo $i; ?>]" name="id_icd_ten[<?php echo $i; ?>]" class="form-control" readonly>
                  <input id="old_id_icd_ten[<?php echo $i; ?>]" name="old_id_icd_ten[<?php echo $i; ?>]" class="form-control" readonly>
                </div>
              </div>
              <?php
              }
              ?>

              <hr>

              <h4 class="text-center" style="margin-top:30px;">ICD 9</h1>
              <hr>
              <?php
              for($i=0;$i<=9;$i++){
              $caption = ($i==0) ? "Utama" : ("Sekundari ".($i+1)) ;
              ?>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label"><?php echo $caption; ?></label>
                <div class="col-sm-7">
                  <div class="ui-widget">
                    <input id="name_icd_nine[<?php echo $i; ?>]" name="name_icd_nine[<?php echo $i; ?>]" class="form-control">
                  </div>
                </div>

                <div class="col-sm-2">
                  <input id="id_icd_nine[<?php echo $i; ?>]" name="id_icd_nine[<?php echo $i; ?>]" class="form-control" readonly>
                  <input id="old_id_icd_nine[<?php echo $i; ?>]" name="old_id_icd_nine[<?php echo $i; ?>]" class="form-control" readonly>
                </div>
              </div>
              <?php
              }
              ?>
              <hr>
              <div class="form-group row">
              	<div class="col-sm-6 text-left">
                  <button type="button" class="btn btn-secondary" id="butt_batal" style="width:150px;" data-dismiss="modal">Batal</button>
                </div>
                <div class="col-sm-6 text-right">
                	<button type="submit" form="frm_icd" class="btn btn-primary" data-target="#modalUpload" id="butt_simpan_icd" style="width:150px; ">Simpan</button>
                </div>
              </div>
            </form>

          </div>
        </div>
			</div>

		</div>
	</div>
</div>

<?php $this->theme->script('theme_default'); ?>
<script>
  // Date picker only
  $('.tanggal').datepicker({
    dateFormat: "yy-mm-dd",
    autoclose: true,
    language: 'id',
  });

  $(".tanggal").datepicker("setDate", new Date());
</script>
<script>

$('.prekitiew').click(function(e) {
  e.preventDefault();
	var id_cpptx = $(this).attr('data-id');
	var id_reg = $(this).attr('data-title');

	$( "#id_reg_icd" ).val(id_reg);
	$.get("<?php echo base_url(); ?>soap/epoli/print_cppt_byid/" + id_cpptx + "/false" , function( data ) {
		$( "#box-intip-soap" ).html( data );
	});
	$.get("<?php echo base_url(); ?>soap/epoli/print_cppt_byid/" + id_cpptx + "/false" , function( data ) {
		$( "#box-intip-soap" ).html( data );
	});

	/*
	$.get("<?php echo base_url(); ?>rekam_medis/inner_modal_input_icd/" + id_reg + "" , function( data ) {
		$( "#box-input-icd" ).html( data );
	});
	$.get("<?php echo base_url(); ?>rekam_medis/inner_modal_input_icd/" + id_reg + "" , function( data ) {
		$( "#box-input-icd" ).html( data );
	});
	*/

	$.get("<?php echo base_url(); ?>rekam_medis/inner_get_icd_pasien/" + id_reg + "" , function( data ) {
		//console.log(data);
		var obj = JSON.parse(data);
		for(h=0;h<=4;h++)
		{
			if (obj[h]==undefined)
			{
				$("#name_icd_ten\\["+h+"\\]").val('');
				$("#id_icd_ten\\["+h+"\\]").val('');
				$("#old_id_icd_ten\\["+h+"\\]").val('');
				//break;
			}
			else
			{
				$("#name_icd_ten\\["+h+"\\]").val(obj[h].combo_name);
				$("#id_icd_ten\\["+h+"\\]").val(obj[h].id_icd);
				$("#old_id_icd_ten\\["+h+"\\]").val(obj[h].id_icd);
			}
		}
	});

		$.get("<?php echo base_url(); ?>rekam_medis/inner_get_icd_nine_pasien/" + id_reg + "" , function( data ) {
		console.log(data);
		var obj = JSON.parse(data);
		for(j=0;j<=4;j++)
		{
			if (obj[j]==undefined)
			{
				$("#name_icd_nine\\["+j+"\\]").val('');
				$("#id_icd_nine\\["+j+"\\]").val('');
				$("#old_id_icd_nine\\["+j+"\\]").val('');
				//break;
			}
			else
			{
				$("#name_icd_nine\\["+j+"\\]").val(obj[j].combo_name);
				$("#id_icd_nine\\["+j+"\\]").val(obj[j].id_icd);
				$("#old_id_icd_nine\\["+j+"\\]").val(obj[j].id_icd);
			}
		}
	});

	$('.modal-title').html('<h3>Rekam Medis - Input ICD 10</h3>');
  $('#modalUpload').modal('show');

});
</script>

<script>
$(function() {
		// ---- autocomplet buat icd 10 ------
		$("#name_icd_ten\\[0\\]").autocomplete({
			source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_ten'); ?>",
			appendTo : "#modal-body-upl",
			minLength: 2,
			select: function(event, ui) {
				$("#id_icd_ten\\[0\\]").val(ui.item.id);
			}
		});

		$("#name_icd_ten\\[1\\]").autocomplete({
			source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_ten'); ?>",
			appendTo : "#modal-body-upl",
			minLength: 2,
			select: function(event, ui) {
				$("#id_icd_ten\\[1\\]").val(ui.item.id);
			}
		});

		$("#name_icd_ten\\[2\\]").autocomplete({
			source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_ten'); ?>",
			appendTo : "#modal-body-upl",
			minLength: 2,
			select: function(event, ui) {
				$("#id_icd_ten\\[2\\]").val(ui.item.id);
			}
		});

		$("#name_icd_ten\\[3\\]").autocomplete({
			source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_ten'); ?>",
			appendTo : "#modal-body-upl",
			minLength: 2,
			select: function(event, ui) {
				$("#id_icd_ten\\[3\\]").val(ui.item.id);
			}
		});

		$("#name_icd_ten\\[4\\]").autocomplete({
			source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_ten'); ?>",
			appendTo : "#modal-body-upl",
			minLength: 2,
			select: function(event, ui) {
				$("#id_icd_ten\\[4\\]").val(ui.item.id);
			}
		});

		// ---- autocomplet buat icd 9 ------
		$("#name_icd_nine\\[0\\]").autocomplete({
			source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_nine'); ?>",
			appendTo : "#modal-body-upl",
			minLength: 2,
			select: function(event, ui) {
				$("#id_icd_nine\\[0\\]").val(ui.item.id);
			}
		});

				$("#name_icd_nine\\[1\\]").autocomplete({
			source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_nine'); ?>",
			appendTo : "#modal-body-upl",
			minLength: 2,
			select: function(event, ui) {
				$("#id_icd_nine\\[1\\]").val(ui.item.id);
			}
		});

				$("#name_icd_nine\\[2\\]").autocomplete({
			source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_nine'); ?>",
			appendTo : "#modal-body-upl",
			minLength: 2,
			select: function(event, ui) {
				$("#id_icd_nine\\[2\\]").val(ui.item.id);
			}
		});

				$("#name_icd_nine\\[3\\]").autocomplete({
			source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_nine'); ?>",
			appendTo : "#modal-body-upl",
			minLength: 2,
			select: function(event, ui) {
				$("#id_icd_nine\\[3\\]").val(ui.item.id);
			}
		});

				$("#name_icd_nine\\[4\\]").autocomplete({
			source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_nine'); ?>",
			appendTo : "#modal-body-upl",
			minLength: 2,
			select: function(event, ui) {
				$("#id_icd_nine\\[4\\]").val(ui.item.id);
			}
		});

				$("#name_icd_nine\\[5\\]").autocomplete({
			source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_nine'); ?>",
			appendTo : "#modal-body-upl",
			minLength: 2,
			select: function(event, ui) {
				$("#id_icd_nine\\[5\\]").val(ui.item.id);
			}
		});

				$("#name_icd_nine\\[6\\]").autocomplete({
			source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_nine'); ?>",
			appendTo : "#modal-body-upl",
			minLength: 2,
			select: function(event, ui) {
				$("#id_icd_nine\\[6\\]").val(ui.item.id);
			}
		});

				$("#name_icd_nine\\[7\\]").autocomplete({
			source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_nine'); ?>",
			appendTo : "#modal-body-upl",
			minLength: 2,
			select: function(event, ui) {
				$("#id_icd_nine\\[7\\]").val(ui.item.id);
			}
		});

				$("#name_icd_nine\\[8\\]").autocomplete({
			source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_nine'); ?>",
			appendTo : "#modal-body-upl",
			minLength: 2,
			select: function(event, ui) {
				$("#id_icd_nine\\[8\\]").val(ui.item.id);
			}
		});

				$("#name_icd_nine\\[9\\]").autocomplete({
			source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_nine'); ?>",
			appendTo : "#modal-body-upl",
			minLength: 2,
			select: function(event, ui) {
				$("#id_icd_nine\\[9\\]").val(ui.item.id);
			}
		});

});
</script>
<script>
$('#frm_icd').submit(function(event) {
  event.preventDefault(); //prevent default action

	/*
	$('#butt_simpan_resep').attr('disabled', 'disabled');
  setTimeout(function() {
    $('#butt_simpan_resep').removeAttr('disabled');
  }, 30000);
	*/

  var post_url = $(this).attr("action"); //get form action url
  var form_data = $(this).serialize(); //Encode form elements for submission

  $.post(post_url, form_data, function(response) {
    //$("#box_new_eresep").html(response);
		alert('Response : ' + response);
		$('#modalUpload').modal('hide');
  });


});
</script>
</body>

</html>
