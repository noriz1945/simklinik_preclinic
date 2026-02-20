<!DOCTYPE html>
<html lang="en">
<head>
  <?php $this->theme->head('theme_default'); ?>
  <?php require_once(APPPATH.'../assets/app_hn/farmasifnc/mnu-cmp-css.php');?>
  <title><?php echo isset($title)?$title:'Penerimaan Barang'; ?></title>

  <style>
    :root{ --lynd-bg:#f6f8fb; --lynd-border:#e8edf5; --lynd-muted:#64748b; --lynd-accent:#2563eb; --lynd-accent-soft:#e8f0ff; }
    body{ background:var(--lynd-bg); }
    .card{ border:1px solid var(--lynd-border); box-shadow:0 8px 26px rgba(16,24,40,.06); border-radius:14px; }
    .page-header.card{ border-radius:14px; }
    .btn-lynd{ background:var(--lynd-accent); color:#fff; border:none; }
    .btn-lynd:hover{ filter:brightness(.95); color:#fff; }
    .pill{ display:inline-flex; align-items:center; gap:.45rem; padding:.35rem .65rem; border-radius:999px; background:var(--lynd-accent-soft); color:var(--lynd-accent); font-weight:800; }
    .help-mini{ color:var(--lynd-muted); font-size:.85rem; }

    .form-control, .select2-container--default .select2-selection--single,
    .select2-container--default .select2-selection--multiple{
      border-radius:12px !important; border:1px solid var(--lynd-border) !important; min-height:42px;
    }

    select.form-control{
      padding-top:.45rem;
      padding-bottom:.45rem;
      background-color:#fff;
    }

    .modal-xl{ max-width:1180px !important; }
    .mini-input{ min-height:38px !important; border-radius:10px !important; }
    .row-table td, .row-table th{ vertical-align:middle; }
    .disabled-block{ opacity:.55; pointer-events:none; }
    .lockbtn{ border-radius:12px; }

    /* SOH clickable row */
    .soh-row{ cursor:pointer; }
    .soh-row:hover{ background:#f3f7ff; }
    .badge-soft{
      display:inline-flex; align-items:center; justify-content:center;
      min-width:28px; height:28px; border-radius:999px;
      background:var(--lynd-accent-soft); color:var(--lynd-accent); font-weight:900;
    }
    /* ✅ Header grup di dropdown Select2 */
    .select2-results__group{
      font-weight:900;
      color:#1e40af;
      background:#eef2ff;
      padding:8px 10px;
      border-top:1px solid #dbeafe;
      border-bottom:1px solid #dbeafe;
    }
    .select2-results__option{
      padding-top:8px;
      padding-bottom:8px;
    }
    .s2-item{
      display:flex;
      justify-content:space-between;
      gap:10px;
    }
    .s2-item b{ font-weight:900; }
    .s2-item small{ color:var(--lynd-muted); }
  </style>
</head>

<body>
<?php $this->theme->wrapper_open('theme_default'); ?>

<div class="loader-bg"><div class="loader-bar"></div></div>

<div id="pcoded" class="pcoded">
  <div class="pcoded-container navbar-wrapper">
    <div class="pcoded-main-container">
      <div class="pcoded-wrapper">
        <div class="pcoded-content">

          <div class="page-header card">
            <div class="row align-items-end">
              <div class="col-lg-8">
                <div class="page-header-title">
                  <i class="feather icon-package bg-c-blue"></i>
                  <div class="d-inline">
                    <h5>Penerimaan Barang</h5>
                    <span>Input batch barang masuk + update harga terakhir ke master obat</span>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 text-right">
                <!-- ✅ tombol SOH -->
                <button class="btn btn-light" id="btnSoh" type="button" style="border-radius:12px;">
                  <i class="feather icon-activity"></i> Stok Aktif
                </button>
              </div>
            </div>
          </div>

          <div class="pcoded-inner-content">
            <div class="page-body">

              <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                  <div>
                    <h5 class="mb-0">Daftar Penerimaan</h5>
                    <div class="help-mini mt-1">
                      <span class="pill">Batch Auto</span>
                      Format: <b>A[MM][YY][00001]</b> (reset tiap ganti bulan).
                    </div>
                  </div>
                  <button class="btn btn-lynd" id="btnAdd" type="button">
                    <i class="feather icon-plus"></i> Tambah Penerimaan
                  </button>
                </div>

                <div class="card-block">
                  <!-- FILTER BAR -->
                  <div class="row mb-3">
                    <div class="col-md-3">
                      <label class="help-mini mb-1">Filter ID Batch</label>
                      <input type="text" class="form-control" id="f_id_batch" placeholder="misal: A122500001">
                    </div>
                    <div class="col-md-4">
                      <label class="help-mini mb-1">Filter Nama Obat</label>
                      <input type="text" class="form-control" id="f_obat" placeholder="misal: Havrix">
                    </div>

                    <div class="col-md-3">
                      <label class="help-mini mb-1">Filter SO Date</label>
                      <select class="form-control" id="f_so_date">
                        <option value="">Semua tanggal</option>
                      </select>
                    </div>

                    <div class="col-md-2 d-flex align-items-end" style="gap:10px;">
                      <button class="btn btn-primary w-100" id="btnFilter" type="button">Cari</button>
                      <button class="btn btn-light w-100" id="btnReset" type="button">Reset</button>
                    </div>
                  </div>

                  <div class="table-responsive">
                    <table id="tblPB" class="table table-hover table-striped" style="width:100%">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>ID Batch</th>
                          <th>Obat / Vaksin</th>
                          <th>Harga Dasar</th>
                          <th>Harga Jual</th>
                          <th>Stok Masuk</th>
                          <th>Sisa Stok</th>
                          <th>SO Date</th>
                          <th>Created</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody></tbody>
                    </table>
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

<!-- MODAL INPUT -->
<div class="modal fade" id="mdlPB" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <form id="frmPB" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Penerimaan Barang</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>

      <div class="modal-body">
        <?php if ($this->security->get_csrf_token_name()): ?>
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                 value="<?php echo $this->security->get_csrf_hash(); ?>">
        <?php endif; ?>

        <div class="row">
          <div class="col-md-4">
            <label class="mb-1">SO Date <span style="color:#ef4444">*</span></label>
            <div class="d-flex" style="gap:10px;">
              <input type="date" class="form-control" name="so_date" id="so_date" required>
              <button type="button" class="btn btn-light lockbtn" id="btnLockSo" title="Lock SO Date">
                <i class="feather icon-lock"></i>
              </button>
            </div>
            <div class="help-mini mt-1">
              Saat pilih SO Date, sistem tampilkan data existing.
              <span class="pill" style="margin-left:8px;">
                Existing: <span id="badgeExisting" style="margin-left:6px; display:none;">0</span>
              </span>
            </div>
          </div>

          <div class="col-md-3">
            <label class="mb-1">Batch Preview</label>
            <input type="text" class="form-control" id="batch_preview" value="(AUTO)" readonly>
            <div class="help-mini mt-1">Estimasi nomor mulai. Server final saat simpan.</div>
          </div>

          <div class="col-md-5">
            <label class="mb-1">Pilih Obat (multi)</label>
            <select class="form-control" id="id_obat_picker" multiple></select>
            <div class="help-mini mt-1">Obat yang sudah ada di SO Date ini tidak akan muncul di list.</div>
          </div>
        </div>

        <div class="mt-3" id="boxExisting" style="display:none;">
          <div class="help-mini mb-2"><b>Sudah diterima di SO Date ini:</b></div>
          <div class="table-responsive">
            <table class="table table-sm table-bordered">
              <thead>
                <tr>
                  <th>ID Batch</th>
                  <th>Obat</th>
                  <th>Harga Dasar</th>
                  <th>Harga Jual</th>
                  <th>Stok</th>
                  <th>Created</th>
                </tr>
              </thead>
              <tbody id="existingBody"></tbody>
            </table>
          </div>
        </div>

        <hr>

        <div class="table-responsive">
          <table class="table table-bordered row-table" id="tblItems">
            <thead>
              <tr>
                <th style="width:70px">#</th>
                <th>Obat</th>
                <th style="width:170px">Harga Dasar</th>
                <th style="width:170px">Harga Jual</th>
                <th style="width:160px">Stok Masuk</th>
                <th style="width:160px">Batch</th>
                <th style="width:90px">Hapus</th>
              </tr>
            </thead>
            <tbody>
              <tr id="emptyRow"><td colspan="7" class="text-center help-mini">Belum ada item. Pilih obat (multi) untuk membuat row.</td></tr>
            </tbody>
          </table>
        </div>

        <div class="alert alert-info mb-0" style="border-radius:12px;">
          <b>Rule:</b> Harga dasar/jual/stok <b>wajib > 0</b>.
        </div>

        <div id="msgBox" class="mt-3"></div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-lynd" id="btnSave"><i class="feather icon-save"></i> Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- MODAL BATCH RESULT -->
<div class="modal fade" id="mdlBatches" tabindex="-1">
  <div class="modal-dialog" style="max-width:720px;">
    <div class="modal-content" style="border-radius:16px;">
      <div class="modal-header">
        <h5 class="modal-title">Batch terbentuk</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <textarea id="batchList" class="form-control" rows="10" readonly style="font-family:ui-monospace,Consolas,monospace;"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- ✅ MODAL SOH (REKAP) -->
<div class="modal fade" id="mdlSoh" tabindex="-1">
  <div class="modal-dialog modal-xl" style="max-width:980px;">
    <div class="modal-content" style="border-radius:16px;">
      <div class="modal-header">
        <div>
          <h5 class="modal-title mb-0">Rekap SOH Obat (Stok Aktif)</h5>
          <div class="help-mini">Stok Aktif = SUM penerimaan - SUM pemakaian resep</div>
        </div>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>

      <div class="modal-body">
        <div class="row" style="gap:12px;">
          <div class="col-md-8">
            <input type="text" class="form-control" id="soh_q" placeholder="Cari nama / ID obat...">
          </div>
          <div class="col-md-4 d-flex" style="gap:10px;">
            <button class="btn btn-primary w-100" id="btnSohCari" type="button"><i class="feather icon-search"></i> Cari</button>
            <button class="btn btn-light w-100" id="btnSohReset" type="button">Reset</button>
          </div>
        </div>

        <div class="table-responsive mt-3">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th style="width:110px;">ID Obat</th>
                <th>Nama Obat</th>
                <th style="width:140px;" class="text-center">Stok Aktif</th>
                <th style="width:140px;" class="text-center">Type</th>
              </tr>
            </thead>
            <tbody id="sohBody">
              <tr><td colspan="4" class="text-center help-mini">Klik "Cari" untuk menampilkan data.</td></tr>
            </tbody>
          </table>
        </div>

        <div class="help-mini mt-2" id="sohCount"></div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- ✅ MODAL SOH DETAIL (BARANG DATANG & PENJUALAN) -->
<div class="modal fade" id="mdlSohDetail" tabindex="-1">
  <div class="modal-dialog" style="max-width:720px;">
    <div class="modal-content" style="border-radius:16px;">
      <div class="modal-header">
        <div>
          <h5 class="modal-title mb-0">Detail SOH Obat</h5>
          <div class="help-mini" id="sohDetailTitle">-</div>
        </div>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>

      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-bordered table-sm">
            <thead>
              <tr>
                <th style="width:160px;">name_transaksi</th>
                <th style="width:170px;">id_batch</th>
                <th style="width:120px;">id_obat</th>
                <th>qty</th>
              </tr>
            </thead>
            <tbody id="sohDetailBody">
              <tr><td colspan="4" class="text-center help-mini">Loading...</td></tr>
            </tbody>
          </table>
        </div>

        <div class="help-mini mt-2" id="sohSellInfo" style="display:none;"></div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/farmasifnc/mnu-cmp-js.php');?>

<script>
(function(){
  const urlList      = "<?php echo site_url('penerimaan_barang/list_json'); ?>";
  const urlDel       = "<?php echo site_url('penerimaan_barang/delete'); ?>/";
  const urlObat      = "<?php echo site_url('penerimaan_barang/obat_search'); ?>";
  const urlSave      = "<?php echo site_url('penerimaan_barang/save_bulk'); ?>";
  const urlNextNo    = "<?php echo site_url('penerimaan_barang/next_batch_no'); ?>";
  const urlSoDates   = "<?php echo site_url('penerimaan_barang/so_dates'); ?>";
  const urlSoItems   = "<?php echo site_url('penerimaan_barang/so_items'); ?>";

  // ✅ SOH endpoints
  const urlSohList   = "<?php echo site_url('penerimaan_barang/soh_list'); ?>";
  const urlSohDetail = "<?php echo site_url('penerimaan_barang/soh_detail'); ?>";

  function toast(html, type){
    const cls = type === 'ok' ? 'alert-success' : (type === 'warn' ? 'alert-warning' : 'alert-danger');
    $("#msgBox").html('<div class="alert '+cls+'" style="border-radius:12px; white-space:pre-line;">'+html+'</div>');
  }

  // ===== DataTable safe init =====
  let tbl = null;
  function ensureTable(){
    if ($.fn.DataTable && !tbl) {
      tbl = $("#tblPB").DataTable({
        processing:true,
        serverSide:true,
        responsive:true,
        ajax:{
          url: urlList,
          type:"POST",
          data:function(d){
            d.f_id_batch = $("#f_id_batch").val();
            d.f_obat     = $("#f_obat").val();
            d.f_so_date  = $("#f_so_date").val() || '';
          }
        },
        columnDefs:[
          { targets:[9], orderable:false, searchable:false, width:"120px",
            render:function(data,type,row){
              const id = row[9];
              return `<button type="button" class="btn btn-sm btn-danger btnDel" data-id="${id}">
                        <i class="feather icon-trash-2"></i>
                      </button>`;
            }
          }
        ]
      });
    }
    return tbl;
  }

  function reloadTable(){
    const t = ensureTable();
    if (t) t.ajax.reload();
  }

  // ✅ FILTER SO DATE (native select)
  function initSoFilter(){
    const $sel = $("#f_so_date");
    $sel.html('<option value="">Semua tanggal</option>');

    $.getJSON(urlSoDates, function(res){
      const rows = (res && res.results) ? res.results : [];
      rows.forEach(function(r){
        $sel.append(new Option(r.text, r.id, false, false));
      });
    }).fail(function(){
      console.warn("Gagal load SO Dates filter");
    });
  }

  $("#btnFilter").on('click', function(e){
    e.preventDefault();
    reloadTable();
  });

  $("#btnReset").on('click', function(e){
    e.preventDefault();
    $("#f_id_batch,#f_obat").val('');
    $("#f_so_date").val('');
    reloadTable();
  });

  $(document).on('click', '.btnDel', function(){
    const id = $(this).data('id');
    if (!confirm("Hapus data penerimaan ini?")) return;
    $.post(urlDel + id, {}, function(res){
      try{ res = (typeof res==='string') ? JSON.parse(res) : res; }catch(e){}
      if (res && res.ok) reloadTable();
      else alert(res && res.msg ? res.msg : "Gagal hapus");
    });
  });

  // ===== Modal existing badge + existing list =====
  let itemMap = {}; // key: string id_obat (mis: "00029")
  let rowSeq = 0;
  let soLocked = false;

  function lockPicker(isLocked){
    $("#id_obat_picker").prop('disabled', isLocked);
    if (isLocked) $("#id_obat_picker").parent().addClass('disabled-block');
    else $("#id_obat_picker").parent().removeClass('disabled-block');
  }

  function resetModal(){
    $("#frmPB")[0].reset();
    $("#msgBox").html('');
    $("#batch_preview").val("(AUTO)");
    $("#existingBody").html('');
    $("#boxExisting").hide();
    $("#badgeExisting").text('0').hide();

    itemMap = {}; rowSeq=0; soLocked=false;

    $("#btnLockSo").html('<i class="feather icon-lock"></i>');
    $("#so_date").prop('disabled', false);

    $("#tblItems tbody").html(`<tr id="emptyRow"><td colspan="7" class="text-center help-mini">Belum ada item. Pilih obat (multi) untuk membuat row.</td></tr>`);
    if ($.fn.select2) $("#id_obat_picker").val(null).trigger('change');
    lockPicker(true);
  }

  function initPicker(){
    if (!$.fn.select2) return;
    if ($("#id_obat_picker").hasClass("select2-hidden-accessible")) return;

    function formatObatResult(d){
      if (d.loading) return d.text;

      // header group (optgroup) => d.children ada
      if (d.children && Array.isArray(d.children)) {
        return $('<div>'+ (d.text || '') +'</div>');
      }

      // item biasa
      const txt = d.text || '';
      const parts = txt.split(' - ');
      const id = parts.shift() || '';
      const name = parts.join(' - ') || '';
      return $(
        '<div class="s2-item">' +
          '<div><b>'+ id +'</b> - '+ name +'</div>' +
        '</div>'
      );
    }

    $("#id_obat_picker").select2({
      width:'100%',
      dropdownParent: $("#mdlPB"),
      placeholder:'Cari obat...',
      multiple:true,
      closeOnSelect:false,
      templateResult: formatObatResult,
      templateSelection: function(d){ return d && d.text ? d.text : ''; },
      ajax:{
        url: urlObat,
        dataType:'json',
        delay:250,
        data:function(params){
          return { q: params.term || '', so_date: $("#so_date").val() || '' };
        },
        processResults:function(data){
          // data sudah grouped dari backend: {results:[{text, children:[...]}]}
          return data;
        }
      }
    }).on('select2:select', function(e){ addRowFromObat(e.params.data||{}); })
      .on('select2:unselect', function(e){ removeRowByObatId((e.params.data||{}).id); });
  }

  function updatePreviewNo(){
    const so = $("#so_date").val();
    if (!so) { $("#batch_preview").val("(AUTO)"); return; }
    $.getJSON(urlNextNo, { so_date: so }, r => r && r.ok && $("#batch_preview").val("Next: " + r.next));
  }

  function loadExistingSoItems(so){
    $("#boxExisting").hide();
    $("#existingBody").html('');
    $("#badgeExisting").text('0').hide();
    if (!so) return;

    $.getJSON(urlSoItems, { so_date: so }, function(res){
      if (!res || !res.ok) return;
      const rows = res.rows || [];
      const cnt  = res.count || rows.length || 0;

      $("#badgeExisting").text(String(cnt)).show();
      if (rows.length < 1) return;

      let html = '';
      rows.forEach(r=>{
        html += `
          <tr>
            <td><b>${r.id_batch}</b></td>
            <td>${r.nama_obat || ''}</td>
            <td>${Number(r.harga_dasar||0).toLocaleString('id-ID')}</td>
            <td>${Number(r.harga_jual||0).toLocaleString('id-ID')}</td>
            <td>${Number(r.stok_masuk||0).toLocaleString('id-ID')}</td>
            <td>${r.created_at || ''}</td>
          </tr>
        `;
      });
      $("#existingBody").html(html);
      $("#boxExisting").show();
    });
  }

  // ✅ PATCH: id obat HARUS STRING, jangan parseInt (biar leading zero aman)
  function addRowFromObat(d){
    const id = String(d.id || '').trim(); // "00029"
    if (!id || itemMap[id]) return;

    $("#emptyRow").remove();

    rowSeq++;
    const rid = "row_" + rowSeq;
    itemMap[id] = rid;

    const hna1 = parseInt(d.hna1 || 0, 10);
    const sale = parseInt(d.sale_price || 0, 10);

    $("#tblItems tbody").append(`
      <tr id="${rid}">
        <td class="text-center">${rowSeq}</td>
        <td>
          <div style="font-weight:800">${d.text || (id + ' - obat')}</div>
          <input type="hidden" name="id_obat[]" value="${id}">
        </td>
        <td><input type="number" class="form-control mini-input" name="harga_dasar[]" value="${hna1}" min="1" step="1" required></td>
        <td><input type="number" class="form-control mini-input" name="harga_jual[]" value="${sale}" min="1" step="1" required></td>
        <td><input type="number" class="form-control mini-input" name="stok_masuk[]" value="1" min="1" step="1" required></td>
        <td class="help-mini">AUTO (server)</td>
        <td class="text-center">
          <button type="button" class="btn btn-sm btn-light btnRemoveRow" data-obat="${id}">
            <i class="feather icon-x"></i>
          </button>
        </td>
      </tr>
    `);
  }

  // ✅ PATCH: id obat STRING
  function removeRowByObatId(id){
    id = String(id || '').trim();
    if (!id || !itemMap[id]) return;

    $("#"+itemMap[id]).remove();
    delete itemMap[id];

    if (Object.keys(itemMap).length === 0) {
      $("#tblItems tbody").html(`<tr id="emptyRow"><td colspan="7" class="text-center help-mini">Belum ada item. Pilih obat (multi) untuk membuat row.</td></tr>`);
    }
  }

  $(document).on('click', '.btnRemoveRow', function(){
    const id = String($(this).data('obat') || '').trim();
    removeRowByObatId(id);

    const vals = $("#id_obat_picker").val() || [];
    $("#id_obat_picker").val(vals.filter(v => String(v) !== String(id))).trigger('change');
  });

  $("#btnLockSo").on('click', function(){
    const so = $("#so_date").val();
    if (!so) { toast("Pilih SO Date dulu sebelum lock.", "warn"); return; }

    if (!soLocked) {
      soLocked = true;
      $("#so_date").prop('disabled', true);
      $("#btnLockSo").html('<i class="feather icon-unlock"></i>');
      toast("SO Date terkunci.", "ok");
    } else {
      if (!confirm("Unlock SO Date akan menghapus item yang sudah dipilih. Lanjutkan?")) return;
      soLocked = false;
      $("#so_date").prop('disabled', false);
      $("#btnLockSo").html('<i class="feather icon-lock"></i>');

      $("#id_obat_picker").val(null).trigger('change');
      itemMap = {}; rowSeq=0;
      $("#tblItems tbody").html(`<tr id="emptyRow"><td colspan="7" class="text-center help-mini">Belum ada item. Pilih obat (multi) untuk membuat row.</td></tr>`);
      lockPicker(false);
      toast("SO Date dibuka.", "warn");
    }
  });

  $("#so_date").on('change', function(){
    if (soLocked) return;
    const so = $(this).val();
    if (!so) { lockPicker(true); $("#batch_preview").val("(AUTO)"); loadExistingSoItems(''); return; }

    lockPicker(false);
    updatePreviewNo();

    $("#id_obat_picker").val(null).trigger('change');
    itemMap = {}; rowSeq=0;
    $("#tblItems tbody").html(`<tr id="emptyRow"><td colspan="7" class="text-center help-mini">Belum ada item. Pilih obat (multi) untuk membuat row.</td></tr>`);
    loadExistingSoItems(so);
  });

  $("#btnAdd").on('click', function(){
    resetModal();
    $("#mdlPB").modal({backdrop:'static', keyboard:true});
    initPicker();
  });

  $("#frmPB").on('submit', function(e){
    e.preventDefault();

    const so = $("#so_date").val();
    if (!so) { toast("SO Date wajib diisi.", "err"); return; }
    if (Object.keys(itemMap).length < 1) { toast("Pilih minimal 1 obat.", "err"); return; }

    let bad = false;
    $("#tblItems tbody input[type=number]").each(function(){
      if (parseFloat($(this).val()||0) <= 0) bad = true;
    });
    if (bad) { toast("Harga dasar/jual/stok wajib > 0.", "err"); return; }

    $("#btnSave").prop('disabled', true);
    let hiddenSo = null;
    if ($("#so_date").is(':disabled')) {
      hiddenSo = $('<input type="hidden" name="so_date">').val(so);
      $("#frmPB").append(hiddenSo);
    }

    $.ajax({
      url: urlSave, type:'POST', data: $(this).serialize(),
      success:function(res){
        try{ res = (typeof res==='string') ? JSON.parse(res) : res; }catch(e){}
        if (res && res.ok) {
          toast(res.msg || "Tersimpan.", "ok");
          reloadTable();

          $("#batchList").val((res.batches||[]).join("\n"));
          $("#mdlBatches").modal('show');
          setTimeout(()=>$("#mdlPB").modal('hide'), 450);
        } else {
          toast(res && res.msg ? res.msg : "Gagal simpan.", "err");
        }
      },
      error:function(){ toast("Server error saat simpan.", "err"); },
      complete:function(){
        if (hiddenSo) hiddenSo.remove();
        $("#btnSave").prop('disabled', false);
      }
    });
  });

  /** ===========================
   *  SOH UI + Detail UI
   *  =========================== */

  function renderSohRows(rows){
    const $b = $("#sohBody");
    if (!rows || rows.length < 1){
      $b.html(`<tr><td colspan="4" class="text-center help-mini">Tidak ada data.</td></tr>`);
      $("#sohCount").text("Menampilkan 0 item");
      return;
    }

    let html = '';
    rows.forEach(r=>{
      const id = String(r.id_obat||'');
      const nm = String(r.nama_obat||'');
      const stok = parseInt(r.stok_aktif||0, 10);
      const tipe = String(r.tipe_text||'');
      html += `
        <tr class="soh-row" data-id="${id}" data-name="${nm}">
          <td><b>${id}</b></td>
          <td>${nm}</td>
          <td class="text-center"><span class="badge-soft">${stok}</span></td>
          <td class="text-center">${tipe}</td>
        </tr>
      `;
    });
    $b.html(html);
    $("#sohCount").text("Menampilkan " + rows.length + " item");
  }

  function loadSohList(){
    const q = $("#soh_q").val() || '';
    $("#sohBody").html(`<tr><td colspan="4" class="text-center help-mini">Loading...</td></tr>`);
    $("#sohCount").text("");

    $.getJSON(urlSohList, { q:q }, function(res){
      if (!res || !res.ok) {
        renderSohRows([]);
        return;
      }
      renderSohRows(res.rows || []);
    }).fail(function(){
      renderSohRows([]);
    });
  }

  $("#btnSoh").on('click', function(){
    $("#soh_q").val('');
    $("#sohBody").html(`<tr><td colspan="4" class="text-center help-mini">Klik "Cari" untuk menampilkan data.</td></tr>`);
    $("#sohCount").text("");
    $("#mdlSoh").modal('show');
  });

  $("#btnSohCari").on('click', function(){ loadSohList(); });
  $("#btnSohReset").on('click', function(){
    $("#soh_q").val('');
    loadSohList();
  });

  $(document).on('click', '.soh-row', function(){
    const id_obat = $(this).data('id');
    const nm = $(this).data('name') || '';
    $("#sohDetailTitle").text(id_obat + " - " + nm);
    $("#sohDetailBody").html(`<tr><td colspan="4" class="text-center help-mini">Loading...</td></tr>`);
    $("#sohSellInfo").hide().text('');

    $("#mdlSohDetail").modal('show');

    $.getJSON(urlSohDetail, { id_obat: id_obat }, function(res){
      if (!res || !res.ok){
        $("#sohDetailBody").html(`<tr><td colspan="4" class="text-center text-danger">Gagal load detail</td></tr>`);
        return;
      }

      const obat = res.obat || {};
      const datang = res.barang_datang || {};
      const jual = res.penjualan || {};

      const id_batch = datang.id_batch ? datang.id_batch : '-';
      const qty_in = parseInt(datang.qty || 0, 10);

      const qty_out = parseInt(jual.qty || 0, 10);
      const lastSell = jual.last_sell ? jual.last_sell : '-';

      let html = '';
      html += `
        <tr>
          <td><b>barang_datang</b></td>
          <td>${id_batch}</td>
          <td>${obat.id_obat || id_obat}</td>
          <td>${qty_in}</td>
        </tr>
      `;
      html += `
        <tr>
          <td><b>penjualan</b></td>
          <td>-</td>
          <td>${obat.id_obat || id_obat}</td>
          <td>${qty_out}</td>
        </tr>
      `;

      $("#sohDetailBody").html(html);
      $("#sohDetailTitle").text((obat.id_obat||id_obat) + " - " + (obat.nama||nm) + " (" + (obat.tipe||'-') + ")");

      $("#sohSellInfo").show().html(
        `Tanggal terakhir penjualan: <b>${lastSell}</b>`
      );
    }).fail(function(){
      $("#sohDetailBody").html(`<tr><td colspan="4" class="text-center text-danger">Server error</td></tr>`);
    });
  });

  $(function(){
    initSoFilter();
    ensureTable();
  });

})();
</script>

</body>
</html>
