
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SP-Order Rehab Medik</title>
</head>

<?php $this->theme->head('theme_default'); ?>

<form action="<?php echo base_url(). 'fisio/rehabmedik/update_aksi'; ?>" method="post">
<!-- Container fluid  -->
<div class="container-fluid">
                <!-- Start Page Content -->
                <div class="row">
                <div class="col-lg-6">
                        <div class="card card-outline-success">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Form Edit SP REHAB MEDIK</h4>
                            </div>
                            <div class="card-body">
                                <form action="#">
                                    <div class="form-body">
                                       <!-- <h3 class="card-title m-t-15">FORMULIR REHAB MEDIK</h3>-->
                                       <?php $segment6=$this->uri->segment('6');?>
                                       <input hidden type="text" name="iddigital" class="form-control" value="<?php echo $segment6; ?>" readonly>
                                        <?php foreach($datPasien as $u){  ?>
                                        <h3 class="box-title m-t-40" hidden>Data Pasien</h3>
                                        <!--<hr>-->
                                        <div class="row">
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label" hidden>RM</label>

                                                    <input hidden type="text" name="rm" class="form-control" value="<?php echo $u->id_pasien; ?>" placeholder="ID Pasien" readonly>

                                                    <input hidden type="text" name="id_reg" class="form-control" value="<?php echo $u->id_reg; ?>" hidden="" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label hidden class="control-label">Nama Pasien</label>
                                                    <input hidden type="text" name="nama" class="form-control" value="<?php echo $u->name; ?>" placeholder="Nama Pasien" readonly>
                                            </div>
                                            
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label" hidden>Umur</label>
                                                    <?php
                                                    $tanggallahir = $u->birthdate;
                                                    $tglnow2	= date("Y"); 

                                                    $umurtahun 	= $tglnow2 - $tanggallahir;
                                                    
                                                    ?>
                                                    <input hidden type="text" id="birthdate" class="form-control" value="<?php echo $umurtahun; ?>" placeholder="Umur" readonly>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label" hidden>Dokter</label>

                                                    <?php 
                                                    foreach($mst_dokter_dta as $dta_dokter){ ?>
                                                    <input hidden type="text" name="dokter" class="form-control" value="<?php echo $dta_dokter->name; ?>" placeholder="Nama Dokter" readonly>
                                                    <input hidden type="text" name="iddokter" hidden="" value="<?php echo $dta_dokter->id_dokter; ?>">
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label hidden class="control-label">Alamat / Telp</label>
                                                    <input hidden type="text" id="address" class="form-control" value="<?php echo $u->address; ?>"  placeholder="Alamat" readonly>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label hidden class="control-label">Ruangan / Kamar</label>
                                                    <label hidden class="control-label">Ruang Kelas</label>
                                                    <?php 
                                                    if ($u->rwjn==1) {$jenis1="Rawat jalan";} else {$jenis1="";}
                                                    if ($u->rwip==1) {$jenis13="Rawat Inap";} else {$jenis13="";}
                                                    if ($u->ugd==1) {$jenis2="ugd";} else {$jenis2="";} 
                                                    ?>
                                                    <input hidden type="text" id="kelas" class="form-control" value="<?php echo $jenis1.$jenis2.$jenis13." ".$u->id_kamar." - ".$u->id_kelas; ?>" placeholder="Ruang Kelas" readonly>
                                                    <input hidden type="text" hidden="" name="id_kelas" value="<?php echo $u->id_kelas ?>">
                                                </div>
                                            </div>
                                            <!--/span-->
                                            
                                            
                                            <?php foreach($list_dat_sp_edit as $u){ ?>
                                            <div class="col-md-10">
                                            <div class="form-group">
                                                    <label class="control-label">Tanggal</label>
                                                    <input type="text" name="tgl_request" class="form-control" value="<?php echo $u->tgl_request; ?>"  placeholder="Tanggal" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Diagnosa</label>
                                                    <input type="text" name="diag" class="form-control" value="<?php echo $u->diagnosa; ?>" placeholder="Diagnosa">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Terapi</label>
                                                    <input type="text" name="terapi" class="form-control" value="<?php echo $u->terapi; ?>" placeholder="Terapi">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Belum dapat dikembalikan ke fasilitas perujuk dengan alasan</label>
                                                    <input type="text" name="poin1" class="form-control" value="<?php echo $u->poin1; ?>" placeholder="Alasan">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Rencana tindak lanjut yang akan dilakukan pada kunjungan selanjutnya</label>
                                                    <input type="text" name="poin2" class="form-control" value="<?php echo $u->poin2; ?>" placeholder="Rencana">
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->   
                                        <?php } ?>
                                    </div>
                                    
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->    
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                        <button type="button" class="btn btn-inverse" onClick="self.close()">Cancel</button>
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
<script>
								
	
</script>
</body>
</html>
