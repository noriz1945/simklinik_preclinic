<?php 

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=laporan_user_erm.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>


<div class="card-body">
  <div class="table-responsive">
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Pasien</th>
          <th scope="col">Regdate</th>
          <th scope="col">Poli</th>
          <th scope="col">Dokter</th>
          <th scope="col">Asuransi</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i=1;
        foreach($data_row as $k)
        {
					$id_pasien= $k['id_pasien'];
					$id_reg		= $k['id_reg']; 
					$regdate	= $k['trxdate'];
					$regdate	= date("d-m-Y", strtotime($regdate) );
					
					if($k['jml_soap'] >= 1 || $k['jml_asm'] >= 1)
						$status = '<span class="badge badge-success">E-RM Ready</span>';
					else
						$status = '<span class="badge badge-danger">Belum ERM</span>';
      ?>
        <tr class="table-row">
          <td>
            <?php echo $i; ?>
          </td>
          <td>
            <b><?php echo $k['name']; ?></b> <br>
            <i><?php echo $id_pasien; ?> / <?php echo $id_reg;   ?></i>
          </td>
          <td>
            <?php echo $regdate ?>
          </td>
          <td>
            <?php echo $k['unit']; ?>
          </td>
          <td>
            <?php echo $k['dokter']; ?>
          </td>
          <td>
            <?php echo $k['asuransi']; ?>
          </td>
          <td>
            <?php echo $status; ?>
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