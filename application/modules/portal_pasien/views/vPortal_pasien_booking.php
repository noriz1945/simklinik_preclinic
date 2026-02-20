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
      <h5>Booking</h5>
      <div class="d-flex align-items-center" style="gap:8px;">
        <a class="btn btn-outline-secondary" href="<?php echo base_url('portal_pasien/home'); ?>">Beranda</a>
        <a class="btn btn-outline-secondary" href="<?php echo base_url('portal_pasien/riwayat'); ?>">Riwayat</a>
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

    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalBooking">Buat booking baru</button>

    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead class="bg-light">
          <tr><th>Tanggal</th><th>Jam</th><th>Spesialisasi</th><th>Dokter</th><th>Jenis Perawatan</th><th>Status Booking</th></tr>
        </thead>
        <tbody>
          <?php if(!empty($bookings)): foreach($bookings as $b): ?>
          <tr>
            <td><?php echo html_escape($b['tanggal']); ?></td>
            <td><?php echo html_escape($b['slot_time']); ?></td>
            <td><?php echo html_escape($b['unit']); ?></td>
            <td><?php echo html_escape($b['nama_dokter']); ?></td>
            <td><?php echo html_escape($b['jenis_perawatan'] ?: '-'); ?></td>
            <td>
              <?php if(!empty($b['cuti_ket'])): ?>
                <div style="background:#ffe5e5;border:1px solid #8B0000;color:#8B0000;border-radius:4px;padding:6px;">
                  <strong>Tidak Praktek:</strong> <?php echo html_escape($b['cuti_ket']); ?>
                </div>
                <div class="mt-2 d-flex" style="gap:8px;">
                  <button class="btn btn-sm btn-outline-primary btn-reschedule" data-toggle="modal" data-target="#modalReschedule"
                          data-id="<?php echo $b['id_book']; ?>"
                          data-tanggal="<?php echo html_escape($b['tanggal']); ?>"
                          data-jam="<?php echo html_escape($b['slot_time']); ?>"
                          data-dokter="<?php echo html_escape($b['id_dokter']); ?>"
                          data-dokter-nama="<?php echo html_escape($b['nama_dokter']); ?>"
                          data-unit="<?php echo html_escape($b['unit']); ?>">
                    Ubah tanggal booking
                  </button>
                  <button class="btn btn-sm btn-outline-danger btn-cancel-book" data-toggle="modal" data-target="#modalCancel"
                          data-id="<?php echo $b['id_book']; ?>"
                          data-info="<?php echo html_escape($b['tanggal'].' '.$b['nama_dokter'].' '.$b['slot_time']); ?>">
                    Batal booking
                  </button>
                </div>
              <?php else: ?>
                <span class="text-success">Available</span>
              <?php endif; ?>
            </td>
          </tr>
          <?php endforeach; else: ?>
          <tr><td colspan="6" class="text-center">Belum ada booking.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
  <style>
    /* Samakan ukuran tombol slot (tersedia maupun sudah terisi) */
    #slotWrap .slot-btn { min-width: 64px; }
  </style>

  <!-- Modal Booking -->
  <div class="modal fade" id="modalBooking" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header"><h5 class="modal-title">Booking Baru</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button></div>
        <div class="modal-body">
          <form id="fBook">
            <div class="form-group">
              <label>Tanggal</label>
              <input type="date" class="form-control" name="tanggal" id="tanggal" required 
                     min="<?php echo date('Y-m-d'); ?>" 
                     max="<?php echo date('Y-m-d', strtotime('+7 days')); ?>">
            </div>
            <div class="form-group">
              <label>Jenis Perawatan</label>
              <div>
                <label class="mr-3"><input type="radio" name="jenis_perawatan" value="Vaksin" checked> Vaksin</label>
                <label class="mr-3"><input type="radio" name="jenis_perawatan" value="Konsultasi"> Konsultasi</label>
              </div>
            </div>
            <div class="form-group">
              <label>Spesialisasi</label>
              <select class="form-control" name="id_unit" id="id_unit" required>
                <option value="">- pilih -</option>
                <?php foreach($units as $u): ?>
                  <option value="<?php echo $u['id_spes'];?>"><?php echo html_escape($u['name']);?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label>Dokter</label>
              <select class="form-control" name="id_dokter" id="id_dokter" required>
                <option value="">- pilih -</option>
                <?php foreach($dokters as $d): ?>
                  <option value="<?php echo $d['id_dokter'];?>"><?php echo html_escape($d['nama_dokter']);?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label>Pilih Slot</label>
              <div id="slotWrap" class="d-flex flex-wrap" style="gap:8px;">
                <em class="text-muted">Pilih tanggal, spesialisasi dan dokter terlebih dahulu</em>
              </div>
              <input type="hidden" name="slot_time" id="slot_time">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" id="btnSubmitBook">Simpan</button>
          <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
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
    const tanggal = document.getElementById('tanggal');
    const id_unit = document.getElementById('id_unit');
    const id_dokter = document.getElementById('id_dokter');
    const slotWrap = document.getElementById('slotWrap');
    const slotInput= document.getElementById('slot_time');

    async function loadSlots(){
      slotWrap.innerHTML = '<em>Memuat slot...</em>';
      const fd = new FormData();
      fd.append('tanggal', tanggal.value);
      fd.append('id_unit', id_unit.value);
      fd.append('id_dokter', id_dokter.value);
      const res = await fetch(baseUrl+'portal_pasien/get_slots_ajax', {method:'POST', body:fd});
      const js  = await res.json();
      if(!js.status){ slotWrap.innerHTML = '<span class="text-danger">'+(js.message||'Gagal memuat')+'</span>'; return; }

      // Jika dokter cuti, tampilkan keterangan cuti di area slot
      if(js.cuti && js.cuti.on){
        const ket = (js.cuti.keterangan||'');
        slotWrap.innerHTML = '<div class="w-100" role="alert" style="background-color:#ffe5e5;border:1px solid #8B0000;color:#8B0000;border-radius:4px;padding:10px;">'+
          '<strong>Dokter tidak praktek:</strong> '+ (ket||'Dokter tidak praktek.') + '</div>';
        return;
      }

      const all = js.all_slots || js.slots || [];
      const bookedSet = new Set(js.booked_slots || []);
      const lockedSet = new Set(js.locked_slots || []);
      if(all.length===0){ slotWrap.innerHTML = '<span class="text-muted">Tidak ada slot pada tanggal ini.</span>'; return; }

      slotWrap.innerHTML = '';
      all.forEach(s=>{
        const b = document.createElement('button');
        b.type='button';
        const isBooked = bookedSet.has(s);
        const isLocked = lockedSet.has(s);
        b.className = 'btn btn-sm slot-btn ' + ((isBooked||isLocked) ? 'btn-outline-secondary' : 'btn-outline-primary');
        b.textContent = s;
        if(isBooked || isLocked){
          b.disabled = true;
          b.title = isLocked ? 'Slot dikunci' : 'Slot sudah terisi';
        }else{
          b.addEventListener('click', ()=>{
            [...slotWrap.querySelectorAll('button')].forEach(x=>x.classList.remove('active'));
            b.classList.add('active'); slotInput.value = s;
          });
        }
        // keep previously chosen selection highlighted if still available
        if(!isBooked && slotInput.value === s){ b.classList.add('active'); }
        slotWrap.appendChild(b);
      });
    }

    // When unit changes, load doctors for that unit and reset slots
    id_unit.addEventListener('change', async ()=>{
      id_dokter.innerHTML = '<option value="">- pilih -</option>';
      slotWrap.innerHTML = '<em class="text-muted">Pilih tanggal, spesialisasi dan dokter terlebih dahulu</em>';
      slotInput.value = '';
      const unitVal = id_unit.value;
      if(!unitVal) return;
      try{
        const fd = new FormData(); fd.append('id_unit', unitVal);
        const res = await fetch(baseUrl+'portal_pasien/get_dokters_by_unit_ajax', {method:'POST', body:fd});
        const js  = await res.json();
        if(js.status){
          (js.dokters||[]).forEach(d=>{
            const opt = document.createElement('option');
            opt.value = d.id_dokter; opt.textContent = d.nama_dokter;
            id_dokter.appendChild(opt);
          });
        }
      }catch(e){ /* silent */ }
      if(tanggal.value && id_dokter.value){ loadSlots(); }
    });

    // When date or doctor changes, try to load slots if ready
    [tanggal,id_dokter].forEach(el=>{
      el.addEventListener('change', ()=>{
        if(tanggal.value && id_unit.value && id_dokter.value){
          loadSlots();
        }
      });
    });

    document.getElementById('btnSubmitBook').addEventListener('click', async ()=>{
      const jenisEl = document.querySelector('input[name="jenis_perawatan"]:checked');
      if(!(tanggal.value && jenisEl && id_unit.value && id_dokter.value && slotInput.value)){
        alert('Lengkapi data & pilih slot.'); return;
      }
      const fd = new FormData(document.getElementById('fBook'));
      const res = await fetch(baseUrl+'portal_pasien/create_booking_ajax', {method:'POST', body:fd});
			const js  = await res.json();
			alert(js.message||'OK');
			if(js.status){
				if(js.wa_link){ window.open(js.wa_link, '_blank'); }
				location.reload();
			}
			
    });

    // Profile dropdown actions
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

    // ====== Reschedule & Cancel integration ======
    async function loadRescheduleSlots(dokterId, tanggalBaru){
      const wrap = document.getElementById('rs_slots');
      const sel  = document.getElementById('rs_slot_time');
      if(!wrap) return;
      wrap.innerHTML = '<em>Memuat slot...</em>';
      const fd = new FormData();
      fd.append('tanggal', tanggalBaru);
      fd.append('id_unit', '');
      fd.append('id_dokter', dokterId);
      const res = await fetch(baseUrl+'portal_pasien/get_slots_ajax', {method:'POST', body:fd});
      const js  = await res.json();
      if(!js.status){ wrap.innerHTML = '<span class="text-danger">'+(js.message||'Gagal memuat')+'</span>'; return; }
      if(js.cuti && js.cuti.on){
        wrap.innerHTML = '<div class="w-100" role="alert" style="background-color:#ffe5e5;border:1px solid #8B0000;color:#8B0000;border-radius:4px;padding:10px;">'+
          '<strong>Dokter tidak praktek:</strong> '+ (js.cuti.keterangan||'Dokter tidak praktek.') + '</div>';
        return;
      }
      const all = js.all_slots || js.slots || [];
      const bookedSet = new Set(js.booked_slots || []);
      const lockedSet = new Set(js.locked_slots || []);
      if(all.length===0){ wrap.innerHTML = '<span class="text-muted">Tidak ada slot pada tanggal ini.</span>'; return; }
      wrap.innerHTML = '';
      if(sel) sel.value = '';
      all.forEach(s=>{
        const b = document.createElement('button'); b.type='button';
        const isBooked = bookedSet.has(s);
        const isLocked = lockedSet.has(s);
        b.className = 'btn btn-sm slot-btn ' + ((isBooked||isLocked) ? 'btn-outline-secondary' : 'btn-outline-primary');
        b.textContent = s;
        if(isBooked || isLocked){ b.disabled = true; b.title= isLocked ? 'Slot dikunci' : 'Slot sudah terisi'; }
        else{
          b.addEventListener('click', ()=>{
            [...wrap.querySelectorAll('button')].forEach(x=>x.classList.remove('active'));
            b.classList.add('active'); if(sel) sel.value = s;
          });
        }
        wrap.appendChild(b);
      });
    }

    if (window.jQuery && typeof $ !== 'undefined'){
      $('#modalReschedule').on('show.bs.modal', function (e) {
        const trg = e.relatedTarget; if(!trg) return;
        const id   = trg.getAttribute('data-id') || '';
        const tgl  = trg.getAttribute('data-tanggal') || '';
        const jam  = trg.getAttribute('data-jam') || '';
        const dktr = trg.getAttribute('data-dokter') || '';
        const dnm  = trg.getAttribute('data-dokter-nama') || '';
        const unit = trg.getAttribute('data-unit') || '';
        const nowBox = document.getElementById('rs_now');
        const dEl = document.getElementById('rs_id_dokter');
        const bEl = document.getElementById('rs_id_book');
        const tEl = document.getElementById('rs_tanggal');
        const sEl = document.getElementById('rs_slot_time');
        if(bEl) bEl.value = id; if(dEl) dEl.value = dktr; if(tEl) tEl.value = ''; if(sEl) sEl.value='';
        if(nowBox){
          nowBox.innerHTML = '<div><strong>Tanggal:</strong> '+ tgl +'</div>'+
            '<div><strong>Jam:</strong> '+ jam +'</div>'+
            '<div><strong>Spesialisasi:</strong> '+ unit +'</div>'+
            '<div><strong>Dokter:</strong> '+ dnm +'</div>';
        }
        const slotsBox = document.getElementById('rs_slots');
        if(slotsBox) slotsBox.innerHTML = '<em class="text-muted">Pilih tanggal</em>';
      });

      $('#modalCancel').on('show.bs.modal', function (e) {
        const trg = e.relatedTarget; if(!trg) return;
        const id  = trg.getAttribute('data-id') || '';
        const inf = trg.getAttribute('data-info') || '';
        const idEl = document.getElementById('cb_id_book');
        const infoEl = document.getElementById('cb_info');
        const ketEl = document.getElementById('cb_ket');
        if(idEl) idEl.value = id; if(infoEl) infoEl.textContent = inf; if(ketEl) ketEl.value = '';
      });
    }

    const rsTanggal = document.getElementById('rs_tanggal');
    if(rsTanggal){
      rsTanggal.addEventListener('change', ()=>{
        const dktr = document.getElementById('rs_id_dokter')?.value || '';
        if(dktr && rsTanggal.value){ loadRescheduleSlots(dktr, rsTanggal.value); }
      });
    }

    const btnSaveRes = document.getElementById('btnSaveReschedule');
    if(btnSaveRes){
      btnSaveRes.addEventListener('click', async ()=>{
        const id = document.getElementById('rs_id_book')?.value || '';
        const t  = document.getElementById('rs_tanggal')?.value || '';
        const s  = document.getElementById('rs_slot_time')?.value || '';
        if(!(id && t && s)){ alert('Lengkapi tanggal dan pilih slot.'); return; }
        const fd = new FormData(); fd.append('id_book', id); fd.append('tanggal', t); fd.append('slot_time', s);
        const res = await fetch(baseUrl+'portal_pasien/update_booking_date_ajax', {method:'POST', body:fd});
        const js  = await res.json(); alert(js.message||'OK');
        if(js.status){ $('#modalReschedule').modal('hide'); location.reload(); }
      });
    }

    const btnDoCancel = document.getElementById('btnDoCancel');
    if(btnDoCancel){
      btnDoCancel.addEventListener('click', async ()=>{
        const id = document.getElementById('cb_id_book')?.value || '';
        const ket= (document.getElementById('cb_ket')?.value || '').trim();
        if(!(id && ket)){ alert('Lengkapi keterangan pembatalan.'); return; }
        const fd = new FormData(); fd.append('id_book', id); fd.append('ket_batal', ket);
        const res = await fetch(baseUrl+'portal_pasien/cancel_booking_ajax', {method:'POST', body:fd});
        const js  = await res.json(); alert(js.message||'OK');
        if(js.status){ $('#modalCancel').modal('hide'); location.reload(); }
      });
    }
  })();
  </script>
  <script>
  // Fallback delegated bindings to ensure cancel works even if earlier scripts didn’t bind
  (function(){
    const baseUrl = "<?php echo base_url(); ?>";
    // Capture last clicked cancel button as fallback source of id/info
    let lastCancel = {id:'', info:''};
    $(document).on('click', '.btn-cancel-book', function(){
      lastCancel.id = this.getAttribute('data-id') || '';
      lastCancel.info = this.getAttribute('data-info') || '';
      const idEl = document.getElementById('cb_id_book');
      const infoEl = document.getElementById('cb_info');
      if(idEl) idEl.value = lastCancel.id;
      if(infoEl) infoEl.textContent = lastCancel.info;
    });
    // When cancel modal is shown, populate fields
    $(document).on('show.bs.modal', '#modalCancel', function(e){
      const trg = e.relatedTarget || null; if(!trg) return;
      const id  = trg.getAttribute('data-id') || '';
      const inf = trg.getAttribute('data-info') || '';
      document.getElementById('cb_id_book').value = id;
      document.getElementById('cb_info').textContent = inf;
      document.getElementById('cb_ket').value = '';
      // persist id on the modal element for reliable retrieval
      $(this).data('id_book', id);
    });

    // Handle cancel button via delegated click
    $(document).on('click', '#btnDoCancel', async function(){
      const modal = $('#modalCancel');
      let id  = (modal.data('id_book') || document.getElementById('cb_id_book')?.value || '');
      const ket = (document.getElementById('cb_ket')?.value||'').trim();
      if(!id && lastCancel.id){ id = lastCancel.id; document.getElementById('cb_id_book').value = id; }
      // Ensure numeric
      id = String(id).trim();
      if(!(id && ket)){
        alert('Lengkapi keterangan pembatalan.');
        document.getElementById('cb_ket')?.focus();
        return;
      }
      const fd = new FormData(); fd.append('id_book', id); fd.append('ket_batal', ket);
      try{
        const res = await fetch(baseUrl+'portal_pasien/cancel_booking_ajax', {method:'POST', body:fd});
        const js  = await res.json(); alert(js.message||'OK');
        if(js.status){ $('#modalCancel').modal('hide'); location.reload(); }
      }catch(err){ alert('Gagal membatalkan.'); }
    });
  })();
  </script>
  <body></html>
  <!-- Modal Reschedule -->
  <div class="modal fade" id="modalReschedule" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header"><h5 class="modal-title">Ubah Tanggal Booking</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button></div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="border p-3 h-100">
                <h6>Booking Saat Ini</h6>
                <div id="rs_now"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="border p-3 h-100">
                <h6>Pilih Tanggal Baru</h6>
                <input type="hidden" id="rs_id_book">
                <input type="hidden" id="rs_id_dokter">
                <div class="form-group">
                  <label>Tanggal</label>
                  <input type="date" class="form-control" id="rs_tanggal"
                         min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+7 days')); ?>">
                </div>
                <div class="form-group">
                  <label>Pilih Slot</label>
                  <div id="rs_slots" class="d-flex flex-wrap" style="gap:8px;"><em class="text-muted">Pilih tanggal</em></div>
                  <input type="hidden" id="rs_slot_time">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" id="btnSaveReschedule">Simpan</button>
          <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Modal Cancel -->
  <div class="modal fade" id="modalCancel" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header"><h5 class="modal-title">Batal Booking</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button></div>
        <div class="modal-body">
          <input type="hidden" id="cb_id_book">
          <div class="form-group">
            <label>Booking</label>
            <div id="cb_info" class="border p-2 bg-light"></div>
          </div>
          <div class="form-group">
            <label>Keterangan batal</label>
            <textarea class="form-control" id="cb_ket" rows="3" placeholder="Tuliskan alasan pembatalan" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger" id="btnDoCancel">Batalkan</button>
          <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    // Ensure baseUrl in this script scope
    const baseUrl = "<?php echo base_url(); ?>";
    // Helpers for reschedule modal
    async function loadRescheduleSlots(dokterId, tanggalBaru){
      const wrap = document.getElementById('rs_slots');
      const sel  = document.getElementById('rs_slot_time');
      wrap.innerHTML = '<em>Memuat slot...</em>';
      const fd = new FormData(); fd.append('tanggal', tanggalBaru); fd.append('id_unit', ''); fd.append('id_dokter', dokterId);
      const res = await fetch(baseUrl+'portal_pasien/get_slots_ajax', {method:'POST', body:fd});
      const js  = await res.json();
      if(!js.status){ wrap.innerHTML = '<span class="text-danger">'+(js.message||'Gagal memuat')+'</span>'; return; }
      if(js.cuti && js.cuti.on){
        wrap.innerHTML = '<div class="w-100" role="alert" style="background-color:#ffe5e5;border:1px solid #8B0000;color:#8B0000;border-radius:4px;padding:10px;">'+
          '<strong>Dokter tidak praktek:</strong> '+ (js.cuti.keterangan||'Dokter tidak praktek.') + '</div>';
        return;
      }
      const all = js.all_slots || js.slots || [];
      const bookedSet = new Set(js.booked_slots || []);
      if(all.length===0){ wrap.innerHTML = '<span class="text-muted">Tidak ada slot pada tanggal ini.</span>'; return; }
      wrap.innerHTML = '';
      sel.value = '';
      all.forEach(s=>{
        const b = document.createElement('button'); b.type='button';
        const isBooked = bookedSet.has(s);
        b.className = 'btn btn-sm slot-btn ' + (isBooked ? 'btn-outline-secondary' : 'btn-outline-primary');
        b.textContent = s;
        if(isBooked){ b.disabled = true; b.title='Slot sudah terisi'; }
        else{
          b.addEventListener('click', ()=>{
            [...wrap.querySelectorAll('button')].forEach(x=>x.classList.remove('active'));
            b.classList.add('active'); sel.value = s;
          });
        }
        wrap.appendChild(b);
      });
    }

    // Use Bootstrap show event to populate modals
    if (window.jQuery) {
      $('#modalReschedule').on('show.bs.modal', function (e) {
        var trg = e.relatedTarget || null;
        if (!trg) return;
        var id   = trg.getAttribute('data-id');
        var tgl  = trg.getAttribute('data-tanggal');
        var jam  = trg.getAttribute('data-jam');
        var dktr = trg.getAttribute('data-dokter');
        var dnm  = trg.getAttribute('data-dokter-nama');
        var unit = trg.getAttribute('data-unit');
        document.getElementById('rs_id_book').value = id || '';
        document.getElementById('rs_id_dokter').value = dktr || '';
        document.getElementById('rs_tanggal').value = '';
        document.getElementById('rs_slot_time').value = '';
        document.getElementById('rs_now').innerHTML = '<div><strong>Tanggal:</strong> '+ (tgl||'') +'</div>'+
          '<div><strong>Jam:</strong> '+ (jam||'') +'</div>'+
          '<div><strong>Spesialisasi:</strong> '+ (unit||'') +'</div>'+
          '<div><strong>Dokter:</strong> '+ (dnm||'') +'</div>';
        document.getElementById('rs_slots').innerHTML = '<em class="text-muted">Pilih tanggal</em>';
      });

      $('#modalCancel').on('show.bs.modal', function (e) {
        var trg = e.relatedTarget || null;
        if (!trg) return;
        document.getElementById('cb_id_book').value = trg.getAttribute('data-id') || '';
        document.getElementById('cb_info').textContent = trg.getAttribute('data-info') || '';
        document.getElementById('cb_ket').value = '';
      });
    }
  </script>
  <script>
    // On reschedule date change, load slots
    const rsTanggal = document.getElementById('rs_tanggal');
    if(rsTanggal){
      rsTanggal.addEventListener('change', ()=>{
        const dktr = document.getElementById('rs_id_dokter').value;
        if(dktr && rsTanggal.value){ loadRescheduleSlots(dktr, rsTanggal.value); }
      });
    }

    // Save reschedule
    const btnSaveRes = document.getElementById('btnSaveReschedule');
    if(btnSaveRes){
      btnSaveRes.addEventListener('click', async ()=>{
        const id = document.getElementById('rs_id_book').value;
        const t  = document.getElementById('rs_tanggal').value;
        const s  = document.getElementById('rs_slot_time').value;
        if(!(id && t && s)){ alert('Lengkapi tanggal dan pilih slot.'); return; }
        const fd = new FormData(); fd.append('id_book', id); fd.append('tanggal', t); fd.append('slot_time', s);
        const res = await fetch(baseUrl+'portal_pasien/update_booking_date_ajax', {method:'POST', body:fd});
        const js  = await res.json(); alert(js.message||'OK');
        if(js.status){ $('#modalReschedule').modal('hide'); location.reload(); }
      });
    }
  </script>

    // (Delegated above)
  </script>
  <script>
    // Do cancel (ensure runs inside script block and enforce required)
    (function(){
      const btnDoCancel = document.getElementById('btnDoCancel');
      if(!btnDoCancel) return;
      btnDoCancel.addEventListener('click', async ()=>{
        const idEl = document.getElementById('cb_id_book');
        const ketEl= document.getElementById('cb_ket');
        const id   = idEl ? (idEl.value||'') : '';
        const ket  = ketEl ? (ketEl.value||'').trim() : '';
        if(!(id && ket)){
          alert('Lengkapi keterangan pembatalan.');
          if(ketEl) ketEl.focus();
          return;
        }
        try{
          const fd = new FormData(); fd.append('id_book', id); fd.append('ket_batal', ket);
          const res = await fetch(baseUrl+'portal_pasien/cancel_booking_ajax', {method:'POST', body:fd});
          const js  = await res.json(); alert(js.message||'OK');
          if(js.status){ $('#modalCancel').modal('hide'); location.reload(); }
        }catch(e){ alert('Gagal membatalkan.'); }
      });
    })();
