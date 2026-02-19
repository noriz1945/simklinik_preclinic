<!doctype html>
<html>
  <head>
    <?php 
					$this->theme->head('theme_portal_pasien'); 
					#$this->theme->head('theme_default'); 
		?>
		<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>
    <style>
      .login-box { max-width:420px; margin:8vh auto; padding:24px; border-radius:16px; box-shadow:0 8px 24px rgba(0,0,0,.08); background:#e1edd7;}
      .login-box h4 { font-weight:700; }
			.pcoded-main-container {
				background: transparent;
			}
    </style>
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
                            <!-- THIS IS WHERE THE MAIN CONTENT SHOULD BE PLACE AT -->
    <div class="container">
      <div class="login-box text-center">
        <img src="<?php echo base_url('assets/img/logoklinik.png');?>" alt="LYND" style="max-height:64px;">
        <h4 class="mt-3">Selamat datang di Portal Pasien Lynd</h4>
        <form id="fLogin" class="text-left mt-4">
          <div class="form-group">
            <label>Portal Id</label>
            <!-- ganti input ke portal_id (format ddmmyyyy) -->
						<input type="text" class="form-control" name="portal_id" id="portal_id" value="<?php echo html_escape($prefill_hp ?? ''); ?>" placeholder="DDMMYYYY contoh: 01032020">
          </div>
          <div class="form-group">
            <label>PIN</label>
            <input type="password" class="form-control" name="pin" id="pin" maxlength="6" placeholder="6 digit" value="<?php echo html_escape($prefill_pin ?? ''); ?>">
          </div>
          <button type="submit" class="btn btn-primary btn-block">Masuk</button>
          <a href="<?php echo base_url('portal_pasien/daftar_pasien_baru'); ?>" class="btn btn-outline-success btn-block mt-2">Daftar Pasien Baru</a>
          <button type="button" id="btnShowQR" class="btn btn-outline-secondary btn-block mt-2">Tampilkan QR Login (opsional)</button>
          <div id="qrWrap" class="text-center mt-3" style="display:none;"></div>
        </form>
        <div id="msg" class="text-danger mt-3" style="min-height:24px;"></div>
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
	
	
	
	
	<?php #$this->theme->wrapper_close('theme_portal_pasien'); ?>
  <?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-js.php'); ?>
  <script>
  (function(){
    const baseUrl = "<?php echo base_url(); ?>";
		
    document.getElementById('btnShowQR').addEventListener('click', ()=>{
			const pid = (document.getElementById('portal_id').value||'').trim();
			if(!pid){ alert('Isi Portal Id dahulu.'); return; }
			const url = baseUrl + 'portal_pasien/index/' + encodeURIComponent(pid);
			const img = document.createElement('img');
			img.alt = 'QR Login';
			// QR generator publik:
			img.src = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' + encodeURIComponent(url);
			const wrap = document.getElementById('qrWrap');
			wrap.innerHTML = ''; wrap.appendChild(img);
			wrap.style.display = 'block';
		});

    document.getElementById('fLogin').addEventListener('submit', async function(e){
      e.preventDefault();
      const fd = new FormData(this);
      const res = await fetch(baseUrl + 'portal_pasien/do_login', { method:'POST', body: fd });
      const js  = await res.json();
      const msg = document.getElementById('msg');
      if(!js.status){ msg.textContent = js.message || 'Login gagal'; return; }
      // sukses
      window.location.href = baseUrl + 'portal_pasien/home';
    });
  })();


  </script>
  <body></html>
