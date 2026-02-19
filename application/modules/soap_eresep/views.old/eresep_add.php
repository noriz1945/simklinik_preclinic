<!doctype html>
<html>
<head>
<?php $this->theme->head('theme_default'); ?>
  <style>
  .ui-autocomplete-loading {
    background: white url("https://jqueryui.com/resources/demos/autocomplete/images/ui-anim_basic_16x16.gif") right center no-repeat;
  }
  </style>
  
<link href="<?php echo base_url(''); ?>assets/css/eresep.css" rel="stylesheet" type="text/css">
</head>

<?php $this->theme->wrapper_open('theme_default'); ?>

<div class="container-fluid">

    <!-- Main content -->
		
  <h5>Item resep baru : </h5>
  <div class="table-responsive" style=" border:#CCC thin solid; max-width:900px">
  	<form id="frm_draft" method="post" action="<?php echo base_url('soap_eresep/save_eresep'); ?>">
      <input type="text" name="id_reg" value="<?php echo $id_reg; ?>" class="hidden">
      <table class="table table-bordered table-hover table-striped table-responsive">
        <tbody id="tbody_draft">
          <tr>
            <th scope="col">Obat</th>
            <th scope="col">Jenis</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Dosis</th>
            <th scope="col">Frekwensi</th>
            <th scope="col">&nbsp;</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Fungsi</th>
          </tr>
        </tbody>
      </table>
      <button type="submit" class="btn btn-secondary hidden" id="butt_simpan_resep">Simpan</button>
    </form>
  </div>
  
  <div class="col-sm-6" style="margin-top:5px; border:#CCC thin solid; padding-top:5px;">
    <div class="col-sm-10">
      <form>
      
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Obat</label>
          <div class="col-sm-9">
            <div class="ui-widget">
              <input id="obat" class="form-control">
              <input type="text" id="id_fa" name="id_fa" class="hidden">
            </div>
          </div>
        </div>
        
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Jenis</label>
          <div class="col-sm-9">
              <input id="jenis_obat" name="jenis_obat" class="form-control">
          </div>
        </div>
    
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Jumlah</label>
          <div class="col-sm-9">
            <input id="qty" name="qty" class="form-control">
          </div>
        </div>
        
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Dosis</label>
          <div class="col-sm-9">
            <div class="ui-widget">
              <input id="dosis" name="dosis" class="form-control">
            </div>
          </div>
        </div>
        
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Frekwensi</label>
          <div class="col-sm-9">
            <div class="ui-widget">
              <input id="frekwensi" name="frekwensi" class="form-control">
            </div>
          </div>
        </div>
        
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Waktu</label>
          <div class="col-sm-9">
            <div class="ui-widget">
              <input id="tme" name="tme" class="form-control">
            </div>
          </div>
        </div>
        
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Keterangan</label>
          <div class="col-sm-9">
            <input id="note" name="note" class="form-control">
          </div>
        </div>
    
      </form>
    </div>
    <div class="form-group row" style="margin-top:10px;">
        <div class="col-sm-12">
          <button type="button" class="btn btn-secondary" id="addrow">ADD ROW</button>
          <button type="button" class="btn btn-secondary" id="addracikan">ADD RACIKAN</button>
          <button type="button" class="btn btn-secondary" id="picktemplate_racikan">TEMPLATE RACIKAN</button>
        </div>
    </div>
  </div>


    <!-- /.content -->
		
</div>

<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>

<script>
$( function() {
	$( "#obat" ).autocomplete({
		source: "<?php echo base_url('soap_eresep/inner_get_data_autocomplet_obat'); ?>",
		minLength: 3,
		select: function( event, ui ) {
			$("#jenis_obat").val(ui.item.jenis_obat);
			$("#id_fa").val(ui.item.id_fa);
		}
	});
});

$( function() {
	$( "#dosis" ).autocomplete({
		source: "<?php echo base_url('soap_eresep/inner_get_data_autocomplet_obat_dosis'); ?>",
		minLength: 1,
		select: function( event, ui ) {
		}
	});
});

$( function() {
	$( "#frekwensi" ).autocomplete({
		source: "<?php echo base_url('soap_eresep/inner_get_data_autocomplet_obat_frekwensi'); ?>",
		minLength: 1,
		select: function( event, ui ) {
		}
	});
});

$( function() {
	$( "#tme" ).autocomplete({
		source: "<?php echo base_url('soap_eresep/inner_get_data_autocomplet_obat_tme'); ?>",
		minLength: 1,
		select: function( event, ui ) {
		}
	});
});

</script>
<script>
$('#addrow').click(function(e) {
  var obat 				= $('#obat').val();
	var id_fa 			= $('#id_fa').val();
	var jenis_obat 	= $('#jenis_obat').val();
	var qty 				= $('#qty').val();
	var dosis 			= $('#dosis').val();
	var frekwensi 	= $('#frekwensi').val();
	var tme 				= $('#tme').val();
	var note 				= $('#note').val();
	
	var tpl_row = '\n' + 
					'<tr id="'+id_fa+'"> \n ' +
						'<td>'+obat+'				<input type="text" name="obat[]" 				value="'+obat+'"></td> \n ' +
						'<td>'+jenis_obat+'	<input type="text" name="jenis_obat[]" 	value="'+jenis_obat+'"><input type="text" name="id_fa[]" 	value="'+id_fa+'"></td> \n ' +
						'<td>'+qty+'				<input type="text" name="qty[]" 				value="'+qty+'"></td> \n ' +
						'<td>'+dosis+'			<input type="text" name="dosis[]" 			value="'+dosis+'"></td> \n ' +
						'<td>'+frekwensi+'	<input type="text" name="frekwensi[]" 	value="'+frekwensi+'"></td> \n ' +
						'<td>'+tme+'				<input type="text" name="tme[]" 				value="'+tme+'"></td> \n ' +
						'<td>'+note+'				<input type="text" name="note[]" 				value="'+note+'"></td> \n ' +
						'<td><a href="#" onclick="javascript: if(confirm(\'Hapus ?\')) remove_row_draft(\''+id_fa+'\');return false;">Hapus</a></td> \n ' +
					'</tr>';
	$( "#tbody_draft" ).append(tpl_row);
	
	$('#butt_simpan_resep').removeClass('hidden');
});

function remove_row_draft(id_fa)
{
	$("#" + id_fa ).remove();	
}
</script>
</body>
</html>
