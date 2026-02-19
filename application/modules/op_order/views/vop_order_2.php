<!doctype html>
<html>

<head>
  <?php $this->theme->head('theme_default'); ?>

  <style type="text/css">

  </style>
</head>

<div class="container-fluid">
  <div class="table-wrapper">

    <table class="table table-bordered">
      <tbody>
      <?php $no=1; foreach($row_view as $viewdata_pasien) ?>
        <tr>
          <td>ID Pasien</td>
          <td>Nama Pasien</td>
          <td>Asal Pasien</td>
          <td>Asuransi pasien</td>
        </tr>
        <tr>
          <td> <?php echo $viewdata_pasien->id_pasien; ?></td>
          <td> <?php echo $viewdata_pasien->nama_pasien; ?></td>
          <td> <?php echo $viewdata_pasien->asal_pasien; ?></td>
          <td> <?php echo $viewdata_pasien->asuransi_pasien; ?></td>
        </tr>

        
      </tbody>
    </table>
    <table class="table table-bordered">
      POLIKLINIK
      <tbody>
    <?php foreach($row_konsultasi as $viewdata){ ?>
        <tr>
          <td>Poliklinik <?php echo $no++ ?></td>
          <td><?php echo $viewdata->nama_poliklinik; ?></td>
        </tr>
        <?php } ?>
        </tbody>
        </table>
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
</script>

</body>

</html>