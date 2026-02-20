
<!-- Add New Resep content -->
<style>
.ui-autocomplete-loading {
	background: white url("https://jqueryui.com/resources/demos/autocomplete/images/ui-anim_basic_16x16.gif") right center no-repeat;
}
.ui-autocomplete { z-index:2147483647; }
</style>
  
<link href="<?php echo base_url(''); ?>assets/css/eresep.css" rel="stylesheet" type="text/css">		
  <h5>Item resep baru : </h5>
  <div class="table-responsive" style=" border:#CCC thin solid; max-width:900px">
  	<form id="frm_draft" method="post" action="<?php echo base_url('soap_eresep/save_eresep'); ?>">
      <input type="text" name="id_reg" value="<?php echo $id_reg; ?>" class="hidden">
      <h6>Obat Non-Racikan</h6>
      <table class="table table-bordered table-hover table-striped table-responsive">
        <tbody id="tbody_draft">
          <tr>
            <th scope="col">Obat</th>
            <th scope="col">Jenis</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Dosis</th>
            <th scope="col">Frekwensi</th>
            <th scope="col">Waktu</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Fungsi</th>
          </tr>
        </tbody>
      </table>
      <h6>Obat Racikan</h6>
      <table class="table table-bordered table-hover table-striped table-responsive">
        <tbody id="tbody_draft_resep_racikan">
        	<tr>
          </tr>
          <tr>
            <th scope="col">Obat</th>
            <th scope="col">Jenis</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Dosis</th>
            <th scope="col">Frekwensi</th>
            <th scope="col">Waktu</th>
            <th scope="col">Kemasan</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Fungsi</th>
          </tr>
        </tbody>
      </table>
      <div class="col-sm-12 text-right">
      	<button type="submit" class="btn btn-secondary hidden" id="butt_simpan_resep">Simpan</button>
        <button type="button" class="btn btn-secondary hidden" id="batal_new_eresep" onClick="javascript: batalkan_resep('<?php echo $id_reg; ?>');">BATAL</button>
      </div>
    </form>
  </div>
  
  
  
  
  <div class="row">
		
    
    
    
    
    <!-- DIV TENTANG OBAT BIASA -->  
  	<div class="col-sm-6" style="margin-top:5px; border:#CCC thin solid; padding-top:5px;">
    	<h5 class="alert-warning" style="margin-top:20px;">Obat Non-Racikan : </h5>
      
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
          <button type="button" class="btn btn-secondary" id="addrow">Masukan ke Resep</button>
          <button type="submit" class="btn btn-secondary" data-toggle="modal" data-target="#modal_racikan">Tambah Racikan</button>
        </div>
    	</div>
  	</div>
  	<!-- end DIV TENTANG OBAT BIASA -->  
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
  </div>
<!-- /.end of add new eresep content -->

<!-- Modal -->
<!--
<div class="modal fade" id="modal_racikan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Form Racikan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal_racikan_body">
-->
<!-- The Modal -->
<div class="modal" id="modal_racikan">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Form Racikan</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div> 
			<!-- Modal body -->
			<div class="modal-body" id="modal_racikan_body">

        <!-- DIV TENTANG RACIKAN -->
        <div class="col-sm-12" style="margin-top:5px; border:#CCC thin solid; padding-top:5px;">
          <h5 class="alert-warning" style="margin-top:20px;">Obat Racikan : </h5>
          
          <h5>Form obat untuk diracik : </h5>
          <div class="col-sm-12" style="margin-top:5px; border:#CCC thin solid; padding-top:5px;">
            <div class="col-sm-10">
              
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Obat</label>
                  <div class="col-sm-9">
                    <div class="ui-widget">
                      <input id="frm_obat" class="form-control">
                      <input type="text" id="frm_id_fa" name="frm_id_fa" class="hidden" style="z-index:9999">
                    </div>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Jenis</label>
                  <div class="col-sm-9">
                      <input id="frm_jenis_obat" name="frm_jenis_obat" class="form-control">
                  </div>
                </div>
            
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Jumlah</label>
                  <div class="col-sm-9">
                    <input id="frm_qty" name="frm_qty" class="form-control">
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Dosis</label>
                  <div class="col-sm-9">
                    <div class="ui-widget">
                      <input id="frm_dosis" name="frm_dosis" class="form-control">
                    </div>
                  </div>
                </div>
                    
            </div>
            <div class="form-group row" style="margin-top:10px;">
              <div class="col-sm-12">
                <button type="button" class="btn btn-secondary" id="addrow_to_racikan">Masukan ke racikan</button>
              </div>
            </div>
          </div>
          
          <!-- TABLE racikan sementara -->
          <form id="temp_racikan_di_modal">
            <div class="table-responsive" style=" border:#CCC thin solid; max-width:900px">
                <table class="table table-bordered table-hover table-striped table-responsive">
                  <tbody id="tbody_draft_racikan">
                    <tr>
                      <th scope="col">Obat</th>
                      <th scope="col">Jenis</th>
                      <th scope="col">Jumlah</th>
                      <th scope="col">Dosis</th>
                      <th scope="col">Fungsi</th>
                    </tr>
                  </tbody>
                </table>
            </div>
        	</form>
        
          <h5 style="margin-top:20px;">Detail Template Racikan : </h5>
          <div class="col-sm-12" style="margin-top:5px; border:#CCC thin solid; padding-top:5px;">
            <div class="col-sm-12">
                            
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
                      <input type="radio" name="kemasan" value="Syrup" checked>&nbsp;Syrup
                    </label>&nbsp;&nbsp;
                    <label class="radio-inline">
                      <input type="radio" name="kemasan" value="Kapsul">&nbsp;Kapsul
                    </label>&nbsp;&nbsp;
                    <label class="radio-inline">
                      <input type="radio" name="kemasan" value="Pulveres">&nbsp;Pulveres
                    </label>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Frekwensi</label>
                  <div class="col-sm-8">
                      <input id="frekwensi_tpl" name="frekwensi_tpl" class="form-control">
                  </div>
                </div>
            
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Waktu</label>
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
        
        </div>
        
        <!-- end DIV TENTANG RACIKAN -->

      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-secondary" onClick="javascript: test_temp();">Test Array</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal/Tutup</button>
        <button type="button" class="btn btn-primary" id="add_racikan_to_resep">Masukan ke Resep</button>
      </div>
    </div>
  </div>
</div>
<input type="hidden" id="id_num" value="0">
<input type="hidden" id="num_resep_racikan" value="0">
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
						'<td>'+obat+'				<input type="hidden" name="obat[]" 				value="'+obat+'"></td> \n ' +
						'<td>'+jenis_obat+'	<input type="hidden" name="jenis_obat[]" 	value="'+jenis_obat+'"><input type="hidden" name="id_fa[]" 	value="'+id_fa+'"></td> \n ' +
						'<td>'+qty+'				<input type="hidden" name="qty[]" 				value="'+qty+'"></td> \n ' +
						'<td>'+dosis+'			<input type="hidden" name="dosis[]" 			value="'+dosis+'"></td> \n ' +
						'<td>'+frekwensi+'	<input type="hidden" name="frekwensi[]" 	value="'+frekwensi+'"></td> \n ' +
						'<td>'+tme+'				<input type="hidden" name="tme[]" 				value="'+tme+'"></td> \n ' +
						'<td>'+note+'				<input type="hidden" name="note[]" 				value="'+note+'"></td> \n ' +
						'<td><a href="#" onclick="javascript: if(confirm(\'Hapus ?\')) remove_row_draft(\''+id_fa+'\');return false;">Hapus</a></td> \n ' +
					'</tr>';
	$( "#tbody_draft" ).append(tpl_row);
	
	$('#butt_simpan_resep').removeClass('hidden');
	$('#batal_new_eresep').removeClass('hidden');
});

function remove_row_draft(id_fa)
{
	$("#" + id_fa ).remove();	
}

$('#frm_draft').submit(function(event){
	event.preventDefault(); //prevent default action 
	var post_url = $(this).attr("action"); //get form action url
	var form_data = $(this).serialize(); //Encode form elements for submission
	
	$.post( post_url, form_data, function( response ) {
	  $("#tab_eresep").html( response );
	});
});

function batalkan_resep(id_reg)
{
	$( "#tab_eresep" ).load( "<?php echo base_url('soap_eresep/riwayat_resep/'); ?>" + id_reg );
}

// -------------- RACIKAN FUNCTION -------------------
$('#addrow_to_racikan').click(function(e) {
	var id_num = $( "#id_num" ).val();
  var obat 				= $('#frm_obat').val();
	var id_fa 			= $('#frm_id_fa').val();
	var jenis_obat 	= $('#frm_jenis_obat').val();
	var qty 				= $('#frm_qty').val();
	var dosis 			= $('#frm_dosis').val();
	
	var tpl_row = '\n' + 
					'<tr id="racikan_'+id_fa+'"> \n ' +
						'<td>'+obat+'				<input type="hidden" name="obat_'+id_num+'" 				value="'+obat+'"></td> \n ' +
						'<td>'+jenis_obat+'	<input type="hidden" name="jenis_obat_'+id_num+'" 	value="'+jenis_obat+'"><input type="hidden" name="id_fa_'+id_num+'" 	value="'+id_fa+'"></td> \n ' +
						'<td>'+qty+'				<input type="hidden" name="qty_'+id_num+'" 				value="'+qty+'"></td> \n ' +
						'<td>'+dosis+'			<input type="hidden" name="dosis_'+id_num+'" 			value="'+dosis+'"></td> \n ' +
						'<td><a href="#" onclick="javascript: if(confirm(\'Hapus ?\')) remove_row_draft_racikan(\''+id_fa+'\');return false;">Hapus</a></td> \n ' +
					'</tr>';
	$( "#tbody_draft_racikan" ).append(tpl_row);
	id_num++;
	$( "#id_num" ).val(id_num);
	console.log(id_num);
	clear_form_add_row_racikan();
});

function test_temp()
{
	var id_num = $( "#id_num" ).val();
	for(i=0;i<id_num;i++)
	{
		var obat 				= $("input[name='obat_"+i+"']").val();
		var id_fa 			= $("input[name='id_fa_"+i+"']").val();
		var jenis_obat 	= $("input[name='jenis_obat_"+i+"']").val();
		var qty 				= $("input[name='qty_"+i+"']").val();
		var dosis 			= $("input[name='dosis_"+i+"']").val();
		console.log(obat);
		console.log(id_fa);
		console.log(jenis_obat);
		console.log(qty);
		console.log(dosis);
	}
}

$('#add_racikan_to_resep').click(function(e) {
		var radios = document.getElementsByName('kemasan');
		for (var i = 0, length = radios.length; i < length; i++) {
			if (radios[i].checked) {
					var selected_kemasan = radios[i].value;
					break;
			}
		}
		var id_num = $( "#id_num" ).val();
		var num_resep_racikan = $( "#num_resep_racikan" ).val();		
		// --- header racikan ---
		var nama_racikan 			= $('#nama_racikan').val();
		var kemasan_racikan 	= selected_kemasan;
		//var kemasan 				= 'pulperes';
		var frekwensi_racikan = $('#frekwensi_tpl').val();
		var tme_racikan 			= $('#tme_tpl').val();
		var note_racikan 			= $('#note_tpl').val();
		var tpl_row = '\n' + 
						'<tr id="row_racikan_'+num_resep_racikan+'">' +
							'<td colspan="4">'+nama_racikan+'	<input type="hidden" name="nama_racikan['+num_resep_racikan+']" 				value="'+nama_racikan+'"></td> \n ' +
							'<td>'+frekwensi_racikan+'				<input type="hidden" name="frekwensi_racikan['+num_resep_racikan+']" 	value="'+frekwensi_racikan+'"></td> \n ' +
							'<td>'+tme_racikan+'							<input type="hidden" name="tme_racikan['+num_resep_racikan+']" 				value="'+tme_racikan+'"></td> \n ' +
							'<td>'+kemasan_racikan+'					<input type="hidden" name="kemasan_racikan['+num_resep_racikan+']" 		value="'+kemasan_racikan+'"></td> \n ' +
							'<td>'+note_racikan+'							<input type="hidden" name="note_racikan['+num_resep_racikan+']" 				value="'+note_racikan+'"></td> \n ' +
							'<td><a href="#" onclick="javascript: if(confirm(\'Hapus ?\')) remove_row_resep_racikan(\''+num_resep_racikan+'\');return false;">Hapus</a></td> \n ' +
						'</tr>';
		$('#tbody_draft_resep_racikan').append(tpl_row);
		console.log(id_num);
		
		for(i=0;i<id_num;i++)
		{
			var obat 				= $("input[name='obat_"+i+"']").val();
			var id_fa 			= $("input[name='id_fa_"+i+"']").val();
			var jenis_obat 	= $("input[name='jenis_obat_"+i+"']").val();
			var qty 				= $("input[name='qty_"+i+"']").val();
			var dosis 			= $("input[name='dosis_"+i+"']").val();
			//console.log(myobat);	
			var tpl_row = '\n' + 
							'<tr class="row_racikan_det_'+num_resep_racikan+'"> \n ' +
								'<td>'+obat+'				<input type="hidden" name="det_racikan_obat['+num_resep_racikan+']['+i+']" 	value="'+obat+'"></td> \n ' +
								'<td>'+jenis_obat+'	<input type="hidden" name="det_jenis_obat['+num_resep_racikan+']['+i+']" 		value="'+jenis_obat+'"> \n ' +
								'										<input type="hidden" name="det_id_fa['+num_resep_racikan+']['+i+']" 					value="'+id_fa+'"></td> \n ' +
								'<td>'+qty+'				<input type="hidden" name="det_racikan_qty['+num_resep_racikan+']['+i+']" 		value="'+qty+'"></td> \n ' +
								'<td>'+dosis+'			<input type="hidden" name="det_racikan_dosis['+num_resep_racikan+']['+i+']" 	value="'+dosis+'"></td> \n ' +
								'<td colspan="5">&nbsp;</td> \n ' +
							'</tr>';
			$('#tbody_draft_resep_racikan').append(tpl_row);
		}
		$('#butt_simpan_resep').removeClass('hidden');
		$('#batal_new_eresep').removeClass('hidden');
		
		num_resep_racikan++;
		$( "#num_resep_racikan" ).val(num_resep_racikan);
		console.log(num_resep_racikan);

		//clear_modal_racikan();
		$('#modal_racikan').modal('hide');
});

var modal_racikan_starter = $('#modal_racikan_body').html();
$('#modal_racikan').on('hidden.bs.modal', function (e) {
  clear_modal_racikan();
})
function clear_modal_racikan()
{
	$("#id_num").val('0');
	$('#modal_racikan_body').empty();
	$('#modal_racikan_body').html(modal_racikan_starter);
}

function remove_row_resep_racikan(id_row)
{
	$("#row_racikan_" + id_row ).remove();
	$(".row_racikan_det_" + id_row ).remove();
}

 
function clear_form_add_row_racikan()
{
	$('#frm_obat').val('');
	$('#frm_id_fa').val('');
	$('#frm_jenis_obat').val('');
	$('#frm_qty').val('');
	$('#frm_dosis').val('');
}

function remove_row_draft_racikan(id_fa)
{
	$("#racikan_" + id_fa ).remove();	
}

</script>
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

$( function() {
	$( "#frm_dosis" ).autocomplete({
		source: "<?php echo base_url('soap_eresep/inner_get_data_autocomplet_obat_dosis'); ?>",
		minLength: 1,
		select: function( event, ui ) {
		}
	});
});

// ----------------------------------------------------------------------------------------
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

