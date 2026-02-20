<script>
var id_reg = '<?php echo $id_reg; ?>';
var id_pasien = '<?php echo $id_pasien; ?>';
</script>
<style>
.pnl-head-3{
	border-radius: 40px 40px 0 0;
	background-color: #CCC;
	margin-bottom:0;
}
hr{
	margin-top:3px;
	margin-bottom:5px;
}
.table-cppt{
    border-style: solid;
    border-color: black;
    }

    .pnl{
    background-color:#f8f8f8;
    }
</style>
<div class="container-fluid">
	<form id="frm_asm_ri_dokter" method="post" action="<?php echo base_url('erm_ranap/act_asm_ranap/'.$id_reg.'/'.$id_pasien); ?>">
  <input type="hidden" id="id_asmri" name="id_asmri" value="<?php echo $row['id_asmri']; ?>">
  <input type="hidden" id="sql_command" name="sql_command" value="<?php echo $sql_command; ?>">
  <input type="hidden" id="kategori" name="kategori" value="ASM">
  <div class="row pnl">
    <div class="col-md-6">
      <div class="row">
        <div class="col-sm-3">
          <label class="control-label">Tanggal Masuk :</label>
        </div>
        <div class="col-sm-9">
          <label class="control-label"><?php echo $data_pasien['regdate']; ?></label>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="row">
        <div class="col-sm-3">
          <label class="control-label">Asal Masuk :</label>
        </div>
        <div class="col-sm-3">
          <input type="radio" name="asal_masuk" value="IGD" /> IGD
        </div>
        <div class="col-sm-5">
          <input type="radio" name="asal_masuk" value="Rawat Jalan" /> RAWAT JALAN
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="row">
        <div class="col-sm-3">
          <label class="control-label">Pengkajian :</label>
        </div>
        <div class="col-sm-9">
          <input type="text" name="tgl_pengkajian" id="tgl_pengkajian" class="form-control tanggal" value="<?php echo $row['tgl_pengkajian']; ?>">
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="row">
        <div class="col-sm-3">
          <label class="control-label">Cara Masuk :</label>
        </div>
        <div class="col-sm-3">
          <input type="radio" name="cara_masuk" value="JALAN" /> JALAN
        </div>
        <div class="col-sm-3">
          <input type="radio" name="cara_masuk" value="KURSI RODA" /> KURSI RODA
        </div>
        <div class="col-sm-3">
          <input type="radio" name="cara_masuk" value="BRANKAR" /> BRANKAR
        </div>
      </div>
    </div>

  </div>


	<h3 class="pnl-head-3" style="margin-top:30px">SUBJECTIVE</h3>
  <div class="row pnl">

    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label">Keluhan Utama :</label>
        <textarea class="form-control input-focus area-scroll" id="keluhan_utama" name="keluhan_utama" rows="5"
          placeholder="Keluhan Utama"><?php echo $row['keluhan_utama']; ?></textarea>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label">Riwayat Penyakit Sekarang :</label>
        <textarea class="form-control input-focus area-scroll" id="riwayat_sakit_now"
          name="riwayat_sakit" rows="5" placeholder="Riwayat Penyakit Sekarang"><?php echo $row['riwayat_sakit']; ?></textarea>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label">Riwayat Penyakit Dahulu :</label>
        <textarea class="form-control input-focus area-scroll" id="riwayat_sakit_old"
          name="riwayat_sakit_dulu" rows="5" placeholder="Riwayat Penyakit Dahulu"><?php echo $riwayat_pasien['penyakit_dahulu']; ?></textarea>
      </div>
    </div>

    <!--/span-->
    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label">Riwayat Pengobatan/Operasi/Obstetri :</label>
        <textarea class="form-control input-focus area-scroll" id="riwayat_pengobatan"
          name="riwayat_pengobatan" rows="5" placeholder="Riwayat Pengobatan/Operasi/Obstetri"><?php echo $riwayat_pasien['pengobatan']; ?></textarea>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label">Riwayat Penyakit Keluarga :</label>
        <textarea class="form-control input-focus area-scroll" id="riwayat_sakit_keluarga"
          name="riwayat_sakit_keluarga" rows="5" placeholder="Riwayat Penyakit Keluarga"><?php echo $riwayat_pasien['penyakit_keluarga']; ?></textarea>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label class="control-label">Riwayat Alergi :</label>
        <textarea class="form-control input-focus area-scroll" id="riwayat_alergi" name="riwayat_alergi"
          rows="5" placeholder="Riwayat Alergi"><?php echo $riwayat_pasien['alergi']; ?></textarea>
      </div>
    </div>

  </div>
  <br>

	<h3 class="pnl-head-3">OBJECTIVE</h3>
  <div class="row pnl pnl-obj">
    <!--
    <div class="col-md-12">
      <div class="form-group">
        <label class="control-label"><strong>OBJECTIVE</strong></label>
        <hr>
      </div>
    </div>
	  -->

    <div class="col-md-12">
      <div class="form-group">
      	<textarea class="form-control input-focus area-scroll" id="objective" name="objective" rows="5"
          placeholder="Objective"><?php echo $row['objective']; ?></textarea>
      </div>
    </div>

    <div class="col-md-12">
      <div class="form-group">
        <h4>TTV</h4>
        <hr>
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Kesadaran</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="kesadaran" name="kesadaran" placeholder="Kesadaran" value="<?php echo $row['kesadaran']; ?>">
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Keadaan Umum</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="keadaan_umum" name="keadaan_umum" placeholder="Keadaan Umum" value="<?php echo $row['keadaan_umum']; ?>">
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Tekanan Darah</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="td" name="td" placeholder="Tekanan Darah" value="<?php echo $row['td']; ?>">
      </div>
    </div>


    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">GCS</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="gcs" name="gcs" placeholder="GCS" value="<?php echo $row['gcs']; ?>">
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Nadi</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="nadi" name="nadi" placeholder="Nadi" value="<?php echo $row['nadi']; ?>">
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">SUHU</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="suhu" name="suhu" placeholder="SUHU" value="<?php echo $row['suhu']; ?>">
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Pernafasan</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="nafas" name="nafas" placeholder="Pernafasan" value="<?php echo $row['nafas']; ?>">
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Reflek Cahaya</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="reaksi_cahaya" name="reaksi_cahaya" placeholder="Reflek Cahaya" value="<?php echo $row['reaksi_cahaya']; ?>">
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Tinggi Badan</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="tinggi" name="tinggi" placeholder="Tinggi Badan" value="<?php echo $row['tinggi']; ?>">
      </div>
    </div>

    <div class="col-md-2">
      <div class="form-group">
        <label class="control-label">Berat Badan</label>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <input type="text" class="form-control input-sm" id="berat" name="berat" placeholder="Berat Badan" value="<?php echo $row['berat']; ?>">
      </div>
    </div>



  </div>
  <br>

  <!--add on rihan 12-04-2023-->
  <h3 class="pnl-head-3">PEMERIKSAAN UMUM</h3>
  <div class="row pnl pnl-obj">
  <div class="col-md-12">
          <!-- START PEMERIKSAAN UMUM -->
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
                <input list="pu_kepala" name="pu_kepala" value="" class="col-sm-6 custom-select custom-select-sm">
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
                <label class="control-label">RAMBUT:</label>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <input list="pu_rambut" name="pu_rambut" value="" class="col-sm-6 custom-select custom-select-sm">
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
                <label class="control-label">WAJAH:</label>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <input list="pu_wajah" name="pu_wajah" value="" class="col-sm-6 custom-select custom-select-sm">
                <datalist id="pu_wajah">
                    <option value="Tidak ada masalah">Tidak ada masalah</option>
                    <option value="Bells palsy">Bells palsy</option>
                    <option value="Tic facials">Tic facials</option>
                    <option value="Kelainan kongenital">Kelainan kongenital</option>
                    <option value="asimetris">asimetris</option>
                </datalist>
              </div>
            </div>

            <div class="col-md-1">
              <div class="form-group">
                <label class="control-label">MATA:</label>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <input list="pu_mata" name="pu_mata" value="" class="col-sm-6 custom-select custom-select-sm">
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
                <label class="control-label">GIGI:</label>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <input list="pu_gigi" name="pu_gigi" value="" class="col-sm-6 custom-select custom-select-sm">
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
                <input list="pu_tenggorokan" name="pu_tenggorokan" value="" class="col-sm-6 custom-select custom-select-sm">
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
                <label class="control-label">LIDAH:</label>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <input list="pu_lidah" name="pu_lidah" value="" class="col-sm-6 custom-select custom-select-sm">
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
                <label class="control-label">LEHER:</label>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <input list="pu_leher" name="pu_leher" value="" class="col-sm-6 custom-select custom-select-sm">
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
                <label class="control-label">ABDOMEN:</label>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <input list="pu_abdomen" name="pu_abdomen" value="" class="col-sm-6 custom-select custom-select-sm">
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
                <label class="control-label">DADA:</label>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <input list="pu_dada" name="pu_dada" value="" class="col-sm-6 custom-select custom-select-sm">
                <datalist id="pu_dada">
                    <option value="Tidak ada kelainan">Tidak ada kelainan</option>
                    <option value="Retraksi">Retraksi</option>
                    <option value="Asimetris">Asimetris</option>
                </datalist>
              </div>
            </div>

            <div class="col-md-1">
              <div class="form-group">
                <label class="control-label">RESPIRASI:</label>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <input list="pu_respirasi" name="pu_respirasi" value="" class="col-sm-6 custom-select custom-select-sm">
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
                <label class="control-label">JANTUNG:</label>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <input list="pu_jantung" name="pu_jantung" value="" class="col-sm-6 custom-select custom-select-sm">
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
                <label class="control-label">Integumen:</label>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <input list="pu_integumen" name="pu_integumen" value="" class="col-sm-6 custom-select custom-select-sm">
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
                <label class="control-label">Ekstremitas:</label>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <input list="pu_ekstremitas" name="pu_ekstremitas" value="" class="col-sm-6 custom-select custom-select-sm">
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
                <label class="control-label">Genitalia:</label>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <input list="pu_genetalia" name="pu_genetalia" value="" class="col-sm-6 custom-select custom-select-sm">
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
                <label class="control-label">Eliminiasi:</label>
              </div>
            </div>

            <div class="col-md-5">
              <div class="form-group">
                <input list="pu_elimitas" name="pu_elimitas" value="" class="col-sm-6 custom-select custom-select-sm">
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
              <input type="radio" name="kualitas_nyeri" value="Tertusuk" /> Tertusuk
            </div>
            <div class="col-sm-3">
              <input type="radio" name="kualitas_nyeri" value="Terbakar" /> Terbakar
            </div>
            <div class="col-sm-3">
              <input type="radio" name="kualitas_nyeri" value="Tertekan" /> Tertekan
            </div>
          </div>

          <div class="row">
            <div class="col-sm-3">
              <label class="control-label">Frekuensi nyeri :</label>
            </div>
            <div class="col-sm-9">
              <input type="text" class="form-control input-default" id="frekuensi_nyeri" name="frekuensi_nyeri">
            </div>
          </div>

          <div class="row">
            <div class="col-sm-3">
              <label class="control-label">Timbul nyeri saat :</label>
            </div>
            <div class="col-sm-3">
              <input type="radio" name="waktu_nyeri" value="Beraktifitas" /> Beraktifitas
            </div>
            <div class="col-sm-3">
              <input type="radio" name="waktu_nyeri" value="Beristirahat" /> Beristirahat
            </div>
          </div>

          <div class="row">
            <div class="col-sm-3">
              <label class="control-label">Intensitas nyeri :</label>
            </div>
            <div class="col-sm-3">
              <input type="radio" name="intesnsitas_nyeri" value="Tidak ada nyeri : (0)" /> Tidak ada nyeri : (0)
            </div>
            <div class="col-sm-3">
              <input type="radio" name="intesnsitas_nyeri" value="Nyeri ringan (1-3)" /> Nyeri ringan (1-3)
            </div>
            <div class="col-sm-3">
              <input type="radio" name="intesnsitas_nyeri" value="Nyeri sedang (4-6)" /> Nyeri sedang (4-6)
            </div>
            <div class="col-sm-3">

            </div>
            <div class="col-sm-3">
              <input type="radio" name="intesnsitas_nyeri" value="Nyeri berat(7-9)" /> Nyeri berat (7-9)
            </div>
            <div class="col-sm-4">
              <input type="radio" name="intesnsitas_nyeri" value="Nyeri sangat berat (10)" /> Nyeri sangat berat (10)
            </div>
          </div>

        </div>

        <div class="col-md-12">
          <div class="row">
            <div class="col-sm-3">
              <label class="control-label">Nyeri / tidak nyaman :</label>
            </div>
            <div class="col-sm-2">
              <input type="radio" name="nyeri" value="YA" /> YA
            </div>
            <div class="col-sm-2">
              <input type="radio" name="nyeri" value="TIDAK" /> TIDAK
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
                <input list="pengaruh_nyeri" name="pengaruh_nyeri" value="" class="col-sm-6 custom-select custom-select-sm">
                <datalist id="pengaruh_nyeri">
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
              <input type="radio" name="aktivitas" value="Mandiri" /> Mandiri
            </div>
            <div class="col-sm-2">
              <input type="radio" name="aktivitas" value="Bantuan total" /> Bantuan total
            </div>
            <div class="col-sm-2">
              <input type="radio" name="aktivitas" value="Bantu sebagian" /> Bantu sebagian
            </div>
            <div class="col-sm-2">
              <input type="radio" name="aktivitas" value="Resiko tinggi" /> Resiko tinggi
            </div>
          </div>

          <div class="row">
            <div class="col-sm-3">
              <label class="control-label">Perlu Restrain :</label>
            </div>
            <div class="col-sm-2">
              <input type="radio" name="restrain" value="YA" /> YA
            </div>
            <div class="col-sm-2">
              <input type="radio" name="restrain" value="TIDAK" /> TIDAK
            </div>
          </div>

        </div>
        <!-- END STATUS NYERI -->
        
</div>
  
    <!-- END PEMERIKSAAN UMUM -->


  <br>
  <!--end add on rihan 12-04-2023-->

  <h3 class="pnl-head-3">ASSESMENT</h3>
  <div class="row pnl pnl-asm">
  	<!--
    <div class="col-md-12">
      <div class="form-group">
        <label class="control-label"><strong>ASSESMENT</strong></label>
        <hr>
      </div>
    </div>
		-->
    <!--
    <div class="col-md-12">
      <div class="form-group">
        <label class="control-label">Diagnosa Medis & Diagnosa Banding :</label>
        <textarea class="form-control input-focus area-scroll" id="txt_banding" name="txt_banding" rows="5"
          placeholder="Diagnosa Medis & Diagnosa Banding"></textarea>
      </div>
    </div>
    -->
    <div class="col-md-12">
      <div class="form-group">
    		<h4>Diagnosa Medis dan Diagnosa Banding</h4>
        <hr>
      </div>
    </div>
    <?php
		for($i=0;$i<=4;$i++){
		$caption = ($i==0) ? "Utama" : ("Sekundari ".($i+0)) ;
		?>
    <div class="col-md-2">
      <div class="form-group">
      	<label class="control-label"><?php echo $caption; ?> :</label>
      </div>
    </div>
    <div class="col-md-8">
      <div class="form-group">
        <div class="ui-widget">
					<input id="name_icd_ten[<?php echo $i; ?>]" name="name_icd_ten[<?php echo $i; ?>]" class="form-control" value="<?php echo $arr_ten_text[$i]; ?>">
				</div>
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
        <input id="id_icd_ten[<?php echo $i; ?>]" name="id_icd_ten[<?php echo $i; ?>]" class="form-control" value="<?php echo $arr_ten[$i]; ?>">
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
				<input id="old_id_icd_ten[<?php echo $i; ?>]" name="old_id_icd_ten[<?php echo $i; ?>]" class="form-control" readonly>
      </div>
    </div>
		<?php
		}
		?>

  <div class="col-md-12" style="margin-top:30px">
    <div class="form-group">
      <h4>PEMERIKSAAN FISIK (GAMBAR)</h4>
      <hr>
    </div>
  </div>

  <div class="col-md-12">
    <div class="form-group">
      	<div id="box_drawing_canvas"></div>
    </div>
  </div>

  </div>

	<h3 class="pnl-head-3" style="margin-top:30px">PLANNING</h3>
  <div class="row pnl pnl-plan">
    <div class="col-md-12">
      <div class="form-group">
    		<h4>RENCANA TINDAKAN</h4>
        <hr>
      </div>
    </div>
    <?php
		for($i=0;$i<=2;$i++){
		$caption = ($i==0) ? "Utama" : ("Sekundari ".($i+0)) ;
		?>
    <div class="col-md-2">
      <div class="form-group">
      	<label class="control-label"><?php echo $caption; ?> :</label>
      </div>
    </div>
    <div class="col-md-8">
      <div class="form-group">
        <div class="ui-widget">
					<input id="name_icd_nine[<?php echo $i; ?>]" name="name_icd_nine[<?php echo $i; ?>]" class="form-control" value="<?php echo $arr_nine_text[$i]; ?>">
				</div>
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
        <input id="id_icd_nine[<?php echo $i; ?>]" name="id_icd_nine[<?php echo $i; ?>]" class="form-control" value="<?php echo $arr_nine[$i]; ?>">
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
				<input id="old_id_icd_nine[<?php echo $i; ?>]" name="old_id_icd_nine[<?php echo $i; ?>]" class="form-control" readonly>
      </div>
    </div>
		<?php
		}
		?>

    <div class="col-md-12" style="margin-top:30px">
      <div class="form-group">
        <h4>INSTRUKSI..</h4>
        <hr>
      </div>
    </div>

    <div class="col-md-12">
      <div class="form-group">
      	<textarea class="form-control input-focus area-scroll" id="p_instruksi" name="p_instruksi" rows="5"
          placeholder="Instruksi"><?php echo $row['p_instruksi']; ?></textarea>
      </div>
    </div>

    <div class="col-md-12" style="margin-top:30px">
      <div class="form-group">
        <h4>RESEP ONLINE</h4>
        <hr>
      </div>
    </div>

    <div class="col-md-12">
    	<!--
      <div class="form-group">
        <label class="control-label"><strong>RESEP ONLINE</strong></label>
      </div>
			-->
      <div class="form-group box_new_eresep" id="box_new_eresep_awal">
        <div class="col-sm-12 text-center">
          <h5>Loading page content, please wait...</h5>
          <!-- <img src="<?php #echo base_url('assets/img/loading-balls.gif'); ?>" alt="Loading Page"> -->
        </div>
      </div>

    </div>

    <div class="col-md-12" style="margin-top:30px" id="anchor_order_lab">
      <div class="form-group">
        <h4>LABORATORIUM</h4>
        <hr>
      </div>
    </div>
    <div class="col-md-12" id="loader_box_lab" style="background-color:white;">
    </div>

    <div class="col-md-12" style="margin-top:30px" id="anchor_order_rad">
      <div class="form-group">
        <h4>RADIOLOGI</h4>
        <hr>
      </div>
    </div>
    <div class="col-md-12" id="loader_box_rad" style="background-color:white;">
    </div>

    <div class="col-md-12" style="margin-top:30px" id="anchor_order_rehab">
      <div class="form-group">
        <h4>REHAB MEDIK</h4>
        <hr>
      </div>
    </div>
    <div class="col-md-12" id="loader_box_rehab" style="background-color:white;">
    </div>

    <div class="col-md-12" style="margin-top:30px" id="anchor_order_op">
      <div class="form-group">
        <h4>OPERASI</h4>
        <hr>
      </div>
    </div>
    <div class="col-md-12" id="loader_box_op" style="background-color:white;">
    </div>

  </div>

  <div class="col-md-12 text-center" style="margin-top:30px;">
    	<button type="submit" class="btn btn-success" style="font-size:22px"> <i class="fa fa-check"></i> S I M P A N </button>
    </div>
	</form>
</div>

<!-- action here -->
<script src="<?php echo base_url('assets/tinymce/js/tinymce/tinymce.min.js'); ?>"></script>
<script>
tinymce.init({
  selector: '#objective',
  //width: 600,
  height: 300,
  toolbar_mode: 'wrap',
  plugins: [
    'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
    'searchreplace', 'wordcount', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media',
    'table', 'emoticons', 'template', 'help'
  ],
  toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify | ' +
    'bullist numlist outdent indent | preview media fullscreen | ' +
    'forecolor backcolor | help',
/*
  menu: {
    favs: { title: 'My Favorites', items: 'code visualaid | searchreplace | emoticons' }
  },
  menubar: 'favs file edit view insert format tools table help',
  */
  menubar: '',

  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
});

</script>
<script>

$(document).ready(function() {

	var alt_target = '_awal';
	$('.box_new_eresep').empty();
	$('#box_new_eresep'+alt_target).empty();
	inner_loader('<?php echo base_url('soap_eresep/add_new/'.$id_reg.'/'.$id_pasien.'/') ?>'+alt_target, '#box_new_eresep'+alt_target, false, '');

});

</script>

<!-- LABORATORIUM -->
<script>
$(document).ready(function() {
	inner_loader('<?php echo base_url('lab/splab/lab_modal_lad/'.$id_reg.'/asm_ri') ?>', '#loader_box_lab', false, '');

	inner_loader('<?php echo base_url('rad/radiologi/rad_modal_lad/'.$id_reg.'/asm_ri') ?>', '#loader_box_rad', false, '');

	inner_loader('<?php echo base_url('fisio/rehabmedik/fisio_modal_lad/'.$id_reg.'/asm_ri') ?>', '#loader_box_rehab', false, '');

	inner_loader('<?php echo base_url('op_order/content_op/'.$id_reg.'/'.$id_pasien) ?>', '#loader_box_op', false, '');
});

</script>

<script>
$(function() {
		// ---- autocomplet buat icd 10 ------
		$("#name_icd_ten\\[0\\]").autocomplete({
			source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_ten'); ?>",
			appendTo : "#modal-body-upl",
			minLength: 2,
			select: function(event, ui) {
				$("#id_icd_ten\\[0\\]").val(ui.item.id);
			}
		});

		$("#name_icd_ten\\[1\\]").autocomplete({
			source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_ten'); ?>",
			appendTo : "#modal-body-upl",
			minLength: 2,
			select: function(event, ui) {
				$("#id_icd_ten\\[1\\]").val(ui.item.id);
			}
		});

		$("#name_icd_ten\\[2\\]").autocomplete({
			source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_ten'); ?>",
			appendTo : "#modal-body-upl",
			minLength: 2,
			select: function(event, ui) {
				$("#id_icd_ten\\[2\\]").val(ui.item.id);
			}
		});

		$("#name_icd_ten\\[3\\]").autocomplete({
			source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_ten'); ?>",
			appendTo : "#modal-body-upl",
			minLength: 2,
			select: function(event, ui) {
				$("#id_icd_ten\\[3\\]").val(ui.item.id);
			}
		});

		$("#name_icd_ten\\[4\\]").autocomplete({
			source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_ten'); ?>",
			appendTo : "#modal-body-upl",
			minLength: 2,
			select: function(event, ui) {
				$("#id_icd_ten\\[4\\]").val(ui.item.id);
			}
		});

		// ---- autocomplet buat icd 9 ------
		$("#name_icd_nine\\[0\\]").autocomplete({
			source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_nine'); ?>",
			appendTo : "#modal-body-upl",
			minLength: 2,
			select: function(event, ui) {
				$("#id_icd_nine\\[0\\]").val(ui.item.id);
			}
		});

				$("#name_icd_nine\\[1\\]").autocomplete({
			source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_nine'); ?>",
			appendTo : "#modal-body-upl",
			minLength: 2,
			select: function(event, ui) {
				$("#id_icd_nine\\[1\\]").val(ui.item.id);
			}
		});

				$("#name_icd_nine\\[2\\]").autocomplete({
			source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_nine'); ?>",
			appendTo : "#modal-body-upl",
			minLength: 2,
			select: function(event, ui) {
				$("#id_icd_nine\\[2\\]").val(ui.item.id);
			}
		});

				$("#name_icd_nine\\[3\\]").autocomplete({
			source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_nine'); ?>",
			appendTo : "#modal-body-upl",
			minLength: 2,
			select: function(event, ui) {
				$("#id_icd_nine\\[3\\]").val(ui.item.id);
			}
		});

				$("#name_icd_nine\\[4\\]").autocomplete({
			source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_nine'); ?>",
			appendTo : "#modal-body-upl",
			minLength: 2,
			select: function(event, ui) {
				$("#id_icd_nine\\[4\\]").val(ui.item.id);
			}
		});

				$("#name_icd_nine\\[5\\]").autocomplete({
			source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_nine'); ?>",
			appendTo : "#modal-body-upl",
			minLength: 2,
			select: function(event, ui) {
				$("#id_icd_nine\\[5\\]").val(ui.item.id);
			}
		});

				$("#name_icd_nine\\[6\\]").autocomplete({
			source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_nine'); ?>",
			appendTo : "#modal-body-upl",
			minLength: 2,
			select: function(event, ui) {
				$("#id_icd_nine\\[6\\]").val(ui.item.id);
			}
		});

				$("#name_icd_nine\\[7\\]").autocomplete({
			source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_nine'); ?>",
			appendTo : "#modal-body-upl",
			minLength: 2,
			select: function(event, ui) {
				$("#id_icd_nine\\[7\\]").val(ui.item.id);
			}
		});

				$("#name_icd_nine\\[8\\]").autocomplete({
			source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_nine'); ?>",
			appendTo : "#modal-body-upl",
			minLength: 2,
			select: function(event, ui) {
				$("#id_icd_nine\\[8\\]").val(ui.item.id);
			}
		});

				$("#name_icd_nine\\[9\\]").autocomplete({
			source: "<?php echo base_url('rekam_medis/inner_get_data_autocomplet_icd_nine'); ?>",
			appendTo : "#modal-body-upl",
			minLength: 2,
			select: function(event, ui) {
				$("#id_icd_nine\\[9\\]").val(ui.item.id);
			}
		});

});
</script>
<script>
$(document).ready(function() {
	inner_loader('<?php echo base_url('drawing/canvas_drawing/'.$id_reg.'/'.$id_pasien.'/ri'); ?>', '#box_drawing_canvas', true,'');
});
</script>
<script>
// Date picker only
$('.tanggal').datepicker({
  dateFormat: "yy-mm-dd HH:mm:ss",
  autoclose: true,
  language: 'id',
});

$(".tanggal").datepicker("setDate", new Date());
</script>
<script>
	$('#frm_asm_ri_dokter').submit(function(event) {
		event.preventDefault(); //prevent default action

		var post_url = $(this).attr("action"); //get form action url
		var form_data = $(this).serialize(); //Encode form elements for submission

		$.post(post_url, form_data, function(response) {
			alert('Response :' + response);
			inner_loader('<?php echo base_url('erm_ranap/asm_ranap/'.$id_reg) ?>', '#box_asm_awal_ranap', false, '');
			location.reload();
       // window.location.href = "http://192.168.30.2/smartplus/erm_ranap/asm_ranap/1120SA16210"

		});
	});
</script>
<script>
$('#frm_asm_ri_dokter').find(':radio[name=asal_masuk][value="<?php echo $row['asal_masuk']; ?>"]').prop('checked', true).val();

$('#frm_asm_ri_dokter').find(':radio[name=cara_masuk][value="<?php echo $row['cara_masuk']; ?>"]').prop('checked', true).val();


</script>
