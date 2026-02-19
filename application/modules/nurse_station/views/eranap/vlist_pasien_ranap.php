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
            <th scope="col">No Kamar</th>
            <th scope="col">Kamar</th>
            <th scope="col">Bed</th>
            <th scope="col">Kelas</th>
            <th scope="col">Data Pasien</th>
            <th scope="col">Diagnosa</th>
            <th scope="col">Dokter</th>
            <th scope="col">Asuransi</th>
            <th scope="col">Alamat</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          foreach ($rs as $val) {
            $id_reg =  $val['id_reg'];
            $id_pasien =  $val['id_pasien'];

          ?>

          <tr class="table-row" data-href="<?php echo site_url("nurse_station/eranap/main_content/" . "$id_reg") ?>">
            <td>
              <?php echo $i; ?>
            </td>
            <td> <?php echo $val['id_kamar']; ?> </td>
            <td> <?php echo $val['description']; ?> </td>
            <td> <?php echo $val['id_bed']; ?> </td>
            <td> <?php echo $val['kelas']; ?> </td>
            <td>
              <b><?php echo $val['name']; ?> </b> <br>
              <i><?php echo $val['id_reg']; ?> / <?php echo $val['id_pasien']; ?></i>
            </td>
            <td> <?php echo $val['diagnosa']; ?> </td>
            <td> <?php echo $val['dokter']; ?> </td>
            <td> <?php echo $val['company']; ?> </td>
            <td> <?php echo $val['address']; ?> </td>
            <td nowrap>
              <?php
                echo anchor(site_url("nurse_station/eranap/main_content/"."$id_reg"."/"."$id_pasien"), "<img src=" . base_url('assets/img/tulis.png') . " style=\"max-height:20px;\">") . " &nbsp; ";
                ?>
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
$(document).ready(function($) {
  $(".table-row").click(function() {
    window.document.location = $(this).data("href");
  });
});

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
