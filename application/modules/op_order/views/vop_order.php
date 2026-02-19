<!doctype html>
<html>

<head>
  <?php $this->theme->head('theme_default'); ?>

  <style type="text/css">

  </style>
</head>

<div class="container-fluid">
  <div class="table-wrapper">

    <div class="table-title">
      <div class="row">
        <div class="col-sm-8 p-5">

          <button type="button" class="btn btn-info add-new fa fa-plus"
            onclick="add_order_op('<?php echo $id_reg; ?>')">
            ORDER OPERASI
          </button>
          <!--<button type="submit" class="btn btn-secondary add-new fa fa-print"
            onClick="javascript:void window.open('<?php echo base_url('soap_awal/soap_awal_print/'.$id_reg) ?>','1541221517736','width=1024,height=600,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;">
            PRINT</button>-->
        </div>
      </div>
    </div>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col" class="text-center">No</th>
          <th scope="col" class="text-center">Tanggal</th>
          <th scope="col" class="text-center">Noreg</th>
          <th scope="col" class="text-center">Dokter</th>
          <th scope="col" class="text-center">Lihat</th>
          <th scope="col" class="text-center">Hapus</th>
        </tr>
      </thead>
      <tbody>
        <?php
				$i=1;
				foreach($data_row as $k){
          $id_pend=$k['id_pendaftaran'];
          $id_pasien=$k['id_pasien']

			?>
        <tr>
          <td> <?php echo $i; ?></td>
          <td> <?php echo $k['rencana_operasi']; ?></td>
          <td> <?php echo $k['no_rekam_medis']; ?></td>
          <!--<td> xxx</td>-->
          <td> <?php echo $k['name'];  ?></td>
          <td>
          <?php echo anchor_popup(("op_order/op_order/view_formorderop/$id_pend"), "<label class='btn btn-info add-new fa fa-eye'> View</label>", '$attributes'); ?>
          </td>
          <td>        
          <a class="delbutton" id="<?php echo $id_pend ?>"  href="#" ><img src="<?php echo base_url('assets/img/delete.png'); ?>" alt="Delete"></a>

          <a class='btn btn-info' id='<?php echo $id_pendaftaran=$view_trx->idpend;   ?>' href="<?php echo base_url('op_order/edit_op_order/'.$id_reg."/".$id_pasien);?>"  <i class='fa fa-edit'> </i>EDIT OP</a>
          </td>
        </tr>
        <?php
							$i++;
							}
						?>
      </tbody>
    </table>

  </div>
</div>


<div class="modal animated bounceIn" id="modal_form_order_op" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Form Order Operasi</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body form_order_op">
        <form action="<?php echo base_url(). 'op_order/op_order/seve_order_op/'.$id_reg; ?>" method="post" id="form_order_op">

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label">Rencana Operasi :</label>
                <input type="text" name="awal" id="awal" class="form-control tanggal" placeholder="Tanggal Operasi" value="<?php echo $date; ?>">                
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label">Tindakan Operasi :</label>
                  <!-- <input id="obat" class="form-control"> -->
                  <input id="tindakan" class="form-control">                               
                  <input type="text" id="name" name="tindakan_op" class="form-control hide" >
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label">DIAGNOSA :</label>
                <textarea class="form-control input-focus area-scroll" id="diagnosa" name="diagnosa" rows="5"
                  placeholder="Diagnosa Pasien"></textarea>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label">SEWA ALAT :</label>
                <textarea class="form-control input-focus area-scroll" id="sewa_alat" name="sewa_alat" rows="5"
                  placeholder="Sewa Alat"></textarea>
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
</div>
</div>
</div>

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
    appendTo : "#modal_form_order_op",
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