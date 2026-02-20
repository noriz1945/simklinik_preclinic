<!doctype html>
<html>

<head>
  <?php $this->theme->head('theme_default'); ?>

  <style type="text/css">
  /* Important part */
  .modal-dialog {
    /* width: 1024px; */
    overflow-y: initial !important
  }

  .modal-body {
    height: 700px;
    overflow-y: auto;
  }
  </style>

</head>

<?php $this->theme->wrapper_open('theme_default'); ?>

<div class="container-fluid">
  <!-- Start Page Content -->
  <div class="row">
    <div class="col-sm-8">
      <div class="form-group">
        <form name="form1" method="post" action="<?php echo base_url('nurse_station/pasien_poli_list') ?>"
          class="form-inline">
          <div class="form-group">
            <input type="text" name="awal" id="awal" class="form-control tanggal" value="<?php echo $date; ?>" readonly>
          </div>&nbsp&nbsp&nbsp
          <div class="form-group">
            <?php echo $dokter_list; ?>
          </div>&nbsp&nbsp&nbsp
          <input class="btn btn-secondary" type="submit" name="button" value="Tampilkan">
        </form>
      </div>
    </div>

    <div class="col-sm-4">
      <div class="form-group">
        <form id="formUpdateShift">
          <select class="form-control combobox" name="id_shift" id="id_shift"
            onchange="update_shift(<?php echo $id_doctor; ?>);">
            <option value="1">Shift 1</option>
            <option value="2">Shift 2</option>
            <option value="3">Shift 3</option>
          </select>
        </form>
      </div>
    </div>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th scope="col" class=" text-center">No</th>
            <th scope="col" class=" text-center">No Reg</th>
            <th scope="col" class=" text-center">No RM</th>
            <th scope="col" class=" text-center">Regdate</th>
            <th scope="col" class=" text-center">Nama Pasien</th>
            <th scope="col" class=" text-center">Poli</th>
            <th scope="col" class=" text-center">No urut</th>
            <th scope="col" class=" text-center">Shift</th>
            <th scope="col" class=" text-center">Asuransi</th>
            <th scope="col" class=" text-center">Status</th>
            <th scope="col" class=" text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i=1;
          foreach($data_row as $k)
          {
            $id_pasien= $k['id_pasien'];
            $id_reg   = $k['id_reg'];
            $regdate	= $k['regdate'];
            $regdate	= date("d-m-Y", strtotime($regdate) );
            
            if($k['jml_stat_fisik'] >= 1)
            {
              $status = '<span class="badge badge-success">Done</span>';
              $add    = 'style="display: none;"';
              $update = '';
            }
            else
            {
              $status = '<span class="badge badge-danger">Waiting</span>';
              $add    = '';
              $update = 'style="display: none;"';
            }
        ?>
          <tr class="table-row">
            <td>
              <?php echo $i; ?>
            </td>
            <td>
              <?php echo $k['id_reg'];	 ?>
            </td>
            <td>
              <?php echo $id_pasien; ?>
            </td>
            <td>
              <?php echo $regdate ?>
            </td>
            <td>
              <?php echo $k['pasien']; ?>
            </td>
            <td>
              <?php echo $k['poli']; ?>
            </td>
            <td class="text-center">
              <?php echo $k['id_num']; ?>
            </td>
            <td class="text-center">
              <?php echo $k['id_shift']; ?>
            </td>
            <td>
              <?php echo $k['asuransi']; ?>
            </td>
            <td>
              <?php echo $status; ?>
            <td>
              <a href="#" onclick="javascript:add_fisik('<?php echo $k['id_reg']; ?>')" <?php echo $add; ?>><img
                  src="<?php echo base_url('assets/img/plus.png'); ?>" alt="View"></a>

              <a href="#" onclick="javascript:edit_fisik('<?php echo $k['id_fisik']; ?>')" <?php echo $update; ?>><img
                  src="<?php echo base_url('assets/img/tulis.png'); ?>" alt="Update"></a>
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
</div>



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

function add_fisik(id_reg) {
  $.get("<?php echo base_url('nurse_station/add_stat_fisik/') ?>" + id_reg)
    .done(function(data) {
      //alert("Data Loaded: " + data);

      $('#modal_form_fisik').html(data);
      $('#modal_fisik').modal('show');
      //$('#myModal').modal('hide')
    });
}

function edit_fisik(id_fisik) {
  $.get("<?php echo base_url('nurse_station/edit_stat_fisik/') ?>" + id_fisik)
    .done(function(data) {
      //alert("Data Loaded: " + data);

      $('#modal_form_fisik').html(data);
      $('#modal_fisik').modal('show');
      //$('#myModal').modal('hide')
    });
}

function update_shift(id_doctor) {
  var url;
  //alert(id_shift.value);
  url = '<?php echo site_url('soap/epoli/update_shift_act'); ?>/' + id_doctor;
  title = 'Shift Dokter Berhasil Dirubah';

  var data_submit = $('#formUpdateShift').serialize();
  $.ajax({
    type: 'POST',
    data: data_submit,
    dataType: 'JSON',
    url: url,
    success: function(data) {
      //console.log(data_submit);
      //console.log(data);
      Swal.fire({
        type: 'success',
        title: title,
        showConfirmButton: false,
        timer: 1000
      });

      window.setTimeout(function() {
        //location.reload();
      }, 1000);
    },
    error: function(jqXHR, textStatus, errorThrown) {
      //console.log(data);
      alert('Error Add / Update Data');
    }
  });
}
</script>

<div class="modal animated bounceIn" id="modal_fisik" role="dialog">
  <div class="modal-dialog modal-lg modal-lg-smart" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title">Form Rekam Medis Pasien Rawat Jalan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body form_fisik" id="modal_form_fisik">

      </div>

    </div>
  </div>
</div>

</body>

</html>