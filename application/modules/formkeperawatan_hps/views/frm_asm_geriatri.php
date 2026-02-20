<style type="text/css">
  .input-append .btn.dropdown-toggle {
    float: none;
}
.pnl-head-1, .pnl-head-2, .pnl-head-3{
	text-align:center;
	font-weight:bold;
}
.table-cppt{
    border-style: solid;
    border-color: black;
    }

    .pnl{
    background-color:#f8f8f8;
    }
.num-center{
	text-align: center;
	padding-right: 10px;
}
  </style>


<div class="container-fluid form_asm_awal_geriatri">
  <form action="#" id="form_asm_awal_geriatri">
    <div class="form-body">
      <!-- Hidden fields -->
      <input type="hidden" class="form-control input-default" id="id_asmri" name="id_asmri">
      <input type="hidden" class="form-control input-default" id="asmri_date" name="asmri_date">

      <input type="hidden" class="form-control input-default" id="id_pasien" name="id_pasien">
      <input type="hidden" class="form-control input-default" id="id_reg" name="id_reg">
      <input type="hidden" class="form-control input-default" id="id_dokter" name="id_dokter">
      <input type="hidden" class="form-control input-default" id="id_type" name="id_type" value="2">
      <input type="hidden" class="form-control input-default" id="kategori" name="kategori">
      <input type="hidden" class="form-control input-default" id="created" name="created">
      <input type="hidden" class="form-control input-default" id="creator" name="creator">
      <input type="hidden" class="form-control input-default" id="updated" name="updated">
      <input type="hidden" class="form-control input-default" id="updator" name="updator">
      <!-- Hidden fields -->

      <div class="row">
        <div class="col-md-6">
          <div class="row">
            <div class="col-sm-3">
              <label class="control-label">Tanggal Masuk :</label>
            </div>
            <div class="col-sm-9">
              <label class="control-label">xxxxxxxxxxxxxxx</label>
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
              <input type="text" name="tgl_pengkajian" id="tgl_pengkajian" class="form-control tanggal" value="">
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
              name="riwayat_sakit" rows="5" placeholder="Riwayat Penyakit Sekarang"><?php echo nl2br($riwayat_pasien['penyakit_sekarang']); ?></textarea>
          </div>

          <div class="form-group">
            <label class="control-label">Riwayat Penyakit Dahulu :</label>
            <textarea class="form-control input-focus area-scroll" id="riwayat_sakit_dulu"
              name="riwayat_sakit_dulu" rows="5" placeholder="Riwayat Penyakit Dahulu"><?php echo nl2br($riwayat_pasien['penyakit_dahulu']); ?></textarea>
            <hr>
          </div>
        </div>
        <!--/span-->
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label">Riwayat Pengobatan/Operasi/Obstetri :</label>
            <textarea class="form-control input-focus area-scroll" id="riwayat_pengobatan"
              name="riwayat_pengobatan" rows="5" placeholder="Riwayat Pengobatan/Operasi/Obstetri"><?php echo nl2br($riwayat_pasien['pengobatan']); ?></textarea>
          </div>

          <div class="form-group">
            <label class="control-label">Riwayat Penyakit Keluarga :</label>
            <textarea class="form-control input-focus area-scroll" id="riwayat_sakit_keluarga"
              name="riwayat_sakit_keluarga" rows="5" placeholder="Riwayat Penyakit Keluarga"><?php echo nl2br($riwayat_pasien['penyakit_keluarga']); ?></textarea>

          </div>

          <div class="form-group">
            <label class="control-label">Riwayat Alergi :</label>
            <textarea class="form-control input-focus area-scroll" id="riwayat_alergi" name="riwayat_alergi"
              rows="5" placeholder="Riwayat Alergi"><?php echo nl2br($riwayat_pasien['alergi']); ?></textarea>
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
                <input type="checkbox" name="status_psikologi[]" value="Marah"> Marah
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="status_psikologi[]" value="Cemas"> Cemas
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="status_psikologi[]" value="Depresi"> Depresi
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="status_psikologi[]" value="Gelisah"> Gelisah
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="status_psikologi[]" value="Takut"> Takut
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="status_psikologi[]" value="Kecenderungan Bunuh Diri"> Kecenderungan Bunuh Diri
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="status_psikologi[]" value="Tidak Ada Masalah"> Tidak Ada Masalah
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="status_psikologi[]" value="Suka Berkelahi"> Suka Berkelahi
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="status_psikologi[]" value="Suka Berkelahi"> Membahayakan diri sendiri atau orang lain
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="status_psikologi[]" value="Lain-Lain"> Lain-Lain
                <div class="input-group-addon"> </div>
              </div>
            </div>

          </div>
        </div>

        <div class="col-md-12">
          <label class="control-label"><strong>STATUS SOSIAL EKONOMI</strong></label>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label">Status Pernikahan  :</label>
              </div>
            </div>

            <div class="col-md-9">
              <div class="form-group">
                <input list="sse_nikah" name="sse_nikah" value="" class="col-sm-6 custom-select custom-select-sm">
                <datalist id="sse_nikah">
                  <option value="Single">Single</option>
                  <option value="Menikah">Menikah</option>
                  <option value="Bercerai">Bercerai</option>
                  <option value="Janda/duda">Janda/duda</option>
                  <option value="....">....</option>
                </datalist>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label">Pendidikan Terakhir :</label>
              </div>
            </div>

            <div class="col-md-9">
              <div class="form-group">
                <input list="sse_study" name="sse_study" value="" class="col-sm-6 custom-select custom-select-sm">
                <datalist id="sse_study">
                  <option value="SD">SD</option>
                  <option value="SMP">SMP</option>
                  <option value="SMA">SMA</option>
                  <option value="Akademi">Akademi</option>
                  <option value="Sarjana">Sarjana</option>
                </datalist>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label">Pekerjaan :</label>
              </div>
            </div>

            <div class="col-md-9">
              <div class="form-group">
                <input list="sse_job" name="sse_job" value="" class="col-sm-6 custom-select custom-select-sm">
                <datalist id="sse_job">
                  <option value="PNS">PNS</option>
                  <option value="Swasta">Swasta</option>
                  <option value="TNI/POLRI">TNI/POLRI</option>
                  <option value="Tidak bekerja">Tidak bekerja</option>
                </datalist>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label">Tinggal Bersama :</label>
              </div>
            </div>

            <div class="col-md-9">
              <div class="form-group">
                <input list="sse_live" name="sse_live" value="" class="col-sm-6 custom-select custom-select-sm">
                <datalist id="sse_live">
                  <option value="Suami/istri">Suami/istri</option>
                  <option value="Anak">Anak</option>
                  <option value="Orang tua">Orang tua</option>
                  <option value="Sendiri">Sendiri</option>
                </datalist>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label">Agama :</label>
              </div>
            </div>

            <div class="col-md-9">
              <div class="form-group">
                <input list="sse_agama" name="sse_agama" value="" class="col-sm-6 custom-select custom-select-sm">
                <datalist id="sse_agama">
                  <option value="Islam">Islam</option>
                  <option value="Kristen">Kristen</option>
                  <option value="Katolik">Katolik</option>
                  <option value="Katolik">Hindu</option>
                  <option value="Katolik">Budha</option>
                </datalist>
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
                <input list="ibadah" name="ibadah" value="" class="col-sm-6 custom-select custom-select-sm">
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
                <input list="thaharoh" name="thaharoh" value="" class="col-sm-6 custom-select custom-select-sm">
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
                <input list="sholat" name="sholat" value="" class="col-sm-6 custom-select custom-select-sm">
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
                <label class="control-label">Reflek Cahaya</label>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <input type="text" class="form-control input-sm" id="reaksi_cahaya" name="reaksi_cahaya" placeholder="Reflek Cahaya">
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
                <label class="control-label">TENGGOROKAN:</label>
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
                <label class="control-label">INTEGUMEN:</label>
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
                <label class="control-label">EKSTREMITAS:</label>
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
                <label class="control-label">GENETALIA:</label>
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
                <label class="control-label">ELIMINIASI:</label>
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



          <div class="col-md-12">
          <div class="form-group">
            <label class="control-label"><strong>STATUS KRITERIA RISIKO NUTRISIONAL/Gizi (MINI NUTRITIONAL ASSESMENT (MNA) ) <br><small>bila skor 0-11dan / pasien dengan diagnosa / kondisi khusus dilakukan asesmen lanjut oleh Dietisien / Ahli Gizi</small></strong></label>
          </div>
        </div>
      
        <div class="col-md-12">
          <div class="row">
            <div class="col-sm-5">
              <label class="control-label">Apakah asupan makanan berkurang selama 3 bulan terakhir karena kehilangan nafsu makan, gangguan pencernaan, kesulitan mengunyah atau menelan?</label>
            </div>
            <div class="col-sm-2">
              <input type="radio" name="mna_1[]" value="0" onClick="this.form.total_skor2.value=checkTotal2(this);"/> Sangat berkurang (skor O)
            </div>
            <div class="col-sm-2">
              <input type="radio" name="mna_1[]" value="1" onClick="this.form.total_skor2.value=checkTotal2(this);"/> Agak berkurang (skor1)
            </div>
            <div class="col-sm-2">
              <input type="radio" name="mna_1[]" value="2" onClick="this.form.total_skor2.value=checkTotal2(this);"/> Agak berkurang (skor2)
            </div>
          </div>

          <div class="row">
            <div class="col-sm-3">
              <label class="control-label">Apakah terdapat penurunan berat badan selama 3 bulan terakhir : </label>
            </div>
            <div class="col-sm-2">
              <input type="radio" name="mna_2[]" value="0" onClick="this.form.total_skor2.value=checkTotal2(this);"/> Turun >3 kg (skor O)
            </div>
            <div class="col-sm-2">
              <input type="radio" name="mna_2[]" value="1" onClick="this.form.total_skor2.value=checkTotal2(this);"/> Tidak Tahu (skor1)
            </div>
            <div class="col-sm-2">
              <input type="radio" name="mna_2[]" value="2" onClick="this.form.total_skor2.value=checkTotal2(this);"/> Turun 1-3 kg (skor2)
            </div>
            <div class="col-sm-2">
              <input type="radio" name="mna_2[]" value="3" onClick="this.form.total_skor2.value=checkTotal2(this);"/> Tidak ada penurunan (skor 3)
            </div>
          </div>

          <div class="row">
            <div class="col-sm-3">
              <label class="control-label">Mobilitas :</label>
            </div>
            <div class="col-sm-2">
              <input type="radio" name="mna_3[]" value="0" onClick="this.form.total_skor2.value=checkTotal2(this);"/> Bed rest di tempat tidur/kursi (skor 0)
            </div>
            <div class="col-sm-2">
              <input type="radio" name="mna_3[]" value="1" onClick="this.form.total_skor2.value=checkTotal2(this);"/> Aktivitas normal dengan kesulitan (skor 1)
            </div>
            <div class="col-sm-2">
              <input type="radio" name="mna_3[]" value="2" onClick="this.form.total_skor2.value=checkTotal2(this);"/> Aktivitas normal dengan kesulitan (skor 2)
            </div>
          </div>

          <div class="row">
            <div class="col-sm-3">
              <label class="control-label">Menderita tekanan psikologis atau penyakit yang berat dalam 3 bulan terakhir? </label>
            </div>
            <div class="col-sm-2">
              <input type="radio" name="mna_4[]" value="0" onClick="this.form.total_skor2.value=checkTotal2(this);"/> Ya (Skor 0)
            </div>
            <div class="col-sm-2">
              <input type="radio" name="mna_4[]" value="1" onClick="this.form.total_skor2.value=checkTotal2(this);"/> Tidak (skor 1)
            </div>
          </div>

          <div class="row">
            <div class="col-sm-3">
              <label class="control-label">Gangguan neuropsikologis : </label>
            </div>
            <div class="col-sm-2">
              <input type="radio" name="mna_5[]" value="0" onClick="this.form.total_skor2.value=checkTotal2(this);"/> Depresi (Skor 0)
            </div>
            <div class="col-sm-2">
              <input type="radio" name="mna_5[]" value="1" onClick="this.form.total_skor2.value=checkTotal2(this);"/> Kepikiran ringan (skor 1)
            </div>
            <div class="col-sm-2">
              <input type="radio" name="mna_5[]" value="2" onClick="this.form.total_skor2.value=checkTotal2(this);"/> Tidak ada gangguan (skor 2)
            </div>
          </div>

          <div class="row">
            <div class="col-sm-3">
              <label class="control-label">Indeks Massa Tubuh (IMT) (berat badan dalam kg)/(tinggi badan dalam m) : </label>
            </div>
            <div class="col-sm-2">
              <input type="radio" name="mna_6[]" value="0" onClick="this.form.total_skor2.value=checkTotal2(this);"/> IMT < 19 (Skor 0)
            </div>
            <div class="col-sm-2">
              <input type="radio" name="mna_6[]" value="1" onClick="this.form.total_skor2.value=checkTotal2(this);"/> IMT 19 - < 21 (skor 1)
            </div>
            <div class="col-sm-2">
              <input type="radio" name="mna_6[]" value="2" onClick="this.form.total_skor2.value=checkTotal2(this);"/> IMT 21- < 23 (skor 2)
            </div>
            <div class="col-sm-2">
              <input type="radio" name="mna_6[]" value="3" onClick="this.form.total_skor2.value=checkTotal2(this);"/> IMT ≥ 23 (skor 3)
            </div>
          </div>

          <div class="row">
            <div class="col-sm-3">
              <label class="control-label">Total Skor :</label>
            </div>
            <div class="col-sm-2">
              <input type="text" class="form-control input-default" id="total_skor2" name="total_skor2" readonly> 
              <input type=hidden name=hiddentotal2 value=0>
            </div>
            <div class="row"><div class="col-sm-5">&nbsp;</div></div>
          </div>

          <div class="row">
            <div class="col-sm-3">
              <label class="control-label">Sudah dibaca dan diketahui oleh Ahli Gizi pada tanggal & pukul :</label>
            </div>
            <div class="col-sm-2">
              <input type="text" name="sudah_dibaca"  id="sudah_dibaca" />
            </div>
          </div>

          <div class="row">

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keluhan_saat_ini[]" value="Mual"> Mual
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keluhan_saat_ini[]" value="Muntah"> Muntah
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keluhan_saat_ini[]" value="Sulit menelan"> Sulit menelan
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keluhan_saat_ini[]" value="Tidak ada masalah"> Tidak ada masalah
              </div>
            </div>
          </div>


        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label"><strong>STATUS FUNGSIONAL</strong></label>
          </div>
        </div>

        <div class="col-md-5">
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
                <td align="center">5</td>
                <td align="center">10</td>
                <td><input type="number" class="form-control input-default num-center" id="sf_makan" name="sf_makan" onChange="javascript: hitung_total_fungsional();"></td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Transfer/ perpindahan tubuh</td>
                <td align="center">5-10</td>
                <td align="center">15</td>
                <td><input type="number" class="form-control input-default num-center" id="sf_transfer" name="sf_transfer" onChange="javascript: hitung_total_fungsional();"></td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Perawatan Diri/kebersihan (Grooming)</td>
                <td align="center">0</td>
                <td align="center">5</td>
                <td><input type="number" class="form-control input-default num-center" id="sf_grooming" name="sf_grooming" onChange="javascript: hitung_total_fungsional();"></td>
              </tr>
              <tr>
                <th scope="row">4</th>
                <td>Masuk dan keluar ke toilet</td>
                <td align="center">5</td>
                <td align="center">10</td>
                <td><input type="number" class="form-control input-default num-center" id="sf_toilet" name="sf_toilet" onChange="javascript: hitung_total_fungsional();"></td>
              </tr>
              <tr>
                <th scope="row">5</th>
                <td>Mandi sendiri</td>
                <td align="center">0</td>
                <td align="center">5</td>
                <td><input type="number" class="form-control input-default num-center" id="sf_mandi" name="sf_mandi" onChange="javascript: hitung_total_fungsional();"></td>
              </tr>
              <tr>
                <th scope="row">6</th>
                <td>Berjalan di permukaan datar (atau dengan kursi roda)</td>
                <td align="center">0</td>
                <td align="center">5</td>
                <td><input type="number" class="form-control input-default num-center" id="sf_jalan" name="sf_jalan" onChange="javascript: hitung_total_fungsional();"></td>
              </tr>
              <tr>
                <th scope="row">7</th>
                <td>Naik Turun Tangga</td>
                <td align="center">5</td>
                <td align="center">10</td>
                <td><input type="number" class="form-control input-default num-center" id="sf_tangga" name="sf_tangga" onChange="javascript: hitung_total_fungsional();"></td>
              </tr>
              <tr>
                <th scope="row">8</th>
                <td>Memakai baju/berpakaian</td>
                <td align="center">5</td>
                <td align="center">10</td>
                <td><input type="number" class="form-control input-default num-center" id="sf_berpakaian" name="sf_berpakaian" onChange="javascript: hitung_total_fungsional();"></td>
              </tr>
              <tr>
                <th scope="row">9</th>
                <td>Mengontrol Buang Air Besar (Bowel)</td>
                <td align="center">5</td>
                <td align="center">10</td>
                <td><input type="number" class="form-control input-default num-center" id="sf_bowel" name="sf_bowel" onChange="javascript: hitung_total_fungsional();"></td>
              </tr>
              <tr>
                <th scope="row">10</th>
                <td>Mengontrol Buang Air Kecil (Bladder)</td>
                <td align="center">5</td>
                <td align="center">10</td>
                <td><input type="number" class="form-control input-default num-center" id="sf_bladder" name="sf_bladder" onChange="javascript: hitung_total_fungsional();"></td>
              </tr>
              <tr>
                <th scope="row">&nbsp;</th>
                <td colspan="3" align="right"><strong>TOTAL</strong>&nbsp;&nbsp;&nbsp;</td>
                <td><input type="number" class="form-control input-default num-center" id="sf_total" name="sf_total" readonly></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="col-md-7">
          Catatan : diberikan nilai 0 bila pasien tidak dapat melakukan kriteria yang telah ditentukan <br><br>

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
                  <label class="control-label">Risiko Jatuh Sidney Scoring Ontario</label>
                </div>
                <div class="col-sm-3">
                  <input type="radio" name="resiko_jatuh_gr" value="Tidak ada Resiko 0-5" /> Tidak ada Resiko 0-5
                </div>
                <div class="col-sm-3">
                  <input type="radio" name="resiko_jatuh_gr" value="Risiko Rendah 6-16" /> Risiko Rendah 6-16
                </div>
                <div class="col-sm-3">
                  <input type="radio" name="resiko_jatuh_gr" value="Risiko Tinggi 17-30" /> Risiko Tinggi 17-30
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
            <label class="control-label">MASALAH KESEHATAN :</label>
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
            <label class="control-label"><strong>DIAGNOSA MEDIS DAN DIAGNOSA BANDING</strong></label>
            <textarea class="form-control input-focus area-scroll" id="diagnosa_medis" name="diagnosa_medis"
              rows="5" placeholder="DIAGNOSA MEDIS DAN DIAGNOSA BANDING"></textarea>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label"><strong>RENCANA (TINDAKAN MEDIS/ KEPERAWATAN)</strong></label>
            <textarea class="form-control input-focus area-scroll" id="rencana_medis" name="rencana_medis"
              rows="5" placeholder="RENCANA (TINDAKAN MEDIS/ KEPERAWATAN)"></textarea>
          </div>
        </div>
		
		<div class="col-md-12">
          <div class="form-group">
            <label class="control-label"><strong>SKRINING IDENTIFIKASI PASIEN RESIKO TINGGI :</strong></label>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
					<label>
					  <input type="radio" name="skr_id_risiko_tinggi" value="Pasien Risiko Tinggi"> Pasien Risiko Tinggi
					  <textarea class="form-control input-focus area-scroll" id="skr_id_text_pasien_rt" name="skr_id_text_pasien_rt" rows="4"></textarea>
					</label>
                </div>
			  </div>
			  <div class="col-md-3">
				<div class="form-group">
					<label>
					  <input type="radio" name="skr_id_risiko_tinggi" value="Pelayanan Risiko Tinggi"> Pelayanan Risiko Tinggi
					  <textarea class="form-control input-focus area-scroll" id="skr_id_text_pelayanan_rt" name="skr_id_text_pelayanan_rt" rows="4"></textarea>
					</label>
				</div>
			  </div>
			  <div class="col-md-3">
				<div class="form-group">
					<label>
					  <input type="radio" name="skr_id_risiko_tinggi" value="Risiko Tinggi Tambahan"> Risiko Tinggi Tambahan
					  <textarea class="form-control input-focus area-scroll" id="skr_id_text_tambahan_rt" name="skr_id_text_tambahan_rt" rows="4"></textarea>
					</label>
				</div>
			  </div>
			  <div class="col-md-3">
				<div class="form-group">
					<label>
					  <input type="radio" name="skr_id_risiko_tinggi" value="Bukan Pasien Risiko Tinggi"> Bukan Pasien Risiko Tinggi
					  <textarea class="form-control input-focus area-scroll" id="skr_id_text_bukan_rt" name="skr_id_text_bukan_rt" rows="4"></textarea>
					</label>
				</div>
              </div>
			</div>
		  </div>
		</div>
	
		
        <div class="col-md-12">
          <div class="form-group">
            <label class="control-label"><strong>KATEGORI /KRITERIA PASIEN MASUK ICU :</strong></label>
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                <input type="checkbox" name="prior[]" id="prior[]" value="1"> Prioritas I
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                <input type="checkbox" name="prior[]" id="prior[]" value="2"> Prioritas II
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                <input type="checkbox" name="prior[]" id="prior[]" value="3"> Prioritas III
                </div>
              </div>
            </div>
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
            <button type="button" class="btn btn-success" onclick="javascript: save_asm_awal('<?php echo $id_reg; ?>'+'/'+'ASM');">
              <i class="fa fa-check"></i> Save</button>
            <button type="button" class="btn btn-inverse" data-dismiss="modal">Cancel</button>
          </div>
        </div>

    </div>
  </form>
</div>

<!-- action here -->
<script>
var save_method;
function save_asm_awal(id_reg,kategori) {
  var url;
  id = '<?php echo $id_asmri ?>';
  if (id === '') {
    save_method = 'add';
  }else {
    $(document).ready(function() {
    	save_method = 'update';
    });
  }

  if (save_method == 'update') {
    url = '<?php echo site_url('formkeperawatan/frm_geriatri/asm_geriatri_edit_act');?>/'+id_reg;
    title = 'Data ASM Berhasil Diupdate';
  } else {
    url = '<?php echo site_url('formkeperawatan/frm_geriatri/asm_geriatri_add');?>/'+id_reg+'/'+kategori ;
    title = 'Data ASM Berhasil Disimpan';
  }

  var data_submit = $('#form_asm_awal_geriatri').serialize();
  $.ajax({
    type: 'POST',
    data: data_submit,
    dataType: 'JSON',
    url: url,
    success: function(data) {
      //console.log(data_submit);
      //console.log(data);
      Swal.fire({
        type: 'success',
        title: title,
        showConfirmButton: false,
        timer: 1000
      });

      window.setTimeout(function() {
        location.reload();
      }, 1000);
    },
      error: function(xhr, ajaxOptions, thrownError) {
      show_my_error_message2(xhr.responseText,xhr.status,xhr.statusText);
      }
  });

}

var id_asmri;
id_asmri = '<?php echo $id_asmri ?>';
if (id_asmri === '') {

}else {
  $(document).ready(function() {
  	update_asm(id_asmri);
  });
}



function checkTotal2(whichbox) {
  with(whichbox.form) {
    if (whichbox.checked == false)
      hiddentotal2.value = eval(hiddentotal2.value) - eval(whichbox.value);
    else
      hiddentotal2.value = eval(hiddentotal2.value) + eval(whichbox.value);
    return (hiddentotal2.value);
  }
}

function update_asm(id_asmri) {
  save_method = 'update';
  $('#form_asm_awal_geriatri')[0].reset();

  $.ajax({
    url: '<?php echo site_url('formkeperawatan/frm_geriatri/asm_geriatri_edit/');?>'+id_asmri,
    type: 'GET',
    dataType: 'JSON',
    success: function(data) {
      $('[name="id_asmri"]').val(data.id_asmri);
      $('[name="asmri_date"]').val(data.asmri_date);
      $('[name="regdate"]').val(data.regdate);
      $('[name="tgl_pengkajian"]').val(data.tgl_pengkajian);
      $('[name="id_reg"]').val(data.id_reg);
      $('[name="id_pasien"]').val(data.id_pasien);
      $('[name="nama_pasien"]').val(data.nama_pasien);
      $('[name="id_dokter"]').val(data.id_dokter);
      $('[name="id_type"]').val(data.id_type);
      $('[name="jenis_asm"]').val(data.jenis_asm);
      $('[name="kategori"]').val(data.kategori);

      var asal_masuk = data.asal_masuk;
      if (asal_masuk == 'IGD') {
        $('#form_asm_awal_geriatri').find(':radio[name=asal_masuk][value="IGD"]').prop('checked', true).val();
      } else if (asal_masuk == 'RAWAT JALAN') {
        $('#form_asm_awal_geriatri').find(':radio[name=asal_masuk][value="RAWAT JALAN"]').prop('checked', true).val();
      }

      var cara_masuk = data.cara_masuk;
      if (cara_masuk == 'JALAN') {
        $('#form_asm_awal_geriatri').find(':radio[name=cara_masuk][value="JALAN"]').prop('checked', true).val();
      } else if (cara_masuk == 'KURSI RODA') {
        $('#form_asm_awal_geriatri').find(':radio[name=cara_masuk][value="KURSI RODA"]').prop('checked', true).val();
      } else if (cara_masuk == 'BRANKAR') {
        $('#form_asm_awal_geriatri').find(':radio[name=cara_masuk][value="BRANKAR"]').prop('checked', true).val();
      }

      // SUBJECTIVE START
      $('[name="keluhan_utama"]').val(data.keluhan_utama);
      $('[name="riwayat_sakit"]').val(data.riwayat_sakit);
      $('[name="riwayat_sakit_dulu"]').val(data.riwayat_sakit_dulu);
      $('[name="riwayat_pengobatan"]').val(data.riwayat_pengobatan);
      $('[name="riwayat_sakit_keluarga"]').val(data.riwayat_sakit_keluarga);
      $('[name="riwayat_alergi"]').val(data.riwayat_alergi);
      // SUBJECTIVE END

      $('[name="objective"]').val(data.objective);

      var status_psikologi = data.status_psikologi;
      if (status_psikologi.length > 0) {
        var status_psikologi = data.status_psikologi.split(";"),
          $inputs = $('input[name^=status_psikologi]');
        for (var j = 0; j < status_psikologi.length; j++) {
          $inputs.filter("[value='" + status_psikologi[j] + "']").attr('checked', 'checked');
        }
      }

      $('[name="sse_nikah"]').val(data.sse_nikah);
      $('[name="sse_study"]').val(data.sse_study);
      $('[name="sse_job"]').val(data.sse_job);
      $('[name="sse_live"]').val(data.sse_live);
      $('[name="sse_agama"]').val(data.sse_agama);

      $('[name="status_kultural"]').val(data.status_kultural);
      $('[name="ibadah"]').val(data.ibadah);
      $('[name="thaharoh"]').val(data.thaharoh);
      $('[name="sholat"]').val(data.sholat);

      var bim_spiritual_muslim = data.bim_spiritual_muslim;
      if (bim_spiritual_muslim.length > 0) {
        var bim_spiritual_muslim = data.bim_spiritual_muslim.split(";"),
          $inputs = $('input[name^=bim_spiritual_muslim]');
        for (var j = 0; j < bim_spiritual_muslim.length; j++) {
          $inputs.filter("[value='" + bim_spiritual_muslim[j] + "']").attr('checked', 'checked');
        }
      }

      var bim_spiritual_nonmuslim = data.bim_spiritual_nonmuslim;
      if (bim_spiritual_nonmuslim.length > 0) {
        var bim_spiritual_nonmuslim = data.bim_spiritual_nonmuslim.split(";"),
          $inputs = $('input[name^=bim_spiritual_nonmuslim]');
        for (var j = 0; j < bim_spiritual_nonmuslim.length; j++) {
          $inputs.filter("[value='" + bim_spiritual_nonmuslim[j] + "']").attr('checked', 'checked');
        }
      }

      $('[name="kesadaran"]').val(data.kesadaran);
      $('[name="keadaan_umum"]').val(data.keadaan_umum);
      $('[name="td"]').val(data.td);
      $('[name="gcs"]').val(data.gcs);
      $('[name="nadi"]').val(data.nadi);
      $('[name="suhu"]').val(data.suhu);
      $('[name="nafas"]').val(data.nafas);
      $('[name="reaksi_cahaya"]').val(data.reaksi_cahaya);
      $('[name="tinggi"]').val(data.tinggi);
      $('[name="berat"]').val(data.berat);

      $('[name="fisik_khusus"]').val(data.fisik_khusus);

      $('[name="pu_kepala"]').val(data.pu_kepala);
      $('[name="pu_rambut"]').val(data.pu_rambut);
      $('[name="pu_wajah"]').val(data.pu_wajah);
      $('[name="pu_mata"]').val(data.pu_mata);
      $('[name="pu_gigi"]').val(data.pu_gigi);
      $('[name="pu_tenggorokan"]').val(data.pu_tenggorokan);
      $('[name="pu_lidah"]').val(data.pu_lidah);
      $('[name="pu_leher"]').val(data.pu_leher);
      $('[name="pu_abdomen"]').val(data.pu_abdomen);
      $('[name="pu_dada"]').val(data.pu_dada);
      $('[name="pu_respirasi"]').val(data.pu_respirasi);
      $('[name="pu_jantung"]').val(data.pu_jantung);
      $('[name="pu_integumen"]').val(data.pu_integumen);
      $('[name="pu_ekstremitas"]').val(data.pu_ekstremitas);
      $('[name="pu_genetalia"]').val(data.pu_genetalia);
      $('[name="pu_elimitas"]').val(data.pu_elimitas);

      $(':radio[name=kualitas_nyeri][value="'+data.kualitas_nyeri+'"]').prop('checked', true).val();
      $('[name="frekuensi_nyeri"]').val(data.frekuensi_nyeri);
      $(':radio[name=waktu_nyeri][value="'+data.waktu_nyeri+'"]').prop('checked', true).val();
      $(':radio[name=intesnsitas_nyeri][value="'+data.intesnsitas_nyeri+'"]').prop('checked', true).val();
      $(':radio[name=nyeri][value="'+data.nyeri+'"]').prop('checked', true).val();
      $('[name="pengaruh_nyeri"]').val(data.pengaruh_nyeri);
      $(':radio[name=aktivitas][value="'+data.aktivitas+'"]').prop('checked', true).val();
      $(':radio[name=restrain][value="'+data.restrain+'"]').prop('checked', true).val();

      var mna_1 = data.mna_1;
      if (mna_1.length > 0) {
        var mna_1 = data.mna_1.split(";"),
          $inputs = $('input[name^=mna_1]');
        for (var j = 0; j < mna_1.length; j++) {
          $inputs.filter("[value='" + mna_1[j] + "']").attr('checked', 'checked');
        }
      }

      var mna_2 = data.mna_2;
      if (mna_2.length > 0) {
        var mna_2 = data.mna_2.split(";"),
          $inputs = $('input[name^=mna_2]');
        for (var j = 0; j < mna_2.length; j++) {
          $inputs.filter("[value='" + mna_2[j] + "']").attr('checked', 'checked');
        }
      }

      var mna_3 = data.mna_3;
      if (mna_3.length > 0) {
        var mna_3 = data.mna_3.split(";"),
          $inputs = $('input[name^=mna_3]');
        for (var j = 0; j < mna_3.length; j++) {
          $inputs.filter("[value='" + mna_3[j] + "']").attr('checked', 'checked');
        }
      }

      var mna_4 = data.mna_4;
      if (mna_4.length > 0) {
        var mna_4 = data.mna_4.split(";"),
          $inputs = $('input[name^=mna_4]');
        for (var j = 0; j < mna_4.length; j++) {
          $inputs.filter("[value='" + mna_4[j] + "']").attr('checked', 'checked');
        }
      }

      var mna_5 = data.mna_5;
      if (mna_5.length > 0) {
        var mna_5 = data.mna_5.split(";"),
          $inputs = $('input[name^=mna_5]');
        for (var j = 0; j < mna_5.length; j++) {
          $inputs.filter("[value='" + mna_5[j] + "']").attr('checked', 'checked');
        }
      }

      var mna_6 = data.mna_6;
      if (mna_6.length > 0) {
        var mna_6 = data.mna_6.split(";"),
          $inputs = $('input[name^=mna_6]');
        for (var j = 0; j < mna_6.length; j++) {
          $inputs.filter("[value='" + mna_6[j] + "']").attr('checked', 'checked');
        }
      }
      
      
      $('[name="total_skor2"]').val(data.total_skor2);
      $('[name="sudah_dibaca"]').val(data.sudah_dibaca);

      $('[name="diagnosa_medis"]').val(data.diagnosa_medis);
      $('[name="rencana_medis"]').val(data.rencana_medis);  

	  $(':radio[name=skr_id_risiko_tinggi][value="'+data.skr_id_risiko_tinggi+'"]').prop('checked', true).val();
	  $('[name="skr_id_text_pasien_rt"]').val(data.skr_id_text_pasien_rt);
	  $('[name="skr_id_text_pelayanan_rt"]').val(data.skr_id_text_pelayanan_rt);
	  $('[name="skr_id_text_tambahan_rt"]').val(data.skr_id_text_tambahan_rt);
	  $('[name="skr_id_text_bukan_rt"]').val(data.skr_id_text_bukan_rt);


      var keluhan_saat_ini = data.keluhan_saat_ini;
      if (keluhan_saat_ini.length > 0) {
        var keluhan_saat_ini = data.keluhan_saat_ini.split(";"),
          $inputs = $('input[name^=keluhan_saat_ini]');
        for (var j = 0; j < keluhan_saat_ini.length; j++) {
          $inputs.filter("[value='" + keluhan_saat_ini[j] + "']").attr('checked', 'checked');
        }
      }

      $('[name="sf_makan"]').val(data.sf_makan);
      $('[name="sf_transfer"]').val(data.sf_transfer);
      $('[name="sf_grooming"]').val(data.sf_grooming);
      $('[name="sf_toilet"]').val(data.sf_toilet);
      $('[name="sf_mandi"]').val(data.sf_mandi);
      $('[name="sf_jalan"]').val(data.sf_jalan);
      $('[name="sf_tangga"]').val(data.sf_tangga);
      $('[name="sf_berpakaian"]').val(data.sf_berpakaian);
      $('[name="sf_bowel"]').val(data.sf_bowel);
      $('[name="sf_bladder"]').val(data.sf_bladder);
      $('[name="sf_total"]').val(data.sf_total);

      
      $('[name="pemeriksaan_penunjang"]').val(data.pemeriksaan_penunjang);
      $('[name="masalah_kesehatan"]').val(data.masalah_kesehatan);

      $('[name="masalah_keperawatan"]').val(data.masalah_keperawatan);

      $('[name="rencana_keperawatan"]').val(data.rencana_keperawatan);

      var edukasi = data.edukasi;
      if (edukasi.length > 0) {
        var edukasi = data.edukasi.split(";"),
          $inputs = $('input[name^=edukasi]');
        for (var j = 0; j < edukasi.length; j++) {
          $inputs.filter("[value='" + edukasi[j] + "']").attr('checked', 'checked');
        }
      }

      var pasien_pulang = data.pasien_pulang;
      if (pasien_pulang.length > 0) {
        var pasien_pulang = data.pasien_pulang.split(";"),
          $inputs = $('input[name^=pasien_pulang]');
        for (var j = 0; j < pasien_pulang.length; j++) {
          $inputs.filter("[value='" + pasien_pulang[j] + "']").attr('checked', 'checked');
        }
      }

      $(':radio[name=resiko_jatuh_gr][value="'+data.resiko_jatuh_gr+'"]').prop('checked', true).val();

      
      var prior = data.prior;
      if (prior.length > 0) {
        var prior = data.prior.split(";"),
          $inputs = $('input[name^=prior]');
        for (var j = 0; j < prior.length; j++) {
          $inputs.filter("[value='" + prior[j] + "']").attr('checked', 'checked');
        }
      }


      //$('[name="created"]').val(data.created);
      //$('[name="creator"]').val(data.creator);
      $('[name="updated"]').val(data.updated);
      $('[name="updator"]').val(data.updator);

    },
      error: function(xhr, ajaxOptions, thrownError) {
        show_my_error_message2(xhr.responseText,xhr.status,xhr.statusText);
    }
  });

}

// Date picker only
$('.tanggal').datepicker({
  dateFormat: "yy-mm-dd",
  autoclose: true,
  language: 'id',
});

$(".tanggal").datepicker("setDate", new Date());
</script>

<script>
function hitung_total_fungsional()
{
	var val_1 = parseInt($("#sf_makan").val()) || 0;
	var val_2 = parseInt($("#sf_transfer").val()) || 0;
	var val_3 = parseInt($("#sf_grooming").val()) || 0;
	var val_4 = parseInt($("#sf_toilet").val()) || 0;
	var val_5 = parseInt($("#sf_mandi").val()) || 0;
	var val_6 = parseInt($("#sf_jalan").val()) || 0;
	var val_7 = parseInt($("#sf_tangga").val()) || 0;
	var val_8 = parseInt($("#sf_berpakaian").val()) || 0;
	var val_9 = parseInt($("#sf_bowel").val()) || 0;
	var val_10 = parseInt($("#sf_bladder").val()) || 0;
	
	var total = 0;
	total = val_1 + val_2 + val_3 + val_4 + val_5 + val_6 + val_7 + val_8 + val_9 + val_10;
	
	$("#sf_total").val(total);
}
</script>