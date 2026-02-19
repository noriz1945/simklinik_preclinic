<!DOCTYPE html>
<html>
<head>
<?php $this->theme->head('theme_default'); ?>
<style>
	p {
	color:black;
	margin-bottom: 1px;
	}
	/*
 @media print{
        .table thead tr td,.table tbody tr td{
            border-width: 1px !important;
            border-style: solid !important;
            border-color: black !important;
            font-size: 10px !important;
            background-color: red;
            padding:0px;
            -webkit-print-color-adjust:exact ;
        }
    }
	*/
	body {
		/*font-size:11px;*/
	}
	input[type=checkbox]
	{
		/* Double-sized Checkboxes */
		-ms-transform: scale(2); /* IE */
		-moz-transform: scale(2); /* FF */
		-webkit-transform: scale(2); /* Safari and Chrome */
		-o-transform: scale(0.8); /* Opera */
		transform: scale(0.8);
		padding: 10px;
	}
	.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th
	{
		/*font-size:11px;*/
		/*line-height:1px;*/
	}
	.table td, .table th {
		/*padding: 5.5rem;*/
	}
	tbody tr td {
		padding-left: 5px;
	}
</style>    
</head>
<body>
	<div class="container">
  	<table class="" width="100%" border="1" background="black" cellspacing="0" cellpadding="1px">
    	<tr>
      	<td colspan="5">
        <table width="100%" border="0">
          <tr>
            <td width="23%"><img src="<?php echo base_url('assets/images/log-sa-bw-texted.png'); ?>" style="max-height:70px;"></td>
            <td width="30%">&nbsp;</td>
            <td width="34%">&nbsp;</td>
            <td width="13%" align="right" valign="top"><strong>RM 46.19</strong></td>
          </tr>
          <tr>
            <td colspan="3"><p style="font-size:18px; font-weight:bold;">RINGKASAN PASIEN PULANG <em>(RESUME MEDIS)</em></p></td>
            <td align="right" valign="bottom" nowrap="nowrap">
              <table width="100%" border="3">
                <tbody>
                  <tr>
                    <td align="center"><p style="font-size:22px;font-weight:bold;margin-bottom:0;line-height:1;">RAHASIA</p></td>
                  </tr>
                </tbody>
            </table></td>
          </tr>
        </table>
      </td>
      </tr>
      <tr>
        <input type="text" id="idregset" name="idregset" value="<?php echo $id_reg; ?>">
      	<td width="25%"><strong>Nama Pasien</strong> : <?php echo $pasien['nama_pasien']; ?></td>
        <td width="25%"><strong>No.RM</strong> : <?php echo $pasien['id_pasien']; ?> / <?php echo $pasien['id_reg']; ?></td>
        <td width="15%"><strong>Tgl Lahir</strong> : <?php echo $pasien['tgl_lahir']; ?></td>
        <td width="15%">
        <strong>Umur</strong> : <?php echo $pasien['umur1']; ?>Thn </td>
        <td width="20%"><strong>Jenis Kelamin</strong> : <?php echo $pasien['gender2']; ?></td>
      </tr>
      <tr>
      	<td><strong>Tanggal Masuk</strong> : <?php echo tgl_indonesia($data_resmed['regdate'])?></td>
        <td colspan="3"><strong>Tanggal Keluar / Meninggal</strong> : <?php echo tgl_indonesia($data_resmed['tgl_keluar'])?></td>
        <td><strong>Ruang Rawat Terakhir</strong> : <?php echo $last_ruangan; ?></td>
      </tr>
      <tr>
      	<td colspan="4"><strong>Indikasi Rawat Inap</strong> : <span class="control-label"><?php echo $data_resmed['keluhan_utama']; ?></span></td>
        <td><strong>Penanggung Bayaran</strong> : <?php echo $pasien['asuransi']; ?></td>
      </tr>
      <tr>
      	<td colspan="5"><strong>Ringkasan Riwayat penyakit</strong> :<br><span class="control-label"><?php echo str_replace("<br />
<br />","<br />",nl2br($data_resmed['riwayat_sakit_dulu'])); ?></span></td>
      </tr>
      <tr>
        <td colspan="5">
        	<strong>Pemeriksaan Fisik</strong><br>
        	Keadaan Umum : <span class="control-label"><?php echo $data_resmed['keadaan_umum']; ?></span>
          <br><br>
          <strong>Tanda Vital</strong> (Awal Masuk)<br>
          <table width="99%">
          <tbody>
            <tr>
              <td>Tekanan Darah : <span class="col-sm-12 col-form-label"><?php echo $data_resmed['td']; ?></span></td>
              <td>Suhu : <span class="col-sm-12 col-form-label"><?php echo $data_resmed['suhu']; ?></span></td>
              <td>Nadi : <span class="col-sm-12 col-form-label"><?php echo $data_resmed['nadi']; ?></span></td>
              <td>Frekuensi Napas : <span class="col-sm-12 col-form-label"><?php echo $data_resmed['nafas']; ?></span></td>
            </tr>
          </tbody>
        </table>
        </td>
      </tr>
      <tr>
        <td colspan="5"><strong>Pemeriksaan Penunjang / Diagnostik terpenting</strong> : <span class="control-label"><?php echo $data_resmed['pemeriksaan_penunjang']; ?></span></td>
      </tr>
      <tr>
        <td colspan="5"><strong>Terapi / Pengobatan Selama di Rumah Sakit</strong> : <span class="control-label"><?php echo $data_resmed['riwayat_pengobatan']; ?></span></td>
      </tr>
      <tr>
        <td colspan="5"><strong>Hasil Konsultasi</strong> : <span class="control-label"><?php echo $data_resmed['hasil_konsultasi']; ?></span></td>
      </tr>
      <tr>
        <td colspan="2"><table width="100%" style="display:none;">
          <tbody>
            <tr>
              <td width="40%"><strong>Diagnosis</strong></td>
              <td width="1%">:</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>Diagnosis Sekunder</td>
              <td>:</td>
              <td>1.</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>2.</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>3.</td>
            </tr>
            <tr>
              <td>Tindakan/Prosedur</td>
              <td>:</td>
              <td>1.</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>2.</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>3.</td>
            </tr>
          </tbody>
        </table>
        										<label class="control-label"><strong>Diagnosis ICD10</strong> :</label>
                            </br>
        										<label class="control-label">
                                <?php 
																	foreach($data_resmed['diag_medis_banding_text'] as $k => $v)
																	{
																		
																		echo "<br>" . $v;
																	}
																?>
                            </label>
        </td>
        <td colspan="3" valign="top"><table width="100%" style="display:none;">
          <tbody>
            <tr>
              <td width="40%">ICD 10</td>
              <td width="1%">:</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>ICD 10</td>
              <td>:</td>
              <td>1.</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>2.</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>3.</td>
            </tr>
            <tr>
              <td>ICD 9</td>
              <td>:</td>
              <td>1.</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>2.</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>3.</td>
            </tr>
          </tbody>
        </table>
        										<label class="control-label"><strong>Tindakan / prosedur (ICD 9cm)</strong>:</label>
                            </br>
          									<label class="control-label">
                                <?php 
																	foreach($data_resmed['planning_text'] as $k => $v)
																	{
																		
																		echo "<br>" . $v;
																	}
																?>
                            </label></td>
      </tr>
      <tr>
        <td colspan="5">Alergi ( reaksi obat ) : <span class="control-label"><?php echo $data_resmed['riwayat_alergi']; ?></span></td>
      </tr>
      <tr>
        <td colspan="5"><strong>Hasil Laboratorium belum selesai (pending)</strong> : <span class="control-label"><?php echo $data_resmed['lab_belum_selesai']; ?></span>
        	<!--
            <label class="control-label">
                <?php 
								/*
                  foreach($rs_lab_pending as $k => $v)
                  {
                ?>
                    <ul>
                      <li>
                            <?php echo "-. " . $v['tindakan'] . "<br>" ;?>
                      </li>
                    </ul>
                <?php
                  }
									*/
                ?>
            </label>
            -->
        </td>
      </tr>
      <tr>
        <td colspan="5"><strong>Diet</strong> : <span class="control-label"><?php echo $data_resmed['diet']; ?></span></td>
      </tr>
      <tr>
        <td colspan="5"><strong>Instruksi / Anjuran dan Edukasi ( Follow Up )</strong> : <span class="control-label"><?php echo $data_resmed['p_instruksi_terakhir']; ?></span></td>
      </tr>
      <tr>
        <td colspan="5"><strong>Tanda Vital  (Saat Pulang)</strong>: <?php echo $data_resmed['tanda_vital_saat_pulang']; ?></td>
      </tr>
      <tr>
        <td colspan="3"><table width="99%">
          <tbody>
            <tr>
              <td><strong>Kondisi Ibadah</strong>:</td>
              <td><span class="form-group">
                <input <?php if (in_array( '1', $data_resmed['kondisi_ibadah'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="kondisi_ibadah[]" value="1">
Disiplin</span></td>
              <td><span class="form-group">
                <input <?php if (in_array( '2', $data_resmed['kondisi_ibadah'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="kondisi_ibadah[]" value="2">
Kadang Kadang</span></td>
              <td><span class="form-group">
                <input <?php if (in_array( '3', $data_resmed['kondisi_ibadah'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="kondisi_ibadah[]" value="3">
Tidak</span></td>
            </tr>
            <tr>
              <td><strong>Kondisi Psiko-Spiritual</strong>:</td>
              <td><span class="form-group">
                <input <?php if (in_array( '1', $data_resmed['kondisi_psiko'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="kondisi_psiko[]" value="1">
Menerima</span></td>
              <td><span class="form-group">
                <input <?php if (in_array( '2', $data_resmed['kondisi_psiko'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="kondisi_psiko[]" value="2">
Mengeluh</span></td>
              <td><span class="form-group">
                <input <?php if (in_array( '3', $data_resmed['kondisi_psiko'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="kondisi_psiko[]" value="3">
Menolak</span></td>
            </tr>
          </tbody>
        </table></td>
        <td colspan="2" rowspan="4" align="center">
        <table width="80%" border="0" style="margin-top:3px;">
          <tbody>
            <tr>
              <td>
              	<ul>
                  <li class="form-group"><input type="checkbox">Sudah Mendapat Penjelasan</li>
                  <li class="form-group"><input type="checkbox">Akses Link <a href="https://sariasihgroup.com/kerohanian.pdf" style="color:blue;" target="_blank">https://sariasihgroup.com/kerohanian.pdf</a></li>
                  <li class="form-group"><input type="checkbox">Menerima Salinan Formulir</li>
                </ul>
              </td>
            </tr>
            <tr>
              <td align="center" valign="bottom">
                <br>
                <br>
                Tanda Tangan Pasien / Keluarga
              </td>
            </tr>
          </tbody>
        </table></td>
      </tr>
      <tr>
        <td colspan="3"><table width="99%">
          <tbody>
            <tr>
              <td><strong>Cara Keluar</strong> :</td>
              <td><span class="form-group">
                <input <?php if (in_array( '1', $data_resmed['cara_keluar'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="cara_keluar[]" value="1">
Petunjuk Dokter</span></td>
              <td><span class="form-group">
                <input <?php if (in_array( '2', $data_resmed['cara_keluar'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="cara_keluar[]" value="2">
Rujuk</span></td>
              <td><span class="form-group">
                <input <?php if (in_array( '3', $data_resmed['cara_keluar'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="cara_keluar[]" value="3">
APS</span></td>
              <td><span class="form-group">
                <input <?php if (in_array( '4', $data_resmed['cara_keluar'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="cara_keluar[]" value="4">
Lain-lain</span></td>
            </tr>
          </tbody>
        </table></td>
      </tr>
      <tr>
        <td colspan="3"><table width="99%">
          <tbody>
            <tr>
              <td><strong>Kondisi Keluar</strong> :</td>
              <td><span class="form-group">
                <input <?php if (in_array( '1', $data_resmed['kondisi_keluar'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="kondisi_keluar[]" value="1">
Sembuh</span></td>
              <td><span class="form-group">
                <input <?php if (in_array( '2', $data_resmed['kondisi_keluar'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="kondisi_keluar[]" value="2">
Meninggal</span></td>
              <td><span class="form-group">
                <input <?php if (in_array( '3', $data_resmed['kondisi_keluar'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="kondisi_keluar[]" value="3">
Asuhan Belum Selesai</span></td>
            </tr>
          </tbody>
        </table></td>
      </tr>
      <tr>
        <td colspan="3"><table width="99%">
          <tbody>
            <tr>
              <td><strong>Tindak Lanjut</strong> :</td>
              <td><span class="form-group">
                <input <?php if (in_array( '1', $data_resmed['tindak_lanjut'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="tindak_lanjut[]" value="1">
Kontrol Rawat Jalan</span><br>Tgl : </td>
              <td><span class="form-group">
                <input <?php if (in_array( '2', $data_resmed['tindak_lanjut'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="tindak_lanjut[]" value="2">
Tidak Perlu kontrol</span></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><span class="form-group">
                <input <?php if (in_array( '3', $data_resmed['tindak_lanjut'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="tindak_lanjut[]" value="3">
Home Care</span></td>
              <td><span class="form-group">
                <input <?php if (in_array( '4', $data_resmed['tindak_lanjut'])) echo "checked" ; else echo "unchecked" ; ?> type="checkbox" name="tindak_lanjut[]" value="4">
Kembali ke perujuk</span></td>
            </tr>
          </tbody>
        </table></td>
      </tr>
      <tr>
        <td colspan="3" valign="top">
        		<div class="col-md-12" id="box_eresep_pulang">
            	<br>
            </div>
        
        </td>
        <td colspan="2" align="center">Tanggal : <?php echo tgl_indonesia($data_resmed['tgl_keluar'])?><br>
          Dokter Penanggungjawab Pasien
          <br>
          <!--
          <img src="<?php echo base_url(); ?>/resume_medis/gen_qrcode/<?php echo rawurlencode($pasien['dokter']).'-'.$pasien['id_reg']; ?>" alt="digital_signature" style="max-height:130px;">
          -->
          <br>
          <br>
          <br>
          <br>
        	<?php #echo $pasien['dokter']; ?>
          <?php echo $data_resmed['dokter_login']; ?>
          <br>
          SIP : <?php echo $data_resmed['sip_str']; ?>
          </td>
      </tr>
    </table>
    <div><p><em>Resume medis elektronik ini syah tanpa tanda tangan, UU Pradok No 29/2004 Penjelasan Ps 46(3)</em></p></div>
    <div><p><em>MIRM 15/ARK4.2.1 / Akreditasi SNARS edisi 1</em></p></div>
</div>
<?php $this->theme->script('theme_default'); ?>
<?php
function tgl_indonesia($date){
   /* ARRAY u/ hari dan bulan */
   $Hari = array ("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu",);
   $Bulan = array ("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

/* Memisahkan format tanggal bulan dan tahun menggunakan substring */
$tahun 	 = substr($date, 0, 4);
$bulan 	 = substr($date, 5, 2);
$tgl	 = substr($date, 8, 2);
$waktu	 = substr($date,11, 5);
$hari	 = date("w", strtotime($date));

$result = $Hari[$hari].", ".$tgl." ".$Bulan[(int)$bulan-1]." ".$tahun."";
return $result;
}
/* by RioBermano.Com */
?>
<script>
  var baseUrl = '/prjext/clinic/';

  $(document).ready(function(){
    var id_reg     = $('#idregset').val();
  
    //detail eresep
    $.ajax({
      url : baseUrl+"soap_eresep/eresep_pulang/"+id_reg+"/false/t",
      method : "POST",
      data : {},
      async : true,
      dataType : 'html',
      success: function(datarestind){
          $('#box_eresep_pulang').html(datarestind);
        }
      });
    //end detail eresep
  });
	//inner_loader('<?php echo base_url('soap_eresep/eresep_pulang/' . $id_reg) ?>' + '/false/t' , '#box_eresep_pulang', false, '');
</script>
</body>
</html>