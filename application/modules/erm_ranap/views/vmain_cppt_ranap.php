<script>
var id_reg = '<?php echo $id_reg; ?>';
var id_pasien = '<?php echo $id_pasien; ?>';
</script>
<style>
.pnl-head-3{
	border-radius: 40px 40px 0 0;
	background-color: #CCC;
	margin-bottom:0;
}
hr{
	margin-top:3px;
	margin-bottom:5px;
}
</style>
	<form id="frm_cppt_ri_dokter" method="post" action="<?php echo base_url('erm_ranap/act_asm_ranap/'.$id_reg.'/'.$id_pasien); ?>">
  <input type="hidden" id="id_asmri" name="id_asmri" value="<?php echo $row['id_asmri']; ?>">
  <input type="hidden" id="sql_command" name="sql_command" value="<?php echo $sql_command; ?>">
  <input type="hidden" id="kategori" name="kategori" value="CPPT">
  <input type="text" id="idregset" name="idregset" value="<?php echo $id_reg; ?>" readonly hidden> 
  <input type="text" id="id_pasien" name="id_pasien" value="<?php echo $id_pasien; ?>" readonly hidden>
  <input type="hidden" id="asal_masuk_set_cppt" value="<?php echo $row['asal_masuk']; ?>" />
  <input type="hidden" id="cara_masuk_set_cppt" value="<?php echo $row['cara_masuk']; ?>" />
  <div class="row pnl">
    <div class="col-md-6">
      <div class="row">
        <div class="col-sm-3">
          <label class="control-label">Tanggal Masuk :</label>
        </div>
        <div class="col-sm-9">
          <label class="control-label"><?php echo $data_pasien['regdate']; ?></label>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="row">
        <div class="col-sm-3">
          <label class="control-label">Asal Masuk :</label>
        </div>
        <div class="col-sm-3">
          <?php if($row['asal_masuk']=="IGD"){ $check_1 = "checked";}else{ $check_1=""; } ?>
          <input type="radio" name="asal_masuk" value="IGD" <?php echo $check_1; ?> /> IGD
        </div>
        <div class="col-sm-5">
          <?php if($row['asal_masuk']=="Rawat Jalan"){ $check_2 = "checked";}else{ $check_2=""; } ?>
          <input type="radio" name="asal_masuk" value="Rawat Jalan" <?php echo $check_2; ?> /> RAWAT JALAN
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="row">
        <div class="col-sm-3">
          <label class="control-label">Pengkajian :</label>
        </div>
        <div class="col-sm-9">
          <input type="text" name="tgl_pengkajian" id="tgl_pengkajian" class="form-control tanggal" value="<?php echo $row['tgl_pengkajian']; ?>">
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="row">
        <div class="col-sm-3">
          <label class="control-label">Cara Masuk :</label>
        </div>
        <div class="col-sm-3">
        <?php if($row['cara_masuk']=="JALAN"){ $check_3 = "checked";}else{ $check_3=""; } ?>
          <input type="radio" name="cara_masuk" value="JALAN" <?php echo $check_3; ?> /> JALAN
        </div>
        <div class="col-sm-3">
        <?php if($row['cara_masuk']=="KURSI RODA"){ $check_4 = "checked";}else{ $check_4=""; } ?>
          <input type="radio" name="cara_masuk" value="KURSI RODA" <?php echo $check_4; ?> /> KURSI RODA
        </div>
        <div class="col-sm-3">
        <?php if($row['cara_masuk']=="BRANKAR"){ $check_5 = "checked";}else{ $check_5=""; } ?>
          <input type="radio" name="cara_masuk" value="BRANKAR" <?php echo $check_5; ?> /> BRANKAR
        </div>
      </div>
    </div>

  </div>


	<h3 class="pnl-head-3" style="margin-top:30px">SUBJECTIVE</h3>
  <div class="row pnl">

    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label">Keluhan Utama :</label>
        <textarea class="form-control input-focus area-scroll" id="keluhan_utama" name="keluhan_utama" rows="5"
          placeholder="Keluhan Utama"><?php echo $row['keluhan_utama']; ?></textarea>
      </div>
    </div>

  </div>
  <br>

	<h3 class="pnl-head-3">OBJECTIVE</h3>
  <div class="row pnl pnl-obj">

    <div class="col-md-12">
      <div class="form-group">
      	<textarea class="form-control input-focus area-scroll" id="objective" name="objective" rows="5"
          placeholder="Objective"><?php echo $row['objective']; ?></textarea>
      </div>
    </div>



  </div>
  <br>

  <h3 class="pnl-head-3">ASSESMENT</h3>
  <div class="row pnl pnl-asm">

    <div class="col-md-12">
      <div class="form-group">
    		<h4>Diagnosa Medis dan Diagnosa Banding</h4>
        <hr>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
      	<label class="control-label">Utama :</label>
      </div>
    </div>
    <div class="col-md-8">
      <div class="form-group">
        <div class="ui-widget">
					<input id="name_icd_ten[0]" name="name_icd_ten[0]" class="form-control">
				</div>
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
        <input id="id_icd_ten[0]" name="id_icd_ten[0]" class="form-control">
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
				<input id="old_id_icd_ten[0]" name="old_id_icd_ten[0]" class="form-control" readonly>
      </div>
    </div>

  </div>

	<h3 class="pnl-head-3" style="margin-top:30px">PLANNING</h3>
  <div class="row pnl pnl-plan">
    <div class="col-md-12">
      <div class="form-group">
    		<h4>RENCANA TINDAKAN</h4>
        <hr>
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
      	<label class="control-label">Utama :</label>
      </div>
    </div>
    <div class="col-md-8">
      <div class="form-group">
        <div class="ui-widget">
					<input id="name_icd_nine[0]" name="name_icd_nine[0]" class="form-control">
				</div>
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
        <input id="id_icd_nine[0]" name="id_icd_nine[0]" class="form-control">
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
				<input id="old_id_icd_nine[0]" name="old_id_icd_nine[0]" class="form-control" readonly>
      </div>
    </div>

    <div class="col-md-12" style="margin-top:30px">
      <div class="form-group">
        <h4>INSTRUKSI</h4>
        <hr>
      </div>
    </div>

    <div class="col-md-12">
      <div class="form-group">
      	<textarea class="form-control input-focus area-scroll" id="p_instruksi" name="p_instruksi" rows="5"
          placeholder="Instruksi"><?php echo $row['p_instruksi']; ?></textarea>
      </div>
    </div>

    <div class="col-md-12" style="margin-top:30px">
      <div class="form-group">
        <h4>RESEP ONLINE</h4>
        <hr>
      </div>
    </div>

    <div class="col-md-12">
      <div class="form-group" id="box_new_eresep_edit">
        <div class="col-sm-12 text-center">
          <h5>Loading page content, please wait...</h5>
          <img src="<?php echo base_url('assets/img/loading-balls.gif'); ?>" alt="Loading Page">
        </div>
      </div>

    </div>

    <div class="col-md-12" style="margin-top:30px" id="anchor_order_lab">
      <div class="form-group">
        <h4>LABORATORIUM</h4>
        <hr>
      </div>
    </div>
    <div class="col-md-12" id="loader_box_lab_edit" style="background-color:white;">
    </div>

    <div class="col-md-12" style="margin-top:30px" id="anchor_order_rad">
      <div class="form-group">
        <h4>RADIOLOGI</h4>
        <hr>
      </div>
    </div>
    <div class="col-md-12" id="loader_box_rad_edit" style="background-color:white;">
    </div>

    <div class="col-md-12" style="margin-top:30px" id="anchor_order_rehab">
      <div class="form-group">
        <h4>REHAB MEDIK</h4>
        <hr>
      </div>
    </div>
    <div class="col-md-12" id="loader_box_rehab_edit" style="background-color:white;">
    </div>

    <div class="col-md-12" style="margin-top:30px" id="anchor_order_op">
      <div class="form-group">
        <h4>OPERASI</h4>
        <hr>
      </div>
    </div>
    <div class="col-md-12" id="loader_box_op_edit" style="background-color:white;">
    </div>

  </div>

  <div class="col-md-12 text-center" style="margin-top:30px;">
    	<button type="submit" class="btn btn-success" style="font-size:22px"> <i class="fa fa-check"></i> S I M P A N </button>
  </div>
	</form>


<!-- modal here -->
<?php $this->theme->script('theme_default'); ?>

<!-- action here -->
<script>
var baseUrl = '/prjext/clinic/';
var id_reg     = $('#idregset').val();
var id_pasien  = $('#id_pasien').val();
var type_rwt   = 'ri';

  //eresep
  $.ajax({
    url : baseUrl+"soap_eresep/add_new",
    method : "POST",
    data : {id_reg:id_reg,id_pasien:id_pasien},
    async : true,
    dataType : 'html',
    success: function(datarestind){
        $('#box_new_eresep_edit').html(datarestind);
      }
    });
  //end eresep

</script>

<!-- LABORATORIUM -->
<script>
    //Order Lab
    $.ajax({
    url : baseUrl+"lab/splab/lab_modal_lad/"+id_reg+"/asm_ri",
    method : "POST",
    data : {},
    async : true,
    dataType : 'html',
    success: function(datarestind){
        $('#loader_box_lab_edit').html(datarestind);
      }
    });
  //end Order Lab

  //Order Radiologi
    $.ajax({
    url : baseUrl+"rad/radiologi/rad_modal_lad/"+id_reg+"/asm_ri",
    method : "POST",
    data : {},
    async : true,
    dataType : 'html',
    success: function(datarestind){
        $('#loader_box_rad_edit').html(datarestind);
      }
    });
  //end Order Radiologi

  //Order Rehab
    $.ajax({
    url : baseUrl+"fisio/rehabmedik/fisio_modal_lad/"+id_reg+"/asm_ri",
    method : "POST",
    data : {},
    async : true,
    dataType : 'html',
    success: function(datarestind){
        $('#loader_box_rehab_edit').html(datarestind);
      }
    });
  //end Order Rehab

  //Order Operasi
    $.ajax({
    url : baseUrl+"op_order/content_op/"+id_reg+"/asm_ri",
    method : "POST",
    data : {},
    async : true,
    dataType : 'html',
    success: function(datarestind){
        $('#loader_box_op_edit').html(datarestind);
      }
    });
  //end Order Operasi
</script>

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
	$('#frm_cppt_ri_dokter').submit(function(event) {
		event.preventDefault(); //prevent default action

		var post_url = $(this).attr("action"); //get form action url
		var form_data = $(this).serialize(); //Encode form elements for submission

		$.post(post_url, form_data, function(response) {
			alert('Response :' + response);
			inner_loader('<?php echo base_url('erm_ranap/cppt_ranap/'.$id_reg) ?>', '#box_list_cppt', false, '');
			//location.reload();
		});
	});
</script>
<script>

  var asal_masuk_cppt = $('#asal_masuk_set_cppt').val();
  var cara_masuk_cppt = $('#cara_masuk_set_cppt').val();
  //alert(asal_masuk_cppt);
$('#frm_cppt_ri_dokter').find(':radio[name=asal_masuk][value="'+asal_masuk_cppt+'"]').prop('checked', true).val();
$('#frm_cppt_ri_dokter').find(':radio[name=cara_masuk][value="'+cara_masuk_cppt+'"]').prop('checked', true).val();

//$('#butt_back').click(function(e) {
//  inner_loader('<?php echo base_url('erm_ranap/cppt_ranap/'.$id_reg) ?>', '#box_list_cppt', false, '');
//});



//ICD TEN
$("#name_icd_ten\\[0\\]").autocomplete({
  source: baseUrl+"rekam_medis/inner_get_data_autocomplet_icd_ten",
  appendTo : "#modal-body-upl",
  minLength: 2,
  select: function(event, ui) {
    $("#id_icd_ten\\[0\\]").val(ui.item.id);
  }
});

$("#name_icd_ten\\[1\\]").autocomplete({
  source: baseUrl+"rekam_medis/inner_get_data_autocomplet_icd_ten",
  appendTo : "#modal-body-upl",
  minLength: 2,
  select: function(event, ui) {
    $("#id_icd_ten\\[1\\]").val(ui.item.id);
  }
});

$("#name_icd_ten\\[2\\]").autocomplete({
  source: baseUrl+"rekam_medis/inner_get_data_autocomplet_icd_ten",
  appendTo : "#modal-body-upl",
  minLength: 2,
  select: function(event, ui) {
    $("#id_icd_ten\\[2\\]").val(ui.item.id);
  }
});

$("#name_icd_ten\\[3\\]").autocomplete({
  source: baseUrl+"rekam_medis/inner_get_data_autocomplet_icd_ten",
  appendTo : "#modal-body-upl",
  minLength: 2,
  select: function(event, ui) {
    $("#id_icd_ten\\[3\\]").val(ui.item.id);
  }
});

$("#name_icd_ten\\[4\\]").autocomplete({
  source: baseUrl+"rekam_medis/inner_get_data_autocomplet_icd_ten",
  appendTo : "#modal-body-upl",
  minLength: 2,
  select: function(event, ui) {
    $("#id_icd_ten\\[4\\]").val(ui.item.id);
  }
});
//END ICD TEN

//ICD NINE
$("#name_icd_nine\\[0\\]").autocomplete({
  source: baseUrl+"rekam_medis/inner_get_data_autocomplet_icd_nine",
  appendTo : "#modal-body-upl",
  minLength: 2,
  select: function(event, ui) {
    $("#name_icd_nine\\[0\\]").val(ui.item.id);
  }
});

$("#name_icd_nine\\[1\\]").autocomplete({
  source: baseUrl+"rekam_medis/inner_get_data_autocomplet_icd_nine",
  appendTo : "#modal-body-upl",
  minLength: 2,
  select: function(event, ui) {
    $("#name_icd_nine\\[1\\]").val(ui.item.id);
  }
});

$("#name_icd_nine\\[2\\]").autocomplete({
  source: baseUrl+"rekam_medis/inner_get_data_autocomplet_icd_nine",
  appendTo : "#modal-body-upl",
  minLength: 2,
  select: function(event, ui) {
    $("#name_icd_nine\\[2\\]").val(ui.item.id);
  }
});
//END ICD NINE
</script>
