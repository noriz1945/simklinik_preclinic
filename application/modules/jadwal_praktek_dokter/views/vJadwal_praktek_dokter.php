<!doctype html>
<html>
  <head>
    <?php $this->theme->head('theme_default'); ?>
    <?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/core/js/datetimepicker-master/jquery.datetimepicker.css'); ?>">
    <style>
      .matrix-table th, .matrix-table td { white-space: nowrap; vertical-align: middle; }
      .matrix-table .cell-btn { display:block; margin-top:4px; }
      .btn-cell-small { font-size: 10px; padding: 1px 6px; line-height: 1.2; }
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
                <div class="d-inline"><h5>Jadwal Praktek Dokter</h5><span>Kelola jadwal per hari</span></div>
              </div>
            </div></div></div>

            <div class="pcoded-inner-content">
              <div class="main-body">
                <div class="page-wrapper">
                  <div class="page-body">
                    <div class="row"><div class="col-sm-12"><div class="card">
                      <div class="card-block">
                        <div class="table-responsive">
                          <table class="table table-bordered table-hover matrix-table">
                            <thead class="bg-light">
                              <tr>
                                <th>Spesialisasi</th>
                                <th>Dokter</th>
                                <?php $days=[1=>'Senin',2=>'Selasa',3=>'Rabu',4=>'Kamis',5=>'Jumat',6=>'Sabtu',7=>'Minggu'];
                                  foreach($days as $dname) echo '<th>'.$dname.'</th>'; ?>
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
                                      <div class="text-muted small">Slots: <?php echo $slots; ?></div>
                                      <div class="mt-1" style="display:flex; gap:6px; flex-wrap:wrap;">
                                        <button class="btn btn-sm btn-outline-primary cell-btn" data-action="edit" data-dokter="<?php echo $d['id_dokter']; ?>" data-dow="<?php echo $dow; ?>">Edit</button>
                                        <button class="btn btn-sm btn-outline-danger cell-del btn-cell-small" data-dokter="<?php echo $d['id_dokter']; ?>" data-dow="<?php echo $dow; ?>">Hapus</button>
                                      </div>
                                    <?php else: ?>
                                      <em class="text-muted small">- belum ada -</em>
                                      <button class="btn btn-sm btn-outline-success cell-btn" data-action="add" data-dokter="<?php echo $d['id_dokter']; ?>" data-dow="<?php echo $dow; ?>">Tambah</button>
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
                      </div>
                    </div></div></div>
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
  <script src="<?php echo base_url('assets/core/js/datetimepicker-master/build/jquery.datetimepicker.full.min.js'); ?>"></script>

  <!-- Modal Add/Edit -->
  <div class="modal fade" id="modalSched" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Jadwal Dokter</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form id="fSched">
            <input type="hidden" id="s_id_dokter">
            <input type="hidden" id="s_id_dow">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Mulai</label>
                <input type="text" class="form-control" id="s_time_start" placeholder="HH:MM" required>
              </div>
              <div class="form-group col-md-4">
                <label>Selesai</label>
                <input type="text" class="form-control" id="s_time_end" placeholder="HH:MM" required>
              </div>
              <div class="form-group col-md-4">
                <label>Durasi (menit)</label>
                <input type="number" class="form-control" id="s_durasi" min="5" step="5" required>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Total Slot</label>
                <input type="number" class="form-control" id="s_total_slots" readonly>
              </div>
              <div class="form-group col-md-4">
                <label>Quota Vaksin</label>
                <input type="number" class="form-control" id="s_q_vaksin" min="0" step="1" placeholder="0">
              </div>
              <div class="form-group col-md-4">
                <label>Quota Konsultasi</label>
                <input type="number" class="form-control" id="s_q_konsul" min="0" step="1" placeholder="0">
              </div>
            </div>
            <div class="form-group">
              <button type="button" class="btn btn-outline-secondary" id="btnAutoQuota">Isi Quota Otomatis</button>
              <small class="text-muted ml-2">70% vaksin, 30% konsultasi</small>
            </div>

            <div class="form-group border-top pt-3">
              <label class="d-block mb-2">Slot dikunci (maks 3)</label>
              <div class="form-row align-items-center mb-2">
                <div class="col-md-3">
                  <input type="number" class="form-control" id="s_lock1_num" placeholder="Nomor slot" min="1">
                </div>
                <div class="col-md-3">
                  <input type="text" class="form-control" id="s_lock1_time" placeholder="Jam:Menit" readonly>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="s_lock1_chk">
                    <label class="form-check-label" for="s_lock1_chk">Kunci</label>
                  </div>
                </div>
              </div>
              <div class="form-row align-items-center mb-2">
                <div class="col-md-3">
                  <input type="number" class="form-control" id="s_lock2_num" placeholder="Nomor slot" min="1">
                </div>
                <div class="col-md-3">
                  <input type="text" class="form-control" id="s_lock2_time" placeholder="Jam:Menit" readonly>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="s_lock2_chk">
                    <label class="form-check-label" for="s_lock2_chk">Kunci</label>
                  </div>
                </div>
              </div>
              <div class="form-row align-items-center mb-2">
                <div class="col-md-3">
                  <input type="number" class="form-control" id="s_lock3_num" placeholder="Nomor slot" min="1">
                </div>
                <div class="col-md-3">
                  <input type="text" class="form-control" id="s_lock3_time" placeholder="Jam:Menit" readonly>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="s_lock3_chk">
                    <label class="form-check-label" for="s_lock3_chk">Kunci</label>
                  </div>
                </div>
              </div>
              <small class="text-muted">Isikan nomor slot yang ingin dikunci. Waktu dihitung otomatis dari jam mulai + (nomor-1)*durasi.</small>
            </div>
            <div id="s_error" class="text-danger small" style="display:none;"></div>
          </form>
        </div>
        <div class="modal-footer d-flex justify-content-between">
          <button class="btn btn-danger" id="btnDelete" style="display:none;">Hapus</button>
          <div>
            <button class="btn btn-primary" id="btnSave">Simpan</button>
            <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
  (function(){
    const baseUrl = "<?php echo base_url(); ?>";
    const modal = $('#modalSched');
    const f = {
      dokter: document.getElementById('s_id_dokter'),
      dow: document.getElementById('s_id_dow'),
      ts: document.getElementById('s_time_start'),
      te: document.getElementById('s_time_end'),
      dur: document.getElementById('s_durasi'),
      total: document.getElementById('s_total_slots'),
      qv: document.getElementById('s_q_vaksin'),
      qk: document.getElementById('s_q_konsul'),
      auto: document.getElementById('btnAutoQuota'),
      del: document.getElementById('btnDelete'),
      err: document.getElementById('s_error')
    };

    function pad2(n){ return (n<10? '0':'')+n; }
    function computeSlotTimeByNumber(num){
      const ts = f.ts.value ? f.ts.value+':00' : '';
      const dur = parseInt(f.dur.value||'0',10);
      if(!(ts && dur>0)) return '';
      const start = new Date('2000-01-01T'+ts);
      const n = parseInt(num||'0',10);
      if(!n || n<1) return '';
      const ms = (n-1) * dur * 60000;
      const t = new Date(start.getTime()+ms);
      return pad2(t.getHours())+':'+pad2(t.getMinutes());
    }

    // Initialize jQuery datetimepicker as time picker only (24h, 10-minute steps)
    if (window.jQuery && typeof jQuery.fn.datetimepicker === 'function') {
      try{
        jQuery.datetimepicker.setLocale('id');
      }catch(e){}
      jQuery('#s_time_start, #s_time_end').datetimepicker({
        datepicker: false,
        format: 'H:i',
        step: 10,
        validateOnBlur: true,
        // hitung ulang total slot segera setelah memilih waktu
        onSelectTime: function(){
          try { computeTotalSlots(); if (typeof clearError === 'function') clearError(); } catch(e){}
        }
      });
    }

    function computeTotalSlots(){
      const ts = f.ts.value ? f.ts.value+':00' : '';
      const te = f.te.value ? f.te.value+':00' : '';
      const dur = parseInt(f.dur.value||'0',10);
      if(!(ts && te && dur>0)) { f.total.value = ''; return 0; }
      const start = new Date('2000-01-01T'+ts);
      const end   = new Date('2000-01-01T'+te);
      if(end <= start){
        if(f.err){ f.err.textContent='Waktu selesai harus lebih besar dari waktu mulai.'; f.err.style.display=''; }
        [f.ts, f.te].forEach(el=> el && el.classList.add('is-invalid'));
        f.total.value='0';
        return 0;
      }
      const total = Math.floor((end - start) / (dur*60000));
      f.total.value = String(total);
      return total;
    }

    function updateLockTimes(){
      document.getElementById('s_lock1_time').value = computeSlotTimeByNumber(document.getElementById('s_lock1_num').value);
      document.getElementById('s_lock2_time').value = computeSlotTimeByNumber(document.getElementById('s_lock2_num').value);
      document.getElementById('s_lock3_time').value = computeSlotTimeByNumber(document.getElementById('s_lock3_num').value);
    }

    ['s_lock1_num','s_lock2_num','s_lock3_num'].forEach(id=>{
      const el = document.getElementById(id);
      if(el){ el.addEventListener('input', updateLockTimes); el.addEventListener('change', updateLockTimes); }
    });
    [f.ts, f.te, f.dur].forEach(el=>{ if(el){ el.addEventListener('change', updateLockTimes); el.addEventListener('input', updateLockTimes); } });

    function clearError(){
      if(f.err){ f.err.style.display='none'; f.err.textContent=''; }
      [f.qv, f.qk, f.total, f.ts, f.te].forEach(el=> el && el.classList.remove('is-invalid'));
    }

    [f.ts, f.te, f.dur].forEach(el=>{
      el.addEventListener('change', ()=>{ computeTotalSlots(); clearError(); });
      el.addEventListener('input', ()=>{ computeTotalSlots(); clearError(); });
    });
    [f.qv, f.qk].forEach(el=>{
      el.addEventListener('input', clearError);
      el.addEventListener('change', clearError);
    });

    f.auto.addEventListener('click', ()=>{
      const total = computeTotalSlots();
      const qv = Math.round(total * 0.70);
      const qk = Math.max(0, total - qv);
      f.qv.value = String(qv);
      f.qk.value = String(qk);
      clearError();
    });

    document.querySelectorAll('.cell-btn').forEach(btn=>{
      btn.addEventListener('click', async ()=>{
        const id_dokter = btn.getAttribute('data-dokter');
        const id_dow = btn.getAttribute('data-dow');
        f.dokter.value = id_dokter; f.dow.value = id_dow;
        f.ts.value=''; f.te.value=''; f.dur.value='';
        f.del.style.display = 'none';
        try{
          const fd = new FormData(); fd.append('id_dokter', id_dokter); fd.append('id_dow', id_dow);
          const res = await fetch(baseUrl+'jadwal_praktek_dokter/get_schedule_ajax', {method:'POST', body:fd});
          const js  = await res.json();
          if(js.status && js.data){
            f.ts.value = (js.data.time_start||'').slice(0,5);
            f.te.value = (js.data.time_end||'').slice(0,5);
            f.dur.value= js.data.durasi||'';
            // quotas
            f.qv.value = js.data.quota_vaksin!=null ? js.data.quota_vaksin : '';
            f.qk.value = js.data.quota_konsul!=null ? js.data.quota_konsul : '';
            // locked slots (prefill)
            const l1 = js.data.kunci_slot_1||'';
            const l2 = js.data.kunci_slot_2||'';
            const l3 = js.data.kunci_slot_3||'';
            document.getElementById('s_lock1_num').value = l1? String(l1):'';
            document.getElementById('s_lock2_num').value = l2? String(l2):'';
            document.getElementById('s_lock3_num').value = l3? String(l3):'';
            document.getElementById('s_lock1_chk').checked = !!l1;
            document.getElementById('s_lock2_chk').checked = !!l2;
            document.getElementById('s_lock3_chk').checked = !!l3;
            updateLockTimes();
            f.del.style.display = 'inline-block';
            computeTotalSlots();
          }
        }catch(e){}
        modal.modal('show');
      });
    });

    // Delete from list (per cell)
    document.querySelectorAll('.cell-del').forEach(btn=>{
      btn.addEventListener('click', async ()=>{
        const id_dokter = btn.getAttribute('data-dokter');
        const id_dow = btn.getAttribute('data-dow');
        if(!confirm('Hapus jadwal ini?')) return;
        const fd = new FormData(); fd.append('id_dokter', id_dokter); fd.append('id_dow', id_dow);
        const res = await fetch(baseUrl+'jadwal_praktek_dokter/delete_schedule_ajax', {method:'POST', body:fd});
        const js  = await res.json(); alert(js.message||'OK');
        if(js.status) location.reload();
      });
    });

    document.getElementById('btnSave').addEventListener('click', async ()=>{
      clearError();
      if(!(f.ts.value && f.te.value && f.dur.value)) { if(f.err){ f.err.textContent='Lengkapi waktu mulai, selesai, dan durasi.'; f.err.style.display=''; } return; }
      const fd = new FormData();
      fd.append('id_dokter', f.dokter.value);
      fd.append('id_dow', f.dow.value);
      fd.append('time_start', f.ts.value+':00');
      fd.append('time_end', f.te.value+':00');
      fd.append('durasi', f.dur.value);
      fd.append('quota_vaksin', f.qv.value||'0');
      fd.append('quota_konsul', f.qk.value||'0');
      // locked slots: only send if checked and valid number
      const total = computeTotalSlots();
      const l1 = document.getElementById('s_lock1_chk').checked ? parseInt(document.getElementById('s_lock1_num').value||'0',10) : 0;
      const l2 = document.getElementById('s_lock2_chk').checked ? parseInt(document.getElementById('s_lock2_num').value||'0',10) : 0;
      const l3 = document.getElementById('s_lock3_chk').checked ? parseInt(document.getElementById('s_lock3_num').value||'0',10) : 0;
      if(l1>0 && l1<=total) fd.append('kunci_slot_1', String(l1));
      if(l2>0 && l2<=total) fd.append('kunci_slot_2', String(l2));
      if(l3>0 && l3<=total) fd.append('kunci_slot_3', String(l3));
      // client validation: time order and quota sum equals total
      if(total<=0){ return; }
      const qv = parseInt(f.qv.value||'0',10); const qk = parseInt(f.qk.value||'0',10);
      if((qv+qk)!==total){
        if(f.err){ f.err.textContent = 'Jumlah quota harus sama dengan Total Slot ('+total+').'; f.err.style.display=''; }
        [f.qv, f.qk, f.total].forEach(el=> el && el.classList.add('is-invalid'));
        return;
      }
      const res = await fetch(baseUrl+'jadwal_praktek_dokter/save_schedule_ajax', {method:'POST', body:fd});
      const js  = await res.json();
      if(!js.status){
        if(f.err){ f.err.textContent = js.message||'Gagal menyimpan.'; f.err.style.display=''; }
        return;
      }
      location.reload();
    });

    document.getElementById('btnDelete').addEventListener('click', async ()=>{
      if(!confirm('Hapus jadwal ini?')) return;
      const fd = new FormData();
      fd.append('id_dokter', f.dokter.value);
      fd.append('id_dow', f.dow.value);
      const res = await fetch(baseUrl+'jadwal_praktek_dokter/delete_schedule_ajax', {method:'POST', body:fd});
      const js  = await res.json(); alert(js.message||'OK');
      if(js.status) location.reload();
    });
  })();
  </script>
  <body></html>
