    <form>
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
            <input id="name_icd_ten[<?php echo $i; ?>]" name="name_icd_ten[<?php echo $i; ?>]" class="form-control" value="<?php echo @$data_icd_ten[$i]['combo_name']; ?>">
          </div>
        </div>
        
        <div class="col-sm-2">
          <input id="id_icd_ten[<?php echo $i; ?>]" name="id_icd_ten[<?php echo $i; ?>]" class="form-control" readonly value="<?php echo @$data_icd_ten[$i]['id_icd']; ?>">
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
        </div>
      </div>
      <?php 
      }
      ?>
      <hr>
    </form>

<script>
$(function() {
	for(i=0;i<=4;$i++){
		$("#name_icd_ten\\["+i+"\\]").autocomplete({
			source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_ten'); ?>",
			appendTo : "#modal-body-upl",
			minLength: 2,
			select: function(event, ui) {
				$("#id_icd_ten\\["+i+"\\]").val(ui.item.id);
			}
		});
	}
	
	for(i=0;i<=9;$i++){
		$("#name_icd_nine\\["+i+"\\]").autocomplete({
			source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_nine'); ?>",
			appendTo : "#modal-body-upl",
			minLength: 2,
			select: function(event, ui) {
				$("#id_icd_nine\\["+i+"\\]").val(ui.item.id);
			}	
		});
	}
});	
</script>