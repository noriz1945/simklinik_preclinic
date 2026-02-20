<?php #print_r($this->session->userdata('sp')); ?>
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

<?php $this->theme->wrapper_open('theme_default',$breadcrumb); ?>

<div class="container-fluid">

  <!-- Main content -->
  <form id="frm_tpl_racikan" method="post" action="<?php echo base_url('soap_eresep/mst_tpl_racikan_save_new'); ?>">
	
    <h5>Item Template Racikan : </h5>
    <div class="col-sm-6" style="margin-top:5px; border:#CCC thin solid; padding-top:5px;">
      <div class="col-sm-10">
        
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Obat</label>
            <div class="col-sm-9">
              <div class="ui-widget">
                <input id="frm_obat" class="form-control">
                <input type="text" id="frm_id_fa" name="frm_id_fa" class="hidden">
              </div>
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jenis</label>
            <div class="col-sm-9">
                <input id="frm_jenis_obat" name="frm_jenis_obat" class="form-control" readonly style="border-color:white; background-color:white;">
            </div>
          </div>
      
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jumlah per Obat</label>
            <div class="col-sm-9">
              <input id="frm_qty" name="frm_qty" class="form-control">
            </div>
          </div>
          
          <!--
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Dosis</label>
            <div class="col-sm-9">
              <div class="ui-widget">
                <input id="frm_dosis" name="frm_dosis" class="form-control">
              </div>
            </div>
          </div>
          -->
              
      </div>
      <div class="form-group row" style="margin-top:10px;">
        <div class="col-sm-12">
          <button type="button" class="btn btn-secondary" id="addrow">ADD ROW</button>
        </div>
    </div>
  	</div>
    
    <div class="table-responsive" style=" border:#CCC thin solid; max-width:900px">
        <table class="table table-bordered table-hover table-striped table-responsive">
          <tbody id="tbody_draft">
            <tr>
              <th scope="col">Obat</th>
              <th scope="col">Jenis</th>
              <th scope="col">Jumlah</th>
              <!--<th scope="col">Dosis</th>-->
              <th scope="col">Fungsi</th>
            </tr>
          </tbody>
        </table>
        <!--<button type="submit" class="btn btn-secondary hidden" id="butt_simpan_resep">Simpan</button>-->
    </div>
  
  
  	<h5 style="margin-top:20px;">Detail Template Racikan : </h5>
    <div class="col-sm-6" style="margin-top:5px; border:#CCC thin solid; padding-top:5px;">
    <div class="col-sm-12">
      
        <div class="form-group row">
          <label class="col-sm-4 col-form-label">Dokter</label>
          <div class="col-sm-8">
            <div class="ui-widget">
            	<input id="nama_dokter" name="nama_dokter" class="form-control">
              <input type="hidden" id="id_dokter" name="id_dokter" class="form-control">
            </div>
          </div>
        </div>
        
        <div class="form-group row">
          <label class="col-sm-4 col-form-label">Nama template racikan</label>
          <div class="col-sm-8">
          	<input id="nama_racikan" name="nama_racikan" class="form-control">
          </div>
        </div>
        
        <div class="form-group row">
          <label class="col-sm-4 col-form-label">Instruksi kemasan</label>
          <div class="col-sm-8">
            <label class="radio-inline">
              <input type="radio" class="form-control" name="kemasan" value="Syrup" checked>Syrup
            </label>&nbsp;&nbsp;
            <label class="radio-inline">
              <input type="radio" class="form-control" name="kemasan" value="Kapsul">Kapsul
            </label>&nbsp;&nbsp;
            <label class="radio-inline">
              <input type="radio" class="form-control" name="kemasan" value="Pulveres">Pulveres
            </label>&nbsp;&nbsp;
            <label class="radio-inline">
              <input type="radio" class="form-control" name="kemasan" value="Pulveres dtd">Pulveres dtd
            </label>&nbsp;&nbsp;
            <label class="radio-inline">
              <input type="radio" class="form-control" name="kemasan" value="Salep">Salep
            </label>
          </div>
        </div>
        
        <!-- jumlah/qty header -->
        <div class="form-group row">
          <label class="col-sm-4 col-form-label">Jumlah Racikan</label>
          <div class="col-sm-8">
            <div class="ui-widget">
              <input id="jumlah" name="jumlah_tpl" class="form-control">
            </div>
          </div>
        </div>
        
        <!-- dosis header -->
        <div class="form-group row">
          <label class="col-sm-4 col-form-label">Dosis</label>
          <div class="col-sm-8">
            <div class="ui-widget">
              <input id="dosis_tpl" name="dosis_tpl" class="form-control">
            </div>
          </div>
        </div>
          
        <div class="form-group row">
          <label class="col-sm-4 col-form-label">Frekwensi</label>
          <div class="col-sm-8">
              <input id="frekwensi_tpl" name="frekwensi_tpl" class="form-control">
          </div>
        </div>
    
        <div class="form-group row">
          <label class="col-sm-4 col-form-label">Waktu/Cara Pemberian</label>
          <div class="col-sm-8">
            <input id="tme_tpl" name="tme_tpl" class="form-control">
          </div>
        </div>
        
        <div class="form-group row">
          <label class="col-sm-4 col-form-label">Keterangan</label>
          <div class="col-sm-8">
            <div class="ui-widget">
              <input id="note_tpl" name="note_tpl" class="form-control">
            </div>
          </div>
        </div>
            
    </div>
  </div>
  <div class="col-sm-6 text-right" style="padding-top:5px;">
		<button type="submit" class="btn btn-secondary" id="butt_simpan_resep">Simpan</button>
  </div>
	</form>
    <!-- /.content -->
		
</div>

<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>

<script>
$( function() {
	$( "#frm_obat" ).autocomplete({
		source: "<?php echo base_url('soap_eresep/inner_get_data_autocomplet_obat'); ?>",
		minLength: 3,
		select: function( event, ui ) {
			$("#frm_jenis_obat").val(ui.item.jenis_obat);
			$("#frm_id_fa").val(ui.item.id_fa);
		}
	});
});

/*
$( function() {
	$( "#frm_dosis" ).autocomplete({
		source: "<?php #echo base_url('soap_eresep/inner_get_data_autocomplet_obat_dosis'); ?>",
		minLength: 1,
		select: function( event, ui ) {
		}
	});
});
*/

// ----------------------------------------------------------------------------------------
$( function() {
	$( "#nama_dokter" ).autocomplete({
		source: "<?php echo base_url('soap_eresep/inner_get_data_autocomplet_nama_dokter'); ?>",
		minLength: 1,
		select: function( event, ui ) {
			$("#id_dokter").val(ui.item.id);
		}
	});
});

$( function() {
	$( "#dosis_tpl" ).autocomplete({
		source: "<?php echo base_url('soap_eresep/inner_get_data_autocomplet_obat_dosis'); ?>",
		minLength: 1,
		select: function( event, ui ) {
		}
	});
});

$( function() {
	$( "#frekwensi_tpl" ).autocomplete({
		source: "<?php echo base_url('soap_eresep/inner_get_data_autocomplet_obat_frekwensi'); ?>",
		minLength: 1,
		select: function( event, ui ) {
		}
	});
});

$( function() {
	$( "#tme_tpl" ).autocomplete({
		source: "<?php echo base_url('soap_eresep/inner_get_data_autocomplet_obat_tme'); ?>",
		minLength: 1,
		select: function( event, ui ) {
		}
	});
});

</script>
<script>
$('#addrow').click(function(e) {
  var obat 				= $('#frm_obat').val();
	var id_fa 			= $('#frm_id_fa').val();
	var jenis_obat 	= $('#frm_jenis_obat').val();
	var qty 				= $('#frm_qty').val();
	//var dosis 			= $('#frm_dosis').val();
	
	var tpl_row = '\n' + 
					'<tr id="'+id_fa+'"> \n ' +
						'<td>'+obat+'				<input type="text" name="obat[]" 				value="'+obat+'"></td> \n ' +
						'<td>'+jenis_obat+'	<input type="text" name="jenis_obat[]" 	value="'+jenis_obat+'"> \n ' +
						'										<input type="text" name="id_fa[]" 	value="'+id_fa+'"></td> \n ' +
						'<td>'+qty+'				<input type="text" name="qty[]" 				value="'+qty+'"></td> \n ' +
						//'<td>'+dosis+'			<input type="text" name="dosis[]" 			value="'+dosis+'"></td> \n ' +
						'<td><a href="#" onclick="javascript: if(confirm(\'Hapus ?\')) remove_row_draft(\''+id_fa+'\');return false;">Hapus</a></td> \n ' +
					'</tr>';
	$( "#tbody_draft" ).append(tpl_row);
	
	//$('#butt_simpan_resep').removeClass('hidden');
	clear_form_add_row();
});

function clear_form_add_row()
{
	$('#frm_obat').val('');
	$('#frm_id_fa').val('');
	$('#frm_jenis_obat').val('');
	$('#frm_qty').val('');
	//$('#frm_dosis').val('');
}

function remove_row_draft(id_fa)
{
	$("#" + id_fa ).remove();	
}
</script>
</body>
</html>
