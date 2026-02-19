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

	<!-- Start Page Content -->
	<div class="row">
		<div class="col-lg-12">
			<div class="card card-outline-success">
				<div class="card-body">
				<form id="frm_order_rad" action="<?php echo base_url(). 'rad/radiologi/tambah_aksi/'.$optional_page; ?>" method="post">
    <div class="card-header">
    <h4 class="m-b-0 text-white">Form Radiologi</h4>
    </div>
    <div class="form-body">
 <?php foreach($dat_pasien as $u){  ?>
 <h3 class="box-title m-t-40">Data Pasien</h3>
 <hr>
    <div class="row">
    <div class="col-md-6">
    <div class="form-group has-danger">
        <label class="control-label" style="color:black">No Registrasi</label>
        <input type="text" name="id_reg" class="form-control form-control-danger" value="<?php echo $u->id_reg; ?>" placeholder="No Reg" readonly>
    </div>
    </div>
 <!--/span-->
    <div class="col-md-6">
    <div class="form-group">
        <label class="control-label" style="color:black">RM</label>
        <input type="text" name="rm" class="form-control" value="<?php echo $u->id_pasien; ?>" placeholder="ID Pasien" readonly>
    </div>
    </div>
 <!--/span-->
    </div>
 <!--/row-->
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
    <div class="col-md-3">
    <div class="form-group">
        <label class="control-label" style="color:black">Gender</label>
 <?php if ($u->gender==1) {
        $genders="Pria";
 }else{
        $genders="wanita";
 } ?>
        <input type="text" id="gender" class="form-control" value="<?php echo $genders; ?>" placeholder="Gender" readonly>
    </div>
    </div>
 <!--/span-->
    <div class="col-md-6">
    <div class="form-group">
        <label class="control-label" style="color:black">Alamat</label>
        <input type="text" id="address" class="form-control" value="<?php echo $u->address; ?>"  placeholder="Alamat" readonly>
    </div>
    </div>
 <!--/span-->
    <div class="col-md-3">
    <div class="form-group">
        <label class="control-label" style="color:black">Tanggal Input</label>
        <input type="text" name="tgl_request" class="form-control tanggalcr" placeholder="Tanggal" readonly>
    </div>
    </div>
 <!--/span-->
    <div class="col-md-3">
    <div class="form-group">
        <label class="control-label" style="color:black">Jam</label>
 <?php $timenowhour=date('H:i:s'); $timenow=date('Y-m-d H:i:s'); ?>
        <input type="text" class="form-control" value="<?php echo $timenowhour; ?>" placeholder="Jam" readonly>
        <input type="text" name="jam_request" class="form-control" value="<?php echo $timenow; ?>" hidden="">
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
    <div class="form-group">
        <label class="control-label" style="color:black">Penjamin</label>
        <input type="text" name="company" class="form-control" value="<?php echo $u->namaasuransi; ?>" placeholder="Asuransi" readonly>
        <input type="text" hidden="" name="id_asuransi" class="form-control" value="<?php echo $u->id_asuransi; ?>">
    </div>
    </div>
 <!--/span-->
    <div class="col-md-6">
    <div class="form-group has-warning">
        <label class="control-label" style="color:black">Diagnosa Kerja</label>
        <textarea name="diag" class="form-control" rows="8" required></textarea>
    </div>
    </div>
 <!--/span-->

                                            <div class="col-md-6">
                                                <div class="form-group has-warning">
                                                    <label class="control-label" style="color:black">Tanggal Periksa</label>
                                                    <!--datepicker
                                                    <div class="input-group date" data-provide="datepicker">-->
                                                        <input type="text" name="tgl_proses" id="tgl_proses" class="form-control tanggal" placeholder="Tanggal Periksa">
                                                        <div class="input-group-addon" >
                                                            <span class="glyphicon glyphicon-th"></span>
                                                        </div>
                                                    <!--</div>
                                                    datepicker-->
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

                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label" hidden>Dokter</label>

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
																												
																										if(!isset($namedokternya))
																										{
																											$namedokternya 	= $this->session->userdata['sp']->name;
																											$iddokternya		= $this->session->userdata['sp']->id_dokter;
																										}
                                                    ?>
                                                    <input type="text" name="dokter" hidden="" class="form-control" value="<?php echo $namedokternya; ?>" placeholder="Nama Dokter" readonly>
                                                    <input type="text" name="iddokter" hidden="" value="<?php echo $iddokternya; ?>">
                                                    <?php }// tutup foreach dr igd?>
                                                </div>
                                            </div>
                                            <!--/span-->

                                        <h3 class="card-title m-t-15"> Pilih check box pada jenis pemeriksaan yang diminta </h3>
                                        <hr>
                                        <div class="row p-t-20">
<!--------------------------------------------------------LINE 1 ------------------------------------------------------------------------------------->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                <h5 class="form-control-feedback">  I. RADIOLOGI NON KONTRAS  </h5><br><hr>
                                                <div class="card-header">
                                                <h6 class="m-b-0 text-white"> A. Kepala </h6>
                                            </div>        
                                            </div>
                                            </div>
                                            <!--/span-->
                                            
                                            <div class="col-md-6">
                                                <div class="form-group has-danger">
                                                <h5 class="form-control-feedback">&nbsp;  </h5><br><hr>
                                                <div class="card-header">
                                                <h6 class="m-b-0 text-white"> E. Extremitas superior </h6>
                                            </div>        
                                            </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-ml-4">
                                            <?php $no=0; foreach($data_head_01 as $dh_01){  ?>
                                            <!--real item start here-->
                                                <div class="form-group">
                                                    <input type="text" hidden="" name="id_rad_digital[]" value="<?php echo $dh_01->id_rad_digital ?>">
                                                    <h6>&nbsp;&nbsp;&nbsp; <input type="checkbox" style="font-size:20px" name="tindakan[<?php echo $dh_01->id_rad_digital ?>]" value="<?php echo $dh_01->nama_order ?>"> <?php echo $dh_01->nama_order; ?></h6>                          
                                                    </div>
                                            <!--/span-->
                                            <?php } ?>
                                            </div>

                                            <div class="col-md-1">
                                           
                                            <!--real item start here-->
                                                <div class="form-group">
                                                <h6>&nbsp;</h6>
                                                <h6>&nbsp;</h6>
                                                <h6>&nbsp;</h6>
                                                <?php $no=0; foreach($data_head_01_r as $dh_01){  ?>
                                                    <input type="text" hidden="" name="id_rad_digital[]" value="<?php echo $dh_01->id_rad_digital ?>">
                                                    
                                                    <h6>&nbsp;<input type="checkbox" name="tindakan[<?php echo $dh_01->id_rad_digital ?>]" value="<?php echo $dh_01->nama_order ?>"> <?php echo $dh_01->nama_order; ?></h6>   
                                                    <?php } ?>
                                                    </div>
                                            <!--/span-->
                                            </div>

                                                <div class="col-md-1">
                                                <div class="form-group">
                                                <h6>&nbsp;</h6>
                                                <h6>&nbsp;</h6>
                                                <h6>&nbsp;</h6>
                                                <?php $no=0; foreach($data_head_01_l as $dh_01){  ?>
                                                    <input type="text" hidden="" name="id_rad_digital[]" value="<?php echo $dh_01->id_rad_digital ?>">
                                                    
                                                    <h6>&nbsp;<input type="checkbox" name="tindakan[<?php echo $dh_01->id_rad_digital ?>]" value="<?php echo $dh_01->nama_order ?>"> <?php echo $dh_01->nama_order; ?></h6>   
                                                    <?php } ?>
                                            </div>
                                            </div>
                                            <div class="col-ml-1">
                                                <div class="form-group">
                                                <h6>&nbsp;</h6>
                                                <h6>&nbsp;</h6>
                                                <h6>&nbsp;</h6>
                                                <?php $no=0; foreach($data_head_01_b as $dh_01){  ?>
                                                    <input type="text" hidden="" name="id_rad_digital[]" value="<?php echo $dh_01->id_rad_digital ?>">
                                                    <h6>&nbsp;<input type="checkbox" name="tindakan[<?php echo $dh_01->id_rad_digital ?>]" value="<?php echo $dh_01->nama_order ?>"> <?php echo $dh_01->nama_order; ?></h6>   
                                                    <?php } ?>
                                            </div>
                                            </div>


                                            <div class="col-md-4">
                                            <?php $no=0; foreach($data_head_02 as $dh_02){  ?>
                                            <!--real item start here-->
                                                <div class="form-group">
                                                    <input type="text" hidden="" name="id_rad_digital[]" value="<?php echo $dh_02->id_rad_digital ?>">
                                                    <h6>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" style="font-size:20px" name="tindakan[<?php echo $dh_02->id_rad_digital ?>]" value="<?php echo $dh_02->nama_order ?>"> <?php echo $dh_02->nama_order; ?></h6>                          
                                                    </div>
                                            <!--/span-->
                                            <?php } ?>
                                            </div>
                                            <div class="col-ml-1">
                                            <?php $no=0; foreach($data_head_02_r as $dh_02){  ?>
                                            <!--real item start here-->
                                                <div class="form-group">
                                                    <input type="text" hidden="" name="id_rad_digital[]" value="<?php echo $dh_02->id_rad_digital ?>">
                                                    <h6>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" style="font-size:20px" name="tindakan[<?php echo $dh_02->id_rad_digital ?>]" value="<?php echo $dh_02->nama_order ?>"> <?php echo $dh_02->nama_order; ?></h6>                          
                                                    </div>
                                            <!--/span-->
                                            <?php } ?>
                                            </div>
                                            <div class="col-ml-1">
                                            <?php $no=0; foreach($data_head_02_l as $dh_02){  ?>
                                            <!--real item start here-->
                                                <div class="form-group">
                                                    <input type="text" hidden="" name="id_rad_digital[]" value="<?php echo $dh_02->id_rad_digital ?>">
                                                    <h6>&nbsp;&nbsp;&nbsp; <input type="checkbox" style="font-size:20px" name="tindakan[<?php echo $dh_02->id_rad_digital ?>]" value="<?php echo $dh_02->nama_order ?>"> <?php echo $dh_02->nama_order; ?></h6>                          
                                                    </div>
                                            <!--/span-->
                                            <?php } ?>
                                            </div>
                                            <div class="col-ml-1">
                                            <?php $no=0; foreach($data_head_02_b as $dh_02){  ?>
                                            <!--real item start here-->
                                                <div class="form-group">
                                                    <input type="text" hidden="" name="id_rad_digital[]" value="<?php echo $dh_02->id_rad_digital ?>">
                                                    <h6>&nbsp;&nbsp;&nbsp; <input type="checkbox" style="font-size:20px" name="tindakan[<?php echo $dh_02->id_rad_digital ?>]" value="<?php echo $dh_02->nama_order ?>"> <?php echo $dh_02->nama_order; ?></h6>                          
                                                    </div>
                                            <!--/span-->
                                            <?php } ?>
                                            </div>
                                            </div>
                                            <!--/row-->
<!--------------------------------------------------------LINE 2 ------------------------------------------------------------------------------------->
                                            <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                <div class="card-header">
                                                <h6 class="m-b-0 text-white"> B. Thorax </h6>
                                            </div>        
                                            </div>
                                            </div>
                                            <!--/span-->
                                            
                                            <div class="col-md-6">
                                                <div class="form-group has-danger">
                                                <div class="card-header">
                                                <h6 class="m-b-0 text-white"> F. Extremitas inferior </h6>
                                            </div>        
                                            </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                            <?php $no=0; foreach($data_head_03 as $dh_03){  ?>
                                            <!--real item start here-->
                                                <div class="form-group">
                                                    <input type="text" hidden="" name="id_rad_digital[]" value="<?php echo $dh_03->id_rad_digital ?>">
                                                    <h6><input type="checkbox" style="font-size:20px" name="tindakan[<?php echo $dh_03->id_rad_digital ?>]" value="<?php echo $dh_03->nama_order ?>"> <?php echo $dh_03->nama_order; ?></h6>                          
                                                    </div>
                                            <!--/span-->
                                            <?php } ?>
                                            </div>

                                            


                                            <div class="col-md-4">
                                            <?php $no=0; foreach($data_head_04 as $dh_04){  ?>
                                            <!--real item start here-->
                                                <div class="form-group">
                                                    <input type="text" hidden="" name="id_rad_digital[]" value="<?php echo $dh_04->id_rad_digital ?>">
                                                    <h6><input type="checkbox" style="font-size:20px" name="tindakan[<?php echo $dh_04->id_rad_digital ?>]" value="<?php echo $dh_04->nama_order ?>"> <?php echo $dh_04->nama_order; ?></h6>                          
                                                    </div>
                                            <!--/span-->
                                            <?php } ?>
                                            </div>
                                            <div class="col-ml-1">
                                            <?php $no=0; foreach($data_head_04_r as $dh_04){  ?>
                                            <!--real item start here-->
                                                <div class="form-group">
                                                    <input type="text" hidden="" name="id_rad_digital[]" value="<?php echo $dh_04->id_rad_digital ?>">
                                                    <h6><input type="checkbox" style="font-size:20px" name="tindakan[<?php echo $dh_04->id_rad_digital ?>]" value="<?php echo $dh_04->nama_order ?>"> <?php echo $dh_04->nama_order; ?></h6>                          
                                                    </div>
                                            <!--/span-->
                                            <?php } ?>
                                            </div>
                                            <div class="col-ml-1">
                                            <?php $no=0; foreach($data_head_04_l as $dh_04){  ?>
                                            <!--real item start here-->
                                                <div class="form-group">
                                                    <input type="text" hidden="" name="id_rad_digital[]" value="<?php echo $dh_04->id_rad_digital ?>">
                                                    <h6>&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" style="font-size:20px" name="tindakan[<?php echo $dh_04->id_rad_digital ?>]" value="<?php echo $dh_04->nama_order ?>"> <?php echo $dh_04->nama_order; ?></h6>                          
                                                    </div>
                                            <!--/span-->
                                            <?php } ?>
                                            </div>
                                            <div class="col-ml-1">
                                            <?php $no=0; foreach($data_head_04_b as $dh_04){  ?>
                                            <!--real item start here-->
                                                <div class="form-group">
                                                    <input type="text" hidden="" name="id_rad_digital[]" value="<?php echo $dh_04->id_rad_digital ?>">
                                                    <h6>&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" style="font-size:20px" name="tindakan[<?php echo $dh_04->id_rad_digital ?>]" value="<?php echo $dh_04->nama_order ?>"> <?php echo $dh_04->nama_order; ?></h6>                          
                                                    </div>
                                            <!--/span-->
                                            <?php } ?>
                                            </div>
                                            </div>
<!--------------------------------------------------------LINE 3 ------------------------------------------------------------------------------------->
<div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                <div class="card-header">
                                                <h6 class="m-b-0 text-white"> C. Abdomen dan Pelvis </h6>
                                            </div>        
                                            </div>
                                            </div>
                                            <!--/span-->
                                            
                                            <div class="col-md-6">
                                                <div class="form-group has-danger">
                                                <div class="card-header">
                                                <h6 class="m-b-0 text-white"> G. Bayi </h6>
                                            </div>        
                                            </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                            <?php $no=0; foreach($data_head_05 as $dh_05){  ?>
                                            <!--real item start here-->
                                                <div class="form-group">
                                                    <input type="text" hidden="" name="id_rad_digital[]" value="<?php echo $dh_05->id_rad_digital ?>">
                                                    <h6><input type="checkbox" style="font-size:20px" name="tindakan[<?php echo $dh_05->id_rad_digital ?>]" value="<?php echo $dh_05->nama_order ?>"> <?php echo $dh_05->nama_order; ?></h6>                          
                                                    </div>
                                            <!--/span-->
                                            <?php } ?>
                                            </div>

                                            


                                            <div class="col-md-4">
                                            <?php $no=0; foreach($data_head_06 as $dh_06){  ?>
                                            <!--real item start here-->
                                                <div class="form-group">
                                                    <input type="text" hidden="" name="id_rad_digital[]" value="<?php echo $dh_06->id_rad_digital ?>">
                                                    <h6><input type="checkbox" style="font-size:20px" name="tindakan[<?php echo $dh_06->id_rad_digital ?>]" value="<?php echo $dh_06->nama_order ?>"> <?php echo $dh_06->nama_order; ?></h6>                          
                                                    </div>
                                            <!--/span-->
                                            <?php } ?>
                                            </div>
                                            
                                            </div>                                            
                                           
<!--------------------------------------------------------LINE 4 ------------------------------------------------------------------------------------->
                                           <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                <div class="card-header">
                                                <h6 class="m-b-0 text-white"> D. Vertebra </h6>
                                            </div>        
                                            </div>
                                            </div>
                                            <!--/span-->
                                            
                                            <div class="col-md-6">
                                                <div class="form-group has-danger">
                                                <div class="card-header">
                                                <h6 class="m-b-0 text-white"> H. Gigi </h6>
                                            </div>        
                                            </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-4">
                                            <?php $no=0; foreach($data_head_07 as $dh_07){  ?>
                                            <!--real item start here-->
                                                <div class="form-group">
                                                    <input type="text" hidden="" name="id_rad_digital[]" value="<?php echo $dh_07->id_rad_digital ?>">
                                                    <h6><input type="checkbox" style="font-size:20px" name="tindakan[<?php echo $dh_07->id_rad_digital ?>]" value="<?php echo $dh_07->nama_order ?>"> <?php echo $dh_07->nama_order; ?></h6>                          
                                                    </div>
                                            <!--/span-->
                                            <?php } ?>
                                            </div>
                                            <div class="col-ml-1">
                                            <?php $no=0; foreach($data_head_07_r as $dh_07){  ?>
                                            <!--real item start here-->
                                                <div class="form-group">
                                                    <input type="text" hidden="" name="id_rad_digital[]" value="<?php echo $dh_07->id_rad_digital ?>">
                                                    <h6><input type="checkbox" style="font-size:20px" name="tindakan[<?php echo $dh_07->id_rad_digital ?>]" value="<?php echo $dh_07->nama_order ?>"> <?php echo $dh_07->nama_order; ?></h6>                          
                                                    </div>
                                            <!--/span-->
                                            <?php } ?>
                                            </div>
                                            <div class="col-ml-1">
                                            <h6>&nbsp;</h6>
                                            <?php $no=0; foreach($data_head_07_l as $dh_07){  ?>
                                            <!--real item start here-->
                                                <div class="form-group">
                                                    <input type="text" hidden="" name="id_rad_digital[]" value="<?php echo $dh_07->id_rad_digital ?>">
                                                    <h6>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" style="font-size:20px" name="tindakan[<?php echo $dh_07->id_rad_digital ?>]" value="<?php echo $dh_07->nama_order ?>"> <?php echo $dh_07->nama_order; ?></h6>                          
                                                    </div>
                                            <!--/span-->
                                            <?php } ?>
                                            </div>
                                            


                                            <div class="col-md-4">
                                            <?php $no=0; foreach($data_head_08 as $dh_08){  ?>
                                            <!--real item start here-->
                                                <div class="form-group">
                                                <h6><input type="text" class="form-control" name="lainlaingigi" placeholder="Gigi..."></h6>
                                                    <input type="text" hidden="" name="id_rad_digital[]" value="<?php echo $dh_08->id_rad_digital ?>">
                                                    <h6><input type="checkbox" style="font-size:20px" name="tindakan[<?php echo $dh_08->id_rad_digital ?>]" value="<?php echo $dh_08->nama_order ?>"> <?php echo $dh_08->nama_order; ?></h6>                          
                                                    </div>
                                            <!--/span-->
                                            <?php } ?>
                                            </div>
                                            </div>

<!--------------------------------------------------------LINE 5 ------------------------------------------------------------------------------------->
<div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                <div class="card-header">
                                                <h6 class="m-b-0 text-white"> II. RADIOLOGI DENGAN KONTRAS </h6>
                                            </div>        
                                            </div>
                                            </div>
                                            <!--/span-->
                                            
                                            <div class="col-md-6">
                                                <div class="form-group has-danger">
                                                <div class="card-header">
                                                <h6 class="m-b-0 text-white"> III. ULTRASONOGRAFI </h6>
                                            </div>        
                                            </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                            <?php $no=0; foreach($data_head_09 as $dh_09){  ?>
                                            <!--real item start here-->
                                                <div class="form-group">
                                                    <input type="text" hidden="" name="id_rad_digital[]" value="<?php echo $dh_09->id_rad_digital ?>">
                                                    <h6><input type="checkbox" style="font-size:20px" name="tindakan[<?php echo $dh_09->id_rad_digital ?>]" value="<?php echo $dh_09->nama_order ?>"> <?php echo $dh_09->nama_order; ?></h6>                          
                                                    </div>
                                            <!--/span-->
                                            <?php } ?>
                                            </div>

                                            


                                            <div class="col-md-4">
                                            <?php $no=0; foreach($data_head_10 as $dh_10){  ?>
                                            <!--real item start here-->
                                                <div class="form-group">
                                                    <input type="text" hidden="" name="id_rad_digital[]" value="<?php echo $dh_10->id_rad_digital ?>">
                                                    <h6><input type="checkbox" style="font-size:20px" name="tindakan[<?php echo $dh_10->id_rad_digital ?>]" value="<?php echo $dh_10->nama_order ?>"> <?php echo $dh_10->nama_order; ?></h6>                          
                                                    </div>
                                            <!--/span-->
                                            <?php } ?>
                                            </div>
                                            </div>

<!--------------------------------------------------------LINE 5 ------------------------------------------------------------------------------------->
<div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                <div class="card-header">
                                                <h6 class="m-b-0 text-white"> IV. CT SCAN 
                                                <?php $no=0; foreach($data_head_11_r as $dh_11){  ?>
                                            <!--real item start here-->
                                                    <input type="text" hidden="" name="id_rad_digital[]" value="<?php echo $dh_11->id_rad_digital ?>">
                                                    <input type="checkbox" style="font-size:20px" name="tindakan[<?php echo $dh_11->id_rad_digital ?>]" value="<?php echo $dh_11->nama_order ?>"> <u><b><?php echo $dh_11->nama_order; ?></b></u>                       
                                            <!--/span-->
                                            <?php } ?>
                                                </h6>
                                            </div>        
                                            </div>
                                            </div>
                                            <!--/span-->
                                            
                                            <div class="col-md-6">
                                                <div class="form-group has-danger">
                                                <div class="card-header">
                                                <h6 class="m-b-0 text-white"> V. MRI </h6>
                                            </div>        
                                            </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                            <?php $no=0; foreach($data_head_11 as $dh_11){  ?>
                                                <?php if($dh_11->id_rad_digital==='171'){
                                                      $hiddena="hidden";
                                                      $checka="checked";
                                                }else{
                                                      $hiddena="";
                                                      $checka="";
                                                      } ?>
                                            <!--real item start here-->
                                                <div class="form-group">
                                                    <input type="text" hidden="" name="id_rad_digital[]" value="<?php echo $dh_11->id_rad_digital ?>">
                                                    <h6><input type="checkbox" <?php echo $hiddena; ?> <?php echo $checka; ?> style="font-size:20px" name="tindakan[<?php echo $dh_11->id_rad_digital ?>]" value="<?php echo $dh_11->nama_order ?>"> <?php echo $dh_11->nama_order; ?></h6>                          
                                                    </div>
                                            <!--/span-->
                                            <?php } ?>
                                            <h6><input type="text" class="form-control" name="lainlainct" placeholder="CT Angiografi..."></h6>
                                            </div>

                                            


                                            <div class="col-md-4">
                                            <?php $no=0; foreach($data_head_12 as $dh_12){  ?>
                                            <!--real item start here-->
                                                <div class="form-group">
                                                    <input type="text" hidden="" name="id_rad_digital[]" value="<?php echo $dh_12->id_rad_digital ?>">
                                                    <h6><input type="checkbox" style="font-size:20px" name="tindakan[<?php echo $dh_12->id_rad_digital ?>]" value="<?php echo $dh_12->nama_order ?>"> <?php echo $dh_12->nama_order; ?></h6>                          
                                                    </div>
                                            <!--/span-->
                                            <?php } ?>
                                            <h6><input type="text" class="form-control" name="lainlainmri" placeholder="..."></h6>
                                            </div>
                                            </div>    
<!--------------------------------------------------------LINE 6 ------------------------------------------------------------------------------------->
<div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                <div class="card-header">
                                                <h6 class="m-b-0 text-white"> VI. LAIN-LAIN </h6>
                                            </div>        
                                            </div>
                                            </div>
                                            <!--/span-->

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                <div class="card-header">
                                                <h6 class="m-b-0 text-white"> CITO </h6>
                                            </div>        
                                            </div>
                                            </div>
                                            <!--/span-->
                                            
                                            
                                            <div class="col-md-6">
                                            <?php $no=0; foreach($data_head_13 as $dh_13){  ?>
                                            <!--real item start here-->
                                                <div class="form-group">
                                                    <input type="text" hidden="" name="id_rad_digital[]" value="<?php echo $dh_13->id_rad_digital ?>">
                                                    <h6><input type="checkbox" style="font-size:20px" name="tindakan[<?php echo $dh_13->id_rad_digital ?>]" value="<?php echo $dh_13->nama_order ?>"> <?php echo $dh_13->nama_order; ?></h6>                          
                                                    </div>
                                            <!--/span-->
                                            <?php } ?>
                                            <h6><input type="text" class="form-control" name="lainlain" placeholder="..."></h6>
                                            </div>

                                            


                                            <div class="col-md-4">
                                            <!--real item start here-->
                                                <div class="form-group">
                                                    <h6><input type="checkbox" name="cito" value="1"> CITO</h6>                          
                                                    </div>
                                            <!--/span-->
                                            </div>
                                            </div>                      
                                            </div>
                                           
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                        <button type="button" class="btn btn-inverse" data-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                            
                            </div>
                <!-- End PAge Content -->
            <?php #$this->theme->script('theme_default'); ?>
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
<script>
var optional_page ='<?php echo $optional_page; ?>';
if(optional_page!='')
{
	$('#frm_order_rad').submit(function(event) {
		event.preventDefault(); //prevent default action 
	
		var post_url = $(this).attr("action"); //get form action url
		var form_data = $(this).serialize(); //Encode form elements for submission
	
		$.post(post_url, form_data, function(response) {
			//$("#box_new_eresep").html(response);
			alert('Response. : ' + response);
			inner_loader('<?php echo base_url('rad/radiologi/rad_modal_lad/'.$id_reg.'/asm_ri') ?>', '#loader_box_rad', false, '');
			$('#Modalradmod').modal('hide');
		});
	});
}
</script>