<script>
var id_reg = '<?php echo $id_reg; ?>';
var id_pasien = '<?php echo $id_pasien; ?>';
</script>
<style>
hr{
	margin-top:3px;
	margin-bottom:5px;
}
</style>
<div class="container-fluid">
	
  <div class="row pnl">
    <div class="col-md-6">
      <div class="row">
        <div class="col-sm-3">
          <label class="control-label">Tanggal Masuk :</label>
        </div>
        <div class="col-sm-9">
          <label class="control-label">xxxxxxxxxxxxxxx</label>
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
          <input type="text" name="tgl_pengkajian" id="tgl_pengkajian" class="form-control tanggal" value="">
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
          placeholder="Keluhan Utama"></textarea>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label">Riwayat Penyakit Sekarang :</label>
        <textarea class="form-control input-focus area-scroll" id="riwayat_sakit_now"
          name="riwayat_sakit" rows="5" placeholder="Riwayat Penyakit Sekarang"></textarea>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label">Riwayat Penyakit Dahulu :</label>
        <textarea class="form-control input-focus area-scroll" id="riwayat_sakit_old"
          name="riwayat_sakit_dulu" rows="5" placeholder="Riwayat Penyakit Dahulu"></textarea>
      </div>
    </div>

    <!--/span-->
    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label">Riwayat Pengobatan/Operasi/Obstetri :</label>
        <textarea class="form-control input-focus area-scroll" id="riwayat_pengobatan"
          name="riwayat_pengobatan" rows="5" placeholder="Riwayat Pengobatan/Operasi/Obstetri"></textarea>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label">Riwayat Penyakit Keluarga :</label>
        <textarea class="form-control input-focus area-scroll" id="riwayat_sakit_keluarga"
          name="riwayat_sakit_keluarga" rows="5" placeholder="Riwayat Penyakit Keluarga"></textarea>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label">Riwayat Alergi :</label>
        <textarea class="form-control input-focus area-scroll" id="riwayat_alergi" name="riwayat_alergi"
          rows="5" placeholder="Riwayat Alergi"></textarea>
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
          placeholder="Objective"></textarea>
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
        <input type="text" class="form-control input-sm" id="kesadaran" name="kesadaran" placeholder="Kesadaran">
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Keadaan Umum</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="keadaan_umum" name="keadaan_umum" placeholder="Keadaan Umum">
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Tekanan Darah</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="txt_tek_darah" name="td" placeholder="Tekanan Darah">
      </div>
    </div>


    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">GCS</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="txt_gcs" name="gcs" placeholder="GCS">
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Nadi</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="txt_nadi" name="nadi" placeholder="Nadi">
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">SUHU</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="suhu" name="txt_suhu" placeholder="SUHU">
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Pernafasan</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="txt_nafas" name="nafas" placeholder="Pernafasan">
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Reaksi Cahaya</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="txt_cahaya" name="reaksi_cahaya" placeholder="Reaksi Cahaya">
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Tinggi Badan</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="txt_tinggi" name="tinggi" placeholder="Tinggi Badan">
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Berat Badan</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="txt_berat" name="berat" placeholder="Berat Badan">
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
    		<h4>Diagnosa Medis dan Diagniosa Banding</h4>
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
					<input id="name_icd_ten[<?php echo $i; ?>]" name="name_icd_ten[<?php echo $i; ?>]" class="form-control">
				</div>
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
        <input id="id_icd_ten[<?php echo $i; ?>]" name="id_icd_ten[<?php echo $i; ?>]" class="form-control" readonly>
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

	<h3 class="pnl-head-3">PLANNING</h3>
  <div class="row pnl pnl-plan">
  	<!--
    <div class="col-md-12">
      <div class="form-group">
        <label class="control-label"><strong>PLANNING</strong></label>
        <hr>
      </div>
    </div>
		-->
    <!--
    <div class="col-md-12">
      <div class="form-group">
        <label class="control-label"><strong>ICD 9</strong></label>
      </div>
    </div>
    <br>

    <div class="col-md-12">
      <div class="form-group">
        <label class="control-label"><strong>NON ICD 9</strong></label>
      </div>
    </div>
    <br>
		-->
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
					<input id="name_icd_nine[<?php echo $i; ?>]" name="name_icd_nine[<?php echo $i; ?>]" class="form-control">
				</div>
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
        <input id="id_icd_nine[<?php echo $i; ?>]" name="id_icd_nine[<?php echo $i; ?>]" class="form-control" readonly>
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
          placeholder="Instruksi"></textarea>
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

		<div class="col-md-12" style="margin-top:30px">
      <div class="form-group">
        <h4>LABORATORIUM</h4>
        <hr>
      </div>
    </div>
    <div class="col-md-12">
    	<!--
      <div class="form-group">
        <label class="control-label"><strong>LABORATORIUM ORDER</strong></label>
        <div class="input_fields_lab">
          <input type="text" id="txt_lab_order[]" name="txt_lab_order[]" placeholder="LABORATORIUM ORDER" size="95%">
          <button class="btn btn-info add_field_lab fa fa-plus"> ORDER LAB</button>
        </div>
      </div>
			-->
      
      <div class="form-group">
        <button type="button" class="btn btn-info add-new fa fa-plus" onclick="javascript:indexlab('1019SA14258')" > ORDER LABORATORIUM</button>
      </div>
    </div>

		<div class="col-md-12" style="margin-top:30px">
      <div class="form-group">
        <h4>RADIOLOGI</h4>
        <hr>
      </div>
    </div>
    
    <div class="col-md-12">
      <div class="form-group">
        <button type="button" class="btn btn-info add-new fa fa-plus" onclick="javascript:indexrad('1019SA14258')" > ORDER RADIOLOGI</button>
      </div>
    </div>
    
    <div class="col-md-12" style="margin-top:30px">
      <div class="form-group">
        <h4>REHAB MEDIK</h4>
        <hr>
      </div>
    </div>
    
    <div class="col-md-12">
      <div class="form-group">
        <button type="button" class="btn btn-info add-new fa fa-plus" onclick="javascript:indexrehab('1119SA00228')" > ORDER REHAB MEDIK</button>
      </div>
    </div>
    
    <div class="col-md-12" style="margin-top:30px">
      <div class="form-group">
        <h4>OPERASI</h4>
        <hr>
      </div>
    </div>
    
    <div class="col-md-12">
      <div class="form-group">
        <button type="button" class="btn btn-info add-new fa fa-plus" onclick="javascript:indexop('1119SA00228','00780294')" > ORDER OPERASI</button>
      </div>
    </div>

  </div>

</div>

<!-- modal here -->
<div class="modal animated bounceIn" id="Modallabmod" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg modal-lg-smart" role="document">
		<div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">FORM ORDER LAB</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

			<div class="modal-body" id="ModalBodylabmod" >

			</div>
		</div>
	</div>
</div>

<div class="modal animated bounceIn" id="Modalradmod" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg modal-lg-smart" role="document">
		<div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">FORM ORDER RADIOLOGI</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

			<div class="modal-body" id="ModalBodyradmod">

			</div>
		</div>
	</div>
</div>

<div class="modal animated bounceIn" id="Modalrehabmod" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg modal-lg-smart" role="document">
		<div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">FORM ORDER REHAB MEDIK</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

			<div class="modal-body" id="ModalBodyrehabmod" >

			</div>
		</div>
	</div>
</div>

<div class="modal animated bounceIn" id="Modalopmod" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg modal-lg-smart" role="document">
		<div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">FORM ORDER OPERASI</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

			<div class="modal-body" id="ModalBodyopmod" >

			</div>
		</div>
	</div>
</div>

<?php $this->theme->script('theme_default'); ?>

<!-- action here -->
<script>
$(document).ready(function() {
	var max_fields_lab      = 10; //maximum input boxes allowed
	var wrapper_lab   		= $(".input_fields_lab"); //Fields wrapper_lab
	var add_button_lab     = $(".add_field_lab"); //Add button ID
	var x = 1; //initlal text box count
	$(add_button_lab).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields_lab){ //max input box allowed
			x++; //text box increment
			$(wrapper_lab).append('<div><input type="text" id="txt_lab_order[]" name="txt_lab_order[]" placeholder="LAB ORDER" size="95%"> <button class="btn btn-danger remove_field_lab fa fa-trash"> HAPUS ORDER</button></div>'); //add input box
		}
	});

  $(wrapper_lab).on("click",".remove_field_lab", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	})

  var max_fields_rad  = 10; //maximum input boxes allowed
	var wrapper_rad   	= $(".input_fields_rad"); //Fields wrapper_rad
	var add_button_rad  = $(".add_field_rad"); //Add button ID
  var y = 1; //initlal text box count
	$(add_button_rad).click(function(e){ //on add input button click
		e.preventDefault();
		if(y < max_fields_rad){ //max input box allowed
			x++; //text box increment
			$(wrapper_rad).append('<div><input type="text" id="txt_rad_order[]" name="txt_rad_order[]" placeholder="rad ORDER" size="95%"> <button class="btn btn-danger remove_field_rad fa fa-trash"> HAPUS ORDER</button></div>'); //add input box
		}
	});

  $(wrapper_rad).on("click",".remove_field_rad", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	})

	$(document).ready(function() {
		inner_loader('<?php echo base_url('soap_eresep/add_new/1019SA14258/00795397') ?>', '#box_new_eresep', true, '');
	});

});

</script>

<!-- LABORATORIUM -->
<script>

	function indexrehab(id_reg) {
    $.get("<?php echo base_url('fisio/rehabmedik/indexrehab/') ?>" + id_reg)
      .done(function (data) {
        //alert("Data Loaded: " + data);

        $('#ModalBodyrehabmod').html(data);
        $('#Modalrehabmod').modal('show');
        //$('#myModal').modal('hide')
      });
  }
	
	function indexop(id_reg,id_pasien) {
    $.get("<?php echo base_url('op_order/modal_add_op/') ?>" + id_reg + "/" + id_pasien)
      .done(function (data) {
        //alert("Data Loaded: " + data);

        $('#ModalBodyopmod').html(data);
        $('#Modalopmod').modal('show');
        //$('#myModal').modal('hide')
      });
  }
	
  function indexlab(id_reg) {
		/*
    $.get("<?php echo base_url('lab/splab/indexlab/') ?>" + id_reg)
      .done(function (data) {
        //alert("Data Loaded: " + data);

        $('#ModalBodylabmod').html(data);
        $('#Modallabmod').modal('show');
        //$('#myModal').modal('hide')
      });
			*/
			inner_loader('<?php echo base_url('lab/splab/indexlab/1019SA14258'); ?>', '#ModalBodylabmod', true,'');
			$('#Modallabmod').modal('show');
    }

		function edit_formsplab(id_digit) {
      $.get("<?php echo base_url('lab/splab/edit_formsplab/') ?>" + id_digit)
        .done(function (data) {
          //alert("Data Loaded: " + data);

          $('#ModalBodylabmod').html(data);
          $('#Modallabmod').modal('show');
          //$('#myModal').modal('hide')
        });
    }


		$(".delbutton").click(function(){
       //Save the link in a variable called element
       var element = $(this);
       //Find the id of the link that was clicked
       var id_digit = element.attr("id");
       //Built a url to send
       var info = 'id=' + id_digit;
       if(confirm("Hapus data order Lab ?"))
       {
       $.ajax({
       type: "POST",
       url : '<?php echo site_url('lab/splab/hapus_lab'); ?>/'+id_digit,
       data: info,
       success: function(){
      	 alert("Hapus data berhasil !");
      	location.reload();
       }
       });

       $(this).parents(".record").animate({ opacity: "hide" }, "slow");

       }

       return false;
   });
	 

</script>

<!-- RADIOLOGI -->
<script>

function indexrad(id_reg) {
  $.get("<?php echo base_url('rad/radiologi/indexrad/') ?>" + id_reg)
    .done(function (data) {
      //alert("Data Loaded: " + data);

      $('#ModalBodyradmod').html(data);
      $('#Modalradmod').modal('show');
      //$('#myModal').modal('hide')
    });
  }

  function edit_formsprad(id_digit) {
    $.get("<?php echo base_url('rad/radiologi/edit_formsprad/') ?>" + id_digit)
      .done(function (data) {
        //alert("Data Loaded: " + data);

        $('#ModalBodyradmod').html(data);
        $('#Modalradmod').modal('show');
        //$('#myModal').modal('hide')
      });
  }

  $(".delbutton").click(function(){
    //Save the link in a variable called element
    var element = $(this);

    //Find the id of the link that was clicked
    var id_digit = element.attr("id");

    //Built a url to send
    var info = 'id=' + id_digit;
    if(confirm("Hapus data order Radiologi ?"))
    {
    $.ajax({
    type: "POST",
    url : '<?php echo site_url('rad/radiologi/hapus_rad'); ?>/'+id_digit,
    data: info,
    success: function(){
     alert("Hapus data berhasil !");
    location.reload();
    }
    });

    $(this).parents(".record").animate({ opacity: "hide" }, "slow");

    }

    return false;
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
	inner_loader('<?php echo base_url('drawing/canvas_drawing/1019SA14258/00795397/ri'); ?>', '#box_drawing_canvas', true,'');
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