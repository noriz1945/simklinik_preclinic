<!-- Add New Resep content -->
<style>
.ui-autocomplete-loading {
  background: white url("https://jqueryui.com/resources/demos/autocomplete/images/ui-anim_basic_16x16.gif") right center no-repeat;
}

.ui-autocomplete {
  z-index: 2147483647;
}

.kotak_kecil {
  width: 50px;
  text-align: center;
}

.kotak_sedang {
  width: 100px;
}
</style>


<div class="row">
<div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        RIWAYAT RESEP ONLINE
      </div>
      <div class="card-body" id="box-riwayat-resep-online">
        <?php echo $list_riwayat_resep_online; ?>
      </div>
    </div>
  </div>

<div class="col-sm-12">
<form id="frm_draft" method="post" action="<?php echo base_url('soap_eresep/save_eresep_additional'); ?>">
<input type="hidden" id="id_reg" name="id_reg" value="<?php echo $id_reg; ?>" class="hidden">
<input type="hidden" id="id_pasien" name="id_pasien" value="<?php echo $id_pasien; ?>" class="hidden"> 
<input type="hidden" id="ideresep" name="ideresep" value="<?php echo $id_eresep; ?>" class="hidden">
<div class="card">
<div class="card-header">FORM EDIT RESEP</div>
<div class="card-body">
<div class="row">
<!--ehew-->
<div class="col-sm-4">
<div class="card">
<div class="card-header">
<h5>Input Obat Non-Racikan :</h5>
</div>
<div class="card-block tab-icon">
<div class="row">
<div class="col-sm-12" style="margin-top:5px; border:#CCC thin solid; padding:5px;">


<form>

  <div class="form-group row">
    <label class="col-sm-4 col-form-label">Obat</label>
    <div class="col-sm-8">
      <div class="ui-widget">
        <input id="obat" class="form-control">
        <input type="hidden" id="id_fa" name="id_fa" class="hidden" readonly>
      </div>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-4 col-form-label">Jenis</label>
    <div class="col-sm-8">
      <input id="jenis_obat" name="jenis_obat" class="form-control">
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-4 col-form-label">Jumlah</label>
    <div class="col-sm-8">
      <input id="qty" name="qty" class="form-control">
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-4 col-form-label">Dosis</label>
    <div class="col-sm-8">
      <div class="ui-widget">
        <input id="dosis" name="dosis" class="form-control">
      </div>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-4 col-form-label">Frekwensi</label>
    <div class="col-sm-8">
      <div class="ui-widget">
        <input id="frekwensi" name="frekwensi" class="form-control">
      </div>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-4 col-form-label">Waktu/Cara Pemberian</label>
    <div class="col-sm-8">
      <div class="ui-widget">
        <input id="tme" name="tme" class="form-control">
      </div>
    </div>
  </div>

  <div class="form-group row">
    <label class="col-sm-4 col-form-label">Keterangan</label>
    <div class="col-sm-8">
      <input id="note" name="note" class="form-control">
    </div>
  </div>

</form>

<div class="form-group row" style="margin-top:10px;">
    <div class="col-sm-6 text-left">
    
  </div>
  <div class="col-sm-6 text-right">
    <button type="button" class="btn btn-primary" id="addrow">Masukan ke Resep</button>
  </div>
</div>
<div class="form-group row" style="margin-top:10px;">
  <div class="col-sm-12">
    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal_racikan">Input
      Racikan</button>
    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal_pick_racikan"
      onClick="javascript: show_popup_template_racikan();">Pilih Racikan dari Template</button>
    <button type="button" class="btn btn-secondary"
      onClick="javascript: if(confirm('Batalkan Resep ?'))batalkan_resep('<?php echo $id_reg; ?>');">Batal</button>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>
<!--end ehew-->
<!--racikan & non racikan-->
<div class="col-sm-8">
<div class="card">
<div class="card-header">
<h5>Obat Non-Racikan</h5>
</div>
<div class="card-block tab-icon">
<div class="row">
<div class="table-responsive">
<table class="table table-bordered table-hover table-striped table-responsive styled-table">
  <thead>
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
  </thead>
  <tbody id="tbody_draft"></tbody>
</table>
</div>
</div>
<div class="col-sm-12 text-right">
          <button type="submit" class="btn btn-success" id="butt_simpan_resep" style="margin-bottom:10px;">Simpan</button>
          <button type="button" class="btn btn-danger hidden" id="batal_new_eresep"
            onClick="javascript: batalkan_resep('<?php echo $id_reg; ?>');" style="margin-bottom:10px;">BATAL</button>
</div>
</div>
</div>

<div class="card">
<div class="card-header">
<h5> Obat Racikan </h5>
</div>
<div class="card-block tab-icon">
<div class="row">
<div class="table-responsive">
<table class="table table-bordered table-hover table-striped table-responsive styled-table">
  <thead>
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
  </thead>
  <tbody id="tbody_draft_resep_racikan"></tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<!--non racikan & racikan-->

</div>
</div>
</div>

</div>


  </form>
</div>

    <!--MODAL SEGMENT 4-->
    <div class="modal fade" id="modal_racikan" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog modal-lg" role="document" style="max-width:80%;">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">INPUT RACIKAN</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<!--<h5>Default Modal</h5>-->
<div class="row">
<div class="col-sm-12">

<div class="card table-card">
<div class="card-block">
           <!-- DIV TENTANG RACIKAN -->
           <div class="col-sm-12" style="margin-top:5px; border:#CCC thin solid; padding-top:5px;">

              <h5 class="p-20 z-depth-top-0">Form obat untuk diracik : </h5>
              <div class="col-sm-12" style="margin-top:5px; border:#CCC thin solid; padding-top:5px;">
                <div class="col-sm-10">

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Obat</label>
                    <div class="col-sm-9">
                      <div class="ui-widget">
                        <input id="frm_obat" class="form-control" placeholder="Ketik nama obat">
                        <input type="hidden" id="frm_id_fa" name="frm_id_fa" class="hidden" style="z-index:9999">
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jenis</label>
                    <div class="col-sm-9">
                      <input id="frm_jenis_obat" name="frm_jenis_obat" class="form-control" readonly>
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
                    <button type="button" class="btn btn-secondary" id="addrow_to_racikan">Masukan ke
                      racikan</button>
                  </div>
                </div>
              </div>

              <!-- TABLE racikan sementara -->
              <form id="temp_racikan_di_modal">
                <div class="table-responsive" style=" border:#CCC thin solid; max-width:900px">
                  <table class="table table-bordered table-hover table-striped table-responsive styled-table" style="background-color:white;">
                    <tbody id="tbody_draft_racikan">
                      <tr>
                        <th scope="col">Obat</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Jumlah</th>
                        <!--<th scope="col">Dosis</th>-->
                        <th scope="col">Fungsi</th>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </form>

              <h5 class="p-20 z-depth-top-0" style="margin-top:20px;">Detail Racikan : </h5>
              <div class="col-sm-12" style="margin-top:5px; border:#CCC thin solid; padding-top:5px;">
                <div class="col-sm-12">

                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Nama Racikan</label>
                    <div class="col-sm-8">
                      <input id="nama_racikan" name="nama_racikan" class="form-control">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Instruksi kemasan</label>
                    <div class="col-sm-8">
                      <label class="radio-inline">
                        <input type="radio" class="form-control" name="kemasan" value="Syrup">Syrup
                      </label>
                      <label class="radio-inline">
                        <input type="radio" class="form-control" name="kemasan" value="Kapsul">Kapsul
                      </label>
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

                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Jumlah Racikan</label>
                                  
        <div class="col-sm-8">
                      <div class="ui-widget">
                        <input id="jumlah_tpl" name="jumlah_tpl" class="form-control">
                      </div>
                    </div>
                  </div>

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

            </div>

            <!-- end DIV TENTANG RACIKAN -->
</div>
</div>
</div>


</div>
<div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" onClick="javascript: test_temp();">Test Array</button> -->
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal/Tutup</button>
            <button type="button" class="btn btn-primary" id="add_racikan_to_resep">Masukan ke Resep</button>
          </div>
</div>
</div>

</div>
</div>
<!--END MODAL SEGMENT 4-->
    <input type="hidden" id="id_num" value="0">
    <input type="hidden" id="num_resep_racikan" value="0">


    <!--MODAL SEGMENT 4-->
<div class="modal fade" id="modal_pick_racikan" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog modal-lg" role="document" style="max-width:80%;">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">TEMPLATE RACIKAN</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<!--<h5>Default Modal</h5>-->
<div class="row">
<div class="col-sm-12">

<div class="card table-card">
<div class="card-block">
<div class="modal-body" id="modal_pick_racikan_body">
</div>
</div>
</div>


</div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal/Tutup</button>
    <button type="button" class="btn btn-primary" id="add_pick_racikan_to_resep">Masukan Template Racikan ke
      Resep</button>
  </div>
</div>

</div>
</div>
</div>
<!--END MODAL SEGMENT 4-->




















<!-- modal pick racikan -->
<div class="modal" id="modal_pick_racikans">
  <div class="modal-dialog modal-lg" style="max-width:1800px;">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Popup Pick Racikan</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body" id="modal_pick_racikan_body">


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal/Tutup</button>
        <button type="button" class="btn btn-primary" id="add_pick_racikan_to_resep">Masukan Template Racikan ke
          Resep</button>
      </div>
    </div>
  </div>
</div>
<script>
  document.getElementById("butt_simpan_resep").hidden = true;
  document.getElementById("batal_new_eresep").hidden = true;

$(function() {
	$("#obat").keydown(function(e) {
		//console.log(e.which);
    if (e.which == 190) {
			alert('Mohon maaf, simbol .(titik) pada keyboard tidak bisa digunakan untuk input resep, mungkin anda bisa mencoba tanda ,(koma)');
			return false;
    }
  });
  $("#obat").autocomplete({
    source: "<?php echo base_url('soap_eresep/inner_get_data_autocomplet_obat'); ?>",
    minLength: 3,
    select: function(event, ui) {
      $("#jenis_obat").val(ui.item.jenis_obat);
      $("#id_fa").val(ui.item.id_fa);
    }
  });
});

$(function() {
	$("#dosis").keydown(function(e) {
		//console.log(e.which);
    if (e.which == 190) {
			alert('Mohon maaf, simbol .(titik) pada keyboard tidak bisa digunakan untuk input resep, mungkin anda bisa mencoba tanda ,(koma)');
			return false;
    }
  });
  $("#dosis").autocomplete({
    source: "<?php echo base_url('soap_eresep/inner_get_data_autocomplet_obat_dosis'); ?>",
    minLength: 1,
    select: function(event, ui) {}
  });
});

$(function() {
	$("#qty").keydown(function(e) {
		//console.log(e.which);
    if (e.which == 190) {
			alert('Mohon maaf, simbol .(titik) pada keyboard tidak bisa digunakan untuk input resep, mungkin anda bisa mencoba tanda ,(koma)');
			return false;
    }
  });
});



$(function() {
	$("#frekwensi").keydown(function(e) {
		//console.log(e.which);
    if (e.which == 190) {
			alert('Mohon maaf, simbol .(titik) pada keyboard tidak bisa digunakan untuk input resep, mungkin anda bisa mencoba tanda ,(koma)');
			return false;
    }
  });
  $("#frekwensi").autocomplete({
    source: "<?php echo base_url('soap_eresep/inner_get_data_autocomplet_obat_frekwensi'); ?>",
    minLength: 1,
    select: function(event, ui) {}
  });
});


$(function() {
  $("#tme").autocomplete({
    source: "<?php echo base_url('soap_eresep/inner_get_data_autocomplet_obat_tme'); ?>",
    minLength: 1,
    select: function(event, ui) {}
  });
});
</script>
<script>
// ADD OBAT BIASA / REGULER
$('#addrow').click(function(e) {
  var obat = $('#obat').val();
  var id_fa = $('#id_fa').val();
  var jenis_obat = $('#jenis_obat').val();
  var qty = $('#qty').val();
  var dosis = $('#dosis').val();
  var frekwensi = $('#frekwensi').val();
  var tme = $('#tme').val();
  var note = $('#note').val();
  var rand_no = get_random_number();

  var tpl_row = '\n' +
    '<tr id="' + rand_no + '"> \n ' +
    '<td>' + obat + '				<input type="hidden" name="obat[]" 				value="' + obat + '"></td> \n ' +
    '<td>' + jenis_obat + '	<input type="hidden" name="jenis_obat[]" 	value="' + jenis_obat +
    '"><input type="hidden" name="id_fa[]" 	value="' + id_fa + '"></td> \n ' +
    '<td>' + qty + '				<input type="hidden" name="qty[]" 				value="' + qty + '"></td> \n ' +
    '<td>' + dosis + '			<input type="hidden" name="dosis[]" 			value="' + dosis + '"></td> \n ' +
    '<td>' + frekwensi + '	<input type="hidden" name="frekwensi[]" 	value="' + frekwensi + '"></td> \n ' +
    '<td>' + tme + '				<input type="hidden" name="tme[]" 				value="' + tme + '"></td> \n ' +
    '<td>' + note + '				<input type="hidden" name="note[]" 				value="' + note + '"></td> \n ' +
    '<td style="text-align:center"><a href="#" onclick="javascript: remove_row_draft(\'' + rand_no +
    '\');return false;"><i class="fa fa-trash" style="color:red;"></i></a></td> \n ' +
    '</tr>';
  $("#tbody_draft").append(tpl_row);

  $('#butt_simpan_resep').removeClass('hidden');
  $('#batal_new_eresep').removeClass('hidden');
	//var added_draft = $('input[name="obat\\[\\]"]');
	//alert('test : ' + added_draft.length);
	
  // --- CLEAR --------------------------
  $('#obat').val('');
  $('#id_fa').val('');
  $('#jenis_obat').val('');
  $('#qty').val('');
  $('#dosis').val('');
  $('#frekwensi').val('');
  $('#tme').val('');
  $('#note').val('');
});

function remove_row_draft(id_fa) {
   /////
 Swal.fire({
    title: 'Hapus',
    text: 'Hapus Item Obat ?' ,
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
      actions: 'my-actions',
      //cancelButton: 'order-1 right-gap',
      confirmButton: 'order-2',
      denyButton: 'order-3',
    }
    }).then((result) => {
    if (result.isConfirmed) {
          swal.fire('Hapus!','Hapus item obat berhasil!', 'success').then(function(){ 
            $("#" + id_fa).remove();
          }
        );
        
      } else if (result.isDenied) {
        Swal.fire('Batal Hapus!', 'Batal hapus item obat!', 'info')
      }
 })
 ////
}

$('#frm_draft').submit(function(event) {
  event.preventDefault(); //prevent default action 

	$('#butt_simpan_resep').attr('disabled', 'disabled');
  setTimeout(function() {
    $('#butt_simpan_resep').removeAttr('disabled');
  }, 30000);

  var post_url = $(this).attr("action"); //get form action url
  var form_data = $(this).serialize(); //Encode form elements for submission

  $.post(post_url, form_data, function(response) {
    $("#box_new_eresep_farmasi").html(response);
  });
});

function batalkan_resep(id_reg, id_pasien) {
var id_reg = $('#id_reg').val();
var id_pasien = $('#id_pasien').val();
 /////
 Swal.fire({
    title: 'Batal Edit',
    text: 'Batalkan Edit Resep ?' ,
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
      actions: 'my-actions',
      //cancelButton: 'order-1 right-gap',
      confirmButton: 'order-2',
      denyButton: 'order-3',
    }
    }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
      url : baseUrl+"soap_eresep/add_additional",
      method : "POST",
      data : {id_reg:id_reg,id_pasien:id_pasien},
      async : true,
      dataType : 'html',
      success: function(datarestind){
        $('#box_new_eresep_farmasi').html(datarestind);
      }
      });
          swal.fire('Batal!','Batal Edit Resep Berhasil!', 'success').then(function(){ 
            //$('#rinciansetadd').submit();
            /*$.ajax({
              url : baseUrl+"rincian/dataresrinc",
              method : "GET",
              data : {id_reg:id_reg},
              async : true,
              dataType : 'html',
              success: function(datarestind){
                prosesrincian(id_reg);
                location.reload();
                window.open(baseUrl+'rincian/printrincian/'+id_reg);
              }
            });*/
          }
        );
        
      } else if (result.isDenied) {
        Swal.fire('Batal Edit Resep!', 'Batal edit resep!', 'info')
      }
 })
 ////

}

// -------------- RACIKAN FUNCTION -------------------
$('#addrow_to_racikan').click(function(e) {
  var id_num = $("#id_num").val();
  var obat = $('#frm_obat').val();
  var id_fa = $('#frm_id_fa').val();
  var jenis_obat = $('#frm_jenis_obat').val();
  var qty = $('#frm_qty').val();
  //var dosis 			= $('#frm_dosis').val();

  var tpl_row = '\n' +
    '<tr id="racikan_' + id_fa + '"> \n ' +
    '<td>' + obat + '				<input type="hidden" name="obat_' + id_num + '" 				value="' + obat + '"></td> \n ' +
    '<td>' + jenis_obat + '	<input type="hidden" name="jenis_obat_' + id_num + '" 	value="' + jenis_obat +
    '"><input type="hidden" name="id_fa_' + id_num + '" 	value="' + id_fa + '"></td> \n ' +
    '<td>' + qty + '				<input type="hidden" name="qty_' + id_num + '" 				value="' + qty + '"></td> \n ' +
    //'<td>'+dosis+'			<input type="hidden" name="dosis_'+id_num+'" 			value="'+dosis+'"></td> \n ' +
    '<td style="text-align:center"><a href="#" onclick="javascript: remove_row_draft_racikan(\'' + id_fa +
    '\');return false;"><i class="fa fa-trash" style="color:red;"></i></a></td> \n ' +
    '</tr>';
  $("#tbody_draft_racikan").append(tpl_row);
  id_num++;
  $("#id_num").val(id_num);
  console.log(id_num);
  clear_form_add_row_racikan();
});

function test_temp() {
  var id_num = $("#id_num").val();
  for (i = 0; i < id_num; i++) {
    var obat = $("input[name='obat_" + i + "']").val();
    var id_fa = $("input[name='id_fa_" + i + "']").val();
    var jenis_obat = $("input[name='jenis_obat_" + i + "']").val();
    var qty = $("input[name='qty_" + i + "']").val();
    //var dosis 			= $("input[name='dosis_"+i+"']").val();
    console.log(obat);
    console.log(id_fa);
    console.log(jenis_obat);
    console.log(qty);
    //console.log(dosis);
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
  var id_num = $("#id_num").val();
  var num_resep_racikan = $("#num_resep_racikan").val();
  // --- header racikan ---
  var nama_racikan = $('#nama_racikan').val();
  var kemasan_racikan = selected_kemasan;
  //var kemasan 				= 'pulperes';
  var jumlah_racikan = $('#jumlah_tpl').val();
  var dosis_racikan = $('#dosis_tpl').val();
  var frekwensi_racikan = $('#frekwensi_tpl').val();
  var tme_racikan = $('#tme_tpl').val();
  var note_racikan = $('#note_tpl').val();
  var tpl_row = '\n' +
    '<tr id="row_racikan_' + num_resep_racikan + '">' +
    '<td colspan="2">' + nama_racikan + '	<input type="hidden" name="nama_racikan[' + num_resep_racikan +
    ']" 			value="' + nama_racikan + '"></td> \n ' +
    '<td>' + jumlah_racikan + '						<input type="hidden" name="jumlah_racikan[' + num_resep_racikan +
    ']" 			value="' + jumlah_racikan + '"></td> \n ' +
    '<td>' + dosis_racikan + '						<input type="hidden" name="dosis_racikan[' + num_resep_racikan +
    ']" 			value="' + dosis_racikan + '"></td> \n ' +
    '<td>' + frekwensi_racikan + '				<input type="hidden" name="frekwensi_racikan[' + num_resep_racikan +
    ']" 	value="' + frekwensi_racikan + '"></td> \n ' +
    '<td>' + tme_racikan + '							<input type="hidden" name="tme_racikan[' + num_resep_racikan + ']" 				value="' +
    tme_racikan + '"></td> \n ' +
    '<td>' + kemasan_racikan + '					<input type="hidden" name="kemasan_racikan[' + num_resep_racikan +
    ']" 		value="' + kemasan_racikan + '"></td> \n ' +
    '<td>' + note_racikan + '							<input type="hidden" name="note_racikan[' + num_resep_racikan +
    ']" 			value="' + note_racikan + '"></td> \n ' +
    '<td style="text-align:center"><a href="#" onclick="javascript: remove_row_resep_racikan(\'' +
    num_resep_racikan + '\');return false;"><i class="fa fa-trash" style="color:red;"></i></a></td> \n ' +
    '</tr>';
  $('#tbody_draft_resep_racikan').append(tpl_row);
  console.log(id_num);

  for (i = 0; i < id_num; i++) {
    var obat = $("input[name='obat_" + i + "']").val();
    var id_fa = $("input[name='id_fa_" + i + "']").val();
    var jenis_obat = $("input[name='jenis_obat_" + i + "']").val();
    var qty = $("input[name='qty_" + i + "']").val();
    //var dosis 			= $("input[name='dosis_"+i+"']").val();
    //console.log(myobat);	
    var tpl_row = '\n' +
      '<tr class="row_racikan_det_' + num_resep_racikan + '"> \n ' +
      '<td>' + obat + '				<input type="hidden" name="det_racikan_obat[' + num_resep_racikan + '][' + i +
      ']" 	value="' + obat + '"></td> \n ' +
      '<td>' + jenis_obat + '	<input type="hidden" name="det_jenis_obat[' + num_resep_racikan + '][' + i +
      ']" 		value="' + jenis_obat + '"> \n ' +
      '										<input type="hidden" name="det_id_fa[' + num_resep_racikan + '][' + i + ']" 				value="' + id_fa +
      '"></td> \n ' +
      '<td>' + qty + '				<input type="hidden" name="det_racikan_qty[' + num_resep_racikan + '][' + i +
      ']" 	value="' + qty + '"></td> \n ' +
      //'<td>'+dosis+'			<input type="hidden" name="det_racikan_dosis['+num_resep_racikan+']['+i+']" 	value="'+dosis+'"></td> \n ' +
      '<td colspan="5">&nbsp;</td> \n ' +
      '</tr>';
    $('#tbody_draft_resep_racikan').append(tpl_row);
  }
  $('#butt_simpan_resep').removeClass('hidden');
  $('#batal_new_eresep').removeClass('hidden');

  num_resep_racikan++;
  $("#num_resep_racikan").val(num_resep_racikan);
  console.log('num_resep_racikan : ' + num_resep_racikan);

  //clear_modal_racikan();
  $('#modal_racikan').modal('hide');

  $('.modal-backdrop').removeClass('show');
  $('.modal-backdrop').addClass('hide');
});

var modal_racikan_starter = $('#modal_racikan_body').html();
$('#modal_racikan').on('hidden.bs.modal', function(e) {
  clear_modal_racikan();
})

function clear_modal_racikan() {
  $("#id_num").val('0');
  //$('#modal_racikan_body').empty();
  //$('#modal_racikan_body').html(modal_racikan_starter);

  clear_form_header_add_racikan();

  var tr_header_form_racikan = ' <tr> ' +
    '<th scope="col">Obat</th>' +
    '<th scope="col">Jenis</th>' +
    '<th scope="col">Jumlah</th>' +
    '<th scope="col">Fungsi</th>' +
    '</tr>';
  $('#tbody_draft_racikan').html(tr_header_form_racikan);
}

function remove_row_resep_racikan(id_row) {
 /////
 Swal.fire({
    title: 'Hapus Racikan',
    text: 'Hapus Obat Racikan?' ,
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
      actions: 'my-actions',
      //cancelButton: 'order-1 right-gap',
      confirmButton: 'order-2',
      denyButton: 'order-3',
    }
    }).then((result) => {
    if (result.isConfirmed) {
          swal.fire('Hapus Racikan!','Hapus obat Racikan berhasil!', 'success').then(function(){ 
            $("#row_racikan_" + id_row).remove();
            $(".row_racikan_det_" + id_row).remove();
          }
        );
        
      } else if (result.isDenied) {
        Swal.fire('Batal Hapus Racikan!', 'Batal hapus obat racikan!', 'info')
      }
 })
 ////
}

function clear_form_header_add_racikan() {
  $("input[name='nama_racikan']").val('');
  $("input[name='jumlah_tpl']").val('');
  $("input[name='dosis_tpl']").val('');
  $("input[name='frekwensi_tpl']").val('');
  $("input[name='tme_tpl']").val('');
  $("input[name='note_tpl']").val('');

}

function clear_form_add_row_racikan() {
  $('#frm_obat').val('');
  $('#frm_id_fa').val('');
  $('#frm_jenis_obat').val('');
  $('#frm_qty').val('');
  //$('#frm_dosis').val('');
}

function remove_row_draft_racikan(id_fa) {
 /////
 Swal.fire({
    title: 'Hapus Racikan',
    text: 'Hapus Item Obat Racikan?' ,
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
      actions: 'my-actions',
      //cancelButton: 'order-1 right-gap',
      confirmButton: 'order-2',
      denyButton: 'order-3',
    }
    }).then((result) => {
    if (result.isConfirmed) {
          swal.fire('Hapus Racikan!','Hapus item obat Racikan berhasil!', 'success').then(function(){ 
            $("#racikan_" + id_fa).remove();
          }
        );
        
      } else if (result.isDenied) {
        Swal.fire('Batal Hapus Racikan!', 'Batal hapus item obat racikan!', 'info')
      }
 })
 ////
}
</script>
<script>
$(function() {
  $("#frm_obat").autocomplete({
    source: "<?php echo base_url('soap_eresep/inner_get_data_autocomplet_obat'); ?>",
    minLength: 3,
    select: function(event, ui) {
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
$(function() {
  $("#frekwensi_tpl").autocomplete({
    source: "<?php echo base_url('soap_eresep/inner_get_data_autocomplet_obat_frekwensi'); ?>",
    minLength: 1,
    select: function(event, ui) {}
  });
});

$(function() {
  $("#tme_tpl").autocomplete({
    source: "<?php echo base_url('soap_eresep/inner_get_data_autocomplet_obat_tme'); ?>",
    minLength: 1,
    select: function(event, ui) {}
  });
});
</script>
<script>
function show_popup_template_racikan() {
  $("#modal_pick_racikan_body").load("<?php echo base_url('soap_eresep/inner_pick_tpl_racikan_list'); ?>");
  $("#add_pick_racikan_to_resep").addClass('hidden');
}
</script>
<script>
$('#add_pick_racikan_to_resep').click(function(e) {
  var id_num = $("#id_num").val();
  var num_resep_racikan = $("#num_resep_racikan").val();
  // --- header racikan ---
  var nama_racikan = $('#nama_racikan_n').val();
  var kemasan_racikan = $('#kemasan_racikan_n').val();

  var jumlah_racikan = $('#jumlah_racikan_n').val();
  var dosis_racikan = $('#dosis_racikan_n').val();

  var frekwensi_racikan = $('#frekwensi_racikan_n').val();
  var tme_racikan = $('#tme_racikan_n').val();
  var note_racikan = $('#note_racikan_n').val();
  var tpl_row = '\n' +
    '<tr id="row_racikan_' + num_resep_racikan + '">' +
    '<td colspan="2">' + nama_racikan + '	<input type="hidden" name="nama_racikan[' + num_resep_racikan +
    ']" 				value="' + nama_racikan + '"></td> \n ' +

    //'<td>'+jumlah_racikan+'				<input type="text" name="jumlah_racikan['+num_resep_racikan+']" 	value="'+jumlah_racikan+'"></td> \n ' +
    //'<td>'+dosis_racikan+'				<input type="text" name="dosis_racikan['+num_resep_racikan+']" 	value="'+dosis_racikan+'"></td> \n ' +
    //'<td>'+frekwensi_racikan+'				<input type="hidden" name="frekwensi_racikan['+num_resep_racikan+']" 	value="'+frekwensi_racikan+'"></td> \n ' +

    '<td>				<input type="text" name="jumlah_racikan[' + num_resep_racikan + ']" 	value="' + jumlah_racikan +
    '" class="kotak_kecil"></td> \n ' +
    '<td>				<input type="text" name="dosis_racikan[' + num_resep_racikan + ']" 	value="' + dosis_racikan +
    '" class="kotak_sedang"></td> \n ' +
    '<td>				<input type="text" name="frekwensi_racikan[' + num_resep_racikan + ']" 	value="' + frekwensi_racikan +
    '"></td> \n ' +

    '<td>' + tme_racikan + '							<input type="hidden" name="tme_racikan[' + num_resep_racikan + ']" 				value="' +
    tme_racikan + '"></td> \n ' +
    '<td>' + kemasan_racikan + '					<input type="hidden" name="kemasan_racikan[' + num_resep_racikan +
    ']" 		value="' + kemasan_racikan + '"></td> \n ' +
    '<td>' + note_racikan + '							<input type="hidden" name="note_racikan[' + num_resep_racikan +
    ']" 				value="' + note_racikan + '"></td> \n ' +
    '<td style="text-align:center"><a href="#" onclick="javascript: remove_row_resep_racikan(\'' +
    num_resep_racikan + '\');return false;"><i class="fa fa-trash" style="color:red;"></i></a></td> \n ' +
    '</tr>';
  $('#tbody_draft_resep_racikan').append(tpl_row);
  console.log(id_num);

  for (i = 0; i < id_num; i++) {
    var obat = $("#det_racikan_obat_n_" + i).val();
    var id_fa = $("#det_id_fa_n_" + i).val();
    var jenis_obat = $("#det_jenis_obat_n_" + i).val();
    var qty = $("#det_racikan_qty_n_" + i).val();
    //var dosis 			= $("#det_racikan_dosis_n_"+i).val();
    //console.log(myobat);	
    var tpl_row = '\n' +
      '<tr class="row_racikan_det_' + num_resep_racikan + '"> \n ' +
      '<td>&nbsp;&nbsp;&nbsp;' + obat + '				<input type="hidden" name="det_racikan_obat[' + num_resep_racikan +
      '][' + i + ']" 	value="' + obat + '"></td> \n ' +
      '<td>&nbsp;&nbsp;&nbsp;' + jenis_obat + '	<input type="hidden" name="det_jenis_obat[' + num_resep_racikan +
      '][' + i + ']" 		value="' + jenis_obat + '"> \n ' +
      '										<input type="hidden" name="det_id_fa[' + num_resep_racikan + '][' + i + ']" 					value="' + id_fa +
      '"></td> \n ' +
      '<td>&nbsp;&nbsp;&nbsp;				<input type="text" name="det_racikan_qty[' + num_resep_racikan +
      '][' + i + ']" 		value="' + qty + '" class="kotak_kecil"></td> \n ' +
      //'<td>'+dosis+'			<input type="hidden" name="det_racikan_dosis['+num_resep_racikan+']['+i+']" 	value="'+dosis+'"></td> \n ' +
      '<td colspan="5">&nbsp;</td> \n ' +
      '</tr>';
    $('#tbody_draft_resep_racikan').append(tpl_row);
  }
  $('#butt_simpan_resep').removeClass('hidden');
  $('#batal_new_eresep').removeClass('hidden');

  num_resep_racikan++;
  $("#num_resep_racikan").val(num_resep_racikan);
  console.log(num_resep_racikan);

  $("#id_num").val('0');
  $('#modal_pick_racikan').modal('hide');

  $('.modal-backdrop').removeClass('show');
  $('.modal-backdrop').addClass('hide');
});
</script>
<script>
//$("#box-riwayat-resep-online").load( "<?php #echo base_url('soap_eresep/list_resep_baru_input/'); ?>" + <?php #echo $id_reg ?> );
function get_random_number() {
  var mymin = 100000;
  var mymax = 999999;
  var myrandom = Math.floor(Math.random() * (+mymax - +mymin)) + +mymin;
  console.log("Random Number Generated : " + myrandom);
  return myrandom;
}
</script>
<script>
function disable_for_x_seconds() {
	
	/*
	//event.preventDefault(); //prevent default action 
  var post_url = $(this).attr("action"); //get form action url
  var form_data = $(this).serialize(); //Encode form elements for submission

  $.post(post_url, form_data, function(response) {
    $("#box_new_eresep").html(response);
  });
	*/
	
  $('#butt_simpan_resep').attr('disabled', 'disabled');
  setTimeout(function() {
    $('#butt_simpan_resep').removeAttr('disabled');
  }, 30000);
}
</script>