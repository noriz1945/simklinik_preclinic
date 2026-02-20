<!doctype html>
<html>
<head>
    <?php $this->theme->head('theme_default'); ?> 
    <?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>

    <style>
        tr td { vertical-align:middle!important; }
        .page-header.card { margin:5px 35px; }
        .thead-db { background:#85c440; color:white; font-weight:bold; }
    </style>

</head>

<?php $this->theme->wrapper_open('theme_default','BreadCrumb'); ?>

<div id="pcoded" class="pcoded">
<div class="pcoded-container navbar-wrapper">
<div class="pcoded-main-container">
<div class="pcoded-wrapper">
<div class="pcoded-content">

<div class="page-header card">
    <div class="row align-items-end">
        <div class="col-lg-8">
            <div class="page-header-title">
                <i class="feather icon-bar-chart bg-c-blue"></i>
                <div class="d-inline">
                    <h5>Dashboard Load Dokter</h5>
                    <span>Utilisasi Slot / Bulan</span>
                </div>
            </div>
        </div>

        <!-- ===== BUTTON KEMBALI ===== -->
        <div class="col-lg-4 text-right">
            <a href="<?= site_url('trx_reg_book'); ?>">
                <button class="btn btn-soft btn-soft-primary" style="border-radius:20px;">
                    <i class="fa fa-arrow-left"></i> Kembali ke Booking
                </button>
            </a>
        </div>
    </div>
</div>


<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">
<div class="page-body">

<div class="row"><div class="col-sm-12">

<div class="card">
<div class="container-fluid">
<div class="col-md-12 box-shadow--16dp">

<div class="card-block">

<form method="get">
<div class="row">
    <div class="col-md-2">
        <label>Bulan</label>
        <input type="number" name="bulan" class="form-control" min="1" max="12"
               value="<?= $bulan ?>">
    </div>

    <div class="col-md-2">
        <label>Tahun</label>
        <input type="number" name="tahun" class="form-control"
               value="<?= $tahun ?>">
    </div>

    <div class="col-md-2">
        <label>&nbsp;</label>
        <button class="btn btn-primary btn-block"><i class="fa fa-search"></i> Tampilkan</button>
    </div>
</div>
</form>

<br>

<canvas id="chartLoad"></canvas>

<hr>

<table class="table table-bordered table-striped">
<thead class="thead-db">
    <tr>
        <th>Dokter</th>
        <th>Slot Terisi</th>
        <th>Total Slot</th>
        <th>Utilisasi</th>
    </tr>
</thead>
<tbody>

<?php foreach($dokter_load as $d):
    $util = ($d['total_kapasitas'] > 0) ? round(($d['total_booking']*100)/$d['total_kapasitas'],1) : 0;
?>
<tr>
    <td><?= $d['nama_dokter'] ?></td>
    <td><?= $d['total_booking'] ?></td>
    <td><?= $d['total_kapasitas'] ?></td>
    <td><?= $util ?>%</td>
</tr>
<?php endforeach; ?>

</tbody>
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

<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-js.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
let ctx = document.getElementById('chartLoad').getContext('2d');

let labels = [
    <?php foreach($dokter_load as $d): ?>
        "<?= $d['nama_dokter'] ?>",
    <?php endforeach; ?>
];

let filledData = [
    <?php foreach($dokter_load as $d): ?>
        <?= $d['total_booking'] ?>,
    <?php endforeach; ?>
];

let capData = [
    <?php foreach($dokter_load as $d): ?>
        <?= $d['total_kapasitas'] ?>,
    <?php endforeach; ?>
];

new Chart(ctx, {
    type:'bar',
    data:{
        labels:labels,
        datasets:[
            { label:'Terisi', data:filledData, backgroundColor:'#4caf50' },
            { label:'Kapasitas', data:capData, backgroundColor:'#2196f3' }
        ]
    },
    options:{
        responsive:true,
        scales:{ y:{ beginAtZero:true } }
    }
});
</script>

</body>
</html>
