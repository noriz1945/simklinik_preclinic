<?php if(empty($rows)): ?>
<div class="alert alert-info">Tidak ada booking untuk hari ini.</div>
<?php else: ?>

<!-- ============================
     FORM FILTER BOOKING
============================= -->
<form id="filterBooking" class="mb-3">

  <div class="form-row">

    <div class="col-md-2">
      <input type="text" name="id_pasien" class="form-control" placeholder="No RM"
             value="<?php echo isset($_GET['id_pasien']) ? $_GET['id_pasien'] : ''; ?>">
    </div>

    <div class="col-md-3">
      <input type="text" name="nama_pasien" class="form-control" placeholder="Nama Pasien"
             value="<?php echo isset($_GET['nama_pasien']) ? $_GET['nama_pasien'] : ''; ?>">
    </div>

    <!-- ======================
         DROPDOWN DOKTER
    ======================= -->
    <div class="col-md-3">
      <select name="nama_dokter" class="form-control">
        <option value="">-- Semua Dokter --</option>
        <?php foreach($dokter as $d): ?>
          <option value="<?= $d['name']; ?>"
            <?= (isset($_GET['nama_dokter']) && $_GET['nama_dokter']==$d['name']) ? 'selected' : '' ?>>
            <?= $d['name']; ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="col-md-2">
      <input type="date" name="tanggal" class="form-control"
             value="<?php echo isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d'); ?>">
    </div>

    <div class="col-md-2">
      <button type="submit" class="btn btn-primary btn-block">
         <i class="fa fa-search"></i> Filter
      </button>
    </div>

  </div>

</form>
<!-- ============================ -->

<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead class="bg-light">
      <tr>
        <th>No RM</th>
        <th>Pasien</th>
        <th>Tgl Lahir</th>
        <th>Dokter</th>
        <th>Tanggal</th>
        <th>Jam</th>
        <th>Penjamin</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>

    <?php foreach($rows as $r): ?>
      <tr>
        <td><?= html_escape($r['id_pasien']); ?></td>
        <td><?= html_escape($r['nama_pasien']); ?></td>
        <td>
          <?php
            $tgl = $r['birthdate'];
            $birth = new DateTime($tgl);
            $today = new DateTime();
            $umur = $today->diff($birth)->y;
            echo date('d-m-Y', strtotime($tgl)) . " ({$umur} th)";
          ?>
        </td>

        <td><?= html_escape($r['nama_dokter']); ?></td>

        <td>
          <?php
            $hari = [
              'Sunday'=>'minggu','Monday'=>'senin','Tuesday'=>'selasa',
              'Wednesday'=>'rabu','Thursday'=>'kamis','Friday'=>'jumat','Saturday'=>'sabtu'
            ];
            echo $hari[date('l', strtotime($r['tanggal']))] . ', ' .
                 date('d-m-Y', strtotime($r['tanggal']));
          ?>
        </td>

        <td><?= html_escape($r['jam_slot']); ?></td>

        <td><?= html_escape($r['asuransi'] ?: '-'); ?></td>

        <td>
          <?php if($r['sudah_checkin']): ?>
            <span class="text-success font-weight-bold">Sudah Check-In</span>
          <?php elseif($r['dokter_cuti']): ?>
            <?php $plink = base_url('portal_pasien/index/'.rawurlencode($r['portal_id']).'/'.rawurlencode($r['pin'])); ?>
            <a class="btn btn-warning btn-sm" href="<?= $plink; ?>" target="_blank">Booking Ulang</a>
          <?php else: ?>
            <button class="btn btn-primary btn-sm btn-checkin" data-idpasien="<?= $r['id_pasien']; ?>">Check-In</button>
          <?php endif; ?>
        </td>

      </tr>
    <?php endforeach; ?>

    </tbody>
  </table>
</div>

<script>
// Check-In
(function(){
  const tab = document.getElementById('tab_booking');
  if(!tab) return;

  tab.querySelectorAll('.btn-checkin').forEach(btn=>{
    btn.addEventListener('click', async ()=>{
      const id = btn.dataset.idpasien;
      const res = await fetch("<?= site_url('trx_reg/inner_pasien_lama_reg/'); ?>" + id);
      tab.innerHTML = await res.text();
    });
  });
})();

// Filter AJAX
$('#filterBooking').on('submit', function(e){
  e.preventDefault();
  $.get("<?= site_url('trx_reg/inner_booking_today'); ?>", $(this).serialize(), function(html){
      $('#tab_booking').html(html);
  });
});
</script>

<?php endif; ?>
