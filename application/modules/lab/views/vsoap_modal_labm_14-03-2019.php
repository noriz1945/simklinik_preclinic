<head>
	<?php $this->theme->head('theme_default'); ?>

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
</head>
<div class="container-fluid">
<!-- Start Page Content -->
	<div class="row">
		<div class="col-lg-12">
		<div class="card card-outline-success">
		<div class="card-body">
	<form action="<?php echo base_url(). 'lab/splab/tambah_aksi'; ?>" method="post">
<!-- Container fluid  -->
<div class="container-fluid">
<!-- Start Page Content -->
        <div class="row">
        <div class="col-lg-12">
        <div class="card card-outline-success">
        <div class="card-header">
        <h4 class="m-b-0 text-white"><!--<img src="<?php echo base_url(). 'assets/img/logo-mainV1.png'; ?>" width="50" height="50" style="color:black">RUMAH SAKIT SARI ASIH <small>KARAWACI</small>--> FORM SP Laboratorium</h4>
        </div>
        <div class="card-body">
        <form action="#">
        <div class="form-body">
        <h3 class="card-title m-t-15">FORMULIR PERMINTAAN PEMERIKSAAN LABORATORIUM</h3>
<?php /* di hidden dulu <hr>
            <div class="row p-t-20">
            <div class="col-md-2">
            <div class="form-group">
            <input type="checkbox" name="cabangid" value="1"> KARAWACI
            <div class="input-group-addon">
            <span class="glyphicon glyphicon-th"></span>
            </div></div></div>
<!--/span-->
                                           
            <div class="col-md-2">
            <div class="form-group">
            <input type="checkbox" name="cabangid" value="2"> CILEDUG
            <div class="input-group-addon">
            <span class="glyphicon glyphicon-th"></span>
            </div></div></div>
<!--/span-->
                                            
            <div class="col-md-2">
            <div class="form-group">
            <input type="checkbox" name="cabangid" value="3"> SANGIANG
            <div class="input-group-addon">
            <span class="glyphicon glyphicon-th"></span>
            </div></div></div>
<!--/span-->
                                            
            <div class="col-md-2">
            <div class="form-group">
            <input type="checkbox" name="cabangid" value="4"> SERANG
            <div class="input-group-addon">
            <span class="glyphicon glyphicon-th"></span>
            </div></div></div>
<!--/span-->
                                            
            <div class="col-md-2">
            <div class="form-group">
            <input type="checkbox" name="cabangid" value="5"> CIPUTAT
            <div class="input-group-addon">
            <span class="glyphicon glyphicon-th"></span>
            </div></div></div>
<!--/span-->
                                           
</div>
<!--/row-->
di hidden dulu */?>
<?php foreach($datPasien as $u){  ?>
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
        <input type="text" name="tgl_request" class="form-control tanggalcr"  placeholder="Tanggal" readonly>
    <?php $hournow=date('H:i:s') ?>
        <input type="text" hidden="" name="jam_request" class="form-control" value="<?php echo $hournow; ?>"  readonly>
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
<?php //untuk kondisi dokter IGD //
    foreach($mst_dokter_dta_igd as $dta_dokter_igd){ ?>
<?php
    if($dta_dokter_igd->id_dokter === null || $dta_dokter_igd->id_dokter === ''){
    foreach($mst_dokter_dta as $dta_dokter){
    $namedokternya=$dta_dokter->name;
    $iddokternya=$dta_dokter->id_dokter;
    }// tutup foreach dr poli                                                
    }else{
    $namedokternya=$dta_dokter_igd->name;
    $iddokternya=$dta_dokter_igd->id_dokter;                                               
    }    
?>
    <input type="text" name="dokter" class="form-control" value="<?php echo $namedokternya; ?>" placeholder="Nama Dokter" readonly>
    <input type="text" name="iddokter" hidden="" value="<?php echo $iddokternya; ?>">
<?php }// tutup foreach dr igd?>
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
    <input type="text" hidden="" name="company" class="form-control" value="<?php echo $u->namaasuransi; ?>">
    <input type="text" hidden="" name="id_asuransi" class="form-control" value="<?php echo $u->id_asuransi; ?>">
    </div>
    </div>
<!--/span-->
                                                
    <div class="col-md-6">
    <div class="form-group has-warning">
        <label class="control-label" style="color:black">Diagnosis / Keterangan Klinis</label>
        <textarea name="diag" class="form-control" rows="8" required></textarea>
    </div>
    </div>
<!--/span-->

    <div class="col-md-6">
    <div class="form-group has-warning">
        <label class="control-label" style="color:black">Tanggal Periksa</label>
        <input type="text" name="tgl_proses" id="tgl_proses" class="form-control tanggal" placeholder="Tanggal Pemeriksaan">
    </div>
    </div>
<!--/span-->

    <div class="col-md-6">
    <div class="form-group has-warning">
        <label class="control-label" style="color:black">INDIKASI KLINIS</label>
        <textarea name="indikasi_klinis" class="form-control" rows="4" required></textarea>
    </div>
    </div>
<!--/span-->
    </div>
<!--/row-->   
<?php } ?>
<!--</div>-->

<h3 class="card-title m-t-15" style="color:black"><strong>HEMATOLOGI - HEMOSTASIS</strong></h3>
    <hr>
    <div class="row p-t-20">
    <div class="col-md-3">
    <div class="form-group">
    <label style="color:black"><strong>HEMATOLOGI</strong></label>
<?php $no=0; foreach($data_head_01 as $dh_01){  ?>
<!--real item start here-->
<?php if($dh_01->checkbox==1){
        $chkortxt="checkbox";
        $classvar=""; 
    }elseif($dh_01->checkbox==2){
        $chkortxt="text";
        $classvar="form-control";
} ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_01->id_item ?>">
    <h6 style="color:black"><?php $no++; echo $no; ?>. <input type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_01->id_item ?>]" value="<?php echo $dh_01->name_item ?>"> <?php echo $dh_01->name_item; ?></h6>                          
<!--/span-->
<?php } ?>
    <div class="input-group-addon">
    <span class="glyphicon glyphicon-th"></span>
    </div></div></div>
<!--/span-->
                                           
    <div class="col-md-2">
    <div class="form-group">
<?php $no=8; foreach($data_head_02 as $dh_02){  ?>
<!--real item start here-->
<?php if($dh_02->checkbox==1){
        $chkortxt="checkbox";
        $classvar=""; 
    }elseif($dh_02->checkbox==2){
        $chkortxt="text";
        $classvar="form-control";
} ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_02->id_item ?>">
    <h6 style="color:black"><?php $no++; echo $no; ?>. <input type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_02->id_item ?>]" value="<?php echo $dh_02->name_item ?>"> <?php echo $dh_02->name_item; ?></h6>                          
<!--/span-->
<?php } ?>
<div class="input-group-addon">
<span class="glyphicon glyphicon-th"></span>
</div></div></div>
<!--/span-->
                                            
    <div class="col-md-2">
    <div class="form-group">
<?php $no=18; foreach($data_head_03 as $dh_03){  ?>
<!--real item start here-->
<?php if($dh_03->checkbox==1){
        $chkortxt="checkbox";
        $classvar=""; 
    }elseif($dh_03->checkbox==2){
        $chkortxt="text";
        $classvar="form-control";
} ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_03->id_item ?>">
    <h6 style="color:black"><?php $no++; echo $no; ?>. <input type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_03->id_item ?>]" value="<?php echo $dh_03->name_item ?>"> <?php echo $dh_03->name_item; ?></h6>                          
<!--/span-->
<?php } ?>
    <div class="input-group-addon">
    <span class="glyphicon glyphicon-th"></span>
    </div></div></div>
<!--/span-->
                                            
    <div class="col-md-3">
    <div class="form-group">
    <label style="color:black"><strong>HEMOSTASIS</strong></label>
<?php $no=0; foreach($data_head_04 as $dh_04){  ?>
<!--real item start here-->
<?php if($dh_04->checkbox==1){
        $chkortxt="checkbox";
        $classvar=""; 
    }elseif($dh_04->checkbox==2){
        $chkortxt="text";
        $classvar="form-control";
} ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_04->id_item ?>">
    <h6 style="color:black"><?php $no++; echo $no; ?>. <input type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_04->id_item ?>]" value="<?php echo $dh_04->name_item ?>"> <?php echo $dh_04->name_item; ?></h6>                          
<!--/span-->
<?php } ?>
    <div class="input-group-addon">
    <span class="glyphicon glyphicon-th"></span>
    </div></div></div>
<!--/span-->
                                            
    <div class="col-md-2">
    <div class="form-group">
 <?php $no=9; foreach($data_head_05 as $dh_05){  ?>
 <!--real item start here-->
 <?php if($dh_05->checkbox==1){
        $chkortxt="checkbox";
        $classvar=""; 
    }elseif($dh_05->checkbox==2){
        $chkortxt="text";
        $classvar="form-control";
 } ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_05->id_item ?>">
    <h6 style="color:black"><?php $no++; echo $no; ?>. <input type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_05->id_item ?>]" value="<?php echo $dh_05->name_item ?>"> <?php echo $dh_05->name_item; ?></h6>                          
 <!--/span-->
 <?php } ?>
    <div class="input-group-addon">
    <span class="glyphicon glyphicon-th"></span>
    </div></div></div>
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
 <!--real item start here-->
 <?php   if($dh_06->checkbox==1){
        $chkortxt="checkbox";
        $classvar=""; 
    }elseif($dh_06->checkbox==2){
        $chkortxt="text";
        $classvar="form-control";
 } ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_06->id_item ?>">
    <h6 style="color:black"><?php $no++; echo $no; ?>. <input type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_06->id_item ?>]" value="<?php echo $dh_06->name_item ?>"> <?php echo $dh_06->name_item; ?></h6>                          
 <!--/span-->
 <?php } ?>
    <div class="input-group-addon">
    <span class="glyphicon glyphicon-th"></span>
    </div></div> </div>
 <!--/span-->
                                           
    <div class="col-md-2">
    <div class="form-group">
        <label style="color:black"><strong>JANTUNG</strong></label>
 <?php $no=0; foreach($data_head_07 as $dh_07){  ?>
 <!--real item start here-->
 <?php   if($dh_07->checkbox==1){
        $chkortxt="checkbox";
        $classvar=""; 
    }elseif($dh_07->checkbox==2){
        $chkortxt="text";
        $classvar="form-control";
 } ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_07->id_item ?>">
    <h6 style="color:black"><?php $no++; echo $no; ?>. <input type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_07->id_item ?>]" value="<?php echo $dh_07->name_item ?>"> <?php echo $dh_07->name_item; ?></h6>                          
 <!--/span-->
 <?php } ?>
    <h6><label style="color:black"><strong>FUNGSI GINJAL</strong></label></h6>
 <?php $no=0; foreach($data_head_08 as $dh_08){  ?>
 <!--real item start here-->
 <?php   if($dh_08->checkbox==1){
        $chkortxt="checkbox";
        $classvar=""; 
    }elseif($dh_08->checkbox==2){
        $chkortxt="text";
        $classvar="form-control";
 } ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_08->id_item ?>">
    <h6 style="color:black"><?php $no++; echo $no; ?>. <input type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_08->id_item ?>]" value="<?php echo $dh_08->name_item ?>"> <?php echo $dh_08->name_item; ?></h6>                          
 <!--/span-->
 <?php } ?>
    <div class="input-group-addon">
    <span class="glyphicon glyphicon-th"></span>
    </div></div></div>
  <!--/span-->
                                            
    <div class="col-md-2">
    <div class="form-group">
    <label style="color:black"><strong>KARBOHIDRAT</strong></label>
 <?php $no=0; foreach($data_head_09 as $dh_09){  ?>
 <!--real item start here-->
 <?php   if($dh_09->checkbox==1){
        $chkortxt="checkbox";
        $classvar=""; 
    }elseif($dh_09->checkbox==2){
        $chkortxt="text";
        $classvar="form-control";
 } ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_09->id_item ?>">
    <h6 style="color:black"><?php $no++; echo $no; ?>. <input type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_09->id_item ?>]" value="<?php echo $dh_09->name_item ?>"> <?php echo $dh_09->name_item; ?></h6>                          
 <!--/span-->
 <?php } ?>
    <label style="color:black"><strong>PANKREAS</strong></label>
 <?php $no=0; foreach($data_head_10 as $dh_10){  ?>
 <!--real item start here-->
 <?php   if($dh_10->checkbox==1){
        $chkortxt="checkbox";
        $classvar=""; 
    }elseif($dh_10->checkbox==2){
        $chkortxt="text";
        $classvar="form-control";
 } ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_10->id_item ?>">
    <h6 style="color:black"><?php $no++; echo $no; ?>. <input type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_10->id_item ?>]" value="<?php echo $dh_10->name_item ?>"> <?php echo $dh_10->name_item; ?></h6>                          
 <!--/span-->
 <?php } ?>
    <div class="input-group-addon">
    <span class="glyphicon glyphicon-th"></span>
    </div></div></div>
 <!--/span-->
                                            
    <div class="col-md-3">
    <div class="form-group">
    <label style="color:black"><strong>LEMAK*</strong></label>
 <?php $no=2; foreach($data_head_11 as $dh_11){  ?>
 <!--real item start here-->
 <?php   if($dh_11->checkbox==1){
        $chkortxt="checkbox";
        $classvar=""; 
    }elseif($dh_11->checkbox==2){
        $chkortxt="text";
        $classvar="form-control";
 } ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_11->id_item ?>">
    <h6 style="color:black"><?php $no++; echo $no; ?>. <input type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_11->id_item ?>]" value="<?php echo $dh_11->name_item ?>"> <?php echo $dh_11->name_item; ?></h6>                          
    <!--/span-->
 <?php } ?>
    <h6><label style="color:black"><strong>ELEKTROliT & GAS DARAH</strong></label></h6>
 <?php $no=0; foreach($data_head_12 as $dh_12){  ?>
 <!--real item start here-->
 <?php   if($dh_12->checkbox==1){
        $chkortxt="checkbox";
        $classvar=""; 
    }elseif($dh_12->checkbox==2){
        $chkortxt="text";
        $classvar="form-control";
 } ?>
    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_12->id_item ?>">
    <h6 style="color:black"><?php $no++; echo $no; ?>. <input type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_12->id_item ?>]" value="<?php echo $dh_12->name_item ?>"> <?php echo $dh_12->name_item; ?></h6>                          
    <!--/span-->
 <?php } ?>
    <div class="input-group-addon">
    <span class="glyphicon glyphicon-th"></span>
    </div></div></div>
 <!--/span-->
                                            


                                            <div class="col-md-2">
                                                <div class="form-group">
                                                <?php $no=3; foreach($data_head_13 as $dh_13){  ?>
                                            <!--real item start here-->
                                            <?php   if($dh_13->checkbox==1){
                                                        $chkortxt="checkbox";
                                                        $classvar=""; 
                                                    }elseif($dh_13->checkbox==2){
                                                        $chkortxt="text";
                                                        $classvar="form-control";
                                                    } ?>
                                                    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_13->id_item ?>">
                                                    <h6 style="color:black"><?php $no++; echo $no; ?>. <input type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_13->id_item ?>]" value="<?php echo $dh_13->name_item ?>"> <?php echo $dh_13->name_item; ?></h6>                          
                                            <!--/span-->
                                            <?php } ?>
                                                <h6><label>&nbsp;</label></h6>
                                                <label style="color:black"><strong>LAIN-LAIN</strong></label>
                                                <?php $no=0; foreach($data_head_14 as $dh_14){  ?>
                                            <!--real item start here-->
                                            <?php   if($dh_14->checkbox==1){
                                                        $chkortxt="checkbox";
                                                        $classvar=""; 
                                                    }elseif($dh_14->checkbox==2){
                                                        $chkortxt="text";
                                                        $classvar="form-control";
                                                    } ?>
                                                    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_14->id_item ?>">
                                                    <h6 style="color:black"><?php $no++; echo $no; ?>. <input type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_14->id_item ?>]" value="<?php echo $dh_14->name_item ?>"> <?php echo $dh_14->name_item; ?></h6>                          
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
                                            <!--real item start here-->
                                            <?php   if($dh_15->checkbox==1){
                                                        $chkortxt="checkbox";
                                                        $classvar=""; 
                                                    }elseif($dh_15->checkbox==2){
                                                        $chkortxt="text";
                                                        $classvar="form-control";
                                                    } ?>
                                                    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_15->id_item ?>">
                                                    <h6 style="color:black"><?php $no++; echo $no; ?>. <input type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_15->id_item ?>]" value="<?php echo $dh_15->name_item ?>"> <?php echo $dh_15->name_item; ?></h6>                          
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
                                            <!--real item start here-->
                                            <?php   if($dh_16->checkbox==1){
                                                        $chkortxt="checkbox";
                                                        $classvar=""; 
                                                    }elseif($dh_16->checkbox==2){
                                                        $chkortxt="text";
                                                        $classvar="form-control";
                                                    } ?>
                                                    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_16->id_item ?>">
                                                    <h6 style="color:black"><?php $no++; echo $no; ?>. <input type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_16->id_item ?>]" value="<?php echo $dh_16->name_item ?>"> <?php echo $dh_16->name_item; ?></h6>                          
                                            <!--/span-->
                                            <?php } ?>
                                                <label style="color:black"><strong>HEPATITIS</strong></label>
                                                <?php $no=0; foreach($data_head_17 as $dh_17){  ?>
                                            <!--real item start here-->
                                            <?php   if($dh_17->checkbox==1){
                                                        $chkortxt="checkbox";
                                                        $classvar=""; 
                                                    }elseif($dh_17->checkbox==2){
                                                        $chkortxt="text";
                                                        $classvar="form-control";
                                                    } ?>
                                                    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_17->id_item ?>">
                                                    <h6 style="color:black"><?php $no++; echo $no; ?>. <input type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_17->id_item ?>]" value="<?php echo $dh_17->name_item ?>"> <?php echo $dh_17->name_item; ?></h6>                          
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
                                            <!--real item start here-->
                                            <?php   if($dh_18->checkbox==1){
                                                        $chkortxt="checkbox";
                                                        $classvar=""; 
                                                    }elseif($dh_18->checkbox==2){
                                                        $chkortxt="text";
                                                        $classvar="form-control";
                                                    } ?>
                                                    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_18->id_item ?>">
                                                    <h6 style="color:black"><?php $no++; echo $no; ?>. <input type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_18->id_item ?>]" value="<?php echo $dh_18->name_item ?>"> <?php echo $dh_18->name_item; ?></h6>                          
                                            <!--/span-->
                                            <?php } ?>
                                                <h6><label style="color:black"><strong>PHS</strong></label></h6>
                                                <?php $no=0; foreach($data_head_19 as $dh_19){  ?>
                                            <!--real item start here-->
                                            <?php   if($dh_19->checkbox==1){
                                                        $chkortxt="checkbox";
                                                        $classvar=""; 
                                                    }elseif($dh_19->checkbox==2){
                                                        $chkortxt="text";
                                                        $classvar="form-control";
                                                    } ?>
                                                    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_19->id_item ?>">
                                                    <h6 style="color:black"><?php $no++; echo $no; ?>. <input type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_19->id_item ?>]" value="<?php echo $dh_19->name_item ?>"> <?php echo $dh_19->name_item; ?></h6>                          
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
                                            <!--real item start here-->
                                            <?php   if($dh_20->checkbox==1){
                                                        $chkortxt="checkbox";
                                                        $classvar=""; 
                                                    }elseif($dh_20->checkbox==2){
                                                        $chkortxt="text";
                                                        $classvar="form-control";
                                                    } ?>
                                                    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_20->id_item ?>">
                                                    <h6 style="color:black"><?php $no++; echo $no; ?>. <input type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_20->id_item ?>]" value="<?php echo $dh_20->name_item ?>"> <?php echo $dh_20->name_item; ?></h6>                          
                                            <!--/span-->
                                            <?php } ?>
                                                <label style="color:black"><strong>HORMON</strong></label>
                                                <?php $no=0; foreach($data_head_21 as $dh_21){  ?>
                                            <!--real item start here-->
                                            <?php   if($dh_21->checkbox==1){
                                                        $chkortxt="checkbox";
                                                        $classvar=""; 
                                                    }elseif($dh_21->checkbox==2){
                                                        $chkortxt="text";
                                                        $classvar="form-control";
                                                    } ?>
                                                    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_21->id_item ?>">
                                                    <h6 style="color:black"><?php $no++; echo $no; ?>. <input type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_21->id_item ?>]" value="<?php echo $dh_21->name_item ?>"> <?php echo $dh_21->name_item; ?></h6>                          
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
                                            <!--real item start here-->
                                            <?php   if($dh_22->checkbox==1){
                                                        $chkortxt="checkbox";
                                                        $classvar=""; 
                                                    }elseif($dh_22->checkbox==2){
                                                        $chkortxt="text";
                                                        $classvar="form-control";
                                                    } ?>
                                                    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_22->id_item ?>">
                                                    <h6 style="color:black"><?php $no++; echo $no; ?>. <input type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_22->id_item ?>]" value="<?php echo $dh_22->name_item ?>"> <?php echo $dh_22->name_item; ?></h6>                          
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
                                            <!--real item start here-->
                                            <?php   if($dh_24->checkbox==1){
                                                        $chkortxt="checkbox";
                                                        $classvar=""; 
                                                    }elseif($dh_24->checkbox==2){
                                                        $chkortxt="text";
                                                        $classvar="form-control";
                                                    } ?>
                                                    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_24->id_item ?>">
                                                    <h6 style="color:black"><?php $no++; echo $no; ?>. <input type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_24->id_item ?>]" value="<?php echo $dh_24->name_item ?>"> <?php echo $dh_24->name_item; ?></h6>                          
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
                                            <!--real item start here-->
                                            <?php   if($dh_25->checkbox==1){
                                                        $chkortxt="checkbox";
                                                        $classvar=""; 
                                                    }elseif($dh_25->checkbox==2){
                                                        $chkortxt="text";
                                                        $classvar="form-control";
                                                    } ?>
                                                    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_25->id_item ?>">
                                                    <h6 style="color:black"><?php $no++; echo $no; ?>. <input type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_25->id_item ?>]" value="<?php echo $dh_25->name_item ?>"> <?php echo $dh_25->name_item; ?></h6>                          
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
                                            <!--real item start here-->
                                            <?php   if($dh_26->checkbox==1){
                                                        $chkortxt="checkbox";
                                                        $classvar=""; 
                                                    }elseif($dh_26->checkbox==2){
                                                        $chkortxt="text";
                                                        $classvar="form-control";
                                                    } ?>
                                                    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_26->id_item ?>">
                                                    <h6 style="color:black"><?php $no++; echo $no; ?>. <input type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_26->id_item ?>]" value="<?php echo $dh_26->name_item ?>"> <?php echo $dh_26->name_item; ?></h6>                          
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
                                            <!--real item start here-->
                                            <?php   if($dh_27->checkbox==1){
                                                        $chkortxt="checkbox";
                                                        $classvar=""; 
                                                    }elseif($dh_27->checkbox==2){
                                                        $chkortxt="text";
                                                        $classvar="form-control";
                                                    } ?>
                                                    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_27->id_item ?>">
                                                    <h6 style="color:black"><?php $no++; echo $no; ?>. <input type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_27->id_item ?>]" value="<?php echo $dh_27->name_item ?>"> <?php echo $dh_27->name_item; ?></h6>                          
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
                                            <!--real item start here-->
                                            <?php   if($dh_28->checkbox==1){
                                                        $chkortxt="checkbox";
                                                        $classvar=""; 
                                                    }elseif($dh_28->checkbox==2){
                                                        $chkortxt="text";
                                                        $classvar="form-control";
                                                    } ?>
                                                    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_28->id_item ?>">
                                                    <h6 style="color:black"><?php $no++; echo $no; ?>. <input type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_28->id_item ?>]" value="<?php echo $dh_28->name_item ?>"> <?php echo $dh_28->name_item; ?></h6>                          
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
                                            <!--real item start here-->
                                            <?php   if($dh_29->checkbox==1){
                                                        $chkortxt="checkbox";
                                                        $classvar=""; 
                                                    }elseif($dh_29->checkbox==2){
                                                        $chkortxt="text";
                                                        $classvar="form-control";
                                                    } ?>
                                                    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_29->id_item ?>">
                                                    <h6 style="color:black"><?php $no++; echo $no; ?>. <input type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_29->id_item ?>]" value="<?php echo $dh_29->name_item ?>"> <?php echo $dh_29->name_item; ?></h6>                          
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
                                            <!--real item start here-->
                                            <?php   if($dh_30->checkbox==1){
                                                        $chkortxt="checkbox";
                                                        $classvar=""; 
                                                    }elseif($dh_30->checkbox==2){
                                                        $chkortxt="text";
                                                        $classvar="form-control";
                                                    } ?>
                                                    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_30->id_item ?>">
                                                    <h6 style="color:black"><?php $no++; echo $no; ?>. <input type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_30->id_item ?>]" value="<?php echo $dh_30->name_item ?>"> <?php echo $dh_30->name_item; ?></h6>                          
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
                                            <!--real item start here-->
                                            <?php   if($dh_31->checkbox==1){
                                                        $chkortxt="checkbox";
                                                        $classvar=""; 
                                                    }elseif($dh_31->checkbox==2){
                                                        $chkortxt="text";
                                                        $classvar="form-control";
                                                    } ?>
                                                    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_31->id_item ?>">
                                                    <h6 style="color:black"><?php $no++; echo $no; ?>. <input type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_31->id_item ?>]" value="<?php echo $dh_31->name_item ?>"> <?php echo $dh_31->name_item; ?></h6>                          
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
                                            <!--real item start here-->
                                            <?php   if($dh_32->checkbox==1){
                                                        $chkortxt="checkbox";
                                                        $classvar=""; 
                                                    }elseif($dh_32->checkbox==2){
                                                        $chkortxt="text";
                                                        $classvar="form-control";
                                                    } ?>
                                                    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_32->id_item ?>">
                                                    <h6 style="color:black"><?php $no++; echo $no; ?>. <input type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_32->id_item ?>]" value="<?php echo $dh_32->name_item ?>"> <?php echo $dh_32->name_item; ?></h6>                          
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
                                            <?php   if($dh_33->checkbox==1){
                                                        $chkortxt="checkbox";
                                                        $classvar=""; 
                                                    }elseif($dh_33->checkbox==2){
                                                        $chkortxt="text";
                                                        $classvar="form-control";
                                                    } ?>
                                                    <input type="text" hidden="" name="id_lab_digital[]" value="<?php echo $dh_33->id_item ?>">
                                                    <h6 style="color:black"><?php $no++; echo $no; ?>. <input type="<?php echo $chkortxt; ?>" class="<?php echo $classvar; ?>" name="tindakan[<?php echo $dh_33->id_item ?>]" value="<?php echo $dh_33->name_item ?>"> <?php echo $dh_33->name_item; ?></h6>                          
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
                                                <!--<li><input type="checkbox" name="hasildd" value="0"> Hasil dikirim ke dokter</li>--> 
                                                <li><input type="checkbox" name="cito" value="1"> <strong style="color:black">CITO</strong></li> 
                                                        <div class="input-group-addon">
                                                            <span class="glyphicon glyphicon-th"></span>
                                                        </div></div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-3">
                                                <div class="form-group has-warning">
                                                <!--<li><input type="checkbox" name="hasildd" value="0"> Hasil dikirim ke dokter</li>--> 
                                                <textarea name="lainlain" class="form-control" rows="8"></textarea>                        
                                            <!--/span-->
                                                        <div class="input-group-addon">
                                                            <span class="glyphicon glyphicon-th"></span>
                                                        </div></div>
                                            </div>
                                            <!--/span-->
                                            <?php /*
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                <li>&nbsp;</li> 
                                                <li>&nbsp;</li> 
                                                        <div class="input-group-addon">
                                                            <span class="glyphicon glyphicon-th"></span>
                                                        </div></div>
                                            </div>
                                            <!--/span-->
                                            */ ?>
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
                                                
                                                <h6><input type="text" hidden="" class="form-control" name="dokpeng" ></h6>
                                                        <div class="input-group-addon">
                                                            <span class="glyphicon glyphicon-th"></span>
                                                        </div></div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->    
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
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
</script>
				</div>

			</div>
		</div>
	</div>
	<!-- End Page Content -->
</div>
