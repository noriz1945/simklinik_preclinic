<!doctype html>
<html>
<head>
	 <meta http-equiv="refresh" content="40">
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="description" content="Aplikasi HIS Hasil Karya Anak Bangsa">
  <meta name="author" content="ICT - Sari Asih">
	<title>SmartPlus</title>
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/images/favicon.png">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/jquery-ui-1.12.1/jquery-ui.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/smartplus.css">
	<link href="<?php echo base_url(); ?>/assets/css/eresep.css" rel="stylesheet" type="text/css">
<style>
.table-responsive{
  min-height:80vh; 
	width:100%;
  overflow-y: auto;
  border:2px solid #444;
}
.table-responsive:hover{border-color:red;}

table{
	width:100%;
}
td{
	padding:24px; 
	background: none;
}
thead > tr > th {
	background-color: rgba(191,255,191,1.00);
	font-size:36px;
}
.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
	line-height: 20px;
	font-size: 16px;
}
.table td, .table th {
	padding: .40rem;
	padding-left: .50rem;
}
</style>
</head>
<body>
<div class="container-fluid">
	<div class="alert alert-success text-center" role="alert">
  	<h1>DISPLAY ANTRIAN e-RESEP</h1>
	</div>
  
	<div class="table-responsive">
		<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">NAMA<br>NO.RM</th>
      <th scope="col">PENJAMIN</th>
      <th scope="col">TANGGAL &amp; WAKTU ERESEP</th>
      <th scope="col">DOKTER</th>
      <th scope="col">JENIS RESEP</th>
      <!-- <th scope="col">ESTIMASI</th> -->
    </tr>
  </thead>
  <tbody>
  	<?php
			foreach($rs as $k => $v)
			{
    ?>
    <tr style="background-color: <?php echo $v['bgcolor']; ?>;">
      <td><strong><a href="#" onClick="javascript: print_eresep('<?php echo $v['id_eresep']; ?>'); "><span style="font-size:22px;"><?php echo $v['nama_pasien']; ?></span></a><br>
				<?php echo $v['id_pasien']; ?>&nbsp; - &nbsp;
        <?php echo $v['id_reg']; ?>
        </strong></td>
      <td><?php echo $v['penjamin']; ?></td>
      <td><?php echo $v['eresepdate']; ?></td>
      <td><?php echo $v['dokter']; ?></td>
      <td><?php echo $v['jenis_kemasan'] ?></td>
      <!-- <td><?php echo 'estimasi' ?></td> -->
    </tr>
    <?php
			}
    ?>
    <tr>
      <td colspan="6"><em>Data yang ditampilkan adalah data resep 12 jam sejak eResep dibuat oleh dokter. Setelah lewat 12 jam akan otomatis menghilang</em></td>
    </tr>
  </tbody>
</table>	
	</div>
  
</div>
<footer class="footer"></footer>
<script src="<?php echo base_url(); ?>/assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/jquery-ui-1.12.1/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/smartplus.js"></script>
<script>
print_
</script>
<script>
var $el = $(".table-responsive");
function anim() {
  var st = $el.scrollTop();
  var sb = $el.prop("scrollHeight")-$el.innerHeight();
  $el.animate({scrollTop: st<sb/2 ? sb : 0}, 20000, 'linear', anim);
}
function stop(){
  $el.stop();
}
anim();
</script>
<script language="javascript">
var popupWindow = null;
function centeredPopup(url,winName,w,h,scroll)
{
	LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
	TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
	settings =
	'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
	popupWindow = window.open(url,winName,settings)
}
function print_eresep(id_eresep)
{
	var url = '<?php echo base_url() ?>' + '/soap_eresep/print_eresep/' + id_eresep;
	var winName = 'Print eResep';
	var w	= '800';
	var h = '500';
	//var scroll = 'true';
	centeredPopup(url,winName,w,h,'yes')
}
</script>
</body>
</html>