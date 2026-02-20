<div class="container-fluid form_resikojatuh_anak">
<input type="hidden" class="form-control input-default" id="id_reg" name="id_reg" value="<?php echo $id_reg; ?>">

  <hr>
  <h5><b>RESIKO JATUH ANAK</b></h5>
  <div class="table-responsive">
     <table class="table table-bordered" style="width:100%">
      <thead>
        <tr class="headings">
          <th class="column-title" colspan="3">TANGGAL & WAKTU</th>
          <?php 
          	$tanggal_set=date_create('now');
            $tanggal = date_format($tanggal_set,"d-m-Y");
          ?>
          <th class="column-title" colspan="1"><input type="text" id="rjatanggal" name="tanggal" class="form-control" placeholder="Pilih Tanggal" onKeyDown="preventBackspace();" value="<?php echo $tanggal; ?>"></th>
          <th class="column-title" colspan="1"><select id="rjajam" name="jam" class="form-control">
          <option default selected disabled value="0">Pilih Jam</option>
          <?php for($i = 1; $i <= 24; $i++): ?>
          <?php if($i<=9) { echo "<option value='$i'>0$i:00</option>"; }else{ ?>
          <?php echo "<option value='$i'>$i:00</option>"; } ?>
        <?php endfor; ?>
          </th>
        </tr>
      </thead>                           
        <tbody id="tbriwrja"></tbody>
    </table>
  </div>
  <br>
  <div id="row">
  <div class="form-group row">
  <div class="col-sm-1">
  <button class="btn btn-success send_resikojatuh_1_rja" type="button">Simpan <i class="fa fa-check"></i></button>
  </div>
  <div class="col-sm-1">
  <label>Laporan : </label>
  </div>
  <div class="col-sm-1">
  <button class="btn btn-warning" id="report_rja" type="button">Harian<i class="fa fa-pdf"></i></button>
  </div>
  <div class="col-sm-1">
  <label>Per Periode : </label>
  </div>
  <div class="col-sm-2">
  <input type="text" id="rjatanggal_period_1" name="tanggal_period_1" class="form-control" placeholder="Pilih Tanggal" value="<?php echo $tanggal; ?>">
  </div>
  <div class="col-sm-2">
  <input type="text" id="rjatanggal_period_2" name="tanggal_period_2" class="form-control" placeholder="Pilih Tanggal" value="<?php echo $tanggal; ?>">
  </div>
  <div class="col-sm-1">
  <button class="btn btn-warning" id="report_brja" type="button"><i class="fa fa-search"></i></button>
  </div>
  </div>
  </div>


  <hr>
  <h5><b>RESIKO JATUH ANAK</b></h5>
  <div class="table-responsive">
     <table class="table table-bordered" style="width:100%">                          
        <tbody id="tbriwrja2" class="tbriwrja3"></tbody>
    </table>
  </div>
</div>

<script src="<?php echo base_url('assets/datepicker/datesdki.js'); ?>"></script>
<script src="<?php echo base_url('assets/datepicker/datesdki.css'); ?>"></script>

<script>
var baseUrl = '<?php echo $base_url; ?>';

function loadingnyah(){
  //loading
  let timerInterval
  Swal.fire({
    title: 'Loading Get Data',
    allowOutsideClick: false,
    didOpen: () => {
      Swal.showLoading()
      const b = Swal.getHtmlContainer().querySelector('b')
      timerInterval = setInterval(() => {
        b.textContent = Swal.getTimerLeft()
      }, 100)
    },
    willClose: () => {
      clearInterval(timerInterval)
    }
  })
  //end loading
}

$(document).ready(function(){ 
  loadingnyah();
  $('#rjatanggal').datepicker({ dateFormat: 'dd-mm-yy' });
  $('#rjatanggal_period_1').datepicker({ dateFormat: 'dd-mm-yy' });
  $('#rjatanggal_period_2').datepicker({ dateFormat: 'dd-mm-yy' });
  
  var idreg_set   = $('#id_reg').val();
  var tanggal_set = $('#rjatanggal').val();
  var jam_set     = $('#rjajam').val();
  listmst(idreg_set,tanggal_set, jam_set);
});


$("#id_frmkepe_rja").click(function(){
  loadingnyah();
  $('#rjatanggal').datepicker({ dateFormat: 'dd-mm-yy' });
  $('#rjatanggal_period_1').datepicker({ dateFormat: 'dd-mm-yy' });
  $('#rjatanggal_period_2').datepicker({ dateFormat: 'dd-mm-yy' });

  var idreg_set   = $('#id_reg').val();
  var tanggal_set = $('#rjatanggal').val();
  var jam_set     = $('#rjajam').val();
  listmst(idreg_set,tanggal_set,jam_set);
});

$("#rjatanggal,#rjajam").bind('change', function(){
  loadingnyah();
  var idreg_set   = $('#id_reg').val();
  var tanggal_set = $('#rjatanggal').val();
  var jam_set     = $('#rjajam').val();
  listmst(idreg_set,tanggal_set,jam_set);
});

function listmst(idreg_set,tanggal_set,jam_set){
  var pj = '<?php echo $creator; ?>';
    $.ajax({
      url : baseUrl+"formkeperawatan/frm_resikojatuh_anak/mst",
      method : "POST",
      data : {idreg_set:idreg_set,tanggal_set:tanggal_set,jam_set:jam_set},
      async : true,
      dataType : 'json',
      success: function(data){
        swal.close();
        var irestind='';
        var irestind2='';
        var line_1_det='';
         for (irestind = 0; irestind < data.length; irestind++){ 
          line_1_det +="<tr><td rowspan="+data[irestind].total+" style='vertical-align : middle;text-align:center;'>"+data[irestind].nama_grup;
          for (irestind2 = 0; irestind2 < data[irestind].rs_1.length; irestind2++){
            if(data[irestind].rs_1[irestind2].nilai_from_trn_1==null){ 
              var nilai_1_set = 0;
            }else{
              var nilai_1_set = data[irestind].rs_1[irestind2].nilai_from_trn_1;
            }
            line_1_det +="<tr><td style='vertical-align : middle;text-align:left;'>"+data[irestind].rs_1[irestind2].indikator+"</td>"
            +"<td style='vertical-align : middle;text-align:left;'><b>"+data[irestind].rs_1[irestind2].nilai+"</b></td>"
            +"<td colspan='2'><input type='text' id='12jam_1a[]' name='12jam_1a[]' class='form-control 12jam_1a' placeholder='Isi Nilai' attr-data-idmst='"+data[irestind].rs_1[irestind2].id+"' value='"+nilai_1_set+"'></td>"
            +"</tr>";
          }
          line_1_det +="</td></tr>";
         }
         line_2_det = "<tr>"
         +"<td colspan='3' style='vertical-align : middle;text-align:center;'><b>Total Score ( Minimal 7 )</b></td>"
         +"<td style='vertical-align : middle;text-align:center;' colspan='2'><input type='text' id='total_score_1a' name='total_score_1a' class='form-control' placeholder='Total Score' readonly></td>"
         +"</tr>"
         +"<tr>"
         +"<td colspan='3' style='vertical-align : middle;text-align:center;'><b>Penanggung Jawab</b></td>"
         +"<td colspan='2' style='vertical-align : middle;text-align:center;'><b>"+pj+"</b></td>"
         +"</tr>"
         +"<tr>"
         +"<td colspan='5' style='vertical-align : middle;text-align:center;'><b>KETERANGAN SCORING</b></td>"
         +"</tr>"
         +"<tr>"
         +"<td colspan='5' style='vertical-align : middle;text-align:center;'><b>Resiko Rendah 7 - 11</b></td>"
         +"</tr>"
         +"<tr>"
         +"<td colspan='5' style='vertical-align : middle;text-align:center;'><b>Resiko Tinggi > 12</b></td>"
         +"</tr>";
         $('#tbriwrja').html(line_1_det+line_2_det);

         $('.12jam_1a').on('input blur paste', function(){
          $(this).val($(this).val().replace(/\D/g, ''));
         });


        //calc
        $(".12jam_1a").each(function () {

          $(this).change(function () {
          var sum = 0;
          $(".12jam_1a").each(function () {
          if (!isNaN(this.value) && this.value.length != 0) {
              sum += parseFloat(this.value);
          }
          });
          $("#total_score_1a").val(sum.toFixed(0));
          });
        });
        //end calc


        //auto calc
        var arr1 = document.getElementsByClassName('12jam_1a');
        var tot1=0;
        for(var i1=0;i1<arr1.length;i1++){
          if(parseFloat(arr1[i1].value))
            tot1 += parseFloat(arr1[i1].value);
        }
        document.getElementById('total_score_1a').value = tot1;
        //end auto calc


      },
              error: function(xhr, ajaxOptions, thrownError) {
                show_my_error_message2(xhr.responseText,xhr.status,xhr.statusText);
              }
    });
    
}

        //Simpen
        $(".send_resikojatuh_1_rja").click(function(e){
          e.preventDefault();
          var idreg_set     = $('#id_reg').val();
          var tanggal_set   = $('#rjatanggal').val();
          var jam_set       = $('#rjajam').val();
          //set row 1
          var jam12_1       = new Array();
          var jam12_1_idmst = new Array();
          $('input[name="12jam_1a[]"]:input').each(function(){ 
            jam12_1.push($(this).val());
            jam12_1_idmst.push($(this).attr("attr-data-idmst"));
          });

          var jam12_1_set         = jam12_1; 
          var jam12_1_idmst_set   = jam12_1_idmst; 

          if(jam_set==null){
            Swal.fire('Gagal!', 'Pilih Jam', 'warning');
          return false;
          }else{
          $.ajax({
            url : baseUrl+"formkeperawatan/frm_resikojatuh_anak/save_news",
            method : "POST",
            data : { idreg_set:idreg_set, tanggal_set:tanggal_set,jam_set:jam_set,jam12_1_set:jam12_1_set,jam12_1_idmst_set:jam12_1_idmst_set},
            //async : false,
            dataType : 'json',
            success: function(data){
              //$('select').prop('selectedIndex', 0);
              Swal.fire('Berhasil!', 'RESIKO JATUH ANAK', 'success');
            },
              error: function(xhr, ajaxOptions, thrownError) {
                show_my_error_message2(xhr.responseText,xhr.status,xhr.statusText);
              }
          });
          listmst(idreg_set,tanggal_set,jam_set);
          return false;
        }
        });
        //End Simpen
        

  function preventBackspace(e) {
        var evt = e || window.event;
        if (evt) {
            var keyCode = evt.charCode || evt.keyCode;
            if (keyCode === 8) {
                if (evt.preventDefault) {
                    evt.preventDefault();
                } else {
                    evt.returnValue = false;
                }
            }
        }
    }
    $("#report_rja").click(function(){
      loadingnyah();

      var idreg_set     = $('#id_reg').val();
      var tanggal_set   = $('#rjatanggal').val();
      //alert(idreg_set+"-"+tanggal_set);
      $.ajax({
            url : baseUrl+"formkeperawatan/frm_resikojatuh_anak/mst_rep",
            method : "POST",
            data : { idreg_set:idreg_set, tanggal_set:tanggal_set},
            //async : false,
            dataType : 'json',
            success: function(data){
              swal.close();
              var irestind='';
              var irestind2='';
              var irestind3='';
              var irestind4='';
              var line_1_det='';
              let sumnailainya_1 = 0;
              var settotal_1  = 0;
              var settotal_2  = 0;
              var settotal_3  = 0;
              var settotal_4  = 0;
              var settotal_5  = 0;
              var settotal_6  = 0;
              var settotal_7  = 0;
              var settotal_8  = 0;
              var settotal_9  = 0;
              var settotal_10 = 0;
              var settotal_11 = 0;
              var settotal_12 = 0;
              var settotal_13 = 0;
              var settotal_14 = 0;
              var settotal_15 = 0;
              var settotal_16 = 0;
              var settotal_17 = 0;
              var settotal_18 = 0;
              var settotal_19 = 0;
              var settotal_20 = 0;
              var settotal_21 = 0;
              var settotal_22 = 0;
              var settotal_23 = 0;
              var settotal_24 = 0;
              var hline_1_det = '';
              var tanggalnyahset = '';
              var t1td  =0;
              var t2td  =0;
              var t3td  =0;
              var t4td  =0;
              var t5td  =0;
              var t6td  =0;
              var t7td  =0;
              var t8td  =0;
              var t9td  =0;
              var t10td =0;
              var t11td =0;
              var t12td =0;
              var t13td =0;
              var t14td =0;
              var t15td =0;
              var t16td =0;
              var t17td =0;
              var t18td =0;
              var t19td =0;
              var t20td =0;
              var t21td =0;
              var t22td =0;
              var t23td =0;
              var t24td =0;

         //for (irestind = 0; irestind < data.length; irestind++){ 
          for (irestind = 0; irestind < data.length; irestind++){
            line_1_det +="<tr><td colspan='27' style='vertical-align : middle;text-align:center;background-color:#FFC514;'><b>"+data[irestind].tanggal+"</b></td></tr>";
            //line_1_det +="<tr style='font-weight:bold;'><td colspan='2'>INDIKATOR</td><td>NILAI</td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td><td>11</td><td>12</td><td>13</td><td>14</td><td>15</td><td>16</td><td>17</td><td>18</td><td>19</td><td>20</td><td>21</td><td>22</td><td>23</td><td>24</td></tr>";

            ////HEADER DOANK
            for (irestind2 = 0; irestind2 < 1; irestind2++){
            for (irestind3 = 0; irestind3 < 1; irestind3++){
            for (irestind4 = 0; irestind4 < 1; irestind4++){
            //////////////////
              
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_1==null){ var t1 = 0; }else{ var t1 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_2==null){ var t2 = 0; }else{ var t2 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_3==null){ var t3 = 0; }else{ var t3 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_4==null){ var t4 = 0; }else{ var t4 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_5==null){ var t5 = 0; }else{ var t5 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_6==null){ var t6 = 0; }else{ var t6 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_7==null){ var t7 = 0; }else{ var t7 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_8==null){ var t8 = 0; }else{ var t8 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_9==null){ var t9 = 0; }else{ var t9 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_10==null){ var t10 = 0; }else{ var t10 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_11==null){ var t11 = 0; }else{ var t11 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_12==null){ var t12 = 0; }else{ var t12 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_13==null){ var t13 = 0; }else{ var t13 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_14==null){ var t14 = 0; }else{ var t14 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_15==null){ var t15 = 0; }else{ var t15 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_16==null){ var t16 = 0; }else{ var t16 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_17==null){ var t17 = 0; }else{ var t17 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_18==null){ var t18 = 0; }else{ var t18 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_19==null){ var t19 = 0; }else{ var t19 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_20==null){ var t20 = 0; }else{ var t20 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_21==null){ var t21 = 0; }else{ var t21 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_22==null){ var t22 = 0; }else{ var t22 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_23==null){ var t23 = 0; }else{ var t23 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_24==null){ var t24 = 0; }else{ var t24 = 1;}


              if(t1==1){  t1td  = '<td style="background-color:#faffb5;text-align:center;">1</td>';  }else{ t1td  = ''; }
              if(t2==1){  t2td  = '<td style="background-color:#faffb5;text-align:center;">2</td>';  }else{ t2td  = ''; }
              if(t3==1){  t3td  = '<td style="background-color:#faffb5;text-align:center;">3</td>';  }else{ t3td  = ''; }
              if(t4==1){  t4td  = '<td style="background-color:#faffb5;text-align:center;">4</td>';  }else{ t4td  = ''; }
              if(t5==1){  t5td  = '<td style="background-color:#faffb5;text-align:center;">5</td>';  }else{ t5td  = ''; }
              if(t6==1){  t6td  = '<td style="background-color:#faffb5;text-align:center;">6</td>';  }else{ t6td  = ''; }
              if(t7==1){  t7td  = '<td style="background-color:#faffb5;text-align:center;">7</td>';  }else{ t7td  = ''; }
              if(t8==1){  t8td  = '<td style="background-color:#faffb5;text-align:center;">8</td>';  }else{ t8td  = ''; }
              if(t9==1){  t9td  = '<td style="background-color:#faffb5;text-align:center;">9</td>';  }else{ t9td  = ''; }
              if(t10==1){ t10td = '<td style="background-color:#faffb5;text-align:center;">10</td>'; }else{ t10td = ''; }
              if(t11==1){ t11td = '<td style="background-color:#faffb5;text-align:center;">11</td>'; }else{ t11td = ''; }
              if(t12==1){ t12td = '<td style="background-color:#faffb5;text-align:center;">12</td>'; }else{ t12td = ''; }
              if(t13==1){ t13td = '<td style="background-color:#faffb5;text-align:center;">13</td>'; }else{ t13td = ''; }
              if(t14==1){ t14td = '<td style="background-color:#faffb5;text-align:center;">14</td>'; }else{ t14td = ''; }
              if(t15==1){ t15td = '<td style="background-color:#faffb5;text-align:center;">15</td>'; }else{ t15td = ''; }
              if(t16==1){ t16td = '<td style="background-color:#faffb5;text-align:center;">16</td>'; }else{ t16td = ''; }
              if(t17==1){ t17td = '<td style="background-color:#faffb5;text-align:center;">17</td>'; }else{ t17td = ''; }
              if(t18==1){ t18td = '<td style="background-color:#faffb5;text-align:center;">18</td>'; }else{ t18td = ''; }
              if(t19==1){ t19td = '<td style="background-color:#faffb5;text-align:center;">19</td>'; }else{ t19td = ''; }
              if(t20==1){ t20td = '<td style="background-color:#faffb5;text-align:center;">20</td>'; }else{ t20td = ''; }
              if(t21==1){ t21td = '<td style="background-color:#faffb5;text-align:center;">21</td>'; }else{ t21td = ''; }
              if(t22==1){ t22td = '<td style="background-color:#faffb5;text-align:center;">22</td>'; }else{ t22td = ''; }
              if(t23==1){ t23td = '<td style="background-color:#faffb5;text-align:center;">23</td>'; }else{ t23td = ''; }
              if(t24==1){ t24td = '<td style="background-color:#faffb5;text-align:center;">24</td>'; }else{ t24td = ''; }
              line_1_det +="<tr style='font-weight:bold;'><td colspan='2'>INDIKATOR</td><td>NILAI</td>"+t1td+t2td+t3td+t4td+t5td+t6td+t7td+t8td+t9td+t10td+t11td+t12td+t13td+t14td+t15td+t16td+t17td+t18td+t19td+t20td+t21td+t22td+t23td+t24td+"</tr>";
            /////////////////
            }
     
            }

            }
          ////END HEADER DOANK

          for (irestind2 = 0; irestind2 < data[irestind].rs_1.length; irestind2++){
            line_1_det +="<tr><td rowspan="+data[irestind].rs_1[irestind2].total+" style='vertical-align : middle;text-align:center;font-weight:bold;'>"+data[irestind].rs_1[irestind2].nama_grup;
            for (irestind3 = 0; irestind3 < data[irestind].rs_1[irestind2].rs_2.length; irestind3++){
              if(data[irestind].rs_1[irestind2].rs_2[irestind3].nilai_from_trn_1==null){ 
              var nilai_1_set = "";
              var nilai_1_calc = 0;
              }else{
                var nilai_1_set = data[irestind].rs_1[irestind2].rs_2[irestind3].nilai_from_trn_1;
                var nilai_1_calc  = data[irestind].rs_1[irestind2].rs_2[irestind3].nilai_from_trn_1;
              }

              line_1_det +="<tr><td style='vertical-align : middle;text-align:left;font-weight:bold;'>"+data[irestind].rs_1[irestind2].rs_2[irestind3].indikator+"</td><td style='vertical-align : middle;text-align:left;font-weight:bold;'>"+data[irestind].rs_1[irestind2].rs_2[irestind3].nilai+"</td>"
              for (irestind4 = 0; irestind4 < data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3.length; irestind4++){

                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_1==null){ var nilai_1=0; var stylebg_nilai_1=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_1==0){ var nilai_1="x"; var stylebg_nilai_1="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_1="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_1+"</b>"; var stylebg_nilai_1="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_2==null){ var nilai_2=0; var stylebg_nilai_2=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_2==0){ var nilai_2="x"; var stylebg_nilai_2="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_2="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_2+"</b>"; var stylebg_nilai_2="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_3==null){ var nilai_3=0; var stylebg_nilai_3=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_3==0){ var nilai_3="x"; var stylebg_nilai_3="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_3="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_3+"</b>"; var stylebg_nilai_3="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_4==null){ var nilai_4=0; var stylebg_nilai_4=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_4==0){ var nilai_4="x"; var stylebg_nilai_4="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_4="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_4+"</b>"; var stylebg_nilai_4="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_5==null){ var nilai_5=0; var stylebg_nilai_5=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_5==0){ var nilai_5="x"; var stylebg_nilai_5="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_5="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_5+"</b>"; var stylebg_nilai_5="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_6==null){ var nilai_6=0; var stylebg_nilai_6=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_6==0){ var nilai_6="x"; var stylebg_nilai_6="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_6="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_6+"</b>"; var stylebg_nilai_6="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_7==null){ var nilai_7=0; var stylebg_nilai_7=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_7==0){ var nilai_7="x"; var stylebg_nilai_7="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_7="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_7+"</b>"; var stylebg_nilai_7="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_8==null){ var nilai_8=0; var stylebg_nilai_8=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_8==0){ var nilai_8="x"; var stylebg_nilai_8="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_8="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_8+"</b>"; var stylebg_nilai_8="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_9==null){ var nilai_9=0; var stylebg_nilai_9=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_9==0){ var nilai_9="x"; var stylebg_nilai_9="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_9="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_9+"</b>"; var stylebg_nilai_9="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_10==null){ var nilai_10=0; var stylebg_nilai_10=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_10==0){ var nilai_10="x"; var stylebg_nilai_10="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_10="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_10+"</b>"; var stylebg_nilai_10="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_11==null){ var nilai_11=0; var stylebg_nilai_11=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_11==0){ var nilai_11="x"; var stylebg_nilai_11="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_11="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_11+"</b>"; var stylebg_nilai_11="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_12==null){ var nilai_12=0; var stylebg_nilai_12=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_12==0){ var nilai_12="x"; var stylebg_nilai_12="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_12="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_12+"</b>"; var stylebg_nilai_12="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_13==null){ var nilai_13=0; var stylebg_nilai_13=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_13==0){ var nilai_13="x"; var stylebg_nilai_13="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_13="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_13+"</b>"; var stylebg_nilai_13="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_14==null){ var nilai_14=0; var stylebg_nilai_14=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_14==0){ var nilai_14="x"; var stylebg_nilai_14="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_14="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_14+"</b>"; var stylebg_nilai_14="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_15==null){ var nilai_15=0; var stylebg_nilai_15=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_15==0){ var nilai_15="x"; var stylebg_nilai_15="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_15="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_15+"</b>"; var stylebg_nilai_15="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_16==null){ var nilai_16=0; var stylebg_nilai_16=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_16==0){ var nilai_16="x"; var stylebg_nilai_16="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_16="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_16+"</b>"; var stylebg_nilai_16="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_17==null){ var nilai_17=0; var stylebg_nilai_17=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_17==0){ var nilai_17="x"; var stylebg_nilai_17="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_17="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_17+"</b>"; var stylebg_nilai_17="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_18==null){ var nilai_18=0; var stylebg_nilai_18=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_18==0){ var nilai_18="x"; var stylebg_nilai_18="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_18="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_18+"</b>"; var stylebg_nilai_18="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_19==null){ var nilai_19=0; var stylebg_nilai_19=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_19==0){ var nilai_19="x"; var stylebg_nilai_19="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_19="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_19+"</b>"; var stylebg_nilai_19="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_20==null){ var nilai_20=0; var stylebg_nilai_20=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_20==0){ var nilai_20="x"; var stylebg_nilai_20="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_20="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_20+"</b>"; var stylebg_nilai_20="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_21==null){ var nilai_21=0; var stylebg_nilai_21=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_21==0){ var nilai_21="x"; var stylebg_nilai_21="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_21="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_21+"</b>"; var stylebg_nilai_21="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_22==null){ var nilai_22=0; var stylebg_nilai_22=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_22==0){ var nilai_22="x"; var stylebg_nilai_22="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_22="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_22+"</b>"; var stylebg_nilai_22="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_23==null){ var nilai_23=0; var stylebg_nilai_23=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_23==0){ var nilai_23="x"; var stylebg_nilai_23="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_23="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_23+"</b>"; var stylebg_nilai_23="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_24==null){ var nilai_24=0; var stylebg_nilai_24=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_24==0){ var nilai_24="x"; var stylebg_nilai_24="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_24="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_24+"</b>"; var stylebg_nilai_24="background-color:#34e366;color:white;text-align:center;";}}


                settotal_1  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_1); 
                settotal_2  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_2); 
                settotal_3  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_3); 
                settotal_4  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_4); 
                settotal_5  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_5); 
                settotal_6  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_6); 
                settotal_7  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_7); 
                settotal_8  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_8); 
                settotal_9  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_9); 
                settotal_10 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_10); 
                settotal_11 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_11); 
                settotal_12 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_12); 
                settotal_13 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_13); 
                settotal_14 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_14); 
                settotal_15 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_15); 
                settotal_16 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_16); 
                settotal_17 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_17); 
                settotal_18 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_18); 
                settotal_19 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_19); 
                settotal_20 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_20); 
                settotal_21 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_21); 
                settotal_22 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_22); 
                settotal_23 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_23); 
                settotal_24 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_24); 


                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_1==null){ var setrow_1_content = ""; }else{ var setrow_1_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_1+"'>"+nilai_1+"</td>"; var setrow_1_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_1+"</td>"; var t1 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_2==null){ var setrow_2_content = ""; }else{ var setrow_2_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_2+"'>"+nilai_2+"</td>"; var setrow_2_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_2+"</td>"; var t2 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_3==null){ var setrow_3_content = ""; }else{ var setrow_3_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_3+"'>"+nilai_3+"</td>"; var setrow_3_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_3+"</td>"; var t3 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_4==null){ var setrow_4_content = ""; }else{ var setrow_4_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_4+"'>"+nilai_4+"</td>"; var setrow_4_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_4+"</td>"; var t4 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_5==null){ var setrow_5_content = ""; }else{ var setrow_5_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_5+"'>"+nilai_5+"</td>"; var setrow_5_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_5+"</td>"; var t5 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_6==null){ var setrow_6_content = ""; }else{ var setrow_6_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_6+"'>"+nilai_6+"</td>"; var setrow_6_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_6+"</td>"; var t6 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_7==null){ var setrow_7_content = ""; }else{ var setrow_7_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_7+"'>"+nilai_7+"</td>"; var setrow_7_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_7+"</td>"; var t7 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_8==null){ var setrow_8_content = ""; }else{ var setrow_8_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_8+"'>"+nilai_8+"</td>"; var setrow_8_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_8+"</td>"; var t8 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_9==null){ var setrow_9_content = ""; }else{ var setrow_9_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_9+"'>"+nilai_9+"</td>"; var setrow_9_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_9+"</td>"; var t9 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_10==null){ var setrow_10_content = ""; }else{ var setrow_10_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_10+"'>"+nilai_10+"</td>"; var setrow_10_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_10+"</td>"; var t10 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_11==null){ var setrow_11_content = ""; }else{ var setrow_11_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_11+"'>"+nilai_11+"</td>"; var setrow_11_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_11+"</td>"; var t11 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_12==null){ var setrow_12_content = ""; }else{ var setrow_12_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_12+"'>"+nilai_12+"</td>"; var setrow_12_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_12+"</td>"; var t12 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_13==null){ var setrow_13_content = ""; }else{ var setrow_13_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_13+"'>"+nilai_13+"</td>"; var setrow_13_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_13+"</td>"; var t13 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_14==null){ var setrow_14_content = ""; }else{ var setrow_14_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_14+"'>"+nilai_14+"</td>"; var setrow_14_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_14+"</td>"; var t14 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_15==null){ var setrow_15_content = ""; }else{ var setrow_15_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_15+"'>"+nilai_15+"</td>"; var setrow_15_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_15+"</td>"; var t15 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_16==null){ var setrow_16_content = ""; }else{ var setrow_16_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_16+"'>"+nilai_16+"</td>"; var setrow_16_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_16+"</td>"; var t16 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_17==null){ var setrow_17_content = ""; }else{ var setrow_17_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_17+"'>"+nilai_17+"</td>"; var setrow_17_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_17+"</td>"; var t17 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_18==null){ var setrow_18_content = ""; }else{ var setrow_18_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_18+"'>"+nilai_18+"</td>"; var setrow_18_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_18+"</td>"; var t18 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_19==null){ var setrow_19_content = ""; }else{ var setrow_19_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_19+"'>"+nilai_19+"</td>"; var setrow_19_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_19+"</td>"; var t19 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_20==null){ var setrow_20_content = ""; }else{ var setrow_20_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_20+"'>"+nilai_20+"</td>"; var setrow_20_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_20+"</td>"; var t20 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_21==null){ var setrow_21_content = ""; }else{ var setrow_21_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_21+"'>"+nilai_21+"</td>"; var setrow_21_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_21+"</td>"; var t21 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_22==null){ var setrow_22_content = ""; }else{ var setrow_22_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_22+"'>"+nilai_22+"</td>"; var setrow_22_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_22+"</td>"; var t22 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_23==null){ var setrow_23_content = ""; }else{ var setrow_23_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_23+"'>"+nilai_23+"</td>"; var setrow_23_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_23+"</td>"; var t23 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_24==null){ var setrow_24_content = ""; }else{ var setrow_24_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_24+"'>"+nilai_24+"</td>"; var setrow_24_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_24+"</td>"; var t24 = 1;}

                line_1_det +=setrow_1_content;
                line_1_det +=setrow_2_content;
                line_1_det +=setrow_3_content;
                line_1_det +=setrow_4_content;
                line_1_det +=setrow_5_content;
                line_1_det +=setrow_6_content;
                line_1_det +=setrow_7_content;
                line_1_det +=setrow_8_content;
                line_1_det +=setrow_9_content;
                line_1_det +=setrow_10_content;
                line_1_det +=setrow_11_content;
                line_1_det +=setrow_12_content;
                line_1_det +=setrow_13_content;
                line_1_det +=setrow_14_content;
                line_1_det +=setrow_15_content;
                line_1_det +=setrow_16_content;
                line_1_det +=setrow_17_content;
                line_1_det +=setrow_18_content;
                line_1_det +=setrow_19_content;
                line_1_det +=setrow_20_content;
                line_1_det +=setrow_21_content;
                line_1_det +=setrow_22_content;
                line_1_det +=setrow_23_content;
                line_1_det +=setrow_24_content;


              
              }
              line_1_det +="</tr>";
  
              
            }



          }

          ////TOTAL DOANK
          var settotalb_1  = 0;
          var settotalb_2  = 0;
          var settotalb_3  = 0;
          var settotalb_4  = 0;
          var settotalb_5  = 0;
          var settotalb_6  = 0;
          var settotalb_7  = 0;
          var settotalb_8  = 0;
          var settotalb_9  = 0;
          var settotalb_10 = 0;
          var settotalb_11 = 0;
          var settotalb_12 = 0;
          var settotalb_13 = 0;
          var settotalb_14 = 0;
          var settotalb_15 = 0;
          var settotalb_16 = 0;
          var settotalb_17 = 0;
          var settotalb_18 = 0;
          var settotalb_19 = 0;
          var settotalb_20 = 0;
          var settotalb_21 = 0;
          var settotalb_22 = 0;
          var settotalb_23 = 0;
          var settotalb_24 = 0;
          for (irestind2 = 0; irestind2 < data[irestind].rs_1.length; irestind2++){
          for (irestind3 = 0; irestind3 < data[irestind].rs_1[irestind2].rs_2.length; irestind3++){
          for (irestind4 = 0; irestind4 < data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3.length; irestind4++){
                settotalb_1  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_1); 
                settotalb_2  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_2); 
                settotalb_3  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_3); 
                settotalb_4  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_4); 
                settotalb_5  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_5); 
                settotalb_6  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_6); 
                settotalb_7  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_7); 
                settotalb_8  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_8); 
                settotalb_9  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_9); 
                settotalb_10 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_10); 
                settotalb_11 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_11); 
                settotalb_12 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_12); 
                settotalb_13 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_13); 
                settotalb_14 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_14); 
                settotalb_15 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_15); 
                settotalb_16 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_16); 
                settotalb_17 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_17); 
                settotalb_18 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_18); 
                settotalb_19 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_19); 
                settotalb_20 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_20); 
                settotalb_21 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_21); 
                settotalb_22 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_22); 
                settotalb_23 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_23); 
                settotalb_24 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_24); 

          }
          }
          }

          var td_settotal_1  = (settotalb_1++);
                var td_settotal_2  = (settotalb_2++);
                var td_settotal_3  = (settotalb_3++);
                var td_settotal_4  = (settotalb_4++);
                var td_settotal_5  = (settotalb_5++);
                var td_settotal_6  = (settotalb_6++);
                var td_settotal_7  = (settotalb_7++);
                var td_settotal_8  = (settotalb_8++);
                var td_settotal_9  = (settotalb_9++);
                var td_settotal_10 = (settotalb_10++);
                var td_settotal_11 = (settotalb_11++);
                var td_settotal_12 = (settotalb_12++);
                var td_settotal_13 = (settotalb_13++);
                var td_settotal_14 = (settotalb_14++);
                var td_settotal_15 = (settotalb_15++);
                var td_settotal_16 = (settotalb_16++);
                var td_settotal_17 = (settotalb_17++);
                var td_settotal_18 = (settotalb_18++);
                var td_settotal_19 = (settotalb_19++);
                var td_settotal_20 = (settotalb_20++);
                var td_settotal_21 = (settotalb_21++);
                var td_settotal_22 = (settotalb_22++);
                var td_settotal_23 = (settotalb_23++);
                var td_settotal_24 = (settotalb_24++);

                if(isNaN(td_settotal_1)){  var setrowtot_1=""; }else{ var setrowtot_1="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_1+"</td>"; }
                if(isNaN(td_settotal_2)){  var setrowtot_2=""; }else{ var setrowtot_2="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_2+"</td>"; }
                if(isNaN(td_settotal_3)){  var setrowtot_3=""; }else{ var setrowtot_3="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_3+"</td>"; }
                if(isNaN(td_settotal_4)){  var setrowtot_4=""; }else{ var setrowtot_4="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_4+"</td>"; }
                if(isNaN(td_settotal_5)){  var setrowtot_5=""; }else{ var setrowtot_5="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_5+"</td>"; }
                if(isNaN(td_settotal_6)){  var setrowtot_6=""; }else{ var setrowtot_6="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_6+"</td>"; }
                if(isNaN(td_settotal_7)){  var setrowtot_7=""; }else{ var setrowtot_7="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_7+"</td>"; }
                if(isNaN(td_settotal_8)){  var setrowtot_8=""; }else{ var setrowtot_8="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_8+"</td>"; }
                if(isNaN(td_settotal_9)){  var setrowtot_9=""; }else{ var setrowtot_9="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_9+"</td>"; }
                if(isNaN(td_settotal_10)){ var setrowtot_10=""; }else{ var setrowtot_10="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_10+"</td>"; }
                if(isNaN(td_settotal_11)){ var setrowtot_11=""; }else{ var setrowtot_11="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_11+"</td>"; }
                if(isNaN(td_settotal_12)){ var setrowtot_12=""; }else{ var setrowtot_12="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_12+"</td>"; }
                if(isNaN(td_settotal_13)){ var setrowtot_13=""; }else{ var setrowtot_13="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_13+"</td>"; }
                if(isNaN(td_settotal_14)){ var setrowtot_14=""; }else{ var setrowtot_14="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_14+"</td>"; }
                if(isNaN(td_settotal_15)){ var setrowtot_15=""; }else{ var setrowtot_15="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_15+"</td>"; }
                if(isNaN(td_settotal_16)){ var setrowtot_16=""; }else{ var setrowtot_16="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_16+"</td>"; }
                if(isNaN(td_settotal_17)){ var setrowtot_17=""; }else{ var setrowtot_17="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_17+"</td>"; }
                if(isNaN(td_settotal_18)){ var setrowtot_18=""; }else{ var setrowtot_18="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_18+"</td>"; }
                if(isNaN(td_settotal_19)){ var setrowtot_19=""; }else{ var setrowtot_19="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_19+"</td>"; }
                if(isNaN(td_settotal_20)){ var setrowtot_20=""; }else{ var setrowtot_20="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_20+"</td>"; }
                if(isNaN(td_settotal_21)){ var setrowtot_21=""; }else{ var setrowtot_21="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_21+"</td>"; }
                if(isNaN(td_settotal_22)){ var setrowtot_22=""; }else{ var setrowtot_22="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_22+"</td>"; }
                if(isNaN(td_settotal_23)){ var setrowtot_23=""; }else{ var setrowtot_23="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_23+"</td>"; }
                if(isNaN(td_settotal_24)){ var setrowtot_24=""; }else{ var setrowtot_24="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_24+"</td>"; }

              line_1_det +="<tr>"
              +"<td colspan='3'>Total Score</td>";
              line_1_det +=setrowtot_1;
              line_1_det +=setrowtot_2;
              line_1_det +=setrowtot_3;
              line_1_det +=setrowtot_4;
              line_1_det +=setrowtot_5;
              line_1_det +=setrowtot_6;
              line_1_det +=setrowtot_7;
              line_1_det +=setrowtot_8;
              line_1_det +=setrowtot_9;
              line_1_det +=setrowtot_10;
              line_1_det +=setrowtot_11;
              line_1_det +=setrowtot_12;
              line_1_det +=setrowtot_13;
              line_1_det +=setrowtot_14;
              line_1_det +=setrowtot_15;
              line_1_det +=setrowtot_16;
              line_1_det +=setrowtot_17;
              line_1_det +=setrowtot_18;
              line_1_det +=setrowtot_19;
              line_1_det +=setrowtot_20;
              line_1_det +=setrowtot_21;
              line_1_det +=setrowtot_22;
              line_1_det +=setrowtot_23;
              line_1_det +=setrowtot_24;
              line_1_det +="</tr>";

          ////END TOTAL DOANK

          line_1_det +="</td></tr>"
              +"<tr>"
              +"<td colspan='3' style='vertical-align : middle;text-align:left;'><b>Penanggung Jawab</b></td>"
              +"<td colspan='24' style='vertical-align : middle;text-align:center;background-color:#ebf4f7;'><b>"+data[irestind].creator+"</b></td>"
              +"</tr><tr><td colspan='27' style='background-color:black;'></td></tr>";

              
         }

         $('#tbriwrja2').html(line_1_det);

            },
              error: function(xhr, ajaxOptions, thrownError) {
                show_my_error_message2(xhr.responseText,xhr.status,xhr.statusText);
              }
          });
    });


    $("#report_brja").click(function(){
      var idreg_set              = $('#id_reg').val();
      var tanggal_period_1_set   = $('#rjatanggal_period_1').val();
      var tanggal_period_2_set   = $('#rjatanggal_period_2').val();
      //alert(idreg_set+"-"+tanggal_set);
      $.ajax({
            url : baseUrl+"formkeperawatan/frm_resikojatuh_anak/mst_rep_periode",
            method : "POST",
            data : { idreg_set:idreg_set, tanggal_period_1_set:tanggal_period_1_set,tanggal_period_2_set:tanggal_period_2_set},
            //async : false,
            dataType : 'json',
            success: function(data){
              swal.close();
              var irestind='';
              var irestind2='';
              var irestind3='';
              var irestind4='';
              var line_1_det='';
              let sumnailainya_1 = 0;
              var settotal_1  = 0;
              var settotal_2  = 0;
              var settotal_3  = 0;
              var settotal_4  = 0;
              var settotal_5  = 0;
              var settotal_6  = 0;
              var settotal_7  = 0;
              var settotal_8  = 0;
              var settotal_9  = 0;
              var settotal_10 = 0;
              var settotal_11 = 0;
              var settotal_12 = 0;
              var settotal_13 = 0;
              var settotal_14 = 0;
              var settotal_15 = 0;
              var settotal_16 = 0;
              var settotal_17 = 0;
              var settotal_18 = 0;
              var settotal_19 = 0;
              var settotal_20 = 0;
              var settotal_21 = 0;
              var settotal_22 = 0;
              var settotal_23 = 0;
              var settotal_24 = 0;
              var hline_1_det = '';
              var tanggalnyahset = '';
              var t1td  =0;
              var t2td  =0;
              var t3td  =0;
              var t4td  =0;
              var t5td  =0;
              var t6td  =0;
              var t7td  =0;
              var t8td  =0;
              var t9td  =0;
              var t10td =0;
              var t11td =0;
              var t12td =0;
              var t13td =0;
              var t14td =0;
              var t15td =0;
              var t16td =0;
              var t17td =0;
              var t18td =0;
              var t19td =0;
              var t20td =0;
              var t21td =0;
              var t22td =0;
              var t23td =0;
              var t24td =0;

         //for (irestind = 0; irestind < data.length; irestind++){ 
          for (irestind = 0; irestind < data.length; irestind++){
            var tanggalsetrownyah = data[irestind].tanggal;
            //versi 2
            tanggalnyahset += "<tr><td colspan='27' style='vertical-align : middle;text-align:center;background-color:#FFC514;'><b>"+data[irestind].tanggal+"</b></td></tr>";

            //versi 1
            line_1_det +="<tr><td colspan='27' style='vertical-align : middle;text-align:center;background-color:#FFC514;'><b>"+data[irestind].tanggal+"</b></td></tr>";
            //line_1_det +="<tr style='font-weight:bold;'><td colspan='2'>INDIKATOR</td><td>NILAI</td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td><td>11</td><td>12</td><td>13</td><td>14</td><td>15</td><td>16</td><td>17</td><td>18</td><td>19</td><td>20</td><td>21</td><td>22</td><td>23</td><td>24</td></tr>";
            
          ////HEADER DOANK
            for (irestind2 = 0; irestind2 < 1; irestind2++){
            for (irestind3 = 0; irestind3 < 1; irestind3++){
            for (irestind4 = 0; irestind4 < 1; irestind4++){
          //////////////////
              
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_1==null){ var t1 = 0; }else{ var t1 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_2==null){ var t2 = 0; }else{ var t2 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_3==null){ var t3 = 0; }else{ var t3 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_4==null){ var t4 = 0; }else{ var t4 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_5==null){ var t5 = 0; }else{ var t5 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_6==null){ var t6 = 0; }else{ var t6 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_7==null){ var t7 = 0; }else{ var t7 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_8==null){ var t8 = 0; }else{ var t8 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_9==null){ var t9 = 0; }else{ var t9 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_10==null){ var t10 = 0; }else{ var t10 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_11==null){ var t11 = 0; }else{ var t11 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_12==null){ var t12 = 0; }else{ var t12 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_13==null){ var t13 = 0; }else{ var t13 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_14==null){ var t14 = 0; }else{ var t14 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_15==null){ var t15 = 0; }else{ var t15 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_16==null){ var t16 = 0; }else{ var t16 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_17==null){ var t17 = 0; }else{ var t17 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_18==null){ var t18 = 0; }else{ var t18 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_19==null){ var t19 = 0; }else{ var t19 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_20==null){ var t20 = 0; }else{ var t20 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_21==null){ var t21 = 0; }else{ var t21 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_22==null){ var t22 = 0; }else{ var t22 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_23==null){ var t23 = 0; }else{ var t23 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_24==null){ var t24 = 0; }else{ var t24 = 1;}


              if(t1==1){  t1td  = '<td style="background-color:#faffb5;text-align:center;">1</td>';  }else{ t1td  = ''; }
              if(t2==1){  t2td  = '<td style="background-color:#faffb5;text-align:center;">2</td>';  }else{ t2td  = ''; }
              if(t3==1){  t3td  = '<td style="background-color:#faffb5;text-align:center;">3</td>';  }else{ t3td  = ''; }
              if(t4==1){  t4td  = '<td style="background-color:#faffb5;text-align:center;">4</td>';  }else{ t4td  = ''; }
              if(t5==1){  t5td  = '<td style="background-color:#faffb5;text-align:center;">5</td>';  }else{ t5td  = ''; }
              if(t6==1){  t6td  = '<td style="background-color:#faffb5;text-align:center;">6</td>';  }else{ t6td  = ''; }
              if(t7==1){  t7td  = '<td style="background-color:#faffb5;text-align:center;">7</td>';  }else{ t7td  = ''; }
              if(t8==1){  t8td  = '<td style="background-color:#faffb5;text-align:center;">8</td>';  }else{ t8td  = ''; }
              if(t9==1){  t9td  = '<td style="background-color:#faffb5;text-align:center;">9</td>';  }else{ t9td  = ''; }
              if(t10==1){ t10td = '<td style="background-color:#faffb5;text-align:center;">10</td>'; }else{ t10td = ''; }
              if(t11==1){ t11td = '<td style="background-color:#faffb5;text-align:center;">11</td>'; }else{ t11td = ''; }
              if(t12==1){ t12td = '<td style="background-color:#faffb5;text-align:center;">12</td>'; }else{ t12td = ''; }
              if(t13==1){ t13td = '<td style="background-color:#faffb5;text-align:center;">13</td>'; }else{ t13td = ''; }
              if(t14==1){ t14td = '<td style="background-color:#faffb5;text-align:center;">14</td>'; }else{ t14td = ''; }
              if(t15==1){ t15td = '<td style="background-color:#faffb5;text-align:center;">15</td>'; }else{ t15td = ''; }
              if(t16==1){ t16td = '<td style="background-color:#faffb5;text-align:center;">16</td>'; }else{ t16td = ''; }
              if(t17==1){ t17td = '<td style="background-color:#faffb5;text-align:center;">17</td>'; }else{ t17td = ''; }
              if(t18==1){ t18td = '<td style="background-color:#faffb5;text-align:center;">18</td>'; }else{ t18td = ''; }
              if(t19==1){ t19td = '<td style="background-color:#faffb5;text-align:center;">19</td>'; }else{ t19td = ''; }
              if(t20==1){ t20td = '<td style="background-color:#faffb5;text-align:center;">20</td>'; }else{ t20td = ''; }
              if(t21==1){ t21td = '<td style="background-color:#faffb5;text-align:center;">21</td>'; }else{ t21td = ''; }
              if(t22==1){ t22td = '<td style="background-color:#faffb5;text-align:center;">22</td>'; }else{ t22td = ''; }
              if(t23==1){ t23td = '<td style="background-color:#faffb5;text-align:center;">23</td>'; }else{ t23td = ''; }
              if(t24==1){ t24td = '<td style="background-color:#faffb5;text-align:center;">24</td>'; }else{ t24td = ''; }
              line_1_det +="<tr style='font-weight:bold;'><td colspan='2'>INDIKATOR</td><td>NILAI</td>"+t1td+t2td+t3td+t4td+t5td+t6td+t7td+t8td+t9td+t10td+t11td+t12td+t13td+t14td+t15td+t16td+t17td+t18td+t19td+t20td+t21td+t22td+t23td+t24td+"</tr>";
              /////////////////
            }
     
            }

          }
          ////END HEADER DOANK

          for (irestind2 = 0; irestind2 < data[irestind].rs_1.length; irestind2++){
            line_1_det +="<tr><td rowspan="+data[irestind].rs_1[irestind2].total+" style='vertical-align : middle;text-align:center;font-weight:bold;'>"+data[irestind].rs_1[irestind2].nama_grup;
            for (irestind3 = 0; irestind3 < data[irestind].rs_1[irestind2].rs_2.length; irestind3++){
              if(data[irestind].rs_1[irestind2].rs_2[irestind3].nilai_from_trn_1==null){ 
              var nilai_1_set = "";
              var nilai_1_calc = 0;
              }else{
                var nilai_1_set = data[irestind].rs_1[irestind2].rs_2[irestind3].nilai_from_trn_1;
                var nilai_1_calc  = data[irestind].rs_1[irestind2].rs_2[irestind3].nilai_from_trn_1;
              }

              line_1_det +="<tr><td style='vertical-align : middle;text-align:left;font-weight:bold;'>"+data[irestind].rs_1[irestind2].rs_2[irestind3].indikator+"</td><td style='vertical-align : middle;text-align:left;font-weight:bold;'>"+data[irestind].rs_1[irestind2].rs_2[irestind3].nilai+"</td>"
              for (irestind4 = 0; irestind4 < data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3.length; irestind4++){

                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_1==null){ var nilai_1=0; var stylebg_nilai_1=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_1==0){ var nilai_1="x"; var stylebg_nilai_1="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_1="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_1+"</b>"; var stylebg_nilai_1="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_2==null){ var nilai_2=0; var stylebg_nilai_2=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_2==0){ var nilai_2="x"; var stylebg_nilai_2="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_2="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_2+"</b>"; var stylebg_nilai_2="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_3==null){ var nilai_3=0; var stylebg_nilai_3=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_3==0){ var nilai_3="x"; var stylebg_nilai_3="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_3="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_3+"</b>"; var stylebg_nilai_3="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_4==null){ var nilai_4=0; var stylebg_nilai_4=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_4==0){ var nilai_4="x"; var stylebg_nilai_4="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_4="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_4+"</b>"; var stylebg_nilai_4="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_5==null){ var nilai_5=0; var stylebg_nilai_5=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_5==0){ var nilai_5="x"; var stylebg_nilai_5="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_5="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_5+"</b>"; var stylebg_nilai_5="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_6==null){ var nilai_6=0; var stylebg_nilai_6=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_6==0){ var nilai_6="x"; var stylebg_nilai_6="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_6="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_6+"</b>"; var stylebg_nilai_6="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_7==null){ var nilai_7=0; var stylebg_nilai_7=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_7==0){ var nilai_7="x"; var stylebg_nilai_7="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_7="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_7+"</b>"; var stylebg_nilai_7="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_8==null){ var nilai_8=0; var stylebg_nilai_8=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_8==0){ var nilai_8="x"; var stylebg_nilai_8="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_8="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_8+"</b>"; var stylebg_nilai_8="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_9==null){ var nilai_9=0; var stylebg_nilai_9=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_9==0){ var nilai_9="x"; var stylebg_nilai_9="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_9="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_9+"</b>"; var stylebg_nilai_9="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_10==null){ var nilai_10=0; var stylebg_nilai_10=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_10==0){ var nilai_10="x"; var stylebg_nilai_10="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_10="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_10+"</b>"; var stylebg_nilai_10="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_11==null){ var nilai_11=0; var stylebg_nilai_11=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_11==0){ var nilai_11="x"; var stylebg_nilai_11="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_11="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_11+"</b>"; var stylebg_nilai_11="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_12==null){ var nilai_12=0; var stylebg_nilai_12=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_12==0){ var nilai_12="x"; var stylebg_nilai_12="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_12="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_12+"</b>"; var stylebg_nilai_12="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_13==null){ var nilai_13=0; var stylebg_nilai_13=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_13==0){ var nilai_13="x"; var stylebg_nilai_13="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_13="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_13+"</b>"; var stylebg_nilai_13="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_14==null){ var nilai_14=0; var stylebg_nilai_14=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_14==0){ var nilai_14="x"; var stylebg_nilai_14="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_14="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_14+"</b>"; var stylebg_nilai_14="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_15==null){ var nilai_15=0; var stylebg_nilai_15=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_15==0){ var nilai_15="x"; var stylebg_nilai_15="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_15="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_15+"</b>"; var stylebg_nilai_15="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_16==null){ var nilai_16=0; var stylebg_nilai_16=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_16==0){ var nilai_16="x"; var stylebg_nilai_16="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_16="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_16+"</b>"; var stylebg_nilai_16="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_17==null){ var nilai_17=0; var stylebg_nilai_17=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_17==0){ var nilai_17="x"; var stylebg_nilai_17="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_17="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_17+"</b>"; var stylebg_nilai_17="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_18==null){ var nilai_18=0; var stylebg_nilai_18=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_18==0){ var nilai_18="x"; var stylebg_nilai_18="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_18="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_18+"</b>"; var stylebg_nilai_18="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_19==null){ var nilai_19=0; var stylebg_nilai_19=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_19==0){ var nilai_19="x"; var stylebg_nilai_19="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_19="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_19+"</b>"; var stylebg_nilai_19="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_20==null){ var nilai_20=0; var stylebg_nilai_20=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_20==0){ var nilai_20="x"; var stylebg_nilai_20="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_20="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_20+"</b>"; var stylebg_nilai_20="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_21==null){ var nilai_21=0; var stylebg_nilai_21=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_21==0){ var nilai_21="x"; var stylebg_nilai_21="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_21="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_21+"</b>"; var stylebg_nilai_21="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_22==null){ var nilai_22=0; var stylebg_nilai_22=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_22==0){ var nilai_22="x"; var stylebg_nilai_22="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_22="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_22+"</b>"; var stylebg_nilai_22="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_23==null){ var nilai_23=0; var stylebg_nilai_23=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_23==0){ var nilai_23="x"; var stylebg_nilai_23="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_23="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_23+"</b>"; var stylebg_nilai_23="background-color:#34e366;color:white;text-align:center;";}}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_24==null){ var nilai_24=0; var stylebg_nilai_24=""; }else{ if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_24==0){ var nilai_24="x"; var stylebg_nilai_24="background-color:#ffb5c5;text-align:center;"; }else{ var nilai_24="<b>"+data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_24+"</b>"; var stylebg_nilai_24="background-color:#34e366;color:white;text-align:center;";}}




                settotal_1  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_1); 
                settotal_2  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_2); 
                settotal_3  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_3); 
                settotal_4  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_4); 
                settotal_5  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_5); 
                settotal_6  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_6); 
                settotal_7  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_7); 
                settotal_8  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_8); 
                settotal_9  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_9); 
                settotal_10 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_10); 
                settotal_11 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_11); 
                settotal_12 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_12); 
                settotal_13 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_13); 
                settotal_14 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_14); 
                settotal_15 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_15); 
                settotal_16 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_16); 
                settotal_17 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_17); 
                settotal_18 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_18); 
                settotal_19 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_19); 
                settotal_20 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_20); 
                settotal_21 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_21); 
                settotal_22 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_22); 
                settotal_23 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_23); 
                settotal_24 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_24); 


                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_1==null){ var setrow_1_content = ""; }else{ var setrow_1_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_1+"'>"+nilai_1+"</td>"; var setrow_1_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_1+"</td>"; var t1 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_2==null){ var setrow_2_content = ""; }else{ var setrow_2_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_2+"'>"+nilai_2+"</td>"; var setrow_2_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_2+"</td>"; var t2 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_3==null){ var setrow_3_content = ""; }else{ var setrow_3_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_3+"'>"+nilai_3+"</td>"; var setrow_3_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_3+"</td>"; var t3 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_4==null){ var setrow_4_content = ""; }else{ var setrow_4_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_4+"'>"+nilai_4+"</td>"; var setrow_4_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_4+"</td>"; var t4 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_5==null){ var setrow_5_content = ""; }else{ var setrow_5_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_5+"'>"+nilai_5+"</td>"; var setrow_5_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_5+"</td>"; var t5 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_6==null){ var setrow_6_content = ""; }else{ var setrow_6_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_6+"'>"+nilai_6+"</td>"; var setrow_6_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_6+"</td>"; var t6 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_7==null){ var setrow_7_content = ""; }else{ var setrow_7_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_7+"'>"+nilai_7+"</td>"; var setrow_7_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_7+"</td>"; var t7 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_8==null){ var setrow_8_content = ""; }else{ var setrow_8_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_8+"'>"+nilai_8+"</td>"; var setrow_8_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_8+"</td>"; var t8 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_9==null){ var setrow_9_content = ""; }else{ var setrow_9_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_9+"'>"+nilai_9+"</td>"; var setrow_9_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_9+"</td>"; var t9 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_10==null){ var setrow_10_content = ""; }else{ var setrow_10_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_10+"'>"+nilai_10+"</td>"; var setrow_10_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_10+"</td>"; var t10 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_11==null){ var setrow_11_content = ""; }else{ var setrow_11_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_11+"'>"+nilai_11+"</td>"; var setrow_11_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_11+"</td>"; var t11 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_12==null){ var setrow_12_content = ""; }else{ var setrow_12_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_12+"'>"+nilai_12+"</td>"; var setrow_12_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_12+"</td>"; var t12 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_13==null){ var setrow_13_content = ""; }else{ var setrow_13_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_13+"'>"+nilai_13+"</td>"; var setrow_13_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_13+"</td>"; var t13 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_14==null){ var setrow_14_content = ""; }else{ var setrow_14_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_14+"'>"+nilai_14+"</td>"; var setrow_14_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_14+"</td>"; var t14 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_15==null){ var setrow_15_content = ""; }else{ var setrow_15_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_15+"'>"+nilai_15+"</td>"; var setrow_15_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_15+"</td>"; var t15 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_16==null){ var setrow_16_content = ""; }else{ var setrow_16_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_16+"'>"+nilai_16+"</td>"; var setrow_16_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_16+"</td>"; var t16 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_17==null){ var setrow_17_content = ""; }else{ var setrow_17_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_17+"'>"+nilai_17+"</td>"; var setrow_17_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_17+"</td>"; var t17 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_18==null){ var setrow_18_content = ""; }else{ var setrow_18_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_18+"'>"+nilai_18+"</td>"; var setrow_18_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_18+"</td>"; var t18 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_19==null){ var setrow_19_content = ""; }else{ var setrow_19_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_19+"'>"+nilai_19+"</td>"; var setrow_19_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_19+"</td>"; var t19 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_20==null){ var setrow_20_content = ""; }else{ var setrow_20_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_20+"'>"+nilai_20+"</td>"; var setrow_20_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_20+"</td>"; var t20 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_21==null){ var setrow_21_content = ""; }else{ var setrow_21_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_21+"'>"+nilai_21+"</td>"; var setrow_21_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_21+"</td>"; var t21 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_22==null){ var setrow_22_content = ""; }else{ var setrow_22_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_22+"'>"+nilai_22+"</td>"; var setrow_22_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_22+"</td>"; var t22 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_23==null){ var setrow_23_content = ""; }else{ var setrow_23_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_23+"'>"+nilai_23+"</td>"; var setrow_23_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_23+"</td>"; var t23 = 1;}
                if(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_24==null){ var setrow_24_content = ""; }else{ var setrow_24_content = "<td style='vertical-align : middle;text-align:left;"+stylebg_nilai_24+"'>"+nilai_24+"</td>"; var setrow_24_content_sum = "<td style='font-weight:bold;text-align:center;'>"+settotal_24+"</td>"; var t24 = 1;}

                sumnailainya_1 = data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].sum_nilai_from_trn_1;
                line_1_det +=setrow_1_content;
                line_1_det +=setrow_2_content;
                line_1_det +=setrow_3_content;
                line_1_det +=setrow_4_content;
                line_1_det +=setrow_5_content;
                line_1_det +=setrow_6_content;
                line_1_det +=setrow_7_content;
                line_1_det +=setrow_8_content;
                line_1_det +=setrow_9_content;
                line_1_det +=setrow_10_content;
                line_1_det +=setrow_11_content;
                line_1_det +=setrow_12_content;
                line_1_det +=setrow_13_content;
                line_1_det +=setrow_14_content;
                line_1_det +=setrow_15_content;
                line_1_det +=setrow_16_content;
                line_1_det +=setrow_17_content;
                line_1_det +=setrow_18_content;
                line_1_det +=setrow_19_content;
                line_1_det +=setrow_20_content;
                line_1_det +=setrow_21_content;
                line_1_det +=setrow_22_content;
                line_1_det +=setrow_23_content;
                line_1_det +=setrow_24_content;


              
              }
              line_1_det +="</tr>";
              
            }

          }



          ////TOTAL DOANK
          var settotalb_1  = 0;
          var settotalb_2  = 0;
          var settotalb_3  = 0;
          var settotalb_4  = 0;
          var settotalb_5  = 0;
          var settotalb_6  = 0;
          var settotalb_7  = 0;
          var settotalb_8  = 0;
          var settotalb_9  = 0;
          var settotalb_10 = 0;
          var settotalb_11 = 0;
          var settotalb_12 = 0;
          var settotalb_13 = 0;
          var settotalb_14 = 0;
          var settotalb_15 = 0;
          var settotalb_16 = 0;
          var settotalb_17 = 0;
          var settotalb_18 = 0;
          var settotalb_19 = 0;
          var settotalb_20 = 0;
          var settotalb_21 = 0;
          var settotalb_22 = 0;
          var settotalb_23 = 0;
          var settotalb_24 = 0;
          for (irestind2 = 0; irestind2 < data[irestind].rs_1.length; irestind2++){
          for (irestind3 = 0; irestind3 < data[irestind].rs_1[irestind2].rs_2.length; irestind3++){
          for (irestind4 = 0; irestind4 < data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3.length; irestind4++){
                settotalb_1  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_1); 
                settotalb_2  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_2); 
                settotalb_3  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_3); 
                settotalb_4  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_4); 
                settotalb_5  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_5); 
                settotalb_6  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_6); 
                settotalb_7  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_7); 
                settotalb_8  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_8); 
                settotalb_9  += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_9); 
                settotalb_10 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_10); 
                settotalb_11 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_11); 
                settotalb_12 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_12); 
                settotalb_13 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_13); 
                settotalb_14 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_14); 
                settotalb_15 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_15); 
                settotalb_16 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_16); 
                settotalb_17 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_17); 
                settotalb_18 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_18); 
                settotalb_19 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_19); 
                settotalb_20 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_20); 
                settotalb_21 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_21); 
                settotalb_22 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_22); 
                settotalb_23 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_23); 
                settotalb_24 += parseInt(data[irestind].rs_1[irestind2].rs_2[irestind3].rs_3[irestind4].nilai_24); 

          }
          }
          }

          var td_settotal_1  = (settotalb_1++);
                var td_settotal_2  = (settotalb_2++);
                var td_settotal_3  = (settotalb_3++);
                var td_settotal_4  = (settotalb_4++);
                var td_settotal_5  = (settotalb_5++);
                var td_settotal_6  = (settotalb_6++);
                var td_settotal_7  = (settotalb_7++);
                var td_settotal_8  = (settotalb_8++);
                var td_settotal_9  = (settotalb_9++);
                var td_settotal_10 = (settotalb_10++);
                var td_settotal_11 = (settotalb_11++);
                var td_settotal_12 = (settotalb_12++);
                var td_settotal_13 = (settotalb_13++);
                var td_settotal_14 = (settotalb_14++);
                var td_settotal_15 = (settotalb_15++);
                var td_settotal_16 = (settotalb_16++);
                var td_settotal_17 = (settotalb_17++);
                var td_settotal_18 = (settotalb_18++);
                var td_settotal_19 = (settotalb_19++);
                var td_settotal_20 = (settotalb_20++);
                var td_settotal_21 = (settotalb_21++);
                var td_settotal_22 = (settotalb_22++);
                var td_settotal_23 = (settotalb_23++);
                var td_settotal_24 = (settotalb_24++);

                if(isNaN(td_settotal_1)){  var setrowtot_1=""; }else{ var setrowtot_1="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_1+"</td>"; }
                if(isNaN(td_settotal_2)){  var setrowtot_2=""; }else{ var setrowtot_2="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_2+"</td>"; }
                if(isNaN(td_settotal_3)){  var setrowtot_3=""; }else{ var setrowtot_3="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_3+"</td>"; }
                if(isNaN(td_settotal_4)){  var setrowtot_4=""; }else{ var setrowtot_4="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_4+"</td>"; }
                if(isNaN(td_settotal_5)){  var setrowtot_5=""; }else{ var setrowtot_5="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_5+"</td>"; }
                if(isNaN(td_settotal_6)){  var setrowtot_6=""; }else{ var setrowtot_6="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_6+"</td>"; }
                if(isNaN(td_settotal_7)){  var setrowtot_7=""; }else{ var setrowtot_7="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_7+"</td>"; }
                if(isNaN(td_settotal_8)){  var setrowtot_8=""; }else{ var setrowtot_8="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_8+"</td>"; }
                if(isNaN(td_settotal_9)){  var setrowtot_9=""; }else{ var setrowtot_9="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_9+"</td>"; }
                if(isNaN(td_settotal_10)){ var setrowtot_10=""; }else{ var setrowtot_10="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_10+"</td>"; }
                if(isNaN(td_settotal_11)){ var setrowtot_11=""; }else{ var setrowtot_11="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_11+"</td>"; }
                if(isNaN(td_settotal_12)){ var setrowtot_12=""; }else{ var setrowtot_12="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_12+"</td>"; }
                if(isNaN(td_settotal_13)){ var setrowtot_13=""; }else{ var setrowtot_13="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_13+"</td>"; }
                if(isNaN(td_settotal_14)){ var setrowtot_14=""; }else{ var setrowtot_14="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_14+"</td>"; }
                if(isNaN(td_settotal_15)){ var setrowtot_15=""; }else{ var setrowtot_15="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_15+"</td>"; }
                if(isNaN(td_settotal_16)){ var setrowtot_16=""; }else{ var setrowtot_16="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_16+"</td>"; }
                if(isNaN(td_settotal_17)){ var setrowtot_17=""; }else{ var setrowtot_17="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_17+"</td>"; }
                if(isNaN(td_settotal_18)){ var setrowtot_18=""; }else{ var setrowtot_18="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_18+"</td>"; }
                if(isNaN(td_settotal_19)){ var setrowtot_19=""; }else{ var setrowtot_19="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_19+"</td>"; }
                if(isNaN(td_settotal_20)){ var setrowtot_20=""; }else{ var setrowtot_20="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_20+"</td>"; }
                if(isNaN(td_settotal_21)){ var setrowtot_21=""; }else{ var setrowtot_21="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_21+"</td>"; }
                if(isNaN(td_settotal_22)){ var setrowtot_22=""; }else{ var setrowtot_22="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_22+"</td>"; }
                if(isNaN(td_settotal_23)){ var setrowtot_23=""; }else{ var setrowtot_23="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_23+"</td>"; }
                if(isNaN(td_settotal_24)){ var setrowtot_24=""; }else{ var setrowtot_24="<td style='background-color:#6cd5f5;text-align:center;'>"+td_settotal_24+"</td>"; }

          line_1_det +="<tr>"
              +"<td colspan='3'>Total Score</td>";
              line_1_det +=setrowtot_1;
              line_1_det +=setrowtot_2;
              line_1_det +=setrowtot_3;
              line_1_det +=setrowtot_4;
              line_1_det +=setrowtot_5;
              line_1_det +=setrowtot_6;
              line_1_det +=setrowtot_7;
              line_1_det +=setrowtot_8;
              line_1_det +=setrowtot_9;
              line_1_det +=setrowtot_10;
              line_1_det +=setrowtot_11;
              line_1_det +=setrowtot_12;
              line_1_det +=setrowtot_13;
              line_1_det +=setrowtot_14;
              line_1_det +=setrowtot_15;
              line_1_det +=setrowtot_16;
              line_1_det +=setrowtot_17;
              line_1_det +=setrowtot_18;
              line_1_det +=setrowtot_19;
              line_1_det +=setrowtot_20;
              line_1_det +=setrowtot_21;
              line_1_det +=setrowtot_22;
              line_1_det +=setrowtot_23;
              line_1_det +=setrowtot_24;
              line_1_det +="</tr>";

          ////END TOTAL DOANK


          
          line_1_det +="<tr>"
              +"<td colspan='3' style='vertical-align : middle;text-align:left;'><b>Penanggung Jawab</b></td>"
              +"<td colspan='24' style='vertical-align : middle;text-align:center;background-color:#ebf4f7;'><b>"+data[irestind].creator+"</b></td></tr>"
              +"<tr><td colspan='27' style='background-color:black;'></td></tr>";

         }

         $('.tbriwrja3').html(line_1_det);
            
            },
              error: function(xhr, ajaxOptions, thrownError) {
                show_my_error_message2(xhr.responseText,xhr.status,xhr.statusText);
              }
          });
    });

</script>
