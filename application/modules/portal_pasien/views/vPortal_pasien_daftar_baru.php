<!doctype html>
<html>
  <head>
    <?php $this->theme->head('theme_portal_pasien'); ?>
    <?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>
    <style>
      .card .form-group label { font-weight:600; }
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
                          <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0" id="pageTitle">Daftar Pasien Baru</h5>
                          </div>
                          <div class="card-block">
                            <form id="fDaftar">
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                  <label>Nama Lengkap <span class="text-danger">*</span></label>
                                  <input type="text" class="form-control" name="nama" id="nama" required>
                                </div>
                                <div class="form-group col-md-3">
                                  <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                  <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" required>
                                </div>
                                <div class="form-group col-md-3">
                                  <label>Tempat Lahir <span class="text-danger">*</span></label>
                                  <input type="text" class="form-control" name="tmp_lahir" id="tmp_lahir" required>
                                </div>
                              </div>

                              <div class="form-row">
                                <div class="form-group col-md-3">
                                  <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                  <div>
                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input" type="radio" name="jk" id="jkL" value="L" required>
                                      <label class="form-check-label" for="jkL">Laki-laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                      <input class="form-check-input" type="radio" name="jk" id="jkP" value="P">
                                      <label class="form-check-label" for="jkP">Perempuan</label>
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group col-md-3">
                                  <label>Nama Ayah</label>
                                  <input type="text" class="form-control" name="nama_ayah" id="nama_ayah">
                                </div>
                                <div class="form-group col-md-3">
                                  <label>Nama Ibu</label>
                                  <input type="text" class="form-control" name="nama_ibu" id="nama_ibu">
                                </div>
                                <div class="form-group col-md-3">
                                  <label>No. HP/WA <span class="text-danger">*</span></label>
                                  <input type="text" class="form-control" name="hp" id="hp" placeholder="08xxxxxxxxxxx" required>
                                </div>
                              </div>

                              <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" class="form-control" name="alamat" id="alamat">
                              </div>

                              <div class="form-row">
                                <div class="form-group col-md-3">
                                  <label>Propinsi</label>
                                  <select class="form-control" name="id_propinsi" id="id_propinsi">
                                    <option value="">- pilih -</option>
                                    <?php foreach(($propinsis ?? []) as $p): ?>
                                      <option value="<?php echo $p['id_propinsi']; ?>"><?php echo html_escape($p['name']); ?></option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                                <div class="form-group col-md-3">
                                  <label>Kota</label>
                                  <select class="form-control" name="id_kota" id="id_kota">
                                    <option value="">- pilih -</option>
                                  </select>
                                </div>
                                <div class="form-group col-md-3">
                                  <label>Kecamatan</label>
                                  <select class="form-control" name="id_kecamatan" id="id_kecamatan">
                                    <option value="">- pilih -</option>
                                  </select>
                                </div>
                                <div class="form-group col-md-3">
                                  <label>Kelurahan</label>
                                  <select class="form-control" name="id_kelurahan" id="id_kelurahan">
                                    <option value="">- pilih -</option>
                                  </select>
                                </div>
                              </div>

                              <div class="d-flex justify-content-between mt-3">
                                <button type="button" id="btnVerify" class="btn btn-primary">Verifikasi Data</button>
                                <button type="button" id="btnSave" class="btn btn-success" style="display:none;">Simpan dan Daftar</button>
                              </div>
                            </form>

                            <div id="resultWrap" class="mt-4" style="display:none;">
                              <div class="card mb-3">
                                <div class="card-header">Akses Portal</div>
                                <div class="card-body">
                                  <div class="form-row">
                                    <div class="form-group col-md-4">
                                      <label>Portal ID</label>
                                      <input type="text" class="form-control" id="d_portal_id" readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label>PIN</label>
                                      <input type="text" class="form-control" id="d_pin" readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                      <label>No. HP</label>
                                      <input type="text" class="form-control" id="d_hp" readonly>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="card">
                                <div class="card-header">Data Lainnya</div>
                                <div class="card-body">
                                  <div class="form-row">
                                    <div class="form-group col-md-3">
                                      <label>No. Rekam Medis</label>
                                      <input type="text" class="form-control" id="d_no_rm" readonly>
                                    </div>
                                    <div class="form-group col-md-5">
                                      <label>Nama</label>
                                      <input type="text" class="form-control" id="d_nama" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                      <label>Tgl. Lahir</label>
                                      <input type="text" class="form-control" id="d_tgl" readonly>
                                    </div>
                                    <div class="form-group col-md-2">
                                      <label>JK</label>
                                      <input type="text" class="form-control" id="d_jk" readonly>
                                    </div>
                                  </div>
                                  <div class="form-row">
                                    <div class="form-group col-md-4">
                                      <label>Tempat Lahir</label>
                                      <input type="text" class="form-control" id="d_tmp" readonly>
                                    </div>
                                    <div class="form-group col-md-8">
                                      <label>Alamat</label>
                                      <input type="text" class="form-control" id="d_alamat" readonly>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="mt-3 d-flex align-items-center" style="gap:8px;">
                                <a class="btn btn-outline-secondary" href="<?php echo base_url('portal_pasien/daftar_pasien_baru'); ?>">Daftar Pasien Baru</a>
                                <a class="btn btn-primary" href="<?php echo base_url('portal_pasien/login'); ?>">Kembali ke Login</a>
                                <button type="button" id="btnSendWA" class="btn btn-success">Kirim PIN Ke WA</button>
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
      </div>
    </div>
  <?php #$this->theme->wrapper_close('theme_default'); ?>
  </div></div></div></div>

  <?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-js.php'); ?>
  <script>
  (function(){
    const baseUrl = "<?php echo base_url(); ?>";

    const selPropinsi  = document.getElementById('id_propinsi');
    const selKota      = document.getElementById('id_kota');
    const selKecamatan = document.getElementById('id_kecamatan');
    const selKelurahan = document.getElementById('id_kelurahan');

    function resetSelect(sel){ sel.innerHTML = '<option value="">- pilih -</option>'; }

    selPropinsi.addEventListener('change', async ()=>{
      resetSelect(selKota); resetSelect(selKecamatan); resetSelect(selKelurahan);
      const id = selPropinsi.value; if(!id) return;
      const fd = new FormData(); fd.append('id_propinsi', id);
      const res = await fetch(baseUrl+'portal_pasien/get_kota_by_propinsi_ajax', {method:'POST', body:fd});
      const js  = await res.json();
      (js.items||[]).forEach(x=>{ const o=document.createElement('option'); o.value=x.id_kota; o.textContent=x.name; selKota.appendChild(o); });
    });

    selKota.addEventListener('change', async ()=>{
      resetSelect(selKecamatan); resetSelect(selKelurahan);
      const id = selKota.value; if(!id) return;
      const fd = new FormData(); fd.append('id_kota', id);
      const res = await fetch(baseUrl+'portal_pasien/get_kecamatan_by_kota_ajax', {method:'POST', body:fd});
      const js  = await res.json();
      (js.items||[]).forEach(x=>{ const o=document.createElement('option'); o.value=x.id_kecamatan; o.textContent=x.name; selKecamatan.appendChild(o); });
    });

    selKecamatan.addEventListener('change', async ()=>{
      resetSelect(selKelurahan);
      const id = selKecamatan.value; if(!id) return;
      const fd = new FormData(); fd.append('id_kecamatan', id);
      const res = await fetch(baseUrl+'portal_pasien/get_kelurahan_by_kecamatan_ajax', {method:'POST', body:fd});
      const js  = await res.json();
      (js.items||[]).forEach(x=>{ const o=document.createElement('option'); o.value=x.id_kelurahan; o.textContent=x.name; selKelurahan.appendChild(o); });
    });

    // ===== Verifikasi & Simpan =====
    function fillResult(d){
      document.getElementById('pageTitle').textContent = 'Pasien Sudah Terdaftar';
      document.getElementById('d_portal_id').value = d.portal_id || '';
      document.getElementById('d_pin').value       = d.pin || '';
      document.getElementById('d_hp').value        = d.hp || '';
      document.getElementById('d_no_rm').value     = d.id_pasien || '';
      document.getElementById('d_nama').value      = d.name || '';
      document.getElementById('d_tgl').value       = d.birthdate || '';
      document.getElementById('d_tmp').value       = d.birthplace || '';
      document.getElementById('d_jk').value        = (d.gender==='L'?'Laki-laki':(d.gender==='P'?'Perempuan':''));
      document.getElementById('d_alamat').value    = d.address || '';
    }

    let resultIdPasien = '';

    // Verifikasi Data
    document.getElementById('btnVerify').addEventListener('click', async ()=>{
      const nama = document.getElementById('nama').value.trim();
      const tgl  = document.getElementById('tgl_lahir').value.trim();
      if(!(nama && tgl)){ alert('Isi Nama Lengkap dan Tanggal Lahir'); return; }
      const fd = new FormData(); fd.append('nama', nama); fd.append('tgl_lahir', tgl);
      const res = await fetch(baseUrl+'portal_pasien/verify_pasien_ajax', {method:'POST', body:fd});
      const js  = await res.json();
      if(js.status){
        // Ada di database => tampilkan data + sembunyikan form
        document.getElementById('fDaftar').style.display = 'none';
        document.getElementById('resultWrap').style.display = 'block';
        document.getElementById('btnSave').style.display = 'none';
        fillResult(js.data);
        resultIdPasien = js.data && js.data.id_pasien ? js.data.id_pasien : '';
      }else{
        // Tidak ada => munculkan tombol Simpan & Daftar
        alert('Pasien belum terdaftar. Silakan lanjutkan pendaftaran.');
        document.getElementById('btnSave').style.display = 'inline-block';
      }
    });

    // Simpan dan Daftar
    document.getElementById('btnSave').addEventListener('click', async ()=>{
      if(!confirm('Simpan & Daftar sebagai pasien baru?')) return;
      const fd = new FormData(document.getElementById('fDaftar'));
      const res = await fetch(baseUrl+'portal_pasien/create_pasien_ajax', {method:'POST', body:fd});
      const js  = await res.json();
      alert(js.message||'OK');
      if(js.status){
        document.getElementById('fDaftar').style.display = 'none';
        document.getElementById('resultWrap').style.display = 'block';
        fillResult(js.data);
        document.getElementById('btnSave').style.display = 'none';
        resultIdPasien = js.data && js.data.id_pasien ? js.data.id_pasien : '';
      }
    });

    // Kirim PIN ke WA (public, gunakan id_pasien)
    document.getElementById('btnSendWA').addEventListener('click', async ()=>{
      if(!resultIdPasien){ alert('Data pasien belum siap.'); return; }
      const fd = new FormData(); fd.append('id_pasien', resultIdPasien);
      const res = await fetch(baseUrl+'portal_pasien/resend_pin_ajax', {method:'POST', body:fd});
      const js  = await res.json();
      if(!js.status){ alert(js.message||'Gagal membuat link WA'); return; }
      window.open(js.wa_link, '_blank');
    });
  })();
  </script>
  <body></html>
