<!doctype html>
<html>
<head>
      <?php $this->theme->head('theme_default'); ?>

    <style>
.ui-autocomplete-loading {
  background: white url("https://jqueryui.com/resources/demos/autocomplete/images/ui-anim_basic_16x16.gif") right center no-repeat;
}
.ui-autocomplete { height: 200px; overflow-y: scroll; overflow-x: hidden;}


.kotak_kecil {
  width: 50px;
  text-align: center;
}

.kotak_sedang {
  width: 100px;
}
</style>

</head>


<?php $this->theme->wrapper_open('theme_default', $breadcrumb); ?>
<!-- page content -->
<div class="right_col" role="main">
 <?php
        $i=1;
        foreach($data_row as $k){
          $diagnosa=$k['diagnosa'];
          $sewa_alat=$k['sewa_alat'];
          $tindakan=$k['tindakan'];

      ?>
              <?php
              $i++;
              }
            ?>
<div class="card">
  <div class="card-body">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <form action="<?php echo base_url(). 'op_order/op_order/seve_edit_order_op/'.$id_reg; ?>" method="post" id="form_order_op">


          <div class="row">
         
            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label">Rencana Operasi :</label> 
                <input type="text" name="awal" id="awal" class="form-control tanggal" placeholder="Tanggal Operasi" value="<?php echo $date; ?>">
                <input type="hidden" name="id_role" id="id_role" class="form-control" placeholder="Tanggal Operasi" value="<?php echo $id_role; ?>">
                 <input type="hidden" name="id_reg" id="id_reg" class="form-control" placeholder="Tanggal Operasi" value="<?php echo $id_reg; ?>">
                 
              </div>
            </div>

            <!-- <div class="col-md-12">
              <div class="form-group">
                <label class="control-label">Tindakan Operasi :</label>
                <#?php echo $list_tindakan; ?>                
              </div>
            </div> --> 

           <!-- <div class="form-group row">
              <label class="col-sm-4 col-form-label">Obat</label>
              <div class="col-sm-8">
                <div class="ui-widget">
                  <input id="obat" class="form-control">
                  <input type="text" id="id_act" name="id_act" class="hidden">
                </div>
              </div>
            </div> -->

            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label">Tindakan Operasi :</label>
                  <!-- <input id="obat" class="form-control"> -->
                  <input id="tindakan" class="form-control" value="<?php echo $tindakan; ?>">                               
                  <input type="text" id="name" name="tindakan_op" class="" >
              </div>
            </div>

            <!--
             <div class="col-md-12">
              <div class="form-group">
                <label class="control-label">Tindakan Operasi :</label>
                 <?php if ($mstTrx_edit) {
                  $no = 1;
                  foreach ($mstTrx_edit as $k => $row) {
                  $namapoli_array=$row->nama_poliklinik;
                  $namapoli_exp=explode("POLIKLINIK",$namapoli_array);
                  
                  ?>

                    <?php 
                    $sql="SELECT MT.id_act, MT.name
                          FROM mst_tindakan MT
                          LEFT JOIN mst_tindakan_grup MTG ON MTG.id_group=MT.id_group
                          LEFT JOIN mst_tindakan_subgrup MTS ON MTS.id_subgroup=MT.id_subgroup
                          WHERE MT.`aktif` = 1 AND UPPER(MTG.`name`) LIKE '%OPERASI%'
                          ORDER BY  MTG.`name`, MT.name";
                    $query= $this->dbhis->query($sql);
                    $rs   = $query->result_array();
                    ?>
                    <select tabindex="1" data-placeholder="Select here.." class="form-control"name="tindakan" id="tindakan">
                    <option value="">Pilih Tindakan</option>
                    <?php foreach($rs as $viewdrop){ ?>
                    <?php $ds1=$viewdrop['name']; $ds2=$row->tindakan;?>
                    <?php if($ds1==$ds2){$dss=$viewdrop['name']; $select="selected"; }else{$dss=$viewdrop['name']; $select=""; } ?>
                    <option value="<?php echo $viewdrop['name']?>" style="color:black;" <?php echo $select; ?>><?php echo $dss; ?></option>
                    <?php } ?>
                    </select>

                     <?php 
                  $no++;
                  }
                  }
                  ?>                
              </div>
            </div> 
            -->
                    
                 

            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label">DIAGNOSA :</label>
                <textarea class="form-control input-focus area-scroll" id="diagnosa" name="diagnosa" rows="5"
                  > <?php echo $diagnosa; ?> </textarea>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label">SEWA ALAT :</label>
                <textarea class="form-control input-focus area-scroll" id="sewa_alat" name="sewa_alat" rows="5"
                  placeholder="Sewa Alat"><?php echo $sewa_alat; ?></textarea>
                  <input type="text" name="id_prendaftaran_ai" id="id_prendaftaran_ai" class="form-control tanggals hide" value="<?php echo $date; ?>">
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label">Konsultasi Ke Poliklinik :</label>
                <?php 
                  for($j=0; $j<5; $j++)
                  {
                    echo $list_poliklinik; 
                    ?>
                <br>
                <?php 
                  }
                ?>
              </div>
            </div>

          </div>

          <div class="modal-footer">
            <div class="form-actions">
              <!--<button type="button" class="btn btn-success"
                onclick="javascript: save_order_op('<?php echo $id_reg; ?>');">
                <i class="fa fa-check"></i> Save</button>-->
                <button type="submit" class="btn btn-success">Simpan</button>
              <button type="button" class="btn btn-inverse" data-dismiss="modal">Cancel</button>
            </div>
          </div>
      </div>

    </div>
    </form>
                </div>
              </ul>


</div>
<div class="modal fade" id="staticModal" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="staticModalLabel">Konfirmasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <p>
               Apakah Anda yakin data yang dimasukkan sudah benar?
            </p>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">TIDAK</button>
            <button type="button" id="btn_save" class="btn btn-primary"  data-dismiss="modal">YA</button>
         </div>
      </div>
   </div>
</div>
<!-- End PAge Content -->
</div>
<!-- End Container fluid  -->
<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>

<script>
// Date picker only
$('.tanggal').datepicker({
  dateFormat: "yy-mm-dd",
  autoclose: true,
  language: 'id',
});

$(".tanggal").datepicker("setDate", new Date());

$(document).ready(function($) {
  $(".table-row").click(function() {
    window.document.location = $(this).data("href");
  });
});

function add_order_op(id_reg) {
  save_method = 'add';
  $('#form_order_op')[0].reset();
  $('#modal_form_order_op').modal('show');

}

$(".delbutton").click(function(){
 
 //Save the link in a variable called element
 var element = $(this);
 
 //Find the id of the link that was clicked
 var id_pend = element.attr("id");
 
 //Built a url to send
 var info = 'id=' + id_pend;
 if(confirm("Hapus data order Operasi ?"))
 {
 $.ajax({
 type: "POST",
 url : '<?php echo site_url('op_order/op_order/delete_asm'); ?>/'+id_pend,
 data: info,
 success: function(){
   alert("Hapus data berhasil !");
  location.reload();
 }
 });
 
 $(this).parents(".record").animate({ opacity: "hide" }, "slow");
 
 }

 return false;
 
 });

$(function() {
  $("#tindakan").autocomplete({
    source: "<?php echo base_url('op_order/inner_get_data_autocomplet_tindakan'); ?>",
    minLength: 3,
    select: function(event, ui) {
      //$("#jenis_obat").val(ui.item.jenis_obat);
      $("#id_act").val(ui.item.id_act);
      $("#name").val(ui.item.name);
    }
  });
});

$('#form_order_op').submit(function(e) {
  if ($('#name').val().trim() == '') {
    e.preventDefault();
    alert('tindakan operasi belum dipilih');
  }
});
</script>

</body>

</html>