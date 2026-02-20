<!doctype html>
<html>
<head> 
    <?php $this->theme->head('theme_default'); ?> 
    <?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>

    <style>
        body { background:#fdf5fb !important; }

        .btn {
            font-size: 12px;
            padding: 6px 14px;
            margin-right: 5px;
            min-width: 50px;
        }

        /* FRAME LAYOUT */
        .frame-left {
            border-right: 1px solid rgba(0,0,0,0.06);
            padding-right: 15px;
        }
        .frame-right {
            padding-left: 20px;
        }
        .frame-right-inner {
            position: sticky;
            top: 110px;
        }

        /* CARD STYLE */
        .card-soft {
            border-radius: 18px;
            border: none;
            box-shadow: 0 10px 25px rgba(0,0,0,0.06);
            background: linear-gradient(145deg, #ffffff, #fff7fb);
            padding: 14px 18px 18px 18px;
        }

        /* FILTER */
        .filter-box {
            margin-bottom: 10px;
            background: #ffffff;
            border-radius: 12px;
            padding: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.06);
        }

        /* KALENDAR GRID */
        .cal-container {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 8px;
            width: 100%;
        }

        .day-header {
            text-align:center;
            font-size:11px;
            font-weight:600;
            color:#b39ddb;
            margin-bottom:6px;
        }

        .cal-day {
            background: #fff;
            border-radius: 16px;
            padding: 10px;
            min-height: 90px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.05);
            cursor: pointer;
            transition: 0.15s;
            position: relative;
        }

        .cal-day:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(0,0,0,0.12);
        }

        .cal-day.empty {
            background: transparent !important;
            box-shadow:none !important;
            cursor: default !important;
        }

        .daynum {
            font-weight: 600;
            font-size: 13px;
            position: absolute;
            top: 6px;
            right: 10px;
            color:#555;
        }

        .badge-slot {
            margin-top: 28px;
            border-radius: 999px;
            padding: 5px 7px;
            font-size: 11px;
            display: inline-block;
            color: white;
            text-align:center;
        }

        .slot-free  { background:#66bb6a; }
        .slot-part  { background:#ffb74d; }
        .slot-full  { background:#ef5350; }
        .slot-cuti  { background:#9e9e9e; color:#333; }

        .cal-selected {
            background:#fde4f5 !important;
            border:1px solid #f48fb1;
        }

        .cal-header {
            display:flex;
            align-items:center;
            justify-content:space-between;
            margin-bottom:8px;
        }
        .cal-header-center {
            text-align:center;
            flex:1;
        }
        .cal-nav-btn {
            border-radius:999px;
            border:none;
            padding:4px 9px;
            background:#ffffff;
            box-shadow:0 2px 6px rgba(0,0,0,0.10);
            cursor:pointer;
        }
        .cal-nav-btn:hover {
            background:#f3e5f5;
        }
        .cal-title {
            font-weight:600;
            color:#e91e63;
            font-size:14px;
        }
        .cal-sub {
            font-size:11px;
            color:#999;
        }

        /* LIST SLOT / BOOKING */
        .thead-booking {
            background: linear-gradient(135deg,#aed581,#81c784);
            color:white;
            font-weight:bold;
        }

        .slot-row-filled td {
            background:#ffe4f2 !important;
        }
        .slot-row-free td {
            background:#f1f8e9 !important;
        }

        .slot-now td {
            background:#fff3e0 !important;
            border-left:4px solid #ff9800;
        }

        .badge-status {
            border-radius:999px;
            padding:3px 10px;
            font-size:11px;
        }
        .badge-menunggu {
            background:#fff3cd;
            color:#856404;
        }
        .badge-selesai {
            background:#c8e6c9;
            color:#1b5e20;
        }

        .btn-soft {
            border-radius:999px !important;
            border:none !important;
            box-shadow:0 4px 10px rgba(0,0,0,0.12);
        }
        .btn-soft-primary {
            background:linear-gradient(135deg,#7e57c2,#5c6bc0) !important;
            color:#fff !important;
        }

        .pcoded[theme-layout="horizontal"] .page-header {
            margin-top: 70px;
        }
        .page-header.card {
            margin: 5px 35px;
        }
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

    <!-- ========================= PAGE HEADER ========================= -->
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="feather icon-book bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>Booking Pasien</h5>
                        <span>Kalender Slot & List Booking Pasien</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url('./'); ?>"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?php echo site_url('trx_reg_book'); ?>">Booking Pasien</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <!-- ========================= CONTENT ========================= -->
    <div class="pcoded-inner-content">
    <div class="main-body">
    <div class="page-wrapper">
    <div class="page-body">

    <div class="row">
    <div class="col-sm-12">

    <div class="card">
    <div class="container-fluid">
    <div class="col-md-12 box-shadow--16dp">
    <div class="card-block">

<?php
// Fallback tanggal/bulan/tahun agar tidak error
$tanggal_selected = isset($f_tanggal) && $f_tanggal ? $f_tanggal : date("d-m-Y");
$bulan  = isset($bulan) && $bulan ? $bulan : date('m', strtotime($tanggal_selected));
$tahun  = isset($tahun) && $tahun ? $tahun : date('Y', strtotime($tanggal_selected));
if (!isset($kalender)) { $kalender = array(); }

// cari nama dokter
$nama_dokter = "Semua Dokter";
if (!empty($dokter) && !empty($f_dokter)) {
    foreach ($dokter as $d) {
        if ($d->id_dokter == $f_dokter) {
            $nama_dokter = $d->name;
            break;
        }
    }
}

// Untuk tombol prev/next bulan (pakai parameter tanggal)
$baseTs       = strtotime($tahun.'-'.$bulan.'-01');
$prevTs       = strtotime('-1 month', $baseTs);
$nextTs       = strtotime('+1 month', $baseTs);
$prevTanggal  = date('d-m-Y', $prevTs);
$nextTanggal  = date('d-m-Y', $nextTs);
?>

<div class="row">

    <!-- =================== FRAME KIRI — KALENDAR =================== -->
    <div class="col-md-5 frame-left">

        <!-- FILTER DOKTER -->
        <div class="filter-box">
            <label><b>Pilih Dokter</b></label>
            <select id="filterDokter" class="form-control">
                <option value="">-- Semua Dokter --</option>
                <?php foreach ($dokter as $d): ?>
                    <option value="<?= $d->id_dokter ?>" 
                        <?= ($f_dokter==$d->id_dokter ? 'selected' : '') ?>>
                        <?= $d->name ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="card-soft mb-3">
            <div class="cal-header">
                <button class="cal-nav-btn"
                        onclick="gotoMonth('<?= $prevTanggal ?>')">
                    <i class="fa fa-chevron-left"></i>
                </button>

                <div class="cal-header-center">
                    <div class="cal-title">Kalender Slot</div>
                    <div class="cal-sub">
                        <?= $nama_dokter ?> — <?= date('F Y', strtotime($tahun.'-'.$bulan.'-01')); ?>
                    </div>
                </div>

                <button class="cal-nav-btn"
                        onclick="gotoMonth('<?= $nextTanggal ?>')">
                    <i class="fa fa-chevron-right"></i>
                </button>
            </div>

            <!-- HEADER HARI -->
            <div class="cal-container">
                <div class="day-header">Min</div>
                <div class="day-header">Sen</div>
                <div class="day-header">Sel</div>
                <div class="day-header">Rab</div>
                <div class="day-header">Kam</div>
                <div class="day-header">Jum</div>
                <div class="day-header">Sab</div>
            </div>

            <?php
            $firstDow = date('w', strtotime($tahun.'-'.$bulan.'-01'));
            $maxDays  = cal_days_in_month(CAL_GREGORIAN, (int)$bulan, (int)$tahun);
            ?>

            <div class="cal-container">

                <!-- KOSONG DI AWAL -->
                <?php for ($i=0; $i<$firstDow; $i++): ?>
                    <div class="cal-day empty"></div>
                <?php endfor; ?>

                <!-- TANGGAL -->
                <?php for ($d=1; $d <= $maxDays; $d++): 
                    $tgl  = sprintf("%04d-%02d-%02d", $tahun, $bulan, $d);
                    $info = isset($kalender[$tgl]) ? $kalender[$tgl] : array(
                        'is_cuti'       => 0,
                        'kapasitas'     => 0,
                        'total_booking' => 0
                    );

                    if ($info['is_cuti']) {
                        $cls = "slot-cuti";
                    } else if ($info['kapasitas'] == 0) {
                        $cls = "slot-cuti";
                    } else {
                        $kap = $info['kapasitas'];
                        $isi = $info['total_booking'];
                        if ($isi == 0) {
                            $cls = "slot-free";
                        } else if ($isi < $kap) {
                            $cls = "slot-part";
                        } else {
                            $cls = "slot-full";
                        }
                    }
                ?>
                    <div class="cal-day" data-date="<?= $tgl ?>">
                        <div class="daynum"><?= $d ?></div>

                        <span class="badge-slot <?= $cls ?>">
                            <?php if ($info['is_cuti']): ?>
                                Cuti
                            <?php elseif ($info['kapasitas'] == 0): ?>
                                Tidak ada
                            <?php else: ?>
                                <?= $isi ?>/<?= $kap ?> slot
                            <?php endif; ?>
                        </span>
                    </div>
                <?php endfor; ?>

            </div>
        </div>
    </div>

    <!-- =================== FRAME KANAN — LIST SLOT =================== -->
    <div class="col-md-7 frame-right">
        <div class="frame-right-inner">

            <div class="card-soft mb-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div>
                        <div style="font-weight:600; color:#5e35b1;">List Slot & Booking</div>
                        <small style="color:#999;">
                            Tanggal terpilih: <span id="tagTanggal"><?= $tanggal_selected ?></span>
                        </small>
                    </div>
                    <a href="<?= site_url('trx_reg_book/dashboard?dokter='.$f_dokter); ?>">
                        <button class="btn btn-soft btn-soft-primary">
                            <i class="fa fa-chart-line"></i> Dashboard Dokter
                        </button>
                    </a>

                </div>

                <div id="bookingListArea">
                    <i style="color:#999;">Memuat daftar slot...</i>
                </div>

            </div>

        </div>
    </div>

</div><!-- ./row inner -->

    </div><!-- card-block -->
    </div><!-- col-md-12 -->
    </div><!-- container-fluid -->
    </div><!-- card -->
    </div><!-- col-sm-12 -->
    </div><!-- row -->

    </div><!-- page-body -->
    </div><!-- page-wrapper -->
    </div><!-- main-body -->
    </div><!-- pcoded-inner-content -->

</div>
</div>
</div>
</div>

<!-- ========================= GLOBAL MODAL AJAX ========================= -->
<div class="modal fade" id="modalGlobal">
  <div class="modal-dialog modal-xl">
    <div class="modal-content" id="modalGlobalContent">
        <div class="modal-body text-center p-5">
            <h5>Sedang memuat...</h5>
        </div>
    </div>
  </div>
</div>

<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-js.php'); ?>

<script>
/* ============ GOTO MONTH (NEXT/PREV) ============ */
function gotoMonth(tanggal) {
    var dokter = $("#filterDokter").val() || "";
    var url = "<?= site_url('trx_reg_book'); ?>?tanggal=" + encodeURIComponent(tanggal);
    if (dokter !== "") {
        url += "&dokter=" + encodeURIComponent(dokter);
    }
    window.location.href = url;
}

/* ============ MODAL ============ */
function loadModal(url, size) {
    if (!size) { size = "xl"; }
    $("#modalGlobal .modal-dialog")
        .removeClass().addClass("modal-dialog modal-" + size);

    $("#modalGlobalContent").html('<div class="modal-body text-center p-5">Memuat...</div>');
    $("#modalGlobal").modal("show");

    $.get(url, function(res){
        $("#modalGlobalContent").html(res);
    });
}

/* ============ FILTER DOKTER ============ */
$("#filterDokter").change(function(){
    var dokter = $(this).val();
    var tanggal = "<?= $tanggal_selected ?>";
    var url = "<?= site_url('trx_reg_book'); ?>?tanggal=" + encodeURIComponent(tanggal);
    if (dokter !== "") {
        url += "&dokter=" + encodeURIComponent(dokter);
    }
    window.location.href = url;
});

/* ============ LOAD SLOT / BOOKING ============ */
function loadBookingTanggal(tgl){
    $("#tagTanggal").text(tgl);
    $("#bookingListArea").html('<i style="color:#999;">Memuat...</i>');

    $.get("<?= site_url('trx_reg_book/list_ajax'); ?>",
        { tanggal: tgl, dokter: $("#filterDokter").val() },
        function(res){
            $("#bookingListArea").html(res);
        }
    );
}

/* ============ DRAG SELECT RANGE ============ */
var isDragging=false, startDate=null, lastDate=null;

function clearSelection(){ $(".cal-day").removeClass("cal-selected"); }

function markRange(a,b){
    clearSelection();
    if(!a || !b) { return; }

    var s = (a<b? a : b);
    var e = (a<b? b : a);

    $(".cal-day").each(function(){
        var d = $(this).data("date");
        if(!d) { return; }
        if(d>=s && d<=e) { $(this).addClass("cal-selected"); }
    });
}

$(".cal-day").mousedown(function(e){
    if($(this).hasClass("empty")) { return; }
    isDragging=true;
    startDate=$(this).data("date");
    lastDate=startDate;
    markRange(startDate,startDate);
    e.preventDefault();
});

$(".cal-day").mouseenter(function(){
    if(!isDragging || $(this).hasClass("empty")) { return; }
    lastDate=$(this).data("date");
    markRange(startDate,lastDate);
});

$(document).mouseup(function(){
    if(!isDragging) { return; }
    isDragging=false;
    var targetDate = lastDate ? lastDate : startDate;
    if(targetDate) { loadBookingTanggal(targetDate); }
});

/* ============ SINGLE CLICK ============ */
$(".cal-day").click(function(){
    if($(this).hasClass("empty")) { return; }
    if(isDragging) { return; }

    clearSelection();
    $(this).addClass("cal-selected");

    var t=$(this).data("date");
    loadBookingTanggal(t);
});

/* ============ LOAD AWAL ============ */
$(document).ready(function(){
    // mark selected date on calendar
    var initDate = "<?= $tanggal_selected ?>";
    clearSelection();
    $(".cal-day[data-date='"+initDate+"']").addClass("cal-selected");

    loadBookingTanggal(initDate);
});
</script>

</body>
</html>
