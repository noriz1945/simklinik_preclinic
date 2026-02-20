<!doctype html>
<html>

<head>
  <?php $this->theme->head('theme_default'); ?>

  <style>
  .modal-lg-smart {
    max-height: 700px;
  }

  .border-kotak {
    border-style: solid;
    border-width: 1px;
  }
  </style>

</head>

<?php $this->theme->wrapper_open('theme_default', $breadcrumb); ?>

<div class="container-fluid">
  <!-- Start Page Content -->
  <div class="card-body">
    <div class="table-responsive">
      <table id="myTable" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Data Pasien</th>
            <th scope="col">Kamar</th>
            <th scope="col">Kelas</th>
            <th scope="col">Tgl Masuk</th>
            <th scope="col">Tgl Keluar</th>
            <th scope="col">Dokter</th>
            <th scope="col">Asuransi</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          foreach ($rs as $val) {
            $id_reg       =  $val['id_reg'];
            $icon_update  = base_url('assets/img/tulis.png');
            $link         = site_url("erm_ranap/main_content/" . "$id_reg");

            if (($id_role == 1) OR ($id_role == 2)) {
              $action = '<a href="' . $link . '"><img src="' . $icon_update . '" alt="Update"></a>';

            }else {
              $action = '';
            }

          ?>

          <tr class="table-row">
            <td>
              <?php echo $i; ?>
            </td>
            <td>
              <b><?php echo $val['name']; ?> </b> <br>
              <i><?php echo $val['id_reg']; ?> / <?php echo $val['id_pasien']; ?></i>
            </td>
            <td> <?php echo $val['kamar']; ?> </td>
            <td> <?php echo $val['kelas']; ?> </td>
            <td> <?php echo $val['tgl_masuk']; ?> </td>
            <td> <?php echo $val['tgl_keluar']; ?> </td>
            <td> <?php echo $val['dokter']; ?> </td>
            <td> <?php echo $val['asuransi']; ?> </td>
            <td>
              <span class="badge badge-danger"><b>RESUME MEDIS <br> BELUM DIISI</b></span>
            </td>
            <td>
               <?php echo $action; ?>
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
var radios = document.getElementsByTagName('input');
for(i=0; i<radios.length; i++ ) {
    radios[i].onclick = function(e) {
        if(e.ctrlKey) {
            this.checked = false;
        }
    }
}

</script>
<script src="<?php echo base_url('assets/'); ?>js/datatables/datatables-init.js"></script>
<script src="<?php echo base_url('assets/'); ?>js/datatables/datatables.min.js"></script>
</body>

</html>
