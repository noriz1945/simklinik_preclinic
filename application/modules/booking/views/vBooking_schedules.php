<!doctype html>
<html>
  <head>
    <?php $this->theme->head('theme_default'); ?>
    <?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php'); ?>
    <style>
      .matrix-table th, .matrix-table td { white-space: nowrap; vertical-align: middle; }
      .matrix-table .meta { font-size: 11px; color:#666; }
    </style>
  </head>
  <?php $this->theme->wrapper_open('theme_default','BreadCrumb'); ?>
  <div class="loader-bg"><div class="loader-bar"></div></div>
  <div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">
      <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
          <div class="pcoded-content">
            <div class="page-header card"><div class="row align-items-end"><div class="col-lg-8">
              <div class="page-header-title"><i class="feather icon-calendar bg-c-blue"></i>
                <div class="d-inline"><h5>Lihat Jadwal Praktek</h5><span>Matriks jadwal per hari</span></div>
              </div>
            </div></div></div>

            <div class="pcoded-inner-content"><div class="main-body"><div class="page-wrapper"><div class="page-body"><div class="row"><div class="col-sm-12"><div class="card"><div class="card-block">
              <?php $this->load->view('booking/vBooking_nav'); ?>
              <div class="table-responsive">
                <table class="table table-bordered table-hover matrix-table">
                  <thead class="bg-light">
                    <tr>
                      <th>Spesialisasi</th>
                      <th>Dokter</th>
                      <?php $days=[1=>'Senin',2=>'Selasa',3=>'Rabu',4=>'Kamis',5=>'Jumat',6=>'Sabtu',7=>'Minggu']; foreach($days as $dname) echo '<th>'.$dname.'</th>'; ?>
                    </tr>
                  </thead>
                  <tbody>
                  <?php if(!empty($dokters)):
                    foreach($dokters as $d): ?>
                    <tr>
                      <td><?php echo html_escape($d['spesialisasi']); ?></td>
                      <td><?php echo html_escape($d['nama_dokter']); ?></td>
                      <?php foreach($days as $dow=>$dn):
                        $row = $sched_map[$d['id_dokter']][$dow] ?? null;
                        $ts  = $row['time_start'] ?? '';
                        $te  = $row['time_end'] ?? '';
                        $dur = (int)($row['durasi'] ?? 0);
                        $slots = ($ts && $te && $dur>0) ? max(0, floor((strtotime('2000-01-01 '.$te)-strtotime('2000-01-01 '.$ts))/60/$dur)) : 0;
                      ?>
                        <td>
                          <?php if($row): ?>
                            <div><strong><?php echo substr($ts,0,5).' - '.substr($te,0,5); ?></strong></div>
                            <div class="meta">Durasi: <?php echo $dur; ?> menit</div>
                            <div class="meta">Total Slot: <?php echo $slots; ?></div>
                            <div class="meta">Quota Vaksin: <?php echo (int)($row['quota_vaksin']??0); ?></div>
                            <div class="meta">Quota Konsul: <?php echo (int)($row['quota_konsul']??0); ?></div>
                            <?php
                              $locks = [];
                              foreach(['kunci_slot_1','kunci_slot_2','kunci_slot_3'] as $k){ if(!empty($row[$k])) $locks[] = (int)$row[$k]; }
                              if($locks) echo '<div class="meta">Nomor Slot Dikunci: '.html_escape(implode(', ', $locks)).'</div>';
                            ?>
                          <?php else: ?>
                            <em class="text-muted small">-</em>
                          <?php endif; ?>
                        </td>
                      <?php endforeach; ?>
                    </tr>
                  <?php endforeach; else: ?>
                    <tr><td colspan="9" class="text-center">Tidak ada data dokter.</td></tr>
                  <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div></div></div></div></div></div></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php #$this->theme->wrapper_close('theme_default'); ?>
  </div></div></div>
  <?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-js.php'); ?>
  <body></html>
