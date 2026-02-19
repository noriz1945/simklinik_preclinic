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
<div class="container-fluid">
	<form id="frm_asm_ri_dokter" method="post" action="<?php echo base_url('erm_ranap/act_asm_ranap/'.$id_reg.'/'.$id_pasien); ?>">
  <input type="hidden" id="id_asmri" name="id_asmri" value="<?php echo $row['id_asmri']; ?>">
  <input type="hidden" id="sql_command" name="sql_command" value="<?php echo $sql_command; ?>">
  <input type="hidden" id="kategori" name="kategori" value="ASM">
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
          <input type="radio" name="asal_masuk" value="IGD" /> IGD
        </div>
        <div class="col-sm-5">
          <input type="radio" name="asal_masuk" value="Rawat Jalan" /> RAWAT JALAN
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
          <input type="radio" name="cara_masuk" value="JALAN" /> JALAN
        </div>
        <div class="col-sm-3">
          <input type="radio" name="cara_masuk" value="KURSI RODA" /> KURSI RODA
        </div>
        <div class="col-sm-3">
          <input type="radio" name="cara_masuk" value="BRANKAR" /> BRANKAR
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

    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label">Riwayat Penyakit Sekarang :</label>
        <textarea class="form-control input-focus area-scroll" id="riwayat_sakit_now"
          name="riwayat_sakit" rows="5" placeholder="Riwayat Penyakit Sekarang"><?php echo $row['riwayat_sakit']; ?></textarea>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label">Riwayat Penyakit Dahulu :</label>
        <textarea class="form-control input-focus area-scroll" id="riwayat_sakit_old"
          name="riwayat_sakit_dulu" rows="5" placeholder="Riwayat Penyakit Dahulu"><?php echo $row['riwayat_sakit_dulu']; ?></textarea>
      </div>
    </div>

    <!--/span-->
    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label">Riwayat Pengobatan/Operasi/Obstetri :</label>
        <textarea class="form-control input-focus area-scroll" id="riwayat_pengobatan"
          name="riwayat_pengobatan" rows="5" placeholder="Riwayat Pengobatan/Operasi/Obstetri"><?php echo $row['riwayat_pengobatan']; ?></textarea>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label">Riwayat Penyakit Keluarga :</label>
        <textarea class="form-control input-focus area-scroll" id="riwayat_sakit_keluarga"
          name="riwayat_sakit_keluarga" rows="5" placeholder="Riwayat Penyakit Keluarga"><?php echo $row['riwayat_sakit_keluarga']; ?></textarea>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label">Riwayat Alergi :</label>
        <textarea class="form-control input-focus area-scroll" id="riwayat_alergi" name="riwayat_alergi"
          rows="5" placeholder="Riwayat Alergi"><?php echo $row['riwayat_alergi']; ?></textarea>
      </div>
    </div>

  </div>
  <br>

	<h3 class="pnl-head-3">OBJECTIVE</h3>
  <div class="row pnl pnl-obj">
  <!--
    <div class="col-md-12">
      <div class="form-group">
        <label class="control-label"><strong>OBJECTIVE</strong></label>
        <hr>
      </div>
    </div>
	-->
		
    <div class="col-md-12">
      <div class="form-group">
      	<textarea class="form-control input-focus area-scroll" id="objective" name="objective" rows="5"
          placeholder="Objective"><?php echo $row['objective']; ?></textarea>
      </div>
    </div>
    
    <div class="col-md-12">
      <div class="form-group">
        <h4>TTV</h4>
        <hr>
      </div>
    </div>  
    
    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Kesadaran</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="kesadaran" name="kesadaran" placeholder="Kesadaran" value="<?php echo $row['kesadaran']; ?>">
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Keadaan Umum</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="keadaan_umum" name="keadaan_umum" placeholder="Keadaan Umum" value="<?php echo $row['keadaan_umum']; ?>">
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Tekanan Darah</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="td" name="td" placeholder="Tekanan Darah" value="<?php echo $row['td']; ?>">
      </div>
    </div>


    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">GCS</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="gcs" name="gcs" placeholder="GCS" value="<?php echo $row['gcs']; ?>">
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Nadi</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="nadi" name="nadi" placeholder="Nadi" value="<?php echo $row['nadi']; ?>">
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">SUHU</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="suhu" name="suhu" placeholder="SUHU" value="<?php echo $row['suhu']; ?>">
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Pernafasan</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="nafas" name="nafas" placeholder="Pernafasan" value="<?php echo $row['nafas']; ?>">
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Reaksi Cahaya</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="reaksi_cahaya" name="reaksi_cahaya" placeholder="Reaksi Cahaya" value="<?php echo $row['reaksi_cahaya']; ?>">
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Tinggi Badan</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="tinggi" name="tinggi" placeholder="Tinggi Badan" value="<?php echo $row['tinggi']; ?>">
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Berat Badan</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="berat" name="berat" placeholder="Berat Badan" value="<?php echo $row['berat']; ?>">
      </div>
    </div>



  </div>
  <br>
	
  <h3 class="pnl-head-3">ASSESMENT</h3>
  <div class="row pnl pnl-asm">
  	<!--
    <div class="col-md-12">
      <div class="form-group">
        <label class="control-label"><strong>ASSESMENT</strong></label>
        <hr>
      </div>
    </div>
		-->
    <!--
    <div class="col-md-12">
      <div class="form-group">
        <label class="control-label">Diagnosa Medis & Diagnosa Banding :</label>
        <textarea class="form-control input-focus area-scroll" id="txt_banding" name="txt_banding" rows="5"
          placeholder="Diagnosa Medis & Diagnosa Banding"></textarea>
      </div>
    </div>
    -->
    <div class="col-md-12">
      <div class="form-group">
    		<h4>Diagnosa Medis dan Diagnosa Banding</h4>
        <hr>
      </div>
    </div>
    <?php 
		for($i=0;$i<=4;$i++){ 
		$caption = ($i==0) ? "Utama" : ("Sekundari ".($i+1)) ;
		?>
    <div class="col-md-2">
      <div class="form-group">
      	<label class="control-label"><?php echo $caption; ?> :</label>
      </div>
    </div>
    <div class="col-md-8">
      <div class="form-group">
        <div class="ui-widget">
					<input id="name_icd_ten[<?php echo $i; ?>]" name="name_icd_ten[<?php echo $i; ?>]" class="form-control" value="<?php echo $arr_ten_text[$i]; ?>">
				</div>
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
        <input id="id_icd_ten[<?php echo $i; ?>]" name="id_icd_ten[<?php echo $i; ?>]" class="form-control" value="<?php echo $arr_ten[$i]; ?>">
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
				<input id="old_id_icd_ten[<?php echo $i; ?>]" name="old_id_icd_ten[<?php echo $i; ?>]" class="form-control" readonly>
      </div>
    </div>
		<?php 
		}
		?>    
	
  <div class="col-md-12" style="margin-top:30px">
    <div class="form-group">
      <h4>DRAWING</h4>
      <hr>
    </div>
  </div>
  
  <div class="col-md-12">
    <div class="form-group">
      	<div id="box_drawing_canvas"></div>
    </div>
  </div>
  
  </div>

	<h3 class="pnl-head-3" style="margin-top:30px">PLANNING</h3>
  <div class="row pnl pnl-plan">
    <div class="col-md-12">
      <div class="form-group">
    		<h4>ICD 9CM</h4>
        <hr>
      </div>
    </div>
    <?php 
		for($i=0;$i<=2;$i++){ 
		$caption = ($i==0) ? "Utama" : ("Sekundari ".($i+1)) ;
		?>
    <div class="col-md-2">
      <div class="form-group">
      	<label class="control-label"><?php echo $caption; ?> :</label>
      </div>
    </div>
    <div class="col-md-8">
      <div class="form-group">
        <div class="ui-widget">
					<input id="name_icd_nine[<?php echo $i; ?>]" name="name_icd_nine[<?php echo $i; ?>]" class="form-control" value="<?php echo $arr_nine_text[$i]; ?>">
				</div>
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
        <input id="id_icd_nine[<?php echo $i; ?>]" name="id_icd_nine[<?php echo $i; ?>]" class="form-control" value="<?php echo $arr_nine[$i]; ?>">
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
				<input id="old_id_icd_nine[<?php echo $i; ?>]" name="old_id_icd_nine[<?php echo $i; ?>]" class="form-control" readonly>
      </div>
    </div>
		<?php 
		}
		?>  
		
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
    	<!--
      <div class="form-group">
        <label class="control-label"><strong>RESEP ONLINE</strong></label>
      </div>
			-->
      <div class="form-group" id="box_new_eresep">
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
    <div class="col-md-12" id="loader_box_lab" style="background-color:white;"> 
    </div>
        
    <div class="col-md-12" style="margin-top:30px" id="anchor_order_rad">
      <div class="form-group">
        <h4>RADIOLOGI</h4>
        <hr>
      </div>
    </div>
    <div class="col-md-12" id="loader_box_rad" style="background-color:white;">
    </div>
    
    <div class="col-md-12" style="margin-top:30px" id="anchor_order_rehab">
      <div class="form-group">
        <h4>REHAB MEDIK</h4>
        <hr>
      </div>
    </div>
    <div class="col-md-12" id="loader_box_rehab" style="background-color:white;">
    </div>
    
    <div class="col-md-12" style="margin-top:30px" id="anchor_order_op">
      <div class="form-group">
        <h4>OPERASI</h4>
        <hr>
      </div>
    </div>
    <div class="col-md-12" id="loader_box_op" style="background-color:white;">
    </div>
    
  </div>
  
  <div class="col-md-12 text-center" style="margin-top:30px;">
    	<button type="submit" class="btn btn-success" style="font-size:22px"> <i class="fa fa-check"></i> S I M P A N </button>
    </div>
	</form>
</div>

<!-- modal here -->
<?php $this->theme->script('theme_default'); ?>

<!-- action here -->
<script>

$(document).ready(function() {
	$(document).ready(function() {
		inner_loader('<?php echo base_url('soap_eresep/add_new/'.$id_reg.'/'.$id_pasien.'') ?>', '#box_new_eresep', true, '');
	});
});

</script>

<!-- LABORATORIUM -->
<script>
$(document).ready(function() {
	inner_loader('<?php echo base_url('lab/splab/lab_modal_lad/'.$id_reg.'/asm_ri') ?>', '#loader_box_lab', true, '');
	
	inner_loader('<?php echo base_url('rad/radiologi/rad_modal_lad/'.$id_reg.'/asm_ri') ?>', '#loader_box_rad', true, '');
	
	inner_loader('<?php echo base_url('fisio/rehabmedik/fisio_modal_lad/'.$id_reg.'/asm_ri') ?>', '#loader_box_rehab', true, '');
	
	inner_loader('<?php echo base_url('op_order/content_op/'.$id_reg.'/'.$id_pasien.'/asm_ri') ?>', '#loader_box_op', true, '');
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
$(document).ready(function() {
	inner_loader('<?php echo base_url('drawing/canvas_drawing/'.$id_reg.'/'.$id_pasien.'/ri'); ?>', '#box_drawing_canvas', true,'');
});
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
	$('#frm_asm_ri_dokter').submit(function(event) {
		event.preventDefault(); //prevent default action 
	
		var post_url = $(this).attr("action"); //get form action url
		var form_data = $(this).serialize(); //Encode form elements for submission
	
		$.post(post_url, form_data, function(response) {
			alert('Response :' + response);
			//inner_loader('<?php echo base_url('erm_ranap/asm_ranap/'.$id_reg) ?>', '#box_asm_awal_ranap', false, '');
			location.reload(); 
		});
	});
</script>
<script>
$('#frm_asm_ri_dokter').find(':radio[name=asal_masuk][value="<?php echo $row['asal_masuk']; ?>"]').prop('checked', true).val();

$('#frm_asm_ri_dokter').find(':radio[name=cara_masuk][value="<?php echo $row['cara_masuk']; ?>"]').prop('checked', true).val();


</script>