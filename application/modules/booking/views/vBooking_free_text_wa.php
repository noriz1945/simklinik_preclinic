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
          <div class="page-header-title"><i class="feather icon-message-circle bg-c-green"></i>
            <div class="d-inline"><h5>Free Text WA</h5><span>Kirim pesan WhatsApp ke pasien</span></div>
          </div>
        </div></div></div>

        <div class="pcoded-inner-content"><div class="main-body"><div class="page-wrapper"><div class="page-body"><div class="row"><div class="col-sm-12"><div class="card"><div class="card-block">
          <?php $this->load->view('booking/vBooking_nav'); ?>
          <div class="form-group">
            <label>Pesan</label>
            <textarea class="form-control" id="wa_text" rows="5" placeholder="Ketik pesan..."></textarea>
          </div>
          <div class="form-group">
            <label>Pasien</label>
            <div class="input-group">
              <input type="text" class="form-control" id="wa_pasien_label" placeholder="Cari pasien..." readonly>
              <div class="input-group-append"><button class="btn btn-outline-secondary" id="wa_btn_cari" type="button">Cari</button></div>
            </div>
            <input type="hidden" id="wa_id_pasien">
          </div>
          <div>
            <button class="btn btn-success" id="wa_btn_send">Kirim via WhatsApp</button>
          </div>

          <!-- Modal Cari Pasien (reuse structure) -->
          <div class="modal fade" id="wa_modalCari" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header"><h5 class="modal-title">Cari Pasien</h5>
                  <button type="button" class="close" data-dismiss="modal">&times;</button></div>
                <div class="modal-body">
                  <div class="form-inline mb-2">
                    <input type="text" class="form-control mr-2" id="wa_s_q" placeholder="RM / Nama / HP" style="min-width:240px;">
                    <button class="btn btn-primary" id="wa_s_btn">Cari</button>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-sm table-hover">
                      <thead class="bg-light"><tr><th>RM</th><th>Nama</th><th>HP</th><th>Aksi</th></tr></thead>
                      <tbody id="wa_s_body"></tbody>
                    </table>
                  </div>
                </div>
                <div class="modal-footer"><button class="btn btn-secondary" data-dismiss="modal">Tutup</button></div>
              </div>
            </div>
          </div>

        </div></div></div></div></div></div></div>
      </div></div></div>
    </div>
  </div>
  <?php #$this->theme->wrapper_close('theme_default'); ?>
  </div></div></div>

  <?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-js.php'); ?>
  <script>
  (function(){
    const baseUrl = "<?php echo base_url(); ?>";
    document.getElementById('wa_btn_cari').addEventListener('click', ()=>{ $('#wa_modalCari').modal('show'); });
    // Trigger search on Enter as well as button click
    document.getElementById('wa_s_q').addEventListener('keydown', (e)=>{
      if(e.key==='Enter'){ e.preventDefault(); document.getElementById('wa_s_btn').click(); }
    });
    document.getElementById('wa_s_btn').addEventListener('click', async ()=>{
      const q = document.getElementById('wa_s_q').value.trim();
      const fd = new FormData(); fd.append('q', q);
      const res = await fetch(baseUrl+'booking/search_pasien_ajax', {method:'POST', body:fd});
      const js  = await res.json();
      const tb = document.getElementById('wa_s_body'); tb.innerHTML='';
      (js.items||[]).forEach(it=>{
        const tr = document.createElement('tr');
        tr.innerHTML = '<td>'+it.no_rm+'</td><td>'+it.name+'</td><td>'+ (it.hp||'') +'</td>'+
                       '<td><button type="button" class="btn btn-sm btn-outline-primary">Pilih</button></td>';
        tr.querySelector('button').addEventListener('click', ()=>{
          document.getElementById('wa_id_pasien').value = it.id_pasien;
          const hp = it.hp ? String(it.hp) : '';
          document.getElementById('wa_pasien_label').value = it.no_rm+' - '+it.name+(hp?(' - '+hp):'');
          $('#wa_modalCari').modal('hide');
        });
        tb.appendChild(tr);
      });
    });
    document.getElementById('wa_btn_send').addEventListener('click', async ()=>{
      const id = document.getElementById('wa_id_pasien').value;
      const txt = document.getElementById('wa_text').value;
      if(!(id && txt)){ alert('Pilih pasien dan isi pesan.'); return; }
      // obtain HP
      const fd = new FormData(); fd.append('q', id);
      const res = await fetch(baseUrl+'booking/search_pasien_ajax', {method:'POST', body:fd});
      const js  = await res.json();
      const it  = (js.items||[]).find(x=>x.id_pasien===id);
      if(!it){ alert('Gagal mendapatkan nomor HP.'); return; }
      let hpRaw = String(it.hp||'');
      let hpClean = hpRaw.replace(/[^0-9+]/g, '');
      let hpE164;
      if (hpClean.startsWith('+62')) {
        hpE164 = hpClean;
      } else if (hpClean.startsWith('0')) {
        hpE164 = '+62' + hpClean.substring(1);
      } else if (hpClean.startsWith('62')) {
        hpE164 = '+' + hpClean;
      } else {
        hpE164 = '+62' + hpClean;
      }
      const link = 'https://web.whatsapp.com/send?phone='+encodeURIComponent(hpE164)+'&text='+encodeURIComponent(txt);
      window.open(link, '_blank');
    });
  })();
  </script>
  <body></html>
