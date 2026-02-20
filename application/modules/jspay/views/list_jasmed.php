<!DOCTYPE html>
<html lang="en">

<head>
<?php $this->theme->head('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/jasmedpayrollfnc/mnu-cmp-css.php');?>
<title>Jasa Dokter</title>
</head>


<body>
<?php $this->theme->wrapper_open('theme_default'); ?>
<div class="pcoded-content">

<div class="pcoded-inner-content">

<div class="page-header card">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<i class="feather icon-feather bg-c-blue"></i>
<div class="d-inline">
<h5>Jasa Dokter</h5>

<span>Rincian Jasa Dokter</span>
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
<a href="<?php echo base_url('jspay/'); ?>">Jasa Dokter</a>
</li>
</ul>
</div>
</div>
</div>
</div>

<div class="main-body">
<div class="page-wrapper">

<div class="page-body">
<div class="row">

<div class="col-lg-12">

<div class="card">
<div class="card-header">
<h5>Data Jasmed</h5>
</div>
<div class="card-block">
<form id="theForm" method="GET" action="<?php echo base_url('jspay/'); ?>">
<div class="form-group row">
<label class="col-sm-1 col-form-label">Tanggal : </label>
<div class="col-sm-2">
<input type="text" class="form-control" placeholder="Tanggal 1" id="date1" name="date1" value="<?php echo $date_range_1; ?>">
</div>
<label class="col-sm-1 col-form-label">:</label>
<div class="col-sm-2">
<input type="text" class="form-control" placeholder="Tanggal 2" id="date2" name="date2" value="<?php echo $date_range_2; ?>">
</div>
<label class="col-sm-1 col-form-label">Dokter</label>
<div class="col-sm-2">
<select class="form-control js-example-basic-single col-sm-12" id="iddokter" name="iddokter">
<option value="-" <?php if($iddokter=="-"){ echo "selected";} ?> selected>Pilih Dokter</option>
<!--<option value="0" <?php if($iddokter=="0"){ echo "selected";} ?>>Semua</option>-->
<?php foreach($dokter as $datdokter){ if($iddokter==$datdokter->id_dokter){ $seldokter="selected"; }else{ $seldokter=""; }?>
<option value="<?php echo $datdokter->id_dokter; ?>" <?php echo $seldokter; ?>><?php echo $datdokter->name; ?></option>
<?php } ?>
</select>
</div>
<label class="col-sm-1 col-form-label">&nbsp;</label>
<div class="col-sm-2">
<button class="btn waves-effect waves-light btn-success searchset"><i class="fa fa-wpforms"></i>Lihat Jasa Dokter</button>
</div>
</div>

<!--<div class="form-group row">
<label class="col-sm-1 col-form-label">Spesialis</label>
<div class="col-sm-2">
<select class="form-control js-example-basic-single col-sm-12" id="spesialisids" name="spesialisids">
<option value="0">Semua</option>
<?php foreach($spesialis as $datspesialis){ if($idspesialis==$datspesialis->id_spes){ $selspesialis="selected"; }else{ $selspesialis=""; } ?>
<option value="<?php echo $datspesialis->id_spes; ?>" <?php echo $selspesialis; ?>><?php echo $datspesialis->name; ?></option>
<?php } ?>
</select>
</div>
<label class="col-sm-1 col-form-label">Tindakan</label>
<div class="col-sm-2">
<select class="form-control js-example-basic-single col-sm-12" id="tindakanids" name="tindakanids">
<option value="0">Semua</option>
<?php foreach($tindakan as $dattindakan){ if($idtindakan==$dattindakan->id_act){ $seltindakan="selected"; }else{ $seltindakan=""; } ?>
<option value="<?php echo $dattindakan->id_act; ?>" <?php echo $seltindakan; ?>><?php echo $dattindakan->name; ?></option>
<?php } ?>
</select>
</div>
<label class="col-sm-1 col-form-label">Penjamin</label>
<div class="col-sm-2">
<select class="form-control js-example-basic-single col-sm-12" id="penjaminids" name="penjaminids">
<option value="0" <?php if ($idpenjamin==0 ) { echo "selected";} ?>>Semua</option>
<?php foreach($penjamin as $datpenjamin){ if($idpenjamin==$datpenjamin->id_company){ $selpenjamin="selected"; }else{ $selpenjamin=""; } ?>
<option value="<?php echo $datpenjamin->id_company; ?>" <?php echo $selpenjamin; ?>><?php echo $datpenjamin->name; ?></option>
<?php } ?>
</select>
</div>
<label class="col-sm-1 col-form-label">&nbsp;</label>
<div class="col-sm-2">
<button class="btn waves-effect waves-light btn-success searchset"><i class="fa fa-wpforms"></i>Lihat Jasa Dokter</button>
</div>
</div>-->
</form>
</div>

</div>

<!--TAB-->
<div class="card">
<div class="card-header">
<h5>Proses Jasmed</h5>
</div>
<div class="card-block">
<div class="col-lg-12 col-xl-12">

<ul class="nav nav-tabs md-tabs " role="tablist">
<li class="nav-item">
<a class="nav-link active show setnotif" data-toggle="tab" href="#rincianjasamedis" role="tab" aria-selected="false"><i class="icofont icofont-list"></i> Rincian jasa medis</a>
<div class="slide"></div>
</li>
<li class="nav-item">
<a class="nav-link" data-toggle="tab" href="#checklistrincianjasamedis" role="tab" aria-selected="false"><i class="icofont icofont-check"></i> Checklist rincian jasa medis</a>
<div class="slide"></div>
</li>
<li class="nav-item">
<a class="nav-link" data-toggle="tab" href="#formslip" role="tab" aria-selected="false"><i class="icofont icofont-file-text"></i> Form slip</a>
<div class="slide"></div>
</li>
<li class="nav-item">
<a class="nav-link" data-toggle="tab" href="#draft" role="tab" aria-selected="true" id="listslipnyah"><i class="icofont icofont-ui-message"></i> Draft</a>
<div class="slide"></div>
</li>
</ul>

<div class="tab-content card-block">
<div class="tab-pane active show" id="rincianjasamedis" role="tabpanel">
<form method="POST" action="<?php echo base_url('jspay/setalljasmed/'.$date_range_1.'/'.$date_range_2.'/'.$iddokter.'/'.$idspesialis.'/'.$idtindakan.'/'.$idpenjamin); ?>">
<div class="card-block resjspay"></div>
<div class="form-group row">
<div class="col-sm-2 txtifkosong">
<button class="btn waves-effect waves-light btn-success" id="setallbtn" type="submit"><i class="fa fa-check"></i>Set All</button>
</div>
</div>
</form>
</div>
<div class="tab-pane" id="checklistrincianjasamedis" role="tabpanel">
<form method="POST" action="<?php echo base_url('jspay/setalljasmed_doneset/'.$date_range_1.'/'.$date_range_2.'/'.$iddokter.'/'.$idspesialis.'/'.$idtindakan.'/'.$idpenjamin); ?>">
<div class="card-block resjspay_doneset"></div>
<div class="form-group row">
<div class="col-sm-2 txtifkosong_doneset">
<button class="btn waves-effect waves-light btn-danger" id="setallbtn_doneset" type="submit"><i class="fa fa-ban"></i>Hapus</button>
</div>
</div>
</form>
</div>
<div class="tab-pane" id="formslip" role="tabpanel">

<form id="submitprosesgaji" method="POST" action="<?php echo base_url('jspay/jasmedslipprc/'.$date_range_1.'/'.$date_range_2.'/'.$iddokter.'/'.$idspesialis.'/'.$idtindakan.'/'.$idpenjamin); ?>">
<div class="table-responsive">
<table class="table table-hover m-b-0">
<thead>
<tr>
<th>Keterangan</th>
<th>&nbsp;</th>
</tr>
</thead>
<tbody>
<tr>
<td colspan="2" style="font-weight: bold;text-align:center;background-color:#10ebd8;color:white;">PENGHASILAN</td>
</tr>
<tr>
<td>1. Jasa / Tindakan Medis</td>
<td><input type="text" class="form-control" id="penghasilan_set" name="penghasilan_set" value="0" readonly></td>
</tr>
<tr>
<td colspan="2" style="font-weight: bold;text-align:center;background-color:#10ebd8;color:white;">PENGHASILAN TAMBAHAN</td>
</tr>
<tr>
<td>1. Upah Pokok</td>
<td><input type="text" class="form-control" id="penghasilan_add_1_set" name="penghasilan_add_1_set" value="0"></td>
</tr>
<tr>
<td>2. Tunjangan Fungsional</td>
<td><input type="text" class="form-control" id="penghasilan_add_2_set" name="penghasilan_add_2_set" value="0"></td>
</tr>
<tr>
<td>3. Tunjangan Transport</td>
<td>
<input type="text" class="form-control" id="penghasilan_add_3_set" name="penghasilan_add_3_set" value="0"></td>
</tr>
<tr>
<td>4. Jasa Medik Rawat Jalan</td>
<td><input type="text" class="form-control" id="penghasilan_add_4_set" name="penghasilan_add_4_set" value="0"></td>
</tr>
<tr>
<td colspan="2" style="font-weight: bold;text-align:center;background-color:#10ebd8;color:white;">POTONGAN TAMBAHAN</td>
</tr>
<tr>
<td>1. Bon Biaya berobat</td>
<td><input type="text" class="form-control" id="penghasilan_min_1_set" name="penghasilan_min_1_set" value="0"></td>
</tr>
<tr>
<td colspan="2" style="font-weight: bold;text-align:center;background-color:#10ebd8;color:white;">TOTAL</td>
</tr>
<tr>
<td style="font-weight: bold;text-align:left;">TOTAL PENGHASILAN </td>
<td><input type="text" class="form-control" id="penghasilan_total_set" name="penghasilan_total_set" value="0" readonly></td>
</tr>
<tr>
<td style="font-weight: bold;text-align:left;">TOTAL POTONGAN</td>
<td><input type="text" class="form-control" id="penghasilan_min_set" name="penghasilan_min_set" value="0" readonly></td>
</tr>
<tr>
<td style="font-weight: bold;text-align:left;">GRAND TOTAL</td>
<td><input type="text" class="form-control" id="penghasilan_grand_set" name="penghasilan_grand_set" value="0" readonly></td>
</tr>
</tbody>
</table>
</div>
</form>
<div class="form-group row">
<div class="col-sm-2">
<button class="btn waves-effect waves-light btn-success" id="kalkulasi_form" type="submit"><i class="fa fa-check"></i>Proses Draft</button>
</div>
</div>
</div>
<div class="tab-pane" id="draft" role="tabpanel">
<div class="card-block resjspay_doneset2"></div>
</div>
</div>
</div>

</div>
</div>
<!--END TAB-->


</div>

</div>


</div>
</div>

</div>


</body>

<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/jasmedpayrollfnc/mnu-cmp-js.php');?>
<script src=<?php echo base_url('assets/app_hn/jasmedpayrollfnc/fncjasmedp.js'); ?>></script>