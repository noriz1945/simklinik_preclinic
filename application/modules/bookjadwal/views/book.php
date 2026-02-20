<!DOCTYPE html>
<html lang="en">

<head>
<?php $this->theme->head('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/bookfnc/book-cmp-css.php');?>
<title>Dokter</title>

<style>
.calendar {
  display: grid;
  grid-template-rows: auto 1fr 1fr 1fr 1fr 1fr;
  grid-template-columns: repeat(7, minmax(120px, 1fr));
  gap: 0px 0px;
  background-color: white;
  overflow: auto;
}

.dayname {
  padding: 20px;
  text-align: left;
  text-transform: uppercase;
  color: #ffffff;
  overflow: hidden;
  background-color: #3DB176;
  font-weight: bold;
  line-height: 1;
}

.day {
  padding: 10px;
  background: linear-gradient(-145deg, transparent, rgba(0, 0, 0, 0.025));
  z-index: 1;
  position: relative;
  
}

.day .day-number {
  font-weight: bold;
}

.event {
  border-left-width: 3px; 
  padding: 8px 12px; 
  margin: 10px; 
  border-left-style: solid; 
  position: relative;
}

.event-weekend-1 {
  border-left-color: #fdb44d;
  grid-column: 2 / span 3;
  grid-row: 3;
  background: #fef0db;
  align-self: center;
  color: #fc9b10;
  margin-top: -5px;
}

.day:nth-of-type(7n + 7) {
  border-right: 0;
}
.day:nth-of-type(n + 1):nth-of-type(-n + 7) {
  grid-row: 2;
}
.day:nth-of-type(n + 8):nth-of-type(-n + 14) {
  grid-row: 3;
}
.day:nth-of-type(n + 15):nth-of-type(-n + 21) {
  grid-row: 4;
}
.day:nth-of-type(n + 22):nth-of-type(-n + 28) {
  grid-row: 5;
}
.day:nth-of-type(n + 29):nth-of-type(-n + 35) {
  grid-row: 6;
}
.day:nth-of-type(7n + 1) {
  grid-column: 1/1;
}
.day:nth-of-type(7n + 2) {
  grid-column: 2/2;
}
.day:nth-of-type(7n + 3) {
  grid-column: 3/3;
}
.day:nth-of-type(7n + 4) {
  grid-column: 4/4;
}
.day:nth-of-type(7n + 5) {
  grid-column: 5/5;
}
.day:nth-of-type(7n + 6) {
  grid-column: 6/6;
}
.day:nth-of-type(7n + 7) {
  grid-column: 7/7;
}
.day:hover {
  background-color:#93eded;
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

<div class="page-header card">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<i class="feather icon-book bg-c-red"></i>
<div class="d-inline">
<h5>Booking Jadwal Dokter</h5>
<span>TESTING MODE </span>
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
<a href="<?php echo base_url('bookjadwal/book'); ?>">Form Booking Jadwal</a>
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
<div class="card-header">
<h5>Jadwal Dokter</h5>
</div>
<div class="card-block">

<div class="row">

<div class="col-md-4">
<div class="form-group">
  <label for="message-text" class="col-form-label">Poli</label>
  <select class="form-control selmst_unit" id="id_unit" name="id_unit">
    <option selected default value="0">POLI</option>
  </select>
</div>
</div>

<div class="col-md-4">
<div class="form-group">
  <label for="message-text" class="col-form-label">Dokter</label>
  <select class="form-control selmst_dokter" id="id_dokter_search" name="id_dokter_search">
    <option selected default value="0">DOKTER</option>
  </select>
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label for="message-text" class="col-form-label">Bulan</label>
<select class="form-control selmst_bulan" id="selmst_bulan" name="selmst_bulan">
<option selected="selected" default value="0">BULAN</option>
<?php
$bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
$jlh_bln=count($bulan);
for($c=0; $c<$jlh_bln; $c+=1){
  if(strlen($c+1) < 2){ $c_set = "0".($c+1);} else { $c_set = ($c+1);}
echo"<option value=$c_set> $bulan[$c] </option>";
}
?>
</select>
</div>
</div>


</div>

  <div class="setcalendar"></div>
  <br>
  <hr>
  <div class="row">
  <div class="col-md-6">
    <div class="form-group">
    <div class="contslot">1</div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
    <div class="contcheckin">2</div>
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
<div id="styleSelector">
</div>
</div>


<div class="modal fade large-Modal" id="large-Modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog modal-lg" role="document" style="max-width: 1420px;">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Booking Jadwal Dokter</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" hidden>
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<input type="text" class="form-control slot_booknyah" id="slot_booknyah" name="slot_booknyah" readonly hidden>
<input type="text" class="form-control jamslot_booknyah" id="jamslot_booknyah" name="jamslot_booknyah" readonly hidden>
<input type="text" class="form-control harislot_booknyah" id="harislot_booknyah" name="harislot_booknyah" readonly hidden>
<input type="text" class="form-control tanggalslot_booknyah" id="tanggalslot_booknyah" name="tanggalslot_booknyah" readonly hidden>
<input type="text" class="form-control totalslot_booknyah" id="totalslot_booknyah" name="totalslot_booknyah" readonly hidden>
<input type="text" class="form-control getidpasien_booknyah" id="getidpasien_booknyah" name="getidpasien_booknyah" readonly hidden>
<input type="text" class="form-control getiddokter_booknyah" id="getiddokter_booknyah" name="getiddokter_booknyah" readonly hidden>
												
<div class="formbook_text"></div>
  <div class="card-block tab-icon formbook">
		<div class="row">
			<div class="col-md-12">
				<div class="sub-title">Silahkan Pilih Tab</div>
				<ul class="nav nav-tabs md-tabs " role="tablist">
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#tab_pas_lama" id="id_pas_lama" role="tab" aria-selected="false">
							<i class="icofont icofont-ui-user "></i>Pasien Lama </a>
						<div class="slide"></div>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#tab_pas_baru" id="id_pas_baru" role="tab" aria-selected="false">
							<i class="icofont icofont-ui-user"></i>Pasien Baru </a>
						<div class="slide"></div>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#tab_pas_aps" id="id_pas_aps" role="tab" aria-selected="false">
							<i class="icofont icofont-ui-user"></i>Pasien APS </a>
						<div class="slide"></div>
					</li>
				</ul>
				<div class="tab-content card-block">

        	<!-- START CONTENT TAB PASIEN LAMA -->
					<div class="tab-pane" id="tab_pas_checkin" role="tabpanel">
						0
					</div>
					<!-- END CONTENT TAB PASIEN LAMA -->
					
					<!-- START CONTENT TAB PASIEN LAMA -->
					<div class="tab-pane" id="tab_pas_lama" role="tabpanel">
						A
					</div>
					<!-- END CONTENT TAB PASIEN LAMA -->
					
					<!-- START CONTENT TAB PASIEN BARU -->
					<div class="tab-pane" id="tab_pas_baru" role="tabpanel">
						B
					</div>
					<!-- END CONTENT TAB PASIEN BARU -->
					
					<!-- START CONTENT TAB PASIEN APS -->
					<div class="tab-pane" id="tab_pas_aps" role="tabpanel">
						C
					</div>
					<!-- END CONTENT TAB PASIEN APS -->
				</div>
			</div>
			
		</div>
	</div>

<div class="modal-footer">
<button type="button" class="btn btn-default waves-effect" id="close_mod_booking">Close</button>
<!--<button type="button" class="btn btn-success waves-effect waves-light" id="sub_dokter">Simpan</button>-->
</div>
</div>

</div>
</div>
</div>

<div class="modal fade checkinlarge-Modal" id="large-Modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog modal-lg" role="document" style="max-width: 1420px;">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title">Checkin</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close" hidden>
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<input type="text" class="form-control slot_booknyah" id="slot_booknyah" name="slot_booknyah" readonly hidden>
<input type="text" class="form-control jamslot_booknyah" id="jamslot_booknyah" name="jamslot_booknyah" readonly hidden>
<input type="text" class="form-control tanggalslot_booknyah" id="tanggalslot_booknyah" name="tanggalslot_booknyah" readonly hidden>
<input type="text" class="form-control getidpasien_booknyah" id="getidpasien_booknyah" name="getidpasien_booknyah" readonly hidden>
<input type="text" class="form-control getiddokter_booknyah" id="getiddokter_booknyah" name="getiddokter_booknyah" readonly hidden>
<input type="text" class="form-control diagnosa_booknyah" id="diagnosa_booknyah" name="diagnosa_booknyah" readonly hidden>
												
<div class="formbook_text"></div>
  <div class="card-block tab-icon formbook">
		<div class="row">
			<div class="col-md-12">
      <div class="tabcheckin_validasi"></div>
			</div>
			
		</div>
	</div>

<div class="modal-footer">
<button type="button" class="btn btn-default waves-effect" id="close_mod_checkin">Close</button>
<!--<button type="button" class="btn btn-success waves-effect waves-light" id="sub_dokter">Simpan</button>-->
</div>
</div>

</div>
</div>
</div>
</body>

<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/bookfnc/book-cmp-js.php');?>
<script src=<?php echo base_url('assets/app_hn/bookfnc/fncbook.js'); ?>></script>