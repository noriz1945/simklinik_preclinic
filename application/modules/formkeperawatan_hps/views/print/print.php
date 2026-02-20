<!doctype html>
<html>
<head>
<?php $this->theme->head('theme_default'); ?>

<style>

</style>
</head>

<body>

  <div class="container-fluid background">
    <div class="row">
      <div class="col-sm-1">
        <span><img src="<?php echo base_url('assets/img/logo_sariasih.png'); ?>" alt="homepage" class="dark-logo" width="80px" /></span>

      </div>

      <div class="col-sm-11">
        <label class="col-sm-12 col-form-label">
          <strong><?php echo $nama_rs; ?></strong>
        </label>
        <label class="col-sm-12 col-form-label">
          <strong><?php echo $alamat_rs; ?></strong>
        </label>
        <label class="col-sm-12 col-form-label">Telp :
          <strong><?php echo $telp_rs; ?> / Fax :
          <?php echo $fax_rs; ?> </strong>
        </label>
      </div>
    </div>
    <br>
    <div class="text-center">
      <?php echo $sprit->id;?>/
      <?php echo date("m", strtotime($sprit->created));?>/SKS/
      <?php echo str_replace('POLIKLINIK ', '', $pasien['poli_ruangan'])?>/
      <?php echo date("Y", strtotime($sprit->created));?>
      <br>
      <strong>
      SURAT PENGANTAR RAWAT INAP / TINDAKAN (RENCANA ASUHAN)
      </strong>
      <br>
    </div>
    <br>
	
    <div  style="text-decoration: underline;" class="col-md-12">
      Yang bertanda tangan dibawah ini menerangkan bahwa :
    </div>
    <div class="row">
      <div  class="col-sm-12 a">
        <div class="row">
          <div class="col-sm-1">
            Nama
          </div>
          <div class="col-sm-6">
            : <?php echo $pasien['nama_pasien']; ?>
          </div>
        </div>
      </div>
      <div  class="col-sm-12 a">
        <div class="row">
          <div class="col-sm-1">
            NIK
          </div>
          <div class="col-sm-6">
            : <?php echo $pasien['pid_num']; ?>
          </div>
        </div>
      </div>
      <div  class="col-sm-12 a">
        <div class="row">
          <div class="col-sm-1">
            Umur

          </div>
          <div class="col-sm-6">
            : <?php echo $pasien['umur2']; ?>
          </div>
        </div>
      </div>
      <div  class="col-sm-12 margin">
        <div class="row">
          <div class="col-sm-1">
            Alamat
          </div>
          <div class="col-sm-6">
            : <?php echo $pasien['alamat']; ?> , <?php echo $pasien['kelurahan']; ?> Kec. <?php echo $pasien['kecamatan']; ?> , Kota/Kab. <?php echo $pasien['kota']; ?>
          </div>
        </div>
      </div>
    </div>
    <br>

    <div class="col-sm-12 margin">
        <div class="row">
          <div class="col-sm-4">
            Diagnosa Kerja
          </div>
          <div class="col-sm-6">
            : <?php echo $sprit->diagnosa_kerja; ?>
          </div>
        </div>
    </div>
    <div class="col-sm-12 margin">
        <div class="row">
          <div class="col-sm-4">
            Rencana Asuhan
          </div>
          <div class="col-sm-6">
            : <?php echo $sprit->rencana_asuhan; ?>
          </div>
        </div>
    </div>
    <div class="col-sm-12 margin">
        <div class="row">
          <div class="col-sm-4">
            Hasil Asuhan yang diharapkan
          </div>
          <div class="col-sm-6">
            : <?php echo $sprit->hasil_asuhan; ?>
          </div>
        </div>
    </div>
    <div class="col-sm-12 margin">
        <div class="row">
          <div class="col-sm-4">
            Cito / Elektif 
          </div>
          <div class="col-sm-6">
            : <?php echo $sprit->cito; ?>
          </div>
        </div>
    </div>
    <div class="col-sm-12 margin">
        <div class="row">
          <div class="col-sm-4">
            Perkiraan Biaya 
          </div>
          <div class="col-sm-6">
            : <?php echo $sprit->perkiraan_biaya; ?>
          </div>
        </div>
    </div>
    <div class="col-sm-12 margin">
        <div class="row">
          <div class="col-sm-4">
            Kategori Tindakan
          </div>
          <div class="col-sm-6">
            (<?php echo $sprit->kecil; ?>) Kecil 1, 2, 3 <br>
            (<?php echo $sprit->sedang; ?>) Sedang 1, 2, 3 <br>
            (<?php echo $sprit->besar; ?>) Besar 1, 2, 3 <br>
            (<?php echo $sprit->khusus; ?>) Khusus 1, 2, 3, 4, 5, 6
          </div>
        </div>
    </div>
    <br>

    <div class="row">
      <div class="col-md-6">
        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label">Kota Tangerang Selatan,  </label> <?php echo date("d-m-Y"); ?>
          </div>
        </div>
        <br><br><br>
        <div class="col-md-12">
          <div class="form-group" style="text-decoration: underline;">
            <strong><?php echo $sprit->nama_dokter; ?></strong>
          </div>
          <div class="form-group">
            <strong><?php echo $pasien['acc_branch']; ?></strong>
          </div>
        </div>
      </div>


       <div class="col-md-12">
       	<br>
      <small>Catatan :<br>
1.	Sesuai peraturan BPJS Kartu Peserta harus aktif
2.	Bagi pasien perusahaan / asuransi, surat jaminan rawat dan operasi harus diterima RS sebelum pasien dilakukan operasi/tindakan
3.	Bagi pasienyang akan dilakukan operasi wajib masuk ruanganrawat inap selambat-lambatnya :
	24 jam sebelum jadwal operasi bagi yang belum melengkapi pemeriksaan kelayakan operasi
	6 jam sebelum jadwal operasi bagi yang telah melengkapinya.

      </small>
    </div>
    </div>


  </div>
</body>
</html>
