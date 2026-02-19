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

        <form name="form1" method="post" action="<?php echo base_url('rekam_medis/user_erm') ?>" class="form-inline">
          <div class="form-group">
            <input type="text" name="awal" id="awal" class="form-control tanggal" value="<?php echo $date; ?>" readonly>
          </div>&nbsp&nbsp&nbsp
          <div class="form-group">
            <?php echo $dokter_list; ?>
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
								
                <a href="#" class="prekitiew" data-id="<?php echo $id_cppt; ?>" data-title="EEG">
                
                
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
      <?php
				echo anchor(site_url("rekam_medis/user_erm_xls/"."$date/".$id_doctor),"<img src=".base_url('assets/img/tulis.png')." style=\"max-height:20px;\">") . " &nbsp; ";
			?>
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
          <div class="col-md-6">
          	
            
            
          <form>
						<h4 class="text-center">ICD 10</h1>
            <hr>
            
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Utama</label>
              <div class="col-sm-7">
                <div class="ui-widget">
                  <input id="name_icd_ten[0]" name="name_icd_ten[0]" class="form-control">
                </div>
              </div>
              
              <div class="col-sm-2">
              	<input id="id_icd_ten[0]" name="id_icd_ten[0]" class="form-control" readonly>
              </div>
            </div>
            
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Sekundari (1)</label>
              <div class="col-sm-7">
                <div class="ui-widget">
                  <input id="name_icd_ten[1]" name="name_icd_ten[1]" class="form-control">
                </div>
              </div>
              
              <div class="col-sm-2">
              	<input id="id_icd_ten[1]" name="id_icd_ten[1]" class="form-control" readonly>
              </div>  
            </div>
            
            <hr>
            
            
            <h4 class="text-center">ICD 9</h1>
            <hr>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Utama</label>
              <div class="col-sm-7">
                <div class="ui-widget">
                  <input id="name_icd_nine[0]" name="name_icd_nine[0]" class="form-control">
                </div>
              </div>
              
              <div class="col-sm-2">
              	<input id="id_icd_nine[0]" name="id_icd_nine[0]" class="form-control" readonly>
              </div>
            </div>
            
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Sekundari (1)</label>
              <div class="col-sm-7">
                <div class="ui-widget">
                  <input id="name_icd_nine[1]" name="name_icd_nine[1]" class="form-control">
                </div>
              </div>
              
              <div class="col-sm-2">
              	<input id="id_icd_nine[1]" name="id_icd_nine[1]" class="form-control" readonly>
              </div>  
            </div>
            <hr>
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
	//var nama_kat = $(this).attr('data-title');
	//$.get("http://192.168.10.43/smartplus/uploader/inner_preview_single/" + id_suf + "/" + "00178184/" , function( data ) {
		$.get("<?php echo base_url(); ?>/soap/epoli/print_cppt_byid/" + id_cpptx + "/false" , function( data ) {
		$( "#box-intip-soap" ).html( data );
		//alert( "Load was performed." );
	});		
	$('.modal-title').html('<h3>Rekam Medis - Input ICD 10</h3>');
  $('#modalUpload').modal('show');
	
});

$(function() {
  $("#name_icd_ten\\[0\\]").autocomplete({
    source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_ten'); ?>",
		appendTo : "#modal-body-upl",
    minLength: 2,
    select: function(event, ui) {
			$("#id_icd\\[0\\]").val(ui.item.id);
    }
		
  });

	$("#name_icd_ten\\[1\\]").autocomplete({
    source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_ten'); ?>",
		appendTo : "#modal-body-upl",
    minLength: 2,
    select: function(event, ui) {
      $("#id_icd\\[1\\]").val(ui.item.id);
    }
  });
});

</script>
</body>

</html>
