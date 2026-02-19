<!doctype html>
<html>
  <head>
    <?php $this->theme->head('theme_default'); ?>
    <?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>
    <style>
      .calendar th, .calendar td { width:14.28%; vertical-align:top; height:150px; }
      .calendar .date { font-weight:700; font-size: 1.2rem; line-height:1; }
      .calendar .cuti { font-size: 11px; color:#b30000; margin-top:4px; }
      .calendar .cuti-alert { font-size: 10px; color:#ffc107; margin-top:2px; white-space: normal; word-break: break-word; overflow-wrap: anywhere; }
      .calendar .btn-sm { font-size: 11px; padding: 1px 4px; }
      .top-controls { display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; }
      /* Make calendar header compact */
      .calendar thead th { padding: 2px 4px !important; line-height: 1; font-size: 11px; }
      .calendar thead tr { height: auto; }
      .calendar th { height: 20px; }
      .calendar td { height: 100px; }
    </style>
  </head>
  <?php $this->theme->wrapper_open('theme_default','BreadCrumb'); ?>
  <div class="loader-bg"><div class="loader-bar"></div></div>
  <div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">
      <div class="pcoded-main-container"><div class="pcoded-wrapper"><div class="pcoded-content">

      <div class="page-header card"><div class="row align-items-end"><div class="col-lg-12">
        <div class="page-header-title"><i class="feather icon-calendar bg-c-blue"></i>
          <div class="d-inline"><h5>Home Booking</h5><span>Kalender booking (Admin)</span></div>
        </div>
      </div></div></div>

      <div class="pcoded-inner-content"><div class="main-body"><div class="page-wrapper"><div class="page-body"><div class="row"><div class="col-sm-12"><div class="card"><div class="card-block">

        <?php $this->load->view('booking/vBooking_nav'); ?>

        <div class="top-controls mb-3">
          <div>
            <?php $prevM = $month-1; $prevY=$year; if($prevM<1){$prevM=12;$prevY--;} $nextM=$month+1; $nextY=$year; if($nextM>12){$nextM=1;$nextY++;} ?>
            <a class="btn btn-outline-secondary" href="<?php echo base_url('booking/index/'.$prevY.'/'.$prevM).($id_dokter?('?id_dokter='.rawurlencode($id_dokter)):''); ?>">&laquo; Prev</a>
            <span class="mx-2 font-weight-bold"><?php echo date('F Y', strtotime(sprintf('%04d-%02d-01',$year,$month))); ?></span>
            <a class="btn btn-outline-secondary" href="<?php echo base_url('booking/index/'.$nextY.'/'.$nextM).($id_dokter?('?id_dokter='.rawurlencode($id_dokter)):''); ?>">Next &raquo;</a>
          </div>
          <form method="get" action="<?php echo base_url('booking/index/'.$year.'/'.$month); ?>" class="form-inline">
            <label class="mr-2">Pilih dokter</label>
            <select class="form-control mr-2" name="id_dokter" onchange="this.form.submit()">
              <option value="">- semua / belum pilih -</option>
              <?php foreach(($dokters??[]) as $d): ?>
                <option value="<?php echo $d['id_dokter']; ?>" <?php echo ($id_dokter==$d['id_dokter'])?'selected':''; ?>><?php echo html_escape($d['nama_dokter']); ?></option>
              <?php endforeach; ?>
            </select>
            <noscript><button class="btn btn-primary">Terapkan</button></noscript>
          </form>
        </div>

        <div class="table-responsive">
                          <table class="table table-sm table-bordered calendar">
                            <thead class="bg-light">
              <tr><th>Senin</th><th>Selasa</th><th>Rabu</th><th>Kamis</th><th>Jumat</th><th>Sabtu</th><th>Minggu</th></tr>
            </thead>
            <tbody>
              <?php
                $today = date('Y-m-d');
                $maxDate = date('Y-m-d', strtotime('+7 days'));
                $day=1; $dow=(int)$start_dow; echo '<tr>';
                for($i=1;$i<$dow;$i++) echo '<td></td>';
                for(;$day<=$days;$day++){
                  $tgl = sprintf('%04d-%02d-%02d', $year, $month, $day);
                  echo '<td>';
                  echo '<div class="d-flex justify-content-between align-items-start"><span class="date">'.$day.'</span>';
                  echo '<div class="btn-group">';
                  $inRange = ($tgl >= $today && $tgl <= $maxDate);
                  $isCuti  = (!empty($id_dokter) && !empty($cuti_map[$tgl]));
                  if($inRange){
                    if($isCuti){
                      echo '<button class="btn btn-sm btn-outline-secondary" type="button" disabled title="Dokter cuti">Booking Baru</button>';
                    } else {
                      echo '<button class="btn btn-sm btn-outline-success" type="button" onclick="openNewBooking(\''.$tgl.'\')">Booking Baru</button>';
                    }
                  }
                  if(!empty($id_dokter)){
                    $cnt = isset($counts_map[$tgl]) ? (int)$counts_map[$tgl] : 0;
                    if($cnt>0){
                      $label = 'Lihat Pasien ('.$cnt.')';
                      echo '<button class="btn btn-sm btn-outline-primary ml-1" onclick="openList(\''.$tgl.'\')">'.html_escape($label).'</button>';
                    }
                  }
                  echo '</div></div>';
                  if(!empty($id_dokter) && !empty($cuti_map[$tgl])){
                    echo '<div class="cuti">Cuti: '.html_escape($cuti_map[$tgl]).'</div>';
                    $cnt = isset($counts_map[$tgl]) ? (int)$counts_map[$tgl] : 0;
                    if($cnt>0){
                      echo '<div class="cuti-alert">Mohon segera ubah tanggal booking pasien ke tanggal tersedia.</div>';
                    }
                  }
                  echo '</td>';
                  if((($dow + $day -1) % 7)==0) echo '</tr><tr>';
                }
                $tail = (7 - (($dow + $days -1) % 7)); if($tail<7){for($i=0;$i<$tail;$i++) echo '<td></td>';}
                echo '</tr>';
              ?>
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

  <!-- Modal List Pasien -->
  <div class="modal fade" id="modalList" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header"><h5 class="modal-title" id="listTitle">Pasien Booking</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button></div>
        <div class="modal-body">
          <div id="listWrap"><em>Pilih dokter terlebih dahulu.</em></div>
        </div>
        <div class="modal-footer"><button class="btn btn-secondary" data-dismiss="modal">Tutup</button></div>
      </div>
    </div>
  </div>

  <!-- Modal Booking Baru -->
  <div class="modal fade" id="modalNew" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header"><h5 class="modal-title" id="newTitle">Booking Baru</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button></div>
        <div class="modal-body">
          <form id="fNew">
            <div class="form-group">
              <label>Tanggal</label>
              <?php $min=date('Y-m-d'); $max=date('Y-m-d', strtotime('+7 days')); ?>
              <input type="date" class="form-control" id="n_tanggal" required min="<?php echo $min; ?>" max="<?php echo $max; ?>">
            </div>
            <div class="form-group">
              <label>Dokter</label>
              <select class="form-control" id="n_dokter" required>
                <option value="">- pilih -</option>
                <?php foreach(($dokters??[]) as $d): ?>
                  <option value="<?php echo $d['id_dokter']; ?>" <?php echo ($id_dokter==$d['id_dokter'])?'selected':''; ?>><?php echo html_escape($d['nama_dokter']); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label>Pasien</label>
              <div class="input-group">
                <input type="text" class="form-control" id="n_pasien_label" placeholder="Cari pasien..." readonly>
                <div class="input-group-append"><button class="btn btn-outline-secondary" type="button" id="btnCariPasien">Cari</button></div>
              </div>
              <input type="hidden" id="n_id_pasien">
            </div>
            <div class="form-group">
              <label>Jenis Perawatan</label>
              <select class="form-control" id="n_jenis" required>
                <option value="">- pilih -</option>
                <option value="Vaksin">Vaksin</option>
                <option value="Konsultasi">Konsultasi</option>
              </select>
            </div>
            <div class="form-group">
              <label>Slot Jam</label>
              <div class="d-flex" style="gap:6px; align-items:center;">
                <input type="time" class="form-control" id="n_slot_manual" step="60" style="max-width:150px;" placeholder="HH:MM">
                <small class="text-muted ml-2">Slot terload otomatis setelah Tanggal, Dokter, Pasien, dan Jenis dipilih.</small>
              </div>
              <div id="slotWrap" class="mt-2"></div>
            </div>
            <div class="text-danger small" id="n_err" style="display:none;"></div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success" id="btnSaveNew">Simpan</button>
          <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Cari Pasien -->
  <div class="modal fade" id="modalCari" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header"><h5 class="modal-title">Cari Pasien</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button></div>
        <div class="modal-body">
          <div class="form-inline mb-2">
            <input type="text" class="form-control mr-2" id="s_q" placeholder="RM / Nama / HP" style="min-width:240px;">
            <button class="btn btn-primary" id="s_btn">Cari</button>
          </div>
          <div class="table-responsive">
            <table class="table table-sm table-hover">
              <thead class="bg-light"><tr><th>RM</th><th>Nama</th><th>HP</th><th>Aksi</th></tr></thead>
              <tbody id="s_body"></tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer"><button class="btn btn-secondary" data-dismiss="modal">Tutup</button></div>
      </div>
    </div>
  </div>

  <script>
  (function(){
    const baseUrl = "<?php echo base_url(); ?>";
    const idDokter = "<?php echo $id_dokter ?? ''; ?>";
    const cutiMap = <?php echo json_encode($cuti_map ?? []); ?>;
    const escAttr = (v)=>String(v||'').replace(/"/g,'&quot;');
    let currentDate = '';
    window.reschBooking = null;

    window.openList = async function(tgl){
      if(!idDokter){ alert('Pilih dokter dahulu.'); return; }
      currentDate = tgl;
      document.getElementById('listTitle').textContent = 'Pasien Booking '+tgl;
      const fd = new FormData(); fd.append('tanggal', tgl); fd.append('id_dokter', idDokter);
      const res = await fetch(baseUrl+'booking/get_bookings_by_date_ajax', {method:'POST', body:fd});
      const js  = await res.json();
      const wrap= document.getElementById('listWrap');
      if(!js.status){ wrap.innerHTML = '<span class="text-danger">Gagal load</span>'; $('#modalList').modal('show'); return; }
      const items = js.items||[];
      if(items.length===0){ wrap.innerHTML = '<em>Tidak ada booking.</em>'; $('#modalList').modal('show'); return; }
      const isCuti = !!cutiMap[currentDate];
      let banner = '';
      if(isCuti) banner = '<div class="alert alert-warning py-1">Dokter cuti di tanggal ini. Mohon segera ubah tanggal booking pasien ke tanggal tersedia.</div>';
      let html = banner + '<div class="table-responsive"><table class="table table-bordered table-sm">'+
                 '<thead class="bg-light"><tr><th>Jam</th><th>Pasien</th><th>Jenis</th><th>Check-in Status</th><th>Aksi</th></tr></thead><tbody>';
      items.forEach(r=>{
        const actions = [];
        if(r.wa_link){ actions.push('<a target="_blank" class="btn btn-sm btn-outline-success" href="'+escAttr(r.wa_link)+'">Kirim WA</a>'); }
        actions.push(
          '<button type="button" class="btn btn-sm btn-outline-primary btn-ubah-tgl"'
          + ' data-id="'+(r.id||'')+'"'
          + ' data-dokter="'+(r.id_dokter||'')+'"'
          + ' data-dokternama="'+escAttr(r.nama_dokter||'')+'"'
          + ' data-tanggal="'+(r.tanggal||currentDate)+'"'
          + ' data-slot="'+(r.slot_time||'')+'"'
          + ' data-slotidx="'+(r.slot_idx||'')+'"'
          + ' data-jenis="'+escAttr(r.jenis_perawatan||'')+'"'
          + '>Ubah Jadwal</button>'
        );
        const infoTxt = escAttr(((r.tanggal||currentDate)+' '+(r.slot_time||'')+' - '+(r.nama_pasien||'')).trim());
        actions.push(
          '<button type="button" class="btn btn-sm btn-outline-danger btn-batal-booking"'
          + ' data-id="'+(r.id||'')+'"'
          + ' data-info="'+infoTxt+'">Batal</button>'
        );
        html += '<tr>'+ 
          '<td>'+(r.slot_time||'-')+'</td>'+ 
          '<td>'+(r.nama_pasien||'')+'<br><small>'+ (r.id_pasien||'') +'</small></td>'+ 
          '<td>'+(r.jenis_perawatan||'')+'</td>'+ 
          '<td>'+ (parseInt(r.sudah_checkin||0,10)?'CHECKIN':'BARU') +'</td>'+ 
          '<td><div class="d-flex flex-wrap" style="gap:6px;">'+actions.join(' ')+'</div></td>'+
        '</tr>';
      });
      html += '</tbody></table></div>';
      wrap.innerHTML = html;
      // bind buttons
      document.querySelectorAll('#listWrap .btn-ubah-tgl').forEach(btn=>{
        btn.addEventListener('click', ()=>{
          window.reschBooking = {
            id: btn.getAttribute('data-id'),
            id_dokter: btn.getAttribute('data-dokter'),
            dokter_nama: btn.getAttribute('data-dokternama')||'',
            tanggal: btn.getAttribute('data-tanggal'),
            slot: btn.getAttribute('data-slot')||'',
            slot_idx: btn.getAttribute('data-slotidx')||'',
            jenis: btn.getAttribute('data-jenis')||''
          };
          openRescheduleModal();
        });
      });
      document.querySelectorAll('#listWrap .btn-batal-booking').forEach(btn=>{
        btn.addEventListener('click', ()=>cancelBooking(btn));
      });
      $('#modalList').modal('show');
    }

    async function cancelBooking(btn){
      if(!btn) return;
      const id = btn.getAttribute('data-id');
      if(!id){ alert('ID booking tidak ditemukan.'); return; }
      const info = btn.getAttribute('data-info') || '';
      const reason = prompt('Alasan pembatalan?\n'+info, '');
      if(reason === null) return;
      const ket = reason.trim();
      if(!ket){ alert('Alasan batal wajib diisi.'); return; }
      const oldLabel = btn.textContent;
      btn.disabled = true; btn.textContent = 'Memproses...';
      const fd = new FormData(); fd.append('id_book', id); fd.append('ket_batal', ket);
      try{
        const res = await fetch(baseUrl+'booking/cancel_booking_ajax', {method:'POST', body:fd});
        const js  = await res.json();
        if(!js.status){ alert(js.message||'Gagal membatalkan booking.'); btn.disabled=false; btn.textContent=oldLabel; return; }
        alert('Booking dibatalkan.');
        location.reload();
      }catch(e){
        alert('Gagal membatalkan booking.');
        btn.disabled=false; btn.textContent=oldLabel;
      }
    }

    window.openNewBooking = function(tgl){
      currentDate = tgl;
      document.getElementById('newTitle').textContent = 'Booking Baru '+tgl;
      document.getElementById('n_tanggal').value = tgl;
      if(idDokter){ document.getElementById('n_dokter').value = idDokter; }
      document.getElementById('slotWrap').innerHTML = '';
      document.getElementById('n_err').style.display='none';
      $('#modalNew').modal('show');
    }

    // Cari pasien
    document.getElementById('btnCariPasien').addEventListener('click', ()=>{
      document.getElementById('s_q').value=''; document.getElementById('s_body').innerHTML='';
      $('#modalCari').modal('show');
    });
    // Trigger search on Enter as well as button click
    document.getElementById('s_q').addEventListener('keydown', (e)=>{
      if(e.key==='Enter'){ e.preventDefault(); document.getElementById('s_btn').click(); }
    });
    document.getElementById('s_btn').addEventListener('click', async ()=>{
      const q = document.getElementById('s_q').value.trim();
      const fd = new FormData(); fd.append('q', q);
      const res = await fetch(baseUrl+'booking/search_pasien_ajax', {method:'POST', body:fd});
      const js  = await res.json();
      const tb = document.getElementById('s_body'); tb.innerHTML='';
      (js.items||[]).forEach(it=>{
        const tr = document.createElement('tr');
        tr.innerHTML = '<td>'+it.no_rm+'</td><td>'+it.name+'</td><td>'+ (it.hp||'') +'</td>'+
                       '<td><button type="button" class="btn btn-sm btn-outline-primary">Pilih</button></td>';
        tr.querySelector('button').addEventListener('click', ()=>{
          document.getElementById('n_id_pasien').value = it.id_pasien;
          document.getElementById('n_pasien_label').value = it.no_rm+' - '+it.name;
          $('#modalCari').modal('hide');
          maybeLoadSlots();
        });
        tb.appendChild(tr);
      });
    });

    // Auto-load slots when all required selections provided
    async function loadSlots(){
      const tgl = document.getElementById('n_tanggal').value;
      const idd = document.getElementById('n_dokter').value;
      const el  = document.getElementById('slotWrap');
      el.innerHTML = '<em>Memuat slot...</em>';
      const fd = new FormData(); fd.append('tanggal', tgl); fd.append('id_dokter', idd);
      try{
        const res = await fetch(baseUrl+'booking/get_slots_ajax', {method:'POST', body:fd});
        const js  = await res.json();
        el.innerHTML='';
        if(!js.status){ el.innerHTML = '<span class="text-danger">'+(js.message||'Gagal memuat slots')+'</span>'; return; }
        const all    = js.all_slots||[];
        const booked = new Set((js.booked_slots||[]).map(String));
        const locked = new Set((js.locked_slots||[]).map(String));
        const avail  = new Set((js.slots||[]).map(String));
        if(all.length===0){ el.innerHTML = '<em>Tidak ada slot tersedia (cuti / tidak ada jadwal).</em>'; return; }
        const frag = document.createDocumentFragment();
        all.forEach(s=>{
          const isBooked = booked.has(s);
          const isLocked = locked.has(s);
          const isAvail  = avail.has(s) && !isBooked && !isLocked;
          const b = document.createElement('button');
          b.type='button';
          if(isAvail){
            b.className='btn btn-sm btn-primary mr-1 mb-1';
            b.addEventListener('click', ()=>{ document.getElementById('n_slot_manual').value=s; });
          } else {
            b.className='btn btn-sm btn-secondary mr-1 mb-1';
            b.disabled = true;
            b.title = isBooked ? 'Sudah terisi' : (isLocked ? 'Dikunci' : 'Tidak tersedia');
          }
          b.textContent = s;
          frag.appendChild(b);
        });
        el.appendChild(frag);
      }catch(e){ el.innerHTML = '<span class="text-danger">Gagal memuat slots</span>'; }
    }

    function canLoadSlots(){
      const tgl = document.getElementById('n_tanggal').value;
      const idd = document.getElementById('n_dokter').value;
      const pid = document.getElementById('n_id_pasien').value;
      const jns = document.getElementById('n_jenis').value;
      return !!(tgl && idd && pid && jns);
    }

    function maybeLoadSlots(){
      const el  = document.getElementById('slotWrap');
      if(canLoadSlots()){
        loadSlots();
      } else {
        el.innerHTML = '';
      }
    }

    // Bind auto-load triggers
    document.getElementById('n_tanggal').addEventListener('change', ()=>{ document.getElementById('n_slot_manual').value=''; maybeLoadSlots(); });
    document.getElementById('n_dokter').addEventListener('change',  ()=>{ document.getElementById('n_slot_manual').value=''; maybeLoadSlots(); });
    document.getElementById('n_jenis').addEventListener('change',   ()=>{ document.getElementById('n_slot_manual').value=''; maybeLoadSlots(); });

    // Save booking
    document.getElementById('btnSaveNew').addEventListener('click', async ()=>{
      const id_pasien = document.getElementById('n_id_pasien').value;
      const id_dokter = document.getElementById('n_dokter').value;
      const tanggal   = document.getElementById('n_tanggal').value;
      const slot_time = document.getElementById('n_slot_manual').value;
      const jenis     = document.getElementById('n_jenis').value;
      const err = document.getElementById('n_err'); err.style.display='none';
      if(!(id_pasien && id_dokter && tanggal && slot_time && jenis)){
        err.textContent = 'Lengkapi data form.'; err.style.display=''; return;
      }
      const fd = new FormData();
      fd.append('id_pasien', id_pasien);
      fd.append('id_dokter', id_dokter);
      fd.append('tanggal', tanggal);
      fd.append('slot_time', slot_time);
      fd.append('jenis_perawatan', jenis);
      const res = await fetch(baseUrl+'booking/save_booking_ajax', {method:'POST', body:fd});
      const js  = await res.json();
      if(!js.status){ err.textContent = js.message||'Gagal menyimpan.'; err.style.display=''; return; }
      // optionally open WA link
      if(js.wa_link){ if(confirm('Buka WhatsApp untuk kirim reminder?')) window.open(js.wa_link, '_blank'); }
      $('#modalNew').modal('hide');
      // refresh current page to update list counts
      location.reload();
    });
  })();
  </script>
  
  <!-- Modal Ubah Tanggal Booking -->
  <div class="modal fade" id="modalReschedule" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header"><h5 class="modal-title">Ubah Tanggal Booking</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button></div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <h6>Booking Saat Ini</h6>
              <div id="r_cur" class="small">
                <div>Dokter: <span id="r_cur_dokter">-</span></div>
                <div>Tanggal: <span id="r_cur_tgl">-</span></div>
                <div>Jam: <span id="r_cur_jam">-</span></div>
                <div>Slot: <span id="r_cur_slot">-</span></div>
                <div>Jenis Perawatan: <span id="r_cur_jenis">-</span></div>
              </div>
            </div>
            <div class="col-md-6">
              <h6>Pilih Tanggal Lain</h6>
              <?php $min=date('Y-m-d'); $max=date('Y-m-d', strtotime('+7 days')); ?>
              <div class="form-group">
                <label>Tanggal Baru</label>
                <input type="date" class="form-control" id="r_tanggal_baru" min="<?php echo $min; ?>" max="<?php echo $max; ?>">
              </div>
              <div class="form-group">
                <label>Pilih Slot</label>
                <div id="r_slots"><em>Pilih tanggal baru untuk memuat slot.</em></div>
              </div>
              <div class="text-danger small" id="r_err" style="display:none;"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="btnReschSave">Simpan Perubahan</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <script>
  (function(){
    const baseUrl = "<?php echo base_url(); ?>";
    const idDokter = "<?php echo $id_dokter ?? ''; ?>";
    let selectedReschSlot = '';
    window.openRescheduleModal = function(){
      var rb = window.reschBooking || {};
      selectedReschSlot = '';
      document.getElementById('r_cur_dokter').textContent = rb.dokter_nama || '';
      document.getElementById('r_cur_tgl').textContent = rb.tanggal || '-';
      document.getElementById('r_cur_jam').textContent = rb.slot || '-';
      document.getElementById('r_cur_slot').textContent = rb.slot_idx || '-';
      document.getElementById('r_cur_jenis').textContent = rb.jenis || '';
      document.getElementById('r_tanggal_baru').value = '';
      document.getElementById('r_slots').innerHTML = '<em>Pilih tanggal baru untuk memuat slot.</em>';
      document.getElementById('r_err').style.display='none';
      $('#modalReschedule').modal('show');
    }

    async function loadRescheduleSlots(){
      const tgl = document.getElementById('r_tanggal_baru').value;
      const el  = document.getElementById('r_slots');
      if(!(tgl && window.reschBooking && window.reschBooking.id_dokter)) { el.innerHTML='<em>Pilih tanggal baru.</em>'; return; }
      el.innerHTML = '<em>Memuat slot...</em>';
      const fd = new FormData(); fd.append('tanggal', tgl); fd.append('id_dokter', window.reschBooking.id_dokter);
      try{
        const res = await fetch(baseUrl+'booking/get_slots_ajax', {method:'POST', body:fd});
        const js  = await res.json();
        el.innerHTML='';
        if(!js.status){ el.innerHTML = '<span class="text-danger">'+(js.message||'Gagal memuat slots')+'</span>'; return; }
        const all    = js.all_slots||[];
        const booked = new Set((js.booked_slots||[]).map(String));
        const locked = new Set((js.locked_slots||[]).map(String));
        if(all.length===0){ el.innerHTML = '<em>Tidak ada slot tersedia di tanggal ini.</em>'; return; }
        const frag = document.createDocumentFragment();
        all.forEach(s=>{
          const isBooked = booked.has(s);
          const isLocked = locked.has(s);
          const isAvail  = (js.slots||[]).includes(s) && !isBooked && !isLocked;
          const b = document.createElement('button'); b.type='button';
          b.textContent=s;
          if(isAvail){ b.className='btn btn-sm btn-primary mr-1 mb-1'; b.addEventListener('click', (e)=>{ selectReschSlot(s, e); }); }
          else { b.className='btn btn-sm btn-secondary mr-1 mb-1'; b.disabled=true; b.title = isBooked?'Sudah terisi':(isLocked?'Dikunci':'Tidak tersedia'); }
          frag.appendChild(b);
        });
        el.appendChild(frag);
      }catch(e){ el.innerHTML='<span class="text-danger">Gagal memuat slots</span>'; }
    }

    function selectReschSlot(s, e){ selectedReschSlot = s; Array.from(document.querySelectorAll('#r_slots .btn')).forEach(x=>x.classList.remove('active')); if(e && e.target){ e.target.classList.add('active'); } }

    document.getElementById('r_tanggal_baru').addEventListener('change', ()=>{ selectedReschSlot=''; loadRescheduleSlots(); });

    document.getElementById('btnReschSave').addEventListener('click', async ()=>{
      const tgl = document.getElementById('r_tanggal_baru').value;
      const err = document.getElementById('r_err'); err.style.display='none';
      if(!(window.reschBooking && window.reschBooking.id && tgl && selectedReschSlot)) { err.textContent='Pilih tanggal baru dan slot.'; err.style.display=''; return; }
      const fd = new FormData(); fd.append('id_book', window.reschBooking.id); fd.append('tanggal_baru', tgl); fd.append('slot_time', selectedReschSlot);
      const res = await fetch(baseUrl+'booking/update_booking_date_ajax', {method:'POST', body:fd});
      const js  = await res.json();
      if(!js.status){ err.textContent = js.message||'Gagal mengubah booking.'; err.style.display=''; return; }
      $('#modalReschedule').modal('hide');
      // refresh both modals and calendar list
      location.reload();
    });
  })();
  </script>
  <body></html>
