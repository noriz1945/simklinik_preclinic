<a href="#!" onclick="javascript:toggleFullScreen()"></a>
<input type="hidden" id="id_reg" name="id_reg" value="<?php echo $id_reg; ?>" class="hidden">
<input type="hidden" id="id_pasien" name="id_pasien" value="<?php echo $id_pasien; ?>" class="hidden"> 
<input type="text" id="ideresepset" name="ideresepset" value="<?php echo $id_eresep; ?>" readonly hidden>
<input type="text" id="tuslahset" name="tuslahset" value="<?php echo $tuslah; ?>" readonly hidden>
<input type="text" id="racikset" name="racikset" value="<?php echo $racik; ?>" readonly hidden>

<div class="row">
<div class="col-sm-12" bis_skin_checked="1">
		<div class="card" bis_skin_checked="1">
		<div class="card-header" bis_skin_checked="1">
			<h5>Data Registrasi Pasien</h5>
		</div>
		<div class="card-block" bis_skin_checked="1">
		
			<div class="row" bis_skin_checked="1">
			
			<div class="col-sm-2" bis_skin_checked="1">
			<!-- STATIC CONTROL -->
			<div class="form-group" bis_skin_checked="1">
				<label class="col-sm-12 control-label">No. RM</label>
				<div class="col-sm-12" bis_skin_checked="1">
					<p class="form-control-static"><?php echo $id_pasien; ?></p>
				</div>
			</div>
			</div>

      <div class="col-sm-2" bis_skin_checked="1">
			<!-- STATIC CONTROL -->
			<div class="form-group" bis_skin_checked="1">
				<label class="col-sm-12 control-label">Nama</label>
				<div class="col-sm-12" bis_skin_checked="1">
					<p class="form-control-static"><?php echo $name; ?></p>
				</div>
			</div>
			</div>

      
      <div class="col-sm-2" bis_skin_checked="1">
			<!-- STATIC CONTROL -->
			<div class="form-group" bis_skin_checked="1">
				<label class="col-sm-12 control-label">NIK</label>
				<div class="col-sm-12" bis_skin_checked="1">
					<p class="form-control-static"><?php echo $id_ktp; ?></p>
				</div>
			</div>
			</div>
			
			<div class="col-sm-2" bis_skin_checked="1">
			<!-- STATIC CONTROL -->
			<div class="form-group" bis_skin_checked="1">
				<label class="col-sm-12 control-label">No. Registrasi</label>
				<div class="col-sm-12" bis_skin_checked="1">
					<p class="form-control-static"><?php echo $id_reg; ?></p>
				</div>
			</div>
			</div>
			
			<!-- STATIC CONTROL -->
			<div class="col-sm-2" bis_skin_checked="1">
			<div class="form-group" bis_skin_checked="1">
				<label class="col-sm-12 control-label">Waktu Registrasi</label>
				<div class="col-sm-12" bis_skin_checked="1">
					<p class="form-control-static"><?php echo $regdate; ?></p>
				</div>
			</div>
			</div>
			
			
			
			<div class="col-sm-2" bis_skin_checked="1">
			<!-- STATIC CONTROL -->
			<div class="form-group" bis_skin_checked="1">
				<label class="col-sm-12 control-label">Asuransi</label>
				<div class="col-sm-12" bis_skin_checked="1">
					<p class="form-control-static"><?php echo $nama_asuransi; ?></p>
				</div>
			</div>
			</div>
			<div class="col-sm-2" bis_skin_checked="1">
			<!-- STATIC CONTROL -->
			<div class="form-group" bis_skin_checked="1">
				<label class="col-sm-12 control-label">Dokter</label>
				<div class="col-sm-12" bis_skin_checked="1">
					<p class="form-control-static"><?php echo $nama_dokter; ?></p>
				</div>
			</div>
			</div>
      <div class="col-sm-2" bis_skin_checked="1">
			<!-- STATIC CONTROL -->
			<div class="form-group" bis_skin_checked="1">
				<label class="col-sm-12 control-label" style="font-size: 30px;font-weight: bold;">Total Tagihan</label>
				<div class="col-sm-12" bis_skin_checked="1">
					<p class="label label-success total_tagihan_set" style="font-size: 30px;"></p>
				</div>
			</div>
			</div>
			</div>
		</div>
		</div>
	</div>
</div>

<div class="row">
<div class="col-sm-6">
<div class="card">
<div class="card-header">
<h5>Tambah / Edit Resep</h5>
</div>
</div>
</div>

<div class="col-sm-6">
<div class="card">
<div class="card-header">
<h5>Validasi</h5>
</div>
</div>
</div>
</div>

<div class="row">
 <!--left-->
    <!--tambah / input non racikan & racikan-->
    <div class="col-sm-6">
    <form method="POST" id="formobtnrck">
    <input type="hidden" id="ideresep" name="ideresep" value="<?php echo $id_eresep; ?>" class="hidden">
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
      <th scope="col">Harga Satuan</th>
      <th scope="col">Sub Total</th>
      <th scope="col">Fungsi</th>
      <th scope="col">Validasi</th>
      </tr>
      </thead>
    
      <tbody id="tbody_draft_resep_non_racikdataview"></tbody>
      <tbody id="tbody_draft_resep_non_racik"></tbody>

    </table>
    </div>

    </div>
    <div class="col-sm-6 text-left">
        <button type="submit" class="btn btn-success" id="butt_simpan_resep" style="margin-bottom:10px;">Simpan</button>
        <button type="button" class="btn btn-danger hidden" id="batal_new_eresep" onClick="javascript: batalkan_resep('<?php echo $id_reg; ?>');" style="margin-bottom:10px;">BATAL</button>
    </div>
    </div>
    </div>
    </form>

    <form method="POST" id="formobtrck">
    <input type="hidden" id="id_reg_rck" name="id_reg_rck" value="<?php echo $id_reg; ?>" class="">
    <input type="hidden" id="id_pasien" name="id_pasien" value="<?php echo $id_pasien; ?>" class="hidden"> 
    <input type="text" id="ideresep_rck" name="ideresep_rck" value="<?php echo $id_eresep; ?>" readonly hidden>
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
      <th scope="col">Harga Satuan</th>
      <th scope="col">Sub Total</th>
      <th scope="col">Keterangan</th>
      <th scope="col">Fungsi</th>
      <th scope="col">Validasi</th>
      </tr>
      </thead>
      <tbody id="tbody_draft_resep_racikdataview"></tbody>
      <tbody id="tbody_draft_resep_racikan"></tbody>
    </table>
    </div>
    </div>
    </div>
    </div>
    </form>

    <input type="hidden" id="det_subtotal" name="det_subtotal" value="<?php echo $totalall; ?>">
    <!--<button type="button" class="btn btn-primary" id="copy_resep_from_riwayat"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Edit Resep</button>-->
    </div>
    <!--non racikan & racikan-->
 <!--END left-->

<!--validasi list-->
<div class="col-sm-6">

<!--detail obat-->
<div class="row">
<div class="col-sm-12">

<div class="card">
<div class="card-header">
<h5>Obat Non-Racikan</h5>
</div>
<div class="card-block tab-icon">
<div class="table-responsive">
<table class="table table-bordered table-responsive styled-table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Obat</th>
          <th scope="col">Jenis</th>
          <th scope="col">Jumlah</th>
          <th scope="col">Dosis</th>
          <th scope="col">Frekwensi</th>
          <th scope="col">Waktu</th>
          <th scope="col">Harga Satuan</th>
          <th scope="col">Sub Total</th>
          <th scope="col">Keterangan</th>
          <th scope="col">Cancel</th>
        </tr>
        </thead>
        <tbody id="list_detail_obat_non_racikan"></tbody>
</table>
</div>
<div id="total"></div>
</div>
</div>

<div class="card">
<div class="card-header">
<h5>Obat Racikan</h5>
</div>
<div class="card-block tab-icon">
<div class="table-responsive">
<form id="frm_draft_pick">
<table class="table table-bordered table-hover table-striped table-responsive styled-table">
      <thead>
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
          <th scope="col">Harga Satuan</th>
          <th scope="col">Sub Total</th>
          <th scope="col">Keterangan</th>
          <th scope="col">Cancel</th>
        </tr>
      </thead>
      <tbody id="list_detail_obat_racikan"></tbody>
    </table>

      </form>
</div>
<div id="total_racik"></div>
</div>
</div>


</div>
</div>
<!--end detail obat-->

</div>
<!--End validasi list-->
</div>





<!--MODAL SEGMENT 4-->
 <div class="modal fade" id="modal_racikan" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" style="z-index: 1100;">
 <div class="modal-dialog modal-lg" role="document" style="max-width:auto;">
 <div class="modal-content">
 <div class="modal-header">
 <h4 class="modal-title">INPUT RACIKAN</h4>
 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
 <span aria-hidden="true">&times;</span>
 </button>
 </div>
 <div class="modal-body">
 <!--<h5>Default Modal</h5>-->
 <!--racikan set-->
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
                        <th scope="col">Satuan</th>
                        <th scope="col">Subtotal</th>
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
 <!--end racikan set-->
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

<script>

///////////////////////////////////////////////// 
var baseUrl = '/fastclinic_binamedika/';

 //Format uang
 formatMoney();
  function formatMoney(amount, decimalCount = 0/*ganti 2 kalo mau pake decimal*/, decimal = ".", thousands = ",") {
  try {
    decimalCount = Math.abs(decimalCount);
    decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

  const negativeSign = amount < 0 ? "-" : "";

  let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
  let j = (i.length > 3) ? i.length % 3 : 0;

    return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
  } catch (e) {
    console.log(e)
  }
 };
 //End Format uang
 
 $( document ).ready(function() {
    detailnonobatracikan();
    detailobatracikan();
    list_detail_obat_nonracikan();
    list_detail_obat_racikan();
    findtotaltagihan();
 });

 function findtotaltagihan(){
  var id_eresep = $("#ideresepset").val();
  $.ajax({
    url : baseUrl+"penjualan_obat/eresep/data_totaltagihan",
    method : "POST",
    data : {id_eresep:id_eresep},
    async : true,
    dataType : 'json',
    success: function(datarestind){
        $('.total_tagihan_set').html(formatMoney(datarestind.totalall,0));
      }
    });
 }

//list set
//segment left
function detailnonobatracikan(){
  var id_eresep = $("#ideresepset").val();
  $.ajax({
    url : baseUrl+"penjualan_obat/eresep/detailobatnonracikan",
    method : "POST",
    data : {id_eresep:id_eresep},
    async : true,
    dataType : 'json',
    success: function(datareslistobat){
    var iresobat;
    var racikanset ="";
    for (iresobat = 0; iresobat < datareslistobat.length; iresobat++) {
        var id_eresep_det        = datareslistobat[iresobat].id_eresep_det;
        var name                 = datareslistobat[iresobat].name;
        var jenis_obat           = datareslistobat[iresobat].jenis_obat;
        var id_trx_det           = datareslistobat[iresobat].id_trx_det;
        var qty                  = datareslistobat[iresobat].qty;
        var dosis                = datareslistobat[iresobat].dosis;
        var frekwensi            = datareslistobat[iresobat].frekwensi;
        var tme                  = datareslistobat[iresobat].tme;
        var note                 = datareslistobat[iresobat].note;
        var harga                = datareslistobat[iresobat].harga_satuan;
        var total_harga_obat     = datareslistobat[iresobat].subtotal;

      racikanset += '<tr id="' + id_eresep_det + '">'+
        '<td>' + name + ' <input type="hidden" name="obat[]" value="' + name + '"></td>'+
        '<td>' + jenis_obat + '	<input type="hidden" name="jenis_obat[]" value="' + jenis_obat +'"><input type="hidden" name="id_fa[]" 	value="' + id_trx_det + '"></td>'+
        '<td><input class="form-control edit_qty_nonracik" attr-id_eresep_det="' + id_eresep_det + '" type="text" name="qty[]" value="' + qty + '"></td>' +
        '<td>' + dosis + ' <input type="hidden" name="dosis[]" value="' + dosis + '"></td>' +
        '<td>' + frekwensi + '	<input type="hidden" name="frekwensi[]" value="' + frekwensi + '"></td>' +
        '<td>' + tme + ' <input type="hidden" name="tme[]" value="' + tme + '"></td>' +
        '<td>' + note + ' <input type="hidden" name="note[]" value="' + note + '"></td>' +
        '<td>' + formatMoney(harga,0) + ' <input type="hidden" class="edit_harga_nonracik" name="harga[]" value="' + harga + '" attr-harga_set="' + harga + '"></td>' +
        '<td>' + formatMoney(total_harga_obat,0) + ' <input type="hidden" name="total_harga_obat[]" value="' + total_harga_obat + '"></td>' +
        '<td style="text-align:center"><a href="#" onclick="javascript: hapus_obat_item(\'' + id_eresep_det +'\');return false;"><i class="fa fa-trash" style="color:red;"></i></a></td>' +
        '<td style="text-align:center"><a href="#" onclick="javascript: validasi_nonracik(\'' + id_eresep_det +'\');return false;"><i class="fa fa-check" style="color:green;"></i></a></td>' +
        '</tr>';
    }

        $("#tbody_draft_resep_non_racikdataview").html(racikanset);

        $('.edit_qty_nonracik').change(function() {
          var id       = $(this).attr('attr-id_eresep_det'); 
          var qty_edit_set = $(this).val(); 

          $.ajax({
            url : baseUrl+"penjualan_obat/eresep/edit_nonracikan",
            method : "POST",
            data : {id:id,qty_edit_set:qty_edit_set},
            async : true,
            dataType : 'json',
            success: function(datares){
              //NOTIFY
              var nFrom='top';
              var nAlign='left';
              var nIcons='fa fa-check';
              var nType='success';
              var nAnimIn='data-animation-in';
              var nAnimOut='data-animation-out';
              var titlenyah='Edit ';
              var msgnyah='Berhasil disimpan';
              notify(nFrom,nAlign,nIcons,nType,nAnimIn,nAnimOut,titlenyah,msgnyah);
              //END NOTIFY
              detailnonobatracikan();
              detailobatracikan();
            }
        });
        });
    }
    });
};



function validasi_nonracik(id_eresep_det) {
 /////
 $.ajax({
              url : baseUrl+"penjualan_obat/eresep/validasiobatnya",
              method : "POST",
              data : {id_eresep_det:id_eresep_det},
              async : true,
              dataType : 'json',
              success: function(datareslistobat){
                detailnonobatracikan();
                list_detail_obat_nonracikan();
                findtotaltagihan();
              }
              });
 ////
}

function hapus_obat_item(id_eresep_det) {
 /////
 Swal.fire({
    title: 'Hapus Obat Non Racikan',
    text: 'Hapus Item Obat Non Racikan?' ,
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
          swal.fire('Hapus Racikan!','Hapus item obat Non Racikan berhasil!', 'success').then(function(){ 
              $.ajax({
              url : baseUrl+"penjualan_obat/eresep/deleteobatnya",
              method : "POST",
              data : {id_eresep_det:id_eresep_det},
              async : true,
              dataType : 'json',
              success: function(datareslistobat){
                detailnonobatracikan();
              }
              });
          }
        );
        
      } else if (result.isDenied) {
        Swal.fire('Batal Hapus Non Racikan!', 'Batal hapus item obat non racikan!', 'info')
      }
 })
 ////
}

function detailobatracikan(){
  var id_eresep = $("#ideresepset").val();
  $.ajax({
    url : baseUrl+"penjualan_obat/eresep/detailobatracikan",
    method : "POST",
    data : {id_eresep:id_eresep},
    async : true,
    dataType : 'json',
    success: function(datareslistobat){
    var irestind="";
    var irestind2="";
    var racikanset ="";
    for (irestind = 0; irestind < datareslistobat.length; irestind++){

    racikanset +='<tr id="row_racikan_n" style="background-color:aqua;">'
      +'<td colspan="2"><strong>'+datareslistobat[irestind].name+'</strong><input type="hidden" id="nama_racikan_n2" value="'+datareslistobat[irestind].name+'"></td>'
      +'<td>'+datareslistobat[irestind].qty+'</td>'
      +'<td>'+datareslistobat[irestind].dosis+'</td>'
      +'<td>'+datareslistobat[irestind].frekwensi+'</td> '
      +'<td>'+datareslistobat[irestind].tme+'</td>'
      +'<td>'+datareslistobat[irestind].jenis_obat+'</td>'
      +'<td>'+datareslistobat[irestind].harga_satuan+'</td>'
      +'<td>'+datareslistobat[irestind].subtotal+'</td>'
      +'<td>'+datareslistobat[irestind].note+'</td>'
      +'<td style="text-align:center"><a href="#" onclick="javascript: hapus_racik(\'' +datareslistobat[irestind].id_eresep_det +'\');return false;"><i class="fa fa-trash" style="color:red;"></i></a></td>'
      +'<td style="text-align:center"><a href="#" onclick="javascript: validasi_racik(\'' +datareslistobat[irestind].id_eresep_det +'\');return false;"><i class="fa fa-check" style="color:green;"></i></a></td>'
      +'</tr>';
    for (irestind2 = 0; irestind2 < datareslistobat[irestind].rs_1.length; irestind2++){
        racikanset +='<tr class="row_racikan_det_n">' 
        +'<td style="padding-left:20px;">&bull; '+datareslistobat[irestind].rs_1[irestind2].name+'</td>'
          +'<td style="padding-left:20px;">'+datareslistobat[irestind].rs_1[irestind2].jenis_obat+'</td>' 
          //+'<td style="padding-left:20px;" colspan="5">'+datareslistobat[irestind].rs_1[irestind2].qty+'</td>'
          +'<td style="padding-left:20px;" colspan="5"><input class="form-control edit_qty_racik" attr-id_eresep_det_racik="'+datareslistobat[irestind].rs_1[irestind2].id_eresep_det_racikan+'" type="text" name="qty[]" value="'+datareslistobat[irestind].rs_1[irestind2].qty+'"></td>'
          +'<td>'+formatMoney(datareslistobat[irestind].rs_1[irestind2].harga_satuan,0)+'</td>'
          +'<td colspan="4">'+formatMoney(datareslistobat[irestind].rs_1[irestind2].subtotal,0)+'</td>'
          +'</tr>'; 
    }
    }
    //'<td><input class="form-control edit_qty_nonracik" attr-id_eresep_det="' + id_eresep_det + '" type="text" name="qty[]" value="' + qty + '"></td>' +
    //'<td>' + formatMoney(harga,0) + ' <input type="hidden" class="edit_harga_nonracik" name="harga[]" value="' + harga + '" attr-harga_set="' + harga + '"></td>' +
    //'<td>' + formatMoney(total_harga_obat,0) + ' <input type="hidden" name="total_harga_obat[]" value="' + total_harga_obat + '"></td>' +

    $("#tbody_draft_resep_racikdataview").html(racikanset);

    $('.edit_qty_racik').change(function() {
          var id       = $(this).attr('attr-id_eresep_det_racik'); 
          var qty_edit_set = $(this).val(); 

          $.ajax({
            url : baseUrl+"penjualan_obat/eresep/edit_racikan",
            method : "POST",
            data : {id:id,qty_edit_set:qty_edit_set},
            async : true,
            dataType : 'json',
            success: function(datares){
              //NOTIFY
              var nFrom='top';
              var nAlign='left';
              var nIcons='fa fa-check';
              var nType='success';
              var nAnimIn='data-animation-in';
              var nAnimOut='data-animation-out';
              var titlenyah='Edit ';
              var msgnyah='Berhasil disimpan';
              notify(nFrom,nAlign,nIcons,nType,nAnimIn,nAnimOut,titlenyah,msgnyah);
              //END NOTIFY
              detailobatracikan();
              list_detail_obat_racikan();
            }
        });
        });
    }




    });
};
//end segment left

//segment right
function list_detail_obat_nonracikan(){
  var id_eresep = $("#ideresepset").val();
  var tuslah    = $("#tuslahset").val();
  $.ajax({
    url : baseUrl+"penjualan_obat/eresep/list_detailobatnonracikan",
    method : "POST",
    data : {id_eresep:id_eresep},
    async : true,
    dataType : 'json',
    success: function(datareslistobat){
    var iresobat;
    var racikanset ="";
    var all_total_harga_obat = 0;
    for (iresobat = 0; iresobat < datareslistobat.length; iresobat++) {
        var id_eresep_det        = datareslistobat[iresobat].id_eresep_det;
        var name                 = datareslistobat[iresobat].name;
        var jenis_obat           = datareslistobat[iresobat].jenis_obat;
        var id_trx_det           = datareslistobat[iresobat].id_trx_det;
        var qty                  = datareslistobat[iresobat].qty;
        var dosis                = datareslistobat[iresobat].dosis;
        var frekwensi            = datareslistobat[iresobat].frekwensi;
        var tme                  = datareslistobat[iresobat].tme;
        var note                 = datareslistobat[iresobat].note;
        var harga                = datareslistobat[iresobat].harga_satuan;
        var total_harga_obat     = datareslistobat[iresobat].subtotal;
        all_total_harga_obat += parseInt(total_harga_obat);
        var setgrand = all_total_harga_obat;
        var hargasetelahtuslah = parseInt(total_harga_obat)+parseInt(tuslah);

      racikanset += '<tr>'+
        '<td>'+name+'</td>'+
        '<td>'+jenis_obat+'</td>'+
        '<td>'+qty+'</td>' +
        '<td>'+dosis+'</td>' +
        '<td>'+frekwensi+'</td>' +
        '<td>'+tme+'</td>' +
        '<td>-</td>' +
        '<td>'+formatMoney(harga,0)+'</td>' +
        '<td>'+formatMoney(total_harga_obat,0)+'</td>' +
        '<td>'+note+'</td>'+
        '<td style="text-align:center"><a href="#" onclick="javascript: cancel_validasi_nonracik(\'' + id_eresep_det +'\');return false;"><i class="fa fa-close" style="color:red;"></i></a></td>' +
        '</tr>';
    }
    var setgrand_nonracik = parseInt(setgrand);

    if(setgrand==0 || setgrand=="undefined" || setgrand==null){
          $("#total").html("");
    }else{
          $("#total").html("Grand Total : "+formatMoney(setgrand_nonracik,0));
    }
    
      $("#list_detail_obat_non_racikan").html(racikanset);
    }
    });
}
function cancel_validasi_nonracik(id_eresep_det) {
 /////
 Swal.fire({
    title: 'Cancel Obat Non Racikan',
    text: 'Cancel Item Obat Non Racikan?' ,
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
          swal.fire('Cancel Non Racikan!','Cancel item obat Non Racikan berhasil!', 'success').then(function(){ 
              $.ajax({
              url : baseUrl+"penjualan_obat/eresep/cancelobatnya",
              method : "POST",
              data : {id_eresep_det:id_eresep_det},
              async : true,
              dataType : 'json',
              success: function(datareslistobat){
                detailnonobatracikan();
                list_detail_obat_nonracikan();
                findtotaltagihan();
              }
              });
          }
        );
        
      } else if (result.isDenied) {
        Swal.fire('Batal Cancel Non Racikan!', 'Batal Cancel item obat non racikan!', 'info')
      }
 })
 ////
}
function list_detail_obat_racikan(){
  var id_eresep = $("#ideresepset").val();
  var tuslah    = $("#tuslahset").val();
  var racik     = $("#racikset").val();
  $.ajax({
    url : baseUrl+"penjualan_obat/eresep/validasidetailobatracikan",
    method : "POST",
    data : {id_eresep:id_eresep},
    async : true,
    dataType : 'json',
    success: function(datareslistobat){
    var irestind="";
    var irestind2="";
    var racikanset ="";
    var all_total_harga_obat = 0;
    for (irestind = 0; irestind < datareslistobat.length; irestind++){


    racikanset +='<tr id="row_racikan_n" style="background-color:aqua;">'
      +'<td colspan="2"><strong>'+datareslistobat[irestind].name+'</strong></td>'
      +'<td>'+datareslistobat[irestind].qty+'</td>'
      +'<td>'+datareslistobat[irestind].dosis+'</td>'
      +'<td>'+datareslistobat[irestind].frekwensi+'</td> '
      +'<td>'+datareslistobat[irestind].tme+'</td>'
      +'<td>'+datareslistobat[irestind].jenis_obat+'</td>'
      +'<td>'+formatMoney(datareslistobat[irestind].harga_satuan,0)+'</td>'
      +'<td>'+formatMoney(datareslistobat[irestind].subtotal,0)+'</td>'
      +'<td>'+datareslistobat[irestind].note+'</td>'
      +'<td style="text-align:center"><a href="#" onclick="javascript: cancel_validasi_racik(\'' +datareslistobat[irestind].id_eresep_det +'\');return false;"><i class="fa fa-close" style="color:red;"></i></a></td>'
      +'</tr>';
    for (irestind2 = 0; irestind2 < datareslistobat[irestind].rs_1.length; irestind2++){
      var total_harga_obat     = datareslistobat[irestind].rs_1[irestind2].subtotal;
      all_total_harga_obat += parseInt(total_harga_obat);
      var setgrand = all_total_harga_obat;
      var hargasetelahtuslah = parseInt(total_harga_obat)+parseInt(tuslah);
      var subtotal_all_res = datareslistobat[irestind].subtotal;

        racikanset +='<tr class="row_racikan_det_n">' 
          +'<td style="padding-left:20px;">&bull; '+datareslistobat[irestind].rs_1[irestind2].name+'</td>'
          +'<td style="padding-left:20px;">'+datareslistobat[irestind].rs_1[irestind2].jenis_obat+'</td>' 
          +'<td style="padding-left:20px;" colspan="5">'+datareslistobat[irestind].rs_1[irestind2].qty+'</td>'
          +'<td>'+formatMoney(datareslistobat[irestind].rs_1[irestind2].harga_satuan,0)+'</td>'
          +'<td colspan="3">'+formatMoney(datareslistobat[irestind].rs_1[irestind2].subtotal,0)+'</td>'
          +'</tr>'; 
    }
    }

    var setgrand_racik = parseInt(subtotal_all_res);
        if(setgrand==0 || setgrand=="undefined" || setgrand==null){
          $("#total_racik").html("");
         }else{
          $("#total_racik").html("Grand Total : "+formatMoney(setgrand_racik,0));
        }


    $("#list_detail_obat_racikan").html(racikanset);
    }




    });
};

function hapus_racik(id_eresep_det) {

   /////
 Swal.fire({
    title: 'Cancel Obat Racikan',
    text: 'Cancel Item Obat Racikan?' ,
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
          swal.fire('Cancel Racikan!','Cancel item obat Racikan berhasil!', 'success').then(function(){ 
            $.ajax({
            url : baseUrl+"penjualan_obat/eresep/hapusobatnya_rck",
            method : "POST",
            data : {id_eresep_det:id_eresep_det},
            async : true,
            dataType : 'json',
            success: function(datareslistobat){

            detailobatracikan();
            list_detail_obat_racikan();
          }
          });
          }
        );
        
      } else if (result.isDenied) {
        Swal.fire('Batal Cancel Racikan!', 'Batal Cancel item obat racikan!', 'info')
      }
 })
 ////

}

function validasi_racik(id_eresep_det) {
 /////
 $.ajax({
  url : baseUrl+"penjualan_obat/eresep/validasiobatnya_rck",
  method : "POST",
  data : {id_eresep_det:id_eresep_det},
  async : true,
  dataType : 'json',
  success: function(datareslistobat){

     detailobatracikan();
     list_detail_obat_racikan();
     findtotaltagihan();
  }
 });
 ////
}

function cancel_validasi_racik(id_eresep_det) {
 /////
 Swal.fire({
    title: 'Cancel Obat Racikan',
    text: 'Cancel Item Obat Racikan?' ,
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
          swal.fire('Cancel Racikan!','Cancel item obat Racikan berhasil!', 'success').then(function(){ 
              $.ajax({
              url : baseUrl+"penjualan_obat/eresep/cancelobatnya_rck",
              method : "POST",
              data : {id_eresep_det:id_eresep_det},
              async : true,
              dataType : 'json',
              success: function(datareslistobat){
                detailobatracikan();
                list_detail_obat_racikan();
                findtotaltagihan();
              }
              });
          }
        );
        
      } else if (result.isDenied) {
        Swal.fire('Batal Cancel Racikan!', 'Batal Cancel item obat racikan!', 'info')
      }
 })
 ////
}

//end segment right


//end list set


////toggle untuk input resep
function toggleFullScreen(){
  $(window).height();
  document.fullscreenElement||document.mozFullScreenElement||document.webkitFullscreenElement?document.cancelFullScreen?document.cancelFullScreen():document.mozCancelFullScreen?document.mozCancelFullScreen():document.webkitCancelFullScreen&&document.webkitCancelFullScreen():document.documentElement.requestFullscreen?document.documentElement.requestFullscreen():document.documentElement.mozRequestFullScreen?document.documentElement.mozRequestFullScreen():document.documentElement.webkitRequestFullscreen&&document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT),$(".full-screen").toggleClass("icon-maximize"),$(".full-screen").toggleClass("icon-minimize")
}
  $(document).ready(
      function(){
          var e=($(window),$("body")),t=e[0].className;
          $(".main-menu").attr("id",t),
          $(".card-header-right .close-card").on("click",function(){
              var e=$(this);
            e.parents(".card").animate({opacity:"0","-webkit-transform":"scale3d(.3, .3, .3)",transform:"scale3d(.3, .3, .3)"}),
        setTimeout(function(){
        e.parents(".card").remove()},800)}),
        $(".card-header-right .minimize-card").on("click",function(){
        var e=$(this),t=$(e.parents(".card"));
            $(t).children(".card-block").slideToggle();
            $(this).toggleClass("icon-minus").fadeIn("slow"),
            $(this).toggleClass("icon-plus").fadeIn("slow")}),
            $(".card-header-right .full-card").on("click",function(){
        var e=$(this);
            $(e.parents(".card")).toggleClass("full-card"),
            $(this).toggleClass("icon-maximize"),
            $(this).toggleClass("icon-minimize")}),
        $("#more-details").on("click",function(){
            $(".more-details").slideToggle(500)}),$(".mobile-options").on("click",function(){$(".navbar-container .nav-right").slideToggle("slow")}),$.mCustomScrollbar.defaults.axis="yx",$("#styleSelector .style-cont").slimScroll({setTop:"10px",height:"calc(100vh - 440px)"}),$(".main-menu").mCustomScrollbar({setTop:"10px",setHeight:"calc(100% - 80px)"});var a=$(window).height()-80;$(".main-friend-list").slimScroll({height:a,allowPageScroll:!1,wheelStep:5,color:"#1b8bf9"}),$("#search-friends").on("keyup",function(){var e=$(this).val().toLowerCase();$(".userlist-box .media-body .chat-header").each(function(){var t=$(this).text().toLowerCase();$(this).closest(".userlist-box")[-1!==t.indexOf(e)?"show":"hide"]()})}),$(".displayChatbox").on("click",function(){if("right"==$(".pcoded").attr("vertical-placement"))var e={direction:"left"};else var e={direction:"right"};$(".showChat").toggle("slide",e,500)}),$(".userlist-box").on("click",function(){if("right"==$(".pcoded").attr("vertical-placement"))var e={direction:"left"};else var e={direction:"right"};
          $(".showChat_inner").toggle("slide",e,500)}),$(".back_chatBox").on("click",function(){if("right"==$(".pcoded").attr("vertical-placement"))var e={direction:"left"};else var e={direction:"right"};$(".showChat_inner").toggle("slide",e,500),$(".showChat").css("display","block")}),$(".search-btn").on("click",function(){$(".main-search").addClass("open"),$(".main-search .form-control").animate({width:"200px"})}),$(".search-close").on("click",function(){$(".main-search .form-control").animate({width:"0"}),setTimeout(function(){$(".main-search").removeClass("open")},300)}),$("#mobile-collapse i").addClass("icon-toggle-right"),$("#mobile-collapse").on("click",function(){$("#mobile-collapse i").toggleClass("icon-toggle-right"),$("#mobile-collapse i").toggleClass("icon-toggle-left")})}),
          
  $(document).ready(function(){
    var id_reg = $("#id_reg").val();
    ////// ROW NON RACIKAN
    $('#addrow').click(function(e) {
        e.preventDefault();
        
        var obat = $('#obat').val();
        var id_fa = $('#id_fa').val();
        var jenis_obat = $('#jenis_obat').val();
        var qty = $('#qty').val();
        var dosis = $('#dosis').val();
        var frekwensi = $('#frekwensi').val();
        var tme = $('#tme').val();
        var note = $('#note').val();
        var rand_no = get_random_number();
      //set data lainnya dlu
      var id_obat = id_fa;
      $.ajax({
      url : baseUrl+"penjualan_obat/eresep/prosesdetailobat",
      method : "POST",
      data : {id_obat:id_obat},
      async : true,
      dataType : 'json',
      success: function(datares){
        var harga        = (Math.round(datares.row_1 / 100) * 100);
        var total_harga_obat = (qty*harga);
        var tpl_row = '\n' +
        '<tr id="' + rand_no + '"> \n ' +
        '<td>' + obat + ' <input type="hidden" name="obat" value="' + obat + '"></td> \n ' +
        '<td>' + jenis_obat + '	<input type="hidden" name="jenis_obat" value="' + jenis_obat +
        '"><input type="hidden" name="id_fa" 	value="' + id_fa + '"></td> \n ' +
        '<td>' + qty + ' <input type="hidden" name="qty" value="' + qty + '"></td> \n ' +
        '<td>' + dosis + ' <input type="hidden" name="dosis" value="' + dosis + '"></td> \n ' +
        '<td>' + frekwensi + '	<input type="hidden" name="frekwensi" value="' + frekwensi + '"></td> \n ' +
        '<td>' + tme + ' <input type="hidden" name="tme" value="' + tme + '"></td> \n ' +
        '<td>' + note + ' <input type="hidden" name="note" value="' + note + '"></td> \n ' +
        '<td>' + formatMoney(harga,0) + ' <input type="hidden" name="harga" value="' + harga + '"></td> \n ' +
        '<td>' + formatMoney(total_harga_obat,0) + ' <input type="hidden" name="total_harga_obat" value="' + total_harga_obat + '"></td> \n ' +
        '<td style="text-align:center"><a href="#" onclick="javascript: remove_row_draft(\'' + rand_no +
        '\');return false;"><i class="fa fa-trash" style="color:red;"></i></a></td> \n ' +
        '</tr>';
        $("#tbody_draft_resep_non_racik").append(tpl_row);
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


        var dataset = $('#formobtnrck').serialize();
        $.ajax({
            url : baseUrl+"penjualan_obat/eresep/save_eresep_nonracikan",
            method : "POST",
            data : dataset,
            async : true,
            dataType : 'json',
            success: function(datares){
              //NOTIFY
              var nFrom='top';
              var nAlign='right';
              var nIcons='fa fa-check';
              var nType='success';
              var nAnimIn='data-animation-in';
              var nAnimOut='data-animation-out';
              var titlenyah='Resep Racikan';
              var msgnyah='Berhasil disimpan';
              notify(nFrom,nAlign,nIcons,nType,nAnimIn,nAnimOut,titlenyah,msgnyah);
              $("#tbody_draft_resep_non_racik").html('');
              detailnonobatracikan();
              //END NOTIFY
            }
        });
      }
      });
      //end set data lainnya dlu
      
    });
    //////END ROW NON RACIKAN
    // -------------- RACIKAN FUNCTION -------------------
    $('#addrow_to_racikan').click(function(e) {
      var id_num     = $("#id_num").val();
      var obat       = $('#frm_obat').val();
      var id_fa      = $('#frm_id_fa').val();
      var jenis_obat = $('#frm_jenis_obat').val();
      var qty        = $('#frm_qty').val();
      var id_obat 	 = id_fa;

      
    $.ajax({
      url : baseUrl+"penjualan_obat/eresep/prosesdetailobat",
      method : "POST",
      data : {id_obat:id_obat},
      async : true,
      dataType : 'json',
      success: function(datares){
        var harga        = (Math.round(datares.row_1 / 100) * 100);
        var total_harga_obat = (qty*harga);
        var tpl_row = '\n' +
        '<tr id="racikan_'+id_num+'"> \n ' +
        '<td>' + obat + '				<input type="hidden" name="obat_' + id_num + '" 				value="' + obat + '"></td> \n ' +
        '<td>' + jenis_obat + '	<input type="hidden" name="jenis_obat_' + id_num + '" 	value="' + jenis_obat +
        '"><input type="hidden" name="id_fa_' + id_num + '" 	value="' + id_fa + '"></td> \n ' +
        '<td>' + qty + '				<input type="hidden" name="qty_' + id_num + '" 				value="' + qty + '"></td> \n ' +
        '<td>'+harga+'			<input type="hidden" name="harga_'+id_num+'" 			value="'+harga+'"></td> \n ' +
        '<td>'+total_harga_obat+'	<input type="hidden" name="subtotal_'+id_num+'" id="subtotal_'+id_num+'" 	value="'+total_harga_obat+'" class="subtotal"></td> \n ' +
        '<td style="text-align:center"><a href="#" class="hapus_item_rck" id="hapus_'+id_num+'" attr-id-item="'+id_num+'" attr-id-subtotal="'+total_harga_obat+'"><i class="fa fa-trash" style="color:red;"></i></a></td> \n ' +
        '</tr>';
      $("#tbody_draft_racikan").append(tpl_row);
      id_num++;
      $("#id_num").val(id_num);
      clear_form_add_row_racikan();

      var sum =0;
        $(".subtotal").each(function () {
            sum += parseFloat(this.value);
            
        });
        $('.hapus_item_rck').click(function(e) {
          var id_nums        = $(this).attr('attr-id-item'); 
          $("#racikan_"+id_nums).remove();
          return false;
        });

        
        $("#grandtotal").val(sum);


      }
     
    });

    
    });




 $('#add_racikan_to_resep').click(function(e) {
        e.preventDefault();
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
        '<td>-					<input type="hidden" name="harga[' + num_resep_racikan +
        ']" 		value="0"></td> \n ' +
        '<td>-					<input type="hidden" name="subtotal[' + num_resep_racikan +
        ']" 		value="0"></td> \n ' +
        '<td>' + note_racikan + '							<input type="hidden" name="note_racikan[' + num_resep_racikan +
        ']" 			value="' + note_racikan + '"></td> \n ' +
        '<td> hapus <input type="hidden" name="note_racikan[' + num_resep_racikan +
        ']" 			value="' + note_racikan + '"></td> \n ' + 
        '</tr>';
      $('#tbody_draft_resep_racikan').append(tpl_row);

      for (i = 0; i < id_num; i++) {
        var obat = $("input[name='obat_" + i + "']").val();
        var id_fa = $("input[name='id_fa_" + i + "']").val();
        var jenis_obat = $("input[name='jenis_obat_" + i + "']").val();
        var qty = $("input[name='qty_" + i + "']").val();
        var harga = $("input[name='harga_" + i + "']").val();
        var subtotal = $("input[name='subtotal_" + i + "']").val();
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
          '<td>' + harga + '				<input type="hidden" name="det_racikan_harga[' + num_resep_racikan + '][' + i +
          ']" 	value="' + harga + '"></td> \n ' +
          '<td>' + subtotal + '				<input type="hidden" name="det_racikan_subtotal[' + num_resep_racikan + '][' + i +
          ']" 	value="' + subtotal + '"></td> \n ' +
          //'<td>'+dosis+'			<input type="hidden" name="det_racikan_dosis['+num_resep_racikan+']['+i+']" 	value="'+dosis+'"></td> \n ' +
          '<td colspan="5">&nbsp;</td> \n ' +
          '</tr>';
        $('#tbody_draft_resep_racikan').append(tpl_row);
      }
      $('#butt_simpan_resep').removeClass('hidden');
      $('#batal_new_eresep').removeClass('hidden');

      num_resep_racikan++;
      $("#num_resep_racikan").val(num_resep_racikan);

      //clear_modal_racikan();
      $('#modal_racikan').modal('hide');

      $('.modal-backdrop').removeClass('show');
      $('.modal-backdrop').addClass('hide');

      var dataset = $('#formobtrck').serialize();
        $.ajax({
            url : baseUrl+"penjualan_obat/eresep/save_eresep_racikan",
            method : "POST",
            data : dataset,
            async : true,
            dataType : 'json',
            success: function(datares){
              //NOTIFY
              var nFrom='top';
              var nAlign='right';
              var nIcons='fa fa-check';
              var nType='success';
              var nAnimIn='data-animation-in';
              var nAnimOut='data-animation-out';
              var titlenyah='Obat Racikan ';
              var msgnyah='Berhasil disimpan';
              notify(nFrom,nAlign,nIcons,nType,nAnimIn,nAnimOut,titlenyah,msgnyah);
              $('#tbody_draft_resep_racikan').html('');
              detailobatracikan();
              //END NOTIFY
            }
        });
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
    //END RACIKAN 
  }),
    $("#styleSelector").html('<div class="selector-toggle">'
    +'<a href="javascript:void(0)"></a>'
    +'</div>'
    +'<div class="card-header">'
    +'<h5>Input Obat Non-Racikan :</h5>'
    +'</div>'
    +'<div class="row">'
    +'<div class="col-sm-12" style="margin-top:5px; border:#CCC thin solid; padding:5px;">'
    +'<form>'
    +'<div class="form-group row">'
    +'  <label class="col-sm-4 col-form-label">Obat</label>'
    +'  <div class="col-sm-8">'
    +'    <div class="ui-widget">'
    +'      <input id="obat" class="form-control" placeholder="Cari Obat...">'
    +'      <input type="hidden" id="id_fa" name="id_fa" class="hidden" readonly>'
    +'    </div>'
    +'  </div>'
    +'</div>'
    +'<div class="form-group row">'
    +'  <label class="col-sm-4 col-form-label">Jenis</label>'
    +'  <div class="col-sm-8">'
    +'    <input id="jenis_obat" name="jenis_obat" class="form-control" placeholder="Jenis Obat">'
    +'  </div>'
    +'</div>'
    +'<div class="form-group row">'
    +'  <label class="col-sm-4 col-form-label">Jumlah</label>'
    +'  <div class="col-sm-8">'
    +'    <input id="qty" name="qty" class="form-control" placeholder="Jumlah Obat">'
    +'  </div>'
    +'</div>'
    +'<div class="form-group row">'
    +'  <label class="col-sm-4 col-form-label">Dosis</label>'
    +'  <div class="col-sm-8">'
    +'    <div class="ui-widget">'
    +'      <input id="dosis" name="dosis" class="form-control" placeholder="Dosis Obat">'
    +'    </div>'
    +'  </div>'
    +'</div>'
    +'<div class="form-group row">'
    +'  <label class="col-sm-4 col-form-label">Frekwensi</label>'
    +'  <div class="col-sm-8">'
    +'    <div class="ui-widget">'
    +'      <input id="frekwensi" name="frekwensi" class="form-control" placeholder="Frekwensi Obat">'
    +'    </div>'
    +'  </div>'
    +'</div>'
    +'<div class="form-group row">'
    +'  <label class="col-sm-4 col-form-label">Waktu/Cara Pemberian</label>'
    +'  <div class="col-sm-8">'
    +'    <div class="ui-widget">'
    +'      <input id="tme" name="tme" class="form-control" placeholder="Waktu/Cara Pemberian Obat">'
    +'    </div>'
    +'  </div>'
    +'</div>'
    +'<div class="form-group row">'
    +'  <label class="col-sm-4 col-form-label">Keterangan</label>'
    +'  <div class="col-sm-8">'
    +'    <input id="note" name="note" class="form-control" placeholder="Keterangan Obat">'
    +'  </div>'
    +'</form>'
    +'</div>'
    +'<div class="row">'
    +'<div class="form-group row" style="margin-top:10px;">'
    +'  <div class="col-sm-1 text-right">'
    +'  </div>'
    +'  <div class="col-sm-5 text-right">'
    +'    <button type="button" class="btn btn-primary" id="addrow">Masukan ke Resep</button>'
    +'  </div>'
    +'  <div class="col-sm-1 text-right">'
    +'  </div>'
    +'  <div class="col-sm-5">'
    +'    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal_racikan">Input Racikan</button>'
    +'  </div>'
    +'</div>'
    +'</div>'

    +'</div>');
////end toggle untuk input resep

//AUTO COMPLETE SEGMENT
$(function() {
	$("#obat").keydown(function(e) {
		//console.log(e.which);
    if (e.which == 190) {
			alert('Mohon maaf, simbol .(titik) pada keyboard tidak bisa digunakan untuk input resep, mungkin anda bisa mencoba tanda ,(koma)');
			return false;
    }
    });
    $("#obat").autocomplete({
      source: "<?php echo base_url('penjualan_obat/eresep/inner_get_data_autocomplet_obat'); ?>",
      minLength: 3,
      select: function(event, ui) {
        $("#jenis_obat").val(ui.item.jenis_obat);
        $("#id_fa").val(ui.item.id_fa);
      },
      appendTo: '#styleSelector'
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
    source: "<?php echo base_url('penjualan_obat/eresep/inner_get_data_autocomplet_obat_dosis'); ?>",
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
    source: "<?php echo base_url('penjualan_obat/eresep/inner_get_data_autocomplet_obat_frekwensi'); ?>",
    minLength: 1,
    select: function(event, ui) {}
  });
});


$(function() {
  $("#tme").autocomplete({
    source: "<?php echo base_url('penjualan_obat/eresep/inner_get_data_autocomplet_obat_tme'); ?>",
    minLength: 1,
    select: function(event, ui) {}
  });
});
//END AUTO COMPLETE SEGMENT

document.getElementById("butt_simpan_resep").hidden = true;
  document.getElementById("batal_new_eresep").hidden = true;

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
      url : baseUrl+"penjualan_obat/eresep/add_additional",
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

$(function() {
  $("#frm_obat").autocomplete({
    source: "<?php echo base_url('penjualan_obat/eresep/inner_get_data_autocomplet_obat'); ?>",
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
		source: "<?php #echo base_url('penjualan_obat/eresep/inner_get_data_autocomplet_obat_dosis'); ?>",
		minLength: 1,
		select: function( event, ui ) {
		}
	});
});
*/

// ----------------------------------------------------------------------------------------
$(function() {
  $("#frekwensi_tpl").autocomplete({
    source: "<?php echo base_url('penjualan_obat/eresep/inner_get_data_autocomplet_obat_frekwensi'); ?>",
    minLength: 1,
    select: function(event, ui) {}
  });
});

$(function() {
  $("#tme_tpl").autocomplete({
    source: "<?php echo base_url('penjualan_obat/eresep/inner_get_data_autocomplet_obat_tme'); ?>",
    minLength: 1,
    select: function(event, ui) {}
  });
});

function get_random_number() {
  var mymin = 100000;
  var mymax = 999999;
  var myrandom = Math.floor(Math.random() * (+mymax - +mymin)) + +mymin;
  console.log("Random Number Generated : " + myrandom);
  return myrandom;
}
////////////////////////////////////////////////
</script>