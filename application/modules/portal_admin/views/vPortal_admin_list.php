<!doctype html>
<html>
  <head> 
    <?php $this->theme->head('theme_default'); ?> 
    <?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>
    <style>
      select.form-control { background-color: ghostwhite; }
      .pointer { cursor:pointer; }
      .modal .form-group label { font-weight:600; }
      .input-group .btn { min-width: 110px; }
      .table-responsive { max-height:50vh; overflow-x:scroll; }
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
              <div class="page-header card">
                <div class="row align-items-end">
                  <div class="col-lg-8">
                    <div class="page-header-title"><i class="feather icon-book bg-c-blue"></i>
                      <div class="d-inline">
                        <h5>portal_admin</h5><span>Daftar Pasien (HP/WA & PIN)</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="page-header-breadcrumb">
                      <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('./'); ?>"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('portal_admin/'); ?>">portal_admin</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('portal_admin/index/'); ?>">List</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

              <div class="pcoded-inner-content">
                <div class="main-body">
                  <div class="page-wrapper">
                    <div class="page-body">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="card">
                            <!-- THIS IS WHERE THE MAIN CONTENT SHOULD BE PLACE AT -->
                            <div class="card-header">
                              <form method="get" action="<?php echo base_url('portal_admin'); ?>" class="form-inline">
                                <div class="form-group mr-2">
                                  <input type="text" class="form-control" name="q" placeholder="Cari (RM / Nama / HP / Email)" value="<?php echo html_escape($search ?? ''); ?>">
                                </div>
                                <button class="btn btn-primary">Cari</button>
                              </form>
                            </div>

                            <div class="card-block">
                              <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                  <thead class="bg-light">
                                    <tr>
                                      <th style="width:60px;">No</th>
                                      <th style="width:60px;">Edit</th>
                                      <th>No.RM</th>
                                      <th>Nama Pasien</th>
                                      <th>Portal Id</th>
                                      <th>Nomor HP/WA</th>
                                      <th>PIN</th>
                                      <th>Url Portal</th>
                                      <th>Email</th>
                                      <th>Alamat</th>
                                      <th>Kelurahan</th>
                                      <th>Kota</th>
                                      <th>Aktif</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  <?php if (!empty($rows)): $no=1; foreach($rows as $r): ?>
                                    <tr>
                                      <td><?php echo $no++; ?></td>
                                      <?php $rm = $r['no_rm']; /* sudah LPAD dari model */ ?>
																			<td class="text-center">
																				<img src="<?php echo base_url('assets/img/doc_edit.png');?>"
																						 style="max-height:20px;" class="pointer btn-edit"
																						 data-id="<?php echo html_escape($rm); ?>">
																			</td>
																			<td><?php echo html_escape($rm); ?></td>
                                      <td><?php echo html_escape($r['name']); ?></td>
                                      <td><?php echo html_escape($r['portal_id'] ?? ''); ?></td>
                                      <td><?php echo html_escape($r['hp']); ?></td>
                                      <td><?php echo html_escape($r['pin']); ?></td>
                                      <td>
                                        <?php 
                                          $pid = $r['portal_id'] ?? '';
                                          $ppin = $r['pin'] ?? '';
                                          if ($pid !== '') {
                                            $plink = base_url('portal_pasien/index/'.rawurlencode($pid).'/'.rawurlencode($ppin));
                                            echo '<small><a href="'.html_escape($plink).'" target="_blank" rel="noopener">'.html_escape($plink).'</a></small>';
                                          } else {
                                            echo '<span class="text-muted">-</span>';
                                          }
                                        ?>
                                      </td>
                                      <td><?php echo html_escape($r['email']); ?></td>
                                      <td><?php echo html_escape($r['alamat']); ?></td>
                                      <td><?php echo html_escape($r['kelurahan']); ?></td>
                                      <td><?php echo html_escape($r['kota']); ?></td>
                                      <td><?php echo (int)$r['aktif']===1?'Ya':'Tidak'; ?></td>
                                    </tr>
                                  <?php endforeach; else: ?>
                                    <tr><td colspan="13" class="text-center">Tidak ada data.</td></tr>
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

  <?php #$this->theme->script('theme_default'); ?>
  <?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-js.php');?>

  <!-- Modal Edit -->
  <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit HP/WA & PIN Pasien</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
        </div>
        <div class="modal-body">
          <form id="formEdit">
            <input type="hidden" name="id_pasien" id="id_pasien">
            <div class="form-group">
              <label>No. RM</label>
              <input type="text" class="form-control" id="no_rm" disabled>
            </div>
            <div class="form-group">
              <label>Nama Pasien</label>
              <input type="text" class="form-control" id="name" disabled>
            </div>
            <div class="form-group">
              <label>Portal Id</label>
              <input type="text" class="form-control" id="portal_id" readonly>
              <small class="text-muted">Format ddmmyyyy dari Tgl Lahir.</small>
            </div>
            <div class="form-group">
              <label>Url Portal</label>
              <div>
                <a id="portal_link" href="#" target="_blank" rel="noopener" class="d-block text-primary"></a>
              </div>
            </div>
            <!-- ubah label & id field HP -->
						<div class="form-group">
							<label>Nomor HP/WA</label>
							<input type="text" class="form-control" name="hp" id="hp" placeholder="08xxxxxxxxxx">
							<small class="text-muted">Hanya angka, boleh diawali 0 (disimpan apa adanya).</small>
						</div>
            <div class="form-group">
              <label>PIN</label>
              <div class="input-group">
                <input type="text" class="form-control" name="pin" id="pin" maxlength="6" placeholder="6 digit">
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="button" id="btnGenPin">Generate PIN</button>
                </div>
              </div>
              <small class="text-muted">Wajib 6 digit angka.</small>
            </div>
          </form>
        </div>
        <div class="modal-footer d-flex justify-content-between">
          <button type="button" class="btn btn-success" id="btnSaveSend">Save & kirim PIN</button>
          <div>
            <button type="button" class="btn btn-primary" id="btnSave">Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
  /* THIS IS WHERE THE MAIN SCRIPT SHOULD BE PLACE AT */
  (function(){
    const baseUrl = "<?php echo base_url(); ?>";
    let currentId = null;

    function randPin6(){
      return String(Math.floor(Math.random()*1000000)).padStart(6,'0');
    }

    // edit click
    document.querySelectorAll('.btn-edit').forEach(el=>{
      el.addEventListener('click', async ()=>{
        const id = el.getAttribute('data-id');
        currentId = id;
        const res = await fetch(`${baseUrl}portal_admin/get_detail_ajax/${id}`);
        const js  = await res.json();
        if(!js.status){ alert(js.message||'Gagal memuat data'); return; }
        const d = js.data;
        document.getElementById('id_pasien').value = d.id_pasien;
        document.getElementById('no_rm').value = d.no_rm || '';
        document.getElementById('name').value = d.name || '';
        document.getElementById('portal_id').value = d.portal_id || '';
        // Set portal link
        const portalLink = document.getElementById('portal_link');
        if (d.portal_id) {
          const url = `${baseUrl}portal_pasien/index/${encodeURIComponent(d.portal_id)}/${encodeURIComponent(d.pin||'')}`;
          portalLink.textContent = url;
          portalLink.setAttribute('href', url);
        } else {
          portalLink.textContent = '-';
          portalLink.setAttribute('href', '#');
        }
        document.getElementById('hp').value = d.hp || '';
        document.getElementById('pin').value = d.pin || '';
        $('#modalEdit').modal('show');
      });
    });

    // generate PIN (client-side)
    document.getElementById('btnGenPin').addEventListener('click', ()=>{
      document.getElementById('pin').value = randPin6();
    });

    async function saveAjax(openWa){
      const id_pasien = document.getElementById('id_pasien').value;
      const hp        = document.getElementById('hp').value.trim();
      const portalId  = (document.getElementById('portal_id')?.value || '').trim();
      const pin       = document.getElementById('pin').value.trim();

      const fd = new FormData();
      fd.append('id_pasien', id_pasien);
      fd.append('hp', hp);
      fd.append('pin', pin);

      const res = await fetch(`${baseUrl}portal_admin/save_contact_pin_ajax`, { method:'POST', body: fd });
      const js  = await res.json();
      if(!js.status){ alert(js.message||'Gagal simpan'); return; }

      // Jika "Save & kirim PIN": buka WhatsApp Web di tab baru
      if(openWa){
        // Format nomor ke internasional ID: 0xxxx => 62xxxx
        let phone = hp;
        if(phone.startsWith('0')) phone = '62' + phone.substring(1);
        const link = buildWaLink(phone, portalId, pin);
        window.open(link, '_blank');
      }

      // Tutup modal & refresh halaman agar list ter-update
      $('#modalEdit').modal('hide');
      location.reload();
    }

    // Template pesan WA
    function buildWaLink(phoneIntl, portal_id, pin){
      const portalUrl = `<?php echo base_url() ?>/portal_pasien/index/${encodeURIComponent(portal_id)}`;
      const lines = [
        "Salam dari Klinik LYND,",
        `berikut kami sampaikan PORTAL_ID anda adalah ${portal_id} (Sama dengan tgl. Lahir DDMMYYYY) dan PIN anda adalah ${pin},`,
        `Untuk booking bisa dilakukan di alamat ${portalUrl}`,
        "Sehat selalu",
        "'- Klinik LYND -"
      ];
      const text = encodeURIComponent(lines.join('\n'));
      return `https://web.whatsapp.com/send?phone=${encodeURIComponent(phoneIntl)}&text=${text}`;
    }

    document.getElementById('btnSave').addEventListener('click', ()=>saveAjax(false));
    document.getElementById('btnSaveSend').addEventListener('click', ()=>saveAjax(true));
  })();
  </script>
  <body></html>
