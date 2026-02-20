<!doctype html>
<html>
  <head>
    <?php $this->theme->head('theme_default'); ?>
    <?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>
    <style>
      .calendar th, .calendar td { width:14.28%; vertical-align:top; height:120px; }
      .calendar .date { font-weight:700; font-size: 1.4rem; line-height:1; }
      .calendar .btn-addedit { font-size: 10px; padding: 1px 6px; line-height: 1.2; }
      .cuti-item { font-size: 12px; padding:2px 4px; background:#ffecec; border:1px solid #ffb3b3; border-radius:4px; margin:2px 0; white-space: normal; word-break: break-word; overflow-wrap: anywhere; }
      .month-title { font-size: 1.5rem; }
    </style>
  </head>
  <?php $this->theme->wrapper_open('theme_default','BreadCrumb'); ?>
  <div class="loader-bg"><div class="loader-bar"></div></div>
  <div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">
      <div class="pcoded-main-container"><div class="pcoded-wrapper"><div class="pcoded-content">

      <div class="page-header card">
        <div class="row align-items-end">
          <div class="col-lg-8">
            <div class="page-header-title"><i class="feather icon-calendar bg-c-green"></i>
              <div class="d-inline"><h5>Dokter Cuti</h5><span>Kalender cuti dokter</span></div>
            </div>
          </div>
          <div class="col-lg-4 text-right">
            <?php $prevM = $month-1; $prevY=$year; if($prevM<1){$prevM=12;$prevY--;}
                  $nextM = $month+1; $nextY=$year; if($nextM>12){$nextM=1;$nextY++;} ?>
            <a class="btn btn-outline-secondary" href="<?php echo base_url('dokter_cuti/index/'.$prevY.'/'.$prevM); ?>">&laquo; Prev</a>
            <span class="mx-2 font-weight-bold month-title"><?php echo date('F Y', strtotime(sprintf('%04d-%02d-01',$year,$month))); ?></span>
            <a class="btn btn-outline-secondary" href="<?php echo base_url('dokter_cuti/index/'.$nextY.'/'.$nextM); ?>">Next &raquo;</a>
            <button class="btn btn-primary ml-2" id="btnCutiRange">Cuti Panjang</button>
          </div>
        </div>
      </div>

      <div class="pcoded-inner-content">
        <div class="main-body"><div class="page-wrapper"><div class="page-body"><div class="row"><div class="col-sm-12"><div class="card"><div class="card-block">

          <div class="table-responsive">
            <table class="table table-bordered calendar">
              <thead class="bg-light">
                <tr>
                  <th>Sen</th><th>Sel</th><th>Rab</th><th>Kam</th><th>Jum</th><th>Sab</th><th>Min</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $day = 1; $dow = (int)$start_dow; // 1..7 (Mon..Sun)
                  echo '<tr>';
                  for ($i=1; $i<$dow; $i++) echo '<td></td>';
                  for (; $day <= $days; $day++) {
                      $tgl = sprintf('%04d-%02d-%02d', $year, $month, $day);
                      echo '<td>';
                      echo '<div class="d-flex justify-content-between align-items-start"><span class="date">'.$day.'</span>';
                      echo '<button class="btn btn-sm btn-outline-primary btn-addedit" data-date="'.$tgl.'" onclick="openDay(\''.$tgl.'\')">Add/Edit</button></div>';
                      if (!empty($cuti_map[$tgl])) {
                        foreach ($cuti_map[$tgl] as $row) {
                          echo '<div class="cuti-item">'.html_escape($row['nama_dokter']).' - '.html_escape($row['keterangan']).'</div>';
                        }
                      }
                      echo '</td>';
                      if ( (($dow + $day -1) % 7) == 0) echo '</tr><tr>';
                  }
                  $tail = (7 - (($dow + $days -1) % 7)); if($tail<7){ for($i=0;$i<$tail;$i++) echo '<td></td>'; }
                  echo '</tr>';
                ?>
              </tbody>
            </table>
          </div>

        </div></div></div></div></div></div></div>
      </div>

      </div></div></div>
    </div>
  </div>
  <?php #$this->theme->wrapper_close('theme_default'); ?>
  </div></div></div></div>

  <?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-js.php'); ?>

  <!-- Modal day -->
  <div class="modal fade" id="modalDay" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header"><h5 class="modal-title" id="dayTitle">Cuti Tanggal</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button></div>
        <div class="modal-body">
          <div id="listCuti"></div>
          <hr>
          <form id="fCuti">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Dokter</label>
                <select class="form-control" id="c_id_dokter">
                  <option value="">- pilih -</option>
                  <?php foreach(($dokters??[]) as $d): ?>
                  <option value="<?php echo $d['id_dokter']; ?>"><?php echo html_escape($d['name']); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label>Keterangan</label>
                <input type="text" class="form-control" id="c_ket" placeholder="misal: Cuti pribadi" required>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" id="btnAddCuti">Simpan</button>
          <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal range -->
  <div class="modal fade" id="modalRange" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header"><h5 class="modal-title">Cuti Panjang</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button></div>
        <div class="modal-body">
          <form id="fRange">
            <div class="form-group">
              <label>Dokter</label>
              <select class="form-control" id="r_id_dokter">
                <option value="">- pilih -</option>
                <?php foreach(($dokters??[]) as $d): ?>
                <option value="<?php echo $d['id_dokter']; ?>"><?php echo html_escape($d['name']); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Dari</label>
                <input type="date" class="form-control" id="r_start" required>
              </div>
              <div class="form-group col-md-6">
                <label>Sampai</label>
                <input type="date" class="form-control" id="r_end" required>
              </div>
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <input type="text" class="form-control" id="r_ket" placeholder="misal: Cuti pribadi" required>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" id="btnSaveRange">Simpan</button>
          <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <script>
  (function(){
    const baseUrl = "<?php echo base_url(); ?>";
    let currentDate = '';

    window.openDay = async function(tgl){
      currentDate = tgl;
      document.getElementById('dayTitle').textContent = 'Cuti Tanggal ' + tgl;
      await reloadDayList();
      $('#modalDay').modal('show');
    }

    async function reloadDayList(){
      const wrap = document.getElementById('listCuti');
      wrap.innerHTML = '<em>Memuat...</em>';
      const fd = new FormData(); fd.append('tanggal', currentDate);
      const res = await fetch(baseUrl+'dokter_cuti/get_cuti_by_date_ajax', {method:'POST', body:fd});
      const js  = await res.json();
      if(!js.status){ wrap.innerHTML = '<span class="text-danger">Gagal load</span>'; return; }
      const items = js.items||[];
      if(items.length===0){ wrap.innerHTML = '<em>Belum ada cuti pada tanggal ini.</em>'; return; }
      wrap.innerHTML = '';
      items.forEach(it=>{
        const div = document.createElement('div');
        div.className = 'd-flex justify-content-between align-items-center cuti-item';
        // ensure button does not act as submit and carries id explicitly
        div.innerHTML = '<span>'+ (it.nama_dokter||'') +' - '+ (it.keterangan||'') +'</span>'+
                        '<button type="button" class="btn btn-sm btn-outline-danger" data-id="'+ (it.id_cuti??'') +'" data-dokter="'+ (it.id_dokter??'') +'" data-date="'+ (it.tanggal_cuti||currentDate) +'">Hapus</button>';
        const btn = div.querySelector('button');
        btn.addEventListener('click', async ()=>{
          const id = btn.getAttribute('data-id');
          const tanggal = btn.getAttribute('data-date') || currentDate;
          const id_dokter = btn.getAttribute('data-dokter') || '';
          if(!confirm('Hapus entri cuti ini?')) return;
          const fd = new FormData();
          if(id) fd.append('id_cuti', id);
          if(tanggal) fd.append('tanggal', tanggal);
          if(id_dokter) fd.append('id_dokter', id_dokter);
          const res = await fetch(baseUrl+'dokter_cuti/delete_cuti_ajax', {method:'POST', body:fd});
          const js  = await res.json(); alert(js.message||'OK');
          if(js.status){
            // tutup modal dan reload, tetap di bulan yang sama
            $('#modalDay').modal('hide');
            location.reload();
          }
        });
        wrap.appendChild(div);
      });
    }

    document.getElementById('btnAddCuti').addEventListener('click', async ()=>{
      const id_dokter = document.getElementById('c_id_dokter').value;
      const ket = document.getElementById('c_ket').value.trim();
      if(!(currentDate && id_dokter && ket)){ alert('Lengkapi data'); return; }
      const fd = new FormData();
      fd.append('tanggal', currentDate);
      fd.append('id_dokter', id_dokter);
      fd.append('keterangan', ket);
      const res = await fetch(baseUrl+'dokter_cuti/save_cuti_ajax', {method:'POST', body:fd});
      const js  = await res.json(); alert(js.message||'OK');
      if(js.status){
        // tutup modal dan reload halaman agar kalender ter-update, tetap di bulan yang sama
        $('#modalDay').modal('hide');
        location.reload();
      }
    });

    document.getElementById('btnCutiRange').addEventListener('click', ()=>{ $('#modalRange').modal('show'); });
    document.getElementById('btnSaveRange').addEventListener('click', async ()=>{
      const id_dokter = document.getElementById('r_id_dokter').value;
      const st = document.getElementById('r_start').value;
      const en = document.getElementById('r_end').value;
      const ket= document.getElementById('r_ket').value.trim();
      if(!(id_dokter && st && en && ket)){ alert('Lengkapi data'); return; }
      const fd = new FormData(); fd.append('id_dokter', id_dokter); fd.append('start', st); fd.append('end', en); fd.append('keterangan', ket);
      const res = await fetch(baseUrl+'dokter_cuti/bulk_cuti_ajax', {method:'POST', body:fd});
      const js  = await res.json(); alert(js.message||'OK');
      if(js.status){
        // tutup modal dan reload, tetap di bulan yang sama
        $('#modalRange').modal('hide');
        location.reload();
      }
    });
  })();
  </script>
  <body></html>
