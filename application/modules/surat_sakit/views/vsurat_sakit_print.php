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
      <?php echo $sukit->id_sukit;?>/
      <?php echo date("m", strtotime($sukit->created));?>/SKS/
      <?php echo str_replace('POLIKLINIK ', '', $pasien['poli_ruangan'])?>/
      <?php echo date("Y", strtotime($sukit->created));?>
      <br>
      <strong>
      SURAT KETERANGAN SAKIT
      </strong>
      <br>
    </div>
    <div class="text-center">
      <strong>
      CERTICATE OF ILLNESS
      </strong>
    </div>
    <br>
	
    <div  style="text-decoration: underline;" class="col-md-12">
      Yang bertanda tangan dibawah ini menerangkan bahwa :
    </div>
   <div class="col-md-12">
    <i>I hereby state that :</i>
    </div>
    <div class="row">
      <div  class="col-sm-12 a">
        <div class="row">
          <div class="col-sm-1">
            Nama
            <br>
            <i>Name</i>
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
            <br>
            <i>NIK</i>
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
            <br>
            <i>Age</i>
          </div>
          <div class="col-sm-6">
            : <?php echo $pasien['umur2']; ?>
          </div>
        </div>
      </div>
      <div  class="col-sm-12 a">
        <div class="row">
          <div class="col-sm-1">
            Pekerjaan
            <br>
            <i>Occuption</i>
          </div>
          <div class="col-sm-6">
            : <?php
                if($sukit->pekerjaan != '')
                {
                  echo $sukit->pekerjaan;
                }
                else {
                  echo $pasien['job'];
                }

              ?>
          </div>
        </div>
      </div>
      <div  class="col-sm-12 margin">
        <div class="row">
          <div class="col-sm-1">
            Alamat
            <br>
            <i>Address</i>
          </div>
          <div class="col-sm-6">
            : <?php echo $pasien['alamat']; ?> , <?php echo $pasien['kelurahan']; ?> Kec. <?php echo $pasien['kecamatan']; ?> , Kota/Kab. <?php echo $pasien['kota']; ?>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div  style="text-decoration: underline;" class="col-md-12">
      Memerlukan cuti / istirahat selama <strong><?php echo $sukit->lama_cuti; ?> </strong> hari karena
    </div>
    <div class="col-md-12">
      <i>Needs to have  <strong><?php echo $sukit->lama_cuti; ?> </strong>
      day (s) sick leave / rest due to</i>
    </div>
    <br>
    <div class="col-md-12">
      <?php
        $alasan = explode(",",$sukit->alasan);
       ?>
      <div class="row">
        <div class="col-md-2">
          <div class="form-group">
            <input <?php if (in_array('1', $alasan)) echo "checked" ; else echo "unchecked" ; ?> type="checkbox"
            name="status_psikologi[]" value="1"> Sakit <br>
            <i>Illness</i>
            <div class="input-group-addon"> </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <input <?php if (in_array('2', $alasan)) echo "checked" ; else echo "unchecked" ; ?> type="checkbox"
            name="status_psikologi[]" value="2"> Melahirkan / Periksa Hamil <br>
            <i>Delivery</i>
            <div class="input-group-addon"> </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      Mulai Tanggal <strong><?php echo date("d-m-Y", strtotime($sukit->tgl_cuti_start));?></strong>
      Sampai dengan <strong><?php echo date("d-m-Y", strtotime($sukit->tgl_cuti_end));?></strong>
      <br> <i>Starting from</i>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      <i>to</i>
    </div>
    <br>
    <div class="col-md-12" style="text-decoration: underline;" >
      Surat keterangan ini di keluarkan untuk dipergunakan  sebagaimana mestinya
    </div>
    <div class="col-md-12">
      <i>This letter is for the use of specified person only</i>
    </div>
    <br>

    <div class="row">
      <div class="col-md-6">
        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label">Kota Tangerang,  </label> <?php echo date("d-m-Y"); ?>
          </div>
        </div>
        <br><br><br>
        <div class="col-md-12">
          <div class="form-group" style="text-decoration: underline;">
            <strong><?php echo $pasien['dokter']; ?></strong>
          </div>
          <div class="form-group">
            <strong><?php echo $pasien['acc_branch']; ?></strong>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <span><img src="<?php echo base_url('qrcode/qrcode_sukit.png'); ?>" alt="homepage" class="dark-logo" width="100px" /></span>

      </div>
       <div class="col-md-12">
       	<br>
      <small>* Verifikasi dapat menghubungi bagian rekam medik rumah sakit <br>
      	   <i>Please contact hospital medical record department for verification</i><br>
         * Surat ini sah tanpa harus di tanda tangani, dan sudah melalui proses komputerisasi dan tersimpan di database server Rumah Sakit<br>
           <i>This letter is valid without having to be signed, and has gone through a computerized process and is stored in the Hospital database server

</i>
      </small>
    </div>
    </div>


  </div>
</body>
</html>
