<!doctype html>
<html>

<head>
  <?php $this->theme->head('theme_default'); ?>

  <style type="text/css">
    .modal-lg-smart {
      max-height: 700px;
    }

    .border-kotak {
      border-style: solid;
      border-width: 1px;
    }
  </style>
</head>

<div class="container-fluid">
  <div class="table-wrapper">

    <div class="table-title">
      <div class="row">
        <div class="col-sm-8 p-5">
          <button type="button" class="btn btn-secondary add-new fa fa-plus" onclick="add_cppt('<?php echo $id_reg; ?>')">
            TAMBAH
          </button>
        </div>
      </div>
    </div>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col" class="text-center">No</th>
          <th scope="col" class="text-center">Noreg</th>
          <th scope="col" class="text-center">Tgl Kaji</th>
          <th scope="col" class="text-center">Kategori</th>
          <th scope="col" class="text-center">Jenis</th>
          <th scope="col" class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i = 1;
        foreach ($rs as $v)
        {
          $icon_update = base_url('assets/img/tulis.png');
          $icon_delete = base_url('assets/img/delete.png');

          $id_asmri 	= $v['id_asmri'];
          if($id_role == 1)
          {
            $update ='<a href="#" onclick="javascript:update_cppt('.$id_asmri.')"><img src="'.$icon_update.'" alt="Update"></a>';
            $delete ='<a href="#" onclick="javascript:delete_cppt('.$id_asmri.')"><img src="'.$icon_delete.'" alt="Update"></a>';
          }else {
            $update ='<a href="#" onclick="javascript:update_cppt('.$id_asmri.')"><img src="'.$icon_update.'" alt="Update"></a>';
            $delete ='<a href="#" onclick="javascript:delete_cppt('.$id_asmri.')"><img src="'.$icon_delete.'" alt="Update"></a>';
          }

         ?>
        <tr>
          <td> <?php echo $i; ?> </td>
          <td> <?php echo $v['id_reg']; ?> </td>
          <td> <?php echo $v['tgl_pengkajian']; ?> </td>
          <td> <?php echo $v['kategori']; ?></td>
          <td> <?php echo $v['jenis_asm']; ?></td>
          <td class="text-center">
            <a href="#" onClick="javascript:void window.open('<?php echo base_url('ppa/ppa_viewer/'.$id_asmri) ?>','1541221517736', 'width=1024,height=600,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;">
              <img src="<?php echo base_url('assets/img/view.png'); ?>" alt="View"></a>&nbsp;&nbsp;&nbsp;&nbsp;
            <?php echo $update; ?> &nbsp;&nbsp;&nbsp;&nbsp;
            <?php echo $delete; ?> &nbsp;&nbsp;&nbsp;&nbsp;
          </td>
        </tr>
      <?php $i++; } ?>
      </tbody>
    </table>

  </div>
</div>

<div class="modal animated bounceIn" id="modal_form_cppt" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg modal-lg-smart" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">CPPT PPA</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body form_cppt">
        <form action="#" id="form_cppt">
          <div class="form-body">
            <!-- Hidden fields -->
            <input type="hidden" class="form-control input-default" id="id_asmri" name="id_asmri">
            <input type="hidden" class="form-control input-default" id="asmri_date" name="asmri_date">
            <input type="hidden" class="form-control input-default" id="tgl_pengkajian" name="tgl_pengkajian">

            <input type="hidden" class="form-control input-default" id="id_pasien" name="id_pasien">
            <input type="hidden" class="form-control input-default" id="id_reg" name="id_reg">
            <input type="hidden" class="form-control input-default" id="id_dokter" name="id_dokter">
            <input type="hidden" class="form-control input-default" id="id_type" name="id_type" value="2">

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
                    name="riwayat_sakit" rows="5" placeholder="Riwayat Penyakit Sekarang" readonly><?php echo nl2br($riwayat_pasien['penyakit_sekarang']); ?></textarea>
                </div>

                <div class="form-group">
                  <label class="control-label">Riwayat Penyakit Dahulu :</label>
                  <textarea class="form-control input-focus area-scroll" id="riwayat_sakit_dulu"
                    name="riwayat_sakit_dulu" rows="5" placeholder="Riwayat Penyakit Dahulu" readonly><?php echo nl2br($riwayat_pasien['penyakit_dahulu']); ?></textarea>
                  <hr>
                </div>
              </div>
              <!--/span-->
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Riwayat Pengobatan/Operasi/Obstetri :</label>
                  <textarea class="form-control input-focus area-scroll" id="riwayat_pengobatan"
                    name="riwayat_pengobatan" rows="5" placeholder="Riwayat Pengobatan/Operasi/Obstetri" readonly><?php echo nl2br($riwayat_pasien['pengobatan']); ?></textarea>
                </div>

                <div class="form-group">
                  <label class="control-label">Riwayat Penyakit Keluarga :</label>
                  <textarea class="form-control input-focus area-scroll" id="riwayat_sakit_keluarga"
                    name="riwayat_sakit_keluarga" rows="5" placeholder="Riwayat Penyakit Keluarga" readonly><?php echo nl2br($riwayat_pasien['penyakit_keluarga']); ?></textarea>

                </div>

                <div class="form-group">
                  <label class="control-label">Riwayat Alergi :</label>
                  <textarea class="form-control input-focus area-scroll" id="riwayat_alergi" name="riwayat_alergi"
                    rows="5" placeholder="Riwayat Alergi" readonly><?php echo nl2br($riwayat_pasien['alergi']); ?></textarea>
                  <hr>
                </div>
              </div>

            </div>

            <h3 class="pnl-head-3">OBJECTIVE</h3>
            <div class="row pnl">

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
                      <label class="control-label">Genetalia:</label>
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
                  <button type="button" class="btn btn-success" onclick="javascript: save_cppt('<?php echo $id_reg; ?>'+'/'+'CPPT');">
                    <i class="fa fa-check"></i> Save</button>
                  <button type="button" class="btn btn-inverse" data-dismiss="modal">Cancel</button>
                </div>
              </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- action here -->
<script>
  var save_method;
  var table;

  function add_cppt(id_reg,kategori) {
    save_method = 'add';
    $('#form_cppt')[0].reset();
    $('#modal_form_cppt').modal('show');
  }

  function save_cppt(id_reg,kategori) {
    var url;

    if (save_method == 'add') {
      url = '<?php echo site_url('nurse_station/eranap/asm_ranap_add');?>/'+id_reg+'/'+kategori ;
      title = 'Data CPPT Berhasil Disimpan';
    } else {
      url = '<?php echo site_url('nurse_station/eranap/asm_ranap_edit_act');?>/'+id_reg;
      title = 'Data CPPT Berhasil Diupdate';
    }
    var data_submit = $('#form_cppt').serialize();
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
      error: function(jqXHR, textStatus, errorThrown) {
        //console.log(data);
        alert('Error Add / Update Data');
      }
    });

  }

  function update_cppt(id_asmri) {
    save_method = 'update';
    $('#form_cppt')[0].reset();

    $.ajax({
      url: '<?php echo site_url('nurse_station/eranap/asm_ranap_edit');?>/'+id_asmri,
      type: 'GET',
      dataType: 'JSON',
      success: function(data) {
        $('[name="id_asmri"]').val(data.id_asmri);
        $('[name="regdate"]').val(data.regdate);
        $('[name="asmri_date"]').val(data.asmri_date);
        $('[name="tgl_pengkajian"]').val(data.tgl_pengkajian);
        $('[name="asal_masuk"]').val(data.asal_masuk);
        $('[name="cara_masuk"]').val(data.cara_masuk);

        $('[name="id_pasien"]').val(data.id_pasien);
        $('[name="id_reg"]').val(data.id_reg);
        $('[name="nama_pasien"]').val(data.nama_pasien);
        $('[name="id_dokter"]').val(data.id_dokter);
        $('[name="jenis_asm"]').val(data.jenis_asm);
        $('[name="kategori"]').val(data.kategori);
        $('[name="id_type"]').val(data.id_type);

        $('[name="subjective"]').val(data.subjective);
        $('[name="keluhan_utama"]').val(data.keluhan_utama);
        $('[name="riwayat_sakit"]').val(data.riwayat_sakit);
        $('[name="riwayat_sakit_dulu"]').val(data.riwayat_sakit_dulu);
        $('[name="riwayat_pengobatan"]').val(data.riwayat_pengobatan);
        $('[name="riwayat_sakit_keluarga"]').val(data.riwayat_sakit_keluarga);
        $('[name="riwayat_alergi"]').val(data.riwayat_alergi);

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

        $('[name="kualitas_nyeri"]').val(data.kualitas_nyeri);
        $('[name="frekuensi_nyeri"]').val(data.frekuensi_nyeri);
        $('[name="waktu_nyeri"]').val(data.waktu_nyeri);
        $('[name="intesnsitas_nyeri"]').val(data.intesnsitas_nyeri);
        $('[name="nyeri"]').val(data.nyeri);
        $('[name="pengaruh_nyeri"]').val(data.pengaruh_nyeri);
        $('[name="aktivitas"]').val(data.aktivitas);
        $('[name="restrain"]').val(data.restrain);

        $('[name="anak_nyeri_face"]').val(data.anak_nyeri_face);
        $('[name="anak_nyeri_legs"]').val(data.anak_nyeri_legs);
        $('[name="anak_nyeri_activity"]').val(data.anak_nyeri_activity);
        $('[name="anak_nyeri_cry"]').val(data.anak_nyeri_cry);
        $('[name="anak_nyeri_consolability"]').val(data.anak_nyeri_consolability);
        $('[name="anak_nyeri_total"]').val(data.anak_nyeri_total);

        var anak_riwayat_imunisasi = data.anak_riwayat_imunisasi;
        if (anak_riwayat_imunisasi.length > 0) {
          var anak_riwayat_imunisasi = data.anak_riwayat_imunisasi.split(";"),
            $inputs = $('input[name^=anak_riwayat_imunisasi]');
          for (var j = 0; j < anak_riwayat_imunisasi.length; j++) {
            $inputs.filter("[value='" + anak_riwayat_imunisasi[j] + "']").attr('checked', 'checked');
          }
        }

        $('[name="anak_tk_senyum"]').val(data.anak_tk_senyum);
        $('[name="anak_tk_tengkurap"]').val(data.anak_tk_tengkurap);
        $('[name="anak_tk_duduk"]').val(data.anak_tk_duduk);
        $('[name="anak_tk_merangkak"]').val(data.anak_tk_merangkak);
        $('[name="anak_tk_berdiri"]').val(data.anak_tk_berdiri);
        $('[name="anak_tk_berjalan"]').val(data.anak_tk_berjalan);
        $('[name="anak_tk_bicara"]').val(data.anak_tk_bicara);
        $('[name="anak_tk_sekolah"]').val(data.anak_tk_sekolah);

        $('[name="bb_turun"]').val(data.bb_turun);
        $('[name="bb_turun_qty"]').val(data.bb_turun_qty);
        $('[name="nafsu_makan"]').val(data.nafsu_makan);
        $('[name="total_skor"]').val(data.total_skor);
        $('[name="diagnosa_khusus"]').val(data.diagnosa_khusus);
        $('[name="pola_makan"]').val(data.pola_makan);

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

        $('[name="resiko_jatuh_dws"]').val(data.resiko_jatuh_dws);
        $('[name="resiko_jatuh_gr"]').val(data.resiko_jatuh_gr);
        $('[name="resiko_jatuh_anak"]').val(data.resiko_jatuh_anak);

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

        //$('[name="created"]').val(data.created);
        //$('[name="creator"]').val(data.creator);
        $('[name="updated"]').val(data.updated);
        $('[name="updator"]').val(data.updator);


        $('#modal_form_cppt').modal('show');
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(data);
        alert('Error Get Data From Ajax');
      }
    });

  }

  function delete_cppt(id_asmri) {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, cancel!',
      confirmButtonClass: 'btn btn-success',
      cancelButtonClass: 'btn btn-danger',
      buttonsStyling: false
    }).then((result) => {
      if (result.value) {

        $.ajax({
          url: '<?php echo site_url('nurse_station/eranap/asm_ranap_delete');?>/'+id_asmri,
          type: 'POST',
          dataType: 'JSON',
          success: function(data) {
            if (result.value) {
              /* Swal({
                type: 'success',
                title: 'Data Berhasil Dihapus',
                showConfirmButton: false,
                timer: 1000
              }); */

              window.setTimeout(function() {
                location.reload();
              }, 1000);
            } else {
              Swal.close(
                'Cancelled',
                'Dibatalkan',
                'error'
              )
            }

          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert('Error DELETE Data From Ajax');
          }
        });

      } else if (
        // Read more about handling dismissals
        result.dismiss === Swal.DismissReason.cancel
      ) {
        /* swal.fire(
          'Cancelled',
          'Your imaginary file is safe :)',
          'error'
        ) */
      }


    });

  }
</script>

</body>

</html>
