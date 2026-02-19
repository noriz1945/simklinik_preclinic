<!doctype html>
<html>
  <head>
    <?php $this->theme->head('theme_default'); ?>
    <?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>
  </head>
  <?php $this->theme->wrapper_open('theme_default','BreadCrumb'); ?>
  <div class="loader-bg"><div class="loader-bar"></div></div>
  <div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">
      <div class="pcoded-main-container"><div class="pcoded-wrapper"><div class="pcoded-content">
        <div class="page-header card"><div class="row align-items-end"><div class="col-lg-12">
          <div class="page-header-title"><i class="feather icon-list bg-c-red"></i>
            <div class="d-inline"><h5>List pasien batal booking</h5></div>
          </div>
        </div></div></div>

        <div class="pcoded-inner-content"><div class="main-body"><div class="page-wrapper"><div class="page-body"><div class="row"><div class="col-sm-12"><div class="card"><div class="card-block">
          <?php $this->load->view('booking/vBooking_nav'); ?>
          <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
              <thead class="bg-light">
                <tr>
                  <th>Tanggal</th>
                  <th>Jam</th>
                  <th>Pasien</th>
                  <th>Dokter</th>
                  <th>Jenis</th>
                  <th>Ket Batal</th>
                  <th>Cancel Date</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($rows)): foreach($rows as $r): ?>
                <tr>
                  <td><?php echo html_escape($r['tanggal']); ?></td>
                  <td><?php echo html_escape($r['jam_slot']); ?></td>
                  <td><?php echo html_escape(($r['id_pasien']??'').' - '.($r['nama_pasien']??'')); ?></td>
                  <td><?php echo html_escape($r['nama_dokter']??''); ?></td>
                  <td><?php echo html_escape($r['jenis_perawatan']??''); ?></td>
                  <td><?php echo html_escape($r['ket_batal']??''); ?></td>
                  <td><?php echo html_escape($r['cancel_date']??''); ?></td>
                </tr>
                <?php endforeach; else: ?>
                <tr><td colspan="7" class="text-center">Tidak ada data.</td></tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div></div></div></div></div></div></div>
      </div></div></div>
    </div>
  </div>
  <?php #$this->theme->wrapper_close('theme_default'); ?>
  </div></div></div>
  <?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-js.php'); ?>
  <body></html>
