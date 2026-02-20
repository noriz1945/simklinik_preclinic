 <?php //$this->theme->head('theme_default'); ?>

 <style type="text/css">
/* Important part */
    .modal-dialog{
        width: 1280px;
        overflow-y: initial !important
		}
	.modal-body{
		height: 550px;
		overflow-y: auto;
		}
 </style>
<div class="container-fluid">
	<!-- Start Page Content -->
	<div class="row">
		<div class="col-lg-12">
			<div class="card card-outline-success">
				<div class="card-body">
				<form id="frm_lab_edit" action="<?php echo base_url(). 'lab/splab/update_aksi' . '/' . $optional_page; ?>" method="post">

<!-- Container fluid  -->
<div class="container-fluid">
<!-- Start Page Content -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-outline-success">
                <div class="card-header">
                <h4 class="m-b-0 text-white">EDIT Form SP Laboratorium</h4>
                </div>
    <div class="card-body">
        <form action="#">
        <div class="form-body">
    <h3 class="card-title m-t-15">FORMULIR PERMINTAAN PEMERIKSAAN LABORATORIUM</h3>
    <?php /*
<hr>
<div class="row p-t-20">
<div class="col-md-2">
<div class="form-group">
<input type="checkbox"> KARAWACI
<div class="input-group-addon">
<span class="glyphicon glyphicon-th"></span>
</div></div>
</div>
<!--/span-->
                                           
<div class="col-md-2">
<div class="form-group">
<input type="checkbox"> CILEDUG
<div class="input-group-addon">
<span class="glyphicon glyphicon-th"></span>
</div></div>
</div>
<!--/span-->
                                            
<div class="col-md-2">
<div class="form-group">
<input type="checkbox"> SANGIANG
<div class="input-group-addon">
<span class="glyphicon glyphicon-th"></span>
</div></div>
</div>
<!--/span-->
                                            
<div class="col-md-2">
<div class="form-group">
<input type="checkbox"> SERANG
<div class="input-group-addon">
<span class="glyphicon glyphicon-th"></span>
</div></div>
</div>
<!--/span-->
                                            
<div class="col-md-2">
<div class="form-group">
<input type="checkbox"> CIPUTAT
<div class="input-group-addon">
<span class="glyphicon glyphicon-th"></span>
</div></div>
</div>
<!--/span-->                                        
</div>
<!--/row-->
*/ ?>
						    
 <?php foreach($datPasien_na as $u){  ?>
 <h3 class="box-title m-t-40" style="color:black">Data Pasien</h3>
 <hr>

 <div class="row">
    <div class="col-md-6">
        <div class="form-group">
        <label class="control-label" style="color:black">Nama Pasien</label>
        <input type="text" name="nama" class="form-control" value="<?php echo $u->name; ?>" placeholder="Nama Pasien" readonly>
    </div>
 </div>
 <!--/span-->
 <div class="col-md-3">
    <div class="form-group">
    <label class="control-label" style="color:black">RM</label>
    <input type="text" name="rm" class="form-control" value="<?php echo $u->id_pasien; ?>" placeholder="ID Pasien" readonly>
    <input type="text" name="id_reg" class="form-control" value="<?php echo $u->id_reg; ?>" hidden="" readonly>
    </div>
 </div>
<!--/span-->
 <div class="col-md-3">
    <div class="form-group">
    <label class="control-label" style="color:black">Tanggal Input</label>
    <?php foreach($list_dat_sp_edit as $diag){ 
            $dateinputformat=date_create($diag->tgl_request);
            $dateinput=date_format($dateinputformat,"d-m-Y");                                                      
    ?>
    <input type="text" name="tgl_request" class="form-control" value="<?php echo $dateinput." ".$diag->jam; ?>" placeholder="Tanggal" readonly>
    <?php } ?>
    <?php $timenowhour=date('H:i:s'); $timenow=date('Y-m-d H:i:s'); ?>
    <input type="text" hidden="" class="form-control" value="<?php echo $timenowhour; ?>" placeholder="Jam" readonly>
    <input type="text" hidden="" name="jam_request" class="form-control" value="<?php echo $timenow; ?>" hidden="">
    <input type="text" hidden="" name="company" class="form-control" value="<?php echo $u->namaasuransi; ?>">
    <input type="text" hidden="" name="id_asuransi" class="form-control" value="<?php echo $u->id_asuransi; ?>">
    </div>
 </div>
<!--/span-->
 </div>
<!--/row-->
 <div class="row">
    <div class="col-md-6">
     <div class="form-group">
        <label class="control-label" style="color:black">Umur</label>
        <?php
            $tanggallahir = $u->birthdate;
            $tglnow2	= date("Y"); 
            $umurtahun 	= $tglnow2 - $tanggallahir;   
        ?>
        <input type="text" id="birthdate" class="form-control" value="<?php echo $umurtahun; ?>" placeholder="Umur" readonly>
        </div>
    </div>
<!--/span-->
    <div class="col-md-6">
    <div class="form-group">
    <label class="control-label" style="color:black">Dokter</label>
    <?php foreach($list_dat_sp_edit as $diag){ ?>
    <input type="text" name="dokter" class="form-control" value="<?php echo $diag->namadokter; ?>" placeholder="Nama Dokter" readonly>
    <?php } ?>
    </div>
    </div>
<!--/span-->
                                            
    <div class="col-md-6">
    <div class="form-group">
    <label class="control-label" style="color:black">Alamat / Telp</label>
    <input type="text" id="address" class="form-control" value="<?php echo $u->address; ?>"  placeholder="Alamat" readonly>
    </div>
    </div>
<!--/span-->
    <div class="col-md-6">
    <div class="form-group">
    <label class="control-label" style="color:black">Ruang</label>
    <?php 
    if ($u->rwjn==1) {$jenis1="Rawat jalan";
    $kelas="rwjn";
    } else {$jenis1="";}
    if ($u->rwip==1) {$jenis13="Rawat Inap";
    $kelas="rwip";
    } else {$jenis13="";}
    if ($u->ugd==1) { $jenis2="ugd";
    $kelas="ugd";
    } else {$jenis2="";} 
    ?>
    <input type="text" class="form-control" value="<?php echo $jenis1.$jenis2.$jenis13." ".$u->id_kamar." - ".$u->id_kelas; ?>" placeholder="Ruang Kelas" readonly>
    <input type="text" hidden="" name="kelas" value="<?php echo $kelas." ".$u->id_kamar." - ".$u->id_kelas; ?>">
    </div>
    </div>
<!--/span-->
                                                     
    <div class="col-md-6">
    <div class="form-group has-warning">
    <?php foreach($list_dat_sp_edit as $diag){ ?>
    <label class="control-label" style="color:black">Diagnosis / Keterangan Klinis</label>
    <textarea name="diag" class="form-control" rows="8"><?php echo $diag->diagnosa; ?></textarea>
    <input type="text" name="iddigital" value="<?php echo $diag->id_digital_request; ?>" hidden=""> 
    <?php } ?>
    </div>
    </div>
<!--/span-->

    <div class="col-md-6">
    <div class="form-group has-warning">
    <label class="control-label" style="color:black">Tanggal Periksa</label>
    <input type="text" name="tgl_proses" id="tgl_proses" class="form-control tanggaledit" value="<?php echo $diag->tgl_proses; ?>" placeholder="Tanggal Pemeriksaan">
    </div>
    </div>
<!--/span-->
    <div class="col-md-6">
    <div class="form-group has-warning">
    <label class="control-label" style="color:black">INDIKASI KLINIS</label>
    <textarea name="indikasi_klinis" class="form-control" rows="4"><?php echo $diag->indikasi_klinis; ?></textarea>
    </div>
    </div>
<!--/span-->
    </div>
    <?php } ?>
    </div>
    <!--/row-->   
    </div>
<?php
//]$data="How to split a string using explode";
//$splittedstring=explode(" ",$data);
//foreach ($splittedstring as $key => $value) {
//echo "splittedstring[".$key."] = ".$value."<br>";
//}
?>

<?php foreach($list_dat_sp_edit as $lst_dat_sp_edit){  
    $expdata=$lst_dat_sp_edit->tindakan_id ;
    $expdata2=$lst_dat_sp_edit->tindakan ;
}
        $splittedstring=explode(",",$expdata);
    $splittedstring_b=explode(",",$expdata2);
?>


<h3 class="card-title m-t-15" style="color:black"><strong>HEMATOLOGI - HEMOSTASIS</strong></h3>
<hr>
<div class="row p-t-20">
<div class="col-md-3">
<div class="form-group">
    <label style="color:black"><strong>HEMATOLOGI</strong></label>
    <?php $no=0; foreach($data_head_01 as $dh_01){ ?>
    <h6 style="color:black"><?php $no++; echo $no; ?>. 
    <!--real item start here-->
    <?php if($dh_01->checkbox==1){
          $chkortxt="checkbox";
          $classvar=""; 
    }else{
          $chkortxt="text";
          $classvar="form-control";
          } ?>
    <?php $hasilitem=$dh_01->id_item //var field id_item ?>
    <?php //proses explode array dari id_rindakan
    foreach ($splittedstring as $key => $hasilarr) {
    $hasila=$hasilarr;
    //echo "<br> hasil a ".$hasila."hasil b ".$hasilitem."<br>";
    if($hasilitem==$hasila){
    $check="checked";
    }else{
    $check="";
    } 
    //echo $check;
    ?>
    <input <?php echo $check; }//end if check ?> type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_01->id_item ?>]" value="<?php echo $dh_01->name_item ?>"> <?php echo $dh_01->name_item; ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_01->id_item ?>"></h6>    
    <!--/span-->
    <?php } ?>
    <div class="input-group-addon">
    <span class="glyphicon glyphicon-th"></span>
    </div></div>
    </div>
    <!--/span-->

<div class="col-md-2">
<div class="form-group">
<?php $no=8; foreach($data_head_02 as $dh_02){  ?>
	<h6 style="color:black"><?php $no++; echo $no; ?>. 
 <!--real item start here-->
	<?php if($dh_02->checkbox==1){
          $chkortxt="checkbox";
          $classvar=""; 
    }else{
          $chkortxt="text";
          $classvar="form-control";
          } ?>
    <?php $hasilitem=$dh_02->id_item //var field id_item ?>
    <?php //proses explode array dari id_rindakan
    foreach ($splittedstring as $key => $hasilarr) {
    $hasila=$hasilarr;
    //echo "<br> hasil a ".$hasila."hasil b ".$hasilitem."<br>";
    if($hasilitem==$hasila){
    $check="checked";
    }else{
    $check="";
    } 
    //echo $check;
    ?>
    <input <?php echo $check; }//end if check ?> type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_02->id_item ?>]" value="<?php echo $dh_02->name_item ?>"> <?php echo $dh_02->name_item; ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_02->id_item ?>"></h6> 
    <!--/span-->
    <?php } ?>
	<div class="input-group-addon">
	<span class="glyphicon glyphicon-th"></span>
	</div></div>
	</div>
	<!--/span-->
                                            
<div class="col-md-2">
<div class="form-group">
<?php $no=18; foreach($data_head_03 as $dh_03){  ?>
<h6 style="color:black"><?php $no++; echo $no; ?>. 
 <!--real item start here-->
	<?php if($dh_03->checkbox==1){
          $chkortxt="checkbox";
          $classvar=""; 
    }else{
          $chkortxt="text";
          $classvar="form-control";
          } ?>
    <?php $hasilitem=$dh_03->id_item //var field id_item ?>
    <?php //proses explode array dari id_rindakan
    foreach ($splittedstring as $key => $hasilarr) {
    $hasila=$hasilarr;
    //echo "<br> hasil a ".$hasila."hasil b ".$hasilitem."<br>";
    if($hasilitem==$hasila){
    $check="checked";
    }else{
    $check="";
    } 
    //echo $check;
    ?>
    <input <?php echo $check; }//end if check ?> type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_03->id_item ?>]" value="<?php echo $dh_03->name_item ?>"> <?php echo $dh_03->name_item; ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_03->id_item ?>"></h6>
    <!--/span-->
    <?php } ?>
	<div class="input-group-addon">
	<span class="glyphicon glyphicon-th"></span>
	</div></div>
	</div>
	<!--/span-->
                                            

	<div class="col-md-3">
	<div class="form-group">
	<label style="color:black"> <strong>HEMOSTASIS</strong></label>
	<?php $no=0; foreach($data_head_04 as $dh_04){  ?>
	<h6 style="color:black"><?php $no++; echo $no; ?>. 
 <!--real item start here-->
	<?php if($dh_04->checkbox==1){
          $chkortxt="checkbox";
          $classvar=""; 
    }else{
          $chkortxt="text";
          $classvar="form-control";
          } ?>
    <?php $hasilitem=$dh_04->id_item //var field id_item ?>
    <?php //proses explode array dari id_rindakan
    foreach ($splittedstring as $key => $hasilarr) {
    $hasila=$hasilarr;
    //echo "<br> hasil a ".$hasila."hasil b ".$hasilitem."<br>";
    if($hasilitem==$hasila){
    $check="checked";
    }else{
    $check="";
    } 
    //echo $check;
    ?>
    <input <?php echo $check; }//end if check ?> type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_04->id_item ?>]" value="<?php echo $dh_04->name_item ?>"> <?php echo $dh_04->name_item; ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_04->id_item ?>"></h6>
    <!--/span-->
    <?php } ?>
	<div class="input-group-addon">
	<span class="glyphicon glyphicon-th"></span>
	</div></div>
	</div>
	<!--/span-->
                                            
	<div class="col-md-2">
	<div class="form-group">
	<?php $no=9; foreach($data_head_05 as $dh_05){ ?>
	<h6 style="color:black"><?php $no++; echo $no; ?>. 
 <!--real item start here-->
	<?php if($dh_05->checkbox==1){
          $chkortxt="checkbox";
          $classvar=""; 
    }else{
          $chkortxt="text";
          $classvar="form-control";
          } ?>
    <?php $hasilitem=$dh_05->id_item //var field id_item ?>
    <?php //proses explode array dari id_rindakan
    foreach ($splittedstring as $key => $hasilarr) {
    $hasila=$hasilarr;
    //echo "<br> hasil a ".$hasila."hasil b ".$hasilitem."<br>";
    if($hasilitem==$hasila){
    $check="checked";
    }else{
    $check="";
    } 
    //echo $check;
    ?>
    <input <?php echo $check; }//end if check ?> type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_05->id_item ?>]" value="<?php echo $dh_05->name_item ?>"> <?php echo $dh_05->name_item; ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_05->id_item ?>"></h6>
    <!--/span-->
    <?php } ?>
	<div class="input-group-addon">
	<span class="glyphicon glyphicon-th"></span>
	</div></div>
	</div>
	<!--/span-->
	</div>
	<!--/row-->

	<!--2-->
	<h3 class="card-title m-t-15" style="color:black"><strong>KIMIA KLINIK</strong></h3>
	<hr>
	<div class="row p-t-20">
	<div class="col-md-3">
	<div class="form-group">
	<label style="color:black"><strong>FUNGSI HATI</strong></label>
	<?php $no=0; foreach($data_head_06 as $dh_06){  ?>
	<h6 style="color:black"><?php $no++; echo $no; ?>. 
 <!--real item start here-->
	<?php if($dh_06->checkbox==1){
          $chkortxt="checkbox";
          $classvar=""; 
    }else{
          $chkortxt="text";
          $classvar="form-control";
          } ?>
    <?php $hasilitem=$dh_06->id_item //var field id_item ?>
    <?php //proses explode array dari id_rindakan
    foreach ($splittedstring as $key => $hasilarr) {
    $hasila=$hasilarr;
    //echo "<br> hasil a ".$hasila."hasil b ".$hasilitem."<br>";
    if($hasilitem==$hasila){
    $check="checked";
    }else{
    $check="";
    } 
    //echo $check;
    ?>
    <input <?php echo $check; }//end if check ?> type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_06->id_item ?>]" value="<?php echo $dh_06->name_item ?>"> <?php echo $dh_06->name_item; ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_06->id_item ?>"></h6>
    <!--/span-->
    <?php } ?>
	<div class="input-group-addon">
	<span class="glyphicon glyphicon-th"></span>
	</div></div>
	</div>
	<!--/span-->
                                           
<div class="col-md-2">
<div class="form-group">
<label style="color:black"><strong>JANTUNG</strong></label>
<?php $no=0; foreach($data_head_07 as $dh_07){  ?>
	<h6 style="color:black"><?php $no++; echo $no; ?>. 
 <!--real item start here-->
	<?php if($dh_07->checkbox==1){
          $chkortxt="checkbox";
          $classvar=""; 
    }else{
          $chkortxt="text";
          $classvar="form-control";
          } ?>
    <?php $hasilitem=$dh_07->id_item //var field id_item ?>
    <?php //proses explode array dari id_rindakan
    foreach ($splittedstring as $key => $hasilarr) {
    $hasila=$hasilarr;
    //echo "<br> hasil a ".$hasila."hasil b ".$hasilitem."<br>";
    if($hasilitem==$hasila){
    $check="checked";
    }else{
    $check="";
    } 
    //echo $check;
    ?>
    <input <?php echo $check; }//end if check ?> type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_07->id_item ?>]" value="<?php echo $dh_07->name_item ?>"> <?php echo $dh_07->name_item; ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_07->id_item ?>"></h6>
    <!--/span-->
    <?php } ?>


<h6><label style="color:black"><strong>FUNGSI GINJAL</strong></label></h6>
<?php $no=0; foreach($data_head_08 as $dh_08){  ?>
	<h6 style="color:black"><?php $no++; echo $no; ?>. 
 <!--real item start here-->
	<?php if($dh_08->checkbox==1){
          $chkortxt="checkbox";
          $classvar=""; 
    }else{
          $chkortxt="text";
          $classvar="form-control";
          } ?>
    <?php $hasilitem=$dh_08->id_item //var field id_item ?>
    <?php //proses explode array dari id_rindakan
    foreach ($splittedstring as $key => $hasilarr) {
    $hasila=$hasilarr;
    //echo "<br> hasil a ".$hasila."hasil b ".$hasilitem."<br>";
    if($hasilitem==$hasila){
    $check="checked";
    }else{
    $check="";
    } 
    //echo $check;
    ?>
    <input <?php echo $check; }//end if check ?> type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_08->id_item ?>]" value="<?php echo $dh_08->name_item ?>"> <?php echo $dh_08->name_item; ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_08->id_item ?>"></h6>
    <!--/span-->
    <?php } ?>
<div class="input-group-addon">
<span class="glyphicon glyphicon-th"></span>
</div></div>
</div>
<!--/span-->
                                            

<div class="col-md-2">
<div class="form-group">
<label style="color:black"><strong>KARBOHIDRAT</strong></label>
<?php $no=0; foreach($data_head_09 as $dh_09){  ?>
	<h6 style="color:black"><?php $no++; echo $no; ?>. 
 <!--real item start here-->
	<?php if($dh_09->checkbox==1){
          $chkortxt="checkbox";
          $classvar=""; 
    }else{
          $chkortxt="text";
          $classvar="form-control";
          } ?>
    <?php $hasilitem=$dh_09->id_item //var field id_item ?>
    <?php //proses explode array dari id_rindakan
    foreach ($splittedstring as $key => $hasilarr) {
    $hasila=$hasilarr;
    //echo "<br> hasil a ".$hasila."hasil b ".$hasilitem."<br>";
    if($hasilitem==$hasila){
    $check="checked";
    }else{
    $check="";
    } 
    //echo $check;
    ?>
    <input <?php echo $check; }//end if check ?> type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_09->id_item ?>]" value="<?php echo $dh_09->name_item ?>"> <?php echo $dh_09->name_item; ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_09->id_item ?>"></h6>
    <!--/span-->
    <?php } ?>


<label style="color:black"><strong>PANKREAS</strong></label>
<?php $no=0; foreach($data_head_10 as $dh_10){  ?>
<h6 style="color:black"><?php $no++; echo $no; ?>. 
 <!--real item start here-->
	<?php if($dh_10->checkbox==1){
          $chkortxt="checkbox";
          $classvar=""; 
    }else{
          $chkortxt="text";
          $classvar="form-control";
          } ?>
    <?php $hasilitem=$dh_10->id_item //var field id_item ?>
    <?php //proses explode array dari id_rindakan
    foreach ($splittedstring as $key => $hasilarr) {
    $hasila=$hasilarr;
    //echo "<br> hasil a ".$hasila."hasil b ".$hasilitem."<br>";
    if($hasilitem==$hasila){
    $check="checked";
    }else{
    $check="";
    } 
    //echo $check;
    ?>
    <input <?php echo $check; }//end if check ?> type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_10->id_item ?>]" value="<?php echo $dh_10->name_item ?>"> <?php echo $dh_10->name_item; ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_10->id_item ?>"></h6>  
    <!--/span-->
    <?php } ?>
<div class="input-group-addon">
	<span class="glyphicon glyphicon-th"></span>
	</div></div>
	</div>
	<!--/span-->
                                            
	<div class="col-md-3">
	<div class="form-group">
	<label style="color:black"><strong>LEMAK*</strong></label>
	<?php $no=2; foreach($data_head_11 as $dh_11){  ?>
		<h6 style="color:black"><?php $no++; echo $no; ?>. 
 <!--real item start here-->
	<?php if($dh_11->checkbox==1){
          $chkortxt="checkbox";
          $classvar=""; 
    }else{
          $chkortxt="text";
          $classvar="form-control";
          } ?>
    <?php $hasilitem=$dh_11->id_item //var field id_item ?>
    <?php //proses explode array dari id_rindakan
    foreach ($splittedstring as $key => $hasilarr) {
    $hasila=$hasilarr;
    //echo "<br> hasil a ".$hasila."hasil b ".$hasilitem."<br>";
    if($hasilitem==$hasila){
    $check="checked";
    }else{
    $check="";
    } 
    //echo $check;
    ?>
    <input <?php echo $check; }//end if check ?> type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_11->id_item ?>]" value="<?php echo $dh_11->name_item ?>"> <?php echo $dh_11->name_item; ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_11->id_item ?>"></h6>
    <!--/span-->
    <?php } ?>

<h6><label style="color:black"><strong>ELEKTROliT & GAS DARAH</strong></label></h6>
	<?php $no=0; foreach($data_head_12 as $dh_12){  ?>
		<h6 style="color:black"><?php $no++; echo $no; ?>. 
 <!--real item start here-->
	<?php if($dh_12->checkbox==1){
          $chkortxt="checkbox";
          $classvar=""; 
    }else{
          $chkortxt="text";
          $classvar="form-control";
          } ?>
    <?php $hasilitem=$dh_12->id_item //var field id_item ?>
    <?php //proses explode array dari id_rindakan
    foreach ($splittedstring as $key => $hasilarr) {
    $hasila=$hasilarr;
    //echo "<br> hasil a ".$hasila."hasil b ".$hasilitem."<br>";
    if($hasilitem==$hasila){
    $check="checked";
    }else{
    $check="";
    } 
    //echo $check;
    ?>
    <input <?php echo $check; }//end if check ?> type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_12->id_item ?>]" value="<?php echo $dh_12->name_item ?>"> <?php echo $dh_12->name_item; ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_12->id_item ?>"></h6>
    <!--/span-->
    <?php } ?>
	<div class="input-group-addon">
	<span class="glyphicon glyphicon-th"></span>
	</div></div>
	</div>
	<!--/span-->
                                            
	<div class="col-md-2">
	<div class="form-group">
	<?php $no=3; foreach($data_head_13 as $dh_13){  ?>
		<h6 style="color:black"><?php $no++; echo $no; ?>. 
 <!--real item start here-->
	<?php if($dh_13->checkbox==1){
          $chkortxt="checkbox";
          $classvar=""; 
    }else{
          $chkortxt="text";
          $classvar="form-control";
          } ?>
    <?php $hasilitem=$dh_13->id_item //var field id_item ?>
    <?php //proses explode array dari id_rindakan
    foreach ($splittedstring as $key => $hasilarr) {
    $hasila=$hasilarr;
    //echo "<br> hasil a ".$hasila."hasil b ".$hasilitem."<br>";
    if($hasilitem==$hasila){
    $check="checked";
    }else{
    $check="";
    } 
    //echo $check;
    ?>
    <input <?php echo $check; }//end if check ?> type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_13->id_item ?>]" value="<?php echo $dh_13->name_item ?>"> <?php echo $dh_13->name_item; ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_13->id_item ?>"></h6>
    <!--/span-->
    <?php } ?>

<h6><label>&nbsp;</label></h6>
<label style="color:black"><strong>LAIN-LAIN</strong></label>
<?php $no=0; foreach($data_head_14 as $dh_14){  ?>
	<h6 style="color:black"><?php $no++; echo $no; ?>. 
 <!--real item start here-->
	<?php if($dh_14->checkbox==1){
          $chkortxt="checkbox";
          $classvar=""; 
    }else{
          $chkortxt="text";
          $classvar="form-control";
          } ?>
    <?php $hasilitem=$dh_14->id_item //var field id_item ?>
    <?php //proses explode array dari id_rindakan
    foreach ($splittedstring as $key => $hasilarr) {
    $hasila=$hasilarr;
    //echo "<br> hasil a ".$hasila."hasil b ".$hasilitem."<br>";
    if($hasilitem==$hasila){
    $check="checked";
    }else{
    $check="";
    } 
    //echo $check;
    ?>
    <input <?php echo $check; }//end if check ?> type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_14->id_item ?>]" value="<?php echo $dh_14->name_item ?>"> <?php echo $dh_14->name_item; ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_14->id_item ?>"></h6>
    <!--/span-->
    <?php } ?>
	<div class="input-group-addon">
	<span class="glyphicon glyphicon-th"></span>
	</div></div>
	</div>
	<!--/span-->
	</div>
	<!--/row-->

<!--3-->
	<h3 class="card-title m-t-15" style="color:black"><strong>IMUNO SEROLOGI</strong></h3>
	<hr>
	<div class="row p-t-20">
	<div class="col-md-3">
	<div class="form-group">
	<label style="color:black"><strong>UMUM</strong></label>
	<?php $no=0; foreach($data_head_15 as $dh_15){  ?>
		<h6 style="color:black"><?php $no++; echo $no; ?>. 
 <!--real item start here-->
	<?php if($dh_02->checkbox==1){
          $chkortxt="checkbox";
          $classvar=""; 
    }else{
          $chkortxt="text";
          $classvar="form-control";
          } ?>
    <?php $hasilitem=$dh_15->id_item //var field id_item ?>
    <?php //proses explode array dari id_rindakan
    foreach ($splittedstring as $key => $hasilarr) {
    $hasila=$hasilarr;
    //echo "<br> hasil a ".$hasila."hasil b ".$hasilitem."<br>";
    if($hasilitem==$hasila){
    $check="checked";
    }else{
    $check="";
    } 
    //echo $check;
    ?>
    <input <?php echo $check; }//end if check ?> type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_15->id_item ?>]" value="<?php echo $dh_15->name_item ?>"> <?php echo $dh_15->name_item; ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_15->id_item ?>"></h6>
    <!--/span-->
    <?php } ?>
	<div class="input-group-addon">
	<span class="glyphicon glyphicon-th"></span>
	</div></div>
	</div>
	<!--/span-->
                                           
<div class="col-md-2">
<div class="form-group">
<?php $no=16; foreach($data_head_16 as $dh_16){  ?>
	<h6 style="color:black"><?php $no++; echo $no; ?>. 
 <!--real item start here-->
	<?php if($dh_16->checkbox==1){
          $chkortxt="checkbox";
          $classvar=""; 
    }else{
          $chkortxt="text";
          $classvar="form-control";
          } ?>
    <?php $hasilitem=$dh_16->id_item //var field id_item ?>
    <?php //proses explode array dari id_rindakan
    foreach ($splittedstring as $key => $hasilarr) {
    $hasila=$hasilarr;
    //echo "<br> hasil a ".$hasila."hasil b ".$hasilitem."<br>";
    if($hasilitem==$hasila){
    $check="checked";
    }else{
    $check="";
    } 
    //echo $check;
    ?>
    <input <?php echo $check; }//end if check ?> type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_16->id_item ?>]" value="<?php echo $dh_16->name_item ?>"> <?php echo $dh_16->name_item; ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_16->id_item ?>"></h6>
    <!--/span-->
    <?php } ?>

<label style="color:black"><strong>HEPATITIS</strong></label>
<?php $no=0; foreach($data_head_17 as $dh_17){  ?>
	<h6 style="color:black"><?php $no++; echo $no; ?>. 
 <!--real item start here-->
	<?php if($dh_17->checkbox==1){
          $chkortxt="checkbox";
          $classvar=""; 
    }else{
          $chkortxt="text";
          $classvar="form-control";
          } ?>
    <?php $hasilitem=$dh_17->id_item //var field id_item ?>
    <?php //proses explode array dari id_rindakan
    foreach ($splittedstring as $key => $hasilarr) {
    $hasila=$hasilarr;
    //echo "<br> hasil a ".$hasila."hasil b ".$hasilitem."<br>";
    if($hasilitem==$hasila){
    $check="checked";
    }else{
    $check="";
    } 
    //echo $check;
    ?>
    <input <?php echo $check; }//end if check ?> type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_17->id_item ?>]" value="<?php echo $dh_17->name_item ?>"> <?php echo $dh_17->name_item; ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_17->id_item ?>"></h6>
    <!--/span-->
    <?php } ?>
<div class="input-group-addon">
<span class="glyphicon glyphicon-th"></span>
</div></div>
</div>
<!--/span-->
                                            
<div class="col-md-2">
<div class="form-group">
<label style="color:black"><strong>TUMOR MARKER</strong></label>
<?php $no=0; foreach($data_head_18 as $dh_18){  ?>
	<h6 style="color:black"><?php $no++; echo $no; ?>. 
 <!--real item start here-->
	<?php if($dh_18->checkbox==1){
          $chkortxt="checkbox";
          $classvar=""; 
    }else{
          $chkortxt="text";
          $classvar="form-control";
          } ?>
    <?php $hasilitem=$dh_18->id_item //var field id_item ?>
    <?php //proses explode array dari id_rindakan
    foreach ($splittedstring as $key => $hasilarr) {
    $hasila=$hasilarr;
    //echo "<br> hasil a ".$hasila."hasil b ".$hasilitem."<br>";
    if($hasilitem==$hasila){
    $check="checked";
    }else{
    $check="";
    } 
    //echo $check;
    ?>
    <input <?php echo $check; }//end if check ?> type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_18->id_item ?>]" value="<?php echo $dh_18->name_item ?>"> <?php echo $dh_18->name_item; ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_18->id_item ?>"></h6>
    <!--/span-->
    <?php } ?>


<h6><label style="color:black"><strong>PHS</strong></label></h6>
<?php $no=0; foreach($data_head_19 as $dh_19){  ?>
	<h6 style="color:black"><?php $no++; echo $no; ?>. 
 <!--real item start here-->
	<?php if($dh_19->checkbox==1){
          $chkortxt="checkbox";
          $classvar=""; 
    }else{
          $chkortxt="text";
          $classvar="form-control";
          } ?>
    <?php $hasilitem=$dh_19->id_item //var field id_item ?>
    <?php //proses explode array dari id_rindakan
    foreach ($splittedstring as $key => $hasilarr) {
    $hasila=$hasilarr;
    //echo "<br> hasil a ".$hasila."hasil b ".$hasilitem."<br>";
    if($hasilitem==$hasila){
    $check="checked";
    }else{
    $check="";
    } 
    //echo $check;
    ?>
    <input <?php echo $check; }//end if check ?> type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_19->id_item ?>]" value="<?php echo $dh_19->name_item ?>"> <?php echo $dh_19->name_item; ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_19->id_item ?>"></h6>
    <!--/span-->
    <?php } ?>
<div class="input-group-addon">
<span class="glyphicon glyphicon-th"></span>
</div></div>
</div>
<!--/span-->
                                            
<div class="col-md-3">
<div class="form-group">
<?php $no=3; foreach($data_head_20 as $dh_20){  ?>
	<h6 style="color:black"><?php $no++; echo $no; ?>. 
 <!--real item start here-->
	<?php if($dh_20->checkbox==1){
          $chkortxt="checkbox";
          $classvar=""; 
    }else{
          $chkortxt="text";
          $classvar="form-control";
          } ?>
    <?php $hasilitem=$dh_20->id_item //var field id_item ?>
    <?php //proses explode array dari id_rindakan
    foreach ($splittedstring as $key => $hasilarr) {
    $hasila=$hasilarr;
    //echo "<br> hasil a ".$hasila."hasil b ".$hasilitem."<br>";
    if($hasilitem==$hasila){
    $check="checked";
    }else{
    $check="";
    } 
    //echo $check;
    ?>
    <input <?php echo $check; }//end if check ?> type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_20->id_item ?>]" value="<?php echo $dh_20->name_item ?>"> <?php echo $dh_20->name_item; ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_20->id_item ?>"></h6>
    <!--/span-->
    <?php } ?>

<label style="color:black"><strong>HORMON</strong></label>
<?php $no=0; foreach($data_head_21 as $dh_21){  ?>
	<h6 style="color:black"><?php $no++; echo $no; ?>. 
 <!--real item start here-->
	<?php if($dh_21->checkbox==1){
          $chkortxt="checkbox";
          $classvar=""; 
    }else{
          $chkortxt="text";
          $classvar="form-control";
          } ?>
    <?php $hasilitem=$dh_21->id_item //var field id_item ?>
    <?php //proses explode array dari id_rindakan
    foreach ($splittedstring as $key => $hasilarr) {
    $hasila=$hasilarr;
    //echo "<br> hasil a ".$hasila."hasil b ".$hasilitem."<br>";
    if($hasilitem==$hasila){
    $check="checked";
    }else{
    $check="";
    } 
    //echo $check;
    ?>
    <input <?php echo $check; }//end if check ?> type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_21->id_item ?>]" value="<?php echo $dh_21->name_item ?>"> <?php echo $dh_21->name_item; ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_21->id_item ?>"></h6>
    <!--/span-->
    <?php } ?>
<div class="input-group-addon">
<span class="glyphicon glyphicon-th"></span>
</div></div>
</div>
<!--/span-->
                                            
<div class="col-md-2">
<div class="form-group">
<label style="color:black"><strong>TORCH</strong></label>
<?php $no=0; foreach($data_head_22 as $dh_22){  ?>
	<h6 style="color:black"><?php $no++; echo $no; ?>. 
 <!--real item start here-->
	<?php if($dh_22->checkbox==1){
          $chkortxt="checkbox";
          $classvar=""; 
    }else{
          $chkortxt="text";
          $classvar="form-control";
          } ?>
    <?php $hasilitem=$dh_22->id_item //var field id_item ?>
    <?php //proses explode array dari id_rindakan
    foreach ($splittedstring as $key => $hasilarr) {
    $hasila=$hasilarr;
    //echo "<br> hasil a ".$hasila."hasil b ".$hasilitem."<br>";
    if($hasilitem==$hasila){
    $check="checked";
    }else{
    $check="";
    } 
    //echo $check;
    ?>
    <input <?php echo $check; }//end if check ?> type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_22->id_item ?>]" value="<?php echo $dh_22->name_item ?>"> <?php echo $dh_22->name_item; ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_22->id_item ?>"></h6>
    <!--/span-->
    <?php } ?>


<div class="input-group-addon">
<span class="glyphicon glyphicon-th"></span>
</div></div>
</div>
<!--/span-->
</div>
<!--/row-->    

<!--4-->
<div class="row">
<div class="col-lg-3">
<h3 class="card-title m-t-15" style="color:black"><strong>URIN</strong></h3>
</div>
<div class="col-lg-1">
<h3 class="card-title m-t-15">&nbsp;</h3>
</div>
<div class="col-lg-2">
<h3 class="card-title m-t-15" style="color:black"><strong>FESES</strong></h3>
</div>
<div class="col-lg-3">
<h5 class="card-title m-t-15" style="color:black"><strong>CAIRAN TUBUH</strong></h5>
</div>
<div class="col-lg-2">
<h5 class="card-title m-t-15" style="color:black"><strong>SEKRET</strong></h5>
</div>
</div>
<hr>
<div class="row p-t-20">
<div class="col-md-2">

<div class="form-group">
<?php $no=0; foreach($data_head_24 as $dh_24){  ?>
	<h6 style="color:black"><?php $no++; echo $no; ?>. 
 <!--real item start here-->
	<?php if($dh_24->checkbox==1){
          $chkortxt="checkbox";
          $classvar=""; 
    }else{
          $chkortxt="text";
          $classvar="form-control";
          } ?>
    <?php $hasilitem=$dh_24->id_item //var field id_item ?>
    <?php //proses explode array dari id_rindakan
    foreach ($splittedstring as $key => $hasilarr) {
    $hasila=$hasilarr;
    //echo "<br> hasil a ".$hasila."hasil b ".$hasilitem."<br>";
    if($hasilitem==$hasila){
    $check="checked";
    }else{
    $check="";
    } 
    //echo $check;
    ?>
    <input <?php echo $check; }//end if check ?> type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_24->id_item ?>]" value="<?php echo $dh_24->name_item ?>"> <?php echo $dh_24->name_item; ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_24->id_item ?>"></h6> 
    <!--/span-->
    <?php } ?>
<div class="input-group-addon">
<span class="glyphicon glyphicon-th"></span>
</div></div>
</div>
<!--/span-->
                                           

<div class="col-md-2">
<div class="form-group">
<?php $no=6; foreach($data_head_25 as $dh_25){  ?>
	<h6 style="color:black"><?php $no++; echo $no; ?>. 
 <!--real item start here-->
	<?php if($dh_25->checkbox==1){
          $chkortxt="checkbox";
          $classvar=""; 
    }else{
          $chkortxt="text";
          $classvar="form-control";
          } ?>
    <?php $hasilitem=$dh_25->id_item //var field id_item ?>
    <?php //proses explode array dari id_rindakan
    foreach ($splittedstring as $key => $hasilarr) {
    $hasila=$hasilarr;
    //echo "<br> hasil a ".$hasila."hasil b ".$hasilitem."<br>";
    if($hasilitem==$hasila){
    $check="checked";
    }else{
    $check="";
    } 
    //echo $check;
    ?>
    <input <?php echo $check; }//end if check ?> type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_25->id_item ?>]" value="<?php echo $dh_25->name_item ?>"> <?php echo $dh_25->name_item; ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_25->id_item ?>"></h6>
    <!--/span-->
    <?php } ?>
<div class="input-group-addon">
<span class="glyphicon glyphicon-th"></span>
</div></div>
</div>
<!--/span-->
                                            

<div class="col-md-2">
<div class="form-group">
<?php $no=0; foreach($data_head_26 as $dh_26){  ?>
	<h6 style="color:black"><?php $no++; echo $no; ?>. 
 <!--real item start here-->
	<?php if($dh_26->checkbox==1){
          $chkortxt="checkbox";
          $classvar=""; 
    }else{
          $chkortxt="text";
          $classvar="form-control";
          } ?>
    <?php $hasilitem=$dh_26->id_item //var field id_item ?>
    <?php //proses explode array dari id_rindakan
    foreach ($splittedstring as $key => $hasilarr) {
    $hasila=$hasilarr;
    //echo "<br> hasil a ".$hasila."hasil b ".$hasilitem."<br>";
    if($hasilitem==$hasila){
    $check="checked";
    }else{
    $check="";
    } 
    //echo $check;
    ?>
    <input <?php echo $check; }//end if check ?> type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_26->id_item ?>]" value="<?php echo $dh_26->name_item ?>"> <?php echo $dh_26->name_item; ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_26->id_item ?>"></h6> 
    <!--/span-->
    <?php } ?>
<div class="input-group-addon">
<span class="glyphicon glyphicon-th"></span>
</div></div>
</div>
<!--/span-->
                                            
<div class="col-md-3">
<div class="form-group">
<?php $no=0; foreach($data_head_27 as $dh_27){  ?>
	<h6 style="color:black"><?php $no++; echo $no; ?>. 
 <!--real item start here-->
	<?php if($dh_27->checkbox==1){
          $chkortxt="checkbox";
          $classvar=""; 
    }else{
          $chkortxt="text";
          $classvar="form-control";
          } ?>
    <?php $hasilitem=$dh_27->id_item //var field id_item ?>
    <?php //proses explode array dari id_rindakan
    foreach ($splittedstring as $key => $hasilarr) {
    $hasila=$hasilarr;
    //echo "<br> hasil a ".$hasila."hasil b ".$hasilitem."<br>";
    if($hasilitem==$hasila){
    $check="checked";
    }else{
    $check="";
    } 
    //echo $check;
    ?>
    <input <?php echo $check; }//end if check ?> type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_27->id_item ?>]" value="<?php echo $dh_27->name_item ?>"> <?php echo $dh_27->name_item; ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_27->id_item ?>"></h6>  
    <!--/span-->
    <?php } ?>
<div class="input-group-addon">
<span class="glyphicon glyphicon-th"></span>
</div></div>
</div>
<!--/span-->
                                            
<div class="col-md-2">
<div class="form-group">
<?php $no=0; foreach($data_head_28 as $dh_28){  ?>
	<h6 style="color:black"><?php $no++; echo $no; ?>. 
 <!--real item start here-->
	<?php if($dh_28->checkbox==1){
          $chkortxt="checkbox";
          $classvar=""; 
    }else{
          $chkortxt="text";
          $classvar="form-control";
          } ?>
    <?php $hasilitem=$dh_28->id_item //var field id_item ?>
    <?php //proses explode array dari id_rindakan
    foreach ($splittedstring as $key => $hasilarr) {
    $hasila=$hasilarr;
    //echo "<br> hasil a ".$hasila."hasil b ".$hasilitem."<br>";
    if($hasilitem==$hasila){
    $check="checked";
    }else{
    $check="";
    } 
    //echo $check;
    ?>
    <input <?php echo $check; }//end if check ?> type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_28->id_item ?>]" value="<?php echo $dh_28->name_item ?>"> <?php echo $dh_28->name_item; ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_28->id_item ?>"></h6> 
    <!--/span-->
    <?php } ?>
<div class="input-group-addon">
<span class="glyphicon glyphicon-th"></span>
</div></div>
</div>
<!--/span-->
</div>
<!--/row-->    

<!--5-->
<div class="row">
<div class="col-lg-3">
<h3 class="card-title m-t-15" style="color:black"><strong>MIKROBIOLOGI</strong></h3>
</div>
<div class="col-lg-1">
<h3 class="card-title m-t-15">&nbsp;</h3>
</div>
<div class="col-lg-2">
<h3 class="card-title m-t-15">&nbsp;</h3>
</div>
<div class="col-lg-3">
<h5 class="card-title m-t-15" style="color:black"><strong>NAPZA</strong></h5>
</div>
<div class="col-lg-2">
<h5 class="card-title m-t-15">&nbsp;</h5>
</div>
</div>
<hr>
<div class="row p-t-20">
<div class="col-md-2">
<div class="form-group">
<label style="color:black"><strong>MIKROSKOPIK</strong></label>
<?php $no=0; foreach($data_head_29 as $dh_29){  ?>
	<h6 style="color:black"><?php $no++; echo $no; ?>. 
 <!--real item start here-->
	<?php if($dh_29->checkbox==1){
          $chkortxt="checkbox";
          $classvar=""; 
    }else{
          $chkortxt="text";
          $classvar="form-control";
          } ?>
    <?php $hasilitem=$dh_29->id_item //var field id_item ?>
    <?php //proses explode array dari id_rindakan
    foreach ($splittedstring as $key => $hasilarr) {
    $hasila=$hasilarr;
    //echo "<br> hasil a ".$hasila."hasil b ".$hasilitem."<br>";
    if($hasilitem==$hasila){
    $check="checked";
    }else{
    $check="";
    } 
    //echo $check;
    ?>
    <input <?php echo $check; }//end if check ?> type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_29->id_item ?>]" value="<?php echo $dh_29->name_item ?>"> <?php echo $dh_29->name_item; ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_29->id_item ?>"></h6>  
    <!--/span-->
    <?php } ?>
<div class="input-group-addon">
<span class="glyphicon glyphicon-th"></span>
</div></div>
</div>
<!--/span-->
                                           

<div class="col-md-2">
<div class="form-group">
<label style="color:black"><strong>BIAKAN & RESISTENSI</strong></label>
<?php $no=0; foreach($data_head_30 as $dh_30){  ?>
	<h6 style="color:black"><?php $no++; echo $no; ?>. 
 <!--real item start here-->
	<?php if($dh_30->checkbox==1){
          $chkortxt="checkbox";
          $classvar=""; 
    }else{
          $chkortxt="text";
          $classvar="form-control";
          } ?>
    <?php $hasilitem=$dh_30->id_item //var field id_item ?>
    <?php //proses explode array dari id_rindakan
    foreach ($splittedstring as $key => $hasilarr) {
    $hasila=$hasilarr;
    //echo "<br> hasil a ".$hasila."hasil b ".$hasilitem."<br>";
    if($hasilitem==$hasila){
    $check="checked";
    }else{
    $check="";
    } 
    //echo $check;
    ?>
    <input <?php echo $check; }//end if check ?> type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_30->id_item ?>]" value="<?php echo $dh_30->name_item ?>"> <?php echo $dh_30->name_item; ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_30->id_item ?>"></h6>
    <!--/span-->
    <?php } ?>
<div class="input-group-addon">
<span class="glyphicon glyphicon-th"></span>
</div></div>
</div>
<!--/span-->
                                            


<div class="col-md-2">
<div class="form-group">
<?php $no=3; foreach($data_head_31 as $dh_31){  ?>
	<h6 style="color:black"><?php $no++; echo $no; ?>. 
 <!--real item start here-->
	<?php if($dh_31->checkbox==1){
          $chkortxt="checkbox";
          $classvar=""; 
    }else{
          $chkortxt="text";
          $classvar="form-control";
          } ?>
    <?php $hasilitem=$dh_31->id_item //var field id_item ?>
    <?php //proses explode array dari id_rindakan
    foreach ($splittedstring as $key => $hasilarr) {
    $hasila=$hasilarr;
    //echo "<br> hasil a ".$hasila."hasil b ".$hasilitem."<br>";
    if($hasilitem==$hasila){
    $check="checked";
    }else{
    $check="";
    } 
    //echo $check;
    ?>
    <input <?php echo $check; }//end if check ?> type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_31->id_item ?>]" value="<?php echo $dh_31->name_item ?>"> <?php echo $dh_31->name_item; ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_31->id_item ?>"></h6>
    <!--/span-->
    <?php } ?>
<div class="input-group-addon">
<span class="glyphicon glyphicon-th"></span>
</div></div>
</div>
<!--/span-->
                                            
<div class="col-md-3">
<div class="form-group">
<?php $no=0; foreach($data_head_32 as $dh_32){  ?>
	<h6 style="color:black"><?php $no++; echo $no; ?>. 
 <!--real item start here-->
	<?php if($dh_32->checkbox==1){
          $chkortxt="checkbox";
          $classvar=""; 
    }else{
          $chkortxt="text";
          $classvar="form-control";
          } ?>
    <?php $hasilitem=$dh_32->id_item //var field id_item ?>
    <?php //proses explode array dari id_rindakan
    foreach ($splittedstring as $key => $hasilarr) {
    $hasila=$hasilarr;
    //echo "<br> hasil a ".$hasila."hasil b ".$hasilitem."<br>";
    if($hasilitem==$hasila){
    $check="checked";
    }else{
    $check="";
    } 
    //echo $check;
    ?>
    <input <?php echo $check; }//end if check ?> type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_32->id_item ?>]" value="<?php echo $dh_32->name_item ?>"> <?php echo $dh_32->name_item; ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_32->id_item ?>"></h6>
    <!--/span-->
    <?php } ?>
<div class="input-group-addon">
<span class="glyphicon glyphicon-th"></span>
</div></div>
</div>
<!--/span-->
                                            

<div class="col-md-2">
<div class="form-group">
<?php $no=4; foreach($data_head_33 as $dh_33){  ?>
	
 <!--real item start here-->
	<?php if($dh_33->checkbox==1){
        $chkortxt="checkbox";
        $classvar=""; 
        $hiddena="";
 }elseif($dh_33->checkbox==2){
        $chkortxt="text";
        $classvar="form-control";
        $hiddena="";
 }elseif($dh_33->checkbox==0){
         $chkortxt="text";
         $classvar="form-control";
         $hiddena="hidden";
          } ?>
    <h6 style="color:black" <?php echo $hiddena; ?>><?php $no++; echo $no; ?>. 
    <?php $hasilitem=$dh_33->id_item //var field id_item ?>
    <?php //proses explode array dari id_rindakan
    foreach ($splittedstring as $key => $hasilarr) {
    $hasila=$hasilarr;
    //echo "<br> hasil a ".$hasila."hasil b ".$hasilitem."<br>";
    if($hasilitem==$hasila){
    $check="checked";
    }else{
    $check="";
    }
    //echo $check;
    ?>
    <input <?php echo $check; }//end if check ?> type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" <?php echo $hiddena; ?> name="tindakan[<?php echo $dh_33->id_item ?>]" value="<?php echo $dh_33->name_item ?>"> <?php echo $dh_33->name_item; ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_33->id_item ?>"></h6>
    <!--/span-->
    <?php } ?>
<div class="input-group-addon">
<span class="glyphicon glyphicon-th"></span>
</div></div>
</div>
<!--/span-->
</div>
<!--/row-->    

<!--6-->
<div class="row">
<div class="col-lg-3">
<h3 class="card-title m-t-15" style="color:black"><strong>KETERANGAN</strong></h3>
</div>
<div class="col-lg-1">
<h3 class="card-title m-t-15">&nbsp;</h3>
</div>
<div class="col-lg-2">
<h3 class="card-title m-t-15" style="color:black"><strong>CITO</strong></h3>
</div>
<div class="col-lg-3">
<h5 class="card-title m-t-15" style="color:black"><strong>LAIN-LAIN</strong></h5>
</div>
<div class="col-lg-3">
<h5 class="card-title m-t-15" style="color:black" hidden><strong>DOKTER PENGIRIM</strong></h5>
</div>
</div>
<hr>
<div class="row p-t-20">
<div class="col-md-2">
<div class="form-group">
<h6 style="color:black"><strong>* Puasa 12 jam</strong></h6>
<h6 style="color:black"><strong>** Urin 24 jam</strong></h6>
<div class="input-group-addon">
<span class="glyphicon glyphicon-th"></span>
</div></div>
</div>
<!--/span-->
                                           
<div class="col-md-2">
<div class="form-group">
<h6>&nbsp;</h6>
<h6>&nbsp;</h6>
<div class="input-group-addon">
<span class="glyphicon glyphicon-th"></span>
</div></div>
</div>
<!--/span-->
                                            

<div class="col-md-2">
<div class="form-group">
<?php  foreach($list_dat_sp_edit as $hslkrm){
if($hslkrman=$hslkrm->cito==1){
      $varhsl="checked";
}else{             
      $varhsl="";
}
?>
<!--<li><input type="checkbox" name="hasildd" value="0" <?php echo $varhsl; ?>> Hasil dikirim ke dokter</li> -->
<li><input type="checkbox" name="cito" value="1" <?php echo $varhsl; ?>> <strong style="color:black">CITO</strong></li> 
<?php } ?>
<div class="input-group-addon">
<span class="glyphicon glyphicon-th"></span>
</div>
</div>
</div>
<!--/span-->

<div class="col-md-3">
<div class="form-group has-warning">
<?php foreach($list_dat_sp_edit as $lainlain){  ?>
	<textarea name="lainlain" class="form-control" rows="8"> <?php echo $lainlain->lainlain ?></textarea>    
    <!--/span-->
    <?php } ?>
<div class="input-group-addon">
<span class="glyphicon glyphicon-th"></span>
</div>
</div>
</div>
<!--/span-->


<div class="col-md-2">
<div class="form-group">
<div class="input-group-addon">
<span class="glyphicon glyphicon-th"></span>
</div>
</div>
</div>
<!--/span-->
                              

                                            

<div class="col-md-2">
<div class="form-group">
<?php foreach($mst_dokter_dta_na as $dkt){ ?>                                                
<h6><input type="text" class="form-control" name="dokpeng" value="<?php echo $dkt->name; ?>" hidden></h6>
<?php } ?>
<div class="input-group-addon">
<span class="glyphicon glyphicon-th"></span>
</div></div>
</div>
<!--/span-->
</div>
<!--/row-->    
<div class="form-actions">
<button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Update</button>
<button type="button" class="btn btn-inverse" data-dismiss="modal">Cancel</button>
</div>
</form>
                            </div>
                        </div>
                    </div>
                            
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End PAge Content -->
            </div>
            <!-- End Container fluid  -->
            <?php $this->theme->script('theme_default'); ?>
<script>
	// Date picker only
	$('.tanggal').datepicker({
		dateFormat: "yy-mm-dd",
		autoclose: true,
		language: 'id',
	});

	$(".tanggal").datepicker("setDate", new Date());

    // Date picker only
	$('.tanggalcr').datepicker({
		dateFormat: "yy-mm-dd",
		autoclose: true,
		language: 'id',
	});

	$(".tanggalcr").datepicker("setDate", new Date());

            // Date picker only
	$('.tanggaledit').datepicker({
		dateFormat: "yy-mm-dd",
		autoclose: true,
		language: 'id',
	});

	$(".tanggaledit").datepicker();
</script>
				</div>

			</div>
		</div>
	</div>
	<!-- End Page Content -->
</div>
<script>
var optional_page ='<?php echo $optional_page; ?>';
if(optional_page!='')
{
	$('#frm_lab_edit').submit(function(event) {
		event.preventDefault(); //prevent default action 
	
		var post_url = $(this).attr("action"); //get form action url
		var form_data = $(this).serialize(); //Encode form elements for submission
	
		$.post(post_url, form_data, function(response) {
			//$("#box_new_eresep").html(response);
			alert('Response :' + response);
			inner_loader('<?php echo base_url('lab/splab/lab_modal_lad/'.$id_reg.'/asm_ri') ?>', '#loader_box_lab', false, '');
			$('#Modallabmod').modal('hide');
		});
	});
}
</script>