<form action="#" id="form_pdn">
<div class="container-fluid">
<input type="hidden" class="form-control input-default" id="id_reg" name="id_reg" value="<?php echo $id_reg; ?>">

  <hr>
  <h5><b>FORMULIR PENILAIAN DERAJAT NYERI</b></h5>
  <div class="table-responsive">
    <?php $strrownyah = 1; ?>
    <?php $totrownyah = 24; ?>
     <table class="table table-bordered" style="width:100%">
     <thead>
      <tr>
        <th>Skor</th>
      <?php for ($setrow = 1; $setrow <= $totrownyah; $setrow++) { ?>
        <th><?php echo $setrow; ?></th>
      <?php } ?>
      </tr>
     </thead>            
        <tbody>
          <tr>
            <td>10</td>
            <?php for ($set10 = 1; $set10 <= $totrownyah; $set10++) { ?>
            <td><input type="checkbox" class="set10_<?php echo $set10; ?>" attr-nilai-fr-s10="10"  attr-calc-fr-s10="skorperrow_<?php echo $set10; ?>"  attr-iden-fr-s10="<?php echo $set10; ?>"  id="skor10[]" name="skor10[]" value="<?php echo $set10; ?>"></td>
            <?php } ?>
          </tr>
          <tr>
            <td>9</td>
            <?php for ($set9 = 1; $set9 <= $totrownyah; $set9++) { ?>
            <td><input type="checkbox" class="set9_<?php echo $set9; ?>" attr-nilai-fr-s9="9" attr-calc-fr-s9="skorperrow_<?php echo $set9; ?>"  attr-iden-fr-s9="<?php echo $set9; ?>"  id="skor9[]" name="skor9[]" value="<?php echo $set9; ?>"></td>
            <?php } ?>
          </tr>
          <tr>
            <td>8</td>
            <?php for ($set8 = 1; $set8 <= $totrownyah; $set8++) { ?>
            <td><input type="checkbox" class="set8_<?php echo $set8; ?>" attr-nilai-fr-s8="8" attr-calc-fr-s8="skorperrow_<?php echo $set8; ?>"  attr-iden-fr-s8="<?php echo $set8; ?>"  id="skor8[]" name="skor8[]" value="<?php echo $set8; ?>"></td>
            <?php } ?>
          </tr>
          <tr>
            <td>7</td>
            <?php for ($set7 = 1; $set7 <= $totrownyah; $set7++) { ?>
            <td><input type="checkbox" class="set7_<?php echo $set7; ?>" attr-nilai-fr-s7="7" attr-calc-fr-s7="skorperrow_<?php echo $set7; ?>"  attr-iden-fr-s7="<?php echo $set7; ?>"  id="skor7[]" name="skor7[]" value="<?php echo $set7; ?>"></td>
            <?php } ?>
          </tr>
          <tr>
            <td>6</td>
            <?php for ($set6 = 1; $set6 <= $totrownyah; $set6++) { ?>
            <td><input type="checkbox" class="set6_<?php echo $set6; ?>" attr-nilai-fr-s6="6" attr-calc-fr-s6="skorperrow_<?php echo $set6; ?>"  attr-iden-fr-s6="<?php echo $set6; ?>"  id="skor6[]" name="skor6[]" value="<?php echo $set6; ?>"></td>
            <?php } ?>
          </tr>
          <tr>
            <td>5</td>
            <?php for ($set5 = 1; $set5 <= $totrownyah; $set5++) { ?>
            <td><input type="checkbox" class="set5_<?php echo $set5; ?>" attr-nilai-fr-s5="5" attr-calc-fr-s5="skorperrow_<?php echo $set5; ?>"  attr-iden-fr-s5="<?php echo $set5; ?>"  id="skor5[]" name="skor5[]" value="<?php echo $set5; ?>"></td>
            <?php } ?>
          </tr>
          <tr>
            <td>4</td>
            <?php for ($set4 = 1; $set4 <= $totrownyah; $set4++) { ?>
            <td><input type="checkbox" class="set4_<?php echo $set4; ?>" attr-nilai-fr-s4="4" attr-calc-fr-s4="skorperrow_<?php echo $set4; ?>"  attr-iden-fr-s4="<?php echo $set4; ?>"  id="skor4[]" name="skor4[]" value="<?php echo $set4; ?>"></td>
            <?php } ?>
          </tr>
          <tr>
            <td>3</td>
            <?php for ($set3 = 1; $set3 <= $totrownyah; $set3++) { ?>
            <td><input type="checkbox" class="set3_<?php echo $set3; ?>" attr-nilai-fr-s3="3" attr-calc-fr-s3="skorperrow_<?php echo $set3; ?>"  attr-iden-fr-s3="<?php echo $set3; ?>"  id="skor3[]" name="skor3[]" value="<?php echo $set3; ?>"></td>
            <?php } ?>
          </tr>
          <tr>
            <td>2</td>
            <?php for ($set2 = 1; $set2 <= $totrownyah; $set2++) { ?>
            <td><input type="checkbox" class="set2_<?php echo $set2; ?>" attr-nilai-fr-s2="2" attr-calc-fr-s2="skorperrow_<?php echo $set2; ?>"  attr-iden-fr-s2="<?php echo $set2; ?>"  id="skor2[]" name="skor2[]" value="<?php echo $set2; ?>"></td>
            <?php } ?>
          </tr>
          <tr>
            <td>1</td>
            <?php for ($set1 = 1; $set1 <= $totrownyah; $set1++) { ?>
            <td><input type="checkbox" class="set1_<?php echo $set1; ?>" attr-nilai-fr-s1="1" attr-calc-fr-s1="skorperrow_<?php echo $set1; ?>"  attr-iden-fr-s1="<?php echo $set1; ?>"  id="skor1[]" name="skor1[]" value="<?php echo $set1; ?>"></td>
            <?php } ?>
          </tr>
          <tr>
            <td>0</td>
            <?php for ($set0 = 1; $set0 <= $totrownyah; $set0++) { ?>
            <td><input type="checkbox" class="set0_<?php echo $set0; ?>" attr-nilai-fr-s0="0" attr-calc-fr-s0="skorperrow_<?php echo $set0; ?>"  attr-iden-fr-s0="<?php echo $set0; ?>"  id="skor0[]" name="skor0[]" value="<?php echo $set1; ?>"></td>
            <?php } ?>
          </tr>
          <tr>
            <td>Skor</td>
            <?php for ($setskor = 1; $setskor <= $totrownyah; $setskor++) { ?>
            <td><label id="txtskorperrow_<?php echo $setskor; ?>">0</label><input class="skorperrow_<?php echo $setskor; ?>" type="text" id="skorperrow_<?php echo $setskor; ?>" name="skorperrow[]" value="0" readonly hidden></td>
            <?php } ?>
          </tr>
          <tr>
            <td><i class="fa fa-calendar" style="color:chartreuse;font-size:12px;"></i></td>
            <?php for ($setwaktu = 1; $setwaktu <= $totrownyah; $setwaktu++) { ?>
            <td><input class="form-control waktuperrow"  attr-iden-fr-time="<?php echo $setwaktu; ?>"  type="text" id="waktuperrow_<?php echo $setwaktu; ?>" name="waktuperrow[]" value="00/00/0000 00:00" readonly hidden></td>
            <?php } ?>
          </tr>
          <tr>
          <td>Waktu</td>
          <?php for ($setwaktutxt = 1; $setwaktutxt <= $totrownyah; $setwaktutxt++) { ?>
            <td style="max-width:auto;"><label id="txtwaktuperrow_<?php echo $setwaktutxt; ?>" style="font-size:12px;"></label></td>
          <?php } ?>
          </tr>
          <td>Nama</td>
            <?php for ($setnama = 1; $setnama <= $totrownyah; $setnama++) { ?>
            <td><label id="txtnamaperrow_<?php echo $setnama; ?>"></label><input class="form-control namaperrow"  attr-iden-fr-nama="<?php echo $setnama; ?>"  type="text" id="namaperrow_<?php echo $setnama; ?>" name="namaperrow[]" value="&nbsp;" readonly hidden></td>
          <?php } ?>
          </tr>
        </tbody>
    </table>
  </div>
  <br>
  <div id="row">
  <div class="form-group row">
  <div class="col-sm-1">
  <button class="btn btn-success send_fpdn" type="button">Simpan <i class="fa fa-check"></i></button>
  </div>
  </div>
  </div>

</div>
</form>

<?php //$this->theme->script('theme_default'); ?>
<script src="<?php echo base_url('assets/datepicker/datesdki.js'); ?>"></script>
<script src="<?php echo base_url('assets/datepicker/datesdki.css'); ?>"></script>

<script>
var baseUrl = '<?php echo $base_url; ?>';
var id_reg = '<?php echo $id_reg; ?>';

var irestindwp='';
for (irestindwp = 1; irestindwp < 25; irestindwp++){ 
  $('#waktuperrow_'+irestindwp).datetimepicker({
      showOn: "button",
      buttonImage: "https://jqueryui.com/resources/demos/datepicker/images/calendar.gif",
      buttonImageOnly: true,
      buttonText: "Select date"
});
}

$(".waktuperrow").change(function(e){
  var getsetidentime=$(this).attr("attr-iden-fr-time");

  var wakturow = $("#waktuperrow_"+getsetidentime).val();
  var namacreator = "<?php echo $creator; ?>";
  $("#txtwaktuperrow_"+getsetidentime).html(wakturow);
  $("#txtnamaperrow_"+getsetidentime).html(namacreator);
  $("#namaperrow_"+getsetidentime).val(namacreator);
});



//Simpen
$(".send_fpdn").click(function(e){
   e.preventDefault();
   var data_submit = $('#form_pdn').serialize();

   $.ajax({
     url : baseUrl+"formkeperawatan/frm_risiko_nyeri/save_news",
     method : "POST",
     data : data_submit,
     //async : false,
     dataType : 'json',
     success: function(data){
       //$('select').prop('selectedIndex', 0);
       Swal.fire('Berhasil!', 'Formulir Risiko Nyeri', 'success');
     },
              error: function(xhr, ajaxOptions, thrownError) {
                show_my_error_message2(xhr.responseText,xhr.status,xhr.statusText);
              }
   });
   listmst(idreg_set);
   return false;
  
});



//calc
$(document).ready(function(){
 
 var irestind='';
 for (irestind = 1; irestind < 25; irestind++){ 
   
 $(".set10_"+irestind).click(function(e){
   var getsetiden=$(this).attr("attr-iden-fr-s10");
   var getattrtarget=$(this).attr("attr-calc-fr-s10"); 
   var getnilaitarget=$(this).attr("attr-nilai-fr-s10");
 
   if ($('input.set10_'+getsetiden).prop('checked')) {
     var row = (this.value);
     var skorrow = $("#"+getattrtarget).val();
     //var res_row=(parseInt(skorrow)+parseInt(row));
     var res_row=(parseInt(getnilaitarget));
   }else{
     var row = (this.value);
     var skorrow = $("#"+getattrtarget).val();
     //var res_row=(parseInt(skorrow)-parseInt(row));
     var res_row=(parseInt(getnilaitarget));
   }
   
   $("#skorperrow_"+getsetiden).val(res_row);
   $("#txtskorperrow_"+getsetiden).html(res_row);
 
 });
 
 $(".set9_"+irestind).click(function(e){
  var getsetiden=$(this).attr("attr-iden-fr-s9");
  var getattrtarget=$(this).attr("attr-calc-fr-s9");
  var getnilaitarget=$(this).attr("attr-nilai-fr-s9");

  if ($('input.set9_'+getsetiden).prop('checked')) {
    var row = (this.value);
    var skorrow = $("#"+getattrtarget).val();
    //var res_row=(parseInt(skorrow)+parseInt(row));
    var res_row=(parseInt(getnilaitarget));
  }else{
    var row = (this.value);
    var skorrow = $("#"+getattrtarget).val();
    //var res_row=(parseInt(skorrow)-parseInt(row));
    var res_row=(parseInt(getnilaitarget));
  }
  $("#skorperrow_"+getsetiden).val(res_row);
  $("#txtskorperrow_"+getsetiden).html(res_row);
 });
 
 $(".set8_"+irestind).click(function(e){
  var getsetiden=$(this).attr("attr-iden-fr-s8");
  var getattrtarget=$(this).attr("attr-calc-fr-s8");
  var getnilaitarget=$(this).attr("attr-nilai-fr-s8");

  if ($('input.set8_'+getsetiden).prop('checked')) {
    var row = (this.value);
    var skorrow = $("#"+getattrtarget).val();
    //var res_row=(parseInt(skorrow)+parseInt(row));
    var res_row=(parseInt(getnilaitarget));
  }else{
    var row = (this.value);
    var skorrow = $("#"+getattrtarget).val();
    //var res_row=(parseInt(skorrow)-parseInt(row));
    var res_row=(parseInt(getnilaitarget));
  }
  $("#skorperrow_"+getsetiden).val(res_row);
  $("#txtskorperrow_"+getsetiden).html(res_row);
 });
 
 $(".set7_"+irestind).click(function(e){
  var getsetiden=$(this).attr("attr-iden-fr-s7");
  var getattrtarget=$(this).attr("attr-calc-fr-s7");
  var getnilaitarget=$(this).attr("attr-nilai-fr-s7");

  if ($('input.set7_'+getsetiden).prop('checked')) {
    var row = (this.value);
    var skorrow = $("#"+getattrtarget).val();
    //var res_row=(parseInt(skorrow)+parseInt(row));
    var res_row=(parseInt(getnilaitarget));
  }else{
    var row = (this.value);
    var skorrow = $("#"+getattrtarget).val();
    //var res_row=(parseInt(skorrow)-parseInt(row));
    var res_row=(parseInt(getnilaitarget));
  }
  $("#skorperrow_"+getsetiden).val(res_row);
  $("#txtskorperrow_"+getsetiden).html(res_row);
 });
 
 $(".set6_"+irestind).click(function(e){
  var getsetiden=$(this).attr("attr-iden-fr-s6");
  var getattrtarget=$(this).attr("attr-calc-fr-s6");
  var getnilaitarget=$(this).attr("attr-nilai-fr-s6");

  if ($('input.set6_'+getsetiden).prop('checked')) {
    var row = (this.value);
    var skorrow = $("#"+getattrtarget).val();
    //var res_row=(parseInt(skorrow)+parseInt(row));
    var res_row=(parseInt(getnilaitarget));
  }else{
    var row = (this.value);
    var skorrow = $("#"+getattrtarget).val();
    //var res_row=(parseInt(skorrow)-parseInt(row));
    var res_row=(parseInt(getnilaitarget));
  }
  $("#skorperrow_"+getsetiden).val(res_row);
  $("#txtskorperrow_"+getsetiden).html(res_row);
 });
 
 $(".set5_"+irestind).click(function(e){
  var getsetiden=$(this).attr("attr-iden-fr-s5");
  var getattrtarget=$(this).attr("attr-calc-fr-s5");
  var getnilaitarget=$(this).attr("attr-nilai-fr-s5");

  if ($('input.set5_'+getsetiden).prop('checked')) {
    var row = (this.value);
    var skorrow = $("#"+getattrtarget).val();
    //var res_row=(parseInt(skorrow)+parseInt(row));
    var res_row=(parseInt(getnilaitarget));
  }else{
    var row = (this.value);
    var skorrow = $("#"+getattrtarget).val();
    //var res_row=(parseInt(skorrow)-parseInt(row));
    var res_row=(parseInt(getnilaitarget));
  }
  $("#skorperrow_"+getsetiden).val(res_row);
  $("#txtskorperrow_"+getsetiden).html(res_row);
 });
 
 $(".set4_"+irestind).click(function(e){
  var getsetiden=$(this).attr("attr-iden-fr-s4");
  var getattrtarget=$(this).attr("attr-calc-fr-s4");
  var getnilaitarget=$(this).attr("attr-nilai-fr-s4");

  if ($('input.set4_'+getsetiden).prop('checked')) {
    var row = (this.value);
    var skorrow = $("#"+getattrtarget).val();
    //var res_row=(parseInt(skorrow)+parseInt(row));
    var res_row=(parseInt(getnilaitarget));
  }else{
    var row = (this.value);
    var skorrow = $("#"+getattrtarget).val();
    //var res_row=(parseInt(skorrow)-parseInt(row));
    var res_row=(parseInt(getnilaitarget));
  }
  $("#skorperrow_"+getsetiden).val(res_row);
  $("#txtskorperrow_"+getsetiden).html(res_row);
 });
 
 $(".set3_"+irestind).click(function(e){
  var getsetiden=$(this).attr("attr-iden-fr-s3");
  var getattrtarget=$(this).attr("attr-calc-fr-s3");
  var getnilaitarget=$(this).attr("attr-nilai-fr-s3");

  if ($('input.set3_'+getsetiden).prop('checked')) {
    var row = (this.value);
    var skorrow = $("#"+getattrtarget).val();
    //var res_row=(parseInt(skorrow)+parseInt(row));
    var res_row=(parseInt(getnilaitarget));
  }else{
    var row = (this.value);
    var skorrow = $("#"+getattrtarget).val();
    //var res_row=(parseInt(skorrow)-parseInt(row));
    var res_row=(parseInt(getnilaitarget));
  }
  $("#skorperrow_"+getsetiden).val(res_row);
  $("#txtskorperrow_"+getsetiden).html(res_row);
 });
 
 $(".set2_"+irestind).click(function(e){
  var getsetiden=$(this).attr("attr-iden-fr-s2");
  var getattrtarget=$(this).attr("attr-calc-fr-s2");
  var getnilaitarget=$(this).attr("attr-nilai-fr-s2");

  if ($('input.set2_'+getsetiden).prop('checked')) {
    var row = (this.value);
    var skorrow = $("#"+getattrtarget).val();
    //var res_row=(parseInt(skorrow)+parseInt(row));
    var res_row=(parseInt(getnilaitarget));
  }else{
    var row = (this.value);
    var skorrow = $("#"+getattrtarget).val();
    //var res_row=(parseInt(skorrow)-parseInt(row));
    var res_row=(parseInt(getnilaitarget));
  }
  $("#skorperrow_"+getsetiden).val(res_row);
  $("#txtskorperrow_"+getsetiden).html(res_row);
 });
 
 $(".set1_"+irestind).click(function(e){
  var getsetiden=$(this).attr("attr-iden-fr-s1");
  var getattrtarget=$(this).attr("attr-calc-fr-s1");
  var getnilaitarget=$(this).attr("attr-nilai-fr-s1");

  if ($('input.set1_'+getsetiden).prop('checked')) {
    var row = (this.value);
    var skorrow = $("#"+getattrtarget).val();
    //var res_row=(parseInt(skorrow)+parseInt(row));
    var res_row=(parseInt(getnilaitarget));
  }else{
    var row = (this.value);
    var skorrow = $("#"+getattrtarget).val();
    //var res_row=(parseInt(skorrow)-parseInt(row));
    var res_row=(parseInt(getnilaitarget));
  }
  $("#skorperrow_"+getsetiden).val(res_row);
  $("#txtskorperrow_"+getsetiden).html(res_row);
 });
 
 $(".set0_"+irestind).click(function(e){
  var getsetiden=$(this).attr("attr-iden-fr-s0");
  var getattrtarget=$(this).attr("attr-calc-fr-s0");
  var getnilaitarget=$(this).attr("attr-nilai-fr-s0");

  if ($('input.set0_'+getsetiden).prop('checked')) {
    var row = (this.value);
    var skorrow = $("#"+getattrtarget).val();
    //var res_row=(parseInt(skorrow)+parseInt(row));
    var res_row=(parseInt(getnilaitarget));
  }else{
    var row = (this.value);
    var skorrow = $("#"+getattrtarget).val();
    //var res_row=(parseInt(skorrow)-parseInt(row));
    var res_row=(parseInt(getnilaitarget));
  }
  $("#skorperrow_"+getsetiden).val(res_row);
  $("#txtskorperrow_"+getsetiden).html(res_row);
 });
 
 
 }

 listlogrisiko(id_reg);
});
//end calc
//End Simpen
//////////////////
function listlogrisiko(id_reg){
    $.ajax({
      url : baseUrl+"formkeperawatan/frm_risiko_nyeri/tbdetailformrisiko",
      method : "POST",
      data : {id_reg:id_reg},
      async : true,
      dataType : 'json',
      success: function(data){
        var dernyer_10 = data[0].dernyer_10;
          if (dernyer_10.length > 0) {
            var dernyer_10 = data[0].dernyer_10.split(";"),
              $inputs = $('input[name^=skor10]');
            for (var j = 0; j < dernyer_10.length; j++) {
              $inputs.filter("[value='" + dernyer_10[j] + "']").attr('checked', 'checked');
            }
          }

          var dernyer_9 = data[0].dernyer_9;
          if (dernyer_9.length > 0) {
            var dernyer_2 = data[0].dernyer_9.split(";"),
              $inputs = $('input[name^=skor9]');
            for (var j = 0; j < dernyer_9.length; j++) {
              $inputs.filter("[value='" + dernyer_9[j] + "']").attr('checked', 'checked');
            }
          }
          var dernyer_8 = data[0].dernyer_8;
          if (dernyer_8.length > 0) {
            var dernyer_8 = data[0].dernyer_8.split(";"),
              $inputs = $('input[name^=skor8]');
            for (var j = 0; j < dernyer_8.length; j++) {
              $inputs.filter("[value='" + dernyer_8[j] + "']").attr('checked', 'checked');
            }
          }
          var dernyer_7 = data[0].dernyer_7;
          if (dernyer_7.length > 0) {
            var dernyer_7 = data[0].dernyer_7.split(";"),
              $inputs = $('input[name^=skor7]');
            for (var j = 0; j < dernyer_7.length; j++) {
              $inputs.filter("[value='" + dernyer_7[j] + "']").attr('checked', 'checked');
            }
          }
          var dernyer_6 = data[0].dernyer_6;
          if (dernyer_6.length > 0) {
            var dernyer_6 = data[0].dernyer_6.split(";"),
              $inputs = $('input[name^=skor6]');
            for (var j = 0; j < dernyer_6.length; j++) {
              $inputs.filter("[value='" + dernyer_6[j] + "']").attr('checked', 'checked');
            }
          }
          var dernyer_5 = data[0].dernyer_5;
          if (dernyer_5.length > 0) {
            var dernyer_5 = data[0].dernyer_5.split(";"),
              $inputs = $('input[name^=skor5]');
            for (var j = 0; j < dernyer_5.length; j++) {
              $inputs.filter("[value='" + dernyer_5[j] + "']").attr('checked', 'checked');
            }
          }
          var dernyer_4 = data[0].dernyer_4;
          if (dernyer_4.length > 0) {
            var dernyer_4 = data[0].dernyer_4.split(";"),
              $inputs = $('input[name^=skor4]');
            for (var j = 0; j < dernyer_4.length; j++) {
              $inputs.filter("[value='" + dernyer_4[j] + "']").attr('checked', 'checked');
            }
          }

        var dernyer_3 = data[0].dernyer_3;
          if (dernyer_3.length > 0) {
            var dernyer_3 = data[0].dernyer_3.split(";"),
              $inputs = $('input[name^=skor3]');
            for (var j = 0; j < dernyer_3.length; j++) {
              $inputs.filter("[value='" + dernyer_3[j] + "']").attr('checked', 'checked');
            }
          }

          var dernyer_2 = data[0].dernyer_2;
          if (dernyer_2.length > 0) {
            var dernyer_2 = data[0].dernyer_2.split(";"),
              $inputs = $('input[name^=skor2]');
            for (var j = 0; j < dernyer_2.length; j++) {
              $inputs.filter("[value='" + dernyer_2[j] + "']").attr('checked', 'checked');
            }
          }

          var dernyer_1 = data[0].dernyer_1;
          if (dernyer_1.length > 0) {
            var dernyer_1 = data[0].dernyer_1.split(";"),
              $inputs = $('input[name^=skor1]');
            for (var j = 0; j < dernyer_1.length; j++) {
              $inputs.filter("[value='" + dernyer_1[j] + "']").attr('checked', 'checked');
            }
          }

          var dernyer_0 = data[0].dernyer_0;
          if (dernyer_0.length > 0) {
            var dernyer_0 = data[0].dernyer_0.split(";"),
              $inputs = $('input[name^=skor0]');
            for (var j = 0; j < dernyer_0.length; j++) {
              $inputs.filter("[value='" + dernyer_0[j] + "']").attr('checked', 'checked');
            }
          }

          var totalskor = data[0].totalskor.split(";");
          for (irestind = 0; irestind < 24; irestind++){ 
            $('.skorperrow_'+(irestind+1)).val(totalskor[irestind]); 
            $('#txtskorperrow_'+(irestind+1)).html(totalskor[irestind]);
          }

          var waktuperrow = data[0].waktu.split(";");
          for (irestind = 0; irestind < 24; irestind++){ 
            $('#waktuperrow_'+(irestind+1)).val(waktuperrow[irestind]); 
            $('#txtwaktuperrow_'+(irestind+1)).html(waktuperrow[irestind]);
          }

          var namaperrow = data[0].namapembuat.split(";");
          for (irestind = 0; irestind < 24; irestind++){ 
            $('#namaperrow_'+(irestind+1)).val(namaperrow[irestind]); 
            $('#txtnamaperrow_'+(irestind+1)).html(namaperrow[irestind]);
          }
      },
              error: function(xhr, ajaxOptions, thrownError) {
                show_my_error_message2(xhr.responseText,xhr.status,xhr.statusText);
              }
    });
}
/////////////////




/*$(document).ready(function(){ 
  
  var idreg_set   = $('#id_reg').val();
  listmst(idreg_set);
});


$("#id_frmkepe_kpmicu").click(function(){
  var idreg_set = $('#id_reg').val();
  listmst(idreg_set);
});

function listmst(idreg_set){
  var pj = '<?php echo $creator; ?>';
    $.ajax({
      url : baseUrl+"formkeperawatan/frm_kpm_nicu/mst",
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
            +"<td colspan='2'><select class='form-control selytkpm' id='12jam_1a[]' name='12jam_1a[]' attr-data-idmst='"+data[irestind].rs_1[irestind2].id+"'><option value='0' "+nilai_0_set+" default>Pilih</option><option value='1' "+nilai_1_set+">Ya</option><option value='2' "+nilai_2_set+">Tidak</option></select></td>"
            +"</tr>";
          }
          line_1_det +="</td></tr>";
         }
         $('#tbriwakpmnicu').html(line_1_det);

         $('.12jam_1a').on('input blur paste', function(){
          $(this).val($(this).val().replace(/\D/g, ''));
         });


      }
    });
    
}

//Simpen
$(".send_news_1_akpm").click(function(e){
          e.preventDefault();
          var idreg_set             = $('#id_reg').val();
          //set row 1
          var jam12_1       = new Array();
          var jam12_1_idmst = new Array();
          $('.selytkpm').each(function(){ 
            jam12_1.push($(this).val());
            jam12_1_idmst.push($(this).attr("attr-data-idmst"));
          });

          var jam12_1_set         = jam12_1; 
          var jam12_1_idmst_set   = jam12_1_idmst; 


          $.ajax({
            url : baseUrl+"formkeperawatan/frm_kpm_nicu/save_news",
            method : "POST",
            data : { idreg_set:idreg_set,jam12_1_set:jam12_1_set,jam12_1_idmst_set:jam12_1_idmst_set},
            //async : false,
            dataType : 'json',
            success: function(data){
              //$('select').prop('selectedIndex', 0);
              Swal.fire('Berhasil!', 'Formulir Kriteria Pasien Keluar NICU', 'success');
            }
          });
          listmst(idreg_set);
          return false;
        
});
//End Simpen

$("#report_a").click(function(){
      var idreg_set     = $('#id_reg').val();
      $.ajax({
            url : baseUrl+"formkeperawatan/frm_kpm_nicu/mst_rep",
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

              $('.tbriwa3kpmnicu').html(line_1_det2+line_1_det);
            
            }
          });

});*/

</script>
