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

<style>
.set1024 {
  background-color: #44d46a;
  color:aliceblue;
}
.set2550 {
  background-color: #e7ed3b;
  color:aliceblue;
}
.set51 {
  background-color: #cc3b25;
  color:aliceblue;
}
</style>


<div class="container-fluid form_asm_awal_hemodial" id="sini">
  <form action="#" id="form_asm_awal_hemodial">
    <div class="form-body">
      <!-- Hidden fields -->
      <input type="hidden" class="form-control input-default" id="id_pasien" name="id_pasien" value="<?php echo $id_pasien; ?>">
      <input type="hidden" class="form-control input-default" id="id_reg" name="id_reg" value="<?php echo $id_reg; ?>">
      <input type="hidden" class="form-control input-default" id="id" name="id">
      <!-- Hidden fields -->

      <div class="row">

        <div class="col-md-6">  
          <div class="row">
            <div class="col-sm-4">
              <label class="control-label">Hari,tanggal/jam</label>
            </div>
            <div class="col-sm-6">
              <input type="text" name="tgl_haritgljam" id="tgl_haritgljam" class="form-control tanggal">
            </div>
          </div>
        </div>

        <div class="col-md-5">
          <div class="row">
            <div class="col-sm-6">
              <label class="control-label">No.mesin :</label>
            </div>
            <div class="col-sm-6">
              <input type="text" name="nomesin" id="nomesin" class="form-control">
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

      <div class="row">

        <div class="col-md-6">  
          <div class="row">
            <div class="col-sm-4">
              <label class="control-label">HD ke-</label>
            </div>
            <div class="col-sm-6">
              <input type="text" name="hdke" id="hdke" class="form-control">
            </div>
          </div>
        </div>

        <div class="col-md-6">  
          <div class="row">
            <div class="col-sm-4">
              <label class="control-label">Tipe Dializer</label>
            </div>
            <div class="col-sm-3">
              <input type="radio" name="tipe_dializer" value="Baru" /> Baru
            </div>
            <div class="col-sm-3">
              <input type="radio" name="tipe_dializer" value="Reuse" /> Reuse
            </div>
          </div>
        </div>

      </div>

      <div class="row">

        <div class="col-md-6">  
          <div class="row">
            <div class="col-sm-4">
              <label class="control-label">Riwayat Alergi Obat</label>
            </div>
            <div class="col-sm-2">
              <input type="radio" name="riwalergiobat" value="Tidak" /> Tidak
            </div>
            <div class="col-sm-2">
              <input type="radio" name="riwalergiobat" value="Ya" /> Ya
            </div>
            <div class="col-sm-3">
              <input type="text" name="riwalergiobat_text" placeholder="......." class="form-control"/>
            </div>
          </div>
        </div>

        <div class="col-md-6">  
          <div class="row">
            <div class="col-sm-4">
              <label class="control-label">Diagnosa Medis</label>
            </div>
            <div class="col-sm-6">
              <input type="text" name="diagnosamedis" id="diagnosamedis" class="form-control">
            </div>
          </div>
        </div>

      </div>

      <div class="row">

        <div class="col-md-12">  
          <div class="row">
            <div class="col-sm-2">
              <label class="control-label">Cara Bayar</label>
            </div>
            <div class="col-sm-2">
              <input type="radio" name="carabayar" value="Asuransi" /> Asuransi
            </div>
            <div class="col-sm-2">
              <input type="radio" name="carabayar" value="Tunai" /> Tunai
            </div>
            <div class="col-sm-2">
              <input type="radio" name="carabayar" value="BPJS" /> BPJS
            </div>
            <div class="col-sm-2">
              <input type="radio" name="carabayar" value="Pekerjaan" /> Pekerjaan
            </div>
            <div class="col-sm-2">
              <input type="text" name="carabayar_text" id="carabayar_text" class="form-control">
            </div>
          </div>
        </div>

      </div>

      <h3 class="pnl-head-3">A.	PENGKAJIAN KEPERAWATAN</h3>
      <div class="row pnl">

        <div class="col-md-12">
          <label class="control-label">1. Keluhan Utama :</label>
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keluhan_utama[]" value="Sesak napas"> Sesak napas
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keluhan_utama[]" value="Mual,Muntah"> Mual,Muntah
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keluhan_utama[]" value="Gatal"> Gatal
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keluhan_utama[]" value="Lain - lain"> Lain - lain
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keluhan_utama[]" value="Nyeri"> Nyeri
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keluhan_utama[]" value="Tidak"> Tidak
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keluhan_utama[]" value="Ya"> Ya
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="radio" name="keluhan_utama_rad" value="Ringan 0 - 3"> Ringan 0 - 3
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="radio" name="keluhan_utama_rad" value="Sedang 4 - 6"> Sedang 4 - 6
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="radio" name="keluhan_utama_rad" value="Berat 7 - 10"> Berat 7 - 10
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keluhan_utama[]" value="Akut"> Akut
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keluhan_utama[]" value="Kronik"> Kronik
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-sm-2">
            <label class="control-label">Lokasi</label>
              <input type="text" name="keluhan_utama_1_text" id="keluhan_utama_1_text" class="form-control" placeholder="Lokasi" title="Lokasi">
            </div>

            <div class="col-sm-2">
            <label class="control-label">Durasi</label>
              <input type="text" name="keluhan_utama_2_text" id="keluhan_utama_2_text" class="form-control" placeholder="Durasi" title="Durasi">
            </div>

          </div>
        </div>

        <div class="col-md-12">
          <label class="control-label">2. Pemeriksaan Fisik :</label>
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
              <label class="control-label">Keadaan Umum</label>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keadaan_umum_1[]" value="Baik"> Baik
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keadaan_umum_1[]" value="Sedang"> Sedang
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keadaan_umum_1[]" value="Buruk"> Buruk
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keadaan_umum_1[]" value="lain-lain"> lain-lain
                <div class="input-group-addon"> </div>
              </div>
            </div>

          </div>

          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
              <label class="control-label">Tekanan Darah</label>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
              <label class="control-label">mmHg</label>
                <input type="text" name="keadaan_umum_2_a_text" placeholder="mmHg" title="mmHg" class="form-control">
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
              <label class="control-label">MAP</label>
                <input type="text" name="keadaan_umum_2_b_text" placeholder="MAP" title="MAP" class="form-control">
                <div class="input-group-addon"> </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
              <label class="control-label">Nadi</label>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keadaan_umum_3[]" value="Reguler"> Reguler  
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keadaan_umum_3[]" value="Ireguler"> Ireguler  
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
              <label class="control-label">Frekuensi</label>
                <input type="text" name="keadaan_umum_3_a_text" placeholder="Frekuensi...........(x/mnt)" title="Frekuensi...........(x/mnt)" class="form-control">
                <div class="input-group-addon"> </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
              <label class="control-label">Respirasi</label>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keadaan_umum_4[]" value="Edema Paru/Ronchi"> Edema Paru/Ronchi  
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keadaan_umum_4[]" value="kusmaul"> kusmaul  
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keadaan_umum_4[]" value="Dispnea"> Dispnea  
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keadaan_umum_4[]" value="Normal"> Normal  
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
              <label class="control-label">Frekuensi</label>
                <input type="text" name="keadaan_umum_4_a_text" placeholder="Frekuensi...........(x/mnt)" title="Frekuensi...........(x/mnt)" class="form-control">
                <div class="input-group-addon"> </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
              <label class="control-label">Konjungtiva</label>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keadaan_umum_5[]" value="Tidak Anemis"> Tidak Anemis 
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keadaan_umum_5[]" value="Anemis"> Anemis  
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keadaan_umum_5[]" value="Lain-lain"> Lain-lain  
                <div class="input-group-addon"> </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
              <label class="control-label">Ekstrimitas</label>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keadaan_umum_6[]" value="Tidak edema/tidak dehidrasi "> Tidak edema/tidak dehidrasi 
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keadaan_umum_6[]" value="Anemis"> Anemis  
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keadaan_umum_6[]" value="Oedema"> Oedema
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keadaan_umum_6[]" value="Anasarka"> Anasarka
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keadaan_umum_6[]" value="Pucat&Dingin"> Pucat&Dingin
                <div class="input-group-addon"> </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
              <label class="control-label">Berat Badan</label>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
              <label class="control-label">Pre HD</label>
                <input type="text" name="keadaan_umum_7_a_text" placeholder="BB" title="BB" class="form-control">
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
              <label class="control-label">Kering</label>
                <input type="text" name="keadaan_umum_7_b_text" placeholder="Kg" title="Kg" class="form-control">
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
              <label class="control-label">BB HD Yg Lalu</label>
                <input type="text" name="keadaan_umum_7_c_text" placeholder="Kg" title="Kg" class="form-control">
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
              <label class="control-label">Post HD</label>
                <input type="text" name="keadaan_umum_7_d_text" placeholder="Kg" title="Kg" class="form-control">
                <div class="input-group-addon"> </div>
              </div>
            </div>

          </div>

          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
              <label class="control-label">Akses Vaskuler</label>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keadaan_umum_8[]" value="AV-fistula"> AV-fistula
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
              <label class="control-label"> HD Kateter: </label>
              <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keadaan_umum_8[]" value="subclavia"> subclavia
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keadaan_umum_8[]" value="Jugular"> Jugular
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="keadaan_umum_8[]" value="femoral"> femoral
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
              <label class="control-label">lainnya</label>
                <input type="text" name="keadaan_umum_8_a_text" placeholder="lainnya" title="lainnya" class="form-control">
                <div class="input-group-addon"> </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
              <label class="control-label">Resiko Jatuh : √ (cheklist) pada kotak skor</label>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
              <label class="control-label">1.	Riwayat jatuh yang baru atau dalam bulan terakhir</label>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <input type="radio" name="keadaan_umum_9_a" value="0"> Tidak
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <input type="radio" name="keadaan_umum_9_a" value="25"> Ya
                <div class="input-group-addon"> </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
              <label class="control-label">2. Diagnosis medis sekunder ≥ 1</label>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <input type="radio" name="keadaan_umum_9_b" value="0"> Tidak
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <input type="radio" name="keadaan_umum_9_b" value="15"> Ya
                <div class="input-group-addon"> </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
              <label class="control-label">3. Alat Bantu Jalan</label>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="radio" name="keadaan_umum_9_c" value="0"> Bedrest
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="radio" name="keadaan_umum_9_c" value="15"> Penopang Tongkat
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="radio" name="keadaan_umum_9_c" value="30"> Furniture
                <div class="input-group-addon"> </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
              <label class="control-label">4. Memakai terapi Heparin lock/iv</label>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <input type="radio" name="keadaan_umum_9_d" value="0"> Tidak
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <input type="radio" name="keadaan_umum_9_d" value="20"> Ya
                <div class="input-group-addon"> </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
              <label class="control-label">5. Cara berjalan / berpindah</label>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <input type="radio" name="keadaan_umum_9_e" value="0"> Normal/Bedrest/ Imobilisasi
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-1">
              <div class="form-group">
                <input type="radio" name="keadaan_umum_9_e" value="15"> Lemah
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="radio" name="keadaan_umum_9_e" value="30"> Terganggu
                <div class="input-group-addon"> </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
              <label class="control-label">6. Status mental</label>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <input type="radio" name="keadaan_umum_9_f" value="0"> Orientasi sesuai kemampuan
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <input type="radio" name="keadaan_umum_9_f" value="15"> Lupa Keterbatasan
                <div class="input-group-addon"> </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
              <label class="control-label">Skor total</label>
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <input type="text" id="skor_9" name="skor_9" value="0" readonly class="form-control">
                <div class="input-group-addon"> </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
              <label class="control-label">Kesimpulan</label>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
              <label class="control-label" id="set1024">&nbsp;&nbsp;&nbsp;&nbsp;10-24 (tidak berisiko)&nbsp;&nbsp;&nbsp;&nbsp;</label>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
              <label class="control-label" id="set2550">&nbsp;&nbsp;&nbsp;&nbsp;25-50 (risiko rendah)&nbsp;&nbsp;&nbsp;&nbsp;</label>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
              <label class="control-label" id="set51">&nbsp;&nbsp;&nbsp;&nbsp;≥51(risiko tinggi)&nbsp;&nbsp;&nbsp;&nbsp;</label>
              </div>
            </div>
          </div>

        </div>

        <div class="col-md-12">
          <label class="control-label">3. Pemeriksaan Penunjang (lab.ro,lain-lain) :</label>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
              <textarea name="pemeriksaan_penunjang_10" placeholder="......" rows="4" cols="170"></textarea>
                <div class="input-group-addon"> </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <label class="control-label">4.Kriteria Risiko Nutrisional / Gizi (dikaji tiap 3 – 6 bulan sekali atau di ulangi jika dianggap terjadi perubahan asupan gizi)</label>
          <div class="row">
            <div class="col-md-4">
            <label class="control-label">Tanggal</label>
              <div class="form-group">
              <input type="text" name="krn_a_text" id="krn_a_text" class="form-control tanggal_krn" placeholder="Tanggal">
                <div class="input-group-addon"> </div>
              </div>
            </div>
            <div class="col-md-4">
            <label class="control-label">MIS,Score Total</label>
              <div class="form-group">
              <input type="text" name="krn_b_text" id="krn_b_text" class="form-control" placeholder="MIS,Score Total">
                <div class="input-group-addon"> </div>
              </div>
            </div>
            <div class="col-md-4">
            <label class="control-label">SGA,Score Toral</label>
              <div class="form-group">
              <input type="text" name="krn_c_text" id="krn_c_text" class="form-control" placeholder="SGA,Score Toral">
                <div class="input-group-addon"> </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                Kesimpulan
                <div class="input-group-addon"> </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
              <input type="radio" name="ksm_a" id="ksm_a" value="Tanpa Malnitrisi (≤6)"> Tanpa Malnitrisi (≤6)
                <div class="input-group-addon"> </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
              <input type="radio" name="ksm_a" id="ksm_a" value="Malnutrisi (≥6)"> Malnutrisi (≥6)
                <div class="input-group-addon"> </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <label class="control-label">Riwayat Kultural , Spiritual dan Psikososial: (dikaji saat kunjungan pertama)</label>
          <div class="row">
            <div class="col-md-4">
            <label class="control-label">Adakah keyakinan / tradisi / budaya yang berkaitan dengan pelayanan kesehatan yang akan diberikan </label>
            </div>
            <div class="col-md-3">
              <div class="form-group">
              <input type="checkbox" name="rikul_a[]" id="rikul_a[]" value="Tidak"> Tidak
                <div class="input-group-addon"> </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
              <input type="checkbox" name="rikul_a[]" id="rikul_a[]" value="Ya"> Ya
                <div class="input-group-addon"> </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-2">
            <label class="control-label">Kendala Komunikasi</label>
            </div>
            <div class="col-md-2">
              <div class="form-group">
              <input type="checkbox" name="rikul_a[]" id="rikul_a[]" value="Tidak Ada"> Tidak Ada
                <div class="input-group-addon"> </div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
              <input type="checkbox" name="rikul_a[]" id="rikul_a[]" value="Ada, jelaskan"> Ada, jelaskan
                <div class="input-group-addon"> </div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <input type="text" id="rikul_a_text" name="rikul_a_text" placeholder="Jelaskan" class="form-control">
                <div class="input-group-addon"> </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-2">
            <label class="control-label">Yang merawat dirumah</label>
            </div>
            <div class="col-md-2">
              <div class="form-group">
              <input type="checkbox" name="rikul_b[]" id="rikul_b[]" value="Tidak Ada"> Tidak Ada
                <div class="input-group-addon"> </div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
              <input type="checkbox" name="rikul_b[]" id="rikul_b[]" value="Ada, jelaskan"> Ada, jelaskan
                <div class="input-group-addon"> </div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <input type="text" id="rikul_b_text" name="rikul_b_text" placeholder="Jelaskan" class="form-control">
                <div class="input-group-addon"> </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-2">
            <label class="control-label">Kondisi saat ini</label>
            </div>
            <div class="col-md-2">
              <div class="form-group">
              <input type="checkbox" name="rikul_c[]" id="rikul_c[]" value="Tenang"> Tenang
                <div class="input-group-addon"> </div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
              <input type="checkbox" name="rikul_c[]" id="rikul_c[]" value="Gelisah"> Gelisah
                <div class="input-group-addon"> </div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
              <input type="checkbox" name="rikul_c[]" id="rikul_c[]" value="Takut terhadap tindakan"> Takut terhadap tindakan
                <div class="input-group-addon"> </div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
              <input type="checkbox" name="rikul_c[]" id="rikul_c[]" value="Marah"> Marah
                <div class="input-group-addon"> </div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
              <input type="checkbox" name="rikul_c[]" id="rikul_c[]" value="Mudah Tersinggung"> Mudah Tersinggung
                <div class="input-group-addon"> </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-2">
            <label class="control-label">Kemampuan Ibadah :Sholat : </label>
            </div>
            <div class="col-md-2">
              <div class="form-group">
              <input type="checkbox" name="rikul_d[]" id="rikul_d[]" value="Berdiri"> Berdiri
                <div class="input-group-addon"> </div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
              <input type="checkbox" name="rikul_d[]" id="rikul_d[]" value="Duduk"> Duduk
                <div class="input-group-addon"> </div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
              <input type="checkbox" name="rikul_d[]" id="rikul_d[]" value="Berbaring"> Berbaring
                <div class="input-group-addon"> </div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
              <input type="checkbox" name="rikul_d[]" id="rikul_d[]" value="Berwudlu"> Berwudlu
                <div class="input-group-addon"> </div>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
              <input type="checkbox" name="rikul_d[]" id="rikul_d[]" value="Tayamum"> Tayamum
                <div class="input-group-addon"> </div>
              </div>
            </div>
          </div>

        </div>

      </div>

      <h3 class="pnl-head-3">B. DIAGNOSA KEPERAWATAN</h3>
      <div class="row pnl">

        <div class="col-md-12">
          <div class="row">

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="diagnosa_kepe[]" value="Kelebihan Volume Cairan"> Kelebihan Volume Cairan
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="diagnosa_kepe[]" value="Penurunan Curah Jantung"> Penurunan Curah Jantung
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="diagnosa_kepe[]" value="Gangguan Keseimbangan Asam Basa"> Gangguan Keseimbangan Asam Basa
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="diagnosa_kepe[]" value="Gangguan Pertukaran Gas"> Gangguan Pertukaran Gas
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="diagnosa_kepe[]" value="Ketidak Patuhan Terhadap Diet"> Ketidak Patuhan Terhadap Diet
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="diagnosa_kepe[]" value="Gangguan Rasa Nyaman:Nyeri"> Gangguan Rasa Nyaman:Nyeri
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="diagnosa_kepe[]" value="Gangguan Keseimbangan Elektrolit"> Gangguan Keseimbangan Elektrolit
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="diagnosa_kepe[]" value="Nutrisi Kurang Dari Kebutuhan Tubuh"> Nutrisi Kurang Dari Kebutuhan Tubuh
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="text" id="diagnosa_kepe_text" name="diagnosa_kepe_text" placeholder="......" class="form-control">
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
                <input type="checkbox" name="perlu_doa_a[]" value="Tidak"> Tidak
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="perlu_doa_a[]" value="Ya"> Ya
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
                <input type="checkbox" name="perlu_doa_a[]" value="Tidak"> Tidak
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="perlu_doa_a[]" value="Ya"> Ya
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
                <input type="checkbox" name="perlu_doa_a[]" value="Tidak"> Tidak
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="perlu_doa_a[]" value="Ya"> Ya
                <div class="input-group-addon"> </div>
              </div>
            </div>

          </div>
        </div>

      </div>

      <h3 class="pnl-head-3">C. INTERVENSI DAN IMPLEMENTASI KEPERAWATAN (Rekapitulasi pre-Intra dan pos HD)</h3>
      <div class="row pnl">

        <div class="col-md-12">
          <div class="row">

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="intimp_a[]" value="Monitor BB, intake out put"> Monitor BB, intake out put
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="intimp_a[]" value="Observasi pasien (monitor TTV)"> Observasi pasien (monitor TTV)
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="intimp_a[]" value="Lakukan tehnik relaksasi dan distraksi"> Lakukan tehnik relaksasi dan distraksi
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="intimp_a[]" value="Atur posisi pasien agar ventilasi adequat"> Atur posisi pasien agar ventilasi adequat
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="intimp_a[]" value="Kaji kemampuan pasien untuk mendapat kan nutrisi yang dibutuhkan"> Kaji kemampuan pasien untuk mendapat kan nutrisi yang dibutuhkan
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="intimp_a[]" value="Hentikan HD sesuai indikasi (bila pasien mulai hipotensi (mual,muntah, keringat dingin, Kram))"> Hentikan HD sesuai indikasi (bila pasien mulai hipotensi (mual,muntah, keringat dingin, Kram))
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="intimp_a[]" value="Berikan terapi oksigen sesuai kebutuhan"> Berikan terapi oksigen sesuai kebutuhan
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="intimp_a[]" value="Ganti balutan luka sesuai prosedur"> Ganti balutan luka sesuai prosedur
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="intimp_a[]" value="Monitor tanda dan gejala hipoglikemi"> Monitor tanda dan gejala hipoglikemi
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="intimp_a[]" value="Posisikan supinasi"> Posisikan supinasi
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="intimp_a[]" value="Membimbing ibadah sholat"> Membimbing ibadah sholat
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="intimp_a[]" value="Membimbing thoharoh (wudlu / tayamum)"> Membimbing thoharoh (wudlu / tayamum)
                <div class="input-group-addon"> </div>
              </div>
            </div>

          </div>
          <div class="row">
          <label class="control-label">KOLABORASI</label>
            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="intimp_b[]" value="Program HD"> Program HD
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="intimp_b[]" value="Transfusi darah"> Transfusi darah
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="intimp_b[]" value="Pemberian Ca Glukonas"> Pemberian Ca Glukonas
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="intimp_b[]" value="Pemberian antipiretik"> Pemberian antipiretik
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="intimp_b[]" value="Pemberian Analgetik"> Pemberian Analgetik
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="intimp_b[]" value="Pemberian preparat Fe / zat besi"> Pemberian preparat Fe / zat besi
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="intimp_b[]" value="Pemberian Erytropoetin"> Pemberian Erytropoetin
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="intimp_b[]" value="Obat- obatan Emergency"> Obat- obatan Emergency
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="intimp_b[]" value="Pemberian Antibiotik"> Pemberian Antibiotik
                <div class="input-group-addon"> </div>
              </div>
            </div>

          </div>

        </div>

      </div>

      <h3 class="pnl-head-3">INSTRUKSI MEDIK </h3>
      <div class="row pnl">

        <div class="col-md-12">
        <div class="row">

        <div class="col-md-12">
          <div class="row">

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="instruksi_medik_a[]" value="Inisiasi"> Inisiasi
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="instruksi_medik_a[]" value="Akut"> Akut
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="instruksi_medik_a[]" value="Rutin"> Rutin
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="instruksi_medik_a[]" value="Pre-OP"> Pre-OP
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group"> 
              <label class="control-label">SLED</label>
                <input type="text" class="form-control" name="instruksi_medik_a_text" id="instruksi_medik_a_text" placeholder="SLED">
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
              <label class="control-label">Dialisat : </label>
                <input type="checkbox" name="instruksi_medik_a[]" value="Asetat"> Asetat
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <input type="checkbox" name="instruksi_medik_a[]" value="Bicarbonat"> Bicarbonat
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group"> 
              <label class="control-label">TD </label>
                <input type="text" class="form-control" name="instruksi_medik_b_text" id="instruksi_medik_b_text" placeholder="JAM">
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group"> 
              <label class="control-label">QB </label>
                <input type="text" class="form-control" name="instruksi_medik_c_text" id="instruksi_medik_c_text" placeholder="ml/mnt">
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group"> 
              <label class="control-label">UF Goal </label>
                <input type="text" class="form-control" name="instruksi_medik_d_text" id="instruksi_medik_d_text" placeholder="ml">
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group"> 
              <label class="control-label">Conductivity </label>
                <input type="text" class="form-control" name="instruksi_medik_e_text" id="instruksi_medik_e_text" placeholder="Conductivity">
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group"> 
              <label class="control-label">Temperature </label>
                <input type="text" class="form-control" name="instruksi_medik_f_text" id="instruksi_medik_f_text" placeholder="Temperature">
                <div class="input-group-addon"> </div>
              </div>
            </div>

            </div>

          <div class="row">
          <label class="control-label">Heparinisasi</label>
          <div class="col-md-2">
              <div class="form-group"> 
              <label class="control-label">Dosis sirkulasi </label>
                <input type="text" class="form-control" name="instruksi_medik_g_text" id="instruksi_medik_g_text" placeholder="iu">
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group"> 
              <label class="control-label">LMWH </label>
                <input type="text" class="form-control" name="instruksi_medik_h_text" id="instruksi_medik_h_text" placeholder="LMWH">
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group"> 
              <label class="control-label">Dosis awal </label>
                <input type="text" class="form-control" name="instruksi_medik_i_text" id="instruksi_medik_i_text" placeholder="iu">
                <div class="input-group-addon"> </div>
              </div>
            </div>
          </div>

          <div class="row">
          <label class="control-label">Dosis maintenance : </label>
          <div class="col-md-2">
              <div class="form-group"> 
              <label class="control-label">Continue </label>
                <input type="text" class="form-control" name="instruksi_medik_j_text" id="instruksi_medik_j_text" placeholder="iu/jam">
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group"> 
              <label class="control-label">Intermitten </label>
                <input type="text" class="form-control" name="instruksi_medik_k_text" id="instruksi_medik_k_text" placeholder="iu/jam">
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group"> 
              <label class="control-label">Tanpa Heparin, Penyebab </label>
                <input type="text" class="form-control" name="instruksi_medik_l_text" id="instruksi_medik_l_text" placeholder="....">
                <div class="input-group-addon"> </div>
              </div>
            </div>
          </div>

          <div class="col-md-5">
              <div class="form-group">
                <input type="checkbox" name="instruksi_medik_a[]" value="Program bilas NaCL 0.9% 100 cc/ jam ½ "> Program bilas NaCL 0.9% 100 cc/ jam ½ 
                <div class="input-group-addon"> </div>
              </div>
            </div>


            </div>
          </div>
        </div>

      </div>

      <h3 class="pnl-head-3">OBSERVASI PASIEN</h3>
      <div class="row pnl">

      <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th rowspan="2" style="transform:rotate(-90deg); text-align: center;vertical-align: middle;height:100px;">OBSERVASI</th>
                                <th rowspan="2" style="text-align: center;vertical-align: middle;height:100px;">JAM</th>
                                <th rowspan="2" style="text-align: center;vertical-align: middle;height:100px;">QB<br>(ml/mnt)</th>
                                <th rowspan="2" style="text-align: center;vertical-align: middle;height:100px;">UF<br>Rate(ml)</th>
                                <th rowspan="2" style="text-align: center;vertical-align: middle;height:100px;">Tek.Darah<br>(mmHg)</th>
                                <th rowspan="2" style="text-align: center;vertical-align: middle;height:100px;">Nadi<br>(x/mnt)</th>
                                <th rowspan="2" style="text-align: center;vertical-align: middle;height:100px;">Suhu<br>(°C)</th>
                                <th rowspan="2" style="text-align: center;vertical-align: middle;height:100px;">Resp<br>(x/mnt)</th>
                                <th colspan="4" style="text-align: center;vertical-align: middle;height:100px;">INTAKE ( CC )</th>
                                <th rowspan="1" style="text-align: center;vertical-align: middle;height:100px;">OUT PUT (CC)</th>
                                <th rowspan="2" style="text-align: center;vertical-align: middle;height:100px;">KET</th>
                                <th rowspan="2" style="text-align: center;vertical-align: middle;height:100px;">Creator</th>
                            </tr>
                            <tr>
                                <th style="text-align: center;vertical-align: middle;">NaCL<br>0,9%</th>
                                <th style="text-align: center;vertical-align: middle;">Dektrose<br>40%</th>
                                <th style="text-align: center;vertical-align: middle;">Makan/minum</th>
                                <th style="text-align: center;vertical-align: middle;">Lain-lain</th>
                                <th style="text-align: center;vertical-align: middle;">UF<br>Volume</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="prehdaddini">
                                <th style="text-align: center;">PRE HD</th>
                                <td><input type="text" class="form-control" id="line_1_a" name="line_1_a" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_1_b" name="line_1_b" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_1_c" name="line_1_c" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_1_d" name="line_1_d" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_1_e" name="line_1_e" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_1_f" name="line_1_f" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_1_g" name="line_1_g" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_1_h" name="line_1_h" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_1_i" name="line_1_i" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_1_j" name="line_1_j" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_1_k" name="line_1_k" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_1_l" name="line_1_l" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_1_m" name="line_1_m" placeholder="..."></td>
                                <td><small><i>Click 2 x untuk simpan</i></small></td>
                            </tr>
                            <tr class="listprerow" style="background-color: #30f25e;"></tr>
                            <tr id="intrahdaddini">
                                <th style="text-align: center;vertical-align: middle;">INTRA HD</th>
                                <td><input type="text" class="form-control" id="line_2_a" name="line_2_a" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_2_b" name="line_2_b" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_2_c" name="line_2_c" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_2_d" name="line_2_d" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_2_e" name="line_2_e" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_2_f" name="line_2_f" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_2_g" name="line_2_g" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_2_h" name="line_2_h" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_2_i" name="line_2_i" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_2_j" name="line_2_j" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_2_k" name="line_2_k" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_2_l" name="line_2_l" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_2_m" name="line_2_m" placeholder="..."></td>
                                <td><small><i>Click 2 x untuk simpan</i></small></td>
                            </tr>
                            </tbody>
                            <tbody class="listintrarow" style="background-color: #30f25e;"></tbody>
                            <tbody>
                            <tr id="posthdaddini">
                                <th style="text-align: center;vertical-align: middle;">POST HD</th>
                                <td><input type="text" class="form-control" id="line_3_a" name="line_3_a" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_3_b" name="line_3_b" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_3_c" name="line_3_c" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_3_d" name="line_3_d" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_3_e" name="line_3_e" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_3_f" name="line_3_f" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_3_g" name="line_3_g" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_3_h" name="line_3_h" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_3_i" name="line_3_i" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_3_j" name="line_3_j" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_3_k" name="line_3_k" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_3_l" name="line_3_l" placeholder="..."></td>
                                <td><input type="text" class="form-control" id="line_3_m" name="line_3_m" placeholder="..."></td>
                                <td><small><i>Click 2 x untuk simpan</i></small></td>
                            </tr>
                            <tr class="listpostrow" style="background-color: #30f25e;"></tr>
                            <tr>
                                <th colspan="8">&nbsp;</th>
                                <td colspan="4">JUMLAH : [total]</td>
                                <td>JUMLAH</td>
                                <td>BALANCE</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <th colspan="8">&nbsp;</th>
                                <td colspan="4">Total UF :.......................................ml</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <th colspan="5" rowspan="3">Penyulit Selama HD</th>
                                <td colspan="2">
                                  <div class="form-group">
                                    <input type="checkbox" name="obs_a[]" value="Masalah akses"> Masalah akses
                                    <div class="input-group-addon"> </div>
                                  </div>
                                </td>
                                <td colspan="2">
                                  <div class="form-group">
                                    <input type="checkbox" name="obs_a[]" value="Pendrahan"> Pendrahan
                                    <div class="input-group-addon"> </div>
                                  </div>
                                </td>
                                <td colspan="2">
                                  <div class="form-group">
                                    <input type="checkbox" name="obs_a[]" value="First use syndrome"> First use syndrome
                                    <div class="input-group-addon"> </div>
                                  </div>
                                </td>
                                <td colspan="2">
                                  <div class="form-group">
                                    <input type="checkbox" name="obs_a[]" value="Sakit kepala"> Sakit kepala
                                    <div class="input-group-addon"> </div>
                                  </div>
                                </td>
                                <td colspan="2">
                                  <div class="form-group">
                                    <input type="checkbox" name="obs_a[]" value="Mual & muntah"> Mual & muntah
                                    <div class="input-group-addon"> </div>
                                  </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                  <div class="form-group">
                                    <input type="checkbox" name="obs_a[]" value="Kram otot"> Kram otot
                                    <div class="input-group-addon"> </div>
                                  </div>
                                </td>
                                <td colspan="2">
                                  <div class="form-group">
                                    <input type="checkbox" name="obs_a[]" value="Hyperkalemia"> Hyperkalemia
                                    <div class="input-group-addon"> </div>
                                  </div>
                                </td>
                                <td colspan="2">
                                  <div class="form-group">
                                    <input type="checkbox" name="obs_a[]" value="Menggigil/dingin"> Menggigil/dingin
                                    <div class="input-group-addon"> </div>
                                  </div>
                                </td>
                                <td colspan="2">
                                  <div class="form-group">
                                    <input type="checkbox" name="obs_a[]" value="Nyeri dada"> Nyeri dada
                                    <div class="input-group-addon"> </div>
                                  </div>
                                </td>
                                <td colspan="2">
                                  <div class="form-group">
                                    <input type="checkbox" name="obs_a[]" value="Demam"> Demam
                                    <div class="input-group-addon"> </div>
                                  </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                  <div class="form-group">
                                    <input type="checkbox" name="obs_a[]" value="Gatal – gatal"> Gatal – gatal
                                    <div class="input-group-addon"> </div>
                                  </div>
                                </td>
                                <td colspan="2">
                                  <div class="form-group">
                                    <input type="checkbox" name="obs_a[]" value="Hypertensi"> Hypertensi
                                    <div class="input-group-addon"> </div>
                                  </div>
                                </td>
                                <td colspan="2">
                                  <div class="form-group">
                                    <input type="checkbox" name="obs_a[]" value="Hypotensi"> Hypotensi
                                    <div class="input-group-addon"> </div>
                                  </div>
                                </td>
                                <td colspan="2">
                                  <div class="form-group">
                                    <input type="checkbox" name="obs_a[]" value="Aritmia"> Aritmia
                                    <div class="input-group-addon"> </div>
                                  </div>
                                </td>
                                <td colspan="2">
                                  <div class="form-group">
                                  <input type="text" class="form-control" id="obs_lainnya_txt" name="obs_lainnya_txt" placeholder="....">
                                  </div>
                                </td>
                            </tr>
                            <!--<tr>
                                <th scope="row">2</th>
                                <td>Kolor Tea Shirt For Women</td>
                                <td><span class="badge badge-success">Tax</span></td>
                                <td>January 30</td>
                                <td class="color-success">$55.32</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Blue Backpack For Baby</td>
                                <td><span class="badge badge-danger">Extended</span></td>
                                <td>January 25</td>
                                <td class="color-danger">$14.85</td>
                            </tr>-->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
        

      </div>

      <h3 class="pnl-head-3">D.  EVALUASI KEPERAWATAN:</h3>
      <div class="row pnl">

        <div class="col-md-12">
         
        <div class="row">
        <label class="control-label">Edukasi Pasien dan Keluarga (termasuk Edukasi Kesembuhan) :</label>
        <div class="col-md-12">
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">
                <input type="checkbox" name="eva_kep_a[]" value="Rencana Pemulangan Pasien"> Rencana Pemulangan Pasien
                <div class="input-group-addon"> </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <input type="checkbox" name="eva_kep_a[]" value="Discharge Planing (gunakan form edukasi jika diperlukan)"> Discharge Planing (gunakan form edukasi jika diperlukan)
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
          <th class="column-title">Tanggal</th>
          <th class="column-title">No Mesin</th>
          <th class="column-title">Dibuat Oleh</th>
          <th class="column-title"><i class="fa fa-trash" style="color:red;"></i></th>
        </tr>
      </thead>                           
        <tbody id="tbriwhemodial"></tbody>
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
    listloghemodial(id_reg);

    //block first
    $("#line_1_a").attr("readonly", true); 
    $("#line_1_b").attr("readonly", true); 
    $("#line_1_c").attr("readonly", true); 
    $("#line_1_d").attr("readonly", true); 
    $("#line_1_e").attr("readonly", true); 
    $("#line_1_f").attr("readonly", true); 
    $("#line_1_g").attr("readonly", true); 
    $("#line_1_h").attr("readonly", true); 
    $("#line_1_i").attr("readonly", true); 
    $("#line_1_j").attr("readonly", true); 
    $("#line_1_k").attr("readonly", true); 
    $("#line_1_l").attr("readonly", true); 
    $("#line_1_m").attr("readonly", true);

    $("#line_2_a").attr("readonly", true); 
    $("#line_2_b").attr("readonly", true); 
    $("#line_2_c").attr("readonly", true); 
    $("#line_2_d").attr("readonly", true); 
    $("#line_2_e").attr("readonly", true); 
    $("#line_2_f").attr("readonly", true); 
    $("#line_2_g").attr("readonly", true); 
    $("#line_2_h").attr("readonly", true); 
    $("#line_2_i").attr("readonly", true); 
    $("#line_2_j").attr("readonly", true); 
    $("#line_2_k").attr("readonly", true); 
    $("#line_2_l").attr("readonly", true); 
    $("#line_2_m").attr("readonly", true);

    $("#line_3_a").attr("readonly", true); 
    $("#line_3_b").attr("readonly", true); 
    $("#line_3_c").attr("readonly", true); 
    $("#line_3_d").attr("readonly", true); 
    $("#line_3_e").attr("readonly", true); 
    $("#line_3_f").attr("readonly", true); 
    $("#line_3_g").attr("readonly", true); 
    $("#line_3_h").attr("readonly", true); 
    $("#line_3_i").attr("readonly", true); 
    $("#line_3_j").attr("readonly", true); 
    $("#line_3_k").attr("readonly", true); 
    $("#line_3_l").attr("readonly", true); 
    $("#line_3_m").attr("readonly", true); 
    //end block first
  });

  function listloghemodial(id_reg){
    $.ajax({
      url : baseUrl+"formkeperawatan/frm_hemodial/tbloghemodial",
      method : "POST",
      data : {id_reg:id_reg},
      async : true,
      dataType : 'json',
      success: function(res){
        var ires;
        var dataresnyah="";
      
         for (ires = 0; ires < res.length; ires++) {
                dataresnyah +="<tr>"
                +"<td><input type='radio' id='id_loghemodial' name='id_loghemodial' class='radbut_hemodial' data-set-id='"+res[ires].id+"'></td>"
                +"<td>"+res[ires].tgl_haritgljam+"</td>"
                +"<td>"+res[ires].nomesin+"</td>"
                +"<td>"+res[ires].creator+"</td>"
                +"<td><button type='button' class='btn btn-danger deleteloghemodial' data-set-id='"+res[ires].id+"'><i class='fa fa-trash' style='color:white;'></i></button></td>"
                +"</tr>";
         }
         
         $('#tbriwhemodial').html(dataresnyah);
         
         
         $(".radbut_hemodial").click(function(){
          $('#form_asm_awal_hemodial')[0].reset();
          $('input:checkbox').removeAttr('checked');
          document.getElementById('sini').scrollIntoView();
            var id     = $(this).attr("data-set-id");
            $('[name="id"]').val(id);
                  $.ajax({
                   url : baseUrl+"formkeperawatan/frm_hemodial/detailloghemodial",
                   method : "POST",
                   data : { id:id},
                   async : false,
                   dataType : 'json',
                   success: function(data){

                    $('[name="tgl_haritgljam"]').val(data.tgl_haritgljam);
                    $('[name="nomesin"]').val(data.nomesin);
                    $('[name="hdke"]').val(data.hdke);
                   
                    var tipe_dializer = data.tipe_dializer;
                    if (tipe_dializer == 'Baru') {
                      $('#form_asm_awal_hemodial').find(':radio[name=tipe_dializer][value="Baru"]').prop('checked', true).val();
                    } else if (tipe_dializer == 'Reuse') {
                      $('#form_asm_awal_hemodial').find(':radio[name=tipe_dializer][value="Reuse"]').prop('checked', true).val();
                    }

                    var riwalergiobat = data.riwalergiobat;
                    if (riwalergiobat == 'Tidak') {
                      $('#form_asm_awal_hemodial').find(':radio[name=riwalergiobat][value="Tidak"]').prop('checked', true).val();
                    } else if (riwalergiobat == 'Ya') {
                      $('#form_asm_awal_hemodial').find(':radio[name=riwalergiobat][value="Ya"]').prop('checked', true).val();
                    }

                    $('[name="riwalergiobat_text"]').val(data.riwalergiobat_text);
                    $('[name="diagnosamedis"]').val(data.diagnosamedis);

                    var carabayar = data.carabayar;
                    if (carabayar == 'Asuransi') {
                      $('#form_asm_awal_hemodial').find(':radio[name=carabayar][value="Asuransi"]').prop('checked', true).val();
                    } else if (carabayar == 'Tunai') {
                      $('#form_asm_awal_hemodial').find(':radio[name=carabayar][value="Tunai"]').prop('checked', true).val();
                    } else if (carabayar == 'BPJS') {
                      $('#form_asm_awal_hemodial').find(':radio[name=carabayar][value="BPJS"]').prop('checked', true).val();
                    } else if (carabayar == 'Pekerjaan') {
                      $('#form_asm_awal_hemodial').find(':radio[name=carabayar][value="Pekerjaan"]').prop('checked', true).val();
                    }

                    $('[name="carabayar_text"]').val(data.carabayar_text);

                    var keluhan_utama = data.keluhan_utama;
                    if (keluhan_utama.length > 0) {
                      var keluhan_utama = data.keluhan_utama.split(";"),
                        $inputs = $('input[name^=keluhan_utama]');
                      for (var j = 0; j < keluhan_utama.length; j++) {
                        $inputs.filter("[value='" + keluhan_utama[j] + "']").attr('checked', 'checked');
                      }
                    }

                    var keluhan_utama_rad = data.keluhan_utama_rad;
                    if (keluhan_utama_rad == 'Ringan 0 - 3') {
                      $('#form_asm_awal_hemodial').find(':radio[name=keluhan_utama_rad][value="Ringan 0 - 3"]').prop('checked', true).val();
                    } else if (keluhan_utama_rad == 'Sedang 4 - 6') {
                      $('#form_asm_awal_hemodial').find(':radio[name=keluhan_utama_rad][value="Sedang 4 - 6"]').prop('checked', true).val();
                    } else if (keluhan_utama_rad == 'Berat 7 - 10') {
                      $('#form_asm_awal_hemodial').find(':radio[name=keluhan_utama_rad][value="Berat 7 - 10"]').prop('checked', true).val();
                    }

                    $('[name="keluhan_utama_1_text"]').val(data.keluhan_utama_1_text);
                    $('[name="keluhan_utama_2_text"]').val(data.keluhan_utama_2_text);

                    var keadaan_umum_1 = data.keadaan_umum_1;
                    if (keadaan_umum_1.length > 0) {
                      var keadaan_umum_1 = data.keadaan_umum_1.split(";"),
                        $inputs = $('input[name^=keadaan_umum_1]');
                      for (var j = 0; j < keadaan_umum_1.length; j++) {
                        $inputs.filter("[value='" + keadaan_umum_1[j] + "']").attr('checked', 'checked');
                      }
                    }

                    $('[name="keadaan_umum_2_a_text"]').val(data.keadaan_umum_2_a_text);
                    $('[name="keadaan_umum_2_b_text"]').val(data.keadaan_umum_2_b_text);

                    var keadaan_umum_3 = data.keadaan_umum_3;
                    if (keadaan_umum_3.length > 0) {
                      var keadaan_umum_3 = data.keadaan_umum_3.split(";"),
                        $inputs = $('input[name^=keadaan_umum_3]');
                      for (var j = 0; j < keadaan_umum_3.length; j++) {
                        $inputs.filter("[value='" + keadaan_umum_3[j] + "']").attr('checked', 'checked');
                      }
                    }

                    $('[name="keadaan_umum_3_a_text"]').val(data.keadaan_umum_3_a_text);

                    var keadaan_umum_4 = data.keadaan_umum_4;
                    if (keadaan_umum_4.length > 0) {
                      var keadaan_umum_4 = data.keadaan_umum_4.split(";"),
                        $inputs = $('input[name^=keadaan_umum_4]');
                      for (var j = 0; j < keadaan_umum_4.length; j++) {
                        $inputs.filter("[value='" + keadaan_umum_4[j] + "']").attr('checked', 'checked');
                      }
                    }

                    $('[name="keadaan_umum_4_a_text"]').val(data.keadaan_umum_4_a_text);

                    var keadaan_umum_5 = data.keadaan_umum_5;
                    if (keadaan_umum_5.length > 0) {
                      var keadaan_umum_5 = data.keadaan_umum_5.split(";"),
                        $inputs = $('input[name^=keadaan_umum_5]');
                      for (var j = 0; j < keadaan_umum_5.length; j++) {
                        $inputs.filter("[value='" + keadaan_umum_5[j] + "']").attr('checked', 'checked');
                      }
                    }

                    var keadaan_umum_6 = data.keadaan_umum_6;
                    if (keadaan_umum_6.length > 0) {
                      var keadaan_umum_6 = data.keadaan_umum_6.split(";"),
                        $inputs = $('input[name^=keadaan_umum_6]');
                      for (var j = 0; j < keadaan_umum_6.length; j++) {
                        $inputs.filter("[value='" + keadaan_umum_6[j] + "']").attr('checked', 'checked');
                      }
                    }

                    $('[name="keadaan_umum_7_a_text"]').val(data.keadaan_umum_7_a_text);
                    $('[name="keadaan_umum_7_b_text"]').val(data.keadaan_umum_7_b_text);
                    $('[name="keadaan_umum_7_c_text"]').val(data.keadaan_umum_7_c_text);
                    $('[name="keadaan_umum_7_d_text"]').val(data.keadaan_umum_7_d_text);

                    var keadaan_umum_8 = data.keadaan_umum_8;
                    if (keadaan_umum_8.length > 0) {
                      var keadaan_umum_8 = data.keadaan_umum_8.split(";"),
                        $inputs = $('input[name^=keadaan_umum_8]');
                      for (var j = 0; j < keadaan_umum_8.length; j++) {
                        $inputs.filter("[value='" + keadaan_umum_8[j] + "']").attr('checked', 'checked');
                      }
                    }

                    $('[name="keadaan_umum_8_a_text"]').val(data.keadaan_umum_8_a_text);

                    var keadaan_umum_9_a = data.keadaan_umum_9_a;
                    if (keadaan_umum_9_a == '0') {
                      $('#form_asm_awal_hemodial').find(':radio[name=keadaan_umum_9_a][value="0"]').prop('checked', true).val();
                    } else if (keadaan_umum_9_a == '25') {
                      $('#form_asm_awal_hemodial').find(':radio[name=keadaan_umum_9_a][value="25"]').prop('checked', true).val();
                    }

                    var keadaan_umum_9_b = data.keadaan_umum_9_b;
                    if (keadaan_umum_9_b == '0') {
                      $('#form_asm_awal_hemodial').find(':radio[name=keadaan_umum_9_b][value="0"]').prop('checked', true).val();
                    } else if (keadaan_umum_9_b == '15') {
                      $('#form_asm_awal_hemodial').find(':radio[name=keadaan_umum_9_b][value="15"]').prop('checked', true).val();
                    }

                    var keadaan_umum_9_c = data.keadaan_umum_9_c;
                    if (keadaan_umum_9_c == '0') {
                      $('#form_asm_awal_hemodial').find(':radio[name=keadaan_umum_9_c][value="0"]').prop('checked', true).val();
                    } else if (keadaan_umum_9_c == '15') {
                      $('#form_asm_awal_hemodial').find(':radio[name=keadaan_umum_9_c][value="15"]').prop('checked', true).val();
                    } else if (keadaan_umum_9_c == '30') {
                      $('#form_asm_awal_hemodial').find(':radio[name=keadaan_umum_9_c][value="30"]').prop('checked', true).val();
                    }

                    var keadaan_umum_9_d = data.keadaan_umum_9_d;
                    if (keadaan_umum_9_d == '0') {
                      $('#form_asm_awal_hemodial').find(':radio[name=keadaan_umum_9_d][value="0"]').prop('checked', true).val();
                    } else if (keadaan_umum_9_d == '20') {
                      $('#form_asm_awal_hemodial').find(':radio[name=keadaan_umum_9_d][value="20"]').prop('checked', true).val();
                    }

                    var keadaan_umum_9_e = data.keadaan_umum_9_e;
                    if (keadaan_umum_9_e == '0') {
                      $('#form_asm_awal_hemodial').find(':radio[name=keadaan_umum_9_e][value="0"]').prop('checked', true).val();
                    } else if (keadaan_umum_9_e == '15') {
                      $('#form_asm_awal_hemodial').find(':radio[name=keadaan_umum_9_e][value="15"]').prop('checked', true).val();
                    } else if (keadaan_umum_9_e == '30') {
                      $('#form_asm_awal_hemodial').find(':radio[name=keadaan_umum_9_e][value="30"]').prop('checked', true).val();
                    }

                    var keadaan_umum_9_f = data.keadaan_umum_9_f;
                    if (keadaan_umum_9_f == '0') {
                      $('#form_asm_awal_hemodial').find(':radio[name=keadaan_umum_9_f][value="0"]').prop('checked', true).val();
                    } else if (keadaan_umum_9_f == '15') {
                      $('#form_asm_awal_hemodial').find(':radio[name=keadaan_umum_9_f][value="15"]').prop('checked', true).val();
                    }

                    var totalskor9nyah=parseInt(data.keadaan_umum_9_a)+parseInt(data.keadaan_umum_9_b)+parseInt(data.keadaan_umum_9_c)+parseInt(data.keadaan_umum_9_d)+parseInt(data.keadaan_umum_9_e)+parseInt(data.keadaan_umum_9_f);

                    $('[name="skor_9"]').val(totalskor9nyah);
                    if(totalskor9nyah < 24){
                      document.getElementById("set1024").setAttribute("class", "set1024"); 
                    }else if(totalskor9nyah > 24 && totalskor9nyah < 50){
                      document.getElementById("set2550").setAttribute("class", "set2550"); 
                    }else if(totalskor9nyah > 50){
                      document.getElementById("set51").setAttribute("class", "set51"); 
                    }
                    
                    
                    

                    $('[name="pemeriksaan_penunjang_10"]').val(data.pemeriksaan_penunjang_10);

                    $('[name="krn_a_text"]').val(data.krn_a_text);
                    $('[name="krn_b_text"]').val(data.krn_b_text);
                    $('[name="krn_c_text"]').val(data.krn_c_text);

                    ///malnutrisi automaton ?

                    var rikul_a = data.rikul_a;
                    if (rikul_a.length > 0) {
                      var rikul_a = data.rikul_a.split(";"),
                        $inputs = $('input[name^=rikul_a]');
                      for (var j = 0; j < rikul_a.length; j++) {
                        $inputs.filter("[value='" + rikul_a[j] + "']").attr('checked', 'checked');
                      }
                    }

                    $('[name="rikul_a_text"]').val(data.rikul_a_text);

                    var rikul_b = data.rikul_b;
                    if (rikul_b.length > 0) {
                      var rikul_b = data.rikul_b.split(";"),
                        $inputs = $('input[name^=rikul_b]');
                      for (var j = 0; j < rikul_b.length; j++) {
                        $inputs.filter("[value='" + rikul_b[j] + "']").attr('checked', 'checked');
                      }
                    }

                    $('[name="rikul_b_text"]').val(data.rikul_b_text);

                    var rikul_c = data.rikul_c;
                    if (rikul_c.length > 0) {
                      var rikul_c = data.rikul_c.split(";"),
                        $inputs = $('input[name^=rikul_c]');
                      for (var j = 0; j < rikul_c.length; j++) {
                        $inputs.filter("[value='" + rikul_c[j] + "']").attr('checked', 'checked');
                      }
                    }
                    
                    var rikul_d = data.rikul_d;
                    if (rikul_d.length > 0) {
                      var rikul_d = data.rikul_d.split(";"),
                        $inputs = $('input[name^=rikul_d]');
                      for (var j = 0; j < rikul_d.length; j++) {
                        $inputs.filter("[value='" + rikul_d[j] + "']").attr('checked', 'checked');
                      }
                    }

                    var diagnosa_kepe = data.diagnosa_kepe;
                    if (diagnosa_kepe.length > 0) {
                      var diagnosa_kepe = data.diagnosa_kepe.split(";"),
                        $inputs = $('input[name^=diagnosa_kepe]');
                      for (var j = 0; j < diagnosa_kepe.length; j++) {
                        $inputs.filter("[value='" + diagnosa_kepe[j] + "']").attr('checked', 'checked');
                      }
                    }
                    $('[name="diagnosa_kepe_text"]').val(data.diagnosa_kepe_text);

                    var perlu_doa_a = data.perlu_doa_a;
                    if (perlu_doa_a.length > 0) {
                      var perlu_doa_a = data.perlu_doa_a.split(";"),
                        $inputs = $('input[name^=perlu_doa_a]');
                      for (var j = 0; j < perlu_doa_a.length; j++) {
                        $inputs.filter("[value='" + perlu_doa_a[j] + "']").attr('checked', 'checked');
                      }
                    }

                    var intimp_a = data.intimp_a;
                    if (intimp_a.length > 0) {
                      var intimp_a = data.intimp_a.split(";"),
                        $inputs = $('input[name^=intimp_a]');
                      for (var j = 0; j < intimp_a.length; j++) {
                        $inputs.filter("[value='" + intimp_a[j] + "']").attr('checked', 'checked');
                      }
                    }

                    var intimp_b = data.intimp_b;
                    if (intimp_b.length > 0) {
                      var intimp_b = data.intimp_b.split(";"),
                        $inputs = $('input[name^=intimp_b]');
                      for (var j = 0; j < intimp_b.length; j++) {
                        $inputs.filter("[value='" + intimp_b[j] + "']").attr('checked', 'checked');
                      }
                    }

                    var instruksi_medik_a = data.instruksi_medik_a;
                    if (instruksi_medik_a.length > 0) {
                      var instruksi_medik_a = data.instruksi_medik_a.split(";"),
                        $inputs = $('input[name^=instruksi_medik_a]');
                      for (var j = 0; j < instruksi_medik_a.length; j++) {
                        $inputs.filter("[value='" + instruksi_medik_a[j] + "']").attr('checked', 'checked');
                      }
                    }

                    $('[name="instruksi_medik_a_text"]').val(data.instruksi_medik_a_text);
                    $('[name="instruksi_medik_b_text"]').val(data.instruksi_medik_b_text);
                    $('[name="instruksi_medik_c_text"]').val(data.instruksi_medik_c_text);
                    $('[name="instruksi_medik_d_text"]').val(data.instruksi_medik_d_text);
                    $('[name="instruksi_medik_e_text"]').val(data.instruksi_medik_e_text);
                    $('[name="instruksi_medik_f_text"]').val(data.instruksi_medik_f_text);
                    $('[name="instruksi_medik_g_text"]').val(data.instruksi_medik_g_text);
                    $('[name="instruksi_medik_h_text"]').val(data.instruksi_medik_h_text);
                    $('[name="instruksi_medik_i_text"]').val(data.instruksi_medik_i_text);
                    $('[name="instruksi_medik_j_text"]').val(data.instruksi_medik_j_text);
                    $('[name="instruksi_medik_k_text"]').val(data.instruksi_medik_k_text);
                    $('[name="instruksi_medik_l_text"]').val(data.instruksi_medik_l_text);

                    var obs_a = data.penyulit;
                    if (obs_a.length > 0) {
                      var obs_a = data.penyulit.split(";"),
                        $inputs = $('input[name^=obs_a]');
                      for (var j = 0; j < obs_a.length; j++) {
                        $inputs.filter("[value='" + obs_a[j] + "']").attr('checked', 'checked');
                      }
                    }

                    $('[name="obs_lainnya_txt"]').val(data.penyulit_txt);

                    var eva_kep_a = data.eval_kepe;
                    if (eva_kep_a.length > 0) {
                      var eva_kep_a = data.eval_kepe.split(";"),
                        $inputs = $('input[name^=eva_kep_a]');
                      for (var j = 0; j < eva_kep_a.length; j++) {
                        $inputs.filter("[value='" + eva_kep_a[j] + "']").attr('checked', 'checked');
                      }
                    }

                              
                   },
                    error: function(xhr, ajaxOptions, thrownError) {
                    show_my_error_message2(xhr.responseText,xhr.status,xhr.statusText);
                    }
                  });

                    //block first
                    $("#line_1_a").attr("readonly", false); 
                    $("#line_1_b").attr("readonly", false); 
                    $("#line_1_c").attr("readonly", false); 
                    $("#line_1_d").attr("readonly", false); 
                    $("#line_1_e").attr("readonly", false); 
                    $("#line_1_f").attr("readonly", false); 
                    $("#line_1_g").attr("readonly", false); 
                    $("#line_1_h").attr("readonly", false); 
                    $("#line_1_i").attr("readonly", false); 
                    $("#line_1_j").attr("readonly", false); 
                    $("#line_1_k").attr("readonly", false); 
                    $("#line_1_l").attr("readonly", false); 
                    $("#line_1_m").attr("readonly", false);

                    $("#line_2_a").attr("readonly", false); 
                    $("#line_2_b").attr("readonly", false); 
                    $("#line_2_c").attr("readonly", false); 
                    $("#line_2_d").attr("readonly", false); 
                    $("#line_2_e").attr("readonly", false); 
                    $("#line_2_f").attr("readonly", false); 
                    $("#line_2_g").attr("readonly", false); 
                    $("#line_2_h").attr("readonly", false); 
                    $("#line_2_i").attr("readonly", false); 
                    $("#line_2_j").attr("readonly", false); 
                    $("#line_2_k").attr("readonly", false); 
                    $("#line_2_l").attr("readonly", false); 
                    $("#line_2_m").attr("readonly", false);

                    $("#line_3_a").attr("readonly", false); 
                    $("#line_3_b").attr("readonly", false); 
                    $("#line_3_c").attr("readonly", false); 
                    $("#line_3_d").attr("readonly", false); 
                    $("#line_3_e").attr("readonly", false); 
                    $("#line_3_f").attr("readonly", false); 
                    $("#line_3_g").attr("readonly", false); 
                    $("#line_3_h").attr("readonly", false); 
                    $("#line_3_i").attr("readonly", false); 
                    $("#line_3_j").attr("readonly", false); 
                    $("#line_3_k").attr("readonly", false); 
                    $("#line_3_l").attr("readonly", false); 
                    $("#line_3_m").attr("readonly", false); 
                    //end block first

                  listprehd(id);
                  listintrahd(id);
                  listposthd(id);
                  

         });

          //DELETE
          $(".deleteloghemodial").click(function(e){

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
                  url : baseUrl+"formkeperawatan/frm_hemodial/deleteloghemodial",
                  method : "POST",
                  data : {id:id},
                  async : true,
                  dataType : 'json',
                    success: function(res){
                        Swal.fire('Berhasil!', '', 'success');
                        listloghemodial(id_reg);
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

  url = '<?php echo site_url('formkeperawatan/frm_hemodial/asm_hemodial_add');?>/'+id_reg ;
  title = 'Data ASM Berhasil Disimpan';

  var data_submit = $('#form_asm_awal_hemodial').serialize();
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

      $('.listprerow').html('');
      $('.listintrarow').html('');
      $('.listpostrow').html('');
      listloghemodial(id_reg);
      $('#form_asm_awal_hemodial')[0].reset();
      $('input:checkbox').removeAttr('checked');
      document.getElementById('sini_listnyah').scrollIntoView();
      
    },
      error: function(xhr, ajaxOptions, thrownError) {
        show_my_error_message2(xhr.responseText,xhr.status,xhr.statusText);
      }
  });
  

}

$("#kelist").click(function(){
  document.getElementById('sini_listnyah').scrollIntoView();
});

$('.tanggal').datetimepicker({
  dateFormat: "yy-mm-dd",
  autoclose: true,
  language: 'id',
});



  $("#prehdaddini").dblclick(function(){

    var id                  = $('#id').val();
    if(id=='' || id==null){
      Swal.fire('Gagal!', 'ID Tidak Boleh Kosong', 'danger');
      return false;
    }else{
    var id_reg              = $('#id_reg').val();
    var line_1_a            = $('#line_1_a').val();
    var line_1_b            = $('#line_1_b').val();
    var line_1_c            = $('#line_1_c').val();
    var line_1_d            = $('#line_1_d').val();
    var line_1_e            = $('#line_1_e').val();
    var line_1_f            = $('#line_1_f').val();
    var line_1_g            = $('#line_1_g').val();
    var line_1_h            = $('#line_1_h').val();
    var line_1_i            = $('#line_1_i').val();
    var line_1_j            = $('#line_1_j').val();
    var line_1_k            = $('#line_1_k').val();
    var line_1_l            = $('#line_1_l').val();
    var line_1_m            = $('#line_1_m').val();
    var line_1_n            = $('#line_1_n').val();
    
    $.ajax({
      url : baseUrl+"formkeperawatan/frm_hemodial/asm_hemodial_add_pre",
      method : "POST",
      data : {id:id,id_reg:id_reg,line_1_a:line_1_a,line_1_b:line_1_b,line_1_c:line_1_c,line_1_d:line_1_d,line_1_e:line_1_e,line_1_f:line_1_f,line_1_g:line_1_g,line_1_h:line_1_h,line_1_i:line_1_i,line_1_j:line_1_j,  line_1_k:line_1_k,line_1_l:line_1_l,line_1_m:line_1_m,line_1_n:line_1_n},
      async : true,
      dataType : 'json',
      success: function(datarestind){
        Swal.fire('Berhasil!', 'Simpan Pre HD', 'success');
        listprehd(id);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        show_my_error_message2(xhr.responseText,xhr.status,xhr.statusText);
      }
    });
    }
  });

  $("#intrahdaddini").dblclick(function(){

    var id                  = $('#id').val();
    if(id=='' || id==null){
      Swal.fire('Gagal!', 'ID Tidak Boleh Kosong', 'danger');
      return false;
    }else{
    var id_reg              = $('#id_reg').val();
    var line_2_a            = $('#line_2_a').val();
    var line_2_b            = $('#line_2_b').val();
    var line_2_c            = $('#line_2_c').val();
    var line_2_d            = $('#line_2_d').val();
    var line_2_e            = $('#line_2_e').val();
    var line_2_f            = $('#line_2_f').val();
    var line_2_g            = $('#line_2_g').val();
    var line_2_h            = $('#line_2_h').val();
    var line_2_i            = $('#line_2_i').val();
    var line_2_j            = $('#line_2_j').val();
    var line_2_k            = $('#line_2_k').val();
    var line_2_l            = $('#line_2_l').val();
    var line_2_m            = $('#line_2_m').val();
    var line_2_n            = $('#line_2_n').val();

      $.ajax({
      url : baseUrl+"formkeperawatan/frm_hemodial/asm_hemodial_add_intra",
      method : "POST",
      data : {id:id,id_reg:id_reg,line_2_a:line_2_a,line_2_b:line_2_b,line_2_c:line_2_c,line_2_d:line_2_d,line_2_e:line_2_e,line_2_f:line_2_f,line_2_g:line_2_g,line_2_h:line_2_h,line_2_i:line_2_i,line_2_j:line_2_j,    line_2_k:line_2_k,line_2_l:line_2_l,line_2_m:line_2_m,line_2_n:line_2_n},
      async : true,
      dataType : 'json',
      success: function(datarestind){
        Swal.fire('Berhasil!', 'Simpan Intra HD', 'success');
        listintrahd(id);
        
        $('#line_2_a').val('');
        $('#line_2_b').val('');
        $('#line_2_c').val('');
        $('#line_2_d').val('');
        $('#line_2_e').val('');
        $('#line_2_f').val('');
        $('#line_2_g').val('');
        $('#line_2_h').val('');
        $('#line_2_i').val('');
        $('#line_2_j').val('');
        $('#line_2_k').val('');
        $('#line_2_l').val('');
        $('#line_2_m').val('');
        $('#line_2_n').val('');
        
      },
      error: function(xhr, ajaxOptions, thrownError) {
        show_my_error_message2(xhr.responseText,xhr.status,xhr.statusText);
      }
    });
  }
  });

  $("#posthdaddini").dblclick(function(){

    var id                  = $('#id').val();
    if(id=='' || id==null){
      Swal.fire('Gagal!', 'ID Tidak Boleh Kosong', 'danger');
      return false;
    }else{
    var id_reg              = $('#id_reg').val();
    var line_3_a            = $('#line_3_a').val();
    var line_3_b            = $('#line_3_b').val();
    var line_3_c            = $('#line_3_c').val();
    var line_3_d            = $('#line_3_d').val();
    var line_3_e            = $('#line_3_e').val();
    var line_3_f            = $('#line_3_f').val();
    var line_3_g            = $('#line_3_g').val();
    var line_3_h            = $('#line_3_h').val();
    var line_3_i            = $('#line_3_i').val();
    var line_3_j            = $('#line_3_j').val();
    var line_3_k            = $('#line_3_k').val();
    var line_3_l            = $('#line_3_l').val();
    var line_3_m            = $('#line_3_m').val();
    var line_3_n            = $('#line_3_n').val();

      $.ajax({
      url : baseUrl+"formkeperawatan/frm_hemodial/asm_hemodial_add_post",
      method : "POST",
      data : {id:id,id_reg:id_reg,line_3_a:line_3_a,line_3_b:line_3_b,line_3_c:line_3_c,line_3_d:line_3_d,line_3_e:line_3_e,line_3_f:line_3_f,line_3_g:line_3_g,line_3_h:line_3_h,line_3_i:line_3_i,line_3_j:line_3_j,       line_3_k:line_3_k,line_3_l:line_3_l,line_3_m:line_3_m,line_3_n:line_3_n},
      async : true,
      dataType : 'json',
      success: function(datarestind){
        Swal.fire('Berhasil!', 'Simpan Post HD', 'success');
        listposthd(id);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        show_my_error_message2(xhr.responseText,xhr.status,xhr.statusText);
      }
    });
  }
  });

  function listprehd(id){
    $.ajax({
      url : baseUrl+"formkeperawatan/frm_hemodial/listprehd",
      method : "POST",
      data : {id:id},
      async : true,
      dataType : 'json',
      success: function(datarestind){
        var datarestindsend="";

        if(datarestind == null){
          $('.listprerow').html('');
        }else{

          $('#line_1_a').val(datarestind.jam);
          $('#line_1_b').val(datarestind.qb);
          $('#line_1_c').val(datarestind.ufrate);
          $('#line_1_d').val(datarestind.tekdarah);
          $('#line_1_e').val(datarestind.nadi);
          $('#line_1_f').val(datarestind.suhu);
          $('#line_1_g').val(datarestind.resp);
          $('#line_1_h').val(datarestind.nacl);
          $('#line_1_i').val(datarestind.dektrose);
          $('#line_1_j').val(datarestind.makanminum);
          $('#line_1_k').val(datarestind.lainlain);
          $('#line_1_l').val(datarestind.ufvolume);
          $('#line_1_m').val(datarestind.ket);
          $('#line_1_n').val(datarestind.creator);

          datarestindsend ="<th style='text-align: center;vertical-align: middle;'> </th>"+
          "<td>"+datarestind.jam+"</td>"+
          "<td>"+datarestind.qb+"</td>"+
          "<td>"+datarestind.ufrate+"</td>"+
          "<td>"+datarestind.tekdarah+"</td>"+
          "<td>"+datarestind.nadi+"</td>"+
          "<td>"+datarestind.suhu+"</td>"+
          "<td>"+datarestind.resp+"</td>"+
          "<td>"+datarestind.nacl+"</td>"+
          "<td>"+datarestind.dektrose+"</td>"+
          "<td>"+datarestind.makanminum+"</td>"+
          "<td>"+datarestind.lainlain+"</td>"+
          "<td>"+datarestind.ufvolume+"</td>"+
          "<td>"+datarestind.ket+"</td>"+
          "<td>"+datarestind.creator+"</td>";
              
          $('.listprerow').html(datarestindsend);

      }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        show_my_error_message2(xhr.responseText,xhr.status,xhr.statusText);
      }
    });

  }

  function listintrahd(id){
    $.ajax({
      url : baseUrl+"formkeperawatan/frm_hemodial/listintrahd",
      method : "POST",
      data : {id:id},
      async : true,
      dataType : 'json',
      success: function(datarestind){
        var irestind;
        var datarestindsend="";
    
        for (irestind = 0; irestind < datarestind.length; irestind++) {
          var irestindnum = irestind+1;
          datarestindsend +="<tr style='text-align: center;vertical-align: middle;'>"+
          "<th style='text-align: center;vertical-align: middle;'><button type='button' class='btn btn-danger seldel' data-set-id='"+datarestind[irestind].id+"'><i class='fa fa-trash' style='color:white;'></i></button></th>"+
          "<td>"+datarestind[irestind].jam+"</td>"+
          "<td>"+datarestind[irestind].qb+"</td>"+
          "<td>"+datarestind[irestind].ufrate+"</td>"+
          "<td>"+datarestind[irestind].tekdarah+"</td>"+
          "<td>"+datarestind[irestind].nadi+"</td>"+
          "<td>"+datarestind[irestind].suhu+"</td>"+
          "<td>"+datarestind[irestind].resp+"</td>"+
          "<td>"+datarestind[irestind].nacl+"</td>"+
          "<td>"+datarestind[irestind].dektrose+"</td>"+
          "<td>"+datarestind[irestind].makanminum+"</td>"+
          "<td>"+datarestind[irestind].lainlain+"</td>"+
          "<td>"+datarestind[irestind].ufvolume+"</td>"+
          "<td>"+datarestind[irestind].ket+"</td>"+
          "<td>"+datarestind[irestind].creator+"</td>"+
          "</tr>";
        }
              
        $('.listintrarow').html(datarestindsend);

        $(".seldel").click(function(){
          var id   = $(this).attr("data-set-id");
            //alert
            Swal.fire({
                   title: 'Hapus',
                   text: 'Hapus Item ?' ,
                   showDenyButton: true,
                   showCancelButton: false,
                   confirmButtonText: 'Yes',
                   denyButtonText: 'No',
                   customClass: {
                     actions: 'my-actions',
                     //cancelButton: 'order-1 right-gap',
                     confirmButton: 'order-2',
                     denyButton: 'order-3',
                   }
                  }).then((result) => {
                   if (result.isConfirmed) {
                         swal.fire('Hapus!','Hapus item berhasil!', 'success').then(function(){ 
                          delitemop(id);
                          listintrahd(id_reg);
                         }
                       );

                     } else if (result.isDenied) {
                       Swal.fire('Batal Hapus!', 'Batal hapus item!', 'info')
                     }
                  })
                  ////
            //end alert

            function delitemop(id) {
               //set hapus
               $.ajax({
                url : baseUrl+"formkeperawatan/frm_hemodial/delintra",
                method : "POST",
                data : { id : id },
                async : false,
                dataType : 'json',
                success: function(data){
                  listintrahd(id_reg);
                }
               });
               //End hapus
            }





         });


      },
      error: function(xhr, ajaxOptions, thrownError) {
        show_my_error_message2(xhr.responseText,xhr.status,xhr.statusText);
      }
    });

  }

  function listposthd(id){
    $.ajax({
      url : baseUrl+"formkeperawatan/frm_hemodial/listposthd",
      method : "POST",
      data : {id:id},
      async : true,
      dataType : 'json',
      success: function(datarestind){
        var datarestindsend="";

        if(datarestind == null){
          $('.listpostrow').html('');
        }else{

          $('#line_3_a').val(datarestind.jam);
          $('#line_3_b').val(datarestind.qb);
          $('#line_3_c').val(datarestind.ufrate);
          $('#line_3_d').val(datarestind.tekdarah);
          $('#line_3_e').val(datarestind.nadi);
          $('#line_3_f').val(datarestind.suhu);
          $('#line_3_g').val(datarestind.resp);
          $('#line_3_h').val(datarestind.nacl);
          $('#line_3_i').val(datarestind.dektrose);
          $('#line_3_j').val(datarestind.makanminum);
          $('#line_3_k').val(datarestind.lainlain);
          $('#line_3_l').val(datarestind.ufvolume);
          $('#line_3_m').val(datarestind.ket);
          $('#line_3_n').val(datarestind.creator);

          datarestindsend ="<th style='text-align: center;vertical-align: middle;'> </th>"+
          "<td>"+datarestind.jam+"</td>"+
          "<td>"+datarestind.qb+"</td>"+
          "<td>"+datarestind.ufrate+"</td>"+
          "<td>"+datarestind.tekdarah+"</td>"+
          "<td>"+datarestind.nadi+"</td>"+
          "<td>"+datarestind.suhu+"</td>"+
          "<td>"+datarestind.resp+"</td>"+
          "<td>"+datarestind.nacl+"</td>"+
          "<td>"+datarestind.dektrose+"</td>"+
          "<td>"+datarestind.makanminum+"</td>"+
          "<td>"+datarestind.lainlain+"</td>"+
          "<td>"+datarestind.ufvolume+"</td>"+
          "<td>"+datarestind.ket+"</td>"+
          "<td>"+datarestind.creator+"</td>";
              
          $('.listpostrow').html(datarestindsend);
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        show_my_error_message2(xhr.responseText,xhr.status,xhr.statusText);
      }
    });

  }



</script>