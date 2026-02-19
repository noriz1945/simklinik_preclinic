<!doctype html>
<html>
<head>
<?php $this->theme->head('theme_default'); ?> 
<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-css.php');?>

<link href="https://cdn.datatables.net/v/dt/jq-3.7.0/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/fh-3.4.0/r-2.5.0/datatables.min.css" rel="stylesheet">

<title>Laporan Pendapatan Obat</title>

<style>
.header { position: sticky; top:0; }
.container-fix { height:56vh; overflow:auto; }
.btn { padding:4px 14px; }
a.btn-detail-obat { cursor:pointer; text-decoration:none; }
.modal-footer { background:#f8f9fa; }
.modal-xxl {
    max-width: 70% !important; /* bisa 90–98% */
}
.dot-notif {
    width:8px;
    height:8px;
    background:#e53935;
    border-radius:50%;
    display:inline-block;
}

</style>
</head>

<?php
// ================= DEFAULT TODAY =================
if (empty($tgl_awal))  $tgl_awal  = date('Y-m-d');
if (empty($tgl_akhir)) $tgl_akhir = date('Y-m-d');
?>

<?php $this->theme->wrapper_open('theme_default','BreadCrumb'); ?>

<div class="loader-bg">
    <div class="loader-bar"></div>
</div>

<div id="pcoded" class="pcoded">
<div class="pcoded-overlay-box"></div>
<div class="pcoded-container navbar-wrapper">
<div class="pcoded-main-container">
<div class="pcoded-wrapper">
<div class="pcoded-content">

<!-- ================= HEADER ================= -->
<div class="page-header card">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<i class="feather icon-activity bg-c-green"></i>
<div class="d-inline">
<h5>Laporan Farmasi</h5>
<span>Pendapatan Obat Berdasarkan Periode Tanggal</span>
</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class="breadcrumb breadcrumb-title">
<li class="breadcrumb-item">
<a href="<?php echo base_url('./'); ?>">
<i class="feather icon-home"></i>
</a>
</li>
<li class="breadcrumb-item">
<a href="#">Pendapatan Obat</a>
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

<div class="row">
<div class="col-sm-12">
<div class="card">
<div class="container-fluid">

<div class="card-block">

<!-- ================= FILTER ================= -->
<div class="row mb-3">
<div class="col-md-10">
<form class="form-inline"
      action="<?php echo site_url('v_pendapatan_obat/index'); ?>"
      method="get">

<div class="form-group mb-2">
<input type="text" class="form-control"
       id="tgl_awal" name="tgl_awal"
       value="<?php echo $tgl_awal; ?>">
</div>

<div class="form-group mx-sm-3 mb-2">
<input type="text" class="form-control"
       id="tgl_akhir" name="tgl_akhir"
       value="<?php echo $tgl_akhir; ?>">
</div>

<button type="submit" class="btn btn-success mb-2">
Tampilkan
</button>

</form>
</div>

<div class="col-md-2 text-right">
<h4 style="margin-top:4px;">
Total :
<br>
Rp <?php echo number_format($total,0,',','.'); ?>
</h4>
</div>
</div>

<!-- ================= TABEL ================= -->
<div class="table-responsive container-fix">
<table id="dt_table" class="table table-bordered table-hover table-striped">
<thead style="position:sticky;top:0" class="thead-light">
<tr>
    <th width="50">#</th>
    <th>Tanggal</th>
    <th>Jumlah Jenis Obat Terjual</th>
    <th>Jumlah Invoice</th>
    <th>Total Pendapatan</th>
</tr>
</thead>


<tbody>

<?php
$no = 1;
if (!empty($rows)):
foreach ($rows as $r):
?>
<tr>
<td><?php echo $no++; ?></td>

<td>
<div class="d-flex align-items-center">

    <!-- TANGGAL (TETAP KLIK MODAL) -->
    <a class="btn-detail-obat text-primary mr-2"
       data-tanggal="<?php echo $r->tanggal; ?>">
        <?php echo date('d-m-Y', strtotime($r->tanggal)); ?>
    </a>

    <!-- NOTIF IKON (INDIKATOR SAJA) -->
    <?php if ($r->total_invoice > 0): ?>
        <span class="badge badge-warning"
              title="Ada transaksi">
            Klik Tanggal untuk lihat detail...
        </span>
    <?php endif; ?>

</div>
</td>


<td class="text-center">
<?php echo number_format($r->total_item,0,',','.'); ?>
</td>

<td class="text-center">
<?php echo number_format($r->total_invoice,0,',','.'); ?>
</td>

<td class="text-right">
Rp <?php echo number_format($r->total_harian,0,',','.'); ?>
</td>
</tr>
<?php endforeach; else: ?>
<tr>
    <td>-</td>
    <td class="text-center"><span class="badge badge-warning"
              title="Ada transaksi">
            Pilih Tanggal Lain
        </span></td>
    <td class="text-center">Tidak ada data</td>
    <td>-</td>
    <td>-</td>
</tr>
<?php endif; ?>


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
</div>
</div>

<?php $this->theme->wrapper_close('theme_default'); ?>

<!-- ================= MODAL DETAIL OBAT ================= -->
<div class="modal fade" id="modalDetailObat" tabindex="-1">
<div class="modal-dialog modal-xl modal-xxl">
<div class="modal-content">

<div class="modal-header bg-success text-white">
<h5 class="modal-title">
Detail Obat - <span id="judulTanggal"></span>
</h5>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>

<div class="modal-body">
<div class="table-responsive">
<table class="table table-bordered table-striped">
<thead>
<tr>
    <th width="40">No</th>
    <th>Nama Obat</th>
    <th>ID Invoice</th>
    <th>Nama Pasien</th>
    <th width="70">Qty</th>
    <th width="120">Harga</th>
    <th width="140">Subtotal</th>
</tr>
</thead>

<tbody id="modalDetailBody">
<tr>
<td colspan="7" class="text-center">Loading...</td>
</tr>
</tbody>
</table>
</div>
</div>

<div class="modal-footer">
<div class="ml-auto">
<b>Grand Total :</b>
<span id="grandTotalModal" class="text-success">
Rp 0
</span>
</div>
</div>

</div>
</div>
</div>

<?php require_once(APPPATH.'../assets/app_hn/depofnc/mnu-cmp-js.php');?>

<!-- ================= DATEPICKER ================= -->
<script>
$('#tgl_awal, #tgl_akhir').datepicker({
    dateFormat:"yy-mm-dd",
    changeMonth:true,
    changeYear:true,
    maxDate:0
});
</script>

<!-- ================= DATATABLE ================= -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/v/dt/jq-3.7.0/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/fh-3.4.0/r-2.5.0/datatables.min.js"></script>

<script>
new DataTable('#dt_table',{
    pageLength:50,
    searching:false,
    paging:false,
    info:false,
    ordering:false,
    fixedHeader:true,
    dom:'Bfrtip',
    buttons:[
        {extend:'print', text:'Print'},
        {extend:'excel', text:'Export Excel'}
    ]
});
</script>

<!-- ================= MODAL AJAX ================= -->
<script>
$(document).on('click','.btn-detail-obat',function(){

    var tanggal = $(this).data('tanggal');

    $('#judulTanggal').text(tanggal);
    $('#grandTotalModal').text('Rp 0');
    $('#modalDetailBody').html(
        '<tr><td colspan="5" class="text-center">Loading...</td></tr>'
    );
    $('#modalDetailObat').modal('show');

    $.ajax({
        url : '<?php echo site_url("v_pendapatan_obat/detail_obat"); ?>',
        type: 'POST',
        dataType:'json',
        data:{
            tanggal : tanggal,
            '<?php echo $this->security->get_csrf_token_name(); ?>' :
            '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        success:function(res){

            var html = '';
            var no = 1;
        
            if (res.detail.length > 0) {
                $.each(res.detail,function(i,v){
                    html += '<tr>'+
                        '<td>'+no+'</td>'+
                        '<td>'+v.nama_obat+'</td>'+
                        '<td>'+v.id_inv+'</td>'+
                        '<td>'+ (v.nama_pasien ? v.nama_pasien : '-') +'</td>'+
                        '<td class="text-center">'+v.qty+'</td>'+
                        '<td class="text-right">Rp '+v.harga+'</td>'+
                        '<td class="text-right">Rp '+v.subtotal+'</td>'+
                    '</tr>';
                    no++;
                });
            } else {
                html = '<tr><td colspan="7" class="text-center">Tidak ada data</td></tr>';
            }
        
            $('#modalDetailBody').html(html);
            $('#grandTotalModal').text(
                'Rp ' + res.grand_total.toLocaleString('id-ID')
            );
        }


    });
});
</script>

</html>
