<?php
/**
 * Farmasi View (UI Redesign Only)
 * - Controller/Model/AJAX engine tetap sama (script di bawah dipertahankan).
 * - ID/selector penting dipertahankan supaya fungsi existing tidak berubah.
 */
?>
<a href="#!" onclick="javascript:toggleFullScreen()"></a>
<input type="hidden" id="id_reg" name="id_reg" value="<?php echo $id_reg; ?>" class="hidden">
<input type="hidden" id="id_pasien" name="id_pasien" value="<?php echo $id_pasien; ?>" class="hidden">
<input type="text" id="ideresepset" name="ideresepset" value="<?php echo $id_eresep; ?>" readonly hidden>
<input type="text" id="tuslahset" name="tuslahset" value="<?php echo $tuslah; ?>" readonly hidden>
<input type="text" id="racikset" name="racikset" value="<?php echo $racik; ?>" readonly hidden>
<style>
  :root{
    --fx-bg:#f6f9fb;
    --fx-card:#fff;
    --fx-text:#111827;
    --fx-muted:#6b7280;
    --fx-line:#e5e7eb;
    --fx-brand:#0f6b43;
    --fx-brand-2:#0ea37a;
    --fx-shadow:0 8px 24px rgba(15,23,42,.08);
    --fx-radius:14px;
  }
  .farmasi-wrap{background:var(--fx-bg); padding: 8px 0 18px;}
  .fx-card{background:var(--fx-card); border:1px solid rgba(229,231,235,.9); border-radius:var(--fx-radius); box-shadow:var(--fx-shadow);}
  .fx-card .card-header{background:transparent; border-bottom:1px solid var(--fx-line); padding:12px 14px; border-top-left-radius:var(--fx-radius); border-top-right-radius:var(--fx-radius);}
  .fx-card .card-header h5{margin:0; font-weight:800; color:var(--fx-text);}
  .fx-card .card-block{padding:14px;}
  /* header pasien */
  .fx-patient{position:sticky; top:0; z-index:40; margin-bottom:12px;}
  .fx-topbar{display:flex; gap:12px; align-items:center; justify-content:space-between; flex-wrap:wrap;}
  .fx-pill{display:inline-flex; align-items:center; gap:8px; padding:6px 10px; border-radius:999px; border:1px solid var(--fx-line); background:#fff; font-size:12px; color:var(--fx-text); white-space:nowrap;}
  .fx-pill b{font-weight:800;}
  .fx-total{display:flex; align-items:center; gap:10px; justify-content:flex-end;}
  .fx-total .label{display:inline-block; padding:10px 14px; border-radius:12px; background:linear-gradient(135deg,var(--fx-brand-2),var(--fx-brand)); color:#fff; font-weight:900; font-size:22px; min-width:190px; text-align:left;}
  .fx-total small{display:block; color:var(--fx-muted); font-weight:700;}
  .fx-soap{margin-top:10px; border-top:1px dashed var(--fx-line); padding-top:10px;}
  .fx-soap-toggle{cursor:pointer; user-select:none; display:flex; align-items:center; justify-content:space-between; color:var(--fx-muted); font-weight:800; font-size:13px;}
  .fx-soap-body{display:none; margin-top:10px;}
  .fx-soap-grid{display:grid; grid-template-columns:130px 1fr; gap:8px 12px; font-size:13px; color:var(--fx-text);}
  .fx-soap-grid .k{color:var(--fx-muted); font-weight:800;}
  .fx-soap-grid .v{color:var(--fx-text);}
  /* workbar */
  .fx-workbar{display:flex; align-items:center; justify-content:space-between; gap:10px; flex-wrap:wrap; margin:10px 0 12px;}
  .fx-title{font-weight:900; color:var(--fx-text); display:flex; align-items:center; gap:10px; flex-wrap:wrap;}
  .fx-actions{display:flex; gap:8px; flex-wrap:wrap; justify-content:flex-end;}
  .fx-btn{border-radius:12px; padding:8px 12px; border:1px solid var(--fx-line); background:#fff; color:var(--fx-text); font-weight:800; cursor:pointer;}
  .fx-btn-primary{background:linear-gradient(135deg,var(--fx-brand-2),var(--fx-brand)); color:#fff; border:none;}
  .fx-btn-secondary{background:#111827; color:#fff; border:none;}
  .fx-badge{display:inline-flex; align-items:center; gap:6px; border-radius:999px; padding:4px 8px; font-size:11px; font-weight:900; border:1px solid var(--fx-line); background:#fff; color:var(--fx-muted);}
  .fx-badge.ok{border-color:rgba(16,185,129,.35); color:#059669; background:rgba(16,185,129,.08);}
  .fx-badge.warn{border-color:rgba(245,158,11,.35); color:#b45309; background:rgba(245,158,11,.10);}
  .fx-badge.info{border-color:rgba(59,130,246,.35); color:#2563eb; background:rgba(59,130,246,.10);}
  /* table */
  .fx-table{width:100%; border-collapse:separate; border-spacing:0; overflow:hidden; border-radius:12px;}
  .fx-table thead th{background:var(--fx-brand); color:#fff; font-weight:900; font-size:12px; padding:10px 10px; border:none; white-space:nowrap;}
  .fx-table tbody td{background:#fff; border-top:1px solid var(--fx-line); font-size:12.5px; color:var(--fx-text); padding:10px 10px; vertical-align:middle;}
  .fx-table tbody tr:hover td{background:#f9fafb;}
  .fx-action{text-align:center; width:70px;}
  .fx-icon{font-size:16px;}
  .fx-table input.form-control{height:34px; padding:6px 8px; border-radius:10px;}
  /* drawer styleSelector */
  #styleSelector{
    position:fixed; top:70px; right:14px;
    width:380px; max-width:calc(100vw - 24px);
    background:#fff; border:1px solid var(--fx-line);
    border-radius:16px; box-shadow:var(--fx-shadow);
    z-index:9999; overflow:hidden;
    transform:translateX(110%); transition:transform .25s ease;
  }
  #styleSelector.fx-open{transform:translateX(0);}
  #styleSelector .selector-toggle{display:none;}
  #styleSelector .card-header{border-bottom:1px solid var(--fx-line); padding:12px 14px; background:#fff;}
  #styleSelector .card-header h5{margin:0; font-weight:900; color:var(--fx-text);}
  #styleSelector .fx-drawer-body{padding:12px 14px;}
  #styleSelector .fx-drawer-footer{padding:12px 14px; border-top:1px solid var(--fx-line); display:flex; gap:10px;}
  #styleSelector .fx-drawer-footer .btn{border-radius:12px; font-weight:900;}
  .fx-drawer-close{width:38px; height:38px; border-radius:12px; border:1px solid var(--fx-line); background:#fff; display:flex; align-items:center; justify-content:center; cursor:pointer;}
  .fx-drawer-close:hover{background:#f9fafb;}
  /* nicer racikan header row */
  #tbody_draft_resep_racikdataview tr#row_racikan_n td{background:rgba(14,163,122,.10) !important; border-top-color:rgba(14,163,122,.20);}
  /* ===== PATCH: Susulan pakai MODAL (bukan drawer/collapse) ===== */
  .fx-modal-susulan .modal-dialog{max-width:520px;}
  .fx-modal-susulan .modal-content{border-radius:16px; overflow:hidden;}
  .fx-modal-susulan .modal-header{border-bottom:1px solid var(--fx-line);}
  .fx-modal-susulan .modal-title{font-weight:900;}
  .fx-modal-susulan .modal-body{background:#fff;}
  .fx-modal-susulan .modal-footer{border-top:1px solid var(--fx-line);}
  /* styleSelector jadi kontainer form di modal */
  .fx-modal-susulan #styleSelector{
    position:static !important; top:auto !important; right:auto !important;
    width:100% !important; max-width:100% !important;
    border:0 !important; border-radius:0 !important; box-shadow:none !important;
    transform:none !important; transition:none !important;
  }
  .fx-modal-susulan #styleSelector.fx-open{transform:none !important;}
  .fx-modal-susulan #styleSelector .selector-toggle{display:none !important;}
</style>
<div class="farmasi-wrap">
  <div class="row fx-patient">
    <div class="col-sm-12">
      <div class="fx-card">
        <div class="card-header">
          <div class="fx-topbar">
            <div style="display:flex; gap:10px; flex-wrap:wrap; align-items:center;">
              <span class="fx-pill"><b>No. RM</b> <?php echo $id_pasien; ?></span>
              <span class="fx-pill"><b>Nama</b> <?php echo $name; ?></span>
              <span class="fx-pill"><b>NIK</b> <?php echo $id_ktp; ?></span>
              <span class="fx-pill"><b>No. Reg</b> <?php echo $id_reg; ?></span>
              <span class="fx-pill"><b>Waktu</b> <?php echo $regdate; ?></span>
              <span class="fx-pill"><b>Asuransi</b> <?php echo $nama_asuransi; ?></span>
              <span class="fx-pill"><b>Dokter</b> <?php echo $nama_dokter; ?></span>
            </div>
            <div class="fx-total">
              <div style="text-align:right;">
                <small>Total Tagihan</small>
                <p class="label total_tagihan_set" style="margin:0;"></p>
              </div>
            </div>
          </div>
          <div class="fx-soap">
            <div class="fx-soap-toggle" id="fxSoapToggle">
              <span>SOAP (klik untuk lihat/sembunyikan)</span>
              <span class="fx-badge info">opsional</span>
            </div>
            <div class="fx-soap-body" id="fxSoapBody">
              <div class="fx-soap-grid">
                <div class="k">Subjective</div><div class="v"><?php echo $subjective; ?></div>
                <div class="k">Objective</div><div class="v"><?php echo $objective; ?></div>
                <div class="k">Assessment</div><div class="v"><?php echo $assesment; ?></div>
                <div class="k">Planning</div><div class="v"><?php echo $planning; ?></div>
              </div>
            </div>
          </div>
        </div><!--/header-->
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="fx-workbar">
        <div class="fx-title">
          <span class="fx-badge ok">PROSES FARMASI</span>
          <span style="color:var(--fx-muted); font-weight:800;">Draft (kiri) → Validasi (kanan)</span>
        </div>
        <div class="fx-actions">
          <button type="button" class="fx-btn fx-btn-primary" id="fxOpenDrawer">+ Tambah Obat Susulan</button>
          <button type="button" class="fx-btn fx-btn-secondary" id="fxOpenRacikan" data-toggle="modal" data-target="#modal_racikan">+ Input Racikan</button>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6">
      <div class="fx-card">
        <div class="card-header">
          <div style="display:flex; align-items:center; justify-content:space-between; gap:10px;">
            <h5>Tambah / Edit Resep (Draft)</h5>
            <span class="fx-badge warn">edit qty di tabel</span>
          </div>
        </div>
        <div class="card-block">
          <form method="POST" id="formobtnrck">
            <input type="hidden" id="ideresep" name="ideresep" value="<?php echo $id_eresep; ?>" class="hidden">
            <div class="fx-card" style="box-shadow:none; border:1px solid var(--fx-line);">
              <div class="card-header">
                <div style="display:flex; align-items:center; justify-content:space-between; gap:10px;">
                  <h5>Obat Non-Racikan</h5>
                  <span class="fx-badge info">klik ✔ untuk validasi</span>
                </div>
              </div>
              <div class="card-block" style="padding:12px;">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped fx-table styled-table">
                    <thead>
                      <tr>
                        <th class="fx-action">Validasi</th>
                        <th>Obat</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                        <th>Dosis</th>
                        <th>Frekwensi</th>
                        <th>Waktu</th>
                        <th>Keterangan</th>
                        <th>Harga Satuan</th>
                        <th>Sub Total</th>
                        <th class="fx-action">Hapus</th>
                      </tr>
                    </thead>
                    <tbody id="tbody_draft_resep_non_racikdataview"></tbody>
                    <tbody id="tbody_draft_resep_non_racik"></tbody>
                  </table>
                </div>
                <div style="display:flex; gap:10px; justify-content:flex-start; margin-top:10px; flex-wrap:wrap;">
                  <button type="submit" class="btn btn-success" id="butt_simpan_resep" style="border-radius:12px; font-weight:900;">Simpan</button>
                  <button type="button" class="btn btn-danger hidden" id="batal_new_eresep"
                    onClick="javascript: batalkan_resep('<?php echo $id_reg; ?>');"
                    style="border-radius:12px; font-weight:900;">BATAL</button>
                </div>
              </div>
            </div>
          </form>
          <form method="POST" id="formobtrck" style="margin-top:12px;">
            <input type="hidden" id="id_reg_rck" name="id_reg_rck" value="<?php echo $id_reg; ?>">
            <input type="hidden" id="id_pasien" name="id_pasien" value="<?php echo $id_pasien; ?>" class="hidden">
            <input type="text" id="ideresep_rck" name="ideresep_rck" value="<?php echo $id_eresep; ?>" readonly hidden>
            <div class="fx-card" style="box-shadow:none; border:1px solid var(--fx-line);">
              <div class="card-header">
                <div style="display:flex; align-items:center; justify-content:space-between; gap:10px;">
                  <h5>Obat Racikan</h5>
                  <span class="fx-badge warn">Racikan</span>
                </div>
              </div>
              <div class="card-block" style="padding:12px;">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped fx-table styled-table">
                    <thead>
                      <tr>
                        <th class="fx-action">Validasi</th>
                        <th>Obat</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                        <th>Dosis</th>
                        <th>Frekwensi</th>
                        <th>Waktu</th>
                        <th>Kemasan</th>
                        <th>Harga Satuan</th>
                        <th>Sub Total</th>
                        <th>Keterangan</th>
                        <th class="fx-action">Hapus</th>
                      </tr>
                    </thead>
                    <tbody id="tbody_draft_resep_racikdataview"></tbody>
                    <tbody id="tbody_draft_resep_racikan"></tbody>
                  </table>
                </div>
              </div>
            </div>
          </form>
          <input type="hidden" id="det_subtotal" name="det_subtotal" value="<?php echo $totalall; ?>">
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="fx-card">
        <div class="card-header">
          <div style="display:flex; align-items:center; justify-content:space-between; gap:10px;">
            <h5>Validasi</h5>
            <span class="fx-badge ok">klik ✖ untuk cancel</span>
          </div>
        </div>
        <div class="card-block">
          <div class="fx-card" style="box-shadow:none; border:1px solid var(--fx-line); margin-bottom:12px;">
            <div class="card-header">
              <div style="display:flex; align-items:center; justify-content:space-between; gap:10px;">
                <h5>Obat Non-Racikan (Tervalidasi)</h5>
                <span class="fx-badge ok">final</span>
              </div>
            </div>
            <div class="card-block" style="padding:12px;">
              <div class="table-responsive">
                <table class="table table-bordered fx-table styled-table">
                  <thead>
                    <tr>
                      <th class="fx-action">Cancel</th>
                      <th>Obat</th>
                      <th>ID Batch</th>
                      <th>Jenis</th>
                      <th>Jumlah</th>
                      <th>Dosis</th>
                      <th>Frekwensi</th>
                      <th>Waktu</th>
                      <th>Harga Satuan</th>
                      <th>Sub Total</th>
                      <th>Keterangan</th>
                    </tr>
                  </thead>
                  <tbody id="list_detail_obat_non_racikan"></tbody>
                </table>
              </div>
              <div id="total" style="font-weight:900; color:var(--fx-text); padding-top:8px;"></div>
            </div>
          </div>
          <div class="fx-card" style="box-shadow:none; border:1px solid var(--fx-line);">
            <div class="card-header">
              <div style="display:flex; align-items:center; justify-content:space-between; gap:10px;">
                <h5>Obat Racikan (Tervalidasi)</h5>
                <span class="fx-badge ok">final</span>
              </div>
            </div>
            <div class="card-block" style="padding:12px;">
              <div class="table-responsive">
                <form id="frm_draft_pick">
                  <table class="table table-bordered table-hover table-striped fx-table styled-table">
                    <thead>
                      <tr>
                        <th class="fx-action">Cancel</th>
                        <th>Obat</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                        <th>Dosis</th>
                        <th>Frekwensi</th>
                        <th>Waktu</th>
                        <th>Kemasan</th>
                        <th>Harga Satuan</th>
                        <th>Sub Total</th>
                        <th>Keterangan</th>
                      </tr>
                    </thead>
                    <tbody id="list_detail_obat_racikan"></tbody>
                  </table>
                </form>
              </div>
              <div id="total_racik" style="font-weight:900; color:var(--fx-text); padding-top:8px;"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ===== PATCH: MODAL INPUT OBAT SUSULAN ===== -->
<div class="modal fade fx-modal-susulan" id="modal_susulan" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="true" style="z-index:1200;">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Input Obat Susulan (Non-Racikan)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Engine existing tetap render form ke #styleSelector -->
        <div id="styleSelector"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<!-- ===== /PATCH: MODAL INPUT OBAT SUSULAN ===== -->
<div class="modal fade" id="modal_racikan" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" style="z-index: 1100;">
 <div class="modal-dialog modal-lg" role="document" style="max-width:auto;">
 <div class="modal-content">
 <div class="modal-header">
 <h4 class="modal-title">INPUT RACIKAN</h4>
 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
 <span aria-hidden="true">&times;</span>
 </button>
 </div>
 <div class="modal-body">
 <!--<h5>Default Modal</h5>-->
 <!--racikan set-->
 <div class="card table-card">
 <div class="card-block">
           <!-- DIV TENTANG RACIKAN -->
           <div class="col-sm-12" style="margin-top:5px; border:#CCC thin solid; padding-top:5px;">
              <h5 class="p-20 z-depth-top-0">Form obat untuk diracik : </h5>
              <div class="col-sm-12" style="margin-top:5px; border:#CCC thin solid; padding-top:5px;">
                <div class="col-sm-10">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Obat</label>
                    <div class="col-sm-9">
                      <div class="ui-widget">
                        <input id="frm_obat" class="form-control" placeholder="Ketik nama obat">
                        <input type="hidden" id="frm_id_fa" name="frm_id_fa" class="hidden" style="z-index:9999">
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jenis</label>
                    <div class="col-sm-9">
                      <input id="frm_jenis_obat" name="frm_jenis_obat" class="form-control" readonly>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jumlah per Obat</label>
                    <div class="col-sm-9">
                      <input id="frm_qty" name="frm_qty" class="form-control">
                    </div>
                  </div>
                  <!--
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Dosis</label>
                        <div class="col-sm-9">
                          <div class="ui-widget">
                            <input id="frm_dosis" name="frm_dosis" class="form-control">
                          </div>
                        </div>
                      </div>
                      -->
                </div>
                <div class="form-group row" style="margin-top:10px;">
                  <div class="col-sm-12">
                    <button type="button" class="btn btn-secondary" id="addrow_to_racikan">Masukan ke
                      racikan</button>
                  </div>
                </div>
              </div>
              <!-- TABLE racikan sementara -->
              <form id="temp_racikan_di_modal">
                <div class="table-responsive" style=" border:#CCC thin solid; max-width:900px">
                  <table class="table table-bordered table-hover table-striped table-responsive styled-table" style="background-color:white;">
                    <tbody id="tbody_draft_racikan">
                      <tr>
                        <th scope="col">Obat</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Satuan</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col">hapus</th>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </form>
              <h5 class="p-20 z-depth-top-0" style="margin-top:20px;">Detail Racikan : </h5>
              <div class="col-sm-12" style="margin-top:5px; border:#CCC thin solid; padding-top:5px;">
                <div class="col-sm-12">
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Nama Racikan</label>
                    <div class="col-sm-8">
                      <input id="nama_racikan" name="nama_racikan" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Instruksi kemasan</label>
                    <div class="col-sm-8">
                      <label class="radio-inline">
                        <input type="radio" class="form-control" name="kemasan" value="Syrup">Syrup
                      </label>
                      <label class="radio-inline">
                        <input type="radio" class="form-control" name="kemasan" value="Kapsul">Kapsul
                      </label>
                      <label class="radio-inline">
                        <input type="radio" class="form-control" name="kemasan" value="Pulveres">Pulveres
                      </label>&nbsp;&nbsp;
                      <label class="radio-inline">
                        <input type="radio" class="form-control" name="kemasan" value="Pulveres dtd">Pulveres dtd
                      </label>&nbsp;&nbsp;
                      <label class="radio-inline">
                        <input type="radio" class="form-control" name="kemasan" value="Salep">Salep
                      </label>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Jumlah Racikan</label>
        <div class="col-sm-8">
                      <div class="ui-widget">
                        <input id="jumlah_tpl" name="jumlah_tpl" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Dosis</label>
                    <div class="col-sm-8">
                      <div class="ui-widget">
                        <input id="dosis_tpl" name="dosis_tpl" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Frekwensi</label>
                    <div class="col-sm-8">
                      <input id="frekwensi_tpl" name="frekwensi_tpl" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Waktu/Cara Pemberian</label>
                    <div class="col-sm-8">
                      <input id="tme_tpl" name="tme_tpl" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Keterangan</label>
                    <div class="col-sm-8">
                      <div class="ui-widget">
                        <input id="note_tpl" name="note_tpl" class="form-control">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end DIV TENTANG RACIKAN -->
 </div>
 </div>
 <!--end racikan set-->
 <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" onClick="javascript: test_temp();">Test Array</button> -->
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal/Tutup</button>
            <button type="button" class="btn btn-primary" id="add_racikan_to_resep">Masukan ke Resep</button>
          </div>
 </div>
 </div>
 </div>
 </div>
<!--END MODAL SEGMENT 4-->
    <input type="hidden" id="id_num" value="0">
    <input type="hidden" id="num_resep_racikan" value="0">
<script>
/* =========================
   UI helper (non-engine)
   ========================= */
(function(){
  // SOAP collapse
  $(document).on('click', '#fxSoapToggle', function(){
    $('#fxSoapBody').slideToggle(150);
  });
  function openSusulanModal(){
    // pastikan form sudah ada sebelum buka
    try{ if($('#styleSelector').is(':empty')){ /* will be filled by engine below */ } }catch(e){}
    if(typeof $ !== 'undefined' && $.fn && $.fn.modal){
      $('#modal_susulan').modal('show');
      setTimeout(function(){ try{ if($('#obat').length){ $('#obat').focus(); } }catch(e){} }, 250);
      return;
    }
    if(window.bootstrap && document.getElementById('modal_susulan')){
      try { new bootstrap.Modal(document.getElementById('modal_susulan')).show(); } catch(err){}
    }
  }
  function closeSusulanModal(){
    try{ $('#modal_susulan').modal('hide'); }catch(e){}
  }
  // open from toolbar (support engine lama)
  $(document).on('click', '#fxOpenDrawer', function(e){
    e.preventDefault();
    openSusulanModal();
  });function showRacikanModal(){
    closeSusulanModal();
    if(typeof $ !== 'undefined' && $.fn && $.fn.modal){
      $('#modal_racikan').modal('show');
      return;
    }
    if(window.bootstrap && document.getElementById('modal_racikan')){
      try { new bootstrap.Modal(document.getElementById('modal_racikan')).show(); } catch(err){}
    }
  }
  $(document).on('click', '#fxOpenRacikan', function(e){
    e.preventDefault();
    showRacikanModal();
  });
  $(document).on('click', '#fxDrawerOpenRacikan', function(e){
    e.preventDefault();
    showRacikanModal();
  });
  // esc close
  $(document).on('keydown', function(e){
    if(e.key === 'Escape') closeSusulanModal();
  });
  })();
///////////////////////////////////////////////// 
var baseUrl = window.location.origin + '/' + window.location.pathname.split ('/') [1] + '/';
 //Format uang
 formatMoney();
  function formatMoney(amount, decimalCount = 0/*ganti 2 kalo mau pake decimal*/, decimal = ".", thousands = ",") {
  try {
    decimalCount = Math.abs(decimalCount);
    decimalCount = isNaN(decimalCount) ? 2 : decimalCount;
  const negativeSign = amount < 0 ? "-" : "";
  let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
  let j = (i.length > 3) ? i.length % 3 : 0;
    return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
  } catch (e) {
    console.log(e)
  }
 };
 //End Format uang
 $( document ).ready(function() {
    detailnonobatracikan();
    detailobatracikan();
    list_detail_obat_nonracikan();
    list_detail_obat_racikan();
    findtotaltagihan();
 });
 function findtotaltagihan(){
  var id_eresep = $("#ideresepset").val();
  $.ajax({
    url : baseUrl+"penjualan_obat/eresep_bypass/data_totaltagihan",
    method : "POST",
    data : {id_eresep:id_eresep},
    async : true,
    dataType : 'json',
    success: function(datarestind){
        $('.total_tagihan_set').html(formatMoney(datarestind.totalall,0));
      }
    });
 }
//list set
//segment left
function detailnonobatracikan(){
  var id_eresep = $("#ideresepset").val();
  $.ajax({
    url : baseUrl+"penjualan_obat/eresep_bypass/detailobatnonracikan",
    method : "POST",
    data : {id_eresep:id_eresep},
    async : true,
    dataType : 'json',
    success: function(datareslistobat){
    var iresobat;
    var racikanset ="";
    for (iresobat = 0; iresobat < datareslistobat.length; iresobat++) {
        var id_eresep_det        = datareslistobat[iresobat].id_eresep_det;
        var name                 = datareslistobat[iresobat].name;
        var jenis_obat           = datareslistobat[iresobat].jenis_obat;
        var id_trx_det           = datareslistobat[iresobat].id_trx_det;
        // PATCH vaksin: id_group=3 butuh pilih batch
        var id_group            = parseInt(datareslistobat[iresobat].id_group || 0);
        var id_batch_selected   = (datareslistobat[iresobat].id_batch || '');
        var qty                  = datareslistobat[iresobat].qty;
        var dosis                = datareslistobat[iresobat].dosis;
        var frekwensi            = datareslistobat[iresobat].frekwensi;
        var tme                  = datareslistobat[iresobat].tme;
        var note                 = datareslistobat[iresobat].note;
        var harga                = datareslistobat[iresobat].harga_satuan;
        var total_harga_obat     = datareslistobat[iresobat].subtotal;
      racikanset += '<tr id="' + id_eresep_det + '">'+
      '<td style="text-align:center"><a href="#" onclick="javascript: validasi_nonracik(\'' + id_eresep_det +'\');return false;"><i class="fa fa-check" style="color:green;"></i></a></td>' +
        '<td>' + (function(){
            var html = name + ' <input type="hidden" name="obat[]" value="' + name + '">';
            if(id_group === 3){
                html += '<div style="margin-top:6px; min-width:200px;">'
                      + '<select class="form-control form-control-sm batch_select" id="batch_' + id_eresep_det + '" '
                      + 'data-id_obat="' + id_trx_det + '" data-selected="' + id_batch_selected + '">'
                      + '<option value="">-- pilih batch (wajib) --</option>'
                      + '</select>'
                      + '</div>';
            }
            return html;
        })() + '</td>'+
        '<td>' + jenis_obat + '	<input type="hidden" name="jenis_obat[]" value="' + jenis_obat +'"><input type="hidden" name="id_fa[]" 	value="' + id_trx_det + '"></td>'+
        '<td><input class="form-control edit_qty_nonracik" attr-id_eresep_det="' + id_eresep_det + '" type="text" name="qty[]" value="' + qty + '"></td>' +
        '<td>' + dosis + ' <input type="hidden" name="dosis[]" value="' + dosis + '"></td>' +
        '<td>' + frekwensi + '	<input type="hidden" name="frekwensi[]" value="' + frekwensi + '"></td>' +
        '<td>' + tme + ' <input type="hidden" name="tme[]" value="' + tme + '"></td>' +
        '<td>' + note + ' <input type="hidden" name="note[]" value="' + note + '"></td>' +
        '<td>' + formatMoney(harga,0) + ' <input type="hidden" class="edit_harga_nonracik" name="harga[]" value="' + harga + '" attr-harga_set="' + harga + '"></td>' +
        '<td>' + formatMoney(total_harga_obat,0) + ' <input type="hidden" name="total_harga_obat[]" value="' + total_harga_obat + '"></td>' +
        '<td style="text-align:center"><a href="#" onclick="javascript: hapus_obat_item(\'' + id_eresep_det +'\');return false;"><i class="fa fa-trash" style="color:red;"></i></a></td>' +
        '</tr>';
    }
        $("#tbody_draft_resep_non_racikdataview").html(racikanset);
        initBatchDropdowns();
        $('.edit_qty_nonracik').change(function() {
          var id       = $(this).attr('attr-id_eresep_det'); 
          var qty_edit_set = $(this).val(); 
          $.ajax({
            url : baseUrl+"penjualan_obat/eresep_bypass/edit_nonracikan",
            method : "POST",
            data : {id:id,qty_edit_set:qty_edit_set},
            async : true,
            dataType : 'json',
            success: function(datares){
              //NOTIFY
              var nFrom='top';
              var nAlign='left';
              var nIcons='fa fa-check';
              var nType='success';
              var nAnimIn='data-animation-in';
              var nAnimOut='data-animation-out';
              var titlenyah='Edit ';
              var msgnyah='Berhasil disimpan';
              notify(nFrom,nAlign,nIcons,nType,nAnimIn,nAnimOut,titlenyah,msgnyah);
              //END NOTIFY
              detailnonobatracikan();
              detailobatracikan();
            }
        });
        });
    }
    });
};
// ================= PATCH VAKSIN BATCH =================
var __batchCache = {};
function initBatchDropdowns(){
    $('.batch_select').each(function(){
        var $sel = $(this);
        var id_obat = $sel.data('id_obat');
        if(!id_obat) return;
        if(__batchCache[id_obat]){
            fillBatchOptions($sel, __batchCache[id_obat]);
            return;
        }
        $.ajax({
            url: "<?php echo base_url('penjualan_obat/eresep_bypass/get_batch_list'); ?>",
            method: "POST",
            data: {id_obat: id_obat},
            async: true,
            dataType: "json",
            success: function(rows){
                __batchCache[id_obat] = rows || [];
                fillBatchOptions($sel, __batchCache[id_obat]);
            }
        });
    });
}
function fillBatchOptions($sel, rows){
    var selected = ($sel.data('selected') || '').toString();
    var opt = '<option value="">-- pilih batch (wajib) --</option>';
    if(rows && rows.length){
        for(var i=0;i<rows.length;i++){
            var idb = (rows[i].id_batch || '').toString();
            opt += '<option value="'+idb+'" '+(idb===selected?'selected':'')+'>'+idb+'</option>';
        }
    }
    $sel.html(opt);
}
// ======================================================
function validasi_nonracik(id_eresep_det) {
    // PATCH vaksin: wajib pilih batch sebelum validasi
    var id_batch = null;
    var $batch = $('#batch_' + id_eresep_det);
    if($batch.length){
        id_batch = ($batch.val() || '').toString();
        if(id_batch === ''){
            swal.fire('Wajib pilih batch','Batch vaksin wajib dipilih sebelum validasi.','warning');
            return;
        }
    }
 /////
 $.ajax({
              url : baseUrl+"penjualan_obat/eresep_bypass/validasiobatnya",
              method : "POST",
              data : {id_eresep_det:id_eresep_det, id_batch:id_batch},
              async : true,
              dataType : 'json',
              success: function(datareslistobat){
                detailnonobatracikan();
                list_detail_obat_nonracikan();
                findtotaltagihan();
              }
              });
 ////
}
function hapus_obat_item(id_eresep_det) {
 /////
 Swal.fire({
    title: 'Hapus Obat Non Racikan',
    text: 'Hapus Item Obat Non Racikan?' ,
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
      actions: 'my-actions',
      //cancelButton: 'order-1 right-gap',
      confirmButton: 'order-2',
      denyButton: 'order-3',
    }
    }).then((result) => {
    if (result.isConfirmed) {
          swal.fire('Hapus Racikan!','Hapus item obat Non Racikan berhasil!', 'success').then(function(){ 
              $.ajax({
              url : baseUrl+"penjualan_obat/eresep_bypass/deleteobatnya",
              method : "POST",
              data : {id_eresep_det:id_eresep_det},
              async : true,
              dataType : 'json',
              success: function(datareslistobat){
                detailnonobatracikan();
              }
              });
          }
        );
      } else if (result.isDenied) {
        Swal.fire('Batal Hapus Non Racikan!', 'Batal hapus item obat non racikan!', 'info')
      }
 })
 ////
}
function detailobatracikan(){
  var id_eresep = $("#ideresepset").val();
  $.ajax({
    url : baseUrl+"penjualan_obat/eresep_bypass/detailobatracikan",
    method : "POST",
    data : {id_eresep:id_eresep},
    async : true,
    dataType : 'json',
    success: function(datareslistobat){
    var irestind="";
    var irestind2="";
    var racikanset ="";
    for (irestind = 0; irestind < datareslistobat.length; irestind++){
    racikanset +='<tr id="row_racikan_n" style="background-color:aqua;">'
      +'<td style="text-align:center"><a href="#" onclick="javascript: validasi_racik(\'' +datareslistobat[irestind].id_eresep_det +'\');return false;"><i class="fa fa-check" style="color:green;"></i></a></td>'
      +'<td colspan="2"><strong>'+datareslistobat[irestind].name+'</strong><input type="hidden" id="nama_racikan_n2" value="'+datareslistobat[irestind].name+'"></td>'
      +'<td>'+datareslistobat[irestind].qty+'</td>'
      +'<td>'+datareslistobat[irestind].dosis+'</td>'
      +'<td>'+datareslistobat[irestind].frekwensi+'</td> '
      +'<td>'+datareslistobat[irestind].tme+'</td>'
      +'<td>'+datareslistobat[irestind].jenis_obat+'</td>'
      +'<td>'+datareslistobat[irestind].harga_satuan+'</td>'
      +'<td>'+datareslistobat[irestind].subtotal+'</td>'
      +'<td>'+datareslistobat[irestind].note+'</td>'
      +'<td style="text-align:center"><a href="#" onclick="javascript: hapus_racik(\'' +datareslistobat[irestind].id_eresep_det +'\');return false;"><i class="fa fa-trash" style="color:red;"></i></a></td>'
      +'</tr>';
    for (irestind2 = 0; irestind2 < datareslistobat[irestind].rs_1.length; irestind2++){
        racikanset +='<tr class="row_racikan_det_n">' 
      +'<td>&nbsp;</td>'
        +'<td style="padding-left:20px;">&bull; '+datareslistobat[irestind].rs_1[irestind2].name+'</td>'
          +'<td style="padding-left:20px;">'+datareslistobat[irestind].rs_1[irestind2].jenis_obat+'</td>' 
          //+'<td style="padding-left:20px;" colspan="5">'+datareslistobat[irestind].rs_1[irestind2].qty+'</td>'
          +'<td style="padding-left:20px;" colspan="5"><input class="form-control edit_qty_racik" attr-id_eresep_det_racik="'+datareslistobat[irestind].rs_1[irestind2].id_eresep_det_racikan+'" type="text" name="qty[]" value="'+datareslistobat[irestind].rs_1[irestind2].qty+'"></td>'
          +'<td>'+formatMoney(datareslistobat[irestind].rs_1[irestind2].harga_satuan,0)+'</td>'
          +'<td colspan="4">'+formatMoney(datareslistobat[irestind].rs_1[irestind2].subtotal,0)+'</td>'
          +'</tr>'; 
    }
    }
    //'<td><input class="form-control edit_qty_nonracik" attr-id_eresep_det="' + id_eresep_det + '" type="text" name="qty[]" value="' + qty + '"></td>' +
    //'<td>' + formatMoney(harga,0) + ' <input type="hidden" class="edit_harga_nonracik" name="harga[]" value="' + harga + '" attr-harga_set="' + harga + '"></td>' +
    //'<td>' + formatMoney(total_harga_obat,0) + ' <input type="hidden" name="total_harga_obat[]" value="' + total_harga_obat + '"></td>' +
    $("#tbody_draft_resep_racikdataview").html(racikanset);
    $('.edit_qty_racik').change(function() {
          var id       = $(this).attr('attr-id_eresep_det_racik'); 
          var qty_edit_set = $(this).val(); 
          $.ajax({
            url : baseUrl+"penjualan_obat/eresep_bypass/edit_racikan",
            method : "POST",
            data : {id:id,qty_edit_set:qty_edit_set},
            async : true,
            dataType : 'json',
            success: function(datares){
              //NOTIFY
              var nFrom='top';
              var nAlign='left';
              var nIcons='fa fa-check';
              var nType='success';
              var nAnimIn='data-animation-in';
              var nAnimOut='data-animation-out';
              var titlenyah='Edit ';
              var msgnyah='Berhasil disimpan';
              notify(nFrom,nAlign,nIcons,nType,nAnimIn,nAnimOut,titlenyah,msgnyah);
              //END NOTIFY
              detailobatracikan();
              list_detail_obat_racikan();
            }
        });
        });
    }
    });
};
//end segment left
//segment right
function list_detail_obat_nonracikan(){
  var id_eresep = $("#ideresepset").val();
  var tuslah    = $("#tuslahset").val();
  $.ajax({
    url : baseUrl+"penjualan_obat/eresep_bypass/list_detailobatnonracikan",
    method : "POST",
    data : {id_eresep:id_eresep},
    async : true,
    dataType : 'json',
    success: function(datareslistobat){
    var iresobat;
    var racikanset ="";
    var all_total_harga_obat = 0;
    for (iresobat = 0; iresobat < datareslistobat.length; iresobat++) {
        var id_eresep_det        = datareslistobat[iresobat].id_eresep_det;
        var name                 = datareslistobat[iresobat].name;
        var jenis_obat           = datareslistobat[iresobat].jenis_obat;
        var id_trx_det           = datareslistobat[iresobat].id_trx_det;
        // PATCH vaksin: id_group=3 butuh pilih batch
        var id_group            = parseInt(datareslistobat[iresobat].id_group || 0);
        var id_batch_selected   = (datareslistobat[iresobat].id_batch || '');
        var qty                  = datareslistobat[iresobat].qty;
        var dosis                = datareslistobat[iresobat].dosis;
        var frekwensi            = datareslistobat[iresobat].frekwensi;
        var tme                  = datareslistobat[iresobat].tme;
        var note                 = datareslistobat[iresobat].note;
        var harga                = datareslistobat[iresobat].harga_satuan;
        var total_harga_obat     = datareslistobat[iresobat].subtotal;
        all_total_harga_obat += parseInt(total_harga_obat);
        var setgrand = all_total_harga_obat;
        var hargasetelahtuslah = parseInt(total_harga_obat)+parseInt(tuslah);
        if(datareslistobat[iresobat].id_batch !=null){
            var id_batch_show = datareslistobat[iresobat].id_batch;
        }else{
            var id_batch_show = "-";
        }
      racikanset += '<tr>'+
      '<td style="text-align:center"><a href="#" onclick="javascript: cancel_validasi_nonracik(\'' + id_eresep_det +'\');return false;"><i class="fa fa-close" style="color:red;"></i></a></td>' +
        '<td>'+name+'</td>'+
        '<td>'+id_batch_show+'</td>'+
        '<td>'+jenis_obat+'</td>'+
        '<td>'+qty+'</td>' +
        '<td>'+dosis+'</td>' +
        '<td>'+frekwensi+'</td>' +
        '<td>'+tme+'</td>' +
        '<td>'+formatMoney(harga,0)+'</td>' +
        '<td>'+formatMoney(total_harga_obat,0)+'</td>' +
        '<td>'+note+'</td>'+
        '</tr>';
    }
    var setgrand_nonracik = parseInt(setgrand);
    if(setgrand==0 || setgrand=="undefined" || setgrand==null){
          $("#total").html("");
    }else{
          $("#total").html("Grand Total : "+formatMoney(setgrand_nonracik,0));
    }
      $("#list_detail_obat_non_racikan").html(racikanset);
    }
    });
}
function cancel_validasi_nonracik(id_eresep_det) {
 /////
 Swal.fire({
    title: 'Cancel Obat Non Racikan',
    text: 'Cancel Item Obat Non Racikan?' ,
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
      actions: 'my-actions',
      //cancelButton: 'order-1 right-gap',
      confirmButton: 'order-2',
      denyButton: 'order-3',
    }
    }).then((result) => {
    if (result.isConfirmed) {
          swal.fire('Cancel Non Racikan!','Cancel item obat Non Racikan berhasil!', 'success').then(function(){ 
              $.ajax({
              url : baseUrl+"penjualan_obat/eresep_bypass/cancelobatnya",
              method : "POST",
              data : {id_eresep_det:id_eresep_det},
              async : true,
              dataType : 'json',
              success: function(datareslistobat){
                detailnonobatracikan();
                list_detail_obat_nonracikan();
                findtotaltagihan();
              }
              });
          }
        );
      } else if (result.isDenied) {
        Swal.fire('Batal Cancel Non Racikan!', 'Batal Cancel item obat non racikan!', 'info')
      }
 })
 ////
}
function list_detail_obat_racikan(){
  var id_eresep = $("#ideresepset").val();
  var tuslah    = $("#tuslahset").val();
  var racik     = $("#racikset").val();
  $.ajax({
    url : baseUrl+"penjualan_obat/eresep_bypass/validasidetailobatracikan",
    method : "POST",
    data : {id_eresep:id_eresep},
    async : true,
    dataType : 'json',
    success: function(datareslistobat){
    var irestind="";
    var irestind2="";
    var racikanset ="";
    var all_total_harga_obat = 0;
    for (irestind = 0; irestind < datareslistobat.length; irestind++){
    racikanset +='<tr id="row_racikan_n" style="background-color:aqua;">'
    +'<td style="text-align:center"><a href="#" onclick="javascript: cancel_validasi_racik(\'' +datareslistobat[irestind].id_eresep_det +'\');return false;"><i class="fa fa-close" style="color:red;"></i></a></td>'
      +'<td colspan="2"><strong>'+datareslistobat[irestind].name+'</strong></td>'
      +'<td>'+datareslistobat[irestind].qty+'</td>'
      +'<td>'+datareslistobat[irestind].dosis+'</td>'
      +'<td>'+datareslistobat[irestind].frekwensi+'</td> '
      +'<td>'+datareslistobat[irestind].tme+'</td>'
      +'<td>'+datareslistobat[irestind].jenis_obat+'</td>'
      +'<td>'+formatMoney(datareslistobat[irestind].harga_satuan,0)+'</td>'
      +'<td>'+formatMoney(datareslistobat[irestind].subtotal,0)+'</td>'
      +'<td>'+datareslistobat[irestind].note+'</td>'
      +'</tr>';
    for (irestind2 = 0; irestind2 < datareslistobat[irestind].rs_1.length; irestind2++){
      var total_harga_obat     = datareslistobat[irestind].rs_1[irestind2].subtotal;
      all_total_harga_obat += parseInt(total_harga_obat);
      var setgrand = all_total_harga_obat;
      var hargasetelahtuslah = parseInt(total_harga_obat)+parseInt(tuslah);
      var subtotal_all_res = datareslistobat[irestind].subtotal;
        racikanset +='<tr class="row_racikan_det_n">' 
        +'<td>&nbsp;</td>'
          +'<td style="padding-left:20px;">&bull; '+datareslistobat[irestind].rs_1[irestind2].name+'</td>'
          +'<td style="padding-left:20px;">'+datareslistobat[irestind].rs_1[irestind2].jenis_obat+'</td>' 
          +'<td style="padding-left:20px;" colspan="5">'+datareslistobat[irestind].rs_1[irestind2].qty+'</td>'
          +'<td>'+formatMoney(datareslistobat[irestind].rs_1[irestind2].harga_satuan,0)+'</td>'
          +'<td colspan="3">'+formatMoney(datareslistobat[irestind].rs_1[irestind2].subtotal,0)+'</td>'
          +'</tr>'; 
    }
    }
    var setgrand_racik = parseInt(subtotal_all_res);
        if(setgrand==0 || setgrand=="undefined" || setgrand==null){
          $("#total_racik").html("");
         }else{
          $("#total_racik").html("Grand Total : "+formatMoney(setgrand_racik,0));
        }
    $("#list_detail_obat_racikan").html(racikanset);
    }
    });
};
function hapus_racik(id_eresep_det) {
   /////
 Swal.fire({
    title: 'Cancel Obat Racikan',
    text: 'Cancel Item Obat Racikan?' ,
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
      actions: 'my-actions',
      //cancelButton: 'order-1 right-gap',
      confirmButton: 'order-2',
      denyButton: 'order-3',
    }
    }).then((result) => {
    if (result.isConfirmed) {
          swal.fire('Cancel Racikan!','Cancel item obat Racikan berhasil!', 'success').then(function(){ 
            $.ajax({
            url : baseUrl+"penjualan_obat/eresep_bypass/hapusobatnya_rck",
            method : "POST",
            data : {id_eresep_det:id_eresep_det, id_batch:id_batch},
            async : true,
            dataType : 'json',
            success: function(datareslistobat){
            detailobatracikan();
            list_detail_obat_racikan();
          }
          });
          }
        );
      } else if (result.isDenied) {
        Swal.fire('Batal Cancel Racikan!', 'Batal Cancel item obat racikan!', 'info')
      }
 })
 ////
}
function validasi_racik(id_eresep_det) {
 /////
 $.ajax({
  url : baseUrl+"penjualan_obat/eresep_bypass/validasiobatnya_rck",
  method : "POST",
  data : {id_eresep_det:id_eresep_det, id_batch:id_batch},
  async : true,
  dataType : 'json',
  success: function(datareslistobat){
     detailobatracikan();
     list_detail_obat_racikan();
     findtotaltagihan();
  }
 });
 ////
}
function cancel_validasi_racik(id_eresep_det) {
 /////
 Swal.fire({
    title: 'Cancel Obat Racikan',
    text: 'Cancel Item Obat Racikan?' ,
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
      actions: 'my-actions',
      //cancelButton: 'order-1 right-gap',
      confirmButton: 'order-2',
      denyButton: 'order-3',
    }
    }).then((result) => {
    if (result.isConfirmed) {
          swal.fire('Cancel Racikan!','Cancel item obat Racikan berhasil!', 'success').then(function(){ 
              $.ajax({
              url : baseUrl+"penjualan_obat/eresep_bypass/cancelobatnya_rck",
              method : "POST",
              data : {id_eresep_det:id_eresep_det, id_batch:id_batch},
              async : true,
              dataType : 'json',
              success: function(datareslistobat){
                detailobatracikan();
                list_detail_obat_racikan();
                findtotaltagihan();
              }
              });
          }
        );
      } else if (result.isDenied) {
        Swal.fire('Batal Cancel Racikan!', 'Batal Cancel item obat racikan!', 'info')
      }
 })
 ////
}
//end segment right
//end list set
////toggle untuk input resep
function toggleFullScreen(){
  $(window).height();
  document.fullscreenElement||document.mozFullScreenElement||document.webkitFullscreenElement?document.cancelFullScreen?document.cancelFullScreen():document.mozCancelFullScreen?document.mozCancelFullScreen():document.webkitCancelFullScreen&&document.webkitCancelFullScreen():document.documentElement.requestFullscreen?document.documentElement.requestFullscreen():document.documentElement.mozRequestFullScreen?document.documentElement.mozRequestFullScreen():document.documentElement.webkitRequestFullscreen&&document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT),$(".full-screen").toggleClass("icon-maximize"),$(".full-screen").toggleClass("icon-minimize")
}
  $(document).ready(
      function(){
          var e=($(window),$("body")),t=e[0].className;
          $(".main-menu").attr("id",t),
          $(".card-header-right .close-card").on("click",function(){
              var e=$(this);
            e.parents(".card").animate({opacity:"0","-webkit-transform":"scale3d(.3, .3, .3)",transform:"scale3d(.3, .3, .3)"}),
        setTimeout(function(){
        e.parents(".card").remove()},800)}),
        $(".card-header-right .minimize-card").on("click",function(){
        var e=$(this),t=$(e.parents(".card"));
            $(t).children(".card-block").slideToggle();
            $(this).toggleClass("icon-minus").fadeIn("slow"),
            $(this).toggleClass("icon-plus").fadeIn("slow")}),
            $(".card-header-right .full-card").on("click",function(){
        var e=$(this);
            $(e.parents(".card")).toggleClass("full-card"),
            $(this).toggleClass("icon-maximize"),
            $(this).toggleClass("icon-minimize")}),
        $("#more-details").on("click",function(){
            $(".more-details").slideToggle(500)}),$(".mobile-options").on("click",function(){$(".navbar-container .nav-right").slideToggle("slow")}),$.mCustomScrollbar.defaults.axis="yx",$("#styleSelector .style-cont").slimScroll({setTop:"10px",height:"calc(100vh - 440px)"}),$(".main-menu").mCustomScrollbar({setTop:"10px",setHeight:"calc(100% - 80px)"});var a=$(window).height()-80;$(".main-friend-list").slimScroll({height:a,allowPageScroll:!1,wheelStep:5,color:"#1b8bf9"}),$("#search-friends").on("keyup",function(){var e=$(this).val().toLowerCase();$(".userlist-box .media-body .chat-header").each(function(){var t=$(this).text().toLowerCase();$(this).closest(".userlist-box")[-1!==t.indexOf(e)?"show":"hide"]()})}),$(".displayChatbox").on("click",function(){if("right"==$(".pcoded").attr("vertical-placement"))var e={direction:"left"};else var e={direction:"right"};$(".showChat").toggle("slide",e,500)}),$(".userlist-box").on("click",function(){if("right"==$(".pcoded").attr("vertical-placement"))var e={direction:"left"};else var e={direction:"right"};
          $(".showChat_inner").toggle("slide",e,500)}),$(".back_chatBox").on("click",function(){if("right"==$(".pcoded").attr("vertical-placement"))var e={direction:"left"};else var e={direction:"right"};$(".showChat_inner").toggle("slide",e,500),$(".showChat").css("display","block")}),$(".search-btn").on("click",function(){$(".main-search").addClass("open"),$(".main-search .form-control").animate({width:"200px"})}),$(".search-close").on("click",function(){$(".main-search .form-control").animate({width:"0"}),setTimeout(function(){$(".main-search").removeClass("open")},300)}),$("#mobile-collapse i").addClass("icon-toggle-right"),$("#mobile-collapse").on("click",function(){$("#mobile-collapse i").toggleClass("icon-toggle-right"),$("#mobile-collapse i").toggleClass("icon-toggle-left")})}),
  $(document).ready(function(){
    var id_reg = $("#id_reg").val();
    ////// ROW NON RACIKAN
    $(document).off('click','#addrow').on('click','#addrow', function(e) {
        e.preventDefault();
        var obat = $('#obat').val();
        var id_fa = $('#id_fa').val();
        var jenis_obat = $('#jenis_obat').val();
        var qty = $('#qty').val();
        var dosis = $('#dosis').val();
        var frekwensi = $('#frekwensi').val();
        var tme = $('#tme').val();
        var note = $('#note').val();
        var rand_no = get_random_number();
      //set data lainnya dlu
      var id_obat = id_fa;
      $.ajax({
      url : baseUrl+"penjualan_obat/eresep_bypass/prosesdetailobat",
      method : "POST",
      data : {id_obat:id_obat},
      async : true,
      dataType : 'json',
      success: function(datares){
        var harga        = (Math.round(datares.row_1 / 100) * 100);
        var total_harga_obat = (qty*harga);
        var tpl_row = '\n' +
        '<tr id="' + rand_no + '"> \n ' +
        '<td>' + obat + ' <input type="hidden" name="obat" value="' + obat + '"></td> \n ' +
        '<td>' + jenis_obat + '	<input type="hidden" name="jenis_obat" value="' + jenis_obat +
        '"><input type="hidden" name="id_fa" 	value="' + id_fa + '"></td> \n ' +
        '<td>' + qty + ' <input type="hidden" name="qty" value="' + qty + '"></td> \n ' +
        '<td>' + dosis + ' <input type="hidden" name="dosis" value="' + dosis + '"></td> \n ' +
        '<td>' + frekwensi + '	<input type="hidden" name="frekwensi" value="' + frekwensi + '"></td> \n ' +
        '<td>' + tme + ' <input type="hidden" name="tme" value="' + tme + '"></td> \n ' +
        '<td>' + note + ' <input type="hidden" name="note" value="' + note + '"></td> \n ' +
        '<td>' + formatMoney(harga,0) + ' <input type="hidden" name="harga" value="' + harga + '"></td> \n ' +
        '<td>' + formatMoney(total_harga_obat,0) + ' <input type="hidden" name="total_harga_obat" value="' + total_harga_obat + '"></td> \n ' +
        '<td style="text-align:center"><a href="#" onclick="javascript: remove_row_draft(\'' + rand_no +
        '\');return false;"><i class="fa fa-trash" style="color:red;"></i></a></td> \n ' +
        '</tr>';
        $("#tbody_draft_resep_non_racik").append(tpl_row);
        $('#butt_simpan_resep').removeClass('hidden');
        $('#batal_new_eresep').removeClass('hidden');
	    //var added_draft = $('input[name="obat\\[\\]"]');
	    //alert('test : ' + added_draft.length);
        // --- CLEAR --------------------------
        $('#obat').val('');
        $('#id_fa').val('');
        $('#jenis_obat').val('');
        $('#qty').val('');
        $('#dosis').val('');
        $('#frekwensi').val('');
        $('#tme').val('');
        $('#note').val('');
        var dataset = $('#formobtnrck').serialize();
        $.ajax({
            url : baseUrl+"penjualan_obat/eresep_bypass/save_eresep_nonracikan",
            method : "POST",
            data : dataset,
            async : true,
            dataType : 'json',
            success: function(datares){
              //NOTIFY
              var nFrom='top';
              var nAlign='right';
              var nIcons='fa fa-check';
              var nType='success';
              var nAnimIn='data-animation-in';
              var nAnimOut='data-animation-out';
              var titlenyah='Resep ';
              var msgnyah='Berhasil disimpan';
              notify(nFrom,nAlign,nIcons,nType,nAnimIn,nAnimOut,titlenyah,msgnyah);
              $("#tbody_draft_resep_non_racik").html('');
              detailnonobatracikan();
              //END NOTIFY
            }
        });
      }
      });
      //end set data lainnya dlu
    });
    //////END ROW NON RACIKAN
    // -------------- RACIKAN FUNCTION -------------------
    $('#addrow_to_racikan').click(function(e) {
      var id_num     = $("#id_num").val();
      var obat       = $('#frm_obat').val();
      var id_fa      = $('#frm_id_fa').val();
      var jenis_obat = $('#frm_jenis_obat').val();
      var qty        = $('#frm_qty').val();
      var id_obat 	 = id_fa;
    $.ajax({
      url : baseUrl+"penjualan_obat/eresep_bypass/prosesdetailobat",
      method : "POST",
      data : {id_obat:id_obat},
      async : true,
      dataType : 'json',
      success: function(datares){
        var harga        = (Math.round(datares.row_1 / 100) * 100);
        var total_harga_obat = (qty*harga);
        var tpl_row = '\n' +
        '<tr id="racikan_'+id_num+'"> \n ' +
        '<td>' + obat + '				<input type="hidden" name="obat_' + id_num + '" 				value="' + obat + '"></td> \n ' +
        '<td>' + jenis_obat + '	<input type="hidden" name="jenis_obat_' + id_num + '" 	value="' + jenis_obat +
        '"><input type="hidden" name="id_fa_' + id_num + '" 	value="' + id_fa + '"></td> \n ' +
        '<td>' + qty + '				<input type="hidden" name="qty_' + id_num + '" 				value="' + qty + '"></td> \n ' +
        '<td>'+harga+'			<input type="hidden" name="harga_'+id_num+'" 			value="'+harga+'"></td> \n ' +
        '<td>'+total_harga_obat+'	<input type="hidden" name="subtotal_'+id_num+'" id="subtotal_'+id_num+'" 	value="'+total_harga_obat+'" class="subtotal"></td> \n ' +
        '<td style="text-align:center"><a href="#" class="hapus_item_rck" id="hapus_'+id_num+'" attr-id-item="'+id_num+'" attr-id-subtotal="'+total_harga_obat+'"><i class="fa fa-trash" style="color:red;"></i></a></td> \n ' +
        '</tr>';
      $("#tbody_draft_racikan").append(tpl_row);
      id_num++;
      $("#id_num").val(id_num);
      clear_form_add_row_racikan();
      var sum =0;
        $(".subtotal").each(function () {
            sum += parseFloat(this.value);
        });
        $('.hapus_item_rck').click(function(e) {
          var id_nums        = $(this).attr('attr-id-item'); 
          $("#racikan_"+id_nums).remove();
          return false;
        });
        $("#grandtotal").val(sum);
      }
    });
    });
 $('#add_racikan_to_resep').click(function(e) {
        e.preventDefault();
      var radios = document.getElementsByName('kemasan');
      for (var i = 0, length = radios.length; i < length; i++) {
        if (radios[i].checked) {
          var selected_kemasan = radios[i].value;
          break;
        }
      }
      var id_num = $("#id_num").val();
      var num_resep_racikan = $("#num_resep_racikan").val();
      // --- header racikan ---
      var nama_racikan = $('#nama_racikan').val();
      var kemasan_racikan = selected_kemasan;
      //var kemasan 				= 'pulperes';
      var jumlah_racikan = $('#jumlah_tpl').val();
      var dosis_racikan = $('#dosis_tpl').val();
      var frekwensi_racikan = $('#frekwensi_tpl').val();
      var tme_racikan = $('#tme_tpl').val();
      var note_racikan = $('#note_tpl').val();
      var tpl_row = '\n' +
        '<tr id="row_racikan_' + num_resep_racikan + '">' +
        '<td colspan="2">' + nama_racikan + '	<input type="hidden" name="nama_racikan[' + num_resep_racikan +
        ']" 			value="' + nama_racikan + '"></td> \n ' +
        '<td>' + jumlah_racikan + '						<input type="hidden" name="jumlah_racikan[' + num_resep_racikan +
        ']" 			value="' + jumlah_racikan + '"></td> \n ' +
        '<td>' + dosis_racikan + '						<input type="hidden" name="dosis_racikan[' + num_resep_racikan +
        ']" 			value="' + dosis_racikan + '"></td> \n ' +
        '<td>' + frekwensi_racikan + '				<input type="hidden" name="frekwensi_racikan[' + num_resep_racikan +
        ']" 	value="' + frekwensi_racikan + '"></td> \n ' +
        '<td>' + tme_racikan + '							<input type="hidden" name="tme_racikan[' + num_resep_racikan + ']" 				value="' +
        tme_racikan + '"></td> \n ' +
        '<td>' + kemasan_racikan + '					<input type="hidden" name="kemasan_racikan[' + num_resep_racikan +
        ']" 		value="' + kemasan_racikan + '"></td> \n ' +
        '<td>-					<input type="hidden" name="harga[' + num_resep_racikan +
        ']" 		value="0"></td> \n ' +
        '<td>-					<input type="hidden" name="subtotal[' + num_resep_racikan +
        ']" 		value="0"></td> \n ' +
        '<td>' + note_racikan + '							<input type="hidden" name="note_racikan[' + num_resep_racikan +
        ']" 			value="' + note_racikan + '"></td> \n ' +
        '<td> hapus <input type="hidden" name="note_racikan[' + num_resep_racikan +
        ']" 			value="' + note_racikan + '"></td> \n ' + 
        '</tr>';
      $('#tbody_draft_resep_racikan').append(tpl_row);
      for (i = 0; i < id_num; i++) {
        var obat = $("input[name='obat_" + i + "']").val();
        var id_fa = $("input[name='id_fa_" + i + "']").val();
        var jenis_obat = $("input[name='jenis_obat_" + i + "']").val();
        var qty = $("input[name='qty_" + i + "']").val();
        var harga = $("input[name='harga_" + i + "']").val();
        var subtotal = $("input[name='subtotal_" + i + "']").val();
        //var dosis 			= $("input[name='dosis_"+i+"']").val();
        //console.log(myobat);	
        var tpl_row = '\n' +
          '<tr class="row_racikan_det_' + num_resep_racikan + '"> \n ' +
          '<td>' + obat + '				<input type="hidden" name="det_racikan_obat[' + num_resep_racikan + '][' + i +
          ']" 	value="' + obat + '"></td> \n ' +
          '<td>' + jenis_obat + '	<input type="hidden" name="det_jenis_obat[' + num_resep_racikan + '][' + i +
          ']" 		value="' + jenis_obat + '"> \n ' +
          '										<input type="hidden" name="det_id_fa[' + num_resep_racikan + '][' + i + ']" 				value="' + id_fa +
          '"></td> \n ' +
          '<td>' + qty + '				<input type="hidden" name="det_racikan_qty[' + num_resep_racikan + '][' + i +
          ']" 	value="' + qty + '"></td> \n ' +
          '<td>' + harga + '				<input type="hidden" name="det_racikan_harga[' + num_resep_racikan + '][' + i +
          ']" 	value="' + harga + '"></td> \n ' +
          '<td>' + subtotal + '				<input type="hidden" name="det_racikan_subtotal[' + num_resep_racikan + '][' + i +
          ']" 	value="' + subtotal + '"></td> \n ' +
          //'<td>'+dosis+'			<input type="hidden" name="det_racikan_dosis['+num_resep_racikan+']['+i+']" 	value="'+dosis+'"></td> \n ' +
          '<td colspan="5">&nbsp;</td> \n ' +
          '</tr>';
        $('#tbody_draft_resep_racikan').append(tpl_row);
      }
      $('#butt_simpan_resep').removeClass('hidden');
      $('#batal_new_eresep').removeClass('hidden');
      num_resep_racikan++;
      $("#num_resep_racikan").val(num_resep_racikan);
      //clear_modal_racikan();
      $('#modal_racikan').modal('hide');
      $('.modal-backdrop').removeClass('show');
      $('.modal-backdrop').addClass('hide');
      var dataset = $('#formobtrck').serialize();
        $.ajax({
            url : baseUrl+"penjualan_obat/eresep_bypass/save_eresep_racikan",
            method : "POST",
            data : dataset,
            async : true,
            dataType : 'json',
            success: function(datares){
              //NOTIFY
              var nFrom='top';
              var nAlign='right';
              var nIcons='fa fa-check';
              var nType='success';
              var nAnimIn='data-animation-in';
              var nAnimOut='data-animation-out';
              var titlenyah='Obat Racikan ';
              var msgnyah='Berhasil disimpan';
              notify(nFrom,nAlign,nIcons,nType,nAnimIn,nAnimOut,titlenyah,msgnyah);
              $('#tbody_draft_resep_racikan').html('');
              detailobatracikan();
              //END NOTIFY
            }
        });
 });
     var modal_racikan_starter = $('#modal_racikan_body').html();
     $('#modal_racikan').on('hidden.bs.modal', function(e) {
      clear_modal_racikan();
    })
    function clear_modal_racikan() {
      $("#id_num").val('0');
      //$('#modal_racikan_body').empty();
      //$('#modal_racikan_body').html(modal_racikan_starter);
      clear_form_header_add_racikan();
      var tr_header_form_racikan = ' <tr> ' +
        '<th scope="col">Obat</th>' +
        '<th scope="col">Jenis</th>' +
        '<th scope="col">Jumlah</th>' +
        '<th scope="col">Hapus</th>' +
        '</tr>';
      $('#tbody_draft_racikan').html(tr_header_form_racikan);
    }
    function remove_row_resep_racikan(id_row) {
     /////
     Swal.fire({
        title: 'Hapus Racikan',
        text: 'Hapus Obat Racikan?' ,
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Yes',
        denyButtonText: 'No',
        customClass: {
          actions: 'my-actions',
          //cancelButton: 'order-1 right-gap',
          confirmButton: 'order-2',
          denyButton: 'order-3',
        }
        }).then((result) => {
        if (result.isConfirmed) {
              swal.fire('Hapus Racikan!','Hapus obat Racikan berhasil!', 'success').then(function(){ 
                $("#row_racikan_" + id_row).remove();
                $(".row_racikan_det_" + id_row).remove();
              }
            );
          } else if (result.isDenied) {
            Swal.fire('Batal Hapus Racikan!', 'Batal hapus obat racikan!', 'info')
          }
     })
     ////
    }
    function clear_form_header_add_racikan() {
      $("input[name='nama_racikan']").val('');
      $("input[name='jumlah_tpl']").val('');
      $("input[name='dosis_tpl']").val('');
      $("input[name='frekwensi_tpl']").val('');
      $("input[name='tme_tpl']").val('');
      $("input[name='note_tpl']").val('');
    }
    function clear_form_add_row_racikan() {
      $('#frm_obat').val('');
      $('#frm_id_fa').val('');
      $('#frm_jenis_obat').val('');
      $('#frm_qty').val('');
      //$('#frm_dosis').val('');
    }
    //END RACIKAN 
  });
$(document).ready(function(){
  $("#styleSelector").html(
    '<div class="selector-toggle"><a href="javascript:void(0)"></a></div>'
  + '<div class="fx-drawer-body">'
  + '  <div class="form-group row"><label class="col-sm-4 col-form-label">Obat</label><div class="col-sm-8"><div class="ui-widget"><input id="obat" class="form-control" placeholder="Cari Obat..."><input type="hidden" id="id_fa" name="id_fa" class="hidden" readonly></div></div></div>'
  + '  <div class="form-group row"><label class="col-sm-4 col-form-label">Jenis</label><div class="col-sm-8"><input id="jenis_obat" name="jenis_obat" class="form-control" placeholder="Jenis Obat"></div></div>'
  + '  <div class="form-group row"><label class="col-sm-4 col-form-label">Jumlah</label><div class="col-sm-8"><input id="qty" name="qty" class="form-control" placeholder="Jumlah Obat"></div></div>'
  + '  <div class="form-group row"><label class="col-sm-4 col-form-label">Dosis</label><div class="col-sm-8"><div class="ui-widget"><input id="dosis" name="dosis" class="form-control" placeholder="Dosis Obat"></div></div></div>'
  + '  <div class="form-group row"><label class="col-sm-4 col-form-label">Frekwensi</label><div class="col-sm-8"><div class="ui-widget"><input id="frekwensi" name="frekwensi" class="form-control" placeholder="Frekwensi Obat"></div></div></div>'
  + '  <div class="form-group row"><label class="col-sm-4 col-form-label">Waktu/Cara</label><div class="col-sm-8"><div class="ui-widget"><input id="tme" name="tme" class="form-control" placeholder="Waktu/Cara Pemberian Obat"></div></div></div>'
  + '  <div class="form-group row"><label class="col-sm-4 col-form-label">Keterangan</label><div class="col-sm-8"><input id="note" name="note" class="form-control" placeholder="Keterangan Obat"></div></div>'
  + '</div>'
  + '<div class="fx-drawer-footer">'
  + '  <button type="button" class="btn btn-primary" id="addrow" style="flex:1;">Masukan ke Resep</button>'
  + '</div>'
);
});
////end toggle untuk input resep
//AUTO COMPLETE SEGMENT
$(function() {
	$("#obat").keydown(function(e) {
		//console.log(e.which);
    if (e.which == 190) {
			alert('Mohon maaf, simbol .(titik) pada keyboard tidak bisa digunakan untuk input resep, mungkin anda bisa mencoba tanda ,(koma)');
			return false;
    }
    });
    $("#obat").autocomplete({
      source: "<?php echo base_url('penjualan_obat/eresep_bypass/inner_get_data_autocomplet_obat'); ?>",
      minLength: 3,
      select: function(event, ui) {
        $("#jenis_obat").val(ui.item.jenis_obat);
        $("#id_fa").val(ui.item.id_fa);
      },
      appendTo: '#styleSelector'
    });
    });
  $(function() {
	$("#dosis").keydown(function(e) {
		//console.log(e.which);
    if (e.which == 190) {
			alert('Mohon maaf, simbol .(titik) pada keyboard tidak bisa digunakan untuk input resep, mungkin anda bisa mencoba tanda ,(koma)');
			return false;
    }
  });
  $("#dosis").autocomplete({
    source: "<?php echo base_url('penjualan_obat/eresep_bypass/inner_get_data_autocomplet_obat_dosis'); ?>",
    minLength: 1,
    select: function(event, ui) {}
  });
  });
  $(function() {
	$("#qty").keydown(function(e) {
		//console.log(e.which);
    if (e.which == 190) {
			alert('Mohon maaf, simbol .(titik) pada keyboard tidak bisa digunakan untuk input resep, mungkin anda bisa mencoba tanda ,(koma)');
			return false;
    }
  });
  });
$(function() {
	$("#frekwensi").keydown(function(e) {
		//console.log(e.which);
    if (e.which == 190) {
			alert('Mohon maaf, simbol .(titik) pada keyboard tidak bisa digunakan untuk input resep, mungkin anda bisa mencoba tanda ,(koma)');
			return false;
    }
  });
  $("#frekwensi").autocomplete({
    source: "<?php echo base_url('penjualan_obat/eresep_bypass/inner_get_data_autocomplet_obat_frekwensi'); ?>",
    minLength: 1,
    select: function(event, ui) {}
  });
});
$(function() {
  $("#tme").autocomplete({
    source: "<?php echo base_url('penjualan_obat/eresep_bypass/inner_get_data_autocomplet_obat_tme'); ?>",
    minLength: 1,
    select: function(event, ui) {}
  });
});
//END AUTO COMPLETE SEGMENT
  // PATCH: reset form susulan setiap modal ditutup
  $('#modal_susulan').on('hidden.bs.modal', function(){
    try{
      $('#obat').val('');
      $('#id_fa').val('');
      $('#jenis_obat').val('');
      $('#qty').val('');
      $('#dosis').val('');
      $('#frekwensi').val('');
      $('#tme').val('');
      $('#note').val('');
      // bersihkan suggestion dropdown kalau ada
      $('.ui-autocomplete').hide();
    }catch(e){}
  });
document.getElementById("butt_simpan_resep").hidden = true;
  document.getElementById("batal_new_eresep").hidden = true;
function batalkan_resep(id_reg, id_pasien) {
 var id_reg = $('#id_reg').val();
 var id_pasien = $('#id_pasien').val();
 /////
 Swal.fire({
    title: 'Batal Edit',
    text: 'Batalkan Edit Resep ?' ,
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
      actions: 'my-actions',
      //cancelButton: 'order-1 right-gap',
      confirmButton: 'order-2',
      denyButton: 'order-3',
    }
    }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
      url : baseUrl+"penjualan_obat/eresep_bypass/add_additional",
      method : "POST",
      data : {id_reg:id_reg,id_pasien:id_pasien},
      async : true,
      dataType : 'html',
      success: function(datarestind){
        $('#box_new_eresep_farmasi').html(datarestind);
      }
      });
          swal.fire('Batal!','Batal Edit Resep Berhasil!', 'success').then(function(){ 
            //$('#rinciansetadd').submit();
            /*$.ajax({
              url : baseUrl+"rincian/dataresrinc",
              method : "GET",
              data : {id_reg:id_reg},
              async : true,
              dataType : 'html',
              success: function(datarestind){
                prosesrincian(id_reg);
                location.reload();
                window.open(baseUrl+'rincian/printrincian/'+id_reg);
              }
            });*/
          }
        );
      } else if (result.isDenied) {
        Swal.fire('Batal Edit Resep!', 'Batal edit resep!', 'info')
      }
 })
 ////
}
function remove_row_draft(id_fa) {
   /////
 Swal.fire({
    title: 'Hapus',
    text: 'Hapus Item Obat ?' ,
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: 'Yes',
    denyButtonText: 'No',
    customClass: {
      actions: 'my-actions',
      //cancelButton: 'order-1 right-gap',
      confirmButton: 'order-2',
      denyButton: 'order-3',
    }
    }).then((result) => {
    if (result.isConfirmed) {
          swal.fire('Hapus!','Hapus item obat berhasil!', 'success').then(function(){ 
            $("#" + id_fa).remove();
          }
        );
      } else if (result.isDenied) {
        Swal.fire('Batal Hapus!', 'Batal hapus item obat!', 'info')
      }
 })
 ////
}
$(function() {
  $("#frm_obat").autocomplete({
    source: "<?php echo base_url('penjualan_obat/eresep_bypass/inner_get_data_autocomplet_obat'); ?>",
    minLength: 3,
    select: function(event, ui) {
      $("#frm_jenis_obat").val(ui.item.jenis_obat);
      $("#frm_id_fa").val(ui.item.id_fa);
    }
  });
});
/*
$( function() {
	$( "#frm_dosis" ).autocomplete({
		source: "<?php #echo base_url('penjualan_obat/eresep_bypass/inner_get_data_autocomplet_obat_dosis'); ?>",
		minLength: 1,
		select: function( event, ui ) {
		}
	});
});
*/
// ----------------------------------------------------------------------------------------
$(function() {
  $("#frekwensi_tpl").autocomplete({
    source: "<?php echo base_url('penjualan_obat/eresep_bypass/inner_get_data_autocomplet_obat_frekwensi'); ?>",
    minLength: 1,
    select: function(event, ui) {}
  });
});
$(function() {
  $("#tme_tpl").autocomplete({
    source: "<?php echo base_url('penjualan_obat/eresep_bypass/inner_get_data_autocomplet_obat_tme'); ?>",
    minLength: 1,
    select: function(event, ui) {}
  });
});
function get_random_number() {
  var mymin = 100000;
  var mymax = 999999;
  var myrandom = Math.floor(Math.random() * (+mymax - +mymin)) + +mymin;
  console.log("Random Number Generated : " + myrandom);
  return myrandom;
}
////////////////////////////////////////////////
</script>
