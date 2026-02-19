<!doctype html>
<html>

<head>
  <?php $this->theme->head('theme_default'); ?>

  <style type="text/css">
  .modal-lg-smart {
    max-height: 700px;
  }

  .border-kotak {
    border-style: solid;
    border-width: 1px;
  }
  </style>
</head>

<div class="container-fluid">
  <div class="table-wrapper">

    <div class="table-title">
      <div class="row">
        <div class="col-sm-8 p-5">

          <button type="button" class="btn btn-secondary add-new fa fa-plus" onclick="">
            TAMBAH
          </button>
          <button type="submit" class="btn btn-secondary add-new fa fa-print" onClick="">
            PRINT
          </button>
        </div>
      </div>
    </div>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col" class="text-center">No</th>
          <th scope="col" class="text-center">Tanggal</th>
          <th scope="col" class="text-center">Noreg</th>
          <th scope="col" class="text-center">Poli</th>
          <th scope="col" class="text-center">Dokter</th>
          <th scope="col" class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td> xxxxxx</td>
          <td> xxxxxx</td>
          <td> xxxxxx</td>
          <td> xxxxxx</td>
          <td> xxxxxx</td>
          <td class="text-center">xxxxxx</td>
        </tr>
      </tbody>
    </table>

  </div>
</div>

<?php $this->theme->script('theme_default'); ?>

<!-- action here -->
<script>

</script>

</body>

</html>
