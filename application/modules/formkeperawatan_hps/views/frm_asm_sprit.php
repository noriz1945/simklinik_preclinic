<style type="text/css">
  .input-append .btn.dropdown-toggle {
    float: none;
}
.pnl-head-1, .pnl-head-2, .pnl-head-3{
	text-align:center;
	font-weight:bold;
}
.table-cppt{
    border-style: solid;
    border-color: black;
    }

    .pnl{
    background-color:#f8f8f8;
    }
  </style>


<div class="container-fluid form_asm_awal_sprit">
  <form action="#" id="form_asm_awal_sprit">
    <div class="form-body">
      <!-- Hidden fields -->
      <input type="hidden" class="form-control input-default" id="id_pasien" name="id_pasien">
      <input type="hidden" class="form-control input-default" id="id_reg" name="id_reg" value="<?php echo $id_reg; ?>">
      <input type="hidden" class="form-control input-default" id="id_sprit" name="id_sprit">
      <!-- Hidden fields -->

      <h3 class="pnl-head-3" id="sini">SURAT PENGANTAR RAWAT INAP / TINDAKAN (RENCANA ASUHAN)</h3>
      <div class="row pnl">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label">Diagnosa Kerja :</label>
            <textarea class="form-control input-focus area-scroll" id="diagnosa_kerja" name="diagnosa_kerja" rows="5" placeholder="Diagnosa Kerja"></textarea>
          </div>

          <div class="form-group">
            <label class="control-label">Rencana Asuhan :</label>
            <textarea class="form-control input-focus area-scroll" id="rencana_asuhan" name="rencana_asuhan" rows="5" placeholder="Rencana Asuhan"></textarea>
          </div>

          <div class="form-group">
            <label class="control-label">Hasil Asuhan yang diharapkan :</label>
            <textarea class="form-control input-focus area-scroll" id="hasil_asuhan" name="hasil_asuhan" rows="5" placeholder="Hasil Asuhan yang diharapkan"></textarea>
          </div>
        </div>
        <!--/span-->
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label">Cito / Elektif :</label>
            <textarea class="form-control input-focus area-scroll" id="cito" name="cito" rows="5" placeholder="Cito"></textarea>
          </div>

          <div class="form-group">
            <label class="control-label">Perkiraan Biaya :</label>
            <textarea class="form-control input-focus area-scroll" id="perkiraan_biaya" name="perkiraan_biaya" rows="5" placeholder="Perkiraan Biaya"></textarea>

          </div>

        </div>

      </div>

      <h3 class="pnl-head-3">Kategori Tindakan</h3>
      <div class="row pnl">

        <div class="col-md-12">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label">Kecil 1, 2, 3  :</label>
              </div>
            </div>

            <div class="col-md-9">
              <div class="form-group">
                <input type="text" id="kecil" name="kecil" class="form-control col-sm-6">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label">Sedang 1, 2, 3 :</label>
              </div>
            </div>

            <div class="col-md-9">
              <div class="form-group">
                <input type="text" id="sedang" name="sedang" class="form-control col-sm-6">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label">Besar 1, 2, 3 :</label>
              </div>
            </div>

            <div class="col-md-9">
              <div class="form-group">
                <input type="text" id="besar" name="besar" class="form-control col-sm-6">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label">Khusus 1,2,3,4,5,6 :</label>
              </div>
            </div>

            <div class="col-md-9">
              <div class="form-group">
                <input type="text" id="khusus" name="khusus" class="form-control col-sm-6">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label">Nama Dokter :</label>
              </div>
            </div>

            <div class="col-md-9">
              <div class="form-group">
              <select id="dokter_set" name="dokter_set" class="form-control col-sm-6">
                <option selected default value="0">Pilih</option>
                <?php foreach($user_all as $dtop){ ?>
                <option value="<?php echo $dtop['login_name']; ?>"><?php echo $dtop['name']; ?></option>
                <?php } ?>
              </select>
              </div>
            </div>

            

          </div>
        </div>
      </div>

        <div class="modal-footer">
          <div class="form-actions">
            <button type="button" class="btn btn-danger" id="reset_sprit">Reset</button>
            <button type="button" class="btn btn-success" id="save_sprit" data-set-idreg="<?php echo $id_reg; ?>">Save</button>
          </div>
        </div>

    </div>
  </form>

  <hr>
  <h5><b>Riwayat Surat Pengantar Rawat Inap</b></h5>
  <div class="table-responsive">
     <table id="datatable" class="table table-striped table-bordered" style="width:100%">
      <thead>
        <tr class="headings">
          <th class="column-title"><i class="fa fa-eye"></i></th>
          <th class="column-title">PRINT</th>
          <th class="column-title">DIAGNOSA KERJA </th>
          <th class="column-title">DOKTER </th>
          <th class="column-title">DIBUAT OLEH </th>
          <th class="column-title">TANGGAL BUAT</th>
          <th class="column-title">HAPUS</th>
        </tr>
      </thead>                           
        <tbody id="tbriwsprit"></tbody>
    </table>
  </div>
</div>

<?php $this->theme->script('theme_default'); ?>
 

<script>
var baseUrl = '<?php echo $base_url; ?>';
$(document).ready(function(){ 
  var idreg_set = $('#id_reg').val();
  listdiagnosa(idreg_set);
});

$("#id_frmkepe_sprit").click(function(){
  var idreg_set = $('#id_reg').val();
  listdiagnosa(idreg_set);
});

$("#reset_sprit").click(function(){
      $('#id_sprit').val('');
      $('#diagnosa_kerja').val('');
      $('#rencana_asuhan').val('');
      $('#hasil_asuhan').val('');
      $('#cito').val('');
      $('#perkiraan_biaya').val('');
      $('#kecil').val('');
      $('#sedang').val('');
      $('#besar').val('');
      $('#khusus').val('');
      $('#dokter_set').val('');
      $('input[type=radio]').prop('checked',false);
      $('select').prop('selectedIndex', 0);

      document.getElementById('sini').scrollIntoView();
      document.getElementById("update_sprit").classList.remove('btn-warning');
      document.getElementById("update_sprit").classList.add('btn-success');
      document.getElementById('update_sprit').id = 'save_sprit';
      const changeText = document.querySelector("#save_sprit");
      changeText.textContent = "Save";
});

$("#save_sprit").click(function(e){
  e.preventDefault();
  var idreg              = $(this).attr("data-set-idreg");
  var id_sprit           = $('#id_sprit').val();
  var diagnosa_kerja     = $('#diagnosa_kerja').val();
  var rencana_asuhan     = $('#rencana_asuhan').val();
  var hasil_asuhan       = $('#hasil_asuhan').val();
  var cito               = $('#cito').val();
  var perkiraan_biaya    = $('#perkiraan_biaya').val();
  var kecil              = $('#kecil').val();
  var sedang             = $('#sedang').val();
  var besar              = $('#besar').val();
  var khusus             = $('#khusus').val();
  var dokter_set         = $('#dokter_set').val();
  var data_submit = $('#form_asm_awal_sprit').serialize();

  if(diagnosa_kerja==''){
    Swal.fire('Gagal!', 'Diagnosa kerja Kosong!', 'danger');
    return false;
  }else if(rencana_asuhan==''){
    Swal.fire('Gagal!', 'Rencana asuhan Kosong!', 'danger');
    return false;
  }else if(hasil_asuhan==''){
    Swal.fire('Gagal!', 'Hasil asuhan yang diharapkan Kosong!', 'danger');
    return false;
  }else if(cito==''){
    Swal.fire('Gagal!', 'cito Kosong!', 'danger');
    return false;
  }else if(perkiraan_biaya==''){
    Swal.fire('Gagal!', 'Perkiraan biaya Kosong!', 'danger');
    return false;
  }else if(dokter_set=='0'){
    Swal.fire('Gagal!', 'Pilih Dokter!', 'danger');
    return false;
  }else{

    Swal.fire({
        title: 'SIMPAN  ?',
        text: 'SURAT PENGANTAR RAWAT INAP',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        denyButtonText: `Tidak`,
      }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("save_sprit").disabled = true; 
  
            $.ajax({
              type: 'POST',
              data: data_submit,
              dataType: 'JSON',
              url : baseUrl+"formkeperawatan/frm_sprit/asm_sprit_add",
              success: function(data) {
              
                //location.reload();
              
                //reset
                id_sprit           = $('#id_sprit').val('');
                diagnosa_kerja     = $('#diagnosa_kerja').val('');
                rencana_asuhan     = $('#rencana_asuhan').val('');
                hasil_asuhan       = $('#hasil_asuhan').val('');
                cito               = $('#cito').val('');
                perkiraan_biaya    = $('#perkiraan_biaya').val('');
                kecil              = $('#kecil').val('');
                sedang             = $('#sedang').val('');
                besar              = $('#besar').val('');
                khusus             = $('#khusus').val('');
                dokter_set         = $('#dokter_set').val('');
                $('input[type=radio]').prop('checked',false);
                $('select').prop('selectedIndex', 0);
                //end reset
              
                Swal.fire('Sukses', '', 'success');
                document.getElementById("save_sprit").disabled = false; 
                listdiagnosa(idreg);
              },
              error: function(xhr, ajaxOptions, thrownError) {
                show_my_error_message2(xhr.responseText,xhr.status,xhr.statusText);
              }
              });
          } else if (result.isDenied) {
              Swal.fire('Batal Simpan', '', 'info')
          }
      });



  }

});

function listdiagnosa(idreg_set){
    $.ajax({
      url : baseUrl+"formkeperawatan/frm_sprit/logsprit",
      method : "POST",
      data : {idreg_set:idreg_set},
      async : true,
      dataType : 'json',
      success: function(res){
        var ires;
        var dataresnyah="";
         for (ires = 0; ires < res.length; ires++) {
                dataresnyah +="<tr>"
                +"<td><input type='radio' id='id_line2' name='id_line2' class='radbut_sprit' value='"+res[ires].id+"'></td>"
                +"<td><button class='btn btn-info print_sprit' data-set-id='"+res[ires].id+"'><i class='fa fa-print'></i></button></td>"
                +"<td>"+res[ires].diagnosa_kerja+"</td>"
                +"<td>"+res[ires].nama_dokter+"</td>"
                +"<td>"+res[ires].creator+"</td>"
                +"<td>"+res[ires].created+"</td>"
                +"<td><button class='btn btn-danger delete_sprit' data-set-id='"+res[ires].id+"'><i class='fa fa-trash'></i></button></td>"
                +"</tr>";
         }
         $('#tbriwsprit').html(dataresnyah);

         $(".radbut_sprit").click(function(){
          document.getElementById('sini').scrollIntoView();

            var id_set    = $(this).val();
            
               $.ajax({
                url : baseUrl+"formkeperawatan/frm_sprit/det_data",
                method : "POST",
                data : { id_set : id_set },
                async : false,
                dataType : 'json',
                success: function(data){
              
                  $('#id_sprit').val(data.id);
                  $('#diagnosa_kerja').val(data.diagnosa_kerja);
                  $('#rencana_asuhan').val(data.rencana_asuhan);
                  $('#hasil_asuhan').val(data.hasil_asuhan);
                  $('#cito').val(data.cito);
                  $('#perkiraan_biaya').val(data.perkiraan_biaya);
                  $('#kecil').val(data.kecil);
                  $('#sedang').val(data.sedang);
                  $('#besar').val(data.besar);
                  $('#khusus').val(data.khusus);
                  $('#dokter_set').val(data.dokter_set);

                  //End set button update
                  document.getElementById("save_sprit").classList.remove('btn-success');
                  document.getElementById("save_sprit").classList.add('btn-warning');
                  document.getElementById('save_sprit').id = 'update_sprit';
                  const changeText = document.querySelector("#update_sprit");
                  changeText.textContent = "Update";
                  //End set button update

                $("#update_sprit").click(function(e){
                  e.preventDefault();
                  var idreg              = $(this).attr("data-set-idreg");
                  var id_sprit           = $('#id_sprit').val();
                  var diagnosa_kerja     = $('#diagnosa_kerja').val();
                  var rencana_asuhan     = $('#rencana_asuhan').val();
                  var hasil_asuhan       = $('#hasil_asuhan').val();
                  var cito               = $('#cito').val();
                  var perkiraan_biaya    = $('#perkiraan_biaya').val();
                  var kecil              = $('#kecil').val();
                  var sedang             = $('#sedang').val();
                  var besar              = $('#besar').val();
                  var khusus             = $('#khusus').val();
                  var dokter_set         = $('#dokter_set').val();
                  var data_submit = $('#form_asm_awal_sprit').serialize();
                                    
                  if(diagnosa_kerja==''){
                    Swal.fire('Gagal!', 'Diagnosa kerja Kosong!', 'danger');
                    return false;
                  }else if(rencana_asuhan==''){
                    Swal.fire('Gagal!', 'Rencana asuhan Kosong!', 'danger');
                    return false;
                  }else if(hasil_asuhan==''){
                    Swal.fire('Gagal!', 'Hasil asuhan yang diharapkan Kosong!', 'danger');
                    return false;
                  }else if(cito==''){
                    Swal.fire('Gagal!', 'cito Kosong!', 'danger');
                    return false;
                  }else if(perkiraan_biaya==''){
                    Swal.fire('Gagal!', 'Perkiraan biaya Kosong!', 'danger');
                    return false;
                  }else if(dokter_set=='0'){
                    Swal.fire('Gagal!', 'Pilih Dokter!', 'danger');
                    return false;
                  }else{
                    
                    Swal.fire({
                        title: 'UPDATE  ?',
                        text: 'SURAT PENGANTAR RAWAT INAP',
                        showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonText: 'Ya',
                        denyButtonText: `Tidak`,
                      }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById("update_sprit").disabled = true; 
                        
                            $.ajax({
                              type: 'POST',
                              data: data_submit,
                              dataType: 'JSON',
                              url : baseUrl+"formkeperawatan/frm_sprit/asm_sprit_upd",
                              success: function(data) {
                              
                                //location.reload();
                              
                                //reset
                                id_sprit           = $('#id_sprit').val('');
                                diagnosa_kerja     = $('#diagnosa_kerja').val('');
                                rencana_asuhan     = $('#rencana_asuhan').val('');
                                hasil_asuhan       = $('#hasil_asuhan').val('');
                                cito               = $('#cito').val('');
                                perkiraan_biaya    = $('#perkiraan_biaya').val('');
                                kecil              = $('#kecil').val('');
                                sedang             = $('#sedang').val('');
                                besar              = $('#besar').val('');
                                khusus             = $('#khusus').val('');
                                dokter_set         = $('#dokter_set').val('');
                                $('input[type=radio]').prop('checked',false);
                                $('select').prop('selectedIndex', 0);
                                //end reset
                              
                                Swal.fire('Sukses', '', 'success');
                                document.getElementById("update_sprit").disabled = false; 
                                listdiagnosa(idreg);
                              },
                              error: function(jqXHR, textStatus, errorThrown) {
                                //console.log(data);
                                Swal.fire('Gagal', '', 'danger')
                                document.getElementById("update_sprit").disabled = false; 
                              }
                              });
                          } else if (result.isDenied) {
                              Swal.fire('Batal Edit', '', 'info')
                          }
                      });
                      
                      
                      
                  }
                  
                });

                },
              error: function(xhr, ajaxOptions, thrownError) {
                show_my_error_message2(xhr.responseText,xhr.status,xhr.statusText);
              }
               });


             

         });

         $(".delete_sprit").click(function(e){
          e.preventDefault();
            var idset=$(this).attr("data-set-id");
              Swal.fire({
                  title: 'HAPUS  ? ',
                  text: 'SURAT PENGANTAR RAWAT INAP',
                  showDenyButton: true,
                  showCancelButton: true,
                  confirmButtonText: 'Ya',
                  denyButtonText: `Tidak`,
              }).then((result) => {
              if (result.isConfirmed) {
                  $.ajax({
                    type: 'POST',
                    data: {idset:idset},
                    dataType: 'JSON',
                    url : baseUrl+"formkeperawatan/frm_sprit/asm_sprit_del",
                    success: function(data) {
                      Swal.fire('Sukses', '', 'success');
                      listdiagnosa(idreg_set);
                    },
              error: function(xhr, ajaxOptions, thrownError) {
                show_my_error_message2(xhr.responseText,xhr.status,xhr.statusText);
              }
                  });
               } else if (result.isDenied) {
                  Swal.fire('Batal Hapus', '', 'info')
                }
              });

                  
         });

         $(".print_sprit").click(function(e){
          e.preventDefault();
            var idset=$(this).attr("data-set-id");
            $.ajax({
                    type: 'POST',
                    data: {idset:idset},
                    dataType: 'html',
                    url : baseUrl+"formkeperawatan/frm_sprit/asm_sprit_prt/"+idset,
                    success: function(data) {
                    window.open(baseUrl+'formkeperawatan/frm_sprit/asm_sprit_prt/'+idset,'1541221517736', 'width=1024,height=600,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');
                    },
              error: function(xhr, ajaxOptions, thrownError) {
                show_my_error_message2(xhr.responseText,xhr.status,xhr.statusText);
              }
                  });

                  
         });
      },
              error: function(xhr, ajaxOptions, thrownError) {
                show_my_error_message2(xhr.responseText,xhr.status,xhr.statusText);
              }
    });
  }
</script>
