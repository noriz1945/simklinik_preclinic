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


<div class="container-fluid form_asm_awal_ulater" id="sini">
  <form action="#" id="form_asm_awal_ulater">
    <div class="form-body">
      <!-- Hidden fields -->
      <input type="hidden" class="form-control input-default" id="id_pasien" name="id_pasien">
      <input type="hidden" class="form-control input-default" id="id_reg" name="id_reg">
      <!-- Hidden fields -->

      <div class="row">

        <div class="col-md-6">  
          <div class="row">
            <div class="col-sm-4">
              <label class="control-label">Asesmen Awal / Ulang :</label>
            </div>
            <div class="col-sm-3">
              <input type="radio" name="asal_ulang" value="Asesmen Awal" /> Asesmen Awal
            </div>
            <div class="col-sm-3">
              <input type="radio" name="asal_ulang" value="Ulang" /> Ulang
            </div>
          </div>
        </div>

        <div class="col-md-5">
          <div class="row">
            <div class="col-sm-6">
              <label class="control-label">Asesmen Awal / Ulang Tanggal :</label>
            </div>
            <div class="col-sm-6">
              <input type="text" name="tgl_asulang" id="tgl_asulang" class="form-control tanggal">
            </div>
          </div>
        </div>

        <div class="col-md-1">
          <div class="row">
            <div class="col-sm-3">
              <button type="button" class="btn btn-warning" id="kelist"><i class="fa fa-arrow-down"></i> List</button>
            </div>
          </div>
        </div>

      </div>

      <h3 class="pnl-head-3">1.	Gejala yang ditemukan pada pasien</h3>
      <div class="row pnl">

        <div class="col-md-12">
          <label class="control-label">1.1.	Kegawatan pernafasan :</label>
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_1_a[]" value="Dyspnoe"> Dyspnoe 
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_1_a[]" value="Nafas cepat dan dangkal"> Nafas cepat dan dangkal 
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_1_a[]" value="Nafas lambat"> Nafas lambat
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_1_a[]" value="Nafas Tak teratur"> Nafas Tak teratur
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_1_a[]" value="Nafas melalui mulut"> Nafas melalui mulut
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_1_a[]" value="Mukosa oral kering"> Mukosa oral kering
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_1_a[]" value="Ada sekret"> Ada sekret
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_1_a[]" value="SpO2 < normal"> SpO2 < normal
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_1_a[]" value="T.A.K"> T.A.K
                <div class="input-group-addon"> </div>
              </div>
            </div>

          </div>
        </div>

        <div class="col-md-12">
          <label class="control-label">1.2.	Perlambatan Sirkulasi :</label>
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_1_b[]" value="Bercak dan sianosis pada ekstremitas"> Bercak dan sianosis pada ekstremitas 
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_1_b[]" value="Kulit dingin dan berkeringat"> Kulit dingin dan berkeringat
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_1_b[]" value="Gelisah"> Gelisah
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_1_b[]" value="Tekanan Darah menurun"> Tekanan Darah menurun
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_1_b[]" value="Lemas"> Lemas
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_1_b[]" value="Nadi lambat dan lemah"> Nadi lambat dan lemah
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_1_b[]" value="T. A. K"> T. A. K
                <div class="input-group-addon"> </div>
              </div>
            </div>

          </div>
        </div>

        <div class="col-md-12">
          <label class="control-label">1.3.	Penurunan / Kehilangan Tinus otot :</label>
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_1_c[]" value="Mual"> Mual
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_1_c[]" value="Penurunan Pergerakan tubuh"> Penurunan Pergerakan tubuh
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_1_c[]" value="Sulit Berbicara"> Sulit Berbicara
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_1_c[]" value="Tekanan Darah menurun"> Tekanan Darah menurun
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_1_c[]" value="Sulit menelan"> Sulit menelan
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_1_c[]" value="Distensi Abdomen"> Distensi Abdomen
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_1_c[]" value="Inkontinensia Urine"> Inkontinensia Urine
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_1_c[]" value="Inkontinensia alvi"> Inkontinensia alvi
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_1_c[]" value="T.A.K"> T.A.K
                <div class="input-group-addon"> </div>
              </div>
            </div>

          </div>
        </div>

        <div class="col-md-12">
          <label class="control-label">1.4.	Nyeri :</label>
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_1_d[]" value="Tidak"> Tidak
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_1_d[]" value="Ya"> Ya
                <div class="input-group-addon"> </div>
              </div>
            </div>

          </div>
        </div>

      </div>

      <h3 class="pnl-head-3">2.	Faktor-faktor yang memperburuk  gejala fisik :</h3>
      <div class="row pnl">

        <div class="col-md-12">
          <label class="control-label">2.	Faktor-faktor yang memperburuk  gejala fisik :</label>
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_2_a[]" value="Melakukan aktivitas fisik"> Melakukan aktivitas fisik
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_2_a[]" value="Pindah posisi"> Pindah posisi
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="text" id="aupt_2_a_text" name="aupt_2_a_text" placeholder="....">
                <div class="input-group-addon"> </div>
              </div>
            </div>

          </div>
        </div>

      </div>

      <h3 class="pnl-head-3">3.	Orientasi spiritual pasien dan keluarga :</h3>
      <div class="row pnl">

        <div class="col-md-12">
          <label class="control-label">Apakah perlu pelayanan spiritual ? </label>
          <div class="row">

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_3_a[]" value="Tidak"> Tidak
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_3_a[]" value="Ya"> Ya
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="text" id="aupt_3_a_text" name="aupt_3_a_text" placeholder="....">
                <div class="input-group-addon"> </div>
              </div>
            </div>

          </div>
        </div>

        <div class="col-md-12">
          <label class="control-label">Perlu didoakan</label>
          <div class="row">

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_3_a[]" value="Tidak"> Tidak
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_3_a[]" value="Ya"> Ya
                <div class="input-group-addon"> </div>
              </div>
            </div>

          </div>
        </div>

        <div class="col-md-12">
          <label class="control-label">Perlu bimbingan rohani</label>
          <div class="row">

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_3_a[]" value="Tidak"> Tidak
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_3_a[]" value="Ya"> Ya
                <div class="input-group-addon"> </div>
              </div>
            </div>

          </div>
        </div>

        <div class="col-md-12">
          <label class="control-label">Perlu pendampingan rohani</label>
          <div class="row">

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_3_a[]" value="Tidak"> Tidak
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_3_a[]" value="Ya"> Ya
                <div class="input-group-addon"> </div>
              </div>
            </div>

          </div>
        </div>

      </div>

      <h3 class="pnl-head-3">4.	Status spiritual pasien dan keluarga seperti : </h3>
      <div class="row pnl">

        <div class="col-md-12">
          <div class="row">

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_4_a[]" value="Putus asa"> Putus asa
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_4_a[]" value="Penderitaan"> Penderitaan
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_4_a[]" value="Rasa bersalah"> Rasa bersalah
                <div class="input-group-addon"> </div>
              </div>
            </div>

          </div>
        </div>

      </div>

      <h3 class="pnl-head-3">5.	Manajemen gejala saat ini da respon pasien : </h3>
      <div class="row pnl">

        <div class="col-md-12">
          <label class="control-label">Masalah keperawatan *</label>
        <div class="row">

        <div class="col-md-12">
          <div class="row">

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_5_a[]" value="Mual"> Mual
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_5_a[]" value="Pola Nafas tidak efektif"> Pola Nafas tidak efektif
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_5_a[]" value="Bersihan jalan nafas tidak efektif"> Bersihan jalan nafas tidak efektif
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_5_a[]" value="Perubahan persepsi sensori"> Perubahan persepsi sensori
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_5_a[]" value="Konstipasi"> Konstipasi
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_5_a[]" value="Defisit perawatan diri"> Defisit perawatan diri
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_5_a[]" value="Nyeri akut"> Nyeri akut
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_5_a[]" value="Nyeri Kronis"> Nyeri Kronis
                <div class="input-group-addon"> </div>
              </div>
            </div>
            </div>
            </div>
          </div>
        </div>

      </div>

      <h3 class="pnl-head-3">6.	Status psikososial dan keluarga : </h3>
      <div class="row pnl">

      <div class="col-md-12">
          <label class="control-label">6.1.	Apakah ada orang yang ingin dihubungi saat ini?</label>
        <div class="row">

        <div class="col-md-12">
          <div class="row">

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_6_a[]" value="Tidak "> Tidak 
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_6_a[]" value="Ya"> Ya
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="text" name="aupt_5_a_1_text" placeholder="Siapa">
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="text" name="aupt_5_a_2_text" placeholder="Hubungan dengan pasien sebagai">
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="text" name="aupt_5_a_3_text" placeholder="Dimana">
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="text" name="aupt_5_a_4_text" placeholder="No. Telpon/HP">
                <div class="input-group-addon"> </div>
              </div>
            </div>
            </div>
            </div>
          </div>
      </div>

      <div class="col-md-12">
          <label class="control-label">6.2.	Bagaimana rencana perawatan selanjutnya?</label>
        <div class="row">

        <div class="col-md-12">
          <div class="row">

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_6_a[]" value="Tetap dirawat di RS"> Tetap dirawat di RS 
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_6_a[]" value="Dirawat di rumah"> Dirawat di rumah
                <div class="input-group-addon"> </div>
              </div>
            </div>

            </div>
        </div>

        <div class="col-md-12">
         <label class="control-label">Apakah lingkungan rumah sudah disiapkan ?</label>
          <div class="row">

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_6_b[]" value="Ya"> Ya
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_6_b[]" value="Tidak"> Tidak 
                <div class="input-group-addon"> </div>
              </div>
            </div>

            </div>
        </div>

        <div class="col-md-12">
         <label class="control-label">Jika Ya, apakah ada yang mampu merawat pasien di rumah ?</label>
          <div class="row">

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_6_b[]" value="Ya"> Ya
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="text" name="aupt_6_b_1_text" placeholder="oleh">
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_6_b[]" value="Tidak"> Tidak 
                <div class="input-group-addon"> </div>
              </div>
            </div>

            </div>
        </div>

        <div class="col-md-12">
         <label class="control-label">Jika tidak, apakah perlu difasilitasi RS (Home Care)?</label>
          <div class="row">

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_6_b[]" value="Ya"> Ya
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_6_b[]" value="Tidak"> Tidak 
                <div class="input-group-addon"> </div>
              </div>
            </div>

            </div>
        </div>

        </div>

        <?php /////////////// ?>
        <label class="control-label">6.3.	Reaksi pasien atas penyakitnya</label>
        <div class="row">

        <div class="col-md-12">
         <label class="control-label">Asesmen informasi</label>
          <div class="row">

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_6_c[]" value="Menyangkal"> Menyangkal 
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_6_c[]" value="Sedih/menangis"> Sedih/menangis 
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_6_c[]" value="Marah"> Marah
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_6_c[]" value="Rasa bersalah"> Rasa bersalah
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_6_c[]" value="Takut"> Takut 
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_6_c[]" value="Ketidak berdayaan"> Ketidak berdayaan
                <div class="input-group-addon"> </div>
              </div>
            </div>

            </div>
        </div>

        <div class="col-md-12">
         <label class="control-label">Masalah keperawatan *</label>
          <div class="row">

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_6_c[]" value="Anxietas"> Anxietas 
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_6_c[]" value="Distress Spiritual"> Distress Spiritual
                <div class="input-group-addon"> </div>
              </div>
            </div>

            </div>
        </div>

        </div>

        <label class="control-label">6.4.	Reaksi keluarga atas penyakit pasien :</label>
        <div class="row">

        <div class="col-md-12">
         <label class="control-label">Asesmen informasi</label>
          <div class="row">

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_6_d[]" value="Marah"> Marah 
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_6_d[]" value="Letih/lelah"> Letih/lelah
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_6_d[]" value="Gangguan tidur"> Gangguan tidur
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_6_d[]" value="Rasa bersalah"> Rasa bersalah
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_6_d[]" value="Penurunan Konsentrasi"> Penurunan Konsentrasi 
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_6_d[]" value="Perubahan kebiasaan pola komunikasi"> Perubahan kebiasaan pola komunikasi
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_6_d[]" value="Ketidakmampuan memenuhi peran yang diharapkan"> Ketidakmampuan memenuhi peran yang diharapkan
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_6_d[]" value="Keluarga kurang berpartisipasi membuat"> Keluarga kurang berpartisipasi membuat
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_6_d[]" value="Keluarga kurang berkomunikasi dengan pasien"> Keluarga kurang berkomunikasi dengan pasien
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_6_d[]" value="Keputusan dalam perawatan pasien"> Keputusan dalam perawatan pasien
                <div class="input-group-addon"> </div>
              </div>
            </div>

            </div>
        </div>

        <div class="col-md-12">
         <label class="control-label">Masalah keperawatan *</label>
          <div class="row">

            <div class="col-md-4">
              <div class="form-group">
                <input type="checkbox" name="aupt_6_d[]" value="Koping individu tidak efektif"> Koping individu tidak efektif 
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_6_d[]" value="Distress Spiritual"> Distress Spiritual
                <div class="input-group-addon"> </div>
              </div>
            </div>

            </div>
        </div>

        </div>

      </div>

      </div>

      <h3 class="pnl-head-3">7.	Kebutuhan dukungan atau kelonggaran pelayanan bagi pasien, keluarga dan pemberi pelayanan lain :</h3>
      <div class="row pnl">

        <div class="col-md-12">
         
        <div class="row">

        <div class="col-md-12">
          <div class="row">

            <div class="col-md-3">
              <div class="form-group">
                <input type="checkbox" name="aupt_7_a[]" value="Pasien perlu didampingin keluarga"> Pasien perlu didampingin keluarga 
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <input type="checkbox" name="aupt_7_a[]" value="Keluarga dapat mengunjungi pasien di luar waktu berkunjung"> Keluarga dapat mengunjungi pasien di luar waktu berkunjung
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <input type="checkbox" name="aupt_7_a[]" value="Sahabat dapat mengunjungi pasien di luar waktu berkunjung"> Sahabat dapat mengunjungi pasien di luar waktu berkunjung
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <input type="text" name="aupt_7_a_1_text" placeholder="......">
                <div class="input-group-addon"> </div>
              </div>
            </div>

            </div>
            </div>
          </div>
        </div>

      </div>

      <h3 class="pnl-head-3">8.	Apakah ada kebutuhan akan alternatif atau timgkat pelayanan lain : </h3>
      <div class="row pnl">

        <div class="col-md-12">
         
        <div class="row">

        <div class="col-md-12">
          <div class="row">

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_8_a[]" value="Tidak"> Tidak
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_8_a[]" value="Autopsi"> Autopsi
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_8_a[]" value="Donasi Organ"> Donasi Organ
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="text" name="aupt_8_a_1_text" placeholder="Donasi Organ">
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="text" name="aupt_8_a_2_text" placeholder="......">
                <div class="input-group-addon"> </div>
              </div>
            </div>

            </div>
            </div>
          </div>
        </div>

      </div>

      <h3 class="pnl-head-3">9.	Faktor resiko bagi keluarga yang ditinggalkan : </h3>
      <div class="row pnl">

        <div class="col-md-12">
          <label class="control-label">Asesmen informasi</label>
        <div class="row">

        <div class="col-md-12">
          <div class="row">

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_9_a[]" value="Marah"> Marah
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_9_a[]" value="Letih/lelah"> Letih/lelah
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_9_a[]" value="Depresi"> Depresi
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_9_a[]" value="Gangguan tidur"> Gangguan tidur
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_9_a[]" value="Rasa bersalah"> Rasa bersalah
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_9_a[]" value="Sedih/menangis"> Sedih/menangis
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_9_a[]" value="Perubahan kebiasaan pola komunikasi"> Perubahan kebiasaan pola komunikasi
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_9_a[]" value="Penurunan konsentrasi"> Penurunan konsentrasi
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="aupt_9_a[]" value="Ketidak mampuan memenuhi peran yang diharapkan"> Ketidak mampuan memenuhi peran yang diharapkan
                <div class="input-group-addon"> </div>
              </div>
            </div>
            </div>
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <label class="control-label">Masalah keperawatan * </label>
        <div class="row">

        <div class="col-md-12">
          <div class="row">

            <div class="col-md-4">
              <div class="form-group">
                <input type="checkbox" name="aupt_9_b[]" value="Koping individu tidak efektif"> Koping individu tidak efektif 
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <input type="checkbox" name="aupt_9_b[]" value="Distress Spiritual"> Distress Spiritual
                <div class="input-group-addon"> </div>
              </div>
            </div>

            </div>
            </div>
          </div>
        </div>

      </div>

      <h3 class="pnl-head-3">10.  Kebutuhan Unik Pasien : </h3>
      <div class="row pnl">

        <div class="col-md-12">
         
        <div class="row">

        <div class="col-md-12">
          <div class="row">


            <div class="col-md-12">
              <div class="form-group">
                <textarea name="aupt_10_a_1_text" placeholder="......" rows="4" cols="170"></textarea>
                <div class="input-group-addon"> </div>
              </div>
            </div>

            </div>
            </div>
          </div>
        </div>

      </div>



      <?php /////////////////////////////////////////////// ?>


        <div class="modal-footer">
          <div class="form-actions">
            <button type="button" class="btn btn-success" onclick="javascript: save_asm_awal('<?php echo $id_reg; ?>');">
              <i class="fa fa-check"></i> Save</button>
            <button type="button" class="btn btn-inverse" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
  </form>


  <h5><b>Riwayat</b></h5>
  <div class="table-responsive" id="sini_listnyah">
    <table class="table table-striped jambo_table bulk_action">
      <thead>
        <tr class="headings">
          <th class="column-title">PILIH</th>
          <th class="column-title">Asesmen Awal / Ulang</th>
          <th class="column-title">Tanggal</th>
          <th class="column-title">Dibuat Oleh</th>
          <th class="column-title"><i class="fa fa-trash" style="color:red;"></i></th>
        </tr>
      </thead>                           
        <tbody id="tbriwterminal"></tbody>
    </table>
  </div>
</div>

<script src="<?php echo base_url('assets/datepicker/datesdki.js'); ?>"></script>
<script src="<?php echo base_url('assets/datepicker/datesdki.css'); ?>"></script>

<!-- action here -->
<script>
  var baseUrl = '<?php echo $base_url; ?>';
  var id_reg  = '<?php echo $id_reg; ?>';

  $(document).ready(function(){  
    listlogterminal(id_reg);
  });

  function listlogterminal(id_reg){
    $.ajax({
      url : baseUrl+"formkeperawatan/frm_ulangterminal/tblogterminal",
      method : "POST",
      data : {id_reg:id_reg},
      async : true,
      dataType : 'json',
      success: function(res){
        var ires;
        var dataresnyah="";
      
         for (ires = 0; ires < res.length; ires++) {
                dataresnyah +="<tr>"
                +"<td><input type='radio' id='id_logterminal' name='id_logterminal' class='radbut_terminal' data-set-id='"+res[ires].id+"'></td>"
                +"<td>"+res[ires].asal_ulang+"</td>"
                +"<td>"+res[ires].tgl_asulang+"</td>"
                +"<td>"+res[ires].creator+"</td>"
                +"<td><button type='button' class='btn btn-danger deletelogterminal' data-set-id='"+res[ires].id+"'><i class='fa fa-trash' style='color:white;'></i></button></td>"
                +"</tr>";
         }
         
         $('#tbriwterminal').html(dataresnyah);
         
         
         $(".radbut_terminal").click(function(){
          $('#form_asm_awal_ulater')[0].reset();
          $('input:checkbox').removeAttr('checked');
          document.getElementById('sini').scrollIntoView();
            var id     = $(this).attr("data-set-id");			
                  $.ajax({
                   url : baseUrl+"formkeperawatan/frm_ulangterminal/detaillogterminal",
                   method : "POST",
                   data : { id:id},
                   async : false,
                   dataType : 'json',
                   success: function(data){
                   
                    var asal_ulang = data.asal_ulang;
                    if (asal_ulang == 'Asesmen Awal') {
                      $('#form_asm_awal_ulater').find(':radio[name=asal_ulang][value="Asesmen Awal"]').prop('checked', true).val();
                    } else if (asal_ulang == 'Ulang') {
                      $('#form_asm_awal_ulater').find(':radio[name=asal_ulang][value="Ulang"]').prop('checked', true).val();
                    }
                    $('[name="tgl_asulang"]').val(data.tgl_asulang);

                    var aupt_1_a = data.chk_aupt_1_a;
                    if (aupt_1_a.length > 0) {
                      var aupt_1_a = data.chk_aupt_1_a.split(";"),
                        $inputs = $('input[name^=aupt_1_a]');
                      for (var j = 0; j < aupt_1_a.length; j++) {
                        $inputs.filter("[value='" + aupt_1_a[j] + "']").attr('checked', 'checked');
                      }
                    }

                    var aupt_1_b = data.chk_aupt_1_b;
                    if (aupt_1_b.length > 0) {
                      var aupt_1_b = data.chk_aupt_1_b.split(";"),
                        $inputs = $('input[name^=aupt_1_b]');
                      for (var j = 0; j < aupt_1_b.length; j++) {
                        $inputs.filter("[value='" + aupt_1_b[j] + "']").attr('checked', 'checked');
                      }
                    }

                    var aupt_1_c = data.chk_aupt_1_c;
                    if (aupt_1_c.length > 0) {
                      var aupt_1_c = data.chk_aupt_1_c.split(";"),
                        $inputs = $('input[name^=aupt_1_c]');
                      for (var j = 0; j < aupt_1_c.length; j++) {
                        $inputs.filter("[value='" + aupt_1_c[j] + "']").attr('checked', 'checked');
                      }
                    }

                    var aupt_1_d = data.chk_aupt_1_d;
                    if (aupt_1_d.length > 0) {
                      var aupt_1_d = data.chk_aupt_1_d.split(";"),
                        $inputs = $('input[name^=aupt_1_d]');
                      for (var j = 0; j < aupt_1_d.length; j++) {
                        $inputs.filter("[value='" + aupt_1_d[j] + "']").attr('checked', 'checked');
                      }
                    }

                    var aupt_2_a = data.chk_aupt_2_a;
                    if (aupt_2_a.length > 0) {
                      var aupt_2_a = data.chk_aupt_2_a.split(";"),
                        $inputs = $('input[name^=aupt_2_a]');
                      for (var j = 0; j < aupt_2_a.length; j++) {
                        $inputs.filter("[value='" + aupt_2_a[j] + "']").attr('checked', 'checked');
                      }
                    }
                    $('[name="aupt_2_a_text"]').val(data.aupt_2_a_text);

                    var aupt_3_a = data.chk_aupt_3_a;
                    if (aupt_3_a.length > 0) {
                      var aupt_3_a = data.chk_aupt_3_a.split(";"),
                        $inputs = $('input[name^=aupt_3_a]');
                      for (var j = 0; j < aupt_3_a.length; j++) {
                        $inputs.filter("[value='" + aupt_3_a[j] + "']").attr('checked', 'checked');
                      }
                    }
                    $('[name="aupt_3_a_text"]').val(data.aupt_3_a_text);

                    var aupt_4_a = data.chk_aupt_4_a;
                    if (aupt_4_a.length > 0) {
                      var aupt_4_a = data.chk_aupt_4_a.split(";"),
                        $inputs = $('input[name^=aupt_4_a]');
                      for (var j = 0; j < aupt_4_a.length; j++) {
                        $inputs.filter("[value='" + aupt_4_a[j] + "']").attr('checked', 'checked');
                      }
                    }

                    var aupt_5_a = data.chk_aupt_5_a;
                    if (aupt_5_a.length > 0) {
                      var aupt_5_a = data.chk_aupt_5_a.split(";"),
                        $inputs = $('input[name^=aupt_5_a]');
                      for (var j = 0; j < aupt_5_a.length; j++) {
                        $inputs.filter("[value='" + aupt_5_a[j] + "']").attr('checked', 'checked');
                      }
                    }
                    $('[name="aupt_5_a_1_text"]').val(data.aupt_5_a_1_text);
                    $('[name="aupt_5_a_2_text"]').val(data.aupt_5_a_2_text);
                    $('[name="aupt_5_a_3_text"]').val(data.aupt_5_a_3_text);
                    $('[name="aupt_5_a_4_text"]').val(data.aupt_5_a_4_text);
                    
                    var aupt_6_a = data.chk_aupt_6_a;
                    if (aupt_6_a.length > 0) {
                      var aupt_6_a = data.chk_aupt_6_a.split(";"),
                        $inputs = $('input[name^=aupt_6_a]');
                      for (var j = 0; j < aupt_6_a.length; j++) {
                        $inputs.filter("[value='" + aupt_6_a[j] + "']").attr('checked', 'checked');
                      }
                    }

                    var aupt_6_b = data.chk_aupt_6_b;
                    if (aupt_6_b.length > 0) {
                      var aupt_6_b = data.chk_aupt_6_b.split(";"),
                        $inputs = $('input[name^=aupt_6_b]');
                      for (var j = 0; j < aupt_6_b.length; j++) {
                        $inputs.filter("[value='" + aupt_6_b[j] + "']").attr('checked', 'checked');
                      }
                    }
                    $('[name="aupt_6_b_1_text"]').val(data.aupt_6_b_1_text);

                    var aupt_6_c = data.chk_aupt_6_c;
                    if (aupt_6_c.length > 0) {
                      var aupt_6_c = data.chk_aupt_6_c.split(";"),
                        $inputs = $('input[name^=aupt_6_c]');
                      for (var j = 0; j < aupt_6_c.length; j++) {
                        $inputs.filter("[value='" + aupt_6_c[j] + "']").attr('checked', 'checked');
                      }
                    }

                    var aupt_6_d = data.chk_aupt_6_d;
                    if (aupt_6_d.length > 0) {
                      var aupt_6_d = data.chk_aupt_6_d.split(";"),
                        $inputs = $('input[name^=aupt_6_d]');
                      for (var j = 0; j < aupt_6_d.length; j++) {
                        $inputs.filter("[value='" + aupt_6_d[j] + "']").attr('checked', 'checked');
                      }
                    }

                    var aupt_7_a = data.chk_aupt_7_a;
                    if (aupt_7_a.length > 0) {
                      var aupt_7_a = data.chk_aupt_7_a.split(";"),
                        $inputs = $('input[name^=aupt_7_a]');
                      for (var j = 0; j < aupt_7_a.length; j++) {
                        $inputs.filter("[value='" + aupt_7_a[j] + "']").attr('checked', 'checked');
                      }
                    }
                    $('[name="aupt_7_a_1_text"]').val(data.aupt_7_a_1_text);

                    var aupt_8_a = data.chk_aupt_8_a;
                    if (aupt_8_a.length > 0) {
                      var aupt_8_a = data.chk_aupt_8_a.split(";"),
                        $inputs = $('input[name^=aupt_8_a]');
                      for (var j = 0; j < aupt_8_a.length; j++) {
                        $inputs.filter("[value='" + aupt_8_a[j] + "']").attr('checked', 'checked');
                      }
                    }

                    $('[name="aupt_8_a_1_text"]').val(data.aupt_8_a_1_text);
                    $('[name="aupt_8_a_2_text"]').val(data.aupt_8_a_2_text);

                    var aupt_9_a = data.chk_aupt_9_a;
                    if (aupt_9_a.length > 0) {
                      var aupt_9_a = data.chk_aupt_9_a.split(";"),
                        $inputs = $('input[name^=aupt_9_a]');
                      for (var j = 0; j < aupt_9_a.length; j++) {
                        $inputs.filter("[value='" + aupt_9_a[j] + "']").attr('checked', 'checked');
                      }
                    }

                    var aupt_9_b = data.chk_aupt_9_b;
                    if (aupt_9_b.length > 0) {
                      var aupt_9_b = data.chk_aupt_9_b.split(";"),
                        $inputs = $('input[name^=aupt_9_b]');
                      for (var j = 0; j < aupt_9_b.length; j++) {
                        $inputs.filter("[value='" + aupt_9_b[j] + "']").attr('checked', 'checked');
                      }
                    }

                    $('[name="aupt_10_a_1_text"]').val(data.aupt_10_a_1_text);
                              
                   },
              error: function(xhr, ajaxOptions, thrownError) {
                show_my_error_message2(xhr.responseText,xhr.status,xhr.statusText);
              }
                  });
                  

         });

          //DELETE
          $(".deletelogterminal").click(function(e){

            var id                = $(this).attr("data-set-id");

            Swal.fire({
			      title: 'Hapus?',
              text: 'Hapus riwayat assesment?',
              showDenyButton: true,
              showCancelButton: true,
              confirmButtonText: 'Ya',
              denyButtonText: `Tidak`,
            }).then((result) => {
              if (result.isConfirmed) {
                $.ajax({
                  url : baseUrl+"formkeperawatan/frm_ulangterminal/deletelogterminal",
                  method : "POST",
                  data : {id:id},
                  async : true,
                  dataType : 'json',
                    success: function(res){
                        Swal.fire('Berhasil!', '', 'success');
                        listlogterminal(id_reg);
                    },
              error: function(xhr, ajaxOptions, thrownError) {
                show_my_error_message2(xhr.responseText,xhr.status,xhr.statusText);
              }
                });
              } else if (result.isDenied) {
                Swal.fire('Batal Hapus', '', 'info')
              }
            });
          });
         //End DELETE

      },
              error: function(xhr, ajaxOptions, thrownError) {
                show_my_error_message2(xhr.responseText,xhr.status,xhr.statusText);
              }
    });
  }

function save_asm_awal(id_reg) {
  var url;
  var asal_ulang             = $('#asal_ulang').val();
  var tgl_asulang            = $('#tgl_asulang').val();
  if(asal_ulang==''){
    Swal.fire('Gagal!', 'Jenis Assesment tidak boleh kosong', 'danger');
    return false;
  }else if(tgl_asulang==''){
    Swal.fire('Gagal!', 'Tanggal tidak boleh kosong!', 'danger');
    return false;
  }else{
  url = '<?php echo site_url('formkeperawatan/frm_ulangterminal/asm_ulangterminal_add');?>/'+id_reg ;
  title = 'Data ASM Berhasil Disimpan';

  var data_submit = $('#form_asm_awal_ulater').serialize();
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

      listlogterminal(id_reg);
      $('#form_asm_awal_ulater')[0].reset();
      $('input:checkbox').removeAttr('checked');
      document.getElementById('sini_listnyah').scrollIntoView();
      
    },
              error: function(xhr, ajaxOptions, thrownError) {
                show_my_error_message2(xhr.responseText,xhr.status,xhr.statusText);
              }
  });
  
  }

}

$("#kelist").click(function(){
  document.getElementById('sini_listnyah').scrollIntoView();

});

$('.tanggal').datetimepicker({
  dateFormat: "yy-mm-dd",
  autoclose: true,
  language: 'id',
});

</script>