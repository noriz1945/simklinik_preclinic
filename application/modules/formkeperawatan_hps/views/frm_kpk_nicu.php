<div class="container-fluid form_news_anak">
<input type="hidden" class="form-control input-default" id="id_reg" name="id_reg" value="<?php echo $id_reg; ?>">

  <hr>
  <h5><b>FORMULIR KRITERIA PASIEN KELUAR NICU</b></h5>
  <div class="table-responsive">
     <table class="table table-bordered" style="width:100%">                        
        <tbody id="tbriwakpknicu"></tbody>
    </table>
  </div>
  <br>
  <div id="row">
  <div class="form-group row">
  <div class="col-sm-1">
  <button class="btn btn-success send_news_1_akpk" type="button">Simpan <i class="fa fa-check"></i></button>
  </div>
  </div>
  </div>


  <!--<hr>
  <h5><b>RIWAYAT FORMULIR KRITERIA PASIEN MASUK ICU</b></h5>
  <div class="table-responsive">
     <table class="table table-bordered" style="width:100%">                          
        <tbody id="tbriwa2" class="tbriwa3kpk"></tbody>
    </table>
  </div>
  <button class="btn btn-warning" id="report_a" type="button">Harian<i class="fa fa-pdf"></i></button>-->
</div>

<?php //$this->theme->script('theme_default'); ?>
<script src="<?php echo base_url('assets/datepicker/datesdki.js'); ?>"></script>
<script src="<?php echo base_url('assets/datepicker/datesdki.css'); ?>"></script>

<script>
var baseUrl = '<?php echo $base_url; ?>';

$(document).ready(function(){ 
  
  var idreg_set   = $('#id_reg').val();
  listmst(idreg_set);
});


$("#id_frmkepe_kpkicu").click(function(){
  var idreg_set = $('#id_reg').val();
  listmst(idreg_set);
});

function listmst(idreg_set){
  var pj = '<?php echo $creator; ?>';
    $.ajax({
      url : baseUrl+"formkeperawatan/frm_kpk_nicu/mst",
      method : "POST",
      data : {idreg_set:idreg_set},
      async : true,
      dataType : 'json',
      success: function(data){
        var irestind='';
        var irestind2='';
        var line_1_det='';
         for (irestind = 0; irestind < data.length; irestind++){ 
          line_1_det +="<tr><td rowspan="+data[irestind].total+" style='vertical-align : middle;text-align:center;'>"+data[irestind].nama_grup;
          for (irestind2 = 0; irestind2 < data[irestind].rs_1.length; irestind2++){
            if(data[irestind].rs_1[irestind2].nilai_from_trn_1==null || data[irestind].rs_1[irestind2].nilai_from_trn_1==0){ 
              var nilai_0_set = 'selected';
              var nilai_1_set = '';
              var nilai_2_set = '';
            }else if(data[irestind].rs_1[irestind2].nilai_from_trn_1==1){ 
              var nilai_0_set = '';
              var nilai_1_set = 'selected';
              var nilai_2_set = '';
            }else if(data[irestind].rs_1[irestind2].nilai_from_trn_1==2){ 
              var nilai_0_set = '';
              var nilai_1_set = '';
              var nilai_2_set = 'selected';
            }

            line_1_det +="<tr><td style='vertical-align : middle;text-align:left;' colspan='2'>"+data[irestind].rs_1[irestind2].indikator+"</td>"
            +"<td colspan='2'><select class='form-control selytkpk' id='12jam_1a[]' name='12jam_1a[]' attr-data-idmst='"+data[irestind].rs_1[irestind2].id+"'><option value='0' "+nilai_0_set+" default>Pilih</option><option value='1' "+nilai_1_set+">Ya</option><option value='2' "+nilai_2_set+">Tidak</option></select></td>"
            +"</tr>";
          }
          line_1_det +="</td></tr>";
         }
         $('#tbriwakpknicu').html(line_1_det);

         $('.12jam_1a').on('input blur paste', function(){
          $(this).val($(this).val().replace(/\D/g, ''));
         });


      },
              error: function(xhr, ajaxOptions, thrownError) {
                show_my_error_message2(xhr.responseText,xhr.status,xhr.statusText);
              }
    });
    
}

        //Simpen
        $(".send_news_1_akpk").click(function(e){
          e.preventDefault();
          var idreg_set             = $('#id_reg').val();
          //set row 1
          var jam12_1       = new Array();
          var jam12_1_idmst = new Array();
          $('.selytkpk').each(function(){ 
            jam12_1.push($(this).val());
            jam12_1_idmst.push($(this).attr("attr-data-idmst"));
          });

          var jam12_1_set         = jam12_1; 
          var jam12_1_idmst_set   = jam12_1_idmst; 


          $.ajax({
            url : baseUrl+"formkeperawatan/frm_kpk_nicu/save_news",
            method : "POST",
            data : { idreg_set:idreg_set,jam12_1_set:jam12_1_set,jam12_1_idmst_set:jam12_1_idmst_set},
            //async : false,
            dataType : 'json',
            success: function(data){
              //$('select').prop('selectedIndex', 0);
              Swal.fire('Berhasil!', 'Formulir Kriteria Pasien Keluar NICU', 'success');
            },
              error: function(xhr, ajaxOptions, thrownError) {
                show_my_error_message2(xhr.responseText,xhr.status,xhr.statusText);
              }
          });
          listmst(idreg_set);
          return false;
        
        });
        //End Simpen
        


    $("#report_a").click(function(){
      var idreg_set     = $('#id_reg').val();
      $.ajax({
            url : baseUrl+"formkeperawatan/frm_kpk_nicu/mst_rep",
            method : "POST",
            data : { idreg_set:idreg_set},
            //async : false,
            dataType : 'json',
            success: function(data){
              var irestind='';
        var irestind2='';
        var irestind3='';
        var irestind4='';
        var line_1_det='';
        let sumnailainya_1 = 0;

          //for (irestind = 0; irestind < data.length; irestind++){
            line_1_det2 ="<tr style='font-weight:bold;'><td colspan='2'>INDIKATOR</td><td colspan='2'>YA / TIDAK</td></tr>";
            for (irestind = 0; irestind < data.length; irestind++){
            line_1_det +="<tr><td rowspan="+data[irestind].total+" style='vertical-align : middle;text-align:center;font-weight:bold;'>"+data[irestind].nama_grup;
            for (irestind2 = 0; irestind2 < data[irestind].rs_1.length; irestind2++){

              line_1_det +="<tr><td style='vertical-align : middle;text-align:left;font-weight:bold;' colspan='2'>"+data[irestind].rs_1[irestind2].indikator+"</td>"
              for (irestind3 = 0; irestind3 < data[irestind].rs_1[irestind2].rs_2.length; irestind3++){

              if(data[irestind].rs_1[irestind2].rs_2[irestind3].nilai_1==null || data[irestind].rs_1[irestind2].rs_2[irestind3].nilai_1=='0'){ 
              var nilai_1_set = "-";
              }else if(data[irestind].rs_1[irestind2].rs_2[irestind3].nilai_1=='1'){ 
                var nilai_1_set = 'YA';
              }else if(data[irestind].rs_1[irestind2].rs_2[irestind3].nilai_1=='2'){ 
                var nilai_1_set = 'TIDAK';
              }else{
                var nilai_1_set = '-';
              }

                line_1_det +="<td style='vertical-align : middle;text-align:left;'>"+nilai_1_set+"</td>";


              
              }
              line_1_det +="</tr>";
              
              
            }



          }


          line_1_det +="</td></tr>"
              +"<tr>"
              +"<td colspan='3' style='vertical-align : middle;text-align:center;'><b>Total Score</b></td>"
              +"<td colspan='24' style='font-weight:bold;text-align:center;'>"+sumnailainya_1+"</td>"
              +"</tr>";

              $('.tbriwa3kpknicu').html(line_1_det2+line_1_det);
            
            },
              error: function(xhr, ajaxOptions, thrownError) {
                show_my_error_message2(xhr.responseText,xhr.status,xhr.statusText);
              }
          });

    });

</script>
