<!doctype html>
<html>

<head>
  <?php $this->theme->head('theme_default'); ?>

  <style type="text/css">
  .input-append .btn.dropdown-toggle {
    float: none;
}
.pnl-head-1, .pnl-head-2, .pnl-head-3{
	text-align:center;
	font-weight:bold;
}
  </style>
</head>

<div class="container-fluid">
  <form action="#" id="form_awal">
    <div class="form-body">
      <!-- Hidden fields -->
      <input type="hidden" class="form-control input-default" id="id_asm" name="id_asm">
      <input type="hidden" class="form-control input-default" id="asm_date" name="asm_date">
      <input type="hidden" class="form-control input-default" id="id_pasien" name="id_pasien">
      <input type="hidden" class="form-control input-default" id="id_reg" name="id_reg">
      <input type="hidden" class="form-control input-default" id="id_dokter" name="id_dokter">
      <input type="hidden" class="form-control input-default" id="id_type" name="id_type" value="1">
      <input type="hidden" class="form-control input-default" id="sign" name="sign" value="xxx">

      <input type="hidden" class="form-control input-default" id="created" name="created">
      <input type="hidden" class="form-control input-default" id="creator" name="creator">
      <input type="hidden" class="form-control input-default" id="updated" name="updated">
      <input type="hidden" class="form-control input-default" id="updator" name="updator">
      <!-- Hidden fields -->

      <h3 class="pnl-head-3">SUBJECTIVE</h3>
      <div class="row pnl">
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label">Keluhan Utama :</label>
            <textarea class="form-control input-focus area-scroll" id="keluhan_utama" name="keluhan_utama" rows="5"
              placeholder="Keluhan Utama"></textarea>
          </div>

          <div class="form-group">
            <label class="control-label">Riwayat Penyakit Sekarang :</label>
            <textarea class="form-control input-focus area-scroll" id="riwayat_sakit"
              name="riwayat_sakit" rows="5" placeholder="Riwayat Penyakit Sekarang"></textarea>
          </div>

          <div class="form-group">
            <label class="control-label">Riwayat Penyakit Dahulu :</label>
            <textarea class="form-control input-focus area-scroll" id="riwayat_sakit_dulu"
              name="riwayat_sakit_dulu" rows="5" placeholder="Riwayat Penyakit Dahulu"></textarea>
            <hr>
          </div>
        </div>
        <!--/span-->
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label">Riwayat Pengobatan/Operasi/Obstetri :</label>
            <textarea class="form-control input-focus area-scroll" id="riwayat_pengobatan"
              name="riwayat_pengobatan" rows="5" placeholder="Riwayat Pengobatan/Operasi/Obstetri"></textarea>
          </div>

          <div class="form-group">
            <label class="control-label">Riwayat Penyakit Keluarga :</label>
            <textarea class="form-control input-focus area-scroll" id="riwayat_sakit_keluarga"
              name="riwayat_sakit_keluarga" rows="5" placeholder="Riwayat Penyakit Keluarga"></textarea>

          </div>

          <div class="form-group">
            <label class="control-label">Riwayat Alergi :</label>
            <textarea class="form-control input-focus area-scroll" id="riwayat_alergi" name="riwayat_alergi"
              rows="5" placeholder="Riwayat Alergi"></textarea>
            <hr>
          </div>
        </div>

      </div>

      <h3 class="pnl-head-3">OBJECTIVE</h3>
      <div class="row pnl">

        <div class="col-md-12">
          <label class="control-label">STATUS PSIKOLOGI :</label>
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="status_psikologi[]" value="1"> Marah
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="status_psikologi[]" value="2"> Cemas
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="status_psikologi[]" value="3"> Depresi
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="status_psikologi[]" value="4"> Gelisah
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="status_psikologi[]" value="5"> Takut
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="status_psikologi[]" value="6"> Kecenderungan Bunuh Diri
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="status_psikologi[]" value="7"> Tidak Ada Masalah
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="status_psikologi[]" value="8"> Lain-Lain
                <div class="input-group-addon"> </div>
              </div>
            </div>

          </div>
        </div>

        <div class="col-md-12">
          <label class="control-label"><strong>STATUS SOSIAL EKONOMI</strong></label>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label">Status Pernikahan : </label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label">Pendidikan Terakhir :
                </label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label">Pekerjaan :  </label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label">Tinggal Bersama : </label>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label">Agama : </label>
              </div>

            </div>
          </div>
        </div>

        <div class="col-md-6">
          <label class="control-label"><strong>STATUS KULTURAL (BUDAYA)</strong></label>
          <div class="row">
            <label class="control-label">Hal-hal yang berkaitan dengan agama, budaya, keyakinan atau kepercayaan (makanan,bahasa,dll</label>
            <textarea class="form-control input-focus area-scroll" id="status_kultural" name="status_kultural"
              rows="5" placeholder="STATUS KULTURAL (BUDAYA)"></textarea>
          </div>
        </div>

        <div class="col-md-6">
          <label class="control-label"><strong>STATUS SPIRITUAL</strong> </label> <br>
          <label class="control-label">Kemampuan beribadah</label>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label">Wajib beribadah :</label>
              </div>
            </div>

            <div class="col-md-9">
              <div class="form-group">
                <input list="ibadah" value="" class="col-sm-6 custom-select custom-select-sm">
                <datalist id="ibadah">
                    <option value="Baligh">Baligh</option>
                    <option value="Belum baligh">Belum baligh</option>
                    <option value="Halangan lain">Halangan lain</option>
                </datalist>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label">Thaharoh :</label>
              </div>
            </div>

            <div class="col-md-9">
              <div class="form-group">
                <input list="thaharoh" value="" class="col-sm-6 custom-select custom-select-sm">
                <datalist id="thaharoh">
                  <option value="Berwudlu">Berwudlu</option>
                  <option value="Tayamum">Tayamum</option>
                </datalist>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label">Sholat :</label>
              </div>
            </div>

            <div class="col-md-9">
              <div class="form-group">
                <input list="sholat" value="" class="col-sm-6 custom-select custom-select-sm">
                <datalist id="sholat">
                  <option value="Berdiri">Berdiri</option>
                  <option value="Duduk">Duduk</option>
                  <option value="Berbaring">Berbaring</option>
                </datalist>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <label class="control-label">Bimbingan Spiritual Muslim :</label>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <input type="checkbox" name="bim_spiritual_muslim[]" value="Bimbingan ibadah"> Bimbingan ibadah
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <input type="checkbox" name="bim_spiritual_muslim[]" value="motivasi kesembuhan"> motivasi kesembuhan
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <label class="control-label">Bimbingan Spiritual Non Muslim :</label>
              </div>
            </div>

            <div class="col-md-7">
              <div class="form-group">
                <input type="checkbox" name="bim_spiritual_nonmuslim[]" value="motivasi kesembuh"> motivasi kesembuh
              </div>
            </div>

          </div>

        </div>

        <div class="col-md-12">
          <!-- START PEMERIKSAAN UMUM -->
          <label class="control-label"><strong>PEMERIKSAAN KONDISI UMUM DAN TANDA TANDA VITAL</strong></label>

          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label class="control-label">Kesadaran</label>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <input type="text" class="form-control input-sm" id="kesadaran" name="kesadaran" placeholder="Kesadaran">
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label class="control-label">Keadaan Umum</label>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <input type="text" class="form-control input-sm" id="keadaan_umum" name="keadaan_umum" placeholder="Keadaan Umum">
              </div>
            </div>


            <div class="col-md-2">
              <div class="form-group">
                <label class="control-label">Tekanan Darah</label>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <input type="text" class="form-control input-sm" id="td" name="td" placeholder="Tekanan Darah">
              </div>
            </div>


            <div class="col-md-2">
              <div class="form-group">
                <label class="control-label">GCS</label>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <input type="text" class="form-control input-sm" id="gcs" name="gcs" placeholder="GCS">
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label class="control-label">Nadi</label>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <input type="text" class="form-control input-sm" id="nadi" name="nadi" placeholder="Nadi">
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label class="control-label">SUHU</label>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <input type="text" class="form-control input-sm" id="suhu" name="suhu" placeholder="SUHU">
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label class="control-label">Pernafasan</label>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <input type="text" class="form-control input-sm" id="nafas" name="nafas" placeholder="Pernafasan">
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label class="control-label">Reaksi Cahaya</label>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <input type="text" class="form-control input-sm" id="reaksi_cahaya" name="reaksi_cahaya" placeholder="Reaksi Cahaya">
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label class="control-label">Tinggi Badan</label>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <input type="text" class="form-control input-sm" id="tinggi" name="tinggi" placeholder="Tinggi Badan">
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label class="control-label">Berat Badan</label>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <input type="text" class="form-control input-sm" id="berat" name="berat" placeholder="Berat Badan">
              </div>
            </div>
          </div>

        </div><!-- END PEMERIKSAAN UMUM -->

        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label"><strong>Pemeriksaan Fisik Khusus</strong></label>
            <textarea class="form-control input-focus area-scroll" id="fisik_khusus" name="fisik_khusus"
              rows="5" placeholder="Pemeriksaan Fisik Khusus"></textarea>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label"><strong>PEMERIKSAAN UMUM</strong></label>
          </div>

          <div class="row">

            <div class="col-md-1">
              <div class="form-group">
                <label class="control-label">KEPALA :</label>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <input list="pu_kepala" value="" class="col-sm-6 custom-select custom-select-sm">
                <datalist id="pu_kepala">
                    <option value="Tidak ada masalah">Tidak ada masalah</option>
                    <option value="Asimetris">Asimetris</option>
                    <option value="Hematoma">Hematoma</option>
                    <option value="Mesosefal">Mesosefal</option>
                    <option value="Lain-Lain">Lain-Lain</option>
                </datalist>
              </div>
            </div>

            <div class="col-md-1">
              <div class="form-group">
                <label class="control-label">RAMBUT :</label>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <input list="pu_rambut" value="" class="col-sm-6 custom-select custom-select-sm">
                <datalist id="pu_rambut">
                    <option value="Tidak ada masalah">Tidak ada masalah</option>
                    <option value="Berminyak">Berminyak</option>
                    <option value="Kering">Kering</option>
                    <option value="Rontok">Rontok</option>
                    <option value="Bersih">Bersih</option>
                    <option value="Kotor">Kotor</option>
                    <option value="Cat rambut warna ">Cat rambut warna </option>
                </datalist>
              </div>
            </div>

            <div class="col-md-1">
              <div class="form-group">
                <label class="control-label">MATA :</label>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <input list="pu_mata" value="" class="col-sm-6 custom-select custom-select-sm">
                <datalist id="pu_mata">
                    <option value="Tidak ada masalah">Tidak ada masalah</option>
                    <option value="Sclera anemis">Sclera anemis</option>
                    <option value="Konjungtivitis">Konjungtivitis</option>
                    <option value="anisokor">anisokor</option>
                    <option value="Midriasis/miosis">Midriasis/miosis</option>
                    <option value="Tidak ada reaksi cahaya">Tidak ada reaksi cahaya</option>
                    <option value="Gangguan penglihatan">Gangguan penglihatan</option>
                    <option value="Lain-Lain ">Lain-Lain </option>
                </datalist>
              </div>
            </div>

            <div class="col-md-1">
              <div class="form-group">
                <label class="control-label">GIGI :</label>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <input list="pu_gigi" value="" class="col-sm-6 custom-select custom-select-sm">
                <datalist id="pu_gigi">
                    <option value="Tidak ada masalah">Tidak ada masalah</option>
                    <option value="Goyang">Goyang</option>
                    <option value="Tambal">Tambal</option>
                    <option value="Gigi Palsu">Gigi Palsu</option>
                    <option value="Karies">Karies</option>
                    <option value="Lain-Lain ">Lain-Lain </option>
                </datalist>
              </div>
            </div>

            <div class="col-md-1">
              <div class="form-group">
                <label class="control-label">Tenggorokan:</label>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <input list="pu_tenggorokan" value="" class="col-sm-6 custom-select custom-select-sm">
                <datalist id="pu_tenggorokan">
                    <option value="Tidak ada masalah">Tidak ada masalah</option>
                    <option value="Sakit Menelan ">Sakit Menelan </option>
                    <option value="Tonsil Membesar">Tonsil Membesar</option>
                    <option value="Faring Merah">Faring Merah</option>
                    <option value="Lain-Lain">Lain-Lain </option>
                </datalist>
              </div>
            </div>

            <div class="col-md-1">
              <div class="form-group">
                <label class="control-label">LIDAH :</label>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <input list="pu_lidah" value="" class="col-sm-6 custom-select custom-select-sm">
                <datalist id="pu_lidah">
                    <option value="Tidak ada masalah">Tidak ada masalah</option>
                    <option value="Mukosa Kering ">Mukosa Kering </option>
                    <option value="Gerakan Asimetris">Gerakan Asimetris</option>
                    <option value="Kotor">Kotor</option>
                    <option value="Lain-Lain ">Lain-Lain </option>
                </datalist>
              </div>
            </div>

            <div class="col-md-1">
              <div class="form-group">
                <label class="control-label">LEHER :</label>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <input list="pu_leher" value="" class="col-sm-6 custom-select custom-select-sm">
                <datalist id="pu_leher">
                    <option value="Tidak ada masalah">Tidak ada masalah</option>
                    <option value="Pembesaran Vena Jugularis">Pembesaran Vena Jugularis</option>
                    <option value="Kaku Kuduk">Kaku Kuduk</option>
                    <option value="Keterbatasan Gerak">Keterbatasan Gerak</option>
                    <option value="Pembesaran Tiroid ">Pembesaran Tiroid </option>
                </datalist>
              </div>
            </div>

            <div class="col-md-1">
              <div class="form-group">
                <label class="control-label">ABDOMEN :</label>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <input list="pu_abdomen" value="" class="col-sm-6 custom-select custom-select-sm">
                <datalist id="pu_abdomen">
                    <option value="Distensi">Distensi</option>
                    <option value="Nyeri">Nyeri</option>
                    <option value="Perisaltik">Perisaltik</option>
                    <option value="Defeksi">Defeksi</option>
                    <option value="Lain-Lain ">Lain-Lain </option>
                </datalist>
              </div>
            </div>

            <div class="col-md-1">
              <div class="form-group">
                <label class="control-label">DADA :</label>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <input list="pu_dada" value="" class="col-sm-6 custom-select custom-select-sm">
                <datalist id="pu_dada">
                    <option value="Tidak ada kelainan">Tidak ada kelainan</option>
                    <option value="Retraksi">Retraksi</option>
                    <option value="Asimetris">Asimetris</option>
                </datalist>
              </div>
            </div>

            <div class="col-md-1">
              <div class="form-group">
                <label class="control-label">RESPIRASI :</label>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <input list="pu_respirasi" value="" class="col-sm-6 custom-select custom-select-sm">
                <datalist id="pu_respirasi">
                    <option value="Tidak ada kesulitan">Tidak ada kesulitan</option>
                    <option value="Nyeri">Nyeri</option>
                    <option value="Batuk">Batuk</option>
                    <option value="Dyspnea">Dyspnea</option>
                    <option value="Sputum">Sputum</option>
                    <option value="Tracheostomy">Tracheostomy</option>
                    <option value="Ronchi di paru kanan / kiri">Ronchi di paru kanan / kiri</option>
                    <option value="Nafas pendek">Nafas pendek</option>
                    <option value="Haemaptoe">Haemaptoe</option>
                    <option value="Bradipnea">Bradipnea</option>
                    <option value="Takipnea">Takipnea</option>
                    <option value="Sleep apnea">Sleep apnea</option>
                    <option value="Alat bantu nafas saat di rumah">Alat bantu nafas saat di rumah</option>
                    <option value="Tidak">Tidak</option>
                </datalist>
              </div>
            </div>

            <div class="col-md-1">
              <div class="form-group">
                <label class="control-label">JANTUNG :</label>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <input list="pu_jantung" value="" class="col-sm-6 custom-select custom-select-sm">
                <datalist id="pu_jantung">
                    <option value="Suara S1/S2">Suara S1/S2</option>
                    <option value="Murmur">Murmur</option>
                    <option value="Gallop">Gallop</option>
                    <option value="Nyeri dada">Nyeri dada</option>
                    <option value="aritmia">aritmia</option>
                    <option value="bradikardi">bradikardi</option>
                    <option value="facemaker">facemaker</option>
                    <option value="Tachikardia">Tachikardia</option>
                    <option value="palpitasi">palpitasi</option>
                    <option value="lain – lain ">lain – lain </option>
                </datalist>
              </div>
            </div>

            <div class="col-md-1">
              <div class="form-group">
                <label class="control-label">Integumen :</label>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <input list="pu_integumen" value="" class="col-sm-6 custom-select custom-select-sm">
                <datalist id="pu_integumen">
                    <option value="Baik">Baik</option>
                    <option value="Elastis">Elastis</option>
                    <option value="Rash/kemerahan">Rash/kemerahan</option>
                    <option value="Diaphoresis/banyak keringat">Diaphoresis/banyak keringat</option>
                    <option value="Fistula">Fistula</option>
                    <option value="Bula">Bula</option>
                    <option value="Memar">Memar</option>
                    <option value="Ada indikasi kekerasan fisik">Ada indikasi kekerasan fisik</option>
                    <option value="RL positif">RL positif</option>
                    <option value="Luka parut">Luka parut</option>
                    <option value="Braden score">Braden score</option>
                    <option value="Lokasi luka/lesi//benjolan/fraktur (lihat gambar)">Lokasi luka/lesi//benjolan/fraktur (lihat gambar)</option>
                </datalist>
              </div>
            </div>

            <div class="col-md-1">
              <div class="form-group">
                <label class="control-label">Ekstremitas :</label>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <input list="pu_ekstremitas" value="" class="col-sm-6 custom-select custom-select-sm">
                <datalist id="pu_ekstremitas">
                    <option value="Tidak ada kelainan">Tidak ada kelainan</option>
                    <option value="Atas : kanan…….. / kiri">Atas : kanan…….. / kiri</option>
                    <option value="Bawah : kanan ……….. / kiri">Bawah : kanan ……….. / kiri</option>
                    <option value="Kontraktur">Kontraktur</option>
                    <option value="Tremor">Tremor</option>
                    <option value="Plegi di">Plegi di</option>
                    <option value="Kekuatan otot">Kekuatan otot</option>
                    <option value="Inkoorniasi">Inkoorniasi</option>
                    <option value="Paresi di">Paresi di</option>
                    <option value="Edema">Edema</option>
                    <option value="Rasa baal">Rasa baal</option>
                    <option value="Kemampuan menggenggam">Kemampuan menggenggam</option>
                    <option value="kuat">kuat</option>
                    <option value="lemah">lemah</option>
                    <option value="Paralysis">Paralysis</option>
                    <option value="Deformitas">Deformitas</option>
                    <option value="Kelainan kongenital">Kelainan kongenital</option>
                </datalist>
              </div>
            </div>

            <div class="col-md-1">
              <div class="form-group">
                <label class="control-label">Genetalia :</label>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <input list="pu_genetalia" value="" class="col-sm-6 custom-select custom-select-sm">
                <datalist id="pu_genetalia">
                    <option value="Tidak ada kelainan">Tidak ada kelainan</option>
                    <option value="Keputihan">Keputihan</option>
                    <option value="Berbau">Berbau</option>
                    <option value="Kotor">Kotor</option>
                </datalist>
              </div>
            </div>

            <div class="col-md-1">
              <div class="form-group">
                <label class="control-label">Eliminiasi :</label>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <input list="pu_elimitas" value="" class="col-sm-6 custom-select custom-select-sm">
                <datalist id="pu_elimitas">
                    <option value="BAB, konsistensi:">BAB, konsistensi:</option>
                    <option value="Lunak / keras :">Lunak / keras :</option>
                    <option value="Frekuensi ….. x/har">Frekuensi ….. x/har</option>
                    <option value="BAK , frekuensi …… x / hari">BAK , frekuensi …… x / hari</option>
                </datalist>
              </div>
            </div>

          </div>
        </div>

        <!-- START STATUS NYERI -->
        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label"><strong>STATUS NYERI :</strong></label>
          </div>
        </div>

        <div class="col-md-4">
          <img src="<?php echo base_url('assets/img/skala_nyeri.jpg'); ?>" height="100px" width="350px">
        </div>

        <div class="col-md-8">
          <div class="row">
            <div class="col-sm-3">
              <label class="control-label">Kualitas Nyeri :</label>
            </div>
            <div class="col-sm-3">
              <input type="radio" name="kategori" value="Tertusuk" /> Tertusuk
            </div>
            <div class="col-sm-3">
              <input type="radio" name="kategori" value="Terbakar" /> Terbakar
            </div>
            <div class="col-sm-3">
              <input type="radio" name="kategori" value="Tertekan" /> Tertekan
            </div>
          </div>

          <div class="row">
            <div class="col-sm-3">
              <label class="control-label">Frekuensi nyeri :</label>
            </div>
            <div class="col-sm-9">
              <input type="text" class="form-control input-default" id="id_asm" name="id_asm">
            </div>
          </div>

          <div class="row">
            <div class="col-sm-3">
              <label class="control-label">Timbul nyeri saat :</label>
            </div>
            <div class="col-sm-3">
              <input type="radio" name="kategori" value="Beraktifitas" /> Beraktifitas
            </div>
            <div class="col-sm-3">
              <input type="radio" name="kategori" value="Beristirahat" /> Beristirahat
            </div>
          </div>

          <div class="row">
            <div class="col-sm-3">
              <label class="control-label">Intensitas nyeri :</label>
            </div>
            <div class="col-sm-3">
              <input type="radio" name="kategori" value="Tidak ada nyeri : (0)" /> Tidak ada nyeri : (0)
            </div>
            <div class="col-sm-3">
              <input type="radio" name="kategori" value="Nyeri ringan (1-3)" /> Nyeri ringan (1-3)
            </div>
            <div class="col-sm-3">
              <input type="radio" name="kategori" value="Nyeri sedang (4-6)" /> Nyeri sedang (4-6)
            </div>
            <div class="col-sm-3">

            </div>
            <div class="col-sm-3">
              <input type="radio" name="kategori" value="Nyeri berat(7-9)" /> Nyeri berat (7-9)
            </div>
            <div class="col-sm-4">
              <input type="radio" name="kategori" value="Nyeri sangat berat (10)" /> Nyeri sangat berat (10)
            </div>
          </div>

        </div>

        <div class="col-md-12">
          <div class="row">
            <div class="col-sm-3">
              <label class="control-label">Nyeri / tidak nyaman :</label>
            </div>
            <div class="col-sm-2">
              <input type="radio" name="kategori" value="YA" /> YA
            </div>
            <div class="col-sm-2">
              <input type="radio" name="kategori" value="TIDAK" /> TIDAK
            </div>
          </div>

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label">Nyeri mempengaruhi:</label>
              </div>
            </div>

            <div class="col-md-9">
              <div class="form-group">
                <input list="pu_kepala" value="" class="col-sm-6 custom-select custom-select-sm">
                <datalist id="pu_kepala">
                    <option value="Tidur">Tidur</option>
                    <option value="Aktivitas fisik">Aktivitas fisik</option>
                    <option value="Konsentrasi">Konsentrasi</option>
                    <option value="Nafsu makan">Nafsu makan</option>
                    <option value="Emosi">Emosi</option>
                </datalist>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-3">
              <label class="control-label">Aktivitas :</label>
            </div>
            <div class="col-sm-2">
              <input type="radio" name="kategori" value="Mandiri" /> Mandiri
            </div>
            <div class="col-sm-2">
              <input type="radio" name="kategori" value="Bantuan total" /> Bantuan total
            </div>
            <div class="col-sm-2">
              <input type="radio" name="kategori" value="Bantu sebagian" /> Bantu sebagian
            </div>
            <div class="col-sm-2">
              <input type="radio" name="kategori" value="Resiko tinggi" /> Resiko tinggi
            </div>
          </div>

          <div class="row">
            <div class="col-sm-3">
              <label class="control-label">Perlu Restrain :</label>
            </div>
            <div class="col-sm-2">
              <input type="radio" name="kategori" value="YA" /> YA
            </div>
            <div class="col-sm-2">
              <input type="radio" name="kategori" value="TIDAK" /> TIDAK
            </div>
          </div>

        </div>
        <!-- END STATUS NYERI -->

        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label"><strong>STATUS KRITERIA RISIKO NUTRISIONAL (MALNUTRISION SCREENING TOOL / MST)  :</strong></label>
          </div>
        </div>

        <div class="col-md-12">
          <div class="row">
            <div class="col-sm-5">
              <label class="control-label">Apakah pasien mengalami penurunan BB dalam 6 bulan terakhir ?</label>
            </div>
            <div class="col-sm-2">
              <input type="radio" name="kategori" value="0" /> Tidak (skor O)
            </div>
            <div class="col-sm-5">
              <input type="radio" name="kategori" value="2" /> Tidak yakin I tidak tahu I baju terasa lebih longgar (skor 2)
            </div>
          </div>

          <div class="row">
            <div class="col-sm-3">
              <label class="control-label">Jika ya berapa penurunan BB tersebut :</label>
            </div>
            <div class="col-sm-2">
              <input type="radio" name="kategori" value="1" /> 1-5 kg (skor1)
            </div>
            <div class="col-sm-2">
              <input type="radio" name="kategori" value="2" />  6-10 kg (skor2)
            </div>
            <div class="col-sm-2">
              <input type="radio" name="kategori" value="3" /> 11-15kg(skor3)
            </div>
            <div class="col-sm-2">
              <input type="radio" name="kategori" value="4" /> 15kg(skor4)
            </div>
          </div>

          <div class="row">
            <div class="col-sm-3">
              <label class="control-label">Total Skor :</label>
            </div>
            <div class="col-sm-9">
              <input type="text" class="form-control input-default" id="id_asm" name="id_asm">
            </div>
          </div>

          <div class="row">
            <div class="col-sm-3">
              <label class="control-label">Apakah pasien mempunyai diagnos khusus :</label>
            </div>
            <div class="col-sm-2">
              <input type="radio" name="kategori" value="Tidak" /> Tidak
            </div>
            <div class="col-sm-5">
              <input type="radio" name="kategori" value="Ya (DM/CKD/HD/Kanker/Hipertensi/Penurunan imunitas)" /> Ya (DM/CKD/HD/Kanker/Hipertensi/Penurunan imunitas)
            </div>
          </div>

          <div class="row">
            <div class="col-sm-3">
              <label class="control-label">Pola Makan :

              </label>
            </div>
            <div class="col-sm-9">
              <input type="text" class="form-control input-default" id="id_asm" name="id_asm">
            </div>
          </div>

          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label">Keluhan Saat ini :</label>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="wajib_ibadah[]" value="Mual"> Mual
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="wajib_ibadah[]" value="Muntah"> Muntah
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="wajib_ibadah[]" value="Sulit menelan"> Sulit menelan
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="wajib_ibadah[]" value="Tidak ada masalah"> Tidak ada masalah
              </div>
            </div>
          </div>


        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label"><strong>STATUS FUNGSIONAL</strong></label>
          </div>
        </div>

        <div class="col-md-6">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Aktifitas</th>
                <th scope="col">Dengan bantuan</th>
                <th scope="col">Mandiri</th>
                <th scope="col">nilai</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Makan (Feeding)</td>
                <td>5</td>
                <td>10</td>
                <td><input type="text" class="form-control input-default" id="id_asm" name="id_asm"></td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Transfer/ perpindahan tubuh</td>
                <td>5-10</td>
                <td>15</td>
                <td><input type="text" class="form-control input-default" id="id_asm" name="id_asm"></td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Perawatan Diri/kebersihan (Grooming)</td>
                <td>0</td>
                <td>5</td>
                <td><input type="text" class="form-control input-default" id="id_asm" name="id_asm"></td>
              </tr>
              <tr>
                <th scope="row">4</th>
                <td>Masuk dan keluar ke toilet</td>
                <td>5</td>
                <td>10</td>
                <td><input type="text" class="form-control input-default" id="id_asm" name="id_asm"></td>
              </tr>
              <tr>
                <th scope="row">5</th>
                <td>Mandi sendiri</td>
                <td>0</td>
                <td>5</td>
                <td><input type="text" class="form-control input-default" id="id_asm" name="id_asm"></td>
              </tr>
              <tr>
                <th scope="row">6</th>
                <td>Berjalan di permukaan datar (atau dengan kursi roda)</td>
                <td>0</td>
                <td>5</td>
                <td><input type="text" class="form-control input-default" id="id_asm" name="id_asm"></td>
              </tr>
              <tr>
                <th scope="row">7</th>
                <td>Naik Turun Tangga</td>
                <td>5</td>
                <td>10</td>
                <td><input type="text" class="form-control input-default" id="id_asm" name="id_asm"></td>
              </tr>
              <tr>
                <th scope="row">8</th>
                <td>Memakai baju/berpakaian</td>
                <td>5</td>
                <td>10</td>
                <td><input type="text" class="form-control input-default" id="id_asm" name="id_asm"></td>
              </tr>
              <tr>
                <th scope="row">9</th>
                <td>Mengontrol Buang Air Besar (Bowel)</td>
                <td>5</td>
                <td>10</td>
                <td><input type="text" class="form-control input-default" id="id_asm" name="id_asm"></td>
              </tr>
              <tr>
                <th scope="row">10</th>
                <td>Mengontrol Buang Air Kecil (Bladder)</td>
                <td>5</td>
                <td>10</td>
                <td><input type="text" class="form-control input-default" id="id_asm" name="id_asm"></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="col-md-6">
          Catatan : diberikan nilai 0 bila pasien tidak dapat
          melakukan kriteria yang telah ditentukan <br><br>

          Kategori Nilai : <br>
          0 – 20 Dependen Total <br>
          21 – 60 Dependen Berat <br>
          61 – 90 Dependen sedang<br>
          91 – 99 Dependen Ringan <br>
          100 Independen Mandiri <br><br>

          <div class="row">
            <label class="control-label">RISIKO JATUH :</label>
            <div class="col-md-12">
              <div class="row">
                <div class="col-sm-3">
                  <label class="control-label">Risiko Jatuh Dewasa:</label>
                </div>
                <div class="col-sm-3">
                  <input type="radio" name="kategori" value="Ringan 0 – 24" /> Ringan 0 – 24
                </div>
                <div class="col-sm-3">
                  <input type="radio" name="kategori" value="Sedang 25- 44" /> Sedang 25- 44
                </div>
                <div class="col-sm-2">
                  <input type="radio" name="kategori" value="Berat >= 45" /> Berat >= 45
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="row">
                <div class="col-sm-3">
                  <label class="control-label">Risiko Jatuh Geriatrik</label>
                </div>
                <div class="col-sm-3">
                  <input type="radio" name="kategori" value="Risiko Rendah 1-3" /> Risiko Rendah 1-3
                </div>
                <div class="col-sm-3">
                  <input type="radio" name="kategori" value="Risiko Tinggi >= 4" /> Risiko Tinggi >= 4
                </div>
              </div>
            </div>
          </div>

        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label">PEMERIKSAAN PENUNJANG :</label>
            <textarea class="form-control input-focus area-scroll" id="pemeriksaan_penunjang"
              name="pemeriksaan_penunjang" rows="5" placeholder="Pemeriksaan Penunjang"></textarea>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label">MASALAH KESEHATAN Diare :</label>
            <textarea class="form-control input-focus area-scroll" id="masalah_kesehatan"
              name="masalah_kesehatan" rows="5" placeholder="MASALAH KESEHATAN"></textarea>
          </div>
        </div>

      </div>

      <h3 class="pnl-head-3">ASSESMENT</h3>
      <div class="row pnl">
        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label">MASALAH KEPERAWATAN :</label>
            <textarea class="form-control input-focus area-scroll" id="masalah_keperawatan"
              name="masalah_keperawatan" rows="8" placeholder="MASALAH KEPERAWATAN"></textarea>
          </div>
        </div>

      </div>

      <h3 class="pnl-head-3">PLANNING</h3>
      <div class="row pnl">

        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label"><strong>RENCANA KEPERAWATAN/TARGET TERUKUR</strong></label>
            <textarea class="form-control input-focus area-scroll" id="rencana_keperawatan" name="rencana_keperawatan"
              rows="5" placeholder="RENCANA KEPERAWATAN/TARGET TERUKUR"></textarea>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label"><strong>KEBUTUHAN EDUKASI / PENDIDIKAN KESEHATAN :</strong></label>
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <input type="checkbox" name="edukasi[]" value="Proses Penyakit"> Proses Penyakit
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <input type="checkbox" name="edukasi[]" value="Pengobatan/tindakan"> Pengobatan/tindakan
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <input type="checkbox" name="edukasi[]" value="Tata tertib Rumah sakit"> Tata tertib Rumah sakit
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <input type="checkbox" name="edukasi[]" value="Nutrisi/diet"> Nutrisi/diet
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <input type="checkbox" name="edukasi[]" value="Perawatan perioperative"> Perawatan perioperative
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <input type="checkbox" name="edukasi[]" value="Manajemen nyeri"> Manajemen nyeri
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <input type="checkbox" name="edukasi[]" value="Pelayanan spiritual"> Pelayanan spiritual
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <input type="checkbox" name="edukasi[]" value="Motivasi kesembuhan"> Motivasi kesembuhan
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <input type="checkbox" name="edukasi[]" value="Pelayanan islami"> Pelayanan islami
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <input type="checkbox" name="edukasi[]" value="Fasilitas ruangan"> Fasilitas ruangan
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <input type="checkbox" name="edukasi[]" value="Informasi tentang tim medis"> Informasi tentang tim medis
                </div>
              </div>


            </div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label"><strong>PERENCANAAN PASIEN PULANG :</strong></label>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <input type="checkbox" name="pasien_pulang[]" value=" Diperlukan discharge planning">  Diperlukan discharge planning
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <input type="checkbox" name="pasien_pulang[]" value="Usia > 65 tahun"> Usia > 65 tahun
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <input type="checkbox" name="pasien_pulang[]" value="Bantuan untuk melakukan aktifitas sehari-hari"> Bantuan untuk melakukan aktifitas sehari-hari
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <input type="checkbox" name="pasien_pulang[]" value="Keterbatasan mobilitas"> Keterbatasan mobilitas
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <input type="checkbox" name="pasien_pulang[]" value="Perawatan/pengobatan lanjutan"> Perawatan/pengobatan lanjutan
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <input type="checkbox" name="pasien_pulang[]" value="Tidak Memerlukan discharge planning"> Tidak Memerlukan discharge planning
                </div>
              </div>

            </div>
          </div>
        </div>

      </div>

        <div class="modal-footer">
          <div class="form-actions">
            <button type="button" class="btn btn-success"
              onclick="javascript: save_asm('');">
              <i class="fa fa-check"></i> Save</button>
            <button type="button" class="btn btn-inverse" data-dismiss="modal">Cancel</button>
          </div>
        </div>

    </div>
  </form>
</div>

<?php $this->theme->script('theme_default'); ?>

<!-- action here -->
<script>


</script>

</body>

</html>
