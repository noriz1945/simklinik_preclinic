
	<h5>Detail Resep : </h5>
  <div class="table-responsive" style="max-height:160px; max-width:800px; border:#CCC thin solid;">
    <table class="table table-bordered table-hover table-striped table-responsive">
      <tbody>
        <tr>
          <th scope="col">Obat</th>
          <!--<th scope="col">Produk</th>-->
          <th scope="col">Jenis</th>
          <th scope="col">Jumlah</th>
          <th scope="col">Dosis</th>
          <th scope="col">Frekwensi</th>
          <th scope="col">Waktu</th>
          <th scope="col">Keterangan</th>
        </tr>
        <?php
				foreach($rs as $k => $v)
				{
        ?>
        <tr>
          <td><?php echo $v['name'] ?></td>
          <!--<td><?php #echo $v->produk'] ?></td>-->
          <td><?php echo $v['jenis_obat'] ?></td>
          <td><?php echo $v['qty'] ?></td>
          <td><?php echo $v['dosis'] ?></td>
          <td><?php echo $v['frekwensi'] ?></td>
          <td><?php echo $v['time_time'] ?>, <?php echo $v['time_name'] ?></td>
          <td><?php echo $v['note'] ?></td>
				</tr>
        <?php
				}
        ?>
      </tbody>
    </table>
  </div>
