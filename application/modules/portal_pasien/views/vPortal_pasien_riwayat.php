<!doctype html>
<html>
  <head>
    <?php $this->theme->head('theme_portal_pasien'); ?>
		<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>
  </head>
  <?php $this->theme->wrapper_open('theme_portal_pasien','BreadCrumb'); ?>
	<div class="loader-bg"><div class="loader-bar"></div></div>
    <div id="pcoded" class="pcoded">
      <div class="pcoded-overlay-box"></div>
      <div class="pcoded-container navbar-wrapper">
        <div class="pcoded-main-container">
          <div class="pcoded-wrapper">
            <div class="pcoded-content">
              

              <div class="pcoded-inner-content">
                <div class="main-body">
                  <div class="page-wrapper">
                    <div class="page-body">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="card">
													
  <div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
      <h5>Riwayat Perawatan</h5>
      <div class="d-flex align-items-center" style="gap:8px;">
        <a class="btn btn-outline-secondary" href="<?php echo base_url('portal_pasien/home'); ?>">Beranda</a>
        <a class="btn btn-outline-secondary" href="<?php echo base_url('portal_pasien/booking'); ?>">Booking</a>
        <div class="dropdown">
          <button class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown">
            <i class="feather icon-user"></i> <?php $___nm = isset($user['nama']) ? (function_exists('mb_substr')? mb_substr($user['nama'],0,5,'UTF-8'): substr($user['nama'],0,5)) : ''; $___nm = rtrim($___nm); echo html_escape($___nm).' ..'; ?>
          </button>
          <div class="dropdown-menu dropdown-menu-right p-3" style="min-width:260px;">
            <div class="form-group mb-2">
              <label>Ganti PIN</label>
              <div class="input-group">
                <input type="text" class="form-control" id="new_pin" maxlength="6" placeholder="6 digit">
                <div class="input-group-append"><button class="btn btn-primary" id="btnGantiPin">Simpan</button></div>
              </div>
            </div>
            <button class="dropdown-item" id="btnResendPin">Kirim PIN ke WA</button>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-danger" href="<?php echo base_url('portal_pasien/logout'); ?>">Keluar</a>
          </div>
        </div>
      </div>
    </div>
    <hr>

    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead class="bg-light">
          <tr><th>Tanggal</th><th>Unit</th><th>Dokter</th><th>No. Reg</th></tr>
        </thead>
        <tbody>
          <?php if(!empty($riwayat)): foreach($riwayat as $r): ?>
          <tr>
            <td><?php echo date('d-m-Y H:i', strtotime($r['regdate'])); ?></td>
            <td><?php echo html_escape($r['unit']); ?></td>
            <td><?php echo html_escape($r['nama_dokter']); ?></td>
            <td><?php echo html_escape($r['id_reg']); ?></td>
          </tr>
          <?php endforeach; else: ?>
          <tr><td colspan="4" class="text-center">Belum ada riwayat perawatan.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
	
<!-- /MAIN CONTENT -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>  
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  <?php #$this->theme->wrapper_close('theme_default'); ?>
  </div></div></div></div>  
  <?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-js.php'); ?>
  <script>
  (function(){
    const baseUrl = "<?php echo base_url(); ?>";
    const btnGantiPin = document.getElementById('btnGantiPin');
    if(btnGantiPin){
      btnGantiPin.addEventListener('click', async ()=>{
        const pin = (document.getElementById('new_pin').value||'').trim();
        if(!/^\d{6}$/.test(pin)){ alert('PIN harus 6 digit angka'); return; }
        const fd = new FormData(); fd.append('pin', pin);
        const res = await fetch(baseUrl+'portal_pasien/ganti_pin_ajax', {method:'POST', body:fd});
        const js  = await res.json();
        alert(js.message||'OK');
      });
    }

    const btnResendPin = document.getElementById('btnResendPin');
    if(btnResendPin){
      btnResendPin.addEventListener('click', async ()=>{
        const res = await fetch(baseUrl+'portal_pasien/resend_pin_ajax', {method:'POST'});
        const js  = await res.json();
        if(!js.status){ alert(js.message||'Gagal'); return; }
        window.open(js.wa_link, '_blank');
      });
    }
  })();
  </script>
  <body></html>
