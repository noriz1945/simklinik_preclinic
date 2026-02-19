<!DOCTYPE html>
<html lang="en">

<head>
<?php $this->theme->head('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/mstfnc/mst-cmp-css.php'); ?>
<title><?= htmlspecialchars($title ?? 'Laporan Vaksinasi') ?></title>

<!-- kalau sudah ada DataTables/Select2 dari theme, boleh hapus yang CDN ini -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables.net-dt@2.1.8/css/dataTables.dataTables.min.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"/>

<style>
/* PATCH: ikut tema aplikasi (terang) */
body{ background:#f4f6fb !important; }

.card .card-header h5{ margin-bottom:0; }
.badge-mode{
  display:inline-block; padding:6px 10px; border-radius:14px;
  background:#e9f2ff; color:#0b5ed7; font-weight:700; font-size:12px;
  border:1px solid #cfe2ff;
}
.btn-mode{
  border-radius: 6px;
  border: 1px solid #d6d6d6;
  background: #fff;
  color: #333;
  padding: 8px 12px;
}
.btn-mode.active{
  border-color:#0d6efd;
  background:#0d6efd;
  color:#fff;
}
.filter-row .form-control, .filter-row .form-select{
  border-radius:6px;
}
.select2-container--default .select2-selection--single{
  height: 38px;
  border: 1px solid #ced4da;
  border-radius: 6px;
}
.select2-container--default .select2-selection--single .select2-selection__rendered{
  line-height: 36px;
}
.select2-container--default .select2-selection--single .select2-selection__arrow{
  height: 36px;
}
.dt-responsive .dataTables_wrapper .dataTables_filter input{
  border:1px solid #ced4da; border-radius:6px; padding:6px 10px;
}
.note-small{
  font-size: 12px; color:#6c757d;
}
</style>
</head>

<body>
<?php $this->theme->wrapper_open('theme_default'); ?>
<div class="loader-bg">
  <div class="loader-bar"></div>
</div>

<div id="pcoded" class="pcoded">
<div class="pcoded-overlay-box"></div>
<div class="pcoded-container navbar-wrapper">

<div class="pcoded-main-container">
<div class="pcoded-wrapper">

<div class="pcoded-content">

<!-- PAGE HEADER -->
<div class="page-header card">
  <div class="row align-items-end">
    <div class="col-lg-8">
      <div class="page-header-title">
        <i class="feather icon-clipboard bg-c-blue"></i>
        <div class="d-inline">
          <h5>Laporan Vaksinasi</h5>
          <span>List per pasien / Matrix per vaksin+batch</span>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="page-header-breadcrumb">
        <ul class="breadcrumb breadcrumb-title">
          <li class="breadcrumb-item">
            <a href="<?php echo base_url('./'); ?>"><i class="feather icon-home"></i></a>
          </li>
          <li class="breadcrumb-item">
            <a href="javascript:void(0)">Farmasi</a>
          </li>
          <li class="breadcrumb-item">
            <a href="<?php echo base_url('laporan_vaksinasi'); ?>">Laporan Vaksinasi</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">

<div class="page-body">

  <div class="card">
    <div class="card-header d-flex align-items-center justify-content-between flex-wrap" style="gap:10px;">
      <h5>Data Vaksinasi</h5>

      <div class="d-flex align-items-center flex-wrap" style="gap:8px;">
        <span class="badge-mode" id="modePill">MODE: LIST</span>

        <button id="btnList" class="btn-mode active" type="button">List</button>
        <button id="btnMatrix" class="btn-mode" type="button">Matrix</button>

        <button id="btnApply" class="btn btn-primary waves-effect" type="button">
          <i class="fa fa-search"></i> Terapkan
        </button>

        <button id="btnReset" class="btn btn-default waves-effect" type="button">
          Reset
        </button>

        <button id="btnExportCsv" class="btn btn-success waves-effect" type="button">
          <i class="fa fa-file-excel-o"></i> Export CSV
        </button>
      </div>
    </div>

    <div class="card-block">

      <!-- FILTERS -->
      <div class="row filter-row">
        <div class="col-md-3">
          <label>Nama Vaksin (id_group=3)</label>
          <select id="vaksin_id" class="form-control">
            <option value="">— Semua Vaksin —</option>
          </select>
        </div>

        <div class="col-md-3">
          <label>Cari Nama Pasien</label>
          <input id="nama_pasien" class="form-control" placeholder="contoh: noris / budi">
        </div>

        <div class="col-md-2">
          <label>Cari ID Batch</label>
          <input id="id_batch" class="form-control" placeholder="contoh: A122500005">
        </div>

        <div class="col-md-2">
          <label>Tanggal Dari</label>
          <input id="date_from" type="date" class="form-control">
        </div>

        <div class="col-md-2">
          <label>Tanggal Sampai</label>
          <input id="date_to" type="date" class="form-control">
        </div>
      </div>

      <hr>

      <!-- TABLE -->
      <div class="dt-responsive table-responsive">
        <table id="tbl" class="table table-striped table-bordered nowrap" style="width:100%">
          <thead>
            <tr id="theadRow"></tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>

      <div class="note-small mt-2">
        Catatan: Matrix memakai <code>GROUP_CONCAT(DISTINCT ...)</code>. Jika nama pasien sangat panjang, MySQL <code>group_concat_max_len</code> bisa membatasi hasil.
      </div>

    </div>
  </div>

</div>
</div>
</div>
</div>

</div> <!-- pcoded-content -->
</div> <!-- pcoded-wrapper -->
</div> <!-- pcoded-main-container -->
</div> <!-- pcoded-container -->
</div> <!-- pcoded -->

<div id="styleSelector"></div>

<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/mstfnc/mst-cmp-js.php'); ?>

<!-- kalau sudah ada jquery/dt/select2 di theme, boleh hapus CDN ini -->
<script src="https://cdn.jsdelivr.net/npm/datatables.net@2.1.8/js/dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
(function(){
  const baseUrl = "<?= site_url('laporan_vaksinasi') ?>";
  let mode = "list"; // list | matrix
  let dt = null;

  function setMode(newMode){
    mode = newMode;

    $("#btnList").toggleClass("active", mode==="list");
    $("#btnMatrix").toggleClass("active", mode==="matrix");
    $("#modePill").text("MODE: " + (mode==="list" ? "LIST" : "MATRIX"));

    renderTable();
    reload();
  }

  function filters(){
    return {
      vaksin_id: $("#vaksin_id").val() || "",
      nama_pasien: $("#nama_pasien").val() || "",
      id_batch: $("#id_batch").val() || "",
      date_from: $("#date_from").val() || "",
      date_to: $("#date_to").val() || ""
    };
  }

  function renderTable(){
    if(dt){
      dt.destroy();
      $("#tbl tbody").empty();
    }

    let cols = [];
    let headHtml = "";

    if(mode === "list"){
      headHtml += "<th>Nama Vaksin</th><th>ID Batch</th><th>Tanggal</th><th>Nama Pasien</th>";
      cols = [
        { data: "nama_vaksin" },
        { data: "id_batch" },
        { data: "so_date" },
        { data: "nama_pasien" }
      ];
    }else{
      headHtml += "<th>Nama Vaksin</th><th>ID Batch</th><th>Tanggal</th><th>Jumlah Pasien</th><th>Detail Pasien</th>";
      cols = [
        { data: "nama_vaksin" },
        { data: "id_batch" },
        { data: "so_date" },
        { data: "jumlah_pasien" },
        { data: "detail_pasien" }
      ];
    }

    $("#theadRow").html(headHtml);

    // DataTables versi theme kamu biasanya v1 (jQuery plugin)
    // PATCH: pakai style aman (fallback)
    dt = $("#tbl").DataTable({
      data: [],
      columns: cols,
      pageLength: 25,
      order: [],
      responsive: true,
      destroy: true
    });
  }

  function reload(){
    const url = (mode==="list") ? (baseUrl + "/api_list") : (baseUrl + "/api_matrix");
    const q = filters();

    $.ajax({
      url: url,
      method: "GET",
      data: q,
      dataType: "json",
      success: function(res){
        const rows = (res && res.data) ? res.data : [];
        dt.clear();
        dt.rows.add(rows).draw();
      },
      error: function(){
        dt.clear().draw();
        alert("Gagal load data laporan vaksinasi.");
      }
    });
  }

  function loadVaksinOptions(){
    $.getJSON(baseUrl + "/api_vaksin", function(res){
      const rows = (res && res.data) ? res.data : [];
      const $sel = $("#vaksin_id");
      rows.forEach(r => {
        $sel.append(`<option value="${escapeHtml(r.id_fa)}">${escapeHtml(r.name)}</option>`);
      });

      // select2 (tema)
      $sel.select2({ width: "100%" });
    });
  }

  function exportCsv(){
    const rows = dt.rows({ search: 'applied' }).data().toArray();
    if(!rows.length){
      alert("Data kosong, tidak ada yang diexport.");
      return;
    }

    let headers = [];
    if(mode==="list"){
      headers = ["nama_vaksin","id_batch","so_date","nama_pasien"];
    }else{
      headers = ["nama_vaksin","id_batch","so_date","jumlah_pasien","detail_pasien"];
    }

    const csv = [
      headers.join(","),
      ...rows.map(r => headers.map(h => csvCell(r[h])).join(","))
    ].join("\n");

    const blob = new Blob([csv], {type: "text/csv;charset=utf-8;"});
    const link = document.createElement("a");
    const url = URL.createObjectURL(blob);
    link.setAttribute("href", url);
    link.setAttribute("download", "laporan_vaksinasi_" + mode + ".csv");
    link.style.visibility = "hidden";
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    URL.revokeObjectURL(url);
  }

  function csvCell(v){
    v = (v === null || v === undefined) ? "" : String(v);
    v = v.replace(/"/g, '""');
    if(/[,\n]/.test(v)) return `"${v}"`;
    return v;
  }

  function escapeHtml(str){
    return String(str ?? "").replace(/[&<>"']/g, s => ({
      "&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#039;"
    }[s]));
  }

  // EVENTS
  $("#btnList").on("click", () => setMode("list"));
  $("#btnMatrix").on("click", () => setMode("matrix"));
  $("#btnApply").on("click", reload);
  $("#btnExportCsv").on("click", exportCsv);
  $("#btnReset").on("click", function(){
    $("#vaksin_id").val("").trigger("change");
    $("#nama_pasien").val("");
    $("#id_batch").val("");
    $("#date_from").val("");
    $("#date_to").val("");
    reload();
  });

  // init
  loadVaksinOptions();
  renderTable();
  reload();
})();
</script>

</body>
</html>
