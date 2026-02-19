<!DOCTYPE html>
<html lang="en">

<head>
<?php $this->theme->head('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/jasmedfnc/mnu-cmp-css.php');?>
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
<a href="<?php echo base_url('jasmed/'); ?>">Jasa Dokter</a>
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
<form method="GET" action="<?php echo base_url('jasmed'); ?>">
<div class="form-group row">
<label class="col-sm-1 col-form-label">Tanggal : </label>
<div class="col-sm-2">
<input type="text" class="form-control" placeholder="Tanggal 1" id="date1" name="date1" value="<?php echo $date_range_1; ?>">
</div>
<label class="col-sm-1 col-form-label">:</label>
<div class="col-sm-2">
<input type="text" class="form-control" placeholder="Tanggal 2" id="date2" name="date2" value="<?php echo $date_range_2; ?>">
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
<label class="col-sm-1 col-form-label">Spesialis</label>
<div class="col-sm-2">
<select class="form-control js-example-basic-single col-sm-12" id="spesialisids" name="spesialisids">
<option value="0">Semua</option>
<?php foreach($spesialis as $datspesialis){ if($idspesialis==$datspesialis->id_spes){ $selspesialis="selected"; }else{ $selspesialis=""; } ?>
<option value="<?php echo $datspesialis->id_spes; ?>" <?php echo $selspesialis; ?>><?php echo $datspesialis->name; ?></option>
<?php } ?>
</select>
</div>
</div>

<div class="form-group row">


<label class="col-sm-1 col-form-label">Tindakan</label>
<div class="col-sm-2">
<select class="form-control js-example-basic-single col-sm-12" id="tindakanids" name="tindakanids">
<option value="0">Semua</option>
<?php foreach($tindakan as $dattindakan){ if($idtindakan==$dattindakan->id_act){ $seltindakan="selected"; }else{ $seltindakan=""; } ?>
<option value="<?php echo $dattindakan->id_act; ?>" <?php echo $seltindakan; ?>><?php echo $dattindakan->name; ?></option>
<?php } ?>
</select>
</div>
<label class="col-sm-1 col-form-label">Dokter</label>
<div class="col-sm-2">
<select class="form-control js-example-basic-single col-sm-12" id="iddokter" name="iddokter">
<option value="0">Semua</option>
<?php foreach($dokter as $datdokter){ if($iddokter==$datdokter->id_dokter){ $seldokter="selected"; }else{ $seldokter=""; }?>
<option value="<?php echo $datdokter->id_dokter; ?>" <?php echo $seldokter; ?>><?php echo $datdokter->name; ?></option>
<?php } ?>
</select>
</div>
<label class="col-sm-1 col-form-label">&nbsp;</label>
<div class="col-sm-2">
<button class="btn waves-effect waves-light btn-success" class="checkjasmed"><i class="fa fa-wpforms"></i>Lihat Jasa Dokter</button>
</div>
</div>

</form>
</div>
<div class="card-block">
<div class="dt-responsive table-responsive">
<table id="cbtn-selectors" class="table table-striped table-bordered nowrap">
<thead>
<tr bgcolor="#ACB4D8" align="center">
<td>DOKTER</td>
<td>SPESIALIS</td>
<td style="background-color:green;color:white;">TINDAKAN</td>
<td style="background-color:green;color:white;">PENJAMIN</td>
<td style="background-color:cornflowerblue;color:white;">TARIF TINDAKAN</td>
<td style="background-color:cornflowerblue;color:white;">PERSEN</td>
<td>JASA MEDIS</td>
<td>NO REG</td>
<td>NAMA PASIEN</td>
<td>RM</td>
</tr>
</thead>
<tbody>
<?php $nodata=1;
foreach($jasmed as $rsjasmed){ 


$dokter = $rsjasmed->dokter;
$splist = $rsjasmed->spesialis;
$tindakan = $rsjasmed->tindakan;
$tarif_tindakan = $rsjasmed->tarif_tindakan;

$rm = $rsjasmed->rm;
$nm_pasien = $rsjasmed->nm_pasien;
$no_daftar = $rsjasmed->no_daftar;
$tgl_tindakan = $rsjasmed->tgl_tindakan;
$tgl_pulang = $rsjasmed->tgl_pulang;
$kode_tindakan = $rsjasmed->kode_tindakan;

$qty_tindakan = $rsjasmed->qty_tindakan;

$share_dokter = $rsjasmed->share_dokter;
$layanan = $rsjasmed->layanan;
$instalasi = $rsjasmed->instalasi;
$penjamin = $rsjasmed->penjamin;

$jablist = $rsjasmed->jabatan_nama;
$createtime = $rsjasmed->create_time;
$tindakanpelayananid = $rsjasmed->tindakanpelayanan_id;

if($tarif_tindakan==0 || $tarif_tindakan==null){
    $jasa_medis = 0;
}else{
    $jasa_medis = ($tarif_tindakan / $share_dokter) * 100;
}

$totaljasmed = $totaljasmed + $jasa_medis;

if($splist==NULL){ $varcolorthisrow1 = "background-color:red;"; }else{ $varcolorthisrow1 = ""; }
if($jeniswaktukerja==NULL){ $varcolorthisrow2 = "background-color:red;"; }else{ $varcolorthisrow2 = ""; }
if($tindakan==NULL){ $varcolorthisrow3 = "background-color:red;"; }else{ $varcolorthisrow3 = ""; }
if($penjamin==NULL){ $varcolorthisrow4 = "background-color:red;"; }else{ $varcolorthisrow4 = ""; }
if($jablist==NULL){ $varcolorthisrow5 = "background-color:red;"; }else{ $varcolorthisrow5 = ""; }

$persen_1 = $rsjasmed->share_dokter;
$persen_2 = $rsjasmed->share_rs;
$jasmed_res_prc_1 = $jasa_medis - ($jasa_medis / 100)*$persen_1;
$jasmed_res = $jasmed_res_prc_1 - ($jasmed_res_prc_1 / 100)*$persen_2;


$summtotalgaji_total += $jasmed_res;
?>
<tr <?php echo $vardisthisrow; ?> class="edittind" data-toggle="modal" data-target=".edit" attr-data-namatindakan="<?php echo $rsjasmed->tindakan; ?>" attr-data-idtindakan="<?php echo $rsjasmed->daftartindakan_id; ?>" attr-data-idcarabayar="<?php echo $rsjasmed->carabayar_id; ?>" attr-data-jasmedpersen="<?php echo $rsjasmed->jasmed_persen; ?>" attr-data-jasmednominal="<?php echo $rsjasmed->jasmed_nominal; ?>" attr-data-mode="<?php echo $rsjasmed->mode; ?>" attr-data-note="<?php echo $rsjasmed->note; ?>" attr-data-penjamin="<?php echo $rsjasmed->penjamin; ?>" attr-data-jeniswaktu="<?php echo $jnswktid; ?>" attr-data-jeniswaktuid="<?php echo $rsjasmed->jeniswaktuid; ?>" attr-data-jnswktsetname="<?php echo $jeniswaktukerja; ?>" attr-data-spslist="<?php echo $splist; ?>" attr-data-jbnid="<?php echo $rsjasmed->jabatan_id; ?>" attr-data-jbnnm="<?php echo $rsjasmed->jabatan_nama; ?>" attr-data-insid="<?php echo $rsjasmed->kelaspelayanan_id; ?>" attr-data-persen1="<?php echo $rsjasmed->persen_1; ?>" attr-data-persen2="<?php echo $rsjasmed->persen_2; ?>">
<td><?php echo $dokter; ?> </td>
<td style="<?php echo $varcolorthisrow1; ?>">&nbsp;<?php echo $splist; ?> </td>
<td style="<?php echo $varcolorthisrow3; ?>">&nbsp;<?php echo $tindakan; ?></td>
<td style="<?php echo $varcolorthisrow4; ?>">&nbsp;<?php echo $penjamin; ?></td>
<td><?php echo number_format($tarif_tindakan); ?></td>
<td><?php echo number_format($share_dokter,1); ?>%</td>
<td><?php echo number_format($jasmed_res); ?></td>
<td><?php echo $no_daftar; ?></td>
<td><?php echo $nm_pasien; ?></td>
<td><?php echo $rm; ?></td>
</tr>
<?php } ?>
</tbody>
</table>

<?php echo "Total : Rp. ".number_format($summtotalgaji_total,0); ?>
</div>

</div>
</div>

</div>

</div>



</div>
</div>

</div>


<div class="modal fade edit" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title dtind" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
					<form>
                    <div class="modal-body">
                                <input type="text" class="form-control dtidt" readonly hidden>
								<input type="text" class="form-control dtcrb" readonly hidden>
                                <input type="text" class="form-control jeniswaktuid" readonly hidden>
                                <input type="text" class="form-control insid" readonly hidden>
                                <input type="text" class="form-control jbnid" readonly hidden>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Spesialis</label>
								<input type="text" class="form-control jbnnm" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">JENIS WAKTU KERJA</label>
								<input type="text" class="form-control jeniswaktu" readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">JENIS TARIF</label>
								<input type="text" class="form-control lbljnt" readonly>
                            </div>
                            <div class="form-group row">
                                <!--<label class="col-sm-2 col-form-label">% <small>M-0</small></label>
                                <div class="col-sm-3">
                                <input type="text" class="form-control dtjpr">
                                </div>
                                <label class="col-sm-2 col-form-label">Rp <small>M-1</small></label>
                                <div class="col-sm-3">
                                <input type="text" class="form-control dtjnm">
                                </div>-->
                                <label class="col-sm-2 col-form-label">% <small>M-0</small></label>
                                <div class="col-sm-4">
                                <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">
                                <input type="radio" id="dtmod0" name="dtmodrad" class="dtmodrad" value="0" aria-label="Mode 0">
                                </div>
                                </div>
                                <input type="text" class="form-control dtjpr" placeholder="% M-0" aria-label="% M-0">
                                </div>
                                </div>
                                <label class="col-sm-2 col-form-label">Rp <small>M-1</small></label>
                                <div class="col-sm-4">
                                <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">
                                <input type="radio" id="dtmod1" name="dtmodrad" class="dtmodrad" value="1" aria-label="Mode 1">
                                </div>
                                </div>
                                <input type="text" class="form-control dtjnm" placeholder="Rp M-1" aria-label="Rp M-1">
                                </div>
                                </div>
                                <input type="text" class="form-control dtmod" readonly hidden>
                            </div>
							<!--<div class="form-group">
                                <label for="exampleFormControlInput1">MODE</label>
                                <input type="text" class="form-control dtmod">
                            </div>-->
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">- % 1</label>
                                <div class="col-sm-3">
                                <input type="text" class="form-control persen_1" placeholder="%" id="persen_1" name="persen_1" value="10">
                                </div>
                                <label class="col-sm-2 col-form-label">- % 2</label>
                                <div class="col-sm-3">
                                <input type="text" class="form-control persen_2" placeholder="%" id="persen_2" name="persen_2" value="0">
                                </div>
                            </div>
							<div class="form-group">
                                <label for="exampleFormControlInput1">NOTE</label>
                                <textarea class="form-control dtnot" rows="5"></textarea>
                            </div>
                    </div>
					<div class="modal-footer">
                        <button type="button" id="updatetarif" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade edit2" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="width:1080px;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">List tindakan yang sudah di revisi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
					<form>
                    <div class="modal-body" >                               

                            <div class="form-group">
                            <div class="card-block contjasmedrevisi"></div>

                            </div>
                    </div>
                </div>
            </div>
        </div>

</body>

<?php $this->theme->wrapper_close('theme_default'); ?>
<?php $this->theme->script('theme_default'); ?>
<?php require_once(APPPATH.'../assets/app_hn/jasmedfnc/mnu-cmp-js.php');?>
<script src=<?php echo base_url('assets/app_hn/jasmedfnc/fncjasmed.js'); ?>></script>